document.addEventListener("DOMContentLoaded", async () => {
  const BETA_SLOT_LIMIT = 500;
  const priceTags = document.querySelectorAll("[data-local-price]");
  const betaBlocks = document.querySelectorAll("[data-beta-block]");
  const prodButtons = document.querySelectorAll("[data-prod-buy]");
  const betaPromoWrappers = document.querySelectorAll("[data-beta-promo]");
  const betaCodeTags = document.querySelectorAll("[data-beta-code]");
  const betaCodeCopyBtns = document.querySelectorAll("[data-beta-code-copy]");
  const betaCodeShareBtns = document.querySelectorAll("[data-beta-code-share]");
  const betaCheckoutBtns = document.querySelectorAll("[data-beta-checkout]");
  const slotWrappers = document.querySelectorAll("[data-beta-slots-wrapper]");
  const slotTags = document.querySelectorAll("[data-beta-slots]");

  let isBeta = window.APP_CONFIG && window.APP_CONFIG.BETA_MODE === true;
  let remainingSlots = null;

  try {
    const { total } = await API.getLicenseCountTotal();
    remainingSlots = Math.max(0, BETA_SLOT_LIMIT - total);
    isBeta = isBeta || remainingSlots > 0;
  } catch (error) {
    console.error("Failed to check license count:", error);
  }

  const betaCode = window.APP_CONFIG && window.APP_CONFIG.BETA_CODE;
  const showBetaPromo = isBeta && !!betaCode;

  if (isBeta) {
    priceTags.forEach((tag) => tag.classList.add("hidden"));
    prodButtons.forEach((btn) => btn.classList.add("hidden"));
    betaBlocks.forEach((block) => block.classList.remove("hidden"));

    if (remainingSlots !== null) {
      slotTags.forEach((tag) => (tag.textContent = remainingSlots));
      slotWrappers.forEach((w) => w.classList.remove("hidden"));
    }
  } else {
    priceTags.forEach((tag) => tag.classList.remove("hidden"));
    prodButtons.forEach((btn) => btn.classList.remove("hidden"));
    betaBlocks.forEach((block) => block.classList.add("hidden"));
    slotWrappers.forEach((w) => w.classList.add("hidden"));
  }

  if (showBetaPromo) {
    betaPromoWrappers.forEach((wrapper) => wrapper.classList.remove("hidden"));

    betaCodeTags.forEach((tag) => {
      tag.textContent = betaCode;
    });

    betaCodeCopyBtns.forEach((btn) => {
      btn.addEventListener("click", async () => {
        const label = btn.querySelector("[data-beta-code-copy-label]");
        try {
          await navigator.clipboard.writeText(betaCode);
          if (label) {
            const original = label.textContent;
            label.textContent = "Copied!";
            setTimeout(() => {
              label.textContent = original;
            }, 1500);
          }
        } catch (error) {
          console.error("Failed to copy promo code:", error);
        }
      });
    });

    betaCodeShareBtns.forEach((btn) => {
      btn.addEventListener("click", async () => {
        const shareData = {
          title: "OBSIDIAN Neural — Free Local Edition",
          text: `Get OBSIDIAN Neural's Local Edition free with this beta code: ${betaCode}`,
          url: window.location.href,
        };

        if (navigator.share) {
          try {
            await navigator.share(shareData);
          } catch (error) {
            if (error.name !== "AbortError") {
              console.error("Share failed:", error);
            }
          }
        } else {
          try {
            await navigator.clipboard.writeText(
              `${shareData.text} — ${shareData.url}`,
            );
            alert("Link copied! Paste it to share with a friend.");
          } catch (error) {
            console.error("Failed to copy share text:", error);
          }
        }
      });
    });

    betaCheckoutBtns.forEach((btn) => {
      if (btn.dataset.betaCheckoutBound) return;
      btn.dataset.betaCheckoutBound = "true";

      btn.addEventListener("click", async () => {
        if (btn.disabled) return;
        btn.disabled = true;
        const originalHTML = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner fa-spin mr-3"></i>Redirecting to Stripe...`;
        try {
          const { checkout_url } = await API.createLocalCheckout(
            null,
            betaCode,
          );
          window.location.href = checkout_url;
        } catch (error) {
          console.error("Failed to start beta checkout:", error);
          btn.disabled = false;
          btn.innerHTML = originalHTML;
        }
      });
    });
  } else {
    betaPromoWrappers.forEach((wrapper) => wrapper.classList.add("hidden"));
  }
});
