<?php
include('partials/press/items.php');

$academic_items = [
    ['name' => 'AES 160th Convention 2026 - Copenhagen', 'url' => 'https://aeseurope2026.sched.com/event/2Lq3I'],
    ['name' => 'AES AIMLA 2025 - Queen Mary University London', 'url' => 'https://aes2.org/publications/elibrary-page/?id=22851'],
];

$citation = array_merge(
    array_column($academic_items, 'url'),
    array_column($press_items, 'url')
);

$item_list_element = [];
$position = 1;

foreach ($academic_items as $entry) {
    $item_list_element[] = [
        '@type' => 'ListItem',
        'position' => $position++,
        'name' => $entry['name'],
        'url' => $entry['url'],
    ];
}

foreach ($press_items as $item) {
    $label = $item['country'] ?: 'YouTube';
    $item_list_element[] = [
        '@type' => 'ListItem',
        'position' => $position++,
        'name' => "{$item['outlet']} ({$label})",
        'url' => $item['url'],
    ];
}

$reviews = [];
foreach ($press_items as $item) {
    if (!empty($item['rating'])) {
        $review = [
            '@type' => 'Review',
            'author' => ['@type' => 'Organization', 'name' => $item['outlet']],
            'reviewRating' => ['@type' => 'Rating', 'ratingValue' => (string) $item['rating']],
            'url' => $item['url'],
        ];
        $reviews[] = $review;
    } elseif (!empty($item['is_review'])) {
        $reviews[] = [
            '@type' => 'Review',
            'author' => ['@type' => 'Organization', 'name' => $item['outlet']],
            'url' => $item['url'],
        ];
    }
}

$press_coverage_description = "Featured in leading music technology publications and presented at two AES conferences "
    . "(London 2025, Copenhagen 2026), covered across {$country_count} countries and {$language_count} languages.";
?>
<script type="application/ld+json">
    <?php
    $schema = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'OBSIDIAN Neural',
            'url' => 'https://obsidian-neural.com',
            'description' => 'First VST3/AU plugin for AI music generation designed for live performance',
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'SoftwareApplication',
            'name' => 'OBSIDIAN Neural',
            'alternateName' => 'OBSIDIAN Neural Sound Engine',
            'applicationCategory' => 'MultimediaApplication',
            'applicationSubCategory' => 'Audio Plugin',
            'operatingSystem' => 'Windows, macOS, Linux',
            'softwareVersion' => 'latest',
            'license' => 'https://www.mozilla.org/en-US/MPL/2.0/',
            'creator' => [
                '@type' => 'Person',
                'name' => 'Anthony Charretier',
                'alternateName' => 'InnerMost47',
                'url' => 'https://github.com/innermost47',
            ],
            'offers' => [
                ['@type' => 'Offer', 'name' => 'Free', 'price' => '0', 'priceCurrency' => 'EUR', 'description' => '20 free credits, 20 samples'],
                ['@type' => 'Offer', 'name' => 'Starter', 'price' => '14.99', 'priceCurrency' => 'EUR', 'description' => '500 credits/month, full features'],
                ['@type' => 'Offer', 'name' => 'Pro', 'price' => '29.99', 'priceCurrency' => 'EUR', 'description' => '1500 credits/month, priority generation'],
            ],
            'url' => 'https://obsidian-neural.com',
            'downloadUrl' => 'https://github.com/innermost47/ai-dj/releases/latest',
            'screenshot' => 'https://obsidian-neural.com/assets/images/screenshot-v2-5-1.webp',
            'citation' => $citation,
            'featureList' => [
                'AI stereo music generation for live performance (~10s per sample)',
                '9 specialized AI models assignable per track (including Stable Audio 3 Medium)',
                '8-track stereo sampler',
                '64-step sequencer with 8 sequences per page',
                'Standalone mode with built-in transport and tempo control',
                'Ableton Link integration for network tempo and start/stop sync',
                'Model-aware Prompt Builder with curated keywords (genres, instruments, moods, negatives)',
                '4 pair crossfaders with model-aware color morphing for DJ-style live mixing',
                'Optional LLM Brain for contextual prompt refinement (disabled by default)',
                'MIDI controller integration and MIDI Learn',
                'BPM auto-detection via MiniBPM with time-stretching via Signalsmith Stretch (zero pitch drift)',
                'VST3 and AU (Logic Pro) formats',
                'Multi-output DAW routing',
                'Quantized sample launch system',
                'Companion Android MIDI controller app with bidirectional feedback',
            ],
            'award' => [
                'AES AIMLA 2025 Late Breaking Demo Paper — Queen Mary University London',
                'AES 160th Convention 2026 Engineering Brief — Copenhagen',
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'VideoObject',
            'name' => 'OBSIDIAN Neural — Jungle Drum & Bass Live Mix',
            'description' => 'Live performance demo: AI-generated samples triggered via MIDI controller in a jungle drum & bass set',
            'thumbnailUrl' => [
                'https://img.youtube-nocookie.com/vi/sihEcsG-W4s/maxresdefault.jpg',
                'https://img.youtube-nocookie.com/vi/sihEcsG-W4s/hqdefault.jpg',
            ],
            'uploadDate' => '2025-01-01T12:00:00+01:00',
            'embedUrl' => 'https://www.youtube-nocookie.com/embed/sihEcsG-W4s',
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'VideoObject',
            'name' => 'OBSIDIAN Neural — AES AIMLA 2025 Live Performance',
            'description' => 'Excerpt from the AES AIMLA 2025 conference at Queen Mary University London. Live AI music generation with hardware controllers in Bitwig Studio.',
            'thumbnailUrl' => [
                'https://img.youtube-nocookie.com/vi/LqHTUhqYl3s/maxresdefault.jpg',
                'https://img.youtube-nocookie.com/vi/LqHTUhqYl3s/hqdefault.jpg',
            ],
            'uploadDate' => '2025-09-01T14:30:00+01:00',
            'embedUrl' => 'https://www.youtube-nocookie.com/embed/LqHTUhqYl3s',
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'name' => 'OBSIDIAN Neural - International Press & Academic Coverage',
            'description' => $press_coverage_description,
            'itemListElement' => $item_list_element,
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'What is OBSIDIAN Neural?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'OBSIDIAN Neural is the first VST3/AU plugin for AI stereo music generation designed for live performance. It generates 30-second audio samples in approximately 30 seconds, directly inside your DAW or in standalone mode with Ableton Link. Features include an 8-track stereo sampler, 9 specialized AI models assignable per track, model-aware Prompt Builder, 4 pair crossfaders for DJ-style live mixing, MIDI control, and automatic BPM synchronization.']],
                ['@type' => 'Question', 'name' => 'Which AI models power OBSIDIAN Neural?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Provider nodes run 9 specialized models, each assignable per track: Stable Audio 3 Medium (latest from Stability AI, FlowMatching architecture with world-class quality on world instruments and ambient textures), Stable Audio Open, Foundation-1, Audialab EDM Elements, RC Infinite Pianos, Vocal Textures, SAO Instrumental Finetune, StableBeaT, and Gluten v1. When no node is available, the system falls back to Stable Audio Open via fal.ai. An optional LLM Brain layer (disabled by default) can refine prompts based on session context and style.']],
                ['@type' => 'Question', 'name' => 'Is OBSIDIAN Neural free?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. The VST3/AU plugin is free and open source (AGPL-3.0) on GitHub. A free account gives you 20 credits (20 samples) at no cost and with no credit card required. Paid plans start at €14.99/month.']],
                ['@type' => 'Question', 'name' => 'Which DAWs and operating systems are supported?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Windows, macOS, and Linux. The free/cloud plugin ships as a universal macOS binary (Intel + Apple Silicon). The one-time Local Edition is Apple Silicon only on macOS (M1 and later; Intel Macs not supported). VST3 format for all major DAWs, and AU format for Logic Pro and GarageBand. A standalone mode with built-in transport and tempo control is also included, with Ableton Link support to sync tempo and start/stop with any Link-enabled app over your network.']],
                ['@type' => 'Question', 'name' => 'How does the Prompt Builder work?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => "The Prompt Builder is a model-aware editor with curated keywords organized by category (genres, instruments, moods, negatives). It builds clean prompts that match each engine's expected syntax — comma-separated tags for Foundation-1, pipe-separated fields for Gluten, descriptive prose for Stable Audio models. No guessing about how each model wants its prompt formatted."]],
                ['@type' => 'Question', 'name' => 'Can I use OBSIDIAN Neural without a DAW?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. OBSIDIAN Neural includes a standalone application with built-in transport controls and tempo management, so you can run it without any DAW. Ableton Link integration allows you to sync tempo and start/stop signals over your local network with any Link-enabled application, making it ideal for jam sessions, live performances, and collaborative setups.']],
                ['@type' => 'Question', 'name' => 'How does OBSIDIAN Neural handle BPM synchronization?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Generated samples are automatically tempo-detected via MiniBPM and time-stretched to match your DAW's current BPM using Signalsmith Stretch with zero pitch drift. You can change tempo mid-session without reloading samples or interrupting playback. In standalone mode, you can also sync tempo across multiple apps via Ableton Link."]],
                ['@type' => 'Question', 'name' => 'What is the OBSIDIAN Neural Local Edition?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'The Local Edition is a one-time purchase (€29) that runs Stable Audio 3 Medium directly on your CPU — no GPU, no cloud, no subscription, and no internet required after activation. A single payment grants a perpetual license activatable on up to 3 machines, with builds for Windows, macOS (Apple Silicon only) and Linux. It can optionally switch to server mode for the other AI engines if you have a subscription or your own self-hosted server.']],
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => 'OBSIDIAN Neural Network',
            'serviceType' => 'DePIN (Decentralized Physical Infrastructure Network)',
            'description' => 'Distributed GPU provider network for AI music generation with automated monthly redistribution via Stripe Connect. Providers verified through Mel Spectrogram Fingerprinting Proof-of-Work.',
            'offers' => [
                '@type' => 'Offer',
                'description' => 'Provider Eligibility: Uptime > 80%, 1+ billable job/month. 85% net revenue share, equal distribution among eligible providers.',
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'Dataset',
            'name' => 'OBSIDIAN Neural Proof of Generation Logs',
            'description' => 'Public immutable logs of AI audio generations verified via Mel Spectrogram Fingerprinting Proof-of-Work.',
            'url' => 'https://github.com/innermost47/obsidian-neural-central',
            'license' => 'https://www.mozilla.org/en-US/MPL/2.0/',
            'creator' => [
                '@type' => 'Person',
                'name' => 'Anthony Charretier',
                'alternateName' => 'InnerMost47',
                'url' => 'https://github.com/innermost47',
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => ['Product', 'SoftwareApplication'],
            'name' => 'OBSIDIAN Neural — Local Edition',
            'description' => 'One-time purchase edition of OBSIDIAN Neural. Runs Stable Audio 3 Medium locally on your CPU — no GPU, no cloud, no subscription. Fully offline after activation. Can switch to server mode for the other engines with a subscription or self-hosted server.',
            'image' => 'https://obsidian-neural.com/assets/images/screenshot-v2-5-1.webp',
            'operatingSystem' => 'Windows, macOS (Apple Silicon), Linux',
            'applicationCategory' => 'MultimediaApplication',
            'brand' => ['@type' => 'Brand', 'name' => 'OBSIDIAN Neural'],
            'creator' => [
                '@type' => 'Person',
                'name' => 'Anthony Charretier',
                'alternateName' => 'InnerMost47',
                'url' => 'https://github.com/innermost47',
            ],
            'offers' => [
                '@type' => 'Offer',
                'name' => 'Local Edition',
                'price' => '29',
                'priceCurrency' => 'EUR',
                'description' => 'One-time payment. Perpetual license, activate on up to 3 machines, Stable Audio 3 Medium runs locally offline forever.',
                'url' => 'https://obsidian-neural.com/local.php',
                'availability' => 'https://schema.org/InStock',
            ],
        ],
    ];

    echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    ?>
</script>