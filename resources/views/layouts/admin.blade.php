<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | Masjid AL-Azhar</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue-primary: #3a7bd5;
            --blue-light: #00d2ff;
            --blue-dark: #2d5895;
            --gradient: linear-gradient(to right, #3a7bd5, #00d2ff);
        }

        body {
            font-family: 'Rubik', sans-serif;
            background-color: #f4f7fc;
        }

        /* ── Sidebar ── */
        #sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--gradient);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.3s;
        }

        #sidebar .sidebar-brand {
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 18px;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        #sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: background 0.2s;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        #sidebar .nav-link i {
            margin-right: 8px;
            font-size: 16px;
        }

        /* ── Main content ── */
        #main-content {
            margin-left: 260px;
            padding: 0;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            background: #fff;
            padding: 15px 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: 'Poppins', sans-serif;
        }

        .topbar .page-title {
            font-weight: 600;
            font-size: 18px;
            color: var(--blue-dark);
            margin: 0;
        }

        /* ── Card stats ── */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border-left: 4px solid var(--blue-primary);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
        }

        .stat-card .stat-number {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 24px;
            color: var(--blue-dark);
        }

        .stat-card .stat-label {
            font-size: 13px;
            color: #7c7c7c;
        }

        /* ── Content area ── */
        .content-area {
            padding: 25px;
        }

        .content-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            padding: 25px;
        }

        .content-card h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--blue-dark);
            margin-bottom: 20px;
        }

        .btn-primary-custom {
            background: var(--gradient);
            border: none;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            padding: 8px 18px;
            border-radius: 8px;
            transition: opacity 0.2s;
        }

        .btn-primary-custom:hover {
            opacity: 0.9;
            color: #fff;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .badge-confirmed {
            background: #d1e7dd;
            color: #0f5132;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .table th {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: var(--blue-dark);
            background: #f4f7fc;
        }

        .table td {
            font-size: 14px;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            #sidebar { width: 0; overflow: hidden; }
            #main-content { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-house-fill me-2"></i>Masjid AL-Azhar
        </div>
        <nav class="mt-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.artikel.index') }}" class="nav-link {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Artikel / Informasi
            </a>
            <a href="{{ route('admin.infaq.index') }}" class="nav-link {{ request()->routeIs('admin.infaq.*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack"></i> Kelola Infaq
            </a>
            <a href="{{ route('admin.pengeluaran.index') }}" class="nav-link {{ request()->routeIs('admin.pengeluaran.*') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i> Kelola Pengeluaran
            </a>
            <a href="{{ route('admin.inventaris.index') }}" class="nav-link {{ request()->routeIs('admin.inventaris.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Inventaris Barang
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Galeri Foto
            </a>
            <hr style="border-color: rgba(255,255,255,0.2); margin: 10px 20px;">
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="bi bi-globe"></i> Lihat Website
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h5 class="page-title">@yield('page-title', 'Dashboard')</h5>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted" style="font-size:14px;"><i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}</span>
            </div>
        </div>

        <!-- Alerts -->
        <div class="content-area pb-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
