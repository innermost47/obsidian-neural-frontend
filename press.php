<?php

include('partials/shared/head.php');

$page_title = "Press Coverage — OBSIDIAN Neural | {$publication_count} Publications, {$country_count} Countries";
$page_desc  = "OBSIDIAN Neural featured in {$publication_count}+ international publications across "
  . "{$country_count} countries and {$language_count} languages: "
  . implode(', ', array_column($press_items, 'outlet')) . ".";
?>

<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 pt-32 pb-24 px-4">
  <div class="max-w-6xl mx-auto">

    <?php include('partials/press/header.php'); ?>
    <?php include('partials/press/stats.php'); ?>
    <?php include('partials/press/featured-aimla.php'); ?>
    <?php include('partials/shared/press-card.php'); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-16">
      <?php foreach ($press_items as $item): ?>
        <?php render_press_card($item); ?>
      <?php endforeach; ?>
    </div>

    <?php include('partials/press/cta.php'); ?>
    <?php include('partials/press/footer-note.php'); ?>

  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/github-stats.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/press.js"></script>