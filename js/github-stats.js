class GitHubStats {
  constructor(repoPath) {
    this.repoPath = repoPath;
    this.cacheKey = "obsidian_github_stats_v3";
    this.cacheDuration = 3600000;
    this.starsElements = [
      document.getElementById("github-stars"),
      document.getElementById("github-stars-2"),
    ].filter(Boolean);
    this.downloadElements = [
      document.getElementById("github-downloads"),
      document.getElementById("github-downloads-2"),
    ].filter(Boolean);
    this.init();
  }

  async init() {
    const cached = localStorage.getItem(this.cacheKey);
    if (cached) {
      const { data, timestamp } = JSON.parse(cached);
      if (Date.now() - timestamp < this.cacheDuration) {
        this.updateStatsDisplay(data.stars, data.downloads);
        return;
      }
    }
    try {
      const stats = await this.fetchData();
      this.saveCache(stats);
      this.updateStatsDisplay(stats.stars, stats.downloads);
    } catch (error) {
      console.error("Error fetching GitHub stats:", error);
    }
  }

  async fetchData() {
    const repoRes = await fetch(
      `https://api.github.com/repos/${this.repoPath}`,
    );
    const repoData = await repoRes.json();
    const stars = repoData.stargazers_count;

    let totalDownloads = 0;
    let page = 1;
    let keepFetching = true;

    while (keepFetching) {
      const releasesRes = await fetch(
        `https://api.github.com/repos/${this.repoPath}/releases?per_page=100&page=${page}`,
      );
      const releasesData = await releasesRes.json();
      if (!Array.isArray(releasesData) || releasesData.length === 0) {
        keepFetching = false;
      } else {
        releasesData.forEach((release) => {
          release.assets.forEach((asset) => {
            totalDownloads += asset.download_count;
          });
        });
        keepFetching = releasesData.length === 100;
        page++;
      }
    }

    return { stars, downloads: totalDownloads };
  }

  saveCache(data) {
    localStorage.setItem(
      this.cacheKey,
      JSON.stringify({
        data,
        timestamp: Date.now(),
      }),
    );
  }

  updateStatsDisplay(stars, downloads) {
    const format = (num) =>
      num >= 1000 ? (num / 1000).toFixed(1) + "k+" : num + "+";
    this.starsElements.forEach((el) => (el.textContent = format(stars)));
    this.downloadElements.forEach((el) => (el.textContent = format(downloads)));
  }
}

function initGitHubStats() {
  const url = (window.APP_CONFIG && window.APP_CONFIG.GITHUB_STATS_URL) || "";
  const match = url.match(/repos\/(.+?)\/?$/);
  if (match) {
    new GitHubStats(match[1]);
  } else {
    console.warn("GITHUB_STATS_URL invalide ou manquante");
  }
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initGitHubStats);
} else {
  initGitHubStats();
}
