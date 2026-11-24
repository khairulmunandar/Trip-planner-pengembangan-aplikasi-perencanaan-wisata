@extends('layouts.app')
@section('title', 'Edit Rencana Perjalanan - TripPlanner')

@section('content')

{{-- Hero Header --}}
<section style="background:linear-gradient(135deg,#4F46E5 0%,#7C3AED 100%);padding:3.5rem 0 2.5rem;margin-top:-1px;">
    <div class="container">
        <div class="d-flex align-items-center gap-3 anim-fade-down">
            <a href="{{ route('trips.show', $trip->id_trip) }}" class="btn btn-sm px-3 fw-semibold"
               style="background:rgba(255,255,255,.18);color:#fff;border:1.5px solid rgba(255,255,255,.35);border-radius:999px;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <div>
                <h1 class="h3 fw-bold text-white mb-0">✏️ Edit Rencana Perjalanan</h1>
                <p class="text-white mb-0 small" style="opacity:.8;">{{ $trip->nama_trip }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Form --}}
<section class="py-5" style="background:#F8FAFF;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm anim-scale" style="border-radius:1.25rem;animation-delay:.05s">
                    <div class="card-body p-4 p-md-5">

                        <form method="POST" action="{{ route('trips.update', $trip->id_trip) }}">
                            @csrf
                            @method('PUT')

                            {{-- Nama Trip --}}
                            <div class="mb-4">
                                <label for="nama_trip" class="form-label fw-semibold small" style="color:#374151;">
                                    Nama Trip <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       id="nama_trip"
                                       name="nama_trip"
                                       value="{{ old('nama_trip', $trip->nama_trip) }}"
                                       class="form-control @error('nama_trip') is-invalid @enderror"
                                       required>
                                @error('nama_trip')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal Mulai --}}
                            <div class="mb-4">
                                <label for="tanggal_mulai" class="form-label fw-semibold small" style="color:#374151;">
                                    Tanggal Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       id="tanggal_mulai"
                                       name="tanggal_mulai"
                                       value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($trip->tanggal_mulai)->format('Y-m-d')) }}"
                                       class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                       required>
                                @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal Selesai --}}
                            <div class="mb-4">
                                <label for="tanggal_selesai" class="form-label fw-semibold small" style="color:#374151;">
                                    Tanggal Selesai <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       id="tanggal_selesai"
                                       name="tanggal_selesai"
                                       value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($trip->tanggal_selesai)->format('Y-m-d')) }}"
                                       class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                       required>
                                @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="mb-4">
                                <label for="status" class="form-label fw-semibold small" style="color:#374151;">
                                    Status Trip <span class="text-danger">*</span>
                                </label>
                                <select id="status"
                                        name="status"
                                        class="form-select @error('status') is-invalid @enderror"
                                        required>
                                    <option value="Direncanakan" {{ old('status', $trip->status) === 'Direncanakan' ? 'selected' : '' }}>⏳ Direncanakan</option>
                                    <option value="Berlangsung"  {{ old('status', $trip->status) === 'Berlangsung'  ? 'selected' : '' }}>▶️ Berlangsung</option>
                                    <option value="Selesai"      {{ old('status', $trip->status) === 'Selesai'      ? 'selected' : '' }}>✅ Selesai</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid gap-2 mt-2">
                                <button type="submit" class="btn btn-warning py-2 fw-semibold text-white">
                                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('trips.show', $trip->id_trip) }}" class="btn btn-outline-secondary">Batal</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
