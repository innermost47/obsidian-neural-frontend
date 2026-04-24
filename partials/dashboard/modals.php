<div id="deleteAccountModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="document.getElementById('deleteAccountModal').classList.add('hidden')"></div>
    <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-md overflow-hidden">
        <div class="bg-danger/20 border-b border-danger/30 px-6 py-4 flex items-center justify-between">
            <h5 class="font-bold text-danger m-0"><i class="fas fa-exclamation-triangle mr-2"></i>Confirm Account Deletion</h5>
            <button onclick="document.getElementById('deleteAccountModal').classList.add('hidden')" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6">
            <div class="bg-danger/10 border border-danger/30 rounded-xl p-3 mb-4 text-sm text-danger font-medium"><strong>Warning:</strong> This action cannot be undone!</div>
            <p class="text-sm text-gray-400 mb-4">Are you absolutely sure you want to delete your account?</p>
            <div id="oauthWarning" class="hidden bg-primary/10 border border-primary/30 rounded-xl p-3 mb-4 text-sm text-gray-300"><i class="fab fa-google mr-2 text-primary"></i><strong>Note:</strong> Your account is linked to Google. Deleting it here won't affect your Google account.</div>
            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Please type your email to confirm:</label>
                <input type="email" id="confirmEmail" placeholder="your@email.com" autocomplete="off" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors text-sm" />
                <p class="text-xs text-gray-600 mt-1" id="userEmailHint"></p>
            </div>
            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" id="confirmUnderstand" class="mt-0.5 accent-danger cursor-pointer" />
                <span class="text-sm text-danger">I understand that this action is permanent and cannot be reversed</span>
            </label>
        </div>
        <div class="px-6 pb-6 flex justify-end gap-3">
            <button onclick="document.getElementById('deleteAccountModal').classList.add('hidden')" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors">Cancel</button>
            <button id="confirmDeleteBtn" disabled class="px-5 py-2.5 rounded-xl bg-danger/20 border border-danger/30 text-danger font-bold text-sm opacity-50 cursor-not-allowed transition-all"><i class="fas fa-trash-alt mr-2"></i>Yes, Delete My Account</button>
        </div>
    </div>
</div>

<div id="deleteFeedbackModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
    <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-md overflow-hidden">
        <div id="feedbackModalHeader" class="px-6 py-4 border-b border-white/10">
            <h5 class="font-bold text-white m-0" id="deleteFeedbackModalLabel"><i class="fas fa-check-circle mr-2"></i>Account Deleted</h5>
        </div>
        <div class="p-6 text-sm text-gray-400" id="feedbackModalBody">Your account has been permanently deleted.</div>
        <div class="px-6 pb-6 flex justify-end">
            <button id="feedbackModalBtn" onclick="window.location.href='index.php'" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform">Go to Home</button>
        </div>
    </div>
</div>

<div id="emailLogDetailModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="document.getElementById('emailLogDetailModal').classList.add('hidden')"></div>
    <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
            <h5 class="font-bold text-white m-0"><i class="fas fa-envelope-open-text mr-2 text-primary"></i>Email Details</h5>
            <button onclick="document.getElementById('emailLogDetailModal').classList.add('hidden')" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6 overflow-y-auto flex-1" id="emailLogDetailBody">
            <div class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></div>
        </div>
        <div class="px-6 pb-6 flex justify-end">
            <button onclick="document.getElementById('emailLogDetailModal').classList.add('hidden')" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors">Close</button>
        </div>
    </div>
</div>

<div id="2fa-modal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="document.getElementById('2fa-modal').classList.add('hidden')"></div>
    <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
            <h5 class="font-bold text-white m-0"><i class="fas fa-mobile-alt mr-2 text-primary"></i><span id="modal-title">Setup Two-Factor Authentication</span></h5>
            <button onclick="document.getElementById('2fa-modal').classList.add('hidden')" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6">
            <div id="setup-2fa-content">
                <div class="text-center mb-5">
                    <p class="text-sm text-gray-400 mb-3">Scan this QR code with your authenticator app:</p>
                    <div id="qr-code-container" class="mb-3"><img id="qr-code-img" src="" alt="QR Code" class="max-w-[200px] mx-auto" /></div>
                    <p class="text-xs text-gray-500 mb-2">Or enter this code manually:</p>
                    <code id="manual-code" class="block bg-black/40 border border-white/10 rounded-xl px-4 py-2 text-primary font-mono text-sm"></code>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Enter 6-digit code to verify:</label>
                    <input type="text" id="verify-code" placeholder="000000" maxlength="6" pattern="[0-9]{6}" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-center text-xl tracking-[0.5em] placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
                </div>
                <div class="bg-warning/10 border border-warning/30 rounded-xl p-3 mb-4 text-xs text-warning font-medium"><i class="fas fa-exclamation-triangle mr-2"></i><strong>Save your backup codes!</strong> You'll receive them after verification.</div>
                <button onclick="verifySetup2FA()" class="w-full px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fas fa-check mr-2"></i>Verify &amp; Enable 2FA</button>
            </div>
            <div id="backup-codes-content" class="hidden">
                <div class="bg-success/10 border border-success/30 rounded-xl p-3 mb-4 text-sm text-success font-medium"><i class="fas fa-check-circle mr-2"></i>2FA enabled successfully!</div>
                <p class="text-sm font-bold text-white mb-2">Save these backup codes in a safe place:</p>
                <div class="bg-black/40 border border-white/10 rounded-xl p-4 mb-4"><code id="backup-codes-list" class="text-xs text-gray-300 font-mono"></code></div>
                <div class="bg-warning/10 border border-warning/30 rounded-xl p-3 mb-4 text-xs text-warning font-medium"><i class="fas fa-exclamation-triangle mr-2"></i>These codes can be used if you lose access to your authenticator app.</div>
                <button onclick="downloadBackupCodes()" class="w-full px-6 py-3 rounded-xl bg-success/20 border border-success/30 text-success font-bold text-sm hover:bg-success/30 transition-colors"><i class="fas fa-download mr-2"></i>Download Backup Codes</button>
            </div>
            <div id="disable-2fa-content" class="hidden">
                <div class="bg-warning/10 border border-warning/30 rounded-xl p-3 mb-4 text-sm text-warning font-medium"><i class="fas fa-exclamation-triangle mr-2"></i><strong>Warning:</strong> Disabling 2FA will make your account less secure.</div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Enter 6-digit code to confirm:</label>
                    <input type="text" id="disable-code" placeholder="000000" maxlength="6" pattern="[0-9]{6}" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white text-center text-xl tracking-[0.5em] placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
                </div>
                <button onclick="confirmDisable2FA()" class="w-full px-6 py-3 rounded-xl bg-danger/20 border border-danger/30 text-danger font-bold text-sm hover:bg-danger/30 transition-colors"><i class="fas fa-times mr-2"></i>Disable 2FA</button>
            </div>
        </div>
    </div>
</div>

<div id="userDetailModal" class="hidden fixed inset-0 z-[2000] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="document.getElementById('userDetailModal').classList.add('hidden')"></div>
    <div class="relative bg-[#1a1a1c] border border-white/10 rounded-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
            <h5 class="font-bold text-white m-0"><i class="fas fa-user-circle mr-2 text-primary"></i>User Details</h5>
            <button onclick="document.getElementById('userDetailModal').classList.add('hidden')" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6 overflow-y-auto flex-1" id="userDetailBody">
            <div class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></div>
        </div>
        <div class="px-6 pb-6 flex justify-end">
            <button onclick="document.getElementById('userDetailModal').classList.add('hidden')" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors">Close</button>
        </div>
    </div>
</div>

<script>
    window.toggleSidebar = function() {
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebar-overlay');
        var isOpen = !sidebar.classList.contains('-translate-x-full');
        if (isOpen) {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        } else {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }
    };

    document.getElementById('confirmEmail')?.addEventListener('input', validateDeleteForm);
    document.getElementById('confirmUnderstand')?.addEventListener('change', validateDeleteForm);

    function validateDeleteForm() {
        var btn = document.getElementById('confirmDeleteBtn');
        var email = document.getElementById('confirmEmail')?.value.trim();
        var check = document.getElementById('confirmUnderstand')?.checked;
        if (email && check && typeof currentUserEmail !== 'undefined' && email === currentUserEmail) {
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }
    document.getElementById('confirmDeleteBtn')?.addEventListener('click', deleteAccount);
    document.getElementById('open-delete-modal')?.addEventListener('click', function() {
        document.getElementById('deleteAccountModal').classList.remove('hidden');
    });
</script>