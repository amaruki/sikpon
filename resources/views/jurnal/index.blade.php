@extends('layouts.app')

@section('title', 'Daftar Jurnal Pembelajaran')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Jurnal Pembelajaran</h3>
                        @if(in_array(auth()->user()->role, ['admin', 'guru']))
                            <a href="{{ route('jurnal.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Jurnal
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="card-body">
                    {{-- Filter Form --}}
                    <form method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div class="col-md-3">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                            </div>
                            <div class="col-md-2">
                                <label>Mata Pelajaran</label>
                                <select name="mata_pelajaran_id" class="form-control">
                                    <option value="">Semua</option>
                                    @foreach($mataPelajaran as $mp)
                                        <option value="{{ $mp->id }}" {{ request('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                            {{ $mp->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Kelas</label>
                                <select name="kelas_id" class="form-control">
                                    <option value="">Semua</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-info">Filter</button>
                                    <a href="{{ route('jurnal.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <input type="text" name="search" placeholder="Cari jurnal..." class="form-control" value="{{ request('search') }}">
                            </div>
                            @if(auth()->user()->role === 'admin' && $guru->count() > 0)
                                <div class="col-md-3">
                                    <select name="guru_id" class="form-control">
                                        <option value="">Semua Guru</option>
                                        @foreach($guru as $g)
                                            <option value="{{ $g->id }}" {{ request('guru_id') == $g->id ? 'selected' : '' }}>
                                                {{ $g->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="final" {{ request('status') === 'final' ? 'selected' : '' }}>Final</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    {{-- Jurnal Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Jurnal</th>
                                    <th>Tanggal</th>
                                    <th>Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Materi</th>
                                    <th>Kehadiran</th>
                                    <th>Status</th>
                                    <th>Pencapaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jurnal as $index => $j)
                                    <tr>
                                        <td>{{ $jurnal->firstItem() + $index }}</td>
                                        <td>
                                            <strong>{{ $j->kode_jurnal }}</strong><br>
                                            <small class="text-muted">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</small>
                                        </td>
                                        <td>{{ $j->tanggal->format('d/m/Y') }}</td>
                                        <td>{{ $j->guru->name }}</td>
                                        <td>{{ $j->mataPelajaran->nama }}</td>
                                        <td>{{ $j->kelas->nama }}</td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;" title="{{ $j->materi_pokok }}">
                                                {{ $j->materi_pokok }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Hadir: {{ $j->jumlah_hadir }}</span><br>
                                            <span class="badge bg-danger">Tidak: {{ $j->jumlah_tidak_hadir }}</span>
                                        </td>
                                        <td>{!! $j->status_badge !!}</td>
                                        <td>{!! $j->pencapaian_badge !!}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('jurnal.show', $j->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'guru' && $j->guru_id === auth()->id()))
                                                    @if($j->status_jurnal === 'draft' || auth()->user()->role === 'admin')
                                                        <a href="{{ route('jurnal.edit', $j->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if($j->status_jurnal === 'draft')
                                                        <form action="{{ route('jurnal.finalisasi', $j->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-success" title="Finalisasi" 
                                                                    onclick="return confirm('Yakin ingin memfinalisasi jurnal ini?')">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                                @if(auth()->user()->role === 'admin')
                                                    <form action="{{ route('jurnal.destroy', $j->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                                                onclick="return confirm('Yakin ingin menghapus jurnal ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Tidak ada data jurnal</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Showing {{ $jurnal->firstItem() }} to {{ $jurnal->lastItem() }} of {{ $jurnal->total() }} results
                        </div>
                        {{ $jurnal->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection