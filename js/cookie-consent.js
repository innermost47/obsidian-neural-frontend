(function () {
  const CONSENT_KEY = "cookie_consent";
  const cfg = window.APP_CONFIG || {};

  const VIDEO_MAP = {
    "yt-dnb": cfg.VIDEO_ID_DNB || "",
    "yt-aimla": cfg.VIDEO_ID_AIMLA || "",
    "yt-draw": cfg.VIDEO_ID_DRAW || "",
    "yt-beatcrafter": cfg.VIDEO_ID_BEATCRAFTER || "",
  };

  const YT_ALLOW =
    "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";

  function getConsent() {
    return localStorage.getItem(CONSENT_KEY);
  }

  function enableAnalytics() {
    if (window.analyticsEnabled) return;
    const GA_ID = cfg.GA_MEASUREMENT_ID || "";
    const GADS_ID = cfg.GADS_MEASUREMENT_ID || "";
    if (!GADS_ID && !GA_ID) return;
    window.analyticsEnabled = true;

    const script = document.createElement("script");
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${GADS_ID || GA_ID}`;
    script.onload = () => {
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      window.gtag = gtag;
      gtag("js", new Date());
      if (GADS_ID) gtag("config", GADS_ID);
      if (GA_ID) gtag("config", GA_ID);
    };
    document.body.appendChild(script);
  }

  function enableYouTube() {
    Object.keys(VIDEO_MAP).forEach(function (id) {
      const videoId = VIDEO_MAP[id];
      if (!videoId) return;

      const container = document.getElementById(id);
      if (!container || container.querySelector("iframe")) return;

      const iframe = document.createElement("iframe");
      iframe.src = `https://www.youtube-nocookie.com/embed/${videoId}`;
      iframe.title = container.dataset.title || "YouTube video";
      iframe.allowFullscreen = true;
      iframe.allow = YT_ALLOW;
      iframe.loading = "lazy";
      iframe.className = "absolute inset-0 w-full h-full rounded-3xl";

      container.innerHTML = "";
      container.appendChild(iframe);
    });
  }

  function showPlaceholders() {
    Object.keys(VIDEO_MAP).forEach(function (id) {
      const videoId = VIDEO_MAP[id];
      if (!videoId) return;

      const container = document.getElementById(id);
      if (!container || container.querySelector("iframe")) return;

      const title = container.dataset.title || "YouTube video";
      container.innerHTML = `
        <div class="absolute inset-0 bg-black/70 flex flex-col items-center justify-center text-center p-6 z-10 rounded-3xl">
          <i class="fab fa-youtube text-6xl text-danger mb-4"></i>
          <h4 class="font-bold text-xl mb-2">${title}</h4>
          <p class="text-sm text-gray-400 mb-4 max-w-sm">This video needs cookies to play.</p>
          <button type="button" class="accept-and-watch px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-white hover:text-black transition-colors">
            <i class="fas fa-cookie-bite mr-2"></i>Accept cookies to watch
          </button>
        </div>
      `;
      container
        .querySelector(".accept-and-watch")
        .addEventListener("click", acceptAll);
    });
  }

  function acceptAll() {
    localStorage.setItem(CONSENT_KEY, "accepted");
    enableAnalytics();
    enableYouTube();
    const banner = document.getElementById("cookie-consent-banner");
    if (banner) banner.remove();
  }

  function showBanner() {
    if (document.getElementById("cookie-consent-banner")) return;

    const banner = document.createElement("div");
    banner.id = "cookie-consent-banner";
    banner.className =
      "fixed bottom-0 inset-x-0 z-[9999] bg-black/90 backdrop-blur-xl border-t border-white/10 p-4";
    banner.innerHTML = `
      <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-300 text-center md:text-left">
          We use cookies to enhance your experience, including YouTube videos and analytics.
          Essential cookies are required for the site to function.
          <a href="cookie-policy.php" class="text-primary hover:underline">Learn more</a>
        </p>
        <div class="flex items-center gap-3 shrink-0">
          <button type="button" id="accept-cookies" class="px-5 py-2 rounded-full bg-primary text-white text-sm font-bold hover:bg-primary/80 transition-colors shadow-[0_0_15px_rgba(217,104,80,0.3)]">
            Accept all
          </button>
          <button type="button" id="reject-optional" class="px-5 py-2 rounded-full bg-white/5 border border-white/10 text-white text-sm font-bold hover:bg-white/10 transition-colors">
            Essential only
          </button>
        </div>
      </div>
    `;

    document.body.appendChild(banner);

    document
      .getElementById("accept-cookies")
      .addEventListener("click", acceptAll);

    document.getElementById("reject-optional").addEventListener("click", () => {
      localStorage.setItem(CONSENT_KEY, "essential_only");
      location.reload();
    });
  }

  function mountSettingsButton() {
    const button = document.createElement("button");
    button.type = "button";
    button.setAttribute("aria-label", "Cookie settings");
    button.title = "Cookie settings";
    button.className =
      "fixed bottom-6 left-6 z-[9998] w-10 h-10 rounded-full bg-white/5 border border-white/10 backdrop-blur-md flex items-center justify-center text-gray-500 hover:text-primary hover:bg-primary/10 hover:border-primary/30 transition-all text-sm";
    button.innerHTML = '<i class="fas fa-cookie-bite"></i>';
    button.addEventListener("click", () => {
      localStorage.removeItem(CONSENT_KEY);
      showBanner();
    });
    document.body.appendChild(button);
  }

  const consent = getConsent();
  if (consent === "accepted") {
    enableAnalytics();
    enableYouTube();
  } else if (consent === "essential_only") {
    showPlaceholders();
  } else {
    showBanner();
  }

  mountSettingsButton();

  window.enableYouTube = enableYouTube;
  window.showCookieBanner = showBanner;
})();
