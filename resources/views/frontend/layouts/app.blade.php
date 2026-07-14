<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lazismu NTB - Lembaga Amil Zakat Infaq dan Shadaqah Muhammadiyah Nusa Tenggara Barat. Memberi untuk Negeri.">
    <title>@yield('title', 'Lazismu NTB - Memberi Untuk Negeri')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ========================================
           ROOT VARIABLES & BASE STYLES
        ======================================== */
        :root {
            --orange-primary: #F7941D;
            --orange-dark: #E5820A;
            --orange-light: #FFF5E6;
            --orange-gradient: linear-gradient(135deg, #F7941D 0%, #F5A623 50%, #F7C948 100%);
            --text-dark: #2D2D2D;
            --text-gray: #6B7280;
            --text-light: #9CA3AF;
            --bg-light: #FAFAFA;
            --bg-white: #FFFFFF;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-xl: 30px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        a {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* ========================================
           BUTTONS
        ======================================== */
        .btn-orange {
            background: var(--orange-primary);
            color: #fff;
            border: none;
            border-radius: var(--radius-xl);
            padding: 10px 28px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(247, 148, 29, 0.3);
        }

        .btn-orange:hover {
            background: var(--orange-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(247, 148, 29, 0.4);
        }

        .btn-orange-outline {
            background: transparent;
            color: var(--orange-primary);
            border: 2px solid var(--orange-primary);
            border-radius: var(--radius-xl);
            padding: 8px 24px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .btn-orange-outline:hover {
            background: var(--orange-primary);
            color: #fff;
            transform: translateY(-2px);
        }

        /* ========================================
           HEADER / NAVBAR
        ======================================== */
        .navbar-lazismu {
            background: var(--bg-white);
            padding: 12px 0;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-lazismu .navbar-brand img {
            height: 45px;
        }

        .navbar-lazismu .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 16px !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-lazismu .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--orange-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-lazismu .nav-link:hover {
            color: var(--orange-primary);
        }

        .navbar-lazismu .nav-link:hover::after {
            width: 60%;
        }

        .navbar-lazismu .nav-link.active {
            color: var(--orange-primary);
            font-weight: 600;
        }

        .navbar-lazismu .nav-link.active::after {
            width: 60%;
        }

        .btn-login {
            background: transparent;
            border: 2px solid #E5E7EB;
            border-radius: var(--radius-xl);
            padding: 8px 20px;
            font-weight: 500;
            color: var(--text-dark);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-login:hover {
            border-color: var(--orange-primary);
            color: var(--orange-primary);
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        /* ========================================
           HERO SECTION
        ======================================== */
        .hero-section {
            position: relative;
            border-radius: 0 0 var(--radius-lg) var(--radius-lg);
            overflow: hidden;
            margin: 0 20px;
        }

        .hero-carousel .carousel-item {
            min-height: 420px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-carousel .carousel-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(247, 148, 29, 0.85) 0%, rgba(247, 148, 29, 0.4) 60%, transparent 100%);
        }

        .hero-carousel .carousel-caption {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }

        .hero-carousel .hero-logo {
            height: 60px;
            margin-bottom: 20px;
        }

        .hero-carousel h1 {
            font-size: 3rem;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
            letter-spacing: 2px;
        }

        .hero-carousel .hero-subtitle {
            font-size: 1.4rem;
            color: #fff;
            font-weight: 600;
            font-style: italic;
            margin-bottom: 30px;
            text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.15);
        }

        .hero-carousel .btn-hero {
            background: linear-gradient(135deg, #1B6EC2 0%, #2980D4 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius-xl);
            padding: 14px 36px;
            font-weight: 700;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(27, 110, 194, 0.4);
            transition: all 0.3s ease;
        }

        .hero-carousel .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(27, 110, 194, 0.5);
        }

        .hero-carousel .carousel-control-prev,
        .hero-carousel .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .hero-carousel .carousel-control-prev {
            left: 20px;
        }

        .hero-carousel .carousel-control-next {
            right: 20px;
        }

        .hero-carousel .carousel-control-prev:hover,
        .hero-carousel .carousel-control-next:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* ========================================
           SEARCH BAR
        ======================================== */
        .search-section {
            margin-top: -30px;
            position: relative;
            z-index: 10;
            padding: 0 40px;
        }

        .search-bar {
            background: var(--bg-white);
            border-radius: var(--radius-xl);
            padding: 8px 8px 8px 24px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            max-width: 700px;
            margin: 0 auto;
        }

        .search-bar i {
            color: var(--text-light);
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 1rem;
            color: var(--text-dark);
            background: transparent;
            font-family: 'Poppins', sans-serif;
        }

        .search-bar input::placeholder {
            color: var(--text-light);
        }

        .search-bar .btn-search {
            background: var(--orange-primary);
            color: #fff;
            border: none;
            border-radius: var(--radius-xl);
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .search-bar .btn-search:hover {
            background: var(--orange-dark);
        }

        /* ========================================
           SECTION TITLES
        ======================================== */
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title .icon-star {
            color: var(--orange-primary);
            font-size: 2.5rem;
            margin-bottom: 8px;
            display: block;
        }

        .section-title h2 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .section-title h2 span {
            color: var(--orange-primary);
        }

        /* ========================================
           TENTANG SECTION
        ======================================== */
        .tentang-section {
            padding: 80px 0 60px;
        }

        .tentang-section .tentang-content h4 {
            font-weight: 700;
            color: var(--orange-primary);
            font-size: 1.1rem;
            margin-bottom: 16px;
        }

        .tentang-section .tentang-content p {
            color: var(--text-gray);
            line-height: 1.8;
            font-size: 0.92rem;
            text-align: justify;
        }

        .tentang-section .tentang-card {
            background: var(--orange-primary);
            border-radius: var(--radius-lg);
            padding: 50px 40px;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .tentang-section .tentang-card::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .tentang-section .tentang-card .card-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #fff;
        }

        .tentang-section .tentang-card h3 {
            font-size: 2.2rem;
            font-weight: 800;
        }

        .tentang-section .tentang-card .tagline {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FFE082;
        }

        .btn-baca {
            background: var(--orange-primary);
            color: #fff;
            border: none;
            border-radius: var(--radius-xl);
            padding: 12px 32px;
            font-weight: 600;
            margin-top: 20px;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-baca:hover {
            background: var(--orange-dark);
            color: #fff;
            transform: translateY(-2px);
        }

        /* ========================================
           PROGRAM SECTION
        ======================================== */
        .program-section {
            padding: 60px 0 80px;
            position: relative;
        }

        .program-section .program-bg {
            background: linear-gradient(180deg, var(--orange-light) 0%, #FFF8E8 100%);
            border-radius: var(--radius-lg);
            padding: 60px 30px;
            margin: 0 20px;
            position: relative;
            overflow: hidden;
        }

        .program-section .program-bg .leaf-left,
        .program-section .program-bg .leaf-right {
            position: absolute;
            bottom: 0;
            width: 120px;
            height: 120px;
            opacity: 0.6;
        }

        .program-section .program-bg .leaf-left {
            left: 0;
        }

        .program-section .program-bg .leaf-right {
            right: 0;
        }

        .program-tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .program-tabs .tab-btn {
            padding: 10px 28px;
            border-radius: var(--radius-xl);
            border: 2px solid var(--orange-primary);
            background: transparent;
            color: var(--orange-primary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
        }

        .program-tabs .tab-btn.active,
        .program-tabs .tab-btn:hover {
            background: var(--orange-primary);
            color: #fff;
        }

        .program-card {
            background: var(--bg-white);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            height: 100%;
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .program-card .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .program-card .card-body {
            padding: 20px;
        }

        .program-card .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .program-card .card-category {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 16px;
        }

        .program-card .progress-info {
            margin-bottom: 6px;
        }

        .program-card .progress-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .program-card .progress-amount {
            font-size: 0.85rem;
            color: var(--orange-primary);
            font-weight: 700;
        }

        .program-card .progress {
            height: 6px;
            border-radius: 10px;
            background: #F3F4F6;
            margin-bottom: 8px;
        }

        .program-card .progress-bar {
            background: var(--orange-gradient);
            border-radius: 10px;
        }

        .program-card .target-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }

        .program-card .target-label {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .program-card .target-amount {
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 600;
        }

        .program-card .btn-donasi {
            background: var(--orange-primary);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            padding: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            width: 100%;
            margin-top: 16px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }

        .program-card .btn-donasi:hover {
            background: var(--orange-dark);
        }

        .link-more {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .link-more:hover {
            color: var(--orange-primary);
            gap: 10px;
        }

        /* ========================================
           BERITA SECTION
        ======================================== */
        .berita-section {
            padding: 60px 0 80px;
        }

        .berita-card {
            border-radius: var(--radius-md);
            overflow: hidden;
            background: var(--bg-white);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            height: 100%;
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .berita-card .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .berita-card .card-body {
            padding: 16px 20px;
        }

        .berita-card .card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .berita-card .card-date {
            font-size: 0.8rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 12px;
        }

        .berita-card .card-link {
            font-size: 0.85rem;
            color: var(--orange-primary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .berita-card .card-link:hover {
            gap: 8px;
            color: var(--orange-dark);
        }

        /* ========================================
           FOOTER
        ======================================== */
        .footer-lazismu {
            background: var(--bg-white);
            border-top: 1px solid #F3F4F6;
            padding: 50px 0 30px;
            margin-top: 0;
        }

        .footer-lazismu .footer-logo img {
            height: 80px;
            margin-bottom: 8px;
        }

        .footer-lazismu .footer-brand {
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .footer-lazismu h5 {
            color: var(--orange-primary);
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-style: italic;
        }

        .footer-lazismu .footer-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-lazismu .footer-info li {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        .footer-lazismu .footer-info li i {
            color: var(--orange-primary);
            margin-top: 3px;
            min-width: 16px;
        }

        .footer-lazismu .social-icons {
            display: flex;
            gap: 12px;
        }

        .footer-lazismu .social-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .footer-lazismu .social-icon.instagram {
            background: linear-gradient(135deg, #F58529, #DD2A7B, #8134AF, #515BD4);
            color: #fff;
        }

        .footer-lazismu .social-icon.facebook {
            background: #1877F2;
            color: #fff;
        }

        .footer-lazismu .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .footer-bottom {
            border-top: 1px solid #F3F4F6;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        /* ========================================
           RESPONSIVE
        ======================================== */
        @media (max-width: 991px) {
            .hero-carousel .carousel-item {
                min-height: 320px;
            }

            .hero-carousel h1 {
                font-size: 2rem;
            }

            .hero-carousel .hero-subtitle {
                font-size: 1.1rem;
            }

            .navbar-lazismu .navbar-actions {
                margin-top: 12px;
                display: flex;
                gap: 8px;
            }
        }

        @media (max-width: 767px) {
            .hero-section {
                margin: 0 10px;
            }

            .hero-carousel .carousel-item {
                min-height: 260px;
            }

            .hero-carousel h1 {
                font-size: 1.5rem;
            }

            .hero-carousel .hero-subtitle {
                font-size: 0.95rem;
            }

            .search-section {
                padding: 0 16px;
            }

            .tentang-section .tentang-card {
                margin-top: 30px;
            }

            .program-section .program-bg {
                margin: 0 10px;
                padding: 40px 16px;
            }

            .section-title h2 {
                font-size: 1.5rem;
            }
        }

        /* ========================================
           ANIMATIONS
        ======================================== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Header --}}
    @include('frontend.components.header')

    {{-- Flash Messages --}}
    @include('frontend.partials.flash-messages')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('frontend.components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>