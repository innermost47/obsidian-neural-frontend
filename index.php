<?php
$page_title = "OBSIDIAN Neural: AI Audio Generation VST Plugin | VST3 AU";
$page_desc = "Real-time AI audio generation VST plugin for live performance. Generate stereo samples in ~10s, 8-track sampler, MIDI control, BPM sync. Free & open source. Featured at AES AIMLA 2025.";
include('partials/shared/head.php');
include('partials/shared/nav.php');
echo ("<main>");

include('partials/home/3D_VST.php');
include('partials/home/hero.php');
include('partials/home/testimonial.php');
include('partials/home/live_mixing.php');
include('partials/home/engines.php');
include('partials/home/local.php');
include('partials/home/mobile_controler.php');
include('partials/home/stats.php');
include('partials/home/featured.php');
include('partials/home/beatcrafter.php');
include('partials/home/provider.php');
include('partials/home/cta.php');
include('partials/shared/footer.php');

echo ("</main>");
echo ("<script src='js/api.js'></script>");
echo ("<script src='js/github-stats.js'></script>");
echo ("<script src='js/cookie-consent.js'></script>");
echo ("<script src='js/home.js'></script>");
echo ("<script src='js/beta-mode.js'></script>");
echo ("<script src='js/local.js'></script>");
