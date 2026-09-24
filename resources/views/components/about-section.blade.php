@extends('layouts.app')

@section('content')
    {{-- Mengubah judul tab browser secara dinamis --}}
    <script data-navigate-once>
        document.title = "Tentang Kami - Radio Kota Mataram";
    </script>

    <section id="about-us" class="py-20 px-6 md:px-24 bg-[#0b0e14] text-white relative min-h-screen">
        <div class="max-w-6xl mx-auto pt-10 md:pt-16">
            
            <div class="mb-12 flex justify-start">
                <a href="/" wire:navigate class="group flex items-center gap-3 bg-white text-black px-6 py-2.5 rounded-full font-black uppercase text-xs tracking-widest hover:bg-gray-200 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.1)] active:scale-95">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="text-center mb-16">
                <h1 class="text-3xl font-black uppercase tracking-widest not-italic">
                    RADIO KOTA <span class="text-red-600">105.9 FM</span>
                </h1>
                <div class="w-20 h-1 bg-red-600 mx-auto mt-2"></div>
            </div>

            <div class="bg-[#161b22] p-8 rounded-2xl border border-white/5 mb-12 text-center shadow-lg">
                <h2 class="text-red-600 font-bold text-xl mb-4 flex justify-center items-center gap-2 not-italic uppercase">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg>
                    Siapa Kami
                </h2>
                <p class="text-gray-400 leading-relaxed max-w-4xl mx-auto">
                   Radio Suara Kota Mataram berfungsi sebagai media informasi, pendidikan, hiburan yang sehat, kontrol sosial, serta sarana untuk melestarikan budaya bangsa dan kearifan lokal khususnya di wilayah Kota Mataram.
                </p>
            </div>

            <div class="text-center mb-10">
                <h2 class="text-2xl font-black uppercase not-italic">Visi & Misi</h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-2"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-20">
                <div class="bg-[#161b22] p-8 rounded-2xl border border-white/5 text-center flex flex-col justify-center">
                    <h3 class="text-red-600 font-bold mb-4 uppercase tracking-widest not-italic">◎ Visi</h3>
                    <p class="text-gray-300">"Menjadi Lembaga Penyiaran Publik Lokal yang Terpercaya, Edukatif, dan Inovatif dalam Mewujudkan Masyarakat Kota Mataram yang Cerdas dan Berbudaya."</p>
                </div>
                <div class="bg-[#161b22] p-8 rounded-2xl border border-white/5">
                    <h3 class="text-red-600 font-bold mb-4 text-center uppercase tracking-widest not-italic">◎ Misi</h3>
                    <ul class="text-gray-400 space-y-3 text-left">
                        <li class="flex items-start gap-3"><span class="text-red-600">♫</span> Menyajikan informasi pembangunan dan pelayanan publik di Kota Mataram secara akurat dan transparan.</li>
                        <li class="flex items-start gap-3"><span class="text-red-600">♫</span> Menjadi media edukasi yang mengangkat nilai-nilai budaya lokal dan kearifan masyarakat.</li>
                        <li class="flex items-start gap-3"><span class="text-red-600">♫</span> Meningkatkan kualitas program penyiaran yang kreatif dan inovatif sesuai perkembangan teknologi.</li>
                         <li class="flex items-start gap-3"><span class="text-red-600">♫</span> Menjadi sarana interaksi dan aspirasi masyarakat dalam mendukung pembangunan daerah.</li>
                    </ul>
                </div>
            </div>

            <div class="mb-10 text-center">
                <h2 class="text-2xl font-black uppercase not-italic">Hubungi Kami</h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-2"></div>
            </div>

           <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-20">
                <div class="bg-[#161b22] p-8 rounded-2xl border border-white/5 hover:border-red-600/50 transition text-center">
                    <div class="text-green-500 mb-4 flex justify-center">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.025 3.284l-.549 2.338 2.421-.635c.978.589 1.942.851 2.846.851.03 0 .06 0 .089-.001 3.182 0 5.768-2.587 5.769-5.767 0-3.18-2.587-5.736-5.833-5.736zm0-1.101c3.784 0 6.849 3.065 6.849 6.849s-3.065 6.849-6.849 6.849c-.312 0-.613-.021-.908-.06l-3.328.872.934-3.98c-.739-1.127-1.171-2.474-1.171-3.921 0-3.784 3.065-6.849 6.849-6.849zm3.565 8.169c-.046-.076-.17-.122-.358-.216s-1.111-.548-1.284-.61-.299-.093-.423.093-.483.61-.592.735-.219.14-.407.046c-.188-.094-.794-.293-1.512-.935-.558-.498-.934-1.113-1.044-1.301s-.011-.29.083-.383c.084-.083.188-.219.282-.328s.125-.187.188-.312-.031-.235-.078-.328-.423-1.018-.578-1.393c-.151-.364-.305-.315-.423-.321s-.24-.007-.37-.007-.341.048-.521.246-.688.673-.688 1.64 1.191 3.21 1.356 3.43c.165.219 2.345 3.58 5.681 5.023.793.344 1.413.549 1.897.703.795.253 1.52.217 2.09.132.636-.095 1.956-.8 2.233-1.571s.277-1.428.194-1.569z"/></svg>
                    </div>
                    <h4 class="font-bold mb-4 uppercase text-sm tracking-widest not-italic text-white">WhatsApp Marketing</h4>
                    <a href="https://wa.me/6282341981355?text=Halo%20Admin%20Marketing" target="_blank" 
                       class="inline-flex items-center justify-center px-6 py-2.5 bg-[#da0231] hover:bg-slate-900 text-white font-black uppercase text-[9px] tracking-[0.15em] rounded-full transition-all duration-300 active:scale-95">
                        Hubungi Sekarang
                    </a>
                </div>

                <div class="bg-[#161b22] p-8 rounded-2xl border border-white/5 hover:border-red-600/50 transition text-center">
                    <div class="text-green-500 mb-4 flex justify-center">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.025 3.284l-.549 2.338 2.421-.635c.978.589 1.942.851 2.846.851.03 0 .06 0 .089-.001 3.182 0 5.768-2.587 5.769-5.767 0-3.18-2.587-5.736-5.833-5.736zm0-1.101c3.784 0 6.849 3.065 6.849 6.849s-3.065 6.849-6.849 6.849c-.312 0-.613-.021-.908-.06l-3.328.872.934-3.98c-.739-1.127-1.171-2.474-1.171-3.921 0-3.784 3.065-6.849 6.849-6.849zm3.565 8.169c-.046-.076-.17-.122-.358-.216s-1.111-.548-1.284-.61-.299-.093-.423.093-.483.61-.592.735-.219.14-.407.046c-.188-.094-.794-.293-1.512-.935-.558-.498-.934-1.113-1.044-1.301s-.011-.29.083-.383c.084-.083.188-.219.282-.328s.125-.187.188-.312-.031-.235-.078-.328-.423-1.018-.578-1.393c-.151-.364-.305-.315-.423-.321s-.24-.007-.37-.007-.341.048-.521.246-.688.673-.688 1.64 1.191 3.21 1.356 3.43c.165.219 2.345 3.58 5.681 5.023.793.344 1.413.549 1.897.703.795.253 1.52.217 2.09.132.636-.095 1.956-.8 2.233-1.571s.277-1.428.194-1.569z"/></svg>
                    </div>
                    <h4 class="font-bold mb-4 uppercase text-sm tracking-widest not-italic text-white">WhatsApp Kerjasama</h4>
                    <a href="https://wa.me/6282341981355?text=Halo%20Admin%20Kerjasama" target="_blank" 
                       class="inline-flex items-center justify-center px-6 py-2.5 bg-[#e00232] hover:bg-slate-900 text-white font-black uppercase text-[9px] tracking-[0.15em] rounded-full transition-all duration-300 active:scale-95">
                        Hubungi Sekarang
                    </a>
                </div>

                <div class="bg-[#161b22] p-8 rounded-2xl border border-white/5 hover:border-red-600/50 transition text-center">
                    <div class="text-red-500 mb-4 flex justify-center">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>
                    <h4 class="font-bold mb-4 uppercase text-sm tracking-widest not-italic text-white">Email Official</h4>
                    <a href="mailto:eddysupriyadi250501@gmail.com" 
                       class="inline-flex items-center justify-center px-6 py-2.5 bg-[#e80234] hover:bg-slate-900 text-white font-black uppercase text-[9px] tracking-[0.15em] rounded-full transition-all duration-300 active:scale-95">
                        Kirim Email
                    </a>
                </div>
            </div>

            <div class="mb-10 text-center">
                <h2 class="text-2xl font-black uppercase not-italic">Lokasi Kami</h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-2"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-0 rounded-3xl overflow-hidden border border-white/5 shadow-2xl">
                <div class="bg-[#161b22] p-10 flex flex-col justify-center">
                    <h3 class="text-xl font-bold mb-4 text-red-600 not-italic">Radio Kota 105.9 FM</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Jl. Hos Cokroaminoto, Mataram Bar., <br>
                        Kec. Selaparang, Kota Mataram, <br>
                        Nusa Tenggara Bar. 83123
                    </p>
                    <div class="flex items-center gap-2 text-yellow-500 mb-6">
                        <span class="text-lg">★★★★★</span>
                        <span class="text-xs text-gray-500 uppercase tracking-widest">4.9 (500+ ulasan)</span>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query=105+FM+Suara+Kota+Mataram" target="_blank" class="text-red-600 font-bold hover:text-white transition flex items-center gap-2 text-sm uppercase tracking-wider">
                        Lihat peta lebih besar 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="h-[400px] relative">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13725.939586296274!2d116.09811229518934!3d-8.578662126902035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdc09edb3ba0c3%3A0x57fcc8eea845147a!2s105%20FM%20Suara%20Kota!5e1!3m2!1sid!2sid!4v1775917809141!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </section>

    {{-- ========================================================= --}}
    {{-- WAJIB ADA: KUBAH RADIO AGAR STREAMING TIDAK PUTUS DI SINI --}}
    {{-- ========================================================= --}}
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

@endsection