"use strict";

const form = document.getElementById("register-form");
const errorAlert = document.getElementById("error-alert");
const errorMessage = document.getElementById("error-message");
const submitBtn = document.getElementById("submit-btn");
const submitText = document.getElementById("submit-text");

window.togglePassword = function () {
  const input = document.getElementById("password");
  const icon = document.getElementById("password-icon");
  if (input.type === "password") {
    input.type = "text";
    icon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.replace("fa-eye-slash", "fa-eye");
  }
};

window.registerWithGoogle = async function () {
  try {
    const response = await API.googleLogin();
    if (response.authorization_url)
      window.location.href = response.authorization_url;
  } catch (error) {
    errorMessage.textContent = error.detail || "Google registration failed";
    errorAlert.classList.remove("hidden");
  }
};

function redirectAfterRegistration() {
  const pendingGiftCode = localStorage.getItem("pending_gift_code");
  if (pendingGiftCode) {
    window.location.href = `gift-activate.php?code=${pendingGiftCode}`;
    return;
  }
  window.location.href = "onboarding.php";
}

form?.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const acceptNewsUpdates =
    document.getElementById("acceptNewsUpdates").checked;

  submitBtn.disabled = true;
  submitText.textContent = "Creating account...";
  errorAlert.classList.add("hidden");

  try {
    await API.register(email, password, acceptNewsUpdates);
    const loginData = await API.login(email, password);
    if (!loginData?.access_token) throw new Error("No access token received");
    localStorage.setItem("token", loginData.access_token);

    submitText.textContent = "Account created!";
    submitBtn.classList.remove(
      "from-primary",
      "to-[#a04840]",
      "shadow-[0_0_25px_rgba(217,104,80,0.3)]",
    );
    submitBtn.classList.add("from-success", "to-green-600");
    setTimeout(() => redirectAfterRegistration(), 1200);
  } catch (error) {
    let msg = "Registration failed. Please try again.";
    if (error.detail)
      msg =
        typeof error.detail === "string"
          ? error.detail
          : JSON.stringify(error.detail);
    errorMessage.textContent = msg;
    errorAlert.classList.remove("hidden");
    submitBtn.disabled = false;
    submitText.textContent = "Create Account";
  }
});

(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "Obsidian Neural";
  var label = document.getElementById("newsletter-label");
  if (label)
    label.textContent =
      "I want to receive news and updates about " + pluginName;
})();
