<section
    class="relative z-20 py-24 px-4"
    style="
background: radial-gradient(
ellipse at 80% 50%,
rgba(77, 163, 179, 0.06) 0%,
transparent 60%
);
"
    id="demo">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h2
                class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-4 gs-reveal opacity-0 translate-y-6">
                <i class="fas fa-play-circle text-danger mr-3"></i>Mix AI Samples
                Live
            </h2>
            <p
                class="text-gray-400 text-lg max-w-xl mx-auto gs-reveal opacity-0 translate-y-6">
                Jungle drum &amp; bass performance with AI-generated samples
                triggered via MIDI controller
            </p>
        </div>

        <div class="max-w-4xl mx-auto mb-16 gs-reveal opacity-0 scale-95">
            <div class="aspect-video rounded-3xl border border-white/10 shadow-2xl relative overflow-hidden bg-black gs-reveal opacity-0 scale-95" id="yt-dnb" data-video-id="" data-title="Jungle Drum & Bass Live Mix">
                <div class="absolute inset-0 bg-black/70 flex flex-col items-center justify-center text-center p-6 z-10">
                    <i class="fab fa-youtube text-6xl text-danger mb-4"></i>
                    <h4 class="font-bold text-xl mb-2">Jungle Drum &amp; Bass Live Mix</h4>
                    <p class="text-sm text-gray-400 mb-4 max-w-sm">This YouTube video requires cookies to be displayed.</p>
                    <button class="px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-white hover:text-black transition-colors" onclick="localStorage.setItem('cookie_consent','accepted'); location.reload();">
                        <i class="fas fa-cookie-bite mr-2"></i>Accept Cookies to Watch
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-12 h-12 rounded-xl bg-track3/20 text-track3 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-gamepad"></i>
                </div>
                <h3 class="font-bold text-white mb-2">
                    MIDI Controller Integration
                </h3>
                <p class="text-sm text-gray-400">
                    Launch AI samples from your controller or UI. All track pages are
                    fully MIDI-learnable.
                </p>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-12 h-12 rounded-xl bg-track2/20 text-track2 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Quantized Launch System</h3>
                <p class="text-sm text-gray-400">
                    Triggers wait for the current sequence to finish, then launch
                    perfectly synced on the next bar.
                </p>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-12 h-12 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Generate During Your Set</h3>
                <p class="text-sm text-gray-400">
                    Queue a generation, keep playing — it drops in when ready. ~30s
                    non-blocking background processing.
                </p>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-12 h-12 rounded-xl bg-track5/20 text-track5 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <h3 class="font-bold text-white mb-2">
                    8 Stereo Tracks + Multi-Output
                </h3>
                <p class="text-sm text-gray-400">
                    Route each track to separate DAW channels for dedicated per-track
                    effects chains.
                </p>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-12 h-12 rounded-xl bg-track6/20 text-track6 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-th"></i>
                </div>
                <h3 class="font-bold text-white mb-2">8 Sequences Per Page</h3>
                <p class="text-sm text-gray-400">
                    8 sequences × 64 steps per page. Switch instantly via MIDI for
                    dynamic pattern variations.
                </p>
            </div>
            <div
                class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition-all gs-reveal opacity-0 translate-y-8">
                <div
                    class="w-12 h-12 rounded-xl bg-track4/20 text-track4 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-music"></i>
                </div>
                <h3 class="font-bold text-white mb-2">Automatic BPM Sync</h3>
                <p class="text-sm text-gray-400">
                    Librosa time-stretching adapts all samples to your DAW's BPM.
                    Change tempo mid-session without breaking flow.
                </p>
            </div>
        </div>
    </div>
</section>