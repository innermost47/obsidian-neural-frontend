<?php
$page_title = "Dashboard - OBSIDIAN Neural";
include('partials/shared/head.php');
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script id="tinymce-script" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
  document.getElementById("tinymce-script").src =
    "https://cdn.tiny.cloud/1/" + (window.APP_CONFIG.TINYMCE_API_KEY || "") + "/tinymce/8/tinymce.min.js";
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
  .section-content {
    display: none;
  }

  .section-content.active {
    display: block;
    animation: fadeInUp 0.4s ease;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<script>
  window.gtagSendEvent = function(planName, planPrice) {
    return new Promise(function(resolve) {
      if (typeof gtag === "function") {
        gtag("event", "conversion_event_purchase", {
          transaction_id: "T_" + new Date().getTime(),
          value: planPrice,
          currency: "EUR",
          items: [{
            item_name: planName,
            price: planPrice,
            quantity: 1
          }],
          event_callback: function() {
            resolve();
          }
        });
        setTimeout(function() {
          resolve();
        }, 400);
      } else {
        resolve();
      }
    });
  };
  window.showSection = function(sectionId) {
    var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?section=" + sectionId;
    window.history.pushState({
      path: newUrl
    }, "", newUrl);
    document.querySelectorAll(".section-content").forEach(function(s) {
      s.classList.remove("active");
    });
    var t = document.getElementById("section-" + sectionId);
    if (t) t.classList.add("active");
    document.querySelectorAll(".nav-link[data-section]").forEach(function(l) {
      l.classList.remove("bg-gradient-to-r", "from-primary", "to-[#a04840]", "text-white", "shadow-[0_4px_12px_rgba(184,96,92,0.4)]");
      l.classList.add("text-white/70");
      if (l.getAttribute("data-section") === sectionId) {
        l.classList.add("bg-gradient-to-r", "from-primary", "to-[#a04840]", "text-white", "shadow-[0_4px_12px_rgba(184,96,92,0.4)]");
        l.classList.remove("text-white/70");
      }
    });
    window.scrollTo(0, 0);
  };
</script>

<div class="flex min-h-screen bg-[#0a0a0c] overflow-x-hidden">

  <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[1101] lg:hidden" onclick="toggleSidebar()"></div>

  <button onclick="toggleSidebar()" class="fixed top-4 right-4 z-[1102] lg:hidden w-12 h-12 bg-white/10 backdrop-blur-md border border-white/10 rounded-xl text-white flex items-center justify-center hover:scale-105 transition-transform">
    <i class="fas fa-bars"></i>
  </button>

  <?php include('partials/dashboard/sidebar.php'); ?>

  <main id="main-content" class="lg:ml-[280px] flex-1 min-h-screen">
    <?php include('partials/dashboard/section-overview.php'); ?>
    <?php include('partials/dashboard/section-subscription.php'); ?>
    <?php include('partials/dashboard/section-usage.php'); ?>
    <?php include('partials/dashboard/section-api.php'); ?>
    <?php include('partials/dashboard/section-security.php'); ?>
    <?php include('partials/dashboard/section-preferences.php'); ?>
    <?php include('partials/dashboard/section-gift.php'); ?>
    <?php include('partials/dashboard/section-provider-stats.php'); ?>
    <?php include('partials/dashboard/section-danger.php'); ?>
    <?php include('partials/dashboard/section-admin.php'); ?>
    <?php include('partials/dashboard/section-email-broadcast.php'); ?>
    <?php include('partials/dashboard/section-analytics.php'); ?>
    <?php include('partials/dashboard/section-providers.php'); ?>
    <?php include('partials/dashboard/section-email-logs.php'); ?>
  </main>

</div>

<?php include('partials/dashboard/modals.php'); ?>

<script src="js/config.js"></script>
<script src="js/api.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/dashboard-notifications.js"></script>
<script src="js/dashboard-subscription.js"></script>
<script src="js/dashboard-api.js"></script>
<script src="js/dashboard-admin.js"></script>
<script src="js/dashboard-providers.js"></script>
<script src="js/2fa.js"></script>
<script src="js/email-logs.js"></script>
<script src="js/email-broadcast.js"></script>
<script src="js/analytics.js"></script>
<script src="js/dashboard-core.js"></script>
<script src="js/dashboard-data.js"></script>