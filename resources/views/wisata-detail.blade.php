@extends('layouts.app')

@section('content')
    {{-- Mengubah judul tab browser secara dinamis --}}
    <script data-navigate-once>
        document.title = "{{ $item->nama_lokasi ?? $item->nama_wisata }} - Radio Kota Mataram";
    </script>

    <div class="min-h-screen pt-10 md:pt-20 pb-16 md:pb-20 px-5 sm:px-8 lg:px-24">
        <div class="max-w-7xl mx-auto">
            
            {{-- Tombol Kembali --}}
            <div class="mb-8 md:mb-10">
                <a href="{{ route('wisata.index') }}" wire:navigate 
                   class="group inline-flex items-center text-gray-400 hover:text-white transition-all duration-300 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.2em] md:tracking-[0.3em]">
                    <span class="mr-3 transform group-hover:-translate-x-2 transition-transform duration-300">←</span>
                    Kembali Ke Daftar
                </a>
            </div>

            {{-- Card Utama Putih --}}
            <div class="bg-[#f4f6f8] rounded-[24px] lg:rounded-[50px] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col lg:flex-row min-h-[auto] lg:min-h-[600px]">
                
                {{-- SISI KIRI: Gambar --}}
                <div class="lg:w-1/2 relative h-80 sm:h-96 lg:h-auto overflow-hidden shrink-0">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" alt="Foto Lokasi">
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-500 font-black uppercase tracking-widest text-[10px]">
                            No Image Available
                        </div>
                    @endif
                    
                    {{-- Badge Kategori --}}
                    <div class="absolute top-4 left-4 md:top-8 md:left-8">
                        <span class="bg-red-600 text-white text-[8px] md:text-[10px] font-black px-4 md:px-6 py-2 md:py-3 rounded-full uppercase tracking-[0.2em] shadow-xl">
                            {{ $item->kategori ?? $item->kategori_tempat }}
                        </span>
                    </div>
                </div>

                {{-- SISI KANAN: Konten --}}
                <div class="lg:w-1/2 p-6 sm:p-10 lg:p-16 flex flex-col justify-start">
                    
                    {{-- Judul --}}
                    <div class="mb-8 md:mb-10">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black uppercase tracking-tighter leading-[1.1] text-slate-900 mb-4 md:mb-5">
                            {{ $item->nama_lokasi ?? $item->nama_wisata }}
                        </h1>
                        <div class="w-16 md:w-20 h-1.5 md:h-2 bg-red-600 rounded-full"></div>
                    </div>
                    
                    {{-- LOGIKA KONDISI: Kotak Hitam Hanya Muncul Jika Bukan Tongkrongan --}}
                    @php
                        // Menentukan kategori huruf kecil untuk pengecekan
                        $kategoriSekarang = strtolower($item->kategori ?? $item->kategori_tempat);
                    @endphp

                    @if(!Str::contains($kategoriSekarang, 'tongkrongan'))
                        <div class="flex flex-col sm:flex-row gap-4 mb-8">
                            {{-- Harga Tiket --}}
                            <div class="bg-[#161b22] rounded-2xl p-5 flex-1 text-white shadow-lg flex items-center gap-4">
                                <div class="w-10 h-10 bg-red-600/20 rounded-xl flex items-center justify-center text-red-500 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[8px] font-black uppercase tracking-widest mb-1">Harga Tiket</p>
                                    <p class="font-bold text-sm">{{ $item->harga_tiket ?? 'Hubungi Pengelola' }}</p>
                                </div>
                            </div>

                            {{-- Jam Operasional --}}
                            <div class="bg-[#161b22] rounded-2xl p-5 flex-1 text-white shadow-lg flex items-center gap-4">
                                <div class="w-10 h-10 bg-red-600/20 rounded-xl flex items-center justify-center text-red-500 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[8px] font-black uppercase tracking-widest mb-1">Jam Operasional</p>
                                    <p class="font-bold text-sm">{{ $item->jam_operasional ?? 'Setiap Hari' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Deskripsi --}}
                    <div class="mb-8 md:mb-10">
                        <h4 class="text-gray-400 text-[9px] font-black uppercase tracking-widest mb-3 md:mb-4">Deskripsi</h4>
                        <div class="prose prose-sm max-w-none text-slate-600 font-medium leading-relaxed text-justify">
                            {!! $item->deskripsi !!}
                        </div>
                    </div>

                    {{-- Google Maps (Muncul jika link map diisi) --}}
                    @php
                        $linkMaps = $item->link_google_maps ?? $item->maps_url;
                    @endphp

                    @if(!empty($linkMaps))
                        <div class="mt-auto">
                            <div class="flex items-center gap-3 mb-4 md:mb-5">
                                <h4 class="text-red-600 text-[9px] md:text-[10px] font-black uppercase tracking-widest">Lokasi Map</h4>
                                <div class="h-[1px] flex-grow bg-gray-200"></div>
                            </div>
                            
                            <div class="w-full h-48 md:h-56 rounded-[16px] md:rounded-[20px] overflow-hidden border border-gray-200 shadow-inner bg-gray-100">
                                <iframe 
                                    width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen 
                                    src="{{ $linkMaps }}">
                                </iframe>
                            </div>
                            
                            @if(!empty($item->lokasi))
                                <p class="mt-3 text-center text-slate-500 text-[9px] md:text-[10px] font-bold uppercase tracking-widest flex items-center justify-center gap-1.5">
                                    <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    {{ $item->lokasi }}
                                </p>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
            
            <div class="mt-12 md:mt-16 text-center opacity-30">
                <p class="text-[8px] md:text-[9px] font-black text-white uppercase tracking-[0.4em] md:tracking-[0.5em]">&copy; 2026 Radio Kota Mataram.</p>
            </div>
        </div>
    </div>
@endsection