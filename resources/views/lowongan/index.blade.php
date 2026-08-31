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

  /* HERO HEADER DENGAN GAMBAR DAN RADIAL GRADIENT */
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
  .loker-title .accent{
    color:var(--coral);
    background:var(--paper);
    padding:0 10px;
    border-radius:10px;
    border:3px solid var(--ink);
    display:inline-block;
    box-shadow:3px 3px 0 var(--ink);
    transform:rotate(-2deg);
  }
  .loker-sub{
    margin-top:16px;
    font-size:18px;
    font-weight:600;
    color:var(--ink);
    line-height:1.6;
  }

/* PEMBATAS ANTARA HERO DAN KONTEN */
  .section-divider{
    width: 100%;
    height: 28px;
    background-image: 
      linear-gradient(45deg, var(--sky-tint) 25%, transparent 25%), 
      linear-gradient(-45deg, var(--sky-tint) 25%, transparent 25%), 
      linear-gradient(45deg, transparent 75%, var(--sky-tint) 75%), 
      linear-gradient(-45deg, transparent 75%, var(--sky-tint) 75%);
    background-size: 28px 28px;
    background-position: 0 0, 0 14px, 14px -14px, -14px 0px;
    background-color: var(--paper);
    border-top: 4px solid var(--ink);
    border-bottom: 4px solid var(--ink);
  }
  /* KONTEN UTAMA */
  .loker-content{
    background:var(--sky-tint);
    padding:60px 0 100px;
  }

  .loker-layout{
    display:grid;
    grid-template-columns: 300px 1fr;
    gap:30px;
    align-items:start;
  }

  /* SIDEBAR FILTER KIRI */
  .loker-sidebar{
    background:var(--paper);
    border:3px solid var(--ink);
    border-radius:var(--radius-md);
    padding:24px;
    box-shadow:var(--shadow-chunky-sm);
    position:sticky;
    top:24px;
  }
  .sidebar-title{
    font-size:18px;
    margin-bottom:14px;
    display:flex;
    align-items:center;
    gap:8px;
  }
  .sidebar-group{
    margin-bottom:24px;
  }
  .sidebar-group:last-child{
    margin-bottom:0;
  }
  .filter-btn-list{
    display:flex;
    flex-direction:column;
    gap:8px;
  }
  .f-filter-btn{
    text-align:left;
    font-family:'Baloo 2',sans-serif;
    font-weight:700;
    font-size:15px;
    padding:10px 16px;
    border-radius:12px;
    border:2px solid var(--ink);
    background:#e2ecf5;
    cursor:pointer;
    transition:all .15s ease;
    color:var(--ink);
  }
  .f-filter-btn:hover, .f-filter-btn.active{
    background:var(--morning-breeze);
    color:var(--paper);
    box-shadow:2px 2px 0 var(--ink);
    transform:translate(-1px,-1px);
  }

  .search-input{
    width:100%;
    padding:12px 16px;
    border:2px solid var(--ink);
    border-radius:12px;
    font-family:'Nunito',sans-serif;
    font-weight:600;
    background:#e2ecf5;
    color:var(--ink);
    outline:none;
  }
  .search-input:focus{
    background:var(--paper);
    box-shadow:2px 2px 0 var(--ink);
  }

  /* KANAN: HEADER INFO & GRID KARTU */
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

  /* SHARE BANNER */
  .share-banner{
    margin-top:50px;
    background: linear-gradient(135deg, var(--dewy-blue) 0%, var(--morning-breeze) 100%);
    color: var(--paper);
    border:3px solid var(--ink);
    border-radius:var(--radius-lg);
    padding:40px;
    box-shadow:var(--shadow-chunky);
    text-align:center;
    position:relative;
    overflow:hidden;
  }
  .share-banner h3{
    font-size:28px;
    margin-bottom:10px;
    color: var(--paper);
    text-shadow: 2px 2px 0 var(--ink);
  }
  .share-banner p{
    font-size:16px;
    font-weight:700;
    color: var(--paper);
    max-width:55ch;
    margin:0 auto 24px;
    text-shadow: 1px 1px 0 var(--ink);
  }
  .share-banner .btn-ghost{
    background: var(--paper);
    color: var(--ink);
  }

  /* RESPONSIVE */
  @media(max-width:992px){
    .loker-layout{grid-template-columns:1fr;}
    .loker-sidebar{position:static;}
    .loker-grid{grid-template-columns:1fr;}
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

      <aside class="loker-sidebar">
        
        <div class="sidebar-group">
          <h3 class="sidebar-title">Cari Posisi</h3>
          <input type="text" id="searchInput" class="search-input" placeholder="Ketik skill / judul...">
        </div>

        <hr style="border:2px dashed rgba(46,58,89,.15); margin:20px 0;">

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

      </aside>

      <div>
        <div class="right-content-header">
          <span class="counter-text" id="counterText">Menampilkan 10 Lowongan Aktif</span>
          <span style="font-family:'Baloo 2',sans-serif; font-weight:700; font-size:13px; color:var(--ink-soft);">Antares Job Board</span>
        </div>

        <div class="loker-grid" id="lokerGrid">

          <div class="loker-card" data-category="Full-Time">
            <span class="card-top-badge">Rekomendasi Alumni</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">DS</div>
                <div>
                  <h2 class="job-title">Junior UI/UX Designer</h2>
                  <div class="company-name">Kreasi Digital Nusantara • (Kak Rian, 2018)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Full-Time</span>
                <span class="j-badge">Remote</span>
                <span class="j-badge">Figma</span>
              </div>
              <p class="job-desc">Lagi cari pelabuhan karier baru atau mau naik tingkat di dunia desain? Perusahaan yang dibangun sama alumni senior kita lagi buka pintu lebar-lebar buat kamu yang jago bikin tampilan aplikasi jadi ciamik! Yuk, berkarya bareng keluarga sendiri.</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Estimasi Gaji:</span>
                Rp 4.5M - 6.5M / bln
              </div>
              <a href="#" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Freelance">
            <span class="card-top-badge" style="background:var(--morning-breeze);">Hot Project</span>
            <div>
              <div class="loker-header">
                <div class="company-logo">WD</div>
                <div>
                  <h2 class="job-title">Junior Web Developer</h2>
                  <div class="company-name">Solusi Pintar Edukasi • (Tim Alumni)</div>
                </div>
              </div>
              <div class="job-badges">
                <span class="j-badge">Freelance</span>
                <span class="j-badge">Hybrid</span>
                <span class="j-badge">PHP & XAMPP</span>
              </div>
              <p class="job-desc">Panggilan buat para pencinta kode dan tukang ngulik database! Perusahaan partner alumni kita lagi butuh bala bantuan nih buat ngembangin sistem informasi sekolah dan manajemen data berbasis web. Anti ribet, asik buat nambah portofolio!</p>
            </div>
            <div class="job-footer">
              <div class="salary-box">
                <span>Sistem Bayar:</span>
                Berdasarkan Project
              </div>
              <a href="#" class="btn btn-primary btn-sm">Ambil</a>
            </div>
          </div>

          <div class="loker-card" data-category="Full-Time">
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
              <a href="#" class="btn btn-primary btn-sm">Kirim CV</a>
            </div>
          </div>

          <div class="loker-card" data-category="Full-Time">
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
              <a href="#" class="btn btn-primary btn-sm">Gabung</a>
            </div>
          </div>

          <div class="loker-card" data-category="Remote">
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
              <a href="#" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Magang">
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
              <a href="#" class="btn btn-primary btn-sm">Daftar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Full-Time">
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
              <a href="#" class="btn btn-primary btn-sm">Ambil</a>
            </div>
          </div>

          <div class="loker-card" data-category="Freelance">
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
              <a href="#" class="btn btn-primary btn-sm">Kirim Demo</a>
            </div>
          </div>

          <div class="loker-card" data-category="Full-Time">
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
              <a href="#" class="btn btn-primary btn-sm">Lamar</a>
            </div>
          </div>

          <div class="loker-card" data-category="Remote">
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
              <a href="#" class="btn btn-primary btn-sm">Daftar</a>
            </div>
          </div>

        </div>

        <div class="share-banner">
          <h3>Punya Info Lowongan di Perusahaanmu Juga?</h3>
          <p>Jangan simpan sendirian! Bantu kawan-kawan se-almamater kita yang lagi berjuang mencari peluang karier baru. Berbagi kebaikan, rezeki makin lancar!</p>
          <a href="#" class="btn btn-ghost">Bagikan Info Loker Di Sini</a>
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

  let currentCategory = 'all';

  function filterCards() {
    const searchTerm = searchInput.value.toLowerCase();
    let visibleCount = 0;

    cards.forEach(card => {
      const category = card.getAttribute('data-category');
      const cardText = card.innerText.toLowerCase();
      
      const matchesCategory = (currentCategory === 'all' || category === currentCategory);
      const matchesSearch = cardText.includes(searchTerm);

      if (matchesCategory && matchesSearch) {
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
</script>

</body>
</html>