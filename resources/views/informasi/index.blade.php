@extends('layouts.backend')

@section('content')

    <main>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Informasi</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ url('home', []) }}">Dashboard</a></div>
                        {{-- <div class="breadcrumb-item"><a href="#">Modules</a></div> --}}
                        <div class="breadcrumb-item">Informasi</div>
                    </div>
                </div>
                @if (\Session::has('notif'))
                    <div class="alert alert-primary" align="center">
                        {!! \Session::get('notif') !!}
                    </div>
                @endif
                <!-- error -->
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (auth()->user()->role == 'Dev')
                <!-- end error -->
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="" data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary">Tambah</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th width="6%">No</th>
                                                    <th>Kelas</th>
                                                    <th>Isi</th>
                                                    <th>Foto</th>
                                                    <th class="text-center">Pilihan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($informasis->count() == 0)
                                                    <tr align="center">
                                                        <th colspan="4">Belum Ada Data !!!</th>
                                                    </tr>
                                                @else
                                                    @foreach ($informasis as $index =>$item)
                                                        <tr>
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{ ($item->kelas)->nama ?? 'Tidak Ada Kelas' }}</td>

                                                            <td>{{ $item->isi }}</td>
                                                            <td>
                                                                <a href="{{ url('/informasi_foto/' . $item->foto) }}"
                                                                    target="_blank"><i class="fa fa-file-image"
                                                                        aria-hidden="true"></i> Lihat
                                                                </a>
                                                            </td>
                                                            <td nowrap align="center">
                                                                <a href="/informasi/edit/{{ $item->id }}/"
                                                                    class="btn btn-warning btn-sm">
                                                                    <i class="fa fa-edit"> </i>
                                                                </a>
                                                                <a href="/informasi/delete/{{ $item->id }}/"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Anda yakin ingin menghapus ?')">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->role == 'Guru' )
                <!-- end error -->
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                                    <a href="" data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary">Tambah</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th width="6%">No</th>
                                                    <th>Kelas</th>
                                                    <th>Isi</th>
                                                    <th>Foto</th>
                                                    <th class="text-center">Pilihan</th>
                                            </thead>
                                            <tbody>
                                                @if ($informasis->count() == 0)
                                                    <tr align="center">
                                                        <th colspan="4">Belum Ada Data !!!</th>
                                                    </tr>
                                                @else
                                                    @foreach ($informasis as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ ($item->kelas)->nama ?? 'Tidak Ada Kelas' }}</td>
                                                            <td>{{ $item->isi }}</td>
                                                            <td>
                                                                <a href="{{ url('/informasi_foto/' . $item->foto) }}"
                                                                    target="_blank"><i class="fa fa-file-image"
                                                                        aria-hidden="true"></i> Lihat
                                                                </a>
                                                            </td>
                                                            <td nowrap align="center">
                                                                <a href="/informasi/edit/{{ $item->id }}/"
                                                                    class="btn btn-warning btn-sm">
                                                                    <i class="fa fa-edit"> </i>
                                                                </a>
                                                                <a href="/informasi/delete/{{ $item->id }}/"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Anda yakin ingin menghapus ?')">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->role == 'Siswa' )
                <!-- end error -->
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                              
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th width="6%">No</th>
                                                    <th>Isi</th>
                                                    <th>Foto</th>
                                                    
                                            </thead>
                                            <tbody>
                                                @if ($informasis->count() == 0)
                                                    <tr align="center">
                                                        <th colspan="4">Belum Ada Data !!!</th>
                                                    </tr>
                                                @else
                                                    @foreach ($informasis as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->isi }}</td>
                                                            <td>
                                                                <a href="{{ url('/informasi_foto/' . $item->foto) }}"
                                                                    target="_blank"><i class="fa fa-file-image"
                                                                        aria-hidden="true"></i> Lihat
                                                                </a>
                                                            </td>
                                                           
                                                        </tr>
                                                    @endforeach
                                                @endif
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
    <!-- Modal Tambah Informasi -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/informasi/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="isi">Isi</label>
                        <textarea name="isi" id="isi" cols="30" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="kelas_id">Kelas (Opsional)</label>
                        <select name="kelas_id" id="kelas_id" class="form-control">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelases as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    {{-- stop modal --}}
@endsection
