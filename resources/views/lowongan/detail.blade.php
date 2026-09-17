{{--
    resources/views/lowongan/show.blade.php

    Variabel dari controller:
    - $job          : JobVacancy
    - $relatedJobs  : Collection<JobVacancy> (opsional)
--}}
@php
    $applyUrl = $job->application_link
        ?: ($job->application_email ? 'mailto:' . $job->application_email : null);

    $companySlug = Str::slug($job->company_name);
    $companyUrl = route('perusahaan.index', $companySlug);

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

    <link rel="stylesheet"
        href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/home.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}?v={{ file_exists(public_path('css/detail-lowongan.css')) ? filemtime(public_path('css/detail-lowongan.css')) : time() }}">
</head>

<body>
    <div class="page-wrap">

        <x-navbar/>

        <main id="top">

            {{-- ================= HERO ================= --}}
            <section class="page-width reveal-onscroll hero-section-top">
                <section class="page-width reveal-onscroll hero-section-top">

    <a href="{{ route('lowongan.index') }}" class="back-link">
        <i data-lucide="arrow-left" width="18" height="18"></i>
        Kembali ke Lowongan
    </a>

             <div class="deco-asset dl-hero-l1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="aset-alattulis floaty">
                </div>
                <div class="deco-asset dl-hero-l2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="aset-bus wiggle">
                </div>
                <div class="deco-asset dl-hero-r1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam floaty-slow">
                </div>
                <div class="deco-asset dl-hero-r2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="aset-papantulis wiggle">
                </div>

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
                            {{-- Memakai route('perusahaan.index') yang sudah dipastikan aman --}}
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


                            @if($applyUrl)
                                <a href="{{ $applyUrl }}" target="_blank" rel="noopener" class="custom-pill-btn">
                                    Lamar Sekarang
                                    <i data-lucide="arrow-up-right" width="16" height="16"></i>
                                </a>
                            @else

                            @endif
                        </div>
                    </div>
                </div>

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

            <section class="page-width detail-grid">
                 <div class="deco-asset dl-grid-l1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="aset-lampu floaty">
                </div>
                <div class="deco-asset dl-grid-l2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam floaty-slow">
                </div>
                <div class="deco-asset dl-grid-r1 reveal-onscroll" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="aset-bus wiggle">
                </div>
                <div class="deco-asset dl-grid-r2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="aset-alattulis floaty">
                </div>

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

                <aside class="company-panel reveal-onscroll">
                    <div class="company-body">
                        <a href="{{ $companyUrl }}" class="company-head company-head-link">
                            <div class="company-avatar">
                                @php
                                    $logoSrc = !empty($job->company_logo)
                                        ? $job->company_logo
                                        : asset('assets/images/imagedefault.png');
                                @endphp
                                <img loading="lazy"
                                     src="{{ $logoSrc }}"
                                     alt="Logo {{ $job->company_name }}"
                                     onerror="this.onerror=null; this.src='{{ asset('assets/anggi/imagedefault.png') }}'">
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

            {{-- Lowongan Serupa --}}
            @if(isset($relatedJobs) && $relatedJobs->count())
                <section class="page-width related-wrap reveal-onscroll">

                <div class="deco-asset dl-related-l1 reveal-onscroll" aria-hidden="true">
                        <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="aset-papantulis floaty-slow">
                    </div>
                    <div class="deco-asset dl-related-l2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                        <img src="{{ asset('assets/images/deco-lampu.png') }}" alt="" class="aset-lampu wiggle">
                    </div>
                    <div class="deco-asset dl-related-r1 reveal-onscroll" aria-hidden="true">
                        <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="aset-alattulis floaty">
                    </div>
                    <div class="deco-asset dl-related-r2 reveal-onscroll" style="animation-delay:.1s" aria-hidden="true">
                        <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="aset-bus floaty-slow">
                    </div>

                    <div class="related-head">
                        <div>
                            <p class="section-kicker">Jelajahi peluang lain</p>
                            <h2 class="section-title">Lowongan Serupa</h2>
                        </div>
                    </div>

                    <div class="related-grid">
                        @foreach($relatedJobs as $i => $related)
                            @php $colors = ['blue', 'pink', 'yellow']; $color = $colors[$i % 3]; @endphp
                            {{-- Diperbaiki ke route lowongan.show agar mengarah ke detail lowongan yang bersangkutan --}}
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
            <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20Alumni%20Space" target="_blank"
                rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
                <i data-lucide="message-circle" width="26" height="26"></i>
            </a>
        </div>
    </div>

    <div id="toast" class="toast" role="status"></div>

    <div id="fab-row" class="fab-row">
    <button id="back-to-top" type="button" class="focus-ring" aria-label="Kembali ke atas">
        <i data-lucide="arrow-up" width="20" height="20"></i>
    </button>


    <script src="{{ asset('js/detail-lowongan.js') }}?v={{ file_exists(public_path('js/detail-lowongan.js')) ? filemtime(public_path('js/detail-lowongan.js')) : time() }}" defer></script>
</body>

</html>