window.showNotification = function (message, type = "info") {
  let container = document.getElementById("notification-container");
  if (!container) {
    container = document.createElement("div");
    container.id = "notification-container";
    container.className =
      "fixed top-5 left-1/2 -translate-x-1/2 z-[9999] w-[90%] max-w-lg space-y-2";
    document.body.appendChild(container);
  }

  const colors = {
    success: "bg-success/10 border-success/30 text-success",
    danger: "bg-danger/10 border-danger/30 text-danger",
    warning: "bg-warning/10 border-warning/30 text-warning",
    info: "bg-primary/10 border-primary/30 text-primary",
  };
  const icons = {
    success: "fa-check-circle",
    danger: "fa-exclamation-circle",
    warning: "fa-exclamation-triangle",
    info: "fa-info-circle",
  };

  const id = `notif-${Date.now()}`;
  const cls = colors[type] || colors.info;
  const icon = icons[type] || icons.info;

  const el = document.createElement("div");
  el.id = id;
  el.className = `flex items-center gap-3 px-4 py-3 rounded-xl border ${cls} text-sm font-medium backdrop-blur-md transition-all duration-300`;
  el.innerHTML = `<i class="fas ${icon} shrink-0"></i><span class="flex-1">${message}</span><button onclick="document.getElementById('${id}').remove()" class="shrink-0 opacity-60 hover:opacity-100 transition-opacity"><i class="fas fa-times text-xs"></i></button>`;
  container.appendChild(el);

  setTimeout(() => {
    if (el.parentNode) {
      el.style.opacity = "0";
      el.style.transform = "translateY(-8px)";
      setTimeout(() => el.remove(), 300);
    }
  }, 5000);
};

window.openModal = function (id) {
  document.getElementById(id)?.classList.remove("hidden");
};
window.closeModal = function (id) {
  document.getElementById(id)?.classList.add("hidden");
};

window.showFeedbackModal = function (isSuccess, message, isOAuth = false) {
  const modal = document.getElementById("deleteFeedbackModal");
  const header = document.getElementById("feedbackModalHeader");
  const body = document.getElementById("feedbackModalBody");
  const btn = document.getElementById("feedbackModalBtn");
  const title = document.getElementById("deleteFeedbackModalLabel");

  if (isSuccess) {
    header.className =
      "px-6 py-4 border-b border-success/30 bg-success/10 flex items-center justify-between";
    title.innerHTML =
      '<i class="fas fa-check-circle mr-2 text-success"></i><span class="text-success font-bold">Account Deleted</span>';
    body.textContent = message;
    if (isOAuth)
      body.innerHTML +=
        '<br><small class="text-gray-500 mt-2 block">Your Google account is unaffected.</small>';
    btn.className =
      "px-5 py-2.5 rounded-xl bg-success/20 border border-success/30 text-success font-bold text-sm hover:bg-success/30 transition-colors";
    btn.textContent = "Go to Home";
    btn.onclick = function () {
      localStorage.removeItem("token");
      sessionStorage.clear();
      window.location.href = "index.php";
    };
  } else {
    header.className =
      "px-6 py-4 border-b border-danger/30 bg-danger/10 flex items-center justify-between";
    title.innerHTML =
      '<i class="fas fa-exclamation-circle mr-2 text-danger"></i><span class="text-danger font-bold">Deletion Failed</span>';
    body.textContent = message;
    btn.className =
      "px-5 py-2.5 rounded-xl bg-danger/20 border border-danger/30 text-danger font-bold text-sm hover:bg-danger/30 transition-colors";
    btn.textContent = "Close";
    btn.onclick = function () {
      closeModal("deleteFeedbackModal");
    };
  }

  openModal("deleteFeedbackModal");
};

window.deleteAccount = async function () {
  const confirmBtn = document.getElementById("confirmDeleteBtn");
  const originalHTML = confirmBtn.innerHTML;
  try {
    confirmBtn.disabled = true;
    confirmBtn.innerHTML =
      '<i class="fas fa-spinner fa-spin mr-2"></i>Deleting...';
    const data = await API.deleteAccount();
    closeModal("deleteAccountModal");
    document.getElementById("confirmEmail").value = "";
    document.getElementById("confirmUnderstand").checked = false;
    setTimeout(
      () =>
        showFeedbackModal(
          true,
          `Your account (${data.email}) has been permanently deleted.`,
          data.oauth_provider !== null,
        ),
      500,
    );
  } catch (error) {
    console.error("Error deleting account:", error);
    confirmBtn.disabled = false;
    confirmBtn.innerHTML = originalHTML;
    showFeedbackModal(
      false,
      error.detail ||
        "An error occurred while deleting your account. Please try again.",
    );
  }
};
