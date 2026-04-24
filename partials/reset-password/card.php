<div class="bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10">

        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-lock-open"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-1">Reset Your Password</h1>
            <p class="text-sm text-gray-500">Enter your new password below</p>
        </div>

        <div id="success-alert" class="hidden mb-6 p-4 rounded-2xl bg-success/10 border border-success/30 text-success text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="success-message"></span>
        </div>

        <div id="error-alert" class="hidden mb-6 p-4 rounded-2xl bg-danger/10 border border-danger/30 text-danger text-sm font-medium">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span id="error-message"></span>
        </div>

        <div id="invalid-token-container" class="hidden text-center py-4">
            <div class="w-16 h-16 rounded-2xl bg-warning/20 text-warning flex items-center justify-center text-3xl mx-auto mb-5">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h2 class="text-xl font-extrabold text-white mb-3">Invalid or Expired Link</h2>
            <p class="text-sm text-gray-500 mb-6">
                This password reset link is invalid or has expired. Reset links are only valid for 1 hour.
            </p>
            <a href="forgot-password.php"
                class="block w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-center hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                <i class="fas fa-redo mr-2"></i>Request New Link
            </a>
        </div>

        <form id="reset-password-form">
            <div class="mb-5">
                <label for="password" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">
                    <i class="fas fa-lock mr-2 text-gray-600"></i>New Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        placeholder="••••••••"
                        required
                        minlength="8"
                        autocomplete="new-password"
                        class="w-full px-4 py-3 pr-12 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
                    <button type="button" onclick="togglePassword('password', 'password-icon')"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-600 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>Minimum 8 characters
                </p>
            </div>

            <div class="mb-6">
                <label for="confirm-password" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">
                    <i class="fas fa-check-circle mr-2 text-gray-600"></i>Confirm Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="confirm-password"
                        placeholder="••••••••"
                        required
                        minlength="8"
                        autocomplete="new-password"
                        class="w-full px-4 py-3 pr-12 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
                    <button type="button" onclick="togglePassword('confirm-password', 'confirm-password-icon')"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors">
                        <i class="fas fa-eye" id="confirm-password-icon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                <i class="fas fa-check mr-2"></i>
                <span id="submit-text">Reset Password</span>
            </button>
        </form>

        <div class="flex items-center gap-4 my-6">
            <div class="flex-1 h-px bg-white/[0.06]"></div>
            <span class="text-xs text-gray-600 uppercase tracking-widest">or</span>
            <div class="flex-1 h-px bg-white/[0.06]"></div>
        </div>

        <a href="login.php"
            class="block w-full px-8 py-4 rounded-xl border border-white/20 text-white font-bold text-center hover:bg-white/5 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Back to Login
        </a>

    </div>
</div>