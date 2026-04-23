(function () {
  "use strict";

  const PRICES = {
    starter: { 1: 14.99, 3: 44.97, 6: 89.94 },
    pro: { 1: 29.99, 3: 89.97, 6: 179.94 },
    studio: { 1: 59.99, 3: 179.97, 6: 359.94 },
  };

  const form = document.getElementById("giftForm");
  const tierSelect = document.getElementById("tier");
  const durationSelect = document.getElementById("duration");
  const giftMessageTextarea = document.getElementById("giftMessage");
  const charCount = document.getElementById("charCount");
  const priceDisplay = document.getElementById("priceDisplay");
  const totalPriceSpan = document.getElementById("totalPrice");
  const errorAlert = document.getElementById("errorAlert");
  const submitBtn = document.getElementById("submitBtn");

  giftMessageTextarea?.addEventListener("input", () => {
    const count = giftMessageTextarea.value.length;
    charCount.textContent = `${count} / 500`;
  });

  function updatePrice() {
    const tier = tierSelect.value;
    const duration = parseInt(durationSelect.value);

    if (tier && duration) {
      const price = PRICES[tier][duration];
      totalPriceSpan.textContent = `€${price.toFixed(2)}`;
      priceDisplay.style.display = "block";
    } else {
      priceDisplay.style.display = "none";
    }
  }

  tierSelect?.addEventListener("change", updatePrice);
  durationSelect?.addEventListener("change", updatePrice);

  function showError(message) {
    errorAlert.textContent = message;
    errorAlert.style.display = "block";
    errorAlert.scrollIntoView({ behavior: "smooth", block: "center" });
    setTimeout(() => {
      errorAlert.style.display = "none";
    }, 5000);
  }

  form?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const recipientEmail = document
      .getElementById("recipientEmail")
      .value.trim();
    const recipientName = document.getElementById("recipientName").value.trim();
    const tier = tierSelect.value;
    const duration = parseInt(durationSelect.value);
    const activationDateInput = document.getElementById("activationDate").value;
    const giftMessage = giftMessageTextarea.value.trim();
    const purchaserName = document.getElementById("purchaserName").value.trim();
    let formattedActivationDate = activationDateInput || null;
    if (formattedActivationDate) {
      formattedActivationDate += "T00:00:00";
    }

    if (!recipientEmail) {
      showError("Please enter recipient's email");
      return;
    }

    if (!tier) {
      showError("Please select a plan");
      return;
    }

    if (!duration) {
      showError("Please select a duration");
      return;
    }

    submitBtn.disabled = true;
    submitBtn.innerHTML =
      '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

    try {
      const giftData = {
        recipient_email: recipientEmail,
        recipient_name: recipientName || null,
        tier: tier,
        duration_months: duration,
        gift_message: giftMessage || null,
        activation_date: formattedActivationDate || null,
        purchaser_name: purchaserName || null,
      };

      const data = await API.purchaseGift(giftData);

      sessionStorage.setItem("gift_recipient_email", recipientEmail);

      window.location.href = data.checkout_url;
    } catch (error) {
      const message = "already has an active subscription";
      if (error.detail.includes(message)) {
        showError(error.detail);
      } else {
        showError("An error occurred. Please try again.");
      }

      submitBtn.disabled = false;
      submitBtn.innerHTML =
        '<i class="fas fa-shopping-cart me-2"></i>Proceed to Payment';
    }
  });

  const activationDateInput = document.getElementById("activationDate");
  if (activationDateInput) {
    const today = new Date().toISOString().split("T")[0];
    activationDateInput.min = today;
  }
})();

(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "OBSIDIAN Neural";
  var priceBase = cfg.GIFT_PRICE_BASE || "7.99";
  var priceStarter = cfg.GIFT_PRICE_STARTER || "11.99";
  var pricePro = cfg.GIFT_PRICE_PRO || "14.99";
  var sym = cfg.GIFT_CURRENCY_SYMBOL || "€";
  var conferenceTag = cfg.CONFERENCE_TAG || "";

  var subtitle = document.getElementById("hero-subtitle");
  if (subtitle) {
    subtitle.textContent =
      "The perfect gift for music producers and live performers. Give access to " +
      pluginName +
      ".";
  }

  var optBase = document.getElementById("opt-base");
  var optStarter = document.getElementById("opt-starter");
  var optPro = document.getElementById("opt-pro");
  if (optBase)
    optBase.textContent = "Base — " + sym + priceBase + "/mo (150 credits)";
  if (optStarter)
    optStarter.textContent =
      "Starter — " + sym + priceStarter + "/mo (300 credits)";
  if (optPro)
    optPro.textContent = "Pro — " + sym + pricePro + "/mo (500 credits)";

  var whyTitle = document.getElementById("why-gift-title");
  if (whyTitle) whyTitle.textContent = "Why Gift " + pluginName + "?";

  var uniqueDesc = document.getElementById("unique-desc");
  if (uniqueDesc) {
    uniqueDesc.textContent = conferenceTag
      ? "First VST of its kind — presented at " +
        conferenceTag +
        ". Give cutting-edge technology."
      : "First VST of its kind. Give cutting-edge technology.";
  }

  var prices = {
    base: parseFloat(priceBase),
    starter: parseFloat(priceStarter),
    pro: parseFloat(pricePro),
  };

  function updatePrice() {
    var tier = document.getElementById("tier").value;
    var duration = parseInt(document.getElementById("duration").value);
    var display = document.getElementById("priceDisplay");
    var total = document.getElementById("totalPrice");
    var errAlert = document.getElementById("errorAlert");

    errAlert.classList.add("hidden");

    if (tier && duration && prices[tier]) {
      total.textContent = sym + (prices[tier] * duration).toFixed(2);
      display.classList.remove("hidden");
    } else {
      display.classList.add("hidden");
    }
  }

  document.getElementById("tier").addEventListener("change", updatePrice);
  document.getElementById("duration").addEventListener("change", updatePrice);

  var giftMessage = document.getElementById("giftMessage");
  var charCount = document.getElementById("charCount");
  if (giftMessage && charCount) {
    giftMessage.addEventListener("input", function () {
      charCount.textContent = giftMessage.value.length + " / 500";
    });
  }
})();

function handleGiftSubmit() {
  var errAlert = document.getElementById("errorAlert");
  var errText = document.getElementById("errorText");
  var tier = document.getElementById("tier").value;
  var duration = document.getElementById("duration").value;

  errAlert.classList.add("hidden");

  if (
    !document.getElementById("recipientEmail").value.trim() ||
    !tier ||
    !duration
  ) {
    errText.textContent = "Please fill in all required fields.";
    errAlert.classList.remove("hidden");
    return;
  }

  if (typeof submitGiftForm === "function") submitGiftForm();
}
