@extends('layouts.app')
@section('title', 'Admin Login - TripPlanner')

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        padding: 40px 0;
        background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 50%, #0F172A 100%);
    }
    .auth-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.12);
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        padding: 44px 40px;
        width: 100%;
        max-width: 440px;
        margin: 0 auto;
    }
    .auth-card .form-control, .auth-card .form-select {
        background: rgba(255,255,255,0.08);
        border: 1.5px solid rgba(255,255,255,0.15);
        color: #fff;
    }
    .auth-card .form-control::placeholder { color: rgba(255,255,255,0.4); }
    .auth-card .form-control:focus {
        background: rgba(255,255,255,0.12);
        border-color: #818CF8;
        box-shadow: 0 0 0 4px rgba(129,140,248,0.2);
        color: #fff;
    }
    .auth-card .form-label { color: rgba(255,255,255,0.8); }
    .auth-card .input-group-text {
        background: rgba(255,255,255,0.06) !important;
        border: 1.5px solid rgba(255,255,255,0.15) !important;
        border-right: none !important;
        color: rgba(255,255,255,0.5) !important;
    }
    @media (max-width: 480px) {
        .auth-card { padding: 32px 20px; }
    }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="auth-card anim-scale">
            <div class="text-center mb-4">
                <span style="font-size:2.4rem;">⚙️</span>
                <h1 class="mt-2 mb-1" style="font-size:1.5rem;font-weight:800;letter-spacing:-0.5px;color:#fff;">Admin Panel</h1>
                <p style="color:rgba(255,255,255,0.5);font-size:0.88rem;">Masuk ke dashboard administrator</p>
            </div>

            @if($errors->any())
            <div class="alert mb-4" style="background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#FCA5A5;border-radius:12px;font-size:0.85rem;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Admin</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="admin@tripplanner.com" required
                               style="border-radius:0 12px 12px 0;border-left:none;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius:12px 0 0 12px;">
                            <i class="bi bi-shield-lock"></i>
                        </span>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="••••••••" required
                               style="border-radius:0 12px 12px 0;border-left:none;"
                               id="adminPw">
                        <button class="btn" type="button" onclick="togglePw()" style="border:1.5px solid rgba(255,255,255,0.15);border-left:none;border-radius:0 12px 12px 0;background:rgba(255,255,255,0.06);" tabindex="-1">
                            <i class="bi bi-eye" id="eyeIcon" style="color:rgba(255,255,255,0.5);"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn w-100" style="background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;padding:13px;font-size:0.95rem;border-radius:14px;font-weight:700;box-shadow:0 8px 24px rgba(79,70,229,0.4);">
                    <i class="bi bi-shield-check me-2"></i>Login Admin
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.4);font-size:0.82rem;text-decoration:none;">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke website
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePw() {
    const inp = document.getElementById('adminPw');
    const ico = document.getElementById('eyeIcon');
    if (inp.type === 'password') { inp.type = 'text'; ico.className = 'bi bi-eye-slash'; }
    else { inp.type = 'password'; ico.className = 'bi bi-eye'; }
}
</script>
@endpush
