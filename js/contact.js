document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("timestamp").value = Date.now();

  const messageField = document.getElementById("message");
  const charCount = document.getElementById("charCount");

  messageField.addEventListener("input", function () {
    charCount.textContent = this.value.length;
  });

  document
    .getElementById("contactForm")
    .addEventListener("submit", handleSubmit);
});

async function handleSubmit(event) {
  event.preventDefault();

  const submitBtn = document.getElementById("submitBtn");
  const btnText = document.getElementById("btnText");
  const btnSpinner = document.getElementById("btnSpinner");

  submitBtn.disabled = true;
  btnText.textContent = "Sending...";
  btnSpinner.style.display = "inline-block";

  const formData = new FormData(event.target);
  const data = Object.fromEntries(formData.entries());

  if (!validateForm(data)) {
    showAlert("An error occurred. Please try again.", "error");
    resetButton(submitBtn, btnText, btnSpinner);
    return;
  }

  try {
    await API.sendContactMessage(
      data.name,
      data.email,
      data.subject,
      data.message,
      {
        website: data.website || "",
        email_confirm: data.email_confirm || "",
        phone: data.phone || "",
        timestamp: data.timestamp,
      }
    );

    showAlert(
      "Message sent successfully! We'll respond within 24-48 hours.",
      "success"
    );
    event.target.reset();
    document.getElementById("timestamp").value = Date.now();
    document.getElementById("charCount").textContent = "0";
  } catch (error) {
    console.error("Error:", error);
    const errorMessage =
      error.detail ||
      "❌ An error occurred. Please check your connection and try again.";
    showAlert(errorMessage, "error");
  } finally {
    resetButton(submitBtn, btnText, btnSpinner);
  }
}

function validateForm(data) {
  if (data.website || data.email_confirm || data.phone) {
    console.warn("Bot detected: honeypot filled");
    return false;
  }

  const now = Date.now();
  const submittedTimestamp = parseInt(data.timestamp);
  const timeDiff = now - submittedTimestamp;

  if (timeDiff < 3000) {
    console.warn("Bot detected: form submitted too fast");
    return false;
  }

  return true;
}

function showAlert(message, type) {
  const alertContainer = document.getElementById("alert-container");
  const alertClass =
    type === "success" ? "alert-success-custom" : "alert-error-custom";

  alertContainer.innerHTML = `
    <div class="alert ${alertClass} alert-custom alert-dismissible fade show" role="alert">
      ${message}
    </div>
  `;

  alertContainer.scrollIntoView({ behavior: "smooth", block: "center" });

  setTimeout(() => {
    const alert = alertContainer.querySelector(".alert");
    if (alert) {
      const bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }
  }, 8000);
}

function resetButton(btn, text, spinner) {
  btn.disabled = false;
  text.textContent = "Send Message";
  spinner.style.display = "none";
}
