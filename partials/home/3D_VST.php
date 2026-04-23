<section class="relative z-20 min-h-screen flex flex-col items-center justify-center px-4 pt-12 lg:pt-36 pb-0"
    style="background-image: radial-gradient(circle at 50% -20%, #2a2a35 0%, #0a0a0c 60%);">

    <div class="lg:hidden text-center mb-8 gs-reveal opacity-0 translate-y-6">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tighter mb-3 leading-tight"
            style="background: linear-gradient(to right, #fff, #888); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            VST3 · AI Music · Stage Ready
        </h1>
        <p class="text-sm text-gray-500 max-w-sm mx-auto">
            The first VST that pays you back. Generate samples in ~30s.
        </p>
    </div>

    <div class="w-full max-w-4xl gs-reveal opacity-0 scale-90">
        <div class="mock-console-wrapper" id="vst-wrapper" style="perspective: 1500px; position: relative; z-index: 10;">
            <div class="mock-console relative bg-gradient-to-br from-[#2b2b2f] to-[#1a1a1d] p-4 sm:p-6 md:p-8 rounded-2xl md:rounded-3xl"
                style="box-shadow: inset 0 1px 1px rgba(255,255,255,0.15), inset 0 -1px 2px rgba(0,0,0,0.5);"
                id="vst-console">
                <div class="console-screen bg-black rounded-xl overflow-hidden relative"
                    style="box-shadow: 0 20px 40px rgba(0,0,0,0.8), inset 0 0 0 2px #333, inset 0 0 20px rgba(0,0,0,1); transform: translateZ(25px);">

                    <video autoplay loop muted playsinline id="vst-video"
                        class="hidden lg:block w-full opacity-95 object-cover"
                        poster="assets/images/screenshot.png">
                        <source src="assets/videos/hero.mp4" type="video/mp4">
                    </video>

                    <img src="assets/images/screenshot.png" alt="VST3 Interface" id="vst-mobile-img"
                        class="block lg:hidden w-full h-auto opacity-95" />

                    <div class="glare absolute inset-0 z-10 pointer-events-none rounded-xl" id="vst-glare"
                        style="background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.15) 0%, transparent 60%);"></div>
                </div>
            </div>
            <div class="console-shadow absolute -bottom-16 sm:-bottom-20 left-1/2 w-4/5 h-8 sm:h-10 bg-black/90 rounded-full z-[-1]"
                style="box-shadow: 0 0 60px 40px rgba(0,0,0,0.8); filter: blur(20px); animation: shadow-pulse 6s ease-in-out infinite;"></div>
            <div class="absolute -bottom-28 sm:-bottom-36 left-1/2 -translate-x-1/2 w-3/5 h-20 sm:h-24 bg-primary opacity-15 pointer-events-none"
                style="transform: translateX(-50%) rotateX(70deg); filter: blur(50px);"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-12 mb-8 flex flex-col items-center gap-2">
        <span class="text-[10px] uppercase tracking-[0.3em] text-gray-500 font-bold">Scroll to explore</span>
        <div class="w-5 h-9 rounded-full border-2 border-white/20 flex items-start justify-center p-1">
            <div class="w-1 h-2 rounded-full bg-primary animate-bounce"></div>
        </div>
    </div>
</section>