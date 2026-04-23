<?php
function render_activation_card($args)
{
    $icon = $args['icon'] ?? 'fas fa-layer-group';
    $icon_color = $args['icon_color'] ?? 'text-primary';
    $title = $args['title'] ?? '';
    $icon_size = $args['icon_size'] ?? 'fa-2x';
?>
    <div class="<?php echo $icon_color; ?>/20 flex items-center justify-center mb-3">
        <i class="<?php echo $icon; ?> <?php echo $icon_size; ?>"></i>
    </div>
    <h3 class="text-lg font-bold text-white mb-1"><?php echo htmlspecialchars($title); ?></h3>
    <p class="text-3xl font-black text-white mb-0" id="<?php echo $args['value_id'] ?? ''; ?>">—</p>
<?php
}
