(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "OBSIDIAN Neural";
  var githubUrl = cfg.GITHUB_URL || "#";
  var githubIssues =
    cfg.GITHUB_ISSUES_URL || (githubUrl !== "#" ? githubUrl + "/issues" : "#");
  var githubDiscuss = githubUrl !== "#" ? githubUrl + "/discussions" : "#";
  var docsUrl = cfg.DOCS_URL || "/documentation.php?page=getting-started";
  var sym = cfg.GIFT_CURRENCY_SYMBOL || "€";
  var pBase = cfg.PLAN_PRICE_BASE || "7.99";
  var pStarter = cfg.GIFT_PRICE_STARTER || "11.99";
  var pPro = cfg.GIFT_PRICE_PRO || "14.99";
  var apiUrl = cfg.VST_API_URL || "";

  window._prices = {
    base: pBase,
    starter: pStarter,
    pro: pPro,
  };

  function setText(id, v) {
    var e = document.getElementById(id);
    if (e) e.textContent = v;
  }

  function setHref(id, u) {
    var e = document.getElementById(id);
    if (e && u !== "#") e.href = u;
  }

  setText("sidebar-plugin-name", pluginName.toUpperCase());
  setHref(
    "nav-download",
    githubUrl !== "#" ? githubUrl + "/releases/latest" : "#",
  );
  setHref("nav-support", githubIssues);

  var rb = githubUrl !== "#" ? githubUrl + "/releases/latest/download/" : "";

  function dlUrl(k, f) {
    return cfg[k] ? rb + cfg[k] : rb ? rb + f : "#";
  }
  var n = pluginName.replace(/ /g, "-");
  setHref("dl-windows", dlUrl("DOWNLOAD_WIN", n + "-Windows-VST3.zip"));
  setHref("dl-macos-vst3", dlUrl("DOWNLOAD_MAC_VST3", n + "-macOS-VST3.zip"));
  setHref("dl-macos-au", dlUrl("DOWNLOAD_MAC_AU", n + "-macOS-AU.zip"));
  setHref("dl-linux", dlUrl("DOWNLOAD_LINUX", n + "-Linux-VST3.tar.gz"));

  setHref("qa-docs", docsUrl);
  setHref("qa-support", githubIssues);
  setHref("qa-community", githubDiscuss);

  if (apiUrl) {
    var e = document.getElementById("server-url");
    if (e) e.textContent = apiUrl;
  }
  setText("sub-price-base", sym + pBase);
  setText("sub-price-starter", sym + pStarter);
  setText("sub-price-pro", sym + pPro);
})();
