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
    --morning-breeze:#7FA8D6;
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

  .eyebrow{
    display:inline-flex;
    align-items:center;
    gap:8px;
    font-family:'Baloo 2', sans-serif;
    font-weight:700;
    font-size:14px;
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
  .btn-primary{background:var(--morning-breeze);color:var(--paper);}
  .btn-ghost{background:var(--paper);color:var(--ink);}

  /* Animasi dekorasi */
  .sparkle{position:absolute;pointer-events:none;opacity:.9;}
  @keyframes float{
    0%,100%{transform:translateY(0) rotate(var(--r,0deg));}
    50%{transform:translateY(-12px) rotate(var(--r,0deg));}
  }
  .float{animation:float 5s ease-in-out infinite;}

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
  .gallery-hero .wrap{max-width:800px;position:relative;z-index:2;}
  .gallery-title{
    font-size:clamp(34px, 5vw, 52px);
    margin-top:14px;
  }
  .gallery-title .accent{
    color:var(--coral);
    background:var(--paper);
    padding:0 10px;
    border-radius:10px;
    border:3px solid var(--ink);
    display:inline-block;
    box-shadow:3px 3px 0 var(--ink);
    transform:rotate(1.5deg);
  }
  .gallery-sub{
    margin-top:14px;
    font-size:17px;
    font-weight:600;
    color:var(--ink-soft);
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
    background:var(--morning-breeze);
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
    font-size:48px;
    margin-bottom:14px;
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



<!-- HERO SECTION -->
<section class="gallery-hero">
  <span class="sparkle float" style="top:25px;left:10%;font-size:28px;--r:-10deg;">📸</span>
  <span class="sparkle float" style="top:40px;right:12%;font-size:26px;--r:12deg;">✨</span>

  <div class="wrap">
    <span class="eyebrow">🖼️ Album Kenangan & Dokumentasi</span>
    <h1 class="gallery-title">Jejak Keseruan & Momen Indah <span class="accent">Keluarga Antares!</span></h1>
    <p class="gallery-sub">Kumpulan potret hangat dari berbagai acara temu kangen, webinar inspiratif, hingga workshop bareng. Yuk intip, siapa tahu ada muka kamu di sini! 💛</p>
  </div>
</section>

<!-- MAIN GALLERY CONTENT -->
<section class="gallery-content">
  <div class="wrap">

    <!-- BAR FILTER & PENCARIAN -->
    <div class="filter-bar">
      <div class="category-pills" id="filterList">
        <button class="pill-btn active" data-filter="all">🔥 Semua Album (9)</button>
        <button class="pill-btn" data-filter="Meetup">☕ Temu Kangen & Meetup</button>
        <button class="pill-btn" data-filter="Webinar">💻 Webinar & Tech Talk</button>
        <button class="pill-btn" data-filter="Workshop">🛠️ Workshop & Coding</button>
      </div>

      <div class="search-box">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari nama event / tahun...">
      </div>
    </div>

    <!-- GRID FOTO ALBUM (9 CARD) -->
    <div class="photo-grid" id="photoGrid">

      <!-- FOTO 1 -->
      <div class="photo-card" data-category="Meetup">
        <div class="photo-wrapper">☕🎉</div>
        <div class="photo-meta">
          <span>📅 15 Agustus 2026</span>
          <span>📍 Denpasar, Bali</span>
        </div>
        <h2 class="photo-title">Gathering Santai Edisi Kemerdekaan</h2>
        <p class="photo-desc">Keseruan kumpul-kumpul sambil ngobrolin seputar perkembangan dunia kerja kreatif lintas angkatan di salah satu cafe hits Bali.</p>
        <div class="photo-footer">
          <span class="badge-tag">Meetup</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 2 -->
      <div class="photo-card" data-category="Webinar">
        <div class="photo-wrapper">💻🚀</div>
        <div class="photo-meta">
          <span>📅 28 Juli 2026</span>
          <span>📍 Online via Zoom</span>
        </div>
        <h2 class="photo-title">Webinar UI/UX & AI Integration</h2>
        <p class="photo-desc">Sesi sharing intensif bersama para alumni senior yang membedah bagaimana memanfaatkan AI untuk efisiensi desain produk.</p>
        <div class="photo-footer">
          <span class="badge-tag">Webinar</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 3 -->
      <div class="photo-card" data-category="Workshop">
        <div class="photo-wrapper">🛠️⚡</div>
        <div class="photo-meta">
          <span>📅 10 Juni 2026</span>
          <span>📍 Lab Komputer Utama</span>
        </div>
        <h2 class="photo-title">Workshop Kilat: Ngoding Bareng PHP & XAMPP</h2>
        <p class="photo-desc">Peserta tampak antusias serius ngulik database dan debugging kode bersama mentor alumni di lab kampus.</p>
        <div class="photo-footer">
          <span class="badge-tag">Workshop</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 4 -->
      <div class="photo-card" data-category="Meetup">
        <div class="photo-wrapper">🍲✨</div>
        <div class="photo-meta">
          <span>📅 20 Mei 2026</span>
          <span>📍 Jakarta Selatan</span>
        </div>
        <h2 class="photo-title">Buka Bersama & Silaturahmi Alumni</h2>
        <p class="photo-desc">Momen hangat melepas rindu sambil menikmati hidangan lezat dan bernostalgia masa-masa kuliah dulu.</p>
        <div class="photo-footer">
          <span class="badge-tag">Meetup</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 5 -->
      <div class="photo-card" data-category="Webinar">
        <div class="photo-wrapper">📈💡</div>
        <div class="photo-meta">
          <span>📅 14 April 2026</span>
          <span>📍 Online Google Meet</span>
        </div>
        <h2 class="photo-title">Karier Series: Tembus Remote Job</h2>
        <p class="photo-desc">Bedah tips praktis menyusun portofolio digital yang memikat client internasional dari rumah.</p>
        <div class="photo-footer">
          <span class="badge-tag">Webinar</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 6 -->
      <div class="photo-card" data-category="Workshop">
        <div class="photo-wrapper">🎨🎯</div>
        <div class="photo-meta">
          <span>📅 02 Maret 2026</span>
          <span>📍 Bandung Creative Hub</span>
        </div>
        <h2 class="photo-title">Pelatihan Branding & Desain Produk Matchora</h2>
        <p class="photo-desc">Studi kasus nyata pembuatan identitas visual produk kuliner lokal yang sukses meluncur ke pasaran.</p>
        <div class="photo-footer">
          <span class="badge-tag">Workshop</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 7 (TAMBAHAN BARU 1) -->
      <div class="photo-card" data-category="Meetup">
        <div class="photo-wrapper">🌴🌊</div>
        <div class="photo-meta">
          <span>📅 12 Januari 2026</span>
          <span>📍 Pantai Sanur, Bali</span>
        </div>
        <h2 class="photo-title">Fun Outing & Beach Cleanup Bareng</h2>
        <p class="photo-desc">Aksi bersih-bersih pantai dilanjutkan games seru dan barbeque sore hari buat mempererat kekompakan.</p>
        <div class="photo-footer">
          <span class="badge-tag">Meetup</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 8 (TAMBAHAN BARU 2) -->
      <div class="photo-card" data-category="Webinar">
        <div class="photo-wrapper">🎤📊</div>
        <div class="photo-meta">
          <span>📅 18 Desember 2025</span>
          <span>📍 Online Live Streaming</span>
        </div>
        <h2 class="photo-title">Akhir Tahun Review: Tren Teknologi 2026</h2>
        <p class="photo-desc">Diskusi panel santai membahas prediksi dan proyeksi teknologi apa saja yang bakal booming di tahun depan.</p>
        <div class="photo-footer">
          <span class="badge-tag">Webinar</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

      <!-- FOTO 9 (TAMBAHAN BARU 3) -->
      <div class="photo-card" data-category="Workshop">
        <div class="photo-wrapper">🧩💻</div>
        <div class="photo-meta">
          <span>📅 05 November 2025</span>
          <span>📍 Kampus Utama Antares</span>
        </div>
        <h2 class="photo-title">Hackathon Mini: Bikin MVP dalam 6 Jam</h2>
        <p class="photo-desc">Adu cepat dan kreatif ngebut bikin purwarupa aplikasi pemecah masalah sosial bareng tim lintas jurusan.</p>
        <div class="photo-footer">
          <span class="badge-tag">Workshop</span>
          <a href="#" class="btn btn-primary" style="padding:6px 14px; font-size:13px;">Lihat Foto 👁️‍🗨️</a>
        </div>
      </div>

    </div>

  </div>
</section>


<!-- SCRIPT FILTER & PENCARIAN GALERI -->
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
</script>

</body>
</html>