let userData = null;
let apiKeyVisible = false;
let allUsers = [];

async function loadDashboard() {
  try {
    userData = await API.getMe();
    currentUserEmail = userData.email;
    isOAuthUser = userData.oauth_provider !== null;

    if (!userData.email_verified) {
      const emailCard = document.getElementById("email-verification-card");
      if (emailCard) {
        emailCard.classList.remove("d-none");
      }
    }

    document.getElementById("newsUpdatesToggle").checked =
      userData.accept_news_updates;

    document.getElementById("userEmailHint").textContent =
      `Your email: ${currentUserEmail}`;
    if (isOAuthUser) {
      document.getElementById("oauthWarning").style.display = "block";
      const icon = document.querySelector("#oauthWarning i");
      if (userData.oauth_provider === "google") {
        icon.className = "fab fa-google me-2";
      }
    }
    const emailText = document.getElementById("email-text");
    if (emailText) {
      emailText.textContent = userData.email;
    }

    const tierElement = document.getElementById("subscription-tier");
    let tierText = "Free";
    if (
      userData.subscription_tier &&
      userData.subscription_tier !== "none" &&
      userData.subscription_tier !== "free"
    ) {
      tierText =
        userData.subscription_tier.charAt(0).toUpperCase() +
        userData.subscription_tier.slice(1);
    }
    tierElement.textContent = tierText;

    const statusElement = document.getElementById("subscription-status");
    const status = userData.subscription_status || "inactive";
    if (userData.subscription_status?.startsWith("changing_to_")) {
      const newTier = userData.subscription_status.replace("changing_to_", "");
      statusElement.innerHTML = `
    <span class="badge bg-info">
      Changing to ${
        newTier.charAt(0).toUpperCase() + newTier.slice(1)
      } next billing cycle
    </span>
  `;
    } else if (status === "active") {
      statusElement.innerHTML = '<span class="badge bg-success">Active</span>';
    } else if (status === "canceling") {
      statusElement.innerHTML =
        '<span class="badge bg-warning">Canceling at period end</span>';
    } else if (status === "canceled") {
      statusElement.innerHTML = '<span class="badge bg-danger">Canceled</span>';
    } else {
      statusElement.innerHTML =
        '<span class="badge bg-secondary">Inactive</span>';
    }
    document.getElementById("credits-remaining").textContent =
      userData.credits_remaining;
    document.getElementById("credits-total").textContent =
      userData.credits_total;
    document.getElementById("credits-used").textContent =
      userData.credits_total - userData.credits_remaining;

    const percentage =
      userData.credits_total > 0
        ? (userData.credits_remaining / userData.credits_total) * 100
        : 0;
    document.getElementById("credits-progress").style.width = `${percentage}%`;
    document.getElementById("api-key").dataset.key = userData.api_key;

    if (
      !userData.subscription_tier ||
      userData.subscription_tier === "none" ||
      userData.subscription_tier === "free"
    ) {
      document.getElementById("pricing-section").classList.remove("d-none");
      document
        .getElementById("current-subscription-info")
        .classList.add("d-none");
    } else {
      document.getElementById("pricing-section").classList.add("d-none");
      document
        .getElementById("current-subscription-info")
        .classList.remove("d-none");
    }

    const subscriptionActions = document.getElementById("subscription-actions");
    const hasPaidPlan =
      userData.subscription_tier &&
      userData.subscription_tier !== "none" &&
      userData.subscription_tier !== "free";

    if (hasPaidPlan && (status === "active" || status === "canceling")) {
      subscriptionActions.innerHTML = `
        <button class="btn btn-sm btn-outline-light w-100 mt-3" 
                onclick="trackClick('manage_billing', 'Stripe Customer Portal').then(() => manageSubscription())">
          <i class="fas fa-cog me-1"></i>Manage Subscription
        </button>
      `;
    } else {
      subscriptionActions.innerHTML = `
        <button class="btn btn-gradient-primary btn-sm w-100 mt-3" 
                onclick="trackClick('begin_checkout', 'Dashboard Upgrade Button').then(() => showSection('subscription'))">
          <i class="fas fa-rocket me-2"></i>Upgrade Now
        </button>
      `;
    }
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("success") === "true") {
      showNotification(
        "Subscription activated! Your credits have been added.",
        "success",
      );
      window.history.replaceState({}, "", "/dashboard.html");
    }
    if (urlParams.get("canceled") === "true") {
      showNotification("Payment canceled. You can try again anytime.", "info");
      window.history.replaceState({}, "", "/dashboard.html");
    }
    updateSubscriptionInfo();
  } catch (error) {
    console.error("Dashboard load error:", error);
    localStorage.removeItem("token");
    window.location.href = "login.html";
  }
}

function updateSubscriptionInfo() {
  if (!userData) return;

  const hasPaidPlan =
    userData.subscription_tier &&
    userData.subscription_tier !== "none" &&
    userData.subscription_tier !== "free";

  if (!hasPaidPlan) return;

  const planName =
    userData.subscription_tier.charAt(0).toUpperCase() +
    userData.subscription_tier.slice(1);
  document.getElementById("current-plan-name").textContent = planName;

  const status = userData.subscription_status || "inactive";
  const statusElement = document.getElementById("current-plan-status");

  if (userData.subscription_status?.startsWith("changing_to_")) {
    const newTier = userData.subscription_status.replace("changing_to_", "");
    statusElement.innerHTML = `
      <span class="badge bg-info">
        Changing to ${
          newTier.charAt(0).toUpperCase() + newTier.slice(1)
        } next billing cycle
      </span>
    `;
  } else if (status === "active") {
    statusElement.innerHTML =
      '<span class="badge bg-success"><i class="fas fa-check me-1"></i>Active</span>';
  } else if (status === "canceling") {
    statusElement.innerHTML =
      '<span class="badge bg-warning"><i class="fas fa-exclamation-triangle me-1"></i>Canceling at period end</span>';
  } else if (status === "canceled") {
    statusElement.innerHTML =
      '<span class="badge bg-danger"><i class="fas fa-times me-1"></i>Canceled</span>';
  } else {
    statusElement.innerHTML =
      '<span class="badge bg-secondary">Inactive</span>';
  }

  document.getElementById("current-plan-credits").textContent =
    userData.credits_total;

  showUpgradeOptions();
}

function showUpgradeOptions() {
  const currentTier = userData.subscription_tier;
  const upgradeContainer = document.getElementById("upgrade-plans-container");
  const upgradeSection = document.getElementById("upgrade-options");

  const plans = {
    starter: { name: "Starter", credits: 500, price: 14.99, order: 1 },
    pro: { name: "Pro", credits: 1500, price: 29.99, order: 2 },
    studio: { name: "Studio", credits: 4000, price: 59.99, order: 3 },
  };

  const currentOrder = plans[currentTier]?.order || 0;
  const availableUpgrades = Object.entries(plans)
    .filter(([tier, plan]) => plan.order > currentOrder)
    .map(([tier, plan]) => ({ tier, ...plan }));

  if (availableUpgrades.length === 0) {
    upgradeSection.classList.add("d-none");
    return;
  }

  upgradeSection.classList.remove("d-none");

  upgradeContainer.innerHTML = availableUpgrades
    .map(
      (plan) => `
    <div class="col-md-${availableUpgrades.length === 1 ? "6" : "4"}">
      <div class="dashboard-card text-center">
        <div class="mb-3">
          <div class="icon-circle bg-gradient-${
            plan.tier === "pro" ? "purple" : "green"
          } mx-auto mb-3" style="width: 60px; height: 60px;">
            <i class="fas fa-${plan.tier === "pro" ? "bolt" : "gem"} fa-2x"></i>
          </div>
          <h4 class="fw-bold">${plan.name}</h4>
          <h2 class="text-primary mb-2">€${
            plan.price
          }<small class="text-muted">/month</small></h2>
        </div>
        <ul class="list-unstyled text-start mb-4">
          <li class="mb-2">
            <i class="fas fa-check text-success me-2"></i>${
              plan.credits
            } credits/month
          </li>
          <li class="mb-2">
            <i class="fas fa-check text-success me-2"></i>${
              plan.credits
            } samples
          </li>
        </ul>
        <button class="btn btn-gradient-primary w-100" onclick="upgradeToTier('${
          plan.tier
        }')">
          <i class="fas fa-arrow-up me-2"></i>Upgrade to ${plan.name}
        </button>
      </div>
    </div>
  `,
    )
    .join("");
}

async function upgradeToTier(tier) {
  try {
    const data = await API.createCheckout(tier);
    window.location.href = data.checkout_url;
  } catch (error) {
    showNotification(
      "Failed to create checkout session. Please try again.",
      "danger",
    );
    console.error(error);
  }
}

function viewBillingHistory() {
  manageSubscription();
}

function toggleApiKey() {
  const apiKeyEl = document.getElementById("api-key");
  const toggleText = document.getElementById("toggle-text");
  const icon = document.querySelector("#toggle-text").previousElementSibling;

  apiKeyVisible = !apiKeyVisible;

  if (apiKeyVisible) {
    apiKeyEl.textContent = apiKeyEl.dataset.key;
    toggleText.textContent = "Hide";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    apiKeyEl.textContent = "••••••••••••••••";
    toggleText.textContent = "Show";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

function copyApiKey() {
  const apiKey = document.getElementById("api-key").dataset.key;
  navigator.clipboard.writeText(apiKey);

  const btn = event.target.closest("button");
  const originalHTML = btn.innerHTML;

  btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
  btn.classList.add("btn-secondary");
  btn.classList.remove("btn-outline-secondary");

  setTimeout(() => {
    btn.innerHTML = originalHTML;
    btn.classList.remove("btn-secondary");
    btn.classList.add("btn-outline-secondary");
  }, 2000);
}

function copyServerUrl(event) {
  const serverUrl = window.APP_CONFIG.API_URL;
  navigator.clipboard.writeText(serverUrl);

  const btn = event.target.closest("button");
  const originalHTML = btn.innerHTML;

  btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
  btn.classList.add("btn-secondary");
  btn.classList.remove("btn-outline-secondary");

  setTimeout(() => {
    btn.innerHTML = originalHTML;
    btn.classList.remove("btn-secondary");
    btn.classList.add("btn-outline-secondary");
  }, 2000);
}

async function subscribe(tier) {
  try {
    const data = await API.createCheckout(tier);
    window.location.href = data.checkout_url;
  } catch (error) {
    showNotification(
      "Failed to create checkout session. Please try again.",
      "danger",
    );
    console.error(error);
  }
}

async function manageSubscription() {
  try {
    const { portal_url } = await API.getCustomerPortal();
    window.location.href = portal_url;
  } catch (error) {
    showNotification(
      "Error opening subscription management. Please try again.",
      "danger",
    );
    console.error(error);
  }
}

function logout() {
  localStorage.removeItem("token");
  window.location.href = "login.html";
}

function showNotification(message, type = "info") {
  let notificationContainer = document.getElementById("notification-container");
  if (!notificationContainer) {
    notificationContainer = document.createElement("div");
    notificationContainer.id = "notification-container";
    notificationContainer.style.cssText =
      "position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; width: 90%; max-width: 500px;";
    document.body.appendChild(notificationContainer);
  }

  const alertClass = `alert-${type}`;
  const alertId = `alert-${Date.now()}`;

  const alertHTML = `
    <div id="${alertId}" class="alert ${alertClass} alert-dismissible fade show mb-2" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `;

  notificationContainer.insertAdjacentHTML("beforeend", alertHTML);

  setTimeout(() => {
    const alert = document.getElementById(alertId);
    if (alert) {
      alert.classList.remove("show");
      setTimeout(() => alert.remove(), 150);
    }
  }, 5000);
}

function validateDeleteForm() {
  const confirmBtn = document.getElementById("confirmDeleteBtn");
  const emailInput = document.getElementById("confirmEmail");
  const understandCheckbox = document.getElementById("confirmUnderstand");

  const emailMatches = emailInput.value.trim() === currentUserEmail;
  const checkboxChecked = understandCheckbox.checked;

  if (emailMatches && checkboxChecked) {
    confirmBtn.disabled = false;
  } else {
    confirmBtn.disabled = true;
  }
}

function showFeedbackModal(isSuccess, message, isOAuth = false) {
  const modal = new bootstrap.Modal(
    document.getElementById("deleteFeedbackModal"),
  );
  const header = document.getElementById("feedbackModalHeader");
  const body = document.getElementById("feedbackModalBody");
  const btn = document.getElementById("feedbackModalBtn");
  const title = document.getElementById("deleteFeedbackModalLabel");

  if (isSuccess) {
    header.className = "modal-header bg-success text-white";
    title.innerHTML = '<i class="fas fa-check-circle me-2"></i>Account Deleted';
    body.textContent = message;
    if (isOAuth) {
      body.innerHTML =
        message +
        '<br><small class="text-muted mt-2 d-block">Your Google account is unaffected.</small>';
    }
    btn.className = "btn btn-success";
    btn.textContent = "Go to Home";
    btn.onclick = function () {
      localStorage.removeItem("token");
      sessionStorage.clear();
      window.location.href = "index.html";
    };
  } else {
    header.className = "modal-header bg-danger text-white";
    title.innerHTML =
      '<i class="fas fa-exclamation-circle me-2"></i>Deletion Failed';
    body.textContent = message;
    btn.className = "btn btn-danger";
    btn.textContent = "Close";
    btn.onclick = function () {
      modal.hide();
    };
  }

  modal.show();
}

async function deleteAccount() {
  const confirmBtn = document.getElementById("confirmDeleteBtn");
  const originalText = confirmBtn.innerHTML;

  try {
    confirmBtn.disabled = true;
    confirmBtn.innerHTML =
      '<i class="fas fa-spinner fa-spin me-2"></i>Deleting...';

    const data = await API.deleteAccount();

    const confirmModal = bootstrap.Modal.getInstance(
      document.getElementById("deleteAccountModal"),
    );
    confirmModal.hide();

    let successMessage = `Your account (${data.email}) has been permanently deleted.`;

    setTimeout(() => {
      showFeedbackModal(true, successMessage, data.oauth_provider !== null);
    }, 500);
  } catch (error) {
    console.error("Error deleting account:", error);

    confirmBtn.disabled = false;
    confirmBtn.innerHTML = originalText;

    const errorMessage =
      error.detail ||
      "An error occurred while deleting your account. Please try again.";
    showFeedbackModal(false, errorMessage);
  }
}

async function addProvider() {
  const nameEl = document.getElementById("provider-name-input");
  const urlEl = document.getElementById("provider-url");

  if (!nameEl || !urlEl) {
    showNotification("Form elements not found", "danger");
    return;
  }

  const name = nameEl.value.trim();
  const url = urlEl.value.trim();
  const stripe = document.getElementById("provider-stripe").value.trim();
  const userId = document.getElementById("provider-user-id").value;

  if (!name || !url) {
    showNotification("Name and URL are required", "danger");
    return;
  }

  try {
    const data = await API.addProvider(name, url, stripe, userId);
    showNotification(`Provider "${name}" added successfully`, "success");
    document.getElementById("provider-api-key-display").textContent =
      data.provider.api_key;
    document.getElementById("server-auth-key-display").textContent =
      data.provider.activation_token;
    document.getElementById("docker-command-display").textContent =
      data.provider.docker_command;
    document
      .getElementById("provider-api-key-alert")
      .classList.remove("d-none");
    document.getElementById("provider-name-input").value = "";
    document.getElementById("provider-url").value = "";
    document.getElementById("provider-stripe").value = "";
    document.getElementById("provider-user-id").value = "";
    loadProviders();
  } catch (error) {
    showNotification(error.detail || "Failed to add provider", "danger");
  }
}

function copyKey(elementId) {
  const text = document.getElementById(elementId).textContent;
  navigator.clipboard
    .writeText(text)
    .then(() => {
      showNotification("Key copied to clipboard", "success");
    })
    .catch((err) => {
      showNotification("Failed to copy key", "danger");
    });
}

async function loadUsersForProviderSelect() {
  try {
    const data = await API.getAdminUsers();
    const select = document.getElementById("provider-user-id");
    const currentVal = select.value;
    select.innerHTML = '<option value="">— No user linked —</option>';
    data.users.forEach((user) => {
      const opt = document.createElement("option");
      opt.value = user.id;
      opt.textContent = `${user.email} (#${user.id})`;
      select.appendChild(opt);
    });
    select.value = currentVal;
  } catch (e) {
    console.error("Failed to load users for provider select", e);
  }
}

async function loadProviders() {
  try {
    const data = await API.listProviders();
    const providers = data.providers;
    document.getElementById("providers-count").textContent = providers.length;

    const tbody = document.getElementById("providers-tbody");
    if (providers.length === 0) {
      tbody.innerHTML =
        '<tr><td colspan="9" class="text-center text-muted py-4">No providers yet</td></tr>';
      return;
    }

    tbody.innerHTML = providers
      .map(
        (p) => `
      <tr>
        <td><strong>${p.name}</strong></td>
        <td>
          ${
            p.is_online
              ? '<span class="badge rounded-pill bg-success"><i class="fas fa-circle me-1" style="font-size: 8px;"></i>Online</span>'
              : '<span class="badge rounded-pill bg-light text-muted border">Offline</span>'
          }
        </td>
        <td>
          ${
            p.user_email
              ? `<small class="text-muted">${p.user_email}</small>`
              : '<small class="text-muted">—</small>'
          }
        </td>
        <td><small class="text-muted">${p.url}</small></td>
        <td>
          ${
            p.is_banned
              ? '<span class="badge bg-danger">Banned</span>'
              : p.is_active
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Inactive</span>'
          }
        </td>
        <td>${p.jobs_done_this_month ?? 0}<small class="text-muted ms-1">/ ${p.jobs_done ?? 0}</small></td>
        <td>${p.uptime?.month_progress_pct != null ? p.uptime.month_progress_pct + "%" : "-"}</td>
        <td><small>${p.last_seen ? new Date(p.last_seen).toLocaleString() : "Never"}</small></td>
        <td>
          ${
            p.stripe_account_id && p.stripe_account_id.trim() !== ""
              ? `<span class="badge bg-success me-2"><i class="fas fa-check me-1"></i>Stripe OK</span>`
              : `<button class="btn btn-sm btn-warning me-2" onclick="sendOnboardingLink(${p.id}, '${p.name}')">
                  <i class="fas fa-link me-1"></i>Stripe
                </button>`
          }
          <button class="btn btn-sm btn-outline-danger" onclick="deleteProvider(${p.id}, '${p.name}')">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    `,
      )
      .join("");
  } catch (error) {
    showNotification("Failed to load providers", "danger");
  }
}

async function sendOnboardingLink(id, name) {
  const btn = event.target.closest("button");
  const originalHTML = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading...';

  try {
    const data = await API.getProviderOnboardingLink(id);

    btn.disabled = false;
    btn.innerHTML = originalHTML;

    const modal = `
      <div class="modal fade" id="onboardingModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                <i class="fas fa-link me-2"></i>Stripe Onboarding — ${name}
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p class="text-muted mb-3">
                Send this link to <strong>${name}</strong> so they can connect their bank account on Stripe.
                The link expires after one use.
              </p>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="onboarding-url-input" value="${data.onboarding_url}" readonly />
                <button class="btn btn-outline-secondary" onclick="copyOnboardingLink()">
                  <i class="fas fa-copy"></i>
                </button>
              </div>
              <a href="${data.onboarding_url}" target="_blank" class="btn btn-warning w-100">
                <i class="fas fa-external-link-alt me-2"></i>Open link
              </a>
            </div>
          </div>
        </div>
      </div>`;

    const existing = document.getElementById("onboardingModal");
    if (existing) existing.remove();

    document.body.insertAdjacentHTML("beforeend", modal);
    new bootstrap.Modal(document.getElementById("onboardingModal")).show();
  } catch (error) {
    btn.disabled = false;
    btn.innerHTML = originalHTML;
    showNotification(
      error.detail || "Failed to generate onboarding link",
      "danger",
    );
  }
}

function copyOnboardingLink() {
  const input = document.getElementById("onboarding-url-input");
  navigator.clipboard.writeText(input.value);
  showNotification("Onboarding link copied!", "success");
}

async function deleteProvider(id, name) {
  if (!confirm(`Delete provider "${name}"?`)) return;
  try {
    await API.deleteProvider(id);
    showNotification(`Provider "${name}" deleted`, "success");
    loadProviders();
  } catch (error) {
    showNotification(error.detail || "Failed to delete provider", "danger");
  }
}

document
  .getElementById("confirmEmail")
  ?.addEventListener("input", validateDeleteForm);
document
  .getElementById("confirmUnderstand")
  ?.addEventListener("change", validateDeleteForm);

document
  .getElementById("confirmDeleteBtn")
  ?.addEventListener("click", deleteAccount);

document
  .getElementById("deleteAccountModal")
  ?.addEventListener("hidden.bs.modal", function () {
    document.getElementById("confirmEmail").value = "";
    document.getElementById("confirmUnderstand").checked = false;
    document.getElementById("confirmDeleteBtn").disabled = true;
  });

async function updateEmailPreferences() {
  const checkbox = document.getElementById("newsUpdatesToggle");
  try {
    await API.updatePreferences(checkbox.checked);
    showNotification("Preferences updated successfully", "success");
  } catch (error) {
    checkbox.checked = !checkbox.checked;
    showNotification("Failed to update preferences", "danger");
  }
}

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.querySelector(".sidebar-overlay");
  sidebar.classList.toggle("active");
  overlay.classList.toggle("active");
}

async function loadProviderStats() {
  try {
    const data = await API.getProviderStats();
    renderProviderStats(data);
    loadFinancesHistory(data.revenue.finances_url);
  } catch (error) {
    if (error.status === 404) {
      document.getElementById("section-provider-stats").innerHTML = `
        <div class="content-header">
          <h1><i class="fas fa-server me-3"></i>My Provider Dashboard</h1>
        </div>
        <div class="content-body">
          <div class="alert alert-warning">
            No provider account is linked to your user yet. Contact the admin to get set up.
          </div>
        </div>`;
    } else {
      showNotification("Failed to load provider stats", "danger");
    }
  }
}

function renderProviderStats(data) {
  const { provider, uptime, network, users, revenue, period } = data;
  const onlineIndicator = document.getElementById("provider-online-indicator");
  if (uptime.is_online) {
    onlineIndicator.innerHTML =
      '<span class="badge rounded-pill bg-success" style="font-size: 0.65rem;"><i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>Online</span>';
  } else {
    onlineIndicator.innerHTML =
      '<span class="badge rounded-pill bg-secondary" style="font-size: 0.65rem; opacity: 0.7;">Offline</span>';
  }
  const { year, month, days_elapsed, days_in_month } = period;
  const monthName = new Date(year, month - 1).toLocaleString("default", {
    month: "long",
  });
  const progressPct = Math.round((days_elapsed / days_in_month) * 100);
  document.getElementById("period-label").textContent =
    `${monthName} ${year} — day ${days_elapsed}/${days_in_month}`;
  document.getElementById("month-progress-bar").style.width = `${progressPct}%`;
  document.getElementById("month-progress-label").textContent =
    `${progressPct}% of month elapsed`;

  document.getElementById("provider-name").textContent = provider.name;

  const hours24 = uptime.last_24h_hours;
  const target24 = uptime.last_24h_target;
  const uptimeText = `${hours24}h / ${target24}h today`;
  document.getElementById("provider-uptime").textContent = uptimeText;

  const uptimeEl = document.getElementById("provider-uptime");
  if (hours24 >= target24) {
    uptimeEl.className = "fw-bold text-success";
  } else {
    uptimeEl.className = "fw-bold text-danger";
  }

  document.getElementById("provider-last-seen").textContent = provider.last_seen
    ? new Date(provider.last_seen).toLocaleString()
    : "Never";

  const badge = document.getElementById("provider-status-badge");
  if (provider.is_active) {
    badge.className = "badge bg-success";
    badge.textContent = "Active";
  } else {
    badge.className = "badge bg-secondary";
    badge.textContent = "Inactive";
  }

  const monthProgress = Math.min(100, uptime.month_progress_pct);
  document.getElementById("uptime-month-bar").style.width = `${monthProgress}%`;
  document.getElementById("uptime-month-bar").textContent =
    `${uptime.month_progress_pct}%`;

  const hoursRemaining = uptime.month_hours_remaining;
  const label =
    hoursRemaining > 0
      ? `${uptime.month_hours}h done — ${hoursRemaining}h remaining / ${uptime.month_required_hours}h goal`
      : `✓ ${uptime.month_hours}h — goal reached (${uptime.month_required_hours}h)`;
  document.getElementById("uptime-month-label").textContent = label;

  const monthBar = document.getElementById("uptime-month-bar");
  if (uptime.month_progress_pct >= 100) {
    monthBar.className = "progress-bar bg-success";
  } else if (uptime.month_progress_pct >= 80) {
    monthBar.className = "progress-bar bg-warning text-dark";
  } else {
    monthBar.className = "progress-bar bg-danger";
  }

  document.getElementById("stat-my-jobs-month").textContent = (
    provider.jobs_done_this_month ?? 0
  ).toLocaleString();
  document.getElementById("stat-my-jobs-total").textContent =
    `${provider.jobs_done.toLocaleString()} total`;
  document.getElementById("stat-global-generations").textContent =
    network.global_generations_this_month.toLocaleString();
  document.getElementById("stat-active-providers").textContent =
    network.active_providers;
  document.getElementById("stat-paying-users").textContent =
    users.paying_total.toLocaleString();

  document.getElementById("rev-platform").textContent =
    `€${revenue.platform_monthly_eur.toFixed(2)}`;
  document.getElementById("rev-pool").textContent =
    `€${revenue.providers_pool_eur.toFixed(2)}`;
  document.getElementById("rev-my-share").textContent =
    `€${revenue.my_estimated_share_eur.toFixed(2)}`;

  const tierColors = {
    free: "secondary",
    starter: "info",
    pro: "primary",
    studio: "success",
  };
  const tierLabels = {
    free: "Free",
    starter: "Starter",
    pro: "Pro",
    studio: "Studio",
  };

  const totalUsers = Object.values(users.by_tier).reduce((a, b) => a + b, 0);
  const tbody = document.getElementById("users-by-tier");
  tbody.innerHTML = Object.entries(users.by_tier)
    .map(([tier, count]) => {
      const pct = totalUsers > 0 ? ((count / totalUsers) * 100).toFixed(0) : 0;
      const color = tierColors[tier] || "secondary";
      const label = tierLabels[tier] || tier;
      return `
      <div class="d-flex align-items-center gap-2 mb-1">
        <span class="badge bg-${color}" style="width:70px;text-align:center;">${label}</span>
        <div class="flex-grow-1">
          <div class="progress" style="height:8px;">
            <div class="progress-bar bg-${color}" style="width:${pct}%"></div>
          </div>
        </div>
        <span class="fw-bold" style="width:32px;text-align:right;">${count}</span>
        <span class="text-muted small" style="width:36px;">${pct}%</span>
      </div>`;
    })
    .join("");
}

async function loadFinancesHistory(financesUrl) {
  const tbody = document.getElementById("finances-history-tbody");

  if (!financesUrl) {
    tbody.innerHTML =
      '<tr><td colspan="5" class="text-center text-muted py-3">No data available</td></tr>';
    return;
  }

  try {
    const res = await fetch(financesUrl);
    const data = await res.json();

    const history = data.history || [];
    if (history.length === 0) {
      tbody.innerHTML =
        '<tr><td colspan="5" class="text-center text-muted py-3">No history yet</td></tr>';
      return;
    }

    tbody.innerHTML = history
      .map((row) => {
        const pool = (row.platform_revenue_eur * 0.85).toFixed(2);
        const perProv =
          row.active_providers > 0
            ? (
                (row.platform_revenue_eur * 0.85) /
                row.active_providers
              ).toFixed(2)
            : "—";
        return `
        <tr>
          <td><strong>${row.period}</strong></td>
          <td>€${row.platform_revenue_eur.toFixed(2)}</td>
          <td>€${pool}</td>
          <td>${row.active_providers ?? "—"}</td>
          <td class="text-primary fw-bold">€${perProv}</td>
        </tr>`;
      })
      .join("");
  } catch {
    tbody.innerHTML =
      '<tr><td colspan="5" class="text-center text-muted py-3">Could not load history</td></tr>';
  }
}

document.querySelectorAll(".nav-link[data-section]").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();

    document
      .querySelectorAll(".nav-link[data-section]")
      .forEach((l) => l.classList.remove("active"));
    this.classList.add("active");

    const sectionId = this.dataset.section;
    document.querySelectorAll(".section-content").forEach((section) => {
      section.classList.remove("active");
    });
    document.getElementById(`section-${sectionId}`).classList.add("active");

    saveActiveSection(sectionId);

    if (sectionId === "admin" && userData && userData.is_admin) {
      setTimeout(loadAdminData, 100);
    }

    if (sectionId === "email-broadcast" && userData && userData.is_admin) {
      setTimeout(() => {
        initBroadcastSection();
      }, 100);
    }

    if (sectionId === "email-logs" && userData && userData.is_admin) {
      setTimeout(() => {
        initEmailLogsSection();
      }, 100);
    }

    if (sectionId === "analytics" && userData && userData.is_admin) {
      setTimeout(() => {
        initAnalyticsSection();
      }, 100);
    }

    if (sectionId === "providers" && userData && userData.is_admin) {
      setTimeout(() => {
        loadProviders();
        loadUsersForProviderSelect();
      }, 100);
    }

    if (sectionId === "provider-stats" && userData.is_provider) {
      setTimeout(loadProviderStats, 100);
    }

    if (window.innerWidth <= 992) {
      toggleSidebar();
    }

    window.scrollTo(0, 0);
  });
});

async function loadAdminData() {
  try {
    if (!userData || !userData.is_admin) return;

    const [stats, usersData] = await Promise.all([
      API.getAdminStats(),
      API.getAdminUsers(),
    ]);

    document.getElementById("stat-total-users").textContent = stats.total_users;
    document.getElementById("stat-verified").textContent = stats.verified_users;
    document.getElementById("stat-paid").textContent = stats.paid_users;
    document.getElementById("stat-generations").textContent =
      stats.total_generations;

    allUsers = usersData.users;
    displayUsers(allUsers);
    document.getElementById("user-count").textContent = allUsers.length;
  } catch (error) {
    console.error("Error loading admin data:", error);
    showNotification("Error loading admin data", "danger");
  }
}

function displayUsers(users) {
  const tbody = document.getElementById("usersTableBody");

  if (!tbody) return;

  if (users.length === 0) {
    tbody.innerHTML =
      '<tr><td colspan="9" class="text-center">No users found</td></tr>';
    return;
  }

  tbody.innerHTML = users
    .map(
      (user) => `
    <tr>
      <td>${user.id}</td>
      <td>
        ${user.email}
        ${
          user.oauth_provider
            ? `<i class="fab fa-${user.oauth_provider} text-muted ms-1"></i>`
            : ""
        }
        ${
          user.email_verified
            ? '<i class="fas fa-check-circle text-success ms-1"></i>'
            : ""
        }
        ${
          user.two_factor_enabled
            ? '<i class="fas fa-shield-alt text-primary ms-1"></i>'
            : ""
        }
        ${
          user.is_admin
            ? '<i class="fas fa-crown text-warning ms-1" title="Admin"></i>'
            : ""
        }
      </td>
      <td>
        <span class="badge badge-tier bg-${getTierColor(
          user.subscription_tier,
        )}">
          ${user.subscription_tier || "free"}
        </span>
      </td>
      <td>
        <span class="badge bg-${getStatusColor(user.subscription_status)}">
          ${user.subscription_status || "inactive"}
        </span>
      </td>
      <td>
        ${user.credits_remaining} / ${user.credits_total}
        <small class="text-muted">(${user.credits_used} used)</small>
      </td>
      <td>${user.total_generations}</td>
      <td>
        <span class="badge bg-${getNewsColor(user.accept_news_updates)}">
          ${user.accept_news_updates ? "Yes" : "No"}
        </span>
      </td>
      <td>
        <small>${formatDate(user.created_at)}</small>
      </td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="viewUserDetail(${
          user.id
        })">
          <i class="fas fa-eye"></i>
        </button>
      </td>
    </tr>
  `,
    )
    .join("");
}

function getTierColor(tier) {
  const colors = {
    free: "secondary",
    starter: "info",
    pro: "primary",
    studio: "success",
  };
  return colors[tier] || "secondary";
}

function getStatusColor(status) {
  if (status === "active") return "success";
  if (status === "canceling") return "warning";
  if (status === "canceled") return "danger";
  return "secondary";
}

function getNewsColor(acceptsNews) {
  return acceptsNews ? "success" : "secondary";
}

function formatDate(dateString) {
  if (!dateString) return "-";
  const date = new Date(dateString);
  return date.toLocaleDateString("en-US", {
    year: "numeric",
    month: "short",
    day: "numeric",
  });
}

async function viewUserDetail(userId) {
  const modal = new bootstrap.Modal(document.getElementById("userDetailModal"));
  modal.show();

  try {
    const data = await API.getAdminUser(userId);
    const user = data.user;

    document.getElementById("userDetailBody").innerHTML = `
      <div class="row">
        <div class="col-md-6">
          <h6 class="text-muted">Account Information</h6>
          <table class="table table-sm">
            <tr><td><strong>Email:</strong></td><td>${user.email}</td></tr>
            <tr><td><strong>ID:</strong></td><td>${user.id}</td></tr>
            <tr><td><strong>Created:</strong></td><td>${formatDate(
              user.created_at,
            )}</td></tr>
            <tr><td><strong>Last Login:</strong></td><td>${
              formatDate(user.last_login) || "Never"
            }</td></tr>
            <tr><td><strong>OAuth:</strong></td><td>${
              user.oauth_provider || "None"
            }</td></tr>
          </table>
        </div>
        <div class="col-md-6">
          <h6 class="text-muted">Subscription</h6>
          <table class="table table-sm">
            <tr><td><strong>Tier:</strong></td><td>${
              user.subscription_tier
            }</td></tr>
            <tr><td><strong>Status:</strong></td><td>${
              user.subscription_status
            }</td></tr>
            <tr><td><strong>Stripe ID:</strong></td><td><small>${
              user.stripe_customer_id || "-"
            }</small></td></tr>
          </table>
        </div>
      </div>
      
      <div class="row mt-3">
        <div class="col-12">
          <h6 class="text-muted">Credits & Usage</h6>
          <div class="alert alert-info">
            <strong>Credits:</strong> ${user.credits_remaining} / ${
              user.credits_total
            } 
            (${user.credits_used} used)
            <br>
            <strong>Total Generations:</strong> ${data.total_generations}
          </div>
        </div>
      </div>
      
      ${
        data.recent_generations && data.recent_generations.length > 0
          ? `
        <div class="row mt-3">
          <div class="col-12">
            <h6 class="text-muted">Recent Generations</h6>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Prompt</th>
                    <th>BPM</th>
                    <th>Credits</th>
                  </tr>
                </thead>
                <tbody>
                  ${data.recent_generations
                    .map(
                      (gen) => `
                    <tr>
                      <td><small>${formatDate(gen.created_at)}</small></td>
                      <td><small>${gen.prompt.substring(0, 50)}...</small></td>
                      <td>${gen.bpm}</td>
                      <td>${gen.credits_cost}</td>
                    </tr>
                  `,
                    )
                    .join("")}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      `
          : ""
      }
    `;
  } catch (error) {
    console.error("Error loading user details:", error);
    document.getElementById("userDetailBody").innerHTML = `
      <div class="alert alert-danger">Error loading user details</div>
    `;
  }
}

function saveActiveSection(sectionId) {
  const url = new URL(window.location);
  url.searchParams.set("section", sectionId);
  window.history.pushState({}, "", url);
}

function restoreActiveSection() {
  const params = new URLSearchParams(window.location.search);
  const sectionId = params.get("section");

  if (sectionId) {
    document.querySelectorAll(".section-content").forEach((section) => {
      section.classList.remove("active");
    });
    document.querySelectorAll(".nav-link").forEach((link) => {
      link.classList.remove("active");
    });

    const section = document.getElementById(`section-${sectionId}`);
    const navLink = document.querySelector(
      `.nav-link[data-section="${sectionId}"]`,
    );

    if (section && navLink) {
      section.classList.add("active");
      navLink.classList.add("active");

      if (sectionId === "admin" && userData && userData.is_admin) {
        setTimeout(loadAdminData, 100);
      }

      if (sectionId === "email-logs" && userData && userData.is_admin) {
        setTimeout(() => {
          initEmailLogsSection();
        }, 100);
      }

      if (sectionId === "email-broadcast" && userData && userData.is_admin) {
        setTimeout(() => {
          initBroadcastSection();
        }, 100);
      }
      if (sectionId === "analytics" && userData && userData.is_admin) {
        setTimeout(() => {
          initAnalyticsSection();
        }, 100);
      }
      if (sectionId === "providers" && userData && userData.is_admin) {
        setTimeout(loadProviders, 100);
      }
      if (sectionId === "provider-stats" && userData.is_provider) {
        setTimeout(loadProviderStats, 100);
      }
    }
  }
}

document.addEventListener("DOMContentLoaded", async () => {
  const params = new URLSearchParams(window.location.search);
  const token = params.get("token");

  if (token) {
    localStorage.setItem("token", token);
    window.history.replaceState({}, document.title, "/dashboard.html");
  }

  await loadDashboard();

  if (userData) {
    const userName = document.getElementById("user-name");
    const userEmail = document.getElementById("user-email");
    const userAvatar = document.getElementById("user-avatar-initial");

    userName.textContent = userData.email.split("@")[0];
    userEmail.textContent = userData.email;
    userAvatar.textContent = userData.email.charAt(0).toUpperCase();

    if (userData.is_admin) {
      document.getElementById("admin-nav-section").style.display = "block";

      const adminLink = document.querySelector(
        '.nav-link[data-section="admin"]',
      );
      if (adminLink) {
        adminLink.addEventListener("click", async () => {
          setTimeout(loadAdminData, 100);
        });
      }
    }

    if (userData.is_provider) {
      document.getElementById("provider-nav-section").style.display = "block";
    }

    restoreActiveSection();

    document.getElementById("searchInput")?.addEventListener("input", (e) => {
      const searchTerm = e.target.value.toLowerCase();
      const filtered = allUsers.filter((user) =>
        user.email.toLowerCase().includes(searchTerm),
      );
      displayUsers(filtered);
    });

    document.getElementById("credits-total-usage").textContent =
      userData.credits_total;
    document.getElementById("credits-used-usage").textContent =
      userData.credits_total - userData.credits_remaining;
    document.getElementById("credits-remaining-usage").textContent =
      userData.credits_remaining;

    const percentageUsage =
      userData.credits_total > 0
        ? (userData.credits_remaining / userData.credits_total) * 100
        : 0;
    document.getElementById("credits-progress-usage").style.width =
      `${percentageUsage}%`;
  }

  function renderSection(sectionId) {
    document
      .querySelectorAll(".section-content")
      .forEach((s) => s.classList.remove("active"));

    const target = document.getElementById("section-" + sectionId);
    if (target) target.classList.add("active");

    document.querySelectorAll(".nav-link").forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("data-section") === sectionId)
        link.classList.add("active");
    });
  }

  window.showSection = function (sectionId) {
    const newUrl =
      window.location.protocol +
      "//" +
      window.location.host +
      window.location.pathname +
      "?section=" +
      sectionId;
    window.history.pushState({ sectionId: sectionId }, "", newUrl);

    renderSection(sectionId);
  };

  window.addEventListener("popstate", function () {
    const urlParams = new URLSearchParams(window.location.search);
    renderSection(urlParams.get("section") || "overview");
  });
});
