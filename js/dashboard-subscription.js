function statusBadge(status) {
  const map = {
    active: "bg-success/10 border-success/30 text-success",
    canceling: "bg-warning/10 border-warning/30 text-warning",
    canceled: "bg-danger/10 border-danger/30 text-danger",
  };
  const cls = map[status] || "bg-white/10 border-white/20 text-gray-400";
  const text =
    status === "canceling"
      ? "Canceling at period end"
      : status
        ? status.charAt(0).toUpperCase() + status.slice(1)
        : "Inactive";
  return `<span class="inline-block px-3 py-1 rounded-full border text-xs font-bold ${cls}">${text}</span>`;
}

function changingBadge(newTier) {
  const t = newTier.charAt(0).toUpperCase() + newTier.slice(1);
  return `<span class="inline-block px-3 py-1 rounded-full border bg-primary/10 border-primary/30 text-primary text-xs font-bold">Changing to ${t} next billing cycle</span>`;
}

window.loadDashboard = async function () {
  try {
    userData = await API.getMe();
    currentUserEmail = userData.email;
    isOAuthUser = userData.oauth_provider !== null;

    if (!userData.email_verified) {
      document
        .getElementById("email-verification-card")
        ?.classList.remove("hidden");
    }

    document.getElementById("newsUpdatesToggle").checked =
      userData.accept_news_updates;
    document.getElementById("userEmailHint").textContent =
      `Your email: ${currentUserEmail}`;

    if (isOAuthUser) {
      const warn = document.getElementById("oauthWarning");
      if (warn) warn.classList.remove("hidden");
      const icon = document.querySelector("#oauthWarning i");
      if (icon && userData.oauth_provider === "google")
        icon.className = "fab fa-google mr-2 text-primary";
    }

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
    document.getElementById("subscription-tier").textContent = tierText;

    const statusEl = document.getElementById("subscription-status");
    const status = userData.subscription_status || "inactive";
    statusEl.innerHTML = userData.subscription_status?.startsWith(
      "changing_to_",
    )
      ? changingBadge(userData.subscription_status.replace("changing_to_", ""))
      : statusBadge(status);

    document.getElementById("credits-remaining").textContent =
      userData.credits_remaining;
    document.getElementById("credits-total").textContent =
      userData.credits_total;
    document.getElementById("credits-used").textContent =
      userData.credits_total - userData.credits_remaining;
    const pct =
      userData.credits_total > 0
        ? (userData.credits_remaining / userData.credits_total) * 100
        : 0;
    document.getElementById("credits-progress").style.width = `${pct}%`;

    document.getElementById("api-key").dataset.key = userData.api_key;

    const hasPaid =
      userData.subscription_tier &&
      userData.subscription_tier !== "none" &&
      userData.subscription_tier !== "free";
    document
      .getElementById("pricing-section")
      .classList.toggle("hidden", hasPaid);
    document
      .getElementById("current-subscription-info")
      .classList.toggle("hidden", !hasPaid);

    const actionsEl = document.getElementById("subscription-actions");
    if (hasPaid && (status === "active" || status === "canceling")) {
      actionsEl.innerHTML = `<button onclick="manageSubscription()" class="mt-3 w-full px-4 py-2 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-cog mr-1"></i>Manage Subscription</button>`;
    } else {
      actionsEl.innerHTML = `<button onclick="showSection('subscription')" class="mt-3 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(217,104,80,0.3)]"><i class="fas fa-rocket mr-2"></i>Upgrade Now</button>`;
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("success") === "true") {
      showNotification(
        "Subscription activated! Your credits have been added.",
        "success",
      );
      window.history.replaceState({}, "", "/dashboard.php");
    }
    if (urlParams.get("canceled") === "true") {
      showNotification("Payment canceled. You can try again anytime.", "info");
      window.history.replaceState({}, "", "/dashboard.php");
    }

    updateSubscriptionInfo();
  } catch (error) {
    console.error("Dashboard load error:", error);
    localStorage.removeItem("token");
    window.location.href = "login.php";
  }
};

function updateSubscriptionInfo() {
  if (!userData) return;
  const hasPaid =
    userData.subscription_tier &&
    userData.subscription_tier !== "none" &&
    userData.subscription_tier !== "free";
  if (!hasPaid) return;

  const planName =
    userData.subscription_tier.charAt(0).toUpperCase() +
    userData.subscription_tier.slice(1);
  document.getElementById("current-plan-name").textContent = planName;
  document.getElementById("current-plan-credits").textContent =
    userData.credits_total;

  const status = userData.subscription_status || "inactive";
  const statusEl = document.getElementById("current-plan-status");
  statusEl.innerHTML = userData.subscription_status?.startsWith("changing_to_")
    ? changingBadge(userData.subscription_status.replace("changing_to_", ""))
    : statusBadge(status);

  showUpgradeOptions();
}

function showUpgradeOptions() {
  const plans = {
    starter: {
      name: "Starter",
      credits: 300,
      price: 11.99,
      icon: "fas fa-bolt",
      order: 1,
    },
    pro: {
      name: "Pro",
      credits: 500,
      price: 14.99,
      icon: "fas fa-crown",
      order: 2,
    },
    studio: {
      name: "Studio",
      credits: 1000,
      price: 29.99,
      icon: "fas fa-gem",
      order: 3,
    },
  };

  const currentOrder = plans[userData.subscription_tier]?.order || 0;
  const availableUpgrades = Object.entries(plans)
    .filter(([, p]) => p.order > currentOrder)
    .map(([tier, p]) => ({ tier, ...p }));

  const upgradeSection = document.getElementById("upgrade-options");
  const container = document.getElementById("upgrade-plans-container");

  if (!availableUpgrades.length) {
    upgradeSection.classList.add("hidden");
    return;
  }
  upgradeSection.classList.remove("hidden");

  container.innerHTML = availableUpgrades
    .map(
      (plan) => `
        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5 text-center hover:border-primary/40 transition-all">
            <div class="w-12 h-12 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl mx-auto mb-3">
                <i class="${plan.icon}"></i>
            </div>
            <h4 class="font-extrabold text-white text-lg mb-1">${plan.name}</h4>
            <div class="text-3xl font-black text-primary mb-1">€${plan.price}<span class="text-sm text-gray-500 font-normal">/mo</span></div>
            <ul class="text-sm text-gray-400 space-y-1 text-left mb-4 mt-3">
                <li class="flex items-center gap-2"><i class="fas fa-check-circle text-success text-xs"></i>${plan.credits} credits/month</li>
                <li class="flex items-center gap-2"><i class="fas fa-check-circle text-success text-xs"></i>${plan.credits} samples</li>
            </ul>
            <button onclick="upgradeToTier('${plan.tier}')" class="w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(217,104,80,0.3)]">
                <i class="fas fa-arrow-up mr-2"></i>Upgrade to ${plan.name}
            </button>
        </div>
    `,
    )
    .join("");
}

window.upgradeToTier = async function (tier) {
  try {
    const data = await API.createCheckout(tier);
    window.location.href = data.checkout_url;
  } catch (error) {
    showNotification(
      "Failed to create checkout session. Please try again.",
      "danger",
    );
  }
};

window.viewBillingHistory = function () {
  manageSubscription();
};

window.subscribe = async function (tier) {
  try {
    const data = await API.createCheckout(tier);
    window.location.href = data.checkout_url;
  } catch (error) {
    showNotification(
      "Failed to create checkout session. Please try again.",
      "danger",
    );
  }
};

window.manageSubscription = async function () {
  try {
    const { portal_url } = await API.getCustomerPortal();
    window.location.href = portal_url;
  } catch (error) {
    showNotification(
      "Error opening subscription management. Please try again.",
      "danger",
    );
  }
};
