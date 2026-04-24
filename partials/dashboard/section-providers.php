<div id="section-providers" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-server mr-3 text-primary"></i>GPU Providers</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Manage the distributed inference network.</p>
    </div>
    <div class="p-6 lg:p-12 space-y-5">

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
            <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-plus mr-2 text-primary"></i>Add Provider</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Name</label><input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors text-sm" id="provider-name-input" placeholder="Paul — RTX 3070" /></div>
                <div><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">URL</label><input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors text-sm" id="provider-url" placeholder="http://192.168.1.42:8001" /></div>
                <div><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Stripe Account ID <span class="text-gray-600 normal-case">(optional)</span></label><input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors text-sm" id="provider-stripe" placeholder="acct_xxxxxxxxxxxxx" /></div>
                <div><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Linked User <span class="text-gray-600 normal-case">(optional)</span></label><select class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-primary focus:outline-none transition-colors text-sm appearance-none" id="provider-user-id">
                        <option value="" class="bg-black">— No user linked —</option>
                    </select>
                    <p class="text-xs text-gray-600 mt-1">Links to user for email notifications.</p>
                </div>
            </div>
            <button onclick="addProvider()" class="mt-4 px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(217,104,80,0.3)]"><i class="fas fa-plus mr-2"></i>Add Provider</button>
        </div>

        <div id="provider-api-key-alert" class="hidden">
            <div class="bg-warning/10 border border-warning/30 rounded-2xl p-5">
                <h5 class="text-sm font-bold text-warning mb-4"><i class="fas fa-exclamation-triangle mr-2"></i>Save these keys now — they will never be shown again</h5>
                <div class="space-y-4">
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Provider Identity Key (API_KEY)</label><code class="block bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-primary font-mono text-sm break-all" id="provider-api-key-display"></code><button onclick="copyKey('provider-api-key-display')" class="mt-2 px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-copy mr-1"></i>Copy Identity Key</button></div>
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Docker Activation Token (OBSIDIAN_TOKEN)</label><code class="block bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-primary font-mono text-sm break-all" id="server-auth-key-display"></code><button onclick="copyKey('server-auth-key-display')" class="mt-2 px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-copy mr-1"></i>Copy Activation Token</button></div>
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Docker Run Command</label><code class="block bg-black border border-white/10 rounded-xl px-4 py-3 text-success font-mono text-xs break-all" id="docker-command-display"></code><button onclick="copyKey('docker-command-display')" class="mt-2 px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-copy mr-1"></i>Copy Command</button></div>
                </div>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-bold text-white m-0"><i class="fas fa-list mr-2 text-primary"></i>Providers (<span id="providers-count">0</span>)</h3>
                <button onclick="loadProviders()" class="px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-sync mr-1"></i>Refresh</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs border-separate border-spacing-0">
                    <thead>
                        <tr><?php foreach (['Name', 'Online', 'Email', 'URL', 'Status', 'Jobs', 'Uptime', 'Last seen', 'Actions'] as $h): ?><th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap"><?= $h ?></th><?php endforeach; ?></tr>
                    </thead>
                    <tbody id="providers-tbody">
                        <tr>
                            <td colspan="9" class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>