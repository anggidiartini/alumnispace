<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>memori. — {{ $article->title }}</title>

    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/artikel.css') }}?v={{ file_exists(public_path('css/artikel.css')) ? filemtime(public_path('css/artikel.css')) : time() }}">

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
</head>
<body>

<x-navbar />

<div class="section-yellow detail-page-wrap" id="article-detail">

  <!-- doodles, senada dengan detail album -->
  <div class="doodle" style="top:110px;left:3%;--r:-8deg;">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="#f2b600"><path d="M12 1l2.9 7.3L22 11l-7.1 2.7L12 21l-2.9-7.3L2 11l7.1-2.7z"/></svg>
  </div>
  <div class="doodle" style="top:55%;right:2%;--r:10deg;color:var(--home-pink-strong);font-size:24px;">♡</div>

  <div class="wrap">

    <a href="{{ route('artikel.index') }}" class="back-link">&larr; Kembali ke Artikel</a>

    <!-- ===== ATAS: foto besar (kiri) + panel info (kanan) — tata letak ala Canva ===== -->
    <div class="detail-grid">

      <div class="detail-photo-col">
        <div class="detail-photo">
          @if($article->thumbnail)
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}">
          @else
            <div style="width:100%;height:100%;min-height:340px;display:flex;align-items:center;justify-content:center;background:var(--jc-soft);">
              <i data-lucide="newspaper" style="width:70px;height:70px;opacity:.35;color:var(--jc-ink);"></i>
            </div>
          @endif
        </div>
      </div>

      <div class="detail-info-col reveal-pop" style="--pop-delay:.1s">
        <div class="greet-badge small"><span>✦</span> {{ strtoupper($article->category) }}</div>

        <h1 class="marker-title">{{ $article->title }}</h1>

        <div class="meta-row">
          <div class="meta-item">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            {{ $article->published_at?->translatedFormat('d F Y') ?? $article->created_at?->translatedFormat('d F Y') ?? '-' }}
          </div>
          <div class="meta-item">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20.59 13.41 12 22l-8-8 8.59-8.59A2 2 0 0 1 14 5h6v6a2 2 0 0 1-.59 1.41Z"/><circle cx="10" cy="8" r="1"/></svg>
            {{ ucfirst($article->category) }}
          </div>
          @if($article->user)
          <div class="meta-item">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
            {{ $article->user->name }}
          </div>
          @endif
        </div>

        @if($article->excerpt)
        <div class="desc-quote">
          <p class="detail-desc">{{ $article->excerpt }}</p>
        </div>
        @endif
      </div>

    </div><!-- /.detail-grid -->

    <!-- ===== ISI ARTIKEL LENGKAP ===== -->
    <div class="info-card article-body-card reveal-pop" style="--pop-delay:.2s;max-width:1080px;margin:0 auto 60px;">
      <div class="article-prose">
        {!! $article->content !!}
      </div>
    </div>

    <!-- ===== ARTIKEL TERKAIT — grid rekomendasi ala Canva ===== -->
    @if($relatedArticles->count())
    <div class="related-head">
      <h2>Artikel <span class="marker">Terkait</span></h2>
    </div>
    <div class="related-grid">
      @foreach($relatedArticles as $related)
        <a href="{{ route('artikel.show', $related->slug) }}" class="related-card reveal-pop" style="--pop-delay:{{ .05 + ($loop->index * .1) }}s">
          <div class="related-photo">
            @if($related->thumbnail)
              <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}">
            @else
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--jc-soft);">
                <i data-lucide="newspaper" style="width:32px;height:32px;opacity:.35;color:var(--jc-ink);"></i>
              </div>
            @endif
          </div>
          <div class="related-body">
            <div class="label">{{ ucfirst($related->category) }}</div>
            <h3>{{ $related->title }}</h3>
            <span class="view-btn">Baca Artikel
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.6"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </span>
          </div>
        </a>
      @endforeach
    </div>
    @endif

    <!-- ===== ARTIKEL TERBARU — grid rekomendasi ala Canva ===== -->
    @if($latestArticles->count())
    <div class="related-head">
      <h2>Baca <span class="marker">Juga</span></h2>
    </div>
    <div class="related-grid">
      @foreach($latestArticles as $latest)
        <a href="{{ route('artikel.show', $latest->slug) }}" class="related-card reveal-pop" style="--pop-delay:{{ .05 + ($loop->index * .1) }}s">
          <div class="related-photo">
            @if($latest->thumbnail)
              <img src="{{ asset('storage/' . $latest->thumbnail) }}" alt="{{ $latest->title }}">
            @else
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--jc-soft);">
                <i data-lucide="newspaper" style="width:32px;height:32px;opacity:.35;color:var(--jc-ink);"></i>
              </div>
            @endif
          </div>
          <div class="related-body">
            <div class="label">{{ ucfirst($latest->category) }}</div>
            <h3>{{ $latest->title }}</h3>
            <span class="view-btn">Baca Artikel
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.6"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </span>
          </div>
        </a>
      @endforeach
    </div>
    @endif

  </div>
</div><!-- /.detail-page-wrap -->

<x-footer />

<script>
document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();

  var popEls = document.querySelectorAll('.reveal-pop');
  var popIo = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        popIo.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  popEls.forEach(function (el) { popIo.observe(el); });

  // Card related biar animasinya matched sama .card index (pakai class 'popped' setelah muncul)
  document.querySelectorAll('.related-card.reveal-pop').forEach(function (el) {
    el.addEventListener('animationend', function (e) {
      if (e.animationName === 'popBounceIn') el.classList.add('popped');
    });
  });
});
</script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
