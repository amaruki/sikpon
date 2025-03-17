<?php

namespace App\Http\Controllers;

use App\Models\Rapot;
use App\Models\RapotDetail;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tahun;
use App\Models\Presensi;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RapotController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rapots = null;
        
        if ($user->role == 'Dev') {
            $rapots = Rapot::with(['siswa', 'kelas', 'tahun'])
                ->latest()
                ->paginate(10);
        } else if ($user->role == 'Guru') {
            $kelasIds = Kelas::where('pegawai_id', $user->pegawai_id)->pluck('id');
            $rapots = Rapot::with(['siswa', 'kelas', 'tahun'])
                ->whereIn('kelas_id', $kelasIds)
                ->latest()
                ->paginate(10);
        } else if ($user->role == 'Siswa') {
            $rapots = Rapot::with(['siswa', 'kelas', 'tahun'])
                ->where('siswa_id', $user->siswa_id)
                ->latest()
                ->paginate(10);
        }
        
        return view('rapots.index', compact('rapots'));
    }

    public function create()
    {
        $user = Auth::user();
        
        if ($user->role == 'Siswa') {
            return redirect()->route('rapots.index')
                ->with('error', 'Siswa tidak memiliki akses untuk membuat rapot.');
        }
        
        $siswas = Siswa::all();
        $kelases = null;
        
        if ($user->role == 'Dev') {
            $kelases = Kelas::all();
        } else if ($user->role == 'Guru') {
            $kelases = Kelas::where('pegawai_id', $user->pegawai_id)->get();
        }
        
        if ($kelases->isEmpty()) {
            return redirect()->route('rapots.index')
                ->with('error', 'Anda tidak memiliki kelas yang diampu.');
        }
        
        $tahuns = Tahun::all();
        
        return view('rapots.create', compact('siswas', 'kelases', 'tahuns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelases,id',
            'tahun_id' => 'required|exists:tahuns,id',
            'semester' => 'required|in:ganjil,genap',
            'catatan_wali_kelas' => 'nullable|string',
        ]);
        
        // Hitung jumlah ketidakhadiran
        $siswaId = $request->siswa_id;
        $kelasId = $request->kelas_id;
        $tahunId = $request->tahun_id;
        
        $jumlahSakit = Presensi::where('siswa_id', $siswaId)
            ->where('kelas_id', $kelasId)
            ->where('tahun_id', $tahunId)
            ->where('status', 'sakit')
            ->count();
            
        $jumlahIzin = Presensi::where('siswa_id', $siswaId)
            ->where('kelas_id', $kelasId)
            ->where('tahun_id', $tahunId)
            ->where('status', 'izin')
            ->count();
            
        $jumlahAlpa = Presensi::where('siswa_id', $siswaId)
            ->where('kelas_id', $kelasId)
            ->where('tahun_id', $tahunId)
            ->where('status', 'alpa')
            ->count();
        
        $rapot = Rapot::create([
            'siswa_id' => $siswaId,
            'kelas_id' => $kelasId,
            'tahun_id' => $tahunId,
            'semester' => $request->semester,
            'jumlah_sakit' => $jumlahSakit,
            'jumlah_izin' => $jumlahIzin,
            'jumlah_alpa' => $jumlahAlpa,
            'catatan_wali_kelas' => $request->catatan_wali_kelas,
            'is_published' => false,
        ]);
        
        // Buat detail rapot untuk setiap mapel
        $mapelIds = Nilai::where('siswa_id', $siswaId)
            ->where('kelas_id', $kelasId)
            ->where('tahun_id', $tahunId)
            ->pluck('mapel_id')
            ->unique();
        
        foreach ($mapelIds as $mapelId) {
            // Hitung nilai pengetahuan (rata-rata dari harian, pts, pas)
            $nilaiPengetahuan = Nilai::where('siswa_id', $siswaId)
                ->where('kelas_id', $kelasId)
                ->where('tahun_id', $tahunId)
                ->where('mapel_id', $mapelId)
                ->whereIn('jenis', ['harian', 'pts', 'pas'])
                ->avg('nilai');
            
            RapotDetail::create([
                'rapot_id' => $rapot->id,
                'mapel_id' => $mapelId,
                'nilai_pengetahuan' => $nilaiPengetahuan,
                'nilai_keterampilan' => null, // Diisi manual saat edit
                'deskripsi_pengetahuan' => null, // Diisi manual saat edit
                'deskripsi_keterampilan' => null, // Diisi manual saat edit
            ]);
        }
        
        return redirect()->route('rapots.edit', $rapot->id)
            ->with('success', 'Rapot berhasil dibuat. Silakan lengkapi detail nilai.');
    }

    public function show(Rapot $rapot)
    {
        $user = Auth::user();
        
        if ($user->role == 'Siswa' && $user->siswa_id != $rapot->siswa_id) {
            return redirect()->route('rapots.index')
                ->with('error', 'Anda tidak memiliki akses untuk melihat rapot ini.');
        }
        
        if ($user->role == 'Guru') {
            $kelasIds = Kelas::where('pegawai_id', $user->pegawai_id)->pluck('id');
            if (!$kelasIds->contains($rapot->kelas_id)) {
                return redirect()->route('rapots.index')
                    ->with('error', 'Anda tidak memiliki akses untuk melihat rapot ini.');
            }
        }
        
        $rapotDetails = RapotDetail::with('mapel')
            ->where('rapot_id', $rapot->id)
            ->get();
        
        return view('rapots.show', compact('rapot', 'rapotDetails'));
    }

    public function edit(Rapot $rapot)
    {
        $user = Auth::user();
        
        if ($user->role == 'Siswa') {
            return redirect()->route('rapots.index')
                ->with('error', 'Siswa tidak memiliki akses untuk mengubah rapot.');
        }
        
        if ($user->role == 'Guru') {
            $kelasIds = Kelas::where('pegawai_id', $user->pegawai_id)->pluck('id');
            if (!$kelasIds->contains($rapot->kelas_id)) {
                return redirect()->route('rapots.index')
                    ->with('error', 'Anda tidak memiliki akses untuk mengubah rapot ini.');
            }
        }
        
        $rapotDetails = RapotDetail::with('mapel')
            ->where('rapot_id', $rapot->id)
            ->get();
        
        $siswas = Siswa::all();
        $kelases = null;
        
        if ($user->role == 'Dev') {
            $kelases = Kelas::all();
        } else if ($user->role == 'Guru') {
            $kelases = Kelas::where('pegawai_id', $user->pegawai_id)->get();
        }
        
        $tahuns = Tahun::all();
        
        return view('rapots.edit', compact('rapot', 'rapotDetails', 'siswas', 'kelases', 'tahuns'));
    }

    public function update(Request $request, Rapot $rapot)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelases,id',
            'tahun_id' => 'required|exists:tahuns,id',
            'semester' => 'required|in:ganjil,genap',
            'jumlah_sakit' => 'required|integer|min:0',
            'jumlah_izin' => 'required|integer|min:0',
            'jumlah_alpa' => 'required|integer|min:0',
            'catatan_wali_kelas' => 'nullable|string',
            'is_published' => 'boolean',
        ]);
        
        $rapot->update([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'tahun_id' => $request->tahun_id,
            'semester' => $request->semester,
            'jumlah_sakit' => $request->jumlah_sakit,
            'jumlah_izin' => $request->jumlah_izin,
            'jumlah_alpa' => $request->jumlah_alpa,
            'catatan_wali_kelas' => $request->catatan_wali_kelas,
            'is_published' => $request->has('is_published'),
        ]);
        
        // Update detail rapot values
        $details = $request->input('details', []);
        
        foreach ($details as $detailId => $detailData) {
            RapotDetail::where('id', $detailId)->update([
                'nilai_pengetahuan' => $detailData['nilai_pengetahuan'] ?? null,
                'nilai_keterampilan' => $detailData['nilai_keterampilan'] ?? null,
                'deskripsi_pengetahuan' => $detailData['deskripsi_pengetahuan'] ?? null,
                'deskripsi_keterampilan' => $detailData['deskripsi_keterampilan'] ?? null,
            ]);
        }
        
        return redirect()->route('rapots.index')
            ->with('success', 'Rapot berhasil diupdate.');
    }

    public function destroy(Rapot $rapot)
    {
        $user = Auth::user();
        
        if ($user->role == 'Siswa') {
            return redirect()->route('rapots.index')
                ->with('error', 'Siswa tidak memiliki akses untuk menghapus rapot.');
        }
        
        if ($user->role == 'Guru') {
            $kelasIds = Kelas::where('pegawai_id', $user->pegawai_id)->pluck('id');
            if (!$kelasIds->contains($rapot->kelas_id)) {
                return redirect()->route('rapots.index')
                    ->with('error', 'Anda tidak memiliki akses untuk menghapus rapot ini.');
            }
        }
        
        // Delete rapot details first
        RapotDetail::where('rapot_id', $rapot->id)->delete();
        
        // Delete rapot
        $rapot->delete();
        
        return redirect()->route('rapots.index')
            ->with('success', 'Rapot berhasil dihapus.');
    }
}