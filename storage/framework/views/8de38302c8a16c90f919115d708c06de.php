<?php $__env->startSection('title', 'Donasi Berhasil - Lazismu NTB'); ?>

<?php $__env->startSection('content'); ?>
<section class="success-payment-section py-5">
    <div class="container" style="max-width: 600px;">
        <div class="card success-card border-0 shadow-lg p-4 p-md-5 text-center">
            
            
            <div class="status-icon-wrapper mb-4">
                <div class="status-icon success animate-bounce">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            
            <h2 class="fw-bold text-dark mb-2">Terima Kasih!</h2>
            <p class="text-muted mb-4">Donasi Anda telah berhasil kami terima dan akan segera disalurkan.</p>
            
            
            <div class="receipt-box text-start p-4 mb-4 rounded-3 border">
                <h5 class="fw-bold text-dark text-center mb-3 pb-3 border-bottom"><i class="fas fa-file-invoice-dollar me-2 text-green"></i> Bukti Donasi Digital</h5>
                
                <div class="receipt-row d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">No. Order</span>
                    <strong class="text-dark small"><?php echo e($orderId); ?></strong>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($donation): ?>
                <div class="receipt-row d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Program</span>
                    <strong class="text-dark text-end small" style="max-width: 250px;"><?php echo e($donation->program->title); ?></strong>
                </div>

                <div class="receipt-row d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Nama Donatur</span>
                    <strong class="text-dark small"><?php echo e($donation->donor_name); ?></strong>
                </div>

                <div class="receipt-row d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Metode Pembayaran</span>
                    <strong class="text-dark small"><?php echo e(strtoupper(str_replace('_', ' ', $donation->payment_method))); ?></strong>
                </div>

                <div class="receipt-row d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Tanggal</span>
                    <strong class="text-dark small"><?php echo e($donation->paid_at ? $donation->paid_at->format('d M Y, H:i') : now()->format('d M Y, H:i')); ?> WITA</strong>
                </div>

                <div class="receipt-row d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Jumlah Donasi</span>
                    <strong class="text-dark small">Rp <?php echo e(number_format($donation->amount, 0, ',', '.')); ?></strong>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($donation->admin_fee > 0): ?>
                <div class="receipt-row d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Biaya Admin</span>
                    <strong class="text-dark small">Rp <?php echo e(number_format($donation->admin_fee, 0, ',', '.')); ?></strong>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($donation->doa)): ?>
                <div class="receipt-row py-2 mt-3 border-top">
                    <span class="text-muted small d-block mb-2">Doa / Dukungan</span>
                    <div class="text-dark small" style="white-space: pre-wrap;"><?php echo e($donation->doa); ?></div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="receipt-row d-flex justify-content-between py-2 mt-2">
                    <span class="text-muted fw-bold">Total Dibayar</span>
                    <h4 class="text-green fw-extrabold mb-0">Rp <?php echo e(number_format($donation->amount + $donation->admin_fee, 0, ',', '.')); ?></h4>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <blockquote class="blockquote-custom p-3 mb-4 rounded-3 text-center bg-light">
                <p class="mb-0 italic small text-muted">
                    "Sesungguhnya orang-orang yang bersedekah baik laki-laki maupun perempuan dan meminjamkan kepada Allah pinjaman yang baik, niscaya akan dilipatgandakan (ganjarannya) kepada mereka; dan bagi mereka pahala yang banyak."
                </p>
                <footer class="blockquote-footer mt-2 small">(QS. Al-Hadid: 18)</footer>
            </blockquote>

            
            <div class="d-flex flex-column gap-2">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-primary btn-lg py-3 fw-bold rounded-3">
                    Kembali ke Beranda
                </a>
                <button onclick="window.print()" class="btn btn-outline-secondary btn-lg py-3 rounded-3 btn-print-receipt">
                    <i class="fas fa-print me-2"></i> Cetak Bukti Pembayaran
                </button>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .success-payment-section {
        background: #f8f9fa;
        min-height: 80vh;
    }
    .success-card {
        border-radius: 18px;
        background: #ffffff;
    }
    .status-icon-wrapper {
        display: flex;
        justify-content: center;
    }
    .status-icon.success {
        color: #10B981;
        font-size: 4.5rem;
        line-height: 1;
    }
    .receipt-box {
        background: #fafafa;
        border-color: #eee !important;
    }
    .text-green {
        color: #10B981;
    }
    .fw-extrabold {
        font-weight: 800;
    }
    .blockquote-custom {
        border-left: 3px solid #10B981;
    }
    .italic {
        font-style: italic;
    }
    
    @media print {
        header, footer, .btn, .btn-print-receipt, blockquote {
            display: none !important;
        }
        .success-payment-section {
            background: none;
            padding: 0 !important;
        }
        .success-card {
            box-shadow: none !important;
            padding: 0 !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Herd\project-lazismu-ntb\resources\views/frontend/donasi/success.blade.php ENDPATH**/ ?>