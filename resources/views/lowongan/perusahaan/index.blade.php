<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $companyProfile->name ?? 'Perusahaan' }} — AS Alumni Space</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- CSS Khusus Detail Perusahaan -->
    <link rel="stylesheet" href="{{ asset('css/detail-perusahaan.css') }}">
</head>
<body>

    <div class="page-wrap section-deco-host" style="position:relative;">

        <!-- 10 ASET ORNAMEN DEKORATIF (Animasi Masuk Saat Scroll & Floating Berbarengan) -->
        <div class="deco-asset dc-asset-papantulis reveal-onscroll floaty"><img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" width="85"></div>
        <div class="deco-asset dc-asset-lampu reveal-onscroll floaty-slow"><img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" width="75"></div>
        <div class="deco-asset dc-asset-jam reveal-onscroll floaty"><img src="{{ asset('assets/images/deco-jam.png') }}" alt="" width="80"></div>
        <div class="deco-asset dc-asset-bus reveal-onscroll floaty-slow"><img src="{{ asset('assets/images/deco-bus.png') }}" alt="" width="95"></div>
        <div class="deco-asset dc-asset-alattulis reveal-onscroll floaty"><img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" width="70"></div>
        <div class="deco-asset dc-asset-buku reveal-onscroll floaty-slow"><img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" width="75"></div>
        <div class="deco-asset dc-asset-task reveal-onscroll floaty"><img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" width="80"></div>
        <div class="deco-asset dc-asset-tas reveal-onscroll floaty-slow"><img src="{{ asset('assets/images/deco-jam.png') }}" alt="" width="85"></div>
        <div class="deco-asset dc-asset-piala reveal-onscroll floaty"><img src="{{ asset('assets/images/deco-bus.png') }}" alt="" width="75"></div>
        <div class="deco-asset dc-asset-gedung reveal-onscroll floaty-slow"><img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" width="90"></div>

        <x-navbar />

        <main id="top" class="dc-container" style="position:relative; z-index:2;">

            <a href="{{ route('lowongan.index') }}" class="dc-back-link reveal-onscroll">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
                Kembali ke Lowongan
            </a>

            {{-- HERO SECTION --}}
            <section class="dc-hero grid-paper reveal-onscroll">
                <span class="badge-dashed-pill dc-pill dc-text-xs dc-font-bold dc-mb-4">Partner perusahaan pilihan alumni</span>

                <div class="dc-hero__grid">
                    <div class="dc-hero__main">
                        <div class="dc-hero__row">
                            <div class="dc-logo-frame floaty-slow">
                                <img src="{{ !empty($companyProfile->logo) ? asset('storage/' . $companyProfile->logo) : asset('assets/anggi/imagedefault.png') }}" alt="Logo {{ $companyProfile->name }}">
                            </div>
                            <div class="dc-hero__heading">
                                <div class="dc-flex dc-flex-wrap dc-gap-2 dc-mb-2">
                                    <span class="dc-pill dc-text-xs dc-font-bold dc-bg-mint dc-c-navy">{{ $companyProfile->category ?? 'Perusahaan' }}</span>
                                    @if(!empty($companyProfile->industry))
                                        <span class="dc-text-sm dc-font-bold dc-c-blue dc-self-center">{{ $companyProfile->industry }}</span>
                                    @endif
                                </div>
                                <h1 class="dc-hero-title">{{ $companyProfile->name }}</h1>
                            </div>
                        </div>

                        @if(!empty($companyProfile->tagline) || !empty($companyProfile->description))
                            <p class="dc-hero-tagline">{{ $companyProfile->tagline ?? \Illuminate\Support\Str::limit($companyProfile->description, 140) }}</p>
                        @endif

                        <div class="dc-flex dc-flex-wrap dc-gap-2">
                            <span class="dc-meta-pill">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="#f1bd38"><path d="M12 2l2.9 6.26 6.9.6-5.2 4.56 1.58 6.78L12 16.9l-6.18 3.3 1.58-6.78-5.2-4.56 6.9-.6z"/></svg>
                                {{ number_format($companyProfile->rating ?? 0, 1) }} / 5
                            </span>
                            @if(!empty($companyProfile->city))
                                <span class="dc-meta-pill">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    {{ $companyProfile->city }}{{ !empty($companyProfile->province) ? ', ' . $companyProfile->province : '' }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="dc-hero__visual">
                        <div class="dc-hero__visual-card shadow-xl">
                            <img src="{{ !empty($companyProfile->banner_image) ? asset('storage/' . $companyProfile->banner_image) : asset('assets/anggi/imagedefault.png') }}" alt="Aktivitas tim {{ $companyProfile->name }}">
                            <div class="dc-hero__visual-caption">
                                Belajar, bikin dampak, dan tumbuh bareng tim yang suportif.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dc-hero__actions">
                    <button type="button" class="custom-pill-btn dc-btn-lg" id="viewJobsButton">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        Lihat Lowongan
                    </button>
                    <button type="button" class="custom-white-pill-btn dc-btn-lg dc-bookmark-btn" id="bookmarkButton" aria-pressed="false">
                        <svg class="dc-icon-unsaved" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                        <svg class="dc-icon-saved" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;display:none;"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/><path d="M9 11l2 2 4-4"/></svg>
                        Simpan
                    </button>
                </div>
            </section>

            {{-- MAIN GRID (CONTENT) --}}
            <div class="dc-main-grid">
                <div class="dc-flex dc-flex-col dc-gap-6 dc-order-1">

                    <section id="overview" class="dc-card dc-card--pink reveal-onscroll">
                        <div class="dc-section-head">
                            <span class="dc-icon-badge dc-badge-pink">
                                <i data-lucide="sparkles" width="20" height="20"></i>
                            </span>
                            <h2>Tentang Perusahaan</h2>
                        </div>
                        <p class="dc-c-body dc-leading-relaxed">{{ $companyProfile->description ?? 'Belum ada deskripsi untuk perusahaan ini.' }}</p>
                    </section>

                    <section class="dc-card dc-card--lavender reveal-onscroll">
                        <div class="dc-section-head">
                            <span class="dc-icon-badge dc-badge-lavender">
                                <i data-lucide="building-2" width="20" height="20"></i>
                            </span>
                            <h2>Info Perusahaan</h2>
                        </div>

                        <div class="dc-info-grid">
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><i data-lucide="tag" width="16" height="16"></i></span>
                                <div>
                                    <p class="dc-info-label">Kategori</p>
                                    <p class="dc-info-value">{{ $companyProfile->category ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><i data-lucide="briefcase" width="16" height="16"></i></span>
                                <div>
                                    <p class="dc-info-label">Industri</p>
                                    <p class="dc-info-value">{{ $companyProfile->industry ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><i data-lucide="monitor" width="16" height="16"></i></span>
                                <div>
                                    <p class="dc-info-label">Tipe Kerja</p>
                                    <p class="dc-info-value">{{ $companyProfile->work_type ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><i data-lucide="users" width="16" height="16"></i></span>
                                <div>
                                    <p class="dc-info-label">Lowongan Aktif</p>
                                    <p class="dc-info-value">{{ $jobs->count() }} posisi tersedia</p>
                                </div>
                            </div>
                            <div class="dc-info-row dc-info-row--full">
                                <span class="dc-info-icon"><i data-lucide="map-pin" width="16" height="16"></i></span>
                                <div>
                                    <p class="dc-info-label">Alamat</p>
                                    <p class="dc-info-value">{{ $companyProfile->address ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="lowongan" class="dc-card dc-card--sun reveal-onscroll">
                        <div class="dc-flex dc-flex-wrap dc-items-end dc-justify-between dc-gap-3 dc-mb-1">
                            <div class="dc-section-head" style="margin-bottom:0;">
                                <span class="dc-icon-badge dc-badge-sun">
                                    <i data-lucide="file-text" width="20" height="20"></i>
                                </span>
                                <h2>Lowongan Tersedia</h2>
                            </div>
                            <a class="dc-c-blue dc-font-bold dc-underline" href="{{ route('lowongan.index') }}">Lihat semua lowongan</a>
                        </div>
                        <p class="dc-text-sm dc-c-muted dc-mb-4">Temukan peran yang bisa jadi langkah awal perjalananmu.</p>

                        <div class="dc-flex dc-flex-col dc-gap-3">
                            @forelse($jobs as $i => $job)
                                <article class="dc-job reveal-onscroll" style="transition-delay: {{ min($i,6) * 0.06 }}s">
                                    <div class="dc-job__top">
                                        <div>
                                            <span class="dc-pill dc-text-xs dc-font-bold dc-bg-white-70 dc-c-navy">{{ $job->employment_type ?? 'Full-time' }}</span>
                                            <h3 class="dc-job__title">{{ $job->title }}</h3>
                                            <p class="dc-job__meta">{{ $job->location ?? $companyProfile->city }} · {{ $job->experience ?? 'Semua level' }}</p>
                                        </div>
                                        <div class="dc-job__actions">
                                            <button type="button" class="custom-white-pill-btn dc-job-detail-btn" style="padding:.5rem 1rem;font-size:.8rem;" aria-expanded="false">Lihat Detail</button>
                                            <a class="custom-pill-btn" style="padding:.5rem 1rem;font-size:.8rem;" href="{{ route('lowongan.show', $job->slug) }}">Lamar Sekarang</a>
                                        </div>
                                    </div>
                                    <div class="dc-job__detail">
                                        <p>{{ $job->description }}</p>
                                    </div>
                                </article>
                            @empty
                                <p class="dc-c-muted dc-text-sm">Belum ada lowongan aktif dari perusahaan ini.</p>
                            @endforelse
                        </div>
                    </section>
                </div>

                <aside class="dc-flex dc-flex-col dc-gap-6 dc-order-2">
                    <section id="lokasi" class="dc-card dc-card--mint reveal-onscroll">
                        <div class="dc-section-head">
                            <span class="dc-icon-badge dc-badge-mint">
                                <i data-lucide="map" width="18" height="18"></i>
                            </span>
                            <h2>Lokasi</h2>
                        </div>
                        <div class="dc-map" role="img" aria-label="Peta visual lokasi kantor {{ $companyProfile->name }}">
                            <span class="dc-map__pin">
                                <i data-lucide="map-pin" width="32" height="32"></i>
                            </span>
                        </div>
                        <p class="dc-font-bold dc-c-navy dc-mt-3">{{ $companyProfile->address ?? '-' }}</p>
                        @if(!empty($companyProfile->city))
                            <p class="dc-text-sm dc-c-muted dc-mb-3">{{ $companyProfile->city }}{{ !empty($companyProfile->province) ? ', ' . $companyProfile->province : '' }}</p>
                        @endif
                        @if(!empty($companyProfile->address))
                            <a class="custom-white-pill-btn dc-w-full dc-mt-2" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($companyProfile->address) }}" target="_blank" rel="noopener noreferrer">
                                <i data-lucide="external-link" width="16" height="16" style="margin-right:6px;"></i>
                                Buka di Google Maps
                            </a>
                        @endif
                    </section>

                    <section id="kontak" class="dc-card dc-card--sky reveal-onscroll">
                        <div class="dc-section-head">
                            <span class="dc-icon-badge dc-badge-sky">
                                <i data-lucide="share-2" width="18" height="18"></i>
                            </span>
                            <h2>Kontak & Sosial Media</h2>
                        </div>
                        <p class="dc-text-sm dc-c-muted dc-mb-3">Hubungi atau ikuti perkembangan terbaru dari kami.</p>

                        <div class="dc-flex dc-flex-col dc-gap-3">
                            <div>
                                <p class="dc-text-xs dc-font-bold dc-uppercase dc-tracking-wide dc-c-muted">Email</p>
                                <a class="dc-contact-btn dc-contact-btn--email dc-mt-1" href="mailto:{{ $companyProfile->email }}">
                                    <i data-lucide="mail" width="16" height="16"></i>
                                    {{ $companyProfile->email ?? '-' }}
                                </a>
                            </div>
                            <div>
                                <p class="dc-text-xs dc-font-bold dc-uppercase dc-tracking-wide dc-c-muted">WhatsApp</p>
                                <a class="dc-contact-btn dc-contact-btn--wa dc-mt-1" href="https://wa.me/62{{ ltrim($companyProfile->phone ?? '87780341780', '0') }}" target="_blank" rel="noopener noreferrer">
                                    <i data-lucide="message-circle" width="16" height="16"></i>
                                    {{ $companyProfile->phone ?? '0877-8034-1780' }}
                                </a>
                            </div>

                            @if($companyProfile->instagram || $companyProfile->linkedin)
                                <div class="dc-mt-2">
                                    <p class="dc-text-xs dc-font-bold dc-uppercase dc-tracking-wide dc-c-muted dc-mb-2">Media Sosial</p>
                                    <div class="dc-grid-2">
                                        @if($companyProfile->instagram)
                                            <a class="custom-white-pill-btn dc-social-btn" href="{{ $companyProfile->instagram }}" target="_blank" rel="noopener noreferrer">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #e1306c;"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                                                Instagram
                                            </a>
                                        @endif
                                        @if($companyProfile->linkedin)
                                            <a class="custom-white-pill-btn dc-social-btn" href="{{ $companyProfile->linkedin }}" target="_blank" rel="noopener noreferrer">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #0077b5;"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                                                LinkedIn
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                </aside>
            </div>
        </main>

        <x-footer />
    </div>

    <div id="toast" class="toast" role="status" aria-live="polite"></div>

    {{-- FLOATING: WA + back-to-top --}}
    <div id="fab-row" class="fab-row">
        <button id="back-to-top" type="button" aria-label="Kembali ke atas">
            <i data-lucide="arrow-up" width="20" height="20"></i>
        </button>

        <div id="wa-widget">
            <div id="wa-bubble" class="wa-bubble">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;">
                    <p class="wa-bubble-title">Ada pertanyaan?</p>
                   <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup"><i data-lucide="x" width="16" height="16"></i></button>
                </div>
                <p class="wa-bubble-text">Hubungi {{ $companyProfile->name }} via WhatsApp 👋</p>
                <p class="wa-bubble-number">{{ $companyProfile->phone ?? '0877-8034-1780' }}</p>
            </div>
            <a id="wa-button" href="https://wa.me/62{{ ltrim($companyProfile->phone ?? '87780341780', '0') }}" target="_blank" rel="noopener" class="wa-pulse" aria-label="Chat WhatsApp">
                <i data-lucide="message-circle" width="26" height="26"></i>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
    <script src="{{ asset('js/detail-perusahaan.js') }}"></script>
</body>
</html>
