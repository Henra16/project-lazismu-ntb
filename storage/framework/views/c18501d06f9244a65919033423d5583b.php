
<nav class="navbar navbar-expand-lg navbar-lazismu" id="navbar-main">
    <div class="container">
        
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset('images/lazismu-logo.png')); ?>" alt="Lazismu NTB" class="img-fluid" />
        </a>

        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMain" aria-controls="navbarMain"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('/') && !request()->has('section') ? 'active' : ''); ?>"
                       href="<?php echo e(url('/')); ?>#hero-section" id="nav-beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>#tentang-section" id="nav-tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>#program-section" id="nav-program">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>#berita-section" id="nav-berita">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>#laporan-section" id="nav-laporan">Laporan</a>
                </li>
            </ul>

            
            <div class="navbar-actions d-flex align-items-center gap-2">
                <a href="<?php echo e(url('/cek-donasi')); ?>" class="btn btn-orange-outline" id="btn-check-donation-nav">
                    Cek Donasi
                </a>
                <a href="<?php echo e(url('/donasi')); ?>" class="btn btn-orange" id="btn-donasi-nav">
                    Donasi Sekarang
                </a>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    
                    <div class="dropdown" id="profile-dropdown-wrap">
                        <button class="profile-trigger dropdown-toggle" type="button"
                                id="profileDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->avatar): ?>
                                <img src="<?php echo e(Storage::url(auth()->user()->avatar)); ?>"
                                     alt="Foto Profil" class="profile-avatar-img">
                            <?php else: ?>
                                <div class="profile-avatar-initial">
                                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <span class="profile-name d-none d-lg-inline">
                                <?php echo e(explode(' ', auth()->user()->name)[0]); ?>

                            </span>
                            <i class="fas fa-chevron-down profile-caret"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end profile-dropdown-menu"
                            aria-labelledby="profileDropdown">
                            
                            <li class="dropdown-header-info">
                                <div class="d-flex align-items-center gap-2 p-3 pb-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->avatar): ?>
                                        <img src="<?php echo e(Storage::url(auth()->user()->avatar)); ?>"
                                             alt="Avatar" class="dropdown-avatar">
                                    <?php else: ?>
                                        <div class="dropdown-avatar-initial">
                                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div>
                                        <div class="dropdown-user-name"><?php echo e(auth()->user()->name); ?></div>
                                        <div class="dropdown-user-email"><?php echo e(auth()->user()->email); ?></div>
                                    </div>
                                </div>
                                <hr class="dropdown-divider my-1">
                            </li>

                            
                            <?php
                                $pendingDonation = auth()->user()->donations()->where('status', 'pending')->latest()->first();
                            ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingDonation): ?>
                                <li class="dropdown-notification px-3 py-2">
                                    <div class="notification-card bg-light rounded-2">
                                        <div class="d-flex flex-column gap-2">
                                            <div class="fw-semibold">Ada transaksi donasi yang belum selesai</div>
                                            <div class="text-secondary small">Selesaikan transaksi donasi Anda dengan meninjau detail donasi pending.</div>
                                            <a href="<?php echo e(route('donasi.track', $pendingDonation->uuid)); ?>" class="btn btn-sm btn-primary w-100">
                                                Selesaikan
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li>
                                <a class="dropdown-item profile-menu-item" href="<?php echo e(route('profile.edit')); ?>">
                                    <i class="fas fa-user-edit"></i> Edit Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item profile-menu-item" href="<?php echo e(route('donasi.history')); ?>">
                                    <i class="fas fa-history"></i> Riwayat Donasi
                                </a>
                            </li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'admin'): ?>
                            <li>
                                <a class="dropdown-item profile-menu-item" href="<?php echo e(url('/admin')); ?>">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard Admin
                                </a>
                            </li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item profile-menu-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-login" id="btn-login-nav">
                        <i class="fas fa-user-circle"></i> Login
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<style>
/* ── Profile Trigger Button ── */
.profile-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: 1.5px solid #E5E7EB;
    border-radius: 30px;
    padding: 5px 12px 5px 5px;
    cursor: pointer;
    transition: all 0.2s;
    font-family: 'Poppins', sans-serif;
}
.profile-trigger:hover,
.profile-trigger.show {
    border-color: #F7941D;
    background: #FFF8E6;
}
.profile-trigger::after { display: none; } /* remove default BS caret */

.profile-avatar-img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #F7941D;
}
.profile-avatar-initial {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #F7941D;
    color: #fff;
    font-weight: 700;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.profile-name {
    font-size: 0.85rem;
    font-weight: 600;
    color: #333;
    max-width: 100px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.profile-caret {
    font-size: 0.65rem;
    color: #999;
    transition: transform 0.2s;
}
.profile-trigger.show .profile-caret { transform: rotate(180deg); }

/* ── Dropdown Menu ── */
.profile-dropdown-menu {
    border: none;
    border-radius: 14px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    padding: 0;
    min-width: 240px;
    overflow: hidden;
    margin-top: 8px !important;
}

.dropdown-user-name {
    font-size: 0.88rem;
    font-weight: 700;
    color: #222;
    line-height: 1.2;
}
.dropdown-user-email {
    font-size: 0.72rem;
    color: #999;
    margin-top: 1px;
}
.dropdown-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #F7941D;
    flex-shrink: 0;
}
.dropdown-avatar-initial {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #F7941D;
    color: #fff;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.profile-menu-item {
    font-size: 0.85rem;
    font-weight: 500;
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #444;
    transition: background 0.15s;
    font-family: 'Poppins', sans-serif;
    border: none;
    width: 100%;
    background: transparent;
    text-align: left;
    cursor: pointer;
    text-decoration: none;
}
.profile-menu-item i {
    width: 16px;
    text-align: center;
    color: #F7941D;
}
.profile-menu-item.text-danger i { color: #dc3545; }
.profile-menu-item:hover {
    background: #FFF8E6;
    color: #F7941D;
}
.profile-menu-item.text-danger:hover {
    background: #fff0f0;
    color: #dc3545;
}
</style>
<?php /**PATH C:\Users\ASUS\Herd\project-lazismu-ntb\resources\views/frontend/components/header.blade.php ENDPATH**/ ?>