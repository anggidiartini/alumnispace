<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni Space Career Hub</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/home.css')) : time() }}">
  <link rel="stylesheet" href="{{ asset('css/lowongan.css') }}?v={{ file_exists(public_path('css/lowongan.css')) ? filemtime(public_path('css/lowongan.css')) : time() }}">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
</head>
<body>
  <div class="site-shell page-wrap">
    <x-navbar />

    <main>
      <!-- HERO -->
      <section class="hero-section grid-paper" aria-labelledby="hero-title">
        <div class="blob blob-drift" style="position:absolute; left:-4rem; top:1rem; width:9rem; height:9rem; background:var(--pink); opacity:.7; z-index:0;" aria-hidden="true"></div>
        <span class="hero-orb hero-orb-yellow spin-slow" aria-hidden="true"></span>
        <span class="hero-orb hero-orb-pink" aria-hidden="true"></span>
        <span class="hero-star wiggle" aria-hidden="true">✦</span>

        <div class="page-width hero-layout">
          <div class="hero-copy reveal-onscroll">
            <p class="eyebrow">ALUMNI SPACE CAREER HUB</p>
            <h1 id="hero-title" class="hero-title">Temukan langkah karier berikutnya</h1>
            <p class="hero-description">Temukan peluang kerja yang relevan dari perusahaan terpercaya — dibagikan khusus untuk komunitas alumni yang terus bertumbuh.</p>
            <a class="custom-pill-btn" href="#jobs-title" style="margin-top:2rem;">Jelajahi Lowongan</a>

            <div class="social-proof">
              <div class="avatar-stack" aria-hidden="true">
                <span class="avatar-dot"></span>
                <span class="avatar-dot"></span>
                <span class="avatar-dot"></span>
              </div>
              <span>Peluang baru setiap minggu</span>
            </div>
          </div>

          <div class="hero-board reveal-onscroll" style="transition-delay:.12s" aria-label="Sorotan lowongan">
            <div class="checker blob" style="position:absolute; inset:0; opacity:.5; z-index:0;" aria-hidden="true"></div>
            <div class="preview-wrap">
              <div class="preview-label">PILIHAN MINGGU INI</div>
              @if($jobs->count())
                @php $featured = $jobs->first(); @endphp
                <article class="preview-card floaty">
                  <div class="preview-top">
                    <div class="preview-monogram">{{ $featured->initials }}</div>
                    <span class="job-badge" style="background:var(--yellow); color:var(--ink);">{{ $featured->job_type }}</span>
                  </div>
                  <h2 style="margin:0; font-size:1.4rem;">{{ $featured->title }}</h2>
                  <p style="margin:.4rem 0 0; color:#355277; font-weight:700;">{{ $featured->company_name }} · {{ $featured->location }}</p>
                  <div class="progress-track" aria-hidden="true">
                    <div class="progress-bar"></div>
                  </div>
                </article>
              @endif
              <div class="hero-note wiggle">Ada peluang baru!</div>
            </div>
          </div>
        </div>
      </section>

      <!-- JOBS -->
      <section class="page-width jobs-section" aria-labelledby="jobs-title">
        <div class="section-heading reveal-onscroll">
          <div>
            <p class="section-kicker">Papan peluang</p>
            <h2 id="jobs-title" class="section-title">Lowongan aktif untukmu</h2>
          </div>
          <span class="jobs-note">Diperbarui secara berkala</span>
        </div>

        <div class="jobs-layout">
          <!-- Filter kategori tetap di kiri, sticky mengikuti scroll -->
          <aside class="filter-panel reveal-onscroll" aria-label="Filter lowongan">
            <div class="filter-panel-heading">
              <h3 style="margin:0; font-size:1.15rem;">Filter Lowongan</h3>
              <i data-lucide="sliders-horizontal" width="19" height="19"></i>
            </div>
            <form class="filter-form" id="filter-form">
              <div>
                <label class="field-label" for="search-input">Cari peluang</label>
                <div class="search-wrap">
                  <i data-lucide="search" width="18" height="18"></i>
                  <input id="search-input" class="field-control" type="search" placeholder="Cari posisi atau kata kunci">
                </div>
              </div>

              <div>
                <label class="field-label" for="company-filter">Perusahaan</label>
                <select id="company-filter" class="field-control">
                  <option value="">Semua Perusahaan</option>
                  @foreach ($jobs->pluck('company_name')->unique() as $company)
                    <option value="{{ $company }}">{{ $company }}</option>
                  @endforeach
                </select>
              </div>

              <div>
                <label class="field-label" for="location-filter">Lokasi</label>
                <select id="location-filter" class="field-control">
                  <option value="">Semua Lokasi</option>
                  @foreach ($jobs->pluck('location')->filter()->unique() as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                  @endforeach
                </select>
              </div>

              <div>
                <p class="field-label">Kategori cepat</p>
                <div class="chip-list">
                  <button class="filter-chip" data-type="Full-Time" type="button">Full-Time</button>
                  <button class="filter-chip" data-type="Remote" type="button">Remote</button>
                  <button class="filter-chip" data-type="Freelance" type="button">Freelance</button>
                  <button class="filter-chip" data-type="Magang" type="button">Magang</button>
                </div>
              </div>

              <button id="reset-filter" class="reset-button" type="button" style="width:100%;">Reset Filter</button>
            </form>
          </aside>

          <div>
            <div class="results-header reveal-onscroll">
              <p id="results-count" class="results-count" aria-live="polite"></p>
              <p id="filter-summary" class="filter-summary" aria-live="polite"></p>
            </div>

            <div id="jobs-grid" class="jobs-grid">
              @foreach ($jobs as $i => $job)
                <article class="job-card reveal-onscroll"
                  style="transition-delay: {{ ($i % 3) * 0.05 }}s"
                  data-company="{{ $job->company_name }}"
                  data-location="{{ $job->location }}"
                  data-type="{{ $job->job_type }}"
                  data-search="{{ strtolower($job->title . ' ' . $job->company_name . ' ' . $job->location . ' ' . $job->job_type) }}">
                  <div class="job-card-head">
                    <span class="job-badge">{{ $job->category }}</span><span class="job-symbol">✳</span>
                  </div>
                  <a class="job-title-link" href="{{ route('lowongan.show', $job->slug) }}">{{ $job->title }}</a>
                  <a class="company-link" href="{{ route('lowongan.show', $job->slug) }}">{{ $job->company_name }}</a>
                  <p class="job-meta">{{ $job->location }} · {{ $job->job_type }} · {{ $job->created_at->diffForHumans() }}</p>
                  <p class="job-description">{{ \Illuminate\Support\Str::limit($job->description, 100) }}</p>
                  <a class="apply-button custom-pill-btn" href="{{ route('lowongan.show', $job->slug) }}#lamar">Lamar</a>
                </article>
              @endforeach
            </div>

            <section id="empty-state" class="empty-state" aria-live="polite">
              <div class="empty-icon">⌕</div>
              <h3 style="margin:1rem 0 0;">Belum ada lowongan yang cocok</h3>
              <p style="color:#355277;">Coba gunakan kata kunci lain atau atur ulang filter untuk melihat semua peluang.</p>
              <button id="empty-reset" class="custom-pill-btn" type="button" style="margin-top:1rem;">Reset Filter</button>
            </section>

            <section class="ticket-banner reveal-onscroll">
              <span class="ticket-divider" aria-hidden="true"></span>
              <div class="ticket-content">
                <div class="ticket-copy">
                  <p class="section-kicker" style="color:var(--yellow);">PANGGILAN KOMUNITAS</p>
                  <h2 class="ticket-title">Bagikan peluang untuk sesama alumni</h2>
                  <p class="ticket-description">Kenalkan posisi terbuka di perusahaanmu dan bantu alumni lain menemukan langkah berikutnya.</p>
                </div>
                <a class="ticket-cta" href="/lowongan">Lihat Lowongan</a>
              </div>
            </section>
          </div>
        </div>
      </section>
    </main>

    <x-footer />
  </div>

  <!-- Floating action buttons: sekarang murni pakai class, disamakan dgn home -->
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
        <p class="wa-bubble-text">Hubungi pengurus alumni kami via WhatsApp 👋</p>
        <p class="wa-bubble-number">+62 812-3456-7890</p>
      </div>
      <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20Alumni%20Space" target="_blank" rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
        <i data-lucide="message-circle" width="26" height="26"></i>
      </a>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var searchInput = document.getElementById("search-input");
      var companyFilter = document.getElementById("company-filter");
      var locationFilter = document.getElementById("location-filter");
      var resetButton = document.getElementById("reset-filter");
      var emptyResetButton = document.getElementById("empty-reset");
      var cards = Array.prototype.slice.call(document.querySelectorAll(".job-card"));
      var chips = Array.prototype.slice.call(document.querySelectorAll(".filter-chip"));
      var emptyState = document.getElementById("empty-state");
      var resultCount = document.getElementById("results-count");
      var filterSummary = document.getElementById("filter-summary");
      var activeType = "";
      var fadeTimers = new WeakMap();

      function filterJobs() {
        var query = searchInput.value.trim().toLowerCase();
        var company = companyFilter.value;
        var location = locationFilter.value;
        var count = 0;

        cards.forEach(function (card) {
          var matchesQuery = !query || card.dataset.search.indexOf(query) !== -1;
          var matchesCompany = !company || card.dataset.company === company;
          var matchesLocation = !location || card.dataset.location === location;
          var matchesType = !activeType || card.dataset.type === activeType;
          var matches = matchesQuery && matchesCompany && matchesLocation && matchesType;

          if (fadeTimers.has(card)) {
            clearTimeout(fadeTimers.get(card));
            fadeTimers.delete(card);
          }

          if (matches) {
            card.classList.remove("is-hidden");
            requestAnimationFrame(function () { card.classList.remove("is-fading"); });
            count += 1;
          } else if (!card.classList.contains("is-hidden")) {
            card.classList.add("is-fading");
            var timer = setTimeout(function () {
              card.classList.add("is-hidden");
            }, 260);
            fadeTimers.set(card, timer);
          }
        });

        var filters = [];
        if (query) filters.push('"' + searchInput.value.trim() + '"');
        if (company) filters.push(company);
        if (location) filters.push(location);
        if (activeType) filters.push(activeType);

        resultCount.textContent = "Menampilkan " + count + " lowongan";
        filterSummary.textContent = filters.length ? "Filter: " + filters.join(" · ") : "Semua peluang aktif";
        emptyState.classList.toggle("is-visible", count === 0);
      }

      function resetFilters() {
        searchInput.value = "";
        companyFilter.value = "";
        locationFilter.value = "";
        activeType = "";

        chips.forEach(function (chip) {
          chip.classList.remove("is-active");
          chip.setAttribute("aria-pressed", "false");
        });

        filterJobs();
      }

      searchInput.addEventListener("input", filterJobs);
      companyFilter.addEventListener("change", filterJobs);
      locationFilter.addEventListener("change", filterJobs);

      chips.forEach(function (chip) {
        chip.setAttribute("aria-pressed", "false");
        chip.addEventListener("click", function () {
          activeType = activeType === chip.dataset.type ? "" : chip.dataset.type;
          chips.forEach(function (item) {
            var isActive = item.dataset.type === activeType;
            item.classList.toggle("is-active", isActive);
            item.setAttribute("aria-pressed", String(isActive));
          });
          filterJobs();
        });
      });

      resetButton.addEventListener("click", resetFilters);
      emptyResetButton.addEventListener("click", resetFilters);

      var revealEls = document.querySelectorAll(".reveal-onscroll");
      var revealObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("in-view");
            revealObserver.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15, rootMargin: "0px 0px -60px 0px" });
      revealEls.forEach(function (el, i) {
        if (!el.style.transitionDelay) {
          el.style.transitionDelay = (i % 3) * 0.1 + "s";
        }
        revealObserver.observe(el);
      });

      var backToTop = document.getElementById("back-to-top");
      window.addEventListener("scroll", function () {
        backToTop.classList.toggle("show", window.scrollY > 400);
      }, { passive: true });
      backToTop.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });

      var waButton = document.getElementById("wa-button");
      var waBubble = document.getElementById("wa-bubble");
      var waBubbleClose = document.getElementById("wa-bubble-close");
      var waTimer = setTimeout(function () { waBubble.classList.add("show"); }, 1800);

      waButton.addEventListener("mouseenter", function () {
        clearTimeout(waTimer);
        waBubble.classList.add("show");
      });
      waBubbleClose.addEventListener("click", function (e) {
        e.preventDefault();
        waBubble.classList.remove("show");
      });

      lucide.createIcons();
      filterJobs();
    });
  </script>
</body>
</html> 