<div id="section-api" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-key mr-3 text-primary"></i>API Configuration</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Manage your API key and server settings.</p>
    </div>
    <div class="p-6 lg:p-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
                <h3 class="text-base font-bold text-white mb-4"><i class="fas fa-key mr-2 text-primary"></i>API Key</h3>
                <code class="block bg-black/30 border border-white/10 rounded-xl px-4 py-3 text-primary font-mono text-sm mb-4 break-all" id="api-key">••••••••••••••••</code>
                <div class="flex gap-2">
                    <button onclick="toggleApiKey()" class="px-4 py-2 rounded-xl bg-success/10 border border-success/30 text-success font-bold text-sm hover:bg-success/20 transition-colors"><i class="fas fa-eye mr-1"></i><span id="toggle-text">Show</span></button>
                    <button onclick="copyApiKey()" class="px-4 py-2 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-copy mr-1"></i>Copy</button>
                </div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
                <h3 class="text-base font-bold text-white mb-4"><i class="fas fa-server mr-2 text-primary"></i>Server URL</h3>
                <code class="block bg-black/30 border border-white/10 rounded-xl px-4 py-3 text-gray-400 font-mono text-sm mb-4 break-all" id="server-url">—</code>
                <button onclick="copyServerUrl(event)" class="px-4 py-2 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-copy mr-1"></i>Copy URL</button>
            </div>
        </div>
        <div class="bg-primary/10 border border-primary/30 rounded-2xl p-5">
            <h5 class="font-bold text-white mb-3"><i class="fas fa-info-circle mr-2 text-primary"></i>Configuration Instructions</h5>
            <ol class="text-sm text-gray-400 space-y-1 list-decimal list-inside">
                <li>Copy your API key and Server URL</li>
                <li>Open your VST plugin in your DAW</li>
                <li>Navigate to the settings panel</li>
                <li>Paste the API key and Server URL in the appropriate fields</li>
            </ol>
        </div>
    </div>
</div>