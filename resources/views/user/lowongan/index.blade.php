<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alumni Space Career Hub</title>

    <link rel="icon" type="image/webp" href="{{ asset('images/logo-as.webp') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link
        rel="stylesheet"
        href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/home.css')) : time() }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/lowongan.css') }}?v={{ file_exists(public_path('css/lowongan.css')) ? filemtime(public_path('css/lowongan.css')) : time() }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">

    @auth
        <script>
            localStorage.setItem("ac_logged_in", "true");
            localStorage.setItem("ac_user_email", @json(Auth::user()->email));
        </script>
    @else
        <script>
            localStorage.setItem("ac_logged_in", "false");
            localStorage.removeItem("ac_user_email");
        </script>
    @endauth
</head>

<body data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}">

    <div class="site-shell page-wrap">

        <x-user-navbar />

        <main>

            {{-- HERO --}}
            <section class="hero-section grid-paper" aria-labelledby="hero-title">

                <div class="deco-asset lw-hero-l1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-papantulis.webp') }}" alt="" class="aset-papantulis wiggle">
                </div>

                <div class="deco-asset lw-hero-l2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-alattulis.webp') }}" alt="" class="aset-alattulis floaty-slow">
                </div>

                <div class="deco-asset lw-hero-r1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-jam.webp') }}" alt="" class="aset-jam floaty">
                </div>

                <div class="deco-asset lw-hero-r2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-lampu.webp') }}" alt="" class="aset-lampu floaty-slow">
                </div>

                <div
                    class="blob blob-drift"
                    style="position:absolute;left:-4rem;top:1rem;width:9rem;height:9rem;background:var(--pink);opacity:.7;z-index:0;"
                    aria-hidden="true">
                </div>

                <span class="hero-orb hero-orb-yellow spin-slow" aria-hidden="true"></span>
                <span class="hero-orb hero-orb-pink" aria-hidden="true"></span>

                <div class="page-width hero-layout">

                    <div class="hero-copy reveal-onscroll">
                        <p class="eyebrow">ALUMNI SPACE CAREER HUB</p>

                        <h1 id="hero-title" class="hero-title">
                            Temukan langkah karier berikutnya
                        </h1>

                        <p class="hero-description">
                            Temukan peluang kerja yang relevan dari perusahaan terpercaya —
                            dibagikan khusus untuk komunitas alumni yang terus bertumbuh.
                        </p>

                        <a class="custom-pill-btn" href="#jobs-title" style="margin-top:2rem;">
                            Jelajahi Lowongan
                        </a>

                        <div class="social-proof">
                            <div class="avatar-stack" aria-hidden="true">
                                <span class="avatar-dot"></span>
                                <span class="avatar-dot"></span>
                                <span class="avatar-dot"></span>
                            </div>

                            <span>Peluang baru setiap minggu</span>
                        </div>
                    </div>

                    <div class="hero-board reveal-onscroll" style="animation-delay:.12s" aria-label="Sorotan lowongan">

                        <div
                            class="checker blob"
                            style="position:absolute;inset:0;opacity:.5;z-index:0;"
                            aria-hidden="true">
                        </div>

                        <div class="preview-wrap">
                            <div class="preview-label">PILIHAN MINGGU INI</div>

                            @if($jobs->count())
                                @php
                                    $featured = $jobs->sortByDesc('created_at')->first();
                                @endphp

                                <article class="preview-card floaty">
                                    <div class="preview-top">
                                        <div class="preview-monogram">{{ $featured->initials }}</div>

                                        <span class="job-badge" style="background:var(--yellow);color:var(--ink);">
                                            {{ $featured->job_type }}
                                        </span>
                                    </div>

                                    <h2 style="margin:0;font-size:1.4rem;">
                                        {{ $featured->title }}
                                    </h2>

                                    <p style="margin:.4rem 0 0;color:#355277;font-weight:700;">
                                        {{ $featured->company_name }} · {{ $featured->location }}
                                    </p>

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

            {{-- DAFTAR LOWONGAN --}}
            <section class="jobs-section" aria-labelledby="jobs-title">

                {{-- Ornamen kiri --}}
                <div class="deco-asset lw-jobs-l1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-papantulis.webp') }}" alt="" class="aset-papantulis wiggle">
                </div>

                <div class="deco-asset lw-jobs-l2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-jam.webp') }}" alt="" class="aset-jam floaty">
                </div>

                <div class="deco-asset lw-jobs-l3 reveal-onscroll" style="animation-delay:.15s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-alattulis.webp') }}" alt="" class="aset-alattulis floaty-slow">
                </div>

                <div class="deco-asset lw-jobs-l4 reveal-onscroll" style="animation-delay:.2s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-lampu.webp') }}" alt="" class="aset-lampu wiggle">
                </div>

                <div class="deco-asset lw-jobs-l5 reveal-onscroll" style="animation-delay:.25s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-jam.webp') }}" alt="" class="aset-jam floaty-slow">
                </div>

                {{-- Ornamen kanan --}}
                <div class="deco-asset lw-jobs-r1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-lampu.webp') }}" alt="" class="aset-lampu floaty">
                </div>

                <div class="deco-asset lw-jobs-r2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-papantulis.webp') }}" alt="" class="aset-papantulis wiggle">
                </div>

                <div class="deco-asset lw-jobs-r3 reveal-onscroll" style="animation-delay:.15s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-jam.webp') }}" alt="" class="aset-jam floaty-slow">
                </div>

                <div class="deco-asset lw-jobs-r4 reveal-onscroll" style="animation-delay:.2s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-alattulis.webp') }}" alt="" class="aset-alattulis wiggle">
                </div>

                <div class="deco-asset lw-jobs-r5 reveal-onscroll" style="animation-delay:.25s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-lampu.webp') }}" alt="" class="aset-lampu floaty">
                </div>

                <div class="page-width">

                    <div class="section-heading reveal-onscroll">
                        <div>
                            <p class="section-kicker">Papan peluang</p>
                            <h2 id="jobs-title" class="section-title">Lowongan aktif untukmu</h2>
                        </div>

                        <span class="jobs-note">Diperbarui secara berkala</span>
                    </div>

                    <div class="jobs-layout">

                        {{-- PANEL FILTER --}}
                        <aside class="filter-panel reveal-onscroll" aria-label="Filter lowongan">

                            <div class="filter-panel-heading">
                                <h3 style="margin:0;font-size:1.15rem;">Filter Lowongan</h3>
                                <i data-lucide="sliders-horizontal" width="19" height="19"></i>
                            </div>

                            <form class="filter-form" id="filter-form">

                                {{-- Pencarian --}}
                                <div>
                                    <label class="field-label" for="search-input">
                                        Cari peluang
                                    </label>

                                    <div class="search-wrap">
                                        <i data-lucide="search" width="18" height="18"></i>

                                        <input
                                            id="search-input"
                                            class="field-control"
                                            type="search"
                                            placeholder="Cari posisi atau kata kunci">
                                    </div>
                                </div>

                                {{-- Perusahaan --}}
                                <div>
                                    <label class="field-label" for="company-filter">
                                        Perusahaan
                                    </label>

                                    <select id="company-filter" class="field-control">
                                        <option value="">Semua Perusahaan</option>

                                        @foreach($jobs->pluck('company_name')->filter()->unique()->sort() as $company)
                                            <option value="{{ $company }}">
                                                {{ $company }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Lokasi --}}
                                <div>
                                    <label class="field-label" for="location-filter">
                                        Lokasi
                                    </label>

                                    <select id="location-filter" class="field-control">
                                        <option value="">Semua Lokasi</option>

                                        @foreach($jobs->pluck('location')->filter()->unique()->sort() as $loc)
                                            <option value="{{ $loc }}">
                                                {{ $loc }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- KATEGORI DARI DATABASE --}}
                                <div>
                                    <p class="field-label">Kategori cepat</p>

                                    <div class="chip-list">
                                        @forelse($categories as $category)
                                            <button
                                                class="filter-chip"
                                                data-category="{{ $category->name }}"
                                                type="button"
                                                aria-pressed="false">
                                                {{ $category->name }}
                                            </button>
                                        @empty
                                            <p class="field-hint">
                                                Belum ada kategori lowongan yang aktif.
                                            </p>
                                        @endforelse
                                    </div>
                                </div>

                                <button
                                    id="reset-filter"
                                    class="reset-button"
                                    type="button"
                                    style="width:100%;">
                                    Reset Filter
                                </button>

                            </form>
                        </aside>

                        {{-- HASIL LOWONGAN --}}
                        <div>

                            <div class="results-header reveal-onscroll">
                                <p id="results-count" class="results-count" aria-live="polite"></p>
                                <p id="filter-summary" class="filter-summary" aria-live="polite"></p>
                            </div>

                            <div id="jobs-grid" class="jobs-grid">

                                @foreach($jobs as $i => $job)
                                    @php
                                        $waMessage = "Halo, saya ingin melamar posisi {$job->title} di {$job->company_name} yang saya lihat di Alumni Space.";

                                        $jobCategory = $job->category ?? '';
                                    @endphp

                                    <article
                                        class="job-card reveal-onscroll"
                                        style="animation-delay:{{ ($i % 3) * 0.05 }}s;cursor:pointer;"
                                        data-company="{{ $job->company_name }}"
                                        data-location="{{ $job->location }}"
                                        data-type="{{ $job->job_type }}"
                                        data-category="{{ $jobCategory }}"
                                        data-search="{{ strtolower($job->title . ' ' . $job->company_name . ' ' . $job->location . ' ' . $job->job_type . ' ' . $jobCategory) }}"
                                        data-href="{{ route('lowongan.show', $job->slug) }}">

                                        <div class="job-card-head">
                                            <span class="job-badge">
                                                {{ $jobCategory ?: 'Kategori belum ditentukan' }}
                                            </span>

                                            <span class="job-symbol">✳</span>
                                        </div>

                                        <a
                                            class="job-title-link"
                                            href="{{ route('lowongan.show', $job->slug) }}">
                                            {{ $job->title }}
                                        </a>

                                        <div class="company-row">
                                            @if($job->company)
                                                <a
                                                    href="{{ route('perusahaan.index', $job->company->slug) }}"
                                                    class="company-link"
                                                    style="display:flex;align-items:center;gap:.5rem;text-decoration:none;color:#2877ED;font-weight:600;"
                                                    onmouseover="this.style.textDecoration='underline'"
                                                    onmouseout="this.style.textDecoration='none'">

                                                    <x-company-logo
                                                        :logo="optional($job->company)->logo"
                                                        :name="$job->company_name"
                                                        size="32"
                                                        option="initials" />

                                                    <span>{{ $job->company->name }}</span>
                                                </a>
                                            @else
                                                <a
                                                    href="{{ route('perusahaan.index', $job->company_slug ?? \Illuminate\Support\Str::slug($job->company_name)) }}"
                                                    class="company-link-enabled"
                                                    style="display:flex;align-items:center;gap:.5rem;text-decoration:none;color:#4a5568;font-weight:500;"
                                                    onmouseover="this.style.textDecoration='underline';this.style.color='#2877ED'"
                                                    onmouseout="this.style.textDecoration='none';this.style.color='#4a5568'">

                                                    <x-company-logo
                                                        :logo="optional($job->company)->logo"
                                                        :name="$job->company_name"
                                                        size="32"
                                                        option="initials" />

                                                    <span>{{ $job->company_name }}</span>
                                                </a>
                                            @endif
                                        </div>

                                        <p class="job-meta">
                                            {{ $job->location }} · {{ $job->job_type }} ·
                                            {{ $job->created_at?->diffForHumans() ?? 'Tanggal belum tersedia' }}
                                        </p>

                                        <p class="job-description">
                                            {{ \Illuminate\Support\Str::limit($job->description, 100) }}
                                        </p>

                                        <div class="job-card-actions">
                                            <a
                                                class="apply-button custom-pill-btn"
                                                href="https://wa.me/6287780341780?text={{ urlencode($waMessage) }}"
                                                target="_blank"
                                                rel="noopener">
                                                <i data-lucide="message-circle" width="16" height="16"></i>
                                                Lamar via WhatsApp
                                            </a>

                                            <a
                                                class="detail-button custom-white-pill-btn"
                                                href="{{ route('lowongan.show', $job->slug) }}">
                                                Detail Lowongan
                                            </a>
                                        </div>

                                    </article>
                                @endforeach

                            </div>

                            {{-- KONDISI KOSONG --}}
                            <section id="empty-state" class="empty-state" aria-live="polite">
                                <div class="empty-icon">⌕</div>

                                <h3 style="margin:1rem 0 0;">
                                    Belum ada lowongan yang cocok
                                </h3>

                                <p style="color:#355277;">
                                    Coba gunakan kata kunci lain atau atur ulang filter untuk melihat semua peluang.
                                </p>

                                <button
                                    id="empty-reset"
                                    class="custom-pill-btn"
                                    type="button"
                                    style="margin-top:1rem;">
                                    Reset Filter
                                </button>
                            </section>

                        </div>
                    </div>

                    {{-- BANNER BAGIKAN LOWONGAN --}}
                    <section class="share-banner reveal-onscroll">

                        <span class="share-banner-orb" aria-hidden="true"></span>

                        <div class="share-banner-icon" aria-hidden="true">
                            <i data-lucide="message-circle" width="26" height="26"></i>
                        </div>

                        <div class="share-banner-content">
                            <p class="section-kicker" style="color:var(--yellow);">
                                UNTUK PERUSAHAAN & ALUMNI
                            </p>

                            <h2 class="share-banner-title">
                                Bagikan Lowongan Perusahaan Anda untuk Kami
                            </h2>

                            <p class="share-banner-description">
                                Punya posisi terbuka di tempatmu bekerja? Kirim detail
                                lowongannya via WhatsApp, biar kami bantu sebarkan ke seluruh komunitas alumni.
                            </p>
                        </div>

                        <a
                            class="share-banner-cta custom-pill-btn"
                            href="https://wa.me/6287780341780?text=Halo%20Alumni%20Space%2C%20saya%20ingin%20membagikan%20lowongan%20di%20perusahaan%20kami"
                            target="_blank"
                            rel="noopener">
                            <i data-lucide="message-circle" width="18" height="18"></i>
                            Kirim via WhatsApp
                        </a>

                    </section>

                </div>
            </section>

        </main>

        <x-user-footer />

    </div>

    {{-- TOMBOL MELAYANG --}}
    <div id="fab-row" class="fab-row">

        <button
            id="back-to-top"
            type="button"
            class="focus-ring"
            aria-label="Kembali ke atas">
            <i data-lucide="arrow-up" width="20" height="20"></i>
        </button>

        <div id="wa-widget">

            <div id="wa-bubble" class="wa-bubble">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:.5rem;">
                    <p class="wa-bubble-title">Ada pertanyaan?</p>

                    <button
                        id="wa-bubble-close"
                        type="button"
                        class="wa-bubble-close"
                        aria-label="Tutup">
                        <i data-lucide="x" width="16" height="16"></i>
                    </button>
                </div>

                <p class="wa-bubble-text">
                    Hubungi pengurus alumni kami via WhatsApp 👋
                </p>

                <p class="wa-bubble-number">+62 812-3456-7890</p>
            </div>

            <a
                id="wa-button"
                href="https://wa.me/6281234567890?text=Halo%20Alumni%20Space"
                target="_blank"
                rel="noopener"
                class="wa-pulse focus-ring"
                aria-label="Hubungi kami via WhatsApp">
                <i data-lucide="message-circle" width="26" height="26"></i>
            </a>

        </div>
    </div>

    <div
        id="toast"
        class="toast fixed bottom-5 left-1/2 z-[70] -translate-x-1/2 rounded-full bg-[#153563] px-5 py-3 text-sm font-bold text-white shadow-xl"
        role="status">
    </div>

    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        // Matikan animasi reveal setelah selesai agar hover tetap berfungsi.
        (function () {
            document.querySelectorAll(".reveal-onscroll").forEach(function (element) {
                element.addEventListener("animationend", function () {
                    element.style.animation = "none";
                }, { once: true });
            });
        })();

        document.addEventListener("DOMContentLoaded", function () {
            var searchInput = document.getElementById("search-input");
            var companyFilter = document.getElementById("company-filter");
            var locationFilter = document.getElementById("location-filter");
            var resetButton = document.getElementById("reset-filter");
            var emptyResetButton = document.getElementById("empty-reset");

            var cards = Array.from(document.querySelectorAll(".job-card"));
            var chips = Array.from(document.querySelectorAll(".filter-chip"));

            var emptyState = document.getElementById("empty-state");
            var resultCount = document.getElementById("results-count");
            var filterSummary = document.getElementById("filter-summary");

            var activeCategory = "";
            var fadeTimers = new WeakMap();

            // Klik kartu akan membuka detail, kecuali saat mengeklik tautan.
            cards.forEach(function (card) {
                var targetUrl = card.dataset.href;

                if (!targetUrl) return;

                card.addEventListener("click", function (event) {
                    if (event.target.closest("a, button")) return;

                    window.location.href = targetUrl;
                });
            });

            function filterJobs() {
                var query = searchInput.value.trim().toLowerCase();
                var company = companyFilter.value;
                var location = locationFilter.value;
                var count = 0;

                cards.forEach(function (card) {
                    var matchesQuery =
                        !query ||
                        (card.dataset.search || "").includes(query);

                    var matchesCompany =
                        !company ||
                        card.dataset.company === company;

                    var matchesLocation =
                        !location ||
                        card.dataset.location === location;

                    var matchesCategory =
                        !activeCategory ||
                        card.dataset.category === activeCategory;

                    var matches =
                        matchesQuery &&
                        matchesCompany &&
                        matchesLocation &&
                        matchesCategory;

                    if (fadeTimers.has(card)) {
                        clearTimeout(fadeTimers.get(card));
                        fadeTimers.delete(card);
                    }

                    if (matches) {
                        card.classList.remove("is-hidden");

                        requestAnimationFrame(function () {
                            card.classList.remove("is-fading");
                        });

                        count++;
                    } else if (!card.classList.contains("is-hidden")) {
                        card.classList.add("is-fading");

                        var timer = setTimeout(function () {
                            card.classList.add("is-hidden");
                            fadeTimers.delete(card);
                        }, 260);

                        fadeTimers.set(card, timer);
                    }
                });

                var filters = [];

                if (query) {
                    filters.push('"' + searchInput.value.trim() + '"');
                }

                if (company) filters.push(company);
                if (location) filters.push(location);
                if (activeCategory) filters.push(activeCategory);

                resultCount.textContent =
                    "Menampilkan " + count + " lowongan";

                filterSummary.textContent = filters.length
                    ? "Filter: " + filters.join(" · ")
                    : "Semua peluang aktif";

                emptyState.classList.toggle("is-visible", count === 0);
            }

            function resetFilters() {
                searchInput.value = "";
                companyFilter.value = "";
                locationFilter.value = "";
                activeCategory = "";

                chips.forEach(function (chip) {
                    chip.classList.remove("is-active");
                    chip.setAttribute("aria-pressed", "false");
                });

                filterJobs();
            }

            searchInput.addEventListener("input", filterJobs);
            companyFilter.addEventListener("change", filterJobs);
            locationFilter.addEventListener("change", filterJobs);

            // Filter kategori berdasarkan nama dari job_categories.
            chips.forEach(function (chip) {
                chip.setAttribute("aria-pressed", "false");

                chip.addEventListener("click", function () {
                    var selectedCategory = chip.dataset.category;

                    activeCategory =
                        activeCategory === selectedCategory
                            ? ""
                            : selectedCategory;

                    chips.forEach(function (item) {
                        var isActive =
                            item.dataset.category === activeCategory;

                        item.classList.toggle("is-active", isActive);
                        item.setAttribute("aria-pressed", String(isActive));
                    });

                    filterJobs();
                });
            });

            resetButton.addEventListener("click", resetFilters);
            emptyResetButton.addEventListener("click", resetFilters);

            filterJobs();
        });
    </script>

</body>
</html>
