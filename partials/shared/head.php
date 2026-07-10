<!doctype html>
<html lang="en" class="bg-black text-white overflow-x-hidden scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <title><?php echo $page_title ?? 'OBSIDIAN Neural - AI Music Plugin'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
        name="description"
        content="<?php echo $page_desc; ?>" />
    <meta
        name="keywords"
        content="AI VST plugin, AI music generation VST3, live performance AI audio, Stable Audio VST, LLM music generation, AI DAW plugin, OBSIDIAN Neural, InnerMost47, sketch to audio, draw to audio VST, DePIN, GPU provider network, passive income GPU, distributed AI audio, proof of work music" />
    <meta name="author" content="InnerMost47 - Anthony Charretier" />
    <meta name="robots" content="index, follow" />
    <link
        rel="canonical"
        href="https://obsidian-neural.com" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="OBSIDIAN Neural" />
    <meta property="og:locale" content="en_US" />
    <meta
        property="og:url"
        content="https://obsidian-neural.com" />
    <meta
        property="og:title"
        content="OBSIDIAN Neural — AI Music Generation VST for Live Performance" />
    <meta
        property="og:description"
        content="First VST for AI music generation designed for live performance. 8-track sampler, LLM brain, draw-to-audio, 8 AI models. Presented at AES AIMLA 2025" />
    <meta
        property="og:image"
        content="https://obsidian-neural.com/assets/images/screenshot-v2-5-1.webp" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta
        property="og:image:alt"
        content="OBSIDIAN Neural VST3 plugin interface — 8-track AI sampler" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@innermost47" />
    <meta
        name="twitter:url"
        content="https://obsidian-neural.com" />
    <meta
        name="twitter:title"
        content="OBSIDIAN Neural — AI Music VST for Live Performance" />
    <meta
        name="twitter:description"
        content="First VST for AI music generation designed for live performance. 8 AI models, open source." />
    <meta
        name="twitter:image"
        content="https://obsidian-neural.com/assets/images/screenshot-v2-5-1.webp" />
    <meta
        name="twitter:image:alt"
        content="OBSIDIAN Neural VST plugin interface" />

    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="icon" type="image/x-icon" href="assets/images/logo.ico" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"
        media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/css/tailwind.min.css" />
    <?php
    require_once "partials/press/items.php";
    require_once "partials/shared/seo-schema.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js" defer></script>
    <script src="js/confetti-helper.js" defer></script>
</head>
<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotateX(20deg) rotateY(-15deg) rotateZ(2deg);
        }

        50% {
            transform: translateY(-20px) rotateX(22deg) rotateY(-12deg) rotateZ(1deg);
        }
    }

    @keyframes shadow-pulse {

        0%,
        100% {
            transform: translateX(-50%) rotateX(60deg) scale(1);
            opacity: 0.8;
        }

        50% {
            transform: translateX(-50%) rotateX(60deg) scale(0.9);
            opacity: 0.4;
        }
    }

    @keyframes pulse-dot {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.35;
            transform: scale(0.65);
        }
    }

    @keyframes scanline {
        0% {
            transform: translateY(-100%);
        }

        100% {
            transform: translateY(800%);
        }
    }

    .mock-console {
        transform-style: preserve-3d;
        transform: rotateX(20deg) rotateY(-15deg) rotateZ(2deg);
        transition: transform 0.1s ease-out;
        animation: float 6s ease-in-out infinite;
    }

    .mock-console::before {
        content: "";
        position: absolute;
        top: 100%;
        left: 1rem;
        right: 1rem;
        height: 30px;
        background: linear-gradient(to bottom, #111, #050505);
        transform-origin: top;
        transform: rotateX(-90deg);
        border-radius: 0 0 1rem 1rem;
    }

    .mock-console::after {
        content: "";
        position: absolute;
        top: 1rem;
        left: 100%;
        bottom: 1rem;
        width: 30px;
        background: linear-gradient(to right, #1a1a1d, #0a0a0c);
        transform-origin: left;
        transform: rotateY(90deg);
        border-radius: 0 1rem 1rem 0;
    }

    .console-screen {
        transform: translateZ(25px);
    }

    .console-shadow {
        animation: shadow-pulse 6s ease-in-out infinite;
    }

    .animate-scanline {
        animation: scanline 4s linear infinite;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #000;
    }

    ::-webkit-scrollbar-thumb {
        background: #333;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #d96850;
    }

    .nav-link-pill {
        padding: 0.4rem 0.85rem;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #888890;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .nav-link-pill:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.07);
    }

    .nav-link-pill.active {
        color: #fff;
        background: rgba(217, 104, 80, 0.15);
    }

    .nav-link-pill.nav-link-pill--warning {
        color: rgba(232, 168, 96, 0.8);
    }

    .nav-link-pill.nav-link-pill--warning:hover {
        color: #e8a860;
        background: rgba(232, 168, 96, 0.07);
    }

    .mobile-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: #c0c0c8;
        transition: all 0.15s;
    }

    .mobile-link:hover,
    .mobile-link.active {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    video,
    canvas {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
</style>

<body
    class="bg-black text-white overflow-x-hidden antialiased selection:bg-primary selection:text-black">