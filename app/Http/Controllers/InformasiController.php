<?php

namespace App\Http\Controllers;

use App\Models\Informasis;
use App\Models\Kelas;
use App\Models\Jadwal_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    public function index()
    {
        $kelases = Kelas::all();
        $user = Auth::user();

        if ($user->role == 'Dev' || $user->role == 'Guru') {
            $informasis = Informasis::with('kelas')->latest()->get();
        } elseif ($user->role == 'Siswa') {
            $jadwalSiswa = Jadwal_siswa::where('siswa_id', $user->siswa_id)
                ->pluck('kelas_id')
                ->unique()
                ->toArray();
            $informasis = Informasis::whereIn('kelas_id', $jadwalSiswa)
                ->orWhereNull('kelas_id')
                ->with('kelas')
                ->latest()
                ->get();
        } else {
            $informasis = collect(); // Default kosong jika role tidak terdefinisi
        }

        return view('informasi.index', compact('informasis', 'kelases'));
    }

    public function create()
    {
        $kelases = Kelas::all();
        return view('informasi.create', compact('kelases'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role == 'Siswa') {
            abort(403, 'Akses ditolak. Siswa tidak dapat melakukan tindakan ini.');
        }
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required|string',
            'kelas_id' => 'nullable|exists:kelases,id',
        ]);

        $file = $request->file('foto');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('informasi_foto'), $namaFile);

        Informasis::create([
            'foto' => $namaFile,
            'isi' => $request->isi,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect('/informasi')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $informasi = Informasis::findOrFail($id);
        $kelases = Kelas::all();
        return view('informasi.edit', compact('informasi', 'kelases'));
        
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role == 'Siswa') {
            abort(403, 'Akses ditolak. Siswa tidak dapat melakukan tindakan ini.');
        }
        $request->validate([
            'isi' => 'required|string',
            'kelas_id' => 'nullable|exists:kelases,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $informasi = Informasis::findOrFail($id);
        $informasi->isi = $request->isi;
        $informasi->kelas_id = $request->kelas_id;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('informasi_foto'), $namaFile);
            $informasi->foto = $namaFile;
        }

        $informasi->save();
        return redirect('/informasi')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        if (auth()->user()->role == 'Siswa') {
            abort(403, 'Akses ditolak. Siswa tidak dapat melakukan tindakan ini.');
        }
        $informasi = Informasis::findOrFail($id);
        $informasi->delete();

        return redirect('/informasi')->with('success', 'Informasi berhasil dihapus.');
    }
}
