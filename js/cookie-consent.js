(function () {
  const CONSENT_KEY = "cookie_consent";
  const cfg = window.APP_CONFIG || {};
  const GA_ID = cfg.GA_MEASUREMENT_ID || "";
  const GADS_ID = cfg.GADS_MEASUREMENT_ID || "";

  function hasConsent() {
    return localStorage.getItem(CONSENT_KEY) === "accepted";
  }

  function showBanner() {
    if (localStorage.getItem(CONSENT_KEY)) return;
    const banner = document.createElement("div");
    banner.id = "cookie-consent-banner";
    banner.className =
      "position-fixed bottom-0 start-0 end-0 bg-black border-top border-secondary p-3";
    banner.style.zIndex = "9999";
    banner.style.maxWidth = "100vw";
    banner.innerHTML = `
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <p class="mb-2 mb-md-0 text-white">
              We use cookies to enhance your experience, including YouTube videos and analytics.
              Essential cookies are required for the site to function.
              <a href="cookie-policy.html" class="text-primary">Learn more</a>
            </p>
          </div>
          <div class="col-md-4 text-md-end">
            <button id="accept-cookies" class="btn btn-primary btn-sm me-2">Accept All</button>
            <button id="reject-optional" class="btn btn-outline-light btn-sm">Essential Only</button>
          </div>
        </div>
      </div>
    `;
    document.body.appendChild(banner);
    document.getElementById("accept-cookies").addEventListener("click", () => {
      localStorage.setItem(CONSENT_KEY, "accepted");
      enableAnalytics();
      enableYouTube();
      banner.remove();
    });
    document.getElementById("reject-optional").addEventListener("click", () => {
      localStorage.setItem(CONSENT_KEY, "essential_only");
      banner.remove();
    });
  }

  function enableAnalytics() {
    if (window.analyticsEnabled) return;
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
    const placeholders = document.querySelectorAll(".youtube-placeholder");
    placeholders.forEach((placeholder) => {
      const videoId = placeholder.dataset.videoId;
      const title = placeholder.dataset.title || "YouTube video";
      const iframe = document.createElement("iframe");
      iframe.src = `https://www.youtube.com/embed/${videoId}`;
      iframe.title = title;
      iframe.allowFullscreen = true;
      iframe.allow =
        "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
      iframe.style.width = "100%";
      iframe.style.height = "100%";
      placeholder.parentNode.replaceChild(iframe, placeholder);
    });
  }

  function createYouTubePlaceholder(videoId, title) {
    const thumbnailUrl = `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`;
    const placeholder = document.createElement("div");
    placeholder.className = "youtube-placeholder";
    placeholder.dataset.videoId = videoId;
    placeholder.dataset.title = title;
    placeholder.style.cssText = `
      position: relative; width: 100%; height: 100%;
      background: #000 url('${thumbnailUrl}') center/cover no-repeat;
      cursor: pointer; display: flex; align-items: center; justify-content: center;
    `;
    placeholder.innerHTML = `
      <div style="background:rgba(0,0,0,.8);color:white;padding:2rem;border-radius:1rem;text-align:center;max-width:400px;">
        <i class="fab fa-youtube" style="font-size:3rem;color:#FF0000;margin-bottom:1rem;"></i>
        <h4 style="margin-bottom:1rem;">YouTube Video</h4>
        <p style="margin-bottom:1.5rem;font-size:.9rem;">This content requires cookies to be displayed.</p>
        <button class="btn btn-primary" onclick="document.getElementById('accept-cookies')?.click() || location.reload()">
          Accept Cookies to Watch
        </button>
      </div>
    `;
    return placeholder;
  }

  if (hasConsent()) {
    enableAnalytics();
    enableYouTube();
  } else if (!localStorage.getItem(CONSENT_KEY)) {
    showBanner();
  }

  window.createYouTubePlaceholder = createYouTubePlaceholder;
  window.enableYouTube = enableYouTube;
})();

(function () {
  const CONSENT_KEY = "cookie_consent";
  const button = document.createElement("button");
  button.id = "cookie-settings-btn";
  button.className = "cookie-settings-floating";
  button.title = "Cookie Settings";
  button.innerHTML = '<i class="fas fa-cookie-bite"></i>';
  button.onclick = function () {
    localStorage.removeItem(CONSENT_KEY);
    const oldBanner = document.getElementById("cookie-consent-banner");
    if (oldBanner) oldBanner.remove();
    location.reload();
  };
  document.body.appendChild(button);
})();
