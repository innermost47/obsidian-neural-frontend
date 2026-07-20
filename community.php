<?php

include('partials/community/tracks.php');

$artist_count = count($community_tracks);

include('partials/shared/head.php');

$page_title = "Made with OBSIDIAN Neural — Community Tracks | {$artist_count} Artists";
$page_desc  = "Real tracks from {$artist_count} producers using OBSIDIAN Neural live in their DAW: "
    . implode(', ', array_column($community_tracks, 'name')) . ".";
?>

<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 pt-32 pb-24 px-4">
    <div class="max-w-6xl mx-auto">

        <?php include('partials/community/header.php'); ?>
        <?php include('partials/community/card.php'); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-16">
            <?php foreach ($community_tracks as $item): ?>
                <?php render_track_card($item); ?>
            <?php endforeach; ?>
        </div>

        <?php include('partials/community/cta.php'); ?>

    </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/cookie-consent.js"></script>
<script src="js/community.js"></script>