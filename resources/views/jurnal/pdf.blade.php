
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Jurnal Harian Mengajar</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Laporan Jurnal Harian Mengajar</h1>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Guru</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Materi Pokok</th>
                <th>Kegiatan Pembelajaran</th>
                <th>Evaluasi Pembelajaran</th>
                <th>Siswa Hadir</th>
                <th>Siswa Tidak Hadir</th>
                <th>Catatan Khusus</th>
                <th>Kendala Pembelajaran</th>
                <th>Solusi Kendala</th>
                <th>Pencapaian Target</th>
                <th>Keterangan Pencapaian</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Status Jurnal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurnals as $jurnal)
                <tr>
                    <td>{{ $jurnal->tanggal }}</td>
                    <td>{{ $jurnal->guru->nama }}</td> {{-- Asumsikan ada relasi guru --}}
                    <td>{{ $jurnal->mataPelajaran->nama }}</td> {{-- Asumsikan ada relasi mata pelajaran --}}
                    <td>{{ $jurnal->kelas->nama }}</td> {{-- Asumsikan ada relasi kelas --}}
                    <td>{{ $jurnal->materi_pokok }}</td>
                    <td>{{ $jurnal->kegiatan_pembelajaran }}</td>
                    <td>{{ $jurnal->evaluasi_pembelajaran }}</td>
                    <td>{{ $jurnal->jumlah_siswa_hadir }}</td> {{-- Asumsikan ada field ini --}}
                    <td>{{ $jurnal->jumlah_siswa_tidak_hadir }}</td> {{-- Asumsikan ada field ini --}}
                    <td>{{ $jurnal->catatan_khusus }}</td>
                    <td>{{ $jurnal->kendala_pembelajaran }}</td>
                    <td>{{ $jurnal->solusi_kendala }}</td>
                    <td>{{ $jurnal->pencapaian_target }}</td>
                    <td>{{ $jurnal->keterangan_pencapaian }}</td>
                    <td>{{ $jurnal->jam_mulai }}</td>
                    <td>{{ $jurnal->jam_selesai }}</td>
                    <td>{{ $jurnal->status_jurnal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>