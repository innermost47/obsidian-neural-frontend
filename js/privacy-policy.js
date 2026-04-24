(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "Obsidian Neural";
  var privacyEmail =
    cfg.PRIVACY_EMAIL || cfg.SUPPORT_EMAIL || cfg.COMPANY_EMAIL || "";
  var lastUpdated = cfg.LEGAL_LAST_UPDATED || "—";

  var dateEl = document.getElementById("legal-last-updated");
  if (dateEl) dateEl.textContent = lastUpdated;

  function setEmail(id, email) {
    var el = document.getElementById(id);
    if (!el) return;
    if (email) {
      el.href = "mailto:" + email;
      el.textContent = email;
    } else {
      el.href = "contact.php";
      el.textContent = "contact form";
    }
  }
  setEmail("privacy-email-gdpr", privacyEmail);

  var ctaBtn = document.getElementById("privacy-email-cta");
  if (ctaBtn)
    ctaBtn.href = privacyEmail ? "mailto:" + privacyEmail : "contact.php";

  var tipsLabel = document.getElementById("email-tips-label");
  if (tipsLabel)
    tipsLabel.textContent = "Tips for getting the most out of " + pluginName;
})();
