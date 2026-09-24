@extends('layouts.app')

@section('content')
    <main>
        <div x-data="{ activeCategory: new URLSearchParams(window.location.search).get('category') || 'Semua' }">

            {{-- HEADER SECTION --}}
            <div class="relative pt-12 md:pt-20 pb-10 px-5 sm:px-8 lg:px-24 bg-[#0b0e14]">
                <div class="max-w-7xl mx-auto">
                    <a href="{{ url('/#creative-district') }}" wire:navigate
                        class="inline-flex items-center gap-3 group mb-8 pr-6 pl-2 py-2 bg-[#161b22] border border-white/10 hover:bg-red-600 hover:border-red-600 rounded-full transition-all duration-300 w-max cursor-pointer shadow-sm hover:shadow-[0_10px_20px_rgba(220,38,38,0.2)]">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 group-hover:text-white transition-colors mt-0.5">
                            Kembali
                        </span>
                    </a>

                    <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter">
                        Koleksi <span class="text-red-600">Creative District</span>
                    </h1>
                </div>
            </div>

            {{-- KONTEN UTAMA --}}
            <section class="pb-20 px-5 sm:px-8 lg:px-24 bg-[#0b0e14] min-h-screen">
                <div class="max-w-7xl mx-auto">

                    {{-- Filter --}}
                    <div class="flex overflow-x-auto no-scrollbar gap-3 mb-12 pb-4 border-b border-white/5">
                        <button @click="activeCategory = 'Semua'"
                            :class="activeCategory === 'Semua' ? 'bg-red-600 text-white' : 'bg-[#161b22] text-gray-400'"
                            class="px-6 py-3 rounded-full border border-white/5 font-black text-[10px] uppercase tracking-widest transition-all">Semua</button>
                        @foreach(['komunitas', 'musisi', 'seniman', 'event', 'film'] as $kat)
                            <button @click="activeCategory = '{{ $kat }}'"
                                :class="activeCategory === '{{ $kat }}' ? 'bg-red-600 text-white' : 'bg-[#161b22] text-gray-400'"
                                class="px-6 py-3 rounded-full border border-white/5 font-black text-[10px] uppercase tracking-widest transition-all whitespace-nowrap">
                                {{ $kat }}
                            </button>
                        @endforeach
                    </div>

                    {{-- GRID DENGAN WIRE:KEY --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" wire:key="district-grid-container">
                        @forelse($creativeDistricts as $item)
                            <div x-show="activeCategory === 'Semua' || activeCategory === '{{ $item->kategori }}'" x-cloak
                                wire:key="district-{{ $item->id }}" class="flex">

                                {{-- PERBAIKAN: wire:navigate dihapus dari sini agar transisi audio mulus tanpa konflik memori --}}
                                <a href="{{ url('/creative-district/' . $item->id) }}" wire:navigate
                                    class="group bg-white rounded-[24px] overflow-hidden shadow-lg hover:-translate-y-2 transition-all duration-300 w-full flex flex-col">

                                    <div class="relative h-52 overflow-hidden p-3">
                                        <div class="w-full h-full rounded-[16px] bg-gray-100 overflow-hidden relative">
                                            @if($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                                    alt="{{ $item->nama }}">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-[10px] font-black uppercase">
                                                    No Image</div>
                                            @endif
                                        </div>
                                        <span class="absolute top-6 left-6 bg-red-600 text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">{{ $item->kategori }}</span>
                                    </div>

                                    <div class="p-6 flex-grow">
                                        <h3 class="text-lg font-black text-slate-900 uppercase mb-2">{{ $item->nama }}</h3>
                                        <p class="text-slate-600 text-xs leading-relaxed mb-4 line-clamp-2">
                                            {{ strip_tags(html_entity_decode($item->deskripsi)) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center text-gray-500">Data belum tersedia.</div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection