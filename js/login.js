const form = document.getElementById("login-form");
const errorAlert = document.getElementById("error-alert");
const errorMessage = document.getElementById("error-message");
const submitBtn = document.getElementById("submit-btn");
const submitText = document.getElementById("submit-text");
const twoFAContainer = document.getElementById("2fa-container");
const twoFAForm = document.getElementById("2fa-form");
const twoFASubmitBtn = document.getElementById("2fa-submit-btn");
const twoFASubmitText = document.getElementById("2fa-submit-text");

let tempToken = null;

function togglePassword() {
  const passwordInput = document.getElementById("password");
  const passwordIcon = document.getElementById("password-icon");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordIcon.classList.remove("fa-eye");
    passwordIcon.classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    passwordIcon.classList.remove("fa-eye-slash");
    passwordIcon.classList.add("fa-eye");
  }
}

function backToLogin() {
  form.classList.remove("d-none");
  twoFAContainer.classList.add("d-none");
  tempToken = null;
}

async function loginWithGoogle() {
  try {
    const response = await API.googleLogin();
    if (response.authorization_url) {
      window.location.href = response.authorization_url;
    }
  } catch (error) {
    errorMessage.textContent = error.detail || "Google login failed";
    errorAlert.classList.remove("d-none");
  }
}

// Helper function to redirect after login
function redirectAfterLogin() {
  // Check for pending gift code
  const pendingGiftCode = localStorage.getItem("pending_gift_code");
  if (pendingGiftCode) {
    window.location.href = `gift-activate.html?code=${pendingGiftCode}`;
    return;
  }

  // Default redirect to dashboard
  window.location.href = "dashboard.html";
}

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  submitBtn.disabled = true;
  submitText.innerHTML = "Logging in...";
  errorAlert.classList.add("d-none");

  try {
    const data = await API.login(email, password);

    if (data.requires_2fa) {
      tempToken = data.access_token;
      form.classList.add("d-none");
      twoFAContainer.classList.remove("d-none");
      submitBtn.disabled = false;
      submitText.innerHTML = "Log In";
      return;
    }

    localStorage.setItem("token", data.access_token);
    submitText.innerHTML = '<i class="fas fa-check me-2"></i>Success!';
    submitBtn.classList.add("btn-success");

    setTimeout(() => {
      redirectAfterLogin();
    }, 500);
  } catch (error) {
    errorMessage.textContent =
      error.detail || "Login failed. Please check your credentials.";
    errorAlert.classList.remove("d-none");
    submitBtn.disabled = false;
    submitText.innerHTML = "Log In";
    errorAlert.classList.add("shake");
    setTimeout(() => errorAlert.classList.remove("shake"), 500);
  }
});

twoFAForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const code = document.getElementById("2fa-code").value;

  if (!tempToken) {
    errorMessage.textContent = "Session expired. Please login again.";
    errorAlert.classList.remove("d-none");
    backToLogin();
    return;
  }

  twoFASubmitBtn.disabled = true;
  twoFASubmitText.innerHTML = "Verifying...";
  errorAlert.classList.add("d-none");

  try {
    const data = await API.verify2FA(tempToken, code);
    localStorage.setItem("token", data.access_token);
    twoFASubmitText.innerHTML = "Success!";
    twoFASubmitBtn.classList.add("btn-success");

    setTimeout(() => {
      redirectAfterLogin();
    }, 500);
  } catch (error) {
    errorMessage.textContent =
      error.detail || "Invalid code. Please try again.";
    errorAlert.classList.remove("d-none");
    twoFASubmitBtn.disabled = false;
    twoFASubmitText.innerHTML = "Verify";
    errorAlert.classList.add("shake");
    setTimeout(() => errorAlert.classList.remove("shake"), 500);
  }
});

// Handle OAuth callback
const urlParams = new URLSearchParams(window.location.search);
const token = urlParams.get("token");
if (token) {
  localStorage.setItem("token", token);
  redirectAfterLogin();
}
