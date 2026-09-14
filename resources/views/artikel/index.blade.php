<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Space — Artikel &amp; Cerita Alumni</title>

    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/artikel.css') }}?v={{ file_exists(public_path('css/artikel.css')) ? filemtime(public_path('css/artikel.css')) : time() }}">

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
</head>
<body data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}">

<x-navbar />

@php
    $categories = $categories ?? \App\Models\Article::select('category')->distinct()->pluck('category');
    $heroArticle = $heroArticle ?? \App\Models\Article::latest()->first();
@endphp

<!-- ===================== WRAPPER UTAMA DENGAN 20 ORNAMEN ===================== -->
<div style="position: relative; overflow: hidden; width: 100%;">

  <!-- ================= KIRI (10 ORNAMEN) ================= -->
  <div class="deco-asset" style="top: 40px; left: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="floaty" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 320px; left: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="wiggle" style="width: 70px;">
  </div>
  <div class="deco-asset" style="top: 650px; left: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="floaty-slow" style="width: 85px;">
  </div>
  <div class="deco-asset" style="top: 980px; left: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="wiggle" style="width: 95px;">
  </div>
  <div class="deco-asset" style="top: 1350px; left: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="floaty" style="width: 100px;">
  </div>
  <div class="deco-asset" style="top: 1720px; left: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="floaty-slow" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 2100px; left: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="wiggle" style="width: 85px;">
  </div>
  <div class="deco-asset" style="top: 2480px; left: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="floaty" style="width: 70px;">
  </div>
  <div class="deco-asset" style="top: 2850px; left: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="floaty-slow" style="width: 90px;">
  </div>



  <!-- ================= KANAN (10 ORNAMEN) ================= -->
  <div class="deco-asset" style="top: 90px; right: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="floaty-slow" style="width: 100px;">
  </div>
  <div class="deco-asset" style="top: 420px; right: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="wiggle" style="width: 90px;">
  </div>
  <div class="deco-asset" style="top: 780px; right: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="floaty" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 1120px; right: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="wiggle" style="width: 85px;">
  </div>

  <div class="deco-asset" style="top: 1880px; right: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="floaty" style="width: 95px;">
  </div>
  <div class="deco-asset" style="top: 2250px; right: 2.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="wiggle" style="width: 90px;">
  </div>
  <div class="deco-asset" style="top: 2620px; right: 1%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="floaty-slow" style="width: 75px;">
  </div>
  <div class="deco-asset" style="top: 2980px; right: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="wiggle" style="width: 85px;">
  </div>
  <div class="deco-asset" style="bottom: 120px; right: 1.5%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="floaty" style="width: 70px;">
  </div>


  <!-- ================= SECTION 1 — HERO ================= -->
  <div class="section-blue" style="position: relative;">
    <section class="hero">
      <div class="hero-inner">

        <div class="hero-copy reveal-pop">
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
          <a href="{{ route('artikel.show', $heroArticle->slug) }}" class="hero-latest-card reveal-pop" style="--pop-delay:.15s">
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

  <!-- ================= SECTION 2 — LIST ARTIKEL ================= -->
  <div class="section-yellow" id="article-section" style="position: relative;">
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
          <div class="card reveal-pop" id="c{{ $article->id }}" data-category="{{ $article->category }}">
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

</div><!-- /wrapper utama -->

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

  var revealEls = document.querySelectorAll('.reveal-pop, .card, .reveal-fade');
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('in-view');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  revealEls.forEach(function(el){ io.observe(el); });

  var scrollBtn = document.getElementById('scroll-to-article');
  var articleSection = document.getElementById('article-section');
  if(scrollBtn && articleSection){
    scrollBtn.addEventListener('click', function(){
      articleSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  var filterBtns = document.querySelectorAll('.filter-btn');
  var filterLabel = document.getElementById('filter-label');
  var cards = document.querySelectorAll('.card');
  filterBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
      filterBtns.forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      var filter = btn.dataset.filter;
      filterLabel.textContent = (filter === 'all') ? 'semua artikel' : ('artikel ' + btn.textContent.trim());
      cards.forEach(function(card){
        var match = filter === 'all' || card.dataset.category === filter;
        card.style.display = match ? 'block' : 'none';
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
=======
  var backToTop = document.getElementById("back-to-top");
  if (backToTop) {
    window.addEventListener("scroll", function() {
      backToTop.classList.toggle("show", window.scrollY > 400);
    }, { passive: true });
    backToTop.addEventListener("click", function() {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  var waButton = document.getElementById("wa-button");
  var waBubble = document.getElementById("wa-bubble");
  var waBubbleClose = document.getElementById("wa-bubble-close");
  if (waButton && waBubble) {
    var waTimer = setTimeout(function() { waBubble.classList.add("show"); }, 1800);
    waButton.addEventListener("mouseenter", function() {
      clearTimeout(waTimer);
      waBubble.classList.add("show");
    });
    if (waBubbleClose) {
      waBubbleClose.addEventListener("click", function(e) {
        e.preventDefault();
        waBubble.classList.remove("show");
      });
    }
  }
});

</script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
