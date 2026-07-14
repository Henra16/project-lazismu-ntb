@extends('frontend.layouts.app')

@section('title', 'Riwayat Donasi - Lazismu NTB')

@section('content')
<section class="donation-history-section py-5">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
            <div>
                <h2 class="fw-bold">Riwayat Donasi Anda</h2>
                <p class="text-muted mb-0">Lihat status, nominal, dan detail setiap donasi yang pernah Anda lakukan.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
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
                        @forelse($donations as $donation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $donation->created_at->format('d M Y') }}</td>
                                <td>{{ $donation->program?->title ?? '-' }}</td>
                                <td>Rp {{ number_format($donation->amount + ($donation->admin_fee ?? 0), 0, ',', '.') }}</td>
                                <td>{{ strtoupper(str_replace('_', ' ', $donation->payment_method)) }}</td>
                                <td>
                                    @php
                                        $badge = 'secondary';
                                        switch ($donation->status) {
                                            case 'paid': $badge = 'success'; break;
                                            case 'pending': $badge = 'warning'; break;
                                            case 'failed': $badge = 'danger'; break;
                                            case 'expired': $badge = 'dark'; break;
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $badge }} text-capitalize">{{ $donation->status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <a href="{{ route('donasi.track', $donation->uuid) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                        @php
                                            $proofUrl = $donation->status === 'paid' && $donation->transaction?->order_id
                                                ? route('donasi.finish', ['order_id' => $donation->transaction->order_id])
                                                : route('donasi.track', $donation->uuid);
                                        @endphp
                                        <a href="{{ $proofUrl }}" class="btn btn-sm btn-outline-success">Bukti Bayar</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat donasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .donation-history-section {
        min-height: 72vh;
    }
</style>
@endpush
