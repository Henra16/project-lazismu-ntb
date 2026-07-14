

<?php $__env->startSection('title', 'Riwayat Donasi - Lazismu NTB'); ?>

<?php $__env->startSection('content'); ?>
<section class="donation-history-section py-5">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
            <div>
                <h2 class="fw-bold">Riwayat Donasi Anda</h2>
                <p class="text-muted mb-0">Lihat status, nominal, dan detail setiap donasi yang pernah Anda lakukan.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-secondary">
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Program</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($donation->created_at->format('d M Y')); ?></td>
                                <td><?php echo e($donation->program?->title ?? '-'); ?></td>
                                <td>Rp <?php echo e(number_format($donation->amount + ($donation->admin_fee ?? 0), 0, ',', '.')); ?></td>
                                <td><?php echo e(strtoupper(str_replace('_', ' ', $donation->payment_method))); ?></td>
                                <td>
                                    <?php
                                        $badge = 'secondary';
                                        switch ($donation->status) {
                                            case 'paid': $badge = 'success'; break;
                                            case 'pending': $badge = 'warning'; break;
                                            case 'failed': $badge = 'danger'; break;
                                            case 'expired': $badge = 'dark'; break;
                                        }
                                    ?>
                                    <span class="badge bg-<?php echo e($badge); ?> text-capitalize"><?php echo e($donation->status); ?></span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <a href="<?php echo e(route('donasi.track', $donation->uuid)); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                                        <?php
                                            $proofUrl = $donation->status === 'paid' && $donation->transaction?->order_id
                                                ? route('donasi.finish', ['order_id' => $donation->transaction->order_id])
                                                : route('donasi.track', $donation->uuid);
                                        ?>
                                        <a href="<?php echo e($proofUrl); ?>" class="btn btn-sm btn-outline-success">Bukti Bayar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat donasi.</td>
                            </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .donation-history-section {
        min-height: 72vh;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Herd\project-lazismu-ntb\resources\views/frontend/donasi/history.blade.php ENDPATH**/ ?>