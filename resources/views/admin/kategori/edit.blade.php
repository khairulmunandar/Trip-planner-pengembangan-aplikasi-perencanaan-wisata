@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-3 mb-4 anim-fade-down">
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <div>
            <h1 class="h3 fw-bold mb-0" style="color:#1E1B4B;">
                <i class="bi bi-pencil-square me-2" style="color:#F59E0B;"></i>Edit Kategori
            </h1>
            <p class="text-muted mb-0 small">Mengubah: <strong>{{ $kategori->nama_kategori }}</strong></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm anim-scale" style="border-radius:1.25rem;animation-delay:.05s">
                <div class="card-body p-4 p-md-5">

                    <form method="POST" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}">
                        @csrf
                        @method('PUT')

                        {{-- Nama Kategori --}}
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label fw-semibold small" style="color:#374151;">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="nama_kategori"
                                   name="nama_kategori"
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   class="form-control @error('nama_kategori') is-invalid @enderror"
                                   placeholder="Nama kategori wisata"
                                   required>
                            @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold small" style="color:#374151;">
                                Deskripsi <span class="text-muted fw-normal">(opsional)</span>
                            </label>
                            <textarea id="deskripsi"
                                      name="deskripsi"
                                      rows="4"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Deskripsikan kategori wisata ini…">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-warning px-5 fw-semibold text-white">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
