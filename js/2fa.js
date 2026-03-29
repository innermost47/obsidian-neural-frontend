let twoFAModal;
let currentUser;
let backupCodes = [];

document.addEventListener("DOMContentLoaded", () => {
  twoFAModal = new bootstrap.Modal(document.getElementById("2fa-modal"));
  loadUserSecurityStatus();
});

async function loadUserSecurityStatus() {
  try {
    const user = await API.getCurrentUser();
    currentUser = user;

    const twoFACardContainer = document.getElementById("2fa-card-container");
    const twoFAStatusBadge = document.getElementById("2fa-status-badge");
    const twoFABtnText = document.getElementById("2fa-btn-text");
    const emailStatusBadge = document.getElementById("email-status-badge");
    const emailVerificationAlert = document.getElementById(
      "email-verification-alert"
    );
    const emailVerificationCard = document.getElementById(
      "email-verification-card"
    );
    const securitySettingsRow = document.getElementById(
      "security-settings-row"
    );

    if (user.oauth_provider === "google") {
      if (twoFACardContainer) {
        twoFACardContainer.classList.add("d-none");
      }
      if (emailVerificationCard) {
        emailVerificationCard.classList.remove("col-md-6");
        emailVerificationCard.classList.add("col-md-12");
      }
    }

    if (!user.email_verified) {
      if (emailVerificationAlert) {
        emailVerificationAlert.classList.remove("d-none");
      }

      const subscribeButtons = document.querySelectorAll(
        '[onclick^="subscribe"]'
      );
      subscribeButtons.forEach((btn) => {
        btn.disabled = true;
        btn.classList.add("disabled");
        btn.title = "Verify your email first";
        const originalOnclick = btn.getAttribute("onclick");
        btn.setAttribute("data-original-onclick", originalOnclick);
        btn.setAttribute(
          "onclick",
          'alert("Please verify your email address before subscribing."); return false;'
        );
      });
    }

    if (twoFAStatusBadge && twoFABtnText) {
      if (user.two_factor_enabled) {
        twoFAStatusBadge.className = "badge bg-success";
        twoFAStatusBadge.innerHTML = '<i class="fas fa-check me-1"></i>Enabled';
        twoFABtnText.textContent = "Disable";
      } else {
        twoFAStatusBadge.className = "badge bg-secondary";
        twoFAStatusBadge.innerHTML =
          '<i class="fas fa-times me-1"></i>Disabled';
        twoFABtnText.textContent = "Setup";
      }
    }

    if (emailStatusBadge) {
      if (user.email_verified) {
        emailStatusBadge.className = "badge bg-success";
        emailStatusBadge.innerHTML =
          '<i class="fas fa-check me-1"></i>Verified';
      } else {
        emailStatusBadge.className = "badge bg-warning";
        emailStatusBadge.innerHTML =
          '<i class="fas fa-exclamation me-1"></i>Not Verified';
      }
    }
  } catch (error) {
    console.error("Failed to load security status:", error);

    const twoFAStatusBadge = document.getElementById("2fa-status-badge");
    const emailStatusBadge = document.getElementById("email-status-badge");

    if (twoFAStatusBadge) {
      twoFAStatusBadge.className = "badge bg-danger";
      twoFAStatusBadge.textContent = "Error";
    }

    if (emailStatusBadge) {
      emailStatusBadge.className = "badge bg-danger";
      emailStatusBadge.textContent = "Error";
    }
  }
}

async function resendVerificationEmail() {
  if (!currentUser || !currentUser.email) {
    alert("Unable to resend email. Please refresh the page.");
    return;
  }

  try {
    await API.resendVerification(currentUser.email);
    alert("Verification email sent! Please check your inbox.");
  } catch (error) {
    alert(
      error.detail || "Failed to send verification email. Please try again."
    );
  }
}

async function toggle2FA() {
  if (!currentUser) {
    await loadUserSecurityStatus();
  }

  if (!currentUser) {
    alert("Failed to load user data. Please refresh the page.");
    return;
  }

  if (currentUser.two_factor_enabled) {
    showDisable2FAModal();
  } else {
    await setup2FA();
  }
}

async function setup2FA() {
  try {
    const response = await API.setup2FA();

    document.getElementById("modal-title").textContent =
      "Setup Two-Factor Authentication";
    document.getElementById("qr-code-img").src = response.qr_code;
    document.getElementById("manual-code").textContent = response.secret;

    document.getElementById("setup-2fa-content").classList.remove("d-none");
    document.getElementById("backup-codes-content").classList.add("d-none");
    document.getElementById("disable-2fa-content").classList.add("d-none");

    twoFAModal.show();
  } catch (error) {
    alert(error.detail || "Failed to setup 2FA");
  }
}

async function verifySetup2FA() {
  const code = document.getElementById("verify-code").value;

  if (!code || code.length !== 6) {
    alert("Please enter a valid 6-digit code");
    return;
  }

  try {
    const response = await API.verifySetup2FA(code);

    backupCodes = response.backup_codes;

    const backupCodesList = document.getElementById("backup-codes-list");
    backupCodesList.textContent = backupCodes.join("\n");

    document.getElementById("setup-2fa-content").classList.add("d-none");
    document.getElementById("backup-codes-content").classList.remove("d-none");

    await loadUserSecurityStatus();
  } catch (error) {
    alert(error.detail || "Invalid code. Please try again.");
  }
}

function downloadBackupCodes() {
  const content = `Obsidian Neural - 2FA Backup Codes\n\nGenerated: ${new Date().toLocaleString()}\n\n${backupCodes.join(
    "\n"
  )}\n\nKeep these codes in a safe place. Each code can only be used once.`;

  const blob = new Blob([content], { type: "text/plain" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = "obsidian-neural-backup-codes.txt";
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);

  twoFAModal.hide();
}

function showDisable2FAModal() {
  document.getElementById("modal-title").textContent =
    "Disable Two-Factor Authentication";
  document.getElementById("setup-2fa-content").classList.add("d-none");
  document.getElementById("backup-codes-content").classList.add("d-none");
  document.getElementById("disable-2fa-content").classList.remove("d-none");
  document.getElementById("disable-code").value = "";

  twoFAModal.show();
}

async function confirmDisable2FA() {
  const code = document.getElementById("disable-code").value;

  if (!code || code.length !== 6) {
    alert("Please enter a valid 6-digit code");
    return;
  }

  try {
    await API.disable2FA(code);

    alert("2FA has been disabled");
    twoFAModal.hide();

    await loadUserSecurityStatus();
  } catch (error) {
    alert(error.detail || "Invalid code. Please try again.");
  }
}
