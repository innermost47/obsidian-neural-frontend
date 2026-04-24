(function () {
  var cfg = window.APP_CONFIG || {};
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "OBSIDIAN Neural";
  var authorAlias = cfg.AUTHOR_ALIAS || "InnerMost47";
  var conferenceTag = cfg.CONFERENCE_TAG || "AES AIMLA 2025";
  var githubUrl = cfg.GITHUB_URL || "#";
  var controllerUrl = cfg.CONTROLLER_GITHUB_URL || "#";
  var beatcrafterUrl = cfg.BEATCRAFTER_GITHUB_URL || "#";
  var kvraudioUrl = cfg.KVRAUDIO_URL || "#";
  var paperUrl = cfg.PAPER_URL || "#";

  function setHref(id, url) {
    var el = document.getElementById(id);
    if (el && url !== "#") el.href = url;
  }

  function setText(id, text) {
    var el = document.getElementById(id);
    if (el) el.textContent = text;
  }

  function setVideoId(id, vid) {
    var el = document.getElementById(id);
    if (el && vid) el.setAttribute("data-video-id", vid);
  }

  setHref("btn-download-plugin", githubUrl + "/releases/latest");
  setHref("btn-controller", controllerUrl);
  setHref("btn-controller-2", controllerUrl);
  setHref("btn-paper", paperUrl);
  setHref("card-paper-link", paperUrl);
  setHref("card-kvr-link", kvraudioUrl);
  setHref("card-github-link", githubUrl);
  setHref("btn-beatcrafter-dl", beatcrafterUrl + "/releases/latest");
  setHref("btn-beatcrafter-src", beatcrafterUrl);
  setHref(
    "provider-cta-contact",
    (cfg.SITE_URL || "") + "/contact.php?subject=partnership",
  );
  setHref("provider-cta-github", cfg.PROVIDER_GITHUB_URL || githubUrl);
  setHref("btn-cta-github", githubUrl);

  setText("conference-badge", "\u{1F3C6} Presented at " + conferenceTag);
  setText("aimla-title", conferenceTag + " Live Performance");
  setText("aimla-badge-text", conferenceTag + " — Late Breaking Demo");
  setText("card-conference-name", conferenceTag);
  setText("also-from-alias", authorAlias);
  setText("provider-section-plugin-name", pluginName);

  setVideoId("yt-dnb", cfg.VIDEO_ID_DNB || "");
  setVideoId("yt-aimla", cfg.VIDEO_ID_AIMLA || "");
  setVideoId("yt-draw", cfg.VIDEO_ID_DRAW || "");
})();

document.addEventListener("DOMContentLoaded", () => {
  const wrapper = document.getElementById("vst-wrapper");
  const vstConsole = document.getElementById("vst-console");
  const glare = document.getElementById("vst-glare");

  if (wrapper && vstConsole && glare) {
    wrapper.addEventListener("mousemove", (e) => {
      vstConsole.style.animation = "none";
      const rect = wrapper.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;
      const rotateX = (y - centerY) / 20 + 15;
      const rotateY = (centerX - x) / 20 - 10;
      vstConsole.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) rotateZ(0deg)`;
      const glareX = (x / rect.width) * 100;
      const glareY = (y / rect.height) * 100;
      glare.style.background = `radial-gradient(circle at ${glareX}% ${glareY}%, rgba(255,255,255,0.2) 0%, transparent 50%)`;
    });
    wrapper.addEventListener("mouseleave", () => {
      vstConsole.style.transform = `rotateX(20deg) rotateY(-15deg) rotateZ(2deg)`;
      vstConsole.style.animation = "float 6s ease-in-out infinite";
      glare.style.background = `radial-gradient(circle at 50% 50%, rgba(255,255,255,0.1) 0%, transparent 60%)`;
    });
  }

  gsap.registerPlugin(ScrollTrigger);

  gsap.utils.toArray(".gs-reveal").forEach((el, i) => {
    gsap.to(el, {
      opacity: 1,
      y: 0,
      x: 0,
      scale: 1,
      duration: 0.9,
      ease: "power3.out",
      scrollTrigger: {
        trigger: el,
        start: "top 85%",
        toggleActions: "play none none reverse",
      },
    });
  });

  gsap.to(".gs-card", {
    opacity: 1,
    y: 0,
    duration: 0.6,
    stagger: 0.08,
    ease: "back.out(1.2)",
    scrollTrigger: {
      trigger: ".gs-card",
      start: "top 85%",
    },
  });

  function init3DParallax(wrapperId, consoleId, glareId) {
    const w = document.getElementById(wrapperId);
    const c = document.getElementById(consoleId);
    const g = document.getElementById(glareId);
    if (!w || !c || !g) return;
    w.addEventListener("mousemove", (e) => {
      c.style.animation = "none";
      const rect = w.getBoundingClientRect();
      const x = e.clientX - rect.left,
        y = e.clientY - rect.top;
      const cx = rect.width / 2,
        cy = rect.height / 2;
      c.style.transform = `rotateX(${(y - cy) / 25 + 12}deg) rotateY(${(cx - x) / 25 - 8}deg) rotateZ(0deg)`;
      g.style.background = `radial-gradient(circle at ${(x / rect.width) * 100}% ${(y / rect.height) * 100}%, rgba(255,255,255,0.18) 0%, transparent 50%)`;
    });
    w.addEventListener("mouseleave", () => {
      c.style.transform = `rotateX(15deg) rotateY(-10deg) rotateZ(1deg)`;
      c.style.animation = c.style.animation;
      g.style.background = `radial-gradient(circle at 50% 50%, rgba(255,255,255,0.1) 0%, transparent 60%)`;
    });
  }
  init3DParallax(
    "controller-wrapper",
    "controller-console",
    "controller-glare",
  );
  init3DParallax(
    "beatcrafter-wrapper",
    "beatcrafter-console",
    "beatcrafter-glare",
  );
});
