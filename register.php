<?php
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main
  class="relative z-20 min-h-screen flex items-center justify-center px-4 py-32">
  <div class="w-full max-w-md">
    <?php include('partials/register/card.php'); ?>

    <div class="grid grid-cols-3 gap-3 mt-4">
      <div
        class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-3 py-3 flex items-center gap-2">
        <i class="fas fa-gift text-warning text-sm"></i>
        <span class="text-xs text-gray-400">20 Credits</span>
      </div>
      <div
        class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-3 py-3 flex items-center gap-2">
        <i class="fas fa-credit-card text-warning text-sm"></i>
        <span class="text-xs text-gray-400">No Card</span>
      </div>
      <div
        class="bg-white/[0.03] border border-white/[0.06] rounded-xl px-3 py-3 flex items-center gap-2">
        <i class="fas fa-bolt text-warning text-sm"></i>
        <span class="text-xs text-gray-400">Instant Access</span>
      </div>
    </div>

    <div
      class="mt-4 bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
      <h3 class="text-sm font-bold text-white text-center mb-4">
        <i class="fas fa-check-circle text-warning mr-2"></i>What you get with
        free credits
      </h3>
      <ul class="space-y-3">
        <li class="flex items-center gap-3 text-sm text-gray-400">
          <i class="fas fa-music text-warning text-xs w-4"></i>20 audio
          generations
        </li>
        <li class="flex items-center gap-3 text-sm text-gray-400">
          <i class="fas fa-brain text-warning text-xs w-4"></i>LLM prompt
          optimization
        </li>
        <li class="flex items-center gap-3 text-sm text-gray-400">
          <i class="fas fa-download text-danger text-xs w-4"></i>Full VST3
          plugin access
        </li>
      </ul>
    </div>
  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/api.js"></script>
<script src="js/register.js"></script>
<script src="js/cookie-consent.js"></script>