/* =========================================================
   IKA ALUMNI — Theme 2: "Sticker Comic" outline style
   ========================================================= */

:root {
  --buttercup: #fff2b2;
  --sunwashed: #ffe08a;
  --cloudpuff: #fff7d6;
  --dewyblue: #a8c6e7;
  --morning: #7fa8d6;

  --ink: #1e2c4f;
  --ink-soft: #48567a;
  --white: #ffffff;

  --radius-lg: 28px;
  --radius-md: 18px;
  --radius-sm: 12px;

  --border-w: 2.5px;
  --pop: 6px;

  --font-display: "Baloo 2", system-ui, sans-serif;
  --font-body: "Nunito", system-ui, sans-serif;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}
html {
  scroll-behavior: smooth;
}
body {
  margin: 0;
  font-family: var(--font-body);
  color: var(--ink-soft);
  background: var(--dewyblue);
  overflow-x: hidden;
}
h1,
h2,
h3 {
  font-family: var(--font-display);
  color: var(--ink);
  margin: 0 0 0.5em;
  line-height: 1.18;
}
p {
  margin: 0 0 1em;
}
a {
  text-decoration: none;
  color: inherit;
}
img {
  max-width: 100%;
  display: block;
}

a:focus-visible,
button:focus-visible {
  outline: 3px solid var(--morning);
  outline-offset: 3px;
  border-radius: 6px;
}

@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}

.card-pop {
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-md);
  box-shadow: var(--pop) var(--pop) 0 var(--ink);
  background: var(--white);
}

.btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 13px 24px;
  border-radius: 999px;
  font-family: var(--font-display);
  font-weight: 600;
  font-size: 0.98rem;
  border: var(--border-w) solid var(--ink);
  cursor: pointer;
  white-space: nowrap;

  /* Langsung punya bayangan tebal ala komik dari awal */
  box-shadow: 4px 4px 0 var(--ink) !important;
  transform: translate(0, 0);

  /* Transisi halus khusus untuk pergerakan naik */
  transition:
    transform 0.15s ease,
    box-shadow 0.15s ease !important;
}
/* ==========================================
   ANIMASI KETIKA KURSOR DIARAHKAN (HOVER)
   Hanya bergeser naik ke atas-kiri sedikit
========================================== */
.btn:hover {
  transform: translate(-2px, -2px) !important;
  box-shadow: 6px 6px 0 var(--ink) !important;
}

/* Efek saat tombol diklik (menekan ke bawah) */
.btn:active {
  transform: translate(2px, 2px) !important;
  box-shadow: 2px 2px 0 var(--ink) !important;
}
/* Tombol Pertama (Fill) */
.btn-fill {
  background: #749abc;
  color: #f9fbff;
  min-width: 200px;
  padding: 8px 16px 8px 22px;
  line-height: 1.2;
  font-size: 15px;
  display: inline-block;
  text-align: right !important;
  text-shadow:
    0 0 8px rgba(56, 56, 53, 0.7),
    0 0 15px rgba(255, 255, 255, 0.4) !important;
}

/* Target teks Tombol Pertama agar ikut naik ke atas */
.btn-fill a,
.btn-fill span {
  position: relative;
  display: inline-block;
  top: -2px;
  left: 6px;
}

/* Tombol Kedua (Outline) */
.btn-outline {
  background: var(--white);
  color: #022d6c;
  min-width: 200px;
  padding: 8px 16px 8px 16px;
  line-height: 1.2; /* Ditambahkan line-height biar sejajar */
  font-size: 16px;
  display: inline-block;
  text-align: right !important;
  text-shadow:
    0 0 8px rgba(0, 0, 0, 0.7),
    0 0 15px rgba(255, 255, 255, 0.4) !important;
}

/* Target teks Tombol Kedua supaya bisa digeser ke atas */
.btn-outline a,
.btn-outline span {
  position: relative;
  display: inline-block;
  top: -2px; /* Ubah angka minus ini kalau mau lebih naik/turun */
}

.navbar {
  position: absolute; /* Mengubah posisi jadi absolute supaya melayang di atas hero */
  top: 0;
  left: 0;
  width: 100%;
  z-index: 50;
  background: transparent !important;
  border-bottom: none;
  transition: all 0.3s ease;
}

/* Saat di-scroll, navbar berubah jadi fixed/sticky di atas dengan warna putih */
.navbar.scrolled {
  position: fixed;
  background: var(--white) !important;
  border-bottom: var(--border-w) solid var(--ink);
  box-shadow: 0 4px 0 rgba(30, 44, 79, 0.12);
}

.nav-inner {
  max-width: 1180px;
  margin: 0 auto;
  padding: 14px 24px;
  display: flex;
  align-items: center;
  gap: 22px;
}
.logo {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 1.2rem;
  color: var(--ink);
  margin-right: auto;
}
.logo-icon {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--sunwashed);
  border: var(--border-w) solid var(--ink);
  border-radius: 50%;
  font-size: 1.05rem;
}
.nav-links {
  display: flex;
  align-items: center;
  gap: 26px;
}
.nav-links a {
  font-family: var(--font-display);
  font-weight: 600;
  font-size: 0.95rem;
  color: var(--ink);
  position: relative;
}
.nav-links a::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -6px;
  width: 0;
  height: 3px;
  background: var(--morning);
  border-radius: 3px;
  transition: width 0.2s ease;
}
.nav-links a:hover::after {
  width: 100%;
}
.nav-cta {
  padding: 10px 22px;
  font-size: 0.9rem;
}

.burger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 6px;
}
.burger span {
  width: 24px;
  height: 3px;
  border-radius: 3px;
  background: var(--ink);
  transition:
    transform 0.2s ease,
    opacity 0.2s ease;
}

.pill-badge {
  display: inline-flex;
  margin-top: 50px;
  align-items: center;
  gap: 4px;

  /* 1. Ganti warna isian (background) di sini */
  background: #dfca75 !important;

  /* 2. Garis tepi/border dihilangkan (ganti jadi none) */
  border: none !important;

  /* (Opsional) Tambah bayangan halus jika mau */
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06) !important;

  border-radius: 999px;
  padding: 8px 18px;
  font-family: var(--font-display);
  font-weight: 600;
  font-size: 0.85rem;

  /* 3. Ganti warna teks di sini */
  color: #cf423e !important;
  /* EFEK BERSINAR HITAM TIPIS & HALUS */
  text-shadow: 0 0 3px rgba(0, 0, 0, 0.3) !important;

  margin-bottom: 18px;
}

.hero {
  position: relative;
  background: linear-gradient(
    180deg,
    #5f93bf 0%,
    #a5c6e4 45%,
    #e4e1b1 75%
  ) !important;
  /* Kunci tinggi agar pas memenuhi satu layar penuh */
  width: 100% !important;
  height: 100vh !important;
  min-height: 100vh !important;
  max-height: 100vh !important;

  padding-top: 10px !important;
  padding-bottom: 0px !important;
  margin-top: 0 !important;

  /* Sembunyikan sisa konten yang melebihi satu layar */
  overflow: hidden !important;
}

.hero-inner {
  max-width: 1180px;
  margin: 0 auto;
  margin-top: -80px !important;
  /* UBAH BAGIAN INI: Kurangi padding bawahnya agar konten dan banner bawahnya saling mendekat */
  padding: 5px 10px 0px !important;
  display: grid;
  grid-template-columns: 1.2fr 0.8fr !important;
  gap: 40px;
  align-items: center;
  position: relative;
  z-index: 2;
}

/* Hanya menaikkan isi/konten beranda saja ke atas, navbar aman di tempatnya */
.hero .container,
.hero-content,
.hero-container {
  margin-top: -20px !important; /* Sesuaikan jarak naiknya */
  padding-top: 0 !important;
}
.hero-title {
  font-family: "Luckiest Guy", cursive, sans-serif !important;
  font-size: clamp(2rem, 4vw, 3.1rem);
  font-weight: 700;
  letter-spacing: 2.3px !important; /* Menambahkan jarak antar huruf */
}
.hero-title .highlight {
  color: var(--morning);
}

.hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 6px;
}

.hero-visual {
  position: relative;
  min-height: 340px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.polaroid {
  width: min(380px, 100%);
  background: var(--white);
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-md);
  box-shadow: 10px 10px 0 var(--ink);
  padding: 14px 14px 20px;
  transform: rotate(2deg);
}
.polaroid-photo {
  aspect-ratio: 4/3.1;
  background: linear-gradient(135deg, var(--buttercup), var(--dewyblue));
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-sm);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 4.5rem;
}
.polaroid-caption {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-family: var(--font-display);
  font-weight: 700;
  color: var(--ink);
  padding-top: 12px;
}

.sticky-note {
  position: absolute;
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 0.82rem;
  color: var(--ink);
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-sm);
  padding: 10px 14px;
  box-shadow: 4px 4px 0 var(--ink);
  line-height: 1.3;
  z-index: 4; /* Supaya posisinya tampil di atas TV */
}

/* Stiker catatan atas (Temu Kangen) didekatkan ke sudut kanan atas TV */
.note-1 {
  top: 15px; /* Dibuat positif atau kecil agar turun mendekati TV */
  right: 10px; /* Ditarik masuk mendekati badan TV */
  background: var(--sunwashed);
  transform: rotate(-6deg);
}

/* Stiker catatan bawah (Info Loker & Bisnis) didekatkan ke sudut kiri bawah TV */
.note-2 {
  bottom: 15px; /* Dibuat naik mendekati badan TV */
  left: 10px; /* Ditarik masuk mendekati badan TV */
  background: var(--white);
  transform: rotate(4deg);
}
.deco {
  position: absolute;
  color: var(--ink);
  font-size: 1.6rem;
  opacity: 0.8;
  animation: twinkle 3s ease-in-out infinite;
}
.deco-star1 {
  top: 14%;
  left: 6%;
  font-size: 1.4rem;
}
.deco-flower {
  bottom: 10%;
  left: 3%;
  font-size: 1.8rem;
  color: var(--morning);
  animation-delay: 0.6s;
}
.deco-star2 {
  top: 30%;
  right: 4%;
  animation-delay: 1.1s;
}
@keyframes twinkle {
  0%,
  100% {
    transform: scale(1) rotate(0deg);
    opacity: 0.8;
  }
  50% {
    transform: scale(1.2) rotate(12deg);
    opacity: 1;
  }
}

.hero-wave {
  position: absolute !important;
  bottom: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 75px !important; /* Atur tinggi lengkungan gelombang */
  z-index: 4 !important;
  pointer-events: none !important;
}

.hero-wave path {
  fill: var(--cloudpuff) !important;
}

.about {
  padding: 70px 24px;
  background: var(--cloudpuff);
}
.about-inner {
  max-width: 1180px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  gap: 56px;
  align-items: center;
}
.about-visual {
  position: relative;
}
.framed-photo {
  aspect-ratio: 1.05/1;
  background: linear-gradient(150deg, var(--sunwashed), var(--dewyblue));
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-lg);
  box-shadow: 10px 10px 0 var(--ink);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 5rem;
}
.badge-float {
  position: absolute;
  bottom: -18px;
  right: -18px;
  background: var(--morning);
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-md);
  box-shadow: 6px 6px 0 var(--ink);
  padding: 14px 20px;
  text-align: center;
  color: var(--ink);
  font-family: var(--font-display);
}
.badge-float strong {
  display: block;
  font-size: 1.5rem;
}
.badge-float span {
  font-size: 0.7rem;
  letter-spacing: 0.5px;
}

.about-copy h2 {
  font-size: clamp(1.6rem, 3vw, 2.2rem);
}
.about-copy p {
  max-width: 520px;
}

.stats {
  background: var(--dewyblue);
  padding: 60px 0;
  border-top: var(--border-w) solid var(--ink);
  border-bottom: var(--border-w) solid var(--ink);
  overflow: hidden;
}
.stats-marquee {
  width: 100%;
  overflow: hidden;
  -webkit-mask-image: linear-gradient(
    90deg,
    transparent 0,
    #000 6%,
    #000 94%,
    transparent 100%
  );
  mask-image: linear-gradient(
    90deg,
    transparent 0,
    #000 6%,
    #000 94%,
    transparent 100%
  );
}
.stats-track {
  display: flex;
  gap: 24px;
  width: max-content;
  padding: 0 12px;
  animation: stats-scroll 26s linear infinite;
}
.stats-marquee:hover .stats-track {
  animation-play-state: paused;
}
@keyframes stats-scroll {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-50%);
  }
}
.stat-card {
  flex: 0 0 260px;
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-md);
  box-shadow: 5px 5px 0 var(--ink);
  padding: 28px 18px;
  text-align: center;
  transition: transform 0.18s ease;
}
.stat-card:hover {
  transform: translateY(-5px);
}
.tint-white {
  background: var(--white);
}
.tint-yellow {
  background: var(--buttercup);
}
.tint-blue {
  background: var(--morning);
}
.tint-gold {
  background: var(--sunwashed);
}
.stat-icon {
  font-size: 1.9rem;
  display: block;
  margin-bottom: 8px;
}
.stat-number {
  font-family: var(--font-display);
  font-size: 2rem;
  font-weight: 700;
  color: var(--ink);
}
.plus {
  font-family: var(--font-display);
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--ink);
}
.stat-card p {
  margin: 6px 0 0;
  font-weight: 700;
  color: var(--ink-soft);
  font-size: 0.9rem;
}

.section-head {
  max-width: 600px;
  margin: 0 auto 42px;
  text-align: center;
}
.section-head h2 {
  font-size: clamp(1.6rem, 3vw, 2.2rem);
}
.section-head p {
  color: var(--ink);
  font-weight: 600;
}

.gallery {
  padding: 80px 24px;
  text-align: center;
  background: var(--cloudpuff);
}
.gallery-grid {
  max-width: 1180px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 26px;
}
.gallery-card {
  text-align: left;
}
.gallery-thumb {
  aspect-ratio: 4/3;
  background: repeating-linear-gradient(
    45deg,
    var(--sunwashed),
    var(--sunwashed) 10px,
    var(--buttercup) 10px,
    var(--buttercup) 20px
  );
  border: var(--border-w) dashed var(--ink);
  border-radius: var(--radius-md);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 10px;
  box-shadow: 5px 5px 0 var(--ink);
}
.gallery-thumb span {
  font-size: 2.2rem;
}
.gallery-thumb small {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 0.7rem;
  letter-spacing: 0.5px;
  color: var(--ink);
  background: var(--white);
  padding: 4px 10px;
  border-radius: 999px;
  border: 1.5px solid var(--ink);
}
.gallery-caption {
  font-family: var(--font-display);
  font-weight: 700;
  color: var(--ink);
  margin: 14px 2px 0;
  font-size: 0.98rem;
}

.testimoni {
  padding: 40px 24px 90px;
  background: var(--dewyblue);
}
.testimoni-grid {
  max-width: 960px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 26px;
}
.testi-card {
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-md);
  box-shadow: 6px 6px 0 var(--ink);
  padding: 26px;
  margin: 0;
}
.testi-card.tint-yellow {
  background: var(--buttercup);
}
.testi-card.tint-blue {
  background: var(--morning);
}
.testi-card p {
  font-weight: 600;
  color: var(--ink);
  font-size: 0.98rem;
}
.testi-card footer {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-top: 16px;
}
.avatar {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: var(--white);
  border: var(--border-w) solid var(--ink);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-display);
  font-weight: 700;
  color: var(--ink);
  flex-shrink: 0;
}
.testi-card footer strong {
  display: block;
  font-family: var(--font-display);
  color: var(--ink);
  font-size: 0.92rem;
}
.testi-card footer small {
  color: var(--ink-soft);
  font-size: 0.8rem;
}

.blog {
  background: var(--cloudpuff);
  padding: 80px 24px;
  border-top: var(--border-w) solid var(--ink);
}
.blog-grid {
  max-width: 1180px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 26px;
}
.blog-card {
  background: var(--white);
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-md);
  box-shadow: 6px 6px 0 var(--ink);
  overflow: hidden;
  padding-bottom: 22px;
  transition: transform 0.18s ease;
}
.blog-card:hover {
  transform: translateY(-5px);
}
.blog-cover {
  aspect-ratio: 16/9;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.4rem;
  border-bottom: var(--border-w) solid var(--ink);
}
.cover-blue {
  background: var(--dewyblue);
}
.cover-orange {
  background: #ffb98a;
}
.blog-card .tag {
  display: inline-block;
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 0.7rem;
  letter-spacing: 0.5px;
  background: var(--cloudpuff);
  border: 1.5px solid var(--ink);
  border-radius: 999px;
  padding: 4px 12px;
  margin: 18px 22px 10px;
  color: var(--ink);
}
.blog-card h3 {
  font-size: 1.08rem;
  margin: 0 22px 10px;
}
.blog-card p {
  font-size: 0.88rem;
  margin: 0 22px 14px;
}
.read-more {
  display: inline-block;
  margin: 0 22px;
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 0.88rem;
  color: var(--ink);
}

.footer {
  background: var(--ink);
  padding: 50px 24px 26px;
}
.footer-inner {
  max-width: 1180px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap;
  padding-bottom: 28px;
  border-bottom: 1.5px solid rgba(255, 247, 214, 0.18);
}
.footer-brand {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
  max-width: 280px;
}
.footer-brand .logo-icon {
  background: var(--sunwashed);
}
.footer-brand .logo-text {
  font-family: var(--font-display);
  font-weight: 700;
  color: var(--cloudpuff);
}
.footer-brand p {
  width: 100%;
  color: var(--dewyblue);
  font-size: 0.85rem;
  margin-top: 6px;
}
.footer-links {
  display: flex;
  gap: 60px;
}
.footer-links h4 {
  color: var(--sunwashed);
  font-family: var(--font-display);
  font-size: 0.9rem;
  margin-bottom: 12px;
}
.footer-links a {
  display: block;
  color: var(--dewyblue);
  font-size: 0.88rem;
  margin-bottom: 8px;
}
.footer-links a:hover {
  color: var(--buttercup);
}
.footer-bottom {
  text-align: center;
  color: var(--dewyblue);
  font-size: 0.8rem;
  margin: 22px 0 0;
}

.reveal {
  opacity: 0;
  transform: translateY(22px);
  transition:
    opacity 0.55s ease,
    transform 0.55s ease;
}
.reveal.is-visible {
  opacity: 1;
  transform: none;
}

@media (max-width: 980px) {
  .hero-inner {
    grid-template-columns: 1fr;
    padding-bottom: 90px;
  }
  .hero-visual {
    order: -1;
    min-height: 300px;
  }
  .about-inner {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .about-copy p {
    margin-inline: auto;
  }
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .testimoni-grid {
    grid-template-columns: 1fr;
  }
  .blog-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 720px) {
  .nav-links,
  .nav-cta {
    display: none;
  }
  .navbar.is-open .nav-links {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    gap: 0;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--dewyblue);
    margin: 0;
    border-bottom: var(--border-w) solid var(--ink);
    padding: 10px 24px 16px;
  }
  .navbar.is-open .nav-links a {
    padding: 10px 0;
  }
  .navbar.is-open .nav-cta {
    display: flex;
    justify-content: center;
    position: absolute;
    top: calc(100% + 230px);
    left: 24px;
    right: 24px;
  }
  .burger {
    display: flex;
  }
  .navbar.is-open .burger span:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }
  .navbar.is-open .burger span:nth-child(2) {
    opacity: 0;
  }
  .navbar.is-open .burger span:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }

  .sticky-note {
    display: none;
  }
  .stat-card {
    flex-basis: 220px;
  }
  .gallery-grid {
    grid-template-columns: 1fr;
  }
}

/* Menyamakan warna teks atas dan tengah menjadi #f1edd2 */
.hero-title span.same-color {
  color: #f1edd2 !important;
}

/* Warna untuk teks bagian bawah */
.hero-title span.title-bottom {
  color: #405370 !important;
}

/* SISI KANAN (TV) */
.hero-visual {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  /* Ubah nilai 'right' atau 'top' di bawah ini jika ingin menggeser posisi TV secara keseluruhan */
  right: 20px; /* Geser ke kiri (tambah besar nilaipx-nya, atau ubah ke 'left: 20px;' untuk geser ke kanan) */
  bottom: 60px; /* Geser posisi ke atas/bawah */
}

.tv-wrapper {
  position: relative;
  width: 460px;
}

.img-tv-frame {
  width: 100%;
  position: relative;
  z-index: 3;
  pointer-events: none;
  filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.2));
}

/* Penempatan foto di dalam layar TV */
.tv-screen-content {
  position: absolute;
  top: 315px;
  left: 50px;
  width: 252px;
  height: 184px;
  overflow: hidden;
  z-index: 2;
  background-color: #000;
}

.tv-screen-content img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Menarik khusus teks sebelah kiri ke atas lebih tinggi lagi */
.hero-inner > div:first-child,
.hero-content {
  margin-top: -166px !important; /* Tambah penarikan khusus teks */
}

/* Memberikan gaya highlight kuning pada teks tertentu */
.hero-title .highlight {
  background: #f1edd2 !important; /* Warna kuning cerah */
  padding: 0 10px !important; /* Sedikit jarak/padding kiri-kanan agar kotak tidak terlalu mepet huruf */
  border-radius: 4px !important; /* Membuat sudut kotak sedikit melengkung */
  color: #405370 !important; /* Memastikan warna teks di dalam highlight tetap warna biru tua */
}

/* Kotak Banner Utama */
.hero-ticker-banner {
  width: 150vw !important;
  position: relative !important;
  left: 50% !important;
  right: 50% !important;
  margin-left: -50vw !important;
  margin-right: -50vw !important;

  margin-top: -525px !important;

  background-color: #667a94 !important;
  padding: 12px 0 !important;
  z-index: 3 !important;

  border-top: 3px dashed #f7e600 !important;
  border-bottom: 3px dashed #f7e600 !important;

  transform: rotate(-1deg) !important;
  transform-origin: center center !important;

  overflow: hidden !important;
  white-space: nowrap !important;
}

/* Jalur pembungkus yang membuat teks berputar terus */
.ticker-track {
  display: inline-block !important;
  white-space: nowrap !important;
  /* Kita gunakan teknik min-content agar jalur teksnya membaca lebar isi aslinya */
  width: max-content !important;
  animation: putarTerus 18s linear infinite !important;
}

/* Styling Teks di dalam Banner */
.ticker-track span {
  display: inline-block !important;
  color: #fffef5 !important;
  font-family: var(--font-display, sans-serif) !important;
  font-size: 0.95rem !important;
  font-weight: 500 !important;
  letter-spacing: 0.5px !important;

  text-shadow:
    0 0 8px rgba(56, 56, 53, 0.7),
    0 0 15px rgba(255, 255, 255, 0.4) !important;
}

/* Animasi putar persis 50% supaya sambungannya mulus tanpa jeda kosong */
@keyframes putarTerus {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

/* Saat navbar berada di posisi paling atas (transparan/putih) */
.navbar.navbar-transparent .nav-links a,
.navbar.navbar-transparent .logo .logo-text,
.navbar.navbar-transparent .logo .logo-icon {
  color: #ffffff !important;
}

.navbar.navbar-transparent .burger span {
  background-color: #ffffff !important;
}

.navbar.navbar-transparent .btn-outline {
  color: #ffffff !important;
  border-color: #ffffff !important;
}

/* ==========================================
   MENAIKKAN KONTEN TEKS SEBELAH KIRI
========================================== */
.hero-inner > div:first-child {
  transform: translateY(
    -15px
  ) !important; /* Ubah angka -40px jika ingin lebih ke atas lagi */
}

/* ==========================================
   PENGATURAN POSISI ASET KACA PEMBESAR
========================================== */
.magnifier-container {
  position: relative !important;
  display: inline-block !important;
  overflow: visible !important; /* Supaya gambar besar tidak terpotong */
}

.hero-magnifier {
  position: absolute !important;
  /* Atur ukuran besar kaca pembesar di sini */
  width: 430px !important;
  max-width: none !important; /* Mencegah ukuran dibatasi bawaan browser/parent */
  height: auto !important;

  /* Sesuaikan posisinya supaya pas menumpuk di tombol */
  left: -178px !important;
  bottom: -150px !important;

  z-index: 99 !important; /* Tarik paling atas agar tidak tertutup elemen lain */
  pointer-events: none !important;
  filter: drop-shadow(4px 6px 0px rgba(0, 0, 0, 0.8)) !important;
  transform: rotate(0.1deg) !important;
}

/* ==========================================
   GESER NAVBAR LEBIH KE TENGAH & BERJARAK
========================================== */
#navLinks {
  display: flex !important;
  gap: 40px !important; /* Memperlebar jarak antar menu (bisa diubah sesuai selera) */

  /* Menggeser posisi navbar ke arah tengah secara akurat */
  position: relative !important;
  right: 180px !important; /* Makin besar angka ini, posisi menu akan semakin bergeser ke tengah layar */
}

/* Styling menu yang aktif (Beranda) */
#navLinks a.active {
  color: #1e2c4f !important;
  font-weight: 700 !important;
  position: relative !important;
}

/* Garis bawah menu aktif */
#navLinks a.active::after {
  content: "" !important;
  position: absolute !important;
  left: 0 !important;
  bottom: -4px !important;
  width: 100% !important;
  height: 3px !important;
  background-color: #1e2c4f !important;
  border-radius: 2px !important;
}

/* ==========================================
   PENGATURAN POSISI & JARAK NAVBAR
========================================== */
#navLinks {
  display: flex !important;

  /* 1. Atur jarak antar teks menu (makin besar makin renggang) */
  gap: 55px !important;

  /* 2. Menggeser posisi navbar ke arah tengah */
  position: relative !important;
  right: 180px !important; /* Ubah angka ini jika ingin lebih ke tengah atau ke kanan */
}

/* Styling untuk menu yang sedang aktif (Beranda) */
#navLinks a.active {
  color: #1e2c4f !important;
  font-weight: 700 !important;
  position: relative !important;
}

/* Garis bawah pada menu aktif */
#navLinks a.active::after {
  content: "" !important;
  position: absolute !important;
  left: 0 !important;
  bottom: -4px !important;
  width: 100% !important;
  height: 3px !important;
  background-color: #1e2c4f !important;
  border-radius: 2px !important;
}
/* ==========================================
   CUSTOM BRANDING: ALUMNIHUB
========================================== */
.logo-brand {
  display: inline-flex !important;
  align-items: center !important;
  text-decoration: none !important;
  font-family: var(--font-display, sans-serif) !important;
  font-size: 1.4rem !important;
  font-weight: 800 !important;
  letter-spacing: 0.5px !important;
}

/* Warna untuk kata "ALUMNI" */
.logo-brand .text-alumni {
  color: #1e2c4f !important; /* Contoh: Biru tua */
}

/* Warna untuk kata "HUB" (bisa dibedakan warnanya, misal jadi oranye/kuning atau tetap kontras) */
.logo-brand .text-hub {
  color: #e67e22 !important; /* Contoh: Warna oranye cerah */
  margin-left: 2px;
}
/* ==========================================
   PENGATURAN NAVBAR & LOGO ALUMNIHUB
========================================== */

/* 1. Pembungkus dalam navbar agar posisinya sejajar kiri-kanan */
.navbar .nav-inner {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  width: 100% !important;
  max-width: 1200px !important;
  margin: 0 auto !important;
  padding: 0 20px !important;
}

/* 2. Styling Logo ALUMNIHUB */
.logo-brand {
  display: inline-flex !important;
  align-items: center !important;
  text-decoration: none !important;
  font-family: var(--font-display, sans-serif) !important;
  font-size: 1.4rem !important;
  font-weight: 800 !important;
}

.logo-brand .text-alumni {
  color: #ccd9d5 !important; /* Warna teks ALUMNI */
}

.logo-brand .text-hub {
  color: #f1edd2 !important; /* Warna teks HUB */
  margin-left: 2px;
}

/* 3. Pengaturan jarak dan posisi menu navigasi */
#navLinks {
  display: flex !important;
  gap: 45px !important; /* Jarak antar teks menu */
  align-items: center !important;
  margin-left: auto !important; /* Mendorong menu agar bergeser ke tengah/kanan */
  margin-right: 40px !important; /* Jarak dari sisi kanan */
}

/* Styling menu aktif (Beranda) */
#navLinks a {
  text-decoration: none !important;
  color: #555 !important;
  font-weight: 500;
}

#navLinks a.active {
  color: #1e2c4f !important;
  font-weight: 700 !important;
  position: relative !important;
}

/* Garis bawah pada menu aktif */
#navLinks a.active::after {
  content: "" !important;
  position: absolute !important;
  left: 0 !important;
  bottom: -4px !important;
  width: 100% !important;
  height: 3px !important;
  background-color: #1e2c4f !important;
  border-radius: 2px !important;
}

/* ==========================================
   TURUNKAN POSISI NAVBAR DENGAN PADDING
========================================== */
.navbar {
  padding-top: 20px !important; /* Menambah jarak dari atas layar */
  padding-bottom: 20px !important; /* Menambah jarak ke bawah */
}
/* ==========================================
   FINAL FIX: NAVBAR POSISI KANAN & WARNA MENU
========================================== */

/* Pastikan pembungkus navbar melebar penuh */
header.navbar .nav-inner {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  max-width: 100% !important;
  padding: 5px 30px !important;
}

/* Pindahkan seluruh menu ke sisi kanan dengan jarak luas */
header.navbar #navLinks {
  display: flex !important;
  gap: 60px !important; /* Jarak antar teks menu */
  align-items: center !important;
  margin-left: auto !important;
  margin-right: 0 !important;
  right: 0 !important;
  position: static !important;
}

/* Warna teks untuk menu biasa (Lowongan, Alumni, Event, Album) */
header.navbar #navLinks a {
  color: #f2f1eb !important;
  text-decoration: none !important;
  font-weight: 600 !important;
  font-size: 1rem !important;
}

/* Warna teks untuk menu Beranda yang aktif */
header.navbar #navLinks a.active {
  color: #1e2c4f !important;
  font-weight: 700 !important;
  position: relative !important;
}

/* Garis bawah pada menu Beranda */
header.navbar #navLinks a.active::after {
  content: "" !important;
  position: absolute !important;
  left: 0 !important;
  bottom: -4px !important;
  width: 100% !important;
  height: 3px !important;
  background-color: #1e2c4f !important;
  border-radius: 2px !important;
}
/* ==========================================
   FIX NAVBAR FIXED, TRANSPARAN DI ATAS, TEKS GELAP SAAT SCROLL
========================================== */

/* 1. Gunakan fixed agar navbar tetap menempel di atas saat di-scroll */
header.navbar {
  position: fixed !important;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  background-color: transparent !important; /* Tetap transparan di posisi paling atas */
  transition: all 0.3s ease-in-out !important;
}

/* Pastikan body tidak memiliki padding tambahan agar halaman Beranda tidak ada kotak putih */
body {
  padding-top: 0 !important;
}

/* 2. Saat halaman digulir (scrolled), teks menunya berubah jadi gelap */
header.navbar.scrolled #navLinks a {
  color: #2b2b2b !important; /* Warna teks jadi gelap saat di-scroll */
}

header.navbar.scrolled .logo-brand .text-alumni {
  color: #2b2b2b !important; /* Teks logo ALUMNI ikut gelap saat di-scroll */
}
/* ==========================================
   FIX EFEK HOVER GARIS BAWAH NAVBAR
========================================== */

#navLinks a {
  position: relative !important;
  text-decoration: none !important;
}

/* Garis bawah bawaan untuk hover dengan transisi yang bersih */
#navLinks a::after {
  content: "" !important;
  position: absolute !important;
  left: 0 !important;
  bottom: -4px !important;
  width: 0 !important; /* Mulai dari lebar 0 (tersembunyi) */
  height: 3px !important;
  background-color: #1e2c4f !important; /* Biru tua */
  border-radius: 2px !important;
  transition: width 0.3s ease-in-out !important; /* Efek mulus saat muncul/hilang */
}

/* Saat kursor diarahkan (hover), garisnya melebar jadi 100% */
#navLinks a:hover::after,
#navLinks a:focus::after {
  width: 100% !important;
}

/* Menu yang sedang aktif (Beranda) garisnya selalu penuh */
#navLinks a.active::after {
  width: 100% !important;
}
/* ==========================================
   CUSTOM BACKGROUND IMAGE (SESUAI UKURAN LAYAR)
========================================== */

/* Targetkan bagian pembungkus utama halaman atau section beranda kamu */
body,
.hero-section,
section#beranda {
  background-image: url("bghome.png") !important; /* Ganti dengan nama file foto kamu di folder project */
  background-size: cover !important; /* Menyesuaikan ukuran agar memenuhi layar penuh */
  background-position: center !important; /* Posisi foto pas di tengah */
  background-repeat: no-repeat !important; /* Tidak berulang/menumpuk */
  background-attachment: fixed !important; /* Tetap stabil saat discroll */
}

/* =========================================================
   AUDIO PLAYER - STICKER COMIC STYLE
   ========================================================= */
.hero-audio {
  position: relative;
  display: flex;
  align-items: center;
  gap: 12px;
  margin-top: 20px;
  margin-left: 165px;
  max-width: 250px;
  background: var(--white);
  border: var(--border-w) solid var(--ink);
  border-radius: var(--radius-md);
  padding: 10px 16px;
  box-shadow: 4px 4px 0 var(--ink);
  z-index: 10;
  cursor: pointer;
  transition:
    transform 0.15s ease,
    box-shadow 0.15s ease;
}
/* Animasi Angkat (Hover) */
.hero-audio:hover {
  transform: translate(-2px, -2px) !important;
  box-shadow: 6px 6px 0 var(--ink) !important;
}

.hero-audio:active {
  transform: translate(2px, 2px) !important;
  box-shadow: 2px 2px 0 var(--ink) !important;
}

/* Kalau di-pause, gelombangnya berhenti bergerak & meredup */
.hero-audio.is-paused .audio-bars span {
  animation-play-state: paused !important;
  height: 20% !important;
  opacity: 0.4 !important;
}

.audio-toggle {
  width: 40px;
  height: 40px;
  flex-shrink: 0;
  border-radius: 50%;
  border: var(--border-w) solid var(--ink);
  background: var(--buttercup);
  color: var(--ink);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 2px 2px 0 var(--ink);
  transition:
    transform 0.15s ease,
    box-shadow 0.15s ease;
}

.audio-toggle:hover {
  transform: translate(-1px, -1px);
  box-shadow: 3px 3px 0 var(--ink);
}

.audio-toggle:active {
  transform: translate(1px, 1px);
  box-shadow: 1px 1px 0 var(--ink);
}

.audio-bars {
  display: flex;
  align-items: flex-end;
  gap: 3px;
  height: 22px;
  width: 100%;
}

.audio-bars span {
  flex: 1;
  height: 100%;
  border-radius: 2px;
  background: var(--ink);
  animation: barBounce 1.1s ease-in-out infinite;
}

/* Mengatur variasi tinggi dan jeda animasi tiap batang gelombang */
.audio-bars span:nth-child(1) {
  height: 40%;
  animation-delay: 0s;
}
.audio-bars span:nth-child(2) {
  height: 90%;
  animation-delay: 0.1s;
}
.audio-bars span:nth-child(3) {
  height: 60%;
  animation-delay: 0.2s;
}
.audio-bars span:nth-child(4) {
  height: 100%;
  animation-delay: 0.3s;
}
.audio-bars span:nth-child(5) {
  height: 50%;
  animation-delay: 0.4s;
}
.audio-bars span:nth-child(6) {
  height: 75%;
  animation-delay: 0.5s;
}
.audio-bars span:nth-child(7) {
  height: 45%;
  animation-delay: 0.6s;
}
.audio-bars span:nth-child(8) {
  height: 85%;
  animation-delay: 0.7s;
}
.audio-bars span:nth-child(9) {
  height: 55%;
  animation-delay: 0.8s;
}
.audio-bars span:nth-child(10) {
  height: 95%;
  animation-delay: 0.9s;
}
.audio-bars span:nth-child(11) {
  height: 40%;
  animation-delay: 1s;
}
.audio-bars span:nth-child(12) {
  height: 65%;
  animation-delay: 1.1s;
}

@keyframes barBounce {
  0%,
  100% {
    transform: scaleY(0.3);
  }
  50% {
    transform: scaleY(1);
  }
}

/* Posisi Stiker OMG di pojok kanan atas */
.hero-omg-sticker {
  position: absolute;
  top: 70px; /* Sesuaikan jarak dari atas */
  right: 3%; /* Sesuaikan jarak dari kanan */
  width: 110px; /* Atur ukuran besar kecilnya stiker */
  z-index: 15;
  pointer-events: none; /* Supaya tidak mengganggu klik di bawahnya */
  /* Atur kemiringan awal di sini (misal -12 derajat supaya miring ke kiri sedikit) */
  transform: rotate(12deg);

  /* Menjalankan 2 animasi sekaligus: Masuk (popIn) & Gerak-gerak (floatBounce) */
  animation:
    popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards,
    floatBounce 3s ease-in-out infinite 0.8s;
}

/* 1. Animasi Masuk (Efek membesar dan melompat masuk) */
@keyframes popIn {
  0% {
    transform: scale(0) rotate(-20deg);
    opacity: 0;
  }
  100% {
    transform: scale(1) rotate(12deg); /* Sedikit miring ala stiker komik */
    opacity: 1;
  }
}

/* 2. Animasi Gerak-Gerak (Maju-mundur / Melayang santai) */
@keyframes floatBounce {
  0%,
  100% {
    transform: translateY(0) rotate(12deg);
  }
  50% {
    transform: translateY(-8px) rotate(7deg); /* Naik sedikit sambil miring ke arah berlawanan */
  }
}
/* Posisi & Efek Gantung Aset Telepon */
.hero-phone-hanger {
  position: absolute;
  top: 53%; /* Atur posisi turun-naiknya supaya pas menggantung */
  left: 36%; /* Atur posisi geser kiri-kanannya sesuai area lingkaran */
  width: 140px; /* Atur ukuran lebar gambar telepon */
  z-index: 12;
  pointer-events: none;

  /* PENTING: Titik tumpu ayunan diatur di bagian atas (kabel paling atas) */
  transform-origin: top center;

  /* Menjalankan animasi muncul (dropIn) & animasi berayun (swing) */
  animation:
    dropIn 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards,
    swing 3.5s ease-in-out infinite 1s;
}

/* 1. Animasi Masuk (Turun dari atas sambil memantul) */
@keyframes dropIn {
  0% {
    transform: translateY(-50px) rotate(-15deg);
    opacity: 0;
  }
  100% {
    transform: translateY(0) rotate(0deg);
    opacity: 1;
  }
}

/* 2. Animasi Berayun ke Kanan dan ke Kiri (seperti bandul) */
@keyframes swing {
  0%,
  100% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(6deg); /* Ayun ke kanan */
  }
  75% {
    transform: rotate(-6deg); /* Ayun ke kiri */
  }
}

/* Wadah pembatas agar kancing menempel pas di sisi kiri tombol */
.btn-with-icon {
  position: relative;
  display: inline-block;
}

/* Styling Aset Kancing (Kuning & Merah) */
.hero-button-icon {
  position: absolute;
  left: -2px; /* Mengatur posisi menjorok ke kiri tombol */
  top: 50%;
  transform: translateY(-50%);
  width: 45px; /* Ukuran kancing */
  height: 45px;
  z-index: 20; /* Berada di atas tombol */
  pointer-events: none;

  /* Menjalankan Animasi Masuk & Animasi Berputar Terus-menerus */
  animation:
    dropSpinIn 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards,
    spinContinuous 8s linear infinite 1s;
}

/* 1. Animasi Masuk (Memantul dan membesar) */
@keyframes dropSpinIn {
  0% {
    transform: translateY(-50%) scale(0) rotate(-180deg);
    opacity: 0;
  }
  100% {
    transform: translateY(-50%) scale(1) rotate(0deg);
    opacity: 1;
  }
}

/* 2. Animasi Gerak Memutar 360 Derajat Terus-menerus */
@keyframes spinContinuous {
  0% {
    transform: translateY(-50%) rotate(0deg);
  }
  100% {
    transform: translateY(-50%) rotate(360deg);
  }
}

/* 1. Kembalikan bagian .stats menjadi putih bersih dan normal seperti kodemu */
.stats {
  position: relative !important;
  display: block !important;
  padding: 100px 0 !important;
  overflow: visible !important;
  background-color: white !important;
}

/* 2. Mengatur posisi dan ukuran aset lembar kertas di kiri */
.stats-corner-paper {
  position: absolute !important;
  left: -5px !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  width: 201px !important;
  height: auto !important;
  z-index: 10 !important;
  pointer-events: none;
}

/* Menyembunyikan card statistik */
.stats .stat-card {
  display: none !important;
}

/* 3. Styling untuk Baris Pita Baru di Bawahnya (Bergaris Pink-Putih & Bergerak) */
.running-stripe-bar {
  width: 100%;
  height: 45px; /* Tinggi garis pita */
  position: relative;
  overflow: hidden;
  border-top: 3px solid #022d6c; /* Garis batas atas (opsional, bisa dihapus kalau tidak mau) */
  border-bottom: 3px solid #022d6c; /* Garis batas bawah */

  /* Membuat pola garis-garis pink & putih */
  background: repeating-linear-gradient(
    45deg,
    #ffccd5,
    #ffccd5 35px,
    #ffffff 35px,
    #ffffff 70px
  );

  /* Menjalankan animasi bergerak geser terus menerus */
  animation: moveStripeBar 12s linear infinite;
}

/* Keyframes agar pitanya bergerak geser tanpa henti */
@keyframes moveStripeBar {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 99px 0;
  }
}

/* Memperpanjang tinggi area section galeri/album tanpa isi */
section.gallery#album {
  /* Ganti 'nama-foto-kamu.jpg' dengan nama file gambar yang kamu punya */
  background-image: url("bg2.png") !important;

  /* Supaya fotonya menutupi seluruh area dengan pas dan tidak gepeng */
  background-size: cover !important;
  background-position: center !important;
  background-repeat: no-repeat !important;
  padding-top: 267px !important; /* Menambah jarak kosong di bagian atas */
  padding-bottom: 150px !important; /* Menambah jarak kosong di bagian bawah */
}

/* Wajib: Jadikan section galeri sebagai patokan posisi (relative) */
section.gallery#album {
  position: relative !important;
}

/* Posisi kontainer strip film di sebelah kiri area galeri */
.film-strips-container {
  position: absolute !important;
  left: 50px !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  display: flex !important;
  gap: 20px !important;
  z-index: 10 !important;
  pointer-events: none;
}

/* Pengaturan ukuran masing-masing strip film */
.film-strip {
  width: 130px !important;
  height: auto !important;
  object-fit: contain;
  filter: drop-shadow(0px 8px 12px rgba(0, 0, 0, 0.3));
}

/* ==========================================
   PENGATURAN KHUSUS TIAP STRIP FILM
   ========================================== */

/* Mengatur khusus Film Pertama (Kiri) */
.film-strip.film-1 {
  position: relative !important; /* Wajib ada agar property 'left' berfungsi */
  width: 320px !important; /* Ukuran lebar film pertama */
  margin-top: -20px !important; /* Geser posisi vertikal (bisa minus agar naik, positif agar turun) */
  transform: rotate(0deg) !important; /* Efek kemiringan */
  left: 40px !important; /* Menggeser posisi ke kanan/kiri */
}

/* Mengatur khusus Film Kedua (Kanan) */
.film-strip.film-2 {
  position: relative !important;
  width: 200px !important; /* Ukuran lebar film kedua */
  margin-top: -113px !important; /* Atur jarak naik/turunnya dibanding film pertama */
  transform: rotate(0deg) !important; /* Efek kemiringan */
  left: 20px !important; /* Menggeser posisi film kedua ke kanan/kiri */
}

/* Kontainer utama untuk dekorasi tambahan */
.decor-assets-container {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  pointer-events: none; /* Supaya tidak mengganggu klik mouse */
  z-index: 15 !important; /* Di atas background dan film */
}

/* Pengaturan Umum Aset Dekorasi */
.decor-item {
  position: absolute !important;
  object-fit: contain;
  filter: drop-shadow(0px 6px 10px rgba(0, 0, 0, 0.25));
}

/* ==========================================
   1. MATA GOYANG (Posisi, Ukuran, Animasi Masuk & Gerak Pelan)
   ========================================== */
.asset-eyes {
  width: 95px !important;
  top: -70px !important;
  left: 120px !important;
  transform: rotate(-35deg) !important;
  animation:
    popIn 0.8s ease-out forwards,
    floatingEyesSlow 6s ease-in-out infinite alternate;
}

/* ==========================================
   2. KURSOR (Posisi, Ukuran, Animasi Masuk & Gerak Pelan)
   ========================================== */
.asset-cursor {
  width: 75px !important;
  top: 35px !important;
  left: 125px !important;
  transform: rotate(85deg) !important;
  animation:
    popIn 1s ease-out forwards,
    floatingCursorSlow 7s ease-in-out infinite alternate;
}

/* ==========================================
   1. MATA GOYANG (Posisi, Ukuran, & Animasi Lengkap)
   ========================================== */
.asset-eyes {
  width: 95px !important;
  top: -70px !important;
  left: 120px !important;
  animation:
    popIn 0.8s ease-out forwards,
    floatingEyesSlow 6s ease-in-out infinite alternate;
}

/* ==========================================
   2. KURSOR (Posisi, Ukuran, & Animasi Lengkap)
   ========================================== */
.asset-cursor {
  width: 75px !important;
  top: 35px !important;
  left: 125px !important;
  animation:
    popIn 1s ease-out forwards,
    floatingCursorSlow 7s ease-in-out infinite alternate;
}

/* ==========================================
   3. TELEPON HITAM (Posisi, Ukuran, & Animasi Lengkap)
   ========================================== */
.asset-phone {
  width: 120px !important;
  top: 125px !important;
  left: 105px !important;
  transform-origin: top center;
  animation:
    popIn 1.2s ease-out forwards,
    swingPhone 4s ease-in-out infinite;
}

/* ==========================================
   RANGKAIAN RUMUS ANIMASI (KEYFRAMES)
   ========================================== */

/* Efek Animasi Masuk */
@keyframes popIn {
  0% {
    opacity: 0;
    transform: scale(0.5);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

/* Efek Gerak Lambat untuk Mata (Menjaga rotasi -35deg tetap miring sambil naik-turun) */
@keyframes floatingEyesSlow {
  0% {
    transform: translateY(0px) rotate(-35deg);
  }
  100% {
    transform: translateY(-6px) rotate(-33deg);
  }
}

/* Efek Gerak Lambat untuk Kursor (Menjaga rotasi 85deg tetap miring sambil naik-turun) */
@keyframes floatingCursorSlow {
  0% {
    transform: translateY(0px) rotate(85deg);
  }
  100% {
    transform: translateY(-7px) rotate(83deg);
  }
}

/* Efek Gerak Goyang ke Kanan dan Kiri untuk Telepon Hitam */
@keyframes swingPhone {
  0% {
    transform: rotate(3deg);
  }
  50% {
    transform: rotate(-7deg);
  }
  100% {
    transform: rotate(3deg);
  }
}

/* ==========================================
   4. VINYL HATI MERAH (lovemerah) - Masuk + Gerak Mengambang
   ========================================== */
.asset-love-vinyl {
  width: 100px !important;
  top: -40px !important;
  left: 20px !important;
  animation:
    popIn 1.3s ease-out forwards,
    floatingLoveVinyl 6s ease-in-out infinite alternate;
}

@keyframes floatingLoveVinyl {
  0% {
    transform: translateY(0px) rotate(-15deg);
  }
  100% {
    transform: translateY(-6px) rotate(-12deg);
  }
}

/* ==========================================
   5. KASET VINYL HITAM (kaset.jpg) - Masuk + Muter Pelan
   ========================================== */
.asset-black-vinyl {
  width: 65px !important;
  top: 150px !important;
  left: 330px !important;
  /* Animasi masuk (popIn) digabung dengan animasi muter terus-menerus (spinSlow) */
  animation:
    popIn 1.5s ease-out forwards,
    spinSlow 12s linear infinite;
}

/* ==========================================
   6. KASET PITA SONY (kaset-2.jpg) - Masuk + Gerak Mengambang
   ========================================== */
.asset-tape {
  width: 90px !important;
  top: 320px !important;
  left: 320px !important;
  transform: rotate(20deg) !important;

  /* Animasi masuk dan gerak mengambang */
  animation:
    popIn 1.7s ease-out forwards,
    floatingTape 8s ease-in-out infinite alternate !important;
}

/* Rumus gerak mengambang kaset pita */
@keyframes floatingTape {
  0% {
    transform: translateY(0px) rotate(20deg);
  }
  100% {
    transform: translateY(-6px) rotate(23deg);
  }
}

/* ==========================================
   RUMUS ANIMASI PUTAR (KEYFRAMES)
   ========================================== */

/* Rumus Putar Searah Jarum Jam (Pelan) */
@keyframes spinSlow {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/* ==========================================
   7. TEKS MEMORIES VERTIKAL (asset-memories-text)
   ========================================== */
.asset-memories-text {
  width: 100px !important; /* Lebar aset (sesuaikan agar pas, tidak terlalu besar) */
  top: 60px !important; /* Jarak dari atas (sejajar dengan area kamera dan telepon) */
  left: 30px !important; /* Paling kiri layar */
  transform: rotate(0deg) !important; /* Pastikan tegak lurus */
  z-index: 20 !important; /* Paling depan agar menumpuk di atas aset lain jika perlu */

  /* Animasi masuk (popIn) - durasi 1.2s */
  animation: popIn 1.2s ease-out forwards;
}