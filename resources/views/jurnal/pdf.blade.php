<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Jurnal Harian Mengajar</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: Arial, sans-serif;
            font-size: 8px;
            line-height: 1.2;
            color: #333;
            background: #fff;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }
        
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .header .subtitle {
            font-size: 10px;
            color: #666;
        }
        
        .report-info {
            margin-bottom: 15px;
            font-size: 9px;
        }
        
        .report-info table {
            width: 100%;
            border: none;
        }
        
        .report-info td {
            border: none;
            padding: 3px 10px;
            background: #f5f5f5;
        }
        
        .main-table { 
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7px;
        }
        
        .main-table th {
            background-color: #333;
            color: white;
            font-weight: bold;
            padding: 6px 3px;
            text-align: center;
            border: 1px solid #000;
            font-size: 7px;
            vertical-align: middle;
            word-wrap: break-word;
        }
        
        .main-table td {
            border: 1px solid #666;
            padding: 4px 3px;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
            font-size: 7px;
        }
        
        .main-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        /* Fixed column widths - total should be 100% */
        .col-no { width: 3%; }
        .col-tanggal { width: 6%; }
        .col-guru { width: 8%; }
        .col-mapel { width: 7%; }
        .col-kelas { width: 4%; }
        .col-jam { width: 4%; }
        .col-materi { width: 12%; }
        .col-kegiatan { width: 12%; }
        .col-evaluasi { width: 10%; }
        .col-hadir { width: 3%; }
        .col-tidak-hadir { width: 3%; }
        .col-target { width: 4%; }
        .col-keterangan { width: 8%; }
        .col-kendala { width: 8%; }
        .col-solusi { width: 8%; }
        .col-status { width: 6%; }
        
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .text-small { font-size: 6px; }
        
        .status-badge {
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 6px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            min-width: 35px;
        }
        
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            font-size: 8px;
        }
        
        .footer-table {
            width: 100%;
            border: none;
        }
        
        .footer-table td {
            border: none;
            padding: 5px;
            vertical-align: top;
        }
        
        .signature-section {
            margin-top: 20px;
            text-align: center;
        }
        
        .signature-box {
            display: inline-block;
            margin: 0 30px;
            text-align: center;
            vertical-align: top;
        }
        
        .signature-line {
            width: 150px;
            height: 40px;
            border-bottom: 1px solid #333;
            margin: 15px auto 8px auto;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #666;
        }
        
        /* Print specific styles */
        @media print {
            body { 
                font-size: 7px; 
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .main-table th {
                background-color: #333 !important;
                color: white !important;
            }
            .main-table tr:nth-child(even) {
                background-color: #f9f9f9 !important;
            }
            .status-approved {
                background-color: #d4edda !important;
            }
            .status-pending {
                background-color: #fff3cd !important;
            }
            .status-rejected {
                background-color: #f8d7da !important;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Jurnal Harian Mengajar</h1>
        <div class="subtitle">Sistem Monitoring Pembelajaran Harian</div>
    </div>

    <div class="report-info">
        <table class="report-info-table">
            <tr>
                <td><strong>Periode:</strong> {{ isset($tanggal_mulai) ? date('d F Y', strtotime($tanggal_mulai)) : date('d F Y') }} - {{ isset($tanggal_akhir) ? date('d F Y', strtotime($tanggal_akhir)) : date('d F Y') }}</td>
                <td><strong>Total Jurnal:</strong> {{ isset($jurnals) ? count($jurnals) : 0 }} entri</td>
                <td><strong>Dicetak:</strong> {{ date('d F Y H:i') }} WIB</td>
            </tr>
        </table>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-tanggal">Tanggal</th>
                <th class="col-guru">Guru</th>
                <th class="col-mapel">Mapel</th>
                <th class="col-kelas">Kelas</th>
                <th class="col-jam">Mulai</th>
                <th class="col-jam">Selesai</th>
                <th class="col-materi">Materi Pokok</th>
                <th class="col-kegiatan">Kegiatan</th>
                <th class="col-evaluasi">Evaluasi</th>
                <th class="col-hadir">Hadir</th>
                <th class="col-tidak-hadir">Alpha</th>
                <th class="col-target">Target %</th>
                <th class="col-keterangan">Keterangan</th>
                <th class="col-kendala">Kendala</th>
                <th class="col-solusi">Solusi</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($jurnals) && count($jurnals) > 0)
                @foreach ($jurnals as $index => $jurnal)
                    <tr>
                        <td class="col-no text-center">{{ $index + 1 }}</td>
                        <td class="col-tanggal text-center">
                            @php
                                $tanggal = '-';
                                if (isset($jurnal->tanggal) && is_string($jurnal->tanggal) && $jurnal->tanggal) {
                                    $tanggal = date('d/m/Y', strtotime($jurnal->tanggal));
                                }
                            @endphp
                            {{ $tanggal }}
                        </td>
                        <td class="col-guru">
                            @if(isset($jurnal->guru) && is_object($jurnal->guru))
                                {{ $jurnal->guru->nama ?? '-' }}
                            @elseif(isset($jurnal->guru_nama))
                                {{ $jurnal->guru_nama }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="col-mapel">
                            @if(isset($jurnal->mapel) && is_object($jurnal->mapel))
                                {{ $jurnal->mapel->nama ?? '-' }}
                            @elseif(isset($jurnal->mapel_nama))
                                {{ $jurnal->mapel_nama }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="col-kelas text-center">
                            @if(isset($jurnal->kelas) && is_object($jurnal->kelas))
                                {{ $jurnal->kelas->nama ?? '-' }}
                            @elseif(isset($jurnal->kelas_nama))
                                {{ $jurnal->kelas_nama }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="col-jam text-center">
                            @php
                                $jam_mulai = '-';
                                if (isset($jurnal->jam_mulai) && is_string($jurnal->jam_mulai) && $jurnal->jam_mulai) {
                                    $jam_mulai = date('H:i', strtotime($jurnal->jam_mulai));
                                }
                            @endphp
                            {{ $jam_mulai }}
                        </td>
                        <td class="col-jam text-center">
                            @php
                                $jam_selesai = '-';
                                if (isset($jurnal->jam_selesai) && is_string($jurnal->jam_selesai) && $jurnal->jam_selesai) {
                                    $jam_selesai = date('H:i', strtotime($jurnal->jam_selesai));
                                }
                            @endphp
                            {{ $jam_selesai }}
                        </td>
                        <td class="col-materi">
                            {{ is_string($jurnal->materi_pokok ?? '') ? $jurnal->materi_pokok : '-' }}
                        </td>
                        <td class="col-kegiatan">
                            {{ is_string($jurnal->kegiatan_pembelajaran ?? '') ? $jurnal->kegiatan_pembelajaran : '-' }}
                        </td>
                        <td class="col-evaluasi">
                            {{ is_string($jurnal->evaluasi_pembelajaran ?? '') ? $jurnal->evaluasi_pembelajaran : '-' }}
                        </td>
                        <td class="col-hadir text-center">
                            @php
                                $hadir = '0';
                                if (isset($jurnal->jumlah_siswa_hadir) && (is_string($jurnal->jumlah_siswa_hadir) || is_numeric($jurnal->jumlah_siswa_hadir))) {
                                    $hadir = $jurnal->jumlah_siswa_hadir;
                                } elseif (isset($jurnal->siswa_hadir) && (is_string($jurnal->siswa_hadir) || is_numeric($jurnal->siswa_hadir))) {
                                    $hadir = $jurnal->siswa_hadir;
                                }
                            @endphp
                            {{ $hadir }}
                        </td>
                        <td class="col-tidak-hadir text-center">
                            @php
                                $tidak_hadir = '0';
                                if (isset($jurnal->jumlah_siswa_tidak_hadir) && (is_string($jurnal->jumlah_siswa_tidak_hadir) || is_numeric($jurnal->jumlah_siswa_tidak_hadir))) {
                                    $tidak_hadir = $jurnal->jumlah_siswa_tidak_hadir;
                                } elseif (isset($jurnal->siswa_tidak_hadir) && (is_string($jurnal->siswa_tidak_hadir) || is_numeric($jurnal->siswa_tidak_hadir))) {
                                    $tidak_hadir = $jurnal->siswa_tidak_hadir;
                                }
                            @endphp
                            {{ $tidak_hadir }}
                        </td>
                        <td class="col-target text-center">
                            @php
                                $target = '-';
                                if (isset($jurnal->pencapaian_target) && (is_string($jurnal->pencapaian_target) || is_numeric($jurnal->pencapaian_target))) {
                                    $target = $jurnal->pencapaian_target;
                                }
                            @endphp
                            {{ $target }}
                        </td>
                        <td class="col-keterangan">
                            {{ is_string($jurnal->keterangan_pencapaian ?? '') ? $jurnal->keterangan_pencapaian : '-' }}
                        </td>
                        <td class="col-kendala">
                            {{ is_string($jurnal->kendala_pembelajaran ?? '') ? $jurnal->kendala_pembelajaran : '-' }}
                        </td>
                        <td class="col-solusi">
                            {{ is_string($jurnal->solusi_kendala ?? '') ? $jurnal->solusi_kendala : '-' }}
                        </td>
                        <td class="col-status text-center">
                            @if(isset($jurnal->status_jurnal))
                                @if($jurnal->status_jurnal == 'approved' || $jurnal->status_jurnal == 'disetujui')
                                    <span class="status-badge status-approved">OK</span>
                                @elseif($jurnal->status_jurnal == 'pending' || $jurnal->status_jurnal == 'menunggu')
                                    <span class="status-badge status-pending">WAIT</span>
                                @else
                                    <span class="status-badge status-rejected">NO</span>
                                @endif
                            @else
                                <span class="status-badge status-pending">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="17" class="no-data">
                        Tidak ada data jurnal untuk periode yang dipilih
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 50%;">
                    <strong>Keterangan Status:</strong><br>
                    <span class="status-badge status-approved">OK</span> = Disetujui &nbsp;&nbsp;
                    <span class="status-badge status-pending">WAIT</span> = Menunggu &nbsp;&nbsp;
                    <span class="status-badge status-rejected">NO</span> = Ditolak
                </td>
                <td style="width: 50%; text-align: right;">
                    <strong>Dicetak oleh Sistem Akademik</strong><br>
                    {{ date('l, d F Y - H:i:s') }} WIB<br>
                    <span class="text-small">Dokumen ini digenerate otomatis</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div>Kepala Sekolah</div>
            <div class="signature-line"></div>
            <div class="text-bold">(.............................)</div>
            <div class="text-small">NIP. .............................</div>
        </div>
        
        <div class="signature-box">
            <div>Wakil Kepala Sekolah</div>
            <div class="signature-line"></div>
            <div class="text-bold">(.............................)</div>
            <div class="text-small">NIP. .............................</div>
        </div>
    </div>
</body>
</html>