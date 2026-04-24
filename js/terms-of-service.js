(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "Obsidian Neural";
  var lastUpdated = cfg.LEGAL_LAST_UPDATED || "—";
  var legalEmail =
    cfg.LEGAL_EMAIL || cfg.SUPPORT_EMAIL || cfg.COMPANY_EMAIL || "";

  var dateEl = document.getElementById("legal-last-updated");
  if (dateEl) dateEl.textContent = lastUpdated;

  var acceptance = document.getElementById("tos-acceptance");
  if (acceptance)
    acceptance.innerHTML =
      "By accessing and using <strong class='text-white'>" +
      pluginName +
      '</strong> ("the Service"), you accept and agree to be bound by these Terms of Service.';

  var desc = document.getElementById("tos-description");
  if (desc)
    desc.innerHTML =
      "<strong class='text-white'>" +
      pluginName +
      "</strong> provides AI-powered audio generation services through a VST plugin. The service uses third-party AI models including Stable Audio, Demucs, and language models.";

  var emailCta = document.getElementById("legal-email-cta");
  if (emailCta)
    emailCta.href = legalEmail ? "mailto:" + legalEmail : "contact.php";
})();
