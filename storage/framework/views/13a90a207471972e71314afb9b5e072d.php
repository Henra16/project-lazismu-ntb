<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success') || session('warning') || session('error') || session('status')): ?>
    <div class="container py-3" style="max-width: 960px;">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['success', 'warning', 'error', 'status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session($msgType)): ?>
                <?php
                    $alertClass = $msgType === 'success' ? 'alert-success' : ($msgType === 'warning' ? 'alert-warning' : ($msgType === 'error' ? 'alert-danger' : 'alert-info'));
                    $message = session($msgType);
                ?>
                <div class="alert <?php echo e($alertClass); ?> alert-dismissible fade show rounded-4 shadow-sm" role="alert" id="flash-message-box">
                    <?php echo e($message); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php $__env->startPush('scripts'); ?>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-message-box');
        if (flash) {
            setTimeout(function () {
                const bsAlert = new bootstrap.Alert(flash);
                bsAlert.close();
            }, 6000);
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\ASUS\Herd\project-lazismu-ntb\resources\views/frontend/partials/flash-messages.blade.php ENDPATH**/ ?>