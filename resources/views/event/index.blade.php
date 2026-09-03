<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Album Kenangan & Dokumentasi</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
  <link rel="stylesheet" href="{{ asset('css/event.css') }}?v={{ file_exists(public_path('css/event.css')) ? filemtime(public_path('css/event.css')) : time() }}">
</head>
<body>
  <div class="site-shell page-wrap">
    <x-navbar />

    <main>
      <!-- HERO -->
      <section id="beranda" class="hero-section grid-paper" aria-labelledby="hero-title">
        <div class="hero-blob-pink blob blob-drift" aria-hidden="true"></div>
        <span class="hero-orb-yellow spin-slow" aria-hidden="true"></span>
        <span class="hero-sparkle wiggle" aria-hidden="true">✦</span>

        <div class="page-width hero-layout">
          <div class="hero-copy reveal">
            <span class="badge-dashed-pill">
              <i data-lucide="sparkles" width="16" height="16"></i>
              Kumpulan cerita yang tak terlupa
            </span>
            <h1 id="hero-title" class="hero-title">Album Kenangan &amp; Dokumentasi</h1>
            <p class="hero-subtitle">Temukan dokumentasi event, momen berharga, dan cerita terbaik dari komunitas yang terus bertumbuh.</p>

            <div class="hero-actions">
              <button type="button" id="heroCta" class="custom-pill-btn focus-ring">
                Jelajahi Event
                <i data-lucide="arrow-down" width="16" height="16"></i>
              </button>
              <span class="hero-note">Pilih momen yang ingin kamu kenang</span>
            </div>

            <div class="hero-stats">
              <div class="stat-pill">
                <span class="stat-pill-number">36+</span>
                <span class="stat-pill-label">Event terdokumentasi</span>
              </div>
              <div class="stat-pill">
                <span class="stat-pill-number">4.8K</span>
                <span class="stat-pill-label">Momen tersimpan</span>
              </div>
              <div class="stat-pill">
                <span class="stat-pill-number">1.2K</span>
                <span class="stat-pill-label">Cerita komunitas</span>
              </div>
            </div>
          </div>

          <div class="hero-visual reveal delay-2">
            <div class="hero-photo-frame">
              <img loading="lazy" src="https://images.pexels.com/photos/708440/pexels-photo-708440.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Sekelompok anak muda tertawa bersama di luar ruangan pada siang hari">
              <div class="hero-photo-caption">
                <strong>Momen yang lebih dari sekadar hadir</strong>
                <span>Kembali rasakan energi, karya, dan kebersamaan kami.</span>
              </div>
            </div>
            <div class="hero-sticker floaty">Ada cerita baru!</div>
          </div>
        </div>
      </section>

      <!-- KATALOG EVENT -->
      <section id="event" class="page-width catalog" aria-labelledby="catalog-title">
        <div class="section-heading reveal-onscroll">
          <div>
            <p class="section-kicker">Katalog event</p>
            <h2 id="catalog-title" class="section-title">Temukan momen terbaik</h2>
            <p class="section-desc">Jelajahi agenda mendatang atau buka kembali dokumentasi dari momen yang sudah berlalu.</p>
          </div>
          <p id="resultCount" class="result-count" aria-live="polite"></p>
        </div>

        <div class="catalog-layout">
          <!-- Filter kategori & status, dipindah ke kiri sesuai gaya lowongan -->
          <aside class="filter-panel reveal-onscroll" aria-label="Filter event">
            <div class="filter-panel-heading">
              <h3 style="margin:0; font-size:1.15rem;">Filter Event</h3>
              <i data-lucide="sliders-horizontal" width="19" height="19"></i>
            </div>

            <div class="filter-group">
              <label class="filter-legend" for="eventSearchInput">Cari event</label>
              <div class="search-wrap">
                <i data-lucide="search" width="18" height="18"></i>
                <input id="eventSearchInput" class="field-control" type="search" placeholder="Cari nama event atau lokasi">
              </div>
            </div>

            <div class="filter-group">
              <span class="filter-legend">Pilih kategori</span>
              <div class="filter-row" id="categoryFilters">
                <button data-filter-category="all" type="button" class="filter-button is-active">Semua</button>
                <button data-filter-category="Seminar" type="button" class="filter-button">Seminar</button>
                <button data-filter-category="Workshop" type="button" class="filter-button">Workshop</button>
                <button data-filter-category="Gathering" type="button" class="filter-button">Gathering</button>
                <button data-filter-category="Festival" type="button" class="filter-button">Festival</button>
                <button data-filter-category="Kompetisi" type="button" class="filter-button">Kompetisi</button>
              </div>
            </div>

            <div class="filter-group">
              <span class="filter-legend">Status event</span>
              <div class="filter-row" id="statusFilters">
                <button data-filter-status="all" type="button" class="filter-button is-active">Semua status</button>
                <button data-filter-status="Upcoming" type="button" class="filter-button">Upcoming</button>
                <button data-filter-status="Completed" type="button" class="filter-button">Completed</button>
              </div>
            </div>
          </aside>

          <div>
            <div id="eventGrid" class="event-grid">

              <!-- Event 1 -->
              <article class="event-card reveal-onscroll" data-category="Workshop" data-status="Upcoming" data-search="kreatif lab ide jadi aksi workshop studio kreativa denpasar">
                <div class="event-card-media">
                  <img loading="lazy" src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Tim berkolaborasi dalam pertemuan kreatif di ruang kerja modern">
                  <span class="event-status upcoming">Upcoming</span>
                </div>
                <div class="event-card-body">
                  <div class="event-card-top">
                    <span class="event-category">Workshop</span>
                    <span class="event-quota">40 kuota</span>
                  </div>
                  <a class="event-title" href="/event/kreatif-lab-workshop" target="_blank" rel="noopener noreferrer">Kreatif Lab: Ide Jadi Aksi</a>
                  <p class="event-desc">Ruang praktik seru untuk merancang ide kreatif bersama mentor dan teman baru.</p>
                  <div class="event-meta">
                    <p class="event-meta-row"><i data-lucide="calendar" width="16" height="16"></i><span>18 September 2026</span></p>
                    <p class="event-meta-row"><i data-lucide="clock" width="16" height="16"></i><span>09.00 – 15.00 WITA</span></p>
                    <p class="event-meta-row"><i data-lucide="map-pin" width="16" height="16"></i><span>Studio Kreativa Denpasar</span></p>
                  </div>
                  <a class="event-detail-link focus-ring" href="/event/kreatif-lab-workshop" target="_blank" rel="noopener noreferrer">Lihat Detail</a>
                </div>
              </article>

              <!-- Event 2 -->
              <article class="event-card reveal-onscroll" style="transition-delay:.05s" data-category="Seminar" data-status="Upcoming" data-search="masa depan digital bali seminar aula dharma negara alaya">
                <div class="event-card-media">
                  <img loading="lazy" src="https://images.pexels.com/photos/2774556/pexels-photo-2774556.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Peserta duduk memperhatikan presentasi dalam konferensi indoor">
                  <span class="event-status upcoming">Upcoming</span>
                </div>
                <div class="event-card-body">
                  <div class="event-card-top">
                    <span class="event-category">Seminar</span>
                    <span class="event-quota">120 kuota</span>
                  </div>
                  <a class="event-title" href="/event/masa-depan-digital" target="_blank" rel="noopener noreferrer">Masa Depan Digital Bali</a>
                  <p class="event-desc">Obrolan inspiratif tentang inovasi, talenta, dan peluang di dunia digital.</p>
                  <div class="event-meta">
                    <p class="event-meta-row"><i data-lucide="calendar" width="16" height="16"></i><span>26 September 2026</span></p>
                    <p class="event-meta-row"><i data-lucide="clock" width="16" height="16"></i><span>13.00 – 17.00 WITA</span></p>
                    <p class="event-meta-row"><i data-lucide="map-pin" width="16" height="16"></i><span>Aula Dharma Negara Alaya</span></p>
                  </div>
                  <a class="event-detail-link focus-ring" href="/event/masa-depan-digital" target="_blank" rel="noopener noreferrer">Lihat Detail</a>
                </div>
              </article>

              <!-- Event 3 -->
              <article class="event-card reveal-onscroll" data-category="Gathering" data-status="Completed" data-search="reuni cerita kita 2026 gathering taman inspirasi mertasari">
                <div class="event-card-media">
                  <img loading="lazy" src="https://images.pexels.com/photos/708440/pexels-photo-708440.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Sekelompok teman muda menikmati waktu bersama di luar ruangan">
                  <span class="event-status completed">Completed</span>
                </div>
                <div class="event-card-body">
                  <div class="event-card-top">
                    <span class="event-category">Gathering</span>
                    <span class="event-quota">Kuota penuh</span>
                  </div>
                  <a class="event-title" href="/event/reuni-cerita-kita" target="_blank" rel="noopener noreferrer">Reuni Cerita Kita 2026</a>
                  <p class="event-desc">Sore penuh tawa, permainan ringan, dan kisah yang kembali dekat di hati.</p>
                  <div class="event-meta">
                    <p class="event-meta-row"><i data-lucide="calendar" width="16" height="16"></i><span>24 Agustus 2026</span></p>
                    <p class="event-meta-row"><i data-lucide="clock" width="16" height="16"></i><span>15.30 – 19.00 WITA</span></p>
                    <p class="event-meta-row"><i data-lucide="map-pin" width="16" height="16"></i><span>Taman Inspirasi Mertasari</span></p>
                  </div>
                  <a class="event-detail-link focus-ring" href="/event/reuni-cerita-kita" target="_blank" rel="noopener noreferrer">Lihat Detail</a>
                </div>
              </article>

              <!-- Event 4 -->
              <article class="event-card reveal-onscroll" style="transition-delay:.05s" data-category="Festival" data-status="Completed" data-search="festival nada kota lapangan puputan badung">
                <div class="event-card-media">
                  <img loading="lazy" src="https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Band tampil di atas panggung dengan penonton dan cahaya konser yang meriah">
                  <span class="event-status completed">Completed</span>
                </div>
                <div class="event-card-body">
                  <div class="event-card-top">
                    <span class="event-category">Festival</span>
                    <span class="event-quota">800 pengunjung</span>
                  </div>
                  <a class="event-title" href="/event/festival-nada-kota" target="_blank" rel="noopener noreferrer">Festival Nada Kota</a>
                  <p class="event-desc">Selebrasi musik, karya lokal, dan energi baik dalam satu malam yang penuh warna.</p>
                  <div class="event-meta">
                    <p class="event-meta-row"><i data-lucide="calendar" width="16" height="16"></i><span>12 Juli 2026</span></p>
                    <p class="event-meta-row"><i data-lucide="clock" width="16" height="16"></i><span>16.00 – 22.00 WITA</span></p>
                    <p class="event-meta-row"><i data-lucide="map-pin" width="16" height="16"></i><span>Lapangan Puputan Badung</span></p>
                  </div>
                  <a class="event-detail-link focus-ring" href="/event/festival-nada-kota" target="_blank" rel="noopener noreferrer">Lihat Detail</a>
                </div>
              </article>

              <!-- Event 5 -->
              <article class="event-card reveal-onscroll" data-category="Kompetisi" data-status="Upcoming" data-search="code sprint nusantara kompetisi bali tech hub sanur">
                <div class="event-card-media">
                  <img loading="lazy" src="https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Dua perempuan bekerja bersama menyusun program di komputer">
                  <span class="event-status upcoming">Upcoming</span>
                </div>
                <div class="event-card-body">
                  <div class="event-card-top">
                    <span class="event-category">Kompetisi</span>
                    <span class="event-quota">60 tim</span>
                  </div>
                  <a class="event-title" href="/event/code-sprint-nusantara" target="_blank" rel="noopener noreferrer">Code Sprint Nusantara</a>
                  <p class="event-desc">Tantang idemu, bentuk tim terbaikmu, dan ciptakan solusi berdampak dalam 24 jam.</p>
                  <div class="event-meta">
                    <p class="event-meta-row"><i data-lucide="calendar" width="16" height="16"></i><span>4 Oktober 2026</span></p>
                    <p class="event-meta-row"><i data-lucide="clock" width="16" height="16"></i><span>08.00 WITA – selesai</span></p>
                    <p class="event-meta-row"><i data-lucide="map-pin" width="16" height="16"></i><span>Bali Tech Hub, Sanur</span></p>
                  </div>
                  <a class="event-detail-link focus-ring" href="/event/code-sprint-nusantara" target="_blank" rel="noopener noreferrer">Lihat Detail</a>
                </div>
              </article>

              <!-- Event 6 -->
              <article class="event-card reveal-onscroll" style="transition-delay:.05s" data-category="Seminar" data-status="Completed" data-search="berani bertumbuh seminar kampus kreatif renon">
                <div class="event-card-media">
                  <img loading="lazy" src="https://images.pexels.com/photos/3184325/pexels-photo-3184325.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Sekelompok profesional berkolaborasi dalam rapat di ruang kerja modern">
                  <span class="event-status completed">Completed</span>
                </div>
                <div class="event-card-body">
                  <div class="event-card-top">
                    <span class="event-category">Seminar</span>
                    <span class="event-quota">150 kuota</span>
                  </div>
                  <a class="event-title" href="/event/berani-bertumbuh" target="_blank" rel="noopener noreferrer">Berani Bertumbuh</a>
                  <p class="event-desc">Rangkuman pembelajaran, koneksi, dan inspirasi dari para penggerak muda.</p>
                  <div class="event-meta">
                    <p class="event-meta-row"><i data-lucide="calendar" width="16" height="16"></i><span>20 Juni 2026</span></p>
                    <p class="event-meta-row"><i data-lucide="clock" width="16" height="16"></i><span>09.30 – 14.30 WITA</span></p>
                    <p class="event-meta-row"><i data-lucide="map-pin" width="16" height="16"></i><span>Kampus Kreatif Renon</span></p>
                  </div>
                  <a class="event-detail-link focus-ring" href="/event/berani-bertumbuh" target="_blank" rel="noopener noreferrer">Lihat Detail</a>
                </div>
              </article>

            </div>

            <p id="emptyState" class="empty-state">Belum ada event yang sesuai dengan pilihan filter ini. Coba kategori atau status lain, ya!</p>
          </div>
        </div>
      </section>

      <!-- BOTTOM CTA -->
      <section id="tentang" class="page-width bottom-cta-section">
        <div class="bottom-cta reveal-onscroll">
          <div class="bottom-cta-blob-1" aria-hidden="true"></div>
          <div class="bottom-cta-blob-2" aria-hidden="true"></div>
          <div class="bottom-cta-content">
            <span class="bottom-cta-kicker">Masih banyak cerita</span>
            <h2 class="bottom-cta-title">Setiap event punya kenangan untuk dibawa pulang.</h2>
            <p class="bottom-cta-desc">Cari event yang membuatmu penasaran, lalu hadirkan cerita terbaikmu bersama kami.</p>
            <button type="button" id="bottomCta" class="custom-white-pill-btn focus-ring">
              Jelajahi Semua Event
              <i data-lucide="arrow-right" width="16" height="16"></i>
            </button>
          </div>
        </div>
      </section>
    </main>

    <x-footer />
  </div>

  <!-- Floating action buttons: back-to-top & WhatsApp, sama seperti lowongan -->
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
      <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20Ruang%20Kenangan" target="_blank" rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
        <i data-lucide="message-circle" width="26" height="26"></i>
      </a>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var eventSection = document.getElementById("event");
      var cards = Array.prototype.slice.call(document.querySelectorAll("#eventGrid .event-card"));
      var resultCount = document.getElementById("resultCount");
      var emptyState = document.getElementById("emptyState");
      var searchInput = document.getElementById("eventSearchInput");
      var category = "all";
      var status = "all";
      var fadeTimers = new WeakMap();

      // ---------- scroll ke katalog event ----------
      function scrollToEvents() {
        eventSection.scrollIntoView({ behavior: "smooth", block: "start" });
      }
      ["heroCta", "bottomCta"].forEach(function (id) {
        var el = document.getElementById(id);
        if (el) el.addEventListener("click", scrollToEvents);
      });

      // ---------- pencarian + filter kategori & status, dengan fade halus ----------
      function applyFilters() {
        var query = searchInput.value.trim().toLowerCase();
        var visible = 0;

        cards.forEach(function (card) {
          var matchesQuery = !query || card.dataset.search.indexOf(query) !== -1;
          var matchesCategory = category === "all" || card.dataset.category === category;
          var matchesStatus = status === "all" || card.dataset.status === status;
          var show = matchesQuery && matchesCategory && matchesStatus;

          if (fadeTimers.has(card)) {
            clearTimeout(fadeTimers.get(card));
            fadeTimers.delete(card);
          }

          if (show) {
            card.classList.remove("is-hidden");
            requestAnimationFrame(function () { card.classList.remove("is-fading"); });
            visible += 1;
          } else if (!card.classList.contains("is-hidden")) {
            card.classList.add("is-fading");
            var timer = setTimeout(function () {
              card.classList.add("is-hidden");
            }, 260);
            fadeTimers.set(card, timer);
          }
        });

        resultCount.textContent = visible + " event ditemukan";
        emptyState.classList.toggle("show", visible === 0);
      }

      searchInput.addEventListener("input", applyFilters);

      document.querySelectorAll("[data-filter-category]").forEach(function (button) {
        button.addEventListener("click", function () {
          category = button.dataset.filterCategory;
          document.querySelectorAll("[data-filter-category]").forEach(function (item) {
            item.classList.toggle("is-active", item === button);
          });
          applyFilters();
        });
      });

      document.querySelectorAll("[data-filter-status]").forEach(function (button) {
        button.addEventListener("click", function () {
          status = button.dataset.filterStatus;
          document.querySelectorAll("[data-filter-status]").forEach(function (item) {
            item.classList.toggle("is-active", item === button);
          });
          applyFilters();
        });
      });

      // ---------- scroll reveal per-section, sama seperti home & lowongan ----------
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
      applyFilters();
    });
  </script>
</body>
</html>