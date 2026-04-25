(function () {
  "use strict";

  const urlParams = new URLSearchParams(window.location.search);
  const giftCode = urlParams.get("gift_code");
  const giftCodeDisplay = document.getElementById("giftCodeDisplay");
  const copyCodeBtn = document.getElementById("copyCodeBtn");
  const recipientEmailDisplay = document.getElementById(
    "recipientEmailDisplay",
  );
  const checkCodeLink = document.getElementById("checkCodeLink");

  if (checkCodeLink) checkCodeLink.href = "gift-activate.php?code=" + giftCode;

  if (giftCode && giftCodeDisplay) {
    giftCodeDisplay.querySelector("code").textContent = giftCode;
  } else if (giftCodeDisplay) {
    giftCodeDisplay.querySelector("code").textContent = "Check your email";
    if (copyCodeBtn) copyCodeBtn.style.display = "none";
  }

  copyCodeBtn?.addEventListener("click", () => {
    navigator.clipboard
      .writeText(giftCode || "")
      .then(() => {
        const originalHTML = copyCodeBtn.innerHTML;
        copyCodeBtn.innerHTML = '<i class="fas fa-check mr-1"></i>Copied!';
        copyCodeBtn.classList.add(
          "bg-success/20",
          "text-success",
          "border-success/30",
        );
        copyCodeBtn.classList.remove("border-white/20", "text-white");
        setTimeout(() => {
          copyCodeBtn.innerHTML = originalHTML;
          copyCodeBtn.classList.remove(
            "bg-success/20",
            "text-success",
            "border-success/30",
          );
          copyCodeBtn.classList.add("border-white/20", "text-white");
        }, 2000);
      })
      .catch((err) => {
        console.error("Failed to copy:", err);
        showNotification(
          "Failed to copy code. Please copy it manually.",
          "warning",
        );
      });
  });

  if (recipientEmailDisplay) {
    const recipientEmail = sessionStorage.getItem("gift_recipient_email");
    recipientEmailDisplay.textContent =
      recipientEmail || "Check your confirmation email";
    if (recipientEmail) sessionStorage.removeItem("gift_recipient_email");
  }

  if (giftCode) {
    setTimeout(() => Confetti.success(), 300);
  }
})();

(function () {
  var cfg = window.APP_CONFIG || {};
  var siteName = cfg.SITE_NAME || "OBSIDIAN Neural";
  var subtitle = document.getElementById("hero-subtitle");
  if (subtitle)
    subtitle.textContent =
      "Activate your " + siteName + " subscription gift below";
})();
