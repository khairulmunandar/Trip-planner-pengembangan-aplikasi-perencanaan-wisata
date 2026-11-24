@extends('layouts.app')
@section('title', 'Buat Rencana Perjalanan - TripPlanner')

@section('content')

{{-- Hero Header --}}
<section style="background:linear-gradient(135deg,#4F46E5 0%,#7C3AED 100%);padding:3.5rem 0 2.5rem;margin-top:-1px;">
    <div class="container">
        <div class="d-flex align-items-center gap-3 anim-fade-down">
            <a href="{{ route('trips.index') }}" class="btn btn-sm px-3 fw-semibold"
               style="background:rgba(255,255,255,.18);color:#fff;border:1.5px solid rgba(255,255,255,.35);border-radius:999px;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <div>
                <h1 class="h3 fw-bold text-white mb-0">✈️ Buat Rencana Perjalanan</h1>
                <p class="text-white mb-0 small" style="opacity:.8;">Isi detail trip barumu di bawah</p>
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

                        <form method="POST" action="{{ route('trips.store') }}">
                            @csrf

                            {{-- Nama Trip --}}
                            <div class="mb-4">
                                <label for="nama_trip" class="form-label fw-semibold small" style="color:#374151;">
                                    Nama Trip <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       id="nama_trip"
                                       name="nama_trip"
                                       value="{{ old('nama_trip') }}"
                                       class="form-control @error('nama_trip') is-invalid @enderror"
                                       placeholder="Contoh: Liburan ke Bali, Jelajah Yogya…"
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
                                       value="{{ old('tanggal_mulai') }}"
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
                                       value="{{ old('tanggal_selesai') }}"
                                       class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                       required>
                                @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid gap-2 mt-2">
                                <button type="submit" class="btn btn-primary py-2 fw-semibold">
                                    <i class="bi bi-plus-circle me-1"></i> Buat Rencana
                                </button>
                                <a href="{{ route('trips.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
