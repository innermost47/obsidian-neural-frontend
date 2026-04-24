<div class="bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10">

        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-1">Create Your Account</h1>
            <p class="text-sm text-gray-500">
                <i class="fas fa-gift mr-2 text-gray-600"></i>Start with <strong class="text-white">20 free credits</strong>
            </p>
        </div>

        <div id="error-alert" class="hidden mb-6 p-4 rounded-2xl bg-danger/10 border border-danger/30 text-danger text-sm font-medium">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span id="error-message"></span>
        </div>

        <form id="register-form">
            <div class="mb-5">
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
            </div>

            <div class="mb-5">
                <label for="password" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">
                    <i class="fas fa-lock mr-2 text-gray-600"></i>Password
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
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-600 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>Minimum 8 characters
                </p>
            </div>

            <div class="mb-6">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        id="acceptNewsUpdates"
                        checked
                        class="mt-0.5 w-4 h-4 rounded border-white/20 bg-white/5 accent-primary cursor-pointer" />
                    <span class="text-xs text-gray-500">
                        <i class="fas fa-envelope mr-1 text-gray-600"></i>
                        <span id="newsletter-label">I want to receive news and updates</span>
                    </span>
                </label>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)] mb-3">
                <i class="fas fa-rocket mr-2"></i>
                <span id="submit-text">Create Account</span>
            </button>

            <button type="button" id="google-register-btn" onclick="registerWithGoogle()"
                class="w-full px-8 py-4 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors flex items-center justify-center gap-3 mb-5">
                <img src="assets/images/google-logo.png" alt="Google" class="w-5 h-5" />
                <span>Continue with Google</span>
            </button>

            <p class="text-center text-xs text-gray-600">
                By signing up, you agree to our
                <a href="terms-of-service.php" class="text-gray-400 hover:text-white transition-colors">Terms</a>
                and
                <a href="privacy-policy.php" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
            </p>
        </form>

        <div class="flex items-center gap-4 my-6">
            <div class="flex-1 h-px bg-white/[0.06]"></div>
            <span class="text-xs text-gray-600 uppercase tracking-widest">or</span>
            <div class="flex-1 h-px bg-white/[0.06]"></div>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-500 mb-3">Already have an account?</p>
            <a href="login.php"
                class="block w-full px-8 py-4 rounded-xl border border-white/20 text-white font-bold text-center hover:bg-white/5 transition-colors">
                <i class="fas fa-sign-in-alt mr-2"></i>Log In
            </a>
        </div>

    </div>
</div>