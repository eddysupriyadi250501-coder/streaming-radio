<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Publik - Radio Kota Mataram</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
  
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0b0e14; }
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
</head>
<body class="bg-[#0b0e14] text-white antialiased selection:bg-red-600 selection:text-white">

    <div class="min-h-screen pt-12 md:pt-24 pb-20 md:pb-32 px-5 sm:px-8 lg:px-24">
        <div class="max-w-7xl mx-auto">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('landing') }}" wire:navigate class="inline-flex items-center gap-3 bg-white/5 border border-white/10 hover:bg-red-600 hover:border-red-600 text-gray-400 hover:text-white font-black uppercase text-[9px] md:text-[10px] tracking-[0.2em] md:tracking-[0.3em] mb-10 md:mb-12 px-5 py-2.5 rounded-full transition-all duration-300 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Beranda
            </a>

            {{-- Header --}}
            <div class="mb-12 md:mb-16">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white uppercase tracking-tighter mb-4 md:mb-5 leading-none">
                    Layanan <span class="text-red-600">Publik</span>
                </h1>
                <div class="flex items-start gap-4 max-w-xl">
                    <span class="h-1 w-12 bg-red-600 mt-2 shrink-0 rounded-full"></span>
                    <p class="text-gray-400 text-xs md:text-sm leading-relaxed font-medium">
                        Pusat akses cepat untuk layanan darurat dan portal pengaduan resmi di Kota Mataram.
                    </p>
                </div>
            </div>

            {{-- Grid Layanan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($layanans as $item)
                
                <div class="group bg-[#e9ecef] rounded-[24px] md:rounded-[35px] overflow-hidden border border-transparent hover:border-red-500/20 shadow-lg hover:shadow-[0_20px_50px_rgba(255,255,255,0.05)] transition-all duration-500 flex flex-col min-h-[320px] md:min-h-[350px] relative">
                    
                    <div class="p-6 md:p-8 flex flex-col flex-grow text-black">
                        
                        {{-- Kategori Badge --}}
                        <div class="mb-5 md:mb-6">
                            <span class="bg-red-600/10 text-red-600 border border-red-600/20 text-[8px] md:text-[9px] font-black px-4 py-1.5 md:py-2 rounded-full uppercase tracking-widest shadow-sm">
                                {{ str_replace('_', ' ', $item->kategori) }}
                            </span>
                        </div>

                        {{-- Judul --}}
                        <h3 class="text-xl md:text-2xl font-black uppercase leading-[1.1] mb-3 group-hover:text-red-600 transition-colors line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                        
                        {{-- Deskripsi --}}
                        <div class="flex-grow">
                            <p class="text-gray-600 text-[11px] md:text-xs leading-relaxed mb-6 md:mb-8 line-clamp-3 md:line-clamp-4 font-medium">
                                {{ strip_tags(str_replace('&nbsp;', ' ', $item->deskripsi)) }}
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-auto pt-5 md:pt-6 border-t border-gray-300/50">
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $item->nomor_telepon);
                                $waLinkNumber = $cleanPhone;
                                if (strpos($waLinkNumber, '0') === 0) {
                                    $waLinkNumber = '62' . substr($waLinkNumber, 1);
                                }
                                $linkWA = "https://wa.me/" . $waLinkNumber . "?text=" . rawurlencode("Halo, saya butuh bantuan mengenai: " . $item->judul);
                            @endphp

                            @if($item->kategori === 'call_center')
                                <div class="grid {{ $item->tipe_kontak === 'both' ? 'grid-cols-2' : 'grid-cols-1' }} gap-2.5 md:gap-3">
                                    @if($item->tipe_kontak === 'wa' || $item->tipe_kontak === 'both')
                                        <a href="{{ $linkWA }}" target="_blank" rel="noopener noreferrer"
                                           class="flex items-center justify-center gap-1.5 md:gap-2 bg-[#25D366] text-white py-3.5 md:py-4 px-2 rounded-[14px] hover:bg-[#20ba5a] transition-all active:scale-95 shadow-md shadow-green-500/20">
                                            <span class="font-black text-[9px] md:text-[10px] uppercase tracking-widest">WhatsApp</span>
                                        </a>
                                    @endif

                                    @if($item->tipe_kontak === 'tel' || $item->tipe_kontak === 'both')
                                        <a href="tel:{{ $cleanPhone }}" 
                                           class="flex items-center justify-center gap-1.5 md:gap-2 bg-black text-white py-3.5 md:py-4 px-2 rounded-[14px] hover:bg-red-600 transition-all active:scale-95 shadow-md">
                                            <span class="font-black text-[9px] md:text-[10px] uppercase tracking-widest">Telepon</span>
                                        </a>
                                    @endif
                                </div>
                            @else
                                <a href="{{ $item->link_external ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center justify-center gap-3 bg-black text-white py-4 px-6 rounded-[14px] hover:bg-red-600 transition-all active:scale-95 shadow-md group/btn">
                                    <span class="font-black text-[9px] md:text-[10px] uppercase tracking-[0.15em] md:tracking-[0.2em]">Kunjungi Portal</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center border-2 border-dashed border-white/10 rounded-[30px] bg-white/5">
                    <p class="text-gray-500 font-bold uppercase tracking-[0.4em] text-[10px] md:text-xs">Data layanan belum tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- KUBAH RADIO (PERSIST) --}}
    @php
        $radioData = \App\Models\Streaming::where('kategori', 'live_radio')->first();
    @endphp

    @if($radioData && !empty($radioData->link_eksternal))
        @persist('radio-suara-kota')
            <div class="fixed bottom-0 right-0 z-[9999] p-4 bg-black/80 rounded-tl-xl border-t border-l border-red-600/30">
                <audio id="main-audio" src="{{ $radioData->link_eksternal }}" preload="none" controls class="h-8 w-64"></audio>
            </div>
        @endpersist
    @endif

    @livewireScripts
</body>
</html>