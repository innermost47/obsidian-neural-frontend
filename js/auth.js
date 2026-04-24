const form = document.getElementById("register-form");
const errorAlert = document.getElementById("error-alert");
const submitBtn = document.getElementById("submit-btn");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  submitBtn.disabled = true;
  submitBtn.textContent = "Creating account...";
  errorAlert.classList.add("d-none");

  try {
    const data = await API.register(email, password);
    localStorage.setItem("token", data.access_token);
    window.location.href = "dashboard.php";
  } catch (error) {
    errorAlert.textContent = error.detail || "Registration failed";
    errorAlert.classList.remove("d-none");
    submitBtn.disabled = false;
    submitBtn.textContent = "Sign Up";
  }
});
