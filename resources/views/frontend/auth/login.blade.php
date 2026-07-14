<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Lazismu NTB - Lembaga Amil Zakat Infaq dan Shadaqah Muhammadiyah Nusa Tenggara Barat.">
    <title>Login - Lazismu NTB</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --orange-primary: #F7941D;
            --orange-dark:    #E5820A;
            --bg-page:        #EBEBEB;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-page);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 16px;
        }

        /* ── Logo ── */
        .auth-logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-logo .logo-wrapper {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
        }

        .auth-logo .auth-logo-img {
            width: 200px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 4px;
        }

        .auth-logo .brand-text {
            font-size: 2rem;
            font-weight: 800;
            color: #222;
            line-height: 1;
        }

        .auth-logo .brand-text span {
            color: var(--orange-primary);
        }

        .auth-logo .brand-sub {
            font-size: 0.72rem;
            color: #555;
            font-weight: 500;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        /* ── Card ── */
        .auth-card {
            background: #fff;
            border-radius: 14px;
            padding: 36px 40px 32px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        }

        .auth-card h2 {
            color: var(--orange-primary);
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 28px;
        }

        /* ── Labels ── */
        .auth-card label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #333;
            margin-bottom: 6px;
            display: block;
        }

        .auth-card label .req {
            color: #e00;
        }

        /* ── Inputs ── */
        .auth-card .form-control {
            border: 1.5px solid var(--orange-primary);
            border-radius: 8px;
            padding: 10px 14px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.875rem;
            color: #333;
            transition: box-shadow 0.2s;
            outline: none;
        }

        .auth-card .form-control::placeholder {
            color: #bbb;
            font-size: 0.85rem;
        }

        .auth-card .form-control:focus {
            border-color: var(--orange-primary);
            box-shadow: 0 0 0 3px rgba(247,148,29,0.18);
        }

        /* ── Lupa password ── */
        .forgot-link {
            text-align: right;
            margin-bottom: 18px;
        }

        .forgot-link a {
            font-size: 0.82rem;
            color: #444;
            text-decoration: none;
        }

        .forgot-link a:hover {
            color: var(--orange-primary);
        }

        /* ── Button ── */
        .btn-auth {
            background: var(--orange-primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-auth:hover {
            background: var(--orange-dark);
            transform: translateY(-1px);
        }

        /* ── Footer text ── */
        .auth-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 0.85rem;
            color: #555;
        }

        .auth-footer a {
            color: var(--orange-primary);
            font-weight: 500;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* ── Alert ── */
        .alert-auth {
            border-radius: 8px;
            font-size: 0.85rem;
            padding: 10px 14px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>

    {{-- Logo --}}
    <div class="auth-logo">
        <div class="logo-wrapper">
            {{-- Lazismu logo image --}}
            <img src="{{ asset('images/lazismu-logo.png') }}" alt="Lazismu NTB" class="auth-logo-img" />
        </div>
    </div>

    {{-- Card --}}
    <div class="auth-card">
        <h2>Login</h2>

        {{-- Session Status (e.g. after successful registration) --}}
        @if (session('status'))
            <div class="alert-auth" style="background:#FFF8E6; border:1.5px solid #F7941D; color:#7a4e00; display:flex; align-items:flex-start; gap:10px;">
                <span style="font-size:1.1rem; margin-top:1px;">✅</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-auth">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Nama (email field) --}}
            <div class="mb-3">
                <label for="email">Email<span class="req">*</span> :</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                >
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password">Password<span class="req">*</span> :</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    autocomplete="current-password"
                    required
                >
            </div>

            {{-- Lupa password --}}
            <div class="forgot-link">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>

            <button type="submit" class="btn-auth">Masuk</button>

            <p class="auth-footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>.
            </p>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>