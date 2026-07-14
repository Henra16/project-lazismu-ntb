@extends('frontend.layouts.app')

@section('title', ($berita->title ?? 'Detail Berita') . ' - Lazismu NTB')

@section('content')

{{-- ============================================
    BREADCRUMB
============================================= --}}
<section class="berita-breadcrumb-section" id="berita-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="berita-breadcrumb">
                <li><a href="{{ url('/') }}" id="breadcrumb-home">Beranda</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><a href="{{ route('berita.index') }}" id="breadcrumb-berita">Berita</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li class="active">{{ Str::limit($berita->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- ============================================
    DETAIL BERITA
============================================= --}}
<section class="berita-detail-section" id="berita-detail-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Article Header --}}
                <div class="berita-detail__header">
                    <div class="berita-detail__badge">{{ $berita->category ?? 'Berita' }}</div>
                    <h1 class="berita-detail__title">{{ $berita->title }}</h1>
                    <div class="berita-detail__meta">
                        <span class="berita-detail__date">
                            <i class="far fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($berita->published_at ?? $berita->created_at ?? now())->translatedFormat('d F Y') }}
                        </span>
                        <span class="berita-detail__divider">·</span>
                        <span class="berita-detail__read">
                            <i class="far fa-clock"></i>
                            5 menit baca
                        </span>
                    </div>
                </div>

                {{-- Article Image --}}
                <div class="berita-detail__img-wrap">
                    @php
                        $mainImg = $berita->image
                            ? (Str::startsWith($berita->image, 'http') ? $berita->image : asset('storage/'.$berita->image))
                            : 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=900&q=80';
                    @endphp
                    <img src="{{ $mainImg }}" alt="{{ $berita->title }}" class="berita-detail__img">
                </div>

                {{-- Article Content --}}
                <div class="berita-detail__content">
                    @if($berita->excerpt)
                        <p class="berita-detail__excerpt">{{ $berita->excerpt }}</p>
                    @endif
                    {!! $berita->content ?? '<p>Konten berita akan segera tersedia.</p>' !!}
                </div>

                {{-- Share Section --}}
                <div class="berita-detail__share">
                    <span class="share-label">Bagikan:</span>
                    <div class="share-btns">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                           target="_blank" class="share-btn share-btn--fb" id="share-facebook" rel="noopener">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->title . ' ' . url()->current()) }}"
                           target="_blank" class="share-btn share-btn--wa" id="share-whatsapp" rel="noopener">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->title) }}&url={{ urlencode(url()->current()) }}"
                           target="_blank" class="share-btn share-btn--tw" id="share-twitter" rel="noopener">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                {{-- Back Link --}}
                <div class="mt-4">
                    <a href="{{ route('berita.index') }}" class="berita-back-link" id="btn-back-to-berita">
                        <i class="fas fa-arrow-left"></i> Kembali ke Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
    BERITA TERKAIT SECTION
============================================= --}}
@if(isset($related) && $related->count() > 0)
<section class="berita-related-section" id="berita-related-section">
    <div class="container">
        <div class="section-title">
            <span class="icon-star">✦</span>
            <h2>Berita <span>Terkait</span></h2>
        </div>
        <div class="row g-4">
            @foreach($related as $item)
            <div class="col-lg-4 col-md-6">
                <article class="berita-list-card" id="related-item-{{ $item->id }}">
                    <div class="berita-list-card__img-wrap">
                        @php
                            $relImg = $item->image
                                ? (Str::startsWith($item->image, 'http') ? $item->image : asset('storage/'.$item->image))
                                : 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=80';
                        @endphp
                        <img src="{{ $relImg }}" alt="{{ $item->title }}" class="berita-list-card__img">
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
                        <a href="{{ route('berita.show', $item->slug) }}" class="berita-list-card__link">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('styles')
<style>
/* ── Breadcrumb ── */
.berita-breadcrumb-section {
    background: #fff;
    border-bottom: 1px solid #F3F4F6;
    padding: 14px 0;
}
.berita-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;
    margin: 0;
    padding: 0;
    flex-wrap: wrap;
}
.berita-breadcrumb li {
    font-size: 0.82rem;
    color: var(--text-light);
}
.berita-breadcrumb li a {
    color: var(--text-gray);
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s;
}
.berita-breadcrumb li a:hover { color: var(--orange-primary); }
.berita-breadcrumb li.active { color: var(--orange-primary); font-weight: 600; }
.berita-breadcrumb li i { font-size: 0.65rem; color: #D1D5DB; }

/* ── Detail Section ── */
.berita-detail-section {
    padding: 48px 0 60px;
    background: #FAFAFA;
}

/* Header */
.berita-detail__header { margin-bottom: 28px; }
.berita-detail__badge {
    display: inline-block;
    background: var(--orange-light);
    color: var(--orange-primary);
    font-size: 0.78rem;
    font-weight: 700;
    padding: 4px 14px;
    border-radius: 20px;
    border: 1px solid #FFD082;
    margin-bottom: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.berita-detail__title {
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--text-dark);
    line-height: 1.4;
    margin-bottom: 16px;
}
.berita-detail__meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.berita-detail__date,
.berita-detail__read {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.82rem;
    color: var(--text-light);
}
.berita-detail__date i,
.berita-detail__read i { color: var(--orange-primary); }
.berita-detail__divider { color: #D1D5DB; }

/* Image */
.berita-detail__img-wrap {
    border-radius: var(--radius-md);
    overflow: hidden;
    margin-bottom: 32px;
    box-shadow: var(--shadow-md);
}
.berita-detail__img {
    width: 100%;
    max-height: 420px;
    object-fit: cover;
    display: block;
}

/* Content */
.berita-detail__content {
    font-size: 0.97rem;
    color: var(--text-gray);
    line-height: 1.9;
    margin-bottom: 36px;
}
.berita-detail__excerpt {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--text-dark);
    border-left: 4px solid var(--orange-primary);
    padding-left: 16px;
    margin-bottom: 24px;
    font-style: italic;
}
.berita-detail__content p { margin-bottom: 16px; }
.berita-detail__content h2,
.berita-detail__content h3 {
    color: var(--text-dark);
    font-weight: 700;
    margin: 28px 0 12px;
}
.berita-detail__content img {
    border-radius: var(--radius-sm);
    margin: 16px 0;
}

/* Share */
.berita-detail__share {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 20px 0;
    border-top: 1px solid #F3F4F6;
    border-bottom: 1px solid #F3F4F6;
    margin-bottom: 28px;
}
.share-label {
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--text-gray);
}
.share-btns {
    display: flex;
    gap: 8px;
}
.share-btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: #fff;
    transition: all 0.3s ease;
}
.share-btn--fb  { background: #1877F2; }
.share-btn--wa  { background: #25D366; }
.share-btn--tw  { background: #1DA1F2; }
.share-btn:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); color: #fff; }

/* Back Link */
.berita-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--text-gray);
    border: 1.5px solid #E5E7EB;
    border-radius: var(--radius-sm);
    padding: 9px 20px;
    transition: all 0.3s ease;
}
.berita-back-link:hover {
    color: var(--orange-primary);
    border-color: var(--orange-primary);
    gap: 12px;
}
.berita-back-link i { transition: transform 0.3s ease; }
.berita-back-link:hover i { transform: translateX(-3px); }

/* Related Section */
.berita-related-section {
    padding: 60px 0 80px;
    background: #fff;
}

/* Reuse berita-list-card styles from index */
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
.berita-list-card__img-wrap {
    position: relative;
    overflow: hidden;
    height: 200px;
    flex-shrink: 0;
}
.berita-list-card__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.berita-list-card:hover .berita-list-card__img { transform: scale(1.06); }
.berita-list-card__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.18) 0%, transparent 60%);
    pointer-events: none;
}
.berita-list-card__body {
    padding: 18px 20px 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.berita-list-card__title {
    font-size: 0.92rem;
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
.berita-list-card__meta { margin-bottom: 14px; }
.berita-list-card__date {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.76rem;
    color: #fff;
    background: var(--orange-primary);
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 500;
}
.berita-list-card__link {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.83rem;
    font-weight: 600;
    color: var(--text-gray);
    border: 1.5px solid #E5E7EB;
    border-radius: 8px;
    padding: 7px 14px;
    width: fit-content;
    transition: all 0.3s ease;
}
.berita-list-card__link:hover {
    color: var(--orange-primary);
    border-color: var(--orange-primary);
    gap: 8px;
}
.berita-list-card__link i { font-size: 0.78rem; transition: transform 0.3s ease; }
.berita-list-card__link:hover i { transform: translateX(3px); }

/* Responsive */
@media (max-width: 767px) {
    .berita-detail__title { font-size: 1.3rem; }
    .berita-detail__img { max-height: 240px; }
}
</style>
@endpush
