document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  const sessionId = params.get("session_id");

  const loadingEl = document.getElementById("license-loading");
  const boxEl = document.getElementById("license-box");
  const errorEl = document.getElementById("license-error");
  const nextStepsEl = document.getElementById("next-steps");
  const keyEl = document.getElementById("license-key");
  const emailEl = document.getElementById("account-email");
  const copyBtn = document.getElementById("copy-key");

  if (!sessionId) {
    loadingEl.classList.add("hidden");
    errorEl.classList.remove("hidden");
    return;
  }

  let attempts = 0;
  const maxAttempts = 6;

  async function poll() {
    attempts++;
    try {
      const data = await API.getLicenseBySession(sessionId);
      if (data.ready) {
        loadingEl.classList.add("hidden");
        keyEl.textContent = data.license_key;
        if (emailEl) emailEl.textContent = data.email;
        boxEl.classList.remove("hidden");
        nextStepsEl.classList.remove("hidden");
        setupDownloads(sessionId);
        return;
      }
    } catch (e) {
      console.error("License fetch error:", e);
    }

    if (attempts >= maxAttempts) {
      loadingEl.classList.add("hidden");
      errorEl.classList.remove("hidden");
      nextStepsEl.classList.remove("hidden");
      return;
    }

    setTimeout(poll, 2000);
  }

  poll();

  copyBtn.addEventListener("click", () => {
    navigator.clipboard.writeText(keyEl.textContent).then(() => {
      const original = copyBtn.innerHTML;
      copyBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
      setTimeout(() => {
        copyBtn.innerHTML = original;
      }, 2000);
    });
  });

  function detectOS() {
    const ua = navigator.userAgent.toLowerCase();
    const platform = (navigator.platform || "").toLowerCase();
    if (platform.includes("win") || ua.includes("windows")) return "windows";
    if (platform.includes("mac") || ua.includes("mac os")) return "macos";
    if (platform.includes("linux") || ua.includes("linux")) return "linux";
    return null;
  }

  function setupDownloads(sessionId) {
    const map = {
      windows: document.getElementById("dl-windows"),
      macos: document.getElementById("dl-macos"),
      linux: document.getElementById("dl-linux"),
    };

    Object.entries(map).forEach(([platform, el]) => {
      if (el) el.href = API.getLocalDownloadUrl(sessionId, platform);
    });

    const detected = detectOS();
    if (detected && map[detected]) {
      const el = map[detected];
      el.classList.remove("bg-white/5", "border-white/10");
      el.classList.add("bg-track5", "border-track5", "text-white");
      el.insertAdjacentHTML(
        "beforeend",
        '<span class="text-xs opacity-80 ml-1">(your system)</span>',
      );
    }
  }
});
