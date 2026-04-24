<?php
function legal_section($icon, $title, $content)
{
    echo '<section class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 md:p-8">';
    echo '<div class="flex items-center gap-3 mb-6">';
    echo '<div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center shrink-0"><i class="' . $icon . '"></i></div>';
    echo '<h2 class="text-xl font-extrabold text-white">' . $title . '</h2>';
    echo '</div>';
    echo $content;
    echo '</section>';
}

function usage_item($icon, $color, $text)
{
    return '<div class="flex items-start gap-3 py-2.5 border-b border-white/[0.04] last:border-0">
        <i class="' . $icon . ' ' . $color . ' mt-0.5 shrink-0 text-sm"></i>
        <span class="text-sm text-gray-400">' . $text . '</span>
    </div>';
}

function info_card($icon, $color, $title, $text)
{
    return '<div class="bg-white/[0.03] border border-white/[0.06] rounded-xl p-5 text-center">
        <i class="' . $icon . ' ' . $color . ' text-2xl mb-3 block"></i>
        <h3 class="text-sm font-bold text-white mb-1">' . $title . '</h3>
        <p class="text-xs text-gray-500 mb-0">' . $text . '</p>
    </div>';
}

function sharing_card($icon, $color, $title, $text)
{
    return '<div class="flex items-start gap-4 bg-white/[0.03] border border-white/[0.06] rounded-xl p-5">
        <i class="' . $icon . ' ' . $color . ' text-2xl shrink-0 mt-0.5"></i>
        <div>
            <h3 class="text-sm font-bold text-white mb-1">' . $title . '</h3>
            <p class="text-xs text-gray-500 mb-0">' . $text . '</p>
        </div>
    </div>';
}

function alert_box($type, $icon, $content)
{
    $colors = [
        'danger'  => 'bg-danger/10 border-danger/30 text-danger',
        'warning' => 'bg-warning/10 border-warning/30 text-warning',
        'info'    => 'bg-primary/10 border-primary/30 text-primary',
        'success' => 'bg-success/10 border-success/30 text-success',
    ];
    $cls = $colors[$type] ?? $colors['info'];
    return '<div class="p-4 rounded-xl border ' . $cls . ' text-sm font-medium">
        <i class="' . $icon . ' mr-2"></i>' . $content . '
    </div>';
}

function legal_cta($title, $subtitle, $btn_id, $btn_label)
{
    echo '<div class="bg-gradient-to-r from-primary/20 to-[#a04840]/10 border border-primary/30 rounded-2xl p-6 md:p-8">';
    echo '<div class="flex flex-col md:flex-row items-center justify-between gap-4">';
    echo '<div>';
    echo '<h3 class="text-xl font-extrabold text-white mb-1">' . $title . '</h3>';
    echo '<p class="text-sm text-gray-400">' . $subtitle . '</p>';
    echo '</div>';
    echo '<a id="' . $btn_id . '" href="contact.php" class="shrink-0 px-6 py-3 rounded-xl bg-white text-black font-bold hover:bg-gray-200 transition-colors whitespace-nowrap">';
    echo '<i class="fas fa-envelope mr-2"></i>' . $btn_label;
    echo '</a>';
    echo '</div>';
    echo '</div>';
}
