<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bursa Loker Kawan Lama — Antares Alumni Club</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{
    --buttercup:#FFF2B2;
    --sunwashed:#FFE08A;
    --cloud-puff:#FFF7D6;
    --dewy-blue:#A8C6E7;
    --morning-breeze:#7FA8D6;
    --sky-tint:#668ba2;
    --sky-tint-2:#D3E4F6;
    --ink:#2E3A59;
    --ink-soft:#5B6B8C;
    --paper:#FFFDF7;
    --coral:#FF9466;
    --radius-lg:28px;
    --radius-md:18px;
    --shadow-chunky:6px 6px 0 var(--ink);
    --shadow-chunky-sm:4px 4px 0 var(--ink);
  }

  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body {
    margin: 0;
    font-family: 'Nunito', sans-serif;
    color: #124d82;
    background: var(--sky-tint);
    overflow-x: hidden;
  }
  h1,h2,h3,.display{
    font-family:'Baloo 2', sans-serif;
    font-weight:800;
    line-height:1.08;
    margin:0;
  }

  h1, h2, h3, .display, .loker-title, .loker-sub, .counter-text, .company-name, .job-desc, .sidebar-title {
    color: #124d82;
  }

  p{margin:0;}
  a{text-decoration:none;color:inherit;}
  ul{margin:0;padding:0;list-style:none;}

  .wrap{
    max-width:1240px;
    margin:0 auto;
    padding:0 24px;
  }

  .eyebrow{
    display:inline-flex;
    align-items:center;
    gap:8px;
    font-family:'Baloo 2', sans-serif;
    font-weight:700;
    font-size:14px;
    letter-spacing:.02em;
    padding:8px 18px;
    border:3px solid var(--ink);
    border-radius:999px;
    background:var(--paper);
    box-shadow:var(--shadow-chunky-sm);
  }

  .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    font-family:'Baloo 2', sans-serif;
    font-weight:700;
    font-size:16px;
    padding:14px 26px;
    border-radius:999px;
    border:3px solid var(--ink);
    box-shadow:var(--shadow-chunky-sm);
    cursor:pointer;
    transition:transform .15s ease, box-shadow .15s ease;
    white-space:nowrap;
  }
  .btn:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--ink);}
  .btn:active{transform:translate(1px,1px);box-shadow:2px 2px 0 var(--ink);}
  .btn-primary{background:var(--morning-breeze);color:var(--paper);}
  .btn-ghost{background:var(--paper);color:var(--ink);}
  .btn-sm{padding:8px 18px;font-size:14px;}

  .loker-hero{
    padding:60px 0 80px;
    background: 
      radial-gradient(circle at 90% 15%, var(--buttercup) 0, transparent 32%),
      radial-gradient(circle at 10% 80%, var(--sunwashed) 0, transparent 20%),
      url('assets/anggi/bgabout.png');
    background-size: cover;
    background-position: center;
    position:relative;
    overflow:hidden;
    text-align:center;
  }
  .loker-hero .wrap{
    max-width:800px;
    position:relative;
    z-index:2;
  }
  .loker-title{
    font-size:clamp(36px, 5vw, 54px);
    margin-top:16px;
    color: var(--ink);
  }
  .loker-title .accent {
    color: #ffe08a !important;
    background: #124d82;
    padding: 4px 18px;
    border-radius: 999px;
    border: 3px solid #ffffff;
    display: inline-block;
    box-shadow: 4px 4px 0 var(--ink);
    transform: rotate(-3deg);
    position: relative;
  }

  .loker-title .accent::after {
    content: '';
    position: absolute;
    top: 4px;
    left: 4px;
    right: 4px;
    bottom: 4px;
    border: 2px dashed rgba(255, 255, 255, 0.6);
    border-radius: 999px;
    pointer-events: none;
  }

  .loker-sub{
    margin-top:16px;
    font-size:18px;
    font-weight:600;
    color:var(--ink);
    line-height:1.6;
  }

  .hero-badge-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 700;
    font-size: clamp(16px, 2vw, 20px);
    color: var(--paper);
    background-color: #124d82;
    padding: 12px 32px;
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

  .section-divider{
    width: 100%;
    height: 36px;
    overflow: hidden;
    position: relative;
    z-index: 10;
    background-color: #6497c0;
    border-top: 3px solid var(--ink);
    border-bottom: 3px solid var(--ink);
    background: repeating-linear-gradient(
      135deg, 
      #124d82, 
      #124d82 35px, 
      #ffffff 35px, 
      #ffffff 70px
    );
    background-size: 200% 100%;
    animation: slideStripes 20s linear infinite;
  }
  @keyframes slideStripes {
    0% { background-position: 0 0; }
    100% { background-position: -100% 0; }
  }

  .loker-content{
    background: #6497c0;
    padding: 60px 0 100px;
  }

  .loker-layout{
    display:grid;
    grid-template-columns: 300px 1fr;
    gap:30px;
    align-items:start;
  }
.loker-sidebar{
    background: var(--paper);
    border: 3px solid var(--ink);
    border-radius: var(--radius-md);
    padding: 20px;
    box-shadow: var(--shadow-chunky-sm);
    position: sticky;
    top: 24px;
    max-height: calc(100vh - 48px);
    overflow-y: auto; /* Membuat isi sidebar bisa di-scroll ke bawah */
  }

/* Kustomisasi scrollbar sidebar agar tetap estetik ala neo-brutalisme */
  .loker-sidebar::-webkit-scrollbar {
    width: 6px;
  }

  .loker-sidebar::-webkit-scrollbar-track {
    background: var(--paper);
    border-radius: 8px;
  }
  .loker-sidebar::-webkit-scrollbar-thumb {
    background: var(--ink);
    border-radius: 8px;
  }

.sidebar-title{
    font-size: 16px;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #124d82;
  }
 .sidebar-group{
    margin-bottom: 14px;
  }

  .sidebar-group:last-child{
    margin-bottom:0;
  }
  
  .filter-btn-list{
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  
  .f-filter-btn{
    text-align: left;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 700;
    font-size: 15px;
    padding: 10px 16px;
    border-radius: 12px;
    border: 2px solid var(--ink);
    cursor: pointer;
    transition: all .15s ease;
    color: #124d82;
    box-shadow: 2px 2px 0 var(--ink);
    background: #f7efbf;
  }

  .f-filter-btn:hover, .f-filter-btn.active{
    background: #124d82 !important;
    color: #ffffff !important;
    box-shadow: 3px 3px 0 var(--ink);
    transform: translate(-1px, -1px);
  }

  .search-input, .search-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--ink);
    border-radius: 12px;
    font-family: 'Nunito', sans-serif;
    font-weight: 600;
    background: #ffffff;
    color: #124d82;
    outline: none;
    box-shadow: 2px 2px 0 var(--ink);
  }
  .search-input:focus, .search-select:focus {
    box-shadow: 3px 3px 0 var(--ink);
  }

  .right-content-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
    background:var(--paper);
    border:3px solid var(--ink);
    padding:14px 20px;
    border-radius:var(--radius-md);
    box-shadow:var(--shadow-chunky-sm);
  }
  .counter-text{
    font-family:'Baloo 2',sans-serif;
    font-weight:700;
    font-size:15px;
    color:var(--ink-soft);
  }

  .loker-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:24px;
  }

  .loker-card{
    background:var(--paper);
    border:3px solid var(--ink);
    border-radius:var(--radius-lg);
    padding:26px;
    box-shadow:var(--shadow-chunky);
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:relative;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .loker-card:hover{
    transform:translate(-3px,-3px);
    box-shadow:9px 9px 0 var(--ink);
  }
  .loker-card:nth-child(5n+1){background:var(--paper);}
  .loker-card:nth-child(5n+2){background:var(--cloud-puff);}
  .loker-card:nth-child(5n+3){background:var(--sky-tint-2);}
  .loker-card:nth-child(5n+4){background:var(--buttercup);}
  .loker-card:nth-child(5n+5){background:var(--sunwashed);}

  .card-top-badge{
    position:absolute;
    top:-14px;
    right:24px;
    background:var(--coral);
    color:var(--paper);
    font-family:'Baloo 2',sans-serif;
    font-weight:800;
    font-size:13px;
    padding:4px 14px;
    border:3px solid var(--ink);
    border-radius:999px;
    box-shadow:2px 2px 0 var(--ink);
  }

  .loker-header{
    display:flex;
    align-items:flex-start;
    gap:14px;
    margin-bottom:14px;
  }
  .company-logo{
    width:50px;height:50px;
    background:var(--dewy-blue);
    border:3px solid var(--ink);
    border-radius:12px;
    display:flex;align-items:center;justify-content:center;
    font-size:20px;
    box-shadow:2px 2px 0 var(--ink);
    flex-shrink:0;
  }
  .job-title{
    font-size:20px;
    margin-bottom:2px;
  }
  .company-name{
    font-weight:700;
    font-size:14px;
    color:var(--ink-soft);
  }

  .job-badges{
    display:flex;
    gap:6px;
    flex-wrap:wrap;
    margin:12px 0;
  }
  .j-badge{
    font-family:'Baloo 2',sans-serif;
    font-weight:700;
    font-size:12px;
    background:#e2ecf5;
    border:2px solid var(--ink);
    padding:3px 10px;
    border-radius:8px;
  }

  .job-desc{
    font-size:14.5px;
    color:var(--ink-soft);
    font-weight:600;
    line-height:1.5;
    margin-bottom:18px;
  }

  .job-footer{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding-top:14px;
    border-top:2px dashed rgba(46,58,89,.2);
    gap:10px;
  }
  .salary-box{
    font-family:'Baloo 2',sans-serif;
    font-weight:800;
    font-size:15px;
    color:var(--ink);
  }
  .salary-box span{
    display:block;
    font-size:11px;
    color:var(--ink-soft);
    font-weight:700;
  }

  .share-banner-ticket {
    position: relative;
    display: flex;
    margin-top: 80px;
    margin-bottom: 40px;
    border-radius: 16px;
    box-shadow: 5px 5px 0 var(--ink, #124d82);
    max-width: 850px;
    margin-left: auto;
    margin-right: auto;
    z-index: 1;
  }

  .ticket-left {
    background-color: #f2e0d6; 
    padding: 40px 60px;
    border: 3px solid #124d82;
    border-right: none;
    border-radius: 16px 0 0 16px;
    flex: 3;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .ticket-right {
    background-color: #e5dbb9;
    border: 3px solid #124d82;
    border-left: 4px dashed #124d82;
    border-radius: 0 16px 16px 0;
    flex: 1;
    min-width: 120px;
  }

  .share-banner-ticket h3 {
    font-size: 26px;
    color: #124d82;
    margin-bottom: 16px;
    line-height: 1.3;
  }

  .share-banner-ticket p {
    font-size: 16px;
    color: #124d82;
    font-weight: 700;
    margin-bottom: 24px;
    line-height: 1.5;
    max-width: 55ch;
  }

  .badge-float {
    position: absolute;
    padding: 8px 16px;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 700;
    font-size: 16px;
    border: 3px solid #124d82;
    border-radius: 12px;
    box-shadow: 3px 3px 0 #124d82;
    z-index: 10;
  }

  .badge-float::after, .btn-ticket::after {
    content: '';
    position: absolute;
    top: 4px; left: 4px; right: 4px; bottom: 4px;
    border: 2px dashed rgba(18, 77, 130, 0.5);
    border-radius: 8px;
    pointer-events: none;
  }

  .badge-top-left {
    top: -20px;
    left: -20px;
    background-color: #b8cdd6;
    color: #124d82;
    transform: rotate(-12deg);
  }

  .badge-right {
    top: 40%;
    right: 8%;
    transform: rotate(10deg);
    background-color: #eebac0;
    color: #124d82;
    text-align: center;
    line-height: 1.2;
  }

  .btn-ticket {
    background-color: #ffe08a;
    color: #124d82;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 800;
    font-size: 16px;
    padding: 12px 24px;
    border: 3px solid #124d82;
    border-radius: 12px;
    box-shadow: 4px 4px 0 #124d82;
    text-decoration: none;
    position: relative;
    display: inline-block;
    transition: all 0.2s;
  }

  .btn-ticket:hover {
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #124d82;
    background-color: #f3c2c6;
  }

  @media(max-width:992px){
    .loker-layout{grid-template-columns:1fr;}
    .loker-sidebar{position:static;}
    .loker-grid{grid-template-columns:1fr;}
    .share-banner-ticket { flex-direction: column; }
    .ticket-left { border-radius: 16px 16px 0 0; border-right: 3px solid #124d82; padding: 30px 20px; }
    .ticket-right { height: 40px; border-radius: 0 0 16px 16px; border-left: 3px solid #124d82; border-top: 4px dashed #124d82; }
    .badge-right { display: none; }
  }
</style>
</head>
<body>

<section class="loker-hero">
  <div class="wrap">
    <div class="hero-badge-box">Bursa Karier & Kolaborasi</div>
    <h1 class="loker-title">Temukan Peluang Karier dari <span class="accent">Keluarga Sendiri!</span></h1>
    <p class="loker-sub">Biar makin gampang dapet cuan dan berkembang, yuk intip berbagai lowongan kerja eksklusif yang dibagikan langsung oleh sesama alumni Antares. Dari senior sampai rekan seangkatan siap dukung langkahmu!</p>
  </div>
</section>

<div class="section-divider"></div>

<section class="loker-content">
  <div class="wrap">

    <div class="loker-layout">

      <!-- SIDEBAR FILTER DIPERBARUI -->
      <aside class="loker-sidebar">
        
        <div class="sidebar-group">
          <h3 class="sidebar-title">Cari Posisi / Skill</h3>
          <input type="text" id="searchInput" class="search-input" placeholder="Ketik skill / judul...">
        </div>

        <div class="sidebar-group">
          <h3 class="sidebar-title">Nama Perusahaan</h3>
          <select id="companySelect" class="search-select">
            <option value="all">Semua Perusahaan</option>
            <option value="Kreasi Digital Nusantara">Kreasi Digital Nusantara</option>
            <option value="Solusi Pintar Edukasi">Solusi Pintar Edukasi</option>
            <option value="Matchora Brand">Matchora Brand</option>
            <option value="Antares Organizer">Antares Organizer</option>
            <option value="Nusantara Media">Nusantara Media</option>
            <option value="Matchora Studio">Matchora Studio</option>
            <option value="Sinergi Teknologi">Sinergi Teknologi</option>
            <option value="Ngobrol Bareng Alumni">Ngobrol Bareng Alumni</option>
            <option value="Logistik Kawan">Logistik Kawan</option>
            <option value="Edukasi Digital">Edukasi Digital</option>
          </select>
        </div>

        <div class="sidebar-group">
          <h3 class="sidebar-title">Lokasi / Sistem Kerja</h3>
          <select id="locationSelect" class="search-select">
            <option value="all">Semua Lokasi / Sistem</option>
            <option value="Remote">Remote / WFH</option>
            <option value="Hybrid">Hybrid</option>
            <option value="Jakarta">Jakarta (WFO/Studio)</option>
            <option value="Bandung">Bandung</option>
            <option value="Surabaya">Surabaya</option>
          </select>
        </div>

        <hr style="border:2px dashed rgba(46,58,89,.15); margin:16px 0;">

        <div class="sidebar-group">
          <h3 class="sidebar-title">Kategori Loker</h3>
          <div class="filter-btn-list" id="filterList">
            <button class="f-filter-btn active" data-filter="all">Semua Loker (10)</button>
            <button class="f-filter-btn" data-filter="Full-Time">Full-Time</button>
            <button class="f-filter-btn" data-filter="Remote">Remote / WFH</button>
            <button class="f-filter-btn" data-filter="Freelance">Freelance / Project</button>
            <button class="f-filter-btn" data-filter="Magang">Magang / Internship</button>
          </div>
        </div>

        <div class="sidebar-group" style="margin-top: 20px;">
          <button id="resetBtn" class="btn btn-ghost btn-sm" style="width: 100%; border: 2px solid var(--ink);">Reset Filter</button>
        </div>

      </aside>

      <div>
        <div class="right-content-header">
          <span class="counter-text" id="counterText">Menampilkan 10 Lowongan Aktif</span>
          <span style="font-family:'Baloo 2',sans-serif; font-weight:700; font-size:13px; color:var(--ink-soft);">Antares Job Board</span>
        </div>

        <div class="loker-grid" id="lokerGrid">

          <div class="loker-card" data-category="Full-Time" data-company="Matchora Brand" data-location="Jakarta">
            <span class="card-top-badge" style="background:var(--dewy-blue); color:var(--ink);">Fresh Grad</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">CM</div>
                <div>
                  <h2 class="job-title">Content & Social Media Specialist</h2>
                  <div class="company-name">Matchora Brand • (Kak Dewi, 2020)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Full-Time</span>
                <span class="j-badge">WFO Jakarta</span>
                <span class="j-badge">Copywriting</span>
              </div>
              <p class="job-desc">Suka bikin konten seru, ngerti tren TikTok/Reels, dan hobi nulis caption yang jenaka? Jenama kuliner milik alumni kita lagi berkembang pesat dan butuh talenta kreatif yang asyik diajak kerja bareng. Segera daftarkan dirimu!</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Estimasi Gaji:</span>
                Rp 4.0M - 5.5M / bln
              </div>
              <a href="/lowongan/detail/matchora-brand" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Full-Time" data-company="Antares Organizer" data-location="Bandung">
            <span class="card-top-badge" style="background:var(--coral);">Special Opening</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">AO</div>
                <div>
                  <h2 class="job-title">Community & Event Manager</h2>
                  <div class="company-name">Antares Organizer • (Pengurus Pusat)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Full-Time</span>
                <span class="j-badge">Bandung / Remote</span>
                <span class="j-badge">Event</span>
              </div>
              <p class="job-desc">Punya bakat ngumpulin orang, seru, dan hobi bikin acara kumpul-kumpul yang pecah? Yuk, gabung jadi penggerak utama di balik layar berbagai event seru dan temu kangen alumni kita selanjutnya! Suasana kerja dijamin seru ala keluarga sendiri.</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Estimasi Gaji:</span>
                Rp 5.0M - 7.0M / bln
              </div>
              <a href="/lowongan/detail/antares-organizer" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Remote" data-company="Nusantara Media" data-location="Remote">
            <span class="card-top-badge" style="background:var(--morning-breeze);">Fast Growth</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">DM</div>
                <div>
                  <h2 class="job-title">Digital Marketing Growth Specialist</h2>
                  <div class="company-name">Nusantara Media • (Kak Bayu, 2016)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Full-Time</span>
                <span class="j-badge">Remote</span>
                <span class="j-badge">Ads & Analytics</span>
              </div>
              <p class="job-desc">Mau ngebantu brand lokal milik alumni melesat tinggi lewat strategi iklan digital dan analisis data yang ciamik? Posisi ini pas banget buat kamu yang hobi eksperimen campaign dan baca tren market terkini!</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Estimasi Gaji:</span>
                Rp 6.0M - 8.5M / bln
              </div>
              <a href="/lowongan/detail/nusantara-media" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Magang" data-company="Matchora Studio" data-location="Hybrid">
            <span class="card-top-badge" style="background:var(--dewy-blue); color:var(--ink);">Intern Program</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">GI</div>
                <div>
                  <h2 class="job-title">Graphic Design Intern</h2>
                  <div class="company-name">Matchora Studio • (Kak Dewi, 2020)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Magang</span>
                <span class="j-badge">Hybrid</span>
                <span class="j-badge">Illustrator</span>
              </div>
              <p class="job-desc">Buat adik-adik tingkat atau fresh graduate yang mau nyari pengalaman nyata di industri kreatif, yuk magang bareng kita! Bakalan dibimbing langsung cara bikin visual brand produk makanan dan minuman yang gemesin.</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Insentif:</span>
                Rp 2.0M - 3.0M / bln
              </div>
              <a href="/lowongan/detail/matchora-studio" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Full-Time" data-company="Sinergi Teknologi" data-location="Remote">
            <span class="card-top-badge">Tech Lead</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">SF</div>
                <div>
                  <h2 class="job-title">Senior Fullstack Engineer</h2>
                  <div class="company-name">Sinergi Teknologi • (Kak Fajar, 2015)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Full-Time</span>
                <span class="j-badge">Remote</span>
                <span class="j-badge">Laravel & Vue</span>
              </div>
              <p class="job-desc">Punya pengalaman matang di framework Laravel dan terbiasa merancang arsitektur sistem skala besar? Senior kita lagi bangun tim impian dan butuh tangan kanan handal buat nakhodain project-project skala nasional!</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Estimasi Gaji:</span>
                Rp 10M - 14M / bln
              </div>
              <a href="/lowongan/detail/sinergi-teknologi" class="btn btn-primary btn-sm">Ambil</a>
            </div>
          </div>

          <div class="loker-card" data-category="Freelance" data-company="Ngobrol Bareng Alumni" data-location="Jakarta">
            <span class="card-top-badge" style="background:var(--morning-breeze);">Kreatif & Seru</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">PH</div>
                <div>
                  <h2 class="job-title">Podcast Host & Copywriter</h2>
                  <div class="company-name">Ngobrol Bareng Alumni • (Tim Media)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Freelance</span>
                <span class="j-badge">Studio Jakarta</span>
                <span class="j-badge">Public Speaking</span>
              </div>
              <p class="job-desc">Pede ngomong di depan kamera/mikrofon, punya suara renyah, dan hobi ngulik cerita unik dari para alumni sukses? Gabung jadi host program bincang-bincang santai kita yuk! Pastinya seru dan nambah relasi luas.</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Sistem Bayar:</span>
                Per Episode
              </div>
              <a href="/lowongan/detail/ngobrol-bareng-alumni" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Full-Time" data-company="Logistik Kawan" data-location="Surabaya">
            <span class="card-top-badge" style="background:var(--coral);">Hot Demand</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">LK</div>
                <div>
                  <h2 class="job-title">Operations & Supply Chain Lead</h2>
                  <div class="company-name">Logistik Kawan • (Kak Reza, 2017)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Full-Time</span>
                <span class="j-badge">On-Site Surabaya</span>
                <span class="j-badge">Supply Chain</span>
              </div>
              <p class="job-desc">Jago ngatur logistik, manajemen gudang, dan koordinasi mitra bisnis dengan efisien? Perusahaan ekspedisi milik alumni kita lagi butuh sosok pemimpin operasional yang cekatan dan solutif.</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Estimasi Gaji:</span>
                Rp 7.5M - 10M / bln
              </div>
              <a href="/lowongan/detail/logistik-kawan" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Remote" data-company="Edukasi Digital" data-location="Remote">
            <span class="card-top-badge" style="background:var(--dewy-blue); color:var(--ink);">Junior Friendly</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">CH</div>
                <div>
                  <h2 class="job-title">Customer Happiness Officer</h2>
                  <div class="company-name">Edukasi Digital • (Tim Alumni)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Full-Time</span>
                <span class="j-badge">Remote</span>
                <span class="j-badge">Communication</span>
              </div>
              <p class="job-desc">Punya empati tinggi, sabar, ramah, dan suka bantu orang lain mecahin masalah seputar aplikasi belajar online? Posisi ini sangat ramah buat fresh graduate yang mau merintis karier di dunia startup edukasi.</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Estimasi Gaji:</span>
                Rp 3.8M - 5.0M / bln
              </div>
              <a href="/lowongan/detail/edukasi-digital" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

        </div>

        <div class="share-banner-ticket">
          <div class="badge-float badge-top-left">Daftar Sekarang</div>
          <div class="badge-float badge-right">Bagikan Ceritamu<br>Bersama Kami!</div>

          <div class="ticket-left">
            <h3>Punya Info Lowongan di Perusahaanmu Juga?</h3>
            <p>Jangan simpan sendirian! Bantu kawan-kawan se-almamater kita yang lagi berjuang mencari peluang karier baru. Berbagi kebaikan, rezeki makin lancar!</p>
            <a href="#" class="btn-ticket">Hubungi kami!</a>
          </div>
          <div class="ticket-right"></div>
        </div>
        

        </div>

        <div class="share-banner-ticket">
          <div class="badge-float badge-top-left">Daftar Sekarang</div>
          <div class="badge-float badge-right">Bagikan Ceritamu<br>Bersama Kami!</div>

          <div class="ticket-left">
            <h3>Punya Info Lowongan di Perusahaanmu Juga?</h3>
            <p>Jangan simpan sendirian! Bantu kawan-kawan se-almamater kita yang lagi berjuang mencari peluang karier baru. Berbagi kebaikan, rezeki makin lancar!</p>
            <a href="#" class="btn-ticket">Hubungi kami!</a>
          </div>
          <div class="ticket-right"></div>
        </div>

      </div>

    </div>

  </div>
</section>

<script>
  const filterBtns = document.querySelectorAll('.f-filter-btn');
  const cards = document.querySelectorAll('.loker-card');
  const counterText = document.getElementById('counterText');
  const searchInput = document.getElementById('searchInput');
  const companySelect = document.getElementById('companySelect');
  const locationSelect = document.getElementById('locationSelect');
  const resetBtn = document.getElementById('resetBtn');

  let currentCategory = 'all';

  function filterCards() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedCompany = companySelect.value;
    const selectedLocation = locationSelect.value;
    let visibleCount = 0;

    cards.forEach(card => {
      const category = card.getAttribute('data-category');
      const company = card.getAttribute('data-company');
      const location = card.getAttribute('data-location');
      const cardText = card.innerText.toLowerCase();
      
      const matchesCategory = (currentCategory === 'all' || category === currentCategory);
      const matchesSearch = cardText.includes(searchTerm);
      const matchesCompany = (selectedCompany === 'all' || company === selectedCompany);
      const matchesLocation = (selectedLocation === 'all' || location.includes(selectedLocation));

      if (matchesCategory && matchesSearch && matchesCompany && matchesLocation) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    counterText.innerText = `Menampilkan ${visibleCount} Lowongan Aktif`;
  }

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentCategory = btn.getAttribute('data-filter');
      filterCards();
    });
  });

  searchInput.addEventListener('input', filterCards);
  companySelect.addEventListener('change', filterCards);
  locationSelect.addEventListener('change', filterCards);

  resetBtn.addEventListener('click', () => {
    searchInput.value = '';
    companySelect.value = 'all';
    locationSelect.value = 'all';
    currentCategory = 'all';
    filterBtns.forEach(b => b.classList.remove('active'));
    filterBtns[0].classList.add('active');
    filterCards();
  });
</script>

</body>
</html>