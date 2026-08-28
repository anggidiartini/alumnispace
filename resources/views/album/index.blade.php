
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Our Album — Index</title>
 <link rel="stylesheet" href="{{ asset('css/album.css') }}">
</head>
<body>

<div class="section-blue">
<nav>
  <div class="logo"><span class="logo-dot"></span>memori.</div>
  <div class="nav-links">
    <span class="active">Albums</span>
    <span>Timeline</span>
    <span>People</span>
    <span>About</span>
  </div>
</nav>

<div class="hero">
    <div class="hero-inner">

        <div class="hero-copy">

            <div class="greet-badge">
                <span>✦</span>
                OUR MEMORIES
            </div>

            <h1 class="title">
                Tentang Kita,<br>
                Tentang Momen yang<br>
                Nggak Akan Terulang Lagi.
            </h1>

            <p class="subtitle">
                Potongan kecil dari hari-hari yang pernah kita jalani bersama,
                sekarang jadi cerita yang akan selalu kita simpan.
            </p>

        </div>


        <!-- 3 POLAROID -->
        <div class="hero-photos">

            <div class="polaroid polaroid-1">
                <div class="polaroid-photo">
                    <img src="{{ asset('images/album/photo-1.jpg') }}" alt="Kenangan 1">
                </div>
                <span>best days ♡</span>
            </div>

            <div class="polaroid polaroid-2">
                <div class="polaroid-photo">
                    <img src="{{ asset('images/album/photo-2.jpg') }}" alt="Kenangan 2">
                </div>
                <span>with you guys</span>
            </div>

            <div class="polaroid polaroid-3">
                <div class="polaroid-photo">
                    <img src="{{ asset('images/album/photo-3.jpg') }}" alt="Kenangan 3">
                </div>
                <span>remember this?</span>
            </div>

        </div>

        <!-- dekorasi scrapbook -->
        <span class="hero-doodle doodle-star">✦</span>
        <span class="hero-doodle doodle-heart">♡</span>
        <span class="hero-doodle doodle-arrow">↝</span>

    </div>
</div>




<div class="section-yellow">
<div class="marquee">
  <div class="marquee-track">
    <span>Tiada hari tanpa canda &amp; tawa bareng kalian</span>
    <span>Kenangan sekolah nggak akan pernah kelewat</span>
    <span>Setiap momen, layak buat dikenang</span>
    <span>Tiada hari tanpa canda &amp; tawa bareng kalian</span>
    <span>Kenangan sekolah nggak akan pernah kelewat</span>
    <span>Setiap momen, layak buat dikenang</span>
  </div>
</div>

<div class="wrap">
  <div class="section-head">
    <h2>Pilih Album Kamu</h2>
    <div class="count">4 albums</div>
  </div>

  <div class="album-grid">

    <div class="hint h1">klik album →</div>

    <svg class="doodle" style="position:absolute;top:-30px;right:120px;width:26px;height:26px;z-index:2;" viewBox="0 0 24 24" fill="var(--morning)" opacity="0.85">
      <path d="M12 0l2.5 8H23l-6.7 5 2.6 8L12 16l-6.9 5 2.6-8L1 8h8.5z"/>
    </svg>
    <svg class="doodle" style="position:absolute;top:60px;left:-10px;width:60px;height:30px;z-index:2;" viewBox="0 0 60 30" fill="none">
      <path d="M2 20 C 15 2, 25 2, 30 15 S 45 28, 58 10" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <svg class="doodle" style="position:absolute;bottom:40px;right:-6px;width:24px;height:24px;z-index:2;" viewBox="0 0 24 24" fill="none" stroke="var(--morning)" stroke-width="2" opacity="0.7">
      <path d="M12 21s-7-4.4-9.5-8.4C.6 9 2 5 6 5c2 0 3.3 1 4 2 .7-1 2-2 4-2 4 0 5.4 4 3.5 7.6C19 16.6 12 21 12 21z"/>
    </svg>

    <!-- CLASS TRIP -->
    <div class="card c1">
      <svg class="corner-clip" viewBox="0 0 34 44" fill="none"><path d="M8 2c-6 0-6 8 0 8h14v20c0 5-8 5-8 0V14" stroke="#2c3e50" stroke-width="2.4" stroke-linecap="round" opacity="0.55"/></svg>
      <div class="card-photo">
        <svg class="photo-icon" width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><rect x="3" y="6" width="18" height="14" rx="2"/><circle cx="12" cy="13" r="3.4"/><path d="M8 6l1.5-2h5L16 6"/></svg>
      </div>
      <div class="sticker">seru<br>banget!</div>
      <div class="card-body">
        <div class="label">liburan sekelas</div>
        <h3>Class Trip</h3>
        <div class="date">14 Maret 2026 · Bandung</div>
        <button class="view-btn">View Album
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFF7D6" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
      </div>
    </div>

    <!-- SCHOOL EVENT -->
    <div class="card c2">
      <div class="tape-strip"></div>
      <svg style="position:absolute;top:-16px;right:-8px;width:24px;height:24px;z-index:6;" viewBox="0 0 24 24" fill="var(--sunwashed)"><path d="M12 0l2.5 8H23l-6.7 5 2.6 8L12 16l-6.9 5 2.6-8L1 8h8.5z"/></svg>
      <div class="card-photo">
        <svg class="photo-icon" width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="#2c3e50" stroke-width="1.6"><rect x="3" y="6" width="18" height="14" rx="2"/><circle cx="12" cy="13" r="3.4"/><path d="M8 6l1.5-2h5L16 6"/></svg>
      </div>
      <div class="card-body">
        <div class="label">panggung &amp; sorak-sorai</div>
        <h3>School Event</h3>
        <div class="date">2 Mei 2026 · Aula Sekolah</div>
        <button class="view-btn">View Album
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFF7D6" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
      </div>
    </div>

    <!-- CLASS GATHERING -->
    <div class="card c3">
      <svg class="corner-clip" viewBox="0 0 34 44" fill="none"><path d="M8 2c-6 0-6 8 0 8h14v20c0 5-8 5-8 0V14" stroke="#2c3e50" stroke-width="2.4" stroke-linecap="round" opacity="0.55"/></svg>
      <div class="card-photo">
        <svg class="photo-icon" width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><rect x="3" y="6" width="18" height="14" rx="2"/><circle cx="12" cy="13" r="3.4"/><path d="M8 6l1.5-2h5L16 6"/></svg>
      </div>
      <div class="sticker">makan<br>bareng</div>
      <div class="card-body">
        <div class="label">kumpul santai</div>
        <h3>Class Gathering</h3>
        <div class="date">19 Juni 2026 · Cafe Rumah Kayu</div>
        <button class="view-btn">View Album
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFF7D6" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
      </div>
    </div>

    <!-- GRADUATION -->
    <div class="card c4">
      <div class="tape-strip"></div>
      <svg style="position:absolute;bottom:-10px;left:20px;width:22px;height:22px;z-index:6;" viewBox="0 0 24 24" fill="none" stroke="var(--morning)" stroke-width="2"><path d="M12 21s-7-4.4-9.5-8.4C.6 9 2 5 6 5c2 0 3.3 1 4 2 .7-1 2-2 4-2 4 0 5.4 4 3.5 7.6C19 16.6 12 21 12 21z"/></svg>
      <div class="card-photo">
        <svg class="photo-icon" width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="#2c3e50" stroke-width="1.6"><rect x="3" y="6" width="18" height="14" rx="2"/><circle cx="12" cy="13" r="3.4"/><path d="M8 6l1.5-2h5L16 6"/></svg>
      </div>
      <div class="card-body">
        <div class="label">akhir dari sebuah babak</div>
        <h3>Graduation</h3>
        <div class="date">28 Juli 2026 · Gedung Serbaguna</div>
        <button class="view-btn">View Album
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFF7D6" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
      </div>
    </div>

  </div>
</div>
</div>

<footer>dibuat dengan tawa, keringat, dan sedikit air mata haru ✦</footer>

</body>
</html>