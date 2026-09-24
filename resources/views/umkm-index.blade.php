@extends('layouts.app')

@section('content')
    <!-- CDN FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <header class="relative pt-16 md:pt-24 pb-12 px-5 sm:px-8 lg:px-24 text-center overflow-hidden bg-[#0b0e14]">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-red-600/20 blur-[120px] pointer-events-none"></div>
        <div class="max-w-6xl mx-auto relative z-10">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black tracking-tighter mb-4 uppercase leading-[1.1]">
                Etalase Produk <br class="block sm:hidden">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-rose-400">UMKM Lokal</span>
            </h1>
            <p class="text-gray-400 max-w-xl mx-auto text-xs md:text-sm font-medium leading-relaxed">
                Dukung produk lokal! Telusuri industri kreatif mulai dari Kuliner, Fashion, hingga Kriya terbaik Kota Mataram.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-24 py-6 md:py-10 w-full min-h-screen relative z-10">

        <!-- Tombol Kembali (wire:navigate) -->
        <div class="mb-8 md:mb-10 w-full flex justify-start">
            <a href="{{ url('/') }}" wire:navigate
               class="group inline-flex items-center justify-center px-5 md:px-6 py-2.5 md:py-3 bg-[#161b22] border border-white/5 hover:bg-red-600 hover:border-red-600 text-gray-400 hover:text-white font-black uppercase text-[9px] md:text-[10px] tracking-[0.2em] rounded-full transition-all duration-300 shadow-lg active:scale-95">
                <svg class="w-3.5 h-3.5 mr-2.5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <!-- Filter Kategori -->
        <div class="flex items-center gap-3 mb-10 md:mb-12 w-full overflow-x-auto no-scrollbar snap-x snap-mandatory pb-4">
            
            <button onclick="filterKategori('all')" id="btn-all"
                class="btn-filter shrink-0 snap-start bg-red-600 text-white border border-red-600 px-5 md:px-6 py-2.5 md:py-3 rounded-full font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all duration-300 shadow-[0_4px_15px_rgba(220,38,38,0.4)]">
                <i class="fa-solid fa-bag-shopping mr-2"></i>Semua Produk
            </button>

            @foreach($listKategori as $kat)
                <button onclick="filterKategori('{{ Str::slug($kat) }}')" id="btn-{{ Str::slug($kat) }}"
                    class="btn-filter shrink-0 snap-start bg-[#161b22] text-gray-400 border border-white/5 px-5 md:px-6 py-2.5 md:py-3 rounded-full font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all duration-300 hover:border-red-500/30 hover:text-white">
                    {{ $kat }}
                </button>
            @endforeach
        </div>

        <!-- GRID KARTU UMKM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 w-full" id="grid-data">
            @forelse($semuaData as $item)
                
                {{-- Kartu dengan wire:navigate --}}
                <a href="{{ route('umkm.show', $item->id) }}" wire:navigate
                   class="card-item group bg-white rounded-[20px] md:rounded-[24px] shadow-lg overflow-hidden border border-transparent hover:border-red-100 transform transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_20px_50px_rgba(255,255,255,0.08)] w-full flex flex-col"
                   data-category="{{ Str::slug($item->kategori) }}">

                    <div class="relative h-48 md:h-52 w-full shrink-0 p-2.5 md:p-3">
                        <div class="w-full h-full overflow-hidden rounded-[14px] md:rounded-[16px] bg-gray-100 relative">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_usaha }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 flex-col gap-2">
                                    <i class="fa-regular fa-image text-3xl"></i>
                                    <span class="text-[8px] font-black uppercase tracking-widest">No Image</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <span class="absolute top-5 left-5 md:top-6 md:left-6 bg-red-600 text-white text-[8px] md:text-[9px] font-black px-3.5 py-1.5 rounded-full uppercase tracking-widest shadow-md">
                            {{ $item->kategori }}
                        </span>
                    </div>

                    <div class="p-5 md:p-6 pt-3 flex flex-col flex-grow">
                        <h3 class="text-lg md:text-xl font-black text-slate-900 line-clamp-1 mb-2.5 uppercase group-hover:text-red-600 transition-colors leading-tight">
                            {{ $item->nama_usaha }}
                        </h3>
                        
                        <p class="text-slate-600 text-[11px] md:text-xs leading-relaxed line-clamp-2 md:line-clamp-3 mb-5 font-medium">
                            {{ str_replace('&nbsp;', ' ', strip_tags($item->deskripsi)) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                            @if($item->maps_url)
                                <div class="text-slate-500 text-[9px] md:text-[10px] font-bold flex items-center gap-1.5 uppercase tracking-widest">
                                    <i class="fa-solid fa-map-location-dot text-red-500"></i> Ada Peta
                                </div>
                            @else
                                <div class="text-slate-400 text-[9px] font-bold flex items-center gap-1.5 uppercase tracking-widest italic">
                                    Peta Belum Ada
                                </div>
                            @endif

                            <div class="inline-flex items-center gap-1.5 text-red-600 text-[9px] md:text-[10px] font-black uppercase tracking-widest transition-colors">
                                Lihat <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1.5 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-20 bg-[#161b22] rounded-[30px] border-2 border-dashed border-white/10 shadow-xl">
                    <div class="text-gray-600 mb-4"><i class="fa-solid fa-boxes-dashed text-4xl"></i></div>
                    <p class="text-gray-500 font-bold uppercase tracking-[0.3em] text-[10px] md:text-xs">Belum ada produk UMKM.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-black py-12 px-6 border-t border-white/5 text-center mt-10">
        <div class="text-xl md:text-2xl font-black tracking-[0.2em] uppercase mb-4 text-white italic">
            SUARA<span class="text-red-600">KOTA</span>
        </div>
        <p class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.4em] md:tracking-[0.6em] text-gray-700 leading-relaxed">&copy; 2026 Radio Kota Mataram. All Rights Reserved.</p>
    </footer>

    <script>
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
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Re-inisialisasi filter kategori saat pindah halaman dengan wire:navigate
        document.addEventListener('livewire:navigated', () => {
            filterKategori('all');
        });
    </script>
@endsection