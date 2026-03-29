(function () {
  "use strict";

  // Price calculation
  const PRICES = {
    starter: { 1: 14.99, 3: 44.97, 6: 89.94 },
    pro: { 1: 29.99, 3: 89.97, 6: 179.94 },
    studio: { 1: 59.99, 3: 179.97, 6: 359.94 },
  };

  // DOM elements
  const form = document.getElementById("giftForm");
  const tierSelect = document.getElementById("tier");
  const durationSelect = document.getElementById("duration");
  const giftMessageTextarea = document.getElementById("giftMessage");
  const charCount = document.getElementById("charCount");
  const priceDisplay = document.getElementById("priceDisplay");
  const totalPriceSpan = document.getElementById("totalPrice");
  const errorAlert = document.getElementById("errorAlert");
  const submitBtn = document.getElementById("submitBtn");

  // Character counter
  giftMessageTextarea?.addEventListener("input", () => {
    const count = giftMessageTextarea.value.length;
    charCount.textContent = `${count} / 500`;
  });

  // Update price display
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

  // Show error
  function showError(message) {
    errorAlert.textContent = message;
    errorAlert.style.display = "block";
    errorAlert.scrollIntoView({ behavior: "smooth", block: "center" });
    setTimeout(() => {
      errorAlert.style.display = "none";
    }, 5000);
  }

  // Form submission
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
    // Validation
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

    // Disable button
    submitBtn.disabled = true;
    submitBtn.innerHTML =
      '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

    try {
      // Prepare data
      const giftData = {
        recipient_email: recipientEmail,
        recipient_name: recipientName || null,
        tier: tier,
        duration_months: duration,
        gift_message: giftMessage || null,
        activation_date: formattedActivationDate || null,
        purchaser_name: purchaserName || null,
      };

      // Call API
      const data = await API.purchaseGift(giftData);

      // Save recipient email for success page
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

  // Set minimum date for activation
  const activationDateInput = document.getElementById("activationDate");
  if (activationDateInput) {
    const today = new Date().toISOString().split("T")[0];
    activationDateInput.min = today;
  }
})();
