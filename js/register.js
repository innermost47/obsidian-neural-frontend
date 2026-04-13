const form = document.getElementById("register-form");
const errorAlert = document.getElementById("error-alert");
const errorMessage = document.getElementById("error-message");
const submitBtn = document.getElementById("submit-btn");
const submitText = document.getElementById("submit-text");

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

async function registerWithGoogle() {
  try {
    const response = await API.googleLogin();
    if (response.authorization_url) {
      window.location.href = response.authorization_url;
    }
  } catch (error) {
    errorMessage.textContent = error.detail || "Google registration failed";
    errorAlert.classList.remove("d-none");
  }
}

function redirectAfterRegistration() {
  const pendingGiftCode = localStorage.getItem("pending_gift_code");
  if (pendingGiftCode) {
    window.location.href = `gift-activate.html?code=${pendingGiftCode}`;
    return;
  }
  window.location.href = "onboarding.html";
}

if (form) {
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const acceptNewsUpdates =
      document.getElementById("acceptNewsUpdates").checked;

    submitBtn.disabled = true;
    submitText.innerHTML = "Creating account...";
    errorAlert.classList.add("d-none");

    try {
      await API.register(email, password, acceptNewsUpdates);
      const loginData = await API.login(email, password);

      if (!loginData || !loginData.access_token) {
        throw new Error("No access token received");
      }

      localStorage.setItem("token", loginData.access_token);

      submitText.innerHTML = "Account created!";
      submitBtn.classList.remove("btn-gradient-primary");
      submitBtn.classList.add("btn-success");

      setTimeout(() => {
        redirectAfterRegistration();
      }, 1000);
    } catch (error) {
      console.error("❌ Error caught:", error);
      let errorMsg = "Registration failed. Please try again.";
      if (error.detail) {
        errorMsg =
          typeof error.detail === "string"
            ? error.detail
            : JSON.stringify(error.detail);
      }
      console.log("Error message:", errorMsg);
      errorMessage.textContent = errorMsg;
      errorAlert.classList.remove("d-none");
      submitBtn.disabled = false;
      submitText.innerHTML = "Create Account";
      errorAlert.classList.add("shake");
      setTimeout(() => errorAlert.classList.remove("shake"), 500);
    }
  });
}
