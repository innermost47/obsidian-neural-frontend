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
  submitBtn.classList.add("opacity-70", "pointer-events-none");
  btnText.textContent = "Sending...";
  btnSpinner.classList.remove("hidden");

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
        timestamp: data.timestamp,
      },
    );

    showAlert(
      "Message sent successfully! We'll respond within 24-48 hours.",
      "success",
    );
    event.target.reset();
    document.getElementById("timestamp").value = Date.now();
    document.getElementById("charCount").textContent = "0";
  } catch (error) {
    console.error("Error:", error);
    const errorMessage =
      error.detail ||
      "An error occurred. Please check your connection and try again.";
    showAlert(errorMessage, "error");
  } finally {
    resetButton(submitBtn, btnText, btnSpinner);
  }
}

function validateForm(data) {
  if (data.website || data.email_confirm) {
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
  if (!alertContainer) return;

  const isSuccess = type === "success";

  alertContainer.innerHTML = `
    <div class="flex items-start gap-3 p-4 rounded-xl border ${isSuccess ? "bg-success/10 border-success/30 text-success" : "bg-danger/10 border-danger/30 text-danger"} transition-all duration-300" id="live-alert">
      <i class="fas ${isSuccess ? "fa-check-circle" : "fa-exclamation-circle"} text-lg mt-0.5"></i>
      <p class="text-sm font-medium flex-1">${message}</p>
      <button onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100 transition-opacity">
        <i class="fas fa-times text-sm"></i>
      </button>
    </div>
  `;

  alertContainer.scrollIntoView({ behavior: "smooth", block: "center" });

  setTimeout(() => {
    const alert = document.getElementById("live-alert");
    if (alert) alert.remove();
  }, 8000);
}

function resetButton(btn, text, spinner) {
  btn.disabled = false;
  btn.classList.remove("opacity-70", "pointer-events-none");
  text.textContent = "Send Message";
  spinner.classList.add("hidden");
}

(function () {
  var cfg = window.APP_CONFIG || {};
  var supportEmail = cfg.SUPPORT_EMAIL || cfg.COMPANY_EMAIL || "";
  var githubUrl = cfg.GITHUB_URL || "#";
  var githubIssuesUrl =
    cfg.GITHUB_ISSUES_URL || (githubUrl !== "#" ? githubUrl + "/issues" : "#");
  var docsUrl = cfg.DOCS_URL || "#";
  var githubLabel =
    githubUrl !== "#" ? githubUrl.replace(/^https?:\/\/github\.com\//, "") : "";

  var emailLink = document.getElementById("contact-email-link");
  if (emailLink && supportEmail) {
    emailLink.href = "mailto:" + supportEmail;
    emailLink.querySelector(".ct-value").textContent = supportEmail;
  }

  var githubLink = document.getElementById("contact-github-link");
  if (githubLink) {
    if (githubUrl !== "#") {
      githubLink.href = githubUrl;
      githubLink.querySelector(".ct-value").textContent =
        githubLabel || githubUrl;
    } else {
      githubLink.style.display = "none";
    }
  }

  var docsLink = document.getElementById("contact-docs-link");
  if (docsLink && docsUrl !== "#") docsLink.href = docsUrl;

  var issuesLink = document.getElementById("contact-issues-link");
  if (issuesLink) {
    if (githubIssuesUrl !== "#") {
      issuesLink.href = githubIssuesUrl;
    } else {
      issuesLink.style.display = "none";
    }
  }
})();
