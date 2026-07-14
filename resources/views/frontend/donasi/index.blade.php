{{-- ============================================
    HALAMAN DONASI SEKARANG - Lazismu NTB
============================================= --}}
@extends('frontend.layouts.app')

@section('title', 'Donasi Sekarang - Lazismu NTB')

@push('styles')
<style>
    /* ========================================
       DONASI PAGE STYLES
    ======================================== */

    /* Hero Banner */
    .donasi-hero {
        background: linear-gradient(135deg, #A8D5A2 0%, #8BC68A 40%, #6DB86B 100%);
        padding: 50px 0 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .donasi-hero::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .donasi-hero::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .donasi-hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin: 0;
        text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .donasi-hero h1 .emoji-icon {
        font-style: normal;
        margin-left: 4px;
    }

    /* Main Container */
    .donasi-container {
        max-width: 960px;
        margin: -20px auto 60px;
        padding: 0 20px;
        position: relative;
        z-index: 5;
    }

    .donasi-card-main {
        background: #fff;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        padding: 40px 36px;
        animation: fadeInUp 0.6s ease forwards;
    }

    /* Section Headers */
    .donasi-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .donasi-section-title .icon-circle {
        width: 32px;
        height: 32px;
        background: var(--orange-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .donasi-section-title h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--orange-primary);
        margin: 0;
    }

    .donasi-section-subtitle {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-bottom: 20px;
        padding-left: 42px;
    }

    /* Form Styles */
    .donasi-form-group {
        margin-bottom: 18px;
    }

    .donasi-form-group label {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
        display: block;
    }

    .donasi-form-group label .required {
        color: #E53E3E;
    }

    .donasi-form-group input,
    .donasi-form-group textarea,
    .donasi-form-group select {
        width: 100%;
        border: 2px solid #E5E7EB;
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        color: var(--text-dark);
        transition: all 0.3s ease;
        background: #fff;
        appearance: none;
        -webkit-appearance: none;
    }

    .donasi-form-group input:focus,
    .donasi-form-group textarea:focus,
    .donasi-form-group select:focus {
        outline: none;
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 3px rgba(247, 148, 29, 0.12);
    }

    .donasi-form-group input::placeholder,
    .donasi-form-group textarea::placeholder {
        color: #C4C4C4;
    }

    .donasi-form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* Select Wrapper */
    .select-wrapper {
        position: relative;
    }

    .select-wrapper::after {
        content: '\f078';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--orange-primary);
        pointer-events: none;
        font-size: 0.8rem;
    }

    .select-wrapper select {
        padding-right: 40px;
        cursor: pointer;
    }

    /* Checkbox Styles */
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: -8px;
        margin-bottom: 18px;
        padding: 10px 14px;
        background: #FFF8F0;
        border: 1.5px dashed #F7941D;
        border-radius: 8px;
    }

    .checkbox-group input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--orange-primary);
        cursor: pointer;
        flex-shrink: 0;
    }

    .checkbox-group label {
        font-size: 0.88rem;
        font-weight: 500;
        color: #6B4C1E;
        margin: 0;
        cursor: pointer;
        line-height: 1.4;
    }

    /* Amount Buttons */
    .amount-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 20px;
    }

    .amount-btn {
        padding: 12px 8px;
        border: 2px solid #E5E7EB;
        border-radius: var(--radius-sm);
        background: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .amount-btn:hover {
        border-color: var(--orange-primary);
        color: var(--orange-primary);
        background: var(--orange-light);
    }

    .amount-btn.active {
        border-color: var(--orange-primary);
        background: var(--orange-primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(247, 148, 29, 0.3);
    }

    /* Custom Amount */
    .custom-amount-group {
        margin-bottom: 20px;
    }

    .custom-amount-group label {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
        display: block;
    }

    .custom-amount-group input {
        width: 100%;
        border: 2px solid #E5E7EB;
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        color: var(--text-dark);
        transition: all 0.3s ease;
        background: #fff;
    }

    .custom-amount-group input:focus {
        outline: none;
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 3px rgba(247, 148, 29, 0.12);
    }

    .custom-amount-group input::placeholder {
        color: #C4C4C4;
    }

    /* Payment Methods */
    .payment-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .payment-btn {
        padding: 12px 8px;
        border: 2px solid #E5E7EB;
        border-radius: var(--radius-sm);
        background: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-dark);
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .payment-btn:hover {
        border-color: var(--orange-primary);
        color: var(--orange-primary);
        background: var(--orange-light);
    }

    .payment-btn.active {
        border-color: var(--orange-primary);
        background: var(--orange-primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(247, 148, 29, 0.3);
    }

    /* Divider */
    .donasi-divider {
        border: none;
        border-top: 2px dashed #E5E7EB;
        margin: 30px 0;
    }

    /* Summary Section */
    .rincian-card {
        border: 2px solid var(--orange-primary);
        border-radius: var(--radius-md);
        padding: 24px 28px;
        background: #fff;
        margin-bottom: 24px;
    }

    .rincian-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }

    .rincian-row .rincian-label {
        font-size: 0.92rem;
        color: var(--text-gray);
        font-weight: 500;
    }

    .rincian-row .rincian-value {
        font-size: 0.92rem;
        color: var(--text-dark);
        font-weight: 600;
    }

    .rincian-row.total {
        border-top: 1.5px solid #F3F4F6;
        margin-top: 6px;
        padding-top: 14px;
    }

    .rincian-row.total .rincian-label {
        font-size: 1rem;
        font-weight: 700;
        color: var(--orange-primary);
    }

    .rincian-row.total .rincian-value {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--orange-primary);
    }

    /* Submit Button */
    .btn-donasi-submit {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #F7941D 0%, #F5A623 50%, #F7C948 100%);
        color: #fff;
        border: none;
        border-radius: var(--radius-xl);
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(247, 148, 29, 0.35);
        letter-spacing: 0.5px;
    }

    .btn-donasi-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(247, 148, 29, 0.5);
    }

    .btn-donasi-submit:active {
        transform: translateY(0);
    }

    /* Layout Grid */
    .donasi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 36px;
    }

    .donasi-left,
    .donasi-right {
        display: flex;
        flex-direction: column;
    }

    /* Program Selected Card */
    .program-selected-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: 16px;
        border-left: 5px solid var(--orange-primary);
        animation: fadeInUp 0.5s ease forwards;
    }
    .program-selected-img {
        width: 100px;
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 20px;
    }
    .badge-terpilih {
        display: block;
        font-size: 0.85rem;
        color: #6B7280;
        font-weight: 500;
        margin-bottom: 4px;
    }
    .title-terpilih {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1F2937;
        margin: 0;
    }

    /* Doa section transition */
    .doa-section {
        overflow: hidden;
        transition: max-height 0.4s ease, opacity 0.4s ease;
        max-height: 0;
        opacity: 0;
    }

    .doa-section.visible {
        max-height: 300px;
        opacity: 1;
    }

    /* User logged-in info badge */
    .user-autofill-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ECFDF5;
        border: 1.5px solid #6EE7B7;
        color: #065F46;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 14px;
    }

    .user-autofill-badge i {
        font-size: 0.75rem;
        color: #10B981;
    }

    @media (max-width: 767px) {
        .donasi-hero h1 {
            font-size: 1.5rem;
        }

        .donasi-card-main {
            padding: 24px 18px;
        }

        .donasi-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .amount-grid,
        .payment-grid {
            grid-template-columns: 1fr 1fr;
        }

        .rincian-card {
            padding: 18px 16px;
        }

        .program-selected-img {
            width: 80px;
            height: 60px;
            margin-right: 15px;
        }
        .title-terpilih {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 480px) {
        .donasi-hero {
            padding: 36px 0 30px;
        }

        .donasi-hero h1 {
            font-size: 1.25rem;
        }

        .donasi-section-title h3 {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')

    {{-- Hero Banner --}}
    <section class="donasi-hero" id="donasi-hero">
        <div class="container">
            <h1>Donasi Sekarang<span class="emoji-icon">🤲</span></h1>
        </div>
    </section>

    {{-- Main Form --}}
    <div class="donasi-container">

        {{-- Program Selected Card --}}
        @if(request('program'))
            @php
                $selectedProgramFromUrl = \App\Models\Program::where('slug', request('program'))->first();
                $pName = $selectedProgramFromUrl ? $selectedProgramFromUrl->title : ucwords(str_replace('-', ' ', request('program')));
                // Mapping sederhana untuk demo
                $imgMap = [
                    'zakat-maal' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=600&q=80',
                    'zakat-fitrah' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=600&q=80',
                    'zakat-profesi' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&q=80'
                ];
               if ($selectedProgramFromUrl && $selectedProgramFromUrl->image) {

                    if (filter_var($selectedProgramFromUrl->image, FILTER_VALIDATE_URL)) {
                        // Jika image berupa URL
                        $pImg = $selectedProgramFromUrl->image;
                    } else {
                        // Jika image berupa file lokal di storage
                        $pImg = asset('storage/' . $selectedProgramFromUrl->image);
                    }
                    } else {

                        $pImg = $imgMap[request('program')]
                            ?? 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80';
                    }
            @endphp
            <div class="program-selected-card mb-4">
                <div class="d-flex align-items-center">
                    <img src="{{ $pImg }}" alt="{{ $pName }}" class="program-selected-img">
                    <div class="program-selected-info">
                        <span class="badge-terpilih">Anda akan berdonasi untuk program:</span>
                        <h3 class="title-terpilih">{{ $pName }}</h3>
                    </div>
                </div>
            </div>
        @endif

        <div class="donasi-card-main">
            <form id="form-donasi" method="POST" action="#">
                @csrf

                <div class="donasi-grid">

                    {{-- ========== LEFT COLUMN ========== --}}
                    <div class="donasi-left">

                        {{-- Section: Pilih Program (Opsional - hanya jika belum dipilih dari URL) --}}
                        @if(!request('program'))
                        <div class="donasi-section-title">
                            <span class="icon-circle"><i class="fas fa-list"></i></span>
                            <h3>Pilih Program Donasi (Opsional)</h3>
                        </div>
                        <p class="donasi-section-subtitle">
                            Biarkan kosong untuk donasi umum ke program aktif kami.
                        </p>

                        <div class="donasi-form-group">
                            <label for="select-program">Program :</label>
                            <div class="select-wrapper">
                                <select id="select-program" name="program_select">
                                    <option value="">Donasi Umum (ke program aktif)</option>
                                    @foreach(\App\Models\Program::where('is_active', true)->get() as $program)
                                    <option value="{{ $program->slug }}" data-title="{{ $program->title }}">{{ $program->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        {{-- Section: Data Donatur --}}
                        <div class="donasi-section-title">
                            <span class="icon-circle"><i class="fas fa-user"></i></span>
                            <h3>Lengkapi Data Anda!</h3>
                        </div>
                        <p class="donasi-section-subtitle">
                            Pastikan data yang Anda masukkan benar dan lengkap untuk memudahkan proses donasi.
                        </p>

                        {{-- Auto-fill Badge jika user sudah login --}}
                        @auth
                        <div class="user-autofill-badge mb-2">
                            <i class="fas fa-check-circle"></i>
                            Data diisi otomatis dari akun Anda &mdash; Anda tetap bisa mengubahnya
                        </div>
                        @endauth

                        {{-- Nama --}}
                        <div class="donasi-form-group">
                            <label for="input-nama">Nama<span class="required">*</span> :</label>
                            <input type="text" id="input-nama" name="nama"
                                placeholder="Nama lengkap"
                                value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                required>
                        </div>

                        {{-- Checkbox Sembunyikan Nama --}}
                        <div class="checkbox-group">
                            <input type="checkbox" id="cb-hamba-allah" name="hamba_allah" value="1">
                            <label for="cb-hamba-allah">Sembunyikan nama saya &amp; tampilkan sebagai <strong>Hamba Allah</strong></label>
                        </div>

                        {{-- Email --}}
                        <div class="donasi-form-group">
                            <label for="input-email">Email<span class="required">*</span> :</label>
                            <input type="email" id="input-email" name="email"
                                placeholder="Email"
                                value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                required>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="donasi-form-group">
                            <label for="input-telepon">Nomor WhatsApp<span class="required">*</span> :</label>
                            <input type="tel" id="input-telepon" name="telepon"
                                placeholder="Nomor WhatsApp"
                                value="{{ auth()->check() ? (auth()->user()->phone ?? '') : '' }}"
                                required>
                        </div>

                        {{-- Doa / Dukungan - tersembunyi sampai data diri & nominal diisi --}}
                        <div class="doa-section" id="doa-section">
                            <div class="donasi-form-group">
                                <label for="input-doa">Tulis Doa atau Dukungan untuk Lazismu NTB (Opsional)</label>
                                <textarea id="input-doa" name="doa" placeholder="Masukkan Doa atau Dukungan Anda" rows="4"></textarea>
                            </div>
                        </div>

                    </div>

                    {{-- ========== RIGHT COLUMN ========== --}}
                    <div class="donasi-right">

                        {{-- Section: Pilih Jumlah Donasi --}}
                        <div class="donasi-section-title">
                            <span class="icon-circle"><i class="fas fa-hand-holding-usd"></i></span>
                            <h3>Pilih Jumlah Donasi Anda!</h3>
                        </div>
                        <div style="margin-bottom: 20px;"></div>

                        <div class="amount-grid" id="amount-grid">
                            <button type="button" class="amount-btn active" data-amount="10000" id="btn-amount-10000">Rp 10.000</button>
                            <button type="button" class="amount-btn" data-amount="25000" id="btn-amount-25000">Rp 25.000</button>
                            <button type="button" class="amount-btn" data-amount="100000" id="btn-amount-100000">Rp 100.000</button>
                            <button type="button" class="amount-btn" data-amount="200000" id="btn-amount-200000">Rp 200.000</button>
                            <button type="button" class="amount-btn" data-amount="50000" id="btn-amount-50000">Rp 50.000</button>
                            <button type="button" class="amount-btn" data-amount="custom" id="btn-amount-custom">Jumlah Lainnya</button>
                        </div>

                        {{-- Custom Amount Input --}}
                        <div class="custom-amount-group" id="custom-amount-wrapper" style="display: none;">
                            <label for="input-custom-amount">Jumlah Lainnya :</label>
                            <input type="number" id="input-custom-amount" name="custom_amount" placeholder="Rp Masukan jumlah donasi" min="1000">
                        </div>

                        {{-- Section: Pilih Metode Pembayaran --}}
                        <div class="donasi-section-title" style="margin-top: 10px;">
                            <span class="icon-circle"><i class="fas fa-credit-card"></i></span>
                            <h3>Pilih Metode Pembayaran</h3>
                        </div>
                        <div style="margin-bottom: 16px;"></div>

                        <div class="payment-grid" id="payment-grid">
                            <button type="button" class="payment-btn" data-method="qris" id="btn-pay-qris">QRIS</button>
                            <button type="button" class="payment-btn" data-method="va_bni" id="btn-pay-bni">VA BNI</button>
                            <button type="button" class="payment-btn" data-method="va_bca" id="btn-pay-ntb">VA BCA</button>
                            <button type="button" class="payment-btn" data-method="va_bsi" id="btn-pay-bsi">VA BSI</button>
                            <button type="button" class="payment-btn" data-method="va_bri" id="btn-pay-bri">VA BRI</button>
                            <button type="button" class="payment-btn" data-method="transfer_manual" id="btn-pay-transfer">Transfer Manual</button>
                        </div>

                    </div>

                </div>

                {{-- Divider --}}
                <hr class="donasi-divider">

                {{-- Section: Rincian Donasi --}}
                <div class="donasi-section-title">
                    <span class="icon-circle"><i class="fas fa-receipt"></i></span>
                    <h3>Rincian Donasi Anda!</h3>
                </div>
                <div style="margin-bottom: 16px;"></div>

                <div class="rincian-card" id="rincian-card">
                    <div class="rincian-row" id="row-program" style="display: none;">
                        <span class="rincian-label">Program :</span>
                        <span class="rincian-value" id="display-program">-</span>
                    </div>
                    <div class="rincian-row">
                        <span class="rincian-label">Jumlah Donasi :</span>
                        <span class="rincian-value" id="display-jumlah">Rp 10.000</span>
                    </div>
                    <div class="rincian-row">
                        <span class="rincian-label">Biaya Admin :</span>
                        <span class="rincian-value" id="display-admin">Rp 0</span>
                    </div>
                    <div class="rincian-row total">
                        <span class="rincian-label">Total Donasi :</span>
                        <span class="rincian-value" id="display-total">Rp 10.000</span>
                    </div>
                </div>

                {{-- Hidden Inputs --}}
                <input type="hidden" name="program_slug" id="hidden-program-slug" value="{{ request('program') }}">
                <input type="hidden" name="amount" id="hidden-amount" value="10000">
                <input type="hidden" name="payment_method" id="hidden-payment-method" value="">

                {{-- Submit --}}
                <button type="submit" class="btn-donasi-submit" id="btn-submit-donasi">
                    Donasi Sekarang
                </button>

            </form>
        </div>
    </div>

@endsection

@push('scripts')
{{-- Tidak ada script Midtrans Snap --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===== STATE =====
    let selectedAmount = 10000;
    let selectedPayment = '';

    // ===== ELEMENTS =====
    const amountBtns = document.querySelectorAll('.amount-btn');
    const paymentBtns = document.querySelectorAll('.payment-btn');
    const customWrapper = document.getElementById('custom-amount-wrapper');
    const customInput = document.getElementById('input-custom-amount');
    const hiddenAmount = document.getElementById('hidden-amount');
    const hiddenPayment = document.getElementById('hidden-payment-method');
    const hiddenProgramSlug = document.getElementById('hidden-program-slug');
    const selectProgram = document.getElementById('select-program');
    const displayJumlah = document.getElementById('display-jumlah');
    const displayAdmin = document.getElementById('display-admin');
    const displayTotal = document.getElementById('display-total');
    const displayProgram = document.getElementById('display-program');
    const rowProgram = document.getElementById('row-program');
    const doaSection = document.getElementById('doa-section');
    const inputNama = document.getElementById('input-nama');
    const inputEmail = document.getElementById('input-email');
    const inputTelepon = document.getElementById('input-telepon');
    const cbHambaAllah = document.getElementById('cb-hamba-allah');

    // ===== FORMAT CURRENCY =====
    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    // ===== UPDATE SUMMARY =====
    // Fee Tripay: QRIS 0.5%, VA BRI Rp 1.500, VA BNI Rp 2.500, VA BCA Rp 3.500, VA BSI Rp 2.500
    function updateSummary() {
        let adminFee = 0;

        if (selectedPayment === 'qris') {
            adminFee = Math.ceil(selectedAmount * 0.005); // Tripay QRIS 0.5%
        } else if (selectedPayment === 'va_bri') {
            adminFee = 1500;
        } else if (selectedPayment === 'va_bni' || selectedPayment === 'va_bsi') {
            adminFee = 2500;
        } else if (selectedPayment === 'va_bca') {
            adminFee = 3500;
        }

        const total = selectedAmount + adminFee;

        displayJumlah.textContent = formatRupiah(selectedAmount);
        displayAdmin.textContent = formatRupiah(adminFee);
        displayTotal.textContent = formatRupiah(total);

        hiddenAmount.value = selectedAmount;

        // Cek apakah doa section harus ditampilkan
        checkDoaVisibility();
    }

    // ===== CHECK DOA SECTION VISIBILITY =====
    // Tampilkan doa section hanya jika data diri & nominal sudah diisi
    function checkDoaVisibility() {
        const namaFilled = inputNama && inputNama.value.trim().length > 0;
        const emailFilled = inputEmail && inputEmail.value.trim().length > 0;
        const teleponFilled = inputTelepon && inputTelepon.value.trim().length > 0;
        const amountFilled = selectedAmount >= 1000;

        if (namaFilled && emailFilled && teleponFilled && amountFilled) {
            doaSection.classList.add('visible');
        } else {
            doaSection.classList.remove('visible');
        }
    }

    // ===== LISTEN TO DATA DIRI INPUTS =====
    if (inputNama) inputNama.addEventListener('input', checkDoaVisibility);
    if (inputEmail) inputEmail.addEventListener('input', checkDoaVisibility);
    if (inputTelepon) inputTelepon.addEventListener('input', checkDoaVisibility);

    // ===== CHECKBOX HAMBA ALLAH =====
    if (cbHambaAllah && inputNama) {
        cbHambaAllah.addEventListener('change', function () {
            if (this.checked) {
                inputNama.dataset.originalValue = inputNama.value;
                inputNama.value = 'Hamba Allah';
                inputNama.readOnly = true;
                inputNama.style.color = '#9CA3AF';
                inputNama.style.fontStyle = 'italic';
            } else {
                inputNama.value = inputNama.dataset.originalValue || '';
                inputNama.readOnly = false;
                inputNama.style.color = '';
                inputNama.style.fontStyle = '';
            }
            checkDoaVisibility();
        });
    }

    // ===== UPDATE PROGRAM IN SUMMARY =====
    function updateProgramInSummary(slug, title) {
        if (slug && title) {
            displayProgram.textContent = title;
            rowProgram.style.display = 'flex';
        } else if (!slug) {
            // Cek apakah ada program dari URL
            @if(request('program'))
            displayProgram.textContent = '{{ $pName ?? "" }}';
            rowProgram.style.display = 'flex';
            @else
            rowProgram.style.display = 'none';
            @endif
        }
    }

    // Set program dari URL jika ada
    @if(request('program'))
    updateProgramInSummary('{{ request("program") }}', '{{ $pName ?? "" }}');
    @endif

    // ===== AMOUNT BUTTONS =====
    function bindAmountButton(btn) {
        const selectAmount = function(event) {
            event.preventDefault();
            amountBtns.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');

            const amount = btn.dataset.amount || btn.getAttribute('data-amount');

            if (amount === 'custom') {
                customWrapper.style.display = 'block';
                customInput.focus();
                const val = parseInt(customInput.value) || 0;
                selectedAmount = val;
            } else {
                customWrapper.style.display = 'none';
                customInput.value = '';
                selectedAmount = parseInt(amount);
            }

            updateSummary();
        };

        btn.addEventListener('click', selectAmount);
        btn.addEventListener('touchstart', selectAmount);
    }

    amountBtns.forEach(bindAmountButton);

    // ===== CUSTOM AMOUNT INPUT =====
    customInput.addEventListener('input', function() {
        const val = parseInt(this.value) || 0;
        selectedAmount = val;
        updateSummary();
    });

    // ===== PAYMENT BUTTONS =====
    if (paymentBtns.length === 0) {
        console.warn('Tidak ada tombol metode pembayaran yang ditemukan.');
    }

    function bindPaymentButton(btn) {
        const selectPayment = function(event) {
            event.preventDefault();
            paymentBtns.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');

            selectedPayment = btn.dataset.method || btn.getAttribute('data-method');
            hiddenPayment.value = selectedPayment;
            updateSummary(); // Re-calculate when payment method changes
        };

        btn.addEventListener('click', selectPayment);
        btn.addEventListener('touchstart', selectPayment);
    }

    paymentBtns.forEach(bindPaymentButton);

    // ===== PROGRAM SELECT =====
    if (selectProgram) {
        selectProgram.addEventListener('change', function() {
            hiddenProgramSlug.value = this.value;
            const selectedOption = this.options[this.selectedIndex];
            const title = selectedOption.getAttribute('data-title') || '';
            updateProgramInSummary(this.value, title);
        });
    }

    // ===== FORM VALIDATION & SUBMIT =====
    document.getElementById('form-donasi').addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate amount
        if (selectedAmount < 1000) {
            alert('Minimal donasi adalah Rp 1.000');
            return;
        }

        // Validate payment method
        if (!selectedPayment) {
            alert('Silakan pilih metode pembayaran');
            return;
        }

        // Validate required fields
        const namaValue = cbHambaAllah && cbHambaAllah.checked
            ? (inputNama.dataset.originalValue || inputNama.value).trim()
            : inputNama.value.trim();
        const displayName = cbHambaAllah && cbHambaAllah.checked ? 'Hamba Allah' : namaValue;
        const email = inputEmail.value.trim();
        const telepon = inputTelepon.value.trim();
        const programSlug = hiddenProgramSlug.value.trim(); // Optional - bisa kosong
        const doa = document.getElementById('input-doa').value.trim();
        const token = document.querySelector('input[name="_token"]').value;
        const isHambaAllah = cbHambaAllah && cbHambaAllah.checked ? 1 : 0;

        if (!namaValue || !email || !telepon) {
            alert('Silakan lengkapi data Anda (Nama, Email, dan Nomor Telepon)');
            return;
        }

        // Disable button & show spinner
        const submitBtn = document.getElementById('btn-submit-donasi');
        const originalBtnText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Memproses...';

        const formData = {
            nama: displayName,
            email: email,
            telepon: telepon,
            amount: selectedAmount,
            payment_method: selectedPayment,
            program_slug: programSlug,
            doa: doa,
            hamba_allah: isHambaAllah
        };

        fetch('{{ route("donasi.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(res => {
            if (res.status !== 200) {
                throw new Error(res.body.message || 'Terjadi kesalahan sistem.');
            }
            
            const data = res.body;
            if (data.status === 'manual') {
                // Redirect ke halaman instruksi transfer manual
                window.location.href = data.redirect_url;
            } else if (data.status === 'tripay') {
                // Redirect ke halaman pembayaran Tripay
                window.location.href = data.payment_url;
            }
        })
        .catch(err => {
            console.error(err);
            alert(err.message || 'Gagal memproses donasi, silakan coba lagi.');
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        });
    });

    // ===== CONTINUE PAYMENT BUTTON =====
    // Initialize
    updateSummary();

    // Cek visibility doa saat pertama load (jika user sudah login & data sudah terisi)
    checkDoaVisibility();

});
</script>
@endpush
