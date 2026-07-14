@extends('frontend.layouts.app')

@section('title', 'Program - Lazismu NTB')

@section('content')

{{-- PROGRAM LAZISMU NTB SECTION --}}
<section class="program-page-section py-5">
    <div class="container">
        {{-- Section Title --}}
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: #F7941D;">Program Lazismu NTB</h2>
        </div>

        {{-- Category Tabs --}}
        <div class="d-flex justify-content-center mb-5">
            <div class="category-pill-bar" id="program-filters">
                <a href="javascript:void(0)" class="cat-btn active" data-filter="zakat">Zakat</a>
                <a href="javascript:void(0)" class="cat-btn" data-filter="infaq">Infaq</a>
                <a href="javascript:void(0)" class="cat-btn" data-filter="shadaqah">Shadaqah</a>
                <a href="javascript:void(0)" class="cat-btn" data-filter="kemanusiaan">Kemanusiaan</a>
                <a href="javascript:void(0)" class="cat-btn" data-filter="qurban">Qurban</a>
            </div>
        </div>

        {{-- Program Cards Grid --}}
        <div class="row g-4 justify-content-center" id="program-grid">
            @if(isset($programs) && count($programs) > 0)
                @foreach($programs as $program)
                <div class="col-lg-4 col-md-6 program-item" data-category="{{ strtolower($program->category ?? 'zakat') }}">
                    <div class="prog-card">
                        <a href="{{ route('program.detail', $program->slug) }}">
                            @php
                                $imgSrc = \Illuminate\Support\Str::startsWith($program->image, ['http://', 'https://']) ? $program->image : asset('storage/'.$program->image);
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $program->title }}" class="prog-img">
                        </a>
                        <div class="prog-body">
                            <a href="{{ route('program.detail', $program->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="prog-title">{{ $program->title }}</h5>
                            </a>
                            <span class="prog-badge">{{ $program->category ?? 'Zakat' }}</span>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3 mb-1">
                                <span class="prog-label">Terkumpul</span>
                                <span class="prog-amount">Rp {{ number_format($program->collected ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="progress prog-progress">
                                @php
                                    $target = $program->target_amount ?? 1;
                                    $collected = $program->collected ?? 0;
                                    $percentage = min(($collected / $target) * 100, 100);
                                @endphp
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-1 mb-4">
                                <span class="prog-target-label">Target</span>
                                <span class="prog-target-amount">Rp {{ number_format($program->target_amount ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <a href="{{ url('/donasi?program='.$program->slug) }}" class="btn btn-donasi-full">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div id="empty-program-msg" class="col-12 text-center" style="display: none; padding: 40px 0;">
                    <div style="color: #6c757d; font-size: 1.1rem;">
                        <i class="fas fa-box-open mb-3" style="font-size: 2rem;"></i>
                        <p>Belum ada program untuk kategori ini.</p>
                    </div>
                </div>
            @else
                <div class="col-12 text-center" style="padding: 40px 0;">
                    <div style="color: #6c757d; font-size: 1.1rem;">
                        <i class="fas fa-box-open mb-3" style="font-size: 2rem;"></i>
                        <p>Belum ada program yang tersedia saat ini.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- KONSULTASI BANNER SECTION --}}
<section class="konsultasi-section mb-5 pb-5">
    <div class="container">
        <div class="konsultasi-banner position-relative">
            <div class="row align-items-center">
                <div class="col-md-7 px-4 py-5 ps-md-5 z-index-1 text-center text-md-start">
                    <h3 class="konsultasi-title mb-4">Konsultasi Zakat Bisa Dari Rumah,<br>Hubungi Kami Sekarang!</h3>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-wa">
                        <i class="fab fa-whatsapp me-2"></i> Hubungi Kami
                    </a>
                </div>
                <div class="col-md-5 d-none d-md-flex justify-content-end align-items-end" style="min-height: 250px;">
                    <img src="{{ asset('images/konsultasi.png') }}" alt="Konsultasi Zakat" class="img-fluid" style="max-height: 250px;">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* CATEGORY PILL BAR */
    .category-pill-bar {
        background: #F7941D;
        border-radius: 50px;
        display: inline-flex;
        padding: 8px 12px;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(247, 148, 29, 0.3);
    }
    .cat-btn {
        color: #fff;
        text-decoration: none;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .cat-btn:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
    }
    .cat-btn.active {
        background: rgba(255, 255, 255, 0.4);
        color: #fff;
        border: 2px solid rgba(255, 255, 255, 0.6);
    }

    /* PROGRAM CARDS */
    .prog-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    }
    .prog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: #F7941D;
    }
    .prog-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .prog-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .prog-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 8px;
    }
    .prog-badge {
        display: inline-block;
        background: #F3F4F6;
        color: #4B5563;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 4px;
        font-weight: 600;
        margin-bottom: 16px;
        border: 1px solid #E5E7EB;
        width: fit-content;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .prog-label {
        font-size: 0.85rem;
        color: #6B7280;
        font-weight: 500;
    }
    .prog-target-label {
        font-size: 0.8rem;
        color: #6B7280;
        font-weight: 500;
    }
    .prog-amount {
        font-size: 0.95rem;
        font-weight: 700;
        color: #F7941D;
    }
    .prog-target-amount {
        font-size: 0.85rem;
        font-weight: 600;
        color: #4B5563;
    }
    .prog-progress {
        height: 6px;
        border-radius: 10px;
        background-color: #F3F4F6;
        overflow: visible;
    }
    .prog-progress .progress-bar {
        background: linear-gradient(90deg, #F7941D, #F7C948);
        border-radius: 10px;
        position: relative;
    }
    .prog-progress .progress-bar::after {
        content: '';
        position: absolute;
        right: -3px;
        top: -2px;
        width: 10px;
        height: 10px;
        background: #fff;
        border: 2px solid #F7941D;
        border-radius: 50%;
    }
    .btn-donasi-full {
        background: #F7941D;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px;
        text-align: center;
        width: 100%;
        margin-top: auto;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.95rem;
    }
    .btn-donasi-full:hover {
        background: #E5820A;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(247, 148, 29, 0.3);
    }

    /* KONSULTASI BANNER */
    .konsultasi-banner {
        background: linear-gradient(135deg, #EAF7EC 0%, #F4FBF5 100%);
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #D1E7D3;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .konsultasi-title {
        color: #F7941D;
        font-weight: 800;
        font-size: 1.8rem;
        line-height: 1.4;
    }
    .btn-wa {
        background-color: #00C853;
        color: #fff;
        border-radius: 50px;
        padding: 12px 28px;
        font-weight: 600;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 6px 15px rgba(0, 200, 83, 0.3);
    }
    .btn-wa:hover {
        background-color: #00A040;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 200, 83, 0.4);
    }
    .z-index-1 {
        position: relative;
        z-index: 1;
    }
    .illustration-placeholder {
        padding-right: 40px;
        padding-bottom: 20px;
        opacity: 0.8;
    }
    
    @media (max-width: 768px) {
        .konsultasi-title {
            font-size: 1.5rem;
        }
        .category-pill-bar {
            border-radius: 16px;
        }
        .cat-btn {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
</style>
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('#program-filters .cat-btn');
        const programItems = document.querySelectorAll('.program-item');
        const emptyState = document.getElementById('empty-program-msg');

        // Check if there is a 'category' or 'tab' query param in the URL
        const urlParams = new URLSearchParams(window.location.search);
        let categoryParam = urlParams.get('category') || urlParams.get('tab');
        
        if (categoryParam) {
            categoryParam = categoryParam.toLowerCase();
            const targetTab = document.querySelector(`#program-filters .cat-btn[data-filter="${categoryParam}"]`);
            if (targetTab) {
                // Remove active class from all tabs
                filterBtns.forEach(b => b.classList.remove('active'));
                
                // Add active class to target tab
                targetTab.classList.add('active');
                
                // Filter the programs
                filterPrograms(categoryParam);
            } else {
                // Fallback to active tab
                const activeTab = document.querySelector('.cat-btn.active');
                if (activeTab) {
                    filterPrograms(activeTab.getAttribute('data-filter'));
                }
            }
        } else {
            // Initial filter on page load based on active tab
            const activeTab = document.querySelector('.cat-btn.active');
            if (activeTab) {
                filterPrograms(activeTab.getAttribute('data-filter'));
            }
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                filterBtns.forEach(b => b.classList.remove('active'));
                
                // Add active class to the clicked tab
                this.classList.add('active');

                // Get category from clicked tab
                const filterValue = this.getAttribute('data-filter');
                filterPrograms(filterValue);
            });
        });

        function filterPrograms(category) {
            let hasVisible = false;
            programItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (itemCategory === category) {
                    item.style.display = '';
                    hasVisible = true;
                } else {
                    item.style.display = 'none';
                }
            });

            if (emptyState) {
                emptyState.style.display = hasVisible ? 'none' : 'block';
            }
        }
    });
</script>
@endpush
