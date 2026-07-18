<?php
$tutoVideos = require __DIR__ . '/video-data.php';
?>
<section
    class="relative z-20 py-24 px-4"
    style="
background: radial-gradient(
ellipse at 80% 50%,
rgba(77, 163, 179, 0.06) 0%,
transparent 60%
);
"
    id="tutorial">

    <style>
        .tuto-dot {
            width: 12px;
            height: 12px;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.25);
            border: none;
            padding: 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tuto-dot:hover {
            background: rgba(255, 255, 255, 0.55);
        }

        .tuto-dot.is-active {
            width: 28px;
            background: var(--color-primary);
        }

        .tuto-arrow[disabled] {
            opacity: 0.3;
            pointer-events: none;
        }

        .yt-lazy {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: none;
            padding: 0;
            cursor: pointer;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .yt-lazy::after {
            content: "";
            width: 72px;
            height: 50px;
            background: rgba(0, 0, 0, 0.75);
            border-radius: 14px;
            position: absolute;
            transition: background 0.2s ease;
        }

        .yt-lazy::before {
            content: "";
            border-style: solid;
            border-width: 12px 0 12px 20px;
            border-color: transparent transparent transparent #fff;
            position: absolute;
            z-index: 1;
            margin-left: 4px;
        }

        .yt-lazy:hover::after {
            background: var(--color-primary);
        }
    </style>

    <div class="max-w-6xl mx-auto">
        <div class="mb-10">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-3 gs-reveal opacity-0 translate-y-6">
                    THE DIY TUTORIALS.
                </h2>
                <p class="text-base font-medium text-primary mb-2 gs-reveal opacity-0 translate-y-6">
                    One take. No script. No cuts. Learn to pilot the mirage.
                </p>
                <p class="text-gray-400 max-w-2xl mx-auto mb-4 gs-reveal opacity-0 translate-y-6">
                    Raw, unpolished, straight from the studio — the same way the whole
                    project was built.
                    <span class="text-white font-semibold">Dive into the beast to
                        discover its number — and what's in its core.</span>
                </p>
            </div>

            <div class="max-w-4xl mx-auto gs-reveal opacity-0 scale-95">
                <div id="tuto-carousel">

                    <div class="overflow-hidden rounded-3xl mb-2">
                        <div class="flex transition-transform duration-500 ease-out"
                            data-carousel-track>

                            <?php foreach ($tutoVideos as $video): ?>
                                <div class="w-full shrink-0" data-carousel-slide>
                                    <div class="aspect-video rounded-3xl border-2 border-danger/40 shadow-2xl shadow-danger/10 relative overflow-hidden bg-black"
                                        id="yt-<?= htmlspecialchars($video['slug']) ?>"
                                        data-youtube-id="<?= htmlspecialchars($video['youtube_id']) ?>"
                                        data-title="<?= htmlspecialchars($video['title']) ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <p class="mt-5 text-sm text-gray-400 text-center min-h-[1.5rem]"
                        data-carousel-caption>
                        <?= htmlspecialchars($tutoVideos[0]['caption'] ?? '') ?>
                    </p>

                    <div class="mt-4 flex items-center justify-center gap-6">
                        <button type="button"
                            data-carousel-prev
                            aria-label="Previous video"
                            class="tuto-arrow w-12 h-12 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-white flex items-center justify-center hover:bg-white/10 hover:border-danger/50 hover:text-danger transition-all">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <div class="flex items-center gap-2.5" data-carousel-dots>
                            <?php foreach ($tutoVideos as $i => $video): ?>
                                <button type="button"
                                    class="tuto-dot<?= $i === 0 ? ' is-active' : '' ?>"
                                    data-carousel-dot="<?= $i ?>"
                                    aria-label="Go to video <?= $i + 1 ?>">
                                </button>
                            <?php endforeach; ?>
                        </div>

                        <button type="button"
                            data-carousel-next
                            aria-label="Next video"
                            class="tuto-arrow w-12 h-12 rounded-full bg-white/5 backdrop-blur-md border border-white/10 text-white flex items-center justify-center hover:bg-white/10 hover:border-danger/50 hover:text-danger transition-all">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    <p class="mt-3 text-xs text-gray-600 text-center font-medium tracking-widest"
                        data-carousel-counter></p>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto gs-reveal opacity-0 translate-y-6">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex flex-col sm:flex-row items-center gap-5 hover:bg-white/10 transition-all">
                <div class="w-12 h-12 shrink-0 rounded-xl bg-primary/20 text-primary flex items-center justify-center text-xl">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h4 class="font-bold text-white mb-1">Want more? Full playlist on YouTube</h4>
                    <p class="text-sm text-gray-400">
                        Demos, live sessions and updates — every OBSIDIAN Neural video in one place.
                    </p>
                </div>
                <a href="https://www.youtube.com/watch?v=L8GKCFTjOX4&list=PL9PCUNVx6wp8gMdbo59a1k3M7sdSPmo5A"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 border border-white/10 text-white text-sm font-semibold hover:bg-white/20 transition-all">
                    <i class="fab fa-youtube text-danger"></i>
                    Watch the playlist
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        document.querySelectorAll("[data-youtube-id]").forEach(function(el) {
            if (el.children.length > 0) return;
            var vid = el.getAttribute("data-youtube-id");
            if (!vid || vid === "YOUR_VIDEO_ID_HERE") return;

            var btn = document.createElement("button");
            btn.type = "button";
            btn.className = "yt-lazy";
            btn.setAttribute("aria-label", "Play: " + (el.getAttribute("data-title") || "video"));
            btn.style.backgroundImage =
                "url('https://i.ytimg.com/vi/" + vid + "/hqdefault.jpg')";

            var thumb = new Image();
            thumb.onload = function() {
                var url = thumb.naturalWidth > 120 ?
                    thumb.src :
                    "https://i.ytimg.com/vi/" + vid + "/hqdefault.jpg";
                btn.style.backgroundImage = "url('" + url + "')";
            };
            thumb.onerror = function() {
                btn.style.backgroundImage =
                    "url('https://i.ytimg.com/vi/" + vid + "/hqdefault.jpg')";
            };
            thumb.src = "https://i.ytimg.com/vi/" + vid + "/maxresdefault.jpg";

            btn.addEventListener("click", function() {
                var iframe = document.createElement("iframe");
                iframe.src = "https://www.youtube-nocookie.com/embed/" + vid +
                    "?autoplay=1&rel=0&enablejsapi=1";
                iframe.title = el.getAttribute("data-title") || "YouTube video";
                iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
                iframe.allowFullscreen = true;
                iframe.style.cssText = "position:absolute;inset:0;width:100%;height:100%;border:0;";
                el.replaceChildren(iframe);
            });

            el.appendChild(btn);
        });

        var root = document.getElementById("tuto-carousel");
        if (!root) return;

        var track = root.querySelector("[data-carousel-track]");
        var slides = root.querySelectorAll("[data-carousel-slide]");
        var prevBtn = root.querySelector("[data-carousel-prev]");
        var nextBtn = root.querySelector("[data-carousel-next]");
        var dots = root.querySelectorAll("[data-carousel-dot]");
        var caption = root.querySelector("[data-carousel-caption]");
        var counter = root.querySelector("[data-carousel-counter]");

        var captions = <?= json_encode(array_column($tutoVideos, 'caption')) ?>;

        var index = 0;
        var total = slides.length;

        if (total < 2) {
            prevBtn.style.display = "none";
            nextBtn.style.display = "none";
            if (counter) counter.style.display = "none";
            return;
        }

        dots.forEach(function(dot) {
            dot.addEventListener("click", function() {
                goTo(parseInt(dot.getAttribute("data-carousel-dot"), 10));
            });
        });

        function pauseSlide(i) {
            var iframe = slides[i].querySelector("iframe");
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage(
                    '{"event":"command","func":"pauseVideo","args":""}',
                    "*"
                );
            }
        }

        function render() {
            track.style.transform = "translateX(-" + index * 100 + "%)";
            dots.forEach(function(dot, i) {
                dot.classList.toggle("is-active", i === index);
            });
            if (caption && captions[index] !== undefined) {
                caption.textContent = captions[index];
            }
            if (counter) {
                counter.textContent = (index + 1) + " / " + total;
            }
            prevBtn.disabled = index === 0;
            nextBtn.disabled = index === total - 1;
        }

        function goTo(i) {
            if (i === index || i < 0 || i >= total) return;
            pauseSlide(index);
            index = i;
            render();
        }

        prevBtn.addEventListener("click", function() {
            goTo(index - 1);
        });
        nextBtn.addEventListener("click", function() {
            goTo(index + 1);
        });

        root.setAttribute("tabindex", "0");
        root.addEventListener("keydown", function(e) {
            if (e.key === "ArrowLeft") goTo(index - 1);
            if (e.key === "ArrowRight") goTo(index + 1);
        });

        var startX = null;
        track.addEventListener("touchstart", function(e) {
            startX = e.touches[0].clientX;
        }, {
            passive: true
        });
        track.addEventListener("touchend", function(e) {
            if (startX === null) return;
            var delta = e.changedTouches[0].clientX - startX;
            if (Math.abs(delta) > 50) goTo(delta < 0 ? index + 1 : index - 1);
            startX = null;
        }, {
            passive: true
        });

        render();
    })();
</script>