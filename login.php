<?php
$page_title = "Login - OBSIDIAN Neural | Access Your Dashboard";
$page_desc = "Log in to your OBSIDIAN Neural account to access your API key and manage your audio generation credits.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 min-h-screen flex items-center justify-center px-4 py-32">
  <div class="w-full max-w-md">

    <?php include('partials/login/card.php'); ?>

    <div class="grid grid-cols-2 gap-3 mt-4">
      <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3 flex items-center gap-2">
        <i class="fas fa-bolt text-warning text-sm"></i>
        <span class="text-xs text-gray-400">Instant Access</span>
      </div>
      <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3 flex items-center gap-2">
        <i class="fas fa-shield-alt text-success text-sm"></i>
        <span class="text-xs text-gray-400">Secure Login</span>
      </div>
    </div>

  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/config.js"></script>
<script src="js/api.js"></script>
<script src="js/login.js"></script>
<script src="js/cookie-consent.js"></script>