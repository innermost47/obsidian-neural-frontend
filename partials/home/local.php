<section class="relative z-20 py-24 px-4" id="local-version"
    style="background: radial-gradient(ellipse at 20% 50%, rgba(180,150,90,0.06) 0%, transparent 60%);">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-track5/10 border border-track5/30 text-sm text-track5 font-bold mb-6 gs-reveal opacity-0 translate-y-6">
                <i class="fas fa-microchip"></i>
                New — Local Edition
            </span>
            <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-3 gs-reveal opacity-0 translate-y-6">
                YOUR MACHINE.<br />YOUR RULES.
            </h2>
            <p class="text-base md:text-lg font-medium text-track5 mb-6 gs-reveal opacity-0 translate-y-6">
                Welcome to the off-grid crew.
            </p>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto gs-reveal opacity-0 translate-y-6">
                Stable Audio 3 Medium runs straight on your CPU — no GPU required. No cloud, no account, no subscription.
                No internet? <strong class="text-white">It still runs.</strong>
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white/5 backdrop-blur-md border border-track5/20 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div class="w-12 h-12 rounded-xl bg-track5/20 text-track5 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-microchip"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Runs On Your CPU — No GPU Needed</h3>
                <p class="text-sm text-gray-400">
                    Stable Audio 3 Medium runs on your processor, not a graphics card. ~11s per generation on a recent laptop CPU, alongside a full DAW session. No internet, no signal, no problem.
                </p>
            </div>

            <div class="bg-white/5 backdrop-blur-md border border-track5/20 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div class="w-12 h-12 rounded-xl bg-track5/20 text-track5 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-infinity"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Pay Once, Keep Forever</h3>
                <p class="text-sm text-gray-400">
                    A single payment. No monthly fees, no credits to top up, no meter running. It's yours — activate it and forget about us.
                </p>
            </div>

            <div class="bg-white/5 backdrop-blur-md border border-track5/20 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div class="w-12 h-12 rounded-xl bg-track5/20 text-track5 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Nothing Leaves Your Computer</h3>
                <p class="text-sm text-gray-400">
                    Every generation happens locally. No prompts sent to a server, no audio uploaded. What you make stays entirely on your machine.
                </p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-track5/10 to-transparent border border-track5/30 rounded-3xl p-8 md:p-10 gs-reveal opacity-0 translate-y-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-center md:text-left">
                    <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-2">
                        OBSIDIAN Neural — Local Edition
                    </h3>
                    <p class="text-gray-400 text-sm max-w-md">
                        The full plugin with Stable Audio 3 Medium running on your own hardware. One payment, activate on up to 3 machines, play offline forever.
                    </p>
                    <ul class="local-features text-sm text-gray-500 mt-3">
                        <li><i class="fas fa-check text-success mr-1"></i>Runs on your CPU</li>
                        <li><i class="fas fa-check text-success mr-1"></i>3 machines</li>
                        <li><i class="fas fa-check text-success mr-1"></i>Win · macOS · Linux</li>
                    </ul>
                    <p class="text-xs text-gray-600 mt-3">
                        <i class="fas fa-circle-info mr-1"></i>macOS: Apple Silicon (M1+) only — Intel Macs not supported.
                    </p>
                </div>
                <div class="flex flex-col items-center gap-3 shrink-0">

                    <div data-prod-buy class="hidden flex flex-col items-center gap-3">
                        <div class="text-center" data-local-price>
                            <span class="text-5xl font-extrabold text-white">€29</span>
                            <span class="block text-xs text-gray-500 uppercase tracking-wider mt-1">One-time payment</span>
                        </div>
                        <a href="local.php"
                            class="px-8 py-4 rounded-xl bg-track5 text-white font-bold hover:scale-105 transition-transform shadow-[0_0_25px_rgba(180,150,90,0.35)] whitespace-nowrap">
                            <i class="fas fa-microchip mr-2"></i>Get the Local Edition
                        </a>
                    </div>

                    <?php include 'partials/local/beta.php'; ?>

                </div>
            </div>
        </div>

        <div class="text-center mt-8 gs-reveal opacity-0 translate-y-6">
            <div class="inline-flex flex-wrap justify-center items-center gap-2 px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-sm text-gray-300 max-w-2xl">
                <i class="fas fa-layer-group text-primary"></i>
                <span>The Local Edition can switch to server mode for all <strong class="text-white">9 engines</strong> — but generating that way needs a subscription, or your own <a href="https://github.com/innermost47/ai-dj" target="_blank" class="text-primary hover:underline">self-hosted server</a>.</span>
            </div>
        </div>
    </div>
</section>