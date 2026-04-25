let currentUser = null;
let backupCodes = [];

function open2FAModal() {
  document.getElementById("2fa-modal")?.classList.remove("hidden");
}
function close2FAModal() {
  document.getElementById("2fa-modal")?.classList.add("hidden");
}

function show2FAPanel(panelId) {
  ["setup-2fa-content", "backup-codes-content", "disable-2fa-content"].forEach(
    (id) => {
      document.getElementById(id)?.classList.add("hidden");
    },
  );
  document.getElementById(panelId)?.classList.remove("hidden");
}

document.addEventListener("DOMContentLoaded", () => {
  loadUserSecurityStatus();
});

async function loadUserSecurityStatus() {
  const twoFABadge = document.getElementById("2fa-status-badge");
  const twoFABtnText = document.getElementById("2fa-btn-text");
  const emailBadge = document.getElementById("email-status-badge");

  try {
    const user = await API.getCurrentUser();
    currentUser = user;

    // 2FA badge
    if (twoFABadge && twoFABtnText) {
      if (user.two_factor_enabled) {
        twoFABadge.className =
          "inline-block px-3 py-1 rounded-full text-xs font-bold bg-success/10 border border-success/30 text-success";
        twoFABadge.innerHTML = '<i class="fas fa-check mr-1"></i>Enabled';
        twoFABtnText.textContent = "Disable";
      } else {
        twoFABadge.className =
          "inline-block px-3 py-1 rounded-full text-xs font-bold bg-white/10 border border-white/20 text-gray-400";
        twoFABadge.innerHTML = '<i class="fas fa-times mr-1"></i>Disabled';
        twoFABtnText.textContent = "Setup";
      }
    }

    if (emailBadge) {
      if (user.email_verified) {
        emailBadge.className =
          "inline-block px-3 py-1 rounded-full text-xs font-bold bg-success/10 border border-success/30 text-success";
        emailBadge.innerHTML = '<i class="fas fa-check mr-1"></i>Verified';
      } else {
        emailBadge.className =
          "inline-block px-3 py-1 rounded-full text-xs font-bold bg-warning/10 border border-warning/30 text-warning";
        emailBadge.innerHTML =
          '<i class="fas fa-exclamation mr-1"></i>Not Verified';
      }
    }

    if (user.oauth_provider === "google") {
      document
        .getElementById("2fa-toggle-btn")
        ?.closest(".bg-white\\/\\[0\\.03\\]")
        ?.classList.add("hidden");
    }

    if (!user.email_verified) {
      document.querySelectorAll('[onclick^="subscribe"]').forEach((btn) => {
        btn.disabled = true;
        btn.title = "Verify your email first";
        btn.setAttribute(
          "onclick",
          'showNotification("Please verify your email address before subscribing.", "warning"); return false;',
        );
      });
    }
  } catch (error) {
    console.error("Failed to load security status:", error);
    const errCls =
      "inline-block px-3 py-1 rounded-full text-xs font-bold bg-danger/10 border border-danger/30 text-danger";
    if (twoFABadge) {
      twoFABadge.className = errCls;
      twoFABadge.textContent = "Error";
    }
    if (emailBadge) {
      emailBadge.className = errCls;
      emailBadge.textContent = "Error";
    }
  }
}

window.resendVerificationEmail = async function () {
  if (!currentUser?.email) {
    showNotification(
      "Unable to resend email. Please refresh the page.",
      "warning",
    );
    return;
  }
  try {
    await API.resendVerification(currentUser.email);
    showNotification(
      "Verification email sent! Please check your inbox.",
      "success",
    );
  } catch (error) {
    showNotification(
      error.detail || "Failed to send verification email. Please try again.",
      "danger",
    );
  }
};

window.toggle2FA = async function () {
  if (!currentUser) await loadUserSecurityStatus();
  if (!currentUser) {
    showNotification(
      "Failed to load user data. Please refresh the page.",
      "danger",
    );
    return;
  }

  if (currentUser.two_factor_enabled) {
    showDisable2FAModal();
  } else {
    await setup2FA();
  }
};

async function setup2FA() {
  try {
    const response = await API.setup2FA();
    document.getElementById("modal-title").textContent =
      "Setup Two-Factor Authentication";
    document.getElementById("qr-code-img").src = response.qr_code;
    document.getElementById("manual-code").textContent = response.secret;
    show2FAPanel("setup-2fa-content");
    open2FAModal();
  } catch (error) {
    showNotification(error.detail || "Failed to setup 2FA", "danger");
  }
}

window.verifySetup2FA = async function () {
  const code = document.getElementById("verify-code").value;
  if (!code || code.length !== 6) {
    showNotification("Please enter a valid 6-digit code", "warning");
    return;
  }

  try {
    const response = await API.verifySetup2FA(code);
    backupCodes = response.backup_codes;
    document.getElementById("backup-codes-list").textContent =
      backupCodes.join("\n");
    show2FAPanel("backup-codes-content");
    await loadUserSecurityStatus();
  } catch (error) {
    showNotification(
      error.detail || "Invalid code. Please try again.",
      "danger",
    );
  }
};

window.downloadBackupCodes = function () {
  const content = `Obsidian Neural - 2FA Backup Codes\n\nGenerated: ${new Date().toLocaleString()}\n\n${backupCodes.join("\n")}\n\nKeep these codes in a safe place. Each code can only be used once.`;
  const blob = new Blob([content], { type: "text/plain" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = "obsidian-neural-backup-codes.txt";
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
  close2FAModal();
};

function showDisable2FAModal() {
  document.getElementById("modal-title").textContent =
    "Disable Two-Factor Authentication";
  document.getElementById("disable-code").value = "";
  show2FAPanel("disable-2fa-content");
  open2FAModal();
}

window.confirmDisable2FA = async function () {
  const code = document.getElementById("disable-code").value;
  if (!code || code.length !== 6) {
    showNotification("Please enter a valid 6-digit code", "warning");
    return;
  }

  try {
    await API.disable2FA(code);
    showNotification("2FA has been disabled", "success");
    close2FAModal();
    await loadUserSecurityStatus();
  } catch (error) {
    showNotification(
      error.detail || "Invalid code. Please try again.",
      "danger",
    );
  }
};
