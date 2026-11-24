@extends('layouts.admin')
@section('title', 'Kelola Kategori')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 anim-fade-down">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color:#1E1B4B;">
                <i class="bi bi-tags-fill me-2" style="color:#10B981;"></i>Kelola Kategori
            </h1>
            <p class="text-muted mb-0 small">Kelola kategori wisata yang tersedia</p>
        </div>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </a>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm anim-fade-up" style="border-radius:1rem;overflow:hidden;animation-delay:.1s">
        <div class="card-body p-0">
            @if($kategori->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-tags" style="font-size:3rem;color:#C7D2FE;"></i>
                <p class="mt-3 text-muted fw-semibold">Belum ada kategori.</p>
                <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm px-4 mt-1">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
                </a>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Destinasi</th>
                            <th class="text-center" style="width:140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $k)
                        <tr class="anim-fade-up" style="animation-delay:{{ $loop->index * 0.04 }}s">
                            <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-semibold" style="color:#1E1B4B;">{{ $k->nama_kategori }}</span>
                            </td>
                            <td class="text-muted small" style="max-width:280px;">
                                {{ $k->deskripsi ? \Illuminate\Support\Str::limit($k->deskripsi, 80) : '—' }}
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill px-3" style="background:#EEF2FF;color:#4F46E5;font-size:.75rem;">
                                    {{ $k->destinasi_count ?? 0 }} destinasi
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.kategori.edit', $k->id_kategori) }}"
                                       class="btn btn-sm btn-outline-primary px-3"
                                       title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.kategori.destroy', $k->id_kategori) }}"
                                          onsubmit="return confirm('Hapus kategori \'{{ addslashes($k->nama_kategori) }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-3" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
