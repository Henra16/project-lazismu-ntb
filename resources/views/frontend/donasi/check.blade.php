@extends('frontend.layouts.app')

@section('title', 'Cek Donasi - Lazismu NTB')

@section('content')
<section class="donation-check-section py-5">
    <div class="container" style="max-width: 620px;">
        <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
            <div class="mb-4 text-center">
                <h2 class="fw-bold">Cek Status Donasi</h2>
                <p class="text-muted">Masukkan ID Donasi Anda untuk melihat status dan detail pembayaran.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donasi.search') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12">
                    <label for="donation_uuid" class="form-label fw-semibold">ID Donasi</label>
                    <input type="text" name="donation_uuid" id="donation_uuid"
                           class="form-control form-control-lg" placeholder="Contoh: 123e4567-e89b-12d3-a456-426614174000"
                           value="{{ old('donation_uuid') }}" required>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-orange btn-lg px-5">Cari Donasi</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .donation-check-section {
        min-height: 72vh;
    }
</style>
@endpush
