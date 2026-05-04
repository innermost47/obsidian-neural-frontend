<div id="section-usage" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-chart-bar mr-3 text-primary"></i>Usage &amp; Credits</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Track your credit usage and understand the cost structure.</p>
    </div>
    <div class="p-6 lg:p-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-coins"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Total Credits</h6>
                </div>
                <div class="text-2xl font-black text-white" id="credits-total-usage">—</div>
                <p class="text-xs text-gray-600 mt-1">Credits allocated this month</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-bolt"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Credits Used</h6>
                </div>
                <div class="text-2xl font-black text-white" id="credits-used-usage">—</div>
                <p class="text-xs text-gray-600 mt-1">Credits consumed so far</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-battery-three-quarters"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Credits Remaining</h6>
                </div>
                <div class="text-2xl font-black text-white mb-3" id="credits-remaining-usage">—</div>
                <div class="h-1.5 rounded-full bg-white/5 mb-1 overflow-hidden">
                    <div id="credits-progress-usage" class="h-full bg-gradient-to-r from-primary to-[#a04840] rounded-full transition-all" style="width:0%"></div>
                </div>
                <p class="text-xs text-gray-600">Available for use</p>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 mb-6">
            <h3 class="text-base font-bold text-white mb-4"><i class="fas fa-info-circle mr-2 text-primary"></i>How Credits Work</h3>
            <p class="text-sm text-gray-400 mb-5">Each generation uses credits based on AI models. Simple pricing: 1 credit = 1 generation.</p>
            <div class="overflow-x-auto">
                <table class="text-sm" style="min-width: 460px;">
                    <thead>
                        <tr class="border-b border-white/[0.06]">
                            <th class="text-left text-xs font-bold uppercase tracking-wider text-gray-500 pb-3 pr-4">Generation Type</th>
                            <th class="text-left text-xs font-bold uppercase tracking-wider text-gray-500 pb-3 pr-4">AI Models Used</th>
                            <th class="text-left text-xs font-bold uppercase tracking-wider text-gray-500 pb-3">Credits</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.04]">
                        <tr>
                            <td class="py-4 pr-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-primary/20 text-primary flex items-center justify-center text-xs"><i class="fas fa-keyboard"></i></div>
                                    <div>
                                        <div class="font-bold text-white text-sm">Text Prompt</div>
                                        <div class="text-xs text-gray-500">Type your prompt directly</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 pr-4">
                                <div class="flex flex-col gap-1"><span class="inline-flex items-center gap-1 bg-white/5 text-gray-400 rounded-full px-2 py-0.5 text-[0.65rem] font-bold"><i class="fas fa-brain text-primary"></i>Gemini 2.5 Flash (LLM)</span><span class="inline-flex items-center gap-1 bg-primary/10 text-primary rounded-full px-2 py-0.5 text-[0.65rem] font-bold"><i class="fas fa-music"></i>Stable Audio</span></div>
                            </td>
                            <td class="py-4"><span class="bg-primary/10 text-primary border border-primary/30 rounded-full px-3 py-1 text-xs font-black">1 credit</span></td>
                        </tr>
                        <tr>
                            <td class="py-4 pr-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-primary/20 text-primary flex items-center justify-center text-xs"><i class="fas fa-paint-brush"></i></div>
                                    <div>
                                        <div class="font-bold text-white text-sm">Drawing to Audio</div>
                                        <div class="text-xs text-gray-500">Paint musical ideas visually</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 pr-4">
                                <div class="flex flex-col gap-1"><span class="inline-flex items-center gap-1 bg-white/5 text-gray-400 rounded-full px-2 py-0.5 text-[0.65rem] font-bold"><i class="fas fa-eye text-primary"></i>Gemini 2.5 Flash (Vision)</span><span class="inline-flex items-center gap-1 bg-primary/10 text-primary rounded-full px-2 py-0.5 text-[0.65rem] font-bold"><i class="fas fa-music"></i>Stable Audio</span></div>
                            </td>
                            <td class="py-4"><span class="bg-primary/10 text-primary border border-primary/30 rounded-full px-3 py-1 text-xs font-black">1 credit</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
            <h3 class="text-base font-bold text-white mb-4"><i class="fas fa-layer-group mr-2 text-primary"></i>AI Models Stack</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4">
                    <h6 class="font-bold text-white mb-2 text-sm"><i class="fas fa-brain mr-2 text-primary"></i>LLM Brain</h6>
                    <p class="text-xs text-gray-500 mb-0"><strong class="text-gray-300">Gemini 2.5 Flash</strong><br>Optimizes prompts, understands context, maintains conversation history</p>
                </div>
                <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4">
                    <h6 class="font-bold text-white mb-2 text-sm"><i class="fas fa-eye mr-2 text-primary"></i>Vision Model</h6>
                    <p class="text-xs text-gray-500 mb-0"><strong class="text-gray-300">Gemini 2.5 Flash</strong><br>Analyzes drawings, translates visual patterns into sonic descriptions</p>
                </div>
                <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4">
                    <h6 class="font-bold text-white mb-2 text-sm"><i class="fas fa-music mr-2 text-primary"></i>Audio Engine</h6>
                    <p class="text-xs text-gray-500 mb-0"><strong class="text-gray-300">Stable Audio</strong><br>Generates high-quality 30-second audio samples in ~10 seconds</p>
                </div>
            </div>
        </div>
    </div>
</div>