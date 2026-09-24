<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Streaming;
use App\Models\Penyiar; 
use App\Models\Berita; 
use App\Models\CreativeDistrict;
use App\Models\SekolahKita;
use App\Models\Wisata; 
use App\Models\Umkm;   
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    /**
     * Menampilkan Halaman Utama (Landing Page)
     */
   public function index(Request $request) 
    {
        // 1. Ambil data
        $streamingData = Streaming::where('kategori', 'live_radio')->first();

        // 2. Berikan nilai default jika data di database kosong
        $streamingData = $streamingData ?? (object) [
            'kategori' => 'live_radio', 
            'link_eksternal' => ''
        ];
        
        // 3. Logika ID YouTube
        $liveId = ($streamingData && $streamingData->link_eksternal) 
                  ? $this->extractYoutubeId($streamingData->link_eksternal) 
                  : null;

        // 4. Pastikan semua variabel terdefinisi untuk dikirim
        $layanans = Layanan::all();
        $penyiars = Penyiar::all();
        $schoolActivities = SekolahKita::latest()->take(4)->get();
        $creativeDistricts = CreativeDistrict::latest()->take(6)->get();
        $wisatas = Wisata::latest()->take(3)->get();
        $umkms = Umkm::latest()->take(3)->get();
        $beritas = Berita::where('status', 'published')->latest()->take(4)->get();
        $daftarKategori = Berita::where('status', 'published')->select('kategori')->distinct()->get();

        // 5. Kirim semua variabel ke view 'landing'
        return view('landing', compact(
            'streamingData',
            'liveId',
            'layanans',
            'penyiars',
            'schoolActivities',
            'creativeDistricts',
            'wisatas',
            'umkms',
            'beritas',
            'daftarKategori'
        ));
    }
    private function extractYoutubeId($url)
    {
        $pattern = "/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/\s]{11})/";
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Menampilkan Halaman Index Berita
     */
    public function indexBerita(Request $request)
    {
        $streamings = Streaming::first(); 
        $daftarKategori = Berita::where('status', 'published')->select('kategori')->distinct()->get();
        $query = Berita::where('status', 'published');

        if ($request->has('category')) {
            $query->where('kategori', 'LIKE', '%' . $request->category . '%');
        }

        $beritas = $query->latest()->get(); 
        return view('berita-index', compact('beritas', 'daftarKategori', 'streamings'));
    }

    /**
     * Menampilkan Halaman Index Wisata
     */
    public function indexWisata(Request $request)
    {
        $query = Wisata::query(); 

        if ($request->has('category')) {
            $query->where('kategori', $request->category);
        }

        $semuaData = $query->latest()->get();
        $listKategori = Wisata::select('kategori')->distinct()->pluck('kategori');

        return view('wisata-index', compact('semuaData', 'listKategori'));
    }

    /**
     * Menampilkan Halaman Index UMKM
     */
    public function indexUmkm(Request $request)
    {
        $query = Umkm::query(); 

        if ($request->has('category')) {
            $query->where('kategori', $request->category);
        }

        $semuaData = $query->latest()->get();
        $listKategori = Umkm::select('kategori')->distinct()->pluck('kategori');

        return view('umkm-index', compact('semuaData', 'listKategori'));
    }

    /**
     * Menampilkan Detail Wisata
     */
    public function showWisata($id)
    {
        $item = Wisata::find($id); 
        if (!$item) abort(404);
        return view('wisata-detail', compact('item'));
    }

    /**
     * Menampilkan Detail UMKM
     */
    public function showUmkm($id)
    {
        $item = Umkm::find($id); 
        if (!$item) abort(404);
        return view('umkm-detail', compact('item'));
    }

    /**
     * Menampilkan Detail Berita
     */
    public function showBerita($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $daftarKategori = Berita::where('status', 'published')->select('kategori')->distinct()->get();
        return view('berita-detail', compact('berita', 'daftarKategori')); 
    }

    /**
     * Menampilkan Detail Penyiar
     */
    public function showPenyiar($id)
    {
        $penyiar = Penyiar::findOrFail($id);
        return view('penyiar_detail', compact('penyiar'));
    }

    /**
     * Menampilkan Index Creative District
     */
    public function indexCreativeDistrict()
    {
        $creativeDistricts = CreativeDistrict::latest()->paginate(12);
        return view('creative-district-index', compact('creativeDistricts'));
    }

    /**
     * Menampilkan Detail Creative District
     */
    public function showCreativeDistrict($id)
    {
        $item = CreativeDistrict::findOrFail($id);
        return view('creative-district-detail', compact('item'));
    }

    /**
     * Menampilkan Index Layanan Publik
     */
    public function indexLayanan()
    {
        $layanans = Layanan::latest()->get();
        return view('layanan_index', compact('layanans'));
    }

    /**
     * Menampilkan Detail Layanan Publik
     */
    public function showLayanan($id)
    {
        $item = Layanan::findOrFail($id);
        return view('layanan_show', compact('item'));
    }

    /**
     * Proses Simpan & Kirim Email Form Donor Darah
     */
    public function storeDonorDarah(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'golongan_darah' => 'required',
            'rhesus' => 'required',
            'jumlah_kantong' => 'required|numeric',
            'rumah_sakit' => 'required|string',
            'kontak_keluarga' => 'required|string',
            'kontak_pribadi' => 'required|string',
            'pesan_tambahan' => 'nullable|string',
        ]);

        $layananMaster = Layanan::where('kategori', 'call_center')->first();

        if (!$layananMaster || !$layananMaster->email) {
            return redirect()->back()->with('error', 'Gagal mengirim: Email tujuan belum diatur di Admin Panel (Menu Layanan Publik -> Call Center).');
        }

        try {
            $dataEmail = $validated;
            
            Mail::send([], [], function ($message) use ($dataEmail, $layananMaster) {
                $message->to($layananMaster->email) 
                        ->subject('PERMINTAAN DARAH BARU - ' . $dataEmail['nama_pasien'])
                        ->html("
                            <div style='font-family: sans-serif; border: 1px solid #eee; padding: 20px; border-radius: 10px;'>
                                <h3 style='color: #e11d48;'>Ada Permintaan Darah Baru</h3>
                                <hr>
                                <p><b>Nama Pasien:</b> {$dataEmail['nama_pasien']}</p>
                                <p><b>Golongan Darah:</b> {$dataEmail['golongan_darah']} ({$dataEmail['rhesus']})</p>
                                <p><b>Jumlah:</b> {$dataEmail['jumlah_kantong']} Kantong</p>
                                <p><b>Rumah Sakit:</b> {$dataEmail['rumah_sakit']}</p>
                                <p><b>Kontak Keluarga:</b> {$dataEmail['kontak_keluarga']}</p>
                                <p><b>Kontak Pribadi:</b> {$dataEmail['kontak_pribadi']}</p>
                                <p><b>Pesan Tambahan:</b> " . ($dataEmail['pesan_tambahan'] ?? '-') . "</p>
                                <br>
                                <p style='font-size: 12px; color: #666;'>Email ini diteruskan secara otomatis dari sistem Layanan Publik Radio Kota Mataram.</p>
                            </div>
                        ");
            });

            return redirect()->back()->with('success', 'Permintaan anda berhasil dikirim!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi masalah pada server email. Silakan coba beberapa saat lagi.');
        }
    }

    /**
     * Menampilkan Index Kegiatan Sekolah (School Activity)
     */
    public function indexSekolah(Request $request)
    {
        $query = SekolahKita::latest();
        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        $SekolahKita = $query->paginate(12);
        return view('sekolah-index', compact('SekolahKita'));
    }

    /**
     * Menampilkan Detail Kegiatan Sekolah
     */
    public function showSekolah($id)
    {
        $activity = SekolahKita::findOrFail($id);
        return view('sekolah-detail', compact('activity'));
    }
}