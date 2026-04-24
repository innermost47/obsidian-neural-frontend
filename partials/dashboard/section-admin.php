<div id="section-admin" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-shield-alt mr-3 text-primary"></i>Admin Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Manage users, view statistics, and system settings.</p>
    </div>
    <div class="p-6 lg:p-12">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-users text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Total Users</h6>
                </div>
                <div class="text-2xl font-black text-white" id="stat-total-users">—</div>
                <p class="text-xs text-gray-600 mt-1">Registered accounts</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-user-check text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Verified Users</h6>
                </div>
                <div class="text-2xl font-black text-white" id="stat-verified">—</div>
                <p class="text-xs text-gray-600 mt-1">Email verified</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-crown text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Paid Users</h6>
                </div>
                <div class="text-2xl font-black text-white" id="stat-paid">—</div>
                <p class="text-xs text-gray-600 mt-1">Active subscriptions</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-bolt text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Generations</h6>
                </div>
                <div class="text-2xl font-black text-white" id="stat-generations">—</div>
                <p class="text-xs text-gray-600 mt-1">Total audio generated</p>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
                <h3 class="text-sm font-bold text-white m-0"><i class="fas fa-users mr-2 text-primary"></i>All Users (<span id="user-count">0</span>)</h3>
                <input type="text" id="searchInput" placeholder="Search by email..." class="w-full max-w-xs px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-white text-sm placeholder-gray-600 focus:border-primary focus:outline-none transition-colors" />
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs border-separate border-spacing-0">
                    <thead>
                        <tr>
                            <?php foreach (['ID', 'Email', 'Tier', 'Status', 'Credits', 'Generations', 'Accept News', 'Created', 'Actions'] as $h): ?>
                                <th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap"><?= $h ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <tr>
                            <td colspan="9" class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>