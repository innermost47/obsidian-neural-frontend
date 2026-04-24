<?php

function dash_stat($icon, $label, $id, $sub = '')
{
    echo '<div class="relative bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 overflow-hidden hover:-translate-y-1 hover:border-primary/40 hover:shadow-[0_12px_24px_rgba(184,96,92,0.15)] transition-all duration-300">';
    echo '<div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-primary to-[#a04840] opacity-0 hover:opacity-100 transition-opacity"></div>';
    echo '<div class="flex items-center gap-3 mb-4"><div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center shrink-0"><i class="' . $icon . '"></i></div><h6 class="text-xs font-bold uppercase tracking-wider text-gray-500 m-0">' . $label . '</h6></div>';
    echo '<div class="text-2xl font-black text-white" id="' . $id . '">—</div>';
    if ($sub) echo '<p class="text-xs text-gray-600 mt-1">' . $sub . '</p>';
    echo '</div>';
}

function dash_section_start($id, $icon, $title, $subtitle, $active = false)
{
    $cls = $active ? ' active' : '';
    echo '<div id="section-' . $id . '" class="section-content' . $cls . '">';
    echo '<div class="sticky top-0 z-10 bg-[#0a0a0c]/95 backdrop-blur-md border-b border-white/[0.06] px-6 lg:px-12 py-5">';
    echo '<h1 class="text-xl md:text-2xl font-extrabold text-white m-0"><i class="' . $icon . ' mr-3 text-primary"></i>' . $title . '</h1>';
    echo '<p class="text-sm text-gray-500 mt-1 mb-0">' . $subtitle . '</p>';
    echo '</div>';
    echo '<div class="p-6 lg:p-12">';
}

function dash_section_end()
{
    echo '</div></div>';
}

function dash_card($content, $class = '')
{
    return '<div class="bg-white/[0.03] border border-white/[0.06] rounded-2xl p-6 ' . $class . '">' . $content . '</div>';
}
