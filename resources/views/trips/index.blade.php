@extends('layouts.app')
@section('title', 'Rencana Perjalanan - TripPlanner')

@push('styles')
<style>
.trip-card {
    border-radius: 1.25rem;
    border: none;
    box-shadow: 0 4px 20px rgba(79,70,229,.08);
    transition: transform .3s ease, box-shadow .3s ease;
    overflow: hidden;
}
.trip-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 36px rgba(79,70,229,.15);
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .3rem .85rem;
    border-radius: 999px;
    font-size: .78rem;
    font-weight: 600;
}
.status-direncanakan { background:#EEF2FF; color:#4F46E5; }
.status-berlangsung  { background:#FEF3C7; color:#D97706; }
.status-selesai      { background:#D1FAE5; color:#059669; }
</style>
@endpush

@section('content')

{{-- Hero Header --}}
<section style="background:linear-gradient(135deg,#4F46E5 0%,#7C3AED 100%);padding:4rem 0 3rem;margin-top:-1px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 anim-fade-down">
                <h1 class="display-5 fw-bold text-white mb-2">✈️ Rencana Perjalanan</h1>
                <p class="text-white mb-0" style="opacity:.85;">Kelola dan atur semua trip wisatamu di satu tempat.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0 anim-fade-up">
                <a href="{{ route('trips.create') }}" class="btn btn-white fw-semibold px-4 py-2 shadow-sm"
                   style="background:#fff;color:#4F46E5;border-radius:999px;">
                    <i class="bi bi-plus-lg me-1"></i> Buat Rencana Baru
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Content --}}
<section class="py-5" style="background:#F8FAFF;min-height:60vh;">
    <div class="container">

        @forelse($trips as $trip)
        <div class="card trip-card mb-3 anim-fade-up" style="animation-delay:{{ $loop->index * 0.07 }}s">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">

                    {{-- Left: Info --}}
                    <div class="col-md-7">
                        <div class="d-flex align-items-start gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:52px;height:52px;background:linear-gradient(135deg,#EEF2FF,#C7D2FE);">
                                <i class="bi bi-suitcase-fill" style="font-size:1.4rem;color:#4F46E5;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1" style="color:#1E1B4B;">{{ $trip->nama_trip }}</h5>
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                    @php
                                        $statusClass = match($trip->status) {
                                            'Berlangsung' => 'status-berlangsung',
                                            'Selesai'     => 'status-selesai',
                                            default       => 'status-direncanakan',
                                        };
                                        $statusIcon = match($trip->status) {
                                            'Berlangsung' => 'bi-play-circle-fill',
                                            'Selesai'     => 'bi-check-circle-fill',
                                            default       => 'bi-clock-fill',
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="bi {{ $statusIcon }}"></i>
                                        {{ $trip->status ?? 'Direncanakan' }}
                                    </span>
                                    <span class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->format('d M Y') }}
                                        —
                                        {{ \Carbon\Carbon::parse($trip->tanggal_selesai)->format('d M Y') }}
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap gap-3">
                                    <span class="small text-muted">
                                        <i class="bi bi-map me-1 text-primary"></i>
                                        {{ $trip->itineraries_count ?? 0 }} destinasi
                                    </span>
                                    @if($trip->budget)
                                    <span class="small text-muted">
                                        <i class="bi bi-wallet2 me-1 text-success"></i>
                                        Rp {{ number_format($trip->budget->total_anggaran, 0, ',', '.') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Actions --}}
                    <div class="col-md-5">
                        <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                            <a href="{{ route('trips.show', $trip->id_trip) }}"
                               class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-eye me-1"></i> Lihat
                            </a>
                            <a href="{{ route('trips.edit', $trip->id_trip) }}"
                               class="btn btn-outline-secondary btn-sm px-3">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <form method="POST"
                                  action="{{ route('trips.destroy', $trip->id_trip) }}"
                                  onsubmit="return confirm('Hapus trip \'{{ addslashes($trip->nama_trip) }}\'? Semua itinerary dan budget akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @empty
        <div class="text-center py-5 anim-fade-up">
            <div class="mb-4" style="font-size:4rem;">🗺️</div>
            <h4 class="fw-bold mb-2" style="color:#1E1B4B;">Belum ada rencana perjalanan</h4>
            <p class="text-muted mb-4">Mulai rencanakan petualanganmu sekarang!</p>
            <a href="{{ route('trips.create') }}" class="btn btn-primary px-5 py-2" style="border-radius:999px;">
                <i class="bi bi-plus-lg me-2"></i> Buat Rencana Pertama
            </a>
        </div>
        @endforelse

    </div>
</section>

@endsection
