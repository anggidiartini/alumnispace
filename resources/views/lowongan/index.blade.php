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
              <article class="preview-card floaty">
                <div class="preview-top">
                  <div class="preview-monogram">RK</div>
                  <span class="job-badge" style="background:var(--yellow); color:var(--ink);">Remote</span>
                </div>
                <h2 style="margin:0; font-size:1.4rem;">Product Designer</h2>
                <p style="margin:.4rem 0 0; color:#355277; font-weight:700;">Ruang Kreatif · Jakarta</p>
                <div class="progress-track" aria-hidden="true">
                  <div class="progress-bar"></div>
                </div>
              </article>
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
                  <option value="Ruang Kreatif">Ruang Kreatif</option>
                  <option value="Nusantara Labs">Nusantara Labs</option>
                  <option value="Kawan Studio">Kawan Studio</option>
                  <option value="Satu Data">Satu Data</option>
                  <option value="Pasar Hijau">Pasar Hijau</option>
                  <option value="Orbit People">Orbit People</option>
                </select>
              </div>

              <div>
                <label class="field-label" for="location-filter">Lokasi</label>
                <select id="location-filter" class="field-control">
                  <option value="">Semua Lokasi</option>
                  <option value="Jakarta">Jakarta</option>
                  <option value="Bandung">Bandung</option>
                  <option value="Remote">Remote</option>
                  <option value="Surabaya">Surabaya</option>
                  <option value="Yogyakarta">Yogyakarta</option>
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
              <article class="job-card reveal-onscroll" data-company="Ruang Kreatif" data-location="Jakarta" data-type="Full-Time" data-search="product designer ruang kreatif jakarta full time desain produk aplikasi digital">
                <div class="job-card-head">
                  <span class="job-badge">Desain</span><span class="job-symbol">✳</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/product-designer">Product Designer</a>
                <a class="company-link" href="/lowongan/detail/product-designer">Ruang Kreatif</a>
                <p class="job-meta">Jakarta · Full-Time · 2 hari lalu</p>
                <p class="job-description">Rancang pengalaman produk digital yang hangat dan mudah digunakan.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/product-designer">Lamar</a>
              </article>

              <article class="job-card reveal-onscroll" style="transition-delay:.05s" data-company="Nusantara Labs" data-location="Bandung" data-type="Remote" data-search="frontend developer nusantara labs bandung remote react javascript teknologi">
                <div class="job-card-head">
                  <span class="job-badge">Teknologi</span><span class="job-symbol">⌘</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/frontend-developer">Frontend Developer</a>
                <a class="company-link" href="/lowongan/detail/frontend-developer">Nusantara Labs</a>
                <p class="job-meta">Bandung · Remote · 3 hari lalu</p>
                <p class="job-description">Bangun antarmuka web cepat dan rapi bersama tim produk kolaboratif.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/frontend-developer">Lamar</a>
              </article>

              <article class="job-card reveal-onscroll" style="transition-delay:.1s" data-company="Kawan Studio" data-location="Jakarta" data-type="Full-Time" data-search="community manager kawan studio jakarta full time komunitas event engagement">
                <div class="job-card-head">
                  <span class="job-badge">Komunitas</span><span class="job-symbol">☻</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/community-manager">Community Manager</a>
                <a class="company-link" href="/lowongan/detail/community-manager">Kawan Studio</a>
                <p class="job-meta">Jakarta · Full-Time · 4 hari lalu</p>
                <p class="job-description">Rawat percakapan, program, dan hubungan bermakna di komunitas kreatif.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/community-manager">Lamar</a>
              </article>

              <article class="job-card reveal-onscroll" data-company="Satu Data" data-location="Remote" data-type="Full-Time" data-search="data analyst satu data remote full time sql dashboard insight bisnis">
                <div class="job-card-head">
                  <span class="job-badge">Data</span><span class="job-symbol">◫</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/data-analyst">Data Analyst</a>
                <a class="company-link" href="/lowongan/detail/data-analyst">Satu Data</a>
                <p class="job-meta">Remote · Full-Time · 5 hari lalu</p>
                <p class="job-description">Ubah data menjadi insight untuk keputusan bisnis yang lebih baik.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/data-analyst">Lamar</a>
              </article>

              <article class="job-card reveal-onscroll" style="transition-delay:.05s" data-company="Pasar Hijau" data-location="Yogyakarta" data-type="Freelance" data-search="copywriter pasar hijau yogyakarta freelance konten brand kampanye">
                <div class="job-card-head">
                  <span class="job-badge">Konten</span><span class="job-symbol">✎</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/copywriter">Copywriter</a>
                <a class="company-link" href="/lowongan/detail/copywriter">Pasar Hijau</a>
                <p class="job-meta">Yogyakarta · Freelance · 1 hari lalu</p>
                <p class="job-description">Ciptakan suara brand yang segar untuk kampanye produk ramah lingkungan.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/copywriter">Lamar</a>
              </article>

              <article class="job-card reveal-onscroll" style="transition-delay:.1s" data-company="Ruang Kreatif" data-location="Remote" data-type="Full-Time" data-search="ux researcher ruang kreatif remote full time riset pengguna produk">
                <div class="job-card-head">
                  <span class="job-badge">Riset</span><span class="job-symbol">◉</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/ux-researcher">UX Researcher</a>
                <a class="company-link" href="/lowongan/detail/ux-researcher">Ruang Kreatif</a>
                <p class="job-meta">Remote · Full-Time · 6 hari lalu</p>
                <p class="job-description">Temukan kebutuhan pengguna melalui riset yang tajam dan penuh empati.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/ux-researcher">Lamar</a>
              </article>

              <article class="job-card reveal-onscroll" data-company="Orbit People" data-location="Surabaya" data-type="Full-Time" data-search="hr specialist orbit people surabaya full time sumber daya manusia rekrutmen">
                <div class="job-card-head">
                  <span class="job-badge">People</span><span class="job-symbol">♡</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/hr-specialist">HR Specialist</a>
                <a class="company-link" href="/lowongan/detail/hr-specialist">Orbit People</a>
                <p class="job-meta">Surabaya · Full-Time · 1 minggu lalu</p>
                <p class="job-description">Bangun pengalaman kandidat dan karyawan yang bertumbuh bersama.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/hr-specialist">Lamar</a>
              </article>

              <article class="job-card reveal-onscroll" style="transition-delay:.05s" data-company="Nusantara Labs" data-location="Jakarta" data-type="Magang" data-search="social media strategist nusantara labs jakarta magang konten kampanye digital">
                <div class="job-card-head">
                  <span class="job-badge">Media Sosial</span><span class="job-symbol">✦</span>
                </div>
                <a class="job-title-link" href="/lowongan/detail/social-media-strategist">Social Media Strategist</a>
                <a class="company-link" href="/lowongan/detail/social-media-strategist">Nusantara Labs</a>
                <p class="job-meta">Jakarta · Magang · 1 hari lalu</p>
                <p class="job-description">Kembangkan strategi sosial yang relevan, ceria, dan berbasis komunitas.</p>
                <a class="apply-button custom-pill-btn" href="/lowongan/detail/social-media-strategist">Lamar</a>
              </article>
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

      // ---------- filter lowongan, dengan fade halus (bukan hilang instan) ----------
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
            // beri 1 frame supaya transisi fade-in kepakai
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

      // ---------- scroll reveal, sama seperti home ----------
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

      // ---------- back to top ----------
      var backToTop = document.getElementById("back-to-top");
      window.addEventListener("scroll", function () {
        backToTop.classList.toggle("show", window.scrollY > 400);
      }, { passive: true });
      backToTop.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });

      // ---------- WhatsApp bubble ----------
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
