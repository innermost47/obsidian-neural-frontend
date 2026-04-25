window.Confetti = (function () {
  const PRIMARY = [0.04, 0.75, 0.63];

  function burst(opts = {}) {
    confetti({
      particleCount: opts.count || 120,
      spread: opts.spread || 70,
      origin: opts.origin || { y: 0.6 },
      colors: opts.colors || ["#d96850", "#a04840", "#ffffff", "#ffcc99"],
      ...opts,
    });
  }

  function sides(opts = {}) {
    const count = opts.count || 60;
    // Canon gauche
    confetti({
      particleCount: count,
      angle: 60,
      spread: 55,
      origin: { x: 0, y: 0.65 },
      colors: ["#d96850", "#ffffff", "#ffcc99"],
    });
    confetti({
      particleCount: count,
      angle: 120,
      spread: 55,
      origin: { x: 1, y: 0.65 },
      colors: ["#d96850", "#ffffff", "#ffcc99"],
    });
  }

  function rain(duration = 3000, opts = {}) {
    const end = Date.now() + duration;
    const interval = setInterval(() => {
      if (Date.now() > end) {
        clearInterval(interval);
        return;
      }
      confetti({
        particleCount: opts.count || 6,
        startVelocity: opts.velocity || 0,
        ticks: opts.ticks || 200,
        origin: { x: Math.random(), y: 0 },
        colors: opts.colors || ["#d96850", "#a04840", "#ffffff", "#ffcc99"],
        gravity: opts.gravity || 0.5,
        ...opts,
      });
    }, opts.interval || 80);
    return interval;
  }

  function star(opts = {}) {
    const defaults = {
      spread: 360,
      ticks: 100,
      gravity: 0,
      decay: 0.94,
      startVelocity: 20,
    };
    confetti({
      ...defaults,
      ...opts,
      particleCount: opts.count || 40,
      origin: opts.origin || { x: 0.5, y: 0.5 },
      colors: opts.colors || ["#FFD700", "#FFA500", "#ffffff"],
      shapes: ["star"],
    });
  }

  function success() {
    burst({ count: 80, spread: 60, origin: { y: 0.7 } });
    setTimeout(() => sides({ count: 40 }), 200);
  }

  function custom(options) {
    return confetti(options);
  }

  return { burst, sides, rain, star, success, custom };
})();
