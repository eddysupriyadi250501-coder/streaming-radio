<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Radio Kota Mataram 105.9 FM - Suara Kota, Suara Kita.">
    
    <title>Radio Kota Mataram 105.9 FM</title>

    <script src="https://cdn.tailwindcss.com" data-navigate-once></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @livewireStyles

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background-color: #0b0e14;
        }

        [wire-loading] { opacity: 0.5; transition: opacity 0.3s; }
        .fade-in { animation: fadeIn 1.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes float { 0%, 100% { transform: translate(0, 0); } 50% { transform: translate(20px, -20px); } }
        .animate-float { animation: float 10s ease-in-out infinite; }
        .text-shadow-glow { text-shadow: 0 0 30px rgba(220, 38, 38, 0.8); }
        .text-shadow-red-glow { text-shadow: 0 0 15px rgba(220, 38, 38, 0.7), 0 0 30px rgba(220, 38, 38, 0.5); }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0b0e14; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #dc2626; }
        
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="text-white antialiased selection:bg-red-500 selection:text-white relative">

    {{-- TEMPAT KONTEN HALAMAN UTAMA --}}
    @yield('content')

    {{-- ======================================================= --}}
    {{-- KUBAH RADIO (PERSIST)                                    --}}
    {{-- ======================================================= --}}
    @persist('radio-suara-kota')
    @php
        $radio = \Illuminate\Support\Facades\DB::table('streaming')
                    ->where('kategori', 'live_radio')
                    ->first();
    @endphp

    <div id="wadah-mini-player" class="fixed bottom-0 right-0 z-[9999] p-4 bg-black/80 rounded-tl-xl border-t border-l border-red-600/30 transform translate-y-full opacity-0 transition-all duration-500 ease-in-out pointer-events-none">
        <audio id="main-audio" preload="none" controls class="h-8 w-64">
            @if($radio && !empty($radio->link_eksternal))
                <source src="{{ $radio->link_eksternal }}" type="audio/mpeg">
            @endif
            Browser Anda tidak mendukung elemen audio.
        </audio>
    </div>
    @endpersist

    {{-- ========================================================================= --}}
    {{-- GLOBAL PERSISTENT YOUTUBE / STREAMING VIDEO PLAYER                         --}}
    {{-- ========================================================================= --}}
    @persist('youtube-persistent-player')
    @php
        $globalStreaming = \Illuminate\Support\Facades\DB::table('streaming')
                            ->where('kategori', 'live_youtube')
                            ->first();
        
        $globalLiveId = '';
        $hasGlobalLink = false;

        if ($globalStreaming && !empty($globalStreaming->link_eksternal)) {
            $hasGlobalLink = true;
            $rawLink = $globalStreaming->link_eksternal;
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $rawLink, $matches)) {
                $globalLiveId = $matches[1];
            } else {
                $globalLiveId = basename($rawLink);
            }
        }
        
        $globalIsAutoLive = ($globalStreaming && property_exists($globalStreaming, 'is_auto_live')) ? (bool)$globalStreaming->is_auto_live : false;
    @endphp

    @if($hasGlobalLink && $globalLiveId)
    <div id="video-container" class="fixed z-[2147483647] bg-black overflow-hidden pointer-events-auto shadow-2xl hidden">
        <button id="close-floating" onclick="forceStopFloating()" class="hidden absolute top-2 right-2 bg-black/85 hover:bg-red-600 text-white rounded-full w-7 h-7 items-center justify-center text-xs z-[2147483648] shadow cursor-pointer transition-all border border-white/20">✕</button>
        
        @php
            $globalEmbedUrl = $globalIsAutoLive 
                ? "https://www.youtube.com/embed/live_stream?channel={$globalLiveId}&autoplay=1" 
                : "https://www.youtube.com/embed/{$globalLiveId}?autoplay=1";
        @endphp
        
        <iframe class="w-full h-full pointer-events-auto border-0"
            src="{{ $globalEmbedUrl }}&rel=0&modestbranding=1&enablejsapi=1&origin={{ urlencode(request()->getSchemeAndHttpHost()) }}"
            title="Radio Suara Kota Streaming"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
    @endif
    @endpersist

    <!-- SCRIPT AUDIO RADIO -->
    <script data-navigate-once>
        document.addEventListener('DOMContentLoaded', () => {
            const playerWrapper = document.getElementById('wadah-mini-player');
            const audio = document.getElementById('main-audio');

            if (!playerWrapper || !audio) return;

            function showPlayer() {
                playerWrapper.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');
                playerWrapper.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            }

            function hidePlayer() {
                playerWrapper.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                playerWrapper.classList.add('translate-y-full', 'opacity-0', 'pointer-events-none');
            }

            function syncHeroButton() {
                const playIcon = document.getElementById('hero-play-icon');
                const pauseIcon = document.getElementById('hero-pause-icon');
                
                if (playIcon && pauseIcon) {
                    if (audio.paused) {
                        playIcon.classList.remove('hidden');
                        pauseIcon.classList.add('hidden');
                    } else {
                        playIcon.classList.add('hidden');
                        pauseIcon.classList.remove('hidden');
                    }
                }
            }

            function checkPlayerVisibility() {
                const isHomePage = document.getElementById('hero-play-icon') !== null;
                const isScrolled = window.scrollY > 400;
                const isPlaying = !audio.paused;

                if (isHomePage) {
                    if (!isScrolled) {
                        hidePlayer();
                    } else {
                        if (isPlaying) showPlayer(); else hidePlayer();
                    }
                } else {
                    showPlayer();
                }
            }

            window.addEventListener('scroll', checkPlayerVisibility);
            document.addEventListener('livewire:navigated', () => { checkPlayerVisibility(); syncHeroButton(); });
            audio.addEventListener('play', () => { checkPlayerVisibility(); syncHeroButton(); });
            audio.addEventListener('pause', () => { checkPlayerVisibility(); syncHeroButton(); });

            checkPlayerVisibility();
            syncHeroButton();
        });

        window.toggleRadioStream = function () {
            const audio = document.getElementById('main-audio');
            if (!audio) return;
            const sourceElement = audio.querySelector('source');
            const currentSrc = audio.getAttribute('src') || (sourceElement ? sourceElement.getAttribute('src') : null);
            
            if (!currentSrc || currentSrc.trim() === '' || currentSrc === window.location.href) {
                alert("Link streaming belum diisi di Admin Panel!");
                return;
            }

            if (audio.paused) {
                audio.play().catch(error => console.error("Audio Play Error:", error));
            } else {
                audio.pause();
            }
        };
    </script>

   {{-- SCRIPT TRACKING PRESISI VIDEO PLAYER --}}
<script data-navigate-once>
    let isFloatingDismissed = false;

    function forceStopFloating() {
        isFloatingDismissed = true;
        const container = document.getElementById('video-container');
        if (container) container.style.display = 'none';
    }

    function updatePlayerPosition() {
        const container = document.getElementById('video-container');
        const anchor = document.getElementById('video-anchor');
        const closeBtn = document.getElementById('close-floating');

        if (!container) return;

        if (anchor) {
            const rect = anchor.getBoundingClientRect();
            // Cek apakah posisi anchor sedang terlihat di dalam layar
            const isInPlace = rect.bottom > 0 && rect.top < window.innerHeight;

            if (isInPlace) {
                // PENTING: Jika discroll kembali ke atas (masuk area anchor), 
                // reset status dismiss agar video otomatis muncul kembali dengan normal.
                isFloatingDismissed = false; 

                container.style.display = 'block';
                container.style.transition = 'none';
                container.style.top = rect.top + 'px';
                container.style.left = rect.left + 'px';
                container.style.width = rect.width + 'px';
                container.style.height = rect.height + 'px';
                container.style.bottom = 'auto';
                container.style.right = 'auto';
                container.style.borderRadius = '20px';
                container.style.border = '1px solid rgba(255, 255, 255, 0.05)';
                if (closeBtn) closeBtn.classList.add('hidden');
            } else {
                // Jika posisi di luar layar, ikuti status apakah sudah ditutup (dismiss) atau belum
                if (isFloatingDismissed) {
                    container.style.display = 'none';
                    return;
                }

                container.style.display = 'block';
                container.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                container.style.top = 'auto';
                container.style.bottom = '24px';
                container.style.left = '24px';
                container.style.right = 'auto';
                container.style.width = '360px';
                container.style.height = '202.5px';
                container.style.borderRadius = '16px';
                container.style.border = '1px solid rgba(255, 255, 255, 0.2)';
                if (closeBtn) closeBtn.classList.remove('hidden');
            }
        } else {
            if (isFloatingDismissed) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            container.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            container.style.top = 'auto';
            container.style.bottom = '24px';
            container.style.left = '24px';
            container.style.right = 'auto';
            container.style.width = '360px';
            container.style.height = '202.5px';
            container.style.borderRadius = '16px';
            container.style.border = '1px solid rgba(255, 255, 255, 0.2)';
            if (closeBtn) closeBtn.classList.remove('hidden');
        }
    }

    window.addEventListener('scroll', () => requestAnimationFrame(updatePlayerPosition), { passive: true });
    window.addEventListener('resize', () => requestAnimationFrame(updatePlayerPosition));
    document.addEventListener('DOMContentLoaded', updatePlayerPosition);
    document.addEventListener('livewire:navigated', () => {
        isFloatingDismissed = false;
        updatePlayerPosition();
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @livewireScripts
</body>
</html>