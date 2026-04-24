<div id="section-danger" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-exclamation-triangle mr-3 text-danger"></i>Danger Zone</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Irreversible and destructive actions.</p>
    </div>
    <div class="p-6 lg:p-12">
        <div class="bg-danger/[0.05] border border-danger/30 rounded-2xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-danger/20 text-danger flex items-center justify-center"><i class="fas fa-exclamation-triangle"></i></div>
                <h3 class="text-base font-bold text-danger m-0">Delete Account</h3>
            </div>
            <p class="text-sm text-gray-400 mb-3">Once you delete your account, there is no going back. This action will:</p>
            <ul class="text-sm text-gray-500 mb-6 space-y-1 list-disc list-inside">
                <li>Permanently delete all your data</li>
                <li>Cancel all active subscriptions</li>
                <li>Revoke your API access</li>
                <li>Delete all your generated content</li>
            </ul>
            <button id="open-delete-modal" onclick="document.getElementById('deleteAccountModal').classList.remove('hidden')" class="px-6 py-3 rounded-xl bg-danger/10 border border-danger/30 text-danger font-bold text-sm hover:bg-danger/20 transition-colors">
                <i class="fas fa-trash-alt mr-2"></i>Delete My Account
            </button>
        </div>
    </div>
</div>