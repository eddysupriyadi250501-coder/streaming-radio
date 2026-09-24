<div>
    @php
        $streamingData = \Illuminate\Support\Facades\DB::table('streaming')
                                    ->where('kategori', 'live_youtube')
                                    ->first();
        $isLiveOnline = $streamingData && !empty($streamingData->link_eksternal);
        
        $thumbnailPath = null;
        if ($streamingData) {
            $thumbnailPath = $streamingData->thumbnail ?? ($streamingData->gambar ?? ($streamingData->image ?? null));
        }

        $youtubeUrl = 'https://www.youtube.com/@suarakota105fm9';
    @endphp

    <section class="relative z-10 pt-8 md:pt-12 pb-16 md:pb-24 px-4 sm:px-6 lg:px-24 bg-[#0b0e14]">
        <div class="max-w-7xl mx-auto">
            
            <div class="mb-10 md:mb-12 text-left">
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tighter text-white border-b-4 border-red-600 inline-block mb-3 md:mb-4">
                    Live YouTube <span class="text-red-600">& Podcast</span>
                </h2>
                <p class="text-gray-400 text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] block">
                    Saksikan Tayangan Interaktif & Obrolan Seru Suara Kota
                </p>
            </div>

            <div class="relative group flex flex-col gap-6 md:gap-8">
                
                @if($isLiveOnline)
                    {{-- ANCHOR: Kotak kosong tempat iframe global akan menempati posisi ini secara otomatis --}}
                    <div id="video-anchor" class="relative aspect-video w-full rounded-[20px] md:rounded-[30px] overflow-hidden bg-black/40 border border-white/5 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    </div>
                @else
                    <div class="relative bg-[#161b22] rounded-[20px] md:rounded-[30px] overflow-hidden aspect-video border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.6)] flex flex-col items-center justify-center text-center group">
                        @if($thumbnailPath)
                            <img src="{{ asset('storage/' . $thumbnailPath) }}" alt="Preview Offline" class="w-full h-full object-cover absolute inset-0 transform group-hover:scale-105 transition-transform duration-700 opacity-50">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/40 backdrop-blur-[3px] flex flex-col items-center justify-center p-6 sm:p-10">
                                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold uppercase tracking-widest mb-4 shadow-sm backdrop-blur-md">
                                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                    Siaran Offline
                                </div>
                                <h3 class="text-xl md:text-3xl font-black text-white uppercase tracking-tight mb-2 drop-shadow-lg">
                                    Belum Ada Siaran Langsung
                                </h3>
                                <p class="text-gray-300 text-xs md:text-sm max-w-lg font-medium drop-shadow mb-6 leading-relaxed">
                                    Saat ini studio belum memulai live streaming. Kunjungi channel YouTube resmi kami untuk menonton arsip video, podcast dan konten seru lainnya!
                                </p>
                                <a href="{{ $youtubeUrl }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-3.5 bg-red-600 hover:bg-red-700 text-white font-black text-xs md:text-sm uppercase tracking-wider rounded-xl transition-all shadow-xl shadow-red-600/30 hover:scale-105 border border-red-500/50">
                                    Kunjungi Channel
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if($isLiveOnline && $streamingData && (!empty($streamingData->judul) || !empty($streamingData->deskripsi)))
                <div class="bg-[#161b22] border border-white/5 rounded-[20px] md:rounded-[24px] p-6 md:p-8 shadow-xl">
                    @if(!empty($streamingData->judul))
                        <div class="flex items-center gap-3 md:gap-4 mb-3 md:mb-4">
                            <span class="relative flex h-3 w-3 md:h-4 md:w-4 shrink-0 mt-1 self-start">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 md:h-4 md:w-4 bg-red-600"></span>
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-500/10 text-red-500 border border-red-500/20">
                                LIVE NOW
                            </span>
                            <h3 class="text-xl md:text-3xl font-black text-white uppercase tracking-tight leading-tight">
                                {{ $streamingData->judul }}
                            </h3>
                        </div>
                    @endif
                    
                    @if(!empty($streamingData->deskripsi))
                        <div class="pl-6 md:pl-8 text-gray-400 text-xs md:text-sm font-medium leading-relaxed">
                            {!! nl2br(e($streamingData->deskripsi)) !!}
                        </div>
                    @endif
                </div>
                @endif

            </div>
        </div>  
    </section>
</div>