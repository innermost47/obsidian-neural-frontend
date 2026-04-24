<?php
$page_title = "Forgot Password - OBSIDIAN Neural";
$page_desc = "Reset your OBSIDIAN Neural password. We'll send you a secure link to create a new password.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 min-h-screen flex items-center justify-center px-4 py-32">
  <div class="w-full max-w-md">

    <?php include('partials/forgot-password/card.php'); ?>

    <div class="mt-4 bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
      <h3 class="text-sm font-bold text-white text-center mb-4">
        <i class="fas fa-shield-alt text-success mr-2"></i>Security Tips
      </h3>
      <ul class="space-y-3">
        <li class="flex items-center gap-3 text-sm text-gray-400">
          <i class="fas fa-check text-success text-xs w-4"></i>Reset link expires in 1 hour
        </li>
        <li class="flex items-center gap-3 text-sm text-gray-400">
          <i class="fas fa-check text-success text-xs w-4"></i>Check your spam folder if needed
        </li>
        <li class="flex items-center gap-3 text-sm text-gray-400">
          <i class="fas fa-check text-success text-xs w-4"></i>Link can only be used once
        </li>
      </ul>
    </div>

  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/api.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/forgot-password.js"></script>