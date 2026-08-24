<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Antares Alumni Club — Kawan Lama, Cerita Baru</title>
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
    background:var(--cloud-puff);
    overflow-x:hidden;
  }
  h1,h2,h3,.display{
    font-family:'Baloo 2', sans-serif;
    font-weight:800;
    line-height:1.08;
    margin:0;
  }
  p{margin:0;}
  img{max-width:100%;display:block;}
  a{text-decoration:none;color:inherit;}
  ul{margin:0;padding:0;list-style:none;}
  section{position:relative;}
  .wrap{
    max-width:1180px;
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
  .btn-sm{padding:10px 20px;font-size:14px;}

  /* Decorative sparkles */
  .sparkle{position:absolute;pointer-events:none;opacity:.9;}
  @media (prefers-reduced-motion:no-preference){
    .float{animation:float 5s ease-in-out infinite;}
    .float-slow{animation:float 7s ease-in-out infinite;}
    .spin-slow{animation:spin 14s linear infinite;}
  }
  @keyframes float{
    0%,100%{transform:translateY(0) rotate(var(--r,0deg));}
    50%{transform:translateY(-14px) rotate(var(--r,0deg));}
  }
  @keyframes spin{ to{ transform:rotate(360deg); } }

  /* NAVBAR */
  .navbar{
    position:sticky;top:0;z-index:50;
    background:rgba(255,253,247,.9);
    backdrop-filter:blur(6px);
    border-bottom:3px solid var(--ink);
  }
  .navbar .wrap{
    display:flex;align-items:center;justify-content:space-between;
    padding-top:14px;padding-bottom:14px;
  }
  .brand{
    display:flex;align-items:center;gap:10px;
    font-family:'Baloo 2',sans-serif;font-weight:800;font-size:20px;
  }
  .brand-badge{
    width:38px;height:38px;border-radius:50%;
    background:var(--sunwashed);
    border:3px solid var(--ink);
    display:flex;align-items:center;justify-content:center;
    font-size:18px;
  }
  .nav-links{display:flex;align-items:center;gap:28px;}
  .nav-links a.menu-link{font-weight:800;font-family:'Baloo 2',sans-serif;font-size:15px;}
  .nav-cta{display:flex;gap:10px;align-items:center;}
  .nav-toggle{display:none;background:none;border:3px solid var(--ink);border-radius:12px;padding:8px 10px;cursor:pointer;}
  .nav-toggle span{display:block;width:22px;height:3px;background:var(--ink);margin:4px 0;border-radius:2px;}

  /* HERO */
  .hero{
    padding:64px 0 110px;
    background:
      radial-gradient(circle at 12% 18%, var(--dewy-blue) 0, transparent 42%),
      radial-gradient(circle at 88% 10%, var(--sunwashed) 0, transparent 38%),
      var(--buttercup);
    position:relative;
    overflow:hidden;
  }
  .hero .wrap{
    display:grid;
    grid-template-columns:1.05fr .95fr;
    gap:48px;
    align-items:center;
  }
  .hero-headline{
    font-size:clamp(34px,4.6vw,58px);
    margin-top:18px;
  }
  .hero-headline .accent{color:var(--morning-breeze);}
  .hero-sub{
    margin-top:18px;
    font-size:18px;
    color:var(--ink-soft);
    font-weight:600;
    max-width:46ch;
  }
  .hero-cta{display:flex;flex-wrap:wrap;gap:14px;margin-top:30px;}

  .hero-visual{position:relative;height:440px;}
  .polaroid{
    position:absolute;
    background:var(--paper);
    border:4px solid var(--ink);
    border-radius:16px;
    padding:14px 14px 44px;
    box-shadow:10px 10px 0 var(--ink);
    width:88%;
    left:6%;
    top:18px;
    transform:rotate(-4deg);
  }
  .polaroid img{border-radius:8px;width:100%;height:280px;object-fit:cover;}
  .polaroid-cap{
    position:absolute;bottom:12px;left:16px;right:16px;
    font-family:'Baloo 2',sans-serif;font-weight:700;font-size:15px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .tape{
    position:absolute;width:90px;height:30px;
    background:rgba(255,148,102,.85);
    border:2px solid var(--ink);
    top:-14px;left:50%;transform:translateX(-50%) rotate(-3deg);
    border-radius:3px;
  }
  .pin{
    position:absolute;width:22px;height:22px;border-radius:50%;
    background:var(--coral);border:3px solid var(--ink);
    box-shadow:0 3px 0 rgba(46,58,89,.3);
  }
  .badge-chip{
    position:absolute;
    background:var(--dewy-blue);
    border:3px solid var(--ink);
    border-radius:16px;
    padding:10px 16px;
    font-family:'Baloo 2',sans-serif;font-weight:700;font-size:14px;
    box-shadow:var(--shadow-chunky-sm);
  }

  .wave-divider{display:block;width:100%;height:70px;margin-top:-2px;}

  /* ABOUT */
  .about{background:var(--paper);padding:90px 0;}
  .about .wrap{display:grid;grid-template-columns:.85fr 1.15fr;gap:56px;align-items:center;}
  .about-visual{position:relative;}
  .about-frame{
    border:4px solid var(--ink);
    border-radius:var(--radius-lg);
    background:var(--sunwashed);
    padding:22px;
    box-shadow:var(--shadow-chunky);
    transform:rotate(2deg);
  }
  .about-frame img{border-radius:var(--radius-md);border:3px solid var(--ink);}
  .stat-float{
    position:absolute;bottom:-26px;right:-18px;
    background:var(--morning-breeze);color:var(--paper);
    border:3px solid var(--ink);border-radius:18px;
    padding:14px 18px;box-shadow:var(--shadow-chunky-sm);
    font-family:'Baloo 2',sans-serif;
    text-align:center;
  }
  .stat-float b{display:block;font-size:24px;}
  .stat-float span{font-size:11px;font-weight:600;}

  .section-title{font-size:clamp(28px,3.6vw,42px);margin-top:14px;}
  .section-text{margin-top:18px;font-size:17px;color:var(--ink-soft);font-weight:600;line-height:1.65;max-width:56ch;}

  /* COUNT */
  .count{
    background:var(--dewy-blue);
    padding:80px 0;
    border-top:4px solid var(--ink);
    border-bottom:4px solid var(--ink);
  }
  .count-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:24px;
  }
  .count-card{
    background:var(--paper);
    border:3px solid var(--ink);
    border-radius:var(--radius-md);
    padding:26px 18px;
    text-align:center;
    box-shadow:var(--shadow-chunky-sm);
  }
  .count-card:nth-child(2){transform:rotate(-2deg);background:var(--buttercup);}
  .count-card:nth-child(3){transform:rotate(2deg);background:var(--sunwashed);}
  .count-card:nth-child(4){transform:rotate(-1deg);}
  .count-card .emoji{font-size:32px;}
  .count-card .num{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:34px;margin-top:8px;}
  .count-card .label{font-weight:700;font-size:14px;color:var(--ink-soft);margin-top:4px;}

  /* GALLERY */
  .gallery{background:var(--cloud-puff);padding:90px 0;}
  .center-head{text-align:center;max-width:640px;margin:0 auto;}
  .gallery-grid{
    margin-top:52px;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:34px 28px;
  }
  .g-slot{
    background:var(--paper);
    border:3px dashed var(--ink);
    border-radius:var(--radius-md);
    padding:16px;
    box-shadow:var(--shadow-chunky-sm);
  }
  .g-slot:nth-child(1){transform:rotate(-3deg);}
  .g-slot:nth-child(2){transform:rotate(2deg);}
  .g-slot:nth-child(3){transform:rotate(-1deg);}
  .g-photo-area{
    height:190px;
    border-radius:12px;
    background:repeating-linear-gradient(135deg, var(--buttercup), var(--buttercup) 12px, var(--sunwashed) 12px, var(--sunwashed) 24px);
    border:3px solid var(--ink);
    display:flex;align-items:center;justify-content:center;
    flex-direction:column;gap:6px;
    color:var(--ink);
  }
  .g-photo-area .cam{font-size:30px;}
  .g-photo-area small{font-family:'Baloo 2',sans-serif;font-weight:700;font-size:12px;}
  .g-cap{font-family:'Baloo 2',sans-serif;font-weight:700;margin-top:14px;font-size:16px;}

  /* TESTIMONI */
  .testi{background:var(--paper);padding:90px 0;}
  .testi-grid{
    margin-top:52px;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:30px;
  }
  .testi-card{
    background:var(--buttercup);
    border:3px solid var(--ink);
    border-radius:var(--radius-lg);
    padding:30px;
    position:relative;
    box-shadow:var(--shadow-chunky-sm);
  }
  .testi-card:nth-child(2){background:var(--dewy-blue);}
  .testi-quote{font-size:16.5px;font-weight:700;line-height:1.6;}
  .testi-quote::before{content:"“";font-family:'Baloo 2',sans-serif;}
  .testi-person{display:flex;align-items:center;gap:12px;margin-top:20px;}
  .avatar{
    width:46px;height:46px;border-radius:50%;
    background:var(--morning-breeze);color:var(--paper);
    border:3px solid var(--ink);
    display:flex;align-items:center;justify-content:center;
    font-family:'Baloo 2',sans-serif;font-weight:800;font-size:16px;
  }
  .testi-person .name{font-family:'Baloo 2',sans-serif;font-weight:700;font-size:15px;}
  .testi-person .angkatan{font-size:13px;color:var(--ink-soft);font-weight:700;}

  /* ARTIKEL */
  .artikel{background:var(--sunwashed);padding:90px 0;border-top:4px solid var(--ink);}
  .art-grid{margin-top:52px;display:grid;grid-template-columns:repeat(3,1fr);gap:28px;}
  .art-card{
    background:var(--paper);
    border:3px solid var(--ink);
    border-radius:var(--radius-md);
    overflow:hidden;
    box-shadow:var(--shadow-chunky-sm);
    display:flex;flex-direction:column;
    transition:transform .15s ease;
  }
  .art-card:hover{transform:translateY(-6px);}
  .art-thumb{
    height:150px;
    display:flex;align-items:center;justify-content:center;
    font-size:34px;
    border-bottom:3px solid var(--ink);
  }
  .art-card:nth-child(1) .art-thumb{background:var(--dewy-blue);}
  .art-card:nth-child(2) .art-thumb{background:var(--coral);color:var(--paper);}
  .art-card:nth-child(3) .art-thumb{background:var(--morning-breeze);color:var(--paper);}
  .art-body{padding:20px;display:flex;flex-direction:column;gap:10px;flex:1;}
  .art-tag{
    align-self:flex-start;
    font-family:'Baloo 2',sans-serif;font-weight:700;font-size:11px;
    background:var(--buttercup);border:2px solid var(--ink);border-radius:999px;
    padding:4px 10px;
  }
  .art-title{font-family:'Baloo 2',sans-serif;font-weight:700;font-size:18px;line-height:1.3;}
  .art-excerpt{font-size:14px;color:var(--ink-soft);font-weight:600;line-height:1.55;flex:1;}
  .art-link{font-family:'Baloo 2',sans-serif;font-weight:700;font-size:14px;color:var(--morning-breeze);}

  /* FOOTER */
  footer{
    background:var(--ink);
    color:var(--paper);
    padding:50px 0 26px;
  }
  .footer-top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:20px;}
  .footer-brand{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:22px;}
  .footer-links{display:flex;gap:22px;flex-wrap:wrap;font-weight:700;}
  .footer-bottom{
    margin-top:34px;padding-top:22px;
    border-top:2px solid rgba(255,255,255,.2);
    font-size:13px;color:rgba(255,255,255,.7);
    display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;
  }

  /* RESPONSIVE */
  @media (max-width:960px){
    .hero .wrap{grid-template-columns:1fr;}
    .hero-visual{height:360px;margin:0 auto;max-width:420px;width:100%;}
    .about .wrap{grid-template-columns:1fr;}
    .count-grid{grid-template-columns:repeat(2,1fr);}
    .gallery-grid{grid-template-columns:repeat(2,1fr);}
    .testi-grid{grid-template-columns:1fr;}
    .art-grid{grid-template-columns:repeat(2,1fr);}
  }
  @media (max-width:720px){
    .nav-links{
      position:absolute;top:100%;left:0;right:0;
      background:var(--paper);
      border-bottom:3px solid var(--ink);
      flex-direction:column;
      align-items:flex-start;
      padding:18px 24px 24px;
      gap:16px;
      display:none;
    }
    .nav-links.open{display:flex;}
    .nav-toggle{display:block;}
    .nav-cta .btn-ghost{display:none;}
    .count-grid{grid-template-columns:repeat(2,1fr);}
    .gallery-grid{grid-template-columns:1fr;}
    .art-grid{grid-template-columns:1fr;}
  }
  @media (max-width:480px){
    .count-grid{grid-template-columns:1fr 1fr;gap:16px;}
    .hero{padding:44px 0 80px;}
    .about,.gallery,.testi,.artikel{padding:64px 0;}
  }
</style>
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
  <div class="wrap">
    <a href="#" class="brand">
      <span class="brand-badge">✨</span>
      Antares Alumni Club
    </a>
    <nav class="nav-links" id="navLinks">
      <a href="#" class="menu-link">Beranda</a>
      <a href="#login" class="menu-link">Masuk</a>
    </nav>
    <div class="nav-cta">
      <a href="#login" class="btn btn-ghost btn-sm">Masuk</a>
      <button class="nav-toggle" id="navToggle" aria-label="Buka menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<!-- HERO -->
<section class="hero">
  <span class="sparkle float" style="top:60px;left:4%;font-size:26px;--r:-10deg;">⭐</span>
  <span class="sparkle float-slow" style="top:120px;right:6%;font-size:22px;--r:8deg;">✨</span>
  <span class="sparkle spin-slow" style="bottom:40px;left:8%;font-size:30px;">🌼</span>

  <div class="wrap">
    <div class="hero-copy">
      <span class="eyebrow">👋 Halo, Kawan Lama!</span>
      <h1 class="hero-headline">Siap Bernostalgia dan Bikin <span class="accent">Cerita Baru</span> Lagi? 🚀</h1>
      <p class="hero-sub">Selamat datang di markas digital kita tercinta! Tempat paling pas buat temu kangen, intip kabar terbaru teman seangkatan, dan saling dukung buat melangkah lebih jauh.</p>
      <div class="hero-cta">
        <a href="#login" class="btn btn-primary">Masuk ke Akun Kuy! 🚀</a>
        <a href="#daftar" class="btn btn-ghost">Daftar / Verifikasi Data</a>
      </div>
    </div>

    <div class="hero-visual">
      <div class="badge-chip float" style="top:-10px;right:0;--r:4deg;">📸 5.000+ Kenangan</div>
      <div class="polaroid">
        <span class="tape"></span>
        <span class="pin" style="top:-8px;right:18px;"></span>
        <img src="assets/images/antares.png" alt="Kumpul bareng alumni Antares">
        <div class="polaroid-cap">
          <span>Reuni Akbar 2026</span>
          <span>💛</span>
        </div>
      </div>
    </div>
  </div>

  <svg class="wave-divider" viewBox="0 0 1440 80" preserveAspectRatio="none" style="position:absolute;bottom:-1px;left:0;">
    <path d="M0,40 C240,90 480,0 720,30 C960,60 1200,10 1440,40 L1440,80 L0,80 Z" fill="#FFFDF7"/>
  </svg>
</section>

<!-- ABOUT -->
<section class="about" id="about">
  <div class="wrap">
    <div class="about-visual">
      <div class="about-frame">
        <img src="assets/images/antares.png" alt="Momen kumpul alumni Antares">
      </div>
      <div class="stat-float float-slow">
        <b>25+</b>
        <span>ANGKATAN GABUNG</span>
      </div>
    </div>
    <div class="about-copy">
      <span class="eyebrow">💛 Kenalin Dulu, Nih...</span>
      <h2 class="section-title">Bukan Sekadar Grup, Ini Keluarga Kedua Kita!</h2>
      <p class="section-text">Website ini dibuat khusus buat kita semua yang rindu masa-masa sekolah/kuliah dulu. Dari yang awalnya cuma mau nanya "Eh, sekarang sibuk apa?", sampai bisa kolaborasi bareng bikin project keren. Yuk, bikin jejaring silaturahmi kita makin erat dan seru di sini!</p>
    </div>
  </div>
</section>

<!-- COUNT -->
<section class="count">
  <div class="wrap">
    <div class="count-grid">
      <div class="count-card">
        <div class="emoji">🎉</div>
        <div class="num">5.000+</div>
        <div class="label">Alumni Hebat Terdaftar</div>
      </div>
      <div class="count-card">
        <div class="emoji">🤝</div>
        <div class="num">25+</div>
        <div class="label">Angkatan Seru Bergabung</div>
      </div>
      <div class="count-card">
        <div class="emoji">💼</div>
        <div class="num">150+</div>
        <div class="label">Perusahaan Partner Loker</div>
      </div>
      <div class="count-card">
        <div class="emoji">✨</div>
        <div class="num">40+</div>
        <div class="label">Keseruan Event Telah Usai</div>
      </div>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section class="gallery" id="gallery">
  <div class="wrap">
    <div class="center-head">
      <span class="eyebrow">📸 Abadikan Momen</span>
      <h2 class="section-title">Senyum, Tawa, dan Kenangan Kita!</h2>
      <p class="section-text" style="margin-left:auto;margin-right:auto;">Yuk, intip lagi momen-momen pecah dari berbagai reuni, pameran, sampai keseruan kumpul spontan kita. Dijamin bikin senyum-senyum sendiri!</p>
    </div>

    <div class="gallery-grid">
      <div class="g-slot">
        <div class="g-photo-area">
          <span class="cam">🖼️</span>
          <small>TARUH FOTOMU DI SINI</small>
        </div>
        <div class="g-cap">Reuni Akbar Paling Pecah</div>
      </div>
      <div class="g-slot">
        <div class="g-photo-area">
          <span class="cam">🖼️</span>
          <small>TARUH FOTOMU DI SINI</small>
        </div>
        <div class="g-cap">Aksi Donor Darah Alumni</div>
      </div>
      <div class="g-slot">
        <div class="g-photo-area">
          <span class="cam">🖼️</span>
          <small>TARUH FOTOMU DI SINI</small>
        </div>
        <div class="g-cap">Nongkrong Santai Lintas Angkatan</div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONI -->
<section class="testi">
  <div class="wrap">
    <div class="center-head">
      <span class="eyebrow">⭐ Cerita Seru Mereka</span>
      <h2 class="section-title">Kata Teman-Teman yang Udah Ngerasain Manfaatnya!</h2>
    </div>

    <div class="testi-grid">
      <div class="testi-card">
        <p class="testi-quote">Sumpah ngebantu banget! Lewat web ini akhirnya bisa kontakan lagi sama geng sekelas dulu. Malah kemarin sempat nongkrong bareng lagi. Asyik banget!</p>
        <div class="testi-person">
          <div class="avatar">R</div>
          <div>
            <div class="name">Rian</div>
            <div class="angkatan">Angkatan 2018</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <p class="testi-quote">Fitur lokernya juara! Kemarin dapet info lowongan dari senior sendiri, alhamdulillah langsung diterima. Makasih banyak wadahnya!</p>
        <div class="testi-person">
          <div class="avatar">D</div>
          <div>
            <div class="name">Dewi</div>
            <div class="angkatan">Angkatan 2020</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ARTIKEL -->
<section class="artikel">
  <div class="wrap">
    <div class="center-head">
      <span class="eyebrow">📰 Bacaan Asyik</span>
      <h2 class="section-title">Kabar Seru & Tips Keren Buat Kamu ✨</h2>
      <p class="section-text" style="margin-left:auto;margin-right:auto;">Update terus info terbaru seputar dunia kerja, kisah sukses alumni, dan cerita seru lainnya.</p>
    </div>

    <div class="art-grid">
      <a href="#" class="art-card">
        <div class="art-thumb">💼</div>
        <div class="art-body">
          <span class="art-tag">KARIR</span>
          <div class="art-title">Tips Gampang Tembus Dunia Kerja Kekinian ala Alumni Senior!</div>
          <p class="art-excerpt">Mau tahu rahasia lolos interview kerja di perusahaan impian? Intip tips dari kakak tingkatmu di sini...</p>
          <span class="art-link">Baca selengkapnya →</span>
        </div>
      </a>
      <a href="#" class="art-card">
        <div class="art-thumb">🎊</div>
        <div class="art-body">
          <span class="art-tag">EVENT</span>
          <div class="art-title">Kilas Balik Reuni Akbar Kemarin: Pecah Banget, Ketawa Sampai Sakit Perut!</div>
          <p class="art-excerpt">Serunya momen kumpul bareng ribuan alumni dari berbagai angkatan. Cek keseruannya di sini!</p>
          <span class="art-link">Baca selengkapnya →</span>
        </div>
      </a>
      <a href="#" class="art-card">
        <div class="art-thumb">🚀</div>
        <div class="art-body">
          <span class="art-tag">INSPIRASI</span>
          <div class="art-title">Cerita Inspiratif: Dari Hobi Nongkrong, Sekarang Jadi Pengusaha Sukses.</div>
          <p class="art-excerpt">Perjalanan seru merintis bisnis kuliner yang sekarang udah punya banyak cabang di kota besar.</p>
          <span class="art-link">Baca selengkapnya →</span>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">✨ Antares Alumni Club</div>
      <div class="footer-links">
        <a href="#about">Tentang</a>
        <a href="#gallery">Galeri</a>
        <a href="#login">Masuk</a>
        <a href="#daftar">Daftar</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Antares Alumni Club. Dibuat dengan 💛 buat kawan lama.</span>
      <span>Kawan Lama, Cerita Baru</span>
    </div>
  </div>
</footer>

<script>
  const navToggle = document.getElementById('navToggle');
  const navLinks = document.getElementById('navLinks');
  navToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
</script>

</body>
</html>