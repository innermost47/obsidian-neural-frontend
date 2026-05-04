<div id="section-provider-stats" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-server mr-3 text-primary"></i>My Provider Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Your node's performance and your share of the network revenue.</p>
    </div>
    <div class="p-6 lg:p-12 space-y-5">

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5" id="provider-status-card">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-server"></i></div>
                    <div>
                        <div class="flex items-center gap-2 font-bold text-white text-lg" id="provider-name">—<span id="provider-online-indicator"></span></div>
                        <div class="text-xs text-gray-500">Last seen: <span id="provider-last-seen">—</span></div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span id="provider-status-badge" class="px-3 py-1 rounded-full text-xs font-bold bg-white/10 text-gray-400">Loading...</span>
                    <div class="text-right">
                        <div class="font-bold text-white" id="provider-uptime">—</div>
                        <div class="text-xs text-gray-500">today's presence</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-bold text-white"><i class="fas fa-clock mr-2 text-primary"></i>Monthly Uptime Goal (8h/day)</span>
                <span class="text-xs text-gray-500" id="uptime-month-label">—</span>
            </div>
            <div class="h-3 rounded-full bg-white/5 overflow-hidden">
                <div id="uptime-month-bar" class="h-full rounded-full bg-gradient-to-r from-primary to-[#a04840] transition-all" style="width:0%"></div>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-bold text-white"><i class="fas fa-calendar-check mr-2 text-primary"></i>Presence days</span>
                <span class="text-xs text-gray-500">Target: 80%</span>
            </div>
            <div class="flex items-baseline gap-1.5 mb-3">
                <span class="text-2xl font-black text-white" id="stat-days-present">0</span>
                <span class="text-sm text-gray-500">/ <span id="stat-total-days-month">0</span> days</span>
                <span class="ml-auto text-lg font-black" id="stat-days-percent">0%</span>
            </div>
            <div class="h-2 rounded-full bg-white/5 overflow-hidden">
                <div id="days-present-bar" class="h-full rounded-full transition-all duration-500" style="width:0%; background: #ef4444;"></div>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-bold text-white" id="period-label">—</span>
                <span class="text-xs text-gray-500" id="month-progress-label">—</span>
            </div>
            <div class="h-1.5 rounded-full bg-white/5 overflow-hidden">
                <div id="month-progress-bar" class="h-full rounded-full bg-primary transition-all" style="width:0%"></div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-4 text-center">
                <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center mx-auto mb-2"><i class="fas fa-microchip text-sm"></i></div>
                <p class="text-xs text-gray-500 mb-1">My jobs this month</p>
                <div class="text-xl font-black text-primary" id="stat-my-jobs-month">—</div>
                <div class="text-xs text-gray-600" id="stat-my-jobs-total">— total</div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-4 text-center">
                <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center mx-auto mb-2"><i class="fas fa-globe text-sm"></i></div>
                <p class="text-xs text-gray-500 mb-1">Network generations</p>
                <div class="text-xl font-black text-primary" id="stat-global-generations">—</div>
                <div class="text-xs text-gray-600">this month</div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-4 text-center">
                <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center mx-auto mb-2"><i class="fas fa-server text-sm"></i></div>
                <p class="text-xs text-gray-500 mb-1">Active providers</p>
                <div class="text-xl font-black text-primary" id="stat-active-providers">—</div>
                <div class="text-xs text-gray-600">on the network</div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-4 text-center">
                <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center mx-auto mb-2"><i class="fas fa-users text-sm"></i></div>
                <p class="text-xs text-gray-500 mb-1">Paying users</p>
                <div class="text-xl font-black text-primary" id="stat-paying-users">—</div>
                <div class="text-xs text-gray-600">active subscribers</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-euro-sign mr-2 text-primary"></i>Revenue estimate — current month</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-white/[0.03] border border-white/[0.06] rounded-xl">
                        <div>
                            <div class="text-sm font-bold text-white">Platform revenue</div>
                            <div class="text-xs text-gray-500">Total subscriptions</div>
                        </div>
                        <div class="text-lg font-black text-white" id="rev-platform">—</div>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-white/[0.03] border border-white/[0.06] rounded-xl">
                        <div>
                            <div class="text-sm font-bold text-white">Providers pool <span class="bg-success/10 text-success border border-success/30 rounded-full px-2 py-0.5 text-[0.6rem] font-black ml-1">85%</span></div>
                            <div class="text-xs text-gray-500">Split equally among active providers</div>
                        </div>
                        <div class="text-lg font-black text-white" id="rev-pool">—</div>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-primary/10 border border-primary/30 rounded-xl">
                        <div>
                            <div class="text-sm font-bold text-primary">Your estimated share</div>
                            <div class="text-xs text-gray-500">If you stay active all month</div>
                        </div>
                        <div class="text-2xl font-black text-primary" id="rev-my-share">—</div>
                    </div>
                </div>
                <p class="text-xs text-gray-600 mt-3"><i class="fas fa-info-circle mr-1"></i>Estimate based on current subscribers. Final amount depends on uptime eligibility.</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-users mr-2 text-primary"></i>Users by plan</h3>
                <div class="flex flex-col gap-2" id="users-by-tier"></div>
                <div class="border-t border-white/[0.06] mt-4 pt-4 flex justify-between items-center">
                    <span class="text-xs text-gray-500">Public financial report</span>
                    <a href="public.php" id="finances-link" target="_blank" class="px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-external-link-alt mr-1"></i>finances</a>
                </div>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-bold text-white m-0"><i class="fas fa-history mr-2 text-primary"></i>Revenue history</h3>
                <button onclick="loadFinancesHistory()" class="px-3 py-1.5 rounded-lg border border-white/20 text-white font-bold text-xs hover:bg-white/5 transition-colors"><i class="fas fa-sync mr-1"></i>Refresh</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs font-mono border-separate border-spacing-0">
                    <thead>
                        <tr>
                            <th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]">Period</th>
                            <th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]">Platform revenue</th>
                            <th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]">Providers pool (85%)</th>
                            <th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]">Active providers</th>
                            <th class="px-3 py-2.5 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]">Share/provider</th>
                        </tr>
                    </thead>
                    <tbody id="finances-history-tbody">
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-start gap-3 p-5 bg-primary/[0.06] border border-primary/20 rounded-2xl">
            <i class="fas fa-shield-alt text-primary mt-0.5 shrink-0"></i>
            <div>
                <div class="text-sm font-bold text-white mb-1">Eligibility to receive your monthly share</div>
                <div class="text-xs text-gray-500">You must maintain at least <strong class="text-gray-300">8 hours of daily presence</strong> (verified by random network pings) and achieve at least <strong class="text-gray-300">80% of your monthly hour objective</strong> (prorated if you join mid-month). You also need at least 1 billable job processed. Revenue is split equally among all eligible providers. Payouts via Stripe Connect.</div>
            </div>
        </div>

    </div>
</div>