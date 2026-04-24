<div id="section-preferences" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-cog mr-3 text-primary"></i>Preferences</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Customize your account preferences and notifications.</p>
    </div>
    <div class="p-6 lg:p-12">
        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6">
            <h3 class="text-base font-bold text-white mb-5"><i class="fas fa-bell mr-2 text-primary"></i>Email Preferences</h3>
            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" id="newsUpdatesToggle" onchange="updateEmailPreferences()" class="mt-0.5 w-4 h-4 rounded border-white/20 bg-white/5 accent-primary cursor-pointer" />
                <div>
                    <span class="text-sm font-bold text-white">Receive product news and updates</span>
                    <p class="text-xs text-gray-500 mt-1">Stay informed about new features and improvements</p>
                </div>
            </label>
        </div>
    </div>
</div>