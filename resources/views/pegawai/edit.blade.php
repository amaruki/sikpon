@extends('layouts.backend')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit {{ $edit->nama }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('pegawai') }}">Guru</a></div>
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
                            <form action="/pegawai/update/{{ $edit->uuid }}/" method="POST" enctype="multipart/form-data"
                                class="needs-validation" novalidate="">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ $edit->nama }}" placeholder="Nama Pegawai">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>NIP</label>
                                            <input type="text" name="nip" class="form-control"
                                                value="{{ $edit->nip }}" placeholder="NIP Pegawai">
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6 col-12">
                                            <label>NIK</label>
                                            <input type="text" name="nik" class="form-control"
                                                value="{{ $edit->nik }}" placeholder="Nomor Induk Kependudukan">
                                        </div>
                                         <div class="form-group col-md-6 col-12">
                                            <label>No. HP</label>
                                            <input type="text" name="no_hp" class="form-control"
                                                value="{{ $edit->no_hp }}" placeholder="Nomor Handphone">
                                        </div>
                                         <div class="form-group col-md-6 col-12">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $edit->email }}" placeholder="Alamat Email">
                                        </div>
                                         <div class="form-group col-md-6 col-12">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="Laki-laki" @if($edit->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                                                <option value="Perempuan" @if($edit->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control"
                                                value="{{ $edit->tempat_lahir }}" placeholder="Tempat Lahir">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                value="{{ $edit->tanggal_lahir }}">
                                        </div>
                                         <div class="form-group col-md-6 col-12">
                                            <label>Agama</label>
                                            <input type="text" name="agama" class="form-control"
                                                value="{{ $edit->agama }}" placeholder="Agama">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Golongan Darah</label>
                                            <input type="text" name="golongan_darah" class="form-control"
                                                value="{{ $edit->golongan_darah }}" placeholder="Golongan Darah">
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap">{{ $edit->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Jabatan</label>
                                            <select name="jabatan" class="form-control" required="">
                                                <option value="Kepsek" @if ($edit->jabatan == 'Kepsek') selected @endif>
                                                    Kepsek</option>
                                                <option value="Guru" @if ($edit->jabatan == 'Guru') selected @endif>
                                                    Guru</option>
                                                <option value="Staff" @if ($edit->jabatan == 'Staff') selected @endif>
                                                    Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
