<?php
$page_title = "Activate Your Gift — OBSIDIAN Neural";
$page_desc = "Activate your OBSIDIAN Neural subscription gift card. Instant activation, no auto-renewal.";
?>
<?php include('partials/shared/head.php'); ?>
<?php include('partials/shared/nav.php'); ?>
<?php include('partials/shared/activation-card.php'); ?>

<main class="relative z-20 pt-32 pb-24 px-4">
  <div class="max-w-6xl mx-auto">

    <?php include('partials/gift/activation-loading.php'); ?>

    <div id="activation-content" class="hidden">
      <?php include('partials/gift/activation-success.php'); ?>
      <?php include('partials/gift/activation-error.php'); ?>
    </div>

    <?php include('partials/gift/features.php'); ?>

  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/github-stats.js"></script>
<script src="js/config.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/api.js"></script>
<script src="js/gift-activate.js"></script>