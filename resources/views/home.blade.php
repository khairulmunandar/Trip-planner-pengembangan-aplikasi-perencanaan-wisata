@extends('layouts.app')
@section('title', 'TripPlanner - Beranda')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 50%, #EC4899 100%);
        background-size: 300% 300%;
        animation: gradientShift 8s ease infinite;
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }
    @keyframes gradientShift {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .hero-section::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        letter-spacing: -1.5px;
        line-height: 1.1;
        color: #fff;
    }
    .hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.85);
        font-weight: 400;
        line-height: 1.6;
    }
    .hero-floating {
        font-size: 3rem;
        display: inline-block;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
    }
    .hero-blob {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        filter: blur(60px);
    }
    .kategori-card {
        border-radius: 18px;
        background: #fff;
        border: 1.5px solid var(--card-border);
        padding: 24px 16px;
        text-align: center;
        transition: var(--transition);
        display: block;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--shadow-sm);
    }
    .kategori-card:hover {
        border-color: var(--primary);
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(79,70,229,0.15);
        color: var(--primary);
    }
    .kategori-card .kat-icon {
        font-size: 2rem;
        display: block;
        margin-bottom: 10px;
    }
    .kategori-card .kat-name {
        font-weight: 700;
        font-size: 0.95rem;
    }
    .kategori-card .kat-count {
        font-size: 0.78rem;
        color: var(--text-secondary);
        margin-top: 4px;
    }
    .dest-card {
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--card-border);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
    }
    .dest-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
        border-color: rgba(79,70,229,0.15);
    }
    .dest-card .img-wrap { overflow: hidden; }
    .dest-card img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .dest-card:hover img { transform: scale(1.1); }
    .dest-card .card-body { padding: 20px; }
    .dest-card .card-footer { background: #fff; padding: 0 20px 20px; border: none; }
    .badge-kat {
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 10px;
        display: inline-block;
        margin-bottom: 8px;
    }

    /* ── Icons per kategori ── */
    .kat-pantai   { background: linear-gradient(135deg, #EFF6FF, #DBEAFE); }
    .kat-gunung   { background: linear-gradient(135deg, #ECFDF5, #D1FAE5); }
    .kat-budaya   { background: linear-gradient(135deg, #FFF7ED, #FED7AA); }
    .kat-kuliner  { background: linear-gradient(135deg, #FEF2F2, #FEE2E2); }
    .kat-default  { background: var(--primary-light); }
</style>
@endpush

@section('content')
{{-- ═══ HERO ═══ --}}
<section class="hero-section">
    <div class="hero-blob" style="width:400px;height:400px;top:-100px;right:-100px;"></div>
    <div class="hero-blob" style="width:300px;height:300px;bottom:-80px;left:-60px;"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="anim-fade-up">
                    <div class="mb-3">
                        <span style="background:rgba(255,255,255,0.2);color:#fff;border-radius:50px;padding:6px 18px;font-size:0.82rem;font-weight:600;letter-spacing:0.5px;">
                            ✈️ Platform Perjalanan #1 Indonesia
                        </span>
                    </div>
                    <h1 class="hero-title mb-4">
                        Rencanakan Perjalanan Wisatamu dengan Mudah
                    </h1>
                    <p class="hero-subtitle mb-5">
                        Temukan destinasi wisata impian, atur itinerary harian, dan kelola anggaran perjalananmu — semuanya dalam satu tempat yang elegan.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('destinasi.index') }}" class="btn btn-lg" style="background:#fff;color:var(--primary);font-weight:700;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,0.2);">
                            <i class="bi bi-compass me-2"></i>Jelajahi Destinasi
                        </a>
                        @guest
                        <a href="{{ route('register') }}" class="btn btn-lg" style="background:rgba(255,255,255,0.15);color:#fff;border:2px solid rgba(255,255,255,0.4);backdrop-filter:blur(10px);border-radius:14px;">
                            <i class="bi bi-stars me-2"></i>Daftar Gratis
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <div class="anim-right" style="animation-delay:0.2s;">
                    <div class="hero-floating anim-float" style="font-size:5rem;">🗺️</div>
                    <div class="d-flex justify-content-center gap-4 mt-3">
                        <div class="hero-floating anim-float" style="animation-delay:0.5s; font-size:2.5rem;">🏖️</div>
                        <div class="hero-floating anim-float" style="animation-delay:1s; font-size:2.5rem;">🏔️</div>
                        <div class="hero-floating anim-float" style="animation-delay:1.5s; font-size:2.5rem;">🛫</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ KATEGORI ═══ --}}
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 anim-fade-up">
            <div>
                <p class="text-uppercase fw-bold mb-1" style="color:var(--primary);font-size:0.78rem;letter-spacing:1px;">Kategori Wisata</p>
                <h2 class="section-title mb-0">Temukan Destinasi Favoritmu</h2>
            </div>
        </div>
        @php
            $katIcons = ['Pantai'=>'🏖️','Gunung'=>'🏔️','Budaya'=>'🏛️','Kuliner'=>'🍜','Alam'=>'🌿','Kota'=>'🏙️','Desa'=>'🌾','Olahraga'=>'🏄'];
        @endphp
        <div class="row g-3">
            @foreach($kategori as $k)
            <div class="col-6 col-md-4 col-lg-3 anim-scale" style="animation-delay:{{ $loop->index * 0.08 }}s;">
                <a href="{{ route('destinasi.index', ['kategori' => $k->id_kategori]) }}" class="kategori-card">
                    <span class="kat-icon">{{ $katIcons[$k->nama_kategori] ?? '📍' }}</span>
                    <div class="kat-name">{{ $k->nama_kategori }}</div>
                    <div class="kat-count">{{ $k->destinasi_count }} destinasi</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ DESTINASI TERBARU ═══ --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 anim-fade-up">
            <div>
                <p class="text-uppercase fw-bold mb-1" style="color:var(--primary);font-size:0.78rem;letter-spacing:1px;">Pilihan Terbaik</p>
                <h2 class="section-title mb-0">Destinasi Terbaru</h2>
            </div>
            <a href="{{ route('destinasi.index') }}" class="btn btn-outline-primary btn-sm d-none d-md-flex align-items-center gap-1">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($destinasiUnggulan as $d)
            <div class="col-12 col-md-6 col-lg-4 anim-fade-up" style="animation-delay:{{ $loop->index * 0.1 }}s;">
                <div class="dest-card card-hover">
                    <div class="img-wrap">
                        <img src="{{ $d->foto_url }}" alt="{{ $d->nama_destinasi }}" loading="lazy" onerror="this.onerror=null;this.src='{{ $d->svg_fallback }}'">
                    </div>
                    <div class="card-body">
                        <span class="badge-kat">{{ $d->kategori->nama_kategori }}</span>
                        <h5 class="fw-700 mb-2" style="font-size:1.05rem;font-weight:700;letter-spacing:-0.3px;">{{ $d->nama_destinasi }}</h5>
                        <p class="text-secondary mb-0" style="font-size:0.85rem;line-height:1.5;">{{ Str::limit($d->deskripsi, 80) }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('destinasi.show', $d->id_destinasi) }}" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-arrow-right-circle me-1"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div style="font-size:3rem;margin-bottom:16px;">🏝️</div>
                <p class="text-secondary">Belum ada destinasi tersedia.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-4 d-md-none">
            <a href="{{ route('destinasi.index') }}" class="btn btn-outline-primary">
                Lihat Semua Destinasi <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

{{-- ═══ CTA ═══ --}}
@guest
<section class="py-5">
    <div class="container">
        <div class="text-center p-5 rounded-4 anim-scale" style="background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;">
            <h2 class="fw-800 mb-3" style="font-weight:800;">Siap Merencanakan Perjalananmu?</h2>
            <p style="color:rgba(255,255,255,0.85);margin-bottom:28px;">Daftar sekarang gratis dan mulai membuat rencana perjalanan impianmu.</p>
            <a href="{{ route('register') }}" class="btn btn-lg" style="background:#fff;color:var(--primary);font-weight:700;border-radius:14px;">
                <i class="bi bi-stars me-2"></i>Mulai Sekarang — Gratis!
            </a>
        </div>
    </div>
</section>
@endguest
@endsection
