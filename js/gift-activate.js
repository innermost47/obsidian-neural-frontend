(function () {
  "use strict";

  const urlParams = new URLSearchParams(window.location.search);
  const giftCode = urlParams.get("code");

  const loadingState = document.getElementById("loadingState");
  const giftDetails = document.getElementById("giftDetails");
  const errorState = document.getElementById("errorState");
  const errorMessage = document.getElementById("errorMessage");

  const isLoggedIn = !!localStorage.getItem("token");

  if (!giftCode) {
    showError("No gift code provided in the URL.");
    return;
  }

  localStorage.setItem("pending_gift_code", giftCode);

  if (isLoggedIn) {
    activateGift();
  } else {
    checkGiftCode();
  }

  function showError(message) {
    loadingState.style.display = "none";
    errorState.style.display = "block";
    errorMessage.textContent = message;
  }

  function showGiftDetails(data) {
    loadingState.style.display = "none";
    giftDetails.style.display = "block";

    const giftPlan = document.getElementById("giftPlan");
    const giftDuration = document.getElementById("giftDuration");
    const giftMessageBox = document.getElementById("giftMessageBox");
    const giftMessageContent = document.getElementById("giftMessageContent");
    const purchaserName = document.getElementById("purchaserName");

    if (giftPlan)
      giftPlan.textContent =
        data.tier.charAt(0).toUpperCase() + data.tier.slice(1);
    if (giftDuration)
      giftDuration.textContent = `${data.duration_months} Month${data.duration_months > 1 ? "s" : ""}`;

    if (data.gift_message && giftMessageBox && giftMessageContent) {
      giftMessageBox.classList.remove("hidden");
      giftMessageContent.textContent = data.gift_message;
      if (purchaserName)
        purchaserName.textContent = data.purchaser_name || "someone special";
    }
  }

  async function checkGiftCode() {
    try {
      const data = await API.checkGiftCode(giftCode);
      showGiftDetails(data);
    } catch (error) {
      showError(
        error.detail ||
          "This gift code is not valid or has already been activated.",
      );
    }
  }

  async function activateGift() {
    loadingState.style.display = "block";
    const loadingText = loadingState.querySelector("p");
    if (loadingText) loadingText.textContent = "Activating your gift...";

    try {
      const data = await API.activateGift(giftCode);
      localStorage.removeItem("pending_gift_code");
      loadingState.style.display = "none";

      giftDetails.innerHTML = `
                <div class="text-center py-8">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary to-[#a04840] flex items-center justify-center text-white text-4xl mx-auto mb-6 shadow-[0_0_40px_rgba(217,104,80,0.4)]"
                         style="animation: successBounce 0.6s ease">
                        <i class="fas fa-check"></i>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3">🎉 Gift Activated!</h2>
                    <p class="text-gray-400 text-lg mb-6">${data.message}</p>
                    <div class="bg-success/10 border border-success/30 rounded-2xl p-5 mb-6 text-left space-y-2 max-w-xs mx-auto">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Plan</span>
                            <span class="font-bold text-white">${data.tier.charAt(0).toUpperCase() + data.tier.slice(1)}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Expires</span>
                            <span class="font-bold text-white">${new Date(data.expires_at).toLocaleDateString()}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Credits Granted</span>
                            <span class="font-bold text-primary">${data.credits_granted}</span>
                        </div>
                    </div>
                    <a href="dashboard.php" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                        <i class="fas fa-rocket"></i>Go to Dashboard
                    </a>
                </div>
                <style>
                    @keyframes successBounce {
                        0%   { transform: scale(0); opacity: 0; }
                        60%  { transform: scale(1.15); }
                        100% { transform: scale(1); opacity: 1; }
                    }
                </style>`;

      giftDetails.style.display = "block";

      Confetti.success();
    } catch (error) {
      showError(
        error.detail ||
          "Failed to activate gift. Please try again or contact support.",
      );
    }
  }
})();

(function () {
  var cfg = window.APP_CONFIG || {};
  var siteName = cfg.SITE_NAME || "OBSIDIAN Neural";
  var subtitle = document.getElementById("activation-hero-sub");
  if (subtitle)
    subtitle.textContent =
      "Activate your " + siteName + " subscription gift below";
})();
