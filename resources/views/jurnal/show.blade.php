@extends('layouts.app')

@section('title', 'Detail Jurnal Pembelajaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Jurnal Pembelajaran</h3>
                    <div class="card-tools">
                        <a href="{{ route('jurnal.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        @if(in_array(auth()->user()->role, ['admin']) || 
                            (auth()->user()->role === 'guru' && auth()->id() === $jurnal->guru_id && $jurnal->status_jurnal !== 'final'))
                            <a href="{{ route('jurnal.edit', $jurnal->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px">Kode Jurnal</th>
                                    <td>{{ $jurnal->kode_jurnal }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $jurnal->tanggal->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Guru</th>
                                    <td>{{ $jurnal->guru->name }}</td>
                                </tr>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <td>{{ $jurnal->mapel->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>{{ $jurnal->kelas->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu</th>
                                    <td>{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px">Status</th>
                                    <td>
                                        <span class="badge badge-{{ $jurnal->status_jurnal === 'final' ? 'success' : 'warning' }}">
                                            {{ ucfirst($jurnal->status_jurnal) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Siswa Hadir</th>
                                    <td>{{ $jurnal->jumlah_hadir }} Siswa</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Siswa Tidak Hadir</th>
                                    <td>{{ $jurnal->jumlah_tidak_hadir }} Siswa</td>
                                </tr>
                                <tr>
                                    <th>Pencapaian Target</th>
                                    <td>
                                        <span class="badge badge-{{ 
                                            $jurnal->pencapaian_target === 'tercapai' ? 'success' : 
                                            ($jurnal->pencapaian_target === 'sebagian' ? 'warning' : 'danger') 
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $jurnal->pencapaian_target)) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Materi dan Kegiatan</h4>
                                </div>
                                <div class="card-body">
                                    <h5>Materi Pokok</h5>
                                    <p class="text-muted">{{ $jurnal->materi_pokok }}</p>

                                    <h5>Kegiatan Pembelajaran</h5>
                                    <p class="text-muted">{!! nl2br(e($jurnal->kegiatan_pembelajaran)) !!}</p>

                                    <h5>Evaluasi Pembelajaran</h5>
                                    <p class="text-muted">{!! nl2br(e($jurnal->evaluasi_pembelajaran)) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Daftar Siswa Hadir</h4>
                                </div>
                                <div class="card-body">
                                    @if(count($siswaHadir) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Siswa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($siswaHadir as $index => $siswa)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $siswa->nama }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada data siswa hadir</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Daftar Siswa Tidak Hadir</h4>
                                </div>
                                <div class="card-body">
                                    @if(count($siswaTidakHadir) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Siswa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($siswaTidakHadir as $index => $siswa)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $siswa->nama }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada data siswa tidak hadir</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Catatan dan Evaluasi</h4>
                                </div>
                                <div class="card-body">
                                    @if($jurnal->catatan_khusus)
                                        <h5>Catatan Khusus</h5>
                                        <p class="text-muted">{!! nl2br(e($jurnal->catatan_khusus)) !!}</p>
                                    @endif

                                    @if($jurnal->kendala_pembelajaran)
                                        <h5>Kendala Pembelajaran</h5>
                                        <p class="text-muted">{!! nl2br(e($jurnal->kendala_pembelajaran)) !!}</p>
                                    @endif

                                    @if($jurnal->solusi_kendala)
                                        <h5>Solusi Kendala</h5>
                                        <p class="text-muted">{!! nl2br(e($jurnal->solusi_kendala)) !!}</p>
                                    @endif

                                    @if($jurnal->keterangan_pencapaian)
                                        <h5>Keterangan Pencapaian</h5>
                                        <p class="text-muted">{!! nl2br(e($jurnal->keterangan_pencapaian)) !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection