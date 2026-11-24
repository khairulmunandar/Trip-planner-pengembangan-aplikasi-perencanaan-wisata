@extends('layouts.app')
@section('title', $trip->nama_trip . ' - TripPlanner')

@push('styles')
<style>
.itinerary-item {
    border-left: 3px solid #C7D2FE;
    padding-left: 1rem;
    margin-bottom: 1rem;
    transition: border-color .2s;
}
.itinerary-item:hover { border-color: #4F46E5; }

.budget-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: .6rem 0;
    border-bottom: 1px solid #F3F4F6;
}
.budget-row:last-child { border-bottom: none; }

.budget-total {
    background: linear-gradient(135deg, #EEF2FF, #C7D2FE);
    border-radius: .75rem;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

.section-card {
    border: none;
    border-radius: 1.25rem;
    box-shadow: 0 4px 20px rgba(79,70,229,.08);
}
</style>
@endpush

@section('content')

{{-- Hero Header --}}
<section style="background:linear-gradient(135deg,#4F46E5 0%,#7C3AED 100%);padding:3.5rem 0 2.5rem;margin-top:-1px;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-start gap-3 anim-fade-down">
            <a href="{{ route('trips.index') }}" class="btn btn-sm px-3 fw-semibold"
               style="background:rgba(255,255,255,.18);color:#fff;border:1.5px solid rgba(255,255,255,.35);border-radius:999px;">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold text-white mb-1">{{ $trip->nama_trip }}</h1>
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    @php
                        $statusClass = match($trip->status) {
                            'Berlangsung' => 'background:#FEF3C7;color:#D97706;',
                            'Selesai'     => 'background:#D1FAE5;color:#059669;',
                            default       => 'background:#EEF2FF;color:#4F46E5;',
                        };
                    @endphp
                    <span class="badge rounded-pill px-3 py-2 fw-semibold" style="{{ $statusClass }}">
                        {{ $trip->status ?? 'Direncanakan' }}
                    </span>
                    <span class="text-white small" style="opacity:.85;">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->format('d M Y') }}
                        —
                        {{ \Carbon\Carbon::parse($trip->tanggal_selesai)->format('d M Y') }}
                    </span>
                </div>
            </div>
            <a href="{{ route('trips.edit', $trip->id_trip) }}" class="btn btn-sm px-3 fw-semibold"
               style="background:rgba(255,255,255,.18);color:#fff;border:1.5px solid rgba(255,255,255,.35);border-radius:999px;">
                <i class="bi bi-pencil me-1"></i> Edit Trip
            </a>
        </div>
    </div>
</section>

{{-- Main Content --}}
<section class="py-5" style="background:#F8FAFF;">
    <div class="container">

        <div class="row g-4">

            {{-- LEFT: Itinerary --}}
            <div class="col-lg-7">

                {{-- Itinerary List --}}
                <div class="card section-card mb-4 anim-fade-up" style="animation-delay:.05s">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color:#1E1B4B;">
                            <i class="bi bi-map-fill me-2" style="color:#4F46E5;"></i>Itinerary
                            <span class="badge ms-2 rounded-pill" style="background:#EEF2FF;color:#4F46E5;font-size:.75rem;">
                                {{ $trip->itineraries->count() }} destinasi
                            </span>
                        </h5>

                        @forelse($trip->itineraries as $item)
                        <div class="itinerary-item anim-fade-up" style="animation-delay:{{ $loop->index * 0.05 }}s">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1" style="color:#1E1B4B;">
                                        {{ $item->destinasi->nama_destinasi ?? 'Destinasi tidak ditemukan' }}
                                    </div>
                                    <div class="d-flex flex-wrap gap-3 text-muted small">
                                        <span>
                                            <i class="bi bi-calendar3 me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('d M Y') }}
                                        </span>
                                        @if($item->jam_kunjungan)
                                        <span>
                                            <i class="bi bi-clock me-1 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($item->jam_kunjungan)->format('H:i') }}
                                        </span>
                                        @endif
                                    </div>
                                    @if($item->catatan)
                                    <p class="text-muted small mb-0 mt-1">
                                        <i class="bi bi-chat-left-text me-1"></i>{{ $item->catatan }}
                                    </p>
                                    @endif
                                </div>
                                <form method="POST"
                                      action="{{ route('itineraries.destroy', [$trip->id_trip, $item->id_itinerary]) }}"
                                      onsubmit="return confirm('Hapus destinasi ini dari itinerary?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger px-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="bi bi-map" style="font-size:2.5rem;color:#C7D2FE;"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada destinasi dalam itinerary.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Add Itinerary Form --}}
                <div class="card section-card anim-fade-up" style="animation-delay:.1s">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color:#1E1B4B;">
                            <i class="bi bi-plus-circle-fill me-2" style="color:#10B981;"></i>Tambah Destinasi ke Itinerary
                        </h5>

                        <form method="POST" action="{{ route('itineraries.store', $trip->id_trip) }}">
                            @csrf

                            <div class="row g-3">
                                {{-- Pilih Destinasi --}}
                                <div class="col-12">
                                    <label for="id_destinasi" class="form-label fw-semibold small" style="color:#374151;">
                                        Pilih Destinasi <span class="text-danger">*</span>
                                    </label>
                                    <select id="id_destinasi"
                                            name="id_destinasi"
                                            class="form-select @error('id_destinasi') is-invalid @enderror"
                                            required>
                                        <option value="">— Pilih Destinasi —</option>
                                        @foreach($destinasiList as $dest)
                                        <option value="{{ $dest->id_destinasi }}"
                                                {{ old('id_destinasi') == $dest->id_destinasi ? 'selected' : '' }}>
                                            {{ $dest->nama_destinasi }}
                                            @if($dest->lokasi) — {{ $dest->lokasi }} @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_destinasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tanggal Kunjungan --}}
                                <div class="col-md-6">
                                    <label for="tanggal_kunjungan" class="form-label fw-semibold small" style="color:#374151;">
                                        Tanggal Kunjungan <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           id="tanggal_kunjungan"
                                           name="tanggal_kunjungan"
                                           value="{{ old('tanggal_kunjungan') }}"
                                           class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
                                           required>
                                    @error('tanggal_kunjungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Jam Kunjungan --}}
                                <div class="col-md-6">
                                    <label for="jam_kunjungan" class="form-label fw-semibold small" style="color:#374151;">
                                        Jam Kunjungan <span class="text-muted fw-normal">(opsional)</span>
                                    </label>
                                    <input type="time"
                                           id="jam_kunjungan"
                                           name="jam_kunjungan"
                                           value="{{ old('jam_kunjungan') }}"
                                           class="form-control @error('jam_kunjungan') is-invalid @enderror">
                                    @error('jam_kunjungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Catatan --}}
                                <div class="col-12">
                                    <label for="catatan" class="form-label fw-semibold small" style="color:#374151;">
                                        Catatan <span class="text-muted fw-normal">(opsional)</span>
                                    </label>
                                    <textarea id="catatan"
                                              name="catatan"
                                              rows="2"
                                              class="form-control @error('catatan') is-invalid @enderror"
                                              placeholder="Catatan kunjungan…">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Submit --}}
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success px-4 fw-semibold">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah ke Itinerary
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- RIGHT: Budget --}}
            <div class="col-lg-5">
                <div class="card section-card anim-fade-up" style="animation-delay:.08s;position:sticky;top:90px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color:#1E1B4B;">
                            <i class="bi bi-wallet2-fill me-2" style="color:#F59E0B;"></i>Anggaran Perjalanan
                        </h5>

                        <form method="POST" action="{{ route('budget.store', $trip->id_trip) }}">
                            @csrf

                            {{-- Transportasi --}}
                            <div class="mb-3">
                                <label for="transportasi" class="form-label fw-semibold small d-flex align-items-center gap-2" style="color:#374151;">
                                    <i class="bi bi-bus-front text-primary"></i> Transportasi
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text small" style="background:#EEF2FF;color:#4F46E5;border-color:#C7D2FE;">Rp</span>
                                    <input type="number"
                                           id="transportasi"
                                           name="transportasi"
                                           value="{{ old('transportasi', $trip->budget->transportasi ?? 0) }}"
                                           class="form-control @error('transportasi') is-invalid @enderror"
                                           min="0"
                                           step="1000">
                                    @error('transportasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Akomodasi --}}
                            <div class="mb-3">
                                <label for="akomodasi" class="form-label fw-semibold small d-flex align-items-center gap-2" style="color:#374151;">
                                    <i class="bi bi-house-fill text-warning"></i> Akomodasi
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text small" style="background:#EEF2FF;color:#4F46E5;border-color:#C7D2FE;">Rp</span>
                                    <input type="number"
                                           id="akomodasi"
                                           name="akomodasi"
                                           value="{{ old('akomodasi', $trip->budget->akomodasi ?? 0) }}"
                                           class="form-control @error('akomodasi') is-invalid @enderror"
                                           min="0"
                                           step="1000">
                                    @error('akomodasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tiket --}}
                            <div class="mb-3">
                                <label for="tiket" class="form-label fw-semibold small d-flex align-items-center gap-2" style="color:#374151;">
                                    <i class="bi bi-ticket-fill text-success"></i> Tiket Wisata
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text small" style="background:#EEF2FF;color:#4F46E5;border-color:#C7D2FE;">Rp</span>
                                    <input type="number"
                                           id="tiket"
                                           name="tiket"
                                           value="{{ old('tiket', $trip->budget->tiket ?? 0) }}"
                                           class="form-control @error('tiket') is-invalid @enderror"
                                           min="0"
                                           step="1000">
                                    @error('tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Konsumsi --}}
                            <div class="mb-3">
                                <label for="konsumsi" class="form-label fw-semibold small d-flex align-items-center gap-2" style="color:#374151;">
                                    <i class="bi bi-cup-hot-fill text-danger"></i> Konsumsi
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text small" style="background:#EEF2FF;color:#4F46E5;border-color:#C7D2FE;">Rp</span>
                                    <input type="number"
                                           id="konsumsi"
                                           name="konsumsi"
                                           value="{{ old('konsumsi', $trip->budget->konsumsi ?? 0) }}"
                                           class="form-control @error('konsumsi') is-invalid @enderror"
                                           min="0"
                                           step="1000">
                                    @error('konsumsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Biaya Lain --}}
                            <div class="mb-4">
                                <label for="biaya_lain" class="form-label fw-semibold small d-flex align-items-center gap-2" style="color:#374151;">
                                    <i class="bi bi-three-dots-vertical text-secondary"></i> Biaya Lain-lain
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text small" style="background:#EEF2FF;color:#4F46E5;border-color:#C7D2FE;">Rp</span>
                                    <input type="number"
                                           id="biaya_lain"
                                           name="biaya_lain"
                                           value="{{ old('biaya_lain', $trip->budget->biaya_lain ?? 0) }}"
                                           class="form-control @error('biaya_lain') is-invalid @enderror"
                                           min="0"
                                           step="1000">
                                    @error('biaya_lain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Total --}}
                            @if($trip->budget)
                            <div class="budget-total mb-3">
                                <span class="fw-bold" style="color:#1E1B4B;">Total Anggaran</span>
                                <span class="fw-bold fs-5" style="color:#4F46E5;">
                                    Rp {{ number_format($trip->budget->total_anggaran, 0, ',', '.') }}
                                </span>
                            </div>
                            @endif

                            {{-- Submit --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning fw-semibold text-white py-2">
                                    <i class="bi bi-save me-1"></i>
                                    {{ $trip->budget ? 'Perbarui Anggaran' : 'Simpan Anggaran' }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
