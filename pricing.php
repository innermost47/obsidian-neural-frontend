<?php
$page_title = "Pricing — OBSIDIAN Neural | Free Plan + Plans from €5.99/month";
$page_desc = "OBSIDIAN Neural pricing: Free (20 credits included), Base €5.99/mo, Starter €11.99/mo, Pro €14.99/mo. No credit card required. AI music generation VST3 directly in your DAW.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 pt-32 pb-24 px-4">
  <div class="max-w-6xl mx-auto">

    <?php include('partials/pricing/header.php'); ?>
    <?php include('partials/pricing/stats-bar.php'); ?>
    <?php include('partials/shared/pricing-card.php'); ?>
    <?php include('partials/shared/faq-item.php'); ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-4 mb-16">

      <?php render_pricing_card([
        'name' => 'Free',
        'desc' => 'Try it out',
        'price' => '€0',
        'period' => '',
        'billing' => '',
        'icon' => 'fas fa-flask',
        'icon_color' => 'text-gray-400',
        'badge_text' => 'Free',
        'badge_icon' => 'fas fa-gift',
        'features' => ['20 credits included', '20 samples', 'No card required'],
        'btn_text' => 'Get Started Free',
        'btn_url' => 'register.php'
      ]); ?>

      <?php render_pricing_card([
        'name' => 'Base',
        'desc' => 'For regular creators',
        'price' => '€5.99',
        'period' => 'month',
        'billing' => 'billed monthly',
        'icon' => 'fas fa-seedling',
        'icon_color' => 'text-track2',
        'badge_text' => 'Base',
        'badge_icon' => 'fas fa-rocket',
        'features' => ['150 credits per month', '150 samples', 'Cancel anytime'],
        'btn_text' => 'Subscribe',
        'btn_icon' => 'fas fa-rocket',
        'btn_url' => 'register.php'
      ]); ?>

      <?php render_pricing_card([
        'name' => 'Starter',
        'desc' => 'The sweet spot',
        'price' => '€11.99',
        'period' => 'month',
        'billing' => 'billed monthly',
        'icon' => 'fas fa-music',
        'icon_color' => 'text-primary',
        'featured' => true,
        'badge_text' => 'Recommended',
        'badge_icon' => 'fas fa-star',
        'features' => ['300 credits per month', '300 samples', 'Cancel anytime'],
        'btn_text' => 'Subscribe',
        'btn_icon' => 'fas fa-rocket',
        'btn_url' => 'register.php'
      ]); ?>

      <?php render_pricing_card([
        'name' => 'Pro',
        'desc' => 'For heavy users',
        'price' => '€14.99',
        'period' => 'month',
        'billing' => 'billed monthly',
        'icon' => 'fas fa-fire',
        'icon_color' => 'text-warning',
        'badge_text' => 'Pro',
        'badge_icon' => 'fas fa-bolt',
        'features' => ['500 credits per month', '500 samples', 'Cancel anytime'],
        'btn_text' => 'Subscribe',
        'btn_icon' => 'fas fa-rocket',
        'btn_url' => 'register.php'
      ]); ?>

    </div>
    <?php include('partials/pricing/how-it-works.php'); ?>
    <?php include('partials/pricing/faq.php'); ?>

  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/github-stats.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/pricing.js"></script>