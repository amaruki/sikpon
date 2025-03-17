@extends('layouts.backend')

@section('content')
    <main>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Kurikulum</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                        <div class="breadcrumb-item">Kurikulum</div>
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
                @if (auth()->user()->role == 'Dev')

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header action-buttons">
                                    <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary">Tambah Kurikulum</a>
                                    <a href="{{ url('/kurikulum/export-pdf') }}" class="btn btn-danger">
                                        Export ke PDF
                                    </a>

                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kelas</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Standar Kompetensi</th>
                                                    <th>Kompetensi Dasar</th>
                                                    <th>Jam Pelajaran</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($kurikulums as $index => $kurikulum)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $kurikulum->kelas->nama }}</td>
                                                        <td>{{ $kurikulum->mapel->nama }}</td>
                                                        <td>{!! $kurikulum->standar_kompetensi !!}</td>
                                                        <td>{!! $kurikulum->kompetensi_dasar !!}</td>

                                                        <td>{{ $kurikulum->jam_pelajaran }}</td>
                                                        <td class="text-center">
                                                            <div class="action-buttons">
                                                                <a href="{{ route('kurikulum.edit', $kurikulum->id) }}" class="btn btn-sm btn-warning">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                                <form action="{{ route('kurikulum.delete', $kurikulum->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>

                                                                <a href="{{ route('kurikulum.export-pdf.id', $kurikulum->id) }}" class="btn btn-sm btn-success">
                                                                    <i class="fa fa-file-pdf"></i>
                                                                </a>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Tidak ada data kurikulum</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->role == 'Guru')

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header action-buttons">
                                    <a href="#" data-toggle="modal" data-target="#modalTambah" class="btn btn-primary">Tambah Kurikulum</a>
                                    <a href="{{ url('/kurikulum/export-pdf') }}" class="btn btn-danger">
                                        Export ke PDF
                                    </a>

                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kelas</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Standar Kompetensi</th>
                                                    <th>Kompetensi Dasar</th>
                                                    <th>Jam Pelajaran</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($kurikulums as $index => $kurikulum)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $kurikulum->kelas->nama }}</td>
                                                        <td>{{ $kurikulum->mapel->nama }}</td>
                                                        <td>{!! $kurikulum->standar_kompetensi !!}</td>
                                                        <td>{!! $kurikulum->kompetensi_dasar !!}</td>

                                                        <td>{{ $kurikulum->jam_pelajaran }}</td>
                                                        <td class="text-center">
                                                            <div class="action-buttons">
                                                                <a href="{{ route('kurikulum.edit', $kurikulum->id) }}" class="btn btn-sm btn-warning">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                                <form action="{{ route('kurikulum.delete', $kurikulum->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>

                                                                <a href="{{ route('kurikulum.export-pdf.id', $kurikulum->id) }}" class="btn btn-sm btn-success">
                                                                    <i class="fa fa-file-pdf"></i>
                                                                </a>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Tidak ada data kurikulum</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->role == 'Siswa')

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header action-buttons">
                                    <a href="{{ url('/kurikulum/export-pdf') }}" class="btn btn-danger">
                                        Export ke PDF
                                    </a>

                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kelas</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Standar Kompetensi</th>
                                                    <th>Kompetensi Dasar</th>
                                                    <th>Jam Pelajaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($kurikulums->where('jadwal_siswas_id', auth()->user()->kelas_id) as $index => $kurikulum)

                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $kurikulum->kelas->nama }}</td>
                                                        <td>{{ $kurikulum->mapel->nama }}</td>
                                                        <td>{!! $kurikulum->standar_kompetensi !!}</td>
                                                        <td>{!! $kurikulum->kompetensi_dasar !!}</td>
                                                        <td>{{ $kurikulum->jam_pelajaran }}</td>
                                                    </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data kurikulum</td>
                                                </tr>
                                            @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </section>
        </div>
    </main>
    
    <!-- Modal Tambah Kurikulum -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Kurikulum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kurikulum.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas_id" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelases as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="mapel_id" class="form-control" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($mapels as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Standar Kompetensi</label>
                            <textarea id="standar_kompetensi" name="standar_kompetensi" class="form-control" ></textarea>
                        </div>

                        <div class="form-group">
                            <label>Kompetensi Dasar</label>
                            <textarea id="kompetensi_dasar" name="kompetensi_dasar" class="form-control" ></textarea>
                        </div>

                        
                        <div class="form-group">
                            <label>Jam Pelajaran</label>
                            <input type="number" class="form-control" name="jam_pelajaran" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection