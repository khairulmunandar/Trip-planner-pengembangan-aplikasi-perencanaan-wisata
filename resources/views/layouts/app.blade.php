<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TripPlanner')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" href="data:,">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-dark: #4338CA;
            --primary-light: #EEF2FF;
            --secondary: #10B981;
            --accent: #F59E0B;
            --dark: #0F172A;
            --text-primary: #1E293B;
            --text-secondary: #64748B;
            --bg-light: #F8FAFC;
            --card-border: rgba(0,0,0,0.06);
            --radius-card: 20px;
            --radius-btn: 12px;
            --radius-input: 12px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.04), 0 6px 24px rgba(0,0,0,0.06);
            --shadow-hover: 0 20px 40px rgba(0,0,0,0.12);
            --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--text-primary);
            background: var(--bg-light);
            overflow-x: hidden;
        }

        /* ── Animations ── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.93); }
            to   { opacity: 1; transform: scale(1); }
        }
        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-36px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(36px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-12px); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(79,70,229,0.4); }
            50%       { box-shadow: 0 0 0 14px rgba(79,70,229,0); }
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes bounceIn {
            0%   { opacity: 0; transform: scale(0.3); }
            50%  { opacity: 1; transform: scale(1.05); }
            70%  { transform: scale(0.9); }
            100% { transform: scale(1); }
        }

        .anim-fade-up   { animation: fadeInUp 0.7s ease both; }
        .anim-fade-down { animation: fadeInDown 0.6s ease both; }
        .anim-fade      { animation: fadeIn 0.6s ease both; }
        .anim-scale     { animation: scaleIn 0.5s ease both; }
        .anim-left      { animation: slideLeft 0.7s ease both; }
        .anim-right     { animation: slideRight 0.7s ease both; }
        .anim-float     { animation: float 3.5s ease-in-out infinite; }
        .anim-bounce    { animation: bounceIn 0.6s ease both; }

        /* ── Navbar ── */
        .navbar-glass {
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            background: rgba(255,255,255,0.88) !important;
            border-bottom: 1px solid rgba(79,70,229,0.08);
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
            padding: 14px 0;
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.3rem;
            background: linear-gradient(135deg, var(--primary), #818CF8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.3px;
        }
        .nav-link {
            font-weight: 500;
            color: var(--text-secondary) !important;
            padding: 8px 14px !important;
            border-radius: 10px;
            transition: var(--transition);
            font-size: 0.9rem;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background: var(--primary-light);
        }
        .navbar-toggler {
            border: none;
            padding: 6px;
            border-radius: 10px;
        }
        .navbar-toggler:focus { box-shadow: none; }

        /* ── Buttons ── */
        .btn {
            border-radius: var(--radius-btn);
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            padding: 10px 22px;
            border: none;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 15px rgba(79,70,229,0.3);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79,70,229,0.45);
        }
        .btn-primary:active { transform: translateY(0); }
        .btn-outline-primary {
            border: 2px solid var(--primary) !important;
            color: var(--primary) !important;
            background: transparent !important;
        }
        .btn-outline-primary:hover {
            background: var(--primary) !important;
            color: #fff !important;
            transform: translateY(-2px);
        }
        .btn-danger {
            background: #EF4444;
            color: #fff;
            box-shadow: 0 4px 15px rgba(239,68,68,0.25);
        }
        .btn-danger:hover {
            background: #DC2626;
            transform: translateY(-2px);
        }
        .btn-success {
            background: var(--secondary);
            color: #fff;
            box-shadow: 0 4px 15px rgba(16,185,129,0.25);
        }
        .btn-success:hover { background: #059669; transform: translateY(-2px); }
        .btn-warning {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 15px rgba(245,158,11,0.25);
        }
        .btn-warning:hover { background: #D97706; transform: translateY(-2px); }
        .btn-sm { padding: 7px 16px; font-size: 0.82rem; }
        .btn-lg { padding: 14px 32px; font-size: 1rem; border-radius: 14px; }
        .btn-link { color: var(--primary); font-weight: 500; padding: 0; }
        .btn-link:hover { color: var(--primary-dark); }

        /* ── Cards ── */
        .card {
            border: 1px solid var(--card-border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            background: #fff;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(79,70,229,0.15);
        }
        .card-hover .card-img-wrap {
            overflow: hidden;
            border-radius: var(--radius-card) var(--radius-card) 0 0;
        }
        .card-hover .card-img-wrap img {
            transition: transform 0.7s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        .card-hover:hover .card-img-wrap img {
            transform: scale(1.1);
        }

        /* ── Forms ── */
        .form-control, .form-select {
            border-radius: var(--radius-input);
            border: 1.5px solid #E2E8F0;
            padding: 11px 16px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: #fff;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79,70,229,0.12);
            outline: none;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        /* ── Badges ── */
        .badge {
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 5px 10px;
        }
        .badge-primary { background: var(--primary-light); color: var(--primary); }
        .badge-success { background: #ECFDF5; color: #059669; }
        .badge-warning { background: #FFFBEB; color: #D97706; }
        .badge-secondary { background: #F1F5F9; color: var(--text-secondary); }

        /* ── Alerts ── */
        .alert {
            border-radius: 14px;
            border: none;
            font-weight: 500;
            animation: fadeInDown 0.5s ease both;
            font-size: 0.9rem;
        }
        .alert-success {
            background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
            color: #065F46;
            border-left: 4px solid #10B981;
        }
        .alert-danger {
            background: linear-gradient(135deg, #FEF2F2, #FEE2E2);
            color: #991B1B;
            border-left: 4px solid #EF4444;
        }

        /* ── Page header ── */
        .page-header {
            padding: 32px 0 24px;
        }
        .page-header h1, .page-header h2 {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        /* ── Footer ── */
        .site-footer {
            background: var(--dark);
            color: #94A3B8;
            padding: 36px 0;
            font-size: 0.88rem;
            margin-top: 60px;
        }
        .site-footer a { color: #94A3B8; text-decoration: none; }
        .site-footer a:hover { color: #fff; }

        /* ── Utility ── */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), #818CF8, #A78BFA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .section-title {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }

        /* ── Responsive ── */
        @media (max-width: 576px) {
            .btn-lg { padding: 12px 24px; font-size: 0.95rem; }
            .section-title { font-size: 1.3rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ═══ NAVBAR ═══ --}}
<nav class="navbar navbar-expand-lg navbar-glass sticky-top anim-fade-down">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">🧭 TripPlanner</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto ms-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('destinasi.*') ? 'active' : '' }}" href="{{ route('destinasi.index') }}">
                        <i class="bi bi-map me-1"></i>Destinasi
                    </a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('trips.*') ? 'active' : '' }}" href="{{ route('trips.index') }}">
                        <i class="bi bi-suitcase me-1"></i>Trip Saya
                    </a>
                </li>
                @endauth
            </ul>
            <ul class="navbar-nav align-items-lg-center gap-2">
                @auth
                    <li class="nav-item d-none d-lg-flex align-items-center me-2">
                        <span style="font-size:0.88rem; color:var(--text-secondary); font-weight:500;">
                            <i class="bi bi-person-circle me-1"></i>Halo, <strong>{{ Auth::user()->nama }}</strong>
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i>Keluar
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-person me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-stars me-1"></i>Daftar Gratis
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- ═══ MAIN CONTENT ═══ --}}
<main>
    @if(session('success') || $errors->any())
    <div class="container py-3">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-start gap-2 mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-1"></i>
                <div>
                    <strong>Terdapat beberapa kesalahan:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    @endif

    @yield('content')
</main>

{{-- ═══ FOOTER ═══ --}}
<footer class="site-footer">
    <div class="container text-center">
        <p class="mb-1" style="font-weight:600; color:#CBD5E1; font-size:1rem;">🧭 TripPlanner</p>
        <p class="mb-0">&copy; {{ date('Y') }} TripPlanner — Perencana Perjalanan Wisata</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
