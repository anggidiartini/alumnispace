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

<!-- ===================== WRAPPER UTAMA DETAIL DENGAN 20 ORNAMEN ===================== -->
<div class="section-yellow detail-page-wrap" id="article-detail" style="position: relative; overflow: hidden; width: 100%;">

  <!-- ================= KIRI (10 ORNAMEN) ================= -->
  <div class="deco-asset" style="top: 50px; left: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="floaty" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 350px; left: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="wiggle" style="width: 85px;">
  </div>
  <div class="deco-asset" style="top: 700px; left: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="floaty-slow" style="width: 70px;">
  </div>
  <div class="deco-asset" style="top: 1050px; left: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="wiggle" style="width: 100px;">
  </div>
  <div class="deco-asset" style="top: 1420px; left: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="floaty" style="width: 95px;">
  </div>
  <div class="deco-asset" style="top: 1800px; left: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="floaty-slow" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 2180px; left: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="wiggle" style="width: 85px;">
  </div>
  <div class="deco-asset" style="top: 2550px; left: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="floaty" style="width: 100px;">
  </div>
  <div class="deco-asset" style="top: 2920px; left: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="floaty-slow" style="width: 70px;">
  </div>
  <div class="deco-asset" style="bottom: 80px; left: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="wiggle" style="width: 95px;">
  </div>


  <!-- ================= KANAN (10 ORNAMEN) ================= -->
  <div class="deco-asset" style="top: 100px; right: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="floaty-slow" style="width: 100px;">
  </div>
  <div class="deco-asset" style="top: 450px; right: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="wiggle" style="width: 95px;">
  </div>
  <div class="deco-asset" style="top: 820px; right: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="floaty" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 1180px; right: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="wiggle" style="width: 70px;">
  </div>
  <div class="deco-asset" style="top: 1560px; right: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="floaty-slow" style="width: 85px;">
  </div>
  <div class="deco-asset" style="top: 1950px; right: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="floaty" style="width: 100px;">
  </div>
  <div class="deco-asset" style="top: 2320px; right: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="wiggle" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 2690px; right: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="floaty-slow" style="width: 95px;">
  </div>
  <div class="deco-asset" style="top: 3050px; right: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="wiggle" style="width: 85px;">
  </div>
  <div class="deco-asset" style="bottom: 100px; right: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="floaty" style="width: 70px;">
  </div>


  <!-- ================= KONTEN HALAMAN DETAIL ================= -->
  <div class="wrap" style="position: relative; z-index: 2;">

    <a href="{{ route('artikel.index') }}" class="back-link reveal-pop">&larr; Kembali ke Artikel</a>

    <!-- Atas: Foto & Info Utama -->
    <div class="detail-grid">
      <div class="detail-photo-col reveal-pop">
        <div class="detail-photo">
          @if($article->thumbnail)
            <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}">
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
    </div>

    <!-- Isi Artikel Lengkap -->
    <div class="info-card article-body-card reveal-pop" style="--pop-delay:.2s;max-width:1080px;margin:0 auto 60px;">
      <div class="article-prose">
        {!! $article->content !!}
      </div>
    </div>

    <!-- Artikel Terkait -->
    @if($relatedArticles->count())
    <div class="related-head reveal-pop">
      <h2>Artikel <span class="marker">Terkait</span></h2>
    </div>
    <div class="related-grid">
      @foreach($relatedArticles as $related)
        <a href="{{ route('artikel.show', $related->slug) }}" class="related-card reveal-pop" style="--pop-delay:{{ .05 + ($loop->index * .1) }}s">
          <div class="related-photo">
            @if($related->thumbnail)
              <img src="{{ asset($related->thumbnail) }}" alt="{{ $related->title }}">
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

    <!-- Artikel Terbaru -->
    @if($latestArticles->count())
    <div class="related-head reveal-pop">
      <h2>Baca <span class="marker">Juga</span></h2>
    </div>
    <div class="related-grid">
      @foreach($latestArticles as $latest)
        <a href="{{ route('artikel.show', $latest->slug) }}" class="related-card reveal-pop" style="--pop-delay:{{ .05 + ($loop->index * .1) }}s">
          <div class="related-photo">
            @if($latest->thumbnail)
              <img src="{{ asset($latest->thumbnail) }}" alt="{{ $latest->title }}">
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
</div>

<!-- Floating action buttons -->
<div id="fab-row" class="fab-row">
    <button id="back-to-top" type="button" class="focus-ring" aria-label="Kembali ke atas">
        <i data-lucide="arrow-up" width="20" height="20"></i>
    </button>
    <div id="wa-widget">
        <div id="wa-bubble" class="wa-bubble">
            <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;">
                <p class="wa-bubble-title">Ada pertanyaan?</p>
                <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup"><i data-lucide="x" width="16" height="16"></i></button>
            </div>
            <p class="wa-bubble-text">Hubungi pengurus kami via WhatsApp 👋</p>
            <p class="wa-bubble-number">+62 812-3456-7890</p>
        </div>
        <a id="wa-button" href="https://wa.me/6281234567890?text=Halo" target="_blank" rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
            <i data-lucide="message-circle" width="26" height="26"></i>
        </a>
    </div>
</div>

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