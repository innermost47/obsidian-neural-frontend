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
  }
});
