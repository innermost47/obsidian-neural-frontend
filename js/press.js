(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "OBSIDIAN Neural";
  var conferenceTag = cfg.CONFERENCE_TAG || "AES AIMLA 2025";
  var paperUrl = cfg.PAPER_URL || "#";
  var githubUrl = cfg.GITHUB_URL || "#";
  var authorAlias = cfg.AUTHOR_ALIAS || "";

  var heroDesc = document.getElementById("hero-desc");
  if (heroDesc)
    heroDesc.textContent =
      pluginName +
      " featured across international music production communities and tech publications";

  var aimlaHeading = document.getElementById("aimla-heading");
  if (aimlaHeading)
    aimlaHeading.textContent =
      conferenceTag + " - Queen Mary University London";

  var paperLink = document.getElementById("paper-link");
  if (paperLink && paperUrl !== "#") paperLink.href = paperUrl;

  var note = document.getElementById("community-note");
  if (note) {
    note.innerHTML =
      '<i class="fas fa-info-circle mr-2 text-gray-600"></i><strong class="text-gray-400">Note:</strong> All articles are from independent publications. ' +
      pluginName +
      " is an open-source project" +
      (authorAlias
        ? ' by <a href="' +
          githubUrl +
          '" target="_blank" class="text-primary hover:underline">' +
          authorAlias +
          "</a>."
        : ".");
  }
})();
