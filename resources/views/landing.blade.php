@extends('layouts.app')

@section('content')

    {{-- Latar Belakang Animasi --}}
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000"
            style="background-image: url('https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=1600&auto=format&fit=crop');">
        </div>
        <div class="absolute inset-0 bg-[#0b0e14]/75 backdrop-blur-[1px]"></div>

        <div
            class="absolute top-[-15%] right-[-10%] w-[60%] h-[60%] bg-red-600/10 blur-[120px] rounded-full animate-float">
        </div>

        <div class="absolute bottom-[-15%] left-[-10%] w-[60%] h-[60%] bg-red-900/10 blur-[120px] rounded-full animate-float"
            style="animation-delay: 2s;"></div>

        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>

    <!-- ================= NAVBAR START ================= -->
    <nav x-data="{ mobileMenuOpen: false }"
        class="sticky top-0 z-50 bg-[#0b0e14]/90 lg:bg-white/5 backdrop-blur-2xl px-5 lg:px-10 py-4 lg:py-5 border-b border-white/10 flex items-center justify-between transition-all duration-300">

        <div class="flex items-center space-x-2">
            <div class="text-xl lg:text-2xl font-black tracking-tighter uppercase text-white lg:text-current">
                SUARA<span class="text-red-600">KOTA</span>
            </div>
        </div>

        <!-- Tombol Hamburger Mobile -->
        <button @click="mobileMenuOpen = !mobileMenuOpen"
            class="lg:hidden text-gray-300 hover:text-white outline-none z-50 relative p-1">
            <svg class="w-7 h-7 transition-transform duration-300"
                :class="mobileMenuOpen ? 'rotate-90 text-red-500' : ''" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
                <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <ul :class="mobileMenuOpen ? 'flex translate-y-0 opacity-100' : 'hidden lg:flex'"
            class="absolute lg:static top-full left-0 w-full lg:w-auto bg-[#0b0e14]/95 lg:bg-transparent backdrop-blur-2xl lg:backdrop-blur-none flex-col lg:flex-row items-start lg:items-center space-y-0 lg:space-y-0 space-x-0 lg:space-x-6 p-5 lg:p-0 text-[11px] lg:text-[9px] font-bold uppercase tracking-widest text-gray-300 border-b border-white/10 lg:border-none shadow-2xl lg:shadow-none transition-all duration-300 z-50 max-h-[85vh] lg:max-h-none overflow-y-auto lg:overflow-visible">

            <li class="w-full lg:w-auto border-b border-white/10 lg:border-none">
    <a href="/" wire:navigate
       class="block w-full py-3.5 lg:py-2 hover:text-red-500 transition-colors duration-300">Home</a>
</li>
<li class="w-full lg:w-auto border-b border-white/10 lg:border-none">
    <a href="/tentang-kami" wire:navigate
       class="block w-full py-3.5 lg:py-2 hover:text-red-500 transition-colors duration-300">Tentang Kami</a>
</li>
            <li class="w-full lg:w-auto border-b border-white/10 lg:border-none"><a href="#penyiar"
                    class="block w-full py-3.5 lg:py-2 hover:text-red-500 transition-colors duration-300">Penyiar</a>
            </li>

            <!-- Dropdown: Berita -->
            <li class="relative group w-full lg:w-auto border-b border-white/10 lg:border-none" x-data="{ open: false }"
                @mouseenter="if(window.innerWidth >= 1024) open = true"
                @mouseleave="if(window.innerWidth >= 1024) open = false">

                <div class="inline-block relative py-1 lg:py-2 w-full lg:w-auto">
                    <button @click.prevent="open = !open"
                        class="flex items-center justify-between lg:justify-start w-full lg:w-auto py-2.5 lg:py-0 group-hover:text-red-500 transition-colors duration-300 outline-none uppercase"
                        :class="open ? 'text-red-500 lg:text-current' : ''">
                        Berita
                        <svg class="w-3.5 h-3.5 ml-1 transition-transform duration-300"
                            :class="open ? 'rotate-180 text-red-500 lg:text-current' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        class="hidden lg:block absolute bottom-0 left-0 w-full h-[3px] bg-red-600 shadow-[0_0_10px_#dc2626] z-[60]">
                    </div>
                </div>

                <div x-show="open" x-transition:enter="transition ease-out duration-300 transform origin-top"
                    x-transition:enter-start="opacity-0 -translate-y-4 lg:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform origin-top"
                    x-transition:leave-start="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-4 lg:scale-95" x-cloak
                    class="lg:absolute relative left-0 mt-1 mb-2 lg:mb-0 lg:mt-0 w-full lg:w-52 bg-white/5 lg:bg-[#1a1d24] backdrop-blur-3xl lg:backdrop-blur-none text-white rounded-lg lg:rounded-b-lg shadow-none lg:shadow-2xl border border-white/10 lg:border-white/10 overflow-hidden z-50">

                    <a href="{{ route('berita.index') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold text-red-600 hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase tracking-wider">
                        Semua Berita
                    </a>
                    <a href="{{ route('berita.index', ['category' => 'MATARAM DALAM BERITA']) }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 font-bold uppercase tracking-widest">
                        Mataram Dalam Berita
                    </a>
                    <a href="{{ route('berita.index', ['category' => 'BERITA NTB']) }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 font-bold uppercase tracking-widest">
                        Berita NTB
                    </a>
                    <a href="{{ route('berita.index', ['category' => 'BERITA INTERNASIONAL']) }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 font-bold uppercase tracking-widest">
                        Berita Internasional
                    </a>
                </div>
            </li>

            <!-- Dropdown: Creative District -->
            <li class="relative group w-full lg:w-auto border-b border-white/10 lg:border-none" x-data="{ open: false }"
                @mouseenter="if(window.innerWidth >= 1024) open = true"
                @mouseleave="if(window.innerWidth >= 1024) open = false">

                <div class="inline-block relative py-1 lg:py-2 w-full lg:w-auto">
                    <button @click.prevent="open = !open"
                        class="flex items-center justify-between lg:justify-start w-full lg:w-auto py-2.5 lg:py-0 group-hover:text-red-500 transition-colors duration-300 outline-none uppercase font-bold text-[11px] lg:text-[9px] tracking-wider"
                        :class="open ? 'text-red-500 lg:text-current' : ''">
                        Creative District
                        <svg class="w-3.5 h-3.5 ml-1 transition-transform duration-300"
                            :class="open ? 'rotate-180 text-red-500 lg:text-current' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        class="hidden lg:block absolute bottom-0 left-0 w-full h-[3px] bg-red-600 shadow-[0_0_10px_#dc2626] z-[60]">
                    </div>
                </div>

                <div x-show="open" x-transition:enter="transition ease-out duration-300 transform origin-top"
                    x-transition:enter-start="opacity-0 -translate-y-4 lg:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform origin-top"
                    x-transition:leave-start="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-4 lg:scale-95" x-cloak
                    class="lg:absolute relative left-0 mt-1 mb-2 lg:mb-0 lg:mt-0 w-full lg:w-52 bg-white/5 lg:bg-[#1a1d24] lg:backdrop-blur-3xl text-white rounded-lg lg:rounded-b-lg shadow-none lg:shadow-2xl border border-white/10 z-50 overflow-hidden">

                    <a href="{{ url('/creative-district?category=komunitas') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5">
                        Komunitas
                    </a>
                    <a href="{{ url('/creative-district?category=musisi') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5">
                        Musisi/Band
                    </a>
                    <a href="{{ url('/creative-district?category=seniman') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5">
                        Seniman
                    </a>
                    <a href="{{ url('/creative-district?category=event') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5">
                        Event
                    </a>
                    <a href="{{ url('/creative-district?category=film') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300">
                        Resensi Film Indie
                    </a>
                </div>
            </li>

            <!-- Dropdown: Hidden GEM -->
            <li class="relative group w-full lg:w-auto border-b border-white/10 lg:border-none" x-data="{ open: false }"
                @mouseenter="if(window.innerWidth >= 1024) open = true"
                @mouseleave="if(window.innerWidth >= 1024) open = false">

                <div class="inline-block relative py-1 lg:py-2 w-full lg:w-auto">
                    <button @click.prevent="open = !open"
                        class="flex items-center justify-between lg:justify-start w-full lg:w-auto py-2.5 lg:py-0 group-hover:text-red-500 transition-colors duration-300 outline-none uppercase font-bold text-[11px] lg:text-[9px] tracking-wider"
                        :class="open ? 'text-red-500 lg:text-current' : ''">
                        Hidden GEM & UMKM
                        <svg class="w-3.5 h-3.5 ml-1 transition-transform duration-300"
                            :class="open ? 'rotate-180 text-red-500 lg:text-current' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        class="hidden lg:block absolute bottom-0 left-0 w-full h-[3px] bg-red-600 shadow-[0_0_10px_#dc2626] z-[60]">
                    </div>
                </div>

                <div x-show="open" x-transition:enter="transition ease-out duration-300 transform origin-top"
                    x-transition:enter-start="opacity-0 -translate-y-4 lg:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform origin-top"
                    x-transition:leave-start="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-4 lg:scale-95" x-cloak
                    class="lg:absolute relative left-0 mt-1 mb-2 lg:mb-0 lg:mt-0 w-full lg:w-52 bg-white/5 lg:bg-[#1a1d24] lg:backdrop-blur-3xl text-white rounded-lg lg:rounded-b-lg shadow-none lg:shadow-2xl border border-white/10 z-50 overflow-hidden">

                    <a href="{{ route('wisata.show', \App\Models\Wisata::where('kategori', 'wisata')->first()->id ?? '#') }}"
                        wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase font-bold tracking-widest">
                        Destinasi Wisata
                    </a>
                    <a href="{{ route('wisata.show', \App\Models\Wisata::where('kategori', 'tongkrongan')->first()->id ?? '#') }}"
                        wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase font-bold tracking-widest">
                        Tongkrongan Asyik
                    </a>
                    <a href="{{ route('umkm.show', \App\Models\Umkm::where('kategori', 'kriya')->first()->id ?? '#') }}"
                        wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase font-bold tracking-widest">
                        Kriya
                    </a>
                    <a href="{{ route('umkm.show', \App\Models\Umkm::where('kategori', 'kuliner')->first()->id ?? '#') }}"
                        wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase font-bold tracking-widest">
                        Kuliner
                    </a>
                    <a href="{{ route('umkm.show', \App\Models\Umkm::where('kategori', 'fashion')->first()->id ?? '#') }}"
                        wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 uppercase font-bold tracking-widest">
                        Fashion
                    </a>
                </div>
            </li>

            <!-- Dropdown: Sekolah Kita -->
            <li class="relative group w-full lg:w-auto border-b border-white/10 lg:border-none" x-data="{ open: false }"
                @mouseenter="if(window.innerWidth >= 1024) open = true"
                @mouseleave="if(window.innerWidth >= 1024) open = false">

                <div class="inline-block relative py-1 lg:py-2 w-full lg:w-auto">
                    <button @click.prevent="open = !open"
                        class="flex items-center justify-between lg:justify-start w-full lg:w-auto py-2.5 lg:py-0 group-hover:text-red-500 transition-colors duration-300 outline-none uppercase font-bold text-[11px] lg:text-[9px] tracking-wider"
                        :class="open ? 'text-red-500 lg:text-current' : ''">
                        Sekolah Kita
                        <svg class="w-3.5 h-3.5 ml-1 transition-transform duration-300"
                            :class="open ? 'rotate-180 text-red-500 lg:text-current' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        class="hidden lg:block absolute bottom-0 left-0 w-full h-[3px] bg-red-600 shadow-[0_0_10px_#dc2626] z-[60]">
                    </div>
                </div>

                <div x-show="open" x-transition:enter="transition ease-out duration-300 transform origin-top"
                    x-transition:enter-start="opacity-0 -translate-y-4 lg:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform origin-top"
                    x-transition:leave-start="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-4 lg:scale-95" x-cloak
                    class="lg:absolute relative left-0 mt-1 mb-2 lg:mb-0 lg:mt-0 w-full lg:w-52 bg-white/5 lg:bg-[#1a1d24] lg:backdrop-blur-3xl text-white rounded-lg lg:rounded-b-lg shadow-none lg:shadow-2xl border border-white/10 z-50 overflow-hidden">

                    <a href="{{ route('sekolah.index') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase font-bold tracking-widest">
                        Semua Kegiatan
                    </a>
                    <a href="{{ route('sekolah.index', ['kategori' => 'ekstrakurikuler']) }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase font-bold tracking-widest">
                        Ekstrakurikuler
                    </a>
                    <a href="{{ route('sekolah.index', ['kategori' => 'siswa']) }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5 uppercase font-bold tracking-widest">
                        Profil Siswa
                    </a>
                    <a href="{{ route('sekolah.index', ['kategori' => 'ukm']) }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 uppercase font-bold tracking-widest">
                        Unit Kegiatan (UKM)
                    </a>
                </div>
            </li>

            <!-- Dropdown: Layanan -->
            <li class="relative group w-full lg:w-auto border-b border-white/10 lg:border-none" x-data="{ open: false }"
                @mouseenter="if(window.innerWidth >= 1024) open = true"
                @mouseleave="if(window.innerWidth >= 1024) open = false">

                <div class="inline-block relative py-1 lg:py-2 w-full lg:w-auto">
                    <button @click.prevent="open = !open"
                        class="flex items-center justify-between lg:justify-start w-full lg:w-auto py-2.5 lg:py-0 group-hover:text-red-500 transition-colors duration-300 outline-none uppercase font-bold text-[11px] lg:text-[9px] tracking-widest"
                        :class="open ? 'text-red-500 lg:text-current' : ''">
                        Layanan
                        <svg class="w-3.5 h-3.5 ml-1 transition-transform duration-300"
                            :class="open ? 'rotate-180 text-red-500 lg:text-current' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        class="hidden lg:block absolute bottom-0 left-0 w-full h-[3px] bg-red-600 shadow-[0_0_10px_#dc2626] z-[60]">
                    </div>
                </div>

                <div x-show="open" x-transition:enter="transition ease-out duration-300 transform origin-top"
                    x-transition:enter-start="opacity-0 -translate-y-4 lg:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform origin-top"
                    x-transition:leave-start="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-4 lg:scale-95" x-cloak
                    class="lg:absolute relative left-0 mt-1 mb-2 lg:mb-0 lg:mt-0 w-full lg:w-52 bg-white/5 lg:bg-[#1a1d24] lg:backdrop-blur-3xl text-white rounded-lg lg:rounded-b-lg shadow-none lg:shadow-2xl border border-white/10 z-50 overflow-hidden">

                    <a href="{{ route('layanan.index') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5">
                        Call Center
                    </a>
                    <a href="{{ route('layanan.index') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5">
                        Lapor Mataram
                    </a>
                    <a href="{{ route('layanan.index') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] font-bold uppercase tracking-widest hover:text-red-500 hover:bg-red-600/20 transition-all duration-300 border-b border-white/5">
                        PPID
                    </a>

                    <a href="#" @click.prevent="$dispatch('buka-form-darah')"
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] text-red-500 font-black uppercase tracking-widest hover:bg-red-600/20 transition-all duration-300">
                        Permintaan Darah
                    </a>
                </div>
            </li>

            <!-- Dropdown: Streaming -->
            <li class="relative group w-full lg:w-auto" x-data="{ open: false }"
                @mouseenter="if(window.innerWidth >= 1024) open = true"
                @mouseleave="if(window.innerWidth >= 1024) open = false">
                <div class="inline-block relative py-1 lg:py-2 w-full lg:w-auto">
                    <button @click.prevent="open = !open"
                        class="flex items-center justify-between lg:justify-start w-full lg:w-auto py-2.5 lg:py-0 group-hover:text-red-500 transition-colors duration-300 outline-none uppercase"
                        :class="open ? 'text-red-500 lg:text-current' : ''">
                        Streaming
                        <svg class="w-3.5 h-3.5 ml-1 transition-transform duration-300"
                            :class="open ? 'rotate-180 text-red-500 lg:text-current' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open"
                        class="hidden lg:block absolute bottom-0 left-0 w-full h-[3px] bg-red-600 shadow-[0_0_10px_#dc2626] z-[60]">
                    </div>
                </div>

                <div x-show="open" x-transition:enter="transition ease-out duration-300 transform origin-top"
                    x-transition:enter-start="opacity-0 -translate-y-4 lg:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform origin-top"
                    x-transition:leave-start="opacity-100 translate-y-0 lg:scale-100"
                    x-transition:leave-end="opacity-0 -translate-y-4 lg:scale-95" x-cloak
                    class="lg:absolute relative right-0 lg:right-0 left-0 lg:left-auto mt-1 lg:mt-0 w-full lg:w-44 bg-white/5 lg:bg-[#1a1d24] lg:backdrop-blur-3xl text-white rounded-lg lg:rounded-b-lg shadow-none lg:shadow-2xl border border-white/10 z-50 overflow-hidden">

                    <a href="{{ url('/') }}" wire:navigate
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:bg-red-600/20 hover:text-red-500 transition-all duration-300 border-b border-white/5 font-bold uppercase tracking-widest">
                        Live Radio
                    </a>

                    <a href="{{ url('/#streaming-section') }}"
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:bg-red-600/20 hover:text-red-500 transition-all duration-300 border-b border-white/5 font-bold uppercase tracking-widest">
                        Live Youtube
                    </a>

                    <a href="{{ url('/#streaming-section') }}"
                        class="block px-5 pl-8 lg:pl-5 py-3 text-[10px] lg:text-[9px] hover:bg-red-600/20 hover:text-red-500 transition-all duration-300 font-bold uppercase tracking-widest">
                        Podcast
                    </a>

                </div>
            </li>
        </ul>
    </nav>
    <!-- ================= NAVBAR END ================= -->

    <section
        class="w-full min-h-screen lg:min-h-[90vh] flex flex-col lg:flex-row items-center px-5 sm:px-8 lg:px-24 relative z-10 pt-28 md:pt-32 pb-16 lg:pb-0 gap-8 lg:gap-12">
        <div
            class="w-full lg:w-1/2 p-6 sm:p-10 rounded-[30px] lg:rounded-[50px] bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl">
            <div
                class="inline-flex items-center px-4 py-2 border border-red-500/20 rounded-full bg-red-500/10 mb-6 lg:mb-8 backdrop-blur-md">
                <span class="w-2 h-2 bg-red-600 rounded-full mr-2.5 animate-pulse shadow-[0_0_10px_#dc2626]"></span>
                <span class="text-red-500 text-[9px] lg:text-[10px] font-bold uppercase tracking-[0.3em]">Live on Air
                    105.9 FM</span>
            </div>

            <h1
                class="text-5xl sm:text-6xl lg:text-[70px] font-black leading-[0.9] tracking-tighter uppercase mb-6 lg:mb-10">
                SUARA <br>
                <span class="text-red-600 text-shadow-glow text-4xl sm:text-5xl lg:text-[62px] block mt-2">KOTA 105
                    FM</span>
            </h1>

            <p
                class="text-gray-300 max-w-md text-[9px] lg:text-[11px] uppercase font-bold tracking-[0.25em] leading-relaxed opacity-90 not-italic border-l-4 border-red-600 pl-4">
                Informasi terupdate, musik terbaik dan inspirasi harian masyarakat Kota Mataram.
            </p>
        </div>

        <div class="w-full lg:w-1/2 flex justify-center lg:justify-end mt-2 lg:mt-0">
            <div class="relative group w-full max-w-[320px] sm:max-w-[360px] lg:max-w-[400px]">
                <div
                    class="absolute inset-0 bg-red-600/10 rounded-[30px] lg:rounded-[50px] blur-[80px] group-hover:bg-red-500/20 transition-all duration-700">
                </div>
                <div
                    class="relative h-[400px] lg:h-[550px] bg-white/5 backdrop-blur-2xl rounded-[30px] lg:rounded-[50px] overflow-hidden border border-white/10 shadow-2xl flex flex-col items-center justify-between p-8 lg:p-12 transition-transform duration-500 group-hover:scale-[1.02]">
                    <div class="absolute inset-0 z-0">
                        <video autoplay muted loop playsinline
                            class="w-full h-full object-cover opacity-20 brightness-50">
                            <source
                                src="https://assets.mixkit.co/videos/preview/mixkit-Abstract-neon-lights-in-motion-background-23471-large.mp4"
                                type="video/mp4">
                        </video>
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-transparent via-[#0b0e14]/40 to-[#0b0e14]/80">
                        </div>
                    </div>

                    <div class="relative z-10 text-center mt-2 lg:mt-0">
                        <h2
                            class="text-xl lg:text-2xl font-black uppercase tracking-[0.3em] text-white/90 text-shadow-red-glow">
                            STREAMING <span class="text-red-600">NOW</span>
                        </h2>
                        <p class="text-[8px] lg:text-[9px] font-bold tracking-[0.2em] text-gray-400 mt-2 uppercase">
                            Radio Kota Mataram 105.9 FM</p>
                    </div>

                    <div class="relative z-10">
                        <!-- TOMBOL YANG SUDAH DIPERBAIKI DAN DIBERSIHKAN -->
                        <button type="button" id="btn-streaming" onclick="window.toggleRadioStream()"
                            class="relative z-50 group/btn active:scale-95 transition-all outline-none cursor-pointer">

                            <div
                                class="relative w-20 h-20 lg:w-24 lg:h-24 bg-red-600 rounded-full flex items-center justify-center shadow-[0_0_40px_rgba(220,38,38,0.4)]">
                                <!-- Ikon Play -->
                                <svg id="hero-play-icon" class="w-8 h-8 lg:w-10 lg:h-10 text-white fill-current ml-1"
                                    viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                <!-- Ikon Pause (Disembunyikan secara default) -->
                                <svg id="hero-pause-icon" class="w-8 h-8 lg:w-10 lg:h-10 text-white fill-current hidden"
                                    viewBox="0 0 24 24">
                                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div class="relative z-10 mb-2 lg:mb-0">
                        <div
                            class="flex items-center gap-2.5 px-5 lg:px-6 py-2 lg:py-2.5 bg-white/5 backdrop-blur-md border border-white/10 rounded-full shadow-lg">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            </span>
                            <span
                                class="text-[8px] lg:text-[9px] font-black uppercase tracking-widest text-white/70">Live
                                Studio Mataram</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main wire:loading.class="opacity-50 transition-opacity duration-300">

        <!-- SECTION PENYIAR (BROADCASTER) -->
        <section id="penyiar" class="py-16 md:py-24 px-5 md:px-6 lg:px-24 relative z-10 bg-transparent"
            x-data="{ openModal: false, selectedPenyiar: {} }">

            <h2
                class="text-3xl md:text-4xl font-black uppercase tracking-tighter mb-8 md:mb-12 border-b-4 border-red-600 inline-block text-white not-italic">
                BROADCASTER
            </h2>

            <div class="swiper penyiarSwiper overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($penyiars as $penyiar)
                        @php
                            $dataPenyiar = [
                                'nama' => $penyiar->nama,
                                'foto' => asset('storage/' . $penyiar->foto),
                                'instagram' => $penyiar->instagram,
                                'bio' => str_replace(["\r", "\n"], ' ', $penyiar->bio ?? 'Radio Kota Announcer')
                            ];
                        @endphp

                        <div class="swiper-slide !w-auto">
                            <div class="group relative w-[260px] md:w-[280px] h-[350px] md:h-[380px] rounded-[30px] overflow-hidden cursor-pointer shadow-2xl transition-all hover:-translate-y-2"
                                @click="openModal = true; selectedPenyiar = {{ json_encode($dataPenyiar) }}">

                                <img src="{{ asset('storage/' . $penyiar->foto) }}"
                                    class="w-full h-full object-cover pointer-events-none transition-transform duration-700 group-hover:scale-110">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-white/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6 md:p-8">
                                    <h3 class="text-red-600 font-black uppercase not-italic tracking-tighter text-xl">
                                        {{ $penyiar->nama }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- MODAL --}}
            <div x-show="openModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed inset-0 z-[10000] flex items-center justify-center bg-black/80 p-4 backdrop-blur-sm"
                x-cloak>

                <div @click.away="openModal = false"
                    class="bg-[#161b22] rounded-[30px] p-6 md:p-8 w-[92%] md:w-full max-w-2xl shadow-[0_0_50px_rgba(0,0,0,0.5)] flex flex-col md:flex-row gap-5 md:gap-8 relative border border-white/10 font-sans max-h-[85vh] overflow-y-auto mx-auto">

                    <div
                        class="w-[130px] sm:w-[180px] md:w-[240px] mx-auto md:mx-0 shrink-0 aspect-[4/5] rounded-[20px] overflow-hidden shadow-2xl mt-2 md:mt-0 border border-white/5">
                        <img :src="selectedPenyiar.foto" class="w-full h-full object-cover">
                    </div>

                    <div class="w-full text-white flex flex-col pt-2 text-center md:text-left">
                        <div class="mb-4 md:mb-6">
                            <p class="text-gray-400 font-bold text-sm md:text-lg mb-1">Nama :</p>
                            <h2 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-white"
                                x-text="selectedPenyiar.nama"></h2>
                        </div>

                        <div class="mb-4 md:mb-6">
                            <p class="text-gray-400 font-bold text-sm md:text-lg mb-2">Social Media :</p>
                            <div class="flex items-center justify-center md:justify-start gap-3">
                                <a :href="'https://instagram.com/' + (selectedPenyiar.instagram ? selectedPenyiar.instagram.replace('@', '') : '')"
                                    target="_blank"
                                    class="flex items-center justify-center w-10 h-10 rounded-xl bg-red-600 hover:bg-red-700 border border-red-50 transition-all shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0 3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                                <span class="text-white font-medium text-base md:text-lg"
                                    x-text="selectedPenyiar.instagram"></span>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-400 font-bold text-sm md:text-lg mb-1">Bio :</p>
                            <p class="text-gray-200 text-sm md:text-base leading-relaxed font-normal"
                                x-text="selectedPenyiar.bio"></p>
                        </div>
                    </div>

                    <button @click="openModal = false"
                        class="absolute top-4 right-4 md:top-6 md:right-6 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white rounded-full p-2 transition-all z-20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <section id="streaming-section" class="relative z-20 py-12 px-6 lg:px-24 bg-[#0b0e14]">
            @livewire('video-player')
        </section>

       <section id="creative-district"
            class="relative z-10 pt-16 md:pt-24 pb-8 md:pb-12 px-5 sm:px-8 lg:px-24 bg-transparent">
            <div class="max-w-7xl mx-auto">

                <!-- Header Section -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 md:mb-12 gap-5 md:gap-6">
                    <div class="w-full md:w-auto">
                        <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-white border-b-4 border-red-600 inline-block mb-3 md:mb-4">
                            105 Creative <span class="text-red-600">District</span>
                        </h2>
                        <p class="text-gray-400 text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] block">
                            Wadah Kreativitas Komunitas & Talenta Lokal Mataram
                        </p>
                    </div>

                    <a href="{{ route('creative-district.index') }}" wire:navigate
                        class="group w-full md:w-auto inline-flex items-center justify-center px-6 py-3.5 md:py-3 bg-red-600 hover:bg-white text-white hover:text-red-600 font-black uppercase text-[10px] md:text-[9px] tracking-[0.2em] rounded-full transition-all duration-300 active:scale-95 shadow-[0_4px_15px_rgba(220,38,38,0.4)] mt-2 md:mt-0">
                        <span>Lihat Semua Koleksi</span>
                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4 ml-2 group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Grid Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($creativeDistricts as $item)
                        <a href="{{ route('creative-district.show', $item->id) }}" wire:navigate
                            class="group bg-white rounded-[20px] md:rounded-[24px] overflow-hidden border border-transparent hover:border-red-100 hover:shadow-[0_15px_40px_rgba(255,255,255,0.08)] transition-all duration-300 flex flex-col cursor-pointer hover:-translate-y-1.5">

                            <div class="relative h-48 md:h-52 overflow-hidden shrink-0 p-2.5 md:p-3">
                                <div class="w-full h-full overflow-hidden rounded-[14px] md:rounded-[16px]">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                            alt="{{ $item->nama }}">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-400 text-[10px] font-bold tracking-widest uppercase">No Preview</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="absolute top-5 left-5 md:top-6 md:left-6">
                                    <span class="bg-red-600 text-white text-[8px] md:text-[9px] font-black px-3.5 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-md">
                                        {{ $item->kategori }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5 md:p-6 pt-3 flex-grow flex flex-col">
                                <h3 class="text-lg md:text-xl font-black text-slate-900 mb-2.5 line-clamp-2 group-hover:text-red-600 transition-colors uppercase tracking-tight leading-tight">
                                    {{ $item->nama }}
                                </h3>

                                @if($item->lokasi)
                                    <div class="flex items-start gap-2 text-slate-500 mb-3.5">
                                        <svg class="w-3.5 h-3.5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        </svg>
                                        <span class="text-[9px] md:text-[10px] font-black uppercase tracking-widest leading-snug mt-0.5">
                                            {{ $item->lokasi }}
                                        </span>
                                    </div>
                                @endif

                                <p class="text-slate-600 text-[11px] md:text-xs leading-relaxed line-clamp-3 font-medium mb-5">
                                    {{ strip_tags($item->deskripsi) }}
                                </p>

                                <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-red-600 font-black text-[9px] md:text-[10px] uppercase tracking-[0.2em] flex items-center">
                                        Selengkapnya <span class="ml-2 group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        
        <section id="berita" class="relative z-10 pt-8 md:pt-12 pb-6 md:pb-8 px-5 sm:px-8 lg:px-24 bg-transparent">

            <div class="mb-10 md:mb-12 flex flex-col md:flex-row md:items-end justify-between gap-5 md:gap-6 text-left">
                <div class="w-full md:w-auto">
                    <h2
                        class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-white border-b-4 border-red-600 inline-block mb-3 md:mb-4">
                        Info <span class="text-red-600">Berita</span>
                    </h2>
                    <p class="text-gray-400 text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] block">
                        Kabar Terkini & Terpercaya Seputar Mataram
                    </p>
                </div>

                @if($beritas->count() > 0)
                    <div class="w-full md:w-auto">
                        <a href="{{ route('berita.index') }}" wire:navigate
                            class="flex md:inline-flex justify-center items-center w-full md:w-auto bg-red-600 hover:bg-white text-white hover:text-red-600 px-6 py-3.5 md:py-3 rounded-full text-[10px] md:text-[9px] font-black uppercase tracking-[0.2em] transition-all duration-300 shadow-[0_4px_15px_rgba(220,38,38,0.4)] active:scale-95 group">
                            <span>Lihat Semua Berita</span> <span
                                class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 sm:gap-6 w-full">
                @forelse($beritas as $berita)
                    <a href="{{ route('berita.detail', $berita->slug) }}" wire:navigate
                        class="bg-white group cursor-pointer rounded-[20px] md:rounded-[24px] overflow-hidden flex h-36 sm:h-40 md:h-44 transition-all duration-300 hover:shadow-[0_15px_40px_rgba(255,255,255,0.08)] hover:-translate-y-1.5 border border-transparent hover:border-red-100">

                        <div class="w-1/3 sm:w-2/5 h-full p-2.5 md:p-3 shrink-0 relative">
                            <div
                                class="w-full h-full overflow-hidden rounded-[14px] md:rounded-[16px] bg-gray-100 relative">
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                        alt="{{ $berita->judul }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <span class="text-[8px] font-black uppercase tracking-widest">No Image</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                        </div>

                        <div class="w-2/3 sm:w-3/5 p-4 sm:p-5 pt-3 flex flex-col justify-center">
                            <div
                                class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-red-600 mb-1.5 md:mb-2">
                                {{ $berita->kategori }}
                            </div>

                            <h3
                                class="text-sm sm:text-base md:text-lg font-black leading-tight text-slate-900 mb-2 line-clamp-2 md:line-clamp-3 group-hover:text-red-600 transition-colors duration-300">
                                {{ $berita->judul }}
                            </h3>

                            <div
                                class="mt-auto text-[9px] md:text-[10px] text-slate-500 font-bold tracking-widest uppercase flex items-center gap-1.5 pt-2 border-t border-slate-100">
                                <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $berita->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    </a>

                @empty
                    <div
                        class="col-span-full text-center py-16 md:py-20 border-2 border-dashed border-white/10 rounded-[24px] bg-[#161b22]">
                        <p class="uppercase font-bold tracking-widest text-xs md:text-sm text-gray-500">
                            Belum ada berita yang dipublikasikan.
                        </p>
                    </div>
                @endforelse
            </div>
        </section>


       <!-- ================= SECTION HIDDEN GEM ================= -->
        <section id="wisata-tongkrongan" class="relative z-20 pt-8 md:pt-12 pb-8 md:pb-12 px-5 sm:px-8 lg:px-24 bg-transparent">
            <div class="mb-10 md:mb-12 flex flex-col md:flex-row md:items-end justify-between gap-5 md:gap-6 text-left">
                <div class="w-full md:w-auto">
                    <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-white border-b-4 border-red-600 inline-block mb-3 md:mb-4">
                        Hidden <span class="text-red-600">GEM</span>
                    </h2>
                    <p class="text-gray-400 text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] block">
                        Destinasi Wisata & Tempat Tongkrongan Pilihan Mataram
                    </p>
                </div>

                <div class="w-full md:w-auto">
                    <a href="{{ route('wisata.index') }}" wire:navigate
                        class="flex md:inline-flex justify-center items-center bg-red-600 hover:bg-white text-white hover:text-red-600 text-[10px] md:text-[9px] font-black uppercase tracking-widest px-6 py-3.5 md:py-3 rounded-full transition-all duration-300 shadow-[0_4px_15px_rgba(220,38,38,0.4)] active:scale-95 group">
                        Lihat Semua Koleksi <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($wisatas as $w)
                    <a href="{{ route('wisata.show', $w->id) }}" wire:navigate
                        class="group bg-white rounded-[20px] md:rounded-[24px] overflow-hidden border border-transparent hover:border-red-100 shadow-lg hover:shadow-[0_20px_50px_rgba(255,255,255,0.08)] hover:-translate-y-1.5 transition-all duration-500 flex flex-col cursor-pointer">
                        
                        <div class="relative h-48 md:h-52 w-full shrink-0 p-2.5 md:p-3">
                            <div class="w-full h-full overflow-hidden rounded-[14px] md:rounded-[16px] bg-gray-100 relative">
                                <img src="{{ asset('storage/' . $w->gambar) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    alt="{{ $w->nama_wisata }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <div class="absolute top-5 left-5 md:top-6 md:left-6">
                                <span class="bg-red-600 text-white text-[8px] md:text-[9px] font-black px-3.5 md:px-4 py-1.5 md:py-2 rounded-full uppercase tracking-widest shadow-md">
                                    {{ strtolower($w->kategori) == 'wisata' ? 'Wisata' : 'Tongkrongan' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 md:p-6 pt-3 flex flex-col flex-grow">
                            <h3 class="text-lg md:text-xl font-black text-slate-900 mb-2.5 line-clamp-1 uppercase tracking-tight group-hover:text-red-600 transition-colors duration-300 leading-tight">
                                {{ $w->nama_wisata }}
                            </h3>

                            <p class="text-slate-600 text-[11px] md:text-xs leading-relaxed font-medium mb-5 line-clamp-2 md:line-clamp-3">
                                {{ strip_tags(html_entity_decode($w->deskripsi ?? 'Jelajahi keindahan destinasi pilihan di Kota Mataram.')) }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between group/btn">
                                <span class="text-red-600 font-black text-[9px] md:text-[10px] uppercase tracking-[0.2em] flex items-center">
                                    Lihat Detail <span class="ml-2 group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- ================= SECTION UMKM ================= -->
        <section id="umkm-lokal" class="relative z-20 pt-8 md:pt-12 pb-16 md:pb-24 px-5 sm:px-8 lg:px-24 bg-transparent">
            <div class="mb-10 md:mb-12 flex flex-col md:flex-row md:items-end justify-between gap-5 md:gap-6 text-left">
                <div class="w-full md:w-auto">
                    <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-white border-b-4 border-red-600 inline-block mb-3 md:mb-4">
                        UMKM
                    </h2>
                    <p class="text-gray-400 text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] block">
                        Dukung Produk Lokal & Kreativitas Masyarakat Mataram
                    </p>
                </div>

                <div class="w-full md:w-auto">
                    <a href="{{ route('umkm.index') }}" wire:navigate
                        class="flex md:inline-flex justify-center items-center bg-red-600 hover:bg-white text-white hover:text-red-600 text-[10px] md:text-[9px] font-black uppercase tracking-widest px-6 py-3.5 md:py-3 rounded-full transition-all duration-300 shadow-[0_4px_15px_rgba(220,38,38,0.4)] active:scale-95">
                        Lihat Semua UMKM <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($umkms as $u)
                    @php
                        $warnaKategori = match (strtolower($u->kategori)) {
                            'kriya' => 'bg-orange-500',
                            'fashion' => 'bg-purple-600',
                            'kuliner' => 'bg-emerald-600',
                            'jasa' => 'bg-blue-600',
                            default => 'bg-slate-700',
                        };
                    @endphp

                    <a href="{{ route('umkm.show', $u->id) }}" wire:navigate
                        class="group bg-white rounded-[20px] md:rounded-[24px] overflow-hidden border border-transparent hover:border-red-100 shadow-lg hover:shadow-[0_20px_50px_rgba(255,255,255,0.08)] hover:-translate-y-1.5 transition-all duration-500 flex flex-col cursor-pointer">
                        
                        <div class="relative h-48 md:h-52 w-full p-2.5 md:p-3 shrink-0">
                            <div class="w-full h-full overflow-hidden rounded-[14px] md:rounded-[16px] bg-gray-100 relative">
                                <img src="{{ asset('storage/' . $u->gambar) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <div class="absolute top-5 left-5 md:top-6 md:left-6">
                                <span class="{{ $warnaKategori }} text-white text-[8px] md:text-[9px] font-black px-3.5 md:px-4 py-1.5 md:py-2 rounded-full uppercase tracking-widest shadow-md">
                                    {{ $u->kategori }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 md:p-6 pt-3 flex flex-col flex-grow">
                            <h3 class="text-lg md:text-xl font-black text-slate-900 mb-2.5 line-clamp-1 uppercase tracking-tight group-hover:text-red-600 transition-colors duration-300 leading-tight">
                                {{ $u->nama_usaha }}
                            </h3>

                            <p class="text-slate-600 text-[11px] md:text-xs leading-relaxed font-medium mb-5 line-clamp-2 md:line-clamp-3">
                                {{ strip_tags(str_replace('&nbsp;', ' ', $u->deskripsi ?? 'Produk UMKM lokal berkualitas.')) }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between group/btn">
                                <span class="text-red-600 font-black text-[9px] md:text-[10px] uppercase tracking-[0.2em] flex items-center">
                                    Profil {{ $u->kategori }} <span class="ml-2 group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- ================= SECTION SEKOLAH KITA ================= -->
        <section id="sekolah-kita" class="relative z-20 pt-2 md:pt-4 pb-8 md:pb-12 px-5 sm:px-8 lg:px-24 bg-transparent">
            <div class="mb-10 md:mb-12 flex flex-col md:flex-row md:items-end justify-between gap-5 md:gap-6 text-left">
                <div class="w-full md:w-auto">
                    <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-white border-b-4 border-red-600 inline-block mb-3 md:mb-4">
                        Sekolah <span class="text-red-600">Kita</span>
                    </h2>
                    <p class="text-gray-400 text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] block">
                        Dokumentasi Prestasi & Kegiatan Siswa Mataram
                    </p>
                </div>

                <div class="w-full md:w-auto">
                    <a href="{{ route('sekolah.index') }}" wire:navigate
                        class="flex md:inline-flex justify-center items-center w-full md:w-auto bg-red-600 hover:bg-white text-white hover:text-red-600 px-6 py-3.5 md:py-3 rounded-full text-[10px] md:text-[9px] font-black uppercase tracking-[0.2em] transition-all duration-300 shadow-[0_4px_15px_rgba(220,38,38,0.4)] active:scale-95 group">
                        <span>Lihat Semua Kegiatan</span> <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 w-full">
                @foreach($schoolActivities as $activity)
                    <a href="{{ route('sekolah.show', $activity->id) }}" wire:navigate
                        class="group bg-white rounded-[20px] md:rounded-[24px] overflow-hidden flex flex-col transition-all duration-300 hover:shadow-[0_20px_50px_rgba(255,255,255,0.08)] hover:-translate-y-1.5 cursor-pointer border border-transparent hover:border-red-100">
                        
                        <div class="relative h-48 md:h-52 w-full shrink-0 p-2.5 md:p-3">
                            <div class="w-full h-full overflow-hidden rounded-[14px] md:rounded-[16px] bg-gray-100 relative">
                                @if($activity->gambar)
                                    <img src="{{ asset('storage/' . $activity->gambar) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                        alt="{{ $activity->judul }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-[10px] font-black uppercase tracking-widest">
                                        No Preview</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <div class="absolute top-5 left-5 md:top-6 md:left-6">
                                <span class="bg-red-600 text-white text-[8px] md:text-[9px] font-black px-3.5 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-md">
                                    {{ $activity->kategori }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 md:p-6 pt-3 flex flex-col flex-grow">
                            <p class="text-red-600 text-[8px] md:text-[9px] font-black uppercase tracking-[0.2em] mb-1.5 line-clamp-1">
                                {{ $activity->asal_sekolah }}
                            </p>

                            <h3 class="text-lg md:text-xl font-black leading-tight text-slate-900 mb-2.5 uppercase line-clamp-2 group-hover:text-red-600 transition-colors duration-300">
                                {{ $activity->judul }}
                            </h3>

                            <p class="text-[11px] md:text-xs text-slate-600 font-medium mb-5 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags(html_entity_decode($activity->deskripsi)), 90) }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between group/btn">
                                <span class="text-red-600 font-black text-[9px] md:text-[10px] uppercase tracking-[0.2em] flex items-center">
                                    Lihat Detail <span class="ml-2 group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- ================= SECTION LAYANAN PUBLIK ================= -->
        <section id="layanan-publik" class="relative z-30 pt-8 md:pt-12 pb-16 md:pb-24 bg-transparent">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-24">
                <div class="mb-10 md:mb-12 flex flex-col md:flex-row md:items-end justify-between gap-5 md:gap-6 text-left">
                    <div class="w-full md:w-auto">
                        <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tighter mb-1 border-b-4 border-red-600 inline-block pb-1">
                            Layanan <span class="text-red-600">Publik</span>
                        </h2>
                        <p class="text-gray-400 text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] mt-3 block">
                            Informasi Penting & Bantuan Masyarakat
                        </p>
                    </div>

                    <div class="w-full md:w-auto">
                        <a href="{{ route('layanan.index') }}" wire:navigate
                            class="flex md:inline-flex items-center justify-center w-full md:w-auto px-6 py-3.5 md:py-3 bg-red-600 hover:bg-white hover:text-red-600 text-white font-black uppercase text-[10px] md:text-[9px] tracking-[0.2em] rounded-full transition-all duration-300 shadow-[0_4px_15px_rgba(220,38,38,0.4)] active:scale-95 group">
                            <span>Lihat Semua Layanan</span>
                            <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    @forelse($layanans->take(3) as $item)
                        <a href="{{ route('layanan.index') }}" wire:navigate
                            class="group bg-white p-6 md:p-8 rounded-[20px] md:rounded-[24px] flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_50px_rgba(255,255,255,0.08)] cursor-pointer border border-transparent hover:border-red-100">

                            <div class="mb-5 md:mb-6">
                                <span class="bg-red-50 text-red-600 border border-red-100 text-[8px] md:text-[9px] font-black px-4 py-2 rounded-full uppercase tracking-widest shadow-sm">
                                    {{ str_replace('_', ' ', $item->kategori) }}
                                </span>
                            </div>

                            <h3 class="text-slate-900 text-xl md:text-2xl font-black uppercase mb-3 md:mb-4 leading-tight group-hover:text-red-600 transition-colors">
                                {{ $item->judul }}
                            </h3>

                            <div class="flex-grow mb-6 md:mb-8 text-slate-600 text-[11px] md:text-xs leading-relaxed font-medium">
                                <p class="line-clamp-3">
                                    {{ Str::limit(strip_tags($item->deskripsi), 100) }}
                                </p>
                            </div>

                            <div class="w-full bg-slate-900 group-hover:bg-red-600 text-white text-[9px] md:text-[10px] font-black uppercase py-3.5 md:py-4 rounded-full text-center transition-colors duration-300 shadow-md flex items-center justify-center gap-2 mt-auto">
                                Akses Layanan <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full py-16 text-center border-2 border-dashed border-white/20 rounded-[24px] bg-[#161b22]">
                            <p class="text-gray-400 font-bold uppercase tracking-[0.3em] text-[10px] md:text-xs">-- Belum ada data layanan --</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <div id="floating-video" class="fixed bottom-5 right-5 z-[9999] hidden">
        <div id="floating-container"></div>
    </div>


    <footer class="py-10 text-center border-t border-gray-200">
        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.5em]">&copy; 2026 Radio Kota Mataram.
            ALL
            RIGHTS RESERVED.</p>
    </footer>

    {{-- MODAL PERMINTAAN DARAH --}}
    <div x-data="{ show: {{ $errors->any() || session()->has('error') || session()->has('success') ? 'true' : 'false' }} }"
        x-on:buka-form-darah.window="show = true" x-show="show"
        class="fixed inset-0 z-[9999] flex items-center justify-center p-4" x-cloak>

        <div class="relative bg-white w-full max-w-lg rounded-[40px] p-10 shadow-2xl border border-white/20 pointer-events-auto"
            x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-8"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Form <span
                            class="text-red-600">Permintaan</span></h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Layanan PMI Kota
                        Mataram</p>
                </div>
                <button @click="show = false"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-red-50 hover:text-red-600 transition-all duration-300">
                    <span class="text-xl">&times;</span>
                </button>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('permintaan.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-2 ml-1">Nama Lengkap
                        Pasien</label>
                    <input type="text" name="nama_pasien"
                        class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 text-slate-900 font-semibold text-sm focus:bg-white focus:border-red-600 outline-none transition-all duration-300"
                        placeholder="Nama sesuai KTP" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-2 ml-1">Golongan
                            Darah</label>
                        <select name="golongan_darah"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 text-slate-900 font-semibold text-sm outline-none focus:bg-white focus:border-red-600">
                            <option value="A">Tipe A</option>
                            <option value="B">Tipe B</option>
                            <option value="AB">Tipe AB</option>
                            <option value="O">Tipe O</option>
                        </select>
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-extrabold uppercase text-slate-500 mb-2 ml-1">Rhesus</label>
                        <select name="rhesus"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 text-slate-900 font-semibold text-sm outline-none focus:bg-white focus:border-red-600">
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-2 ml-1">Jumlah
                            Kantong</label>
                        <input type="number" name="jumlah_kantong"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 text-slate-900 font-semibold text-sm focus:bg-white focus:border-red-600 outline-none"
                            placeholder="0" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-2 ml-1">Rumah
                            Sakit
                            Tujuan</label>
                        <input type="text" name="rumah_sakit"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 text-slate-900 font-semibold text-sm focus:bg-white focus:border-red-600 outline-none"
                            placeholder="Nama RS" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-2 ml-1">Kontak
                            Keluarga</label>
                        <input type="text" name="kontak_keluarga"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 text-slate-900 font-semibold text-sm focus:bg-white focus:border-red-600 outline-none"
                            placeholder="0812..." required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-2 ml-1">Kontak
                            Pribadi</label>
                        <input type="text" name="kontak_pribadi"
                            class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 text-slate-900 font-semibold text-sm focus:bg-white focus:border-red-600 outline-none"
                            placeholder="0877..." required>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-slate-900 text-white font-black py-5 rounded-[24px] uppercase text-[11px] tracking-[0.2em] transition-all duration-500 shadow-xl shadow-red-200">
                        Kirim Permintaan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- SCRIPTS KHUSUS LANDING PAGE --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Inisialisasi Swiper
        document.addEventListener('livewire:navigated', () => {
            if (window.mySwiperInstance) {
                window.mySwiperInstance.destroy(true, true);
                window.mySwiperInstance = null;
            }

            window.mySwiperInstance = new Swiper('.penyiarSwiper', {
                slidesPerView: 'auto',
                spaceBetween: 30,
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                observer: true,
                observeParents: true,
            });
        });

        // Filter Kategori
        function filterKategori(slug) {
            document.querySelectorAll('.btn-filter').forEach(btn => {
                btn.className = 'btn-filter shrink-0 snap-start bg-[#161b22] text-gray-400 border border-white/5 px-5 md:px-6 py-2.5 md:py-3 rounded-full font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all duration-300 hover:border-red-500/30 hover:text-white';
            });

            const activeBtn = document.getElementById('btn-' + slug);
            if (activeBtn) {
                activeBtn.className = 'btn-filter shrink-0 snap-start bg-red-600 text-white border border-red-600 px-5 md:px-6 py-2.5 md:py-3 rounded-full font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all duration-300 shadow-[0_4px_15px_rgba(220,38,38,0.4)]';
            }

            document.querySelectorAll('.card-item').forEach(card => {
                if (slug === 'all' || card.getAttribute('data-category') === slug) {
                    card.style.display = ''; 
                    card.classList.remove('hidden');
                } else {
                    card.style.display = 'none';
                }
            });
        }

        document.addEventListener('livewire:navigated', () => {
            filterKategori('all');
        });

        // Inisialisasi Floating Video
        document.addEventListener('livewire:navigated', function () {
            initFloatingVideo();
        });

        function initFloatingVideo() {
            const wrapper = document.getElementById('video-wrapper');
            const floating = document.getElementById('floating-video');
            const floatContainer = document.getElementById('floating-container');
            const mainPlayer = document.getElementById('main-player');

            if (!wrapper || !mainPlayer) {
                window.onscroll = null;
                return;
            }

            window.onscroll = () => {
                const rect = wrapper.getBoundingClientRect();

                if (rect.bottom < 0) {
                    if (floating && floating.classList.contains('hidden')) {
                        floating.classList.remove('hidden');
                        floatContainer.appendChild(mainPlayer);
                        if (mainPlayer.src && mainPlayer.src.includes('mute=1')) {
                            mainPlayer.src = mainPlayer.src.replace('mute=1', 'mute=0');
                        }
                    }
                } else {
                    if (floatContainer && floatContainer.contains(mainPlayer)) {
                        wrapper.appendChild(mainPlayer);
                        if (mainPlayer.src && mainPlayer.src.includes('mute=0')) {
                            mainPlayer.src = mainPlayer.src.replace('mute=0', 'mute=1');
                        }
                        floating.classList.add('hidden');
                    }
                }
            };
        }
    </script>

   

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#e11d48',
            });
        </script>
    @endif

@endsection