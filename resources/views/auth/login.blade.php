@extends('layouts.app')
@section('title', 'Login - TripPlanner')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        padding: 40px 0;
        background: linear-gradient(135deg, #EEF2FF 0%, #F0FDF4 100%);
    }
    .auth-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid rgba(79,70,229,0.1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.04), 0 20px 60px rgba(79,70,229,0.12);
        padding: 44px 40px;
        width: 100%;
        max-width: 460px;
        margin: 0 auto;
    }
    .auth-logo {
        font-size: 2.4rem;
        display: block;
        text-align: center;
        margin-bottom: 8px;
    }
    @media (max-width: 480px) {
        .auth-card { padding: 32px 24px; border-radius: 20px; }
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="auth-card anim-scale">
            <div class="text-center mb-4">
                <span class="auth-logo">🧭</span>
                <h1 class="fw-800 mb-1" style="font-size:1.6rem;font-weight:800;letter-spacing:-0.5px;">Selamat Datang Kembali</h1>
                <p style="color:var(--text-secondary);font-size:0.9rem;">Masuk ke akun TripPlanner kamu</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;border:1.5px solid #E2E8F0;border-right:none;background:#F8FAFC;">
                            <i class="bi bi-envelope" style="color:var(--text-secondary);"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"
                               placeholder="email@contoh.com" required autocomplete="email"
                               style="border-radius:0 12px 12px 0;border-left:none;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;border:1.5px solid #E2E8F0;border-right:none;background:#F8FAFC;">
                            <i class="bi bi-lock" style="color:var(--text-secondary);"></i>
                        </span>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••" required autocomplete="current-password"
                               style="border-radius:0 12px 12px 0;border-left:none;"
                               id="passwordInput">
                        <button class="btn" type="button" onclick="togglePw()" style="border:1.5px solid #E2E8F0;border-left:none;border-radius:0 12px 12px 0;background:#F8FAFC;" tabindex="-1">
                            <i class="bi bi-eye" id="eyeIcon" style="color:var(--text-secondary);"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember" style="border-radius:6px;">
                        <label class="form-check-label" for="remember" style="font-size:0.85rem;color:var(--text-secondary);">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="padding:13px;font-size:0.95rem;border-radius:14px;">
                    <i class="bi bi-arrow-right-circle me-2"></i>Masuk
                </button>
            </form>

            <div class="text-center mt-4" style="font-size:0.88rem;color:var(--text-secondary);">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:var(--primary);font-weight:600;text-decoration:none;">Daftar di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePw() {
    const inp = document.getElementById('passwordInput');
    const ico = document.getElementById('eyeIcon');
    if (inp.type === 'password') {
        inp.type = 'text';
        ico.className = 'bi bi-eye-slash';
    } else {
        inp.type = 'password';
        ico.className = 'bi bi-eye';
    }
}
</script>
@endpush
