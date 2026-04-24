<div id="section-security" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-shield-alt mr-3 text-primary"></i>Security Settings</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Enhance your account security with 2FA and email verification.</p>
    </div>
    <div class="p-6 lg:p-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
                <div class="w-12 h-12 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl mb-4"><i class="fas fa-mobile-alt"></i></div>
                <h3 class="text-base font-bold text-white mb-2">Two-Factor Authentication</h3>
                <p class="text-sm text-gray-500 mb-4">Add an extra layer of security to your account</p>
                <div class="mb-4"><span class="inline-block px-3 py-1 rounded-full text-xs font-bold" id="2fa-status-badge">Loading...</span></div>
                <button onclick="toggle2FA()" id="2fa-toggle-btn" class="px-4 py-2 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-cog mr-1"></i><span id="2fa-btn-text">Setup</span></button>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
                <div class="w-12 h-12 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl mb-4"><i class="fas fa-envelope"></i></div>
                <h3 class="text-base font-bold text-white mb-2">Email Verification</h3>
                <p class="text-sm text-gray-500 mb-4">Verify your email address</p>
                <div class="mb-4"><span class="inline-block px-3 py-1 rounded-full text-xs font-bold" id="email-status-badge">Loading...</span></div>
            </div>
        </div>
    </div>
</div>