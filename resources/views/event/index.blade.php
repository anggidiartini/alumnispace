<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Kenangan & Dokumentasi</title>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <link rel="stylesheet"
        href="{{ asset('/css/navbar.css') }}?v={{ file_exists(public_path('/css/navbar.css')) ? filemtime(public_path('/css/navbar.css')) : time() }}">
    <link rel="stylesheet"
        href="{{ asset('/css/event.css') }}?v={{ file_exists(public_path('/css/event.css')) ? filemtime(public_path('/css/event.css')) : time() }}">
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
                    <div class="hero-copy hero-pop-left">
                        <span class="badge-dashed-pill">
                            Kumpulan cerita yang tak terlupa
                        </span>
                        <h1 id="hero-title" class="hero-title">Album Kenangan &amp; Dokumentasi</h1>
                        <p class="hero-subtitle">Temukan dokumentasi event, momen berharga, dan cerita terbaik dari
                            komunitas yang terus bertumbuh.</p>

                        <div class="hero-actions">
                            <button type="button" id="heroCta" class="custom-pill-btn focus-ring">
                                Jelajahi Event
                            </button>
                            <span class="hero-note">Pilih momen yang ingin kamu kenang</span>
                        </div>

                        <div class="hero-stats" id="heroStats">
                            <div class="stat-pill">
                                <span class="stat-pill-number" data-count-to="36" data-suffix="+">0+</span>
                                <span class="stat-pill-label">Event terdokumentasi</span>
                            </div>
                            <div class="stat-pill">
                                <span class="stat-pill-number" data-count-to="4.8" data-suffix="K">0K</span>
                                <span class="stat-pill-label">Momen tersimpan</span>
                            </div>
                            <div class="stat-pill">
                                <span class="stat-pill-number" data-count-to="1.2" data-suffix="K">0K</span>
                                <span class="stat-pill-label">Cerita komunitas</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero-visual hero-pop-right">
                        <div class="hero-visual-backdrop checker blob blob-drift" aria-hidden="true"></div>
                        <div class="hero-photo-frame">
                            <img loading="lazy" src="{{ asset('assets/images/antares.png') }}"
                                alt="Antares, maskot Alumni Space">
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
                        <p class="section-desc">Jelajahi agenda mendatang atau buka kembali dokumentasi dari momen yang
                            sudah berlalu.</p>
                    </div>
                    <p id="resultCount" class="result-count" aria-live="polite"></p>
                </div>

                <div class="catalog-layout">
                    <!-- Filter kategori & status, dipindah ke kiri sesuai gaya lowongan -->
                    <aside class="filter-panel reveal-onscroll reveal-left" aria-label="Filter event">
                        <div class="filter-panel-heading">
                            <h3 style="margin:0; font-size:1.15rem;">Filter Event</h3>
                            <i data-lucide="sliders-horizontal" width="19" height="19"></i>
                        </div>

                        <div class="filter-group">
                            <label class="filter-legend" for="eventSearchInput">Cari event</label>
                            <div class="search-wrap">
                                <i data-lucide="search" width="18" height="18"></i>
                                <input id="eventSearchInput" class="field-control" type="search"
                                    placeholder="Cari nama event atau lokasi">
                            </div>
                        </div>

                        <div class="filter-group">
                            <span class="filter-legend">Pilih kategori</span>
                            <div class="filter-row" id="categoryFilters">
                                <button data-filter-category="all" type="button"
                                    class="filter-button is-active">Semua</button>
                                <button data-filter-category="Seminar" type="button"
                                    class="filter-button">Seminar</button>
                                <button data-filter-category="Workshop" type="button"
                                    class="filter-button">Workshop</button>
                                <button data-filter-category="Gathering" type="button"
                                    class="filter-button">Gathering</button>
                                <button data-filter-category="Festival" type="button"
                                    class="filter-button">Festival</button>
                                <button data-filter-category="Kompetisi" type="button"
                                    class="filter-button">Kompetisi</button>
                            </div>
                        </div>

                    </aside>

                    <div>
                        <div class="status-tabs" role="tablist" aria-label="Filter status event">
                            <button type="button" class="status-tab is-active" data-filter-status="Upcoming"
                                role="tab" aria-selected="true">
                                <i data-lucide="calendar-clock" width="16" height="16"></i>
                                Upcoming
                            </button>
                            <button type="button" class="status-tab" data-filter-status="Completed" role="tab"
                                aria-selected="false">
                                <i data-lucide="check-circle-2" width="16" height="16"></i>
                                Completed
                            </button>
                        </div>

                        <div id="eventGrid" class="event-grid">
  @foreach($events as $index => $event)
    <article class="event-card reveal-onscroll {{ $index % 2 === 0 ? 'reveal-left' : 'reveal-right' }}"
            style="{{ $index % 2 !== 0 ? 'transition-delay:.05s' : '' }}" 
            data-category="{{ $event->category }}" 
            data-status="{{ $event->status }}" 
            data-search="{{ strtolower($event->title . ' ' . $event->category . ' ' . $event->venue) }}">
      
      <div class="event-card-media">
        <!-- Menggunakan fallback gambar jika banner_image kosong -->
        <img loading="lazy" src="{{ $event->banner_image ?? 'https://pexels.com' }}" alt="{{ $event->title }}">
      </div>
      
      <div class="event-card-body">
        <div class="event-card-top">
          <span class="event-category">{{ $event->category }}</span>
          <span class="event-quota">{{ $event->quota }} kuota</span>
        </div>
        
        <a class="event-title" href="{{ route('event.show', $event->slug) }}">
          {{ $event->title }}
        </a>
        
        <p class="event-desc">{{ $event->short_description }}</p>
        
        <div class="event-meta">
          <p class="event-meta-row">
            <i data-lucide="calendar" width="16" height="16"></i>
            <span>{{ $event->event_date ? $event->event_date->translatedFormat('d F Y') : '-' }}</span>
          </p>
          <p class="event-meta-row">
            <i data-lucide="clock" width="16" height="16"></i>
            <span>{{ $event->time_info }}</span>
          </p>
          <p class="event-meta-row">
            <i data-lucide="map-pin" width="16" height="16"></i>
            <span>{{ $event->venue }}</span>
          </p>
        </div>
        
        <a class="event-detail-link focus-ring" href="{{ route('event.show', $event->slug) }}">
          Lihat Detail
        </a>
      </div>
    </article>
  @endforeach
</div>


                            <p id="emptyState" class="empty-state">Belum ada event yang sesuai dengan pilihan filter
                                ini. Coba kategori atau status lain, ya!</p>
                        </div>
                    </div>
            </section>

            <!-- BOTTOM CTA -->
            <section id="tentang" class="page-width bottom-cta-section">
                <div class="bottom-cta reveal-onscroll">
                    <div class="bottom-cta-blob-1" aria-hidden="true"></div>
                    <div class="bottom-cta-blob-2" aria-hidden="true"></div>
                    <div class="bottom-cta-wave" aria-hidden="true"></div>
                    <div class="bottom-cta-content">
                        <span class="bottom-cta-kicker">Yuk, ikutan juga</span>
                        <h2 class="bottom-cta-title">Event serunya nggak berhenti di sini.</h2>
                        <p class="bottom-cta-desc">Masih banyak momen seru menantimu — cari agenda berikutnya dan
                            jadi bagian dari ceritanya.</p>
                        <button type="button" id="bottomCta" class="custom-white-pill-btn cta-pulse focus-ring">
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
                    <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup"><i
                            data-lucide="x" width="16" height="16"></i></button>
                </div>
                <p class="wa-bubble-text">Hubungi pengurus alumni kami via WhatsApp 👋</p>
                <p class="wa-bubble-number">+62 812-3456-7890</p>
            </div>
            <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20Ruang%20Kenangan" target="_blank"
                rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
                <i data-lucide="message-circle" width="26" height="26"></i>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var eventSection = document.getElementById("event");
            var cards = Array.prototype.slice.call(document.querySelectorAll("#eventGrid .event-card"));
            var resultCount = document.getElementById("resultCount");
            var emptyState = document.getElementById("emptyState");
            var searchInput = document.getElementById("eventSearchInput");
            var category = "all";
            var status = "Upcoming";
            var fadeTimers = new WeakMap();

            // ---------- scroll ke katalog event ----------
            function scrollToEvents() {
                eventSection.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
            ["heroCta", "bottomCta"].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) el.addEventListener("click", scrollToEvents);
            });

            // ---------- pencarian + filter kategori & status, dengan fade halus ----------
            function applyFilters() {
                var query = searchInput.value.trim().toLowerCase();
                var visible = 0;

                cards.forEach(function(card) {
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
                        requestAnimationFrame(function() {
                            card.classList.remove("is-fading");
                        });
                        visible += 1;
                    } else if (!card.classList.contains("is-hidden")) {
                        card.classList.add("is-fading");
                        var timer = setTimeout(function() {
                            card.classList.add("is-hidden");
                        }, 260);
                        fadeTimers.set(card, timer);
                    }
                });

                resultCount.textContent = visible + " event ditemukan";
                emptyState.classList.toggle("show", visible === 0);
            }

            searchInput.addEventListener("input", applyFilters);

            document.querySelectorAll("[data-filter-category]").forEach(function(button) {
                button.addEventListener("click", function() {
                    category = button.dataset.filterCategory;
                    document.querySelectorAll("[data-filter-category]").forEach(function(item) {
                        item.classList.toggle("is-active", item === button);
                    });
                    applyFilters();
                });
            });

            document.querySelectorAll("[data-filter-status]").forEach(function(button) {
                button.addEventListener("click", function() {
                    status = button.dataset.filterStatus;
                    document.querySelectorAll("[data-filter-status]").forEach(function(item) {
                        var isActive = item === button;
                        item.classList.toggle("is-active", isActive);
                        item.setAttribute("aria-selected", String(isActive));
                    });
                    applyFilters();
                });
            });

            // ---------- scroll reveal per-section: fade-up di tengah,
            // slide-in dari kiri/kanan untuk elemen yang dikasih
            // class .reveal-left / .reveal-right ----------
            var revealEls = document.querySelectorAll(".reveal-onscroll");
            var revealObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("in-view");
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: "0px 0px -60px 0px"
            });
            revealEls.forEach(function(el, i) {
                if (!el.style.transitionDelay) {
                    el.style.transitionDelay = (i % 3) * 0.1 + "s";
                }
                revealObserver.observe(el);
            });

            // ---------- number counter dengan efek bounce ----------
            function easeOutBack(t) {
                var c1 = 1.70158, c3 = c1 + 1;
                return 1 + c3 * Math.pow(t - 1, 3) + c1 * Math.pow(t - 1, 2);
            }
            function animateCounter(el) {
                var target = parseFloat(el.dataset.countTo);
                var suffix = el.dataset.suffix || "";
                var isDecimal = String(el.dataset.countTo).indexOf(".") !== -1;
                var duration = 1100;
                var start = null;
                function step(ts) {
                    if (!start) start = ts;
                    var progress = Math.min((ts - start) / duration, 1);
                    var eased = easeOutBack(progress);
                    var current = Math.max(target * eased, 0);
                    el.textContent = (isDecimal ? current.toFixed(1) : Math.round(current)) + suffix;
                    if (progress < 1) {
                        requestAnimationFrame(step);
                    } else {
                        el.textContent = (isDecimal ? target.toFixed(1) : target) + suffix;
                    }
                }
                requestAnimationFrame(step);
            }
            var heroStats = document.getElementById("heroStats");
            if (heroStats) {
                var countersDone = false;
                var counterObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting && !countersDone) {
                            countersDone = true;
                            heroStats.querySelectorAll("[data-count-to]").forEach(function(el, i) {
                                setTimeout(function() { animateCounter(el); }, i * 120);
                            });
                            counterObserver.disconnect();
                        }
                    });
                }, { threshold: 0.4 });
                counterObserver.observe(heroStats);
            }

            // ---------- efek 3D tilt + ripple pada card event ----------
            cards.forEach(function(card) {
                card.addEventListener("mousemove", function(e) {
                    var rect = card.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var rotateX = ((y / rect.height) - 0.5) * -8;
                    var rotateY = ((x / rect.width) - 0.5) * 8;
                    card.style.transform = "perspective(900px) rotateX(" + rotateX + "deg) rotateY(" + rotateY + "deg) translateY(-6px)";
                });
                card.addEventListener("mouseleave", function() {
                    card.style.transform = "";
                });
                card.addEventListener("click", function(e) {
                    var rect = card.getBoundingClientRect();
                    var ripple = document.createElement("span");
                    ripple.className = "card-ripple";
                    ripple.style.left = (e.clientX - rect.left) + "px";
                    ripple.style.top = (e.clientY - rect.top) + "px";
                    card.appendChild(ripple);
                    setTimeout(function() { ripple.remove(); }, 650);
                });
            });

            // ---------- back to top ----------
            var backToTop = document.getElementById("back-to-top");
            window.addEventListener("scroll", function() {
                backToTop.classList.toggle("show", window.scrollY > 400);
            }, {
                passive: true
            });
            backToTop.addEventListener("click", function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });

            // ---------- WhatsApp bubble ----------
            var waButton = document.getElementById("wa-button");
            var waBubble = document.getElementById("wa-bubble");
            var waBubbleClose = document.getElementById("wa-bubble-close");
            var waTimer = setTimeout(function() {
                waBubble.classList.add("show");
            }, 1800);

            waButton.addEventListener("mouseenter", function() {
                clearTimeout(waTimer);
                waBubble.classList.add("show");
            });
            waBubbleClose.addEventListener("click", function(e) {
                e.preventDefault();
                waBubble.classList.remove("show");
            });

            lucide.createIcons();
            applyFilters();
        });
    </script>
</body>

</html>