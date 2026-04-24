<div id="section-email-broadcast" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-envelope mr-3 text-primary"></i>Email Broadcast</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Send newsletters to users who accepted news updates.</p>
    </div>
    <div class="p-6 lg:p-12 space-y-5">
        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-users text-sm"></i></div>
                <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Recipients</h6>
            </div>
            <div class="text-2xl font-black text-white" id="broadcast-recipients-count">—</div>
            <p class="text-xs text-gray-600 mt-1">Users accepting news</p>
        </div>
        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
            <h3 class="text-sm font-bold text-white mb-5"><i class="fas fa-edit mr-2 text-primary"></i>Compose Email</h3>
            <form id="broadcast-form">
                <div class="mb-4"><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Subject *</label><input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" id="email-subject" placeholder="Newsletter subject..." required /></div>
                <div class="mb-4"><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Message *</label><textarea id="email-body" name="email-body" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors min-h-[120px]"></textarea>
                    <p class="text-xs text-gray-600 mt-1">Write your message using the rich text editor above.</p>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="previewEmail()" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-eye mr-2"></i>Preview</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(217,104,80,0.3)]"><i class="fas fa-paper-plane mr-2"></i>Send to All Recipients</button>
                </div>
            </form>
        </div>
        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-bold text-white m-0"><i class="fas fa-history mr-2 text-primary"></i>Email History</h3><button onclick="loadEmailHistory()" class="px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-sync mr-1"></i>Refresh</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs border-separate border-spacing-0">
                    <thead>
                        <tr><?php foreach (['Date', 'Subject', 'Recipients', 'Status', 'Actions'] as $h): ?><th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]"><?= $h ?></th><?php endforeach; ?></tr>
                    </thead>
                    <tbody id="email-history-tbody">
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>