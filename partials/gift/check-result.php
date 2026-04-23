<?php
function render_gift_check_result($args)
{
    $icon = $args['icon'] ?? 'fas fa-check';
    $icon_color = $args['icon_color'] ?? 'text-success';
    $icon_size = $args['icon_size'] ?? 'fa-2x';
?>
    <div class="max-w-lg mx-auto bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-60 h-60 bg-success/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <div class="text-center mb-8">
                <div class="w-20 h-20 rounded-2xl bg-success/20 text-success flex items-center justify-center text-3xl mx-auto mb-6 shadow-[0_0_30px_rgba(107,179,138,0.2)]">
                    <i class="<?php echo $icon; ?> <?php echo $icon_size; ?>"></i>
                </div>
                <h2 class="text-2xl font-extrabold tracking-tight text-white mb-2">Valid Gift Code!</h2>
                <p class="text-sm text-gray-500 mb-8">Here's what you'll receive:</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="p-4 rounded-xl bg-white/5 border border-white/[0.06] text-center">
                    <div class="w-10 h-10 rounded-lg bg-primary/20 text-primary flex items-center justify-center text-xl mx-auto mb-2">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h6 class="font-bold text-sm text-white mb-0">Plan</h6>
                    <p class="text-2xl font-black text-white mb-0" id="giftPlan">-</p>
                </div>
                <div class="p-4 rounded-xl bg-white/5 border border-white/[0.06] text-center">
                    <div class="w-10 h-10 rounded-lg bg-primary/20 text-primary flex items-center justify-center text-xl mx-auto mb-2">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <h6 class="font-bold text-sm text-white mb-0">Duration</h6>
                    <p class="text-2xl font-black text-white mb-0" id="giftDuration">-</p>
                </div>
            </div>

            <div class="hidden mb-8 p-5 rounded-2xl bg-primary/5 border border-primary/20 relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-transparent via-primary/30 to-transparent"></div>
                <div class="relative z-10">
                    <i class="fas fa-comment-alt text-primary text-xl mb-3 block"></i>
                    <p class="text-sm text-gray-300 italic leading-relaxed" id="giftMessageContent">-</p>
                    <p class="text-xs text-gray-500 mt-3 mb-0">— <span class="text-primary font-bold" id="purchaserName">Someone special</span></p>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white/5 border border-white/10 text-center mb-8">
                <p class="text-sm text-gray-500"><i class="fas fa-envelope text-primary mr-2"></i>This gift is for: <strong class="text-gray-300" id="recipientEmail">-</strong></p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="gift-activate.html?id=<?php echo $_GET['code'] ?? ''; ?>" class="px-6 py-3.5 rounded-xl bg-primary text-white font-bold hover:bg-primary/80 transition-colors shadow-[0_0_20px_rgba(217,104,80,0.3)]">
                    <i class="fas fa-unlock mr-2"></i>Activate This Gift
                </a>
                <button onclick="window.location.reload()" class="px-6 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors">
                    <i class="fas fa-search mr-2"></i>Check Another Code
                </button>
            </div>
        </div>
    </div>
<?php
}
