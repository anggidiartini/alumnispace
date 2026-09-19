<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alumni Space — Direktori Alumni</title>

<script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/alumni.css') }}?v={{ file_exists(public_path('css/alumni.css')) ? filemtime(public_path('css/alumni.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/alumni.css')) ? filemtime(public_path('css/home.css')) : time() }}">
</head>
<body class="alumni-page-body" data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}" style="background: #f7fbff;">

<x-user-navbar />

<main>
  <section class="hero-section dot-grid" style="background: linear-gradient(135deg, rgb(234, 244, 255), rgb(255, 254, 249));">
    <span class="hero-shape shape-pink"></span>
    <span class="hero-shape shape-yellow"></span>
    <span class="hero-shape shape-mint"></span>
    <div class="deco-asset alumni-hero-papantulis reveal-onscroll" aria-hidden="true">
      <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="aset-papantulis floaty">
    </div>
    <div class="deco-asset alumni-hero-lampu reveal-onscroll" style="transition-delay:.1s" aria-hidden="true">
      <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="aset-lampu floaty-slow">
    </div>
    <div class="deco-asset alumni-hero-jam reveal-onscroll" aria-hidden="true">
      <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam wiggle">
    </div>
    <div class="deco-asset alumni-hero-bus reveal-onscroll" style="transition-delay:.15s" aria-hidden="true">
      <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="aset-bus floaty-slow">
    </div>
    <div class="hero-container">
      <div class="hero-grid">
        <div class="hero-left reveal">
          <p class="inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold">Alumni Space · ruang temu lintas angkatan</p>
          <h1 class="hero-title" style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 32px;">Kita tetap tumbuh, bersama.</h1>
          <p class="hero-subtitle" style="color: rgb(80, 117, 155); font-weight: 400; font-style: normal; font-size: 18px; line-height: 1.55;">Temukan kembali teman seperjalanan, bagikan cerita, dan rayakan langkah baik dari komunitas alumni kita.</p>
          <a href="#direktori" class="custom-pill-btn px-6 py-3.5 text-base">Lihat direktori</a>

          <div class="hero-stats">
            <div class="stat-card" style="background: rgb(255, 255, 255);">
              <p class="stat-label">Alumni terdaftar</p>
              <p class="stat-value">{{ $totalActiveAlumni ?? $alumni->count() }}</p>
            </div>
            <div class="stat-card" style="background: rgb(255, 240, 168);">
              <p class="stat-label">Rentang angkatan</p>
              <p class="stat-value">
                {{ $yearRange ?? '-' }}
              </p>
            </div>
            <div class="stat-card" style="background: rgb(204, 239, 227);">
              <p class="stat-label">Kota terhubung</p>
              <p class="stat-value">{{ $connectedCitiesCount ?? 0 }}</p>
            </div>
          </div>
        </div>

        <div class="hero-photo-outer reveal" style="animation-delay:.15s">

          <div class="hero-photo-frame">
            <img loading="lazy" src="{{ asset('assets/images/image9.png') }}" alt="A happy group of diverse college students posing cheerfully outside a modern building.">
          </div>

        </div>
      </div>
    </div>
  </section>

  <section id="direktori" class="directory-section">
    <div class="deco-asset alumni-direktori-alattulis reveal-onscroll" aria-hidden="true">
      <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="aset-alattulis floaty-slow">
    </div>
    <div class="deco-asset alumni-direktori-jam reveal-onscroll" style="transition-delay:.1s" aria-hidden="true">
      <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam wiggle">
    </div>
    <div id="directory-shell" class="directory-shell">
      <div class="directory-header reveal-onscroll">
        <div>
          <p class="inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold">Dirokti Alumni</p>
          <h2 class="directory-title" style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 24px;">Temukan teman seperjalanan.</h2>
          <p class="directory-subtitle" style="color: rgb(94, 127, 163); font-weight: 400; font-style: normal; font-size: 16px;">Jelajahi profil alumni, bidang karier, dan domisili mereka.</p>
        </div>
        <p id="result-count" aria-live="polite" class="result-count"></p>
      </div>

      <form id="filter-form" action="{{ route('alumni.index') }}" method="GET" class="filter-form reveal-onscroll" novalidate>
        <div class="filter-grid">
          <div class="icon-field">
            <label class="filter-label" for="search-input" style="color: rgb(49, 87, 127);">Cari alumni</label>
            <i data-lucide="search"></i>
            <input id="search-input" name="search" class="filter-control" type="search" autocomplete="off" placeholder="Cari nama atau profesi" value="{{ request('search') }}">
          </div>
          <div>
            <label class="filter-label" for="year-filter" style="color: rgb(49, 87, 127);">Angkatan</label>
            <select id="year-filter" name="generation" class="filter-control">
              <option value="">Semua angkatan</option>
              @foreach($generations as $year)
                <option value="{{ $year }}" {{ request('generation') == $year ? 'selected' : '' }}>{{ $year }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="filter-label" for="city-filter" style="color: rgb(49, 87, 127);">Kota domisili</label>
            <select id="city-filter" name="city" class="filter-control">
              <option value="">Semua kota</option>
              @foreach($cities as $city)
                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
              @endforeach
            </select>
          </div>
          <button id="search-button" class="cari-button" type="button">Cari</button>
          <button id="reset-button" class="reset-button" type="button" style="background: rgb(255, 255, 255); color: rgb(46, 117, 221);">Reset</button>
        </div>
      </form>

      <div id="start-state" class="empty-state start-state reveal-onscroll">
        <p class="start-state-text">Silakan ketik nama alumni atau pilih angkatan pada kolom pencarian di atas untuk mulai mencari.</p>
      </div>

      <div id="alumni-grid" class="alumni-grid hidden">
        @foreach($alumni as $item)
          <article class="directory-card reveal-onscroll"
                   data-name="{{ $item->user->name }}"
                   data-year="{{ $item->graduation_year }}"
                   data-city="{{ $item->city }}"
                   data-search="{{ strtolower($item->user->name.' '.$item->profession) }}">
            <div class="card-top-row">
              @php
                $words = preg_split('/\s+/', trim($item->user->name));
                $initials = strtoupper(mb_substr($words[0] ?? '', 0, 1) . mb_substr($words[1] ?? '', 0, 1));
                $hasAvatarFile = !empty($item->avatar) && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->avatar);
              @endphp
              @if($hasAvatarFile)
                <img class="card-avatar" loading="lazy"
                     src="{{ asset('storage/'.$item->avatar) }}"
                     alt="Foto profil {{ $item->user->name }}"
                     onerror="this.replaceWith(Object.assign(document.createElement('div'),{className:'card-avatar avatar-initial',textContent:'{{ $initials }}'}))">
              @else
                <div class="card-avatar avatar-initial" aria-label="Foto profil {{ $item->user->name }}">
                  {{ $initials }}
                </div>
              @endif

              @if($item->graduation_year)
                <span class="badge">Angkatan {{ $item->graduation_year }}</span>
              @endif
            </div>

            <a class="card-name-link" href="{{ route('alumni.show', $item->slug ?? $item->id) }}">{{ $item->user->name }}</a>
            <p class="card-role">{{ $item->profession ?? '-' }}</p>

            @if($item->city)
              <p class="meta-row"><i data-lucide="map-pin" width="14"></i> {{ $item->city }}</p>
            @endif

            @if($item->bio)
              <p class="card-quote">“{{ \Illuminate\Support\Str::limit($item->bio, 60) }}”</p>
            @endif

            <a class="profile-link" href="{{ route('alumni.show', $item->slug ?? $item->id) }}">
              Lihat Profil <i data-lucide="arrow-right" width="15"></i>
            </a>
          </article>
        @endforeach
      </div>

      <div id="empty-state" class="empty-state hidden reveal-onscroll">
        <div class="empty-emoji" aria-hidden="true">🔎</div>
        <h3 style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 19px;">Belum ada alumni yang cocok</h3>
        <p style="color: rgb(94, 127, 163); font-weight: 400; font-style: normal; font-size: 16px; margin-top: .5rem;">Coba gunakan kata kunci lain atau reset filter untuk melihat semua alumni.</p>
      </div>
    </div>
  </section>
</main>

<div class="footer-spacer"></div>
<x-user-footer />

<div id="toast" class="toast" role="status" aria-live="polite">
  <i data-lucide="sparkles" width="19"></i>
  <span id="toast-text"></span>
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
                <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup"><i
                        data-lucide="x" width="16" height="16"></i></button>
            </div>
            <p class="wa-bubble-text">Hubungi pengurus kami via WhatsApp 👋</p>
            <p class="wa-bubble-number">+62 812-3456-7890</p>
        </div>
        <a id="wa-button" href="https://wa.me/6281234567890?text=Halo" target="_blank"
            rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
            <i data-lucide="message-circle" width="26" height="26"></i>
        </a>
    </div>
</div>
<script src="{{ asset('js/script.js') }}"></script>
<script>
  const searchInput = document.getElementById("search-input");
  const searchButton = document.getElementById("search-button");
  const yearFilter = document.getElementById("year-filter");
  const cityFilter = document.getElementById("city-filter");
  const grid = document.getElementById("alumni-grid");
  const resultCount = document.getElementById("result-count");
  const emptyState = document.getElementById("empty-state");
  const startState = document.getElementById("start-state");
  let totalCount = {{ $totalActiveAlumni ?? $alumni->count() }};
  let toastTimer;
  let searchDebounceTimer;
  let activeAbortController = null;

  function hasActiveQuery() {
    return searchInput.value.trim() !== "" || yearFilter.value !== "" || cityFilter.value !== "";
  }

  function escapeHtml(text) {
    if (!text) return "";
    return text.toString()
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  function buildCardHtml(item) {
    const avatarHtml = item.avatar_url
      ? `<img class="card-avatar" loading="lazy" src="${escapeHtml(item.avatar_url)}" alt="Foto profil ${escapeHtml(item.name)}" onerror="this.replaceWith(Object.assign(document.createElement('div'),{className:'card-avatar avatar-initial',textContent:'${escapeHtml(item.initials)}'}))">`
      : `<div class="card-avatar avatar-initial" aria-label="Foto profil ${escapeHtml(item.name)}">${escapeHtml(item.initials)}</div>`;

    const badgeHtml = item.graduation_year
      ? `<span class="badge">Angkatan ${escapeHtml(item.graduation_year)}</span>`
      : ``;

    const cityHtml = item.city
      ? `<p class="meta-row"><i data-lucide="map-pin" width="14"></i> ${escapeHtml(item.city)}</p>`
      : ``;

    const quoteHtml = item.bio
      ? `<p class="card-quote">“${escapeHtml(item.bio)}”</p>`
      : ``;

    return `
      <article class="directory-card reveal-onscroll"
               data-name="${escapeHtml(item.name)}"
               data-year="${escapeHtml(item.graduation_year || '')}"
               data-city="${escapeHtml(item.city || '')}"
               data-search="${escapeHtml(((item.name || '') + ' ' + (item.profession || '')).toLowerCase())}">
        <div class="card-top-row">
          ${avatarHtml}
          ${badgeHtml}
        </div>
        <a class="card-name-link" href="${escapeHtml(item.profile_url)}">${escapeHtml(item.name)}</a>
        <p class="card-role">${escapeHtml(item.profession || '-')}</p>
        ${cityHtml}
        ${quoteHtml}
        <a class="profile-link" href="${escapeHtml(item.profile_url)}">
          Lihat Profil <i data-lucide="arrow-right" width="15"></i>
        </a>
      </article>
    `;
  }

  async function performRealtimeSearch(animate = true) {
    if (!hasActiveQuery()) {
      grid.innerHTML = "";
      grid.classList.add("hidden");
      emptyState.classList.add("hidden");
      startState.classList.remove("hidden");
      resultCount.textContent = "";
      return;
    }

    startState.classList.add("hidden");

    if (activeAbortController) {
      activeAbortController.abort();
    }
    activeAbortController = new AbortController();

    const params = new URLSearchParams();
    if (searchInput.value.trim()) params.append("search", searchInput.value.trim());
    if (yearFilter.value) params.append("generation", yearFilter.value);
    if (cityFilter.value) params.append("city", cityFilter.value);

    const newRelativePathQuery = window.location.pathname + (params.toString() ? "?" + params.toString() : "");
    window.history.replaceState(null, "", newRelativePathQuery);

    try {
      const response = await fetch(`{{ route('alumni.index') }}?${params.toString()}`, {
        headers: {
          "Accept": "application/json",
          "X-Requested-With": "XMLHttpRequest"
        },
        signal: activeAbortController.signal
      });

      if (!response.ok) throw new Error("Network response was not ok");
      const result = await response.json();

      if (result.total_active !== undefined) {
        totalCount = result.total_active;
      }

      const items = result.data || [];

      if (items.length === 0) {
        grid.innerHTML = "";
        grid.classList.add("hidden");
        emptyState.classList.remove("hidden");
        resultCount.textContent = `0 dari ${totalCount} alumni ditemukan`;
      } else {
        emptyState.classList.add("hidden");
        grid.classList.remove("hidden");
        grid.innerHTML = items.map(buildCardHtml).join("");
        resultCount.textContent = `${items.length} dari ${totalCount} alumni ditemukan`;

        if (animate) {
          const newCards = grid.querySelectorAll(".directory-card");
          newCards.forEach((card, index) => {
            card.style.animation = `cardIn .42s ${index * 35}ms both`;
          });
        }
        lucide.createIcons();
      }
    } catch (err) {
      if (err.name === "AbortError") return;
      console.error("Gagal memuat data pencarian alumni:", err);
    }
  }

  function showToast(message) {
    document.getElementById("toast-text").textContent = message;
    const toast = document.getElementById("toast");
    toast.classList.add("is-visible");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove("is-visible"), 3400);
  }

  document.getElementById("filter-form").addEventListener("submit", event => {
    event.preventDefault();
    performRealtimeSearch();
  });

  searchButton.addEventListener("click", () => performRealtimeSearch());

  searchInput.addEventListener("keydown", event => {
    if (event.key === "Enter") {
      event.preventDefault();
      performRealtimeSearch();
    }
  });

  searchInput.addEventListener("input", () => {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
      performRealtimeSearch();
    }, 280);
  });

  [yearFilter, cityFilter].forEach(control => {
    control.addEventListener("change", () => performRealtimeSearch());
  });

  document.getElementById("reset-button").addEventListener("click", () => {
    searchInput.value = "";
    yearFilter.value = "";
    cityFilter.value = "";
    window.history.replaceState(null, "", window.location.pathname);
    performRealtimeSearch();
    showToast("Filter sudah dikembalikan ke awal.");
  });

  if (hasActiveQuery()) {
    performRealtimeSearch(false);
  } else {
    grid.classList.add("hidden");
    startState.classList.remove("hidden");
  }

  lucide.createIcons();
</script>

</body>
</html>
