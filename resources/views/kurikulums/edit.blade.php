@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Kurikulum</h4>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('kurikulum.update', $kurikulum->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="kelas_id" class="col-md-3 col-form-label">Kelas</label>
                            <div class="col-md-9">
                                <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
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
                        </div>

                        <div class="form-group row">
                            <label for="mapel_id" class="col-md-3 col-form-label">Mata Pelajaran</label>
                            <div class="col-md-9">
                                <select name="mapel_id" id="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
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

                        <div class="form-group">
                            <label>Standar Kompetensi</label>
                            <textarea id="standar_kompetensi" name="standar_kompetensi" class="form-control" required>{{ $kurikulum->standar_kompetensi }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Kompetensi Dasar</label>
                            <textarea id="kompetensi_dasar" name="kompetensi_dasar" class="form-control" required>{{ $kurikulum->kompetensi_dasar }}</textarea>
                        </div>


                        <div class="form-group row">
                            <label for="jam_pelajaran" class="col-md-3 col-form-label">Jam Pelajaran</label>
                            <div class="col-md-9">
                                <input type="number" name="jam_pelajaran" id="jam_pelajaran" class="form-control @error('jam_pelajaran') is-invalid @enderror" value="{{ $kurikulum->jam_pelajaran }}" required>
                                @error('jam_pelajaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('kurikulum.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
