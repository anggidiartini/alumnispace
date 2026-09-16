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
    <link rel="stylesheet"
        href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet"
        href="{{ asset('css/footer.css') }}?v={{ file_exists(public_path('css/footer.css')) ? filemtime(public_path('css/footer.css')) : time() }}">
    <link rel="stylesheet"
        href="{{ asset('css/detail-perusahaan.css') }}?v={{ file_exists(public_path('css/detail-perusahaan.css')) ? filemtime(public_path('css/detail-perusahaan.css')) : time() }}">
    <script defer
        src="{{ asset('js/detail-perusahaan.js') }}?v={{ file_exists(public_path('js/detail-perusahaan.js')) ? filemtime(public_path('js/detail-perusahaan.js')) : time() }}"></script>

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

            <!-- TENTANG PERUSAHAAN & ALAMAT — 2 kolom berdampingan -->
            <div class="main-layout">
                <section class="content-card about-card reveal-onscroll" aria-labelledby="about-title">
                    <h2 id="about-title" class="section-title">Tentang Perusahaan</h2>
                    <p class="body-copy">{{ $about ?? ($companyProfile->name . ' adalah perusahaan mitra alumni yang membuka peluang karier untuk komunitas Alumni Space.') }}</p>
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
    </div>
</body>

</html>
