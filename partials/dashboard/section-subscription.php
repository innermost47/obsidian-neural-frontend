<?php include_once('partials/shared/pricing-card.php'); ?>

<div id="section-subscription" class="section-content">
    <div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">
        <h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="fas fa-crown mr-3 text-primary"></i>Subscription Management</h1>
        <p class="text-sm text-gray-500 mt-1 mb-0">Manage your subscription and upgrade your plan.</p>
    </div>
    <div class="p-6 lg:p-12">

        <div id="pricing-section" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <?php render_pricing_card([
                    'name'        => 'Base',
                    'desc'        => 'For regular creators',
                    'price'       => '€7.99',
                    'period'      => 'month',
                    'billing'     => 'billed monthly',
                    'icon'        => 'fas fa-seedling',
                    'icon_color'  => 'text-track2',
                    'badge_text'  => 'Base',
                    'badge_icon'  => 'fas fa-rocket',
                    'features'    => ['150 credits per month', '150 samples', 'Cancel anytime'],
                    'btn_text'    => 'Subscribe',
                    'btn_icon'    => 'fas fa-rocket',
                    'btn_onclick' => "gtagSendEvent('Base', parseFloat(window._prices.base)).then(() => subscribe('base'))",
                ]); ?>
                <?php render_pricing_card([
                    'name'        => 'Starter',
                    'desc'        => 'The sweet spot',
                    'price'       => '€11.99',
                    'period'      => 'month',
                    'billing'     => 'billed monthly',
                    'icon'        => 'fas fa-music',
                    'icon_color'  => 'text-primary',
                    'featured'    => true,
                    'badge_text'  => 'Recommended',
                    'badge_icon'  => 'fas fa-star',
                    'features'    => ['300 credits per month', '300 samples', 'Cancel anytime'],
                    'btn_text'    => 'Subscribe',
                    'btn_icon'    => 'fas fa-rocket',
                    'btn_onclick' => "gtagSendEvent('Starter', parseFloat(window._prices.starter)).then(() => subscribe('starter'))",
                ]); ?>
                <?php render_pricing_card([
                    'name'        => 'Pro',
                    'desc'        => 'For heavy users',
                    'price'       => '€14.99',
                    'period'      => 'month',
                    'billing'     => 'billed monthly',
                    'icon'        => 'fas fa-fire',
                    'icon_color'  => 'text-warning',
                    'badge_text'  => 'Pro',
                    'badge_icon'  => 'fas fa-bolt',
                    'features'    => ['500 credits per month', '500 samples', 'Cancel anytime'],
                    'btn_text'    => 'Subscribe',
                    'btn_icon'    => 'fas fa-rocket',
                    'btn_onclick' => "gtagSendEvent('Pro', parseFloat(window._prices.pro)).then(() => subscribe('pro'))",
                ]); ?>
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