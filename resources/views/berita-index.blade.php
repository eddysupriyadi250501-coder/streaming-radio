@extends('layouts.app')

@section('content')
    <style>
        /* Utility untuk menyembunyikan scrollbar di menu kategori (khusus HP) */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <main class="min-h-screen pt-10 md:pt-16 pb-20 px-5 sm:px-8 lg:px-24 relative">
        <div class="max-w-7xl mx-auto">

            {{-- Tombol Kembali --}}
            <a href="{{ route('landing') }}" wire:navigate
                class="group inline-flex items-center text-gray-400 hover:text-white transition-colors text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] mb-10">
                <span class="mr-3 transform group-hover:-translate-x-2 transition-transform duration-300">←</span>
                Kembali ke Home
            </a>

            {{-- Header Gudang Berita --}}
            <div class="mb-10 md:mb-14">
                <h1
                    class="text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tighter mb-4 md:mb-5 leading-tight">
                    Gudang <span class="text-red-600">Berita</span>
                </h1>
                <div class="flex items-center gap-4">
                    <span class="h-1 w-10 md:w-12 bg-red-600 shrink-0 rounded-full"></span>
                    <p
                        class="text-gray-400 font-bold uppercase tracking-[0.2em] text-[10px] md:text-[11px] leading-relaxed">
                        Arsip Informasi & Berita Terkini Kota Mataram
                    </p>
                </div>
            </div>

            {{-- GRID UTAMA --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-10">

                {{-- SIDEBAR / FILTER KATEGORI --}}
                <div class="lg:col-span-4 order-1 lg:order-2">
                    <div class="sticky top-24 space-y-6">

                        {{-- KOTAK PENCARIAN & KATEGORI --}}
                        <div class="bg-[#161b22] border border-white/5 p-5 md:p-6 rounded-[24px] shadow-2xl">

                            {{-- Form Pencarian --}}
                            <form action="{{ route('berita.index') }}" method="GET" class="relative mb-6">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari judul berita..."
                                    class="w-full bg-[#0b0e14] border border-white/10 rounded-full py-3.5 pl-5 pr-12 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-red-500/50 focus:ring-1 focus:ring-red-500/50 transition-all font-medium">
                                <button type="submit"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center bg-red-600 hover:bg-red-700 text-white rounded-full transition-colors active:scale-95">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </form>

                            <h4
                                class="text-[10px] md:text-xs font-black uppercase tracking-[0.2em] text-white mb-4 md:mb-5 flex items-center gap-3">
                                <span class="w-1.5 h-4 bg-red-600 rounded-full"></span> Kategori Topik
                            </h4>

                            {{-- Menu Kategori --}}
                            <div
                                class="flex flex-row lg:flex-col gap-2.5 overflow-x-auto lg:overflow-visible hide-scrollbar pb-2 lg:pb-0 snap-x">
                                
                                <a href="{{ route('berita.index') }}" wire:navigate
                                    class="{{ !request('category') ? 'bg-red-600 text-white shadow-[0_0_15px_rgba(220,38,38,0.3)] border-red-500' : 'bg-[#0b0e14] text-gray-400 hover:bg-white/10 hover:text-white border-white/5' }} transition-all duration-300 font-black px-5 py-3 rounded-full lg:rounded-xl uppercase text-[9px] tracking-widest shrink-0 snap-start flex justify-between items-center border">
                                    <span>Semua Berita</span>
                                    <span class="opacity-50 hidden lg:inline text-xs">&rarr;</span>
                                </a>

                                @foreach($daftarKategori as $kat)
                                    <a href="{{ route('berita.index', ['category' => $kat->kategori]) }}" wire:navigate
                                        class="{{ request('category') == $kat->kategori ? 'bg-red-600 text-white shadow-[0_0_15px_rgba(220,38,38,0.3)] border-red-500' : 'bg-[#0b0e14] text-gray-400 hover:bg-white/10 hover:text-white border-white/5' }} transition-all duration-300 font-black px-5 py-3 rounded-full lg:rounded-xl uppercase text-[9px] tracking-widest shrink-0 snap-start flex justify-between items-center border">
                                        <span>{{ $kat->kategori }}</span>
                                        <span class="opacity-50 hidden lg:inline text-xs">&rarr;</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Banner Streaming --}}
                        <div
                            class="p-6 md:p-8 bg-gradient-to-br from-red-600 to-red-900 rounded-[24px] relative overflow-hidden group shadow-2xl shadow-red-900/20 hidden sm:block">
                            <div class="relative z-10">
                                <h5 class="text-xl md:text-2xl font-black uppercase leading-tight mb-5 text-white">
                                    Streaming<br>Suara Kota</h5>
                                <a href="{{ route('landing') }}#streaming" wire:navigate
                                    class="inline-block bg-white text-black px-6 py-3 rounded-full text-[9px] font-black uppercase tracking-widest hover:scale-105 transition-transform shadow-lg">
                                    Dengarkan Sekarang
                                </a>
                            </div>
                            <div
                                class="absolute -right-4 -bottom-6 text-white/10 text-8xl font-black rotate-[-10deg] group-hover:rotate-0 transition-transform duration-500">
                                105
                            </div>
                        </div>
                    </div>
                </div>

                {{-- LIST BERITA --}}
                <div class="lg:col-span-8 order-2 lg:order-1 space-y-4 md:space-y-6">

                    @if(request('search'))
                        <div
                            class="bg-red-600/10 border border-red-500/20 rounded-2xl p-4 flex items-center justify-between">
                            <p class="text-xs font-bold text-red-500 uppercase tracking-widest">
                                Hasil pencarian: "<span class="text-white">{{ request('search') }}</span>"
                            </p>
                            <a href="{{ route('berita.index', request()->except('search')) }}" wire:navigate
                                class="text-white hover:text-red-500 text-xs font-black uppercase tracking-widest">✕
                                Reset</a>
                        </div>
                    @endif

                    @forelse($beritas as $berita)
                        <a href="{{ route('berita.detail', $berita->slug) }}" wire:navigate
                            class="bg-white flex flex-col sm:flex-row gap-0 sm:gap-5 md:gap-6 group cursor-pointer p-3 sm:p-4 md:p-5 rounded-[20px] md:rounded-[24px] shadow-lg hover:shadow-[0_20px_50px_rgba(255,255,255,0.08)] border border-transparent hover:border-red-100 transition-all duration-300 hover:-translate-y-1.5">

                            {{-- Gambar --}}
                            <div
                                class="w-full sm:w-2/5 md:w-1/3 aspect-[4/3] sm:aspect-square md:aspect-[4/3] overflow-hidden rounded-[14px] md:rounded-[16px] relative shrink-0 mb-4 sm:mb-0 bg-gray-100">
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fa-regular fa-image text-3xl"></i>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>

                            {{-- Konten --}}
                            <div class="flex flex-col flex-grow justify-center py-1 md:py-2 px-2 sm:px-0">
                                <div>
                                    <div class="mb-3">
                                        <span
                                            class="bg-red-50 text-red-600 px-3.5 py-1.5 rounded-full text-[8px] md:text-[9px] font-black uppercase tracking-widest border border-red-100 shadow-sm">
                                            {{ $berita->kategori }}
                                        </span>
                                    </div>

                                    <h3
                                        class="text-base md:text-xl font-black uppercase tracking-tight leading-tight mb-3 md:mb-4 group-hover:text-red-600 text-slate-900 transition-colors duration-300 line-clamp-2 md:line-clamp-3">
                                        {{ $berita->judul }}
                                    </h3>
                                </div>

                                {{-- Footer Kartu --}}
                                <div
                                    class="flex items-center justify-between text-[9px] md:text-[10px] font-bold uppercase tracking-widest mt-auto border-t border-slate-100 pt-3 md:pt-4">
                                    <div class="flex items-center">
                                        <span class="text-slate-600">{{ $berita->penulis ?? 'REDAKSI' }}</span>
                                        <span class="mx-2 md:mx-3 text-red-600">•</span>
                                        <span
                                            class="text-slate-500">{{ $berita->created_at->translatedFormat('d M Y') }}</span>
                                    </div>

                                    <div
                                        class="hidden sm:flex items-center gap-1 text-red-600 group-hover:translate-x-1 transition-transform">
                                        <span
                                            class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">Baca</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M9 5l7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div
                            class="text-center py-20 bg-white rounded-[24px] border border-slate-100 shadow-lg flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-slate-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M14 4v5h5M9 14h6M9 10h6"></path>
                            </svg>
                            <p class="text-slate-500 uppercase font-black tracking-[0.3em] text-[10px] md:text-xs">
                                Belum ada berita yang ditemukan.
                            </p>
                        </div>
                    @endforelse

                    {{-- PAGINATION WIDGET --}}
                    @if(method_exists($beritas, 'links') && $beritas->hasPages())
                        <div class="pt-8">
                            {{ $beritas->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-black py-12 px-6 border-t border-white/5 text-center mt-10">
        <div class="max-w-7xl mx-auto">
            <div class="text-xl md:text-2xl font-black tracking-[0.2em] uppercase mb-4 text-white italic">
                SUARA<span class="text-red-600">KOTA</span>
            </div>
            <p
                class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.4em] md:tracking-[0.6em] text-gray-700 leading-relaxed">
                &copy; 2026 SUARA KOTA MATARAM - ALL RIGHTS RESERVED
            </p>
        </div>
    </footer>
@endsection