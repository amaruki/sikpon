@extends('layouts.backend')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Kurikulum</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('kurikulum') }}">Kurikulum</a></div>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger" align="center">
                    {{ session('error') }}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('kurikulum.update', $kurikulum->id) }}" method="POST" class="needs-validation" novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kelas</label>
                                            <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                                                <option value="">Pilih Kelas</option>
                                                @foreach($kelases as $kelas)
                                                    <option value="{{ $kelas->id }}" {{ $kurikulum->kelas_id == $kelas->id ? 'selected' : '' }}>
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
                                        <div class="col-md-6">
                                            <label>Mata Pelajaran</label>
                                            <select name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
                                                <option value="">Pilih Mata Pelajaran</option>
                                                @foreach($mapels as $mapel)
                                                    <option value="{{ $mapel->id }}" {{ $kurikulum->mapel_id == $mapel->id ? 'selected' : '' }}>
                                                        {{ $mapel->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('mapel_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label>Standar Kompetensi</label>
                                            <textarea id="standar_kompetensi" name="standar_kompetensi" class="form-control">
                                                {{ old('standar_kompetensi', $kurikulum->standar_kompetensi) }}
                                            </textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kompetensi Dasar</label>
                                            <textarea id="kompetensi_dasar" name="kompetensi_dasar" class="form-control">
                                                {{ old('kompetensi_dasar', $kurikulum->kompetensi_dasar) }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label>Jam Pelajaran</label>
                                            <input type="number" name="jam_pelajaran" class="form-control @error('jam_pelajaran') is-invalid @enderror" value="{{ $kurikulum->jam_pelajaran }}" required>
                                            @error('jam_pelajaran')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('kurikulum.index') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection