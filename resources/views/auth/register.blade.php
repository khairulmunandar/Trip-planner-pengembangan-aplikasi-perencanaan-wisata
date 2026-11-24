@extends('layouts.app')
@section('title', 'Registrasi - TripPlanner')

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
        max-width: 480px;
        margin: 0 auto;
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
                <span style="font-size:2.4rem;">🧭</span>
                <h1 class="fw-800 mt-2 mb-1" style="font-size:1.6rem;font-weight:800;letter-spacing:-0.5px;">Buat Akun Baru</h1>
                <p style="color:var(--text-secondary);font-size:0.9rem;">Bergabung dengan TripPlanner hari ini — gratis!</p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;border:1.5px solid #E2E8F0;border-right:none;background:#F8FAFC;">
                            <i class="bi bi-person" style="color:var(--text-secondary);"></i>
                        </span>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                               class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Nama kamu" required
                               style="border-radius:0 12px 12px 0;border-left:none;">
                    </div>
                    @error('nama')
                    <div class="text-danger mt-1" style="font-size:0.8rem;"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;border:1.5px solid #E2E8F0;border-right:none;background:#F8FAFC;">
                            <i class="bi bi-envelope" style="color:var(--text-secondary);"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="email@contoh.com" required
                               style="border-radius:0 12px 12px 0;border-left:none;">
                    </div>
                    @error('email')
                    <div class="text-danger mt-1" style="font-size:0.8rem;"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;border:1.5px solid #E2E8F0;border-right:none;background:#F8FAFC;">
                            <i class="bi bi-lock" style="color:var(--text-secondary);"></i>
                        </span>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Min. 6 karakter" required
                               style="border-radius:0 12px 12px 0;border-left:none;"
                               id="pw1">
                        <button class="btn" type="button" onclick="togglePw('pw1','eye1')" style="border:1.5px solid #E2E8F0;border-left:none;border-radius:0 12px 12px 0;background:#F8FAFC;" tabindex="-1">
                            <i class="bi bi-eye" id="eye1" style="color:var(--text-secondary);"></i>
                        </button>
                    </div>
                    @error('password')
                    <div class="text-danger mt-1" style="font-size:0.8rem;"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;border:1.5px solid #E2E8F0;border-right:none;background:#F8FAFC;">
                            <i class="bi bi-shield-check" style="color:var(--text-secondary);"></i>
                        </span>
                        <input type="password" name="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password" required
                               style="border-radius:0 12px 12px 0;border-left:none;"
                               id="pw2">
                        <button class="btn" type="button" onclick="togglePw('pw2','eye2')" style="border:1.5px solid #E2E8F0;border-left:none;border-radius:0 12px 12px 0;background:#F8FAFC;" tabindex="-1">
                            <i class="bi bi-eye" id="eye2" style="color:var(--text-secondary);"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100" style="padding:13px;font-size:0.95rem;border-radius:14px;">
                    <i class="bi bi-stars me-2"></i>Buat Akun Sekarang
                </button>
            </form>

            <div class="text-center mt-4" style="font-size:0.88rem;color:var(--text-secondary);">
                Sudah punya akun?
                <a href="{{ route('login') }}" style="color:var(--primary);font-weight:600;text-decoration:none;">Login di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePw(id, iconId) {
    const inp = document.getElementById(id);
    const ico = document.getElementById(iconId);
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
