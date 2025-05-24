@extends('layouts.backend')

@section('title', 'Tambah Jurnal Pembelajaran')

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
                                    <h4 class="card-title">Tambah Jurnal Pembelajaran</h4>
                                    <div class="card-header-action">
                                        <div class="btn-group">
                                            <a href="{{ route('jurnal.index') }}" class="btn btn-light btn-icon">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('jurnal.store') }}" method="POST" id="formJurnal">
                                    @csrf
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <!-- Informasi Dasar -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                                    <input type="date"
                                                        class="form-control @error('tanggal') is-invalid @enderror"
                                                        id="tanggal" name="tanggal"
                                                        value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                                                    @error('tanggal')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="guru_id">Guru <span class="text-danger">*</span></label>
                                                    <select
                                                        class="form-control select2 @error('guru_id') is-invalid @enderror"
                                                        id="guru_id" name="guru_id" required
                                                        {{ auth()->user()->role === 'Guru' ? 'disabled' : '' }}>
                                                        <option value="">Pilih Guru</option>
                                                        @foreach ($guru as $g)
                                                            <option value="{{ $g->id }}">
                                                                {{ $g->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if (auth()->user()->role === 'Guru')
                                                        <input type="hidden" name="guru_id" value="{{ auth()->id() }}">
                                                    @endif
                                                    @error('guru_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="mapel_id">Mata Pelajaran <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        class="form-control select2 @error('mapel_id') is-invalid @enderror"
                                                        id="mapel_id" name="mapel_id" required>
                                                        <option value="">Pilih Mata Pelajaran</option>
                                                        @foreach ($mapel as $m)
                                                            <option value="{{ $m->id }}"
                                                                {{ old('mapel_id') == $m->id ? 'selected' : '' }}>
                                                                {{ $m->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('mapel_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
                                                    <select
                                                        class="form-control select2 @error('kelas_id') is-invalid @enderror"
                                                        id="kelas_id" name="kelas_id" required>
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach ($kelas as $k)
                                                            <option value="{{ $k->id }}"
                                                                {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                                                {{ $k->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kelas_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="materi_pokok">Materi Pokok <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('materi_pokok') is-invalid @enderror"
                                                        id="materi_pokok" name="materi_pokok"
                                                        value="{{ old('materi_pokok') }}" required maxlength="255">
                                                    @error('materi_pokok')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jam_mulai">Jam Mulai <span
                                                            class="text-danger">*</span></label>
                                                    <input type="time"
                                                        class="form-control @error('jam_mulai') is-invalid @enderror"
                                                        id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}"
                                                        required>
                                                    @error('jam_mulai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jam_selesai">Jam Selesai <span
                                                            class="text-danger">*</span></label>
                                                    <input type="time"
                                                        class="form-control @error('jam_selesai') is-invalid @enderror"
                                                        id="jam_selesai" name="jam_selesai"
                                                        value="{{ old('jam_selesai') }}" required>
                                                    @error('jam_selesai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="kegiatan_pembelajaran">Kegiatan Pembelajaran <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control @error('kegiatan_pembelajaran') is-invalid @enderror" id="kegiatan_pembelajaran"
                                                        name="kegiatan_pembelajaran" rows="4" required>{{ old('kegiatan_pembelajaran') }}</textarea>
                                                    @error('kegiatan_pembelajaran')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="evaluasi_pembelajaran">Evaluasi Pembelajaran <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control @error('evaluasi_pembelajaran') is-invalid @enderror" id="evaluasi_pembelajaran"
                                                        name="evaluasi_pembelajaran" rows="4" required>{{ old('evaluasi_pembelajaran') }}</textarea>
                                                    @error('evaluasi_pembelajaran')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="siswa_hadir">Siswa Hadir</label>
                                                    <select
                                                        class="form-control select2 @error('siswa_hadir') is-invalid @enderror"
                                                        id="siswa_hadir" name="siswa_hadir[]" multiple>
                                                        @foreach ($siswa as $s)
                                                            <option value="{{ $s->id }}"
                                                                {{ in_array($s->id, old('siswa_hadir', [])) ? 'selected' : '' }}>
                                                                {{ $s->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('siswa_hadir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="siswa_tidak_hadir">Siswa Tidak Hadir</label>
                                                    <select
                                                        class="form-control select2 @error('siswa_tidak_hadir') is-invalid @enderror"
                                                        id="siswa_tidak_hadir" name="siswa_tidak_hadir[]" multiple>
                                                        @foreach ($siswa as $s)
                                                            <option value="{{ $s->id }}"
                                                                {{ in_array($s->id, old('siswa_tidak_hadir', [])) ? 'selected' : '' }}>
                                                                {{ $s->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('siswa_tidak_hadir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="catatan_khusus">Catatan Khusus</label>
                                                    <textarea class="form-control @error('catatan_khusus') is-invalid @enderror" id="catatan_khusus"
                                                        name="catatan_khusus" rows="3">{{ old('catatan_khusus') }}</textarea>
                                                    @error('catatan_khusus')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kendala_pembelajaran">Kendala Pembelajaran</label>
                                                    <textarea class="form-control @error('kendala_pembelajaran') is-invalid @enderror" id="kendala_pembelajaran"
                                                        name="kendala_pembelajaran" rows="3">{{ old('kendala_pembelajaran') }}</textarea>
                                                    @error('kendala_pembelajaran')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="solusi_kendala">Solusi Kendala</label>
                                                    <textarea class="form-control @error('solusi_kendala') is-invalid @enderror" id="solusi_kendala"
                                                        name="solusi_kendala" rows="3">{{ old('solusi_kendala') }}</textarea>
                                                    @error('solusi_kendala')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pencapaian_target">Pencapaian Target <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        class="form-control @error('pencapaian_target') is-invalid @enderror"
                                                        id="pencapaian_target" name="pencapaian_target" required>
                                                        <option value="">Pilih Pencapaian</option>
                                                        <option value="tercapai"
                                                            {{ old('pencapaian_target') === 'tercapai' ? 'selected' : '' }}>
                                                            Tercapai</option>
                                                        <option value="sebagian"
                                                            {{ old('pencapaian_target') === 'sebagian' ? 'selected' : '' }}>
                                                            Sebagian</option>
                                                        <option value="tidak_tercapai"
                                                            {{ old('pencapaian_target') === 'tidak_tercapai' ? 'selected' : '' }}>
                                                            Tidak Tercapai</option>
                                                    </select>
                                                    @error('pencapaian_target')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="keterangan_pencapaian">Keterangan Pencapaian</label>
                                                    <textarea class="form-control @error('keterangan_pencapaian') is-invalid @enderror" id="keterangan_pencapaian"
                                                        name="keterangan_pencapaian" rows="3">{{ old('keterangan_pencapaian') }}</textarea>
                                                    @error('keterangan_pencapaian')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="status_jurnal">Status Jurnal <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        class="form-control @error('status_jurnal') is-invalid @enderror"
                                                        id="status_jurnal" name="status_jurnal" required>
                                                        <option value="draft"
                                                            {{ old('status_jurnal') === 'draft' ? 'selected' : '' }}>Draft
                                                        </option>
                                                        <option value="final"
                                                            {{ old('status_jurnal') === 'final' ? 'selected' : '' }}>Final
                                                        </option>
                                                    </select>
                                                    @error('status_jurnal')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary btn-icon">
                                                <i class="fas fa-save"></i> Simpan
                                            </button>
                                            <a href="{{ route('jurnal.index') }}" class="btn btn-light btn-icon">
                                                <i class="fas fa-times"></i> Batal
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .select2-container--bootstrap4 .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
        }
        .select2-container--bootstrap4 .select2-selection--multiple {
            min-height: calc(2.25rem + 2px) !important;
        }
        .form-control.is-invalid + .select2-container--bootstrap4 .select2-selection {
            border-color: #dc3545;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endpush
