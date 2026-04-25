(function () {
  "use strict";

  const form = document.getElementById("giftCheckForm");
  const checkForm = document.getElementById("checkForm");
  const loadingState = document.getElementById("loadingState");
  const giftDetailsCard = document.getElementById("giftDetailsCard");
  const errorAlert = document.getElementById("errorAlert");
  const submitBtn = document.getElementById("submitBtn");

  const urlParams = new URLSearchParams(window.location.search);
  const codeFromUrl = urlParams.get("code");
  if (codeFromUrl) {
    document.getElementById("giftCode").value = codeFromUrl;
    setTimeout(() => {
      form.dispatchEvent(
        new Event("submit", { cancelable: true, bubbles: true }),
      );
    }, 500);
  }

  function showError(message) {
    errorAlert.textContent = message;
    errorAlert.classList.remove("d-none");
    setTimeout(() => {
      errorAlert.classList.add("d-none");
    }, 5000);
  }

  function showLoading() {
    checkForm.classList.add("d-none");
    giftDetailsCard.classList.add("d-none");
    loadingState.classList.remove("d-none");
  }

  function showGiftDetails(data) {
    loadingState.classList.add("d-none");
    giftDetailsCard.classList.remove("d-none");

    const giftPlan = document.getElementById("giftPlan");
    const giftDuration = document.getElementById("giftDuration");
    const giftMessageBox = document.getElementById("giftMessageBox");
    const giftMessageContent = document.getElementById("giftMessageContent");
    const purchaserName = document.getElementById("purchaserName");
    const recipientEmail = document.getElementById("recipientEmail");
    const activateBtn = document.getElementById("activateBtn");

    giftPlan.textContent =
      data.tier.charAt(0).toUpperCase() + data.tier.slice(1);

    giftDuration.textContent = `${data.duration_months} Month${
      data.duration_months > 1 ? "s" : ""
    }`;

    if (data.gift_message) {
      giftMessageBox.style.display = "block";
      giftMessageContent.textContent = data.gift_message;
      purchaserName.textContent = data.purchaser_name || "someone special";
    }

    recipientEmail.textContent = data.recipient_email;

    const giftCode = document.getElementById("giftCode").value.trim();
    activateBtn.href = `gift-activate.php?code=${giftCode}`;
  }

  function showCheckForm() {
    loadingState.classList.add("d-none");
    giftDetailsCard.classList.add("d-none");
    checkForm.classList.remove("d-none");
  }

  form?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const giftCode = document
      .getElementById("giftCode")
      .value.trim()
      .toUpperCase();

    if (!giftCode) {
      showError("Please enter a gift code");
      return;
    }

    if (!giftCode.startsWith("OBSIDIAN-") || giftCode.length < 20) {
      showError("Invalid gift code format. Should be OBSIDIAN-XXXXXXXXXXXX");
      return;
    }

    submitBtn.disabled = true;
    showLoading();

    try {
      const data = await API.checkGiftCode(giftCode);
      showGiftDetails(data);
    } catch (error) {
      console.error("Error:", error);
      showCheckForm();
      showError(
        error.detail ||
          "Invalid or already activated gift code. Please check and try again.",
      );
    } finally {
      submitBtn.disabled = false;
    }
  });
})();
