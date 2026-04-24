<?php
$page_title = "Access Granted - OBSIDIAN Neural";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main
  class="relative z-20 min-h-screen flex items-center justify-center px-4 py-32">
  <div class="w-full max-w-xl text-center">

    <div
      class="w-20 h-20 rounded-3xl bg-success/20 text-success flex items-center justify-center text-3xl mx-auto mb-6 shadow-[0_0_30px_rgba(40,200,64,0.15)]">
      <i class="fas fa-check"></i>
    </div>

    <h1
      class="text-4xl md:text-5xl font-black tracking-tighter text-primary mb-2 font-mono">
      ACCESS GRANTED
    </h1>
    <p class="text-gray-500 mb-8">Your Press VIP account is now active.</p>

    <div
      class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 text-left relative overflow-hidden">
      <div
        class="absolute -top-16 -right-16 w-48 h-48 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

      <div class="flex items-center gap-2 mb-6">
        <div class="w-3 h-3 rounded-full bg-primary"></div>
        <div class="w-3 h-3 rounded-full bg-white/10"></div>
        <div class="w-3 h-3 rounded-full bg-white/10"></div>
      </div>

      <div class="space-y-6 relative z-10">
        <div class="flex items-start gap-4">
          <i
            class="fas fa-envelope-open-text text-primary text-xl mt-0.5 shrink-0"></i>
          <div>
            <p class="font-bold text-white mb-1">Check your inbox</p>
            <p class="text-sm text-gray-500">
              We've sent your <strong class="text-gray-300">API Key</strong> and
              the Press Kit download links. It should arrive within 5 minutes.
            </p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <i class="fas fa-plug text-primary text-xl mt-0.5 shrink-0"></i>
          <div>
            <p class="font-bold text-white mb-1">Install the Plugin</p>
            <p class="text-sm text-gray-500">
              Download the VST3/AU version for your OS and move it to your
              plugin folder.
            </p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <i class="fas fa-key text-primary text-xl mt-0.5 shrink-0"></i>
          <div>
            <p class="font-bold text-white mb-1">Activate with API Key</p>
            <p class="text-sm text-gray-500" id="activate-desc">
              Paste your unique key directly into the plugin interface to unlock
              your 200 credits.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/config.js"></script>
<script src="js/press-success.js"></script>