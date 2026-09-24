@extends('layouts.app')

@section('content')
    {{-- Mengubah judul tab browser secara dinamis --}}
    <script data-navigate-once>
        document.title = "{{ $activity->judul }} - Radio Kota Mataram";
    </script>

    {{-- CSS Khusus untuk halaman Detail Sekolah --}}
    <style>
        .text-shadow-red {
            text-shadow: 0 0 30px rgba(220, 38, 38, 0.4);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .bg-glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(220, 38, 38, 0.15);
            filter: blur(100px);
            border-radius: 50%;
            z-index: -1;
        }
    </style>

    <div class="text-gray-200 relative">
        <!-- Efek Glow Latar Belakang -->
        <div class="bg-glow top-0 -left-20 md:top-20 md:-left-20"></div>
        <div class="bg-glow bottom-20 -right-20 hidden md:block"></div>

        <div class="min-h-screen py-10 md:py-24">
            <div class="container mx-auto px-5 sm:px-8 max-w-6xl">

                <div class="mb-10 md:mb-12">
                    {{-- Tombol Kembali dengan wire:navigate --}}
                    <a href="{{ route('sekolah.index') }}" wire:navigate
                        class="inline-flex items-center gap-3 bg-white/5 border border-white/10 hover:bg-red-600 hover:border-red-600 text-gray-400 hover:text-white font-black uppercase text-[9px] md:text-[10px] tracking-[0.2em] md:tracking-[0.3em] mb-10 md:mb-12 px-5 py-2.5 rounded-full transition-all duration-300 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali Ke Kegiatan
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-16 items-start lg:items-center">

                    <div class="lg:col-span-5 order-1">
                        <div class="relative group mx-auto max-w-sm md:max-w-none">
                            <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-red-900 rounded-[2rem] md:rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition duration-1000 hidden md:block"></div>
                            
                            <div class="relative rounded-[1.5rem] md:rounded-[2.2rem] overflow-hidden shadow-2xl border border-white/5 bg-[#161b22]">
                                @if($activity->gambar)
                                    <img src="{{ asset('storage/' . $activity->gambar) }}" 
                                         class="w-full h-auto aspect-[4/5] md:aspect-auto object-cover transform group-hover:scale-105 transition duration-700"
                                         alt="{{ $activity->judul }}">
                                @else
                                    <div class="h-64 md:h-80 flex items-center justify-center text-gray-600 font-bold uppercase tracking-widest text-xs not-italic bg-black/50">
                                        No Image Preview
                                    </div>
                                @endif

                                <div class="absolute bottom-4 right-4 md:bottom-6 md:right-6">
                                    <span class="bg-red-600/95 backdrop-blur-md text-white text-[8px] md:text-[9px] font-black uppercase px-4 md:px-5 py-2 rounded-full shadow-lg tracking-[0.2em]">
                                        {{ $activity->kategori }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-7 order-2">
                        <div class="space-y-8 md:space-y-10 text-center lg:text-left">
                            
                            <div class="space-y-4 md:space-y-5">
                                <div class="flex items-center justify-center lg:justify-start space-x-3 md:space-x-4">
                                    <div class="h-[2px] w-8 md:w-12 bg-red-600"></div>
                                    <p class="text-red-500 text-[10px] md:text-[11px] font-black uppercase tracking-[0.2em] md:tracking-[0.3em]">
                                        {{ $activity->asal_sekolah }}
                                    </p>
                                    <div class="h-[2px] w-8 bg-red-600 lg:hidden"></div> 
                                </div>

                                <h1 class="text-white text-3xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tighter text-shadow-red leading-[1.1] md:leading-[1] not-italic">
                                    {{ $activity->judul }}
                                </h1>
                            </div>

                            @if($activity->prestasi)
                                <div class="glass-card p-6 md:p-8 rounded-[1.2rem] md:rounded-[1.5rem] border-l-[4px] md:border-l-[6px] border-red-600 relative overflow-hidden text-left shadow-xl">
                                    <div class="absolute top-0 right-0 p-4 opacity-5">
                                        <svg class="w-12 h-12 md:w-16 md:h-16 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    </div>
                                    <h4 class="text-red-500 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] mb-2 md:mb-3">Prestasi Yang Diraih</h4>
                                    <p class="text-white text-lg md:text-xl font-semibold leading-snug">
                                        {{ $activity->prestasi }}
                                    </p>
                                </div>
                            @endif

                            <div class="space-y-4 md:space-y-5 text-left">
                                <h4 class="text-gray-500 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] md:tracking-[0.3em] flex items-center">
                                    <span class="mr-3">Keterangan</span>
                                    <div class="flex-grow h-[1px] bg-white/10"></div>
                                </h4>
                                
                                <div class="prose prose-invert prose-sm md:prose-base max-w-none text-gray-300 text-justify font-medium leading-relaxed">
                                    {!! $activity->deskripsi !!}
                                </div>
                            </div>

                            <div class="pt-6 md:pt-8 flex justify-center lg:justify-start items-center border-t border-white/10">
                                <div class="bg-white/5 p-2.5 md:p-3 rounded-full mr-3 md:mr-4">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="text-[9px] md:text-[10px] uppercase tracking-[0.15em] md:tracking-[0.2em] text-left">
                                    <p class="text-gray-500 font-bold mb-0.5">Dipublikasikan</p>
                                    <p class="text-white font-black">{{ $activity->created_at->format('d F Y') }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer class="py-10 text-center border-t border-white/5 bg-[#07090d]">
            <p class="text-[9px] md:text-[10px] font-bold text-gray-600 uppercase tracking-[0.4em] md:tracking-[0.6em]">&copy; 2026 Radio Kota Mataram.</p>
        </footer>
    </div>
@endsection