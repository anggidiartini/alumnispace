<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <title>Alumni Hub</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <x-navbar />
    <!-- NAVBAR TRANSPARAN -->
<header class="navbar-container">
    <div class="navbar-logo">
        ALUMNI HUB
    </div>

    <!-- Tombol Garis Tiga (Hamburger) untuk HP -->
    <div class="menu-toggle" id="menuToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Menu Navbar (Href dikosongkan/diatur ke # agar tidak pindah section) -->
    <nav class="navbar-menu" id="navbarMenu">
        <a href="#" class="active">Beranda</a>
        <a href="#">Lowongan</a>
        <a href="#">Alumni</a>
        <a href="#">Event</a>
        <a href="#">Album</a>
    </nav>
</header>

    <!-- KONTEN UTAMA: 5 SECTION -->
    <main>
       <!-- Di bagian dalam <section id="section-1" class="content-section bg-1"> -->
<section id="section-1" class="content-section bg-1">
<!-- 4 ASET DEKORASI -->
    <img src="{{ asset('assets/images/telefon.png') }}" alt="Aset Telepon" class="hero-asset asset-telepon">
    <img src="{{ asset('assets/images/polaroid-pink.png') }}" alt="Aset Polaroid" class="hero-asset asset-polaroid">
    <img src="{{ asset('assets/images/polka-kuning.png') }}" alt="Aset Polkadot" class="hero-asset asset-polkadot">
    <img src="{{ asset('assets/images/foto-home.png') }}" alt="Aset Foto" class="hero-asset asset-foto">

    <div class="hero-content">


        <h1 class="hero-title">
    Balik Lagi Ke<br>
    Masa Paling Seru<br>
    <span class="text-yuk">Yuk!</span> <span class="title-bottom">Nostalgia Bareng</span>
</h1>

        <!-- Tombol Aksi -->
        <div class="hero-buttons">
            <a href="#" class="btn-primary-custom">Masuk ke Akun Kuy!</a>
            <a href="#" class="btn-secondary-custom">Jelajahi Bersama</a>
        </div>


</div>
    </div>
</section>



       <section id="section-2" class="content-section bg-2">

       <img src="{{ asset('assets/images/lembaratas.png') }}" alt="Aset Lembaran" class="asset-lembaran">
    <div class="section-inner">
        <div class="stats-container">
            <div class="stat-box">
                <h2 class="stat-number" data-target="36" data-suffix="">0</h2>
                <p class="stat-label">Angkatan</p>
            </div>
            <div class="stat-box">
                <h2 class="stat-number" data-target="1025" data-suffix="+">0</h2>
                <p class="stat-label">Total Alumni</p>
            </div>
            <div class="stat-box">
                <h2 class="stat-number" data-target="24" data-suffix="+">0</h2>
                <p class="stat-label">Lowongan Kerja</p>
            </div>
            <div class="stat-box">
                <h2 class="stat-number" data-target="538" data-suffix="">0</h2>
                <p class="stat-label">Alumni Tersebar</p>
            </div>
        </div>
    </div>
</section>

<!-- PEMBATAS GARIS BERGERAK ANTARA SECTION 2 & 3 -->

<div class="moving-stripe-divider"></div>
        <section id="section-3" class="content-section bg-3">

    <!-- 9 Aset di Section 3 -->
    <img src="{{ asset('assets/images/telfon-hitam.png') }}" alt="Telepon Hitam" class="asset-item asset-telepon">
    <img src="{{ asset('assets/images/jendela-pink.png') }}" alt="Jendela Pink" class="asset-item asset-jendela">
    <img src="{{ asset('assets/images/card-kuning.png') }}" alt="Card Kuning" class="asset-item asset-card">
    <img src="{{ asset('assets/images/fotodijendela.png') }}" alt="Foto" class="asset-item asset-foto">
    <img src="{{ asset('assets/images/mata.png') }}" alt="Mata" class="asset-item asset-mata">
    <img src="{{ asset('assets/images/gitarmerah.png') }}" alt="Gitar" class="asset-item asset-gitar">
    <img src="{{ asset('assets/images/polkadot.png') }}" alt="Polkadot Pink" class="asset-item asset-polkadot">
    <img src="{{ asset('assets/images/kamerapink.png') }}" alt="Kamera Pink" class="asset-item asset-kamera">
     <img src="{{ asset('assets/images/bukupink.png') }}" alt="Pegang Buku" class="asset-item asset-buku">

    <!-- Konten Teks & Button di dalam Card -->
<div class="card-content-inner">
 <h3 class="card-title">Ketawa Bareng Lagi Disini</h3>
 <p class="card-desc">
Balik lagi ke sudut jendela ini, tempat kita dulu rebutan
bangku, nyontek PR, gaduh, sampai berantem lalu baikan lagi.
Waktu boleh bikin sibuk, tapi kita selalu punya alasan buat
ketawa bareng lagi di sini.
</p>
 <a href="#jendela" class="card-btn">Jelajahi Kelas</a>
</div>
</div>
</section>

<!-- GARIS BELANG-BELANG PINK BERGERAK -->
<div class="pink-stripe-marquee"></div>

        <!-- SECTION 4 -->
<section id="section-4" class="content-section bg-4">
    <!-- Panel Kiri: Polkadot -->
    <div class="bg-4-left"></div>

    <!-- Panel Kanan: Garis-garis -->
    <div class="bg-4-right"></div>

    <!-- Tempat Aset & Konten Section 4 -->
    <div class="section-inner">

        <div class="section4-container">
            <div class="photo-grid">
                <!-- Kotak 1 -->
                <div class="photo-card" onclick="openLightbox('foto1.jpg')">
                    <img src="{{ asset('assets/images/foto-2.png') }}" alt="Foto 1">
                </div>
                <!-- Kotak 2 -->
                <div class="photo-card" onclick="openLightbox('foto2.jpg')">
                    <img src="{{ asset('assets/images/foto02.png') }}" alt="Foto 2">
                </div>
                <!-- Kotak 3 -->
                <div class="photo-card" onclick="openLightbox('foto3.jpg')">
                    <img src="{{ asset('assets/images/foto03.png') }}" alt="Foto 3">
                </div>
                <!-- Kotak 4 -->
                <div class="photo-card" onclick="openLightbox('foto4.jpg')">
                    <img src="{{ asset('assets/images/foto04.png') }}" alt="Foto 4">
                </div>
            </div>
</div>
</section>

<!-- MODAL LIGHTBOX -->
<div id="imageLightbox" class="lightbox-modal" onclick="closeLightbox()">
    <span class="lightbox-close">&times;</span>
    <img class="lightbox-content" id="lightboxImg">
</div>
<!-- Garis Animasi Berjalan Kuning -->


    </main>

    <x-footer />

    <!-- Script JavaScript Toggle Menu & JS External -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navbarMenu = document.getElementById('navbarMenu');

        menuToggle.addEventListener('click', () => {
            navbarMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });

        document.querySelectorAll('.navbar-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navbarMenu.classList.remove('active');
                menuToggle.classList.remove('active');
            });
        });
    </script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
