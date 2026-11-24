@extends('layouts.app')
@section('title', 'Destinasi Wisata - TripPlanner')

@push('styles')
<style>
    .dest-card {
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--card-border);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .dest-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
        border-color: rgba(79,70,229,0.15);
    }
    .dest-card .img-wrap { overflow: hidden; flex-shrink: 0; }
    .dest-card img {
        height: 210px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .dest-card:hover img { transform: scale(1.1); }
    .dest-card .card-body { padding: 18px; flex: 1; }
    .dest-card .card-footer { background: #fff; padding: 0 18px 18px; border: none; }
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
    .search-box {
        background: #fff;
        border-radius: 20px;
        padding: 24px 28px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--card-border);
        margin-bottom: 32px;
    }
    .hero-dest {
        background: linear-gradient(135deg, #1E293B 0%, #334155 100%);
        padding: 48px 0 40px;
        margin-bottom: 0;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state .empty-icon { font-size: 4rem; margin-bottom: 16px; display: block; }
</style>
@endpush

@section('content')
<div class="hero-dest">
    <div class="container">
        <div class="anim-fade-up">
            <p class="text-uppercase fw-bold mb-2" style="color:rgba(255,255,255,0.6);font-size:0.78rem;letter-spacing:1px;">Wisata Indonesia</p>
            <h1 class="fw-800 text-white mb-1" style="font-size:2rem;font-weight:800;letter-spacing:-0.5px;">Jelajahi Destinasi Wisata</h1>
            <p style="color:rgba(255,255,255,0.7);font-size:0.9rem;">{{ $destinasi->total() }} destinasi tersedia untuk ditemukan</p>
        </div>
    </div>
</div>

<div class="container py-4">
    {{-- ═══ SEARCH & FILTER ═══ --}}
    <div class="search-box anim-fade-up" style="animation-delay:0.1s;">
        <form action="{{ route('destinasi.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="form-label">Cari Destinasi</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;border:1.5px solid #E2E8F0;border-right:none;background:#F8FAFC;">
                            <i class="bi bi-search" style="color:var(--text-secondary);"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                               placeholder="Nama destinasi..." style="border-radius:0 12px 12px 0;border-left:none;">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ request('kategori') == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                    @if(request('q') || request('kategori'))
                    <a href="{{ route('destinasi.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- ═══ HASIL ═══ --}}
    @if(request('q') || request('kategori'))
    <div class="mb-3 anim-fade">
        <small class="text-secondary">
            Menampilkan {{ $destinasi->total() }} hasil
            @if(request('q')) untuk "<strong>{{ request('q') }}</strong>"@endif
            @if(request('kategori'))
                @php $kat = $kategori->firstWhere('id_kategori', request('kategori')); @endphp
                @if($kat) di kategori <strong>{{ $kat->nama_kategori }}</strong>@endif
            @endif
        </small>
    </div>
    @endif

    <div class="row g-4">
        @forelse($destinasi as $d)
        <div class="col-12 col-sm-6 col-lg-4 anim-fade-up" style="animation-delay:{{ ($loop->index % 9) * 0.07 }}s;">
            <div class="dest-card card-hover">
                <div class="img-wrap">
                    <img src="{{ $d->foto_url }}" alt="{{ $d->nama_destinasi }}" loading="lazy" onerror="this.onerror=null;this.src='{{ $d->svg_fallback }}'">
                </div>
                <div class="card-body">
                    <span class="badge-kat">{{ $d->kategori->nama_kategori }}</span>
                    <h5 class="mb-2" style="font-size:1rem;font-weight:700;letter-spacing:-0.3px;">{{ $d->nama_destinasi }}</h5>
                    <p class="mb-2" style="font-size:0.82rem;color:var(--text-secondary);line-height:1.5;">
                        <i class="bi bi-geo-alt me-1" style="color:var(--primary);"></i>{{ $d->lokasi }}
                    </p>
                    <div style="font-size:0.82rem;font-weight:600;color:var(--secondary);">
                        {{ $d->harga_tiket > 0 ? 'Rp ' . number_format($d->harga_tiket, 0, ',', '.') : 'Gratis' }}
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('destinasi.show', $d->id_destinasi) }}" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-arrow-right-circle me-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state anim-scale">
                <span class="empty-icon">🔍</span>
                <h4 class="fw-700" style="font-weight:700;">Destinasi Tidak Ditemukan</h4>
                <p class="text-secondary mb-4">Coba ubah kata kunci atau pilih kategori yang berbeda.</p>
                <a href="{{ route('destinasi.index') }}" class="btn btn-outline-primary">Reset Pencarian</a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- ═══ PAGINATION ═══ --}}
    @if($destinasi->hasPages())
    <div class="d-flex justify-content-center mt-5 anim-fade-up">
        {{ $destinasi->links() }}
    </div>
    @endif
</div>
@endsection
