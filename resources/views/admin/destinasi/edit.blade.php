@extends('layouts.admin')
@section('title', 'Edit Destinasi')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-3 mb-4 anim-fade-down">
        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <div>
            <h1 class="h3 fw-bold mb-0" style="color:#1E1B4B;">
                <i class="bi bi-pencil-square me-2" style="color:#F59E0B;"></i>Edit Destinasi
            </h1>
            <p class="text-muted mb-0 small">Mengubah: <strong>{{ $destinasi->nama_destinasi }}</strong></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm anim-scale" style="border-radius:1.25rem;animation-delay:.05s">
                <div class="card-body p-4 p-md-5">

                    {{-- Current Photo Preview --}}
                    @if($destinasi->foto)
                    <div class="mb-4 text-center">
                        <p class="fw-semibold small text-muted mb-2">Foto Saat Ini</p>
                        <img src="{{ $destinasi->foto_url }}"
                             alt="{{ $destinasi->nama_destinasi }}"
                             class="rounded-3 shadow-sm"
                             style="max-height:200px;max-width:100%;object-fit:cover;"
                             onerror="this.onerror=null;this.src='{{ $destinasi->svg_fallback }}'">
                    </div>
                    @endif

                    <form method="POST"
                          action="{{ route('admin.destinasi.update', $destinasi->id_destinasi) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">

                            {{-- Nama Destinasi --}}
                            <div class="col-12">
                                <label for="nama_destinasi" class="form-label fw-semibold small" style="color:#374151;">
                                    Nama Destinasi <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       id="nama_destinasi"
                                       name="nama_destinasi"
                                       value="{{ old('nama_destinasi', $destinasi->nama_destinasi) }}"
                                       class="form-control @error('nama_destinasi') is-invalid @enderror"
                                       required>
                                @error('nama_destinasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kategori --}}
                            <div class="col-md-6">
                                <label for="id_kategori" class="form-label fw-semibold small" style="color:#374151;">
                                    Kategori <span class="text-danger">*</span>
                                </label>
                                <select id="id_kategori"
                                        name="id_kategori"
                                        class="form-select @error('id_kategori') is-invalid @enderror"
                                        required>
                                    <option value="">— Pilih Kategori —</option>
                                    @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}"
                                            {{ old('id_kategori', $destinasi->id_kategori) == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label fw-semibold small" style="color:#374151;">
                                    Lokasi <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       id="lokasi"
                                       name="lokasi"
                                       value="{{ old('lokasi', $destinasi->lokasi) }}"
                                       class="form-control @error('lokasi') is-invalid @enderror"
                                       required>
                                @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Harga Tiket --}}
                            <div class="col-md-6">
                                <label for="harga_tiket" class="form-label fw-semibold small" style="color:#374151;">
                                    Harga Tiket (Rp) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text fw-semibold" style="background:#EEF2FF;color:#4F46E5;border-color:#C7D2FE;">Rp</span>
                                    <input type="number"
                                           id="harga_tiket"
                                           name="harga_tiket"
                                           value="{{ old('harga_tiket', $destinasi->harga_tiket) }}"
                                           class="form-control @error('harga_tiket') is-invalid @enderror"
                                           min="0"
                                           step="1000"
                                           required>
                                    @error('harga_tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Foto (new) --}}
                            <div class="col-md-6">
                                <label for="foto" class="form-label fw-semibold small" style="color:#374151;">
                                    Ganti Foto <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <input type="file"
                                       id="foto"
                                       name="foto"
                                       accept="image/*"
                                       class="form-control @error('foto') is-invalid @enderror"
                                       onchange="previewImage(this)">
                                @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Biarkan kosong jika tidak ingin mengganti foto</div>
                                <div id="preview-wrapper" class="mt-2 d-none">
                                    <p class="small text-muted mb-1">Preview Foto Baru:</p>
                                    <img id="image-preview" src="" alt="Preview" class="rounded shadow-sm" style="max-height:140px;width:100%;object-fit:cover;">
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label for="deskripsi" class="form-label fw-semibold small" style="color:#374151;">
                                    Deskripsi <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <textarea id="deskripsi"
                                          name="deskripsi"
                                          rows="5"
                                          class="form-control @error('deskripsi') is-invalid @enderror"
                                          placeholder="Deskripsikan destinasi wisata ini…">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="col-12 d-flex justify-content-end gap-2 pt-2">
                                <a href="{{ route('admin.destinasi.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" class="btn btn-warning px-5 fw-semibold text-white">
                                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
function previewImage(input) {
    const wrapper = document.getElementById('preview-wrapper');
    const preview = document.getElementById('image-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            wrapper.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        wrapper.classList.add('d-none');
    }
}
</script>
@endpush
@endsection
