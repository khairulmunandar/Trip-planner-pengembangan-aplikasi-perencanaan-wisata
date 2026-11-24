@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Page Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 anim-fade-down">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color:#1E1B4B;">
                <i class="bi bi-speedometer2 me-2" style="color:#6366F1;"></i>Dashboard
            </h1>
            <p class="text-muted mb-0 small">Selamat datang di panel admin TripPlanner</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary btn-sm px-3">
                <i class="bi bi-plus-lg me-1"></i> Destinasi
            </a>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="bi bi-plus-lg me-1"></i> Kategori
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3 anim-scale" style="animation-delay:.05s">
            <div class="stat-card">
                <div class="stat-icon" style="background:linear-gradient(135deg,#6366F1,#4F46E5);">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="stat-label">Total Destinasi</div>
                <div class="stat-value" style="color:#4F46E5;">{{ $totalDestinasi }}</div>
                <a href="{{ route('admin.destinasi.index') }}" class="stat-link">
                    Kelola <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="col-6 col-xl-3 anim-scale" style="animation-delay:.10s">
            <div class="stat-card">
                <div class="stat-icon" style="background:linear-gradient(135deg,#10B981,#059669);">
                    <i class="bi bi-tags-fill"></i>
                </div>
                <div class="stat-label">Total Kategori</div>
                <div class="stat-value" style="color:#059669;">{{ $totalKategori }}</div>
                <a href="{{ route('admin.kategori.index') }}" class="stat-link">
                    Kelola <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="col-6 col-xl-3 anim-scale" style="animation-delay:.15s">
            <div class="stat-card">
                <div class="stat-icon" style="background:linear-gradient(135deg,#F59E0B,#D97706);">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-label">Total User</div>
                <div class="stat-value" style="color:#D97706;">{{ $totalUser }}</div>
                <span class="stat-link" style="cursor:default;opacity:.5;">Pengguna terdaftar</span>
            </div>
        </div>
        <div class="col-6 col-xl-3 anim-scale" style="animation-delay:.20s">
            <div class="stat-card">
                <div class="stat-icon" style="background:linear-gradient(135deg,#8B5CF6,#7C3AED);">
                    <i class="bi bi-suitcase-fill"></i>
                </div>
                <div class="stat-label">Total Trip</div>
                <div class="stat-value" style="color:#7C3AED;">{{ $totalTrip }}</div>
                <span class="stat-link" style="cursor:default;opacity:.5;">Rencana perjalanan</span>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row g-3 anim-fade-up" style="animation-delay:.25s">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius:1rem;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1" style="color:#1E1B4B;">
                        <i class="bi bi-geo-alt me-2 text-primary"></i>Kelola Destinasi
                    </h5>
                    <p class="text-muted small mb-3">Tambah, ubah, atau hapus data destinasi wisata.</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-list-ul me-1"></i> Daftar Destinasi
                        </a>
                        <a href="{{ route('admin.destinasi.create') }}" class="btn btn-outline-primary btn-sm px-3">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius:1rem;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1" style="color:#1E1B4B;">
                        <i class="bi bi-tags me-2 text-success"></i>Kelola Kategori
                    </h5>
                    <p class="text-muted small mb-3">Atur kategori wisata untuk pengelompokan destinasi.</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-success btn-sm px-3">
                            <i class="bi bi-list-ul me-1"></i> Daftar Kategori
                        </a>
                        <a href="{{ route('admin.kategori.create') }}" class="btn btn-outline-success btn-sm px-3">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
.stat-link {
    display: inline-block;
    margin-top: .5rem;
    font-size: .78rem;
    font-weight: 600;
    color: #6366F1;
    text-decoration: none;
    transition: color .2s;
}
.stat-link:hover { color: #4F46E5; }
</style>
@endpush
@endsection
