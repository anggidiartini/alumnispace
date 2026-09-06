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

    <div class="article-head reveal-pop">
      <span class="cat-pill">{{ $article->category }}</span>
      <h1 class="article-title marker-title">{{ $article->title }}</h1>
      <div class="article-date">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#4a5a6a" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        {{ $article->published_at?->translatedFormat('d-m-Y') ?? $article->created_at->translatedFormat('d-m-Y') }}
      </div>
    </div>

    <div class="article-cover reveal-pop" style="--pop-delay:.1s">
      @if($article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}">
      @else
        <i data-lucide="newspaper" class="no-cover-icon" style="width:90px;height:90px;"></i>
      @endif
    </div>

    @php
        /*
         * View-only, read-only: Controller show() saat ini cuma compact('article'),
         * belum kirim data related/terbaru ke view. Sambil menunggu itu ditambahkan
         * di backend, sidebar "Artikel Terkait" & "Artikel Terbaru" ambil datanya
         * di sini dulu (tidak menyentuh Controller/Model).
         *
         * Kalau nanti backend sudah mengirim $relatedArticles / $latestArticles
         * sendiri lewat Controller, blok @php ini tinggal dihapus dan variabel
         * yang dikirim Controller akan otomatis dipakai di bawah.
         */
        $relatedArticles = $relatedArticles ?? \App\Models\Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        $latestArticles = $latestArticles ?? \App\Models\Article::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();
    @endphp

    <div class="article-layout">

      <div class="article-content-col">
        <div class="info-card article-body-card reveal-pop" style="--pop-delay:.15s">
          <div class="article-prose">
            {!! $article->content !!}
          </div>
        </div>
      </div>

      <aside class="article-sidebar-col">

        @if($relatedArticles->count())
        <div class="sidebar-block reveal-pop" style="--pop-delay:.2s">
          <h3 class="sidebar-title">Artikel <span class="marker">Terkait</span></h3>
          @foreach($relatedArticles as $related)
            <a href="{{ route('artikel.show', $related->slug) }}" class="sidebar-item">
              <div class="sidebar-thumb">
                @if($related->thumbnail)
                  <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}">
                @else
                  <i data-lucide="newspaper" style="width:22px;height:22px;opacity:.4;color:var(--jc-ink);"></i>
                @endif
              </div>
              <div class="sidebar-text">
                <span class="cat-pill mini">{{ $related->category }}</span>
                <p class="sidebar-item-title">{{ $related->title }}</p>
                <span class="sidebar-item-date">{{ $related->published_at?->translatedFormat('d-m-Y') ?? $related->created_at->translatedFormat('d-m-Y') }}</span>
              </div>
            </a>
          @endforeach
        </div>
        @endif

        @if($latestArticles->count())
        <div class="sidebar-block reveal-pop" style="--pop-delay:.3s">
          <h3 class="sidebar-title">Artikel <span class="marker">Terbaru</span></h3>
          @foreach($latestArticles as $latest)
            <a href="{{ route('artikel.show', $latest->slug) }}" class="sidebar-item">
              <div class="sidebar-thumb">
                @if($latest->thumbnail)
                  <img src="{{ asset('storage/' . $latest->thumbnail) }}" alt="{{ $latest->title }}">
                @else
                  <i data-lucide="newspaper" style="width:22px;height:22px;opacity:.4;color:var(--jc-ink);"></i>
                @endif
              </div>
              <div class="sidebar-text">
                <span class="cat-pill mini">{{ $latest->category }}</span>
                <p class="sidebar-item-title">{{ $latest->title }}</p>
                <span class="sidebar-item-date">{{ $latest->published_at?->translatedFormat('d-m-Y') ?? $latest->created_at->translatedFormat('d-m-Y') }}</span>
              </div>
            </a>
          @endforeach
        </div>
        @endif

      </aside>
    </div>

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
});
</script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>