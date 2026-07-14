<?php $__env->startSection('title', 'Instruksi Transfer Manual - Lazismu NTB'); ?>

<?php $__env->startSection('content'); ?>
<section class="manual-payment-section py-5">
    <div class="container" style="max-width: 650px;">
        <div class="card payment-card border-0 shadow-lg p-4 p-md-5 text-center">
            
            
            <div class="status-icon-wrapper mb-4">
                <div class="status-icon pending animate-pulse">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            
            <h2 class="fw-bold text-dark mb-2">Instruksi Pembayaran</h2>
            <p class="text-muted mb-4">Silakan lakukan transfer sesuai rincian di bawah ini untuk menyelesaikan donasi Anda.</p>
            
            
            <div class="program-summary p-3 mb-4 rounded-3 text-start">
                <span class="text-muted d-block small">Program Donasi</span>
                <strong class="text-dark"><?php echo e($donation->program->title); ?></strong>
            </div>

            
            <div class="amount-box p-4 mb-4 rounded-3 text-center">
                <span class="text-muted d-block small mb-1">JUMLAH TRANSFER</span>
                <h2 class="amount fw-extrabold text-orange" id="transfer-amount">
                    Rp <?php echo e(number_format($donation->amount, 0, ',', '.')); ?>

                </h2>
                <div class="d-flex justify-content-center gap-2 mt-2">
                    <button class="btn btn-outline-secondary btn-sm btn-copy" data-clipboard="<?php echo e($donation->amount); ?>">
                        <i class="far fa-copy me-1"></i> Salin Nominal
                    </button>
                </div>
            </div>

            
            <div class="bank-details-box text-start p-4 mb-4 rounded-3 border">
                <h5 class="fw-bold text-dark mb-3"><i class="fas fa-university me-2 text-orange"></i> Rekening Tujuan</h5>
                
                <div class="mb-3">
                    <span class="text-muted d-block small">Bank Tujuan</span>
                    <strong class="text-dark fs-5"><?php echo e($bankDetails['bank_name']); ?></strong>
                </div>

                <div class="mb-3 position-relative">
                    <span class="text-muted d-block small">Nomor Rekening</span>
                    <div class="d-flex align-items-center justify-content-between">
                        <strong class="text-dark fs-4" id="account-number"><?php echo e($bankDetails['account_number']); ?></strong>
                        <button class="btn btn-outline-primary btn-sm btn-copy" data-clipboard="<?php echo e(str_replace('-', '', $bankDetails['account_number'])); ?>">
                            <i class="far fa-copy me-1"></i> Salin
                        </button>
                    </div>
                </div>

                <div>
                    <span class="text-muted d-block small">Atas Nama</span>
                    <strong class="text-dark"><?php echo e($bankDetails['account_name']); ?></strong>
                </div>
            </div>

            
            <div class="alert alert-warning text-start mb-4 fs-7" role="alert">
                <i class="fas fa-info-circle me-2"></i> <strong>Penting:</strong> Harap transfer nominal tepat sesuai angka di atas. Proses verifikasi manual akan dilakukan oleh admin dalam waktu maksimal 1x24 jam.
            </div>

            
            <div class="d-flex flex-column gap-2">
                <?php
                    $waMessage = urlencode("Halo Admin Lazismu NTB, saya sudah melakukan donasi melalui Transfer Manual.\n\nDetail Donasi:\n- Nama: {$donation->donor_name}\n- Email: {$donation->donor_email}\n- Program: {$donation->program->title}\n- Nominal: Rp " . number_format($donation->amount, 0, ',', '.') . "\n- UUID: {$donation->uuid}\n\nBerikut saya lampirkan bukti transfernya.");
                    $waLink = "https://wa.me/" . env('ADMIN_WHATSAPP', '6281234567890') . "?text=" . $waMessage;
                ?>
                <a href="<?php echo e($waLink); ?>" target="_blank" class="btn btn-success btn-lg py-3 fw-bold rounded-3">
                    <i class="fab fa-whatsapp me-2"></i> Konfirmasi via WhatsApp
                </a>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary btn-lg py-3 rounded-3">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .manual-payment-section {
        background: #f8f9fa;
        min-height: 80vh;
    }
    .payment-card {
        border-radius: 18px;
        background: #ffffff;
    }
    .status-icon-wrapper {
        display: flex;
        justify-content: center;
    }
    .status-icon.pending {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(247, 148, 29, 0.1);
        color: #F7941D;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
    }
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(247, 148, 29, 0.4); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(247, 148, 29, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(247, 148, 29, 0); }
    }
    .program-summary {
        background: #f3f4f6;
        border-left: 4px solid #F7941D;
    }
    .amount-box {
        background: #FFF9F2;
        border: 1px dashed #FFE2C2;
    }
    .text-orange {
        color: #F7941D;
    }
    .fw-extrabold {
        font-weight: 800;
    }
    .fs-7 {
        font-size: 0.85rem;
    }
    .btn-copy {
        font-size: 0.8rem;
        padding: 4px 8px;
        border-radius: 6px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.btn-copy');
    
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const textToCopy = this.getAttribute('data-clipboard');
            navigator.clipboard.writeText(textToCopy).then(() => {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                this.classList.replace('btn-outline-primary', 'btn-success');
                this.classList.replace('btn-outline-secondary', 'btn-success');
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.replace('btn-success', 'btn-outline-primary');
                    this.classList.replace('btn-success', 'btn-outline-secondary');
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin: ', err);
            });
        });
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Herd\project-lazismu-ntb\resources\views/frontend/donasi/manual.blade.php ENDPATH**/ ?>