<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Kurikulum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
            text-align: center;
        }
        h1, h2 {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 10px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px 10px;
            vertical-align: top;
            border: none; /* Menghilangkan garis */
        }
        .info-table td:first-child {
            width: 30%;
            font-weight: bold;
            text-align: left;
            white-space: nowrap;
        }
    </style>
</head>
<body>

   
    <div class="header">
        <h2>STANDAR KOMPETENSI DAN KOMPETENSI DASAR (SKKD)</h2>
        <h2>MADRASAH DINIYAH TAKMILIYAH </h2>
        <h2>(TINGKAT AWALIYAH)</h2>
    </div>
    <table class="info-table">
            <tr>
                <td>Mata Pelajaran</td>
                <td>: {{ $kurikulum->mapel->nama }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>: {{ $kurikulum->jam_pelajaran }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: {{ $kurikulum->kelas->nama }}</td>
            </tr>
            <tr>
                <td>Jenis Pendidikan</td>
                <td>: Madrasah Diniyah Takmiliyah</td>
            </tr>
        </table>
   
        <table>
            <thead>
                <tr>
                    <th>Standar Kompetensi</th>
                    <th>Kompetensi Dasar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{!! $kurikulum->standar_kompetensi !!}</td>
                <td>{!! $kurikulum->kompetensi_dasar !!}</td>
                </tr>
            </tbody>
        </table>
</body>
</html>
