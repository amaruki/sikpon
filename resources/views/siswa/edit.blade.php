@extends('layouts.backend')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit {{ $edit->nama }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('siswa') }}">Siswa</a></div>
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
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="/siswa/update/{{ $edit->uuid }}/" method="POST" enctype="multipart/form-data"
                                class="needs-validation" novalidate="">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-row">
                                       <div class="col-3 col-sm-3">
                                           <label class="small mb-1" for="inputID">ID</label>
                                            <input type="text" name="id" id="inputID" class="form-control"
                                                placeholder="ID" value="{{ $edit->id }}" readonly disabled>
                                        </div>
                                        <div class="col-3 col-sm-3">
                                            <label class="small mb-1" for="inputNIK">NIK</label>
                                            <input type="text" name="nik" id="inputNIK" class="form-control"
                                                placeholder="NIK" value="{{ $edit->nik }}">
                                        </div>
                                        <div class="col-3 col-sm-3">
                                            <label class="small mb-1" for="inputNISN">NISN</label>
                                            <input type="text" name="nisn" id="inputNISN" class="form-control"
                                                placeholder="NISN" value="{{ $edit->nisn }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12 col-sm-12">
                                            <label class="small mb-1" for="inputNama">Nama</label>
                                            <input type="text" name="nama" id="inputNama" class="form-control"
                                                placeholder="Masukan Nama Siswa" value="{{ $edit->nama }}">
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-4 col-sm-4">
                                            <label class="small mb-1" for="inputTempat">Tempat Lahir</label>
                                            <input type="text" name="tempat" id="inputTempat" class="form-control"
                                                placeholder="Masukan Tempat Lahir" value="{{ $edit->tempat }}">
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="small mb-1" for="inputTTL">Tanggal</label>
                                            <input type="date" name="ttl" id="inputTTL" class="form-control"
                                                value="{{ $edit->ttl }}">
                                        </div>
                                        <div class="col-4 col-sm-4">
                                            <label class="small mb-1" for="inputJK">Jenis Kelamin</label>
                                            <select name="jk" id="inputJK" class="form-control" required="">
                                                <option value="Laki-Laki" @if ($edit->jk == 'Laki-Laki') selected @endif>
                                                    Laki-Laki</option>
                                                <option value="Perempuan" @if ($edit->jk == 'Perempuan') selected @endif>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-6 col-sm-6">
                                            <label class="small mb-1" for="inputNIS">NISN</label>
                                            <input type="number" name="nisn" id="inputNISN" class="form-control"
                                                placeholder="Masukan NISN" value="{{ $edit->nisn }}">
                                        </div>
                                        <div class="col-6 col-sm-6">
                                            <label class="small mb-1" for="inputHP">No. Hp</label>
                                            <input type="number" name="hp" id="inputHP" class="form-control"
                                                placeholder="Masukan Nomor HP" value="{{ $edit->hp }}">
                                        </div>
                                    </div>
                                    <div class="form-row mt-3 mb-4">
                                        <div class="col-12 col-sm-12">
                                            <label class="small mb-1" for="inputAlamat">Alamat</label>
                                            <textarea name="alamat" id="inputAlamat" cols="30" rows="3" class="form-control">{{ $edit->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3 mb-4">
                                        <div class="col-12 col-sm-12">
                                            <label class="small mb-1" for="inputKelas">Kelas</label>
                                            <select name="kelas_id" id="inputKelas" class="form-control">
                                                <option value="">Pilih Kelas</option>
                                                @foreach($kelas as $k)
                                                    <option value="{{ $k->id }}" @if($edit->kelas_id == $k->id) selected @endif>
                                                        {{ $k->kelas }} - {{ $k->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right mt-3">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection