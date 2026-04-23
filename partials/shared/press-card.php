<?php
function render_press_card($args)
{
    $flag = $args['flag'] ?? '🏴';
    $country = $args['country'] ?? '';
    $outlet = $args['outlet'] ?? '';
    $date = $args['date'] ?? '';
    $icon = $args['icon'] ?? 'fas fa-newspaper';
    $icon_color = $args['icon_color'] ?? 'text-primary';
    $title = $args['title'] ?? '';
    $excerpt = $args['excerpt'] ?? '';
    $link_url = $args['url'] ?? '#';
    $link_label = $args['link_label'] ?? 'Read article';
?>
    <a href="<?php echo htmlspecialchars($link_url); ?>" target="_blank" rel="noopener" class="group block h-full">
        <div class="relative h-full bg-white/[0.03] backdrop-blur-md border border-white/[0.06] rounded-2xl p-5 md:p-6 hover:bg-white/[0.06] hover:border-white/[0.12] transition-all duration-300 overflow-hidden">

            <div class="absolute -top-20 -right-20 w-40 h-40 bg-primary/0 group-hover:bg-primary/10 rounded-full blur-3xl transition-all duration-500 pointer-events-none"></div>

            <div class="flex items-start justify-between mb-4 relative z-10">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-lg <?php echo $icon_color; ?> group-hover:scale-110 group-hover:border-white/20 transition-all duration-300 shrink-0">
                        <i class="<?php echo $icon; ?>"></i>
                    </div>
                    <div>
                        <span class="inline-block text-[10px] font-bold text-gray-500 bg-white/5 px-2 py-0.5 rounded-md mb-1 tracking-wider uppercase"><?php echo $flag . ' ' . $country; ?></span>
                        <h3 class="text-base font-bold text-white group-hover:text-primary transition-colors leading-tight"><?php echo htmlspecialchars($outlet); ?></h3>
                    </div>
                </div>
                <span class="text-[11px] text-gray-600 shrink-0 mt-1 hidden sm:block"><?php echo htmlspecialchars($date); ?></span>
            </div>

            <div class="relative z-10 flex flex-col h-[calc(100%-80px)]">
                <h4 class="text-sm font-bold text-gray-200 mb-2 leading-snug group-hover:text-white transition-colors line-clamp-2">
                    <?php echo htmlspecialchars($title); ?>
                </h4>
                <p class="text-xs text-gray-500 mb-4 leading-relaxed flex-1 line-clamp-3">
                    "<?php echo htmlspecialchars($excerpt); ?>"
                </p>

                <div class="flex items-center gap-2 text-xs font-bold <?php echo $icon_color; ?> group-hover:gap-3 transition-all duration-300">
                    <span><?php echo htmlspecialchars($link_label); ?></span>
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform duration-300"></i>
                </div>
            </div>

        </div>
    </a>
<?php
}
