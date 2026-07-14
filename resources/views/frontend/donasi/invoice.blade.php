@extends('frontend.layouts.app')

@section('title', 'Detail Donasi - Lazismu NTB')

@section('content')
<section class="invoice-section py-5">
    <div class="container" style="max-width: 860px;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- ===== PAID: Banner Sukses ===== --}}
        @if($donation->status === 'paid')
        <div class="paid-success-banner mb-4 p-4 rounded-4 text-center">
            <div class="paid-icon mb-3">&#x2705;</div>
            <h3 class="fw-bold text-white mb-1">Pembayaran Berhasil!</h3>
            <p class="text-white mb-0 opacity-75">Donasi Anda telah kami terima. Jazakallahu Khairan!</p>
        </div>
        @endif

        {{-- ===== PENDING: Banner Menunggu dengan Auto-check ===== --}}
        @if($donation->status === 'pending')
        <div id="pending-banner" class="pending-waiting-banner mb-4 p-4 rounded-4">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="spinner-border text-warning spinner-border-sm flex-shrink-0" role="status"></div>
                <div>
                    <div class="fw-bold" style="color:#92400e;">Menunggu Konfirmasi Pembayaran</div>
                    <div class="small" style="color:#78350f;">Halaman akan otomatis diperbarui saat pembayaran dikonfirmasi...</div>
                </div>
            </div>
        </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5" id="invoice-card">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Detail Donasi</h2>
                    <p class="text-muted mb-0">Nomor Donasi: <strong>{{ $donation->uuid }}</strong></p>
                </div>
                <div class="text-end">
                    <span id="status-badge" class="badge py-2 px-3 fs-6
                        {{ $donation->status === 'paid' ? 'bg-success' : ($donation->status === 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                        @if($donation->status === 'paid') &#x2705; Lunas
                        @elseif($donation->status === 'pending') &#x23F3; Menunggu
                        @elseif($donation->status === 'expired') &#x274C; Kedaluwarsa
                        @else {{ $donation->status }}
                        @endif
                    </span>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="info-card p-4 rounded-4 bg-light">
                        <h5 class="fw-bold mb-3">Informasi Donatur</h5>
                        <div class="mb-3">
                            <div class="text-muted small">Nama</div>
                            <div class="fw-semibold">{{ $donation->donor_name }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">{{ $donation->donor_email }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">No. Telepon</div>
                            <div class="fw-semibold">{{ $donation->donor_phone }}</div>
                        </div>
                        <div>
                            <div class="text-muted small">Program</div>
                            <div class="fw-semibold">{{ $donation->program?->title ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="info-card p-4 rounded-4 bg-light">
                        <h5 class="fw-bold mb-3">Rincian Pembayaran</h5>
                        <div class="mb-3">
                            <div class="text-muted small">Metode Pembayaran</div>
                            <div class="fw-semibold text-uppercase">{{ str_replace('_', ' ', $donation->payment_method) }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Jumlah Donasi</div>
                            <div class="fw-semibold">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
                        </div>
                        @if($donation->admin_fee > 0)
                            <div class="mb-3">
                                <div class="text-muted small">Biaya Admin</div>
                                <div class="fw-semibold">Rp {{ number_format($donation->admin_fee, 0, ',', '.') }}</div>
                            </div>
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="text-muted small">Total Pembayaran</div>
                                <div class="fw-semibold fs-5">Rp {{ number_format($donation->amount + $donation->admin_fee, 0, ',', '.') }}</div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <div class="text-muted small">Tanggal Transaksi</div>
                            <div class="fw-semibold">{{ $donation->created_at->format('d M Y, H:i') }} WITA</div>
                        </div>
                        @if($donation->paid_at)
                            <div>
                                <div class="text-muted small">Tanggal Pembayaran</div>
                                <div class="fw-semibold">{{ $donation->paid_at->format('d M Y, H:i') }} WITA</div>
                            </div>
                        @else
                            <div id="paid-at-container" style="display:none;">
                                <div class="text-muted small">Tanggal Pembayaran</div>
                                <div class="fw-semibold" id="paid-at-value">-</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 border bg-white">
                <h5 class="fw-bold mb-3">Ringkasan Transaksi</h5>
                <div class="row gy-3">
                    <div class="col-12 col-md-6">
                        <div class="text-muted small">ID Order</div>
                        <div class="fw-semibold">{{ $donation->transaction?->order_id ?? '-' }}</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="text-muted small">Status Gateway</div>
                        <div class="fw-semibold text-capitalize" id="gateway-status">{{ $donation->transaction?->transaction_status ?? 'pending' }}</div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">Catatan Donasi</div>
                        <div class="fw-semibold">{{ $donation->doa ?? '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- Bukti Pembayaran Digital (muncul saat paid) --}}
            @if($donation->status === 'paid')
            <div class="mt-4 p-4 rounded-4 border border-success bg-success bg-opacity-10" id="receipt-section">
                <h5 class="fw-bold mb-3 text-success">&#x1F389; Bukti Pembayaran Digital</h5>
                <div class="row gy-2">
                    <div class="col-6">
                        <div class="text-muted small">Donatur</div>
                        <div class="fw-semibold">{{ $donation->donor_name }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Program</div>
                        <div class="fw-semibold">{{ $donation->program?->title }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Total Donasi</div>
                        <div class="fw-bold text-success fs-5">Rp {{ number_format($donation->amount + ($donation->admin_fee ?? 0), 0, ',', '.') }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Dibayar Pada</div>
                        <div class="fw-semibold">{{ $donation->paid_at?->format('d M Y, H:i') }} WITA</div>
                    </div>
                </div>
            </div>
            @else
            <div class="mt-4 p-4 rounded-4 border border-success bg-success bg-opacity-10" id="receipt-section" style="display:none;">
                <h5 class="fw-bold mb-3 text-success">&#x1F389; Bukti Pembayaran Digital</h5>
                <div class="row gy-2" id="receipt-content"></div>
            </div>
            @endif

            <div class="mt-4 d-flex flex-column flex-md-row gap-3" id="action-buttons">
                <a href="{{ auth()->check() && $donation->user_id === auth()->id() ? route('donasi.history') : route('donasi.check') }}"
                   class="btn btn-outline-secondary btn-lg flex-fill">Kembali</a>

                @if($donation->status === 'paid')
                    <button onclick="window.print()" class="btn btn-success btn-lg flex-fill">
                        <i class="fas fa-print me-2"></i> Cetak Bukti Pembayaran
                    </button>
                @endif

                @if($donation->status === 'pending')
                    <div class="d-flex gap-2 flex-fill flex-column flex-sm-row" id="pending-actions">
                        @if($donation->transaction && $donation->transaction->gateway_name === 'tripay' && data_get($donation->transaction->raw_response, 'checkout_url'))
                            <a href="{{ data_get($donation->transaction->raw_response, 'checkout_url') }}"
                               class="btn btn-warning btn-lg flex-fill">Lanjutkan Pembayaran</a>
                        @elseif($donation->payment_method === 'transfer_manual' || $donation->payment_method === 'va_ntb_syariah')
                            <a href="{{ route('donasi.manual', $donation->uuid) }}"
                               class="btn btn-warning btn-lg flex-fill">Lihat Instruksi Pembayaran</a>
                        @endif
                        <form action="{{ route('donasi.cancel', $donation->uuid) }}" method="POST"
                              class="flex-fill" id="form-batalkan-donasi">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg w-100"
                                    id="btn-batalkan-donasi">Batalkan Transaksi</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Modal Konfirmasi Batalkan Donasi --}}
<div class="modal fade" id="modalBatalkanDonasi" tabindex="-1" aria-labelledby="modalBatalkanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-bold" id="modalBatalkanLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Batalkan Transaksi Donasi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Anda yakin ingin <strong>membatalkan transaksi donasi</strong> ini?</p>
                <div class="alert alert-warning mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <small>Pembatalan tidak dapat dibatalkan kembali. Jika ingin melakukan donasi kembali, Anda harus membuat donasi baru.</small>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak, Jangan Batalkan</button>
                <button type="button" class="btn btn-danger" id="btn-konfirmasi-batalkan">
                    <i class="fas fa-trash me-1"></i>Ya, Batalkan Transaksi
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .invoice-section {
        min-height: 72vh;
        background: #f8fafc;
    }
    .info-card {
        border: 1px solid #EFF2F7;
    }

    /* Paid banner */
    .paid-success-banner {
        background: linear-gradient(135deg, #10B981, #059669);
        animation: fadeInDown 0.6s ease forwards;
    }
    .paid-icon {
        font-size: 3rem;
        animation: bounceIn 0.8s ease;
    }

    /* Pending banner */
    .pending-waiting-banner {
        background: #FEF3C7;
        border: 1px solid #FCD34D;
    }

    /* Receipt section */
    #receipt-section {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes bounceIn {
        0%   { transform: scale(0.3); opacity: 0; }
        60%  { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @media print {
        header, footer, nav, .btn,
        .pending-waiting-banner,
        #pending-actions,
        #modalBatalkanDonasi {
            display: none !important;
        }
        .invoice-section { background: none; padding: 0 !important; }
        .card { box-shadow: none !important; }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===== Modal Batalkan =====
    const formBatalkan  = document.getElementById('form-batalkan-donasi');
    const btnBatalkan   = document.getElementById('btn-batalkan-donasi');
    const btnKonfirmasi = document.getElementById('btn-konfirmasi-batalkan');
    const modalEl       = document.getElementById('modalBatalkanDonasi');

    if (btnBatalkan && formBatalkan && modalEl) {
        const modalBatalkan = new bootstrap.Modal(modalEl);
        btnBatalkan.addEventListener('click', function (e) {
            e.preventDefault();
            modalBatalkan.show();
        });
        if (btnKonfirmasi) {
            btnKonfirmasi.addEventListener('click', function () {
                formBatalkan.submit();
            });
        }
    }

    // ===== Auto-Polling Status (hanya saat pending) =====
    @if($donation->status === 'pending')
    const donationUuid = '{{ $donation->uuid }}';
    const checkUrl     = '/donasi/track/' + donationUuid + '/status';
    let pollInterval   = null;
    let pollCount      = 0;
    const MAX_POLLS    = 72; // ~6 menit (72 x 5 detik)

    function checkPaymentStatus() {
        pollCount++;
        if (pollCount > MAX_POLLS) {
            clearInterval(pollInterval);
            return;
        }

        fetch(checkUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.status === 'paid') {
                clearInterval(pollInterval);
                handlePaymentPaid(data);
            } else if (data.status === 'expired' || data.status === 'failed') {
                clearInterval(pollInterval);
                location.reload();
            }
        })
        .catch(function () { /* silent — retry on next tick */ });
    }

    function handlePaymentPaid(data) {
        // Sembunyikan pending banner
        var pendingBanner = document.getElementById('pending-banner');
        if (pendingBanner) pendingBanner.style.display = 'none';

        // Tampilkan paid banner di atas invoice card
        var paidBanner = document.createElement('div');
        paidBanner.className = 'paid-success-banner mb-4 p-4 rounded-4 text-center';
        paidBanner.innerHTML  = '<div class="paid-icon mb-3">&#x2705;</div>';
        paidBanner.innerHTML += '<h3 class="fw-bold text-white mb-1">Pembayaran Berhasil!</h3>';
        paidBanner.innerHTML += '<p class="text-white mb-0 opacity-75">Donasi Anda telah kami terima. Jazakallahu Khairan!</p>';
        var invoiceCard = document.getElementById('invoice-card');
        invoiceCard.parentNode.insertBefore(paidBanner, invoiceCard);

        // Update badge
        var badge = document.getElementById('status-badge');
        if (badge) {
            badge.className   = 'badge bg-success py-2 px-3 fs-6';
            badge.textContent = '✅ Lunas';
        }

        // Update gateway status
        var gwStatus = document.getElementById('gateway-status');
        if (gwStatus) gwStatus.textContent = 'paid';

        // Tampilkan tanggal dibayar
        if (data.paid_at) {
            var paidAtContainer = document.getElementById('paid-at-container');
            var paidAtValue     = document.getElementById('paid-at-value');
            if (paidAtContainer && paidAtValue) {
                paidAtValue.textContent  = data.paid_at + ' WITA';
                paidAtContainer.style.display = 'block';
            }
        }

        // Tampilkan receipt section
        var receiptSection = document.getElementById('receipt-section');
        if (receiptSection) {
            var rcContent = document.getElementById('receipt-content');
            if (rcContent && data.receipt) {
                rcContent.innerHTML =
                    '<div class="col-6"><div class="text-muted small">Donatur</div><div class="fw-semibold">' + data.receipt.donor_name + '</div></div>' +
                    '<div class="col-6"><div class="text-muted small">Program</div><div class="fw-semibold">' + data.receipt.program + '</div></div>' +
                    '<div class="col-6"><div class="text-muted small">Total Donasi</div><div class="fw-bold text-success fs-5">' + data.receipt.total + '</div></div>' +
                    '<div class="col-6"><div class="text-muted small">Dibayar Pada</div><div class="fw-semibold">' + (data.paid_at || '-') + ' WITA</div></div>';
            }
            receiptSection.style.display = 'block';
        }

        // Hapus tombol pending, tambah tombol cetak
        var pendingActions = document.getElementById('pending-actions');
        if (pendingActions) pendingActions.remove();

        var actionButtons = document.getElementById('action-buttons');
        if (actionButtons) {
            var printBtn    = document.createElement('button');
            printBtn.className   = 'btn btn-success btn-lg flex-fill';
            printBtn.innerHTML   = '<i class="fas fa-print me-2"></i> Cetak Bukti Pembayaran';
            printBtn.onclick     = function () { window.print(); };
            actionButtons.appendChild(printBtn);
        }

        // Scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Mulai polling tiap 5 detik
    pollInterval = setInterval(checkPaymentStatus, 5000);
    @endif
});
</script>
@endpush
