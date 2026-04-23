<?php
function render_pricing_card($args)
{
    $name = $args['name'] ?? '';
    $desc = $args['desc'] ?? '';
    $price = $args['price'] ?? '';
    $period = $args['period'] ?? '';
    $billing = $args['billing'] ?? '';
    $icon = $args['icon'] ?? 'fas fa-flask';
    $icon_color = $args['icon_color'] ?? 'text-gray-400';
    $features = $args['features'] ?? [];
    $btn_text = $args['btn_text'] ?? 'Get Started';
    $btn_url = $args['btn_url'] ?? 'register.php';
    $btn_icon = $args['btn_icon'] ?? '';
    $featured = $args['featured'] ?? false;
    $badge_text = $args['badge_text'] ?? '';
    $badge_icon = $args['badge_icon'] ?? '';
?>
    <div class="relative <?php if ($featured): ?>md:scale-105 md:z-10<?php endif; ?>">

        <div class="relative h-full bg-white/[0.03] backdrop-blur-md border rounded-2xl p-6 flex flex-col overflow-hidden transition-all duration-300 <?php if ($featured): ?>border-primary/40 bg-gradient-to-b from-primary/10 to-transparent hover:border-primary/60<?php else: ?>border-white/[0.06] hover:bg-white/[0.06] hover:border-white/[0.12]<?php endif; ?>">

            <?php if ($badge_text): ?>
                <div class="absolute top-0 inset-x-0 h-8 flex items-center justify-center <?php if ($featured): ?>bg-primary<?php else: ?>bg-white/5<?php endif; ?>">
                    <span class="text-[10px] font-bold uppercase tracking-[0.15em] <?php if ($featured): ?>text-white<?php else: ?>text-gray-400<?php endif; ?>">
                        <?php if ($badge_icon): ?><i class="<?php echo $badge_icon; ?> mr-1"></i><?php endif; ?><?php echo htmlspecialchars($badge_text); ?>
                    </span>
                </div>
            <?php endif; ?>

            <div class="flex-1 flex flex-col pt-<?php echo $badge_text ? '10' : '6'; ?>">

                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-2xl mx-auto mb-4 <?php echo $icon_color; ?> group-hover:scale-110 transition-transform">
                    <i class="<?php echo $icon; ?>"></i>
                </div>

                <h2 class="text-xl font-bold text-center mb-1 <?php if ($featured): ?>text-white<?php else: ?>text-white<?php endif; ?>"><?php echo htmlspecialchars($name); ?></h2>
                <p class="text-xs text-center mb-6 <?php if ($featured): ?>text-white/60<?php else: ?>text-gray-500<?php endif; ?>"><?php echo htmlspecialchars($desc); ?></p>

                <div class="text-center mb-1">
                    <span class="text-4xl font-black tracking-tight <?php if ($featured): ?>text-white<?php else: ?>text-white<?php endif; ?>"><?php echo htmlspecialchars($price); ?></span>
                    <?php if ($period): ?><span class="text-sm text-gray-500 font-medium">/<?php echo htmlspecialchars($period); ?></span><?php endif; ?>
                </div>
                <?php if ($billing): ?>
                    <p class="text-[10px] text-center text-gray-600 mb-6 mt-2"><?php echo htmlspecialchars($billing); ?></p>
                <?php else: ?>
                    <div class="mb-6"></div>
                <?php endif; ?>

                <ul class="space-y-3 mb-8 flex-1">
                    <?php foreach ($features as $feat): ?>
                        <li class="flex items-start gap-2.5 text-sm">
                            <i class="fas fa-check-circle <?php if ($featured): ?>text-white/80<?php else: ?>text-success<?php endif; ?> mt-0.5 text-xs shrink-0"></i>
                            <span class="<?php if ($featured): ?>text-white/80<?php else: ?>text-gray-400<?php endif; ?>"><?php echo $feat; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="mt-auto">
                    <a href="<?php echo htmlspecialchars($btn_url); ?>" class="block w-full text-center px-6 py-3 rounded-xl font-bold transition-all duration-200 <?php if ($featured): ?>bg-white text-black hover:bg-gray-200 shadow-[0_0_25px_rgba(255,255,255,0.15)]<?php else: ?>bg-white/5 border border-white/10 text-white hover:bg-white/10<?php endif; ?>">
                        <?php if ($btn_icon): ?><i class="<?php echo $btn_icon; ?> mr-2"></i><?php endif; ?><?php echo htmlspecialchars($btn_text); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
<?php
}
