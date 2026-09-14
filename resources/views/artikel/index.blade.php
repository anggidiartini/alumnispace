<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Space — Artikel &amp; Cerita Alumni</title>

    <!-- CSS File Calls -->
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/artikel.css') }}?v={{ file_exists(public_path('css/artikel.css')) ? filemtime(public_path('css/artikel.css')) : time() }}">

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
</head>
<body data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}">

<x-navbar />

@php
    /*
     * View-only: Controller index() saat ini kirim $articles (SEMUA artikel,
     * tanpa pagination — filter kategori sekarang full client-side JS,
     * mirip pola di halaman Album).
     *
     * Kalau nanti jumlah artikel sudah banyak dan butuh pagination lagi,
     * pola filter ini perlu diganti ke versi AJAX/server-side.
     */
    $categories = $categories ?? \App\Models\Article::select('category')
        ->distinct()
        ->pluck('category');

    $heroArticle = $heroArticle ?? \App\Models\Article::latest()->first();
@endphp

<!-- ===================== SECTION 1 — HERO (senada section-blue album) ===================== -->
<div class="section-blue">

  <!-- doodles -->
  <div class="doodle" style="top:60px;left:6%;--r:-10deg;" id="doodle-star">
    <svg width="34" height="34" viewBox="0 0 24 24" fill="#FFF7D6"><path d="M12 1l2.9 7.3L22 11l-7.1 2.7L12 21l-2.9-7.3L2 11l7.1-2.7z"/></svg>
  </div>
  <div class="doodle" style="bottom:8%;left:3%;--r:12deg;color:#fff;font-size:26px;">♡</div>

  <section class="hero">
    <div class="hero-inner">

      <div class="hero-copy">
        <div class="greet-badge"> ARTIKEL &amp; CERITA</div>
        <h1 class="title">
          Cerita, Tips, dan Kabar Seputar Alumni
        </h1>
        <p class="subtitle">
          Kumpulan tulisan dari dan untuk alumni — mulai dari kisah perjalanan karier,
          tips, sampai kabar terbaru seputar keluarga besar alumni.
        </p>
        <button class="hero-cta" id="scroll-to-article">
          Lihat Artikel
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2c3e50" stroke-width="2.6"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
        </button>
      </div>

      @if($heroArticle)
        <a href="{{ route('artikel.show', $heroArticle->slug) }}" class="hero-latest-card">
          <span class="hero-latest-pin">Terbaru</span>
          <div class="hero-latest-top hero-latest-top--blue">
            @if($heroArticle->thumbnail)
              <img src="{{ asset($heroArticle->thumbnail) }}" alt="{{ $heroArticle->title }}" style="width:100%;height:100%;object-fit:cover;">
            @else
              <i data-lucide="newspaper" style="width:48px;height:48px;"></i>
            @endif
          </div>
          <div class="hero-latest-body">
            <span class="hero-latest-cat">{{ $heroArticle->category }}</span>
            <h3 class="hero-latest-title">{{ $heroArticle->title }}</h3>
            <p class="hero-latest-desc">{{ $heroArticle->excerpt }}</p>
            <span class="hero-latest-link">
              Baca selengkapnya
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </span>
          </div>
        </a>
      @endif

    </div>
  </section>

  <div class="wave-divider">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
      <path d="M0,40 C240,90 380,0 620,35 C860,70 1000,10 1180,45 C1300,68 1380,60 1440,45 L1440,100 L0,100 Z" fill="#ffffff"></path>
    </svg>
  </div>
</div>

<!-- ===================== SECTION 2 — LIST ARTIKEL (senada section-yellow album) ===================== -->
<div class="section-yellow" id="article-section">

  <div class="wrap">
    <div class="section-head reveal-pop">
      <h2>Semua <span class="marker">Artikel</span></h2>
      <div class="count">{{ $articles->count() }} artikel</div>
    </div>

    <div class="filter-bar">
      <button class="filter-btn active reveal-pop" data-filter="all" style="--pop-delay:.05s">Semua</button>
      @foreach($categories as $index => $cat)
        <button class="filter-btn reveal-pop" data-filter="{{ $cat }}"
                style="--pop-delay:{{ .05 + (($index + 1) * .1) }}s">{{ ucfirst($cat) }}</button>
      @endforeach
    </div>
    <div class="filter-status reveal-fade" style="--pop-delay:.35s">
      Menampilkan <strong id="filter-label">semua artikel</strong>
    </div>

    <div class="album-grid">
      @forelse($articles as $article)
        <div class="card" id="c{{ $article->id }}" data-category="{{ $article->category }}">
          <div class="card-photo">
            <span class="cat-pill">{{ ucfirst($article->category) }}</span>
            <span class="card-symbol">✳</span>
            @if($article->thumbnail)
              <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}">
            @else
              <i data-lucide="newspaper" style="width:44px;height:44px;opacity:.4;color:var(--jc-ink);"></i>
            @endif
          </div>
          <div class="card-body">
            <h3>{{ $article->title }}</h3>
            <div class="date">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.4" class="date-icon">
                <rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/>
              </svg>
              {{ $article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}
            </div>
            <p class="card-desc">{{ \Illuminate\Support\Str::limit($article->excerpt, 90) }}</p>
            <a href="{{ route('artikel.show', $article->slug) }}" class="view-btn">Baca Artikel
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      @empty
        <div style="grid-column: 1 / -1; text-align:center; padding: 40px;">
          <p style="font-size: 18px; font-weight:700;">Belum ada artikel.</p>
        </div>
      @endforelse
    </div>
  </div>

</div>
<!-- Floating action buttons -->


<x-footer />

<script>
document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();
});

(function(){
  // ---------- SMOOTH SCROLL KE SECTION ARTIKEL ----------
  var scrollBtn = document.getElementById('scroll-to-article');
  var articleSection = document.getElementById('article-section');
  if(scrollBtn && articleSection){
    scrollBtn.addEventListener('click', function(){
      articleSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  // ---------- SCROLL REVEAL UNTUK CARD ARTIKEL ----------
  var cards = document.querySelectorAll('.card');
  var columns = 3;
  cards.forEach(function(c, i){
    var row = Math.floor(i / columns);
    c.style.setProperty('--row-delay', (row * 0.65) + 's');
  });
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('in-view');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  cards.forEach(function(c){
    io.observe(c);
    c.addEventListener('animationend', function(e){
      if(e.animationName === 'popBounceIn'){ c.classList.add('popped'); }
    });
  });

  // ---------- SCROLL REVEAL UNTUK HEADING / FILTER BAR / STATUS ----------
  var popEls = document.querySelectorAll('.reveal-pop, .reveal-fade');
  var popIo = new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('in-view');
        popIo.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });
  popEls.forEach(function(el){ popIo.observe(el); });

  // ---------- FILTER BUTTONS (client-side, tanpa reload — sama seperti Album) ----------
  var filterBtns = document.querySelectorAll('.filter-btn');
  var filterLabel = document.getElementById('filter-label');

  filterBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
      filterBtns.forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      var filter = btn.dataset.filter;
      filterLabel.textContent = (filter === 'all')
        ? 'semua artikel'
        : ('artikel ' + btn.textContent.trim());

      cards.forEach(function(card){
        var match = filter === 'all' || card.dataset.category === filter;
        card.classList.toggle('filtered-out', !match);
      });
    });
  });

  // Catatan: logic back-to-top & WA widget SUDAH ditangani oleh js/script.js
  // (dipakai bareng di semua halaman). Sebelumnya di sini ada logic duplikat
  // untuk keduanya (timer 1800ms + listener terpisah) yang tabrakan sama
  // logic global di script.js (timer 2200ms) - itu penyebab animasi/posisi
  // jadi berantakan. Makanya blok itu DIHAPUS dari sini, jangan ditambah lagi.
})();

const menuToggle = document.getElementById('menuToggle');
const navbarMenu = document.getElementById('navbarMenu');

if (menuToggle && navbarMenu) {
  menuToggle.addEventListener('click', () => {
    navbarMenu.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });

  document.querySelectorAll('.navbar-menu a').forEach(link => {
    link.addEventListener('click', () => {
      navbarMenu.classList.remove('active');
      menuToggle.classList.remove('active');
    });
  });
}
</script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>