<?php
$page_title = "AI Music Gift Cards — OBSIDIAN Neural | Perfect for Producers & DJs";
$page_desc = "Give the gift of AI music generation. OBSIDIAN Neural gift cards for Base, Starter, Pro plans — 1, 3, or 6 months. Instant email delivery. No auto-renewal.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 pt-32 pb-24 px-4">
  <div class="max-w-6xl mx-auto">
    <?php include('partials/gift/header.php'); ?>
    <?php include('partials/shared/gift-step.php'); ?>

    <section class="py-16 mb-16">
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-white mb-2">How It Works</h2>
        <p class="text-gray-500">Purchase, gift, and let them create</p>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <?php render_step(['number' => '1', 'color' => 'bg-primary', 'title' => 'Choose a Plan', 'desc' => 'Base, Starter, or Pro for 1, 3, or 6 months']); ?>
        <?php render_step(['number' => '2', 'color' => 'bg-track3', 'title' => 'Recipient Email', 'desc' => 'Enter their email and optional message']); ?>
        <?php render_step(['number' => '3', 'color' => 'bg-danger', 'title' => 'Pay Securely', 'desc' => 'Secure payment via Stripe']); ?>
        <?php render_step(['number' => '4', 'color' => 'bg-success', 'title' => 'Instant Delivery', 'desc' => 'Gift code sent via email instantly']); ?>
      </div>
    </section>

    <section class="py-16 mb-16" style="background: radial-gradient(ellipse at 50% 50%, rgba(77,163,179,0.05) 0%, transparent 60%);">
      <?php include('partials/gift/form.php'); ?>
    </section>

    <?php include('partials/gift/why-gift.php'); ?>
  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/github-stats.js"></script>
<script src="js/config.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/api.js"></script>
<script src="js/gift.js"></script>