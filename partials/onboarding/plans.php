<section class="max-w-6xl mx-auto mb-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-4 plan-grid">

        <div class="plan-option cursor-pointer transition-all duration-300" data-plan="free" onclick="selectPlan('free')">
            <?php render_pricing_card([
                'name'       => 'Free',
                'desc'       => 'Try the basics',
                'price'      => '€0',
                'period'     => '',
                'billing'    => '',
                'icon'       => 'fas fa-seedling',
                'icon_color' => 'text-gray-400',
                'badge_text' => 'Free',
                'badge_icon' => 'fas fa-gift',
                'features'   => ['20 credits included', '20 samples', 'No card required'],
                'btn_text'   => 'Get Started Free',
                'btn_url'    => '#',
            ]); ?>
        </div>

        <div class="plan-option cursor-pointer transition-all duration-300" data-plan="base" onclick="selectPlan('base')">
            <?php render_pricing_card([
                'name'       => 'Base',
                'desc'       => 'For regular creators',
                'price'      => '€0',
                'period'     => 'month',
                'billing'    => 'billed monthly',
                'icon'       => 'fas fa-music',
                'icon_color' => 'text-track2',
                'badge_text' => 'Base',
                'badge_icon' => 'fas fa-rocket',
                'features'   => ['150 credits per month', '150 samples', 'Cancel anytime'],
                'btn_text'   => 'Subscribe',
                'btn_icon'   => 'fas fa-rocket',
                'btn_url'    => '#',
            ]); ?>
        </div>

        <div class="plan-option cursor-pointer transition-all duration-300" data-plan="starter" onclick="selectPlan('starter')">
            <?php render_pricing_card([
                'name'       => 'Starter',
                'desc'       => 'The sweet spot',
                'price'      => '€0',
                'period'     => 'month',
                'billing'    => 'billed monthly',
                'icon'       => 'fas fa-bolt',
                'icon_color' => 'text-primary',
                'featured'   => true,
                'badge_text' => 'Most Popular',
                'badge_icon' => 'fas fa-star',
                'features'   => ['300 credits per month', '300 samples', 'Cancel anytime'],
                'btn_text'   => 'Subscribe',
                'btn_icon'   => 'fas fa-rocket',
                'btn_url'    => '#',
            ]); ?>
        </div>

        <div class="plan-option cursor-pointer transition-all duration-300" data-plan="pro" onclick="selectPlan('pro')">
            <?php render_pricing_card([
                'name'       => 'Pro',
                'desc'       => 'For heavy users',
                'price'      => '€0',
                'period'     => 'month',
                'billing'    => 'billed monthly',
                'icon'       => 'fas fa-crown',
                'icon_color' => 'text-warning',
                'badge_text' => 'Pro',
                'badge_icon' => 'fas fa-fire',
                'features'   => ['500 credits per month', '500 samples', 'Cancel anytime'],
                'btn_text'   => 'Subscribe',
                'btn_icon'   => 'fas fa-rocket',
                'btn_url'    => '#',
            ]); ?>
        </div>

    </div>
</section>