<section class="relative z-20 pt-32 pb-20 px-4"
    style="background-image: radial-gradient(circle at 50% -20%, #2a2a23 0%, #0a0a0c 60%);">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none -z-10">
        <div class="w-[600px] h-[600px] md:w-[900px] md:h-[900px] rounded-full bg-track5/10 blur-[120px]"></div>
    </div>
    <div class="max-w-4xl mx-auto text-center">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-track5/10 border border-track5/30 text-sm text-track5 font-bold mb-6">
            <i class="fas fa-microchip"></i>
            Local Edition
        </span>

        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tighter leading-[0.9]"
            style="background: linear-gradient(to right, #fff, #888); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Your machine.<br />Your rules.
        </h1>

        <p class="text-center max-w-2xl mx-auto mb-8 text-gray-400 text-lg leading-relaxed">
            <strong class="text-white">Stable Audio 3 Medium runs straight on your CPU.</strong><br />
            No cloud, no account, no subscription. No internet?
            <strong class="text-track5">It still runs.</strong>
        </p>

        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-400">
                <i class="fas fa-laptop text-track5"></i>
                Runs 100% offline
            </span>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-400">
                <i class="fas fa-infinity text-success"></i>
                Pay once, keep forever
            </span>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-400">
                <i class="fas fa-shield-halved text-primary"></i>
                Nothing leaves your computer
            </span>
        </div>

        <div class="flex flex-col items-center gap-4">
            <div class="flex items-baseline gap-2">
                <span class="text-6xl font-extrabold text-white">€29</span>
                <span class="text-sm text-gray-500 uppercase tracking-wider">one-time</span>
            </div>

            <button
                id="btn-buy-local"
                class="px-6 py-6 rounded-xl bg-track5 text-white text-lg font-bold hover:scale-105 transition-transform shadow-[0_0_30px_rgba(180,150,90,0.4)] disabled:opacity-60 disabled:cursor-not-allowed">
                <i class="fas fa-microchip mr-2"></i>Get the Local Edition
            </button>

            <span id="buy-error" class="text-sm text-danger hidden"></span>

            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mt-2 text-sm text-gray-500">
                <span class="mr-1"><i class="fas fa-check text-success mr-2"></i>VST3 · AU · Standalone</span>
                <span class="mr-1"><i class="fas fa-check text-success mr-2"></i>Windows · macOS · Linux</span>
                <span><i class="fas fa-check text-success mr-2"></i>3 machines</span>
            </div>
            <p class="text-xs text-gray-600 mt-2">
                By purchasing, you agree to our <a href="terms-of-service.php" class="text-gray-400 hover:text-white underline">Terms of Service</a>.
            </p>
        </div>
    </div>
</section>