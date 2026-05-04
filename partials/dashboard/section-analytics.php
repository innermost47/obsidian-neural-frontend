<div id="section-analytics" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-chart-line mr-3 text-primary"></i>Website Analytics</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Google Analytics data for the last 30 days.</p>
    </div>
    <div class="p-6 lg:p-12 space-y-5">

        <div class="flex flex-wrap gap-2">
            <?php foreach ([[7, '7 Days'], [30, '30 Days', true], [90, '90 Days'], [365, '1 Year'], [9999, 'All Time']] as $d): ?>
                <button type="button" onclick="loadAnalytics(<?= $d[0] ?>)" class="px-4 py-2 rounded-xl <?= isset($d[2]) ? 'bg-gradient-to-r from-primary to-[#a04840] text-white' : 'border border-white/20 text-gray-400 hover:border-primary/50 hover:text-white' ?> font-bold text-xs transition-all"><?= $d[1] ?></button>
            <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-users text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Active Users</h6>
                </div>
                <div class="text-2xl font-black text-white" id="analytics-active-users">—</div>
                <p class="text-xs text-gray-600 mt-1">Visitors in period</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-user-plus text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">New Users</h6>
                </div>
                <div class="text-2xl font-black text-white" id="analytics-new-users">—</div>
                <p class="text-xs text-gray-600 mt-1">First-time visitors</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-eye text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Page Views</h6>
                </div>
                <div class="text-2xl font-black text-white" id="analytics-page-views">—</div>
                <p class="text-xs text-gray-600 mt-1">Total views</p>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/20 text-primary flex items-center justify-center"><i class="fas fa-clock text-sm"></i></div>
                    <h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">Avg. Session</h6>
                </div>
                <div class="text-2xl font-black text-white" id="analytics-avg-session">—</div>
                <p class="text-xs text-gray-600 mt-1">Duration in seconds</p>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-chart-area mr-2 text-primary"></i>Daily Traffic</h3><canvas id="analytics-daily-chart" height="80"></canvas>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-file-alt mr-2 text-primary"></i>Top Pages</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs border-separate border-spacing-0">
                        <thead>
                            <tr><?php foreach (['Page', 'Views', 'Avg. Time (s)'] as $h): ?><th class="px-3 py-2 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]"><?= $h ?></th><?php endforeach; ?></tr>
                        </thead>
                        <tbody id="analytics-top-pages">
                            <tr>
                                <td colspan="3" class="text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-share-alt mr-2 text-primary"></i>Traffic Sources</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs border-separate border-spacing-0">
                        <thead>
                            <tr><?php foreach (['Source', 'Sessions', 'New Users'] as $h): ?><th class="px-3 py-2 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]"><?= $h ?></th><?php endforeach; ?></tr>
                        </thead>
                        <tbody id="analytics-traffic-sources">
                            <tr>
                                <td colspan="3" class="text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-globe-americas mr-2 text-primary"></i>Visitors Map</h3>
                <div id="analytics-world-map" class="rounded-xl overflow-hidden" style="height:400px"></div>
            </div>
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
                <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-globe mr-2 text-primary"></i>Top Countries</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs border-separate border-spacing-0">
                        <thead>
                            <tr><?php foreach (['Country', 'Users', 'Sessions'] as $h): ?><th class="px-3 py-2 text-left text-[0.65rem] font-bold uppercase tracking-wider text-gray-500 bg-white/[0.02] border-b border-white/[0.06]"><?= $h ?></th><?php endforeach; ?></tr>
                        </thead>
                        <tbody id="analytics-countries">
                            <tr>
                                <td colspan="3" class="text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-share-alt mr-2 text-primary"></i>Social Media Traffic</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="analytics-social-media">
                <div class="col-span-full text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></div>
            </div>
        </div>

        <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-5">
            <h3 class="text-sm font-bold text-white mb-4"><i class="fas fa-mobile-alt mr-2 text-primary"></i>Device Breakdown</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="analytics-devices">
                <div class="col-span-full text-center py-8 text-gray-600"><i class="fas fa-spinner fa-spin text-xl"></i></div>
            </div>
        </div>

    </div>
</div>