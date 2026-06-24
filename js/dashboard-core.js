let userData = null;
let currentUserEmail = "";
let isOAuthUser = false;

window.toggleSidebar = function () {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("sidebar-overlay");
  const isOpen = !sidebar.classList.contains("-translate-x-full");
  if (isOpen) {
    sidebar.classList.add("-translate-x-full");
    overlay.classList.add("hidden");
  } else {
    sidebar.classList.remove("-translate-x-full");
    overlay.classList.remove("hidden");
  }
};

async function releaseMachine(key, machine, btn) {
  if (
    !confirm(
      "Release this machine? You'll be able to activate a new one in its place.",
    )
  ) {
    return;
  }

  const original = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
  btn.disabled = true;

  try {
    await API.releaseLicenseMachine(key, machine);
    const user = await API.getMe();
    renderLocalLicenses(user);
  } catch (e) {
    btn.innerHTML = original;
    btn.disabled = false;
    alert(e.detail || "Could not release the machine. Please try again.");
  }
}

function renderLocalLicenses(user) {
  const block = document.getElementById("local-license-block");
  const list = document.getElementById("local-license-list");
  if (!block || !list) return;

  const licenses = user.vst_licenses || [];
  if (licenses.length === 0) {
    block.classList.add("hidden");
    return;
  }

  block.classList.remove("hidden");
  list.innerHTML = "";

  licenses.forEach((lic) => {
    const used = lic.machines_used || 0;
    const max = lic.max_activations || 3;

    const machinesHtml = (lic.machines || [])
      .map((m) => {
        const shortId = m.machine_id ? m.machine_id.slice(0, 12) + "…" : "—";
        const last = m.last_seen_at
          ? new Date(m.last_seen_at).toLocaleDateString()
          : "—";
        return `
          <div class="flex items-center justify-between bg-black/20 rounded-lg px-3 py-2 text-xs">
            <span class="text-gray-400 font-mono">${shortId}</span>
            <div class="flex items-center gap-3">
              <span class="text-gray-600">last seen ${last}</span>
              <button data-key="${lic.license_key}" data-machine="${m.machine_id}" class="release-machine-btn text-danger hover:text-white transition-colors" title="Release this machine">
                <i class="fas fa-times-circle"></i>
              </button>
            </div>
          </div>`;
      })
      .join("");

    const card = document.createElement("div");
    card.className =
      "border-b border-white/[0.04] pb-5 last:border-0 last:pb-0";
    card.innerHTML = `
      <p class="text-xs uppercase tracking-wider text-gray-500 mb-2">License key</p>
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 mb-4">
        <code class="flex-1 bg-black/30 border border-white/10 rounded-xl px-4 py-3 text-track5 font-mono text-sm break-all">${lic.license_key}</code>
        <button data-copy="${lic.license_key}" class="copy-license-btn px-4 py-3 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors whitespace-nowrap">
          <i class="fas fa-copy mr-1"></i>Copy
        </button>
      </div>
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs text-gray-500">Activated machines</span>
        <span class="text-xs font-bold ${used >= max ? "text-danger" : "text-success"}">${used} / ${max}</span>
      </div>
      <div class="flex flex-col gap-2">${machinesHtml || '<p class="text-xs text-gray-600">No machines activated yet.</p>'}</div>
    `;
    list.appendChild(card);
  });

  list.querySelectorAll(".copy-license-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      navigator.clipboard.writeText(btn.dataset.copy).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check mr-1"></i>Copied!';
        setTimeout(() => {
          btn.innerHTML = original;
        }, 2000);
      });
    });
  });

  list.querySelectorAll(".release-machine-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const key = btn.dataset.key;
      const machine = btn.dataset.machine;
      releaseMachine(key, machine, btn);
    });
  });
}

function setNavActive(sectionId) {
  document.querySelectorAll(".nav-link[data-section]").forEach((l) => {
    const isActive = l.getAttribute("data-section") === sectionId;
    l.classList.toggle("bg-gradient-to-r", isActive);
    l.classList.toggle("from-primary", isActive);
    l.classList.toggle("to-[#a04840]", isActive);
    l.classList.toggle("text-white", isActive);
    l.classList.toggle("shadow-[0_4px_12px_rgba(184,96,92,0.4)]", isActive);
    l.classList.toggle("text-white/70", !isActive);
  });
}

function renderSection(sectionId) {
  document
    .querySelectorAll(".section-content")
    .forEach((s) => s.classList.remove("active"));
  const target = document.getElementById("section-" + sectionId);
  if (target) target.classList.add("active");
  setNavActive(sectionId);
}

window.showSection = function (sectionId) {
  const newUrl =
    window.location.protocol +
    "//" +
    window.location.host +
    window.location.pathname +
    "?section=" +
    sectionId;
  window.history.pushState({ sectionId }, "", newUrl);
  renderSection(sectionId);
};

window.addEventListener("popstate", function () {
  renderSection(
    new URLSearchParams(window.location.search).get("section") || "overview",
  );
});

function saveActiveSection(sectionId) {
  const url = new URL(window.location);
  url.searchParams.set("section", sectionId);
  window.history.pushState({}, "", url);
}

function restoreActiveSection() {
  const sectionId = new URLSearchParams(window.location.search).get("section");
  if (!sectionId) return;

  renderSection(sectionId);

  if (sectionId === "admin" && userData?.is_admin)
    setTimeout(loadAdminData, 100);
  if (sectionId === "email-logs" && userData?.is_admin)
    setTimeout(initEmailLogsSection, 100);
  if (sectionId === "email-broadcast" && userData?.is_admin)
    setTimeout(initBroadcastSection, 100);
  if (sectionId === "analytics" && userData?.is_admin)
    setTimeout(initAnalyticsSection, 100);
  if (sectionId === "providers" && userData?.is_admin)
    setTimeout(() => {
      loadProviders();
      loadUsersForProviderSelect();
    }, 100);
  if (sectionId === "provider-stats" && userData?.is_provider)
    setTimeout(loadProviderStats, 100);
}

document.querySelectorAll(".nav-link[data-section]").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const sectionId = this.dataset.section;
    renderSection(sectionId);
    saveActiveSection(sectionId);

    if (sectionId === "admin" && userData?.is_admin)
      setTimeout(loadAdminData, 100);
    if (sectionId === "email-broadcast" && userData?.is_admin)
      setTimeout(initBroadcastSection, 100);
    if (sectionId === "email-logs" && userData?.is_admin)
      setTimeout(initEmailLogsSection, 100);
    if (sectionId === "analytics" && userData?.is_admin)
      setTimeout(initAnalyticsSection, 100);
    if (sectionId === "providers" && userData?.is_admin)
      setTimeout(() => {
        loadProviders();
        loadUsersForProviderSelect();
      }, 100);
    if (sectionId === "provider-stats" && userData?.is_provider)
      setTimeout(loadProviderStats, 100);

    if (window.innerWidth <= 1024) toggleSidebar();
    window.scrollTo(0, 0);
  });
});

window.validateDeleteForm = function () {
  const btn = document.getElementById("confirmDeleteBtn");
  const email = document.getElementById("confirmEmail")?.value.trim();
  const check = document.getElementById("confirmUnderstand")?.checked;
  const ok = email === currentUserEmail && check;
  btn.disabled = !ok;
  btn.classList.toggle("opacity-50", !ok);
  btn.classList.toggle("cursor-not-allowed", !ok);
};

document
  .getElementById("confirmEmail")
  ?.addEventListener("input", validateDeleteForm);
document
  .getElementById("confirmUnderstand")
  ?.addEventListener("change", validateDeleteForm);
document
  .getElementById("confirmDeleteBtn")
  ?.addEventListener("click", () => window.deleteAccount());

window.logout = function () {
  localStorage.removeItem("token");
  window.location.href = "login.php";
};

window.updateEmailPreferences = async function () {
  const checkbox = document.getElementById("newsUpdatesToggle");
  try {
    await API.updatePreferences(checkbox.checked);
    showNotification("Preferences updated successfully", "success");
  } catch {
    checkbox.checked = !checkbox.checked;
    showNotification("Failed to update preferences", "danger");
  }
};

document.addEventListener("DOMContentLoaded", async () => {
  const params = new URLSearchParams(window.location.search);
  const token = params.get("token");
  if (token) {
    localStorage.setItem("token", token);
    window.history.replaceState({}, document.title, "/dashboard.php");
  }

  await loadDashboard();

  if (userData) {
    document.getElementById("user-name").textContent =
      userData.email.split("@")[0];
    document.getElementById("user-email").textContent = userData.email;
    document.getElementById("user-avatar-initial").textContent = userData.email
      .charAt(0)
      .toUpperCase();

    if (userData.is_admin) {
      document.getElementById("admin-nav-section").classList.remove("hidden");
    }
    if (userData.is_provider) {
      document
        .getElementById("provider-nav-section")
        .classList.remove("hidden");
    }

    restoreActiveSection();

    document.getElementById("searchInput")?.addEventListener("input", (e) => {
      const term = e.target.value.toLowerCase();
      const filtered = allUsers.filter((u) =>
        u.email.toLowerCase().includes(term),
      );
      displayUsers(filtered);
    });

    document.getElementById("credits-total-usage").textContent =
      userData.credits_total;
    document.getElementById("credits-used-usage").textContent =
      userData.credits_total - userData.credits_remaining;
    document.getElementById("credits-remaining-usage").textContent =
      userData.credits_remaining;
    const pct =
      userData.credits_total > 0
        ? (userData.credits_remaining / userData.credits_total) * 100
        : 0;
    document.getElementById("credits-progress-usage").style.width = `${pct}%`;
    renderLocalLicenses(userData);
    if (userData.vst_licenses && userData.vst_licenses.length > 0) {
      document.getElementById("local-edition-promo")?.classList.add("hidden");
    }
    if (userData.vst_licenses && userData.vst_licenses.length > 0) {
      const link = document.getElementById("overview-license-link");
      link?.classList.remove("hidden");
      link?.classList.add("flex");

      document.getElementById("download-opensource")?.classList.add("hidden");
      const localDl = document.getElementById("download-local");
      localDl?.classList.remove("hidden");

      document.querySelectorAll("[data-local-dl]").forEach((a) => {
        a.href = API.getLicenseDownloadUrl(a.dataset.localDl);
      });
    }
  }
});
