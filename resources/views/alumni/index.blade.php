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
</head>
<body class="alumni-page-body" data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}" style="background: #f7fbff;">

<x-navbar />

<main>
  <section class="hero-section dot-grid" style="background: linear-gradient(135deg, rgb(234, 244, 255), rgb(255, 254, 249));">
    <span class="hero-shape shape-pink"></span>
    <span class="hero-shape shape-yellow"></span>
    <span class="hero-shape shape-mint"></span>
    <div class="hero-container">
      <div class="hero-grid">
        <div class="hero-left">
          <p class="hero-eyebrow" style="background: rgb(255, 240, 168); color: rgb(49, 87, 127); font-weight: 700; font-style: normal; font-size: 16px;">✦ Alumni Space · ruang temu lintas angkatan</p>
          <h1 class="hero-title" style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 32px;">Kita tetap tumbuh, bersama.</h1>
          <p class="hero-subtitle" style="color: rgb(80, 117, 155); font-weight: 400; font-style: normal; font-size: 18px; line-height: 1.55;">Temukan kembali teman seperjalanan, bagikan cerita, dan rayakan langkah baik dari komunitas alumni kita.</p>
          <a href="#direktori" class="hero-cta" style="background: rgb(46, 117, 221); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lihat direktori</a>

          <div class="hero-stats">
            <div class="stat-card" style="background: rgb(255, 255, 255);">
              <p class="stat-label">Alumni terdaftar</p>
              <p class="stat-value">{{ $alumni->count() }}</p>
            </div>
            <div class="stat-card" style="background: rgb(255, 240, 168);">
              <p class="stat-label">Rentang angkatan</p>
              <p class="stat-value">
                @if($alumni->count())
                  {{ $alumni->min('graduation_year') }}–{{ $alumni->max('graduation_year') }}
                @else
                  -
                @endif
              </p>
            </div>
            <div class="stat-card" style="background: rgb(204, 239, 227);">
              <p class="stat-label">Kota terhubung</p>
              <p class="stat-value">{{ $alumni->pluck('city')->filter()->unique()->count() }}</p>
            </div>
          </div>
        </div>

        <div class="hero-photo-outer">
          <div class="hero-decor-1" aria-hidden="true">✦</div>
          <div class="hero-decor-2" aria-hidden="true">✿</div>
          <div class="hero-photo-frame">
            <img loading="lazy" src="https://images.pexels.com/photos/7683745/pexels-photo-7683745.jpeg" alt="A happy group of diverse college students posing cheerfully outside a modern building.">
          </div>
          <div class="hero-note" style="background: rgb(255, 240, 168); color: rgb(49, 87, 127);"><span aria-hidden="true">👋</span> Temukan teman seperjalananmu</div>
        </div>
      </div>
    </div>
  </section>

  <section id="direktori" class="directory-section">
    <div id="directory-shell" class="directory-shell">
      <div class="directory-header">
        <div>
          <p class="directory-eyebrow" style="background: rgb(255, 220, 233); color: rgb(135, 81, 108); font-weight: 800; font-style: normal; font-size: 16px;">DIREKTORI ALUMNI</p>
          <h2 class="directory-title" style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 24px;">Temukan teman seperjalanan.</h2>
          <p class="directory-subtitle" style="color: rgb(94, 127, 163); font-weight: 400; font-style: normal; font-size: 16px;">Jelajahi profil alumni, bidang karier, dan domisili mereka.</p>
        </div>
        <p id="result-count" aria-live="polite" class="result-count"></p>
      </div>

      <form id="filter-form" class="filter-form" novalidate>
        <div class="filter-grid">
          <div class="icon-field">
            <label class="filter-label" for="search-input" style="color: rgb(49, 87, 127);">Cari alumni</label>
            <i data-lucide="search"></i>
            <input id="search-input" class="filter-control" type="search" autocomplete="off" placeholder="Cari nama atau profesi">
          </div>
          <div>
            <label class="filter-label" for="year-filter" style="color: rgb(49, 87, 127);">Angkatan</label>
            <select id="year-filter" class="filter-control">
              <option value="">Semua angkatan</option>
              @foreach($alumni->pluck('graduation_year')->filter()->unique()->sort() as $year)
                <option value="{{ $year }}">{{ $year }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="filter-label" for="city-filter" style="color: rgb(49, 87, 127);">Kota domisili</label>
            <select id="city-filter" class="filter-control">
              <option value="">Semua kota</option>
              @foreach($alumni->pluck('city')->filter()->unique()->sort() as $city)
                <option value="{{ $city }}">{{ $city }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="filter-label" for="sort-filter" style="color: rgb(49, 87, 127);">Urutkan</label>
            <select id="sort-filter" class="filter-control">
              <option value="default">Urutan awal</option>
              <option value="name-asc">Nama A–Z</option>
              <option value="year-asc">Angkatan terlama</option>
              <option value="year-desc">Angkatan terbaru</option>
            </select>
          </div>
          <button id="reset-button" class="reset-button" type="button" style="background: rgb(255, 255, 255); color: rgb(46, 117, 221);">Reset</button>
        </div>
      </form>

      <div id="alumni-grid" class="alumni-grid">
        @foreach($alumni as $item)
          <article class="directory-card"
                   data-name="{{ $item->user->name }}"
                   data-year="{{ $item->graduation_year }}"
                   data-city="{{ $item->city }}"
                   data-search="{{ strtolower($item->user->name.' '.$item->profession) }}">
            <div class="card-top-row">
              <img class="card-avatar" loading="lazy"
                   src="{{ $item->avatar ? asset('storage/'.$item->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($item->user->name).'&background=eaf4ff&color=2e75dd&size=200' }}"
                   alt="Foto profil {{ $item->user->name }}">
              @if($item->graduation_year)
                <span class="badge">Angkatan {{ $item->graduation_year }}</span>
              @endif
            </div>

            <a class="card-name-link" href="{{ route('alumni.show', $item->slug) }}">{{ $item->user->name }}</a>
            <p class="card-role">{{ $item->profession ?? '-' }}</p>

            @if($item->city)
              <p class="meta-row"><i data-lucide="map-pin" width="14"></i> {{ $item->city }}</p>
            @endif

            @if($item->bio)
              <p class="card-quote">“{{ \Illuminate\Support\Str::limit($item->bio, 60) }}”</p>
            @endif

            <a class="profile-link" href="{{ route('alumni.show', $item->slug) }}">
              Lihat Profil <i data-lucide="arrow-right" width="15"></i>
            </a>
          </article>
        @endforeach
      </div>

      <div id="empty-state" class="empty-state hidden">
        <div class="empty-emoji" aria-hidden="true">🔎</div>
        <h3 style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 19px;">Belum ada alumni yang cocok</h3>
        <p style="color: rgb(94, 127, 163); font-weight: 400; font-style: normal; font-size: 16px; margin-top: .5rem;">Coba gunakan kata kunci lain atau reset filter untuk melihat semua alumni.</p>
      </div>
    </div>
  </section>
</main>

<div class="footer-spacer"></div>
<x-footer />

<div id="toast" class="toast" role="status" aria-live="polite">
  <i data-lucide="sparkles" width="19"></i>
  <span id="toast-text"></span>
</div>
<script src="{{ asset('js/script.js') }}"></script>
<script>
  const searchInput = document.getElementById("search-input");
  const yearFilter = document.getElementById("year-filter");
  const cityFilter = document.getElementById("city-filter");
  const sortFilter = document.getElementById("sort-filter");
  const grid = document.getElementById("alumni-grid");
  const resultCount = document.getElementById("result-count");
  const emptyState = document.getElementById("empty-state");
  const cards = Array.from(grid.querySelectorAll(".directory-card"));
  const totalCount = cards.length;
  let toastTimer;

  function getFilteredCards() {
    const query = searchInput.value.trim().toLocaleLowerCase("id");
    const year = yearFilter.value;
    const city = cityFilter.value;

    let filtered = cards.filter(card => {
      const matchingText = !query || card.dataset.search.includes(query);
      const matchingYear = !year || card.dataset.year === year;
      const matchingCity = !city || card.dataset.city === city;
      return matchingText && matchingYear && matchingCity;
    });

    if (sortFilter.value === "name-asc") {
      filtered.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name, "id"));
    }
    if (sortFilter.value === "year-asc") {
      filtered.sort((a, b) => Number(a.dataset.year) - Number(b.dataset.year) || a.dataset.name.localeCompare(b.dataset.name, "id"));
    }
    if (sortFilter.value === "year-desc") {
      filtered.sort((a, b) => Number(b.dataset.year) - Number(a.dataset.year) || a.dataset.name.localeCompare(b.dataset.name, "id"));
    }
    return filtered;
  }

  function renderDirectory() {
    const filtered = getFilteredCards();
    const visibleSet = new Set(filtered);

    cards.forEach(card => {
      card.hidden = !visibleSet.has(card);
    });

    filtered.forEach((card, index) => {
      card.style.animation = "none";
      grid.appendChild(card);
      requestAnimationFrame(() => {
        card.style.animation = `cardIn .42s ${index * 35}ms both`;
      });
    });

    resultCount.textContent = `${filtered.length} dari ${totalCount} alumni ditemukan`;
    emptyState.classList.toggle("hidden", filtered.length !== 0);
  }

  function showToast(message) {
    document.getElementById("toast-text").textContent = message;
    const toast = document.getElementById("toast");
    toast.classList.add("is-visible");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove("is-visible"), 3400);
  }

  document.getElementById("filter-form").addEventListener("submit", event => event.preventDefault());
  [searchInput, yearFilter, cityFilter, sortFilter].forEach(control => {
    control.addEventListener(control === searchInput ? "input" : "change", renderDirectory);
  });

  document.getElementById("reset-button").addEventListener("click", () => {
    searchInput.value = "";
    yearFilter.value = "";
    cityFilter.value = "";
    sortFilter.value = "default";
    renderDirectory();
    showToast("Filter sudah dikembalikan ke awal.");
  });

  renderDirectory();
  lucide.createIcons();
</script>

</body>
</html>
