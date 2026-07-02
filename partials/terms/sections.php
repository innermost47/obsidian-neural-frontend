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
        'fas fa-microchip',
        '7. Local Edition License (One-Time Purchase)',
        '<p class="text-sm text-gray-400 mb-5">The OBSIDIAN Neural Local Edition is sold as a one-time purchase, separate from the cloud subscription. The following terms apply specifically to it:</p>'
            . '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-infinity', 'text-success', 'A single payment grants a perpetual license to run Stable Audio 3 Medium locally — no recurring fees')
            . usage_item('fas fa-desktop', 'text-primary', 'The license may be activated on up to 3 machines simultaneously')
            . usage_item('fas fa-key', 'text-danger', 'Your license key is personal — you may not share, resell, or distribute it')
            . usage_item('fas fa-server', 'text-warning', 'Switching to server mode for the other AI engines requires an active subscription or your own self-hosted server')
            . usage_item('fas fa-wifi', 'text-primary', 'Internet is required once, to activate the license and download the model; the plugin then runs fully offline')
            . usage_item('fas fa-download', 'text-success', 'You are entitled to download builds for Windows, macOS (Apple Silicon only) and Linux under a single license')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-undo',
        '8. Local Edition Refunds & Right of Withdrawal',
        alert_box('warning', 'fas fa-exclamation-triangle', '<strong>Please read carefully before purchasing.</strong>') .
            '<p class="text-sm text-gray-400 my-4">The Local Edition is digital content delivered immediately upon purchase. Under EU and French consumer law, the 14-day right of withdrawal does not apply once you have started downloading the software and AI model, which you expressly acknowledge and accept at checkout.</p>'
            . '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-check-circle', 'text-success', 'Before any download, you may request a full refund')
            . usage_item('fas fa-times-circle', 'text-danger', 'Once the software or model has been downloaded, the purchase is final')
            . usage_item('fas fa-life-ring', 'text-primary', 'Having a technical issue? Contact us first — we will always try to help before anything else')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-shield-halved',
        '9. Local Edition — Activation & Anti-Piracy',
        '<p class="text-sm text-gray-400 mb-5">To protect against unauthorized use, the Local Edition includes a license verification system:</p>'
            . '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-fingerprint', 'text-primary', 'Activation links your license to your machines via a device identifier')
            . usage_item('fas fa-rotate', 'text-success', 'You may release a machine and activate a new one if you change hardware')
            . usage_item('fas fa-ban', 'text-danger', 'Circumventing, tampering with, or attempting to bypass the license system is strictly prohibited')
            . usage_item('fas fa-volume-xmark', 'text-warning', 'Unlicensed or tampered copies may produce degraded audio output')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-plug',
        '10. Local Edition — Formats & DAW Compatibility',
        '<p class="text-sm text-gray-400 mb-5">The Local Edition ships as a VST3 plugin, an Audio Unit (AU) plugin, and a standalone application, for Windows, macOS (Apple Silicon) and Linux. All formats are included in the installer. Because each host application implements plugin transport and playback differently, full functionality is only guaranteed in the DAWs we officially test.</p>'
            . '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-check-circle', 'text-success', 'Officially tested and supported: Ableton Live and Bitwig Studio')
            . usage_item('fas fa-box', 'text-primary', 'Provided as VST3, Audio Unit (AU) and standalone, all included in the installer')
            . usage_item('fas fa-laptop-code', 'text-primary', 'The standalone application runs independently, without a DAW')
            . usage_item('fas fa-exclamation-triangle', 'text-warning', 'Other DAWs (including FL Studio) are not officially tested; some features such as sequencer playback may not work as intended')
            . usage_item('fas fa-life-ring', 'text-primary', 'If you are unsure whether your DAW is supported, contact us before purchasing and we will tell you what to expect')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-server',
        '11. Service Availability',
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
        '12. Limitation of Liability',
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
        '13. Account Termination',
        alert_box('danger', 'fas fa-user-times', '<strong>We may suspend or terminate your account if you:</strong>') .
            '<div class="divide-y divide-white/[0.04] my-4">'
            . usage_item('fas fa-file-contract', 'text-danger', 'Violate these Terms')
            . usage_item('fas fa-credit-card', 'text-warning', 'Engage in fraudulent activity')
            . usage_item('fas fa-exclamation-circle', 'text-danger', 'Abuse the Service')
            . '</div>'
            . '<p class="text-sm text-gray-400"><i class="fas fa-info-circle mr-2 text-primary"></i>You may delete your account anytime from your dashboard.</p>'
    ); ?>

    <?php legal_section('fas fa-edit', '13. Changes to Terms', '
        <p class="text-gray-400 leading-relaxed">We may modify these Terms. Continued use after changes constitutes acceptance. Material changes will be notified via email.</p>
    '); ?>

    <?php legal_section('fas fa-landmark', '14. Governing Law', '
        <div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-5 text-center">
            <i class="fas fa-flag text-primary text-3xl mb-3 block"></i>
            <p class="text-gray-400 mb-0" id="tos-governing-law">These Terms are governed by <strong class="text-white">French law</strong>. Disputes will be resolved in French courts.</p>
        </div>
    '); ?>

    <?php legal_cta('Questions about these Terms?', 'Our legal team is here to help clarify', 'legal-email-cta', 'Contact Legal'); ?>

</div>