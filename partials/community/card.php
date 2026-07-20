<?php

function render_track_card($item)
{
?>
    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden hover:bg-white/10 transition-all translate-y-8 flex flex-col">

        <?php if ($item['embed_type'] === 'youtube'): ?>
            <div class="aspect-video relative bg-black"
                data-youtube-id="<?= htmlspecialchars($item['embed']) ?>"
                data-title="<?= htmlspecialchars($item['track_title']) ?>">
            </div>
        <?php elseif ($item['embed_type'] === 'soundcloud'): ?>
            <div class="h-[166px] bg-black">
                <iframe
                    width="100%"
                    height="166"
                    scrolling="no"
                    frameborder="no"
                    loading="lazy"
                    title="<?= htmlspecialchars($item['track_title']) ?>"
                    src="https://w.soundcloud.com/player/?url=<?= urlencode($item['embed']) ?>&color=%23d96850&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false">
                </iframe>
            </div>
        <?php endif; ?>

        <div class="p-6 flex items-start gap-4 flex-1">
            <img
                src="<?= htmlspecialchars($item['avatar']) ?>"
                alt="<?= htmlspecialchars($item['name']) ?>"
                loading="lazy"
                class="w-14 h-14 rounded-full object-cover border-2 border-white/10 shrink-0" />
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-0.5 truncate">
                    <?= htmlspecialchars($item['track_title']) ?>
                </p>
                <h3 class="font-bold text-white text-lg mb-1">
                    <?= htmlspecialchars($item['name']) ?>
                </h3>
                <p class="text-sm text-gray-400 mb-3">
                    <?= htmlspecialchars($item['bio']) ?>
                </p>
                <a href="<?= htmlspecialchars($item['link']) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-bold text-gray-300 hover:text-white hover:bg-white/10 transition-all">
                    <i class="fas fa-external-link-alt text-primary"></i>
                    <?= htmlspecialchars($item['link_label']) ?>
                </a>
            </div>
        </div>
    </div>
<?php
}
