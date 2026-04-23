(function () {
  var cfg = window.APP_CONFIG || {};
  var sym = cfg.GIFT_CURRENCY_SYMBOL || "€";
  var pBase = cfg.PLAN_PRICE_BASE || "5.99";
  var pStarter = cfg.GIFT_PRICE_STARTER || "11.99";
  var pPro = cfg.GIFT_PRICE_PRO || "14.99";
  var githubUrl = cfg.GITHUB_URL || "#";

  document
    .querySelectorAll(".pricing-card-wrapper .price-value")
    .forEach((el, i) => {
      var prices = ["€0", sym + pBase, sym + pStarter, sym + pPro];
      if (prices[i]) el.textContent = prices[i];
    });

  var ghLink = document.getElementById("faq-github-link");
  if (ghLink && githubUrl !== "#") ghLink.href = githubUrl;
})();
