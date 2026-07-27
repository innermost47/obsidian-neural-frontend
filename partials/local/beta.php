<div data-beta-block class="hidden flex flex-col items-center gap-4">
    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-track5/15 border border-track5/40 text-track5 text-xs font-bold uppercase tracking-wider">
        <i class="fas fa-flask"></i>Beta Access
    </span>
    <p data-beta-slots-wrapper class="hidden text-sm text-gray-300">
        <span data-beta-slots class="text-track5 font-bold text-lg">—</span>
        <span class="text-gray-400">/ 500 beta slots left</span>
    </p>
    <button data-beta-checkout
        class="px-6 py-6 rounded-xl bg-track5 text-white text-lg font-bold hover:scale-105 transition-transform shadow-[0_0_30px_rgba(180,150,90,0.4)] whitespace-nowrap disabled:opacity-60 disabled:cursor-not-allowed">
        <i class="fas fa-flask mr-2"></i>Become a Beta Tester
    </button>

    <div class="flex flex-col items-center gap-3">
        <div class="flex flex-wrap items-center justify-center gap-3 bg-black/20 border border-track5/30 rounded-xl p-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-gift text-track5"></i>
                <span class="text-xs text-gray-400">Promo code:</span>
                <span data-beta-code class="font-mono font-bold text-track5 tracking-wider"></span>
            </div>
            <button type="button" data-beta-code-copy class="text-xs font-bold text-track5 bg-track5/15 border border-track5/40 px-3 py-1.5 rounded-lg hover:bg-track5/25 transition-colors whitespace-nowrap">
                <i class="fas fa-copy mr-1"></i><span data-beta-code-copy-label>Copy</span>
            </button>
            <button type="button" data-beta-code-share class="text-xs font-bold text-track5 bg-track5/15 border border-track5/40 px-3 py-1.5 rounded-lg hover:bg-track5/25 transition-colors whitespace-nowrap">
                <i class="fas fa-share-nodes mr-1"></i>Share
            </button>
        </div>
        <p class="text-xs text-gray-500 leading-relaxed max-w-xs text-center">
            <i class="fas fa-circle-check text-success mr-1"></i>
            This code makes the plugin <span class="text-white font-semibold">free for life</span>.
            Click "Become a Beta Tester" and it's applied automatically on Stripe — no card form, nothing to type.
            <span class="text-track5 font-semibold">Know someone who'd love this?</span> Share the code below!
        </p>
    </div>
</div>