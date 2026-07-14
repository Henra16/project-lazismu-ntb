@if(session('success') || session('warning') || session('error') || session('status'))
    <div class="container py-3" style="max-width: 960px;">
        @foreach(['success', 'warning', 'error', 'status'] as $msgType)
            @if(session($msgType))
                @php
                    $alertClass = $msgType === 'success' ? 'alert-success' : ($msgType === 'warning' ? 'alert-warning' : ($msgType === 'error' ? 'alert-danger' : 'alert-info'));
                    $message = session($msgType);
                @endphp
                <div class="alert {{ $alertClass }} alert-dismissible fade show rounded-4 shadow-sm" role="alert" id="flash-message-box">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach
    </div>
@endif

@push('scripts')
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
@endpush
