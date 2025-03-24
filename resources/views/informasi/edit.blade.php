
@extends('layouts.backend')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit {{ $informasi->nama }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('informasi') }}">Informasi</a></div>
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
                            <form action="/informasi/update/{{ $informasi->id }}/" method="POST" enctype="multipart/form-data"
                                class="needs-validation" novalidate="">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                    <label for="kelas_id" class="col-md-3 col-form-label">Kelas</label>
                                        <div class="col-md-9">
                                            <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                                                <option value="">Pilih Kelas</option>
                                                @foreach($kelases as $kelas)
                                                    <option value="{{ $kelas->id }}" {{ $informasi->kelas_id == $kelas->id ? 'selected' : '' }}>
                                                        {{ $kelas->kelas }} {{ $kelas->nama }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('kelas_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-8 col-12">
                                            <label>Isi</label>
                                            <input type="text" name="isi" class="form-control"
                                            value="{{ $informasi->isi }}" placeholder="Nama Aset">
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Foto</label>
                                            <input type="file" name="foto" class="form-control"
                                                value="{{ $informasi->foto }}" >
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
