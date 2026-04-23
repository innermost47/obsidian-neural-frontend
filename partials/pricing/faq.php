<div class="text-center mb-10 mt-16">
    <h2 class="text-2xl font-bold text-white mb-2"><i class="fas fa-question-circle text-success mr-2"></i>FAQ</h2>
</div>
<div class="max-w-3xl mx-auto space-y-3">

    <?php render_faq_item([
        'icon' => 'fas fa-gift',
        'icon_color' => 'text-success',
        'question' => 'How many free credits do I get?',
        'answer' => 'Every new account receives <strong>20 free credits</strong> automatically — no credit card required, no time limit. That\'s 20 AI-generated audio samples to explore the plugin at your own pace.'
    ]); ?>

    <?php render_faq_item([
        'icon' => 'fas fa-sync-alt',
        'icon_color' => 'text-primary',
        'question' => 'Do credits roll over?',
        'answer' => 'No. Credits reset each month on your billing date. Unused credits do not carry over.'
    ]); ?>

    <?php render_faq_item([
        'icon' => 'fas fa-times-circle',
        'icon_color' => 'text-danger',
        'question' => 'Can I cancel anytime?',
        'answer' => 'Yes. Cancel from your dashboard anytime. You keep access until the end of your billing period.'
    ]); ?>

    <?php render_faq_item([
        'icon' => 'fab fa-cc-stripe',
        'icon_color' => 'text-success',
        'question' => 'Payment methods?',
        'answer' => 'We accept all major credit cards through <strong>Stripe</strong>, a secure and industry-standard payment processor.'
    ]); ?>

    <?php render_faq_item([
        'icon' => 'fas fa-exchange-alt',
        'icon_color' => 'text-warning',
        'question' => 'Can I change plans?',
        'answer' => 'Yes. Upgrade anytime (takes effect immediately). Downgrades take effect next billing cycle.'
    ]); ?>

    <?php render_faq_item([
        'icon' => 'fas fa-microchip',
        'icon_color' => 'text-primary',
        'question' => 'What AI models power the audio generation?',
        'answer' => 'Provider nodes run <strong>8 specialized models</strong>, each assignable per track: Stable Audio Open, Foundation-1, Audialab EDM Elements, RC Infinite Pianos, Vocal Textures, SAO Finetune, StableBeaT, Gluten v1. When no node is available, the system falls back to <strong>Stable Audio Open</strong> via fal.ai. The LLM layer uses <strong>Gemini 2.5 Flash</strong>.'
    ]); ?>

    <?php render_faq_item([
        'icon' => 'fab fa-github',
        'icon_color' => 'text-gray-400',
        'question' => 'Support?',
        'answer' => 'Open an issue on <a href="#" id="faq-github-link" target="_blank" class="text-primary hover:underline">GitHub</a>. Community-driven support.'
    ]); ?>

</div>