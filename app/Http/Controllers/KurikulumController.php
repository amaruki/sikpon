<?php
namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Kelas;
use App\Models\Mapel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'siswa') {
            $kurikulums = Kurikulum::where('kelas_id', $user->kelas_id)->get(
            
            );
        } else {
            $kurikulums = Kurikulum::with(['kelas', 'mapel', ])->latest()->paginate(10);
            $kelases = Kelas::all();
            $mapels = Mapel::all();
            
            return view('kurikulums.index', compact('kurikulums', 'kelases', 'mapels' ));
        }
    }

    public function create()
    {
        $kelases = Kelas::all();
        $mapels = Mapel::all();
        
        return view('kurikulums.create', compact('kelases', 'mapels' ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelases,id',
            'mapel_id' => 'required|exists:mapels,id',
            'standar_kompetensi' => 'required|string',
            'kompetensi_dasar' => 'required|string',
            'jam_pelajaran' => 'required|string|max:100',
        ]);

        Kurikulum::create($request->all());

        return redirect()->route('kurikulum.index')->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $kelases = Kelas::all();
        $mapels = Mapel::all();

        return view('kurikulums.edit', compact('kurikulum', 'kelases', 'mapels'));
    }

    public function update(Request $request, $id) // Ubah parameter dari Kurikulum $kurikulum menjadi $id
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelases,id',
            'mapel_id' => 'required|exists:mapels,id',
            'standar_kompetensi' => 'required|string',
            'kompetensi_dasar' => 'required|string',
            'jam_pelajaran' => 'required|string|max:100',
        ]);

        $kurikulum = Kurikulum::findOrFail($id);
        $kurikulum->update($request->all());

        return redirect()->route('kurikulum.index')->with('success', 'Kurikulum berhasil diperbarui.');
    }

    public function delete($id) // Ubah dari delete() ke destroy()
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $kurikulum->delete();

        return redirect()->route('kurikulum.index')->with('success', 'Kurikulum berhasil dihapus.');
    }
    public function exportPDF()
    {
        $kurikulum = Kurikulum::all(); // Ambil data dari database

        $pdf = Pdf::loadView('kurikulums.pdf', compact('kurikulum'))
                  ->setPaper('A4', 'portrait'); // Atur ukuran dan orientasi

        return $pdf->download('Kurikulum_Akhlak.pdf');
    }

    public function exportPDFById($id)
{
    $kurikulum = Kurikulum::with(['kelas', 'mapel'])->findOrFail($id);

    $pdf = Pdf::loadView('kurikulums.pdfId', compact('kurikulum'))
              ->setPaper('A4', 'portrait');

    return $pdf->download("Kurikulum_{$kurikulum->id}.pdf");
}

}
