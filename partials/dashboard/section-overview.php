<?php include_once('partials/dashboard/helpers.php'); ?>

<div id="section-overview" class="section-content active">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-th-large mr-3 text-primary"></i>Dashboard Overview</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Welcome back! Here's your account summary.</p>
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
                <p class="text-sm text-gray-400 mb-4">Download the latest version</p>
                <div class="space-y-2">
                    <a id="dl-windows" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-windows"></i>Windows — VST3</a>
                    <a id="dl-macos-vst3" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-apple"></i>macOS — VST3</a>
                    <a id="dl-macos-au" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-apple"></i>macOS — AU</a>
                    <a id="dl-linux" href="#" target="_blank" rel="noopener" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fab fa-linux"></i>Linux — VST3</a>
                    <button onclick="showSection('api')" class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-key"></i>Get your API key &amp; server URL</button>
                </div>
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
</div>