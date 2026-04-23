<div class="text-center mb-10 mt-16">
    <h2 class="text-2xl font-bold text-white mb-2"><i class="fas fa-info-circle text-success mr-2"></i>How It Works</h2>
    <p class="text-gray-400 text-sm">Each generation costs 1 credit, regardless of method</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-track2/20 text-track2 flex items-center justify-center"><i class="fas fa-keyboard text-sm"></i></div>
            <div>
                <h4 class="font-bold text-sm text-white">Text Prompt</h4>
                <p class="text-[11px] text-gray-500">Type your prompt directly</p>
            </div>
        </div>
        <p class="text-xs text-gray-500 mb-3">Uses Gemini 2.5 Flash (LLM) to optimize your prompt → Sends to 8 specialized GPU models or Stable Audio fallback.</p>
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-success/10 text-success text-[10px] font-bold">
            <i class="fas fa-coins"></i> 1 credit per generation
        </div>
    </div>
    <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-track3/20 text-track3 flex items-center justify-center"><i class="fas fa-paintbrush text-sm"></i></div>
            <div>
                <h4 class="font-bold text-sm text-white">Drawing to Audio</h4>
                <p class="text-[11px] text-gray-500">Paint musical ideas visually</p>
            </div>
        </div>
        <p class="text-xs text-gray-500 mb-3">Uses Gemini 2.5 Flash (Vision) to interpret your drawing → Translates to musical prompt → Same audio pipeline.</p>
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-success/10 text-success text-[10px] font-bold">
            <i class="fas fa-coins"></i> 1 credit per generation
        </div>
    </div>
</div>

<div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 mb-8">
    <h4 class="font-bold text-sm text-white mb-4"><i class="fas fa-microchip text-primary mr-2"></i>AI Stack</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 rounded-xl bg-black/30 border border-white/5">
            <h5 class="font-bold text-xs text-gray-300 mb-2"><i class="fas fa-brain text-gray-400 mr-2"></i>LLM Brain</h5>
            <p class="text-[11px] text-gray-500 leading-relaxed"><strong class="text-gray-300">Gemini 2.5 Flash</strong><br>Optimizes prompts, understands context</p>
        </div>
        <div class="p-4 rounded-xl bg-black/30 border border-white/5">
            <h5 class="font-bold text-xs text-gray-300 mb-2"><i class="fas fa-eye text-gray-400 mr-2"></i>Vision Model</h5>
            <p class="text-[11px] text-gray-500 leading-relaxed"><strong class="text-gray-300">Gemini 2.5 Flash</strong><br>Analyzes drawings → sonic descriptions</p>
        </div>
        <div class="p-4 rounded-xl bg-black/30 border border-white/5">
            <h5 class="font-bold text-xs text-gray-300 mb-2"><i class="fas fa-music text-gray-400 mr-2"></i>Audio Engines</h5>
            <p class="text-[11px] text-gray-500 leading-relaxed"><strong class="text-gray-300">8 specialized models</strong> on provider nodes (Foundation-1, StableBeaT, EDM Elements…).<br><strong class="text-gray-300">Stable Audio Open</strong> via fal.ai as automatic fallback.</p>
        </div>
    </div>
</div>

<div class="text-center p-4 rounded-xl bg-white/[0.03] border border-white/[0.06]">
    <p class="text-xs text-gray-500"><i class="fas fa-check-circle text-success mr-2"></i><strong class="text-gray-400">Simple Pricing:</strong> 1 credit = 1 generation, regardless of model or method. Model quality depends on GPU node availability.</p>
</div>