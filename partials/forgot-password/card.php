<div class="bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10">

        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-key"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-1">Forgot Password?</h1>
            <p class="text-sm text-gray-500">No worries! Enter your email and we'll send you a reset link.</p>
        </div>

        <div id="success-alert" class="hidden mb-6 p-4 rounded-2xl bg-success/10 border border-success/30 text-success text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="success-message"></span>
        </div>

        <div id="error-alert" class="hidden mb-6 p-4 rounded-2xl bg-danger/10 border border-danger/30 text-danger text-sm font-medium">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span id="error-message"></span>
        </div>

        <form id="forgot-password-form">
            <div class="mb-6">
                <label for="email" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">
                    <i class="fas fa-envelope mr-2 text-gray-600"></i>Email Address
                </label>
                <input
                    type="email"
                    id="email"
                    placeholder="you@example.com"
                    required
                    autocomplete="email"
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
                <p class="text-xs text-gray-600 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>We'll send a reset link to this email
                </p>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                <i class="fas fa-paper-plane mr-2"></i>
                <span id="submit-text">Send Reset Link</span>
            </button>
        </form>

        <div class="flex items-center gap-4 my-6">
            <div class="flex-1 h-px bg-white/[0.06]"></div>
            <span class="text-xs text-gray-600 uppercase tracking-widest">or</span>
            <div class="flex-1 h-px bg-white/[0.06]"></div>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-500 mb-3">Remember your password?</p>
            <a href="login.php"
                class="block w-full px-8 py-4 rounded-xl border border-white/20 text-white font-bold text-center hover:bg-white/5 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Login
            </a>
        </div>

    </div>
</div>