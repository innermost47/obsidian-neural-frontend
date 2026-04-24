<div class="bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-3xl p-6 md:p-8 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10">

        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-1">Welcome Back</h1>
            <p class="text-sm text-gray-500">Sign in to access your dashboard</p>
        </div>

        <div id="error-alert" class="hidden mb-6 p-4 rounded-2xl bg-danger/10 border border-danger/30 text-danger text-sm font-medium">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span id="error-message"></span>
        </div>

        <div id="2fa-container" class="hidden">
            <div class="text-center mb-6">
                <div class="w-14 h-14 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h2 class="text-xl font-extrabold text-white mb-1">Two-Factor Authentication</h2>
                <p class="text-sm text-gray-500">Enter the 6-digit code from your authenticator app</p>
            </div>

            <form id="2fa-form">
                <div class="mb-6">
                    <input
                        type="text"
                        id="2fa-code"
                        placeholder="000000"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        required
                        autocomplete="off"
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-center text-2xl tracking-[0.5em] placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
                </div>
                <button type="submit" id="2fa-submit-btn"
                    class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)] mb-3">
                    <i class="fas fa-check mr-2"></i>
                    <span id="2fa-submit-text">Verify</span>
                </button>
                <button type="button" onclick="backToLogin()"
                    class="w-full px-8 py-3 rounded-xl border border-white/10 text-gray-400 font-medium hover:bg-white/5 transition-colors text-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Back to login
                </button>
            </form>
        </div>

        <form id="login-form">
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

            <div class="mb-6">
                <label for="password" class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">
                    <i class="fas fa-lock mr-2 text-gray-600"></i>Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                        class="w-full px-4 py-3 pr-12 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white transition-colors">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
                <div class="text-right mt-2">
                    <a href="forgot-password.php" class="text-xs text-gray-500 hover:text-white transition-colors">
                        <i class="fas fa-question-circle mr-1"></i>Forgot password?
                    </a>
                </div>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)] mb-3">
                <i class="fas fa-sign-in-alt mr-2"></i>
                <span id="submit-text">Log In</span>
            </button>

            <button type="button" id="google-login-btn" onclick="loginWithGoogle()"
                class="w-full px-8 py-4 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors flex items-center justify-center gap-3">
                <img src="assets/images/google-logo.png" alt="Google" class="w-5 h-5" />
                <span>Continue with Google</span>
            </button>
        </form>

        <div class="flex items-center gap-4 my-6">
            <div class="flex-1 h-px bg-white/[0.06]"></div>
            <span class="text-xs text-gray-600 uppercase tracking-widest">or</span>
            <div class="flex-1 h-px bg-white/[0.06]"></div>
        </div>
        <div class="text-center">
            <p class="text-sm text-gray-500 mb-3">Don't have an account?</p>
            <a href="register.php"
                class="block w-full px-8 py-4 rounded-xl border border-white/20 text-white font-bold text-center hover:bg-white/5 transition-colors">
                <i class="fas fa-user-plus mr-2"></i>Create Account
            </a>
        </div>

    </div>
</div>