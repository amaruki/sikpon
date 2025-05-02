@extends('layouts.backend')

@section('content')
    <main>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Siswa</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ url('home', []) }}">Dashboard</a></div>
                        <div class="breadcrumb-item">Siswa</div>
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
                <!-- end error -->
                
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="" data-toggle="modal" data-target="#tambahSiswaModal"
                                        class="btn btn-primary">Tambah Siswa</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th width="6%">No</th>
                                                    <th>Nama</th>
                                                    <th>TTL</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>NISN</th>
                                                    <th>Kelas</th>
                                                    <th class="text-center">Pilihan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($siswa->count() == 0)
                                                    <tr align="center">
                                                        <th colspan="8">Belum Ada Siswa</th>
                                                    </tr>
                                                @else
                                                    @foreach ($siswa as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ $item->tempat }},
                                                                {{ date('d-m-Y', strtotime($item->ttl ?? '')) }}
                                                            </td>
                                                            <td>{{ $item->jk ?? '-' }}</td>
                                                            <td>{{ $item->nisn ?? '-' }}</td>
                                                            <td>
                                                                @foreach ($kelas as $k)
                                                                    @if ($k->id == $item->kelas_id)
                                                                        {{ $k->kelas }} - {{ $k->nama }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td nowrap align="center">
                                                                <a href="/siswa/edit/{{ $item->uuid }}/"
                                                                    class="btn btn-warning btn-sm">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="/siswa/delete/{{ $item->uuid }}/"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Anda yakin ingin menghapus data siswa ini?')">
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
            </section>
        </div>
    </main>
    
    <!-- Modal tambah -->
    <div class="modal fade" id="tambahSiswaModal" tabindex="-1" role="dialog" aria-labelledby="tambahSiswaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/siswa/store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-12 col-sm-12">
                                <label class="small mb-1" for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Siswa" required>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-4 col-sm-4">
                                <label class="small mb-1" for="tempat">Tempat Lahir</label>
                                <input type="text" name="tempat" id="tempat" class="form-control"
                                    placeholder="Masukan Tempat Lahir" required>
                            </div>
                            <div class="col-4 col-sm-4">
                                <label class="small mb-1" for="ttl">Tanggal Lahir</label>
                                <input type="date" name="ttl" id="ttl" class="form-control" required>
                            </div>
                            <div class="col-4 col-sm-4">
                                <label class="small mb-1" for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih --</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-6 col-sm-6">
                                <label class="small mb-1" for="nisn">NISN</label>
                                <input type="number" name="nisn" id="nisn" class="form-control" placeholder="Masukan NISN">
                            </div>
                            <div class="col-6 col-sm-6">
                                <label class="small mb-1" for="hp">No HP</label>
                                <input type="number" name="hp" id="hp" class="form-control" placeholder="Masukan Nomor HP">
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-12 col-sm-12">
                                <label class="small mb-1" for="kelas_id">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->kelas }} - {{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-3 mb-4">
                            <div class="col-12 col-sm-12">
                                <label class="small mb-1" for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" placeholder="Masukan Alamat" required></textarea>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection