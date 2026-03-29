async function fetchGitHubStats() {
  const CACHE_KEY = "obsidian_github_stats";
  const CACHE_DURATION = 3600000;

  const cached = localStorage.getItem(CACHE_KEY);
  if (cached) {
    const { data, timestamp } = JSON.parse(cached);
    if (Date.now() - timestamp < CACHE_DURATION) {
      updateStarsDisplay(data.stargazers_count);
      return;
    }
  }

  try {
    const response = await fetch(window.APP_CONFIG.GITHUB_STATS_URL, {
      headers: {
        Accept: "application/vnd.github.v3+json",
      },
    });

    if (!response.ok) throw new Error("API request failed");

    const data = await response.json();

    localStorage.setItem(
      CACHE_KEY,
      JSON.stringify({
        data: { stargazers_count: data.stargazers_count },
        timestamp: Date.now(),
      }),
    );

    updateStarsDisplay(data.stargazers_count);
  } catch (error) {
    console.error("Error fetching GitHub stats:", error);
    updateStarsDisplay(120);
  }
}

function updateStarsDisplay(count) {
  const starsElement = document.getElementById("github-stars");
  if (starsElement) {
    const formatted =
      count >= 1000 ? (count / 1000).toFixed(1) + "k+" : count + "+";
    starsElement.textContent = formatted;
  }
  const starsElement2 = document.getElementById("github-stars-2");
  if (starsElement2) {
    const formatted =
      count >= 1000 ? (count / 1000).toFixed(1) + "k+" : count + "+";
    starsElement2.textContent = formatted;
  }
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", fetchGitHubStats);
} else {
  fetchGitHubStats();
}
