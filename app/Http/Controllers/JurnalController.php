<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\User;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class JurnalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of jurnal
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Query dasar berdasarkan role
        $query = Jurnal::with(['guru', 'mataPelajaran', 'kelas']);
        
        // Filter berdasarkan role
        if ($user->role === 'guru') {
            $query->byGuru($user->id);
        } elseif ($user->role === 'wali_murid') {
            // Wali murid hanya melihat jurnal yang melibatkan anaknya
            $anakIds = $user->anak()->pluck('id')->toArray();
            if (!empty($anakIds)) {
                $query->where(function($q) use ($anakIds) {
                    foreach ($anakIds as $anakId) {
                        $q->orWhereJsonContains('santri_hadir', $anakId)
                          ->orWhereJsonContains('santri_tidak_hadir', $anakId);
                    }
                });
            } else {
                $query->whereRaw('1 = 0'); // Tidak ada data jika tidak punya anak
            }
        }
        
        // Filter berdasarkan parameter request
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->byDateRange($request->tanggal_mulai, $request->tanggal_selesai);
        }
        
        if ($request->filled('mata_pelajaran_id')) {
            $query->byMataPelajaran($request->mata_pelajaran_id);
        }
        
        if ($request->filled('kelas_id')) {
            $query->byKelas($request->kelas_id);
        }
        
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }
        
        if ($request->filled('guru_id') && $user->role === 'admin') {
            $query->byGuru($request->guru_id);
        }
        
        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_jurnal', 'LIKE', "%{$search}%")
                  ->orWhere('materi_pokok', 'LIKE', "%{$search}%")
                  ->orWhereHas('guru', function($subQ) use ($search) {
                      $subQ->where('name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('mataPelajaran', function($subQ) use ($search) {
                      $subQ->where('nama', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $jurnal = $query->orderBy('tanggal', 'desc')
                       ->orderBy('jam_mulai', 'desc')
                       ->paginate(15);
        
        // Data untuk filter dropdown
        $mataPelajaran = MataPelajaran::active()->get();
        $kelas = Kelas::active()->get();
        $guru = $user->role === 'admin' ? User::guru()->get() : collect();
        
        return view('jurnal.index', compact('jurnal', 'mataPelajaran', 'kelas', 'guru'));
    }

    /**
     * Show the form for creating a new jurnal
     */
    public function create()
    {
        $user = Auth::user();
        
        // Hanya admin dan guru yang bisa membuat jurnal
        if (!in_array($user->role, ['admin', 'guru'])) {
            abort(403, 'Anda tidak memiliki akses untuk membuat jurnal');
        }
        
        $mataPelajaran = MataPelajaran::active()->get();
        $kelas = Kelas::active()->get();
        $guru = User::guru()->get();
        
        return view('jurnal.create', compact('mataPelajaran', 'kelas', 'guru'));
    }

    /**
     * Store a newly created jurnal
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validasi akses
        if (!in_array($user->role, ['admin', 'guru'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membuat jurnal');
        }
        
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'guru_id' => 'required|exists:users,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'materi_pokok' => 'required|string|max:255',
            'kegiatan_pembelajaran' => 'required|string',
            'evaluasi_pembelajaran' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'santri_hadir' => 'nullable|array',
            'santri_tidak_hadir' => 'nullable|array',
            'catatan_khusus' => 'nullable|string',
            'kendala_pembelajaran' => 'nullable|string',
            'solusi_kendala' => 'nullable|string',
            'pencapaian_target' => 'required|in:tercapai,sebagian,tidak_tercapai',
            'keterangan_pencapaian' => 'nullable|string',
            'status_jurnal' => 'required|in:draft,final'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }
        
        // Guru hanya bisa membuat jurnal untuk dirinya sendiri
        if ($user->role === 'guru' && $request->guru_id != $user->id) {
            return redirect()->back()->with('error', 'Anda hanya dapat membuat jurnal untuk diri sendiri');
        }
        
        try {
            DB::beginTransaction();
            
            // Hitung jumlah kehadiran
            $jumlahHadir = count($request->santri_hadir ?? []);
            $jumlahTidakHadir = count($request->santri_tidak_hadir ?? []);
            
            // Buat jurnal baru
            $jurnal = Jurnal::create([
                'tanggal' => $request->tanggal,
                'guru_id' => $request->guru_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'kelas_id' => $request->kelas_id,
                'materi_pokok' => $request->materi_pokok,
                'kegiatan_pembelajaran' => $request->kegiatan_pembelajaran,
                'evaluasi_pembelajaran' => $request->evaluasi_pembelajaran,
                'santri_hadir' => $request->santri_hadir,
                'santri_tidak_hadir' => $request->santri_tidak_hadir,
                'jumlah_hadir' => $jumlahHadir,
                'jumlah_tidak_hadir' => $jumlahTidakHadir,
                'catatan_khusus' => $request->catatan_khusus,
                'kendala_pembelajaran' => $request->kendala_pembelajaran,
                'solusi_kendala' => $request->solusi_kendala,
                'pencapaian_target' => $request->pencapaian_target,
                'keterangan_pencapaian' => $request->keterangan_pencapaian,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'status_jurnal' => $request->status_jurnal
            ]);
            
            DB::commit();
            
            return redirect()->route('jurnal.show', $jurnal->id)
                           ->with('success', 'Jurnal pembelajaran berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                           ->with('error', 'Gagal membuat jurnal: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Display the specified jurnal
     */
    public function show(Jurnal $jurnal)
    {
        $user = Auth::user();
        
        // Cek akses berdasarkan role
        if (!$jurnal->canBeAccessedBy($user)) {
            abort(403, 'Anda tidak memiliki akses untuk melihat jurnal ini');
        }
        
        $jurnal->load(['guru', 'mataPelajaran', 'kelas']);
        
        // Ambil data santri yang hadir dan tidak hadir
        $santriHadir = $jurnal->getSantriHadirData();
        $santriTidakHadir = $jurnal->getSantriTidakHadirData();
        
        return view('jurnal.show', compact('jurnal', 'santriHadir', 'santriTidakHadir'));
    }

    /**
     * Show the form for editing jurnal
     */
    public function edit(Jurnal $jurnal)
    {
        $user = Auth::user();
        
        // Hanya admin dan guru pemilik yang bisa edit
        if ($user->role === 'wali_murid' || 
            ($user->role === 'guru' && $jurnal->guru_id !== $user->id)) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit jurnal ini');
        }
        
        // Jurnal yang sudah final tidak bisa diedit kecuali admin
        if ($jurnal->status_jurnal === 'final' && $user->role !== 'admin') {
            return redirect()->back()->with('error', 'Jurnal yang sudah final tidak dapat diedit');
        }
        
        $jurnal->load(['guru', 'mataPelajaran', 'kelas']);
        
        $mataPelajaran = MataPelajaran::active()->get();
        $kelas = Kelas::active()->get();
        $guru = User::guru()->get();
        
        // Ambil santri berdasarkan kelas
        $santriKelas = User::santri()
                          ->whereHas('kelas', function($q) use ($jurnal) {
                              $q->where('kelas.id', $jurnal->kelas_id);
                          })
                          ->get();
        
        return view('jurnal.edit', compact('jurnal', 'mataPelajaran', 'kelas', 'guru', 'santriKelas'));
    }

    /**
     * Update the specified jurnal
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        $user = Auth::user();
        
        // Validasi akses
        if ($user->role === 'wali_murid' || 
            ($user->role === 'guru' && $jurnal->guru_id !== $user->id)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit jurnal ini');
        }
        
        // Jurnal final hanya bisa diedit oleh admin
        if ($jurnal->status_jurnal === 'final' && $user->role !== 'admin') {
            return redirect()->back()->with('error', 'Jurnal yang sudah final tidak dapat diedit');
        }
        
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'guru_id' => 'required|exists:users,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'materi_pokok' => 'required|string|max:255',
            'kegiatan_pembelajaran' => 'required|string',
            'evaluasi_pembelajaran' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'santri_hadir' => 'nullable|array',
            'santri_tidak_hadir' => 'nullable|array',
            'catatan_khusus' => 'nullable|string',
            'kendala_pembelajaran' => 'nullable|string',
            'solusi_kendala' => 'nullable|string',
            'pencapaian_target' => 'required|in:tercapai,sebagian,tidak_tercapai',
            'keterangan_pencapaian' => 'nullable|string',
            'status_jurnal' => 'required|in:draft,final'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }
        
        // Guru hanya bisa edit jurnal dirinya sendiri
        if ($user->role === 'guru' && $request->guru_id != $user->id) {
            return redirect()->back()->with('error', 'Anda hanya dapat mengedit jurnal untuk diri sendiri');
        }
        
        try {
            DB::beginTransaction();
            
            // Hitung jumlah kehadiran
            $jumlahHadir = count($request->santri_hadir ?? []);
            $jumlahTidakHadir = count($request->santri_tidak_hadir ?? []);
            
            // Update jurnal
            $jurnal->update([
                'tanggal' => $request->tanggal,
                'guru_id' => $request->guru_id,
                'mata_pelajaran_id' => $request->mata_pelajaran_id,
                'kelas_id' => $request->kelas_id,
                'materi_pokok' => $request->materi_pokok,
                'kegiatan_pembelajaran' => $request->kegiatan_pembelajaran,
                'evaluasi_pembelajaran' => $request->evaluasi_pembelajaran,
                'santri_hadir' => $request->santri_hadir,
                'santri_tidak_hadir' => $request->santri_tidak_hadir,
                'jumlah_hadir' => $jumlahHadir,
                'jumlah_tidak_hadir' => $jumlahTidakHadir,
                'catatan_khusus' => $request->catatan_khusus,
                'kendala_pembelajaran' => $request->kendala_pembelajaran,
                'solusi_kendala' => $request->solusi_kendala,
                'pencapaian_target' => $request->pencapaian_target,
                'keterangan_pencapaian' => $request->keterangan_pencapaian,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'status_jurnal' => $request->status_jurnal
            ]);
            
            DB::commit();
            
            return redirect()->route('jurnal.show', $jurnal->id)
                           ->with('success', 'Jurnal pembelajaran berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                           ->with('error', 'Gagal memperbarui jurnal: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Remove the specified jurnal
     */
    public function destroy(Jurnal $jurnal)
    {
        $user = Auth::user();
        
        // Hanya admin yang bisa menghapus jurnal
        if ($user->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus jurnal');
        }
        
        try {
            $jurnal->delete();
            return redirect()->route('jurnal.index')
                           ->with('success', 'Jurnal pembelajaran berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Gagal menghapus jurnal: ' . $e->getMessage());
        }
    }

    /**
     * Get santri by kelas (AJAX)
     */
    public function getSantriByKelas(Request $request)
    {
        $kelasId = $request->kelas_id;
        
        $santri = User::santri()
                     ->whereHas('kelas', function($q) use ($kelasId) {
                         $q->where('kelas.id', $kelasId);
                     })
                     ->select('id', 'name', 'nis')
                     ->orderBy('name')
                     ->get();
        
        return response()->json($santri);
    }

    /**
     * Laporan jurnal
     */
    public function laporan(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role === 'wali_murid') {
            abort(403, 'Anda tidak memiliki akses untuk melihat laporan');
        }
        
        $query = Jurnal::with(['guru', 'mataPelajaran', 'kelas']);
        
        // Filter berdasarkan role
        if ($user->role === 'guru') {
            $query->byGuru($user->id);
        }
        
        // Filter berdasarkan parameter
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->byDateRange($request->tanggal_mulai, $request->tanggal_selesai);
        } else {
            // Default bulan ini
            $query->byDateRange(now()->startOfMonth(), now()->endOfMonth());
        }
        
        if ($request->filled('mata_pelajaran_id')) {
            $query->byMataPelajaran($request->mata_pelajaran_id);
        }
        
        if ($request->filled('kelas_id')) {
            $query->byKelas($request->kelas_id);
        }
        
        if ($request->filled('guru_id') && $user->role === 'admin') {
            $query->byGuru($request->guru_id);
        }
        
        $jurnal = $query->orderBy('tanggal', 'desc')->get();
        
        // Statistik
        $stats = [
            'total_jurnal' => $jurnal->count(),
            'jurnal_final' => $jurnal->where('status_jurnal', 'final')->count(),
            'jurnal_draft' => $jurnal->where('status_jurnal', 'draft')->count(),
            'target_tercapai' => $jurnal->where('pencapaian_target', 'tercapai')->count(),
            'target_sebagian' => $jurnal->where('pencapaian_target', 'sebagian')->count(),
            'target_tidak_tercapai' => $jurnal->where('pencapaian_target', 'tidak_tercapai')->count(),
            'total_kehadiran' => $jurnal->sum('jumlah_hadir'),
            'total_ketidakhadiran' => $jurnal->sum('jumlah_tidak_hadir')
        ];
        
        // Data untuk filter dropdown
        $mataPelajaran = MataPelajaran::active()->get();
        $kelas = Kelas::active()->get();
        $guru = $user->role === 'admin' ? User::guru()->get() : collect();
        
        return view('jurnal.laporan', compact('jurnal', 'stats', 'mataPelajaran', 'kelas', 'guru'));
    }

    /**
     * Export laporan ke Excel/PDF
     */
    public function exportLaporan(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role === 'wali_murid') {
            abort(403, 'Anda tidak memiliki akses untuk export laporan');
        }
        
        $jurnal = Jurnal::all(); // Ambil data dari database

        $pdf = Pdf::loadView('jurnals.pdf', compact('jurnal'))
                  ->setPaper('A4', 'portrait'); // Atur ukuran dan orientasi

        return $pdf->download('Laporan Jurnal.pdf');
    }

    /**
     * Finalisasi jurnal (mengubah dari draft ke final)
     */
    public function finalisasi(Jurnal $jurnal)
    {
        $user = Auth::user();
        
        // Validasi akses
        if ($user->role === 'wali_murid' || 
            ($user->role === 'guru' && $jurnal->guru_id !== $user->id)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memfinalisasi jurnal ini');
        }
        
        if ($jurnal->status_jurnal === 'final') {
            return redirect()->back()->with('warning', 'Jurnal sudah dalam status final');
        }
        
        try {
            $jurnal->update(['status_jurnal' => 'final']);
            
            return redirect()->back()->with('success', 'Jurnal berhasil difinalisasi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memfinalisasi jurnal: ' . $e->getMessage());
        }
    }

    /**
     * Dashboard statistik jurnal
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        if ($user->role === 'wali_murid') {
            return $this->dashboardWaliMurid();
        }
        
        $query = Jurnal::query();
        
        // Filter berdasarkan role
        if ($user->role === 'guru') {
            $query->byGuru($user->id);
        }
        
        // Statistik bulan ini
        $bulanIni = $query->byDateRange(now()->startOfMonth(), now()->endOfMonth())->get();
        
        // Statistik minggu ini
        $mingguIni = $query->byDateRange(now()->startOfWeek(), now()->endOfWeek())->get();
        
        // Statistik hari ini
        $hariIni = $query->where('tanggal', now()->format('Y-m-d'))->get();
        
        $stats = [
            'bulan_ini' => [
                'total' => $bulanIni->count(),
                'final' => $bulanIni->where('status_jurnal', 'final')->count(),
                'draft' => $bulanIni->where('status_jurnal', 'draft')->count(),
                'tercapai' => $bulanIni->where('pencapaian_target', 'tercapai')->count()
            ],
            'minggu_ini' => [
                'total' => $mingguIni->count(),
                'final' => $mingguIni->where('status_jurnal', 'final')->count(),
                'draft' => $mingguIni->where('status_jurnal', 'draft')->count(),
                'tercapai' => $mingguIni->where('pencapaian_target', 'tercapai')->count()
            ],
            'hari_ini' => [
                'total' => $hariIni->count(),
                'final' => $hariIni->where('status_jurnal', 'final')->count(),
                'draft' => $hariIni->where('status_jurnal', 'draft')->count(),
                'tercapai' => $hariIni->where('pencapaian_target', 'tercapai')->count()
            ]
        ];
        
        // Jurnal terbaru
        $jurnalTerbaru = $query->with(['guru', 'mataPelajaran', 'kelas'])
                              ->orderBy('created_at', 'desc')
                              ->limit(5)
                              ->get();
        
        return view('jurnal.dashboard', compact('stats', 'jurnalTerbaru'));
    }

    /**
     * Dashboard khusus wali murid
     */
    private function dashboardWaliMurid()
    {
        $user = Auth::user();
        $anakIds = $user->anak()->pluck('id')->toArray();
        
        if (empty($anakIds)) {
            $stats = [
                'bulan_ini' => ['total' => 0, 'hadir' => 0, 'tidak_hadir' => 0],
                'minggu_ini' => ['total' => 0, 'hadir' => 0, 'tidak_hadir' => 0],
                'hari_ini' => ['total' => 0, 'hadir' => 0, 'tidak_hadir' => 0]
            ];
            $jurnalTerbaru = collect();
        } else {
            // Query jurnal yang melibatkan anak
            $queryBase = Jurnal::where(function($q) use ($anakIds) {
                foreach ($anakIds as $anakId) {
                    $q->orWhereJsonContains('santri_hadir', $anakId)
                      ->orWhereJsonContains('santri_tidak_hadir', $anakId);
                }
            });
            
            // Statistik bulan ini
            $bulanIni = (clone $queryBase)->byDateRange(now()->startOfMonth(), now()->endOfMonth())->get();
            
            // Statistik minggu ini  
            $mingguIni = (clone $queryBase)->byDateRange(now()->startOfWeek(), now()->endOfWeek())->get();
            
            // Statistik hari ini
            $hariIni = (clone $queryBase)->where('tanggal', now()->format('Y-m-d'))->get();
            
            $stats = [
                'bulan_ini' => $this->hitungKehadiranAnak($bulanIni, $anakIds),
                'minggu_ini' => $this->hitungKehadiranAnak($mingguIni, $anakIds),
                'hari_ini' => $this->hitungKehadiranAnak($hariIni, $anakIds)
            ];
            
            // Jurnal terbaru
            $jurnalTerbaru = (clone $queryBase)->with(['guru', 'mataPelajaran', 'kelas'])
                                              ->orderBy('created_at', 'desc')
                                              ->limit(5)
                                              ->get();
        }
        
        return view('jurnal.dashboard-wali', compact('stats', 'jurnalTerbaru'));
    }

    /**
     * Hitung kehadiran anak dari jurnal
     */
    private function hitungKehadiranAnak($jurnal, $anakIds)
    {
        $totalJurnal = 0;
        $totalHadir = 0;
        $totalTidakHadir = 0;
        
        foreach ($jurnal as $j) {
            foreach ($anakIds as $anakId) {
                if (in_array($anakId, $j->santri_hadir ?? [])) {
                    $totalJurnal++;
                    $totalHadir++;
                } elseif (array_key_exists($anakId, $j->santri_tidak_hadir ?? [])) {
                    $totalJurnal++;
                    $totalTidakHadir++;
                }
            }
        }
        
        return [
            'total' => $totalJurnal,
            'hadir' => $totalHadir,
            'tidak_hadir' => $totalTidakHadir
        ];
    }
}
