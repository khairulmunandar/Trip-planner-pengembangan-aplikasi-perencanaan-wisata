<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — TripPlanner Admin</title>
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
            --admin-nav: #1E1B4B;
            --text-primary: #1E293B;
            --text-secondary: #64748B;
            --bg-light: #F1F5F9;
            --card-border: rgba(0,0,0,0.06);
            --radius-card: 18px;
            --radius-btn: 12px;
            --radius-input: 12px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05), 0 4px 16px rgba(0,0,0,0.07);
            --shadow-hover: 0 16px 40px rgba(0,0,0,0.12);
            --transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            color: var(--text-primary);
            background: var(--bg-light);
            overflow-x: hidden;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @keyframes scaleIn {
            from { opacity:0; transform:scale(0.94); }
            to   { opacity:1; transform:scale(1); }
        }
        @keyframes slideLeft {
            from { opacity:0; transform:translateX(-28px); }
            to   { opacity:1; transform:translateX(0); }
        }

        .anim-fade-up   { animation: fadeInUp 0.65s ease both; }
        .anim-fade-down { animation: fadeInDown 0.55s ease both; }
        .anim-fade      { animation: fadeIn 0.5s ease both; }
        .anim-scale     { animation: scaleIn 0.5s ease both; }
        .anim-left      { animation: slideLeft 0.65s ease both; }

        /* ── Admin Navbar ── */
        .admin-navbar {
            background: var(--admin-nav) !important;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 4px 24px rgba(0,0,0,0.3);
            padding: 14px 0;
        }
        .admin-navbar .navbar-brand {
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff !important;
            letter-spacing: -0.3px;
        }
        .admin-navbar .nav-link {
            color: rgba(255,255,255,0.75) !important;
            font-weight: 500;
            font-size: 0.88rem;
            border-radius: 10px;
            padding: 8px 14px !important;
            transition: var(--transition);
        }
        .admin-navbar .nav-link:hover, .admin-navbar .nav-link.active {
            color: #fff !important;
            background: rgba(255,255,255,0.12);
        }
        .admin-navbar .navbar-toggler {
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 10px;
        }
        .admin-navbar .navbar-toggler-icon {
            filter: invert(1);
        }
        .admin-navbar .navbar-toggler:focus { box-shadow: none; }

        /* ── Buttons ── */
        .btn {
            border-radius: var(--radius-btn);
            font-weight: 600;
            font-size: 0.88rem;
            transition: var(--transition);
            padding: 10px 20px;
            border: none;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 14px rgba(79,70,229,0.3);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(79,70,229,0.4);
        }
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
        .btn-danger { background: #EF4444; color: #fff; }
        .btn-danger:hover { background: #DC2626; transform: translateY(-2px); }
        .btn-warning { background: var(--accent); color: #fff; }
        .btn-warning:hover { background: #D97706; transform: translateY(-2px); }
        .btn-success { background: var(--secondary); color: #fff; }
        .btn-success:hover { background: #059669; transform: translateY(-2px); }
        .btn-sm { padding: 6px 14px; font-size: 0.8rem; }
        .btn-lg { padding: 13px 28px; font-size: 0.95rem; border-radius: 14px; }
        .btn-link { color: var(--primary); font-weight: 500; padding: 0; border: none; background: none; }

        /* ── Cards ── */
        .card {
            border: 1px solid var(--card-border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-sm);
            background: #fff;
            transition: var(--transition);
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        /* ── Forms ── */
        .form-control, .form-select {
            border-radius: var(--radius-input);
            border: 1.5px solid #E2E8F0;
            padding: 10px 15px;
            font-size: 0.88rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79,70,229,0.12);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        /* ── Alerts ── */
        .alert {
            border-radius: 14px;
            border: none;
            font-weight: 500;
            animation: fadeInDown 0.5s ease both;
            font-size: 0.88rem;
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

        /* ── Table ── */
        .table {
            border-radius: var(--radius-card);
            overflow: hidden;
            border: 1px solid var(--card-border);
            font-size: 0.88rem;
        }
        .table thead th {
            background: #F8FAFC;
            font-weight: 700;
            color: var(--text-secondary);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #E2E8F0;
            padding: 14px 16px;
        }
        .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #F1F5F9;
            vertical-align: middle;
        }
        .table tbody tr:last-child td { border-bottom: none; }
        .table tbody tr { transition: background 0.2s; }
        .table tbody tr:hover { background: #F8FAFC; }

        /* ── Stat cards ── */
        .stat-card {
            border-radius: var(--radius-card);
            padding: 24px;
            background: #fff;
            border: 1px solid var(--card-border);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            overflow: hidden;
            position: relative;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 100px; height: 100px;
            border-radius: 50%;
            opacity: 0.08;
        }
        .stat-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-hover); }
        .stat-card .stat-icon {
            width: 54px; height: 54px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 16px;
        }
        .stat-card .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -1px;
            color: var(--text-primary);
        }
        .stat-card .stat-label {
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* ── Page header ── */
        .admin-page-header {
            padding: 24px 0 20px;
        }

        /* ── Footer ── */
        .admin-footer {
            background: var(--dark);
            color: #64748B;
            padding: 24px 0;
            font-size: 0.82rem;
            margin-top: 60px;
            text-align: center;
        }

        /* ── Thumbnail ── */
        .thumb-sm {
            width: 56px; height: 44px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #E2E8F0;
        }

        /* ── Pagination ── */
        .pagination .page-link {
            border-radius: 10px !important;
            margin: 0 2px;
            border: 1.5px solid #E2E8F0;
            color: var(--primary);
            font-weight: 500;
            font-size: 0.85rem;
            padding: 8px 14px;
            transition: all 0.25s;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }
        .pagination .page-link:hover { background: var(--primary-light); }

        @media (max-width: 576px) {
            .stat-value { font-size: 1.8rem !important; }
            .table { font-size: 0.8rem; }
            .table thead th, .table tbody td { padding: 10px 10px; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ═══ ADMIN NAVBAR ═══ --}}
<nav class="navbar navbar-expand-lg admin-navbar sticky-top anim-fade-down">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">⚙️ TripPlanner Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto ms-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.destinasi.*') ? 'active' : '' }}" href="{{ route('admin.destinasi.index') }}">
                        <i class="bi bi-geo-alt me-1"></i>Destinasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                        <i class="bi bi-tags me-1"></i>Kategori
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm" style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.3);">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- ═══ MAIN CONTENT ═══ --}}
<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-check-circle-fill flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger d-flex align-items-start gap-2 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-1"></i>
            <div>
                <strong>Terdapat kesalahan:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="admin-footer">
    &copy; {{ date('Y') }} TripPlanner Admin Panel
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
