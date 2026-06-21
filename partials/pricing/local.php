<style>
    .local-features {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        width: 100%;
        align-items: center;
    }

    .local-features li {
        display: flex;
        align-items: center;
    }

    .local-features li i {
        margin-right: 0.75rem;
    }

    @media (min-width: 768px) {
        .local-features {
            align-items: flex-start;
        }
    }
</style>
<section class="mt-20 mb-12">
    <div class="text-center mb-8">
        <div class="inline-flex items-center gap-3 text-gray-500 text-sm uppercase tracking-[0.2em] font-bold">
            <span class="h-px w-12 bg-white/10"></span>
            Or go fully offline
            <span class="h-px w-12 bg-white/10"></span>
        </div>
    </div>
    <div class="max-w-3xl mx-auto mb-16">
        <div class="bg-gradient-to-br from-track5/10 to-transparent border border-track5/30 rounded-3xl p-8 md:p-10 relative overflow-hidden">
            <div class="absolute top-4 right-4">
                <span class="text-[10px] uppercase font-bold text-track5 bg-track5/15 border border-track5/40 px-3 py-1 rounded-full tracking-wider">
                    <i class="fas fa-infinity mr-1"></i>One-time payment
                </span>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <div class="w-12 h-12 rounded-xl bg-track5/20 text-track5 flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-2">
                        Local Edition
                    </h3>
                    <p class="text-gray-400 text-sm max-w-md mb-4">
                        Stable Audio 3 Medium runs on your own CPU. No subscription, no credits, no internet required. Pay once, play offline forever.
                    </p>
                    <ul class="local-features text-sm text-gray-500">
                        <li><i class="fas fa-check text-success"></i>Runs on your CPU</li>
                        <li><i class="fas fa-check text-success"></i>3 machines</li>
                        <li><i class="fas fa-check text-success"></i>Win · macOS · Linux</li>
                    </ul>
                </div>
                <div class="flex flex-col items-center gap-3 shrink-0">
                    <div class="text-center">
                        <span class="text-5xl font-extrabold text-white">€29</span>
                        <span class="block text-xs text-gray-500 uppercase tracking-wider mt-1">Forever</span>
                    </div>
                    <a
                        href="local.php"
                        class="px-8 py-4 rounded-xl bg-track5 text-white font-bold hover:scale-105 transition-transform shadow-[0_0_25px_rgba(180,150,90,0.35)] whitespace-nowrap">
                        <i class="fas fa-microchip mr-2"></i>Get Local Edition
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>