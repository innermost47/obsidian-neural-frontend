<div class="bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10">

        <div id="loading-container" class="text-center">
            <div class="w-16 h-16 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-1">Verifying Your Email...</h1>
            <p class="text-sm text-gray-500">Please wait a moment</p>
        </div>

        <div id="success-container" class="hidden text-center">
            <div class="w-16 h-16 rounded-2xl bg-success/20 text-success flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Email Verified!</h1>
            <p class="text-sm text-gray-500 mb-6">Your email has been successfully verified. You can now access your dashboard.</p>
            <a href="dashboard.php"
                class="block w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-center hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)] mb-6">
                <i class="fas fa-chart-line mr-2"></i>Go to Dashboard
            </a>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5 text-left">
                <h3 class="text-sm font-bold text-white mb-4">
                    <i class="fas fa-gift text-success mr-2"></i>What's Next?
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-sm text-gray-400">
                        <i class="fas fa-bolt text-warning text-xs w-4"></i>You have 20 free credits
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-400">
                        <i class="fas fa-download text-primary text-xs w-4"></i>Download the VST plugin
                    </li>
                    <li class="flex items-center gap-3 text-sm text-gray-400">
                        <i class="fas fa-music text-success text-xs w-4"></i>Start generating audio!
                    </li>
                </ul>
            </div>
        </div>

        <div id="error-container" class="hidden text-center">
            <div class="w-16 h-16 rounded-2xl bg-warning/20 text-warning flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Verification Failed</h1>
            <p class="text-sm text-gray-500 mb-6" id="error-message">This verification link is invalid or has expired.</p>
            <div class="mb-4">
                <input
                    type="email"
                    id="resend-email"
                    placeholder="your@email.com"
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
            </div>
            <button onclick="resendVerification()" id="resend-btn"
                class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)] mb-4">
                <i class="fas fa-paper-plane mr-2"></i>
                <span id="resend-text">Resend Verification Email</span>
            </button>
            <div class="flex items-center gap-4 my-5">
                <div class="flex-1 h-px bg-white/[0.06]"></div>
                <span class="text-xs text-gray-600 uppercase tracking-widest">or</span>
                <div class="flex-1 h-px bg-white/[0.06]"></div>
            </div>
            <a href="register.php"
                class="block w-full px-8 py-4 rounded-xl border border-white/20 text-white font-bold text-center hover:bg-white/5 transition-colors">
                <i class="fas fa-user-plus mr-2"></i>Create New Account
            </a>
        </div>

        <div id="already-verified-container" class="hidden text-center">
            <div class="w-16 h-16 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-info-circle"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Already Verified</h1>
            <p class="text-sm text-gray-500 mb-6">This email address has already been verified.</p>
            <a href="login.php"
                class="block w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-center hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)] mb-3">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </a>
            <a href="dashboard.php"
                class="block w-full px-8 py-4 rounded-xl border border-white/20 text-white font-bold text-center hover:bg-white/5 transition-colors">
                <i class="fas fa-chart-line mr-2"></i>Go to Dashboard
            </a>
        </div>

    </div>
</div>