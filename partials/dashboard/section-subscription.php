<div id="section-subscription" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-crown mr-3 text-primary"></i>Subscription Management</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Manage your subscription and upgrade your plan.</p>
    </div>
    <div class="p-6 lg:p-12">

        <div id="pricing-section" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl overflow-hidden hover:border-primary/40 transition-all">
                    <div class="bg-gradient-to-br from-primary/30 to-primary/10 px-6 py-8 text-center">
                        <i class="fas fa-seedling text-3xl text-primary mb-3 block"></i>
                        <h3 class="text-xl font-extrabold text-white">Base</h3>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-5">
                            <span class="text-4xl font-black text-white" id="sub-price-base">€7.99</span>
                            <span class="text-sm text-gray-500">/month</span>
                        </div>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center gap-2 text-sm text-gray-400"><i class="fas fa-check-circle text-success text-xs"></i>150 credits per month</li>
                            <li class="flex items-center gap-2 text-sm text-gray-400"><i class="fas fa-check-circle text-success text-xs"></i>150 samples</li>
                            <li class="flex items-center gap-2 text-sm text-gray-400"><i class="fas fa-sync text-success text-xs"></i>Cancel anytime</li>
                        </ul>
                        <button onclick="gtagSendEvent('Base', parseFloat(window._prices.base)).then(() => subscribe('base'))" class="w-full px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors"><i class="fas fa-rocket mr-2"></i>Subscribe</button>
                    </div>
                </div>

                <div class="bg-gradient-to-b from-primary/20 to-transparent border border-primary/40 rounded-2xl overflow-hidden relative hover:border-primary/60 transition-all">
                    <div class="absolute top-0 inset-x-0 h-8 bg-primary flex items-center justify-center">
                        <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-white"><i class="fas fa-star mr-1"></i>Recommended</span>
                    </div>
                    <div class="pt-8 px-6 py-8 text-center">
                        <i class="fas fa-music text-3xl text-white mb-3 block"></i>
                        <h3 class="text-xl font-extrabold text-white">Starter</h3>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-5">
                            <span class="text-4xl font-black text-white" id="sub-price-starter">€11.99</span>
                            <span class="text-sm text-white/60">/month</span>
                        </div>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center gap-2 text-sm text-white/80"><i class="fas fa-check-circle text-white/60 text-xs"></i>300 credits per month</li>
                            <li class="flex items-center gap-2 text-sm text-white/80"><i class="fas fa-check-circle text-white/60 text-xs"></i>300 samples</li>
                            <li class="flex items-center gap-2 text-sm text-white/80"><i class="fas fa-sync text-white/60 text-xs"></i>Cancel anytime</li>
                        </ul>
                        <button onclick="gtagSendEvent('Starter', parseFloat(window._prices.starter)).then(() => subscribe('starter'))" class="w-full px-6 py-3 rounded-xl bg-white text-black font-bold hover:bg-gray-200 transition-colors shadow-[0_0_20px_rgba(255,255,255,0.15)]"><i class="fas fa-rocket mr-2"></i>Subscribe</button>
                    </div>
                </div>

                <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl overflow-hidden hover:border-primary/40 transition-all">
                    <div class="bg-gradient-to-br from-warning/20 to-warning/5 px-6 py-8 text-center">
                        <i class="fas fa-bolt text-3xl text-warning mb-3 block"></i>
                        <h3 class="text-xl font-extrabold text-white">Pro</h3>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-5">
                            <span class="text-4xl font-black text-white" id="sub-price-pro">€14.99</span>
                            <span class="text-sm text-gray-500">/month</span>
                        </div>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center gap-2 text-sm text-gray-400"><i class="fas fa-check-circle text-success text-xs"></i>500 credits per month</li>
                            <li class="flex items-center gap-2 text-sm text-gray-400"><i class="fas fa-check-circle text-success text-xs"></i>500 samples</li>
                            <li class="flex items-center gap-2 text-sm text-gray-400"><i class="fas fa-sync text-success text-xs"></i>Cancel anytime</li>
                        </ul>
                        <button onclick="gtagSendEvent('Pro', parseFloat(window._prices.pro)).then(() => subscribe('pro'))" class="w-full px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-white/10 transition-colors"><i class="fas fa-rocket mr-2"></i>Subscribe</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="current-subscription-info" class="hidden">
            <div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 mb-6">
                <h5 class="text-base font-bold text-white mb-5"><i class="fas fa-check-circle text-success mr-2"></i>Active Subscription</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                    <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4">
                        <p class="text-xs text-gray-500 mb-1">Current Plan</p>
                        <div class="text-lg font-black text-primary" id="current-plan-name">—</div>
                    </div>
                    <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4">
                        <p class="text-xs text-gray-500 mb-1">Status</p>
                        <div id="current-plan-status">—</div>
                    </div>
                    <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-4">
                        <p class="text-xs text-gray-500 mb-1">Monthly Credits</p>
                        <div class="text-lg font-black text-white" id="current-plan-credits">—</div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button onclick="manageSubscription()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold text-sm hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(217,104,80,0.3)]"><i class="fas fa-cog mr-2"></i>Manage Subscription</button>
                    <button onclick="viewBillingHistory()" class="px-5 py-2.5 rounded-xl border border-white/20 text-white font-bold text-sm hover:bg-white/5 transition-colors"><i class="fas fa-history mr-2"></i>Billing History</button>
                </div>
            </div>
            <div id="upgrade-options" class="hidden">
                <h5 class="text-base font-bold text-white mb-4"><i class="fas fa-arrow-up mr-2 text-primary"></i>Upgrade Your Plan</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5" id="upgrade-plans-container"></div>
            </div>
        </div>

    </div>
</div>