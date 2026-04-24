<?php
$page_title = "Press Coverage — OBSIDIAN Neural | 12 Publications, 8 Countries";
$page_desc = "OBSIDIAN Neural featured in 12+ international publications across 8 countries and 6 languages: Bedroom Producers Blog, Synthtopia, Audiofanzine, Rekkerd, FutureMusic España, MIDIFAN, Sohu, DTM Plugin Sale, Audio Plugin Guy, S1 Forum.";
include('partials/shared/head.php');
?>
<?php include('partials/shared/nav.php'); ?>

<main class="relative z-20 pt-32 pb-24 px-4">
  <div class="max-w-6xl mx-auto">

    <?php include('partials/press/header.php'); ?>
    <?php include('partials/press/stats.php'); ?>
    <?php include('partials/press/featured-aimla.php'); ?>
    <?php include('partials/shared/press-card.php'); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-16">

      <?php render_press_card([
        'url' => 'https://www.synthtopia.com/content/2025/12/22/obsidian-neural-brings-ai-generated-samples-to-your-daw/',
        'flag' => '🇺🇸',
        'country' => 'USA',
        'outlet' => 'Synthtopia',
        'date' => 'Dec 22, 2025',
        'icon' => 'fas fa-wave-square',
        'icon_color' => 'text-success',
        'title' => 'Obsidian Neural Brings AI-Generated Samples To Your DAW',
        'excerpt' => 'All drum loops, basslines, and atmospheric elements were generated using AI text-to-audio prompts, then arranged and performed live. No pre-recorded traditional samples used.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://www.midifan.com/modulenews-detailview-57259.htm',
        'flag' => '🇨🇳',
        'country' => 'China',
        'outlet' => 'MIDIFAN',
        'date' => 'Dec 5, 2025',
        'icon' => 'fas fa-music',
        'icon_color' => 'text-warning',
        'title' => '福利：可实时生成音乐的 AI 创作插件 OBSIDIAN Neural 免费下载',
        'excerpt' => 'OBSIDIAN Neural是作为AI创意伙伴，而非替代音乐制作。插件实时生成音乐，保持完全控制，无限制探索，直接在DAW中完成。'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://s1forum.kr/news/innermost47%EC%97%90%EC%84%9C-obsidian-neural-%EA%B3%B5%EA%B0%9C/',
        'flag' => '🇰🇷',
        'country' => 'South Korea',
        'outlet' => 'S1 Forum',
        'date' => '2025',
        'icon' => 'fas fa-drum',
        'icon_color' => 'text-track2',
        'title' => 'InnerMost47에서 OBSIDIAN Neural 공개',
        'excerpt' => 'AI를 대체가 아닌 창작 파트너로 활용... 사용자는 실시간으로 음악을 생성하면서도 모든 컨트롤을 유지하고, DAW 안에서 제한 없이 탐색할 수 있습니다.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://rekkerd.org/obsidian-neural-real-time-ai-music-generation-vst3/',
        'flag' => '🇳🇱',
        'country' => 'Netherlands',
        'outlet' => 'Rekkerd',
        'date' => 'Dec 3, 2025',
        'icon' => 'fas fa-headphones',
        'icon_color' => 'text-track4',
        'title' => 'OBSIDIAN Neural: AI music generation VST3 for live performance',
        'excerpt' => 'AI as your creative partner, not your replacement. Generate samples in ~30s, keep full control, explore without limits—directly in your DAW.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://fr.audiofanzine.com/sequenceur-divers/obsidian-neural/obsidian-neural/news/a.play,n.78783.html',
        'flag' => '🇫🇷',
        'country' => 'France',
        'outlet' => 'Audiofanzine',
        'date' => 'Oct 28, 2025',
        'icon' => 'fas fa-flag',
        'icon_color' => 'text-primary',
        'title' => 'Voici Obsidian-Neural',
        'excerpt' => 'Contrairement aux solutions externes nécessitant de passer par des applications séparées, Obsidian-Neural intègre la génération audio neuronale en temps réel directement dans le séquenceur.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://bedroomproducersblog.com/2025/06/06/obsidian-neural-sound-engine/',
        'flag' => '🇺🇸',
        'country' => 'USA',
        'outlet' => 'Bedroom Producers Blog',
        'date' => 'Jun 6, 2025',
        'icon' => 'fas fa-music',
        'icon_color' => 'text-track3',
        'title' => 'OBSIDIAN Neural Sound Engine, a FREE AI-powered jam partner',
        'excerpt' => 'Too many AI projects focus on the things AI can save you from doing rather than how AI can help you get better at what you do. — James Nugent'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://www.futuremusic-es.com/obsidian-neural-vst3-ia-generativa/',
        'flag' => '🇪🇸',
        'country' => 'Spain',
        'outlet' => 'FutureMusic España',
        'date' => '2025',
        'icon' => 'fas fa-bolt',
        'icon_color' => 'text-track7',
        'title' => 'OBSIDIAN‑Neural es una IA creativa en vivo con un VST3 generativo',
        'excerpt' => 'OBSIDIAN-Neural acts like a neural DJ in your DAW, generating audio in real time based on the production environment...'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://www.sohu.com/a/903075640_455142',
        'flag' => '🇨🇳',
        'country' => 'China',
        'outlet' => 'Sohu.com',
        'date' => '2025',
        'icon' => 'fas fa-globe',
        'icon_color' => 'text-track5',
        'title' => 'OBSIDIAN：免费开源 AI 驱动的即兴演奏引擎',
        'excerpt' => 'Coverage on one of China\'s major web portals, introducing OBSIDIAN-Neural to the Chinese tech and music production community.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://www.midifan.com/modulenews-detailview-55186.htm',
        'flag' => '🇨🇳',
        'country' => 'China',
        'outlet' => 'MIDIFAN',
        'date' => '2025',
        'icon' => 'fas fa-star',
        'icon_color' => 'text-warning',
        'title' => 'Featured Coverage',
        'excerpt' => 'Coverage in China\'s leading music technology publication, reaching the Asian electronic music production community.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://projectofnapskint.com/obsidian-2/',
        'flag' => '🇯🇵',
        'country' => 'Japan',
        'outlet' => 'DTM Plugin Sale',
        'date' => '2025',
        'icon' => 'fas fa-microchip',
        'icon_color' => 'text-track6',
        'title' => 'AI を楽器に変える時代が来た！',
        'excerpt' => 'The era of turning AI into musical instruments has arrived! Coverage in Japanese music production community.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://www.audiopluginguy.com/news-innermost47-launches-free-real-time-ai-music-generation-plugin-obsidian-neural-sound-engine/',
        'flag' => '🇺🇸',
        'country' => 'USA',
        'outlet' => 'Audio Plugin Guy',
        'date' => '2025',
        'icon' => 'fas fa-plug',
        'icon_color' => 'text-primary',
        'title' => 'innermost47 launches free AI music generation plugin for live performance',
        'excerpt' => 'Comprehensive coverage of the plugin launch and technical capabilities.'
      ]); ?>

      <?php render_press_card([
        'url' => 'https://www.youtube.com/watch?v=40pkX_MkXjE',
        'flag' => '📺',
        'country' => 'YouTube',
        'outlet' => 'Amner Hunter',
        'date' => 'Jun 2025',
        'icon' => 'fab fa-youtube',
        'icon_color' => 'text-danger',
        'title' => '17 Best New FREE Effect Plugins - JUNE 2025',
        'excerpt' => 'Featured in YouTube roundup of best free plugins for June 2025.',
        'link_label' => 'Watch video'
      ]); ?>

    </div>

    <?php include('partials/press/cta.php'); ?>
    <?php include('partials/press/footer-note.php'); ?>

  </div>
</main>

<?php include('partials/shared/footer.php'); ?>

<script src="js/github-stats.js"></script>
<script src="js/cookie-consent.js"></script>
<script src="js/press.js"></script>