<?php

$testimonials = [
    [
        'name'   => 'Moteka',
        'role'   => 'Producer',
        'avatar' => 'assets/images/moteka.jpg',
        'quote'  => [
            '"I\'ve cycled through almost every AI music tool on the market, but <span class="text-white font-semibold">this is the first one that actually feels like a real production tool</span> rather than a novelty. While other AI apps try to replace the songwriter, it treats AI like a <span class="text-primary font-semibold">powerful, playable instrument</span>."',
            '"The <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-track4 font-bold">8-track MIDI-triggering</span> is a total game-changer—having immediate access to eight distinct loops that I can mix and manipulate individually makes it feel like a <span class="text-white font-semibold">smart sampler</span> rather than a \'black box.\'"',
            '"Because it lives directly in my DAW, there is <span class="text-white font-semibold">zero latency and zero break in my workflow</span>; I\'m not downloading files or waiting for a browser to render. It stays perfectly locked to my project\'s tempo and vibe, serving as the ultimate <span class="text-primary font-bold">\'intelligent jam partner VST\'</span> whenever I need to break through a creative block, or start a new track from scratch."',
        ],
        'links'  => [
            ['icon' => 'fab fa-soundcloud', 'url' => 'https://soundcloud.com/moteka', 'label' => 'Moteka Soundcloud'],
            ['icon' => 'fab fa-instagram', 'url' => 'https://www.instagram.com/pmoteka/', 'label' => 'Moteka Instagram'],
        ],
    ],

    [
        'name'   => 'Brian Bullock',
        'role'   => 'Founder/Director @RETHINK Studios',
        'avatar' => 'assets/images/rethink.jpg',
        'quote'  => [
            '"As someone deep in AI-assisted production, OBSIDIAN Neural\'s local edition is a game-changer for creative flow. Once the model loads into memory, we\'re generating usable samples in <span class="text-primary font-semibold">under 10 seconds</span> — fast enough that it never breaks momentum in the DAW."',
            '"Being able to iterate on basslines, drum loops, and textures at that speed, without round-tripping to a cloud API, <span class="text-white font-semibold">changes how you actually work</span>. Most AI audio tools break flow because you\'re waiting on a queue; this one just disappears into the workflow."',
            '"And if local generation is already this fast, it\'s easy to see a near future where AI-generated content runs live, in real time, right alongside the artist — not as a tool you wait on, but as an <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-track4 font-bold">instrument you play</span>."',
        ],
        'links'  => [
            ['icon' => 'fab fa-linkedin', 'url' => 'https://www.linkedin.com/in/brian-bullock-9aa0512/', 'label' => 'Brian Bullock LinkedIn'],
            ['icon' => 'fas fa-link', 'url' => 'https://www.rethinkstudios.tv/', 'label' => 'Rethink Studios Website'],
        ],
    ],
];

$autoplay = 6000;
?>

<section class="relative z-20 py-24 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-3 gs-reveal opacity-0 translate-y-6">
                Testimonials
            </h2>
            <p class="text-base md:text-lg font-medium text-primary mb-2 gs-reveal opacity-0 translate-y-6">
                From producers who actually used it.
            </p>
            <p class="text-gray-400 text-lg gs-reveal opacity-0 translate-y-6">
                Real feedback, straight from their own sessions
            </p>
        </div>
        <div
            class="testimonial-carousel gs-reveal opacity-0 scale-95"
            data-autoplay="<?= (int) $autoplay ?>">

            <div class="testimonial-viewport relative overflow-hidden">
                <div class="testimonial-track flex" style="width:<?= count($testimonials) * 100 ?>%;">
                    <?php foreach ($testimonials as $i => $t):
                        $hasAvatar = !empty($t['avatar']);
                        $links = $t['links'] ?? [];
                    ?>
                        <div class="testimonial-slide" style="width:<?= 100 / max(count($testimonials), 1) ?>%;">
                            <div
                                class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl overflow-hidden relative">
                                <div
                                    class="absolute inset-0 bg-primary/10 blur-[100px] rounded-full mix-blend-screen pointer-events-none opacity-30"></div>
                                <div class="relative grid grid-cols-1 md:grid-cols-12 gap-0">

                                    <div
                                        class="md:col-span-4 p-8 md:p-10 flex flex-col items-center justify-center text-center border-b md:border-b-0 md:border-r border-white/10">

                                        <?php if ($hasAvatar): ?>
                                            <div
                                                class="w-28 h-28 rounded-full overflow-hidden border-3 border-primary mb-4 shadow-[0_0_30px_rgba(217,104,80,0.3)]">
                                                <img
                                                    src="<?= htmlspecialchars($t['avatar']) ?>"
                                                    alt="<?= htmlspecialchars($t['name']) ?> — <?= htmlspecialchars($t['role']) ?>"
                                                    class="w-full h-full object-cover"
                                                    onerror="this.onerror=null;this.parentElement.classList.add('testimonial-avatar-fallback');this.remove();" />
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="w-28 h-28 rounded-full flex items-center justify-center border-3 border-primary mb-4 bg-white/5 shadow-[0_0_30px_rgba(217,104,80,0.3)]">
                                                <i class="fas fa-user text-3xl text-primary/70"></i>
                                            </div>
                                        <?php endif; ?>

                                        <p class="text-xl font-bold text-white mb-1"><?= htmlspecialchars($t['name']) ?></p>
                                        <p class="text-primary font-bold text-sm uppercase tracking-wider mb-5">
                                            <?= htmlspecialchars($t['role']) ?>
                                        </p>

                                        <?php if (!empty($links)): ?>
                                            <div class="flex gap-3">
                                                <?php foreach ($links as $link): ?>
                                                    <a
                                                        href="<?= htmlspecialchars($link['url']) ?>"
                                                        target="_blank"
                                                        rel="noopener"
                                                        aria-label="<?= htmlspecialchars($link['label'] ?? $t['name']) ?>"
                                                        class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"><i class="<?= htmlspecialchars($link['icon']) ?>"></i></a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="md:col-span-8 p-8 md:p-10">
                                        <i
                                            class="fas fa-quote-left text-5xl text-white/5 absolute top-6 right-8"></i>
                                        <blockquote class="space-y-5 text-gray-300 leading-relaxed">
                                            <?php foreach ($t['quote'] as $paragraph): ?>
                                                <p><?= $paragraph ?></p>
                                            <?php endforeach; ?>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if (count($testimonials) > 1): ?>
                <div class="flex items-center justify-center gap-4 mt-8">
                    <button
                        type="button"
                        class="testimonial-prev w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"
                        aria-label="Témoignage précédent">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="testimonial-dots flex items-center gap-2">
                        <?php foreach ($testimonials as $i => $t): ?>
                            <button
                                type="button"
                                class="testimonial-dot w-2.5 h-2.5 rounded-full bg-white/20 hover:bg-white/40 transition-all"
                                data-index="<?= $i ?>"
                                aria-label="Aller au témoignage <?= $i + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>

                    <button
                        type="button"
                        class="testimonial-next w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/10 transition-all"
                        aria-label="Témoignage suivant">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .testimonial-track {
        transition: transform 0.6s cubic-bezier(0.65, 0, 0.35, 1);
    }

    .testimonial-slide {
        flex-shrink: 0;
        padding: 0 2px;
        /* évite un léger débordement visuel entre slides */
    }

    .testimonial-avatar-fallback {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
    }

    .testimonial-avatar-fallback::after {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f007";
        /* fa-user */
        color: var(--tw-color-primary, #d96850);
        opacity: 0.7;
        font-size: 1.5rem;
    }

    .testimonial-dot.is-active {
        background-color: var(--tw-color-primary, #d96850);
        width: 1.5rem;
        border-radius: 9999px;
    }
</style>

<script>
    (function() {
        document.querySelectorAll('.testimonial-carousel').forEach(function(root) {
            var track = root.querySelector('.testimonial-track');
            var slides = root.querySelectorAll('.testimonial-slide');
            var dots = root.querySelectorAll('.testimonial-dot');
            var prevBtn = root.querySelector('.testimonial-prev');
            var nextBtn = root.querySelector('.testimonial-next');
            var total = slides.length;
            var current = 0;
            var autoplayDelay = parseInt(root.dataset.autoplay || '0', 10);
            var timer = null;

            if (total <= 1) return;

            function goTo(index) {
                current = (index + total) % total;
                track.style.transform = 'translateX(-' + (current * (100 / total)) + '%)';
                dots.forEach(function(dot, i) {
                    dot.classList.toggle('is-active', i === current);
                });
            }

            function next() {
                goTo(current + 1);
            }

            function prev() {
                goTo(current - 1);
            }

            function startAutoplay() {
                if (!autoplayDelay) return;
                stopAutoplay();
                timer = setInterval(next, autoplayDelay);
            }

            function stopAutoplay() {
                if (timer) clearInterval(timer);
            }

            prevBtn && prevBtn.addEventListener('click', function() {
                prev();
                startAutoplay();
            });
            nextBtn && nextBtn.addEventListener('click', function() {
                next();
                startAutoplay();
            });
            dots.forEach(function(dot) {
                dot.addEventListener('click', function() {
                    goTo(parseInt(dot.dataset.index, 10));
                    startAutoplay();
                });
            });

            root.addEventListener('mouseenter', stopAutoplay);
            root.addEventListener('mouseleave', startAutoplay);

            // Swipe tactile
            var startX = null;
            track.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
                stopAutoplay();
            }, {
                passive: true
            });
            track.addEventListener('touchend', function(e) {
                if (startX === null) return;
                var diff = e.changedTouches[0].clientX - startX;
                if (diff > 50) prev();
                else if (diff < -50) next();
                startX = null;
                startAutoplay();
            });

            goTo(0);
            startAutoplay();
        });
    })();
</script>