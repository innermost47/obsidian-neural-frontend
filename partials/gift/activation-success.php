<div id="giftDetails" class="hidden">
    <div class="bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
        <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <h2 class="text-2xl font-extrabold tracking-tight text-white mb-8 text-center">
                <i class="fas fa-check-circle text-success mr-2"></i>Gift Activated!
            </h2>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <?php render_activation_card(['icon' => 'fas fa-layer-group', 'icon_color' => 'text-primary', 'value_id' => 'giftPlan', 'title' => 'Plan']); ?>
                <?php render_activation_card(['icon' => 'fas fa-calendar', 'icon_color' => 'text-primary', 'value_id' => 'giftDuration', 'title' => 'Duration']); ?>
            </div>

            <div id="giftMessageBox" class="hidden mb-8 p-5 rounded-2xl bg-primary/5 border border-primary/20 relative overflow-hidden">
                <div class="absolute -top-0 inset-x-0 h-1 bg-gradient-to-r from-transparent via-primary/30 to-transparent"></div>
                <div class="relative z-10">
                    <i class="fas fa-comment-alt text-primary text-2xl mb-3 block"></i>
                    <p class="text-sm text-gray-300 italic leading-relaxed" id="giftMessageContent"></p>
                    <p class="text-xs text-gray-500 mt-3 mb-0">— <span class="text-primary font-bold" id="purchaserName">Someone special</span></p>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
                <p class="text-sm text-gray-500 mb-5"><i class="fas fa-info-circle text-primary mr-2"></i><strong class="text-gray-300">To activate this gift, you need to sign in or create an account.</strong></p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="login.php" class="px-6 py-3 rounded-xl bg-primary text-white font-bold hover:bg-primary/80 transition-colors shadow-[0_0_20px_rgba(217,104,80,0.3)]">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </a>
                    <a href="register.php" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>