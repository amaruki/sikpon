@extends('layouts.backend')

@section('title', 'Detail Jurnal Pembelajaran')

@section('content')
    <main>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Jurnal</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                        <div class="breadcrumb-item">Jurnal</div>
                    </div>
                </div>
                @if (session('notif'))
                    <div class="alert alert-primary text-center">
                        {!! session('notif') !!}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Detail Jurnal Pembelajaran</h4>
                                    <div class="card-header-action">
                                        <div class="btn-group">
                                            <a href="{{ route('jurnal.index') }}" class="btn btn-light btn-icon">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </a>
                                            @if (in_array(auth()->user()->role, ['Dev']) ||
                                                    (auth()->user()->role === 'Guru' && auth()->id() === $jurnal->guru_id && $jurnal->status_jurnal !== 'final'))
                                                <a href="{{ route('jurnal.edit', $jurnal->id) }}" class="btn btn-warning btn-icon">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endif
                                            <a href="{{ route('jurnal.pdf', $jurnal->id) }}" class="btn btn-info btn-icon" target="_blank">
                                                <i class="fas fa-print"></i> Cetak PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th style="width: 200px">
                                                        <i class="fas fa-bookmark text-primary"></i> Kode Jurnal
                                                    </th>
                                                    <td><strong>{{ $jurnal->kode_jurnal }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-calendar text-primary"></i> Tanggal
                                                    </th>
                                                    <td>{{ $jurnal->tanggal->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-user text-primary"></i> Guru
                                                    </th>
                                                    <td>{{ $jurnal->guru->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-book text-primary"></i> Mata Pelajaran
                                                    </th>
                                                    <td>{{ $jurnal->mapel->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-school text-primary"></i> Kelas
                                                    </th>
                                                    <td>{{ $jurnal->kelas->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-clock text-primary"></i> Waktu
                                                    </th>
                                                    <td>{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th style="width: 200px">
                                                        <i class="fas fa-info-circle text-info"></i> Status
                                                    </th>
                                                    <td>
                                                        <span class="badge badge-{{ $jurnal->status_jurnal === 'final' ? 'success' : 'warning' }} badge-pill">
                                                            <i class="fas fa-{{ $jurnal->status_jurnal === 'final' ? 'check-circle' : 'clock' }}"></i>
                                                            {{ ucfirst($jurnal->status_jurnal) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-users text-success"></i> Jumlah Siswa Hadir
                                                    </th>
                                                    <td>
                                                        <span class="badge badge-success badge-pill">
                                                            {{ $jurnal->jumlah_hadir }} Siswa
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-user-slash text-danger"></i> Jumlah Siswa Tidak Hadir
                                                    </th>
                                                    <td>
                                                        <span class="badge badge-danger badge-pill">
                                                            {{ $jurnal->jumlah_tidak_hadir }} Siswa
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-bullseye text-info"></i> Pencapaian Target
                                                    </th>
                                                    <td>
                                                        <span class="badge badge-{{ $jurnal->pencapaian_target === 'tercapai'
                                                            ? 'success'
                                                            : ($jurnal->pencapaian_target === 'sebagian'
                                                                ? 'warning'
                                                                : 'danger') }} badge-pill">
                                                            <i class="fas fa-{{ $jurnal->pencapaian_target === 'tercapai' 
                                                                ? 'check-circle' 
                                                                : ($jurnal->pencapaian_target === 'sebagian' 
                                                                    ? 'adjust' 
                                                                    : 'times-circle') }}"></i>
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
                                                    <h4 class="card-title">
                                                        <i class="fas fa-chalkboard-teacher text-primary"></i>
                                                        Materi dan Kegiatan Pembelajaran
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label class="text-primary">
                                                            <i class="fas fa-book-open"></i> Materi Pokok
                                                        </label>
                                                        <p class="border-bottom pb-2">{{ $jurnal->materi_pokok }}</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="text-primary">
                                                            <i class="fas fa-tasks"></i> Kegiatan Pembelajaran
                                                        </label>
                                                        <p class="border-bottom pb-2">{!! nl2br(e($jurnal->kegiatan_pembelajaran)) !!}</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="text-primary">
                                                            <i class="fas fa-clipboard-check"></i> Evaluasi Pembelajaran
                                                        </label>
                                                        <p class="border-bottom pb-2">{!! nl2br(e($jurnal->evaluasi_pembelajaran)) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        <i class="fas fa-user-check text-success"></i>
                                                        Daftar Kehadiran Siswa
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    @if (count($siswaHadir) > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="10%">No</th>
                                                                        <th>Nama Siswa</th>
                                                                        <th width="15%" class="text-center">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($siswaHadir as $index => $siswa)
                                                                        <tr>
                                                                            <td>{{ $index + 1 }}</td>
                                                                            <td>{{ $siswa->nama }}</td>
                                                                            <td class="text-center">
                                                                                <span class="badge badge-success badge-pill">
                                                                                    <i class="fas fa-check"></i> Hadir
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @else
                                                        <div class="alert alert-light">
                                                            <i class="fas fa-info-circle"></i> Tidak ada data siswa hadir
                                                        </div>
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
                                                    @if (count($siswaTidakHadir) > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Siswa</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($siswaTidakHadir as $index => $siswa)
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
                                                    @if ($jurnal->catatan_khusus)
                                                        <h5>Catatan Khusus</h5>
                                                        <p class="text-muted">{!! nl2br(e($jurnal->catatan_khusus)) !!}</p>
                                                    @endif

                                                    @if ($jurnal->kendala_pembelajaran)
                                                        <h5>Kendala Pembelajaran</h5>
                                                        <p class="text-muted">{!! nl2br(e($jurnal->kendala_pembelajaran)) !!}</p>
                                                    @endif

                                                    @if ($jurnal->solusi_kendala)
                                                        <h5>Solusi Kendala</h5>
                                                        <p class="text-muted">{!! nl2br(e($jurnal->solusi_kendala)) !!}</p>
                                                    @endif

                                                    @if ($jurnal->keterangan_pencapaian)
                                                        <h5>Keterangan Pencapaian</h5>
                                                        <p class="text-muted">{!! nl2br(e($jurnal->keterangan_pencapaian)) !!}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mb-3">
                                        <a href="{{ route('jurnal.pdf', $jurnal->id) }}" class="btn btn-primary">
                                            <i class="fas fa-file-pdf"></i> Export PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
