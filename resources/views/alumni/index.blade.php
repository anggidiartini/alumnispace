<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alumni Space — Direktori Alumni</title>

<script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/alumni.css') }}?v={{ file_exists(public_path('css/alumni.css')) ? filemtime(public_path('css/alumni.css')) : time() }}">
</head>
<body class="alumni-page-body" data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}" style="background: #f7fbff;">

<x-navbar />

<main>
  <section class="hero-section dot-grid" style="background: linear-gradient(135deg, rgb(234, 244, 255), rgb(255, 254, 249));">
    <span class="hero-shape shape-pink"></span>
    <span class="hero-shape shape-yellow"></span>
    <span class="hero-shape shape-mint"></span>
    <div class="hero-container">
      <div class="hero-grid">
        <div class="hero-left">
          <p class="hero-eyebrow" style="background: rgb(255, 240, 168); color: rgb(49, 87, 127); font-weight: 700; font-style: normal; font-size: 16px;">✦ Alumni Space · ruang temu lintas angkatan</p>
          <h1 class="hero-title" style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 32px;">Kita tetap tumbuh, bersama.</h1>
          <p class="hero-subtitle" style="color: rgb(80, 117, 155); font-weight: 400; font-style: normal; font-size: 18px; line-height: 1.55;">Temukan kembali teman seperjalanan, bagikan cerita, dan rayakan langkah baik dari komunitas alumni kita.</p>
          <a href="#direktori" class="hero-cta" style="background: rgb(46, 117, 221); color: rgb(255, 255, 255); font-weight: 800; font-style: normal; font-size: 16px;">Lihat direktori</a>

          <div class="hero-stats">
            <div class="stat-card" style="background: rgb(255, 255, 255);">
              <p class="stat-label">Alumni terdaftar</p>
              <p id="stat-total-value" class="stat-value">16</p>
            </div>
            <div class="stat-card" style="background: rgb(255, 240, 168);">
              <p class="stat-label">Rentang angkatan</p>
              <p class="stat-value">2015–2020</p>
            </div>
            <div class="stat-card" style="background: rgb(204, 239, 227);">
              <p class="stat-label">Kota terhubung</p>
              <p id="city-count" class="stat-value">0</p>
            </div>
          </div>
        </div>

        <div class="hero-photo-outer">
          <div class="hero-decor-1" aria-hidden="true">✦</div>
          <div class="hero-decor-2" aria-hidden="true">✿</div>
          <div class="hero-photo-frame">
            <img loading="lazy" src="https://images.pexels.com/photos/7683745/pexels-photo-7683745.jpeg" alt="A happy group of diverse college students posing cheerfully outside a modern building.">
          </div>
          <div class="hero-note" style="background: rgb(255, 240, 168); color: rgb(49, 87, 127);"><span aria-hidden="true">👋</span> Temukan teman seperjalananmu</div>
        </div>
      </div>
    </div>
  </section>

  <section id="direktori" class="directory-section">
    <div id="directory-shell" class="directory-shell">
      <div class="directory-header">
        <div>
          <p class="directory-eyebrow" style="background: rgb(255, 220, 233); color: rgb(135, 81, 108); font-weight: 800; font-style: normal; font-size: 16px;">DIREKTORI ALUMNI</p>
          <h2 class="directory-title" style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 24px;">Temukan teman seperjalanan.</h2>
          <p class="directory-subtitle" style="color: rgb(94, 127, 163); font-weight: 400; font-style: normal; font-size: 16px;">Jelajahi profil alumni, bidang karier, dan domisili mereka.</p>
        </div>
        <p id="result-count" aria-live="polite" class="result-count"></p>
      </div>

      <form id="filter-form" class="filter-form" novalidate>
        <div class="filter-grid">
          <div class="icon-field">
            <label class="filter-label" for="search-input" style="color: rgb(49, 87, 127);">Cari alumni</label>
            <i data-lucide="search"></i>
            <input id="search-input" class="filter-control" type="search" autocomplete="off">
          </div>
          <div>
            <label class="filter-label" for="year-filter" style="color: rgb(49, 87, 127);">Angkatan</label>
            <select id="year-filter" class="filter-control"><option value="">Semua angkatan</option></select>
          </div>
          <div>
            <label class="filter-label" for="city-filter" style="color: rgb(49, 87, 127);">Kota domisili</label>
            <select id="city-filter" class="filter-control"><option value="">Semua kota</option></select>
          </div>
          <div>
            <label class="filter-label" for="sort-filter" style="color: rgb(49, 87, 127);">Urutkan</label>
            <select id="sort-filter" class="filter-control">
              <option value="default">Urutan awal</option>
              <option value="name-asc">Nama A–Z</option>
              <option value="year-asc">Angkatan terlama</option>
              <option value="year-desc">Angkatan terbaru</option>
            </select>
          </div>
          <button id="reset-button" class="reset-button" type="button" style="background: rgb(255, 255, 255); color: rgb(46, 117, 221);">Reset</button>
        </div>
      </form>

      <div id="alumni-grid" class="alumni-grid">
        <article data-id="1" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-1" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=400" alt="Portrait of a happy man with arms crossed, exuding confidence and friendliness.">
            <span class="badge">Angkatan 2015</span>
          </div>
          <div>
            <h3 class="card-name">Andi Pratama</h3>
            <p class="card-role">Software Engineer</p>
          </div>
          <p class="card-quote">“Membangun produk digital”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Yogyakarta</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="2" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-2" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/8101969/pexels-photo-8101969.jpeg" alt="Portrait of a confident Asian woman smiling in a business setting with colleagues in the background.">
            <span class="badge">Angkatan 2016</span>
          </div>
          <div>
            <h3 class="card-name">Siti Rahma</h3>
            <p class="card-role">UI/UX Designer</p>
          </div>
          <p class="card-quote">“Suka berbagi insight desain”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Bandung</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="3" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-3" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/9301461/pexels-photo-9301461.jpeg" alt="A cheerful young man in a white shirt smiling at his desk in a modern office environment.">
            <span class="badge">Angkatan 2017</span>
          </div>
          <div>
            <h3 class="card-name">Budi Santoso</h3>
            <p class="card-role">Product Manager</p>
          </div>
          <p class="card-quote">“Mengembangkan produk berdampak”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Jakarta</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="4" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-4" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/5214958/pexels-photo-5214958.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=400" alt="Portrait of a smiling female doctor in a lab coat with stethoscope and clipboard indoors.">
            <span class="badge">Angkatan 2018</span>
          </div>
          <div>
            <h3 class="card-name">Citra Lestari</h3>
            <p class="card-role">Dokter</p>
          </div>
          <p class="card-quote">“Melayani dengan sepenuh hati”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Surabaya</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="5" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-5" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/23496638/pexels-photo-23496638.jpeg" alt="Confident young man in glasses smiling at camera in a stylish office setting.">
            <span class="badge">Angkatan 2019</span>
          </div>
          <div>
            <h3 class="card-name">Dimas Anggara</h3>
            <p class="card-role">Content Creator</p>
          </div>
          <p class="card-quote">“Bercerita lewat visual”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Semarang</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="6" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-6" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/22046239/pexels-photo-22046239.jpeg" alt="Portrait of a smiling woman with glasses in a stylish modern office setting.">
            <span class="badge">Angkatan 2020</span>
          </div>
          <div>
            <h3 class="card-name">Eka Wulandari</h3>
            <p class="card-role">Data Analyst</p>
          </div>
          <p class="card-quote">“Mengubah data jadi keputusan”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Malang</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="7" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-7" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/8101728/pexels-photo-8101728.jpeg" alt="Portrait of a professional Asian man sitting in a modern office setting, exuding confidence and focus.">
            <span class="badge">Angkatan 2015</span>
          </div>
          <div>
            <h3 class="card-name">Fajar Nugroho</h3>
            <p class="card-role">Entrepreneur</p>
          </div>
          <p class="card-quote">“Membangun bisnis lokal”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Solo</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="8" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-8" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/3727464/pexels-photo-3727464.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=400" alt="Smiling woman on phone call while working on a laptop in a stylish office.">
            <span class="badge">Angkatan 2016</span>
          </div>
          <div>
            <h3 class="card-name">Gina Maharani</h3>
            <p class="card-role">Marketing Specialist</p>
          </div>
          <p class="card-quote">“Menghubungkan ide dan audiens”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Jakarta</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="9" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-9" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/8961125/pexels-photo-8961125.jpeg" alt="Confident engineer posing with arms crossed on a construction site.">
            <span class="badge">Angkatan 2017</span>
          </div>
          <div>
            <h3 class="card-name">Hendra Wijaya</h3>
            <p class="card-role">Civil Engineer</p>
          </div>
          <p class="card-quote">“Merancang masa depan kota”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Medan</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="10" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-10" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/6256118/pexels-photo-6256118.jpeg" alt="Portrait of a young woman in a classroom holding books, standing in front of a chalkboard.">
            <span class="badge">Angkatan 2018</span>
          </div>
          <div>
            <h3 class="card-name">Intan Permata</h3>
            <p class="card-role">Teacher</p>
          </div>
          <p class="card-quote">“Menumbuhkan generasi baru”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Makassar</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="11" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-11" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/7163455/pexels-photo-7163455.jpeg" alt="Smiling professional in a blue suit confidently holding a tablet in a modern office space.">
            <span class="badge">Angkatan 2019</span>
          </div>
          <div>
            <h3 class="card-name">Joko Firmansyah</h3>
            <p class="card-role">Financial Consultant</p>
          </div>
          <p class="card-quote">“Membantu rencana finansial”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Jakarta</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="12" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-12" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/29162190/pexels-photo-29162190.jpeg" alt="Focused woman taking a photo with a DSLR camera indoors, expressing creativity.">
            <span class="badge">Angkatan 2020</span>
          </div>
          <div>
            <h3 class="card-name">Kanya Salsabila</h3>
            <p class="card-role">Photographer</p>
          </div>
          <p class="card-quote">“Mengabadikan cerita perjalanan”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Bali</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="13" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-13" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/30082415/pexels-photo-30082415.jpeg" alt="Man in casual attire holding architectural plans, exuding confidence.">
            <span class="badge">Angkatan 2015</span>
          </div>
          <div>
            <h3 class="card-name">Luki Ramadhan</h3>
            <p class="card-role">Architect</p>
          </div>
          <p class="card-quote">“Menciptakan ruang bermakna”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Bandung</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="14" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-14" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/27086886/pexels-photo-27086886.jpeg" alt="Professional woman in a black blazer smiling warmly in an indoor setting.">
            <span class="badge">Angkatan 2016</span>
          </div>
          <div>
            <h3 class="card-name">Maya Kartika</h3>
            <p class="card-role">HR Professional</p>
          </div>
          <p class="card-quote">“Membantu talenta berkembang”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Tangerang</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="15" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-15" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/8851492/pexels-photo-8851492.jpeg" alt="Asian female scientist in lab coat reading a book, experimenting in a laboratory setting.">
            <span class="badge">Angkatan 2018</span>
          </div>
          <div>
            <h3 class="card-name">Nabila Zahra</h3>
            <p class="card-role">Researcher</p>
          </div>
          <p class="card-quote">“Meneliti untuk perubahan”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Bogor</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
        <article data-id="16" class="directory-card" tabindex="0" style="background: rgb(255, 255, 255);">
          <div class="card-top-row">
            <img data-template-id="alumni-image-16" class="card-photo" loading="lazy" src="https://images.pexels.com/photos/19552251/pexels-photo-19552251.jpeg" alt="Portrait of a young man with glasses holding a smartphone, wearing a jean shirt indoors.">
            <span class="badge">Angkatan 2020</span>
          </div>
          <div>
            <h3 class="card-name">Rangga Pratama</h3>
            <p class="card-role">Mobile Developer</p>
          </div>
          <p class="card-quote">“Membuat teknologi lebih dekat”</p>
          <p class="meta-row"><i data-lucide="map-pin" width="14"></i> Surabaya</p>
          <button class="profile-link" type="button">Lihat profil</button>
        </article>
      </div>

      <div id="empty-state" class="empty-state hidden">
        <div class="empty-emoji" aria-hidden="true">🔎</div>
        <h3 style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 19px;">Belum ada alumni yang cocok</h3>
        <p style="color: rgb(94, 127, 163); font-weight: 400; font-style: normal; font-size: 16px; margin-top: .5rem;">Coba gunakan kata kunci lain atau reset filter untuk melihat semua alumni.</p>
      </div>
    </div>

    <section id="detail-shell" class="detail-shell detail-container" aria-live="polite">
      <button id="back-button" class="back-button" type="button" style="background: rgb(234, 244, 255); color: rgb(36, 91, 157);">Kembali ke direktori</button>
      <article class="detail-card">
        <div class="detail-header">
          <span class="hero-shape shape-pink" style="width:128px;height:128px;top:-48px;right:-28px;left:auto;"></span>
          <span class="hero-shape shape-yellow" style="width:64px;height:64px;top:auto;bottom:0;right:25%;"></span>
          <div class="detail-header-inner">
            <img id="detail-image" class="detail-avatar" alt="">
            <div>
              <p id="detail-year" class="badge detail-year"></p>
              <h2 id="detail-name" class="detail-name" style="font-weight:800;font-size:1.5rem;"></h2>
              <p id="detail-field" class="detail-field"></p>
              <p id="detail-city" class="detail-city"><i data-lucide="map-pin" width="16"></i><span></span></p>
            </div>
          </div>
        </div>
        <div class="detail-body">
          <h3 style="color: rgb(18, 53, 107); font-weight: 800; font-style: normal; font-size: 19px;">Cerita singkat</h3>
          <p id="detail-bio" class="detail-bio"></p>
          <div class="detail-actions">
            <button id="contact-button" class="action-button" type="button" style="background: rgb(46, 117, 221); color: rgb(255, 255, 255); font-weight: 800; font-size: 16px;">Hubungi</button>
            <button id="share-button" class="action-button" type="button" style="background: rgb(255, 240, 168); color: rgb(49, 87, 127); font-weight: 800; font-size: 16px;">Bagikan profil</button>
          </div>
        </div>
      </article>
    </section>
  </section>
</main>

<div class="footer-spacer"></div>
<x-footer />

<div id="toast" class="toast" role="status" aria-live="polite">
  <i data-lucide="sparkles" width="19"></i>
  <span id="toast-text"></span>
</div>
<script src="{{ asset('js/script.js') }}"></script>
<script>
  const alumni = [
    { id: 1, name: "Andi Pratama", year: 2015, field: "Software Engineer", city: "Yogyakarta", status: "Membangun produk digital" },
    { id: 2, name: "Siti Rahma", year: 2016, field: "UI/UX Designer", city: "Bandung", status: "Suka berbagi insight desain" },
    { id: 3, name: "Budi Santoso", year: 2017, field: "Product Manager", city: "Jakarta", status: "Mengembangkan produk berdampak" },
    { id: 4, name: "Citra Lestari", year: 2018, field: "Dokter", city: "Surabaya", status: "Melayani dengan sepenuh hati" },
    { id: 5, name: "Dimas Anggara", year: 2019, field: "Content Creator", city: "Semarang", status: "Bercerita lewat visual" },
    { id: 6, name: "Eka Wulandari", year: 2020, field: "Data Analyst", city: "Malang", status: "Mengubah data jadi keputusan" },
    { id: 7, name: "Fajar Nugroho", year: 2015, field: "Entrepreneur", city: "Solo", status: "Membangun bisnis lokal" },
    { id: 8, name: "Gina Maharani", year: 2016, field: "Marketing Specialist", city: "Jakarta", status: "Menghubungkan ide dan audiens" },
    { id: 9, name: "Hendra Wijaya", year: 2017, field: "Civil Engineer", city: "Medan", status: "Merancang masa depan kota" },
    { id: 10, name: "Intan Permata", year: 2018, field: "Teacher", city: "Makassar", status: "Menumbuhkan generasi baru" },
    { id: 11, name: "Joko Firmansyah", year: 2019, field: "Financial Consultant", city: "Jakarta", status: "Membantu rencana finansial" },
    { id: 12, name: "Kanya Salsabila", year: 2020, field: "Photographer", city: "Bali", status: "Mengabadikan cerita perjalanan" },
    { id: 13, name: "Luki Ramadhan", year: 2015, field: "Architect", city: "Bandung", status: "Menciptakan ruang bermakna" },
    { id: 14, name: "Maya Kartika", year: 2016, field: "HR Professional", city: "Tangerang", status: "Membantu talenta berkembang" },
    { id: 15, name: "Nabila Zahra", year: 2018, field: "Researcher", city: "Bogor", status: "Meneliti untuk perubahan" },
    { id: 16, name: "Rangga Pratama", year: 2020, field: "Mobile Developer", city: "Surabaya", status: "Membuat teknologi lebih dekat" }
  ];

  const searchInput = document.getElementById("search-input");
  const yearFilter = document.getElementById("year-filter");
  const cityFilter = document.getElementById("city-filter");
  const sortFilter = document.getElementById("sort-filter");
  const grid = document.getElementById("alumni-grid");
  const resultCount = document.getElementById("result-count");
  const emptyState = document.getElementById("empty-state");
  const directoryShell = document.getElementById("directory-shell");
  const detailShell = document.getElementById("detail-shell");
  const toast = document.getElementById("toast");
  let activeId = null;
  let toastTimer;

  function populateFilters() {
    const years = [...new Set(alumni.map(item => item.year))].sort();
    const cities = [...new Set(alumni.map(item => item.city))].sort((a, b) => a.localeCompare(b, "id"));
    years.forEach(year => yearFilter.insertAdjacentHTML("beforeend", `<option value="${year}">${year}</option>`));
    cities.forEach(city => cityFilter.insertAdjacentHTML("beforeend", `<option value="${city}">${city}</option>`));
    document.getElementById("city-count").textContent = cities.length;
  }

  function getFilteredAlumni() {
    const query = searchInput.value.trim().toLocaleLowerCase("id");
    let list = alumni.filter(item => {
      const matchingText = !query || item.name.toLocaleLowerCase("id").includes(query) || item.field.toLocaleLowerCase("id").includes(query);
      const matchingYear = !yearFilter.value || String(item.year) === yearFilter.value;
      const matchingCity = !cityFilter.value || item.city === cityFilter.value;
      return matchingText && matchingYear && matchingCity;
    });

    if (sortFilter.value === "name-asc") list.sort((a, b) => a.name.localeCompare(b.name, "id"));
    if (sortFilter.value === "year-asc") list.sort((a, b) => a.year - b.year || a.name.localeCompare(b.name, "id"));
    if (sortFilter.value === "year-desc") list.sort((a, b) => b.year - a.year || a.name.localeCompare(b.name, "id"));
    return list;
  }

  function renderDirectory() {
    const filtered = getFilteredAlumni();
    const orderedIds = new Set(filtered.map(item => String(item.id)));
    const cards = [...grid.querySelectorAll(".directory-card")];

    cards.forEach(card => {
      const visible = orderedIds.has(card.dataset.id);
      card.hidden = !visible;
    });

    filtered.forEach((item, index) => {
      const card = grid.querySelector(`[data-id="${item.id}"]`);
      card.style.animation = "none";
      grid.appendChild(card);
      requestAnimationFrame(() => {
        card.style.animation = `cardIn .42s ${index * 35}ms both`;
      });
    });

    resultCount.textContent = `${filtered.length} dari ${alumni.length} alumni ditemukan`;
    emptyState.classList.toggle("hidden", filtered.length !== 0);
  }

  function showToast(message) {
    document.getElementById("toast-text").textContent = message;
    toast.classList.add("is-visible");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove("is-visible"), 3400);
  }

  function getCardImage(id) {
    const cardImage = document.querySelector(`[data-template-id="alumni-image-${id}"]`);
    return cardImage ? cardImage.src : "";
  }

  function showDetail(id) {
    const person = alumni.find(item => item.id === id);
    if (!person) return;
    activeId = id;

    const detailImage = document.getElementById("detail-image");
    detailImage.src = getCardImage(id);
    detailImage.alt = `Foto profil ${person.name}`;
    document.getElementById("detail-year").textContent = `Angkatan ${person.year}`;
    document.getElementById("detail-name").textContent = person.name;
    document.getElementById("detail-field").textContent = person.field;
    document.querySelector("#detail-city span").textContent = person.city;
    document.getElementById("detail-bio").textContent = `${person.name} adalah alumni angkatan ${person.year} yang kini berkiprah sebagai ${person.field} di ${person.city}. ${person.status}.`;

    directoryShell.classList.add("is-hidden");
    detailShell.classList.add("is-active");
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  function showDirectory() {
    detailShell.classList.remove("is-active");
    directoryShell.classList.remove("is-hidden");
    activeId = null;
    document.getElementById("direktori").scrollIntoView({ behavior: "smooth", block: "start" });
  }

  document.getElementById("filter-form").addEventListener("submit", event => event.preventDefault());
  [searchInput, yearFilter, cityFilter, sortFilter].forEach(control => {
    control.addEventListener(control === searchInput ? "input" : "change", renderDirectory);
  });

  document.getElementById("reset-button").addEventListener("click", () => {
    searchInput.value = "";
    yearFilter.value = "";
    cityFilter.value = "";
    sortFilter.value = "default";
    renderDirectory();
    showToast("Filter sudah dikembalikan ke awal.");
  });

  grid.addEventListener("click", event => {
    const card = event.target.closest(".directory-card");
    if (card) showDetail(Number(card.dataset.id));
  });

  grid.addEventListener("keydown", event => {
    const card = event.target.closest(".directory-card");
    if (card && (event.key === "Enter" || event.key === " ")) {
      event.preventDefault();
      showDetail(Number(card.dataset.id));
    }
  });

  document.getElementById("back-button").addEventListener("click", showDirectory);

  document.getElementById("contact-button").addEventListener("click", () => {
    const person = alumni.find(item => item.id === activeId);
    if (person) showToast(`Permintaan untuk terhubung dengan ${person.name} sudah disiapkan.`);
  });

  document.getElementById("share-button").addEventListener("click", async () => {
    const person = alumni.find(item => item.id === activeId);
    if (!person) return;
    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(`Profil Alumni Space: ${person.name}, ${person.field}, angkatan ${person.year}.`);
        showToast("Ringkasan profil berhasil disalin.");
      } else {
        showToast(`Bagikan profil ${person.name} kepada teman alumnimu.`);
      }
    } catch {
      showToast(`Bagikan profil ${person.name} kepada teman alumnimu.`);
    }
  });

  populateFilters();
  renderDirectory();
  lucide.createIcons();

  // Auto-buka detail kalau datang dari halaman lain lewat ?profil=ID
  const urlParams = new URLSearchParams(window.location.search);
  const targetProfilId = urlParams.get('profil');
  if (targetProfilId) {
    showDetail(Number(targetProfilId));
  }
</script>

</body>
</html>
