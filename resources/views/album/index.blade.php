
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMNIHUB - Album Memories</title>
   <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.html" class="brand-logo">
                ALUMNI<span>HUB</span>
            </a>
            <ul class="nav-menu">
                <li><a href="#" class="nav-sticker active">Beranda</a></li>
                <li><a href="#" class="nav-sticker">Lowongan</a></li>
                <li><a href="#" class="nav-sticker">Alumni</a></li>
                <li><a href="#" class="nav-sticker">Event</a></li>
                <li><a href="#" class="nav-sticker">Album</a></li>
            </ul>
        </div>
    </nav>

    <!-- SECTION 1: HERO & POLAROID SHOWCASE -->
    <section class="hero-section">
        <div class="hero-container">
            <!-- Left Side: Retro Ornaments -->
            <div class="ornament-col">
                <div class="sticker-text-3d">MEMORIES</div>
                
                <div class="floating-wrapper">
                    <div class="polaroid-camera float-item">
                        <div class="camera-lens"></div>
                        <div class="flash-btn"></div>
                        <div class="rainbow-stripe"></div>
                    </div>
                    
                    <div class="film-strip float-item-delay-1">
                        <div class="film-hole"></div>
                        <div class="film-frame"><img src="https://picsum.photos/seed/mem1/150/150" alt="Memory"></div>
                        <div class="film-frame"><img src="https://picsum.photos/seed/mem2/150/150" alt="Memory"></div>
                        <div class="film-frame"><img src="https://picsum.photos/seed/mem3/150/150" alt="Memory"></div>
                        <div class="film-hole"></div>
                    </div>

                    <div class="cassette-tape float-item-delay-2">
                        <div class="cassette-wheels"><span></span><span></span></div>
                        <div class="cassette-label">CLASS 2024</div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Interactive Hero Album Frame -->
            <div class="album-frame-col">
                <div class="striped-frame">
                    <div class="tape-element tape-top-left"></div>
                    <div class="tape-element tape-top-right"></div>
                    <div class="frame-content">
                        <div class="explorer-header">
                            <h2><i class="fa-solid fa-folder-open"></i> ALBUM EXPLORER 2024</h2>
                            <span class="badge-tag">8 Folders</span>
                        </div>
                        <div class="folder-grid">
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Wisuda & Lulus</span>
                            </div>
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Batik Day</span>
                            </div>
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Study Tour</span>
                            </div>
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Kegiatan Kelas</span>
                            </div>
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Momen Lucu</span>
                            </div>
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Project Fest</span>
                            </div>
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Kantin Time</span>
                            </div>
                            <div class="folder-card">
                                <i class="fa-solid fa-folder"></i>
                                <span>Behind Scene</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: SCRAPBOOK ALUMNI CARDS -->
    <section class="alumni-section">
        <div class="section-title">
            <h2>Kumpulan Alumni <span>Angkatan 2024</span></h2>
            <p>Klik kartu alumni untuk melihat biodata & album kenangan pribadi!</p>
        </div>

        <div class="alumni-grid">
            <!-- Alumni Card 1 -->
            <a href="detail.html" class="alumni-card tilt-left">
                <div class="card-tape"></div>
                <div class="photo-frame">
                    <img src="https://picsum.photos/seed/alumni1/300/300" alt="Adinda Putri">
                    <span class="pin-badge">📌</span>
                </div>
                <div class="alumni-info">
                    <h3>Adinda Putri</h3>
                    <span class="sub-text">Rekayasa Perangkat Lunak</span>
                    <p class="quote">"Tetap senyum meskipun revisi melanda setiap hari!"</p>
                    <div class="card-footer-tags">
                        <span class="tag">@dindaptr</span>
                        <span class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
            </a>

            <!-- Alumni Card 2 -->
            <a href="detail.html" class="alumni-card tilt-right">
                <div class="card-tape"></div>
                <div class="photo-frame">
                    <img src="https://picsum.photos/seed/alumni2/300/300" alt="Bagas Prayoga">
                    <span class="pin-badge">⭐</span>
                </div>
                <div class="alumni-info">
                    <h3>Bagas Prayoga</h3>
                    <span class="sub-text">Teknik Komputer Jaringan</span>
                    <p class="quote">"Bisa tidur 8 jam sehari adalah keajaiban dunia ke-8."</p>
                    <div class="card-footer-tags">
                        <span class="tag">@bagaspr</span>
                        <span class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
            </a>

            <!-- Alumni Card 3 -->
            <a href="detail.html" class="alumni-card tilt-left">
                <div class="card-tape"></div>
                <div class="photo-frame">
                    <img src="https://picsum.photos/seed/alumni3/300/300" alt="Citra Kirana">
                    <span class="pin-badge">🏷️</span>
                </div>
                <div class="alumni-info">
                    <h3>Citra Kirana</h3>
                    <span class="sub-text">Multimedia & Desain</span>
                    <p class="quote">"Render video jam 3 pagi, senggol dong!"</p>
                    <div class="card-footer-tags">
                        <span class="tag">@citra.krn</span>
                        <span class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
            </a>

            <!-- Alumni Card 4 -->
            <a href="detail.html" class="alumni-card tilt-right">
                <div class="card-tape"></div>
                <div class="photo-frame">
                    <img src="https://picsum.photos/seed/alumni4/300/300" alt="Dika Pratama">
                    <span class="pin-badge">📌</span>
                </div>
                <div class="alumni-info">
                    <h3>Dika Pratama</h3>
                    <span class="sub-text">Sistem Informasi</span>
                    <p class="quote">"Kalo kodenya error, coba restart laptopnya dulu."</p>
                    <div class="card-footer-tags">
                        <span class="tag">@dika_prt</span>
                        <span class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- FOOTER (SQUARE & SOLID) -->
    <footer class="footer-square">
        <div class="footer-container">
            <div class="footer-brand">
                <h3>ALUMNIHUB 2024</h3>
                <p>Ruang Kumpul & Album Kenangan Abadi Angkatan 2024.</p>
            </div>
            
            <div class="footer-search">
                <div class="search-box">
                    <input type="text" placeholder="Cari nama alumni atau jurusan...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>

            <div class="footer-links">
                <a href="#">Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Kontak Kami</a>
            </div>

            <div class="footer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 AlumniHub. Created with ❤️ for Alumni Memories.</p>
        </div>
    </footer>

</body>
</html>