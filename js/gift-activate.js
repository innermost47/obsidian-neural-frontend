(function () {
  "use strict";

  // Get gift code from URL
  const urlParams = new URLSearchParams(window.location.search);
  const giftCode = urlParams.get("code");

  const loadingState = document.getElementById("loadingState");
  const giftDetails = document.getElementById("giftDetails");
  const errorState = document.getElementById("errorState");
  const errorMessage = document.getElementById("errorMessage");

  // Check if user is logged in
  const token = localStorage.getItem("token");
  const isLoggedIn = !!token;

  if (!giftCode) {
    // No code provided
    showError("No gift code provided in the URL.");
    return;
  }

  // If user is logged in, try to activate immediately
  if (isLoggedIn) {
    activateGift();
  } else {
    // Not logged in, show gift details and login options
    checkGiftCode();
  }

  // Store gift code for after login
  localStorage.setItem("pending_gift_code", giftCode);

  function showError(message) {
    loadingState.style.display = "none";
    errorState.style.display = "block";
    errorMessage.textContent = message;
  }

  function showGiftDetails(data) {
    loadingState.style.display = "none";
    giftDetails.style.display = "block";

    // Populate details
    const giftPlan = document.getElementById("giftPlan");
    const giftDuration = document.getElementById("giftDuration");
    const giftMessageBox = document.getElementById("giftMessageBox");
    const giftMessageContent = document.getElementById("giftMessageContent");
    const purchaserName = document.getElementById("purchaserName");

    if (giftPlan) {
      giftPlan.textContent =
        data.tier.charAt(0).toUpperCase() + data.tier.slice(1);
    }

    if (giftDuration) {
      giftDuration.textContent = `${data.duration_months} Month${
        data.duration_months > 1 ? "s" : ""
      }`;
    }

    // Show personal message if exists
    if (data.gift_message && giftMessageBox && giftMessageContent) {
      giftMessageBox.style.display = "block";
      giftMessageContent.textContent = data.gift_message;
      if (purchaserName) {
        purchaserName.textContent = data.purchaser_name || "someone special";
      }
    }
  }

  async function checkGiftCode() {
    try {
      const data = await API.checkGiftCode(giftCode);
      showGiftDetails(data);
    } catch (error) {
      console.error("Error:", error);
      showError(
        error.detail ||
          "This gift code is not valid or has already been activated."
      );
    }
  }

  async function activateGift() {
    loadingState.style.display = "block";
    loadingState.querySelector("p").textContent = "Activating your gift...";

    try {
      const data = await API.activateGift(giftCode);

      // Clear the pending gift code
      localStorage.removeItem("pending_gift_code");

      // Show success message
      loadingState.style.display = "none";

      // Create success display
      const successHTML = `
        <div class="text-center py-5">
          <div class="success-icon mx-auto mb-4" style="width: 100px; height: 100px; background: var(--gradient-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; animation: success-bounce 0.6s ease;">
            <i class="fas fa-check fa-3x" style="color: white;"></i>
          </div>
          <h2 class="h3 fw-bold mb-3">🎉 Gift Activated!</h2>
          <p class="lead mb-4">${data.message}</p>
          <div class="alert alert-success mb-4">
            <strong>Plan:</strong> ${
              data.tier.charAt(0).toUpperCase() + data.tier.slice(1)
            }<br>
            <strong>Expires:</strong> ${new Date(
              data.expires_at
            ).toLocaleDateString()}<br>
            <strong>Credits Granted:</strong> ${data.credits_granted}
          </div>
          <a href="dashboard.html" class="btn btn-gradient-primary btn-lg px-5 py-3">
            <i class="fas fa-rocket me-2"></i>Go to Dashboard
          </a>
        </div>
      `;

      giftDetails.innerHTML = successHTML;
      giftDetails.style.display = "block";

      // Add confetti animation
      createConfetti();
    } catch (error) {
      console.error("Error:", error);
      showError(
        error.detail ||
          "Failed to activate gift. Please try again or contact support."
      );
    }
  }

  // Confetti animation
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
})();
