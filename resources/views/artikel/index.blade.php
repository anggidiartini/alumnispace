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
  <div class="deco-asset" style="top: 1500px; right: 2%;" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="floaty-slow" style="width: 70px;">
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

        <div class="hero-copy reveal-pop" style="--pop-delay:0s">
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
        <h2>Semua Artikel</h2>
        <div class="count">{{ $articles->count() }} artikel</div>
      </div>

      <!-- SEARCH BAR: cari judul artikel, kerja pas tombol "Cari" diklik (atau Enter). Minimal 4 huruf. -->
      <div class="album-search-bar reveal-fade" style="--pop-delay:.15s">
        <div class="album-search-field">
          <label class="sr-only" for="article-search">Cari judul artikel</label>
          <input type="text" id="article-search" placeholder="Cari judul artikel..." autocomplete="off">
        </div>
        <button type="button" id="article-search-btn" class="album-search-submit">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6">
            <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
          </svg>
          Cari
        </button>
      </div>
      <p id="article-search-hint" class="album-search-hint" style="display:none;">Ketik minimal 4 huruf dulu ya, biar hasil carinya pas </p>

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
          <a href="{{ route('artikel.show', $article->slug) }}" class="card" id="c{{ $article->id }}" data-category="{{ $article->category }}" data-title="{{ strtolower($article->title) }}">
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
              <span class="view-btn">Baca Artikel</span>
            </div>
          </a>
        @empty
          <div style="grid-column: 1 / -1; text-align:center; padding: 40px;">
            <p style="font-size: 18px; font-weight:700;">Belum ada artikel.</p>
          </div>
        @endforelse
      </div>

      <!-- Pesan saat filter kategori tidak ada hasil -->
      <p id="article-filter-empty" class="album-search-empty" style="display:none;">
        Belum ada artikel di kategori ini.
      </p>
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

  // ---------- SCROLL TO ARTICLE LIST ----------
  var scrollBtn = document.getElementById('scroll-to-article');
  var articleSection = document.getElementById('article-section');
  if (scrollBtn && articleSection) {
    scrollBtn.addEventListener('click', function () {
      articleSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  // ---------- SCROLL REVEAL UNTUK CARD ARTIKEL (row-by-row, sama kaya album) ----------
  var cards = document.querySelectorAll('.card');
  var columns = 3;
  cards.forEach(function (c, i) {
    var row = Math.floor(i / columns);
    c.style.setProperty('--row-delay', (row * 0.65) + 's');
  });

  var cardIo = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        cardIo.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  cards.forEach(function (c) {
    cardIo.observe(c);
    c.addEventListener('animationend', function (e) {
      if (e.animationName === 'popBounceIn') { c.classList.add('popped'); }
    });
  });

  // ---------- SCROLL REVEAL UNTUK HEADING / FILTER BAR / HERO CARD / SIDEBAR, dst ----------
  var popEls = document.querySelectorAll(
    '.reveal-pop, .reveal-fade, .article-head, .article-cover, .article-body-card, .sidebar-block, .related-card'
  );
  var popIo = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        popIo.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  popEls.forEach(function (el) {
    popIo.observe(el);
    el.addEventListener('animationend', function (e) {
      if (e.animationName === 'popBounceIn') { el.classList.add('popped'); }
    });
  });

  // ---------- SEARCH (judul artikel, minimal 4 huruf) + FILTER KATEGORI — jalan bareng, sama kaya album ----------
  var filterBtns = document.querySelectorAll('.filter-btn');
  var filterLabel = document.getElementById('filter-label');
  var emptyMsg = document.getElementById('article-filter-empty');
  var searchInput = document.getElementById('article-search');
  var searchBtn = document.getElementById('article-search-btn');
  var hintMsg = document.getElementById('article-search-hint');
  var activeFilter = 'all';
  var activeKeyword = '';
  var MIN_CHARS = 4;

  function shake(el) {
    if (!el) return;
    el.classList.remove('shake');
    // force reflow biar animasi bisa diulang walau diklik berkali-kali beruntun
    void el.offsetWidth;
    el.classList.add('shake');
  }

  function currentFilterLabel() {
    if (activeFilter === 'all') return 'semua artikel';
    var activeBtn = document.querySelector('.filter-btn[data-filter="' + activeFilter + '"]');
    return 'artikel ' + (activeBtn ? activeBtn.textContent.trim() : activeFilter);
  }

  function applyFilterOnly() {
    var visibleCount = 0;
    cards.forEach(function (card) {
      var show = activeFilter === 'all' || card.dataset.category === activeFilter;
      card.classList.toggle('filtered-out', !show);
      if (show) visibleCount++;
    });
    filterLabel.textContent = currentFilterLabel();
    if (emptyMsg) emptyMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
  }

  // Menjalankan pencarian + filter kategori sekaligus.
  // Baru dijalankan ketika tombol "Cari" diklik (atau tekan Enter),
  // dan hanya kalau ketikannya sudah minimal 4 huruf.
  function runSearch() {
    var raw = searchInput ? searchInput.value.trim() : '';

    if (raw.length > 0 && raw.length < MIN_CHARS) {
      if (hintMsg) hintMsg.style.display = 'block';
      shake(searchInput);
      shake(searchBtn);
      return;
    }

    if (hintMsg) hintMsg.style.display = 'none';
    activeKeyword = raw.toLowerCase();

    var visibleCount = 0;
    cards.forEach(function (card) {
      var matchCategory = activeFilter === 'all' || card.dataset.category === activeFilter;
      var matchTitle = !activeKeyword || (card.dataset.title || '').indexOf(activeKeyword) !== -1;
      var show = matchCategory && matchTitle;
      card.classList.toggle('filtered-out', !show);
      if (show) visibleCount++;
    });

    if (activeKeyword) {
      filterLabel.textContent = 'hasil pencarian "' + activeKeyword + '"';
      if (searchBtn) searchBtn.classList.add('is-active');
    } else {
      filterLabel.textContent = currentFilterLabel();
      if (searchBtn) searchBtn.classList.remove('is-active');
    }

    if (emptyMsg) {
      emptyMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
    }
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      activeFilter = btn.dataset.filter;
      if (activeKeyword) {
        runSearch();
      } else {
        applyFilterOnly();
      }
    });
  });

  if (searchBtn) {
    searchBtn.addEventListener('click', function () {
      runSearch();
    });
  }

  if (searchInput) {
    searchInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        runSearch();
      }
    });

    // Kalau kolom cari dikosongin lagi, langsung balik tampilkan sesuai filter aktif
    // dan matikan status aktif tombol + sembunyikan hint.
    searchInput.addEventListener('input', function () {
      if (this.value.trim() === '') {
        if (hintMsg) hintMsg.style.display = 'none';
        if (activeKeyword !== '') {
          activeKeyword = '';
          if (searchBtn) searchBtn.classList.remove('is-active');
          applyFilterOnly();
        }
      } else if (this.value.trim().length >= MIN_CHARS && hintMsg) {
        hintMsg.style.display = 'none';
      }
    });
  }

  // ---------- BACK TO TOP ----------
  var backToTop = document.getElementById("back-to-top");
  if (backToTop) {
    window.addEventListener("scroll", function () {
      backToTop.classList.toggle("show", window.scrollY > 400);
    }, { passive: true });
    backToTop.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // ---------- WHATSAPP WIDGET ----------
  var waButton = document.getElementById("wa-button");
  var waBubble = document.getElementById("wa-bubble");
  var waBubbleClose = document.getElementById("wa-bubble-close");
  if (waButton && waBubble) {
    var waTimer = setTimeout(function () { waBubble.classList.add("show"); }, 1800);
    waButton.addEventListener("mouseenter", function () {
      clearTimeout(waTimer);
      waBubble.classList.add("show");
    });
    if (waBubbleClose) {
      waBubbleClose.addEventListener("click", function (e) {
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