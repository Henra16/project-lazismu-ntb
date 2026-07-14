@extends('frontend.layouts.app')

@section('title', 'Hasil Pencarian - Lazismu NTB')

@section('content')

{{-- ============================================
    SEARCH HEADER SECTION
============================================= --}}
<section class="search-header-section py-5" style="background: linear-gradient(135deg, var(--orange-primary) 0%, var(--orange-dark) 100%); color: #fff;">
    <div class="container text-center py-4">
        <h1 class="display-5 fw-bold mb-3">Hasil Pencarian</h1>
        <p class="lead mb-4">Menampilkan hasil untuk: <strong>"{{ $query }}"</strong></p>
        
        <div class="search-bar-container mx-auto" style="max-width: 600px;">
            <div class="search-bar bg-white rounded-pill p-2 shadow-lg d-flex align-items-center">
                <i class="fas fa-search ms-3 text-muted"></i>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari program donasi..." id="search-input-page" value="{{ $query }}">
                <button class="btn btn-orange rounded-pill px-4 ms-2" id="btn-search-page">Cari</button>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    SEARCH RESULTS SECTION
============================================= --}}
<section class="results-section py-5">
    <div class="container">
        <div class="row">
            @if($programs->count() > 0)
                <div class="col-12 mb-4">
                    <h3 class="fw-bold">{{ $programs->total() }} Program Ditemukan</h3>
                </div>
                
                @foreach($programs as $program)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="program-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <img src="{{ $program->image ? (Str::startsWith($program->image, 'http') ? $program->image : asset('storage/'.$program->image)) : 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400&q=80' }}" alt="{{ $program->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <span class="badge position-absolute top-0 end-0 m-3 bg-orange-primary px-3 py-2 rounded-pill shadow-sm" style="background-color: var(--orange-primary);">{{ $program->category ?? 'Zakat' }}</span>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-1">{{ $program->title }}</h5>
                            <p class="text-muted small mb-3">{{ Str::limit($program->description, 100) }}</p>

                            <div class="progress-info d-flex justify-content-between mb-1">
                                <span class="progress-label small fw-bold">Terkumpul</span>
                                <span class="progress-amount small fw-bold text-orange-primary" style="color: var(--orange-primary);">Rp {{ number_format($program->collected ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="progress mb-3" style="height: 8px; border-radius: 10px;">
                                @php
                                    $target = $program->target_amount ?? 1;
                                    $collected = $program->collected ?? 0;
                                    $percentage = min(($collected / $target) * 100, 100);
                                @endphp
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%; background: var(--orange-gradient); border-radius: 10px;"></div>
                            </div>
                            
                            <div class="target-row d-flex justify-content-between mb-4">
                                <span class="target-label small text-muted">Target</span>
                                <span class="target-amount small fw-bold">Rp {{ number_format($program->target_amount ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <a href="{{ url('/program/'.$program->slug) }}" class="btn btn-orange w-100 rounded-3 py-2 fw-bold">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-12 mt-4 d-flex justify-content-center">
                    {{ $programs->appends(['q' => $query])->links() }}
                </div>
            @else
                <div class="col-12 text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search-minus fa-5x text-muted opacity-25"></i>
                    </div>
                    <h2 class="fw-bold text-muted">Maaf, program tidak ditemukan</h2>
                    <p class="text-muted">Coba gunakan kata kunci lain untuk menemukan program yang Anda cari.</p>
                    <a href="{{ route('home') }}" class="btn btn-orange-outline mt-3 rounded-pill px-4">Kembali ke Beranda</a>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input-page');
        const btnSearch   = document.getElementById('btn-search-page');
        
        if (btnSearch) {
            btnSearch.addEventListener('click', function() {
                const query = searchInput.value.trim();
                if (query) {
                    window.location.href = '{{ route("search") }}?q=' + encodeURIComponent(query);
                } else {
                    window.location.href = '{{ route("home") }}';
                }
            });
        }
        
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') btnSearch.click();
            });
        }
    });
</script>
@endpush
