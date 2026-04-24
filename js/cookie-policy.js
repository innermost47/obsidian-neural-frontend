(function () {
  var cfg = window.APP_CONFIG || {};
  var el = document.getElementById("legal-last-updated");
  if (el) el.textContent = cfg.LEGAL_LAST_UPDATED || "—";
  var privacyEmail =
    cfg.PRIVACY_EMAIL || cfg.SUPPORT_EMAIL || cfg.COMPANY_EMAIL || "";
  var link = document.getElementById("privacy-contact-link");
  if (link) link.href = privacyEmail ? "mailto:" + privacyEmail : "contact.php";
})();
