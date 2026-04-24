<?php
$page_title = "Choose Your Plan - OBSIDIAN Neural";
$page_desc = "Choose your OBSIDIAN Neural plan and start generating AI music.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/pricing-card.php'); ?>

<main class="min-h-screen pb-32 px-4 pt-24">
  <?php include('partials/onboarding/nav.php'); ?>
  <?php
  include('partials/onboarding/header.php'); ?>
  <?php
  include('partials/onboarding/plans.php'); ?>
  <?php
  include('partials/onboarding/trust-bar.php'); ?>
  <?php
  include('partials/onboarding/cta-bar.php'); ?>
</main>

<script src="js/config.js"></script>
<script src="js/api.js"></script>
<script src="js/onboarding.js"></script>

</body>

</html>