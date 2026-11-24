@extends('layouts.app')
@section('title', $destinasi->nama_destinasi . ' - TripPlanner')

@push('styles')
<style>
    .dest-hero-img {
        border-radius: 20px;
        width: 100%;
        height: 420px;
        object-fit: cover;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        transition: transform 0.6s ease;
    }
    .dest-hero-img:hover { transform: scale(1.01); }
    .info-card {
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        border: 1px solid var(--card-border);
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
    }
    .map-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--card-border);
        box-shadow: var(--shadow-sm);
    }
    .map-card iframe {
        width: 100%;
        height: 320px;
        display: block;
        border: none;
    }
    .price-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ECFDF5;
        color: #059669;
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 700;
        font-size: 1.05rem;
    }
    .price-badge.paid {
        background: var(--primary-light);
        color: var(--primary);
    }
    @media (max-width: 768px) {
        .dest-hero-img { height: 260px; }
        .info-card { padding: 20px; }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    {{-- ═══ BACK LINK ═══ --}}
    <div class="mb-3 anim-fade-down">
        <a href="{{ route('destinasi.index') }}" style="color:var(--text-secondary);text-decoration:none;font-size:0.88rem;font-weight:500;display:inline-flex;align-items:center;gap:6px;transition:color 0.2s;">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Destinasi
        </a>
    </div>

    <div class="row g-4">
        {{-- ═══ KIRI ═══ --}}
        <div class="col-lg-7 anim-left">
            <img src="{{ $destinasi->foto_url }}" alt="{{ $destinasi->nama_destinasi }}" class="dest-hero-img mb-4" onerror="this.onerror=null;this.src='{{ $destinasi->svg_fallback }}'">

            <div class="info-card">
                <div class="mb-3">
                    <span class="badge-kat d-inline-block mb-2" style="background:var(--primary-light);color:var(--primary);border-radius:8px;font-size:0.75rem;font-weight:700;padding:5px 12px;">
                        {{ $destinasi->kategori->nama_kategori }}
                    </span>
                    <h1 class="fw-800 mb-2" style="font-size:1.8rem;font-weight:800;letter-spacing:-0.5px;">{{ $destinasi->nama_destinasi }}</h1>
                    <p class="mb-0" style="color:var(--text-secondary);font-size:0.9rem;display:flex;align-items:center;gap:6px;">
                        <i class="bi bi-geo-alt-fill" style="color:var(--primary);"></i>
                        {{ $destinasi->lokasi }}
                    </p>
                </div>

                <hr style="border-color:#F1F5F9;margin:20px 0;">

                <p style="color:var(--text-secondary);line-height:1.75;font-size:0.95rem;">{{ $destinasi->deskripsi }}</p>

                <div class="mt-4 d-flex flex-wrap align-items-center gap-3">
                    <div class="{{ $destinasi->harga_tiket > 0 ? 'price-badge paid' : 'price-badge' }}">
                        <i class="bi bi-ticket-perforated"></i>
                        {{ $destinasi->harga_tiket > 0 ? 'Rp ' . number_format($destinasi->harga_tiket, 0, ',', '.') : 'Gratis' }}
                    </div>
                    @auth
                    <a href="{{ route('trips.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambahkan ke Rencana Perjalanan
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                        <i class="bi bi-lock me-2"></i>Login untuk buat rencana perjalanan
                    </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- ═══ KANAN ═══ --}}
        <div class="col-lg-5 anim-right">
            <div class="map-card">
                <div style="padding:16px 20px;background:#F8FAFC;border-bottom:1px solid #E2E8F0;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-map" style="color:var(--primary);font-size:1.1rem;"></i>
                    <span style="font-weight:700;font-size:0.9rem;">Lokasi di Peta</span>
                </div>
                <iframe
                    src="https://www.google.com/maps?q={{ urlencode($destinasi->lokasi) }}&output=embed"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Peta {{ $destinasi->nama_destinasi }}"
                    allowfullscreen>
                </iframe>
                <div style="padding:12px 20px;background:#F8FAFC;border-top:1px solid #E2E8F0;">
                    <a href="https://maps.google.com/?q={{ urlencode($destinasi->lokasi) }}" target="_blank" rel="noopener noreferrer"
                       class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
