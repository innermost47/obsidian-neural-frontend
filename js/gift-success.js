(function () {
  "use strict";

  // Get gift code from URL parameter
  const urlParams = new URLSearchParams(window.location.search);
  const giftCode = urlParams.get("gift_code");

  const giftCodeDisplay = document.getElementById("giftCodeDisplay");
  const copyCodeBtn = document.getElementById("copyCodeBtn");
  const recipientEmailDisplay = document.getElementById(
    "recipientEmailDisplay"
  );
  const checkCodeLink = document.getElementById("checkCodeLink");
  checkCodeLink.href = "gift-check.html?code=" + giftCode;

  // Display gift code
  if (giftCode && giftCodeDisplay) {
    giftCodeDisplay.querySelector("code").textContent = giftCode;
  } else if (giftCodeDisplay) {
    giftCodeDisplay.querySelector("code").textContent = "Check your email";
    copyCodeBtn.style.display = "none";
  }

  // Copy code functionality
  copyCodeBtn?.addEventListener("click", () => {
    const code = giftCode || "";
    navigator.clipboard
      .writeText(code)
      .then(() => {
        const originalHTML = copyCodeBtn.innerHTML;
        copyCodeBtn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        copyCodeBtn.classList.add("btn-success");
        copyCodeBtn.classList.remove("btn-outline-primary");

        setTimeout(() => {
          copyCodeBtn.innerHTML = originalHTML;
          copyCodeBtn.classList.remove("btn-success");
          copyCodeBtn.classList.add("btn-outline-primary");
        }, 2000);
      })
      .catch((err) => {
        console.error("Failed to copy:", err);
        alert("Failed to copy code. Please copy it manually.");
      });
  });

  // Display recipient email from session storage
  if (recipientEmailDisplay) {
    const recipientEmail = sessionStorage.getItem("gift_recipient_email");
    if (recipientEmail) {
      recipientEmailDisplay.textContent = recipientEmail;
      sessionStorage.removeItem("gift_recipient_email");
    } else {
      recipientEmailDisplay.textContent = "Check your confirmation email";
    }
  }

  // Add confetti animation (optional)
  function createConfetti() {
    const colors = ["#b8605c", "#c97571", "#d4a5a0", "#f5c842", "#f7a800"];
    const confettiCount = 50;

    for (let i = 0; i < confettiCount; i++) {
      setTimeout(() => {
        const confetti = document.createElement("div");
        confetti.style.position = "fixed";
        confetti.style.width = "10px";
        confetti.style.height = "10px";
        confetti.style.backgroundColor =
          colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = Math.random() * 100 + "%";
        confetti.style.top = "-10px";
        confetti.style.opacity = "1";
        confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
        confetti.style.pointerEvents = "none";
        confetti.style.zIndex = "9999";
        confetti.style.borderRadius = "50%";

        document.body.appendChild(confetti);

        const fallDuration = 3000 + Math.random() * 2000;
        const fallDistance = window.innerHeight + 50;

        confetti.animate(
          [
            {
              transform: `translateY(0) rotate(0deg)`,
              opacity: 1,
            },
            {
              transform: `translateY(${fallDistance}px) rotate(${
                Math.random() * 720
              }deg)`,
              opacity: 0,
            },
          ],
          {
            duration: fallDuration,
            easing: "cubic-bezier(0.25, 0.46, 0.45, 0.94)",
          }
        );

        setTimeout(() => {
          confetti.remove();
        }, fallDuration);
      }, i * 50);
    }
  }

  // Trigger confetti on page load
  if (giftCode) {
    setTimeout(createConfetti, 300);
  }
})();
