@extends('layouts.app')

@section('title', 'Tambah Jurnal Pembelajaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Jurnal Pembelajaran</h3>
                    <div class="card-tools">
                        <a href="{{ route('jurnal.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guru_id">Guru <span class="text-danger">*</span></label>
                                    <select class="form-control select2 @error('guru_id') is-invalid @enderror" 
                                            id="guru_id" name="guru_id" required>
                                        <option value="">Pilih Guru</option>
                                        @foreach($guru as $g)
                                            <option value="{{ $g->id }}" 
                                                {{ (old('guru_id', Auth::user()->role === 'guru' ? Auth::user()->id : '') == $g->id) ? 'selected' : '' }}>
                                                {{ $g->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('guru_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mata_pelajaran_id">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <select class="form-control select2 @error('mata_pelajaran_id') is-invalid @enderror" 
                                            id="mata_pelajaran_id" name="mata_pelajaran_id" required>
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mataPelajaran as $mp)
                                            <option value="{{ $mp->id }}" {{ old('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                                {{ $mp->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mata_pelajaran_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
                                    <select class="form-control select2 @error('kelas_id') is-invalid @enderror" 
                                            id="kelas_id" name="kelas_id" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach($kelas as $k)
                                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Waktu -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jam_mulai">Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                           id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jam_selesai">Jam Selesai <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                           id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Materi -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="materi_pokok">Materi Pokok <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('materi_pokok') is-invalid @enderror" 
                                           id="materi_pokok" name="materi_pokok" value="{{ old('materi_pokok') }}" 
                                           placeholder="Masukkan materi pokok pembelajaran" required>
                                    @error('materi_pokok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="kegiatan_pembelajaran">Kegiatan Pembelajaran <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('kegiatan_pembelajaran') is-invalid @enderror" 
                                              id="kegiatan_pembelajaran" name="kegiatan_pembelajaran" rows="4" 
                                              placeholder="Deskripsikan kegiatan pembelajaran yang dilakukan" required>{{ old('kegiatan_pembelajaran') }}</textarea>
                                    @error('kegiatan_pembelajaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="evaluasi_pembelajaran">Evaluasi Pembelajaran <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('evaluasi_pembelajaran') is-invalid @enderror" 
                                              id="evaluasi_pembelajaran" name="evaluasi_pembelajaran" rows="4" 
                                              placeholder="Evaluasi hasil pembelajaran dan pemahaman siswa" required>{{ old('evaluasi_pembelajaran') }}</textarea>
                                    @error('evaluasi_pembelajaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kehadiran Santri -->
                            <div class="col-12">
                                <h5 class="mt-3 mb-3">Kehadiran Santri</h5>
                                <div id="kehadiran-section" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Santri Hadir</label>
                                                <div id="santri-hadir-list" class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                                    <p class="text-muted">Pilih kelas terlebih dahulu</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Santri Tidak Hadir</label>
                                                <div id="santri-tidak-hadir-list" class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                                    <p class="text-muted">Pilih kelas terlebih dahulu</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pencapaian Target -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pencapaian_target">Pencapaian Target <span class="text-danger">*</span></label>
                                    <select class="form-control @error('pencapaian_target') is-invalid @enderror" 
                                            id="pencapaian_target" name="pencapaian_target" required>
                                        <option value="">Pilih Pencapaian</option>
                                        <option value="tercapai" {{ old('pencapaian_target') == 'tercapai' ? 'selected' : '' }}>Tercapai</option>
                                        <option value="sebagian" {{ old('pencapaian_target') == 'sebagian' ? 'selected' : '' }}>Sebagian Tercapai</option>
                                        <option value="tidak_tercapai" {{ old('pencapaian_target') == 'tidak_tercapai' ? 'selected' : '' }}>Tidak Tercapai</option>
                                    </select>
                                    @error('pencapaian_target')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status_jurnal">Status Jurnal <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status_jurnal') is-invalid @enderror" 
                                            id="status_jurnal" name="status_jurnal" required>
                                        <option value="draft" {{ old('status_jurnal', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="final" {{ old('status_jurnal') == 'final' ? 'selected' : '' }}>Final</option>
                                    </select>
                                    @error('status_jurnal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="keterangan_pencapaian">Keterangan Pencapaian</label>
                                    <textarea class="form-control @error('keterangan_pencapaian') is-invalid @enderror" 
                                              id="keterangan_pencapaian" name="keterangan_pencapaian" rows="3" 
                                              placeholder="Jelaskan detail pencapaian target pembelajaran">{{ old('keterangan_pencapaian') }}</textarea>
                                    @error('keterangan_pencapaian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Catatan dan Kendala -->
                            <div class="col-12">
                                <h5 class="mt-3 mb-3">Catatan dan Kendala</h5>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="catatan_khusus">Catatan Khusus</label>
                                    <textarea class="form-control @error('catatan_khusus') is-invalid @enderror" 
                                              id="catatan_khusus" name="catatan_khusus" rows="3" 
                                              placeholder="Catatan khusus terkait pembelajaran">{{ old('catatan_khusus') }}</textarea>
                                    @error('catatan_khusus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kendala_pembelajaran">Kendala Pembelajaran</label>
                                    <textarea class="form-control @error('kendala_pembelajaran') is-invalid @enderror" 
                                              id="kendala_pembelajaran" name="kendala_pembelajaran" rows="3" 
                                              placeholder="Kendala yang dihadapi saat pembelajaran">{{ old('kendala_pembelajaran') }}</textarea>
                                    @error('kendala_pembelajaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="solusi_kendala">Solusi Kendala</label>
                                    <textarea class="form-control @error('solusi_kendala') is-invalid @enderror" 
                                              id="solusi_kendala" name="solusi_kendala" rows="3" 
                                              placeholder="Solusi untuk mengatasi kendala">{{ old('solusi_kendala') }}</textarea>
                                    @error('solusi_kendala')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Jurnal
                        </button>
                        <a href="{{ route('jurnal.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Load santri when kelas selected
    $('#kelas_id').change(function() {
        var kelasId = $(this).val();
        if (kelasId) {
            loadSantriByKelas(kelasId);
        } else {
            $('#kehadiran-section').hide();
        }
    });

    // Function to load santri by kelas
    function loadSantriByKelas(kelasId) {
        $.ajax({
            url: '{{ route("jurnal.get-santri-by-kelas") }}',
            type: 'GET',
            data: { kelas_id: kelasId },
            success: function(response) {
                var hadirHtml = '';
                var tidakHadirHtml = '';
                
                if (response.length > 0) {
                    response.forEach(function(santri) {
                        hadirHtml += `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="santri_hadir[]" 
                                       value="${santri.id}" id="hadir_${santri.id}">
                                <label class="form-check-label" for="hadir_${santri.id}">
                                    ${santri.name} (${santri.nis || '-'})
                                </label>
                            </div>
                        `;
                        
                        tidakHadirHtml += `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="santri_tidak_hadir[]" 
                                       value="${santri.id}" id="tidak_hadir_${santri.id}">
                                <label class="form-check-label" for="tidak_hadir_${santri.id}">
                                    ${santri.name} (${santri.nis || '-'})
                                </label>
                            </div>
                        `;
                    });
                } else {
                    hadirHtml = '<p class="text-muted">Tidak ada santri di kelas ini</p>';
                    tidakHadirHtml = '<p class="text-muted">Tidak ada santri di kelas ini</p>';
                }
                
                $('#santri-hadir-list').html(hadirHtml);
                $('#santri-tidak-hadir-list').html(tidakHadirHtml);
                $('#kehadiran-section').show();
            },
            error: function() {
                alert('Gagal memuat data santri');
            }
        });
    }

    // Prevent same santri selected in both hadir and tidak hadir
    $(document).on('change', 'input[name="santri_hadir[]"]', function() {
        var santriId = $(this).val();
        if ($(this).is(':checked')) {
            $(`input[name="santri_tidak_hadir[]"][value="${santriId}"]`).prop('checked', false);
        }
    });

    $(document).on('change', 'input[name="santri_tidak_hadir[]"]', function() {
        var santriId = $(this).val();
        if ($(this).is(':checked')) {
            $(`input[name="santri_hadir[]"][value="${santriId}"]`).prop('checked', false);
        }
    });

    // Form validation
    $('#formJurnal').on('submit', function(e) {
        var jamMulai = $('#jam_mulai').val();
        var jamSelesai = $('#jam_selesai').val();
        
        if (jamMulai && jamSelesai && jamMulai >= jamSelesai) {
            alert('Jam selesai harus lebih besar dari jam mulai');
            e.preventDefault();
            return false;
        }
    });

    // Auto-hide guru selection for guru role
    @if(Auth::user()->role === 'guru')
        $('#guru_id').prop('disabled', true);
    @endif
});
</script>
@endpush