<?php include('partials/shared/legal-helpers.php'); ?>

<div class="space-y-12">

    <?php legal_section(
        'fas fa-database',
        '1. Information We Collect',
        '<p class="text-sm text-gray-400 mb-5">We collect information you provide directly to us:</p>'
            . '<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">'
            . info_card('fas fa-user', 'text-primary', 'Account Information', 'Email address, password (encrypted)')
            . info_card('fas fa-credit-card', 'text-success', 'Payment Information', "Processed securely through Stripe (we don't store payment details)")
            . info_card('fas fa-chart-line', 'text-warning', 'Usage Data', 'API calls, credits consumed, generation history')
            . info_card('fas fa-laptop', 'text-danger', 'Technical Data', 'IP address, browser type, device information')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-cogs',
        '2. How We Use Your Information',
        '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-check-circle', 'text-success', 'Providing and maintaining our services')
            . usage_item('fas fa-check-circle', 'text-success', 'Processing payments and managing subscriptions')
            . usage_item('fas fa-check-circle', 'text-success', 'Sending important service updates')
            . usage_item('fas fa-check-circle', 'text-success', 'Improving our AI models and services')
            . usage_item('fas fa-check-circle', 'text-success', 'Detecting and preventing fraud')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-paper-plane',
        '2.1 Email Communications',
        '
        <p class="text-sm text-gray-400 mb-4">If you have opted in to receive communications, we may use your email address to send you:</p>
        <div class="divide-y divide-white/[0.04] mb-5">'
            . usage_item('fas fa-bell', 'text-primary', 'Product updates and new feature announcements')
            . usage_item('fas fa-rocket', 'text-success', '<span id="email-tips-label">Tips for getting the most out of the plugin</span>')
            . usage_item('fas fa-newspaper', 'text-primary', 'Occasional newsletters about AI audio generation')
            . '</div>'
            . alert_box('success', 'fas fa-check-circle', '<strong>You control your preferences:</strong> You can opt out of marketing emails at any time through your account settings or by clicking the unsubscribe link in any email. Service-critical emails cannot be opted out of while you maintain an account.')
    ); ?>

    <?php legal_section(
        'fas fa-share-alt',
        '3. Data Sharing',
        '<p class="text-sm text-gray-400 mb-5">We share your information only with:</p>'
            . '<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">'
            . sharing_card('fas fa-plug', 'text-primary', 'Service Providers', 'Stripe (payments), fal.ai (AI processing)')
            . sharing_card('fas fa-gavel', 'text-warning', 'Legal Requirements', 'When required by law or to protect our rights')
            . '</div>'
            . alert_box('info', 'fas fa-info-circle', '<strong>We never sell your personal information to third parties.</strong>')
    ); ?>

    <?php legal_section(
        'fas fa-music',
        '4. Audio Content',
        alert_box('warning', 'fas fa-exclamation-triangle', '<strong>Important:</strong> Audio generated through our service is processed by third-party AI providers (fal.ai). While we don\'t store your generated audio permanently, these providers may temporarily cache it for processing. Your audio prompts may be used to improve AI models.')
    ); ?>

    <?php legal_section(
        'fas fa-cookie-bite',
        '5. Cookies and Tracking',
        '<p class="text-sm text-gray-400 mb-5">We use essential cookies for:</p>'
            . '<div class="divide-y divide-white/[0.04]">'
            . usage_item('fas fa-key', 'text-primary', 'Authentication (JWT tokens stored in localStorage)')
            . usage_item('fas fa-clock', 'text-success', 'Session management')
            . usage_item('fas fa-shield-alt', 'text-warning', 'Security features')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-hourglass-half',
        '6. Data Retention',
        '<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">'
            . info_card('fas fa-user', 'text-primary', 'Account Data', 'Retained while your account is active')
            . info_card('fas fa-history', 'text-primary', 'Generation History', '90 days')
            . info_card('fas fa-receipt', 'text-success', 'Payment Records', '7 years (legal requirement)')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-user-shield',
        '7. Your Rights (GDPR)',
        '<p class="text-sm text-gray-400 mb-5">You have the right to:</p>'
            . '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-5">'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-eye text-primary shrink-0"></i><span class="text-sm text-gray-400">Access your personal data</span></div>'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-edit text-success shrink-0"></i><span class="text-sm text-gray-400">Correct inaccurate data</span></div>'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-trash text-danger shrink-0"></i><span class="text-sm text-gray-400">Request deletion of your data</span></div>'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-download text-warning shrink-0"></i><span class="text-sm text-gray-400">Export your data</span></div>'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-ban text-primary shrink-0"></i><span class="text-sm text-gray-400">Object to data processing</span></div>'
            . '</div>'
            . '<p class="text-sm text-gray-400">Contact us at <a id="privacy-email-gdpr" href="contact.php" class="text-primary hover:text-white transition-colors">our contact form</a> to exercise these rights.</p>'
    ); ?>

    <?php legal_section(
        'fas fa-lock',
        '8. Security',
        '<p class="text-sm text-gray-400 mb-5">We implement industry-standard security measures:</p>'
            . '<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-shield-alt text-success shrink-0"></i><span class="text-sm text-gray-400">Encrypted data transmission (HTTPS)</span></div>'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-key text-primary shrink-0"></i><span class="text-sm text-gray-400">Encrypted password storage (bcrypt)</span></div>'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-random text-warning shrink-0"></i><span class="text-sm text-gray-400">Secure API key generation</span></div>'
            . '<div class="flex items-center gap-3 bg-white/[0.03] border border-white/[0.06] rounded-xl px-4 py-3"><i class="fas fa-search text-primary shrink-0"></i><span class="text-sm text-gray-400">Regular security audits</span></div>'
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-child',
        "9. Children's Privacy",
        alert_box('info', 'fas fa-info-circle', "Our service is not intended for users under 16. We don't knowingly collect data from children.")
    ); ?>

    <?php legal_cta("Questions about your privacy?", "We're committed to transparency and protecting your data", 'privacy-email-cta', 'Contact Us'); ?>

</div>