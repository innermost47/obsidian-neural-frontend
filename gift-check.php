<?php
$page_title = "Check Gift Code — OBSIDIAN Neural";
$page_desc = "Check your OBSIDIAN Neural gift card status and activate it instantly.";

include('partials/shared/head.php');
include('partials/shared/nav.php');

include('partials/gift/check-form.php');
?>

<main class="relative z-20 pt-32 pb-24 px-4">
  <div class="max-w-6xl mx-auto">

    <?php render_gift_check_form('Check Gift Code', 'fas fa-search'); ?>

    <div id="check-content" class="hidden">
      <?php include('partials/gift/check-result.php'); ?>
      <?php include('partials/gift/check-error.php'); ?>
    </div>

  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/github-stats.js"></script>
<script src="js/config.js"></script>
<script src="js/api.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/gift-check.js"></script>