<?php
$page_title = "Verify Email - OBSIDIAN Neural";
$page_desc = "Verify your OBSIDIAN Neural email address to activate your account.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 min-h-screen flex items-center justify-center px-4 py-32">
  <div class="w-full max-w-md">
    <?php include('partials/verify-email/card.php'); ?>
  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/config.js"></script>
<script src="js/api.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/verify-email.js"></script>