(function () {
  var cfg = window.APP_CONFIG || {};
  var sym = cfg.GIFT_CURRENCY_SYMBOL || "€";
  var pBase = cfg.PLAN_PRICE_BASE || "7.99";
  var pStarter = cfg.GIFT_PRICE_STARTER || "11.99";
  var pPro = cfg.GIFT_PRICE_PRO || "14.99";
  var pluginName = cfg.PLUGIN_NAME || cfg.SITE_NAME || "OBSIDIAN NEURAL";

  var headerName = document.getElementById("header-plugin-name");
  if (headerName) headerName.textContent = pluginName.toUpperCase();

  var priceMap = {
    base: sym + pBase,
    starter: sym + pStarter,
    pro: sym + pPro,
  };
  Object.keys(priceMap).forEach(function (plan) {
    var wrapper = document.querySelector('[data-plan="' + plan + '"]');
    if (!wrapper) return;
    var priceEl = wrapper.querySelector(".text-4xl");
    if (priceEl) priceEl.textContent = priceMap[plan];
  });

  window._prices = { sym: sym, base: pBase, starter: pStarter, pro: pPro };

  var FEATURED_INNER = [
    "border-primary/40",
    "bg-gradient-to-b",
    "from-primary/10",
    "to-transparent",
    "hover:border-primary/60",
  ];
  var UNFEATURED_INNER = [
    "border-white/[0.06]",
    "hover:bg-white/[0.06]",
    "hover:border-white/[0.12]",
  ];
  var FEATURED_BADGE = ["bg-primary"];
  var UNFEATURED_BADGE = ["bg-white/5"];
  var FEATURED_BADGE_TXT = ["text-white"];
  var UNFEATURED_BADGE_TXT = ["text-gray-400"];

  var FEATURED_BTN = ["bg-white", "text-black", "hover:bg-gray-200"];
  var UNFEATURED_BTN = [
    "bg-white/5",
    "text-white",
    "border",
    "border-white/10",
    "hover:bg-white/10",
  ];

  function setFeatured(wrapper, on) {
    var inner = wrapper.querySelector(".rounded-2xl");
    var badge = wrapper.querySelector(".absolute.top-0");
    var badgeTxt = badge ? badge.querySelector("span") : null;
    var btn = wrapper.querySelector("a.block");

    if (on) {
      UNFEATURED_INNER.forEach(function (c) {
        inner && inner.classList.remove(c);
      });
      FEATURED_INNER.forEach(function (c) {
        inner && inner.classList.add(c);
      });
      UNFEATURED_BADGE.forEach(function (c) {
        badge && badge.classList.remove(c);
      });
      FEATURED_BADGE.forEach(function (c) {
        badge && badge.classList.add(c);
      });
      UNFEATURED_BADGE_TXT.forEach(function (c) {
        badgeTxt && badgeTxt.classList.remove(c);
      });
      FEATURED_BADGE_TXT.forEach(function (c) {
        badgeTxt && badgeTxt.classList.add(c);
      });
      UNFEATURED_BTN.forEach(function (c) {
        btn && btn.classList.remove(c);
      });
      FEATURED_BTN.forEach(function (c) {
        btn && btn.classList.add(c);
      });
    } else {
      FEATURED_INNER.forEach(function (c) {
        inner && inner.classList.remove(c);
      });
      UNFEATURED_INNER.forEach(function (c) {
        inner && inner.classList.add(c);
      });
      FEATURED_BADGE.forEach(function (c) {
        badge && badge.classList.remove(c);
      });
      UNFEATURED_BADGE.forEach(function (c) {
        badge && badge.classList.add(c);
      });
      FEATURED_BADGE_TXT.forEach(function (c) {
        badgeTxt && badgeTxt.classList.remove(c);
      });
      UNFEATURED_BADGE_TXT.forEach(function (c) {
        badgeTxt && badgeTxt.classList.add(c);
      });
      FEATURED_BTN.forEach(function (c) {
        btn && btn.classList.remove(c);
      });
      UNFEATURED_BTN.forEach(function (c) {
        btn && btn.classList.add(c);
      });
    }
  }

  function buildPlanMeta() {
    var p = window._prices;
    return {
      free: {
        label: "Free — " + p.sym + "0/mo",
        detail: "20 credits · no card required",
        btnText: "Get Started Free",
        btnIcon: "",
        skipVisible: false,
      },
      base: {
        label: "Base — " + p.sym + p.base + "/mo",
        detail: "150 credits/month · cancel anytime",
        btnText: "Subscribe",
        btnIcon: "fas fa-rocket",
        skipVisible: true,
      },
      starter: {
        label: "Starter — " + p.sym + p.starter + "/mo",
        detail: "300 credits/month · cancel anytime",
        btnText: "Subscribe",
        btnIcon: "fas fa-rocket",
        skipVisible: true,
      },
      pro: {
        label: "Pro — " + p.sym + p.pro + "/mo",
        detail: "500 credits/month · cancel anytime",
        btnText: "Subscribe",
        btnIcon: "fas fa-rocket",
        skipVisible: true,
      },
    };
  }

  var selectedPlan = "starter";

  window.selectPlan = function (plan) {
    document.querySelectorAll(".plan-option").forEach(function (el) {
      setFeatured(el, false);
      el.classList.remove("scale-[1.02]", "-translate-y-2");
    });

    selectedPlan = plan;
    var card = document.querySelector('[data-plan="' + plan + '"]');
    if (card) {
      setFeatured(card, true);
      card.classList.add("-translate-y-2");
    }

    var m = buildPlanMeta()[plan];
    function setTxt(id, val) {
      var e = document.getElementById(id);
      if (e) e.textContent = val;
    }
    setTxt("ctaPlanName", m.label);
    setTxt("ctaPlanDetail", m.detail);
    setTxt("ctaBtnText", m.btnText);

    var icon = document.getElementById("ctaBtnIcon");
    if (icon) icon.className = m.btnIcon + " text-sm";

    var skip = document.getElementById("ctaSkip");
    if (skip) skip.style.display = m.skipVisible ? "inline" : "none";
  };

  window.handleCta = async function () {
    if (selectedPlan === "free") {
      goToDashboard();
      return;
    }
    var btn = document.getElementById("ctaBtn");
    btn.disabled = true;
    btn.innerHTML =
      '<i class="fas fa-spinner animate-spin text-sm"></i><span>Preparing...</span>';
    try {
      var data = await API.createCheckout(selectedPlan);
      window.location.href = data.checkout_url;
    } catch (e) {
      console.error(e);
      btn.disabled = false;
      selectPlan(selectedPlan);
    }
  };

  window.goToDashboard = function () {
    window.location.href = "dashboard.php";
  };

  selectPlan("free");
})();
