<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $article->title }} | Alumni Space</title>

    <link rel="preconnect" href="https://googleapis.com">
    <link
        href="https://googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fredoka:wght@500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com" defer></script>

    <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}">
</head>

<body>

    <!-- =========================================
       HEADER & NAVIGATION
       ========================================= -->
    <header class="site-header" data-animate="fade-down">
        <div class="header-inner">
            <a href="{{ url('/') }}" class="brand" aria-label="Alumni Space">
                <span class="brand-badge">A</span>
                <span class="brand-name">ALUMNI SPACE ARTIKEL</span>
            </a>

            <nav class="nav-desktop" aria-label="Navigasi utama">
                <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                <a class="nav-link" href="{{ route('artikel.index') }}">Artikel</a>
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
            <a class="nav-link nav-link-mobile" href="{{ route('artikel.index') }}">Artikel</a>
            @auth
                <span class="btn btn-secondary btn-block">{{ Auth::user()->name }}</span>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Masuk</a>
            @endauth
        </nav>
    </header>

    <main id="beranda">

        <!-- =========================================
         BREADCRUMB & HERO AREA ARTIKEL
         ========================================= -->
        <section class="wrap breadcrumb-wrap" data-animate="fade-up">
            <nav aria-label="Breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('artikel.index') }}">Artikel</a></li>
                    <li aria-hidden="true">/</li>
                    <li class="breadcrumb-current">{{ $article->title }}</li>
                </ol>
            </nav>

            <section class="job-hero reveal" data-animate="fade-up">
                <div class="job-hero-blob job-hero-blob-1"></div>
                <div class="job-hero-blob job-hero-blob-2"></div>

                <div class="job-hero-inner">
                    <div class="job-hero-main">
                        <span class="tag tag-sun">{{ $article->kategori }}</span>
                        <h1 class="job-title">{{ $article->title }}</h1>
                        <p class="job-company">Oleh: {{ $article->user->name ?? 'Anonim' }}</p>

                        <span class="job-meta-item">
                            <i data-lucide="clock-3" width="17"></i>
                            Dipublikasikan
                            {{ $article->created_at ? $article->created_at->diffForHumans() : 'Baru saja' }}
                        </span>

                    </div>

                    <div class="job-hero-actions">
                        <a href="{{ route('artikel.index') }}" class="btn btn-secondary">
                            <i data-lucide="arrow-left" width="18"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Summary Card Artikel -->
            <div class="summary-grid reveal" data-animate="fade-up" data-delay="1">
                <article class="summary-card">
                    <i data-lucide="tag" width="19"></i>
                    <p class="summary-label">Kategori</p>
                    <p class="summary-value">{{ $article->kategori }}</p>
                </article>
                <article class="summary-card">
                    <i data-lucide="user" width="19"></i>
                    <p class="summary-label">Penulis</p>
                    <p class="summary-value">{{ $article->user->name ?? 'Anonim' }}</p>
                </article>
                <article class="summary-card">
                    <i data-lucide="calendar" width="19"></i>
                    <p class="summary-label">Tanggal Rilis</p>
                    <p class="summary-value">
                        {{ $article->created_at ? $article->created_at->translatedFormat('d M Y') : '-' }}</p>
                </article>

            </div>
        </section>

        <!-- =========================================
         DETAIL GRID CONTENT
         ========================================= -->
        <section class="wrap detail-grid">
            <div class="detail-main">

                <section class="accordion-card reveal" data-animate="fade-up">
                    <button type="button" class="accordion-button" aria-expanded="true">
                        <span>Isi Konten Artikel</span>
                        <i data-lucide="chevron-down" width="22"></i>
                    </button>
                    <div class="accordion-panel" style="padding: 20px; color: #333;">

                        <!-- Gambar Utama Artikel jika ada di DB -->
                        @if ($article->gambar_utama)
                            <div
                                style="margin-bottom: 25px; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;">
                                <img src="{{ asset('storage/' . $article->gambar_utama) }}"
                                    alt="{{ $article->title }}" style="width: 100%; height: auto; display: block;">
                            </div>
                        @endif

                        <!-- Konten Utama Teks Editor -->
                        <div style="line-height: 1.8; font-size: 17px;">
                            {!! $article->konten !!}
                        </div>

                    </div>
                </section>
            </div>

            <!-- SIDEBAR (Profil Kontributor senada dengan panel perusahaan) -->
            <aside id="perusahaan" class="company-panel reveal" data-animate="fade-left">
                <div class="company-body">
                    <div class="company-head">
                        <div class="company-avatar"
                            style="background: #1e40af; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px;">
                            {{ strtoupper(substr($article->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="company-kicker">Profil Penulis</h3>
                            <h2 class="company-name">{{ $article->user->name ?? 'Anonim' }}</h2>
                            <p class="company-industry">Kontributor Komunitas</p>
                        </div>
                    </div>

                    <p class="company-desc" style="margin-top: 15px; font-size: 14px; color: #555; line-height: 1.6;">
                        Terima kasih telah membaca artikel ini. Terus pantau linimasa untuk mendapatkan tips karier,
                        kabar alumni terbaru, dan kenangan indah lainnya seputar ruang lingkup alumni kita.
                    </p>

                    <div class="divider" style="margin: 20px 0; border-top: 1px dashed #cbd5e1;"></div>

                    <a href="{{ route('artikel.index') }}" class="company-profile-link">Lihat semua artikel alumni
                        →</a>
                </div>
            </aside>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Handler Menu Navigasi Mobile
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener("click", function() {
                    const expanded = menuToggle.getAttribute("aria-expanded") === "true";
                    menuToggle.setAttribute("aria-expanded", !expanded);
                    mobileMenu.classList.toggle("is-open", !expanded);
                });
            }

            // Handler Buka-Tutup Panel Accordion Isi Artikel
            document.querySelectorAll(".accordion-button").forEach(button => {
                button.addEventListener("click", () => {
                    const expanded = button.getAttribute("aria-expanded") === "true";
                    button.setAttribute("aria-expanded", !expanded);
                    const panel = button.nextElementSibling;
                    if (panel) {
                        panel.style.display = expanded ? "none" : "block";
                    }
                });
            });
        });
    </script>

</body>

</html>
