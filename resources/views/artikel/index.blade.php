<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel &amp; Cerita Alumni</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&family=Fredoka:wght@500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --navy: #1E40AF;
            --ink: #16336f;
            --pink: #FCE7F3;
            --sky-line: rgba(96, 165, 250, 0.16);
            --cream: #fffdf7;

            /* Token tombol & badge disamakan dengan hero home/album */
            --btn-border: #0a4174;
            --btn-fill: #7bbde8;
            --btn-hover: #fae588;
            --badge-bg: #f9f6bd;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            width: 100%;
            font-family: "DM Sans", sans-serif;
            color: var(--ink);
        }

        /* =========================================
       SECTION 1 — HERO PEMBUKA (baru)
       ========================================= */
        .hero-open {
            width: 100%;
            position: relative;
            overflow: hidden;
            padding: 96px 24px 78px;
            background-color: var(--cream);
            background-image:
                linear-gradient(var(--sky-line) 1px, transparent 1px),
                linear-gradient(90deg, var(--sky-line) 1px, transparent 1px);
            background-size: 21px 21px;
            text-align: center;
        }

        .hero-open-inner {
            max-width: 680px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero-open .scribble-star {
            top: 10px;
            right: 6%;
            color: #f8bd24;
            transform: rotate(12deg);
        }

        .hero-open .scribble-loop {
            left: -20px;
            bottom: 14%;
            width: 80px;
            height: 50px;
            border: 3px dashed #f9a8d4;
            border-radius: 52% 48% 46% 54%;
            transform: rotate(14deg);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 16px;
            margin-bottom: 20px;
            border: 2px dashed var(--btn-border);
            border-radius: 999px;
            background: var(--badge-bg);
            color: var(--btn-border);
            font-weight: 700;
            font-size: 13px;
            letter-spacing: .04em;
        }

        .hero-open-title {
            margin: 0 0 16px;
            font-family: 'Fredoka', 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: clamp(30px, 4.5vw, 46px);
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        .hero-open-title .pop {
            color: var(--navy);
        }

        .hero-open-subtitle {
            margin: 0 auto 32px;
            max-width: 520px;
            font-size: 16px;
            line-height: 1.7;
            color: #47638f;
        }

        .hero-open-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--btn-fill);
            color: var(--btn-border);
            border: 3px solid var(--btn-border);
            border-radius: 999px;
            padding: 14px 28px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 6px 0 var(--btn-border);
            transition: transform .2s ease, background-color .2s ease, box-shadow .2s ease;
        }

        .hero-open-cta:hover {
            background: var(--btn-hover);
            transform: translateY(-3px);
            box-shadow: 0 9px 0 var(--btn-border);
        }

        .hero-open-cta:active {
            transform: translateY(2px);
            box-shadow: 0 3px 0 var(--btn-border);
        }

        .hero-open-cta svg {
            transition: transform .25s ease;
        }

        .hero-open-cta:hover svg {
            transform: translateY(3px);
        }

        @media (max-width: 590px) {
            .hero-open {
                padding: 64px 18px 56px;
            }

            .hero-open .scribble-loop,
            .hero-open .scribble-star {
                display: none;
            }
        }

        /* =========================================
       SECTION 2 — GRID ARTIKEL (kodingan asli, tidak diubah)
       ========================================= */
        .alumni-section {
            width: 100%;
            position: relative;
            overflow: hidden;
            padding: 72px 24px 88px;
            background-image:
                linear-gradient(var(--sky-line) 1px, transparent 1px),
                linear-gradient(90deg, var(--sky-line) 1px, transparent 1px);
            background-size: 21px 21px;
            scroll-margin-top: 24px;
        }

        .section-shell {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            position: relative;
        }

        .scribble {
            position: absolute;
            pointer-events: none;
            z-index: 0;
        }

        .scribble-star {
            top: 4px;
            right: 3%;
            color: #f8bd24;
            transform: rotate(12deg);
        }

        .scribble-loop {
            left: -34px;
            top: 173px;
            width: 95px;
            height: 58px;
            border: 3px dashed #f9a8d4;
            border-radius: 52% 48% 46% 54%;
            transform: rotate(-16deg);
        }

        .section-head {
            position: relative;
            z-index: 1;
            max-width: 660px;
            margin: 0 auto 34px;
            text-align: center;
        }

        .eyebrow-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            margin-bottom: 14px;
            border: 1.5px dashed var(--navy);
            border-radius: 999px;
            background: #fffde7;
            transform: rotate(-1deg);
        }

        .eyebrow-dot {
            width: 9px;
            height: 9px;
            border-radius: 999px;
            background: #f9a8d4;
            box-shadow: 2px 2px 0 #1e40af;
        }

        .filter-nav {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 35px;
        }

        .filter-tab {
            border: 1.5px solid #bed4ff;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 0.91rem;
            font-weight: 700;
            line-height: 1;
            cursor: pointer;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease, color .18s ease;
        }

        .filter-tab:hover {
            transform: translateY(-2px) rotate(-1deg);
        }

        .filter-tab:focus-visible,
        .article-button:focus-visible {
            outline: 3px solid #f9a8d4;
            outline-offset: 3px;
        }

        .filter-tab.is-active {
            box-shadow: 3px 3px 0 #f9a8d4;
            transform: rotate(-1deg);
        }

        .article-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
        }

        .article-card {
            min-width: 0;
            overflow: hidden;
            border: 1.5px solid #c7d7ff;
            border-radius: 24px;
            box-shadow: 0 8px 0 rgba(30, 64, 175, 0.07);
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        }

        .article-card:hover,
        .article-card:focus-within {
            transform: translateY(-7px);
            border-color: #8eb2ff;
            box-shadow: 0 18px 30px rgba(30, 64, 175, 0.16);
        }

        .article-card.is-hidden {
            display: none !important;
        }

        .article-thumb {
            min-height: 188px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 18px;
        }

        .article-thumb::before {
            content: "";
            position: absolute;
            inset: 11px;
            border: 2px solid rgba(255, 255, 255, 0.82);
            border-radius: 17px;
            transform: rotate(-2deg);
        }

        .article-thumb::after {
            content: "";
            width: 86px;
            height: 86px;
            position: absolute;
            border-radius: 50%;
            right: -20px;
            top: -23px;
            background: rgba(255, 255, 255, 0.45);
        }

        .thumb-art {
            position: relative;
            z-index: 1;
            width: 100%;
            min-height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .art-paper {
            width: 76%;
            padding: 12px 14px;
            border: 2px solid #fff;
            border-radius: 8px;
            color: #fff;
            text-align: center;
            font-size: 1.02rem;
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -0.02em;
            background: rgba(30, 64, 175, .22);
            box-shadow: 5px 5px 0 rgba(255, 255, 255, .35);
            transform: rotate(-4deg);
        }

        .thumb-symbol {
            position: absolute;
            color: #fff;
            opacity: .95;
        }

        .card-body {
            padding: 20px 20px 21px;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 13px;
            font-size: .78rem;
            font-weight: 700;
        }

        .category-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 999px;
            white-space: nowrap;
        }

        .article-title {
            margin: 0 0 10px;
            line-height: 1.18;
            letter-spacing: -0.025em;
        }

        .summary {
            min-height: 68px;
            margin: 0 0 17px;
            font-size: .92rem;
            line-height: 1.55;
        }

        .article-button {
            width: 100%;
            min-height: 43px;
            border: 1.5px solid #1E40AF;
            border-radius: 12px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .18s ease, background .18s ease, color .18s ease;
        }

        .article-button:hover {
            transform: translateX(3px);
            background: #1E40AF !important;
            color: #ffffff !important;
        }

        .article-preview {
            display: none;
            margin-top: 13px;
            padding: 12px 13px;
            border: 1.5px dashed #94b6ff;
            border-radius: 12px;
            font-size: .84rem;
            line-height: 1.45;
        }

        .article-card.is-open .article-preview {
            display: block;
        }

        .corner-tape {
            position: absolute;
            z-index: 2;
            top: -6px;
            left: 50%;
            width: 58px;
            height: 19px;
            background: rgba(252, 231, 243, 0.85);
            transform: translateX(-50%) rotate(-4deg);
        }

        .article-card .summary {
            display: -webkit-box !important;
            visibility: visible !important;
            opacity: 1 !important;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-top: 10px;
            margin-bottom: 15px;
            height: 48px;
            /* Menjaga tinggi card tetap seragam */
        }

        .alumni-section,
        .grid,
        [class*="grid"] {
            align-items: start !important;
        }

        .article-card.is-hidden {
            display: none !important;
        }

        @media (max-width: 900px) {
            .article-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 590px) {
            .alumni-section {
                padding: 55px 16px 68px;
            }

            .article-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .section-head {
                margin-bottom: 27px;
            }

            .filter-nav {
                justify-content: flex-start;
            }

            .filter-tab {
                padding: 10px 13px;
            }

            .scribble-loop {
                left: -48px;
            }
        }
    </style>
</head>

<body data-template-id="__page-root" style="background: rgb(255, 255, 255);">

    <!-- =========================================
       SECTION 1 — HERO PEMBUKA (baru, gaya senada dengan hero album)
       ========================================= -->
    <section class="hero-open" aria-label="Pembuka artikel alumni">
        <div class="scribble scribble-star" aria-hidden="true"><i data-lucide="sparkles" width="26"
                height="26"></i></div>
        <div class="scribble scribble-loop" aria-hidden="true"></div>
        <div class="hero-open-inner">
            <div class="hero-badge"><span>✦</span> CERITA &amp; INSPIRASI</div>
            <h1 class="hero-open-title">Cerita yang <span class="pop">Layak Dibaca Ulang</span>, Ditulis oleh Alumni
                Sendiri</h1>
            <p class="hero-open-subtitle">Dari kabar reuni sampai tips karier, setiap tulisan di sini datang dari
                pengalaman nyata teman-teman seangkatanmu. Yuk, telusuri satu per satu.</p>
            <button class="hero-open-cta" id="scroll-to-articles" type="button">
                Baca Artikel
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#0a4174"
                    stroke-width="2.6">
                    <path d="M12 5v14M5 12l7 7 7-7" />
                </svg>
            </button>
        </div>
    </section>

    <!-- =========================================
       SECTION 2 — GRID ARTIKEL (kodingan asli kamu, tidak diubah)
       ========================================= -->
    <main class="alumni-section" aria-labelledby="article-section-title">
        <div class="section-shell">
            <div class="scribble scribble-star" aria-hidden="true"><i data-lucide="sparkles" width="29"
                    height="29"></i>
            </div>
            <div class="scribble scribble-loop" aria-hidden="true"></div>
            <header class="section-head">
                <div class="eyebrow-wrap"><span class="eyebrow-dot" aria-hidden="true"></span> <span
                        data-template-id="article-eyebrow" class="canva-text"
                        style="color: rgb(30, 64, 175); font-weight: 700; font-style: normal; font-size: 13px;">Cerita
                        dari komunitas kita</span>
                </div>
                <h2 id="article-section-title" data-template-id="article-section-title"
                    class="canva-text font-extrabold"
                    style="color: rgb(30, 64, 175); font-weight: 800; font-style: normal; font-size: 24px;">Artikel
                    &amp; Cerita Alumni</h2>
                <p data-template-id="article-section-description" class="canva-text mt-3 leading-relaxed"
                    style="color: rgb(71, 99, 143); font-weight: 400; font-style: normal; font-size: 17px;">Kumpulan
                    kabar hangat, pelajaran karier, dan memori kecil dari alumni yang terus bertumbuh bersama.</p>
            </header>
            <nav class="filter-nav" aria-label="Filter kategori artikel" role="tablist">
                <!-- Tombol Semua -->
                <button type="button" data-filter="all" class="filter-tab is-active canva-button"
                    data-template-id="filter-all" role="tab" aria-selected="true"
                    style="background: rgb(30, 64, 175); color: rgb(255, 255, 255); font-weight: 700; font-style: normal; font-size: 16px;">
                    Semua
                </button>

                @php
                    // 1. Ambil data kategori unik dari DB, ubah teksnya jadi rapi (huruf besar di awal kata)
                    $kategoriDariDb = $articles
                        ->pluck('kategori')
                        ->filter()
                        ->unique()
                        ->map(function ($item) {
                            return ucwords(trim($item));
                        });

                    // 2. Daftar kategori standar bawaan sebagai cadangan awal
                    $kategoriDefault = collect(['Kabar Alumni', 'Tips & Karir', 'Kenangan']);

                    // 3. Gabungkan keduanya agar jika ada kategori baru di DB (seperti 'tips'), dia langsung ikut muncul
                    $daftarKategori = $kategoriDefault->merge($kategoriDariDb)->unique();
                @endphp

                <!-- Looping Tombol Kategori Gabungan -->
                @foreach ($daftarKategori as $kategori)
                    <button type="button" data-filter="{{ Str::slug($kategori) }}" class="filter-tab canva-button"
                        data-template-id="filter-{{ Str::slug($kategori) }}" role="tab" aria-selected="false"
                        style="background: rgb(255, 255, 255); color: rgb(30, 64, 175); font-weight: 700; font-style: normal; font-size: 16px; margin-left: 8px;">
                        {{ $kategori }}
                    </button>
                @endforeach
            </nav>


            <!-- ====================================================================
         BAGIAN GRID ARTIKEL DINAMIS (CUMA PAKAI CETAKAN CARD-2 DI-LOOPING)
         ==================================================================== -->
            <section id="article-grid" class="article-grid" aria-label="Daftar artikel alumni">

                <!-- Loop $articles menggunakan variabel $index untuk variasi warna, mirip halaman album -->
                @forelse($articles as $index => $article)
                    @php
                        // Array daftar variasi warna asli buatan temen lu agar tetep beda-beda tiap data nambah
                        $gradients = [
                            'linear-gradient(135deg, rgb(252, 231, 243), rgb(249, 168, 212))', // Pink asli Card 2
                            'linear-gradient(135deg, rgb(30, 64, 175), rgb(96, 165, 250))', // Biru
                            'linear-gradient(135deg, rgb(253, 230, 138), rgb(251, 113, 133))', // Kuning-Merah
                            'linear-gradient(135deg, rgb(153, 246, 228), rgb(56, 189, 248))', // Hijau-Biru
                            'linear-gradient(135deg, rgb(199, 210, 254), rgb(167, 139, 250))', // Ungu
                            'linear-gradient(135deg, rgb(254, 215, 170), rgb(252, 231, 243))', // Oranye-Pink
                        ];

                        // Array daftar variasi ikon Lucide berganti otomatis
                        $icons = [
                            'rocket',
                            'heart-handshake',
                            'camera',
                            'users-round',
                            'briefcase-business',
                            'sparkles',
                        ];

                        // Rumus membagi rata warna & ikon berdasarkan urutan index data database
                        $currentGradient = $gradients[$index % count($gradients)];
                        $currentIcon = $icons[$index % count($icons)];
                    @endphp

                    <!-- Menggunakan struktur murni Card-2 milik temen lu -->
                    <article class="article-card canva-card" data-template-id="card-2" data-category="{{ Str::slug($article->category) }}" style="background: rgb(255, 255, 255);">
                        <div data-template-id="thumb-2" class="article-thumb canva-banner"
                            style="background: {{ $article->gambar_utama ? 'url(' . asset('storage/' . $article->gambar_utama) . ') center/cover' : $currentGradient }};">
                            <span class="corner-tape" aria-hidden="true"></span>
                            <div class="thumb-art">
                                <i class="thumb-symbol" data-lucide="{{ $currentIcon }}"
                                    style="position: absolute; right:8px; top:2px;" width="27" height="27"
                                    aria-hidden="true"></i>
                                <div data-template-id="thumb-text-2" class="art-paper canva-text"
                                    style="color: rgb(30, 64, 175); font-weight: 800; font-style: normal; font-size: 16px;">
                                    {{ Str::limit($article->title, 20) }}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="card-meta">
                                <span data-template-id="badge-2" class="category-badge canva-tag"
                                    style="background: rgb(252, 231, 243); color: rgb(157, 23, 77); font-weight: 700; font-style: normal; font-size: 16px;">
                                    {{ Str::slug($article->category) }}
                                </span>
                                <time data-template-id="date-2" class="canva-text"
                                    style="color: rgb(97, 118, 155); font-weight: 600; font-style: normal; font-size: 16px;">
                                    {{ $article->created_at ? $article->created_at->translatedFormat('d M Y') : '-' }}
                                </time>
                            </div>

                            <!-- Judul Artikel Otomatis Bisa Diklik Menuju Slug Detail -->
                            <h3 data-template-id="title-2" class="article-title canva-text font-extrabold"
                                style="color: rgb(23, 56, 117); font-weight: 800; font-style: normal; font-size: 19px;">
                                <a href="{{ route('artikel.show', $article->slug) }}"
                                    style="color: inherit; text-decoration: none;">{{ $article->title }}</a>
                            </h3>

                            <!-- Ringkasan Teks Konten Utama Dinamis -->
                            <p data-template-id="summary-2" class="summary canva-text"
                                style="color: rgb(77, 99, 136); font-weight: 400; font-style: normal; font-size: 16px;">
                                {{ Str::limit(strip_tags($article->konten), 140) }}
                            </p>

                            <!-- DUA ELEMEN DI BAWAH INI TETAP DIPERTAHANKAN WARISAN STRUKTUR DARI TEMEN LU -->
                            <!-- 1. Tombol Utama diubah jadi tag <a> untuk meluncur ke halaman slug -->
                            <a href="{{ route('artikel.show', $article->slug) }}" class="article-button canva-button"
                                data-template-id="button-2"
                                style="background: rgb(255, 255, 255); color: rgb(30, 64, 175); font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 4px; padding: 10px 15px; border: 1px solid rgb(30, 64, 175); border-radius: 8px;">
                                <span data-template-id="button-label-2" class="canva-text"
                                    style="color: rgb(30, 64, 175); font-weight: 800; font-style: normal; font-size: 16px;">Baca
                                    Artikel</span>
                                <i data-lucide="arrow-up-right" width="17" height="17"
                                    aria-hidden="true"></i>
                            </a>

                            <!-- 2. Tag paragraf preview bawaan JS temen lu biar animasinya ga eror -->
                            <p data-template-id="preview-2" class="article-preview canva-text"
                                style="background: rgb(255, 241, 247); color: rgb(122, 49, 87); font-weight: 400; font-style: normal; font-size: 16px;">
                                Oleh: {{ $article->user->name ?? 'Anonim' }}
                            </p>
                        </div>
                    </article>

                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: rgb(97, 118, 155);">
                        Belum ada artikel yang tersedia saat ini.
                    </div>
                @endforelse

            </section>

        </div>
    </main>

          <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();

            // ---------- FUNGSI SCROLL ----------
            const heroScrollBtn = document.getElementById("scroll-to-articles");
            const articleSection = document.querySelector(".alumni-section");
            if (heroScrollBtn && articleSection) {
                heroScrollBtn.addEventListener("click", function() {
                    articleSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                });
            }

            // ---------- FUNGSI FILTER KATEGORI PINTAR ----------
            const tabs = document.querySelectorAll(".filter-tab");
            const cards = document.querySelectorAll(".article-card");

            tabs.forEach(function(tab) {
                tab.addEventListener("click", function() {
                    const category = tab.getAttribute('data-filter') || '';

                    tabs.forEach(function(item) {
                        const active = item === tab;
                        item.classList.toggle("is-active", active);
                        item.setAttribute("aria-selected", String(active));
                        
                        if (active) {
                            item.style.background = "rgb(30, 64, 175)";
                            item.style.color = "rgb(255, 255, 255)";
                        } else {
                            item.style.background = "rgb(255, 255, 255)";
                            item.style.color = "rgb(30, 64, 175)";
                        }
                    });

                    cards.forEach(function(card) {
                        const cardCategory = card.getAttribute('data-category') || '';
                        
                        // Menjaring kecocokan kata: jika tombol 'all', atau slug data cocok satu sama lain
                        const isMatch = category === "all" || 
                                        cardCategory === category || 
                                        category.includes(cardCategory) || 
                                        cardCategory.includes(category);

                        if (isMatch) {
                            card.style.setProperty('display', 'block', 'important');
                        } else {
                            card.style.setProperty('display', 'none', 'important');
                        }
                    });
                });
            });

            // ---------- FUNGSI BUTTON & CARD CLICK ----------
            document.querySelectorAll(".article-button").forEach(function(button) {
                button.addEventListener("click", function(e) {
                    e.stopPropagation();
                });
            });

            document.querySelectorAll(".article-card").forEach(function(card) {
                card.addEventListener("click", function(e) {
                    if (e.target.closest('.article-button') || e.target.closest('.article-title a')) {
                        return;
                    }
                    this.classList.toggle("is-open");
                });
            });
        });
    </script>



</body>

</html>
