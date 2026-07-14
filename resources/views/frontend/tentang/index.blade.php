@extends('frontend.layouts.app')

@section('title', 'Tentang Kami - Lazismu NTB')

@section('content')

{{-- ============================================
    PAGE HEADER / HERO
============================================= --}}
<section class="page-header" style="background: linear-gradient(135deg, var(--orange-primary) 0%, var(--orange-dark) 100%); padding: 100px 0 60px; position: relative; overflow: hidden;">
    <div class="container text-center position-relative" style="z-index: 2;">
        <h1 class="text-white mb-3" style="font-size: 3rem; font-weight: 800;">Tentang <span style="color: #FFE082;">Kami</span></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white opacity-75">Beranda</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Tentang</li>
            </ol>
        </nav>
    </div>
    {{-- Abstract Shapes --}}
    <div class="position-absolute" style="top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
    <div class="position-absolute" style="bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 30px; transform: rotate(15deg);"></div>
</section>

{{-- ============================================
    INTRODUCTION SECTION
============================================= --}}
<section class="intro-section py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="pe-lg-4">
                    <span class="text-uppercase fw-bold text-primary mb-2 d-block" style="letter-spacing: 2px; color: var(--orange-primary) !important;">Profil Lembaga</span>
                    <h2 class="mb-4" style="font-size: 2.2rem;">Lembaga Amil Zakat Nasional <span style="color: var(--orange-primary);">Lazismu NTB</span></h2>
                    <p class="text-muted mb-4" style="line-height: 1.8; text-align: justify;">
                        LAZISMU adalah lembaga zakat tingkat nasional yang berkhidmat dalam pemberdayaan masyarakat melalui pendayagunaan secara produktif dana zakat, infaq, shadaqah dan dana kedermawanan lainnya baik dari perseorangan, lembaga, perusahaan dan instansi lainnya.
                    </p>
                    <p class="text-muted mb-4" style="line-height: 1.8; text-align: justify;">
                        Didirikan oleh Pimpinan Pusat Muhammadiyah pada tahun 2002, selanjutnya dikukuhkan oleh Menteri Agama Republik Indonesia sebagai Lembaga Amil Zakat Nasional melalui SK No. 457 Tahun 2002. Dengan hadirnya LAZISMU, diharapkan dapat mengoptimalkan potensi zakat nasional yang sangat besar menjadi kekuatan nyata dalam pembangunan umat.
                    </p>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="p-3 bg-light rounded-circle text-primary" style="color: var(--orange-primary) !important;">
                            <i class="fas fa-award fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">Terakreditasi A</h6>
                            <p class="small text-muted mb-0">Audit Kepatuhan Syariah & Audit Keuangan WTP</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex flex-column gap-3">

                    {{-- Logo Card --}}
                    <div class="rounded-4 shadow-lg overflow-hidden d-flex align-items-center justify-content-center"
                        style="background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%); border: 2px solid #F7941D22; min-height: 260px; padding: 40px;">
                        <img src="{{ asset('images/lazismu.png') }}"
                            alt="Logo Lazismu NTB"
                            class="img-fluid"
                            style="max-height: 180px; object-fit: contain; filter: drop-shadow(0 4px 16px rgba(247,148,29,0.18));">
                    </div>

                    {{-- Stat Badge --}}
                    <div class="d-flex align-items-center gap-3 bg-white rounded-4 shadow-sm px-4 py-3"
                        style="border-left: 5px solid var(--orange-primary);">
                        <div>
                            <h3 class="fw-bold mb-0" style="color: var(--orange-primary); font-size: 2rem;">20+</h3>
                        </div>
                        <div>
                            <p class="mb-0 fw-semibold" style="color: #374151; font-size: 0.95rem;">Tahun melayani dan memberdayakan masyarakat NTB</p>
                            <p class="mb-0 small text-muted">Berdiri sejak 2002 &mdash; Lazismu NTB</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    VISION & MISSION SECTION
============================================= --}}
<section class="visimisi-section py-5" style="background-color: var(--orange-light);">
    <div class="container py-4">
        <div class="row g-4">
            {{-- Visi --}}
            <div class="col-md-6">
                <div class="h-100 p-5 bg-white rounded-4 shadow-sm border-start border-5 border-primary" style="border-color: var(--orange-primary) !important;">
                    <div class="mb-3">
                        <i class="fas fa-eye fa-3x" style="color: var(--orange-primary);"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Visi</h3>
                    <p class="text-muted mb-0" style="font-size: 1.1rem; line-height: 1.8;">
                        "Menjadi Lembaga Amil Zakat Nasional yang Terpercaya, Profesional, dan Mandiri dalam memberdayakan masyarakat."
                    </p>
                </div>
            </div>
            {{-- Misi --}}
            <div class="col-md-6">
                <div class="h-100 p-5 bg-white rounded-4 shadow-sm border-start border-5 border-primary" style="border-color: var(--orange-primary) !important;">
                    <div class="mb-3">
                        <i class="fas fa-bullseye fa-3x" style="color: var(--orange-primary);"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Misi</h3>
                    <ul class="list-unstyled text-muted" style="line-height: 2;">
                        <li><i class="fas fa-check-circle me-2" style="color: var(--orange-primary);"></i> Mengoptimalkan penghimpunan dana ZISKA.</li>
                        <li><i class="fas fa-check-circle me-2" style="color: var(--orange-primary);"></i> Menyelenggarakan manajemen yang profesional dan transparan.</li>
                        <li><i class="fas fa-check-circle me-2" style="color: var(--orange-primary);"></i> Mendayagunakan dana ZISKA untuk pemberdayaan umat.</li>
                        <li><i class="fas fa-check-circle me-2" style="color: var(--orange-primary);"></i> Memperluas jaringan dan kemitraan strategis.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    PILLARS SECTION
============================================= --}}
<section class="pilar-section py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">6 Pilar Program <span style="color: var(--orange-primary);">Lazismu</span></h2>
            <p class="text-muted">Fokus utama pendayagunaan dana untuk kemaslahatan umat</p>
        </div>
        <div class="row g-4">
            @php
                $pilars = [
                    ['icon' => 'fa-graduation-cap', 'title' => 'Pendidikan', 'desc' => 'Dukungan akses pendidikan bagi masyarakat kurang mampu.'],
                    ['icon' => 'fa-heartbeat', 'title' => 'Kesehatan', 'desc' => 'Layanan kesehatan dan bantuan biaya medis untuk dhuafa.'],
                    ['icon' => 'fa-briefcase', 'title' => 'Ekonomi', 'desc' => 'Pemberdayaan ekonomi melalui modal usaha dan pelatihan.'],
                    ['icon' => 'fa-hand-holding-heart', 'title' => 'Sosial Dakwah', 'desc' => 'Pembinaan masyarakat dan penguatan nilai-nilai keislaman.'],
                    ['icon' => 'fa-leaf', 'title' => 'Lingkungan', 'desc' => 'Pelestarian alam dan sanitasi lingkungan bagi warga.'],
                    ['icon' => 'fa-first-aid', 'title' => 'Kemanusiaan', 'desc' => 'Respon cepat bencana dan bantuan kemanusiaan darurat.']
                ];
            @endphp
            @foreach($pilars as $pilar)
            <div class="col-md-4 col-sm-6">
                <div class="p-4 rounded-4 text-center h-100 transition-hover shadow-sm" style="background: #fdfdfd; border: 1px solid #eee;">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width: 70px; height: 70px; background: var(--orange-light); color: var(--orange-primary);">
                        <i class="fas {{ $pilar['icon'] }} fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">{{ $pilar['title'] }}</h5>
                    <p class="small text-muted mb-0">{{ $pilar['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================
    LEGAL SECTION
============================================= --}}
<section class="legal-section py-5" style="background-color: #f8f9fa;">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="p-5 bg-white rounded-4 shadow-md">
                    <h3 class="fw-bold mb-4">Legalitas & Transparansi</h3>
                    <p class="text-muted mb-5">
                        Kami mengelola amanah donatur secara profesional dengan landasan hukum yang kuat dan transparansi keuangan yang diaudit secara rutin.
                    </p>
                    <div class="row g-4 text-start">
                        <div class="col-md-6">
                            <div class="d-flex gap-3 mb-4">
                                <i class="fas fa-file-contract text-primary mt-1" style="color: var(--orange-primary) !important;"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">SK Menteri Agama RI</h6>
                                    <p class="small text-muted mb-0">Nomor 90 Tahun 2022</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-3 mb-4">
                                <i class="fas fa-file-invoice-dollar text-primary mt-1" style="color: var(--orange-primary) !important;"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Opini Audit Keuangan</h6>
                                    <p class="small text-muted mb-0">Wajar Tanpa Pengecualian (WTP)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-3">
                                <i class="fas fa-shield-alt text-primary mt-1" style="color: var(--orange-primary) !important;"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Kepatuhan Syariah</h6>
                                    <p class="small text-muted mb-0">Nilai Akreditasi Syariah "A"</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-3">
                                <i class="fas fa-landmark text-primary mt-1" style="color: var(--orange-primary) !important;"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Badan Hukum</h6>
                                    <p class="small text-muted mb-0">Persyarikatan Muhammadiyah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    CTA SECTION
============================================= --}}
<section class="cta-section py-5 bg-white">
    <div class="container py-5">
        <div class="p-5 rounded-5 text-center text-white" style="background: var(--orange-gradient); box-shadow: 0 20px 40px rgba(247, 148, 29, 0.3);">
            <h2 class="fw-bold mb-3" style="font-size: 2.5rem;">Mari Berbagi Kebaikan Bersama Kami</h2>
            <p class="mb-4 opacity-75" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                Setiap donasi yang Anda berikan adalah harapan bagi mereka yang membutuhkan. Mari bersama membangun negeri yang lebih baik.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ url('/program') }}" class="btn btn-light px-5 py-3 rounded-pill fw-bold text-primary shadow-sm" style="color: var(--orange-primary) !important;">Mulai Berdonasi</a>
                <a href="https://wa.me/628123456789" target="_blank" class="btn btn-outline-light px-5 py-3 rounded-pill fw-bold">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .transition-hover {
        transition: all 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md) !important;
        border-color: var(--orange-primary) !important;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }
    .rounded-4 { border-radius: 1.5rem !important; }
    .rounded-5 { border-radius: 2.5rem !important; }
</style>
@endpush
