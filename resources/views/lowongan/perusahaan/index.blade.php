<!--
    Simpan file ini di: resources/views/lowongan/perusahaan/index.blade.php
    Terhubung dengan: App\Http\Controllers\CompanyController@index
    Variabel dari controller: $companyProfile (model Company), $jobs (koleksi JobVacancy aktif milik perusahaan ini)
    Route terkait (tidak diubah):
      Route::get('/perusahaan/{slug}', [CompanyController::class, 'index'])->name('perusahaan.index');

    REVISI: desain disamakan dengan halaman detail-lowongan (font DM Sans + Fredoka,
    warna & komponen dari detail-lowongan.css). Card "Tentang Perusahaan" dan "Alamat"
    sekarang dipisah jadi 2 kolom berdampingan (main-layout grid 2 kolom di desktop).

    REVISI 2: dekorasi blob abstrak diganti ornamen ikon (bus, jam, lampu, alat
    tulis, papan tulis) — asetnya disamakan dengan halaman detail-lowongan.
    Sekarang 6 ornamen di kiri + 6 di kanan, tersebar dari hero sampai bawah
    halaman, pakai animasi masuk "tuing" (class reveal-onscroll) + animasi
    gerak floaty/wiggle.
-->
<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $companyProfile->name }} | Alumni Space</title>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap"
        rel="stylesheet">
<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
=======
>>>>>>> d29eb8270851f17bc41363da73c9f5a030996bcb
    <link rel="stylesheet"
        href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet"
        href="{{ asset('css/footer.css') }}?v={{ file_exists(public_path('css/footer.css')) ? filemtime(public_path('css/footer.css')) : time() }}">
<<<<<<< HEAD

     <link rel="stylesheet"
        href="{{ asset('css/detail-perusahaan.css') }}?v={{ file_exists(public_path('css/detail-perusahaan.css')) ? filemtime(public_path('css/detail-perusahaan.css')) : time() }}">
=======
    <link rel="stylesheet"
        href="{{ asset('css/detail-perusahaan.css') }}?v={{ file_exists(public_path('css/detail-perusahaan.css')) ? filemtime(public_path('css/detail-perusahaan.css')) : time() }}">
    <script defer
        src="{{ asset('js/detail-perusahaan.js') }}?v={{ file_exists(public_path('js/detail-perusahaan.js')) ? filemtime(public_path('js/detail-perusahaan.js')) : time() }}"></script>
>>>>>>> d29eb8270851f17bc41363da73c9f5a030996bcb

    @auth
    <script>
        localStorage.setItem("ac_logged_in", "true");
        localStorage.setItem("ac_user_email", "{{ Auth::user()->email }}");
    </script>
    @else
    <script>
        localStorage.setItem("ac_logged_in", "false");
        localStorage.removeItem("ac_user_email");
    </script>
    @endauth
</head>

<body data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}">
    @php
        // --- Ambil field perusahaan secara fleksibel, biar aman walau nama kolom beda ---
        $logoField = $companyProfile->logo ?? $companyProfile->company_logo ?? null;
        $hasLogoFile = !empty($logoField) && (str_contains($logoField, '/') || str_contains($logoField, '.'));
        $logoUrl = $hasLogoFile
            ? (str_starts_with($logoField, 'http') ? $logoField : asset('storage/' . $logoField))
            : null;

        $industry = $companyProfile->industry ?? $companyProfile->category ?? null;
        $location = $companyProfile->location ?? $companyProfile->city ?? null;
        $workType = $companyProfile->work_type ?? null;
        $about = $companyProfile->description ?? $companyProfile->about ?? null;
        $address = $companyProfile->address ?? $location;
        $website = $companyProfile->website ?? $companyProfile->website_url ?? null;
        $email = $companyProfile->email ?? null;
        $linkedin = $companyProfile->linkedin ?? $companyProfile->linkedin_url ?? null;
        $facebook = $companyProfile->facebook ?? $companyProfile->facebook_url ?? null;
        $instagram = $companyProfile->instagram ?? $companyProfile->instagram_url ?? null;
        $phoneRaw = $companyProfile->phone ?? $companyProfile->whatsapp ?? null;
        $phoneDigits = $phoneRaw ? preg_replace('/\D/', '', $phoneRaw) : '6287780341780';
        $hasWhatsapp = !empty($phoneRaw);
    @endphp

    <div class="site-shell">

        {{-- ===== Ornamen kiri-kanan: 6 kiri + 6 kanan, aset sama seperti
             halaman detail-lowongan (bus, jam, lampu, alat tulis, papan
             tulis). Animasi masuk pakai reveal-onscroll (tuing), animasi
             gerak idle pakai floaty/floaty-slow/wiggle. ===== --}}

        {{-- kiri --}}
        <div class="deco-asset dp-deco-l1 reveal-onscroll" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="aset-alattulis floaty">
        </div>
        <div class="deco-asset dp-deco-l2 reveal-onscroll" style="animation-delay:.15s" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="aset-bus wiggle">
        </div>
        <div class="deco-asset dp-deco-l3 reveal-onscroll" style="animation-delay:.3s" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam floaty-slow">
        </div>
        <div class="deco-asset dp-deco-l4 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="aset-papantulis wiggle">
        </div>


        {{-- kanan --}}
        <div class="deco-asset dp-deco-r1 reveal-onscroll" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="aset-papantulis wiggle">
        </div>
        <div class="deco-asset dp-deco-r2 reveal-onscroll" style="animation-delay:.2s" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="aset-lampu floaty">
        </div>
        <div class="deco-asset dp-deco-r3 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="aset-alattulis floaty">
        </div>
        <div class="deco-asset dp-deco-r4 reveal-onscroll" style="animation-delay:.3s" aria-hidden="true">
            <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam floaty-slow">
        </div>



        <x-navbar />

        <main class="page-frame">
            <a class="back-link" href="{{ route('lowongan.index') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7"></path>
                </svg>
                <span>Kembali ke Lowongan</span>
            </a>

            <!-- HERO PERUSAHAAN -->
            <section class="company-hero reveal-onscroll" aria-labelledby="company-name">
                <div class="hero-content">
                    <div class="company-avatar" aria-label="Logo {{ $companyProfile->name }}">
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}" alt="Logo {{ $companyProfile->name }}">
                        @else
                            {{ $companyProfile->initials }}
                        @endif
                    </div>

                    <div class="hero-copy">
                        <div class="hero-badges">
                            <span class="eyebrow">Perusahaan Partner Alumni</span>
                            @if ($industry)
                                <span class="eyebrow industry-badge">{{ $industry }}</span>
                            @endif
                        </div>

                        <h1 id="company-name" class="company-name">{{ $companyProfile->name }}</h1>

                        @if ($industry || $location)
                            <p class="company-meta">{{ collect([$industry, $location])->filter()->implode(' · ') }}</p>
                        @endif

                        @if ($linkedin || $facebook || $hasWhatsapp || $instagram || $email || $website)
                            <ul class="connect-list hero-social-list" aria-label="Kontak perusahaan">
                                @if ($linkedin)
                                    <li><a class="social-link" href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" title="LinkedIn">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.5 8.5H3.3V21h3.2zM4.9 3A1.9 1.9 0 1 0 5 6.8 1.9 1.9 0 0 0 4.9 3zM21 13.8c0-3.8-2-5.6-4.7-5.6-2.2 0-3.1 1.2-3.7 2v-1.7H9.4V21h3.2v-6.2c0-1.6.3-3.2 2.3-3.2 2 0 2 1.9 2 3.3V21H21z"></path></svg>
                                    </a></li>
                                @endif
                                @if ($facebook)
                                    <li><a class="social-link" href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Facebook">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.8 21v-8h2.7l.4-3.1h-3.1V8c0-.9.3-1.5 1.6-1.5H17V3.7c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.4-4 4.1v2.2H8v3.1h2.6v8z"></path></svg>
                                    </a></li>
                                @endif
                                @if ($hasWhatsapp)
                                    <li><a class="social-link" href="https://wa.me/{{ $phoneDigits }}?text={{ urlencode('Halo, saya ingin bertanya seputar ' . $companyProfile->name . ' di Alumni Space.') }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" title="WhatsApp">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 3.5A11.8 11.8 0 0 0 2.7 18L1.5 22.5l4.7-1.2A11.8 11.8 0 1 0 20.5 3.5zm-8.4 16a9.7 9.7 0 0 1-4.9-1.3l-.3-.2-2.8.7.7-2.7-.2-.3a9.7 9.7 0 1 1 7.5 3.8zm5.3-7.3c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.2-.7.2s-.8 1-1 1.2c-.2.2-.4.2-.7.1-1.8-.9-3-2.4-3.5-3.2-.2-.3 0-.5.1-.7l.5-.6c.2-.2.2-.4.3-.6 0-.2-.4-1.8-.6-2.4-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.6.1-.9.5s-1.2 1.2-1.2 2.9 1.2 3.3 1.4 3.5c.2.2 2.4 3.7 5.8 5.2.8.4 1.5.6 2 .7.9.3 1.7.2 2.3.1.7-.1 1.8-.7 2.1-1.4.3-.7.3-1.3.2-1.4z"></path></svg>
                                    </a></li>
                                @endif
                                @if ($instagram)
                                    <li><a class="social-link" href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" title="Instagram">
                                        <svg class="instagram-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.4" cy="6.6" r="1"></circle></svg>
                                    </a></li>
                                @endif
                                @if ($email)
                                    <li><a class="social-link" href="mailto:{{ $email }}" aria-label="Email perusahaan" title="Email perusahaan">
                                        <svg class="mail-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="m3 7 9 6 9-6"></path></svg>
                                    </a></li>
                                @endif
                                @if ($website)
                                    <li><a class="social-link" href="{{ $website }}" target="_blank" rel="noopener noreferrer" aria-label="Website perusahaan" title="Website perusahaan">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M2 12h20M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"></path></svg>
                                    </a></li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </section>

            <!-- FAKTA SINGKAT -->
            <section class="facts-grid" aria-label="Informasi singkat perusahaan">
                <article class="fact-card reveal-onscroll">
                    <span class="fact-label">Kategori</span>
                    <p class="fact-value">Perusahaan</p>
                </article>
                @if ($industry)
                    <article class="fact-card reveal-onscroll">
                        <span class="fact-label">Industri</span>
                        <p class="fact-value">{{ $industry }}</p>
                    </article>
                @endif
                @if ($location)
                    <article class="fact-card reveal-onscroll">
                        <span class="fact-label">Lokasi</span>
                        <p class="fact-value">{{ $location }}</p>
                    </article>
                @endif
                @if ($workType)
                    <article class="fact-card reveal-onscroll">
                        <span class="fact-label">Work Type</span>
                        <p class="fact-value">{{ $workType }}</p>
                    </article>
                @endif
            </section>

                </div>
                <div class="deco-asset lw-jobs-l2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam wiggle">
                </div>
                <div class="deco-asset lw-jobs-r1 reveal-onscroll" aria-hidden="true">

                </div>
                <div class="deco-asset lw-jobs-r2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="aset-papantulis wiggle">
                </div>
                <div class="section-heading reveal-onscroll">
                    <div>
                        <p class="section-kicker">Papan peluang</p>
                        <h2 id="jobs-title" class="section-title">Lowongan aktif untukmu</h2>
                    </div>
                    <span class="jobs-note">Diperbarui secara berkala</span>
                </div>

                <div class="jobs-layout">
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
                                    <input id="search-input" class="field-control" type="search"
                                        placeholder="Cari posisi atau kata kunci">
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
                                    <button class="filter-chip" data-type="Full-Time"
                                        type="button">Full-Time</button>
                                    <button class="filter-chip" data-type="Remote" type="button">Remote</button>
                                    <button class="filter-chip" data-type="Freelance"
                                        type="button">Freelance</button>
                                    <button class="filter-chip" data-type="Magang" type="button">Magang</button>
                                </div>
                            </div>

                            <button id="reset-filter" class="reset-button" type="button" style="width:100%;">Reset
                                Filter</button>
                        </form>
                    </aside>

                    <div>
                        <div class="results-header reveal-onscroll">
                            <p id="results-count" class="results-count" aria-live="polite"></p>
                            <p id="filter-summary" class="filter-summary" aria-live="polite"></p>
                        </div>

                        <div id="jobs-grid" class="jobs-grid">
                            @foreach ($jobs as $i => $job)
                                @php
                                    $waMessage = "Halo, saya ingin melamar posisi {$job->title} di {$job->company_name} yang saya lihat di Alumni Space.";
                                @endphp
                                <article class="job-card reveal-onscroll"
                                    style="animation-delay: {{ ($i % 3) * 0.05 }}s"
                                    data-company="{{ $job->company_name }}" data-location="{{ $job->location }}"
                                    data-type="{{ $job->job_type }}"
                                    data-search="{{ strtolower($job->title . ' ' . $job->company_name . ' ' . $job->location . ' ' . $job->job_type) }}">
                                    <div class="job-card-head">
                                        <span class="job-badge">{{ $job->category }}</span><span
                                            class="job-symbol">✳</span>
                                    </div>
                                    <a class="job-title-link"
                                        href="{{ route('lowongan.index', $job->slug) }}">{{ $job->title }}</a>

                                    <div class="company-row">
                                        @if ($job->company)
                                            <a href="{{ route('perusahaan.index', $job->company->slug) }}"
                                                class="company-link"
                                                style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #2877ED; font-weight: 600;"
                                                onmouseover="this.style.textDecoration='underline'"
                                                onmouseout="this.style.textDecoration='none'">

                                                @if (
                                                     !empty($job->company_logo) &&
                                                        (strpos($job->company_logo, '/') !== false || strpos($job->company_logo, '.') !== false))
                                                    <img class="company-logo"
                                                        src="{{ asset('storage/' . $job->company_logo) }}"
                                                        alt="" loading="lazy">
                                                @else
                                                    <span class="company-initials"
                                                        style="width: 32px; height: 32p x; background: #e2e8f0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 0.85rem; font-weight: bold; color: #4a5568;">
                                                        {{ $job->company_logo ?? $job->initials }}
                                                    </span>
                                                @endif

                                                <span>{{ $job->company->name }}</span>
                                            </a>
                                        @else
                                            <a href="{{ route('perusahaan.index', $job->company_slug ?? \Illuminate\Support\Str::slug($job->company_name)) }}"
                                                class="company-link-enabled"
                                                style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #4a5568; font-weight: 500;"
                                                onmouseover="this.style.textDecoration='underline'; this.style.color='#2877ED'"
                                                onmouseout="this.style.textDecoration='none'; this.style.color='#4a5568'">

                                                @if (
                                                    !empty($job->company_logo) &&
                                                        (strpos($job->company_logo, '/') !== false || strpos($job->company_logo, '.') !== false))
                                                    <img class="company-logo"
                                                        src="{{ asset('storage/' . $job->company_logo) }}"
                                                        alt="" loading="lazy">
                                                @else
                                                    <span class="company-initials"
                                                        style="width: 32px; height: 32px; background: #e2e8f0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 0.85rem; font-weight: bold; color: #4a5568;">
                                                        {{ $job->company_logo ?? $job->initials }}
                                                    </span>
                                                @endif

                                                <span>{{ $job->company_name }}</span>
                                            </a>
                                        @endif
                                    </div>

                                    <p class="job-meta">{{ $job->location }} · {{ $job->job_type }} ·
                                        {{ $job->created_at->diffForHumans() }}</p>
                                    <p class="job-description">
                                        {{ \Illuminate\Support\Str::limit($job->description, 100) }}</p>

                                    <div class="job-card-actions">
                                        <a class="apply-button custom-pill-btn"
                                            href="https://wa.me/6287780341780?text={{ urlencode($waMessage) }}">
                                            <i data-lucide="message-circle" width="16" height="16"></i>
                                            Lamar via WhatsApp
                                        </a>
                                        <a class="detail-button custom-white-pill-btn"
                                            href="{{ route('lowongan.show', $job->slug) }}">
                                            Detail Lowongan
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <section id="empty-state" class="empty-state" aria-live="polite">
                            <div class="empty-icon">⌕</div>
                            <h3 style="margin:1rem 0 0;">Belum ada lowongan yang cocok</h3>
                            <p style="color:#355277;">Coba gunakan kata kunci lain atau atur ulang filter untuk melihat
                                semua peluang.</p>
                            <button id="empty-reset" class="custom-pill-btn" type="button"
                                style="margin-top:1rem;">Reset Filter</button>
                        </section>
                    </div>
                </div>

                <section class="share-banner reveal-onscroll">
                    <span class="share-banner-orb" aria-hidden="true"></span>

                    <div class="share-banner-icon" aria-hidden="true">
                        <i data-lucide="message-circle" width="26" height="26"></i>
                    </div>

                    <div class="share-banner-content">
                        <p class="section-kicker" style="color:var(--yellow);">UNTUK PERUSAHAAN & ALUMNI</p>
                        <h2 class="share-banner-title">Bagikan Lowongan Perusahaan Anda untuk Kami</h2>
                        <p class="share-banner-description">Punya posisi terbuka di tempatmu bekerja? Kirim detail
                            lowongannya via WhatsApp, biar kami bantu sebarkan ke seluruh komunitas alumni.</p>
                    </div>

                    <a class="share-banner-cta custom-pill-btn"
                        href="https://wa.me/6287780341780?text=Halo%20Alumni%20Space%2C%20saya%20ingin%20membagikan%20lowongan%20di%20perusahaan%20kami"
                        target="_blank" rel="noopener">
                        <i data-lucide="message-circle" width="18" height="18"></i>
                        Kirim via WhatsApp
                    </a>
                </section>

                @if ($address)
                    <section class="content-card address-card reveal-onscroll" aria-labelledby="address-title">
                        <div class="section-title-row">
                            <h2 id="address-title" class="section-title">Alamat</h2>
                            <button type="button" id="copy-address-btn" class="copy-address-btn" data-address="{{ $address }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <rect x="9" y="9" width="12" height="12" rx="2"></rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                                <span>Salin</span>
                            </button>
                        </div>
                        <div class="address-stack">
                            <div class="address-line">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <p class="body-copy">{{ $address }}</p>
                            </div>
                            <a class="button button-secondary button-wide"
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($address) }}"
                                target="_blank" rel="noopener noreferrer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="12" cy="12" r="3"></circle><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                </svg>
                                Lihat di Google Maps
                            </a>
                        </div>
                    </section>
                @endif
            </div>

            <!-- LOWONGAN DARI PERUSAHAAN INI -->
            <section class="jobs-section" aria-labelledby="jobs-title">
                <div class="section-header">
                    <h2 id="jobs-title" class="section-title">Lowongan dari perusahaan ini</h2>
                    <span class="demo-pill">{{ $jobs->count() }} lowongan aktif</span>
                </div>

                @if ($jobs->isEmpty())
                    <p class="empty-state">Belum ada lowongan aktif dari {{ $companyProfile->name }} saat ini. Coba cek lagi lain waktu ya.</p>
                @else
                    <div class="jobs-grid">
                        @foreach ($jobs as $job)
                            <article class="job-card reveal-onscroll">
                                <span class="job-tag">{{ $job->category ?? $job->job_type }}</span>
                                <h3 class="job-title">{{ $job->title }}</h3>
                                <div class="job-details">
                                    <span>⌖ <span>{{ $job->location }}</span></span>
                                    <span>▣ <span>{{ $job->job_type }}</span></span>
                                </div>
                                <a class="button button-secondary button-wide" href="{{ route('lowongan.show', $job->slug) }}">Lihat Lowongan</a>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        </main>

        <x-footer />

        <div id="toast" class="toast" role="status" aria-live="polite"></div>

        <button type="button" id="back-to-top" class="back-to-top" aria-label="Kembali ke atas">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M12 19V5M5 12l7-7 7 7"></path>
            </svg>
        </button>

    <!-- Floating action buttons -->


    <div id="toast" class="toast fixed bottom-5 left-1/2 z-[70] -translate-x-1/2 rounded-full bg-[#153563] px-5 py-3 text-sm font-bold text-white shadow-xl" role="status"></div>

    <!-- Modal notifikasi "harus login" -->
    <div id="auth-modal-overlay" class="auth-modal-overlay">
        <div class="auth-modal-card">
            <button id="auth-modal-close" type="button" class="auth-modal-close" aria-label="Tutup">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
            <span class="auth-modal-icon">
                <i data-lucide="lock" class="h-7 w-7"></i>
            </span>
            <h3 class="auth-modal-title">Yah, masih terkunci</h3>
            <p class="auth-modal-text">
                Kamu harus masuk dulu buat akses <strong id="auth-modal-label">fitur ini</strong>.
            </p>
            <div class="auth-modal-actions">
                <button id="auth-modal-cancel" type="button" class="auth-modal-btn-secondary">Nanti dulu</button>
                <a id="auth-modal-confirm" href="{{ route('login') }}" class="auth-modal-btn-primary">Login sekarang</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

                cards.forEach(function(card) {
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
                        requestAnimationFrame(function() {
                            card.classList.remove("is-fading");
                        });
                        count += 1;
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
                if (company) filters.push(company);
                if (location) filters.push(location);
                if (activeType) filters.push(activeType);

                resultCount.textContent = "Menampilkan " + count + " lowongan";
                filterSummary.textContent = filters.length ? "Filter: " + filters.join(" · ") :
                    "Semua peluang aktif";
                emptyState.classList.toggle("is-visible", count === 0);
            }

            function resetFilters() {
                searchInput.value = "";
                companyFilter.value = "";
                locationFilter.value = "";
                activeType = "";

                chips.forEach(function(chip) {
                    chip.classList.remove("is-active");
                    chip.setAttribute("aria-pressed", "false");
                });

                filterJobs();
            }

            searchInput.addEventListener("input", filterJobs);
            companyFilter.addEventListener("change", filterJobs);
            locationFilter.addEventListener("change", filterJobs);

            chips.forEach(function(chip) {
                chip.setAttribute("aria-pressed", "false");
                chip.addEventListener("click", function() {
                    activeType = activeType === chip.dataset.type ? "" : chip.dataset.type;
                    chips.forEach(function(item) {
                        var isActive = item.dataset.type === activeType;
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
