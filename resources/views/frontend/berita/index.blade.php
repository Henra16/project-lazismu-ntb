@extends('frontend.layouts.app')

@section('title', 'Berita - Lazismu NTB')

@section('content')

{{-- ============================================
    PAGE HEADER SECTION
============================================= --}}
<section class="berita-page-header" id="berita-page-header">
    <div class="container">
        <h1 class="berita-page-title">Berita <span>Lazismu NTB</span></h1>
        <p class="berita-page-subtitle">Informasi terkini kegiatan dan program Lazismu NTB</p>
    </div>
</section>

{{-- ============================================
    BERITA GRID SECTION
============================================= --}}
<section class="berita-list-section" id="berita-list-section">
    <div class="container">

        @if($news->count() > 0)
        <div class="row g-4" id="berita-grid">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6">
                <article class="berita-list-card" id="berita-item-{{ $item->id }}">
                    <div class="berita-list-card__img-wrap">
                        @php
                            $imgSrc = $item->image
                                ? (Str::startsWith($item->image, 'http') ? $item->image : asset('storage/'.$item->image))
                                : 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=80';
                        @endphp
                        <img src="{{ $imgSrc }}" alt="{{ $item->title }}" class="berita-list-card__img">
                        <div class="berita-list-card__overlay"></div>
                    </div>
                    <div class="berita-list-card__body">
                        <h2 class="berita-list-card__title">{{ $item->title }}</h2>
                        <div class="berita-list-card__meta">
                            <span class="berita-list-card__date">
                                <i class="far fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                        <a href="{{ route('berita.show', $item->slug) }}"
                           class="berita-list-card__link"
                           id="berita-read-{{ $item->id }}">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($news->hasPages())
        <div class="berita-pagination" id="berita-pagination">
            {{-- Prev Button --}}
            @if($news->onFirstPage())
                <span class="page-btn page-btn--disabled">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $news->previousPageUrl() }}" class="page-btn">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                @if($page == $news->currentPage())
                    <span class="page-btn page-btn--active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Button --}}
            @if($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}" class="page-btn page-btn--next" id="btn-pagination-next">
                    Selanjutnya <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="page-btn page-btn--disabled page-btn--next">
                    Selanjutnya <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>
        @endif

        @else
        <div class="row justify-content-center">
            <div class="col-md-6 text-center py-5">
                <div style="color: #6c757d; font-size: 1.1rem;">
                    <i class="fas fa-box-open mb-3" style="font-size: 3rem; color: #F7941D;"></i>
                    <p class="fw-bold">Belum Ada Berita</p>
                    <p class="text-muted small">Saat ini belum ada berita yang diterbitkan. Silakan kembali lagi nanti!</p>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection

@push('styles')
<style>
/* ── Page Header ── */
.berita-page-header {
    background: linear-gradient(135deg, #fff9f0 0%, #fff3e0 100%);
    padding: 56px 0 40px;
    text-align: center;
    border-bottom: 1px solid #FFE0A3;
}
.berita-page-title {
    font-size: 2.2rem;
    font-weight: 900;
    color: var(--text-dark);
    margin-bottom: 8px;
}
.berita-page-title span {
    color: var(--orange-primary);
}
.berita-page-subtitle {
    font-size: 0.95rem;
    color: var(--text-gray);
    font-weight: 400;
}

/* ── Berita List Section ── */
.berita-list-section {
    padding: 56px 0 80px;
    background: #FAFAFA;
}

/* ── Berita List Card ── */
.berita-list-card {
    background: #fff;
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #F3F4F6;
}
.berita-list-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 36px rgba(247, 148, 29, 0.15);
    border-color: #FFD082;
}

/* Image Wrapper */
.berita-list-card__img-wrap {
    position: relative;
    overflow: hidden;
    height: 210px;
    flex-shrink: 0;
}
.berita-list-card__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.berita-list-card:hover .berita-list-card__img {
    transform: scale(1.06);
}
.berita-list-card__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.18) 0%, transparent 60%);
    pointer-events: none;
}

/* Card Body */
.berita-list-card__body {
    padding: 20px 22px 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.berita-list-card__title {
    font-size: 0.97rem;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.5;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}
.berita-list-card__meta {
    margin-bottom: 14px;
}
.berita-list-card__date {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.78rem;
    color: #fff;
    background: var(--orange-primary);
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: 500;
}
.berita-list-card__date i {
    font-size: 0.75rem;
}
.berita-list-card__link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-gray);
    border: 1.5px solid #E5E7EB;
    border-radius: 8px;
    padding: 7px 16px;
    width: fit-content;
    transition: all 0.3s ease;
    margin-top: auto;
}
.berita-list-card__link:hover {
    color: var(--orange-primary);
    border-color: var(--orange-primary);
    gap: 8px;
}
.berita-list-card__link i {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}
.berita-list-card__link:hover i {
    transform: translateX(3px);
}

/* ── Pagination ── */
.berita-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 56px;
    flex-wrap: wrap;
}
.page-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 42px;
    padding: 0 14px;
    border-radius: 10px;
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--text-dark);
    background: #fff;
    border: 1.5px solid #E5E7EB;
    text-decoration: none;
    transition: all 0.25s ease;
    cursor: pointer;
    gap: 6px;
}
.page-btn:hover {
    border-color: var(--orange-primary);
    color: var(--orange-primary);
}
.page-btn--active {
    background: var(--orange-primary);
    border-color: var(--orange-primary);
    color: #fff;
    cursor: default;
}
.page-btn--active:hover {
    color: #fff;
}
.page-btn--disabled {
    color: #C9C9C9;
    border-color: #F0F0F0;
    cursor: not-allowed;
    pointer-events: none;
}
.page-btn--next {
    padding: 0 20px;
    font-size: 0.88rem;
    background: var(--orange-primary);
    color: #fff;
    border-color: var(--orange-primary);
}
.page-btn--next:hover {
    background: var(--orange-dark);
    border-color: var(--orange-dark);
    color: #fff;
}
.page-btn--next.page-btn--disabled {
    background: #F0F0F0;
    border-color: #F0F0F0;
    color: #C9C9C9;
}
.page-ellipsis {
    border: none;
    background: none;
    color: var(--text-light);
    cursor: default;
    min-width: 20px;
}

/* ── Responsive ── */
@media (max-width: 767px) {
    .berita-page-title { font-size: 1.7rem; }
    .berita-list-card__img-wrap { height: 180px; }
    .berita-pagination { gap: 6px; }
    .page-btn { min-width: 36px; height: 36px; font-size: 0.85rem; }
}
</style>
@endpush
