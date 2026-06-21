<?php
$page_title = "Thank You — OBSIDIAN Neural Local Edition";
$page_desc = "Your OBSIDIAN Neural Local Edition purchase is confirmed.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>
<main class="relative z-20 pt-32 pb-24 px-4 min-h-screen">
    <div class="max-w-2xl mx-auto">

        <div class="text-center mb-10">
            <div class="w-16 h-16 rounded-full bg-success/20 text-success flex items-center justify-center text-3xl mb-6 mx-auto">
                <i class="fas fa-check"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tighter mb-4" style="padding-bottom: 0.15em;">
                Payment confirmed.
            </h1>
            <p class="text-gray-400 text-lg">
                Welcome aboard! Your license key is ready below — and we've also emailed it to you.
            </p>
        </div>

        <div id="license-loading" class="bg-white/5 border border-white/10 rounded-2xl p-8 text-center">
            <i class="fas fa-circle-notch fa-spin text-track5 text-2xl mb-3"></i>
            <p class="text-gray-400 text-sm">Finalizing your purchase…</p>
        </div>

        <div id="license-box" class="hidden bg-gradient-to-br from-track5/10 to-transparent border border-track5/30 rounded-2xl p-8 mb-8">
            <p class="text-xs uppercase tracking-wider text-gray-500 mb-2">Your license key</p>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <code id="license-key" class="flex-1 text-2xl font-bold text-track5 bg-black/40 rounded-xl px-5 py-4 text-center tracking-wider"></code>
                <button id="copy-key" class="px-5 py-4 rounded-xl bg-track5 text-white font-bold hover:scale-105 transition-transform whitespace-nowrap">
                    <i class="fas fa-copy mr-2"></i>Copy
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-3">
                <i class="fas fa-envelope mr-1"></i>A copy is also in your inbox — keep it safe.
            </p>
        </div>

        <div id="license-error" class="hidden bg-white/5 border border-danger/30 rounded-2xl p-8 text-center mb-8">
            <i class="fas fa-circle-exclamation text-danger text-2xl mb-3"></i>
            <p class="text-gray-300 text-sm mb-1">Your payment went through, but the key is taking a moment to generate.</p>
            <p class="text-gray-500 text-sm">Check your email in a minute — it'll be there. Still nothing? Just reply to the email or contact us.</p>
        </div>

        <div id="next-steps" class="hidden">
            <h2 class="text-2xl font-extrabold tracking-tight mb-6 text-center">Next steps</h2>
            <div class="flex flex-col gap-4">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                    <div class="flex items-start gap-4 mb-4">
                        <span class="w-9 h-9 shrink-0 rounded-full bg-track5/20 text-track5 flex items-center justify-center font-extrabold text-sm">1</span>
                        <div>
                            <h3 class="font-bold text-white mb-1">Download the plugin</h3>
                            <p class="text-sm text-gray-400">Pick your platform — we've preselected yours. The link is also in your email if you bought from your phone.</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 sm:pl-13">
                        <a id="dl-windows" href="#" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors font-bold text-sm">
                            <i class="fab fa-windows"></i>Windows
                        </a>
                        <a id="dl-macos" href="#" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors font-bold text-sm">
                            <i class="fab fa-apple"></i>macOS
                        </a>
                        <a id="dl-linux" href="#" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors font-bold text-sm">
                            <i class="fab fa-linux"></i>Linux
                        </a>
                    </div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 flex items-start gap-4">
                    <span class="w-9 h-9 shrink-0 rounded-full bg-track5/20 text-track5 flex items-center justify-center font-extrabold text-sm">2</span>
                    <div>
                        <h3 class="font-bold text-white mb-1">Activate &amp; download the model</h3>
                        <p class="text-sm text-gray-400">Open the plugin, paste your key, then let it download Stable Audio 3 Medium. Both need internet once — after that, you're fully offline.</p>
                    </div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 flex items-start gap-4">
                    <span class="w-9 h-9 shrink-0 rounded-full bg-track5/20 text-track5 flex items-center justify-center font-extrabold text-sm">3</span>
                    <div>
                        <h3 class="font-bold text-white mb-1">Set up account access (optional)</h3>
                        <p class="text-sm text-gray-400 mb-3">Want to back up your key online or manage your machines? Set a password for your account — it's already linked to <span id="account-email" class="text-track5"></span>.</p>
                        <a href="forgot-password.php" class="inline-flex px-5 py-2.5 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 transition-colors text-sm font-bold">
                            <i class="fas fa-key mr-2 mt-0.5"></i>Set up my account
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<?php include('partials/shared/footer.php'); ?>
<script src="js/api.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/vst-success.js"></script>