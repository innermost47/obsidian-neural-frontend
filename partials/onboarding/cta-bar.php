<div class="fixed bottom-0 left-0 right-0 bg-black/90 backdrop-blur-xl border-t border-white/[0.06] px-6 py-4 flex items-center justify-between gap-4 z-50">
    <div>
        <div class="text-white font-black tracking-tight font-mono text-sm" id="ctaPlanName">Starter — €11.99/mo</div>
        <div class="text-xs text-gray-500 mt-0.5" id="ctaPlanDetail">300 credits/month · cancel anytime</div>
    </div>
    <div class="flex items-center gap-4">
        <a class="text-sm text-gray-500 hover:text-white transition-colors cursor-pointer hidden sm:inline" id="ctaSkip" onclick="goToDashboard()">
            Continue with free plan
        </a>
        <button
            class="px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)] flex items-center gap-2"
            id="ctaBtn"
            onclick="handleCta()">
            <i class="fas fa-rocket text-sm" id="ctaBtnIcon"></i>
            <span id="ctaBtnText">Subscribe</span>
            <i class="fas fa-arrow-right text-xs opacity-70"></i>
        </button>
    </div>
</div>