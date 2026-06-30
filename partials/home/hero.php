<section class="relative z-20 py-20 mt-10 px-4">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none -z-10">
        <div class="w-[600px] h-[600px] md:w-[900px] md:h-[900px] rounded-full bg-primary/20 blur-[120px]"></div>
    </div>
    <div class="max-w-4xl mx-auto text-center">
        <h1
            class="text-5xl md:text-7xl lg:text-8xl font-extrabold mb-6 tracking-tighter leading-[0.9] gs-reveal opacity-0 translate-y-6"
            style="
background: linear-gradient(to right, #fff, #888);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
">
            The first VST<br />that hallucinates live
        </h1>
        <h2 class="text-base md:text-lg font-medium text-gray-500 mb-10 gs-reveal opacity-0 translate-y-6">
            Finally, a VST that justifies your impostor syndrome.
        </h2>

        <div class="flex flex-wrap justify-center gap-2 mb-10 gs-reveal opacity-0 translate-y-6">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-400">
                <i class="fas fa-cloud text-primary"></i>
                No GPU required — cloud or local CPU
            </span>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-gray-400">
                <i class="fas fa-bolt text-success"></i>
                Standalone or in your DAW (VST3 / AU)
            </span>
        </div>
        <p class="text-center max-w-2xl mx-auto mb-10 text-gray-400 text-lg leading-relaxed gs-reveal opacity-0 translate-y-6">
            <strong class="text-white">Your trip. Your machine. Your call.</strong><br />
            Generate samples in ~10s — on your own CPU, fully offline, or in the cloud
            if you'd rather skip the wait. Got a spare GPU?
            <strong class="text-primary">Let it go wild for someone else and earn 85% of the network revenue.</strong>
        </p>

        <div class="flex flex-wrap justify-center gap-4 mb-10 gs-reveal opacity-0 translate-y-6">
            <div class="flex flex-col items-center gap-1">
                <a
                    href="register.php"
                    class="px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-105 transition-transform shadow-[0_0_25px_rgba(217,104,80,0.4)]">
                    <i class="fas fa-rocket mr-2"></i>Start Free — 20 Credits
                </a>
                <span class="text-xs text-gray-500"><i class="fas fa-cloud mr-1"></i>No GPU needed</span>
            </div>
            <div class="flex flex-col items-center gap-1">
                <a
                    id="btn-download-plugin"
                    href="#"
                    target="_blank"
                    class="px-6 py-4 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors backdrop-blur-md font-bold">
                    <i class="fab fa-github mr-2"></i>Download Plugin
                </a>
                <span class="text-xs text-gray-500">VST3 · AU · Free</span>
            </div>
            <div class="flex flex-col items-center gap-1">
                <a href="local.php" data-prod-buy
                    class="hidden px-6 py-4 rounded-xl bg-track5 text-white font-bold hover:scale-105 transition-transform shadow-[0_0_25px_rgba(180,150,90,0.35)]">
                    <i class="fas fa-microchip mr-2"></i>CPU Version — €29
                </a>
                <a href="local.php" data-beta-block
                    class="hidden px-6 py-4 rounded-xl bg-track5 text-white font-bold hover:scale-105 transition-transform shadow-[0_0_25px_rgba(180,150,90,0.35)]">
                    <i class="fas fa-microchip mr-2"></i>CPU Version — Beta
                </a>
                <span class="text-xs text-gray-500"><i class="fas fa-laptop mr-1"></i>Runs offline</span>
            </div>
            <div class="flex flex-col items-center gap-1">
                <a
                    href="#provider-network"
                    class="px-6 py-4 rounded-xl border border-primary/40 text-primary hover:bg-primary/10 transition-colors font-bold">
                    <i class="fas fa-server mr-2"></i>Earn with GPU
                </a>
                <span class="text-xs text-gray-500">85% revenue share</span>
            </div>
        </div>

        <div
            class="flex flex-wrap justify-center gap-6 text-sm text-gray-500 gs-reveal opacity-0 translate-y-6">
            <span><i class="fas fa-code text-success mr-2"></i>Open Source
                (AGPL-3.0)</span>
            <span><i class="fas fa-star text-warning mr-2"></i><span id="github-stars">Loading...</span> Stars</span>
            <span><i class="fas fa-download text-primary mr-2"></i><span id="github-downloads">Loading...</span> Downloads</span>
            <span><i class="fas fa-bolt text-danger mr-2"></i>~10s Generation</span>
            <span><i class="fas fa-microchip text-primary mr-2"></i>9 AI Models</span>
        </div>
    </div>
</section>