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
            <!-- HERO (TIDAK DIUBAH) -->
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

            <!-- KATALOG EVENT — desain disamakan dengan katalog lowongan -->
            <section id="event" class="page-width catalog" aria-labelledby="catalog-title">
                <div class="section-heading reveal-onscroll">
                    <div>
                        <p class="section-kicker">Katalog event</p>
                        <h2 id="catalog-title" class="section-title">Temukan momen terbaik</h2>
                    </div>
                    <span class="jobs-note">Diperbarui secara berkala</span>
                </div>

                <div class="catalog-layout">
                    <!-- Filter panel: sama persis strukturnya dengan filter-panel lowongan -->
                    <aside class="filter-panel reveal-onscroll" aria-label="Filter event">
                        <div class="filter-panel-heading">
                            <h3 style="margin:0; font-size:1.15rem;">Filter Event</h3>
                            <i data-lucide="sliders-horizontal" width="19" height="19"></i>
                        </div>

                        <form class="filter-form" id="filter-form">
                            <div>
                                <label class="field-label" for="eventSearchInput">Cari event</label>
                                <div class="search-wrap">
                                    <i data-lucide="search" width="18" height="18"></i>
                                    <input id="eventSearchInput" class="field-control" type="search"
                                        placeholder="Cari nama event atau lokasi">
                                </div>
                            </div>

                            <div>
                                <p class="field-label">Status event</p>
                                <div class="chip-list">
                                    <button class="filter-chip is-active" data-filter-status="Upcoming" type="button" aria-pressed="true">Upcoming</button>
                                    <button class="filter-chip" data-filter-status="Completed" type="button" aria-pressed="false">Completed</button>
                                </div>
                            </div>

                            <div>
                                <p class="field-label">Kategori cepat</p>
                                <div class="chip-list">
                                    <button class="filter-chip is-active" data-filter-category="all" type="button" aria-pressed="true">Semua</button>
                                    <button class="filter-chip" data-filter-category="Seminar" type="button" aria-pressed="false">Seminar</button>
                                    <button class="filter-chip" data-filter-category="Workshop" type="button" aria-pressed="false">Workshop</button>
                                    <button class="filter-chip" data-filter-category="Gathering" type="button" aria-pressed="false">Gathering</button>
                                    <button class="filter-chip" data-filter-category="Festival" type="button" aria-pressed="false">Festival</button>
                                    <button class="filter-chip" data-filter-category="Kompetisi" type="button" aria-pressed="false">Kompetisi</button>
                                </div>
                            </div>

                            <button id="reset-filter" class="reset-button" type="button" style="width:100%;">Reset Filter</button>
                        </form>
                    </aside>

                    <div>
                        <div class="results-header reveal-onscroll">
                            <p id="resultCount" class="results-count" aria-live="polite"></p>
                            <p id="filterSummary" class="filter-summary" aria-live="polite"></p>
                        </div>

                        <div id="eventGrid" class="jobs-grid event-grid">
                            @foreach($events as $index => $event)
                                <article class="job-card event-card reveal-onscroll"
                                    style="transition-delay: {{ ($index % 3) * 0.05 }}s"
                                    data-category="{{ $event->category }}"
                                    data-status="{{ $event->status }}"
                                    data-search="{{ strtolower($event->title . ' ' . $event->category . ' ' . $event->venue) }}">

                                    <div class="event-card-media">
                                        <img loading="lazy" src="{{ $event->banner_image ?? 'https://pexels.com' }}" alt="{{ $event->title }}">
                                    </div>

                                    <div class="job-card-head">
                                        <span class="job-badge">{{ $event->category }}</span>
                                        <span class="event-quota">{{ $event->quota }} kuota</span>
                                    </div>

                                    <a class="job-title-link" href="{{ route('event.show', $event->slug) }}">{{ $event->title }}</a>
                                    <p class="job-description">{{ $event->short_description }}</p>

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

                                    <a class="apply-button custom-pill-btn" href="{{ route('event.show', $event->slug) }}">Lihat Detail</a>
                                </article>
                            @endforeach
                        </div>

                        <section id="empty-state" class="empty-state" aria-live="polite">
                            <div class="empty-icon">⌕</div>
                            <h3 style="margin:1rem 0 0;">Belum ada event yang cocok</h3>
                            <p style="color:#355277;">Coba gunakan kata kunci lain atau atur ulang filter untuk melihat semua event.</p>
                            <button id="empty-reset" class="custom-pill-btn" type="button" style="margin-top:1rem;">Reset Filter</button>
                        </section>
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

    <!-- Floating action buttons: back-to-top & WhatsApp (tidak diubah) -->
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
            var filterSummary = document.getElementById("filterSummary");
            var emptyState = document.getElementById("empty-state");
            var searchInput = document.getElementById("eventSearchInput");
            var categoryChips = Array.prototype.slice.call(document.querySelectorAll("[data-filter-category]"));
            var statusChips = Array.prototype.slice.call(document.querySelectorAll("[data-filter-status]"));
            var resetButton = document.getElementById("reset-filter");
            var emptyResetButton = document.getElementById("empty-reset");
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

                var filters = [];
                if (query) filters.push('"' + searchInput.value.trim() + '"');
                if (category !== "all") filters.push(category);
                if (status !== "all") filters.push(status);

                resultCount.textContent = "Menampilkan " + visible + " event";
                filterSummary.textContent = filters.length ? "Filter: " + filters.join(" · ") : "Semua event aktif";
                emptyState.classList.toggle("is-visible", visible === 0);
            }

            searchInput.addEventListener("input", applyFilters);

            categoryChips.forEach(function(chip) {
                chip.addEventListener("click", function() {
                    category = chip.dataset.filterCategory;
                    categoryChips.forEach(function(item) {
                        var isActive = item === chip;
                        item.classList.toggle("is-active", isActive);
                        item.setAttribute("aria-pressed", String(isActive));
                    });
                    applyFilters();
                });
            });

            statusChips.forEach(function(chip) {
                chip.addEventListener("click", function() {
                    status = chip.dataset.filterStatus;
                    statusChips.forEach(function(item) {
                        var isActive = item === chip;
                        item.classList.toggle("is-active", isActive);
                        item.setAttribute("aria-pressed", String(isActive));
                    });
                    applyFilters();
                });
            });

            function resetFilters() {
                searchInput.value = "";
                category = "all";
                status = "Upcoming";

                categoryChips.forEach(function(chip) {
                    var isActive = chip.dataset.filterCategory === "all";
                    chip.classList.toggle("is-active", isActive);
                    chip.setAttribute("aria-pressed", String(isActive));
                });
                statusChips.forEach(function(chip) {
                    var isActive = chip.dataset.filterStatus === "Upcoming";
                    chip.classList.toggle("is-active", isActive);
                    chip.setAttribute("aria-pressed", String(isActive));
                });

                applyFilters();
            }

            resetButton.addEventListener("click", resetFilters);
            emptyResetButton.addEventListener("click", resetFilters);

            // ---------- scroll reveal per-section ----------
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

            // ---------- number counter dengan efek bounce (hero, tidak diubah) ----------
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