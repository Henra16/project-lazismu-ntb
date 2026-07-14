<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Lazismu NTB - Lembaga Amil Zakat Infaq dan Shadaqah Muhammadiyah Nusa Tenggara Barat.">
    <title>Login - Lazismu NTB</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    
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

    
    <div class="auth-logo">
        <div class="logo-wrapper">
            
            <img src="<?php echo e(asset('images/lazismu-logo.png')); ?>" alt="Lazismu NTB" class="auth-logo-img" />
        </div>
    </div>

    
    <div class="auth-card">
        <h2>Login</h2>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
            <div class="alert-auth" style="background:#FFF8E6; border:1.5px solid #F7941D; color:#7a4e00; display:flex; align-items:flex-start; gap:10px;">
                <span style="font-size:1.1rem; margin-top:1px;">✅</span>
                <span><?php echo e(session('status')); ?></span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="alert alert-danger alert-auth">
                <ul class="mb-0 ps-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li><?php echo e($error); ?></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            
            <div class="mb-3">
                <label for="email">Email<span class="req">*</span> :</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    value="<?php echo e(old('email')); ?>"
                    autocomplete="email"
                    required
                >
            </div>

            
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

            
            <div class="forgot-link">
                <a href="<?php echo e(route('password.request')); ?>">Lupa password?</a>
            </div>

            <button type="submit" class="btn-auth">Masuk</button>

            <p class="auth-footer">
                Belum punya akun? <a href="<?php echo e(route('register')); ?>">Daftar sekarang</a>.
            </p>
        </form>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\ASUS\Herd\project-lazismu-ntb\resources\views/frontend/auth/login.blade.php ENDPATH**/ ?>