<section
    class="relative z-20 py-24 px-4"
    style="
background: radial-gradient(
ellipse at 50% 0%,
rgba(217, 104, 80, 0.06) 0%,
transparent 60%
);
"
    id="mobile-controller">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2
                class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-4 gs-reveal opacity-0 translate-y-6">
                <i class="fas fa-mobile-alt text-primary mr-3"></i>MIDI Controller
            </h2>
            <p
                class="text-gray-400 text-lg max-w-xl mx-auto gs-reveal opacity-0 translate-y-6">
                Control the plugin from your mobile device via USB MIDI
            </p>
            <div
                class="inline-block mt-4 px-4 py-1.5 bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest rounded-full border border-primary/30 gs-reveal opacity-0 translate-y-6">
                <i class="fas fa-code mr-2"></i>Open Source — Flutter
            </div>
        </div>

        <div class="mb-12 gs-reveal opacity-0 scale-95">
            <div class="max-w-4xl mx-auto relative">
                <div
                    class="absolute inset-0 bg-primary/15 blur-[80px] rounded-full mix-blend-screen pointer-events-none"></div>
                <div
                    class="mock-console-wrapper"
                    id="controller-wrapper"
                    style="perspective: 1200px; position: relative; z-index: 10">
                    <div
                        class="mock-console relative bg-gradient-to-br from-[#2b2b2f] to-[#1a1a1d] p-4 md:p-5 rounded-2xl"
                        style="
    box-shadow:
    inset 0 1px 1px rgba(255, 255, 255, 0.12),
    inset 0 -1px 2px rgba(0, 0, 0, 0.5);
    animation: float 7s ease-in-out infinite;
"
                        id="controller-console">
                        <div
                            class="console-screen bg-black rounded-xl overflow-hidden relative"
                            style="
    box-shadow:
        0 15px 30px rgba(0, 0, 0, 0.8),
        inset 0 0 0 2px #333;
    ">
                            <div
                                class="glare absolute inset-0 z-10 pointer-events-none rounded-xl"
                                id="controller-glare"
                                style="
        background: radial-gradient(
        circle at 50% 50%,
        rgba(255, 255, 255, 0.12) 0%,
        transparent 60%
        );
    "></div>
                            <div
                                class="absolute inset-0 bg-gradient-to-b from-transparent via-primary/15 to-transparent h-12 animate-scanline mix-blend-screen pointer-events-none rounded-xl"></div>
                            <img
                                src="assets/images/controller-screenshot.png"
                                alt="Android MIDI Controller — 8 slots, pages, sequencer (landscape)"
                                class="w-full block rounded-xl opacity-90"
                                onerror="
        this.src =
        'https://via.placeholder.com/900x500/111/fff?text=CONTROLLER+LANDSCAPE'
    " />
                        </div>
                    </div>
                    <div
                        class="console-shadow absolute -bottom-16 left-1/2 w-4/5 h-8 bg-black/80 rounded-full z-[-1]"
                        style="
    box-shadow: 0 0 40px 30px rgba(0, 0, 0, 0.7);
    filter: blur(15px);
    animation: shadow-pulse 7s ease-in-out infinite;
"></div>
                    <div
                        class="absolute -bottom-28 left-1/2 -translate-x-1/2 w-2/5 h-16 bg-track2 opacity-15 pointer-events-none"
                        style="
    transform: translateX(-50%) rotateX(70deg);
    filter: blur(40px);
"></div>
                </div>
            </div>
            <p class="text-center mt-4 text-sm text-gray-500">
                <i class="fas fa-plug mr-2"></i>USB MIDI • 8 slots • Pages A/B/C/D •
                Séquenceur • Feedback bidirectionnel
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-14 h-14 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <h3 class="font-bold text-lg mb-3 text-white">
                    Full Real-Time Control
                </h3>
                <p class="text-sm text-gray-400 mb-4">
                    Control all 8 tracks simultaneously — play, generate, mute, solo,
                    volume, pan, pitch, fine tuning, beat repeat and page switching,
                    all from your phone.
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-primary text-xs"></i>Map any button
                        to trigger samples
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-primary text-xs"></i>Hardware and
                        software triggering
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-primary text-xs"></i>Live
                        performance ready
                    </li>
                </ul>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-14 h-14 rounded-xl bg-track2/20 text-track2 flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <h3 class="font-bold text-lg mb-3 text-white">
                    Bidirectional Feedback
                </h3>
                <p class="text-sm text-gray-400 mb-4">
                    The plugin sends its state back to the app in real time. Page
                    changes, play states, generated values — your phone always
                    reflects what's happening in the DAW.
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-track2 text-xs"></i>Live state sync
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-track2 text-xs"></i>Page changes
                        reflected
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-track2 text-xs"></i>Generated values
                        shown
                    </li>
                </ul>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-14 h-14 rounded-xl bg-track3/20 text-track3 flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-plug"></i>
                </div>
                <h3 class="font-bold text-lg mb-3 text-white">
                    USB — Zero Latency
                </h3>
                <p class="text-sm text-gray-400 mb-4">
                    Connects via USB OTG directly to your computer. No Bluetooth
                    pairing, no Wi-Fi setup, no latency. Plug in and play.
                </p>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-track3 text-xs"></i>No Bluetooth
                        needed
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-track3 text-xs"></i>No Wi-Fi setup
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-track3 text-xs"></i>Instant plug &
                        play
                    </li>
                </ul>
            </div>
        </div>

        <div class="text-center mt-10 gs-reveal opacity-0 translate-y-6">
            <a
                id="btn-controller-2"
                href="#"
                target="_blank"
                class="px-8 py-4 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 font-bold transition-colors">
                <i class="fab fa-github mr-2"></i>View on GitHub
            </a>
        </div>
    </div>
</section>