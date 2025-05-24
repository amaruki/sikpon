@extends('layouts.backend')

@section('title', 'Daftar Jurnal Pembelajaran')

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
                                    <h4 class="card-title">Data Jurnal Pembelajaran</h4>
                                    <div class="card-header-action">
                                        @if (auth()->user()->role == 'Dev' || auth()->user()->role == 'Guru')
                                            <a href="{{ route('jurnal.create') }}" class="btn btn-icon btn-primary">
                                                <i class="fas fa-plus"></i> Tambah Jurnal
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body">
                                    {{-- Filter Form --}}
                                    <form method="GET" class="mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Tanggal Mulai</label>
                                                    <input type="date" name="tanggal_mulai" class="form-control"
                                                        value="{{ request('tanggal_mulai') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Tanggal Selesai</label>
                                                    <input type="date" name="tanggal_selesai" class="form-control"
                                                        value="{{ request('tanggal_selesai') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Mata Pelajaran</label>
                                                <select name="mapel_id" class="form-control select2">
                                                    <option value="">Semua</option>
                                                    @foreach ($mapel as $m)
                                                        <option value="{{ $m->id }}"
                                                            {{ request('mapel_id') == $m->id ? 'selected' : '' }}>
                                                            {{ $m->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Kelas</label>
                                                <select name="kelas_id" class="form-control select2">
                                                    <option value="">Semua</option>
                                                    @foreach ($kelas as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                                            {{ $k->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if (auth()->user()->role === 'Dev')
                                                <div class="col-md-2">
                                                    <label>Guru</label>
                                                    <select name="guru_id" class="form-control select2">
                                                        <option value="">Semua</option>
                                                        @foreach ($guru as $g)
                                                            <option value="{{ $g->id }}"
                                                                {{ request('guru_id') == $g->id ? 'selected' : '' }}>
                                                                {{ $g->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            <div class="col-md-2">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="draft"
                                                        {{ request('status') === 'draft' ? 'selected' : '' }}>
                                                        Draft</option>
                                                    <option value="published"
                                                        {{ request('status') === 'published' ? 'selected' : '' }}>Published
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 align-self-end">
                                                <div class="form-group">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-primary btn-icon">
                                                            <i class="fas fa-search"></i> Filter
                                                        </button>
                                                        <a href="{{ route('jurnal.index') }}" class="btn btn-light btn-icon">
                                                            <i class="fas fa-redo"></i> Reset
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    {{-- Tabel Jurnal --}}
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th width="5%" class="text-center">No</th>
                                                    <th width="10%">Tanggal</th>
                                                    <th width="12%">Kode Jurnal</th>
                                                    <th width="15%">Guru</th>
                                                    <th width="13%">Mata Pelajaran</th>
                                                    <th width="10%">Kelas</th>
                                                    <th>Materi Pokok</th>
                                                    <th width="8%" class="text-center">Status</th>
                                                    <th width="12%" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($jurnal as $index => $j)
                                                    <tr>
                                                        <td class="text-center">{{ $jurnal->firstItem() + $index }}</td>
                                                        <td>{{ $j->tanggal->format('d/m/Y') }}</td>
                                                        <td>{{ $j->kode_jurnal }}</td>
                                                        <td>{{ $j->guru->nama }}</td>
                                                        <td>{{ $j->mapel->nama }}</td>
                                                        <td>{{ $j->kelas->nama }}</td>
                                                        <td>{{ \Str::limit($j->materi_pokok, 50) }}</td>
                                                        <td class="text-center">
                                                            <span class="badge badge-{{ $j->status_jurnal === 'final' ? 'success' : 'warning' }}">
                                                                {{ $j->status_jurnal === 'final' ? 'Final' : 'Draft' }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('jurnal.show', $j->id) }}"
                                                                    class="btn btn-info btn-sm" title="Lihat Detail">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                @if (in_array(auth()->user()->role, ['Dev', 'Guru']) &&
                                                                        (auth()->user()->role === 'Dev' || auth()->id() === $j->guru_id))
                                                                    <a href="{{ route('jurnal.edit', $j->id) }}"
                                                                        class="btn btn-warning btn-sm" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                <form action="{{ route('jurnal.destroy', $j->id) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center">Tidak ada data jurnal</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{ $jurnal->links() }}
                                </div>
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
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>
@endpush
