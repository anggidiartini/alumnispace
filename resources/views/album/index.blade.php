<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>memori. — Our Album</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap');

:root{
  --buttercup:#FFE08A;
  --dewy:#A8C6E7;
  --sunwashed:#FFE08A;
  --cloud:#FFF7D6;
  --morning:#7FA8D6;
  --ink:#2c3e50;
  --ink-soft:#4a5a6a;
  --navy:#124d82;
  --sky:#6497c0;
  --pink2:#f3c2c6;
  --cream2:#f7efbf;
}

html{scroll-behavior:smooth;}
*{margin:0;padding:0;box-sizing:border-box;}

body{
  background:var(--cloud);
  font-family:'Baloo 2', sans-serif;
  color:var(--ink);
  overflow-x:hidden;
  position:relative;
}

body::before{
  content:"";
  position:fixed;inset:0;
  background-image:radial-gradient(circle at 1px 1px, rgba(44,62,80,0.035) 1px, transparent 0);
  background-size:22px 22px;
  pointer-events:none;z-index:0;
}

.wrap{max-width:1180px;margin:0 auto;padding:0 40px;position:relative;z-index:1;}

/* ---------- SECTION BLOCKS ---------- */
.section-blue{
  background:linear-gradient(155deg, var(--dewy) 0%, var(--morning) 100%);
  position:relative;padding-bottom:10px;overflow:hidden;
}
.section-blue::before{
  content:"";position:absolute;inset:0;z-index:1;pointer-events:none;
  background-image:
    radial-gradient(circle at 1px 1px, rgba(255,255,255,0.35) 1.5px, transparent 0);
  background-size:26px 26px;
}
.section-yellow{
  background:#ffffff;
  position:relative;padding-top:10px;overflow:hidden;
  scroll-margin-top:80px;
}
.section-yellow::before{
  content:"";position:absolute;inset:0;z-index:1;pointer-events:none;
  background-image:
    radial-gradient(circle at 1px 1px, rgba(44,62,80,0.09) 1.5px, transparent 0);
  background-size:26px 26px;
}
.section-blue::after{
  content:"";position:absolute;left:0;right:0;bottom:-2px;height:90px;
  z-index:2;pointer-events:none;
}
.wave-divider{
  position:absolute;left:0;right:0;bottom:-1px;width:100%;height:90px;
  line-height:0;z-index:3;
}
.wave-divider svg{display:block;width:100%;height:100%;}
@media (max-width:900px){
  .wave-divider{height:55px;}
}

/* ---------- BUNTING GARLAND ---------- */
.garland{
  display:flex;justify-content:center;gap:6px;
  padding-top:18px;position:relative;z-index:3;
}
.garland .flag{
  width:0;height:0;
  border-left:13px solid transparent;
  border-right:13px solid transparent;
  border-top:20px solid var(--cloud);
  opacity:.9;
  animation:swayFlag 2.6s ease-in-out infinite;
}
.garland .flag:nth-child(2n){border-top-color:var(--sunwashed);animation-delay:.2s;}
.garland .flag:nth-child(3n){border-top-color:var(--buttercup);animation-delay:.4s;}
.garland .flag:nth-child(4n){border-top-color:#ffffff;animation-delay:.6s;}

/* ---------- CONFETTI + DOODLES ---------- */
.confetti-layer{
  position:absolute;inset:0;pointer-events:none;z-index:1;overflow:hidden;
}
.confetti{position:absolute;pointer-events:none;will-change:transform;}
.confetti.dot{border-radius:50%;}
.confetti.square{border-radius:2px;}
.confetti.star{font-family:'Baloo 2', sans-serif;line-height:1;}

.doodle{
  position:absolute;pointer-events:none;z-index:3;
  font-family:'Baloo 2', sans-serif;font-weight:700;
  opacity:.85;
}
.doodle svg{display:block;overflow:visible;}

@keyframes floatUpDown{
  0%,100%{transform:translateY(0) rotate(var(--r,0deg));}
  50%{transform:translateY(-16px) rotate(calc(var(--r,0deg) + 8deg));}
}
@keyframes spinSlow{
  from{transform:rotate(0deg);}
  to{transform:rotate(360deg);}
}
@keyframes popIn{
  0%{opacity:0;transform:scale(0) rotate(0deg);}
  70%{opacity:1;transform:scale(1.15) rotate(var(--r,0deg));}
  100%{opacity:1;transform:scale(1) rotate(var(--r,0deg));}
}

/* highlight marker behind key words */
.marker{
  position:relative;white-space:nowrap;
}
.marker::before{
  content:"";
  position:absolute;
  left:-6px;right:-6px;bottom:2px;
  height:38%;
  background:var(--sunwashed);
  opacity:.55;
  transform:skewX(-6deg);
  z-index:-1;
  border-radius:3px;
}

/* =========================================
   HERO / SECTION 1
   ========================================= */
.hero{
  position:relative;
  max-width:1180px;
  margin:0 auto;
  padding:90px 40px 105px;
  z-index:1;
}
.hero-inner{
  position:relative;
  display:grid;
  grid-template-columns:minmax(0,1fr) minmax(420px,520px);
  align-items:center;
  gap:55px;
  min-height:500px;
}

.hero-copy{
  position:relative;
  z-index:4;
  max-width:600px;
  text-align:left;
  animation:heroTextIn .9s cubic-bezier(.2,.8,.2,1) both;
}

.greet-badge{
  display:inline-flex;
  align-items:center;
  gap:8px;
  color:#fff;
  border:1px dashed rgba(255,255,255,.75);
  padding:7px 16px;
  font-family:'Baloo 2', sans-serif;
  font-size:11px;
  font-weight:700;
  letter-spacing:2px;
  transform:rotate(-2deg);
  margin-bottom:22px;
  animation:badgeIn .8s .15s ease both;
}
.greet-badge span{
  font-size:16px;
  display:inline-block;
}

h1.title{
  font-family:'Baloo 2', sans-serif;
  font-size:clamp(36px,4.2vw,54px);
  line-height:1.1;
  letter-spacing:-1px;
  color:#fff;
  text-shadow:3px 4px 0 rgba(44,62,80,.2);
  animation:heroTitleIn 1s .15s cubic-bezier(.2,.8,.2,1) both;
}
h1.title .pop{
  color:#FFE08A;
  display:inline-block;
}

.subtitle{
  font-family:'Baloo 2', sans-serif;
  color:rgba(255,255,255,.9);
  font-size:15.5px;
  line-height:1.75;
  max-width:530px;
  margin:22px 0 0;
  animation:fadeUp .9s .35s ease both;
}

.hero-cta{
  display:inline-flex;align-items:center;gap:10px;
  margin-top:34px;
  background:var(--buttercup);color:var(--ink);
  font-family:'Baloo 2', sans-serif;font-weight:600;font-size:15px;
  padding:14px 28px;border-radius:40px;border:3px dashed var(--ink);
  cursor:pointer;letter-spacing:.01em;
  box-shadow:0 10px 24px rgba(44,62,80,.22);
  transition:transform .18s cubic-bezier(.34,1.56,.64,1), background .2s ease, box-shadow .2s ease;
  animation:fadeUp .9s .5s ease both;
}
.hero-cta:hover{
  background:var(--sunwashed);
  transform:translateY(-3px) scale(1.03);
  box-shadow:0 14px 30px rgba(44,62,80,.28);
}
.hero-cta:active{transform:scale(.96);}
.hero-cta svg{transition:transform .25s ease;}
.hero-cta:hover svg{transform:translateY(3px);}

/* ---------- POLAROID STACK ---------- */
.photo-stack{
  position:relative;
  width:min(100%,500px);
  height:450px;
  justify-self:end;
  animation:photoAreaIn 1s .25s cubic-bezier(.2,.8,.2,1) both;
}

.polaroid{
  position:absolute;
  width:260px;
  background:#f9cede;
  padding:12px 12px 42px;
  box-shadow:0 18px 35px rgba(0,0,0,.22);
  transform-origin:center center;
  transition:transform .45s cubic-bezier(.2,.8,.2,1), box-shadow .45s ease;
  cursor:pointer;
}
.polaroid img{
  width:100%;
  height:270px;
  display:block;
  object-fit:cover;
}
.polaroid::after{
  content:attr(data-caption);
  position:absolute;
  left:0;
  right:0;
  bottom:10px;
  text-align:center;
  font-family:'Baloo 2', sans-serif;
  font-size:21px;
  font-weight:700;
  color:var(--ink);
}

.polaroid.one{
  left:0;
  top:100px;
  transform:rotate(-12deg);
  animation:polaroidFloat1 4.8s ease-in-out infinite;
}
.polaroid.two{
  left:150px;
  top:0;
  z-index:2;
  transform:rotate(3deg);
  animation:polaroidFloat2 5.2s .3s ease-in-out infinite;
}
.polaroid.three{
  right:0;
  top:130px;
  z-index:3;
  transform:rotate(12deg);
  animation:polaroidFloat3 4.6s .6s ease-in-out infinite;
}

.polaroid:hover{
  z-index:10;
  transform:translateY(-18px) rotate(0deg) scale(1.06) !important;
  box-shadow:0 30px 55px rgba(0,0,0,.28);
  animation-play-state:paused;
}
.polaroid img{
  transition:transform .6s ease, filter .6s ease;
}
.polaroid:hover img{
  transform:scale(1.04);
  filter:saturate(1.1);
}

/* little pin/sticker on the corner polaroid, appears once */
.pin-heart{
  position:absolute;top:-14px;right:-10px;
  font-size:26px;z-index:11;
  transform:rotate(12deg);
  filter:drop-shadow(0 3px 4px rgba(0,0,0,.2));
}

/* ---------- MAGNIFYING GLASS (searching over the polaroids) ---------- */
.magnifier{
  position:absolute;
  width:200px;
  height:200px;
  z-index:15;
  pointer-events:none;
  filter:drop-shadow(0 10px 16px rgba(0,0,0,.28));
  animation:magnifierSearch 10s ease-in-out infinite;
}
.magnifier img{
  width:100%;
  height:100%;
  display:block;
}

@keyframes magnifierSearch{
  0%{   top:26%; left:4%;  transform:rotate(-18deg) scale(1);   }
  15%{  top:9%;  left:18%; transform:rotate(8deg)   scale(1.08);}
  30%{  top:33%; left:36%; transform:rotate(-10deg) scale(0.95);}
  45%{  top:7%;  left:52%; transform:rotate(14deg)  scale(1.1); }
  60%{  top:35%; left:58%; transform:rotate(-14deg) scale(0.98);}
  75%{  top:18%; left:30%; transform:rotate(10deg)  scale(1.05);}
  90%{  top:31%; left:12%; transform:rotate(12deg)  scale(1.05);}
  100%{ top:26%; left:4%;  transform:rotate(-18deg) scale(1);   }
}

@media (max-width:900px){
  .magnifier{ width:140px; height:140px; }
}
@media (max-width:600px){
  .magnifier{ width:100px; height:100px; }
}

/* =========================================
   ALBUM SECTION
   ========================================= */
.section-head{
  display:flex;align-items:baseline;justify-content:space-between;
  margin:44px 0 24px;flex-wrap:wrap;gap:10px;
  border-bottom:2px dashed rgba(44,62,80,.25);padding-bottom:18px;
  position:relative;z-index:2;
}
.section-head h2{font-family:'Baloo 2', sans-serif;font-size:26px;font-weight:600;}
.section-head .count{
  font-family:'Baloo 2', sans-serif;font-size:13px;font-weight:600;color:var(--ink);
  background:var(--dewy);padding:5px 12px;border-radius:20px;
}

/* filter bar */
.filter-bar{display:flex;flex-wrap:wrap;gap:12px;margin-bottom:14px;position:relative;z-index:2;}
.filter-btn{
  font-family:'Baloo 2', sans-serif;font-weight:600;font-size:13.5px;
  padding:10px 20px;border-radius:30px;border:2.5px dashed var(--ink);
  background:transparent;color:var(--ink);cursor:pointer;
  transition:transform .2s ease, background .2s ease, color .2s ease, box-shadow .2s ease;
}
.filter-btn:hover{transform:translateY(-2px) rotate(-2deg);box-shadow:0 6px 0 rgba(44,62,80,.15);}
.filter-btn.active{background:var(--ink);color:var(--cloud);}
.filter-btn.active:hover{transform:translateY(-2px) rotate(2deg);}
.filter-status{
  font-family:'Baloo 2', sans-serif;font-size:17px;color:var(--ink-soft);
  margin-bottom:34px;position:relative;z-index:2;
}
.filter-status strong{color:var(--ink);}

.album-grid{
  position:relative;display:grid;grid-template-columns:repeat(2,1fr);
  gap:26px;padding-bottom:100px;z-index:2;
}

.card{
  position:relative;background:#ffffff;border-radius:16px;
  border:2.5px solid var(--navy);
  padding:16px 16px 20px;box-shadow:5px 5px 0 var(--navy);
  cursor:default;
  opacity:0;transform:translateY(40px);
  transition:transform .3s ease, box-shadow .3s ease, opacity .3s ease;
}
.card.in-view{animation:riseIn .7s cubic-bezier(.2,.8,.2,1) forwards;animation-delay:var(--row-delay,0s);}
.card:hover{transform:translateY(-8px) rotate(-1deg);box-shadow:7px 7px 0 var(--navy);}
.card.filtered-out{display:none;}

.card:nth-of-type(1){background:var(--sky);}
.card:nth-of-type(2){background:var(--sunwashed);}
.card:nth-of-type(3){background:var(--pink2);}
.card:nth-of-type(4){background:var(--cream2);}

.card-photo{
  width:100%;height:230px;border-radius:12px;position:relative;overflow:hidden;
  display:flex;align-items:center;justify-content:center;
  border:2px solid var(--navy);
}
.card-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s ease;}
.card:hover .card-photo img{transform:scale(1.08);}

.cat-pill{
  position:absolute;top:10px;left:10px;z-index:5;
  font-family:'Baloo 2', sans-serif;font-weight:600;font-size:11.5px;
  padding:5px 12px;border-radius:20px;color:var(--navy);
  background:#ffffff;border:2px solid var(--navy);box-shadow:0 3px 8px rgba(0,0,0,.15);
}
.cat-pill.outdoor{background:#ffffff;}

.sticker{
  position:absolute;bottom:-14px;right:-10px;width:56px;height:56px;border-radius:50%;
  background:var(--navy);color:#fff;display:flex;align-items:center;justify-content:center;
  font-family:'Baloo 2', sans-serif;font-weight:700;font-size:14px;text-align:center;line-height:1.1;
  box-shadow:0 6px 14px rgba(44,62,80,.25);z-index:6;border:2.5px solid #fff;
  transition:transform .3s ease;
}
.sticker.alt{background:var(--navy);}
.card:hover .sticker{transform:scale(1.12) rotate(-8deg);}

.card-body{padding-top:18px;}
.label{font-family:'Baloo 2', sans-serif;font-weight:600;font-size:16px;color:var(--navy);margin-bottom:2px;}
.card-body h3{font-family:'Baloo 2', sans-serif;font-weight:600;font-size:23px;margin-bottom:4px;}
.date{font-size:13px;color:var(--ink-soft);font-weight:500;margin-bottom:16px;}

.view-btn{
  display:inline-flex;align-items:center;gap:8px;background:var(--ink);color:var(--cloud);
  font-family:'Baloo 2', sans-serif;font-weight:600;font-size:13.5px;padding:10px 18px;border-radius:30px;
  border:2px dashed var(--cloud);letter-spacing:.02em;cursor:pointer;transition:transform .18s cubic-bezier(.34,1.56,.64,1), background .2s ease;
}
.view-btn svg{transition:transform .2s;}
.view-btn:hover{transform:scale(1.06) rotate(-2deg);background:var(--morning);}
.view-btn:active{transform:scale(.93);}
.card:hover .view-btn svg{transform:translateX(4px);}

/* ---------- CONFETTI BURST (click) ---------- */
.burst-piece{
  position:fixed;pointer-events:none;z-index:999;border-radius:2px;
}

/* =========================================
   KEYFRAMES
   ========================================= */
@keyframes fadeUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:translateY(0);}}
@keyframes twinkle{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.5;transform:scale(.85);}}
@keyframes swayFlag{0%,100%{transform:rotate(-6deg);}50%{transform:rotate(6deg);}}
@keyframes riseIn{to{opacity:1;transform:translateY(0);}}
@keyframes burstFly{
  to{transform:translate(var(--tx),var(--ty)) rotate(var(--tr)); opacity:0;}
}

@media (prefers-reduced-motion: reduce){
  *{animation-duration:.01ms !important;animation-iteration-count:1 !important;transition-duration:.01ms !important;}
}

/* =========================================
   RESPONSIVE
   ========================================= */
@media (max-width:900px){
  .hero{padding:70px 25px 85px;}
  .wrap{padding-left:26px;padding-right:26px;}
  .hero-inner{
    grid-template-columns:1fr;
    gap:35px;
    min-height:auto;
  }
  .hero-copy{
    max-width:680px;
    text-align:center;
    margin:0 auto;
  }
  .subtitle{margin-left:auto;margin-right:auto;}
  .photo-stack{
    justify-self:center;
    width:min(100%,480px);
    height:410px;
  }
  .doodle{display:none;}
}

@media (max-width:600px){
  .hero{padding:55px 18px 70px;}
  h1.title{
    font-size:clamp(34px,10vw,46px);
    line-height:1.08;
  }
  .subtitle{
    font-size:13.5px;
    line-height:1.7;
  }
  .greet-badge{font-size:9px;padding:6px 12px;}
  .photo-stack{
    width:100%;
    max-width:360px;
    height:330px;
  }
  .polaroid{
    width:175px;
    padding:8px 8px 31px;
  }
  .polaroid img{height:185px;}
  .polaroid::after{
    bottom:5px;
    font-size:16px;
  }
  .polaroid.one{left:0;top:70px;}
  .polaroid.two{left:50%;top:8px;transform:translateX(-50%) rotate(3deg);}
  .polaroid.three{right:0;top:82px;}
  .polaroid.two:hover{transform:translateX(-50%) translateY(-18px) rotate(0deg) scale(1.06) !important;}

  .section-head h2{font-size:21px;}
  .filter-btn{padding:8px 16px;font-size:12.5px;}
  .album-grid{grid-template-columns:1fr;gap:24px;padding-bottom:60px;}
  .card-photo{height:200px;}
  .sticker{width:46px;height:46px;font-size:11.5px;}
  .card-body h3{font-size:20px;}
}
</style>
</head>
<body>

<x-navbar />

<div class="section-blue">
  <div class="confetti-layer" id="confetti-blue"></div>

  <!-- doodles -->
  <div class="doodle" style="top:60px;left:6%;--r:-10deg;" id="doodle-star">
    <svg width="34" height="34" viewBox="0 0 24 24" fill="#FFF7D6"><path d="M12 1l2.9 7.3L22 11l-7.1 2.7L12 21l-2.9-7.3L2 11l7.1-2.7z"/></svg>
  </div>
  <div class="doodle" style="bottom:8%;left:3%;--r:12deg;color:#fff;font-size:26px;">♡</div>

  <section class="hero">
    <div class="hero-inner">

      <div class="hero-copy">
        <div class="greet-badge"><span>✦</span> OUR MEMORIES</div>
        <h1 class="title">
          Tentang Kita, Tentang Momen yang <span class="pop">Nggak Akan Terulang</span> Lagi 
        </h1>
        <p class="subtitle">
          Potongan kecil dari hari-hari yang pernah kita jalani bersama,
          sekarang jadi cerita yang akan selalu kita simpan.
        </p>
        <button class="hero-cta" id="scroll-to-album">
          Lihat Album
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2c3e50" stroke-width="2.6"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
        </button>
      </div>

      <div class="photo-stack" aria-label="Kumpulan foto kenangan">
        <div class="polaroid one" data-caption="momen kecil ✦">
          <img src="{{ asset('assets/images/foto-1.png') }}" alt="Momen kenangan pertama">
        </div>
        <div class="polaroid two" data-caption="bareng-bareng ♡">
          <img src="{{ asset('assets/images/foto-2.png') }}" alt="Momen kenangan kedua">
        </div>
        <div class="polaroid three" data-caption="never forget ✨">
          <img src="{{ asset('assets/images/foto-3.png') }}" alt="Momen kenangan ketiga">
          <span class="pin-heart">💛</span>
        </div>

         <div class="magnifier" aria-hidden="true">
        <img src="{{ asset('assets/icons/kacapembesar.png') }}" alt="">
    </div>
      </div>

    </div>
  </section>

  <div class="wave-divider">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
      <path d="M0,40 C240,90 380,0 620,35 C860,70 1000,10 1180,45 C1300,68 1380,60 1440,45 L1440,100 L0,100 Z" fill="#ffffff"></path>
    </svg>
  </div>
</div>

<div class="section-yellow" id="album-section">
  <div class="confetti-layer" id="confetti-yellow"></div>

  <div class="wrap">
    <div class="section-head">
      <h2>Pilih Album <span class="marker">Kamu</span></h2>
      <div class="count">4 albums</div>
    </div>

    <div class="filter-bar">
      <button class="filter-btn active" data-filter="all">Semua</button>
      <button class="filter-btn" data-filter="indoor">Indoor</button>
      <button class="filter-btn" data-filter="outdoor">Outdoor</button>
    </div>
    <div class="filter-status">Menampilkan <strong id="filter-label">semua album</strong></div>

    <div class="album-grid">

      <!-- CLASS TRIP -->
      <div class="card" id="c1" data-category="outdoor">
        <div class="card-photo">
          <span class="cat-pill outdoor">Outdoor</span>
          <img src="{{ asset('assets/images/foto-4OUTDOOR.jpg') }}" alt="Class Trip">
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
      <div class="card" id="c2" data-category="indoor">
        <div class="card-photo">
          <span class="cat-pill">Indoor</span>
           <img src="{{ asset('assets/images/foto-6INDOOR.jpg') }}" alt="School Event">
        </div>
        <div class="sticker alt">asik<br>banget</div>
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
      <div class="card" id="c3" data-category="outdoor">
        <div class="card-photo">
          <span class="cat-pill outdoor">Outdoor</span>
           <img src="{{ asset('assets/images/foto-5OUTDOOR.jpg') }}" alt="Class Gathering">
        </div>
        <div class="sticker">seru<br>bareng</div>
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
      <div class="card" id="c4" data-category="indoor">
        <div class="card-photo">
          <span class="cat-pill">Indoor</span>
           <img src="{{ asset('assets/images/foto-7INDOOR.jpg') }}" alt="Graduation">
        </div>
        <div class="sticker alt">so<br>proud</div>
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

<x-footer />

<script>
(function(){
  // ---------- SMOOTH SCROLL TO ALBUM ----------
  var scrollBtn = document.getElementById('scroll-to-album');
  var albumSection = document.getElementById('album-section');
  if(scrollBtn && albumSection){
    scrollBtn.addEventListener('click', function(){
      albumSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  // ---------- CONFETTI GENERATOR ----------
  var colors = ['#ffffff','#FFE08A','#A8C6E7','#7FA8D6'];

  function spawnConfetti(containerId, count, shapesAllowed){
    var container = document.getElementById(containerId);
    if(!container) return;
    for(var i=0;i<count;i++){
      var el = document.createElement('div');
      var kind = shapesAllowed[Math.floor(Math.random()*shapesAllowed.length)];
      el.className = 'confetti ' + kind;
      var size = 6 + Math.random()*8;
      var top = Math.random()*100;
      var left = Math.random()*100;
      var rot = (Math.random()*60 - 30);
      var duration = 3 + Math.random()*3;
      var delay = Math.random()*3;
      var color = colors[Math.floor(Math.random()*colors.length)];

      if(kind === 'star'){
        el.textContent = '✦';
        el.style.fontSize = (size+6) + 'px';
        el.style.color = color;
      } else {
        el.style.width = size + 'px';
        el.style.height = size + 'px';
        el.style.background = color;
      }

      el.style.top = top + '%';
      el.style.left = left + '%';
      el.style.opacity = 0.55 + Math.random()*0.4;
      el.style.setProperty('--r', rot + 'deg');
      el.style.transform = 'rotate(' + rot + 'deg)';
      el.style.animation = 'floatUpDown ' + duration + 's ease-in-out ' + delay + 's infinite';

      container.appendChild(el);
    }
  }

  spawnConfetti('confetti-blue', 14, ['dot','square','star']);
  spawnConfetti('confetti-yellow', 14, ['dot','square','star']);

  // ---------- SCROLL REVEAL FOR ALBUM CARDS (staggered by row) ----------
  var cards = document.querySelectorAll('.card');
  var columns = 2; // matches .album-grid grid-template-columns
  cards.forEach(function(c, i){
    var row = Math.floor(i / columns);
    c.style.setProperty('--row-delay', (row * 0.65) + 's');
  });
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting){
        entry.target.classList.add('in-view');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  cards.forEach(function(c){ io.observe(c); });

  // ---------- FILTER BUTTONS ----------
  var filterBtns = document.querySelectorAll('.filter-btn');
  var filterLabel = document.getElementById('filter-label');
  var labelText = { all: 'semua album', indoor: 'album Indoor', outdoor: 'album Outdoor' };

  filterBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
      filterBtns.forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      var filter = btn.dataset.filter;
      filterLabel.textContent = labelText[filter];

      cards.forEach(function(card){
        var match = filter === 'all' || card.dataset.category === filter;
        card.classList.toggle('filtered-out', !match);
      });
    });
  });

  // ---------- CLICK CONFETTI BURST ON VIEW-BTN ----------
  function burst(x, y){
    var pieces = 16;
    for(var i=0;i<pieces;i++){
      var piece = document.createElement('div');
      piece.className = 'burst-piece';
      var size = 5 + Math.random()*6;
      var color = colors[Math.floor(Math.random()*colors.length)];
      var angle = Math.random()*Math.PI*2;
      var dist = 60 + Math.random()*70;
      var tx = Math.cos(angle)*dist + 'px';
      var ty = Math.sin(angle)*dist + 'px';
      var tr = (Math.random()*360) + 'deg';

      piece.style.width = size + 'px';
      piece.style.height = size + 'px';
      piece.style.background = color;
      piece.style.left = x + 'px';
      piece.style.top = y + 'px';
      piece.style.setProperty('--tx', tx);
      piece.style.setProperty('--ty', ty);
      piece.style.setProperty('--tr', tr);
      piece.style.animation = 'burstFly .8s ease-out forwards';

      document.body.appendChild(piece);
      (function(p){
        setTimeout(function(){ p.remove(); }, 850);
      })(piece);
    }
  }

  document.querySelectorAll('.view-btn').forEach(function(btn){
    btn.addEventListener('click', function(e){
      burst(e.clientX, e.clientY);
    });
  });

  // little heart pop when a polaroid is clicked
  document.querySelectorAll('.polaroid').forEach(function(p){
    p.addEventListener('click', function(e){
      var heart = document.createElement('div');
      heart.textContent = '♡';
      heart.style.position = 'fixed';
      heart.style.left = e.clientX + 'px';
      heart.style.top = e.clientY + 'px';
      heart.style.color = '#FFE08A';
      heart.style.fontSize = '22px';
      heart.style.pointerEvents = 'none';
      heart.style.zIndex = 999;
      heart.style.animation = 'floatUpDown .9s ease-out forwards';
      heart.style.setProperty('--r','0deg');
      document.body.appendChild(heart);
      setTimeout(function(){ heart.remove(); }, 900);
    });
  });
})();
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