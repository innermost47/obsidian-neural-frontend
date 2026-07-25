<?php include_once('partials/dashboard/helpers.php'); ?>

<div id="section-overview" class="section-content active">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-th-large mr-3 text-primary"></i>Dashboard Overview</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Welcome back! Here's your account summary.</p>
    </div>
    <div class="px-6 lg:px-12 py-3 border-b border-white/[0.06]">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-sm text-gray-400">
            <i class="fas fa-cloud text-primary"></i>
            <span>No GPU required — AI generation runs in the cloud on our servers</span>
        </div>
    </div>

    <div class="px-6 lg:px-12 pt-6">
        <button onclick="showSection('api')" class="w-full flex items-center justify-between gap-4 px-6 py-4 rounded-2xl bg-track2/[0.08] border border-track2/30 hover:bg-track2/[0.15] transition-colors text-left">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-track2/20 text-track2 flex items-center justify-center text-lg shrink-0"><i class="fas fa-key"></i></div>
                <div>
                    <p class="text-sm font-bold text-white m-0">Your API key &amp; server URL</p>
                    <p class="text-xs text-gray-500 m-0">Needed to connect the plugin — get them here</p>
                </div>
            </div>
            <i class="fas fa-arrow-right text-track2 shrink-0"></i>
        </button>
    </div>

    <div class="px-6 lg:px-12 mt-3">
        <button id="overview-license-link" onclick="showSection('api')" class="hidden w-full items-center justify-between gap-4 px-6 py-4 rounded-2xl bg-track5/[0.08] border border-track5/30 hover:bg-track5/[0.15] transition-colors text-left">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-xl bg-track5/20 text-track5 flex items-center justify-center text-lg shrink-0"><i class="fas fa-microchip"></i></div>
                <div>
                    <p class="text-sm font-bold text-white m-0">Your Local Edition license key</p>
                    <p class="text-xs text-gray-500 m-0">Paste it in the plugin to activate offline mode — get it here</p>
                </div>
            </div>
            <i class="fas fa-arrow-right text-track5 shrink-0"></i>
        </button>
    </div>

    <div class="p-6 lg:p-12">

        <div id="email-verification-card" class="hidden mb-6">
            <div class="bg-danger/10 border border-danger/30 rounded-2xl p-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-danger/20 text-danger flex items-center justify-center shrink-0"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="flex-1">
                    <h5 class="text-danger font-bold mb-2"><i class="fas fa-envelope mr-2"></i>Email Verification Required</h5>
                    <p class="text-sm text-gray-400 mb-3"><strong class="text-white">Your account is restricted.</strong> You must verify your email address to access all features:</p>
                    <ul class="text-sm text-gray-500 mb-4 space-y-1 list-disc list-inside">
                        <li>Generate audio with the VST plugin</li>
                        <li>Purchase or upgrade subscriptions</li>
                        <li>Access premium features</li>
                    </ul>
                    <div class="flex flex-wrap gap-3">
                        <button onclick="resendVerificationEmail()" class="px-4 py-2 rounded-xl bg-warning text-black font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fas fa-paper-plane mr-2"></i>Resend Verification Email</button>
                        <button onclick="window.location.reload()" class="px-4 py-2 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-sync mr-2"></i>I've Verified - Refresh</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

            <div class="relative bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 overflow-hidden hover:-translate-y-1 hover:border-primary/40 transition-all duration-300">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-crown"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Subscription</h6>
                </div>
                <div class="text-2xl font-black text-white mb-2" id="subscription-tier">Loading...</div>
                <div id="subscription-status"></div>
                <div id="subscription-actions" class="mt-3"></div>
            </div>

            <div class="relative bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 overflow-hidden hover:-translate-y-1 hover:border-primary/40 transition-all duration-300">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-bolt"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Credits Remaining</h6>
                </div>
                <div class="text-2xl font-black text-white mb-3" id="credits-remaining">—</div>
                <div class="h-1.5 rounded-full bg-white/5 mb-2 overflow-hidden">
                    <div id="credits-progress" class="h-full bg-gradient-to-r from-primary to-[#a04840] rounded-full transition-all" style="width:0%"></div>
                </div>
                <p class="text-xs text-gray-600"><span id="credits-used">—</span> / <span id="credits-total">—</span> used</p>
            </div>

            <div class="relative bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 overflow-hidden hover:-translate-y-1 hover:border-primary/40 transition-all duration-300">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-download"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Plugin</h6>
                </div>
                <p class="text-sm text-gray-400 mb-4">
                    Download the latest version<span id="local-build-current" class="hidden text-track5 font-bold"></span>
                </p>

                <div id="download-opensource" class="space-y-2">
                    <a id="dl-windows" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-windows"></i>Windows — VST3</a>
                    <a id="dl-windows-stdln" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-windows"></i>Windows — Standalone</a>
                    <a id="dl-macos-vst3" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-apple"></i>macOS — VST3</a>
                    <a id="dl-macos-au" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-apple"></i>macOS — AU</a>
                    <a id="dl-macos-stdln" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-apple"></i>macOS — Standalone</a>
                    <a id="dl-linux" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-linux"></i>Linux — VST3</a>
                    <a id="dl-linux-stdln" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-linux"></i>Linux — Standalone</a>
                </div>

                <div id="download-local" class="hidden space-y-2">
                    <p class="text-xs text-track5 font-bold mb-1"><i class="fas fa-microchip mr-1"></i>Local Edition installers</p>
                    <a data-local-dl="windows" href="#" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-track5 text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-windows"></i>Windows installer (.exe)</a>
                    <a data-local-dl="macos" href="#" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-track5 text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-apple"></i>macOS installer (.pkg)</a>
                    <a data-local-dl="linux" href="#" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-track5 text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-linux"></i>Linux installer (.tar.gz)</a>
                    <button id="open-versions-modal" type="button" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl border border-white/20 text-white/80 font-bold text-sm hover:bg-white/5 transition-colors">
                        <i class="fas fa-clock-rotate-left"></i>Previous versions
                    </button>
                </div>
                <p id="download-local-error" class="hidden text-xs text-danger mt-2"></p>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
            <h3 class="text-base font-bold text-white mb-5"><i class="fas fa-rocket mr-2 text-primary"></i>Quick Actions</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a id="qa-support" href="#" target="_blank" class="flex flex-col items-center gap-2 p-4 bg-white/[0.03] border border-white/[0.06] rounded-xl hover:bg-white/[0.06] hover:border-primary/30 transition-all text-center">
                    <i class="fas fa-life-ring text-2xl text-primary"></i>
                    <span class="text-sm font-bold text-white">Get Support</span>
                    <span class="text-xs text-gray-500">Report issues or ask questions</span>
                </a>
                <a id="qa-community" href="#" target="_blank" class="flex flex-col items-center gap-2 p-4 bg-white/[0.03] border border-white/[0.06] rounded-xl hover:bg-white/[0.06] hover:border-primary/30 transition-all text-center">
                    <i class="fab fa-github text-2xl text-primary"></i>
                    <span class="text-sm font-bold text-white">Join Community</span>
                    <span class="text-xs text-gray-500">Connect with other users</span>
                </a>
                <a href="#" onclick="showSection('api')" class="flex flex-col items-center gap-2 p-4 bg-white/[0.03] border border-white/[0.06] rounded-xl hover:bg-white/[0.06] hover:border-primary/30 transition-all text-center">
                    <i class="fas fa-key text-2xl text-primary"></i>
                    <span class="text-sm font-bold text-white">API Configuration</span>
                    <span class="text-xs text-gray-500">Get your API key &amp; server URL</span>
                </a>
            </div>
        </div>

    </div>
    <dialog id="versions-modal" class="p-0 bg-transparent backdrop:bg-black/70 backdrop:backdrop-blur-sm max-w-2xl w-[calc(100%-2rem)]">
        <div class="flex flex-col max-h-[80vh] bg-[#0a0a0c] border border-white/[0.08] rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b border-white/[0.06] shrink-0">
                <div>
                    <h3 class="text-lg font-bold text-white m-0"><i class="fas fa-clock-rotate-left mr-2 text-track5"></i>Previous versions</h3>
                    <p class="text-xs text-gray-500 mt-1 mb-0">Download an earlier build of the Local Edition.</p>
                </div>
                <button id="close-versions-modal" type="button" class="w-9 h-9 rounded-xl border border-white/10 text-gray-400 hover:text-white hover:bg-white/5 transition-colors shrink-0">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="versions-modal-body" class="overflow-y-auto px-6 py-5 space-y-3"></div>
            <p id="versions-modal-error" class="hidden px-6 pb-5 text-xs text-danger shrink-0"></p>
        </div>
    </dialog>
</div>