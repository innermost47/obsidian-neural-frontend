<?php
function render_step($args)
{
    $number = $args['number'] ?? '1';
    $color = $args['color'] ?? 'bg-primary';
    $title = $args['title'] ?? '';
    $desc = $args['desc'] ?? '';
?>
    <div class="text-center">
        <div class="w-14 h-14 rounded-2xl <?php echo $color; ?> flex items-center justify-center text-2xl mx-auto mb-4 shadow-[0_0_20px_rgba(217,104,80,0.15)]">
            <span class="text-white font-black text-lg"><?php echo $number; ?></span>
        </div>
        <h3 class="font-bold text-white mb-1"><?php echo htmlspecialchars($title); ?></h3>
        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($desc); ?></p>
    </div>
<?php
}
