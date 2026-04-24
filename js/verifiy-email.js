const loadingContainer = document.getElementById("loading-container");
const successContainer = document.getElementById("success-container");
const errorContainer = document.getElementById("error-container");
const alreadyVerifiedContainer = document.getElementById(
  "already-verified-container",
);
const errorMessage = document.getElementById("error-message");
const resendBtn = document.getElementById("resend-btn");
const resendText = document.getElementById("resend-text");

const urlParams = new URLSearchParams(window.location.search);
const token = urlParams.get("token");

function showState(id) {
  [
    "loading-container",
    "success-container",
    "error-container",
    "already-verified-container",
  ].forEach((s) => {
    document.getElementById(s).classList.add("hidden");
  });
  document.getElementById(id).classList.remove("hidden");
}

async function verifyEmail() {
  if (!token) {
    showState("error-container");
    errorMessage.textContent = "No verification token provided.";
    return;
  }
  try {
    await API.verifyEmail(token);
    showState("success-container");
    setTimeout(() => {
      window.location.href = "dashboard.php";
    }, 3000);
  } catch (error) {
    if (error.detail && error.detail.includes("already verified")) {
      showState("already-verified-container");
    } else {
      errorMessage.textContent =
        error.detail ||
        "Verification failed. The link may be invalid or expired.";
      showState("error-container");
    }
  }
}

async function resendVerification() {
  const email = document.getElementById("resend-email").value;
  if (!email) return;
  resendBtn.disabled = true;
  resendText.innerHTML =
    '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
  try {
    await API.resendVerification(email);
    resendText.innerHTML = '<i class="fas fa-check mr-2"></i>Email Sent!';
    resendBtn.classList.remove(
      "from-primary",
      "to-[#a04840]",
      "shadow-[0_0_25px_rgba(217,104,80,0.3)]",
    );
    resendBtn.classList.add("from-success", "to-green-600");
    setTimeout(() => {
      resendBtn.disabled = false;
      resendBtn.classList.add(
        "from-primary",
        "to-[#a04840]",
        "shadow-[0_0_25px_rgba(217,104,80,0.3)]",
      );
      resendBtn.classList.remove("from-success", "to-green-600");
      resendText.innerHTML =
        '<i class="fas fa-paper-plane mr-2"></i>Resend Verification Email';
    }, 3000);
  } catch (error) {
    resendBtn.disabled = false;
    resendText.innerHTML =
      '<i class="fas fa-paper-plane mr-2"></i>Resend Verification Email';
  }
}

verifyEmail();
