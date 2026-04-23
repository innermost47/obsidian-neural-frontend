<?php
function render_faq_item($args)
{
    $id = $args['id'] ?? 'faq-' . rand();
    $icon = $args['icon'] ?? 'fas fa-circle';
    $icon_color = $args['icon_color'] ?? 'text-primary';
    $question = $args['question'] ?? '';
    $answer = $args['answer'] ?? '';
?>
    <div class="border border-white/[0.06] rounded-xl overflow-hidden">
        <button onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.faq-chevron').classList.toggle('rotate-180')" class="w-full flex items-center justify-between p-5 text-left hover:bg-white/[0.03] transition-colors">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center shrink-0 <?php echo $icon_color; ?>">
                    <i class="<?php echo $icon; ?> text-sm"></i>
                </div>
                <span class="font-bold text-sm text-white pr-4"><?php echo htmlspecialchars($question); ?></span>
            </div>
            <i class="fas fa-chevron-down faq-chevron text-[10px] text-gray-500 transition-transform duration-300 shrink-0"></i>
        </button>
        <div class="hidden px-5 pb-5 pl-[4.5rem] pt-5">
            <div class="text-sm text-gray-400 leading-relaxed">
                <?php echo $answer; ?>
            </div>
        </div>
    </div>
<?php
}
