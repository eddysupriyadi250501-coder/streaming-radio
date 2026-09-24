@extends('layouts.app')

@section('content')
    <main class="min-h-screen pt-12 md:pt-20 pb-20 px-5 sm:px-8 lg:px-24">
        <div class="max-w-7xl mx-auto">
            
            <!-- Tombol Kembali -->
            <div class="mb-10 md:mb-12">
                <a href="{{ url('/') }}" wire:navigate
                   class="group inline-flex items-center text-gray-400 hover:text-white transition-colors duration-300 font-bold text-[10px] md:text-[11px] uppercase tracking-[0.2em] md:tracking-[0.3em]">
                    <span class="mr-3 transform group-hover:-translate-x-2 transition-transform duration-300">←</span>
                    Kembali Ke Beranda
                </a>
            </div>
            
            <!-- Hero Section (Tetap Gelap) -->
            <div class="max-w-3xl mb-12 md:mb-20">
                <p class="text-red-600 text-[10px] md:text-[11px] font-black uppercase tracking-[0.3em] md:tracking-[0.4em] mb-3 md:mb-4">Informasi Terkini</p>
                <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tighter mb-5 md:mb-6 leading-[1.1] md:leading-none">
                    Semua Kegiatan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-rose-400">Sekolah Kita</span>
                </h1>
                <div class="w-16 md:w-20 h-1 md:h-1.5 bg-red-600 mb-6 md:mb-8 rounded-full"></div>
                <p class="text-gray-400 text-xs md:text-sm lg:text-base font-medium leading-relaxed max-w-xl">
                    Eksplorasi seluruh dokumentasi prestasi, kegiatan rutin, dan kreativitas siswa-siswi terbaik di wilayah Mataram.
                </p>
            </div>

            <!-- Activities Grid (CARD PUTIH) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @forelse($SekolahKita as $activity)
                
                <a href="{{ route('sekolah.show', $activity->id) }}" wire:navigate
                     class="group bg-white rounded-[24px] md:rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 shadow-lg hover:shadow-[0_20px_50px_rgba(220,38,38,0.15)] flex flex-col cursor-pointer relative z-10">
                    
                    <!-- Thumbnail -->
                    <div class="relative h-52 md:h-60 overflow-hidden shrink-0">
                        @if($activity->gambar)
                            <img src="{{ asset('storage/' . $activity->gambar) }}"  wire:navigate
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 alt="{{ $activity->judul }}">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-[10px] font-black uppercase tracking-[0.3em]">
                                NO IMAGE
                            </div>
                        @endif
                        
                        <!-- Overlay gradient tipis untuk mempertegas gambar -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Badge Kategori -->
                        <div class="absolute top-4 left-4 md:top-5 md:left-5 z-20">
                            <span class="bg-red-600 text-white text-[8px] md:text-[9px] font-black uppercase px-3.5 md:px-4 py-1.5 md:py-2 rounded-[10px] tracking-[0.15em] shadow-md">
                                {{ $activity->kategori }}
                            </span>
                        </div>
                    </div>

                    <!-- Details (Teks diubah menjadi gelap) -->
                    <div class="p-6 md:p-8 flex flex-col flex-grow bg-white">
                        
                        <!-- Asal Sekolah -->
                        <div class="flex items-center space-x-2.5 mb-3 md:mb-4">
                            <div class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></div>
                            <p class="text-gray-500 text-[9px] md:text-[10px] font-bold uppercase tracking-widest truncate group-hover:text-red-600 transition-colors duration-300">
                                {{ $activity->asal_sekolah }}
                            </p>
                        </div>
                        
                        <!-- Judul -->
                        <h3 class="text-gray-900 font-black text-lg md:text-xl mb-6 leading-tight line-clamp-2 uppercase group-hover:text-red-600 transition-colors duration-300">
                            {{ $activity->judul }}
                        </h3>

                        <!-- Tombol Selengkapnya -->
                        <div class="mt-auto pt-5 border-t border-gray-100 flex items-center justify-between group/link">
                            <span class="text-red-600 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] transition-colors">
                                Selengkapnya
                            </span>
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center group-hover/link:bg-red-600 transition-all duration-300 shadow-sm">
                                <svg class="w-3.5 h-3.5 text-gray-900 group-hover/link:text-white transform group-hover/link:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                
                @empty
                <!-- Empty State -->
                <div class="col-span-full py-20 text-center border-2 border-dashed border-white/10 rounded-[2rem] bg-white/5">
                    <p class="text-gray-500 uppercase font-black tracking-[0.4em] text-xs">Belum ada kegiatan yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>

            <!-- Navigation -->
            @if(method_exists($SekolahKita, 'links') && $SekolahKita->hasPages())
            <div class="mt-20 flex justify-center">
                <div class="inline-block p-2 bg-[#161b22] rounded-2xl border border-white/5">
                    {{ $SekolahKita->links() }}
                </div>
            </div>
            @endif
            
        </div>
    </main>

    <footer class="bg-black py-10 px-6 border-t border-white/5 text-center relative z-20">
        <p class="text-[9px] md:text-[10px] font-bold uppercase tracking-[0.4em] md:tracking-[0.6em] text-gray-700 leading-relaxed">
            &copy; 2026 RADIO KOTA MATARAM.
        </p>
    </footer>
@endsection