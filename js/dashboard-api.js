let apiKeyVisible = false;

window.toggleApiKey = function () {
  const apiKeyEl = document.getElementById("api-key");
  const toggleText = document.getElementById("toggle-text");
  const icon = toggleText.previousElementSibling;

  apiKeyVisible = !apiKeyVisible;

  if (apiKeyVisible) {
    apiKeyEl.textContent = apiKeyEl.dataset.key;
    toggleText.textContent = "Hide";
    icon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    apiKeyEl.textContent = "••••••••••••••••";
    toggleText.textContent = "Show";
    icon.classList.replace("fa-eye-slash", "fa-eye");
  }
};

window.copyApiKey = function () {
  const apiKey = document.getElementById("api-key").dataset.key;
  navigator.clipboard.writeText(apiKey);

  const btn = event.target.closest("button");
  const originalHTML = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-check mr-1"></i>Copied!';
  btn.classList.add("bg-success/20", "text-success", "border-success/30");
  btn.classList.remove("border-white/20");
  setTimeout(() => {
    btn.innerHTML = originalHTML;
    btn.classList.remove("bg-success/20", "text-success", "border-success/30");
    btn.classList.add("border-white/20");
  }, 2000);
};

window.copyServerUrl = function (event) {
  const serverUrl = window.APP_CONFIG.API_URL;
  navigator.clipboard.writeText(serverUrl);

  const btn = event.target.closest("button");
  const originalHTML = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-check mr-1"></i>Copied!';
  btn.classList.add("bg-success/20", "text-success", "border-success/30");
  btn.classList.remove("border-white/20");
  setTimeout(() => {
    btn.innerHTML = originalHTML;
    btn.classList.remove("bg-success/20", "text-success", "border-success/30");
    btn.classList.add("border-white/20");
  }, 2000);
};

window.resendVerificationEmail = async function () {
  try {
    await API.resendVerification(currentUserEmail);
    showNotification("Verification email sent! Check your inbox.", "success");
  } catch (error) {
    showNotification(
      error.detail || "Failed to send verification email.",
      "danger",
    );
  }
};
