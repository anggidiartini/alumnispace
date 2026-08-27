<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IKASMAJA — Ruang Kumpul & Cerita Kita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap"
      rel="stylesheet"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- ===== NAVBAR ===== -->
    <header class="navbar" id="navbar">
      <div class="nav-inner">
        <a href="index.html" class="logo-brand">
  <span class="text-alumni">ALUMNI</span><span class="text-hub">HUB</span>
</a>

        <nav class="nav-links" id="navLinks">
  <a href="#beranda" class="active">Beranda</a>
  <a href="#lowongan">Lowongan</a>
  <a href="#alumni">Alumni</a>
  <a href="#event">Event</a>
  <a href="#album">Album</a>
</nav>



        <button class="burger" id="burgerBtn" aria-label="Buka menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </header>

    <!-- ===== HERO ===== -->
    <section class="hero" id="beranda">
      <!-- Aset Stiker OMG yang baru kita buat -->
  <img src="assets/omg2.png" alt="OMG Sticker" class="hero-omg-sticker">
      <!-- TARUH KODE TELEPON DI SINI (DI DALAM HERO) -->
  <img src="assets/telefon.png" alt="Gagang Telepon" class="hero-phone-hanger">
      <div class="hero-inner">
        <div class="hero-copy">
          <span class="pill-badge"> Halo, Angkatan Seperjuangan!</span>
          <h1 class="hero-title">
            <span class="same-color">Balik Lagi Ke</span><br />
            <span class="same-color">Masa Paling Seru</span><br />
            <span class="title-bottom"
              >Yuk! <span class="highlight">Nostalgia Bareng</span></span
            >
          </h1>

          <div class="hero-actions">

  <!-- Tombol Pertama + Kancing Kuning -->
  <div class="magnifier-container btn-with-icon">
    <img src="assets/kancing-kuning.png" alt="Kancing Kuning" class="hero-button-icon">
    <a href="#masuk" class="btn btn-fill"><span>Masuk ke Akun Kuy!</span></a>
    <img src="kaca-pembesar.png" alt="Kaca Pembesar" class="hero-magnifier">
  </div>

  <!-- Tombol Kedua + Kancing Merah -->
  <div class="btn-with-icon">
    <img src="assets/kancing-merah.png" alt="Kancing Merah" class="hero-button-icon">
    <a href="#daftar" class="btn btn-outline"><span>Jelajahi Bersama</span></a>
  </div>

</div>
          <!-- Audio Player yang sudah dilengkapi tag audio di dalamnya -->
        <div class="hero-audio">
          <button class="audio-toggle" aria-label="Putar / jeda">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <rect x="3" y="2" width="3.5" height="12" rx="1" fill="currentColor" />
            <rect x="9.5" y="2" width="3.5" height="12" rx="1" fill="currentColor" />
          </svg>
          </button>
            <div class="audio-bars" aria-hidden="true">
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span>
            </div>
            <audio id="bg-audio" src="music.mp3" loop></audio>
          </div>
        </div>



        <div class="hero-visual">
          <div class="tv-wrapper">
            <!-- Foto Grup di dalam layar TV -->
            <div class="tv-screen-content">
              <img src="assets/alumni-group.png" alt="Foto Nostalgia Sekolah" />
            </div>
            <!-- Bingkai TV Utama -->
            <img src="assets/tv-assets.png" alt="Bingkai TV" class="img-tv-frame" />
          </div>
        </div>
        <!-- Banner Panjang Bawah -->
        <div class="hero-ticker-banner">
  <div class="ticker-track">
    <span>Tidak Ada Kenangan Masa Sekolah Yang Lebih Indah Dari Masa - Masa Sekolah , Tiada Hari Tanpa Canda, Tawa, Sedih &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;</span>
    <span>Tidak Ada Kenangan Masa Sekolah Yang Lebih Indah Dari Masa - Masa Sekolah , Tiada Hari Tanpa Canda, Tawa, Sedih &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;</span>
    <span>Tidak Ada Kenangan Masa Sekolah Yang Lebih Indah Dari Masa - Masa Sekolah , Tiada Hari Tanpa Canda, Tawa, Sedih &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;</span>
  </div>
</div>



    </section>

    <!-- ===== ABOUT ===== -->
    <section class="about" id="about">
      <div class="about-inner">
        <div class="about-visual">
          <div class="framed-photo">🏫</div>
          <div class="badge-float">
            <strong>30+</strong>
            <span>ANGKATAN TERHUBUNG</span>
          </div>
        </div>

        <div class="about-copy">
          <span class="pill-badge">💛 Cerita di Balik Layar</span>
          <h2>Bukan Cuma Grup Chat, Ini Keluarga Besar Kita!</h2>
          <p>
            Berawal dari rindu kantin sekolah, PR yang menumpuk, hingga cerita
            kenakalan masa remaja. Portal ini hadir agar silaturahmi kita tidak
            putus di gerbang kelulusan. Mari saling dukung karier, bangun
            kolaborasi, dan sebarkan energi positif antarsesama alumni!
          </p>
        </div>
      </div>
    </section>

    <!-- ===== STATS ===== -->
    <section class="stats" id="stats">
      <!-- Aset Lembar Kertas di Kiri -->
  <img src="assets/lembar-atas.png" alt="Hiasan Lembar Kertas" class="stats-corner-paper">
      <div class="stats-marquee">
        <div class="stats-track" id="statsTrack">
          <div class="stat-card tint-white">
            <span class="stat-icon">🎉</span>
            <span class="stat-number" data-count="3800">0</span
            ><span class="plus">+</span>
            <p>Alumni Terdaftar Aktif</p>
          </div>
          <div class="stat-card tint-blue">
            <span class="stat-icon">🤝</span>
            <span class="stat-number" data-count="30">0</span
            ><span class="plus">+</span>
            <p>Angkatan Tergabung</p>
          </div>
          <div class="stat-card tint-gold">
            <span class="stat-icon">💼</span>
            <span class="stat-number" data-count="120">0</span
            ><span class="plus">+</span>
            <p>Peluang Karier & Bisnis</p>
          </div>
          <div class="stat-card tint-white">
            <span class="stat-icon">✦</span>
            <span class="stat-number" data-count="45">0</span
            ><span class="plus">+</span>
            <p>Agenda & Reuni Sukses</p>
          </div>
          <!-- duplicate set for seamless scrolling -->
          <div class="stat-card tint-white" aria-hidden="true">
            <span class="stat-icon">🎉</span>
            <span class="stat-number" data-count="3800">0</span
            ><span class="plus">+</span>
            <p>Alumni Terdaftar Aktif</p>
          </div>
          <div class="stat-card tint-blue" aria-hidden="true">
            <span class="stat-icon">🤝</span>
            <span class="stat-number" data-count="30">0</span
            ><span class="plus">+</span>
            <p>Angkatan Tergabung</p>
          </div>
          <div class="stat-card tint-gold" aria-hidden="true">
            <span class="stat-icon">💼</span>
            <span class="stat-number" data-count="120">0</span
            ><span class="plus">+</span>
            <p>Peluang Karier & Bisnis</p>
          </div>
          <div class="stat-card tint-white" aria-hidden="true">
            <span class="stat-icon">✦</span>
            <span class="stat-number" data-count="45">0</span
            ><span class="plus">+</span>
            <p>Agenda & Reuni Sukses</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== TAMBAHAN BARIS PITA BERGERAK DI BAWAHNYA ===== -->
<div class="running-stripe-bar"></div>
    <!-- ===== GALLERY / ALBUM ===== -->
<section class="gallery" id="album">
  <!-- DIV KHUSUS BACKGROUND (Biar bisa dipanjangkan ke bawah lewat CSS) -->
  <div class="album-bg-extension"></div>

  <!-- Kumpulan Aset Dekorasi Estetik -->
<div class="decor-assets-container">

  <!-- 1. Kartu Kuning (Tempat Teks) -->
  <img src="assets/card-kuning.png" class="decor-item asset-card-biru" alt="Card Biru">

  <!-- 🔥 KONTEN TEKS DI DALAM KARTU (Tanpa inline style) 🔥 -->
  <div class="card-content-box">
    <h2 class="card-title">Ketawa Bareng<br>Lagi di Sini</h2>
    <p class="card-desc">
      Nggak kerasa waktu cepat banget mutar. Dari yang dulunya rebutan bangku di kelas paling belakang, nyontek PR pas pagi-pagi buta, sampai sekarang masing-masing udah sibuk sama jalan hidupnya. Yuk, intip lagi galeri momen terbaik kita!
    </p>
    <div class="card-btn">Momen Bersama</div>


</div>
    <!-- ==========================================
     2. 10 ASET DEKORASI
     ========================================== -->

    <!-- Aset 1: Jendela -->
    <img src="assets/foto-jendela.png" alt="Jendela" class="decor-item asset-window animate-up">

    <!-- Aset 2: Foto di Dalam Jendela -->
    <img src="assets/fotodijendela copy.png" alt="Foto Jendela" class="decor-item asset-window-photo animate-up">

    <!-- Aset 3: Telepon (Spesial: Wadah luar untuk animasi scroll, gambar dalam untuk ayun) -->
    <div class="decor-item asset-phone-wrapper animate-up" style="position: absolute !important; top: -1px !important; left: 35px !important; z-index: 13 !important;">
      <img src="assets/telfon-hitam.png" alt="Telepon" class="asset-phone-img" style="width: 180px !important;">
    </div>

    <!-- Aset 4: Pegang Buku -->
    <img src="assets/bukupink.png" alt="Pegang Buku" class="decor-item asset-book animate-up">

    <!-- Aset 5: Pegang HP -->
    <img src="assets/pegang-hp.png" alt="Pegang HP" class="decor-item asset-phone-hand animate-up">

    <!-- Aset 6: Mata -->
    <img src="assets/mata.png" alt="Mata" class="decor-item asset-eyes animate-up">

    <!-- Aset 7: Memories -->
    <img src="assets/memories.png" alt="Memories" class="decor-item asset-memories animate-up">

    <!-- Aset 8: Gitar -->
    <img src="assets/gitarmerah.png" alt="Gitar" class="decor-item asset-guitar animate-up">

    <!-- Aset 9: Kamera Pink -->
    <img src="assets/kamerapink.png" alt="Kamera Pink" class="decor-item asset-camera animate-up">

    <!-- Aset 10: Polkadot -->
    <img src="assets/polkadot.png" alt="Polkadot" class="decor-item asset-polkadot animate-up">

    <!-- Aset 11: Omg -->
    <img src="assets/omg2.png" alt="Omg" class="decor-item asset-omg animate-up">

  </div>
</section>

    <!-- ===== SECTION MOMENTS DENGAN GARIS BERGERAK KUNING ===== -->
<section class="testimoni" id="moments" style="position: relative; overflow: hidden;">
  <!-- Garis berjalan warna kuning di atas section -->
  <div class="moving-stripe-bar"></div>

  <!-- Wadah utama area scrapbook -->
  <div class="scrapbook-container">
    <!-- Masukkan ke-24 aset kamu di sini (Contoh beberapa, ganti src dengan aset kamu) -->
    <img src="assets/polaroid-biru1.png" class="scrap-item polaroid-biru1" alt="Polaroid Biru 1">
    <img src="assets/polkadot.png" class="scrap-item polkadot" alt="Polkadot">
    <img src="assets/panah-merah.png" class="scrap-item panah-merah" alt="Panah Merah">

    <img src="assets/map-kuning.png" class="scrap-item map-kuning1" alt="Map Kuning1">
    <img src="assets/polaroid-kuning.png" class="scrap-item polaroid-kuning" alt="Polaroid Kuning">
    <img src="assets/foto-handball.png" class="scrap-item foto-handball" alt="Foto Handball">
    <img src="assets/panah-biru.png" class="scrap-item panah-biru" alt="Panah Biru">
    <img src="assets/map-biru.png" class="scrap-item map-biru" alt="Map Biru">
    <img src="assets/foto-batik.png" class="scrap-item foto-batik" alt="Foto Batik">
    <img src="assets/polaroid-biru1.png" class="scrap-item polaroid-biru2" alt="Polaroid Biru 2">
    <img src="assets/foto-agustus.png" class="scrap-item foto-agustus" alt="Foto Agustus">
    <img src="assets/panah-biru.png" class="scrap-item panah-biru2" alt="Panah Biru 2">
    <img src="assets/map-kuning.png" class="scrap-item map-kuning2" alt="Map Kuning 2">
    <img src="assets/polkadot.png" class="scrap-item polkadot2" alt="Polkadot 2">
    <img src="assets/mata.png" class="scrap-item mata1" alt="mata1">
    <img src="assets/mata.png" class="scrap-item mata2" alt="mata2">
    <img src="assets/mata.png" class="scrap-item mata3" alt="mata3">
    <img src="assets/kotak-kuning.png" class="scrap-item kotak-kuning1" alt="Kotak Kuning 1">
    <img src="assets/kotak-kuning.png" class="scrap-item kotak-kuning2" alt="Kotak Kuning 2">
    <img src="assets/kotak-merah.png" class="scrap-item kotak-merah" alt="Kotak Merah">
    <img src="assets/telfon-hitam.png" class="scrap-item telfon-hitam" alt="Telfon Hitam">
    <img src="assets/aset-4.png" class="scrap-item item-4" alt="Aset 4">
    <img src="assets/aset-4.png" class="scrap-item item-4" alt="Aset 4">
    <img src="assets/aset-4.png" class="scrap-item item-4" alt="Aset 4">


  </div>

  <!-- Kosong total sesuai permintaan sebelumnya -->
</section>

    <!-- ===== BLOG / ARTIKEL ===== -->
    <section class="blog" id="lowongan">
      <div class="section-head">
        <span class="pill-badge">📰 Wawasan & Kabar</span>
        <h2>Informasi Karier & Cerita Inspiratif ✨</h2>
        <p>
          Update info dunia kerja, tips pengembangan diri, dan kisah sukses dari
          kakak/adik tingkat yang berkiprah di berbagai bidang.
        </p>
      </div>

      <div class="blog-grid">
        <article class="blog-card">
          <div class="blog-cover cover-blue">💼</div>
          <span class="tag">KARIER</span>
          <h3>
            Strategi Menembus Perusahaan Impian Berdasarkan Pengalaman Alumni
          </h3>
          <p>
            Simak tips dan trik langsung dari para profesional senior seputar
            persiapan CV, wawancara kerja, dan membangun relasi...
          </p>
          <a href="#" class="read-more">Baca selengkapnya →</a>
        </article>
        <article class="blog-card">
          <div class="blog-cover cover-orange">🎯</div>
          <span class="tag">AGENDA</span>
          <h3>
            Persiapan Reuni Akbar Mendatang: Catat Tanggal & Kejutan Serunya!
          </h3>
          <p>
            Rencana temu akbar tahun ini bakal lebih meriah dengan berbagai
            kegiatan menarik dan doorprize spesial. Jangan sampai ketinggalan!
          </p>
          <a href="#" class="read-more">Baca selengkapnya →</a>
        </article>
        <article class="blog-card">
          <div class="blog-cover cover-blue">💡</div>
          <span class="tag">BISNIS</span>
          <h3>
            Kisah Sukses UMKM Alumni: Dari Hobi Sampingan Jadi Bisnis Skala
            Besar
          </h3>
          <p>
            Perjalanan inspiratif merintis usaha kuliner dan kreatif dari nol
            hingga sukses menembus pasar nasional.
          </p>
          <a href="#" class="read-more">Baca selengkapnya →</a>
        </article>
      </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer" id="event">
      <div class="footer-inner">
        <div class="footer-brand">
          <span class="logo-icon">✦</span>
          <span class="logo-text">IKASMAJA</span>
          <p>
            Satu almamater, sejuta cerita indah. Wadah resmi komunikasi dan
            kolaborasi seluruh keluarga besar alumni.
          </p>
        </div>
        <div class="footer-links">
          <div>
            <h4>Jelajahi</h4>
            <a href="#lowongan">Lowongan</a>
            <a href="#alumni">Alumni</a>
            <a href="#album">Album</a>
          </div>
          <div>
            <h4>Komunitas</h4>
            <a href="#event">Event</a>
            <a href="#masuk">Masuk</a>
            <a href="#daftar">Daftar</a>
          </div>
        </div>
      </div>
      <p class="footer-bottom">
        © 2026 IKASMAJA. Dibuat dengan penuh rasa nostalgia & kebersamaan.
      </p>
    </footer>

    <script src="script.js"></script>
    <script>
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('header.navbar');
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
</script>
<script>
  // Script untuk memicu animasi masuk saat section album/galeri di-scroll ke layar
  document.addEventListener("DOMContentLoaded", function() {
    const albumSection = document.querySelector("#album");

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Tambahkan kelas 'active' ke section saat sudah kelihatan di layar
          albumSection.classList.add("animate-visible");
          observer.unobserve(entry.target); // Jalankan sekali saja
        }
      });
    }, {
      threshold: 0.2 // Animasi mulai berjalan saat 20% bagian galeri terlihat di layar
    });

    if (albumSection) {
      observer.observe(albumSection);
    }
  });
</script>
  </body>
</html>
