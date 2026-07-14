<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reset Password Lazismu NTB - Atur ulang kata sandi akun Anda.">
    <title>Reset Password - Lazismu NTB</title>

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

        .auth-logo svg {
            width: 56px;
            height: 56px;
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
            margin-top: 8px;
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
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(0 50 50)"/>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(45 50 50)"/>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(90 50 50)"/>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(135 50 50)"/>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(180 50 50)"/>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(225 50 50)"/>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(270 50 50)"/>
                    <ellipse cx="50" cy="22" rx="10" ry="18" fill="#F7941D" transform="rotate(315 50 50)"/>
                    <circle cx="50" cy="50" r="14" fill="#F7941D"/>
                </g>
            </svg>
            <div class="brand-text">lazis<span>mu</span></div>
            <div class="brand-sub">Nusa Tenggara Barat</div>
        </div>
    </div>

    {{-- Card --}}
    <div class="auth-card">
        <h2>Reset Password</h2>

        {{-- Status sukses setelah kirim link --}}
        @if (session('status'))
            <div class="alert alert-success alert-auth">
                {{ session('status') }}
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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email">Email<span class="req">*</span> :</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                    autofocus
                >
            </div>

            <button type="submit" class="btn-auth">Reset Password</button>

            <p class="auth-footer">
                Sudah Ingat Password? <a href="{{ route('login') }}">Login di sini</a>.
            </p>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>