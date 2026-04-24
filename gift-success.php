<?php
$page_title = "Activate Your Gift - OBSIDIAN Neural";
$page_desc = "Activate your OBSIDIAN Neural subscription gift.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 pt-32 px-4">
  <?php include('partials/gift/header-success.php'); ?>
  <?php include('partials/gift/details-success.php'); ?>
  <?php include('partials/gift/features-success.php'); ?>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/components.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/api.js"></script>
<script>
  (function() {
    var cfg = window.APP_CONFIG || {};
    var siteName = cfg.SITE_NAME || "OBSIDIAN Neural";
    var subtitle = document.getElementById("hero-subtitle");
    if (subtitle) {
      subtitle.textContent = "Activate your " + siteName + " subscription gift below";
    }
  })();
</script>
<script src="js/gift-activate.js"></script>