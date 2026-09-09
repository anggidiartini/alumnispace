<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->name }} — Alumni Space</title>
    <meta name="description" content="{{ Str::limit(strip_tags($company->description ?? ''), 155) }}">

    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/detail-perusahaan.css') }}">
</head>
<body>

    <x-navbar />

    <div class="dp-page">
    <div class="dp-shell">
        <main id="beranda">
            <div class="dp-width">


                {{-- HERO --}}
                <section class="dp-hero dp-reveal" aria-labelledby="companyName">
                    <span class="dp-blob one"></span>
                    <span class="dp-blob two"></span>
                    <span class="dp-blob three"></span>

                    <div class="dp-hero-content">
                        <div class="dp-logo" aria-label="Logo {{ $company->name }}">
                            @if(!empty($company->logo))
                                <img src="{{ asset('storage/'.$company->logo) }}" alt="Logo {{ $company->name }}">
                            @else
                                <svg viewBox="0 0 80 80" fill="none" aria-hidden="true">
                                    <path d="M40 8 65 23v34L40 72 15 57V23L40 8Z" fill="#2877ED"/>
                                    <path d="m27 40 9 9 18-20" stroke="#fff" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            @endif
                        </div>

                        <div class="dp-hero-info">
                            <div class="dp-eyebrow">
                                @if(!empty($company->category))
                                    <span class="dp-pill yellow">{{ $company->category }}</span>
                                @endif
                                @if($company->is_verified ?? false)
                                    <span class="dp-pill blue">Terverifikasi</span>
                                @endif
                            </div>

                            <h1 id="companyName">{{ $company->name }}</h1>
                            <p class="dp-industry">{{ $company->industry ?? '-' }}</p>
                            <p class="dp-location">⌖ {{ $company->location ?? '-' }}</p>

                            <div class="dp-hero-actions">
                                <button id="jobsButton" class="dp-btn-primary" type="button">Lihat Lowongan</button>
                                <button id="shareButton" class="dp-btn-secondary" type="button" data-title="{{ $company->name }}">
                                    <span>Bagikan</span>
                                    <i data-lucide="share-2" style="width:17px"></i>
                                </button>
                                <button id="bookmarkButton" class="dp-icon-btn" type="button" aria-label="Simpan perusahaan" aria-pressed="false">
                                    <i data-lucide="bookmark" style="width:19px"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="dp-hero-stats" aria-label="Statistik perusahaan">
                        <div class="dp-stat">
                            <strong>{{ $company->jobs_count ?? ($jobs->count() ?? 0) }}</strong>
                            <span>Lowongan aktif</span>
                        </div>
                        <div class="dp-stat">
                            <strong>{{ $company->followers_count ?? 0 }}</strong>
                            <span>Followers</span>
                        </div>
                        <div class="dp-stat">
                            <strong>{{ $company->rating ?? '-' }} ★</strong>
                            <span>Dari {{ $company->review_count ?? 0 }} review</span>
                        </div>
                    </div>
                </section>
            </div>

            <div class="dp-width dp-main-grid">
                <div class="dp-stack">
                    {{-- TENTANG --}}
                    <section class="dp-card dp-reveal" aria-labelledby="aboutTitle">
                        <h2 id="aboutTitle" class="dp-section-title">
                            <span class="dp-title-dot"></span>
                            <span>Tentang perusahaan</span>
                        </h2>
                        <p class="dp-copy">{!! nl2br(e($company->description ?? '-')) !!}</p>

                        <div class="dp-socials" aria-label="Media sosial perusahaan">
                            @if(!empty($company->linkedin))
                                <a class="dp-social linkedin" href="{{ $company->linkedin }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn perusahaan"><i data-lucide="linkedin"></i></a>
                            @endif
                            @if(!empty($company->instagram))
                                <a class="dp-social instagram" href="{{ $company->instagram }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram perusahaan"><i data-lucide="instagram"></i></a>
                            @endif
                            @if(!empty($company->facebook))
                                <a class="dp-social facebook" href="{{ $company->facebook }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook perusahaan"><i data-lucide="facebook"></i></a>
                            @endif
                            @if(!empty($company->whatsapp))
                                <a class="dp-social wa" href="https://wa.me/{{ preg_replace('/\D/', '', $company->whatsapp) }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp perusahaan"><i data-lucide="message-circle"></i></a>
                            @endif
                            @if(!empty($company->website))
                                <a class="dp-social website" href="{{ $company->website }}" target="_blank" rel="noopener noreferrer" aria-label="Website perusahaan"><span aria-hidden="true">𝕏</span></a>
                            @endif
                        </div>
                    </section>

                    {{-- ALAMAT --}}
                    <section class="dp-card dp-reveal" aria-labelledby="addressTitle">
                        <h2 id="addressTitle" class="dp-section-title">
                            <span class="dp-title-dot"></span>
                            <span>Alamat kantor</span>
                        </h2>
                        <div class="dp-address-box">
                            <div class="dp-round-icon">
                                <i data-lucide="map-pin" style="width:22px"></i>
                            </div>
                            <div>
                                <strong>{{ $company->address ?? '-' }}</strong>
                                <p>{{ $company->city ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="dp-map-preview" aria-label="Preview peta lokasi kantor">
                            <div class="dp-map-route"></div>
                            <div class="dp-map-pin"></div>
                            <span class="dp-map-label one">{{ $company->map_label_left ?? 'Lokasi' }}</span>
                            <span class="dp-map-label two">{{ $company->map_label_right ?? 'Kantor' }}</span>
                        </div>
                        <a class="dp-map-link" href="{{ $company->maps_url ?? 'https://maps.google.com' }}" target="_blank" rel="noopener noreferrer">Buka di Maps ↗</a>
                    </section>
                </div>

                <aside class="dp-stack dp-aside">
                    {{-- INFO PERUSAHAAN --}}
                    <section class="dp-card dp-reveal" aria-labelledby="infoTitle">
                        <h2 id="infoTitle" class="dp-section-title">
                            <span class="dp-title-dot"></span>
                            <span>Info perusahaan</span>
                        </h2>
                        <div class="dp-info-list">
                            <div class="dp-info-row">
                                <i data-lucide="globe-2"></i>
                                <div>
                                    <span>Industri</span>
                                    <strong>{{ $company->industry ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="dp-info-row">
                                <i data-lucide="calendar-days"></i>
                                <div>
                                    <span>Tipe kerja</span>
                                    <strong>{{ $company->work_type ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="dp-info-row">
                                <i data-lucide="clock-3"></i>
                                <div>
                                    <span>Tahun berdiri</span>
                                    <strong>{{ $company->founded_year ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="dp-info-row">
                                <i data-lucide="mail"></i>
                                <div>
                                    <span>Email kontak</span>
                                    <a href="mailto:{{ $company->email ?? '' }}">{{ $company->email ?? '-' }}</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="dp-card dp-contact-card dp-sticky dp-reveal" aria-labelledby="contactTitle">
                        <h2 id="contactTitle" class="dp-section-title">
                            <span class="dp-title-dot"></span>
                            <span>Kontak</span>
                        </h2>
                        <p>Punya pertanyaan tentang proses rekrutmen atau ingin berkolaborasi?</p>
                        <a href="mailto:{{ $company->email ?? '' }}">Kirim email →</a>
                    </section>
                </aside>
            </div>

            {{-- LOWONGAN LAIN --}}
            <section id="lowongan" class="dp-jobs-section dp-width dp-reveal" aria-labelledby="jobsTitle">
                <div class="dp-jobs-heading">
                    <div>
                        <h2 id="jobsTitle">Lowongan lain dari {{ $company->name }}</h2>
                        <p>Jelajahi peran yang sedang mencari talenta baru seperti kamu.</p>
                    </div>
                </div>

                <div class="dp-jobs-dashboard">
                    <span class="dp-grid-deco one" aria-hidden="true">✦</span>
                    <span class="dp-grid-deco two" aria-hidden="true">•••</span>

                    <div id="jobsGrid" class="dp-jobs-grid">
                        @forelse($jobs as $job)
                            <article class="dp-job-card">
                                <div class="dp-job-strip">
                                    <span class="dp-job-category">{{ $job->category ?? 'Umum' }}</span>
                                    <span class="dp-job-spark">✦</span>
                                </div>
                                <div class="dp-job-body">
                                    <div class="dp-job-company-row">
                                        <div class="dp-job-logo">
                                            @if(!empty($company->logo))
                                                <img src="{{ asset('storage/'.$company->logo) }}" alt="">
                                            @else
                                                ✦
                                            @endif
                                        </div>
                                        <span class="dp-job-kind">{{ $job->work_type ?? 'Full-Time' }}</span>
                                    </div>
                                    <h3>{{ $job->title }}</h3>
                                    <p class="dp-company-name">{{ $company->name }}</p>
                                    <div class="dp-job-meta">
                                        <span>📍 {{ $job->location ?? '-' }}</span>
                                        <span>{{ $job->work_mode ?? 'On-site' }}</span>
                                    </div>
                                    <p class="dp-job-description">{{ Str::limit($job->description ?? '-', 110) }}</p>
                                    <div class="dp-job-bottom">
                                        <span class="dp-deadline">
                                            Tutup {{ optional($job->deadline)->translatedFormat('d M Y') ?? '-' }}
                                        </span>
                                        <div class="dp-job-actions">
                                            <a class="dp-job-action dp-whatsapp-btn"
                                               href="https://wa.me/{{ preg_replace('/\D/', '', $job->whatsapp ?? $company->whatsapp ?? '') }}"
                                               target="_blank" rel="noopener noreferrer">Lamar via WhatsApp</a>
                                            <a class="dp-job-action dp-detail-link" href="{{ route('lowongan.show', $job->slug) }}">Detail Lowongan</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="dp-empty">
                                <i data-lucide="search"></i>
                                <span>Belum ada lowongan lain dari perusahaan ini.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>

        <div class="dp-float-actions">
            <button id="backToTop" class="dp-fab dp-fab-top" type="button" aria-label="Kembali ke atas">
                <i data-lucide="arrow-up"></i>
            </button>
            <a class="dp-fab dp-fab-wa"
               href="https://wa.me/{{ preg_replace('/\D/', '', $company->whatsapp ?? '') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp">
                <i data-lucide="message-circle"></i>
            </a>
        </div>

        <div id="dpToast" class="dp-toast" role="status" aria-live="polite"></div>
    </div>
    </div>

    <x-footer />

    <script src="{{ asset('js/detail-perusahaan.js') }}"></script>
</body>
</html>
