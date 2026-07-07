<section class="relative z-20 py-24 px-4"
    style="background-image: radial-gradient(circle at 50% 120%, #2a2a23 0%, #0a0a0c 60%);">
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none -z-10">
        <div class="w-[500px] h-[500px] md:w-[800px] md:h-[800px] rounded-full bg-track5/10 blur-[120px]"></div>
    </div>
    <div class="max-w-3xl mx-auto text-center">
        <div class="w-16 h-16 rounded-2xl bg-track5/20 text-track5 flex items-center justify-center text-3xl mb-8 mx-auto">
            <i class="fas fa-laptop"></i>
        </div>
        <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-6"
            style="background: linear-gradient(to right, #fff, #888); -webkit-background-clip: text; -webkit-text-fill-color: transparent; padding-bottom: 0.15em; line-height: 1.15;">
            Pull the cable.<br />Play anyway.
        </h2>
        <p class="text-gray-400 text-lg max-w-xl mx-auto mb-10">
            Stable Audio 3 Medium on your own CPU. One payment, three machines, offline forever. No account, no subscription, no strings.
        </p>
        <div class="flex flex-col items-center gap-4">

            <div data-prod-buy class="hidden flex flex-col items-center gap-4">
                <div class="flex items-baseline gap-2" data-local-price>
                    <span class="text-6xl font-extrabold text-white">€29</span>
                    <span class="text-sm text-gray-500 uppercase tracking-wider">one-time</span>
                </div>
                <button
                    id="btn-buy-local-cta"
                    class="px-6 py-6 rounded-xl bg-track5 text-white text-lg font-bold hover:scale-105 transition-transform shadow-[0_0_30px_rgba(180,150,90,0.4)] disabled:opacity-60 disabled:cursor-not-allowed">
                    <i class="fas fa-microchip mr-3"></i>Get the Local Edition
                </button>
            </div>

            <?php include __DIR__ . '/beta.php'; ?>

            <span id="buy-error" class="text-sm text-danger hidden"></span>

            <p class="text-xs text-gray-500 mt-3">
                <i class="fas fa-lock mr-1"></i>Secure checkout via Stripe · Key delivered instantly by email
            </p>
            <p class="text-xs text-gray-600 mt-2">
                <i class="fas fa-circle-info mr-1"></i>macOS: Apple Silicon (M1+) only — Intel Macs not supported.
            </p>
            <p class="text-xs text-gray-600 mt-2">
                By purchasing, you agree to our <a href="terms-of-service.php" class="text-gray-400 hover:text-white underline">Terms of Service</a>.
            </p>
        </div>
        <div class="mt-12 pt-8 border-t border-white/10">
            <p class="text-sm text-gray-500">
                Just want to try the cloud version first? It's
                <a href="register.php" class="text-primary hover:underline">free to start — 20 credits, no card</a>.
            </p>
        </div>
    </div>
</section>