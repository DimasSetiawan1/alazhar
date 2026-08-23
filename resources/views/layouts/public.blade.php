<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Masjid AL-Azhar | Daerah Taman Tridaya Indah II')</title>
    <meta name="description" content="@yield('meta_description', 'DONASIKAN WAKAF TERBAIK ANDA KE MASJID AL AZHAR')">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rubik:wght@400;500&family=Outfit:wght@300;400&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue-primary: #3a7bd5;
            --blue-light: #00d2ff;
            --blue-dark: #2d5895;
            --gradient: linear-gradient(to right, #3a7bd5, #00d2ff);
            --gradient-hover: linear-gradient(to right, #2d5895, #0abce4);
        }

        body {
            font-family: 'Rubik', sans-serif;
        }

        .fontNavbar {
            font-family: 'Poppins', sans-serif;
            color: var(--blue-primary) !important;
            font-weight: 600;
        }

        .buttonCustom {
            background: var(--gradient);
            border-color: #f8f9fa;
            color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .buttonCustom:hover {
            background: var(--gradient-hover);
            border-color: #f8f9fa;
            color: #f8f9fa;
        }

        .customJumbtron {
            background: var(--gradient);
            color: #f8f9fa;
        }

        .customInformasi h2,
        .customLInfaq h2,
        .customGaleri h2,
        .customDownloads h2 {
            font-size: 30px;
            font-family: 'Poppins', sans-serif;
            color: var(--blue-primary);
        }

        .imageThumbnail {
            margin-bottom: 30px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-around;
            overflow: hidden;
        }

        .imageThumbnail img {
            transition: transform .2s;
            width: 360px;
            height: 300px;
            border-radius: 4px;
            z-index: 1;
            object-fit: cover;
        }

        .imageThumbnail:hover img {
            transform: scale(1.1);
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            color: var(--blue-primary) !important;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            color: var(--blue-primary) !important;
        }

        .nav-link:hover {
            color: var(--blue-dark) !important;
        }

        .footer {
            border-top: 1px solid #e0e0e0;
            padding: 20px 0;
            margin-top: 40px;
        }

        @media only screen and (max-width: 1024px) {
            .imageThumbnail img { width: 250px; height: 250px; }
        }
    </style>

    @stack('styles')
</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    <div class="container">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light mb-2">
            <div class="container-fluid">
                <a class="navbar-brand me-5 fw-bold fontNavbar" href="{{ route('home') }}">Masjid | AL - Azhar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item me-5">
                            <a class="nav-link fontNavbar {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link fontNavbar {{ request()->routeIs('home') ? '' : '' }}" href="{{ route('home') }}#informasi">Informasi</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link fontNavbar {{ request()->routeIs('infaq.*') ? 'active fw-bold' : '' }}" href="{{ route('infaq.index') }}">Infaq</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link fontNavbar {{ request()->routeIs('jadwal-sholat') ? 'active fw-bold' : '' }}" href="{{ route('jadwal-sholat') }}">Jadwal Sholat</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link fontNavbar {{ request()->routeIs('pengeluaran.index') ? 'active fw-bold' : '' }}" href="{{ route('pengeluaran.index') }}">Pengeluaran</a>
                        </li>
                        <li class="nav-item me-5">
                            <a class="nav-link fontNavbar" href="{{ route('home') }}#galeri">Galeri</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="https://api.whatsapp.com/send/?phone=+628111972250&text&app_absent=0"
                           target="_blank" rel="noopener noreferrer"
                           class="btn btn-sm fontNavbar">
                            <i class="bi bi-telephone-fill"></i> 0811-1972-250
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Footer -->
    <div class="footer">
        <p class="text-center fw-bolder text-secondary">Copyright @2022 | Masjid AL - Azhar | Taman Tridaya Indah II</p>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>

    @stack('scripts')
</body>
</html>
