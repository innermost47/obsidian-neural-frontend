"use strict";

const form = document.getElementById("reset-password-form");
const errorAlert = document.getElementById("error-alert");
const errorMessage = document.getElementById("error-message");
const successAlert = document.getElementById("success-alert");
const successMessage = document.getElementById("success-message");
const submitBtn = document.getElementById("submit-btn");
const submitText = document.getElementById("submit-text");
const invalidTokenContainer = document.getElementById(
  "invalid-token-container",
);

const urlParams = new URLSearchParams(window.location.search);
const token = urlParams.get("token");

if (!token) {
  form.classList.add("hidden");
  invalidTokenContainer.classList.remove("hidden");
}

window.togglePassword = function (inputId, iconId) {
  const input = document.getElementById(inputId);
  const icon = document.getElementById(iconId);
  if (input.type === "password") {
    input.type = "text";
    icon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.replace("fa-eye-slash", "fa-eye");
  }
};

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  if (password !== confirmPassword) {
    errorMessage.textContent = "Passwords do not match";
    errorAlert.classList.remove("hidden");
    return;
  }
  if (password.length < 8) {
    errorMessage.textContent = "Password must be at least 8 characters";
    errorAlert.classList.remove("hidden");
    return;
  }

  submitBtn.disabled = true;
  submitText.textContent = "Resetting...";
  errorAlert.classList.add("hidden");
  successAlert.classList.add("hidden");

  try {
    await API.resetPassword(token, password);

    successMessage.textContent =
      "Password reset successfully! Redirecting to login...";
    successAlert.classList.remove("hidden");
    submitText.textContent = "Success!";
    submitBtn.classList.remove(
      "from-primary",
      "to-[#a04840]",
      "shadow-[0_0_25px_rgba(217,104,80,0.3)]",
    );
    submitBtn.classList.add("from-success", "to-green-600");
    form.classList.add("hidden");

    setTimeout(() => {
      window.location.href = "login.php";
    }, 2000);
  } catch (error) {
    if (
      error.detail &&
      (error.detail.includes("Invalid") || error.detail.includes("expired"))
    ) {
      form.classList.add("hidden");
      invalidTokenContainer.classList.remove("hidden");
    } else {
      errorMessage.textContent =
        error.detail || "Failed to reset password. Please try again.";
      errorAlert.classList.remove("hidden");
      submitBtn.disabled = false;
      submitText.textContent = "Reset Password";
    }
  }
});
