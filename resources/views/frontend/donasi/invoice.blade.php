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

        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Detail Donasi</h2>
                    <p class="text-muted mb-0">Nomor Donasi: <strong>{{ $donation->uuid }}</strong></p>
                </div>
                <div class="text-end">
                    <span class="badge bg-{{ $donation->status === 'paid' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }} text-capitalize py-2 px-3">{{ $donation->status }}</span>
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
                        <div class="fw-semibold text-capitalize">{{ $donation->transaction?->transaction_status ?? 'pending' }}</div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">Catatan Donasi</div>
                        <div class="fw-semibold">{{ $donation->doa ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex flex-column flex-md-row gap-3">
                <a href="{{ auth()->check() && $donation->user_id === auth()->id() ? route('donasi.history') : route('donasi.check') }}" class="btn btn-outline-secondary btn-lg flex-fill">Kembali</a>

                @if($donation->status === 'pending')
                    <div class="d-flex gap-2 flex-fill flex-column flex-sm-row">
                        @if($donation->transaction && $donation->transaction->gateway_name === 'tripay' && data_get($donation->transaction->raw_response, 'checkout_url'))
                            <a href="{{ data_get($donation->transaction->raw_response, 'checkout_url') }}" class="btn btn-warning btn-lg flex-fill">Lanjutkan Pembayaran</a>
                        @elseif($donation->payment_method === 'transfer_manual' || $donation->payment_method === 'va_ntb_syariah')
                            <a href="{{ route('donasi.manual', $donation->uuid) }}" class="btn btn-warning btn-lg flex-fill">Lihat Instruksi Pembayaran</a>
                        @endif
                        <form action="{{ route('donasi.cancel', $donation->uuid) }}" method="POST" class="flex-fill" id="form-batalkan-donasi">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg w-100" id="btn-batalkan-donasi">Batalkan Transaksi</button>
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
    }
    .info-card {
        border: 1px solid #EFF2F7;
    }
</style>
@endpush

@push('scripts')
    {{-- Modal Batalkan Donasi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formBatalkan = document.getElementById('form-batalkan-donasi');
            const btnBatalkan = document.getElementById('btn-batalkan-donasi');
            const modalBatalkan = new bootstrap.Modal(document.getElementById('modalBatalkanDonasi'));
            const btnKonfirmasi = document.getElementById('btn-konfirmasi-batalkan');

            if (btnBatalkan && formBatalkan) {
                btnBatalkan.addEventListener('click', function(e) {
                    e.preventDefault();
                    modalBatalkan.show();
                });

                btnKonfirmasi?.addEventListener('click', function() {
                    formBatalkan.submit();
                });
            }
        });
    </script>
    {{-- Script Tripay tidak diperlukan karena menggunakan redirect langsung --}}
@endpush
