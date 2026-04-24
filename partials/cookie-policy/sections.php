<?php include('partials/shared/legal-helpers.php'); ?>

<?php
function cookie_table($rows)
{
    $html = '<div class="overflow-x-auto mt-4">
        <table class="w-full text-xs font-mono border-separate border-spacing-0">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06]"><i class="fas fa-tag mr-2"></i>Name</th>
                    <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06]"><i class="fas fa-info-circle mr-2"></i>Purpose</th>
                    <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-[0.1em] text-gray-500 bg-white/[0.02] border-b border-white/[0.06]"><i class="fas fa-clock mr-2"></i>Duration</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($rows as $row) {
        $html .= '<tr class="hover:bg-white/[0.02] transition-colors">
            <td class="px-4 py-3 border-b border-white/[0.04]"><span class="bg-primary/10 text-primary border border-primary/20 rounded px-2 py-0.5">' . $row[0] . '</span></td>
            <td class="px-4 py-3 border-b border-white/[0.04] text-gray-400">' . $row[1] . '</td>
            <td class="px-4 py-3 border-b border-white/[0.04]"><span class="bg-white/5 text-gray-400 border border-white/10 rounded px-2 py-0.5 text-[0.7rem]">' . $row[2] . '</span></td>
        </tr>';
    }
    $html .= '</tbody></table></div>';
    return $html;
}

function cookie_badge($type)
{
    if ($type === 'required') {
        return '<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-success/10 text-success border border-success/30 text-xs font-bold uppercase tracking-wider"><i class="fas fa-check-circle"></i>Required</span>';
    }
    return '<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary/10 text-primary border border-primary/30 text-xs font-bold uppercase tracking-wider"><i class="fas fa-toggle-on"></i>Optional</span>';
}
?>

<div class="space-y-12">

    <?php legal_section('fas fa-question-circle', 'What Are Cookies?', '
        <p class="text-gray-400 leading-relaxed">Cookies are small text files stored on your device. We use them to provide and improve our Service.</p>
    '); ?>

    <?php legal_section('fas fa-shield-alt', 'Cookies We Use', '
        <div class="space-y-8">

            <div>
                <div class="flex items-center gap-3 mb-3">'
        . cookie_badge('required') .
        '<h3 class="text-base font-bold text-white">Essential Cookies</h3>
                </div>
                <p class="text-sm text-gray-400 mb-3">These cookies are necessary for the Service to function:</p>'
        . cookie_table([
            ['token', 'Authentication (JWT)', '30 days'],
            ['session_id', 'Session management', 'Session'],
        ]) .
        '</div>

            <div>
                <div class="flex items-center gap-3 mb-3">'
        . cookie_badge('optional') .
        '<h3 class="text-base font-bold text-white">Analytics Cookies</h3>
                </div>
                <p class="text-sm text-gray-400 mb-3">We use Google Analytics to understand how users interact with our Service:</p>'
        . cookie_table([
            ['_ga', 'Distinguish users', '2 years'],
            ['_gid', 'Distinguish users', '24 hours'],
            ['_gat', 'Throttle request rate', '1 minute'],
        ]) .
        '</div>

            <div>
                <div class="flex items-center gap-3 mb-3">'
        . cookie_badge('optional') .
        '<h3 class="text-base font-bold text-white">Advertising Cookies</h3>
                </div>
                <p class="text-sm text-gray-400 mb-3">We use Google Ads to measure advertising effectiveness and show relevant ads:</p>'
        . cookie_table([
            ['_gcl_au', 'Store and track conversions', '90 days'],
            ['test_cookie', 'Check if browser supports cookies', '15 minutes'],
            ['IDE', 'Measure ad performance', '13 months'],
        ])
        . alert_box('info', 'fas fa-info-circle', '<strong>Note:</strong> Advertising cookies help us understand which ads bring visitors to our site. You can opt out at <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener" class="underline hover:text-white transition-colors">Google Ads Settings</a>.') .
        '</div>

        </div>
    '); ?>

    <?php legal_section(
        'fas fa-database',
        'Local Storage',
        '<p class="text-sm text-gray-400 mb-5">We also use browser Local Storage for:</p>'
            . '<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">'
            . info_card('fas fa-key', 'text-primary', 'token', 'Your authentication token (JWT)')
            . info_card('fas fa-cog', 'text-success', 'preferences', 'UI preferences and settings')
            . info_card('fas fa-cookie-bite', 'text-warning', 'cookie_consent', 'Your cookie preferences')
            . '</div>'
    ); ?>

    <?php legal_section(
        'fas fa-sliders-h',
        'Managing Cookies',
        '
        <p class="text-sm text-gray-400 mb-5">You can control cookies through your browser settings:</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-5">
            <a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener"
                class="flex flex-col items-center gap-2 bg-white/[0.03] border border-white/[0.06] rounded-xl p-4 hover:bg-white/[0.06] hover:border-white/[0.12] transition-all text-center">
                <i class="fab fa-chrome text-3xl text-gray-400"></i>
                <span class="text-xs font-bold text-gray-400">Chrome</span>
            </a>
            <a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer" target="_blank" rel="noopener"
                class="flex flex-col items-center gap-2 bg-white/[0.03] border border-white/[0.06] rounded-xl p-4 hover:bg-white/[0.06] hover:border-white/[0.12] transition-all text-center">
                <i class="fab fa-firefox text-3xl text-gray-400"></i>
                <span class="text-xs font-bold text-gray-400">Firefox</span>
            </a>
            <a href="https://support.apple.com/guide/safari/manage-cookies-sfri11471/mac" target="_blank" rel="noopener"
                class="flex flex-col items-center gap-2 bg-white/[0.03] border border-white/[0.06] rounded-xl p-4 hover:bg-white/[0.06] hover:border-white/[0.12] transition-all text-center">
                <i class="fab fa-safari text-3xl text-gray-400"></i>
                <span class="text-xs font-bold text-gray-400">Safari</span>
            </a>
            <a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener"
                class="flex flex-col items-center gap-2 bg-white/[0.03] border border-white/[0.06] rounded-xl p-4 hover:bg-white/[0.06] hover:border-white/[0.12] transition-all text-center">
                <i class="fab fa-edge text-3xl text-gray-400"></i>
                <span class="text-xs font-bold text-gray-400">Edge</span>
            </a>
        </div>'
            . alert_box('warning', 'fas fa-exclamation-triangle', '<strong>Note:</strong> Blocking essential cookies will prevent you from using the Service.')
    ); ?>

    <?php legal_section(
        'fas fa-plug',
        'Third-Party Cookies',
        '<p class="text-sm text-gray-400 mb-5">Our third-party service providers may also set cookies:</p>'
            . '<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">'
            . info_card('fab fa-stripe', 'text-primary', 'Stripe', 'Payment processing')
            . info_card('fab fa-google', 'text-danger', 'Google Analytics', 'Usage statistics and analytics')
            . info_card('fab fa-google', 'text-success', 'Google Ads', 'Advertising and conversion tracking')
            . '</div>'
            . '<p class="text-sm text-gray-400 mb-3">These are governed by their respective privacy policies:</p>'
            . '<ul class="space-y-2">
            <li><a href="https://policies.google.com/privacy" target="_blank" rel="noopener" class="text-sm text-primary hover:text-white transition-colors"><i class="fas fa-external-link-alt mr-2 text-xs"></i>Google Privacy Policy</a></li>
            <li><a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener" class="text-sm text-primary hover:text-white transition-colors"><i class="fas fa-external-link-alt mr-2 text-xs"></i>How Google uses cookies in advertising</a></li>
            <li><a href="https://stripe.com/privacy" target="_blank" rel="noopener" class="text-sm text-primary hover:text-white transition-colors"><i class="fas fa-external-link-alt mr-2 text-xs"></i>Stripe Privacy Policy</a></li>
        </ul>'
    ); ?>

    <?php legal_cta('Questions about cookies?', "We're here to help clarify anything", 'privacy-contact-link', 'Contact Us'); ?>

</div>