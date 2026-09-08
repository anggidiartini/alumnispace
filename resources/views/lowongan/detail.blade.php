{{--
    resources/views/lowongan/show.blade.php

    Variabel dari controller:
    - $job          : JobVacancy
    - $relatedJobs  : Collection<JobVacancy> (opsional)

    Disesuaikan dengan field yang BENERAN ada di model JobVacancy:
    posted_by, title, slug, company_name, company_logo, alumni_contact,
    job_type, workplace_type, category, highlight_badge, location,
    salary_display, salary_type, description, requirements, skills_tags,
    application_link, application_email, deadline, is_active.

    Model belum punya company_description / company_maps_url /
    company_website / company_instagram / company_linkedin, jadi
    field-field itu DIHAPUS dari view ini (dulu sempat ditulis di
    comment lama tapi belum pernah ada kolomnya).

    Tombol "Lamar Sekarang" dihitung langsung di sini ($applyUrl):
    pakai application_link kalau ada, kalau kosong fallback ke
    mailto:application_email, kalau dua-duanya kosong tombolnya
    nonaktif. Kalau mau lebih rapi, ini bisa dipindah jadi accessor
    getApplyUrlAttribute() di model JobVacancy — tinggal bilang ke
    temenmu yang pegang model.

    "Tentang perusahaan" (avatar + nama) dibuat jadi link ke halaman
    detail perusahaan (route perusahaan.index). Karena JobVacancy
    CUMA nyimpen company_name (string, bukan relasi ke tabel
    companies), slug perusahaan di-generate dari Str::slug(company_name).
    Ini cuma asumsi sementara — kalau slug company_name nggak match
    persis sama slug di tabel companies, linknya bisa 404. Solusi
    jangka panjang: tambah kolom company_id / company_slug di
    job_vacancies biar link-nya pasti akurat.
--}}
@php
    $applyUrl = $job->application_link
        ?: ($job->application_email ? 'mailto:' . $job->application_email : null);

    $companySlug = Str::slug($job->company_name);
    $companyUrl = route('perusahaan.index', $companySlug);

    // Fallback lamar via WhatsApp kalau application_link & application_email
    // dua-duanya kosong. Nomor ini sementara di-hardcode — kalau nanti mau
    // dibikin dinamis, tinggal ganti jadi kolom baru di JobVacancy
    // (misal `whatsapp_contact`) dan pakai itu sebagai fallback-nya.
    $waFallbackNumber = '6287780341780';
    $waFallbackUrl = 'https://wa.me/' . $waFallbackNumber
        . '?text=' . urlencode('Halo, saya mau lamar untuk posisi ' . $job->title . ' di ' . $job->company_name);
@endphp
<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $job->title }} - {{ $job->company_name }} | Alumni Space Career Hub</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js" defer></script>

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}?v={{ file_exists(public_path('css/detail-lowongan.css')) ? filemtime(public_path('css/detail-lowongan.css')) : time() }}">
</head>

<body>
    <div class="page-wrap">

        <x-navbar/>

        <main id="top">

            {{-- ================= BREADCRUMB ================= --}}
            <section class="page-width breadcrumb-wrap reveal-onscroll">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li aria-hidden="true">/</li>
                        <li><a href="{{ route('lowongan.index') }}">Lowongan</a></li>
                        <li aria-hidden="true">/</li>
                        <li class="breadcrumb-current">{{ $job->title }}</li>
                    </ol>
                </nav>
            </section>

            {{-- ================= HERO ================= --}}
            <section class="page-width reveal-onscroll">
                <div class="job-hero grid-paper">
                    <div class="job-hero-blob job-hero-blob-1 blob" aria-hidden="true"></div>
                    <div class="job-hero-blob job-hero-blob-2 blob" aria-hidden="true"></div>
                    <div class="job-hero-blob job-hero-blob-3 blob" aria-hidden="true"></div>

                    <div class="job-hero-inner">
                        <div class="job-hero-main">
                            <div class="job-hero-tags">
                                <span class="tag tag-sun">{{ $job->job_type ?? 'Full-time' }}</span>
                                @if(!empty($job->highlight_badge))
                                    <span class="tag tag-pink">{{ $job->highlight_badge }}</span>
                                @endif
                                @if($job->is_active)
                                    <span class="tag tag-white">
                                        <span class="status-dot" aria-hidden="true"></span>
                                        Lowongan dibuka
                                    </span>
                                @else
                                    <span class="tag tag-white tag-muted">
                                        <span class="status-dot status-dot-muted" aria-hidden="true"></span>
                                        Lowongan ditutup
                                    </span>
                                @endif
                            </div>

                            <h1 class="job-title">{{ $job->title }}</h1>
                            <a href="{{ $companyUrl }}" class="job-company job-company-link">{{ $job->company_name }}</a>

                            <div class="job-meta">
                                @if(!empty($job->location))
                                    <span class="job-meta-item"><i data-lucide="map-pin" width="16" height="16"></i>{{ $job->location }}</span>
                                @endif
                                @if(!empty($job->workplace_type))
                                    <span class="job-meta-item"><i data-lucide="building-2" width="16" height="16"></i>{{ $job->workplace_type }}</span>
                                @endif
                                <span class="job-meta-item"><i data-lucide="clock-3" width="16" height="16"></i>Diposting {{ optional($job->created_at)->diffForHumans() }}</span>
                                @if($job->deadline)
                                    <span class="job-meta-item"><i data-lucide="calendar-clock" width="16" height="16"></i>Deadline {{ $job->deadline->translatedFormat('d F Y') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="job-hero-actions">
                            <button type="button" id="save-button" class="custom-white-pill-btn" data-slug="{{ $job->slug }}" aria-pressed="false">
                                <i data-lucide="bookmark" width="18" height="18"></i>
                                <span class="save-label">Simpan Lowongan</span>
                                <span class="saved-label">Tersimpan</span>
                            </button>

                            @if($applyUrl)
                                <a href="{{ $applyUrl }}" target="_blank" rel="noopener" class="custom-pill-btn">
                                    Lamar Sekarang
                                    <i data-lucide="arrow-up-right" width="16" height="16"></i>
                                </a>
                            @else
                                <a href="{{ $waFallbackUrl }}" target="_blank" rel="noopener" class="whatsapp-pill-btn">
                                    <span class="whatsapp-pill-icon"><i data-lucide="message-circle" width="15" height="15"></i></span>
                                    Lamar via WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ---- Ringkasan cepat ---- --}}
                <div class="summary-grid reveal-onscroll">
                    <article class="summary-card">
                        <i data-lucide="briefcase-business" width="19" height="19"></i>
                        <p class="summary-label">Tipe pekerjaan</p>
                        <p class="summary-value">{{ $job->job_type ?? '-' }}</p>
                    </article>
                    <article class="summary-card">
                        <i data-lucide="tag" width="19" height="19"></i>
                        <p class="summary-label">Kategori</p>
                        <p class="summary-value">{{ $job->category ?? '-' }}</p>
                    </article>
                    <article class="summary-card">
                        <i data-lucide="map" width="19" height="19"></i>
                        <p class="summary-label">Lokasi</p>
                        <p class="summary-value">{{ $job->location ?? '-' }}</p>
                    </article>
                    @if(!empty($job->salary_display))
                        <article class="summary-card summary-card-highlight">
                            <i data-lucide="banknote" width="19" height="19"></i>
                            <p class="summary-label">Estimasi gaji</p>
                            <p class="summary-value">{{ $job->salary_display }}@if(!empty($job->salary_type)) / {{ $job->salary_type }}@endif</p>
                        </article>
                    @endif
                </div>
            </section>

            {{-- ================= KONTEN UTAMA + SIDEBAR ================= --}}
            <section class="page-width detail-grid">
                <div class="detail-main">

                    <section class="detail-card reveal-onscroll">
                        <button type="button" class="accordion-button" aria-expanded="true">
                            <span>Deskripsi Pekerjaan</span>
                            <i data-lucide="chevron-down" width="22" height="22"></i>
                        </button>
                        <div class="accordion-panel">
                            <p class="section-text">{!! nl2br(e($job->description)) !!}</p>
                        </div>
                    </section>

                    @if(!empty($job->requirements))
                        <section class="detail-card reveal-onscroll">
                            <button type="button" class="accordion-button" aria-expanded="true">
                                <span>Kualifikasi &amp; Persyaratan</span>
                                <i data-lucide="chevron-down" width="22" height="22"></i>
                            </button>
                            <div class="accordion-panel">
                                <p class="section-text">{!! nl2br(e($job->requirements)) !!}</p>
                            </div>
                        </section>
                    @endif

                    @if(!empty($job->skills_tags) && count($job->skills_tags))
                        <section class="detail-card reveal-onscroll">
                            <div class="section-heading">
                                <span class="icon-badge icon-badge-blue" aria-hidden="true">
                                    <i data-lucide="sparkles" width="18" height="18"></i>
                                </span>
                                <h2 class="section-title">Skill yang dibutuhkan</h2>
                            </div>
                            <div class="skills-list">
                                @foreach($job->skills_tags as $skill)
                                    <span class="tag tag-blue-soft">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                {{-- ================= SIDEBAR PERUSAHAAN ================= --}}
                <aside class="company-panel reveal-onscroll">
                    <div class="company-body">
                        <a href="{{ $companyUrl }}" class="company-head company-head-link">
                            <div class="company-avatar">
                                @if(!empty($job->company_logo))
                                    <img loading="lazy" src="{{ $job->company_logo }}" alt="Logo {{ $job->company_name }}">
                                @else
                                    <span class="company-initials">{{ $job->initials }}</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="company-kicker">Tentang perusahaan</h3>
                                <h2 class="company-name">{{ $job->company_name }}</h2>
                                @if(!empty($job->category))
                                    <p class="company-industry">{{ $job->category }}</p>
                                @endif
                            </div>
                        </a>

                        <div class="divider"></div>

                        <dl class="company-facts">
                            @if(!empty($job->workplace_type))
                                <div>
                                    <dt>Tipe tempat kerja</dt>
                                    <dd>{{ $job->workplace_type }}</dd>
                                </div>
                            @endif
                            @if(!empty($job->location))
                                <div>
                                    <dt>Lokasi</dt>
                                    <dd>{{ $job->location }}</dd>
                                </div>
                            @endif
                            @if(!empty($job->alumni_contact))
                                <div>
                                    <dt>Kontak alumni pengunggah</dt>
                                    <dd>{{ $job->alumni_contact }}</dd>
                                </div>
                            @endif
                        </dl>

                        <a href="{{ $companyUrl }}" class="company-maps-link">
                            <i data-lucide="building-2" width="16" height="16"></i>
                            Lihat profil perusahaan
                        </a>

                        @if($applyUrl)
                            <a href="{{ $applyUrl }}" target="_blank" rel="noopener" class="custom-pill-btn full-width">
                                Lamar Sekarang
                                <i data-lucide="arrow-up-right" width="16" height="16"></i>
                            </a>
                        @else
                            <a href="{{ $waFallbackUrl }}" target="_blank" rel="noopener" class="whatsapp-pill-btn full-width">
                                <span class="whatsapp-pill-icon"><i data-lucide="message-circle" width="15" height="15"></i></span>
                                Lamar via WhatsApp
                            </a>
                        @endif
                    </div>
                </aside>
            </section>

            {{-- ================= LOWONGAN SERUPA ================= --}}
            @if(isset($relatedJobs) && $relatedJobs->count())
                <section class="page-width related-wrap reveal-onscroll">
                    <div class="related-head">
                        <div>
                            <p class="section-kicker">Jelajahi peluang lain</p>
                            <h2 class="section-title">Lowongan Serupa</h2>
                        </div>
                    </div>

                    <div class="related-grid">
                        @foreach($relatedJobs as $i => $related)
                            @php $colors = ['blue', 'pink', 'yellow']; $color = $colors[$i % 3]; @endphp
                            <a href="{{ route('lowongan.show', $related->slug) }}" class="related-card">
                                <div class="related-icon related-icon-{{ $color }}">
                                    <i data-lucide="briefcase" width="20" height="20"></i>
                                </div>
                                <h3 class="related-job-title">{{ $related->title }}</h3>
                                <p class="related-job-company">{{ $related->company_name }}</p>
                                <div class="related-tags">
                                    <span class="tag tag-{{ $color }}">{{ $related->job_type ?? '-' }}</span>
                                    @if(!empty($related->location))
                                        <span class="tag tag-white">{{ $related->location }}</span>
                                    @endif
                                </div>
                                <span class="custom-white-pill-btn full-width">Lihat Lowongan</span>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

        </main>

        <x-footer/>
    </div>

    <div id="toast" class="toast" role="status"></div>

    {{-- ================= FLOATING: back-to-top & WhatsApp ================= --}}
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
                <p class="wa-bubble-text">Hubungi pengurus alumni kami via WhatsApp 👋</p>
                <p class="wa-bubble-number">+62 812-3456-7890</p>
            </div>
            <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20Alumni%20Space%2C%20saya%20mau%20tanya%20soal%20lowongan%20{{ urlencode($job->title) }}" target="_blank" rel="noopener" class="wa-pulse" aria-label="Hubungi kami via WhatsApp">
                <i data-lucide="message-circle" width="26" height="26"></i>
            </a>
        </div>
    </div>

    <script src="{{ asset('js/detail-lowongan.js') }}?v={{ file_exists(public_path('js/detail-lowongan.js')) ? filemtime(public_path('js/detail-lowongan.js')) : time() }}" defer></script>
</body>

</html>