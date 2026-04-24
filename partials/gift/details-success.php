<section class="relative z-20 py-8 px-4" id="giftInfoSection">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Gift Details</h2>
                </div>

                <!-- Loading State -->
                <div id="loadingState" class="text-center py-10">
                    <div class="w-12 h-12 border-2 border-white/10 border-t-primary rounded-full animate-spin mx-auto mb-4"></div>
                    <p class="text-sm text-gray-500">Checking gift code...</p>
                </div>

                <!-- Gift Details -->
                <div id="giftDetails" style="display: none">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5 text-center">
                            <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl mx-auto mb-3">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Plan</p>
                            <p class="text-xl font-black text-white" id="giftPlan">—</p>
                        </div>
                        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5 text-center">
                            <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl mx-auto mb-3">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Duration</p>
                            <p class="text-xl font-black text-white" id="giftDuration">—</p>
                        </div>
                    </div>

                    <div id="giftMessageBox" class="hidden mb-6 p-5 rounded-2xl bg-white/[0.03] border border-white/[0.06]">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            <i class="fas fa-comment-alt mr-2 text-primary"></i>Personal message from <span class="text-white" id="purchaserName">someone special</span>
                        </p>
                        <p class="text-sm text-gray-300 italic" id="giftMessageContent"></p>
                    </div>

                    <div class="mb-6 p-4 rounded-2xl bg-warning/10 border border-warning/20 text-sm text-warning font-medium">
                        <i class="fas fa-info-circle mr-2"></i>
                        To activate this gift, you need to sign in or create an account.
                    </div>

                    <div class="flex flex-col gap-3">
                        <a href="login.php"
                            class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-center hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                            <i class="fas fa-sign-in-alt mr-2"></i>Sign In to Activate
                        </a>
                        <a href="register.php"
                            class="w-full px-8 py-4 rounded-xl border border-white/20 text-white font-bold text-center hover:bg-white/5 transition-colors">
                            <i class="fas fa-user-plus mr-2"></i>Create Account
                        </a>
                    </div>
                </div>

                <!-- Error State -->
                <div id="errorState" style="display: none">
                    <div class="text-center py-8">
                        <div class="w-16 h-16 rounded-2xl bg-danger/20 text-danger flex items-center justify-center text-3xl mx-auto mb-5">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h4 class="text-xl font-extrabold text-white mb-3">Invalid or Expired Gift Code</h4>
                        <p class="text-sm text-gray-500 mb-6" id="errorMessage">
                            This gift code is not valid or has already been used.
                        </p>
                        <a href="index.php"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-white/20 text-white font-bold hover:bg-white/5 transition-colors">
                            <i class="fas fa-home"></i>Back to Home
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>