@extends('layouts.app')

@section('content')
    {{-- Mengubah judul tab browser secara dinamis tanpa mereload halaman --}}
    <script data-navigate-once>
        document.title = "{{ $item->nama_usaha }} - Radio Kota Mataram";
    </script>

    <div class="min-h-screen pt-10 md:pt-20 pb-16 md:pb-20 px-5 sm:px-8 lg:px-24">
        <div class="max-w-7xl mx-auto">
            
            {{-- Tombol Kembali (wire:navigate) --}}
            <div class="mb-8 md:mb-10">
                <a href="{{ route('umkm.index') }}" wire:navigate 
                   class="group inline-flex items-center text-gray-400 hover:text-white transition-all duration-300 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.2em] md:tracking-[0.3em]">
                    <span class="mr-3 transform group-hover:-translate-x-2 transition-transform duration-300">←</span>
                    Kembali Ke Daftar
                </a>
            </div>

            {{-- Card Utama Putih --}}
            <div class="bg-[#f4f6f8] rounded-[24px] lg:rounded-[50px] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col lg:flex-row min-h-[auto] lg:min-h-[600px]">
                
                {{-- Sisi Gambar --}}
                <div class="lg:w-1/2 relative h-64 sm:h-80 lg:h-auto overflow-hidden shrink-0">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" alt="{{ $item->nama_usaha }}">
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-500 font-black uppercase tracking-widest text-[10px]">
                            No Image Available
                        </div>
                    @endif
                    
                    <div class="absolute top-4 left-4 md:top-8 md:left-8">
                        <span class="bg-red-600 text-white text-[8px] md:text-[10px] font-black px-4 md:px-6 py-2 md:py-3 rounded-full uppercase tracking-[0.2em] shadow-xl">
                            {{ $item->kategori }}
                        </span>
                    </div>
                </div>

                {{-- Sisi Konten --}}
                <div class="lg:w-1/2 p-6 sm:p-10 lg:p-16 flex flex-col justify-center">
                    
                    <div class="mb-8 md:mb-10">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black uppercase tracking-tighter leading-[1.1] text-slate-900 mb-4 md:mb-5">
                            {{ $item->nama_usaha }}
                        </h1>
                        <div class="w-16 md:w-20 h-1.5 md:h-2 bg-red-600 rounded-full"></div>
                    </div>
                    
                    <div class="space-y-6 md:space-y-8 mb-8 md:mb-10 text-slate-800">
                        {{-- Pemilik --}}
                        <div class="flex items-center gap-4 md:gap-6">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-md border border-gray-100 text-red-600 shrink-0">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2.5"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-[8px] md:text-[9px] font-black uppercase tracking-widest mb-0.5 md:mb-1">Owner / Pemilik</p>
                                <p class="text-lg md:text-xl font-extrabold uppercase tracking-tight text-slate-900 leading-tight">{{ $item->pemilik }}</p>
                            </div>
                        </div>

                        {{-- WhatsApp --}}
                        <div class="flex items-center gap-4 md:gap-6">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-md border border-gray-100 text-red-600 shrink-0">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2.5"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-[8px] md:text-[9px] font-black uppercase tracking-widest mb-0.5 md:mb-1">WhatsApp / Hotline</p>
                                <p class="text-lg md:text-xl font-extrabold text-slate-900 leading-tight">{{ $item->no_hp }}</p>
                            </div>
                        </div>

                        {{-- Instagram --}}
                        @if($item->instagram)
                        <div class="flex items-center gap-4 md:gap-6">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-md border border-gray-100 text-red-600 shrink-0">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" stroke-width="2.5"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-[8px] md:text-[9px] font-black uppercase tracking-widest mb-0.5 md:mb-1">Instagram Resmi</p>
                                <a href="https://instagram.com/{{ str_replace('@', '', $item->instagram) }}" target="_blank" class="text-lg md:text-xl font-extrabold text-slate-900 hover:text-red-600 transition-colors leading-tight">
                                    @ {{ str_replace('@', '', $item->instagram) }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Deskripsi UMKM --}}
                    <div class="border-t border-gray-200 pt-6 md:pt-8 mb-8 md:mb-10">
                        <h4 class="text-gray-400 text-[9px] font-black uppercase tracking-widest mb-3 md:mb-4">Deskripsi Usaha</h4>
                        <div class="prose prose-sm md:prose-base max-w-none text-slate-600 font-medium leading-relaxed prose-p:mb-4 text-justify">
                            {!! $item->deskripsi !!}
                        </div>
                    </div>

                    {{-- Google Maps --}}
                    @if(!empty($item->maps_url))
                    <div class="mt-auto">
                        <div class="flex items-center gap-3 mb-4 md:mb-5">
                            <h4 class="text-red-600 text-[9px] md:text-[10px] font-black uppercase tracking-widest">Lokasi Toko / Usaha</h4>
                            <div class="h-[1px] flex-grow bg-gray-200"></div>
                        </div>
                        
                        <div class="w-full h-48 md:h-64 rounded-[16px] md:rounded-[20px] overflow-hidden border border-gray-200 shadow-inner bg-gray-100">
                            <iframe 
                                width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen 
                                src="{{ $item->maps_url }}">
                            </iframe>
                        </div>
                        
                        @if($item->alamat)
                        <p class="mt-3 text-center text-slate-500 text-[9px] md:text-[10px] font-bold uppercase tracking-widest flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $item->alamat }}
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