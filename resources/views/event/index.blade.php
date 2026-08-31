<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galeri Keseruan Event — Antares Alumni Club</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{
    --buttercup:#FFF2B2;
    --sunwashed:#FFE08A;
    --cloud-puff:#FFF7D6;
    --dewy-blue:#A8C6E7;
    --morning-breeze:#124d82;
    --sky-tint:#E9F1FB;
    --sky-tint-2:#D3E4F6;
    --ink:#2E3A59;
    --ink-soft:#5B6B8C;
    --paper:#FFFDF7;
    --coral:#FF9466;
    --mint:#A3E4D7;
    --radius-lg:24px;
    --radius-md:14px;
    --shadow-chunky:6px 6px 0 var(--ink);
    --shadow-chunky-sm:4px 4px 0 var(--ink);
  }

  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body{
    margin:0;
    font-family:'Nunito', sans-serif;
    color:var(--ink);
    background:var(--sky-tint);
    overflow-x:hidden;
  }

  h1,h2,h3,.display{
    font-family:'Baloo 2', sans-serif;
    font-weight:800;
    line-height:1.08;
    margin:0;
  }
  p{margin:0;}
  a{text-decoration:none;color:inherit;}

  .wrap{
    max-width:1240px;
    margin:0 auto;
    padding:0 24px;
  }

  /* HERO BADGE ATAS */
  .hero-badge-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 700;
    font-size: clamp(21px, 3vw, 27px);
    color: var(--paper);
    background-color: #124d82;
    padding: 20px 48px;
    border-radius: 999px;
    border: 3px solid #ffffff;
    box-shadow: 4px 4px 0 var(--ink);
    position: relative;
  }
  .hero-badge-box::after {
    content: '';
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border: 2px dashed rgba(255, 255, 255, 0.6);
    border-radius: 999px;
    pointer-events: none;
  }

  .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    font-family:'Baloo 2', sans-serif;
    font-weight:700;
    font-size:15px;
    padding:12px 24px;
    border-radius:999px;
    border:3px solid var(--ink);
    box-shadow:var(--shadow-chunky-sm);
    cursor:pointer;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .btn:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--ink);}
  .btn:active{transform:translate(1px,1px);box-shadow:2px 2px 0 var(--ink);}
  .btn-primary{background:#124d82;color:var(--paper);}
  .btn-ghost{background:var(--paper);color:var(--ink);}

  /* HERO HEADER */
  .gallery-hero{
    padding:50px 0 70px;
    background:
      radial-gradient(circle at 85% 20%, var(--buttercup) 0, transparent 30%),
      radial-gradient(circle at 15% 75%, var(--mint) 0, transparent 28%),
      var(--dewy-blue);
    border-bottom:4px solid var(--ink);
    text-align:center;
    position:relative;
  }
  .gallery-hero .wrap{max-width:850px;position:relative;z-index:2;}
  
  .gallery-title{
    font-size:clamp(32px, 4.5vw, 48px);
    margin-top:16px;
    color: #124d82;
  }

  /* KOTAK BADGE "Alumni" */
  .gallery-title .alumni-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 700;
    font-size: clamp(24px, 3.5vw, 40px);
    background-color: #124d82;
    padding: 8px 28px;
    border-radius: 999px;
    border: 3px solid #ffffff;
    box-shadow: 4px 4px 0 var(--ink);
    position: relative;
    transform: rotate(-1.5deg);
    margin-top: 10px;
  }
  .gallery-title .alumni-badge::after {
    content: '';
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border: 2px dashed rgba(255, 255, 255, 0.6);
    border-radius: 999px;
    pointer-events: none;
  }

  .gallery-sub{
    margin-top:16px;
    font-size:16px;
    font-weight:600;
    color: #124d82;
  }

  /* STYLING SECTION DIVIDER BERGERAK */
  .moving-divider {
    width: 100%;
    height: 35px; /* Tinggi garis pembatas */
    overflow: hidden;
    position: relative;
    border-top: 3px solid #2E3A59; /* Garis batas ala neo-brutalist kamu */
    border-bottom: 3px solid #2E3A59;
    background-color: #ffffff;
  }

  .moving-track {
    display: flex;
    width: 200%;
    height: 100%;
    /* Animasi bergerak ke samping, durasi 8 detik (bisa dipercepat/diperlambat) */
    animation: slideStripes 8s linear infinite;
  }

  .stripe-pattern {
    width: 50%;
    height: 100%;
    /* Membuat pola garis diagonal (stripes) warna putih dan #f3c2c6 */
    background: repeating-linear-gradient(
      -45deg,
      #ffffff,
      #ffffff 30px,
      #f3c2c6 30px,
      #f3c2c6 60px
    );
  }

  /* Keyframes buat looping geser ke samping */
  @keyframes slideStripes {
    0% {
      transform: translateX(0);
    }
    100% {
      transform: translateX(-50%);
    }
    
  /* MAIN LAYOUT GALERI */
  .gallery-content{
    padding:50px 0 90px;
  }

  .filter-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:16px;
    margin-bottom:35px;
    background:var(--paper);
    border:3px solid var(--ink);
    padding:16px 24px;
    border-radius:var(--radius-md);
    box-shadow:var(--shadow-chunky-sm);
  }
  .category-pills{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
  }
  .pill-btn{
    font-family:'Baloo 2', sans-serif;
    font-weight:700;
    font-size:14px;
    padding:8px 16px;
    border-radius:999px;
    border:2.5px solid var(--ink);
    background:var(--sky-tint);
    cursor:pointer;
    transition:all .15s ease;
    box-shadow:2px 2px 0 var(--ink);
    color:var(--ink);
  }
  .pill-btn:hover{transform:translate(-2px,-2px);box-shadow:4px 4px 0 var(--ink);}
  .pill-btn.active{
    background:#124d82;
    color:var(--paper);
    box-shadow:4px 4px 0 var(--ink);
    transform:translate(-2px,-2px);
  }

  .search-box{
    position:relative;
    min-width:260px;
  }
  .search-input{
    width:100%;
    padding:10px 16px;
    border:2.5px solid var(--ink);
    border-radius:999px;
    font-family:'Nunito',sans-serif;
    font-weight:600;
    background:var(--sky-tint);
    color:var(--ink);
    outline:none;
  }
  .search-input:focus{background:var(--paper);box-shadow:2px 2px 0 var(--ink);}

  /* GRID ALBUM FOTO */
  .photo-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:30px;
  }

  .photo-card{
    background:var(--paper);
    border:3px solid var(--ink);
    border-radius:var(--radius-lg);
    padding:16px 16px 20px 16px;
    box-shadow:var(--shadow-chunky);
    transition:transform .2s ease, box-shadow .2s ease;
    display:flex;
    flex-direction:column;
    position:relative;
  }
  .photo-card:hover{
    transform:translate(-4px,-4px) rotate(-1deg);
    box-shadow:10px 10px 0 var(--ink);
  }
  .photo-card:nth-child(4n+1){background:var(--paper);transform:rotate(0.5deg);}
  .photo-card:nth-child(4n+2){background:var(--cloud-puff);transform:rotate(-0.8deg);}
  .photo-card:nth-child(4n+3){background:var(--sky-tint-2);transform:rotate(1deg);}
  .photo-card:nth-child(4n+4){background:var(--buttercup);transform:rotate(-0.5deg);}

  .photo-card::before{
    content:"";
    position:absolute;
    top:-10px;
    left:50%;
    transform:translateX(-50%);
    width:90px;
    height:22px;
    background:rgba(255,255,255,0.6);
    border:2px dashed var(--ink);
    border-radius:4px;
    z-index:2;
  }

  .photo-wrapper{
    width:100%;
    height:220px;
    background:var(--dewy-blue);
    border:3px solid var(--ink);
    border-radius:12px;
    overflow:hidden;
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Baloo 2', sans-serif;
    font-weight:700;
    font-size:20px;
    color:var(--paper);
    margin-bottom:14px;
    text-shadow: 2px 2px 0 var(--ink);
  }

  .photo-meta{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:12.5px;
    font-weight:700;
    color:var(--ink-soft);
    margin-bottom:6px;
  }

  .photo-title{
    font-size:18px;
    margin-bottom:8px;
    color:#124d82;
  }

  .photo-desc{
    font-size:13.5px;
    color:var(--ink-soft);
    font-weight:600;
    line-height:1.4;
    margin-bottom:16px;
    flex-grow:1;
  }

  .photo-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding-top:10px;
    border-top:2px dashed rgba(46,58,89,.2);
  }

  .badge-tag{
    font-family:'Baloo 2',sans-serif;
    font-weight:700;
    font-size:11.5px;
    background:var(--sky-tint);
    border:2px solid var(--ink);
    padding:2px 10px;
    border-radius:6px;
  }

  /* MODAL LIGHTBOX STYLES */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(46, 58, 89, 0.7);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    pointer-events: none;
    transition: opacity .25s ease;
    padding: 24px;
  }
  .modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
  }
  .modal-container {
    background: var(--paper);
    border: 3px solid var(--ink);
    border-radius: var(--radius-lg);
    max-width: 600px;
    width: 100%;
    padding: 24px;
    box-shadow: 8px 8px 0 var(--ink);
    position: relative;
    transform: scale(0.95) rotate(0.5deg);
    transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  .modal-overlay.active .modal-container {
    transform: scale(1) rotate(0deg);
  }
  .modal-close {
    position: absolute;
    top: -16px;
    right: -16px;
    width: 40px;
    height: 40px;
    background: var(--coral);
    color: var(--paper);
    border: 3px solid var(--ink);
    border-radius: 50%;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 800;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: var(--shadow-chunky-sm);
    transition: transform .15s ease;
  }
  .modal-close:hover {
    transform: scale(1.1) rotate(90deg);
  }
  .modal-img-wrapper {
    width: 100%;
    height: 280px;
    background: var(--dewy-blue);
    border: 3px solid var(--ink);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 800;
    font-size: 28px;
    color: var(--paper);
    margin-bottom: 16px;
    text-shadow: 2px 2px 0 var(--ink);
  }
  .modal-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--ink-soft);
    margin-bottom: 8px;
  }
  .modal-title {
    font-size: 22px;
    margin-bottom: 10px;
    color: #124d82;
  }
  .modal-desc {
    font-size: 15px;
    color: var(--ink-soft);
    font-weight: 600;
    line-height: 1.5;
    margin-bottom: 20px;
  }
  .modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 14px;
    border-top: 2px dashed rgba(46,58,89,.2);
  }

  @media(max-width:992px){
    .photo-grid{grid-template-columns:repeat(2,1fr);}
  }
  @media(max-width:768px){
    .photo-grid{grid-template-columns:1fr;}
    .filter-bar{flex-direction:column;align-items:stretch;}
    .search-box{width:100%;}
  }
</style>
</head>
<body>

<section class="gallery-hero">
  <div class="wrap">
    <div class="hero-badge-box">Album Kenangan & Dokumentasi</div>
    <h1 class="gallery-title" style="margin-top: 16px;">
      Jejak Keseruan & Momen Indah <br>
      <span class="alumni-badge" style="color: #ffe08a !important;">Alumni</span>
    </h1>
    <p class="gallery-sub">Kumpulan potret hangat dari berbagai acara temu kangen, webinar inspiratif, hingga workshop bareng. Yuk intip, siapa tahu ada muka kamu di sini!</p>
  </div>
</section>

<!-- SECTION DIVIDER BERGERAK -->
<div class="moving-divider">
  <div class="moving-track">
    <div class="stripe-pattern"></div>
    <div class="stripe-pattern"></div>
  </div>
</div>

<section class="gallery-content">
  <div class="wrap">

    <div class="filter-bar">
      <div class="category-pills" id="filterList">
        <button class="pill-btn active" data-filter="all">Semua Album (9)</button>
        <button class="pill-btn" data-filter="Meetup">Temu Kangen & Meetup</button>
        <button class="pill-btn" data-filter="Webinar">Webinar & Tech Talk</button>
        <button class="pill-btn" data-filter="Workshop">Workshop & Coding</button>
      </div>

      <div class="search-box">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari nama event / tahun...">
      </div>
    </div>

    <div class="photo-grid" id="photoGrid">

      <div class="photo-card" data-category="Meetup">
        <div class="photo-wrapper">Gathering Bali</div>
        <div class="photo-meta">
          <span>15 Agustus 2026</span>
          <span>Denpasar, Bali</span>
        </div>
        <h2 class="photo-title">Gathering Santai Edisi Kemerdekaan</h2>
        <p class="photo-desc">Keseruan kumpul-kumpul sambil ngobrolin seputar perkembangan dunia kerja kreatif lintas angkatan di salah satu cafe hits Bali.</p>
        <div class="photo-footer">
          <span class="badge-tag">Meetup</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="Gathering Bali" data-date="15 Agustus 2026" data-location="Denpasar, Bali" data-title="Gathering Santai Edisi Kemerdekaan" data-desc="Keseruan kumpul-kumpul sambil ngobrolin seputar perkembangan dunia kerja kreatif lintas angkatan di salah satu cafe hits Bali." data-tag="Meetup">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Webinar">
        <div class="photo-wrapper">UI/UX & AI</div>
        <div class="photo-meta">
          <span>28 Juli 2026</span>
          <span>Online via Zoom</span>
        </div>
        <h2 class="photo-title">Webinar UI/UX & AI Integration</h2>
        <p class="photo-desc">Sesi sharing intensif bersama para alumni senior yang membedah bagaimana memanfaatkan AI untuk efisiensi desain produk.</p>
        <div class="photo-footer">
          <span class="badge-tag">Webinar</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="UI/UX & AI" data-date="28 Juli 2026" data-location="Online via Zoom" data-title="Webinar UI/UX & AI Integration" data-desc="Sesi sharing intensif bersama para alumni senior yang membedah bagaimana memanfaatkan AI untuk efisiensi desain produk." data-tag="Webinar">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Workshop">
        <div class="photo-wrapper">PHP & XAMPP</div>
        <div class="photo-meta">
          <span>10 Juni 2026</span>
          <span>Lab Komputer Utama</span>
        </div>
        <h2 class="photo-title">Workshop Kilat: Ngoding Bareng PHP & XAMPP</h2>
        <p class="photo-desc">Peserta tampak antusias serius ngulik database dan debugging kode bersama mentor alumni di lab kampus.</p>
        <div class="photo-footer">
          <span class="badge-tag">Workshop</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="PHP & XAMPP" data-date="10 Juni 2026" data-location="Lab Komputer Utama" data-title="Workshop Kilat: Ngoding Bareng PHP & XAMPP" data-desc="Peserta tampak antusias serius ngulik database dan debugging kode bersama mentor alumni di lab kampus." data-tag="Workshop">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Meetup">
        <div class="photo-wrapper">Buka Bersama</div>
        <div class="photo-meta">
          <span>20 Mei 2026</span>
          <span>Jakarta Selatan</span>
        </div>
        <h2 class="photo-title">Buka Bersama & Silaturahmi Alumni</h2>
        <p class="photo-desc">Momen hangat melepas rindu sambil menikmati hidangan lezat dan bernostalgia masa-masa kuliah dulu.</p>
        <div class="photo-footer">
          <span class="badge-tag">Meetup</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="Buka Bersama" data-date="20 Mei 2026" data-location="Jakarta Selatan" data-title="Buka Bersama & Silaturahmi Alumni" data-desc="Momen hangat melepas rindu sambil menikmati hidangan lezat dan bernostalgia masa-masa kuliah dulu." data-tag="Meetup">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Webinar">
        <div class="photo-wrapper">Remote Job</div>
        <div class="photo-meta">
          <span>14 April 2026</span>
          <span>Online Google Meet</span>
        </div>
        <h2 class="photo-title">Karier Series: Tembus Remote Job</h2>
        <p class="photo-desc">Bedah tips praktis menyusun portofolio digital yang memikat client internasional dari rumah.</p>
        <div class="photo-footer">
          <span class="badge-tag">Webinar</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="Remote Job" data-date="14 April 2026" data-location="Online Google Meet" data-title="Karier Series: Tembus Remote Job" data-desc="Bedah tips praktis menyusun portofolio digital yang memikat client internasional dari rumah." data-tag="Webinar">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Workshop">
        <div class="photo-wrapper">Matchora Design</div>
        <div class="photo-meta">
          <span>02 Maret 2026</span>
          <span>Bandung Creative Hub</span>
        </div>
        <h2 class="photo-title">Pelatihan Branding & Desain Produk Matchora</h2>
        <p class="photo-desc">Studi kasus nyata pembuatan identitas visual produk kuliner lokal yang sukses meluncur ke pasaran.</p>
        <div class="photo-footer">
          <span class="badge-tag">Workshop</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="Matchora Design" data-date="02 Maret 2026" data-location="Bandung Creative Hub" data-title="Pelatihan Branding & Desain Produk Matchora" data-desc="Studi kasus nyata pembuatan identitas visual produk kuliner lokal yang sukses meluncur ke pasaran." data-tag="Workshop">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Meetup">
        <div class="photo-wrapper">Beach Cleanup</div>
        <div class="photo-meta">
          <span>12 Januari 2026</span>
          <span>Pantai Sanur, Bali</span>
        </div>
        <h2 class="photo-title">Fun Outing & Beach Cleanup Bareng</h2>
        <p class="photo-desc">Aksi bersih-bersih pantai dilanjutkan games seru dan barbeque sore hari buat mempererat kekompakan.</p>
        <div class="photo-footer">
          <span class="badge-tag">Meetup</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="Beach Cleanup" data-date="12 Januari 2026" data-location="Pantai Sanur, Bali" data-title="Fun Outing & Beach Cleanup Bareng" data-desc="Aksi bersih-bersih pantai dilanjutkan games seru dan barbeque sore hari buat mempererat kekompakan." data-tag="Meetup">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Webinar">
        <div class="photo-wrapper">Tech Trends 2026</div>
        <div class="photo-meta">
          <span>18 Desember 2025</span>
          <span>Online Live Streaming</span>
        </div>
        <h2 class="photo-title">Akhir Tahun Review: Tren Teknologi 2026</h2>
        <p class="photo-desc">Diskusi panel santai membahas prediksi dan proyeksi teknologi apa saja yang bakal booming di tahun depan.</p>
        <div class="photo-footer">
          <span class="badge-tag">Webinar</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="Tech Trends 2026" data-date="18 Desember 2025" data-location="Online Live Streaming" data-title="Akhir Tahun Review: Tren Teknologi 2026" data-desc="Diskusi panel santai membahas prediksi dan proyeksi teknologi apa saja yang bakal booming di tahun depan." data-tag="Webinar">Lihat Foto</button>
        </div>
      </div>

      <div class="photo-card" data-category="Workshop">
        <div class="photo-wrapper">Mini Hackathon</div>
        <div class="photo-meta">
          <span>05 November 2025</span>
          <span>Kampus Utama Antares</span>
        </div>
        <h2 class="photo-title">Hackathon Mini: Bikin MVP dalam 6 Jam</h2>
        <p class="photo-desc">Adu cepat dan kreatif ngebut bikin purwarupa aplikasi pemecah masalah sosial bareng tim lintas jurusan.</p>
        <div class="photo-footer">
          <span class="badge-tag">Workshop</span>
          <button class="btn btn-primary open-modal-btn" style="padding:6px 14px; font-size:13px;" data-preview="Mini Hackathon" data-date="05 November 2025" data-location="Kampus Utama Antares" data-title="Hackathon Mini: Bikin MVP dalam 6 Jam" data-desc="Adu cepat dan kreatif ngebut bikin purwarupa aplikasi pemecah masalah sosial bareng tim lintas jurusan." data-tag="Workshop">Lihat Foto</button>
        </div>
      </div>

    </div>

  </div>
</section>

<div class="modal-overlay" id="photoModal">
  <div class="modal-container">
    <button class="modal-close" id="modalClose">×</button>
    <div class="modal-img-wrapper" id="modalPreview">Dokumentasi Event</div>
    <div class="modal-meta">
      <span id="modalDate">Tanggal</span>
      <span id="modalLocation">Lokasi</span>
    </div>
    <h2 class="modal-title" id="modalTitle">Judul Event</h2>
    <p class="modal-desc" id="modalDesc">Deskripsi lengkap dari event yang dipilih akan muncul di sini dengan detail interaktif.</p>
    <div class="modal-actions">
      <span class="badge-tag" id="modalTag">Kategori</span>
      <button class="btn btn-ghost" id="modalCloseBtn" style="padding: 6px 16px; font-size: 13.5px;">Tutup</button>
    </div>
  </div>
</div>

<script>
  const filterBtns = document.querySelectorAll('.pill-btn');
  const cards = document.querySelectorAll('.photo-card');
  const searchInput = document.getElementById('searchInput');

  let currentCategory = 'all';

  function filterGallery() {
    const searchTerm = searchInput.value.toLowerCase();

    cards.forEach(card => {
      const category = card.getAttribute('data-category');
      const cardText = card.innerText.toLowerCase();

      const matchesCategory = (currentCategory === 'all' || category === currentCategory);
      const matchesSearch = cardText.includes(searchTerm);

      if (matchesCategory && matchesSearch) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  }

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentCategory = btn.getAttribute('data-filter');
      filterGallery();
    });
  });

  searchInput.addEventListener('input', filterGallery);

  /* MODAL LOGIC */
  const modalOverlay = document.getElementById('photoModal');
  const modalClose = document.getElementById('modalClose');
  const modalCloseBtn = document.getElementById('modalCloseBtn');
  const openModalBtns = document.querySelectorAll('.open-modal-btn');

  const modalPreview = document.getElementById('modalPreview');
  const modalDate = document.getElementById('modalDate');
  const modalLocation = document.getElementById('modalLocation');
  const modalTitle = document.getElementById('modalTitle');
  const modalDesc = document.getElementById('modalDesc');
  const modalTag = document.getElementById('modalTag');

  openModalBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      modalPreview.innerText = btn.getAttribute('data-preview');
      modalDate.innerText = btn.getAttribute('data-date');
      modalLocation.innerText = btn.getAttribute('data-location');
      modalTitle.innerText = btn.getAttribute('data-title');
      modalDesc.innerText = btn.getAttribute('data-desc');
      modalTag.innerText = btn.getAttribute('data-tag');

      modalOverlay.classList.add('active');
    });
  });

  function closeModal() {
    modalOverlay.classList.remove('active');
  }

  modalClose.addEventListener('click', closeModal);
  modalCloseBtn.addEventListener('click', closeModal);
  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
      closeModal();
    }
  });
</script>

</body>
</html>