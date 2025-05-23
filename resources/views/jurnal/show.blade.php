@extends('layouts.app')

@section('title', 'Detail Jurnal Pembelajaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Jurnal Pembelajaran</h3>
                    <div class="card-tools">
                        @if(Auth::user()->role !== 'wali_murid' && 
                            (Auth::user()->role === 'admin' || $jurnal->guru_id === Auth::user()->id))
                            <a href="{{ route('jurnal.edit', $jurnal->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                        
                        @if($jurnal->status_jurnal === 'draft' && 
                            (Auth::user()->role === 'admin' || $jurnal->guru_id === Auth::user()->id))
                            <a href="{{ route('jurnal.finalisasi', $jurnal->id) }}" class="btn btn-success btn-sm"
                               onclick="return confirm('Apakah Anda yakin ingin memfinalisasi jurnal ini? Jurnal yang sudah final tidak dapat diubah lagi.')">
                                <i class="fas fa-check"></i> Finalisasi
                            </a>
                        @endif
                        
                        @if(Auth::user()->role === 'admin')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        @endif
                        
                        <button onclick="window.print()" class="btn btn-info btn-sm">
                            <i class="fas fa-print"></i> Print
                        </button>
                        
                        <a href="{{ route('jurnal.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- Status dan Informasi Dasar -->
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>
                                        Status: 
                                        @if($jurnal->status_jurnal === 'final')
                                            <span class="badge badge-success">Final</span>
                                        @else
                                            <span class="badge badge-warning">Draft</span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <small class="text-muted">
                                        Kode: {{ $jurnal->kode_jurnal ?? '-' }} |
                                        Dibuat: {{ $jurnal->created_at->format('d/m/Y H:i') }}
                                        @if($jurnal->updated_at != $jurnal->created_at)
                                            | Diupdate: {{ $jurnal->updated_at->format('d/m/Y H:i') }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Umum -->
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fas fa-calendar"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tanggal & Waktu</span>
                                    <span class="info-box-number">
                                        {{ Carbon\Carbon::parse($jurnal->tanggal)->format('d F Y') }}
                                        <br>
                                        <small>{{ $jurnal->jam_mulai }} - {{ $jurnal->jam_selesai }} WIB</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-user-graduate"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Guru Pengajar</span>
                                    <span class="info-box-number">{{ $jurnal->guru->name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-book"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Mata Pelajaran</span>
                                    <span class="info-box-number">{{ $jurnal->mataPelajaran->nama }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Kelas</span>
                                    <span class="info-box-number">{{ $jurnal->kelas->nama }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Materi dan Pembelajaran -->
                        <div class="col-12 mt-3">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Materi Pembelajaran</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6><strong>Materi Pokok:</strong></h6>
                                            <p>{{ $jurnal->materi_pokok }}</p>
                                        </div>
                                        
                                        <div class="col-12">
                                            <h6><strong>Kegiatan Pembelajaran:</strong></h6>
                                            <div class="bg-light p-3 rounded">
                                                {!! nl2br(e($jurnal->kegiatan_pembelajaran)) !!}
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mt-3">
                                            <h6><strong>Evaluasi Pembelajaran:</strong></h6>
                                            <div class="bg-light p-3 rounded">
                                                {!! nl2br(e($jurnal->evaluasi_pembelajaran)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kehadiran Santri -->
                        <div class="col-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Kehadiran Santri</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6><strong>Santri Hadir ({{ $jurnal->jumlah_hadir }} orang):</strong></h6>
                                            @if(count($santriHadir) > 0)
                                                <div class="list-group">
                                                    @foreach($santriHadir as $santri)
                                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $santri->name }}
                                                            <span class="badge badge-success">Hadir</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-muted">Tidak ada data santri hadir</p>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h6><strong>Santri Tidak Hadir ({{ $jurnal->jumlah_tidak_hadir }} orang):</strong></h6>
                                            @if(count($santriTidakHadir) > 0)
                                                <div class="list-group">
                                                    @foreach($santriTidakHadir as $santri)
                                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $santri->name }}
                                                            <span class="badge badge-danger">Tidak Hadir</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-muted">Semua santri hadir</p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="progress">
                                                @php
                                                    $totalSantri = $jurnal->jumlah_hadir + $jurnal->jumlah_tidak_hadir;
                                                    $persentaseHadir = $totalSantri > 0 ? ($jurnal->jumlah_hadir / $totalSantri) * 100 : 0;
                                                @endphp
                                                <div class="progress-bar bg-success" role="progressbar" 
                                                     style="width: {{ $persentaseHadir }}%" 
                                                     aria-valuenow="{{ $persentaseHadir }}" 
                                                     aria-valuemin="0" aria-valuemax="100">
                                                    {{ number_format($persentaseHadir, 1) }}% Kehadiran
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pencapaian Target -->
                        <div class="col-12">
                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Pencapaian Target</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6><strong>Status Pencapaian:</strong></h6>
                                            @if($jurnal->pencapaian_target === 'tercapai')
                                                <span class="badge badge-success badge-lg">
                                                    <i class="fas fa-check-circle"></i> Tercapai
                                                </span>
                                            @elseif($jurnal->pencapaian_target === 'sebagian')
                                                <span class="badge badge-warning badge-lg">
                                                    <i class="fas fa-exclamation-circle"></i> Sebagian Tercapai
                                                </span>
                                            @else
                                                <span class="badge badge-danger badge-lg">
                                                    <i class="fas fa-times-circle"></i> Tidak Tercapai
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if($jurnal->keterangan_pencapaian)
                                            <div class="col-md-8">
                                                <h6><strong>Keterangan:</strong></h6>
                                                <div class="bg-light p-3 rounded">
                                                    {!! nl2br(e($jurnal->keterangan_pencapaian)) !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan dan Kendala -->
                        @if($jurnal->catatan_khusus || $jurnal->kendala_pembelajaran || $jurnal->solusi_kendala)
                            <div class="col-12">
                                <div class="card card-outline card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">Catatan dan Kendala</h3>
                                    </div>
                                    <div class="card-body">
                                        @if($jurnal->catatan_khusus)
                                            <div class="mb-3">
                                                <h6><strong>Catatan Khusus:</strong></h6>
                                                <div class="bg-light p-3 rounded">
                                                    {!! nl2br(e($jurnal->catatan_khusus)) !!}
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($jurnal->kendala_pembelajaran)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6><strong>Kendala Pembelajaran:</strong></h6>
                                                    <div class="bg-light p-3 rounded">
                                                        {!! nl2br(e($jurnal->kendala_pembelajaran)) !!}
                                                    </div>
                                                </div>
                                                
                                                @if($jurnal->solusi_kendala)
                                                    <div class="col-md-6">
                                                        <h6><strong>Solusi Kendala:</strong></h6>
                                                        <div class="bg-light p-3 rounded">
                                                            {!! nl2br(e($jurnal->solusi_kendala)) !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
@if(Auth::user()->role === 'admin')
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this journal entry?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>