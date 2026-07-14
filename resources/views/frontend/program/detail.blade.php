@extends('frontend.layouts.app')

@section('title', 'Detail Program - Lazismu NTB')

@section('content')

<section class="program-detail-section py-5">
    <div class="container" style="max-width: 1000px;">
        {{-- Images Row --}}
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                @php
                    $imgSrc = $program->image
                        ? (\Illuminate\Support\Str::startsWith($program->image, ['http://', 'https://']) ? $program->image : asset('storage/'.$program->image))
                        : 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=800&q=80';
                @endphp
                <img src="{{ $imgSrc }}" alt="{{ $program->title }}" class="img-fluid w-100" style="object-fit: cover; border-radius: 12px; max-height: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
            </div>
            <div class="col-md-6">
                {{-- Donation Chart --}}
                <div style="background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 1px solid #eee; height: 100%; display: flex; align-items: center; justify-content: center;">
                    <canvas id="donationChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Info Row --}}
        <div class="row mb-5 align-items-center mt-5">
            <div class="col-md-7">
                <h2 class="fw-bold text-dark mb-3">{{ $program->title }}</h2>
                <div class="d-flex align-items-center gap-5 mt-4">
                    <span style="font-weight: 500; font-size: 1.05rem; color: #4B5563;">Target Dana</span>
                    <h4 class="mb-0 fw-bold" style="color: #F7941D;">Rp {{ number_format($program->target_amount, 0, ',', '.') }}</h4>
                </div>
            </div>
            <div class="col-md-5 text-md-end mt-4 mt-md-0">
                <a href="{{ url('/donasi?program=' . $program->slug) }}" class="btn btn-donasi-large w-100 w-md-auto">Donasi Sekarang</a>
            </div>
        </div>

        {{-- Tabs Row --}}
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav detail-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0)" data-target="keterangan">Keterangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-target="informasi">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-target="donatur">Donatur</a>
                    </li>
                </ul>

                <div class="tab-content" id="detail-tab-content">
                    <div class="tab-pane-content" id="keterangan" style="display: block;">
                        <div style="color: #4B5563; line-height: 1.8; text-align: justify; font-size: 0.95rem;">
                            {!! $program->description ?? 'Tidak ada keterangan untuk program ini.' !!}
                        </div>
                    </div>
                    <div class="tab-pane-content" id="informasi" style="display: none;">
                        <ul style="color: #4B5563; line-height: 1.8; margin-bottom: 1rem; font-size: 0.95rem; padding-left: 20px;">
                            <li><strong>Nama Program:</strong> {{ $program->title }}</li>
                            <li><strong>Kategori:</strong> {{ $program->category ?? 'Umum' }}</li>
                            <li><strong>Status:</strong> {{ $program->is_active ? 'Aktif' : 'Tidak Aktif' }}</li>
                            <li><strong>Target Dana:</strong> Rp {{ number_format($program->target_amount, 0, ',', '.') }}</li>
                            <li><strong>Terkumpul:</strong> Rp {{ number_format($program->collected, 0, ',', '.') }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane-content" id="donatur" style="display: none;">
                        @if(isset($programDonors) && $programDonors->count() > 0)
                            <div class="list-group">
                                @foreach($programDonors as $donor)
                                    <div class="list-group-item list-group-item-action flex-column align-items-start mb-2" style="border-radius: 8px; border: 1px solid #eee;">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 fw-bold" style="color: #F7941D;">
                                                <i class="bi bi-person-circle me-2"></i>
                                                {{ $donor->is_anonymous ? 'Hamba Allah' : $donor->donor_name }}
                                            </h6>
                                            <small class="text-muted">{{ $donor->paid_at ? $donor->paid_at->diffForHumans() : ($donor->created_at ? $donor->created_at->diffForHumans() : '') }}</small>
                                        </div>
                                        @if($donor->doa)
                                            <p class="mb-1 mt-2" style="font-size: 0.9rem; font-style: italic; color: #4B5563;">
                                                "{{ $donor->doa }}"
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Belum ada donatur untuk program ini. Jadilah yang pertama!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .btn-donasi-large {
        background: #F7941D;
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 14px 40px;
        border-radius: 8px;
        transition: all 0.3s ease;
        border: none;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(247, 148, 29, 0.3);
    }
    .btn-donasi-large:hover {
        background: #E5820A;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(247, 148, 29, 0.4);
    }

    .detail-tabs {
        border-bottom: 2px solid #E5E7EB;
        gap: 30px;
    }
    .detail-tabs .nav-item .nav-link {
        color: #111827;
        font-weight: 600;
        font-size: 1.15rem;
        padding: 12px 0;
        border: none;
        background: transparent;
        position: relative;
    }
    .detail-tabs .nav-item .nav-link:hover {
        color: #F7941D;
    }
    .detail-tabs .nav-item .nav-link.active {
        color: #F7941D;
    }
    .detail-tabs .nav-item .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 3px;
        background: #F7941D;
        border-radius: 3px 3px 0 0;
    }
    
    @media (max-width: 768px) {
        .d-flex.align-items-center.gap-5 {
            gap: 1.5rem !important;
            flex-direction: column;
            align-items: flex-start !important;
        }
        .btn-donasi-large {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.detail-tabs .nav-link');
        const tabContents = document.querySelectorAll('.tab-pane-content');

        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all tabs
                tabLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                // Hide all contents
                tabContents.forEach(content => {
                    content.style.display = 'none';
                });

                // Show target content
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).style.display = 'block';
            });
        });
    });
</script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('donationChart').getContext('2d');
        
        const labels = {!! json_encode($months) !!};
        const data = {!! json_encode($values) !!};

        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(247, 148, 29, 0.5)');   
        gradient.addColorStop(1, 'rgba(247, 148, 29, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tren Donasi (Rp)',
                    data: data,
                    borderColor: '#F7941D',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#F7941D',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                let value = context.raw || 0;
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F3F4F6',
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + ' Jt';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000) + ' Rb';
                                }
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
