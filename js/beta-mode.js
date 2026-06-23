document.addEventListener("DOMContentLoaded", () => {
  const isBeta = window.APP_CONFIG && window.APP_CONFIG.BETA_MODE === true;

  const priceTags = document.querySelectorAll("[data-local-price]");
  const betaBlocks = document.querySelectorAll("[data-beta-block]");
  const prodButtons = document.querySelectorAll("[data-prod-buy]");

  if (isBeta) {
    priceTags.forEach((tag) => tag.classList.add("hidden"));
    prodButtons.forEach((btn) => btn.classList.add("hidden"));
    betaBlocks.forEach((block) => block.classList.remove("hidden"));
  } else {
    priceTags.forEach((tag) => tag.classList.remove("hidden"));
    prodButtons.forEach((btn) => btn.classList.remove("hidden"));
    betaBlocks.forEach((block) => block.classList.add("hidden"));
  }
});
