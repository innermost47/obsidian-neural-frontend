(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "OBSIDIAN Neural";
  var githubUrl = cfg.GITHUB_URL || "#";
  var githubIssues =
    cfg.GITHUB_ISSUES_URL || (githubUrl !== "#" ? githubUrl + "/issues" : "#");
  var githubDiscuss = githubUrl !== "#" ? githubUrl + "/discussions" : "#";
  var docsUrl = cfg.DOCS_URL || "/documentation.php?page=getting-started";
  var sym = cfg.GIFT_CURRENCY_SYMBOL || "€";
  var pBase = cfg.PLAN_PRICE_BASE || "5.99";
  var pStarter = cfg.GIFT_PRICE_STARTER || "14.99";
  var pPro = cfg.GIFT_PRICE_PRO || "29.99";
  var apiUrl = cfg.VST_API_URL || "";

  window._prices = {
    base: pBase,
    starter: pStarter,
    pro: pPro,
  };

  function setText(id, val) {
    var el = document.getElementById(id);
    if (el) el.textContent = val;
  }

  function setHref(id, url) {
    var el = document.getElementById(id);
    if (el && url !== "#") el.href = url;
  }

  setText("sidebar-plugin-name", pluginName.toUpperCase());
  setHref(
    "nav-download",
    githubUrl !== "#" ? githubUrl + "/releases/latest" : "#",
  );
  setHref("nav-support", githubIssues);

  var releasesBase =
    githubUrl !== "#" ? githubUrl + "/releases/latest/download/" : "";

  function dlUrl(cfgKey, fallbackFilename) {
    if (cfg[cfgKey]) return releasesBase + cfg[cfgKey];
    return releasesBase ? releasesBase + fallbackFilename : "#";
  }
  setHref(
    "dl-windows",
    dlUrl("DOWNLOAD_WIN", pluginName.replace(/ /g, "-") + "-Windows-VST3.zip"),
  );
  setHref(
    "dl-macos-vst3",
    dlUrl(
      "DOWNLOAD_MAC_VST3",
      pluginName.replace(/ /g, "-") + "-macOS-VST3.zip",
    ),
  );
  setHref(
    "dl-macos-au",
    dlUrl("DOWNLOAD_MAC_AU", pluginName.replace(/ /g, "-") + "-macOS-AU.zip"),
  );
  setHref(
    "dl-linux",
    dlUrl(
      "DOWNLOAD_LINUX",
      pluginName.replace(/ /g, "-") + "-Linux-VST3.tar.gz",
    ),
  );

  setHref("qa-docs", docsUrl);
  setHref("qa-support", githubIssues);
  setHref("qa-community", githubDiscuss);

  if (apiUrl) {
    var serverEl = document.getElementById("server-url");
    if (serverEl) serverEl.textContent = apiUrl;
  }

  setText("sub-price-base", sym + pBase);
  setText("sub-price-starter", sym + pStarter);
  setText("sub-price-pro", sym + pPro);
})();
