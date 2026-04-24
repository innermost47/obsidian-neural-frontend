const form = document.getElementById("forgot-password-form");
const errorAlert = document.getElementById("error-alert");
const errorMessage = document.getElementById("error-message");
const successAlert = document.getElementById("success-alert");
const successMessage = document.getElementById("success-message");
const submitBtn = document.getElementById("submit-btn");
const submitText = document.getElementById("submit-text");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const email = document.getElementById("email").value;
  submitBtn.disabled = true;
  submitText.innerHTML =
    '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
  errorAlert.classList.add("hidden");
  successAlert.classList.add("hidden");

  try {
    await API.forgotPassword(email);
    successMessage.textContent =
      "If an account exists with this email, you'll receive a reset link shortly. Check your inbox!";
    successAlert.classList.remove("hidden");
    submitText.innerHTML = '<i class="fas fa-check mr-2"></i>Email Sent!';
    submitBtn.classList.remove(
      "from-primary",
      "to-[#a04840]",
      "shadow-[0_0_25px_rgba(217,104,80,0.3)]",
    );
    submitBtn.classList.add("from-success", "to-green-600");
    document.getElementById("email").value = "";
    setTimeout(() => {
      submitBtn.disabled = false;
      submitBtn.classList.remove("from-success", "to-green-600");
      submitBtn.classList.add(
        "from-primary",
        "to-[#a04840]",
        "shadow-[0_0_25px_rgba(217,104,80,0.3)]",
      );
      submitText.innerHTML =
        '<i class="fas fa-paper-plane mr-2"></i>Send Reset Link';
    }, 3000);
  } catch (error) {
    errorMessage.textContent =
      error.detail || "Failed to send reset email. Please try again.";
    errorAlert.classList.remove("hidden");
    submitBtn.disabled = false;
    submitText.innerHTML =
      '<i class="fas fa-paper-plane mr-2"></i>Send Reset Link';
  }
});
