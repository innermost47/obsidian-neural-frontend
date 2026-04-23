<?php
function render_gift_check_form($btn_label = 'Check Gift Code', $btn_icon = 'fas fa-search')
{
?>
    <div class="max-w-lg mx-auto bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-2xl mx-auto mb-6">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Check Gift Code</h2>
                <p class="text-sm text-gray-500 mb-8">Enter your gift code to see the details</p>
            </div>

            <form id="giftCheckForm">
                <div class="mb-5">
                    <label for="giftCode" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-widest">Gift Code *</label>
                    <input type="text" id="giftCode" placeholder="OBSIDIAN-XXXXXXXXXXXX" required
                        class="w-full px-4 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 text-center text-xl font-bold tracking-[0.2em] uppercase focus:border-primary focus:outline-none transition-colors">
                    <p class="text-[11px] text-gray-600 mt-1.5 text-center">Format: OBSIDIAN-XXXXXXXXXXXX</p>
                </div>

                <div class="hidden mb-5 p-4 rounded-xl bg-danger/10 border border-danger/30" id="errorAlert" role="alert">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle text-danger text-xl"></i>
                        <div class="text-sm text-danger">
                            <strong class="block mb-1">Invalid Code</strong>
                            <span id="errorMessage">This gift code is not valid or has already been used.</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                    <i class="<?php echo $btn_icon; ?> mr-2"></i><?php echo $btn_label; ?>
                </button>
            </form>
        </div>
    </div>
<?php
}
