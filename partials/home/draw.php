<section
    class="relative z-20 py-24 px-4"
    style="
background: radial-gradient(
ellipse at 20% 80%,
rgba(139, 106, 181, 0.06) 0%,
transparent 60%
);
"
    id="draw-to-audio">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h2
                class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-4 gs-reveal opacity-0 translate-y-6">
                <i class="fas fa-palette text-danger mr-3"></i>Draw Your Sound
            </h2>
            <p
                class="text-gray-400 text-lg max-w-xl mx-auto gs-reveal opacity-0 translate-y-6">
                Transform visual drawings into unique audio samples with AI
            </p>
        </div>

        <!-- Video -->
        <div class="max-w-4xl mx-auto mb-16 gs-reveal opacity-0 scale-95">
            <div
                class="aspect-video rounded-3xl border border-white/10 shadow-2xl relative overflow-hidden bg-black"
                id="yt-draw"
                data-video-id="">
                <div
                    class="absolute inset-0 bg-black/70 flex flex-col items-center justify-center text-center p-6 z-10">
                    <i class="fab fa-youtube text-6xl text-danger mb-4"></i>
                    <h4 class="font-bold text-xl mb-2">Draw-to-Audio Live Demo</h4>
                    <p class="text-sm text-gray-400 mb-4 max-w-sm">
                        Raw improvisation: sketch patterns → AI interprets visuals →
                        generates matching loops.
                    </p>
                    <button
                        class="px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-white hover:text-black transition-colors"
                        onclick="
localStorage.setItem('cookie_consent', 'accepted');
location.reload();
">
                        <i class="fas fa-cookie-bite mr-2"></i>Accept Cookies
                    </button>
                </div>
            </div>
        </div>

        <!-- 3 steps -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl gs-reveal opacity-0 translate-y-8">
                <div class="text-3xl font-black text-track3 mb-4">1</div>
                <div
                    class="w-12 h-12 rounded-xl bg-track3/20 text-track3 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-paintbrush"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Sketch Your Idea</h3>
                <p class="text-sm text-gray-400 mb-3">
                    Drawing tools (Pencil, Brush, Spray, Eraser) and 10 colors on a
                    512×512 canvas.
                </p>
                <ul class="space-y-1 text-xs text-gray-500">
                    <li>
                        <i class="fas fa-check text-track3 mr-2"></i>Pencil → Sharp,
                        staccato sounds
                    </li>
                    <li>
                        <i class="fas fa-check text-track3 mr-2"></i>Brush → Smooth,
                        sustained pads
                    </li>
                    <li>
                        <i class="fas fa-check text-track3 mr-2"></i>Colors → Frequency
                        ranges &amp; timbres
                    </li>
                </ul>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl gs-reveal opacity-0 translate-y-8">
                <div class="text-3xl font-black text-track2 mb-4">2</div>
                <div
                    class="w-12 h-12 rounded-xl bg-track2/20 text-track2 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-tags"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Add Musical Keywords</h3>
                <p class="text-sm text-gray-400 mb-3">
                    Select from 20+ musical keywords or add your own to guide the AI
                    interpretation.
                </p>
                <ul class="space-y-1 text-xs text-gray-500">
                    <li>
                        <i class="fas fa-check text-track2 mr-2"></i>Pre-defined musical
                        terms
                    </li>
                    <li>
                        <i class="fas fa-check text-track2 mr-2"></i>Custom keywords
                        support
                    </li>
                    <li>
                        <i class="fas fa-check text-track2 mr-2"></i>Alphabetically
                        sorted &amp; scrollable
                    </li>
                </ul>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl gs-reveal opacity-0 translate-y-8">
                <div class="text-3xl font-black text-primary mb-4">3</div>
                <div
                    class="w-12 h-12 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-robot"></i>
                </div>
                <h3 class="font-bold text-white mb-2">AI Sonic Translation</h3>
                <p class="text-sm text-gray-400 mb-3">
                    Vision LLM analyzes tools, colors, patterns, composition.
                    Generates detailed musical prompt.
                </p>
                <ul class="space-y-1 text-xs text-gray-500">
                    <li>
                        <i class="fas fa-check text-primary mr-2"></i>Visual → Sonic
                        interpretation
                    </li>
                    <li>
                        <i class="fas fa-check text-primary mr-2"></i>Context-aware
                        generation
                    </li>
                    <li>
                        <i class="fas fa-check text-primary mr-2"></i>BPM &amp; Key
                        synchronized
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="grid grid-cols-1 md:grid-cols-2 gap-6 gs-reveal opacity-0 translate-y-8">
            <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                <h4 class="font-bold text-white mb-3">
                    <i class="fas fa-palette text-primary mr-2"></i>Colors →
                    Frequencies
                </h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>
                        <span
                            class="inline-block w-3 h-3 rounded-full bg-black mr-2"></span>Black → Deep bass, sub-bass
                    </li>
                    <li>
                        <span
                            class="inline-block w-3 h-3 rounded-full bg-red-500 mr-2"></span>Red → Aggressive mid-high energy
                    </li>
                    <li>
                        <span
                            class="inline-block w-3 h-3 rounded-full bg-blue-500 mr-2"></span>Blue → Cool, ethereal, reverberant
                    </li>
                    <li>
                        <span
                            class="inline-block w-3 h-3 rounded-full bg-yellow-400 mr-2"></span>Yellow → Bright, high frequencies
                    </li>
                </ul>
            </div>
            <div class="bg-white/5 border border-white/10 p-6 rounded-2xl">
                <h4 class="font-bold text-white mb-3">
                    <i class="fas fa-shapes text-track3 mr-2"></i>Patterns → Rhythms
                </h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>
                        <i class="fas fa-grip-lines-vertical text-track3 mr-2"></i>Vertical lines → Staccato, percussive hits
                    </li>
                    <li>
                        <i class="fas fa-grip-lines text-track3 mr-2"></i>Horizontal
                        flows → Sustained notes, drones
                    </li>
                    <li>
                        <i class="fas fa-circle-notch text-track3 mr-2"></i>Circular
                        patterns → Arpeggios, sequences
                    </li>
                    <li>
                        <i class="fas fa-random text-track3 mr-2"></i>Chaotic scribbles
                        → Glitchy, randomized
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>