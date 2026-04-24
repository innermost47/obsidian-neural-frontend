<div id="section-email-logs" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-envelope-open-text mr-3 text-primary"></i>Email Logs</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">View, filter, and retry failed emails sent by the system.</p>
    </div>
    <div class="p-6 lg:p-12 space-y-5">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-envelope text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Total Emails</h6>
                </div>
                <div class="text-2xl font-black text-white" id="email-stats-total">—</div>
                <p class="text-xs text-gray-600 mt-1">Last 30 days</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-success/20 text-success flex items-center justify-center"><i class="fas fa-check-circle text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Sent</h6>
                </div>
                <div class="text-2xl font-black text-success" id="email-stats-sent">—</div>
                <p class="text-xs text-gray-600 mt-1">Success rate: <span id="email-stats-rate">—</span>%</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-danger/20 text-danger flex items-center justify-center"><i class="fas fa-exclamation-circle text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Failed</h6>
                </div>
                <div class="text-2xl font-black text-danger" id="email-stats-failed">—</div>
                <p class="text-xs text-gray-600 mt-1">Need attention</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-warning/20 text-warning flex items-center justify-center"><i class="fas fa-clock text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Pending</h6>
                </div>
                <div class="text-2xl font-black text-warning" id="email-stats-pending">—</div>
                <p class="text-xs text-gray-600 mt-1">In queue</p>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-end">
                <div><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Status</label>
                    <select class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-primary focus:outline-none transition-colors text-sm appearance-none" id="email-filter-status">
                        <option value="" class="bg-black">All Status</option>
                        <option value="sent" class="bg-black">Sent</option>
                        <option value="failed" class="bg-black">Failed</option>
                        <option value="pending" class="bg-black">Pending</option>
                        <option value="retrying" class="bg-black">Retrying</option>
                    </select>
                </div>
                <div><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Type</label>
                    <select class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-primary focus:outline-none transition-colors text-sm appearance-none" id="email-filter-type">
                        <option value="" class="bg-black">All Types</option>
                        <option value="welcome" class="bg-black">Welcome</option>
                        <option value="verification" class="bg-black">Verification</option>
                        <option value="password_reset" class="bg-black">Password Reset</option>
                        <option value="subscription_confirmation" class="bg-black">Subscription Confirmed</option>
                        <option value="subscription_cancelled" class="bg-black">Subscription Cancelled</option>
                        <option value="gift_notification" class="bg-black">Gift Notification</option>
                        <option value="expiration_warning" class="bg-black">Expiration Warning</option>
                        <option value="day2_promo" class="bg-black">Day 2 Promo</option>
                        <option value="day7_promo" class="bg-black">Day 7 Promo</option>
                        <option value="no_generation_help" class="bg-black">No Generation Help</option>
                    </select>
                </div>
                <div><label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Search</label><input type="text" class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-primary focus:outline-none transition-colors text-sm" id="email-filter-search" placeholder="Search by email or subject..." /></div>
                <button onclick="loadEmailLogs()" class="w-full px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform"><i class="fas fa-search mr-2"></i>Filter</button>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex flex-wrap justify-between items-center gap-3 mb-4">
                <h3 class="text-sm font-bold text-white m-0"><i class="fas fa-list mr-2 text-primary"></i>Email Logs</h3>
                <div class="flex gap-2">
                    <button onclick="retryFailedEmails()" id="retry-failed-btn" class="px-3 py-1.5 rounded-lg bg-danger/10 border border-danger/30 text-danger font-bold text-xs hover:bg-danger/20 transition-colors"><i class="fas fa-redo mr-1"></i>Retry Failed</button>
                    <button onclick="loadEmailLogs()" class="px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-sync mr-1"></i>Refresh</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs border-separate border-spacing-0">
                    <thead>
                        <tr>
                            <th class="px-3 py-2.5 text-left bg-white/[0.02] border-b border-white/[0.06]"><input type="checkbox" id="select-all-emails" onchange="toggleAllEmails(this)" class="accent-primary" /></th>
                            <?php foreach (['ID', 'Recipient', 'Subject', 'Type', 'Status', 'Retries', 'Created', 'Sent', 'Actions'] as $h): ?>
                                <th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06] whitespace-nowrap"><?= $h ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody id="email-logs-tbody">
                        <tr>
                            <td colspan="10" class="text-center py-10 text-gray-600"><i class="fas fa-spinner fa-spin text-2xl"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-wrap justify-between items-center gap-3 mt-4">
                <span class="text-xs text-gray-500" id="email-logs-info">Showing 0 of 0 emails</span>
                <nav>
                    <ul class="flex gap-1" id="email-logs-pagination"></ul>
                </nav>
            </div>
        </div>

    </div>
</div>