<?php include('partials/shared/legal-helpers.php'); ?>

<div class="space-y-12">

    <?php legal_section('fas fa-handshake', '1. Acceptance of Terms', '
        <p class="text-gray-400 leading-relaxed" id="tos-acceptance">
            By accessing and using the Service, you accept and agree to be bound by these Terms of Service.
        </p>
    '); ?>

    <?php legal_section('fas fa-info-circle', '2. Description of Service', '
        <p class="text-gray-400 leading-relaxed" id="tos-description">
            The Service provides AI-powered audio generation services through a VST plugin.
        </p>
    '); ?>

    <?php legal_section('fas fa-user-check', '3. Account Registration', '
        <div class="divide-y divide-white/[0.04]">'
        . usage_item('fas fa-birthday-cake', 'text-primary', 'You must be at least 16 years old to use the Service')
        . usage_item('fas fa-check-circle', 'text-success', 'You must provide accurate and complete information')
        . usage_item('fas fa-shield-alt', 'text-warning', 'You are responsible for maintaining account security')
        . usage_item('fas fa-user', 'text-primary', 'One account per person or entity')
        . usage_item('fas fa-key', 'text-danger', 'You may not share your API key with others')
        . '</div>'); ?>

    <?php legal_section(
        'fas fa-exclamation-triangle',
        '4. Acceptable Use',
        alert_box('danger', 'fas fa-ban', '<strong>You may NOT use the Service to:</strong>') .
            '<div class="divide-y divide-white/[0.04] mt-4">'
            . usage_item('fas fa-times-circle', 'text-danger', 'Generate illegal, harmful, or offensive content')
            . usage_item('fas fa-times-circle', 'text-danger', 'Infringe on copyrights or intellectual property rights')
            . usage_item('fas fa-times-circle', 'text-danger', 'Impersonate others or create deepfakes without consent')
            . usage_item('fas fa-times-circle', 'text-danger', 'Spam, abuse, or overload our systems')
            . usage_item('fas fa-times-circle', 'text-danger', 'Reverse engineer or attempt to extract AI models')
            . usage_item('fas fa-times-circle', 'text-danger', 'Resell or redistribute generated content as a service')
            . usage_item('fas fa-times-circle', 'text-danger', 'Create content that violates any applicable laws')
            . '</div>'
    ); ?>

    <?php legal_section('fas fa-copyright', '5. Intellectual Property', '
        <div class="mb-6">
            <h3 class="text-sm font-bold text-white mb-3 flex items-center gap-2"><i class="fas fa-user-circle text-primary"></i>Your Content</h3>
            <p class="text-sm text-gray-400 mb-4">You retain ownership of audio you generate. However:</p>
            <div class="divide-y divide-white/[0.04]">'
        . usage_item('fas fa-info-circle', 'text-primary', 'Generated audio may have similarities to training data')
        . usage_item('fas fa-balance-scale', 'text-warning', "You're responsible for ensuring your use doesn't infringe on others' rights")
        . usage_item('fas fa-chart-line', 'text-success', 'We may use anonymized generation data to improve our models')
        . '</div></div>
        <div>
            <h3 class="text-sm font-bold text-white mb-3 flex items-center gap-2"><i class="fas fa-shield-alt text-success"></i>Our Content</h3>
            <p class="text-sm text-gray-400">The Service, including the VST plugin, API, and website, is protected by copyright and other laws.</p>
        </div>
    '); ?>

    <?php legal_section(
        'fas fa-credit-card',
        '6. Billing and Payments',
        '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">'
            . info_card('fas fa-calendar-check', 'text-primary', 'Monthly Billing', 'Subscriptions are billed monthly in advance')
            . info_card('fas fa-sync-alt', 'text-warning', 'Credit Reset', "Credits reset each billing cycle and don't roll over")
            . info_card('fas fa-bell', 'text-primary', 'Price Changes', 'Prices may change with 30 days notice')
            . info_card('fas fa-undo', 'text-danger', 'Refunds', 'Refunds are only provided in exceptional circumstances')
            . info_card('fas fa-times-circle', 'text-success', 'Cancellation', 'You can cancel anytime; access continues until period end')
            . info_card('fas fa-exclamation-triangle', 'text-warning', 'Failed Payments', 'Failed payments may result in service suspension')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-server',
        '7. Service Availability',
        '<p class="text-sm text-gray-400 mb-5">We strive for 99% uptime but don\'t guarantee uninterrupted service. We\'re not liable for:</p>'
            . '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-plug', 'text-gray-500', 'Temporary service interruptions')
            . usage_item('fas fa-cloud', 'text-gray-500', 'Third-party API failures (Stable Audio, Replicate, etc.)')
            . usage_item('fas fa-database', 'text-gray-500', 'Data loss or corruption')
            . usage_item('fas fa-sliders-h', 'text-gray-500', 'Quality variations in AI-generated content')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-scale-balanced',
        '8. Limitation of Liability',
        alert_box('warning', 'fas fa-exclamation-triangle', '<strong>THE SERVICE IS PROVIDED "AS IS" WITHOUT WARRANTIES.</strong>') .
            '<p class="text-sm text-gray-400 my-4">To the maximum extent permitted by law:</p>'
            . '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-ban', 'text-danger', "We're not liable for indirect, incidental, or consequential damages")
            . usage_item('fas fa-euro-sign', 'text-warning', 'Our total liability is limited to the amount you paid in the last 3 months')
            . usage_item('fas fa-user-shield', 'text-primary', "We're not responsible for content you generate or how you use it")
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-user-slash',
        '9. Account Termination',
        alert_box('danger', 'fas fa-user-times', '<strong>We may suspend or terminate your account if you:</strong>') .
            '<div class="divide-y divide-white/[0.04] my-4">'
            . usage_item('fas fa-file-contract', 'text-danger', 'Violate these Terms')
            . usage_item('fas fa-credit-card', 'text-warning', 'Engage in fraudulent activity')
            . usage_item('fas fa-exclamation-circle', 'text-danger', 'Abuse the Service')
            . '</div>'
            . '<p class="text-sm text-gray-400"><i class="fas fa-info-circle mr-2 text-primary"></i>You may delete your account anytime from your dashboard.</p>'
    ); ?>

    <?php legal_section('fas fa-edit', '10. Changes to Terms', '
        <p class="text-gray-400 leading-relaxed">We may modify these Terms. Continued use after changes constitutes acceptance. Material changes will be notified via email.</p>
    '); ?>

    <?php legal_section('fas fa-landmark', '11. Governing Law', '
        <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-5 text-center">
            <i class="fas fa-flag text-primary text-3xl mb-3 block"></i>
            <p class="text-gray-400 mb-0" id="tos-governing-law">These Terms are governed by <strong class="text-white">French law</strong>. Disputes will be resolved in French courts.</p>
        </div>
    '); ?>

    <?php legal_cta('Questions about these Terms?', 'Our legal team is here to help clarify', 'legal-email-cta', 'Contact Legal'); ?>

</div>