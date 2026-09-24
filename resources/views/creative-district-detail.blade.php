@extends('layouts.app')

@section('content')
    {{-- Mengubah judul tab browser secara dinamis tanpa mereload halaman --}}
    <script data-navigate-once>
        document.title = "{{ $item->nama }} - Radio Kota Mataram";
    </script>

    <main>
        {{-- HERO SECTION --}}
        <div class="relative w-full h-[50vh] md:h-[70vh] lg:h-[80vh] overflow-hidden">
            <div class="absolute top-6 left-5 md:top-10 lg:left-24 z-20">
                <a href="{{ route('creative-district.index') }}" wire:navigate
                   class="inline-flex items-center gap-2.5 md:gap-3 bg-black/30 md:bg-white/10 backdrop-blur-md border border-white/10 md:border-white/20 text-white px-5 md:px-6 py-2.5 md:py-3 rounded-full font-black uppercase text-[9px] md:text-[10px] tracking-widest hover:bg-red-600 hover:border-red-600 transition-all duration-300 group shadow-lg">
                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover brightness-[0.4]" alt="{{ $item->nama }}">
            @else
                <div class="w-full h-full bg-gray-900 flex items-center justify-center">
                    <span class="text-gray-700 font-black uppercase tracking-[0.3em] md:tracking-[0.5em] text-xs md:text-base">No Image Preview</span>
                </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-[#0b0e14] via-[#0b0e14]/40 to-transparent"></div>

            <div class="absolute bottom-0 left-0 w-full p-6 sm:p-8 lg:p-24 z-10">
                <div class="max-w-7xl mx-auto">
                    <span class="inline-block bg-red-600 text-white text-[9px] md:text-[10px] font-black px-4 md:px-6 py-1.5 md:py-2 rounded-full uppercase tracking-[0.2em] md:tracking-[0.3em] mb-4 md:mb-6 shadow-[0_0_15px_rgba(220,38,38,0.5)]">
                        {{ $item->kategori }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white uppercase tracking-tighter leading-[1.1] max-w-4xl drop-shadow-2xl">
                        {{ $item->nama }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <section class="py-12 md:py-20 px-5 sm:px-8 lg:px-24 bg-[#0b0e14]">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">
                    
                    <div class="lg:col-span-8">
                        <div class="prose prose-invert prose-sm md:prose-base max-w-none text-gray-300">
                            <h2 class="text-xl md:text-2xl font-black text-white uppercase tracking-tight mb-6 md:mb-8 border-l-4 border-red-600 pl-4 md:pl-6">
                                Tentang District Ini
                            </h2>
                            <div class="leading-relaxed space-y-4 md:space-y-6 text-justify">
                                {!! $item->deskripsi !!}
                            </div>
                        </div>

                        @if($item->link_maps)
                        <div class="mt-12 md:mt-16">
                            <h2 class="text-xl md:text-2xl font-black text-white uppercase tracking-tight mb-6 md:mb-8 border-l-4 border-red-600 pl-4 md:pl-6">
                                Lokasi Peta
                            </h2>
                            <div class="w-full rounded-[20px] md:rounded-[30px] overflow-hidden border border-white/5 shadow-2xl bg-white/5 p-1.5 md:p-2">
                                <iframe 
                                    class="w-full h-64 md:h-96 rounded-[16px] md:rounded-[25px]"
                                    src="{{ $item->link_maps }}" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="lg:col-span-4">
                        <div class="bg-white rounded-[25px] md:rounded-[40px] p-6 sm:p-8 md:p-10 lg:sticky lg:top-10 shadow-[0_20px_50px_rgba(255,255,255,0.05)] border border-white/10">
                            <h3 class="text-black font-black uppercase tracking-[0.15em] md:tracking-[0.2em] text-[9px] md:text-[10px] mb-6 md:mb-8 border-b border-gray-100 pb-4">
                                Informasi Detail
                            </h3>

                            <div class="space-y-6 md:space-y-8">
                                @if($item->lokasi)
                                <div class="flex items-start gap-4 md:gap-5">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-red-50 rounded-xl md:rounded-2xl flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Alamat/Tempat</p>
                                        <p class="text-black font-bold text-xs md:text-sm uppercase leading-tight">{{ $item->lokasi }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($item->tanggal_event)
                                <div class="flex items-start gap-4 md:gap-5">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-red-50 rounded-xl md:rounded-2xl flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Waktu Pelaksanaan</p>
                                        <p class="text-black font-bold text-xs md:text-sm uppercase leading-tight">{{ $item->tanggal_event->format('d F Y') }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($item->kontak)
                                <div class="flex items-start gap-4 md:gap-5">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-red-50 rounded-xl md:rounded-2xl flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-[8px] md:text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Kontak Person</p>
                                        <p class="text-black font-bold text-xs md:text-sm uppercase leading-tight">{{ $item->kontak }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            @if($item->link_external)
                            <div class="mt-8 md:mt-12 pt-6 md:pt-8 border-t border-gray-100">
                                <a href="{{ $item->link_external }}" target="_blank" 
                                   class="flex items-center justify-center gap-2.5 md:gap-3 bg-red-600 text-white w-full py-4 md:py-5 rounded-[15px] md:rounded-[20px] font-black uppercase text-[9px] md:text-[10px] tracking-[0.15em] md:tracking-[0.2em] hover:bg-black transition-all duration-300 shadow-[0_10px_20px_rgba(220,38,38,0.25)] group active:scale-95">
                                    Kunjungi Sosial Media
                                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-10 text-center border-t border-white/5 bg-[#0b0e14]">
            <p class="text-[9px] md:text-[10px] font-bold text-gray-600 uppercase tracking-[0.4em] md:tracking-[0.5em]">&copy; 2026 Radio Kota Mataram.</p>
        </footer>
    </main>
@endsection