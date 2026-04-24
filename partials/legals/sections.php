<?php include('partials/shared/legal-helpers.php'); ?>

<div class="space-y-12">

    <?php legal_section('fas fa-user-tie', 'Publisher', '
        <div class="space-y-3">
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Name</span>
                <span class="text-sm text-white" id="legal-name">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Status</span>
                <span class="text-sm text-gray-300" id="legal-status">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Address</span>
                <span class="text-sm text-gray-300" id="legal-address">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">SIRET</span>
                <span class="text-sm text-gray-300 font-mono" id="legal-siret">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Email</span>
                <a class="text-sm text-primary hover:text-white transition-colors" id="legal-email" href="#">—</a>
            </div>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">VAT</span>
                <span class="text-sm text-gray-300 font-mono" id="legal-vat">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Publication Director</span>
                <span class="text-sm text-gray-300" id="legal-director">—</span>
            </div>
        </div>
    '); ?>

    <?php legal_section('fas fa-server', 'Website Hosting', '
        <div class="space-y-3">
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Host</span>
                <span class="text-sm text-white" id="legal-host-name">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Address</span>
                <span class="text-sm text-gray-300" id="legal-host-address">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04]">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Phone</span>
                <span class="text-sm text-gray-300 font-mono" id="legal-host-phone">—</span>
            </div>
            <div class="flex items-start gap-3 py-2.5">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider w-36 shrink-0 mt-0.5">Website</span>
                <a class="text-sm text-primary hover:text-white transition-colors" id="legal-host-url" href="#" target="_blank" rel="noopener">—</a>
            </div>
        </div>
    '); ?>

    <?php legal_section('fas fa-copyright', 'Intellectual Property', '
        <p class="text-sm text-gray-400 mb-3" id="legal-ip-text">—</p>
        <p class="text-sm text-gray-500">Any reproduction without express authorization is prohibited.</p>
    '); ?>

    <?php legal_cta('Questions?', 'Contact us for any information regarding this legal notice', 'legal-contact-email', 'Contact'); ?>

</div>