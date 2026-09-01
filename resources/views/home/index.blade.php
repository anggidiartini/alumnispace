<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JejakKeluarga - Platform Alumni SMA Ceria</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    <header class="header-nav" id="mainHeader">
        <div class="nav-container">
            <div class="logo-brand">
                <div class="logo-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <span class="brand-name">Jejak<span class="highlight">Keluarga</span></span>
            </div>

            <nav class="nav-links" id="navLinks">
    <!-- 1. Beranda / Profil -->
    <div class="dropdown">
        <a href="#beranda" class="nav-item drop-btn">Beranda / Profil <i class="fa-solid fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#angka">Statistik</a></li>
        </ul>
    </div>

    <!-- 2. Komunitas -->
    <div class="dropdown">
        <a href="#komunitas" class="nav-item drop-btn">Komunitas <i class="fa-solid fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="#alumni">Alumni</a></li>
            <li><a href="#testimoni">Testimoni</a></li>
        </ul>
    </div>

    <!-- 3. Media & Berita -->
    <div class="dropdown">
        <a href="#media" class="nav-item drop-btn">Media & Berita <i class="fa-solid fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="#artikel">Artikel</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="#album">Album</a></li>
        </ul>
    </div>

    <!-- 4. Informasi -->
    <div class="dropdown">
        <a href="#informasi" class="nav-item drop-btn">Informasi <i class="fa-solid fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
            <li><a href="#lowongan">Lowongan</a></li>
            <li><a href="#event">Event</a></li>
        </ul>
    </div>
</nav>

            <div class="auth-action">
                <div id="loggedOutState">
                    <a href="{{ route('login') }}" class="btn-login" id="loginBtn">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk
                    </a>
                </div>
                <div id="loggedInState" class="hidden">
                    <div class="user-profile-badge" id="userProfileDropdown">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100" alt="Avatar" class="avatar-img">
                        <span class="user-name">Kanya Salsabila</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <a href="#profil-saya"><i class="fa-solid fa-user"></i> Profil Saya</a>
                        <a href="#pengaturan"><i class="fa-solid fa-gear"></i> Pengaturan</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" id="logoutBtn" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                    </div>
                </div>
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
    </header>

    <main class="main-content-wrapper">

        <div id="landingView" class="view-section active-view">

            <section class="hero-section" id="hero">

                <div class="hero-blob blob-1"></div>
                <div class="hero-blob blob-2"></div>
                <div class="container hero-grid">
                    <div class="hero-text" data-aos="fade-right" data-aos-duration="800">
                        <span class="badge-tag">✨ Platform Alumni Generasi Baru</span>
                        <h1>
    Siap Bernostalgia <br>
    dan <span class="badge-capsule">Cerita Baru</span> <br>
    Lagi?
</h1>
                        <p class="hero-desc">
    Selamat datang di <span class="highlight-box">markas digital kita tercinta!</span> Tempat paling pas buat <span class="highlight-box">temu kangen,</span> intip kabar terbaru teman seangkatan, dan saling dukung buat <span class="highlight-box">melangkah lebih jauh.</span>
</p>
                        <div class="hero-buttons">
                            <button class="btn-primary-glow" id="heroLoginTrigger">Gabung Sekarang <i class="fa-solid fa-arrow-right"></i></button>
                            <a href="#tentang" class="btn-secondary-outline">Pelajari Dulu <i class="fa-solid fa-compass"></i></a>
                        </div>
                        <div class="hero-avatars">
                            <div class="avatar-group">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100" alt="">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100" alt="">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100" alt="">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100" alt="">
                            </div>
                            <p>Bergabung dengan <strong>2,500+</strong> alumni aktif!</p>
                        </div>
                    </div>
                    <div class="hero-image-wrapper" data-aos="fade-left" data-aos-duration="800">

                </div>
            </section>

            <section class="section-padding bg-light-tint" id="tentang">
                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span class="badge-tag">Tentang Kami</span>
                        <h2>Kenapa Sih Harus Pakai <span class="highlight">JejakKeluarga</span>?</h2>
                        <p>Bukan cuma buku tahunan digital biasa. Ini ekosistem digital anak SMA jaman now.</p>
                    </div>
                    <div class="grid-3 mt-5">
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon bg-blue-light"><i class="fa-solid fa-network-wired text-blue"></i></div>
                            <h3>Networking Gampang</h3>
                            <p>Temukan alumni satu almamater yang berkarier di industri impianmu. Tanya-tanya info loker jadi lebih gampang.</p>
                        </div>
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-icon bg-yellow-light"><i class="fa-solid fa-calendar-star text-yellow"></i></div>
                            <h3>Event & Reuni Seru</h3>
                            <p>Ikuti berbagai keseruan mulai dari ngobrol santai, webinar karir, sampai reuni akbar sekolah yang anti-bosan.</p>
                        </div>
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-icon bg-pink-light"><i class="fa-solid fa-bullhorn text-pink"></i></div>
                            <h3>Update Kabar & Kolaborasi</h3>
                            <p>Jangan sampai ketinggalan prestasi teman-temanmu. Kolaborasi bikin project bareng jadi makin sat-set.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding stats-section" id="angka">
                <div class="container">
                    <div class="stats-grid" data-aos="zoom-in">
                        <div class="stat-box">
                            <h3>2,540+</h3>
                            <p>Total Alumni Terdaftar</p>
                        </div>
                        <div class="stat-box">
                            <h3>45+</h3>
                            <p>Angkatan Sekolah</p>
                        </div>
                        <div class="stat-box">
                            <h3>180+</h3>
                            <p>Lowongan Pekerjaan</p>
                        </div>
                        <div class="stat-box">
                            <h3>35+</h3>
                            <p>Negara Perantauan</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding" id="galeri">
                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span class="badge-tag">Momen Seru</span>
                        <h2>Galeri <span class="highlight">Alumni Ceria</span></h2>
                        <p>Kilas balik keseruan kumpul-kumpul dari masa sekolah sampai sekarang.</p>
                    </div>
                    <div class="gallery-grid mt-5">
                        <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                            <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500" alt="Gallery 1">
                            <div class="gallery-overlay">
                                <h5>Reuni Akbar 2025</h5>
                                <p>GBK Senayan</p>
                            </div>
                        </div>
                        <div class="gallery-item" data-aos="fade-up" data-aos-delay="200">
                            <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=500" alt="Gallery 2">
                            <div class="gallery-overlay">
                                <h5>Gathering Angkatan 2017</h5>
                                <p>Cafe Rooftop SCBD</p>
                            </div>
                        </div>
                        <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
                            <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=500" alt="Gallery 3">
                            <div class="gallery-overlay">
                                <h5>Webinar Karir Tech</h5>
                                <p>Online Zoom Live</p>
                            </div>
                        </div>
                        <div class="gallery-item" data-aos="fade-up" data-aos-delay="400">
                            <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=500" alt="Gallery 4">
                            <div class="gallery-overlay">
                                <h5>Charity Run Alumni</h5>
                                <p>Monas Jakarta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding bg-light-tint" id="testimoni">
                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span class="badge-tag">Kata Mereka</span>
                        <h2>Apa Kata <span class="highlight">Alumni Hits</span>?</h2>
                        <p>Testimoni jujur dari mereka yang udah merasakan manfaat platform ini.</p>
                    </div>
                    <div class="grid-3 mt-5">
                        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <p>"Berkat JejakKeluarga, aku bisa nyambung lagi sama ketua geng kelasku dulu dan sekarang malah jadi partner bisnis startup!"</p>
                            <div class="testi-author">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100" alt="">
                                <div>
                                    <h5>Rangga Pratama</h5>
                                    <small>Angkatan 2015 • Software Engineer</small>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <p>"Informasi lowongan kerja di sini valid banget karena langsung direkomendasikan sama kakak tingkat yang udah senior di korporat."</p>
                            <div class="testi-author">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100" alt="">
                                <div>
                                    <h5>Nabila Zahra</h5>
                                    <small>Angkatan 2018 • Product Manager</small>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <p>"Tampilan web-nya gemesin banget, pas banget sama selera anak muda dan gak ngebosenin pas dibuka di HP."</p>
                            <div class="testi-author">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100" alt="">
                                <div>
                                    <h5>Dimas Anggara</h5>
                                    <small>Angkatan 2020 • Content Creator</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding" id="artikel">
                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span class="badge-tag">Bacaan Seru</span>
                        <h2>Artikel & <span class="highlight">Kabar Almamater</span></h2>
                        <p>Update info terkini seputar sekolah dan tips dunia kerja.</p>
                    </div>
                    <div class="grid-3 mt-5">
                        <div class="article-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="article-img">
                                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=500" alt="">
                                <span class="article-tag">Sekolah</span>
                            </div>
                            <div class="article-body">
                                <small><i class="fa-regular fa-calendar"></i> 28 Agustus 2026</small>
                                <h4>Peresmian Gedung Baru Lab Komputer Hasil Donasi Alumni</h4>
                                <p>Fasilitas makin canggih buat adik-adik kelas belajar coding dan AI di sekolah.</p>
                                <a href="#" class="read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="article-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="article-img">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=500" alt="">
                                <span class="article-tag">Karier</span>
                            </div>
                            <div class="article-body">
                                <small><i class="fa-regular fa-calendar"></i> 25 Agustus 2026</small>
                                <h4>Tips Lolos Interview Kerja di Perusahaan Unicorn ala Kakak Alumni</h4>
                                <p>Bongkar rahasia HRD saat menyaring CV fresh graduate berpengalaman organisasi.</p>
                                <a href="#" class="read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="article-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="article-img">
                                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500" alt="">
                                <span class="article-tag">Reuni</span>
                            </div>
                            <div class="article-body">
                                <small><i class="fa-regular fa-calendar"></i> 20 Agustus 2026</small>
                                <h4>Persiapan Grand Reunion 2027: Bakal Ada Artis Tamu Spesial!</h4>
                                <p>Panitia angkatan 2010 siap mengguncang stadion utama dengan konsep festival musik.</p>
                                <a href="#" class="read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


        <div id="homeView" class="view-section">

            <section class="user-welcome-banner">
                <div class="container">
                    <div class="welcome-banner-content" data-aos="fade-down">
                        <div class="welcome-text">
                            <span class="badge-tag">✨ Status: Terverifikasi Alumni</span>
                            <h1>Hai, Kanya Salsabila! 👋</h1>
                            <p>Selamat datang kembali di dashboard utama. Cek lowongan kerja terbaru atau sapa teman seangkatanmu hari ini!</p>
                        </div>
                        <div class="welcome-quick-stats">
                            <div class="quick-pill"><i class="fa-solid fa-fire text-orange"></i> <strong>12</strong> Pesan Baru</div>
                            <div class="quick-pill"><i class="fa-solid fa-bell text-yellow"></i> <strong>3</strong> Event Mendatang</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding" id="lowongan">
                <div class="container">
                    <div class="section-header-flex">
                        <div>
                            <span class="badge-tag">Peluang Karir</span>
                            <h2>Bursa Lowongan & <span class="highlight">Magang</span></h2>
                        </div>
                        <button class="btn-primary-glow" id="postJobModalBtn"><i class="fa-solid fa-plus"></i> Pasang Loker</button>
                    </div>

                    <div class="lowongan-layout mt-4">
                        <div class="filter-sidebar" data-aos="fade-right">
                            <div class="filter-box">
                                <h3>Cari Posisi</h3>
                                <div class="search-input-group">
                                    <i class="fa-solid fa-search"></i>
                                    <input type="text" id="jobSearchInput" placeholder="Ketik skill / judul...">
                                </div>
                            </div>
                            <div class="filter-box mt-4">
                                <h3>Kategori Loker</h3>
                                <div class="filter-categories" id="jobCategories">
                                    <button class="filter-btn active" data-filter="all">Semua Loker (10)</button>
                                    <button class="filter-btn" data-filter="Full-Time">Full-Time</button>
                                    <button class="filter-btn" data-filter="Remote">Remote / WFH</button>
                                    <button class="filter-btn" data-filter="Freelance">Freelance / Project</button>
                                    <button class="filter-btn" data-filter="Magang">Magang / Internship</button>
                                </div>
                            </div>
                        </div>

                        <div class="job-cards-grid" id="jobCardsContainer">
                            <div class="job-card-item" data-category="Full-Time" data-aos="fade-up" data-aos-delay="100">
                                <div class="job-card-header">
                                    <div class="company-badge-icon">DM</div>
                                    <div>
                                        <h4>Digital Marketing Specialist</h4>
                                        <p>Nusantara Media • (Kak Bayu, 2016)</p>
                                    </div>
                                    <span class="badge-label tag-lead">Tech Lead</span>
                                </div>
                                <div class="job-tags">
                                    <span class="tag-pill">Full-Time</span>
                                    <span class="tag-pill">Remote</span>
                                    <span class="tag-pill">Ads & Analytics</span>
                                </div>
                                <p class="job-desc">Mau ngebantu brand lokal milik alumni melesat tinggi lewat strategi iklan digital dan analisis data yang ciamik? Posisi ini pas banget buat kamu yang hobi eksperimen campaign dan baca tren market terkini!</p>
                                <div class="job-footer">
                                    <div>
                                        <small>Estimasi Gaji:</small>
                                        <strong>Rp 6.0M - 8.5M / bln</strong>
                                    </div>
                                    <button class="btn-lamar" onclick="alert('Lamaran terkirim ke Kak Bayu!')">Lamar Sekarang</button>
                                </div>
                            </div>

                            <div class="job-card-item" data-category="Magang" data-aos="fade-up" data-aos-delay="200">
                                <div class="job-card-header">
                                    <div class="company-badge-icon bg-pink-light text-pink">GI</div>
                                    <div>
                                        <h4>Graphic Design Intern</h4>
                                        <p>Matchora Studio • (Kak Dewi, 2020)</p>
                                    </div>
                                </div>
                                <div class="job-tags">
                                    <span class="tag-pill">Magang</span>
                                    <span class="tag-pill">Hybrid</span>
                                    <span class="tag-pill">Illustrator</span>
                                </div>
                                <p class="job-desc">Buat adik-adik tingkat atau fresh graduate yang mau nyari pengalaman nyata di industri kreatif, yuk magang bareng kita! Bakalan dibimbing langsung cara bikin visual brand produk makanan dan minuman yang gemesin.</p>
                                <div class="job-footer">
                                    <div>
                                        <small>Insentif:</small>
                                        <strong>Rp 2.0M - 3.0M / bln</strong>
                                    </div>
                                    <button class="btn-lamar btn-daftar" onclick="alert('Pendaftaran magang berhasil dikirim!')">Daftar</button>
                                </div>
                            </div>

                            <div class="job-card-item" data-category="Full-Time" data-aos="fade-up" data-aos-delay="300">
                                <div class="job-card-header">
                                    <div class="company-badge-icon bg-blue-light text-blue">SF</div>
                                    <div>
                                        <h4>Senior Fullstack Engineer</h4>
                                        <p>Sinergi Teknologi • (Kak Fajar, 2015)</p>
                                    </div>
                                    <span class="badge-label tag-lead">Tech Lead</span>
                                </div>
                                <div class="job-tags">
                                    <span class="tag-pill">Full-Time</span>
                                    <span class="tag-pill">Remote</span>
                                    <span class="tag-pill">Laravel & Vue</span>
                                </div>
                                <p class="job-desc">Punya pengalaman matang di framework Laravel dan terbiasa merancang arsitektur sistem skala besar? Senior kita lagi bangun tim impian dan butuh tangan kanan handal buat nakhodain project-project skala nasional!</p>
                                <div class="job-footer">
                                    <div>
                                        <small>Estimasi Gaji:</small>
                                        <strong>Rp 10M - 14M / bln</strong>
                                    </div>
                                    <button class="btn-lamar" onclick="alert('CV Anda telah diteruskan ke Kak Fajar!')">Ambil</button>
                                </div>
                            </div>

                            <div class="job-card-item" data-category="Freelance" data-aos="fade-up" data-aos-delay="400">
                                <div class="job-card-header">
                                    <div class="company-badge-icon bg-yellow-light text-yellow">PH</div>
                                    <div>
                                        <h4>Podcast Host & Copywriter</h4>
                                        <p>Ngobrol Bareng Alumni • (Tim Media)</p>
                                    </div>
                                    <span class="badge-label tag-kreatif">Kreatif & Seru</span>
                                </div>
                                <div class="job-tags">
                                    <span class="tag-pill">Freelance</span>
                                    <span class="tag-pill">Studio Jakarta</span>
                                    <span class="tag-pill">Public Speaking</span>
                                </div>
                                <p class="job-desc">Pede ngomong di depan kamera/mikrofon, punya suara renyah, dan hobi ngulik cerita unik dari para alumni sukses? Gabung jadi host program bincang-bincang santai kita yuk! Pastinya seru dan nambah relasi luas.</p>
                                <div class="job-footer">
                                    <div>
                                        <small>Sistem Bayar:</small>
                                        <strong>Per Episode</strong>
                                    </div>
                                    <button class="btn-lamar btn-demo" onclick="alert('Silakan upload link demo suara Anda.')">Kirim Demo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding bg-light-tint" id="alumni">
                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span class="badge-tag">Direktori Almamater</span>
                        <h2>Temukan <span class="highlight">Teman Sekelasmu</span></h2>
                        <p>Cari berdasarkan angkatan, kota domisili, atau profesi saat ini.</p>
                    </div>

                    <div class="alumni-search-bar mt-4" data-aos="fade-up">
                        <input type="text" id="alumniSearch" placeholder="Cari nama alumni, angkatan (misal: 2017), atau profesi...">
                        <select id="generationFilter">
                            <option value="">Semua Angkatan</option>
                            <option value="2022">Angkatan 2022</option>
                            <option value="2020">Angkatan 2020</option>
                            <option value="2018">Angkatan 2018</option>
                            <option value="2015">Angkatan 2015</option>
                            <option value="2010">Angkatan 2010</option>
                        </select>
                        <button class="btn-primary-glow" id="searchAlumniBtn"><i class="fa-solid fa-search"></i> Cari</button>
                    </div>

                    <div class="grid-4 mt-5" id="alumniGrid">
                        <div class="alumni-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="alumni-avatar-wrap">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300" alt="">
                                <span class="status-dot online"></span>
                            </div>
                            <h4>Kanya Salsabila</h4>
                            <p class="alumni-role">UI/UX Lead Designer</p>
                            <span class="badge-angkatan">Angkatan 2019</span>
                            <div class="alumni-socials">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                            <button class="btn-chat-alumni" onclick="alert('Membuka ruang obrolan dengan Kanya!')"><i class="fa-solid fa-comment-dots"></i> Sapa</button>
                        </div>

                        <div class="alumni-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="alumni-avatar-wrap">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300" alt="">
                                <span class="status-dot online"></span>
                            </div>
                            <h4>Rangga Pratama</h4>
                            <p class="alumni-role">Software Engineer</p>
                            <span class="badge-angkatan">Angkatan 2015</span>
                            <div class="alumni-socials">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-brands fa-github"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                            <button class="btn-chat-alumni" onclick="alert('Membuka ruang obrolan dengan Rangga!')"><i class="fa-solid fa-comment-dots"></i> Sapa</button>
                        </div>

                        <div class="alumni-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="alumni-avatar-wrap">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300" alt="">
                                <span class="status-dot offline"></span>
                            </div>
                            <h4>Nabila Zahra</h4>
                            <p class="alumni-role">Product Manager</p>
                            <span class="badge-angkatan">Angkatan 2018</span>
                            <div class="alumni-socials">
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                            <button class="btn-chat-alumni" onclick="alert('Membuka ruang obrolan dengan Nabila!')"><i class="fa-solid fa-comment-dots"></i> Sapa</button>
                        </div>

                        <div class="alumni-card" data-aos="fade-up" data-aos-delay="400">
                            <div class="alumni-avatar-wrap">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300" alt="">
                                <span class="status-dot online"></span>
                            </div>
                            <h4>Dimas Anggara</h4>
                            <p class="alumni-role">Content Creator & Founder</p>
                            <span class="badge-angkatan">Angkatan 2020</span>
                            <div class="alumni-socials">
                                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-solid fa-envelope"></i></a>
                            </div>
                            <button class="btn-chat-alumni" onclick="alert('Membuka ruang obrolan dengan Dimas!')"><i class="fa-solid fa-comment-dots"></i> Sapa</button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding" id="event">
                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span class="badge-tag">Agenda Mendatang</span>
                        <h2>Event & <span class="highlight">Gathering Alumni</span></h2>
                        <p>Catat tanggalnya dan jangan sampai ketinggalan keseruannya!</p>
                    </div>

                    <div class="grid-3 mt-5">
                        <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="event-date-badge">
                                <span class="date-num">15</span>
                                <span class="date-month">SEP 2026</span>
                            </div>
                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=500" alt="Event">
                            <div class="event-body">
                                <span class="badge-tag">Webinar Karir</span>
                                <h4>Ngobrol Santai: Menembus Karir Tech Global Tanpa Harus Kuliah IT</h4>
                                <p><i class="fa-regular fa-clock"></i> 19:30 - 21:00 WIB via Zoom</p>
                                <button class="btn-primary-glow w-100 mt-3" onclick="alert('Anda berhasil terdaftar di event ini!')">Ikuti Event</button>
                            </div>
                        </div>

                        <div class="event-card" data-aos="fade-up" data-aos-delay="200">
                            <div class="event-date-badge">
                                <span class="date-num">28</span>
                                <span class="date-month">SEP 2026</span>
                            </div>
                            <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=500" alt="Event">
                            <div class="event-body">
                                <span class="badge-tag">Gathering Offline</span>
                                <h4>Mini Reunion & Futsal Cup Antar Angkatan 2015-2020</h4>
                                <p><i class="fa-regular fa-location-dot"></i> Lapangan Pancoran Soccer Field</p>
                                <button class="btn-primary-glow w-100 mt-3" onclick="alert('Tiket kehadiran berhasil dipesan!')">Amankan Tiket</button>
                            </div>
                        </div>

                        <div class="event-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="event-date-badge">
                                <span class="date-num">10</span>
                                <span class="date-month">OKT 2026</span>
                            </div>
                            <img src="https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=500" alt="Event">
                            <div class="event-body">
                                <span class="badge-tag">Workshop</span>
                                <h4>Mastering Personal Branding di LinkedIn & IG untuk Profesional</h4>
                                <p><i class="fa-regular fa-clock"></i> 13:00 - 16:00 WIB • Co-working Space Jaksel</p>
                                <button class="btn-primary-glow w-100 mt-3" onclick="alert('Pendaftaran workshop dikonfirmasi!')">Daftar Slot</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-padding bg-light-tint" id="album">
                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span class="badge-tag">Arsip Nostalgia</span>
                        <h2>Album <span class="highlight">Kenangan SMA</span></h2>
                        <p>Kumpulan foto jadok (jaman dulu) sewaktu kita masih seragam putih abu-abu.</p>
                    </div>

                    <div class="album-grid mt-5">
                        <div class="album-item" data-aos="zoom-in" data-aos-delay="100">
                            <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=500" alt="Album">
                            <div class="album-caption">
                                <h5>Upacara Bendera Senin Pagi</h5>
                                <p>Angkatan 2018</p>
                            </div>
                        </div>
                        <div class="album-item" data-aos="zoom-in" data-aos-delay="200">
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=500" alt="Album">
                            <div class="album-caption">
                                <h5>Suasana Belajar di Kelas XII IPA 2</h5>
                                <p>Angkatan 2019</p>
                            </div>
                        </div>
                        <div class="album-item" data-aos="zoom-in" data-aos-delay="300">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=500" alt="Album">
                            <div class="album-caption">
                                <h5>Pensi Sekolah (Pentas Seni Akhir Tahun)</h5>
                                <p>Semua Angkatan</p>
                            </div>
                        </div>
                        <div class="album-item" data-aos="zoom-in" data-aos-delay="400">
                            <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=500" alt="Album">
                            <div class="album-caption">
                                <h5>Perpisahan & Lempar Toga</h5>
                                <p>Angkatan 2017</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </main>

    <footer class="footer-section">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="logo-brand">
                        <div class="logo-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <span class="brand-name text-white">Jejak<span class="highlight">Keluarga</span></span>
                    </div>
                    <p>Platform jejaring alumni SMA Ceria paling hits, interaktif, dan penuh warna. Menghubungkan ribuan cerita dalam satu genggaman.</p>
                    <div class="social-links-footer">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Navigasi Cepat</h4>
                    <ul>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#angka">Statistik</a></li>
                        <li><a href="#galeri">Galeri Momen</a></li>
                        <li><a href="#artikel">Artikel Almamater</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Fitur Eksklusif</h4>
                    <ul>
                        <li><a href="#lowongan">Bursa Lowongan Kerja</a></li>
                        <li><a href="#alumni">Direktori Angkatan</a></li>
                        <li><a href="#event">Agenda & Gathering</a></li>
                        <li><a href="#album">Album Kenangan Jadul</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Kontak & Sekretariat</h4>
                    <p><i class="fa-solid fa-location-dot"></i> Jl. Pendidikan Ceria No. 45, Jakarta Selatan</p>
                    <p><i class="fa-solid fa-envelope"></i> halo@jejakkeluarga.alumni.id</p>
                    <p><i class="fa-solid fa-phone"></i> +62 812-3456-7890</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 JejakKeluarga Alumni SMA Ceria. Dibuat dengan penuh cinta & semangat Gen-Z 🚀</p>
            </div>
        </div>
    </footer>

    <div class="modal-overlay" id="loginModal">
        <div class="modal-card" data-aos="zoom-in">
            <button class="modal-close" id="closeModalBtn"><i class="fa-solid fa-xmark"></i></button>
            <div class="text-center mb-4">
                <div class="logo-icon mx-auto mb-2"><i class="fa-solid fa-graduation-cap"></i></div>
                <h3>Masuk Portal Alumni</h3>
                <p>Masukkan akun email almamater atau akun terdaftar kamu.</p>
            </div>
            <form id="loginForm">
                <div class="form-group mb-3">
                    <label>Email / Nomor Anggota</label>
                    <input type="email" id="loginEmail" class="form-control-custom" value="kanya.salsabila@alumni.id" required>
                </div>
                <div class="form-group mb-4">
                    <label>Kata Sandi</label>
                    <input type="password" id="loginPassword" class="form-control-custom" value="password123" required>
                </div>
                <button type="submit" class="btn-primary-glow w-100 py-3">Masuk Sekarang 🚀</button>
            </form>
            <div class="text-center mt-3">
                <small class="text-muted">Simulasi: Cukup klik tombol di atas untuk langsung masuk ke mode Home!</small>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
