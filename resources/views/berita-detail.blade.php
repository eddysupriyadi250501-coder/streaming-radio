@extends('layouts.app')
@section('content')
    {{-- Mengubah judul tab browser secara dinamis tanpa mereload halaman --}}
    <script data-navigate-once>
        document.title = "{{ $berita->judul }} - Suara Kota";
    </script>

    <main wire:loading.class="opacity-50 transition-opacity duration-300">

        <article class="min-h-screen pt-8 md:pt-16 pb-20 px-5 sm:px-8 lg:px-0 max-w-3xl mx-auto">

            {{-- Tombol Kembali --}}
            <a href="{{ route('berita.index') }}" wire:navigate
                class="group inline-flex items-center text-gray-400 hover:text-white transition-colors text-[10px] md:text-[11px] font-bold uppercase tracking-[0.2em] mb-10 md:mb-14">
                <span class="mr-3 transform group-hover:-translate-x-2 transition-transform duration-300">←</span>
                Kembali ke Berita
            </a>

            <header class="mb-10 md:mb-12">
                {{-- Metadata: Kategori & Tanggal Sejajar --}}
                <div class="flex flex-wrap items-center gap-3 md:gap-4 mb-5 md:mb-6">
                    <span
                        class="bg-red-600/10 text-red-500 border border-red-500/20 px-3.5 py-1.5 rounded-full text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em]">
                        {{ $berita->kategori }}
                    </span>

                    <span
                        class="flex items-center gap-1.5 text-gray-500 text-[9px] md:text-[10px] font-bold uppercase tracking-widest">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $berita->created_at->translatedFormat('l, d F Y') }}
                    </span>
                </div>

                {{-- Judul Artikel --}}
                <h1
                    class="text-3xl sm:text-4xl md:text-5xl font-black uppercase tracking-tight leading-[1.15] text-white">
                    {{ $berita->judul }}
                </h1>
            </header>

            {{-- Gambar Utama (Hero Image) --}}
            <div
                class="relative w-full aspect-video rounded-[20px] md:rounded-[24px] overflow-hidden border border-white/5 shadow-[0_20px_50px_rgba(0,0,0,0.3)] mb-10 md:mb-14 bg-gray-900">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-full h-full object-cover"
                        alt="{{ $berita->judul }}">
                @else
                    <div
                        class="w-full h-full flex items-center justify-center text-gray-600 text-sm font-bold uppercase tracking-widest">
                        No Image Available
                    </div>
                @endif
            </div>

            {{-- Konten Artikel dengan Tailwind Typography --}}
            <div class="prose prose-invert prose-sm sm:prose-base md:prose-lg max-w-none 
                        prose-headings:font-black prose-headings:tracking-tight prose-headings:uppercase 
                        prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-6 
                        prose-a:text-red-500 hover:prose-a:text-red-400 prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-white prose-strong:font-bold
                        prose-img:rounded-[16px] prose-img:shadow-lg prose-img:mx-auto text-justify">

                @if($berita->isi_berita)
                    {!! $berita->isi_berita !!}
                @else
                    <p class="italic text-gray-500 text-center py-10 font-medium">Konten berita ini belum tersedia.</p>
                @endif
            </div>

            {{-- Bagian Share & Identitas (Footer Artikel) --}}
            <div
                class="mt-16 md:mt-24 pt-8 md:pt-10 border-t border-white/10 flex flex-col md:flex-row gap-8 items-center justify-between">

                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Bagikan :</span>
                    <div class="flex gap-2.5">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            target="_blank"
                            class="w-10 h-10 rounded-full bg-white/5 hover:bg-blue-600 transition-all flex items-center justify-center text-gray-400 hover:text-white border border-white/5 hover:border-blue-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(request()->fullUrl()) }}"
                            target="_blank"
                            class="w-10 h-10 rounded-full bg-white/5 hover:bg-black transition-all flex items-center justify-center text-gray-400 hover:text-white border border-white/5 hover:border-black">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}"
                            target="_blank"
                            class="w-10 h-10 rounded-full bg-white/5 hover:bg-green-600 transition-all flex items-center justify-center text-gray-400 hover:text-white border border-white/5 hover:border-green-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col items-center md:items-end text-center md:text-right">
                    <span
                        class="text-[10px] md:text-[11px] font-black text-red-600 uppercase tracking-[0.4em] italic mb-1.5">
                        SUARA KOTA 105.9 FM
                    </span>
                    <span class="text-gray-500 text-[8px] md:text-[9px] font-bold uppercase tracking-[0.3em] italic">
                        Suara Rakyat Mataram
                    </span>
                </div>
            </div>

        </article>
    </main>

    <div id="floating-video" class="fixed bottom-5 right-5 z-[9999] hidden">
        <div id="floating-container"></div>
    </div>

    {{-- Footer Bawah Halaman --}}
    <footer class="bg-[#07090d] py-12 md:py-16 text-center border-t border-white/5 px-6 mt-10">
        <div class="max-w-7xl mx-auto">
            <div class="text-xl md:text-2xl font-black tracking-[0.2em] uppercase mb-4 text-white italic">
                SUARA<span class="text-red-600">KOTA</span>
            </div>
            <p
                class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.4em] md:tracking-[0.6em] text-gray-700 leading-relaxed">
                © 2026 SUARA KOTA MATARAM - ALL RIGHTS RESERVED
            </p>
        </div>
    </footer>
@endsection