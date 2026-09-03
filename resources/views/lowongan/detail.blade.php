<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $job->title }} - {{ $job->company_name }} | Alumni Space Career Hub</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@0.577.0/dist/umd/lucide.min.js" defer></script>

  <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}">
</head>
<body>

  <header class="site-header" data-animate="fade-down">
    <div class="header-inner">
      <a href="{{ url('/') }}" class="brand" aria-label="Alumni Space Career Hub">
        <span class="brand-badge">A</span>
        <span class="brand-name">ALUMNI SPACE CAREER HUB</span>
      </a>

      <nav class="nav-desktop" aria-label="Navigasi utama">
        <a class="nav-link" href="{{ url('/') }}">Beranda</a>
        <a class="nav-link" href="{{ route('lowongan.index') }}">Lowongan</a>
        <a class="nav-link" href="#perusahaan">Perusahaan</a>
      </nav>

      <div class="nav-desktop">
        @auth
          <span class="btn btn-secondary">{{ Auth::user()->name }}</span>
        @else
          <a href="{{ route('login') }}" class="btn btn-secondary">Masuk</a>
        @endauth
      </div>

      <button id="menu-toggle" type="button" class="menu-toggle" aria-label="Buka menu" aria-expanded="false">
        <i data-lucide="menu" width="21" height="21"></i>
      </button>
    </div>

    <nav id="mobile-menu" class="nav-mobile" aria-label="Navigasi mobile">
      <a class="nav-link nav-link-mobile" href="{{ url('/') }}">Beranda</a>
      <a class="nav-link nav-link-mobile" href="{{ route('lowongan.index') }}">Lowongan</a>
      <a class="nav-link nav-link-mobile" href="#perusahaan">Perusahaan</a>
      @auth
        <span class="btn btn-secondary btn-block">{{ Auth::user()->name }}</span>
      @else
        <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Masuk</a>
      @endauth
    </nav>
  </header>

  <main id="beranda">

    <section class="wrap breadcrumb-wrap" data-animate="fade-up">
      <nav aria-label="Breadcrumb">
        <ol class="breadcrumb">
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li aria-hidden="true">/</li>
          <li><a href="{{ route('lowongan.index') }}">Lowongan</a></li>
          <li aria-hidden="true">/</li>
          <li class="breadcrumb-current">{{ $job->title }}</li>
        </ol>
      </nav>

      <section class="job-hero reveal" data-animate="fade-up">
        <div class="job-hero-blob job-hero-blob-1"></div>
        <div class="job-hero-blob job-hero-blob-2"></div>

        <div class="job-hero-inner">
          <div class="job-hero-main">
            <span class="tag tag-sun">{{ $job->job_type ?? 'Full-time' }}</span>
            <h1 class="job-title">{{ $job->title }}</h1>
            <p class="job-company">{{ $job->company_name }}</p>

            <div class="job-meta">
              @if(!empty($job->location))
                <span class="job-meta-item"><i data-lucide="map-pin" width="17"></i>{{ $job->location }}</span>
              @endif
              <span class="job-meta-item"><i data-lucide="clock-3" width="17"></i>Dipublikasikan {{ optional($job->created_at)->diffForHumans() }}</span>
            </div>
          </div>

          <div class="job-hero-actions">
            <button type="button" id="save-button" class="btn btn-secondary" data-slug="{{ $job->slug }}" aria-pressed="false">
              <i data-lucide="bookmark" width="18"></i>
              <span class="save-label">Simpan Lowongan</span>
              <span class="saved-label">Tersimpan</span>
            </button>
            <button type="button" class="btn btn-primary" data-scroll-apply>Lamar Sekarang</button>
          </div>
        </div>
      </section>

      <div class="summary-grid reveal" data-animate="fade-up" data-delay="1">
        <article class="summary-card">
          <i data-lucide="briefcase-business" width="19"></i>
          <p class="summary-label">Tipe pekerjaan</p>
          <p class="summary-value">{{ $job->job_type ?? '-' }}</p>
        </article>
        <article class="summary-card">
          <i data-lucide="tag" width="19"></i>
          <p class="summary-label">Kategori</p>
          <p class="summary-value">{{ $job->category ?? '-' }}</p>
        </article>
        <article class="summary-card">
          <i data-lucide="map" width="19"></i>
          <p class="summary-label">Lokasi</p>
          <p class="summary-value">{{ $job->location ?? '-' }}</p>
        </article>
        @if(!empty($job->salary_min) && !empty($job->salary_max))
        <article class="summary-card summary-card-highlight">
          <i data-lucide="banknote" width="19"></i>
          <p class="summary-label">Kisaran gaji</p>
          <p class="summary-value">
            Rp{{ number_format($job->salary_min / 1000000, 0) }}–{{ number_format($job->salary_max / 1000000, 0) }} juta / bulan
          </p>
        </article>
        @endif
      </div>
    </section>

    <section class="wrap detail-grid">
      <div class="detail-main">

        <section class="accordion-card reveal" data-animate="fade-up">
          <button type="button" class="accordion-button" aria-expanded="true">
            <span>Deskripsi Pekerjaan</span>
            <i data-lucide="chevron-down" width="22"></i>
          </button>
          <div class="accordion-panel">
            <p>{{ $job->description }}</p>
          </div>
        </section>

        @if(!empty($job->responsibilities))
        <section class="accordion-card reveal" data-animate="fade-up" data-delay="1">
          <button type="button" class="accordion-button" aria-expanded="true">
            <span>Tanggung Jawab</span>
            <i data-lucide="chevron-down" width="22"></i>
          </button>
          <div class="accordion-panel">
            <ul class="dot-list dot-list-pink">
              @foreach($job->responsibilities as $item)
                <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
        </section>
        @endif

        @if(!empty($job->qualifications))
        <section class="accordion-card reveal" data-animate="fade-up" data-delay="2">
          <button type="button" class="accordion-button" aria-expanded="true">
            <span>Kualifikasi &amp; Persyaratan</span>
            <i data-lucide="chevron-down" width="22"></i>
          </button>
          <div class="accordion-panel">
            <ul class="dot-list dot-list-blue">
              @foreach($job->qualifications as $item)
                <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
        </section>
        @endif
      </div>

      <aside id="perusahaan" class="company-panel reveal" data-animate="fade-left">
        @if(!empty($job->company_banner))
          <img class="company-banner" loading="lazy" src="{{ $job->company_banner }}" alt="Banner {{ $job->company_name }}">
        @endif
        <div class="company-body">
          <div class="company-head">
            @if(!empty($job->company_logo))
            <div class="company-avatar">
              <img loading="lazy" src="{{ $job->company_logo }}" alt="Logo {{ $job->company_name }}">
            </div>
            @endif
            <div>
              <h3 class="company-kicker">Tentang {{ $job->company_name }}</h3>
              <h2 class="company-name">{{ $job->company_name }}</h2>
              @if(!empty($job->category))
                <p class="company-industry">{{ $job->category }}</p>
              @endif
            </div>
          </div>

          @if(!empty($job->company_description))
            <p class="company-desc">{{ $job->company_description }}</p>
          @endif

          <div class="divider"></div>

          <a href="#perusahaan" class="company-profile-link">Lihat profil perusahaan →</a>
          <button type="button" class="btn btn-primary btn-block" data-scroll-apply>Lamar Sekarang</button>
        </div>
      </aside>
    </section>

    <section id="lamar" class="wrap apply-wrap">
      <div class="apply-card reveal" data-animate="zoom-in">

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div id="application-form-wrap">
          <div class="apply-grid">
            <div>
              <span class="tag tag-sun">Mulai langkahmu</span>
              <h2 class="apply-title">Kirim lamaran terbaikmu.</h2>
              <p class="apply-helper">Ceritakan sedikit tentang dirimu dan sertakan tautan portofolio yang paling mewakili perjalananmu.</p>
              <p class="apply-position">Posisi yang dilamar: <strong>{{ $job->title }}</strong></p>

              @guest
                <p class="apply-login-notice">
                  Kamu perlu <a href="{{ route('login') }}">login</a> terlebih dahulu sebelum bisa melamar posisi ini.
                </p>
              @endguest
            </div>

            <form id="application-form" novalidate
                  data-apply-url="{{ route('lowongan.apply', $job->id) }}"
                  data-authenticated="{{ auth()->check() ? '1' : '0' }}"
                  data-login-url="{{ route('login') }}">
              @csrf

              <div class="form-field">
                <label for="cover-letter">Cover letter</label>
                <textarea id="cover-letter" name="cover_letter" rows="5" maxlength="2000"></textarea>
                <p class="field-error">Cover letter maksimal 2000 karakter.</p>
              </div>

              <div class="form-field">
                <label for="portfolio-url">Tautan portofolio</label>
                <input id="portfolio-url" name="portfolio_url" type="url">
                <p class="field-error">Masukkan tautan yang valid.</p>
              </div>

              <p id="form-status" class="form-status hidden" aria-live="polite"></p>

              <button id="submit-application" type="submit" class="btn btn-accent btn-block">Kirim Lamaran</button>
            </form>
          </div>
        </div>

        <div id="success-state" class="success-state hidden" aria-live="polite">
          <div class="success-icon"><i data-lucide="check" width="34"></i></div>
          <h2 class="success-title">Lamaran berhasil dikirim</h2>
          <p class="success-message">Terima kasih sudah melangkah bersama kami. Tim {{ $job->company_name }} akan meninjau lamaranmu.</p>
        </div>
      </div>
    </section>

    @if($relatedJobs->count())
    <section id="lowongan-serupa" class="wrap related-wrap">
      <div class="related-head reveal" data-animate="fade-up">
        <div>
          <p class="related-kicker">Jelajahi peluang lain</p>
          <h2 class="related-title">Lowongan Serupa</h2>
        </div>
        <p class="related-helper">Pilih kartu untuk melihat detailnya.</p>
      </div>

      <div class="related-grid">
        @foreach($relatedJobs as $i => $related)
          @php $colors = ['blue','pink','mint']; $color = $colors[$i % 3]; @endphp
          <article class="related-card reveal" data-animate="fade-up" data-delay="{{ $i }}">
            <a href="{{ route('lowongan.show', $related->slug) }}" class="related-card-link">
              <div class="related-icon related-icon-{{ $color }}">
                <i data-lucide="briefcase" width="21"></i>
              </div>
              <h3 class="related-job-title">{{ $related->title }}</h3>
              <p class="related-job-company">{{ $related->company_name }}</p>
              <div class="related-tags">
                <span class="tag tag-{{ $color }}">{{ $related->job_type ?? '-' }}</span>
                @if(!empty($related->location))
                  <span class="tag tag-sun-soft">{{ $related->location }}</span>
                @endif
              </div>
              <span class="btn btn-secondary btn-block">Lihat Lowongan</span>
            </a>
          </article>
        @endforeach
      </div>
    </section>
    @endif

  </main>

  <footer class="site-footer">
    <div class="wrap footer-inner">
      <p>© {{ date('Y') }} Alumni Space Career Hub</p>
      <nav class="footer-nav" aria-label="Tautan footer">
        <a href="#bantuan">Bantuan</a>
        <a href="#privasi">Kebijakan Privasi</a>
        <a href="#kontak">Kontak</a>
      </nav>
    </div>
  </footer>

  <div id="toast" class="toast" role="status">Lowongan berhasil diperbarui.</div>

  <script src="{{ asset('js/detail-lowongan.js') }}" defer></script>
</body>
</html>