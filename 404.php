<?php
$page_title = "404 — Page Not Found · OBSIDIAN Neural";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 min-h-screen flex items-center justify-center px-4 overflow-hidden">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/10 rounded-full blur-[120px]"></div>
        <div class="absolute top-1/3 left-1/4 w-[300px] h-[300px] bg-primary/5 rounded-full blur-[80px]"></div>
    </div>

    <div class="relative z-10 text-center max-w-2xl mx-auto">

        <div class="relative mb-6 select-none">
            <div class="text-[160px] md:text-[220px] font-black font-mono leading-none text-white/[0.03] absolute inset-0 flex items-center justify-center pointer-events-none"
                style="text-shadow: 0 0 80px rgba(217,104,80,0.15);">
                404
            </div>
            <div class="relative text-[80px] md:text-[120px] font-black font-mono leading-none tracking-tighter"
                style="background: linear-gradient(to bottom, #fff 40%, rgba(255,255,255,0.2)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                404
            </div>
        </div>

        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="h-px flex-1 bg-gradient-to-r from-transparent to-primary/40"></div>
            <div class="flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/10 border border-primary/30">
                <div class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Signal Lost</span>
            </div>
            <div class="h-px flex-1 bg-gradient-to-l from-transparent to-primary/40"></div>
        </div>

        <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-3">
            This page doesn't exist.
        </h1>
        <p class="text-gray-500 text-lg mb-10 max-w-md mx-auto">
            The audio you're looking for has already been generated — elsewhere. Let's get you back on track.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="index.php"
                class="px-8 py-4 rounded-xl bg-gradient-to-r from-primary to-[#a04840] text-white font-bold hover:scale-[1.02] transition-transform shadow-[0_0_25px_rgba(217,104,80,0.3)]">
                <i class="fas fa-home mr-2"></i>Back to Home
            </a>
            <a href="dashboard.php"
                class="px-8 py-4 rounded-xl bg-white/[0.03] border border-white/[0.06] text-white font-bold hover:bg-white/[0.06] transition-colors">
                <i class="fas fa-chart-line mr-2"></i>Dashboard
            </a>
        </div>

        <div class="mt-12 inline-block bg-white/[0.03] border border-white/[0.06] rounded-xl px-6 py-3 font-mono text-xs text-left">
            <span class="text-gray-600">$ </span>
            <span class="text-primary">obsidian</span>
            <span class="text-gray-400"> --find </span>
            <span class="text-white">page</span>
            <span class="text-gray-600 ml-2 animate-pulse">▋</span>
        </div>

    </div>

</main>

<?php include('partials/shared/footer.php'); ?>
<script src="js/cookie-consent.js"></script>