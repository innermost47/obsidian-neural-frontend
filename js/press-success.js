(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "OBSIDIAN Neural";
  var el = document.getElementById("activate-desc");
  if (el) {
    el.innerHTML =
      "Paste your unique key directly into the <strong class='text-gray-300'>" +
      pluginName +
      "</strong> interface to unlock your 200 credits.";
  }
})();
