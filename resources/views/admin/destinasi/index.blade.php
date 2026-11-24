@extends('layouts.admin')
@section('title', 'Kelola Destinasi')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 anim-fade-down">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color:#1E1B4B;">
                <i class="bi bi-geo-alt-fill me-2" style="color:#6366F1;"></i>Kelola Destinasi
            </h1>
            <p class="text-muted mb-0 small">Kelola semua destinasi wisata yang tersedia</p>
        </div>
        <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-lg me-1"></i> Tambah Destinasi
        </a>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm anim-fade-up" style="border-radius:1rem;overflow:hidden;animation-delay:.1s">
        <div class="card-body p-0">
            @if($destinasi->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-geo-alt" style="font-size:3rem;color:#C7D2FE;"></i>
                <p class="mt-3 text-muted fw-semibold">Belum ada destinasi.</p>
                <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary btn-sm px-4 mt-1">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Destinasi
                </a>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:70px;">Foto</th>
                            <th>Nama Destinasi</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Harga Tiket</th>
                            <th class="text-center" style="width:140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($destinasi as $d)
                        <tr class="anim-fade-up" style="animation-delay:{{ $loop->index * 0.04 }}s">
                            <td>
                                @if($d->foto)
                                <img src="{{ $d->foto_url }}"
                                     alt="{{ $d->nama_destinasi }}"
                                     class="thumb-sm"
                                     onerror="this.onerror=null;this.src='{{ $d->svg_fallback }}'">
                                @else
                                <div class="thumb-sm d-flex align-items-center justify-content-center"
                                     style="background:#EEF2FF;border-radius:.5rem;">
                                    <i class="bi bi-image" style="color:#A5B4FC;font-size:1.25rem;"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold d-block" style="color:#1E1B4B;">{{ $d->nama_destinasi }}</span>
                                <span class="text-muted small">{{ \Illuminate\Support\Str::limit($d->deskripsi, 50) }}</span>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3" style="background:#EEF2FF;color:#4F46E5;font-size:.75rem;">
                                    {{ $d->kategori->nama_kategori ?? '—' }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                <i class="bi bi-pin-map me-1"></i>{{ $d->lokasi }}
                            </td>
                            <td class="fw-semibold small" style="color:#059669;">
                                Rp {{ number_format($d->harga_tiket, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.destinasi.edit', $d->id_destinasi) }}"
                                       class="btn btn-sm btn-outline-primary px-3"
                                       title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.destinasi.destroy', $d->id_destinasi) }}"
                                          onsubmit="return confirm('Hapus destinasi \'{{ addslashes($d->nama_destinasi) }}\'?')">
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

            {{-- Pagination --}}
            @if($destinasi->hasPages())
            <div class="px-4 py-3 border-top">
                {{ $destinasi->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>

</div>
@endsection
