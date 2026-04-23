<!doctype html>
<html lang="en" class="bg-black text-white overflow-x-hidden scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <title><?php echo $page_title ?? 'OBSIDIAN Neural - AI Music Plugin'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
        name="description"
        content="<?php echo $page_desc; ?>" />
    <meta
        name="keywords"
        content="AI VST plugin, AI music generation VST3, live performance AI audio, Stable Audio VST, LLM music generation, AI DAW plugin, OBSIDIAN Neural, InnerMost47, sketch to audio, draw to audio VST, DePIN, GPU provider network, passive income GPU, distributed AI audio, proof of work music" />
    <meta name="author" content="InnerMost47 - Anthony Charretier" />
    <meta name="robots" content="index, follow" />
    <link
        rel="canonical"
        href="https://ai-harmony.duckdns.org/obsidian/api/v1/" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="OBSIDIAN Neural" />
    <meta property="og:locale" content="en_US" />
    <meta
        property="og:url"
        content="https://ai-harmony.duckdns.org/obsidian/api/v1/" />
    <meta
        property="og:title"
        content="OBSIDIAN Neural — AI Music Generation VST for Live Performance" />
    <meta
        property="og:description"
        content="First VST for AI music generation designed for live performance. 8-track sampler, LLM brain, draw-to-audio, 8 AI models. Presented at AES AIMLA 2025" />
    <meta
        property="og:image"
        content="https://ai-harmony.duckdns.org/obsidian/api/v1/assets/images/screenshot.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta
        property="og:image:alt"
        content="OBSIDIAN Neural VST3 plugin interface — 8-track AI sampler" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@innermost47" />
    <meta
        name="twitter:url"
        content="https://ai-harmony.duckdns.org/obsidian/api/v1/" />
    <meta
        name="twitter:title"
        content="OBSIDIAN Neural — AI Music VST for Live Performance" />
    <meta
        name="twitter:description"
        content="First VST for AI music generation designed for live performance. 8 AI models, open source." />
    <meta
        name="twitter:image"
        content="https://ai-harmony.duckdns.org/obsidian/api/v1/assets/images/screenshot.png" />
    <meta
        name="twitter:image:alt"
        content="OBSIDIAN Neural VST plugin interface" />

    <link rel="icon" type="image/x-icon" href="assets/images/logo.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />



    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#d96850",
                        danger: "#e07060",
                        dangerLight: "#eb8777",
                        success: "#6bb38a",
                        warning: "#e8a860",
                        bgDeep: "#0a0a0c",
                        bgMid: "#111115",
                        track1: "#d96850",
                        track2: "#4da3b3",
                        track3: "#8b6ab5",
                        track4: "#d9a54e",
                        track5: "#6bb38a",
                        track6: "#5568a0",
                        track7: "#cb7aa8",
                        track8: "#6b8299",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"]
                    },
                },
            },
        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <link href="/css/new.css" rel="stylesheet" />
</head>

<body
    class="bg-black text-white overflow-x-hidden antialiased selection:bg-primary selection:text-black">
    <canvas
        id="latent-space"
        class="fixed inset-0 w-full h-full z-0 pointer-events-none opacity-50 mix-blend-screen"></canvas>
    <script>
        const canvas = document.getElementById("latent-space");
        if (canvas) {
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(
                75,
                window.innerWidth / window.innerHeight,
                0.1,
                1000,
            );
            camera.position.z = 120;
            const renderer = new THREE.WebGLRenderer({
                canvas,
                alpha: true,
                antialias: true,
            });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

            const geo = new THREE.BufferGeometry();
            const count = 1800;
            const pos = new Float32Array(count * 3);
            const col = new Float32Array(count * 3);
            const palette = [
                new THREE.Color("#d96850"),
                new THREE.Color("#4da3b3"),
                new THREE.Color("#8b6ab5"),
            ];

            for (let i = 0; i < count * 3; i += 3) {
                const r = 250,
                    theta = Math.random() * 2 * Math.PI,
                    phi = Math.acos(Math.random() * 2 - 1);
                pos[i] = r * Math.sin(phi) * Math.cos(theta);
                pos[i + 1] = r * Math.sin(phi) * Math.sin(theta);
                pos[i + 2] = r * Math.cos(phi);
                const c = palette[Math.floor(Math.random() * palette.length)];
                col[i] = c.r;
                col[i + 1] = c.g;
                col[i + 2] = c.b;
            }
            geo.setAttribute("position", new THREE.BufferAttribute(pos, 3));
            geo.setAttribute("color", new THREE.BufferAttribute(col, 3));
            const mat = new THREE.PointsMaterial({
                size: 0.8,
                vertexColors: true,
                transparent: true,
                opacity: 0.6,
                blending: THREE.AdditiveBlending,
            });
            const mesh = new THREE.Points(geo, mat);
            scene.add(mesh);

            let mx = 0,
                my = 0;
            document.addEventListener("mousemove", (e) => {
                mx = e.clientX / window.innerWidth - 0.5;
                my = e.clientY / window.innerHeight - 0.5;
            });

            const clock = new THREE.Clock();

            function animate() {
                requestAnimationFrame(animate);
                const t = clock.getElapsedTime();
                mesh.rotation.y = t * 0.05;
                mesh.rotation.x = t * 0.02;
                mesh.position.x += (mx * 30 - mesh.position.x) * 0.05;
                mesh.position.y += (-my * 30 - mesh.position.y) * 0.05;
                renderer.render(scene, camera);
            }
            animate();

            window.addEventListener("resize", () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
        }
    </script>