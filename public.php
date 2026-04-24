<?php
$page_title = "Public Network Data — OBSIDIAN Neural";
$page_desc = "Live network stats, proof-of-generation logs and financial transparency reports for the OBSIDIAN Neural distributed GPU network.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 pt-32 pb-24 px-4">
  <div class="max-w-6xl mx-auto">
    <?php include('partials/public-dashboard/header.php'); ?>
    <?php include('partials/public-dashboard/stats.php'); ?>
    <?php include('partials/public-dashboard/tabs.php'); ?>
    <?php include('partials/public-dashboard/panel-ownership.php'); ?>
    <?php include('partials/public-dashboard/panel-network.php'); ?>
    <?php include('partials/public-dashboard/panel-finances.php'); ?>
    <?php include('partials/public-dashboard/privacy-notice.php'); ?>
  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/config.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/public-dashboard.js"></script>