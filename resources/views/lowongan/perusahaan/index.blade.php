<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $companyProfile->name ?? 'Perusahaan' }} — AS Alumni Space</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/home.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/detail-perusahaan.css') }}?v={{ file_exists(public_path('css/detail-perusahaan.css')) ? filemtime(public_path('css/detail-perusahaan.css')) : time() }}">
</head>
<body>

    <div class="page-wrap section-deco-host">
        <div class="deco-dot floaty" style="width:130px;height:120px;left:-60px;top:200px;background:#ffd9e7;opacity:.55;border-radius:50%;"></div>
        <div class="deco-dot floaty-slow" style="width:90px;height:90px;right:-30px;top:140px;background:#fff0a9;opacity:.55;border-radius:50%;"></div>
        <div class="deco-dot floaty" style="width:110px;height:110px;right:-50px;top:640px;background:#a8d3ff;opacity:.45;border-radius:50%;"></div>

        <x-navbar />

        <main id="top" class="dc-container" style="position:relative;z-index:1;">

            <a href="{{ route('lowongan.index') }}" class="dc-back-link reveal-onscroll">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
                Kembali ke Lowongan
            </a>

            {{-- HERO --}}
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

            {{-- MAIN GRID --}}
            <div class="dc-main-grid">
                <div class="dc-flex dc-flex-col dc-gap-6 dc-order-1">

                    <section id="overview" class="dc-card dc-card--pink reveal-onscroll">
                        <div class="dc-section-head">
                            <span class="dc-icon-badge dc-badge-pink">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l1.9 4.6L18.5 9l-4.6 1.9L12 15.5l-1.9-4.6L5.5 9l4.6-1.9z"/></svg>
                            </span>
                            <h2>Tentang Perusahaan</h2>
                        </div>
                        <p class="dc-c-body dc-leading-relaxed">{{ $companyProfile->description ?? 'Belum ada deskripsi untuk perusahaan ini.' }}</p>
                    </section>

                    <section class="dc-card dc-card--lavender reveal-onscroll">
                        <div class="dc-section-head">
                            <span class="dc-icon-badge dc-badge-lavender">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M3 9h18M9 4v17"/></svg>
                            </span>
                            <h2>Info Perusahaan</h2>
                        </div>

                        <div class="dc-info-grid">
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.6 12.1L13 4.5a2 2 0 0 0-2.8 0L4.5 10.2a2 2 0 0 0 0 2.8l7.6 7.6a2 2 0 0 0 2.8 0l5.7-5.7a2 2 0 0 0 0-2.8z"/></svg></span>
                                <div>
                                    <p class="dc-info-label">Kategori</p>
                                    <p class="dc-info-value">{{ $companyProfile->category ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18"/></svg></span>
                                <div>
                                    <p class="dc-info-label">Industri</p>
                                    <p class="dc-info-value">{{ $companyProfile->industry ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></span>
                                <div>
                                    <p class="dc-info-label">Tipe Kerja</p>
                                    <p class="dc-info-value">{{ $companyProfile->work_type ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="dc-info-row">
                                <span class="dc-info-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg></span>
                                <div>
                                    <p class="dc-info-label">Lowongan Aktif</p>
                                    <p class="dc-info-value">{{ $jobs->count() }} posisi tersedia</p>
                                </div>
                            </div>
                            <div class="dc-info-row dc-info-row--full">
                                <span class="dc-info-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
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
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                </span>
                                <h2>Lowongan Tersedia</h2>
                            </div>
                            <a class="dc-c-blue dc-font-bold dc-underline" href="{{ route('lowongan.index') }}">Lihat semua lowongan</a>
                        </div>
                        <p class="dc-text-sm dc-c-muted dc-mb-4">Temukan peran yang bisa jadi langkah awal perjalananmu.</p>

                        <div class="dc-flex dc-flex-col dc-gap-3">
                            @forelse($jobs as $i => $job)
                                @php $variant = ['card-v1','card-v2','card-v3','card-v4'][$i % 4]; @endphp
                                <article class="dc-job {{ $variant }} reveal-onscroll" style="transition-delay: {{ min($i,6) * 0.06 }}s">
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
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <h2>Lokasi</h2>
                        </div>
                        <div class="dc-map" role="img" aria-label="Peta visual lokasi kantor {{ $companyProfile->name }}">
                            <span class="dc-map__pin">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C7.6 2 4 5.6 4 10c0 5.4 7 12 8 12s8-6.6 8-12c0-4.4-3.6-8-8-8zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
                            </span>
                        </div>
                        <p class="dc-font-bold dc-c-navy dc-mt-3">{{ $companyProfile->address ?? '-' }}</p>
                        @if(!empty($companyProfile->city))
                            <p class="dc-text-sm dc-c-muted dc-mb-3">{{ $companyProfile->city }}{{ !empty($companyProfile->province) ? ', ' . $companyProfile->province : '' }}</p>
                        @endif
                        @if(!empty($companyProfile->address))
                            <a class="custom-white-pill-btn dc-w-full dc-mt-2" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($companyProfile->address) }}" target="_blank" rel="noopener noreferrer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6"/><path d="M10 14L21 3"/></svg>
                                Buka di Google Maps
                            </a>
                        @endif
                    </section>

                    @if($companyProfile->instagram || $companyProfile->facebook || $companyProfile->linkedin || $companyProfile->twitter)
                        <section class="dc-card dc-card--peach reveal-onscroll">
                            <div class="dc-section-head">
                                <span class="dc-icon-badge dc-badge-peach">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a3 3 0 1 0-2.8-4M6 15a3 3 0 1 0 2.8 4M8.6 13.5l6.8-3.9M8.6 10.5l6.8 3.9"/></svg>
                                </span>
                                <h2>Ikuti Perusahaan</h2>
                            </div>
                            <p class="dc-text-sm dc-c-muted dc-mb-3">Kenali aktivitas, karya, dan cerita tim kami.</p>
                            <div class="dc-grid-2">
                                @if($companyProfile->instagram)
                                    <a class="custom-white-pill-btn" style="padding:.5rem;font-size:.8rem;" href="{{ $companyProfile->instagram }}" target="_blank" rel="noopener noreferrer">Instagram</a>
                                @endif
                                @if($companyProfile->facebook)
                                    <a class="custom-white-pill-btn" style="padding:.5rem;font-size:.8rem;" href="{{ $companyProfile->facebook }}" target="_blank" rel="noopener noreferrer">Facebook</a>
                                @endif
                                @if($companyProfile->linkedin)
                                    <a class="custom-white-pill-btn" style="padding:.5rem;font-size:.8rem;" href="{{ $companyProfile->linkedin }}" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                                @endif
                                @if($companyProfile->twitter)
                                    <a class="custom-white-pill-btn" style="padding:.5rem;font-size:.8rem;" href="{{ $companyProfile->twitter }}" target="_blank" rel="noopener noreferrer">X / Twitter</a>
                                @endif
                            </div>
                        </section>
                    @endif

                    <section id="kontak" class="dc-card dc-card--sky reveal-onscroll">
                        <div class="dc-section-head">
                            <span class="dc-icon-badge dc-badge-sky">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l8.4 6a2 2 0 0 0 3.2 0L22 7"/></svg>
                            </span>
                            <h2>Kontak</h2>
                        </div>
                        <div class="dc-flex dc-flex-col dc-gap-3">
                            <div>
                                <p class="dc-text-xs dc-font-bold dc-uppercase dc-tracking-wide dc-c-muted">Email</p>
                                <a class="dc-contact-btn dc-contact-btn--email dc-mt-2" href="mailto:{{ $companyProfile->email }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l8.4 6a2 2 0 0 0 3.2 0L22 7"/></svg>
                                    {{ $companyProfile->email ?? '-' }}
                                </a>
                            </div>
                            <div>
                                <p class="dc-text-xs dc-font-bold dc-uppercase dc-tracking-wide dc-c-muted">WhatsApp</p>
                                <a class="dc-contact-btn dc-contact-btn--wa dc-mt-2" href="https://wa.me/62{{ ltrim($companyProfile->phone ?? '87780341780', '0') }}" target="_blank" rel="noopener noreferrer">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.85.5 3.58 1.35 5.06L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm0 1.67c2.19 0 4.25.85 5.79 2.4a8.18 8.18 0 0 1 2.4 5.79c0 4.52-3.68 8.2-8.2 8.2a8.2 8.2 0 0 1-4.17-1.14l-.3-.18-3.12.82.83-3.04-.2-.31a8.15 8.15 0 0 1-1.25-4.35c0-4.52 3.68-8.19 8.22-8.19zm4.52 5.87c-.25-.12-1.47-.72-1.7-.8-.23-.08-.4-.12-.57.12-.17.25-.65.8-.8.97-.15.17-.29.19-.54.06-.25-.12-1.06-.39-2.01-1.24-.74-.66-1.24-1.48-1.39-1.73-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.15.16-.25.25-.42.08-.17.04-.31-.02-.43-.06-.12-.57-1.37-.78-1.87-.2-.49-.41-.42-.57-.43h-.48c-.17 0-.43.06-.66.31-.23.25-.86.84-.86 2.05 0 1.21.88 2.38 1 2.54.12.17 1.74 2.66 4.22 3.73.59.25 1.05.4 1.41.51.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.28z"/></svg>
                                    {{ $companyProfile->phone ?? '0877-8034-1780' }}
                                </a>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </main>

        <x-footer />
    </div>

    <div id="toast" class="toast" role="status" aria-live="polite"></div>

    {{-- FLOATING: WA + back-to-top (persis home.css) --}}
    <div id="fab-row" class="fab-row">
        <div id="wa-widget">
            <div id="wa-bubble" class="wa-bubble">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;">
                    <p class="wa-bubble-title">Ada pertanyaan?</p>
                   <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup">&times;</button>
                </div>
                <p class="wa-bubble-text">Hubungi {{ $companyProfile->name }} via WhatsApp 👋</p>
                <p class="wa-bubble-number">{{ $companyProfile->phone ?? '0877-8034-1780' }}</p>
            </div>
            <a id="wa-button" href="https://wa.me/62{{ ltrim($companyProfile->phone ?? '87780341780', '0') }}" target="_blank" rel="noopener" class="wa-pulse" aria-label="Chat WhatsApp">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="#fff"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.85.5 3.58 1.35 5.06L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2zm0 1.67c2.19 0 4.25.85 5.79 2.4a8.18 8.18 0 0 1 2.4 5.79c0 4.52-3.68 8.2-8.2 8.2a8.2 8.2 0 0 1-4.17-1.14l-.3-.18-3.12.82.83-3.04-.2-.31a8.15 8.15 0 0 1-1.25-4.35c0-4.52 3.68-8.19 8.22-8.19zm4.52 5.87c-.25-.12-1.47-.72-1.7-.8-.23-.08-.4-.12-.57.12-.17.25-.65.8-.8.97-.15.17-.29.19-.54.06-.25-.12-1.06-.39-2.01-1.24-.74-.66-1.24-1.48-1.39-1.73-.15-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.15.16-.25.25-.42.08-.17.04-.31-.02-.43-.06-.12-.57-1.37-.78-1.87-.2-.49-.41-.42-.57-.43h-.48c-.17 0-.43.06-.66.31-.23.25-.86.84-.86 2.05 0 1.21.88 2.38 1 2.54.12.17 1.74 2.66 4.22 3.73.59.25 1.05.4 1.41.51.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.28z"/></svg>
            </a>
        </div>
        <button id="back-to-top" type="button" aria-label="Kembali ke atas">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
        </button>
    </div>
    
    <script src="{{ asset('js/detail-perusahaan.js') }}?v={{ file_exists(public_path('js/detail-perusahaan.js')) ? filemtime(public_path('js/detail-perusahaan.js')) : time() }}"></script>
</body>
</html>