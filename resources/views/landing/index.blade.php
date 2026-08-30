<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alumnispace — Kawan Lama, Cerita Baru</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Nunito:wght@700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
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
    --hero-panel:#668BA2;
    --hero-effect:#14537B;
    --cream-text:#FFF7E1;
    --about-panel:#668BA2;
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
  section[id]{scroll-margin-top:130px;}
  
h1, h2, h3, .display {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-weight: 800;
  line-height: 1.2;
  margin: 0;
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

  /* SCROLL-REVEAL ANIMATIONS */
  @media (prefers-reduced-motion:no-preference){
    .reveal{
      opacity:0;
      transform:translateY(30px);
      transition:opacity .65s cubic-bezier(.2,.7,.3,1), transform .65s cubic-bezier(.2,.7,.3,1);
    }
    .reveal.in-view{opacity:1;transform:translateY(0);}
    .reveal-d1{transition-delay:.08s;}
    .reveal-d2{transition-delay:.16s;}
    .reveal-d3{transition-delay:.24s;}
    .reveal-d4{transition-delay:.32s;}
    .reveal-pop{transform:translateY(30px) scale(.92);}
    .reveal-pop.in-view{transform:translateY(0) scale(1);}
  }

  .site-nav{
    position:sticky;top:0;z-index:1000;
    background:var(--paper);
    border-bottom:4px solid var(--ink);
    transition:box-shadow .25s ease;
  }
  .site-nav.scrolled{
    box-shadow:0 4px 0 rgba(46,58,89,.06), 0 14px 26px -8px rgba(46,58,89,.28);
  }
  .nav-inner{
    max-width:1240px;margin:0 auto;
    display:flex;align-items:center;justify-content:space-between;
    padding:13px 24px;gap:18px;
  }
  .nav-logo{
    display:flex;align-items:center;gap:10px;
    font-family:'Baloo 2',sans-serif;font-weight:800;font-size:18px;
    flex-shrink:0;
  }
  .nav-logo-badge{
    width:36px;height:36px;border-radius:12px;
    background:var(--sunwashed);
    border:3px solid var(--ink);
    display:flex;align-items:center;justify-content:center;
    font-size:17px;
    transform:rotate(-6deg);
  }
  .nav-menu{display:flex;align-items:center;gap:4px;}
  .nav-item{
    display:flex;align-items:center;gap:6px;
    font-family:'Baloo 2',sans-serif;font-weight:700;font-size:14px;
    padding:9px 16px;border-radius:999px;
    border:2.5px solid transparent;
    color:var(--ink-soft);
    transition:all .18s ease;
    white-space:nowrap;
  }
  .nav-item-emoji{font-size:15px;}
  .nav-item:hover{color:var(--ink);background:var(--sky-tint);}
  .nav-item.active{
    background:var(--morning-breeze);
    color:var(--paper);
    border-color:var(--ink);
    box-shadow:3px 3px 0 var(--ink);
    transform:translateY(-2px);
  }
  .nav-actions{display:flex;align-items:center;gap:10px;flex-shrink:0;}
  .nav-login{white-space:nowrap;}
  .nav-burger{
    display:none;
    width:42px;height:42px;
    background:var(--paper);
    border:3px solid var(--ink);border-radius:12px;
    box-shadow:3px 3px 0 var(--ink);
    align-items:center;justify-content:center;
    flex-direction:column;gap:4px;
    cursor:pointer;
  }
  .nav-burger span{display:block;width:18px;height:2.5px;background:var(--ink);border-radius:2px;transition:all .2s ease;}
  .nav-burger.open span:nth-child(1){transform:translateY(6.5px) rotate(45deg);}
  .nav-burger.open span:nth-child(2){opacity:0;}
  .nav-burger.open span:nth-child(3){transform:translateY(-6.5px) rotate(-45deg);}

  .nav-mobile-panel{
    display:none;
    flex-direction:column;gap:8px;
    padding:14px 24px 22px;
    background:var(--paper);
    border-top:3px dashed var(--ink);
  }
  .nav-mobile-panel.open{display:flex;}
  .nav-mobile-panel .nav-item{width:100%;}
  .nav-mobile-panel .nav-item.active{transform:none;}
  .nav-login-mobile{width:100%;justify-content:center;margin-top:6px;}

  @media(max-width:900px){
    .nav-menu, .nav-actions .nav-login{display:none;}
    .nav-burger{display:flex;}
  }

/* ============================= */
  /* HERO — Buku Kenangan Baru      */
  /* ============================= */
.hero {
    position: relative;
    overflow: hidden;
    isolation: isolate;
    background: var(--hero-panel); /* Ini jadi background bagian kanan */
    min-height: 620px;
    display: grid;
    grid-template-columns: 1fr 1fr; /* Membagi layar jadi 2 kolom sama besar (50% - 50%) */
    align-items: center;
  }
.hero .wrap {
    position: absolute;
    inset: 0;
    z-index: 2;
    display: flex;
    align-items: center;
    padding: 96px 24px 110px;
  }
  @media (max-width:960px){
    .hero .wrap{grid-template-columns:1fr;}
  }

  /* Left striped backdrop — "ditarik" naik dari bawah, seperti halaman baru muncul */
.hero-bg-left{
    position: absolute;
    inset: 0 auto 0 0;
    width: 100%; /* Pas setengah layar (50% dari total lebar) */
    height: 100%;
    background-image: url('{{ asset('assets/anggi/bgkirihero.png') }}');
    background-repeat: no-repeat; /* Jangan diulang biar gak ada garis putih */
    background-position: right top; /* Nempel pas di batas tengah kanan */
    background-size: 100% 100%; /* Membentang penuh di area 50% itu */
    z-index: 1;
    transform: translateY(115%);
    animation: heroBgRise 1.05s cubic-bezier(.16,.86,.24,1) .05s forwards;
  }
  @keyframes heroBgRise{
    to{transform:translateY(0);}
  }
  @media (prefers-reduced-motion:reduce){
    .hero-bg-left{transform:translateY(0);animation:none;}
  }
  @media (max-width:900px){
    .hero-bg-left{width:100%;}
  }

  .hero-copy{position:relative;max-width:620px;}

  /* Visual kanan — mesin ketik & tumpukan foto kenangan */
  .hero-visual{
    position:relative;
    width:100%;
    max-width:560px;
    height:560px;
    margin:0 auto;
    justify-self:end;
  }
  @media (max-width:960px){
    .hero-visual{justify-self:center;margin-top:36px;height:480px;}
  }
  .hero-visual img{position:absolute;display:block;max-width:none;}

  .hv-base{
    width: 190%;
    right:-80%;
    top:0;
    height:auto;
    z-index:2;
    filter:drop-shadow(10px 16px 0 rgba(20,83,123,.16));
    opacity:0;
    animation:hvBaseIn .65s cubic-bezier(.22,.9,.28,1) .5s forwards, hvBaseFloat 6s ease-in-out 1.2s infinite;
  }
  @keyframes hvBaseIn{
    from{opacity:0;transform:translateY(26px) scale(.96);}
    to{opacity:1;transform:translateY(0) scale(1);}
  }
  @keyframes hvBaseFloat{
    0%,100%{transform:translateY(0);}
    50%{transform:translateY(-10px);}
  }

  .hv-photo{
    height:auto;
    cursor:pointer;
    transition:transform .3s cubic-bezier(.2,.8,.3,1), filter .3s ease;
    filter:drop-shadow(5px 8px 0 rgba(20,83,123,.24));
  }

  .hv-photo-1{
    width: 44%;
    right: 3%;
    top:8%;
    z-index:3;
    opacity:0;
    animation:hvPop1 .55s cubic-bezier(.34,1.56,.64,1) .85s forwards, hvFloat1 4.5s ease-in-out 1.4s infinite;
  }
  .hv-photo-1:hover{
    transform:translateY(-14px) scale(1.06) rotate(-5deg) !important;
    z-index:10 !important;
    filter:drop-shadow(9px 16px 0 rgba(20,83,123,.3));
  }
  @keyframes hvPop1{
    0%{opacity:0;transform:scale(.5) rotate(-6deg) translateY(26px);}
    65%{opacity:1;}
    100%{opacity:1;transform:scale(1) rotate(-5deg) translateY(0);}
  }
  @keyframes hvFloat1{
    0%,100%{transform:scale(1) rotate(-5deg) translateY(0);}
    50%{transform:scale(1) rotate(-6.5deg) translateY(-12px);}
  }

  .hv-photo-2{
    width:44%;
    right:-3%;
    top:50%;
    z-index:4;
    opacity:0;
    animation:hvPop2 .55s cubic-bezier(.34,1.56,.64,1) 1.05s forwards, hvFloat2 5s ease-in-out 1.6s infinite;
  }
  .hv-photo-2:hover{
    transform:translateY(-14px) scale(1.06) rotate(-2deg) !important;
    z-index:10 !important;
    filter:drop-shadow(9px 16px 0 rgba(20,83,123,.3));
  }
  @keyframes hvPop2{
    0%{opacity:0;transform:scale(.5) rotate(-14deg) translateY(26px);}
    65%{opacity:1;}
    100%{opacity:1;transform:scale(1) rotate(-2deg) translateY(0);}
  }
  @keyframes hvFloat2{
    0%,100%{transform:scale(1) rotate(-2deg) translateY(0);}
    50%{transform:scale(1) rotate(-.5deg) translateY(-10px);}
  }
  @media (prefers-reduced-motion:reduce){
    .hv-base, .hv-photo-1, .hv-photo-2{opacity:1;animation:none;transform:none;}
  }

  /* Kaca Pembesar — Di-flip horizontal dan diatur posisinya di atas foto */
  .hv-magnifier{
    position: absolute;
    width: 70%;
    right: -50%;
    top: 32%;
    z-index: 5;
transform: scaleY(-1) rotate(-35deg); /* Pakai scaleY(-1) buat balikin atas-bawahnya*/
    filter: drop-shadow(-8px 12px 0 rgba(20,83,123,.25));
    opacity: 0;
    animation: hvMagnifierIn .6s cubic-bezier(.34,1.56,.64,1) 1.25s forwards, hvMagnifierFloat 5.5s ease-in-out 1.9s infinite;
  }
  @keyframes hvMagnifierIn{
    0%{opacity:0;transform: scaleX(-1) rotate(45deg) scale(0.5) translateY(20px);}
    100%{opacity:1;transform: scaleX(-1) rotate(35deg) scale(1) translateY(0);}
  }
  @keyframes hvMagnifierFloat{
    0%,100%{transform:scaleY(-1) rotate(-35deg) translateY(0);}
    50%{transform:scaleY(-1) rotate(-33deg) translateY(-9px);}
  }

  /* Badge "Halo, Kawan Lama!" — gaya stempel jahit */
  .hero-eyebrow{
    position:relative;
    display:inline-block;
    font-family:'Chunk Five','Baloo 2',sans-serif;
    font-weight:400;
    font-size:15px;
    letter-spacing:.02em;
    color:var(--paper);
    background:var(--hero-effect);
    padding:10px 24px;
    border-radius:999px;
    border:2.5px solid var(--paper);
  }
  .hero-eyebrow::after{
    content:"";
    position:absolute;inset:3px;
    border:1.5px dashed rgba(255,255,255,.6);
    border-radius:999px;
    pointer-events:none;
  }

  /* Headline — font Chunk Five, krem dengan outline biru tua tebal */
  .hero-headline-2{
    margin-top:20px;
    font-family:'Chunk Five','Baloo 2',sans-serif;
    font-weight:400;
    font-size:clamp(34px,4.6vw,58px);
    line-height:1.18;
    letter-spacing:.01em;
  }
  .hero-headline-2 .h-line,
  .cream-outline-text{
    display:block;
    color:var(--cream-text);
    -webkit-text-stroke:4px var(--hero-effect);
    paint-order:stroke fill;
    text-shadow:6px 6px 0 var(--hero-effect);
  }
  .hero-headline-2 .accent-stamp{
    position:relative;
    display:inline-block;
    vertical-align:middle;
    font-family:'Chunk Five','Baloo 2',sans-serif;
    color:var(--hero-effect);
    -webkit-text-stroke:0;
    text-shadow:
      0 0 10px rgba(20,83,123,.45),
      0 0 20px rgba(20,83,123,.3);
    background:#F8EFA0;
    padding:6px 20px;
    border-radius:999px;
    border:2.5px solid var(--hero-effect);
    box-shadow:4px 4px 0 var(--hero-effect);
    transform:rotate(-1.5deg);
  }
  .hero-headline-2 .accent-stamp::after{
    content:"";
    position:absolute;inset:3px;
    border:1.5px dashed rgba(20,83,123,.6);
    border-radius:999px;
    pointer-events:none;
  }

  .hero-sub-2{
    margin-top:22px;
    font-family:'Chunk Five','Baloo 2',sans-serif;
    font-weight:400;
    font-size:17px;
    line-height:1.65;
    color:var(--hero-effect);
    max-width:46ch;
  }
  .hero-sub-2 mark{
    background:var(--sunwashed);
    color:var(--hero-effect);
    padding:1px 5px;
    border-radius:5px;
    box-decoration-break:clone;
    -webkit-box-decoration-break:clone;
  }

  .hero-cta-2{display:flex;flex-wrap:wrap;gap:16px;margin-top:34px;}

  .btn-stamp{
    position:relative;
    display:inline-flex;align-items:center;justify-content:center;
    font-family:'Chunk Five','Baloo 2',sans-serif;font-weight:400;font-size:16px;letter-spacing:.01em;
    padding:14px 28px;
    border-radius:999px;
    border:3px solid var(--paper);
    box-shadow:5px 5px 0 var(--hero-effect);
    cursor:pointer;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .btn-stamp::after{
    content:"";
    position:absolute;inset:4px;
    border:1.5px dashed rgba(255,255,255,.55);
    border-radius:999px;
    pointer-events:none;
  }
  .btn-stamp:hover{transform:translate(-2px,-2px);box-shadow:7px 7px 0 var(--hero-effect);}
  .btn-stamp:active{transform:translate(1px,1px);box-shadow:3px 3px 0 var(--hero-effect);}
  .btn-stamp-fill{background:var(--hero-effect);color:var(--paper);}
  .btn-stamp-outline{
    background:var(--paper);color:var(--hero-effect);
    border-color:var(--hero-effect);
    box-shadow:5px 5px 0 var(--hero-effect);
  }
  .btn-stamp-outline::after{border-color:rgba(20,83,123,.4);}

  /* ---- Animasi teks: Muncul (Fade) ---- */
  .reveal-fade{
    opacity:0;
    transform:translateY(16px);
    animation:heroFadeIn2 .7s ease-out forwards;
    animation-delay:var(--d,0s);
  }
  @keyframes heroFadeIn2{
    to{opacity:1;transform:translateY(0);}
  }

  /* ---- Animasi teks: Cetak Timbul (Baseline) — muncul seolah dicetak naik dari garis dasar ---- */
  .baseline-in{
    opacity:0;
    clip-path:inset(0 0 100% 0);
    transform:translateY(14px);
    animation:baselineReveal .75s cubic-bezier(.22,.9,.28,1) forwards;
    animation-delay:var(--d,0s);
  }
  @keyframes baselineReveal{
    0%{opacity:0;clip-path:inset(0 0 100% 0);transform:translateY(14px);}
    55%{opacity:1;}
    100%{opacity:1;clip-path:inset(0 0 0% 0);transform:translateY(0);}
  }
  @media (prefers-reduced-motion:reduce){
    .reveal-fade, .baseline-in{opacity:1;transform:none;clip-path:none;animation:none;}
  }

  @media (max-width:480px){
    .hero .wrap{padding:64px 20px 80px;}
  }
  .wave-outer{position:absolute;bottom:-1px;left:0;width:100%;height:42px;overflow:hidden;line-height:0;z-index:3;}
  .wave-divider{display:block;width:200%;height:42px;}
  @media (prefers-reduced-motion:no-preference){
    .wave-divider{animation:waveDrift 16s linear infinite;}
  }
  @keyframes waveDrift{from{transform:translateX(0);}to{transform:translateX(-50%);}}


  /* ============================= */
  /* ABOUT — Kalender & Kartu Kenangan */
  /* ============================= */
  .about{
    background:var(--about-panel);
    padding:100px 0 0;
    overflow:hidden;
    isolation:isolate;
  }
  .about .wrap{
    position:relative;
    z-index:2;
    display:grid;
    grid-template-columns:.9fr 1.1fr;
    gap:56px;
    align-items:center;
    padding-bottom:130px;
  }

  /* Garis background bawah (bg.about.png) */
  .about-bg-line{
    position:absolute;
    left:0;right:0;bottom:-2px;
    width:100%;
    height:auto;
    z-index:0;
    pointer-events:none;
    user-select:none;
  }

/* Kalender kiri (biar ukurannya besar pas) */
  .about-visual{position:relative;display:flex;justify-content:center;}
  .ab-calendar{
    width: 100%;
    max-width: 480px; /* Diperbesar dari sebelumnya */
    height: auto;
    display: block;
    filter: drop-shadow(12px 18px 0 rgba(20,83,123,.28));
  }
  @media (prefers-reduced-motion:no-preference){
    .ab-calendar{animation:abCalendarFloat 5.5s ease-in-out infinite;}
  }
  @keyframes abCalendarFloat{
    0%,100%{transform:translateY(0) rotate(-1.5deg);}
    50%{transform:translateY(-18px) rotate(.5deg);}
  }
  @media (prefers-reduced-motion:reduce){
    .ab-calendar{animation:none;}
  }

  /* Kartu teks kanan */
  .about-copy{position:relative;display:flex;flex-direction:column;align-items:flex-start;}
  .about-copy .hero-eyebrow{margin-bottom:20px;}

/* Card kanan biar teksnya tidak saling tumpuk */
  .ab-card {
    position: relative;
    width: 100%;
    max-width: 560px;
    background: var(--paper);
    border: 3px solid var(--ink);
    border-radius: var(--radius-lg);
    padding: 36px 32px;
    box-shadow: var(--shadow-chunky);
  }
 .ab-card-bg {
    display: none; /* Buang background gambar card lama yang bikin teks ketumpuk */
  }
.ab-card-inner {
    position: relative;
    inset: auto;
    display: flex;
    flex-direction: column;
    gap: 14px;
    padding: 0;
  }
  .about-title{
    font-family:'Chunk Five','Baloo 2',sans-serif;
    font-weight:400;
    font-size:clamp(22px,2.6vw,32px);
    line-height:1.28;
    letter-spacing:.01em;
  }
  .about-text{
    font-family:'Chunk Five','Baloo 2',sans-serif;
    font-weight:400;
    font-size:14.5px;
    line-height:1.6;
    color:var(--hero-effect);
    max-width:42ch;
  }

  .about-highlights{
    display:flex;flex-wrap:wrap;gap:10px;
    margin-top:26px;
  }
  .about-highlight{
    display:inline-flex;align-items:center;gap:8px;
    background:var(--paper);
    border:2.5px solid var(--ink);
    border-radius:999px;
    padding:8px 16px;
    font-family:'Baloo 2',sans-serif;font-weight:700;font-size:13px;
    box-shadow:3px 3px 0 var(--ink);
  }

  .section-title{font-size:clamp(28px,3.6vw,42px);margin-top:14px;}
  .section-text{margin-top:18px;font-size:17px;color:var(--ink-soft);font-weight:600;line-height:1.65;max-width:56ch;}

  /* MARQUEE STRIP */
.marquee-band {
  position: relative;
  width: 100vw;
  left: 50%;
  right: 50%;
  margin-left: -50vw;
  margin-right: -50vw;
  background: var(--ink);
  border-top: 3px dashed var(--sunwashed);
  border-bottom: 3px dashed var(--sunwashed);
  overflow: hidden;
  padding: 12px 0;
  box-shadow: 0 4px 0 rgba(0, 0, 0, 0.1);
  z-index:2;
}

.marquee-track {
  display: flex;
  width: max-content;
  will-change: transform;
}

.marquee-copy {
  display: flex;
  align-items: center;
  flex-shrink: 0;
}

.marquee-copy span {
  font-family: 'Baloo 2', sans-serif;
  font-weight: 700;
  font-size: 16px;
  color: var(--paper);
  white-space: nowrap;
  padding: 0 15px;
}

.marquee-copy .dot {
  color: var(--sunwashed);
  padding: 0 10px;
}

@media (prefers-reduced-motion: no-preference) {
  .marquee-track {
    animation: marqueeScroll 22s linear infinite;
  }
}

@media (prefers-reduced-motion: reduce) {
  .marquee-track {
    animation: none;
  }
  .marquee-copy:nth-child(2) {
    display: none;
  }
}

@keyframes marqueeScroll {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-50%);
  }
}

  /* COUNT */
  .count{
    background:var(--morning-breeze);
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
    transition:transform .2s ease;
  }
  .count-card:hover{transform:translateY(-6px) !important;}
  .count-card:nth-child(2){transform:rotate(-2deg);background:var(--sky-tint);}
  .count-card:nth-child(3){transform:rotate(2deg);background:var(--sky-tint-2);}
  .count-card:nth-child(4){transform:rotate(-1deg);}
  .count-card .emoji{font-size:32px;}
  .count-card .num{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:34px;margin-top:8px;}
  .count-card .label{font-weight:700;font-size:14px;color:var(--ink-soft);margin-top:4px;}

  /* GALLERY */
  .gallery{background:var(--sky-tint);padding:90px 0;}
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
    transition:transform .2s ease;
  }
  .g-slot:nth-child(1){transform:rotate(-3deg);}
  .g-slot:nth-child(2){transform:rotate(2deg);}
  .g-slot:nth-child(3){transform:rotate(-1deg);}
  .g-slot:hover{transform:scale(1.03) !important;}
  .g-photo-area{
    height:190px;
    border-radius:12px;
    background:repeating-linear-gradient(135deg, var(--sky-tint), var(--sky-tint) 12px, var(--dewy-blue) 12px, var(--dewy-blue) 24px);
    border:3px solid var(--ink);
    display:flex;align-items:center;justify-content:center;
    flex-direction:column;gap:6px;
    color:var(--ink);
  }
  .g-photo-area .cam{font-size:30px;}
  .g-photo-area small{font-family:'Baloo 2',sans-serif;font-weight:700;font-size:12px;}
  .g-cap{font-family:'Baloo 2',sans-serif;font-weight:700;margin-top:14px;font-size:16px;}

  /* TESTIMONI */
  .testi{background:var(--paper);padding:90px 0;border-top:4px solid var(--ink);}
  .testi-grid{
    margin-top:52px;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:30px;
  }
  .testi-card{
    background:var(--dewy-blue);
    border:3px solid var(--ink);
    border-radius:var(--radius-lg);
    padding:30px;
    position:relative;
    box-shadow:var(--shadow-chunky-sm);
    transition:transform .2s ease;
  }
  .testi-card:hover{transform:translateY(-5px);}
  .testi-card:nth-child(2){background:var(--sky-tint-2);}
  .testi-quote{font-size:16.5px;font-weight:700;line-height:1.6;}
  .testi-quote::before{content:"\201C";font-family:'Baloo 2',sans-serif;}
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
  .artikel{background:var(--sky-tint-2);padding:90px 0;border-top:4px solid var(--ink);}
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
    transition:transform .3s ease;
  }
  .art-card:hover .art-thumb{transform:scale(1.08);}
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

  /* FOOTER LANDING PAGE */
  footer{
    background:var(--ink);
    color:var(--paper);
    padding:50px 0 26px;
  }
  .footer-top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:20px;}
  .footer-brand{font-family:'Baloo 2',sans-serif;font-weight:800;font-size:22px;}
  .footer-links{display:flex;gap:22px;flex-wrap:wrap;font-weight:700;}
  .footer-links a{transition:color .15s ease;}
  .footer-links a:hover{color:var(--sunwashed);}
  .footer-bottom{
    margin-top:34px;padding-top:22px;
    border-top:2px solid rgba(255,255,255,.2);
    font-size:13px;color:rgba(255,255,255,.7);
    display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;
  }

  /* RESPONSIVE */
  @media (max-width:960px){
    .about .wrap{grid-template-columns:1fr;padding-bottom:100px;}
    .about-copy{align-items:center;text-align:center;}
    .count-grid{grid-template-columns:repeat(2,1fr);}
    .gallery-grid{grid-template-columns:repeat(2,1fr);}
    .testi-grid{grid-template-columns:1fr;}
    .art-grid{grid-template-columns:repeat(2,1fr);}
  }
  @media (max-width:720px){
    .count-grid{grid-template-columns:repeat(2,1fr);}
    .gallery-grid{grid-template-columns:1fr;}
    .art-grid{grid-template-columns:1fr;}
  }
  @media (max-width:480px){
    .count-grid{grid-template-columns:1fr 1fr;gap:16px;}
    .hero{padding:44px 0 80px;}
    .about,.gallery,.testi,.artikel{padding:64px 0;}
    .about .wrap{padding-bottom:80px;}
  }
</style>
</head>
<body>

<!-- NAVBAR -->
<header class="site-nav" id="siteNav">
  <div class="nav-inner">
    <a href="#beranda" class="nav-logo">
      <span class="nav-logo-badge">✨</span>
      <span>Antares</span>
    </a>

    <nav class="nav-menu">
      <a href="#beranda" data-target="beranda" class="nav-item active"><span class="nav-item-emoji">🏠</span>Beranda</a>
      <a href="#about" data-target="about" class="nav-item"><span class="nav-item-emoji">📖</span>Tentang</a>
      <a href="#count" data-target="count" class="nav-item"><span class="nav-item-emoji">🚀</span>Angka</a>
      <a href="#gallery" data-target="gallery" class="nav-item"><span class="nav-item-emoji">🖼️</span>Galeri</a>
      <a href="#testi" data-target="testi" class="nav-item"><span class="nav-item-emoji">💬</span>Testimoni</a>
      <a href="#artikel" data-target="artikel" class="nav-item"><span class="nav-item-emoji">✍️</span>Artikel</a>
    </nav>

    <div class="nav-actions">
      <a href="/login" class="btn btn-primary btn-sm nav-login">Masuk 🔑</a>
      <button class="nav-burger" id="navBurger" aria-label="Buka menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>

  <div class="nav-mobile-panel" id="navMobilePanel">
    <a href="#beranda" data-target="beranda" class="nav-item active"><span class="nav-item-emoji">🏠</span>Beranda</a>
    <a href="#about" data-target="about" class="nav-item"><span class="nav-item-emoji">📖</span>Tentang</a>
    <a href="#count" data-target="count" class="nav-item"><span class="nav-item-emoji">🚀</span>Angka</a>
    <a href="#gallery" data-target="gallery" class="nav-item"><span class="nav-item-emoji">🖼️</span>Galeri</a>
    <a href="#testi" data-target="testi" class="nav-item"><span class="nav-item-emoji">💬</span>Testimoni</a>
    <a href="#artikel" data-target="artikel" class="nav-item"><span class="nav-item-emoji">✍️</span>Artikel</a>
    <a href="/login" class="btn btn-primary nav-login-mobile">Masuk 🔑</a>
  </div>
</header>

<!-- HERO -->
<section class="hero" id="beranda">

  <div class="hero-bg-left" aria-hidden="true"></div>

  <div class="wrap">
    <div class="hero-copy">
      <span class="hero-eyebrow reveal-fade" style="--d:.1s">Halo, Kawan Lama!</span>
      <h1 class="hero-headline-2">
        <span class="h-line baseline-in" style="--d:.35s">Siap Bernostalgia</span>
        <span class="h-line baseline-in" style="--d:.55s">dan <span class="accent-stamp">Cerita Baru</span></span>
        <span class="h-line baseline-in" style="--d:.75s">Lagi?</span>
      </h1>
      <p class="hero-sub-2 reveal-fade" style="--d:1s"><mark>Selamat datang di markas digital kita tercinta!</mark> Tempat paling pas buat temu kangen, intip kabar terbaru <mark>teman seangkatan</mark>, dan saling <mark>dukung buat melangkah lebih jauh.</mark></p>
      <div class="hero-cta-2 reveal-fade" style="--d:1.2s">
        <a href="/login" class="btn-stamp btn-stamp-fill">Masuk Ke Akun Yuk!</a>
        <a href="#daftar" class="btn-stamp btn-stamp-outline">Daftar / Verifikasi Data</a>
      </div>
    </div>

<div class="hero-visual">
      <img class="hv-base" src="{{ asset('assets/anggi/polaroid.png') }}" alt="Mesin ketik dan tumpukan foto kenangan">
      <img class="hv-photo hv-photo-1" src="{{ asset('assets/anggi/siswa.png') }}" alt="Foto kenangan alumni 1">
      <img class="hv-photo hv-photo-2" src="{{ asset('assets/anggi/siswa2.png') }}" alt="Foto kenangan alumni 2">
      <!-- Elemen Kaca Pembesar yang sudah di-flip -->
    <img src="{{ asset('assets/images/kaca-pembesar.png') }}" alt="Kaca Pembesar" class="hv-magnifier">
      <img class="hv-magnifier" src="{{ asset('assets/images/kaca-pembesar.png') }}" alt="Kaca Pembesar">
    </div>
  </div>

  <div class="wave-outer">
    <svg class="wave-divider" viewBox="0 0 2880 80" preserveAspectRatio="none">
      <path d="M0,40 C240,90 480,0 720,30 C960,60 1200,10 1440,40 C1680,90 1920,0 2160,30 C2400,60 2640,10 2880,40 L2880,80 L0,80 Z" fill="#FFFDF7"/>
    </svg>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">

  <div class="wrap">
    <div class="about-visual">
      <img class="ab-calendar" src="{{ asset('assets/anggi/calendar.png') }}" alt="Kalender kenangan alumni" data-aos="fade-left" data-aos-delay="300" data-aos-duration="800">
    </div>

    <div class="about-copy" data-aos="fade-up">
      <span class="hero-eyebrow" data-aos="fade-up" data-aos-delay="100">Kenalin Dulu, Nih...</span>

      <div class="ab-card" data-aos="fade-left" data-aos-delay="150" data-aos-duration="800">
        <img class="ab-card-bg" src="{{ asset('assets/anggi/cardabout.png') }}" alt="" aria-hidden="true">
        <div class="ab-card-inner">
          <h2 class="about-title cream-outline-text" data-aos="fade-up" data-aos-delay="100">Bukan Sekadar Grup, Ini Keluarga Kedua Kita!</h2>
          <p class="about-text" data-aos="fade-up" data-aos-delay="300">Website ini dibuat khusus buat kita semua yang rindu masa-masa sekolah/kuliah dulu. Dari yang awalnya cuma mau nanya "Eh, sekarang sibuk apa?", sampai bisa kolaborasi bareng bikin project keren. Yuk, bikin jejaring silaturahmi kita makin erat dan seru di sini!</p>
        </div>
      </div>
    </div>
  </div>

  <img class="about-bg-line" src="{{ asset('assets/anggi/bg.about.png') }}" alt="" aria-hidden="true">

  <div class="marquee-band">
    <div class="marquee-track">
      <div class="marquee-copy">
        <span>Tidak Ada Kenangan Yang Lebih Indah Dari Masa-Masa Sekolah <span class="dot">•</span> Tiada Hari Tanpa Canda, Tawa, Sedih <span class="dot">•</span> Tidak Ada Kenangan Yang Lebih Indah Dari Masa-Masa Sekolah <span class="dot">•</span> Tiada Hari Tanpa Canda, Tawa, Sedih <span class="dot">•</span> Tidak Ada Kenangan Yang Lebih Indah Dari Masa-Masa Sekolah <span class="dot">•</span> Tiada Hari Tanpa Canda, Tawa, Sedih <span class="dot">•</span></span>
      </div>
      <div class="marquee-copy" aria-hidden="true">
        <span>Tidak Ada Kenangan Yang Lebih Indah Dari Masa-Masa Sekolah <span class="dot">•</span> Tiada Hari Tanpa Canda, Tawa, Sedih <span class="dot">•</span> Tidak Ada Kenangan Yang Lebih Indah Dari Masa-Masa Sekolah <span class="dot">•</span> Tiada Hari Tanpa Canda, Tawa, Sedih <span class="dot">•</span> Tidak Ada Kenangan Yang Lebih Indah Dari Masa-Masa Sekolah <span class="dot">•</span> Tiada Hari Tanpa Canda, Tawa, Sedih <span class="dot">•</span></span>
      </div>
    </div>
  </div>
</section>

<!-- COUNT -->
<section class="count" id="count">
  <div class="wrap">
    <div class="count-grid">
      <div class="count-card reveal reveal-pop">
        <div class="emoji">🎉</div>
        <div class="num">5.000+</div>
        <div class="label">Alumni Hebat Terdaftar</div>
      </div>
      <div class="count-card reveal reveal-pop reveal-d1">
        <div class="emoji">🤝</div>
        <div class="num">25+</div>
        <div class="label">Angkatan Seru Bergabung</div>
      </div>
      <div class="count-card reveal reveal-pop reveal-d2">
        <div class="emoji">💼</div>
        <div class="num">150+</div>
        <div class="label">Perusahaan Partner Loker</div>
      </div>
      <div class="count-card reveal reveal-pop reveal-d3">
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
    <div class="center-head reveal">
      <span class="eyebrow">📸 Abadikan Momen</span>
      <h2 class="section-title">Senyum, Tawa, dan Kenangan Kita!</h2>
      <p class="section-text" style="margin-left:auto;margin-right:auto;">Yuk, intip lagi momen-momen pecah dari berbagai reuni, pameran, sampai keseruan kumpul spontan kita. Dijamin bikin senyum-senyum sendiri!</p>
    </div>

    <div class="gallery-grid">
      <div class="g-slot reveal">
        <div class="g-photo-area">
          <span class="cam">🖼️</span>
          <small>TARUH FOTOMU DI SINI</small>
        </div>
        <div class="g-cap">Reuni Akbar Paling Pecah</div>
      </div>
      <div class="g-slot reveal reveal-d1">
        <div class="g-photo-area">
          <span class="cam">🖼️</span>
          <small>TARUH FOTOMU DI SINI</small>
        </div>
        <div class="g-cap">Aksi Donor Darah Alumni</div>
      </div>
      <div class="g-slot reveal reveal-d2">
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
<section class="testi" id="testi">
  <div class="wrap">
    <div class="center-head reveal">
      <span class="eyebrow">⭐ Cerita Seru Mereka</span>
      <h2 class="section-title">Kata Teman-Teman yang Udah Ngerasain Manfaatnya!</h2>
    </div>

    <div class="testi-grid">
      <div class="testi-card reveal">
        <p class="testi-quote">Sumpah ngebantu banget! Lewat web ini akhirnya bisa kontakan lagi sama geng sekelas dulu. Malah kemarin sempat nongkrong bareng lagi. Asyik banget!</p>
        <div class="testi-person">
          <div class="avatar">R</div>
          <div>
            <div class="name">Rian</div>
            <div class="angkatan">Angkatan 2018</div>
          </div>
        </div>
      </div>
      <div class="testi-card reveal reveal-d1">
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
<section class="artikel" id="artikel">
  <div class="wrap">
    <div class="center-head reveal">
      <span class="eyebrow">📰 Bacaan Asyik</span>
      <h2 class="section-title">Kabar Seru & Tips Keren Buat Kamu ✨</h2>
      <p class="section-text" style="margin-left:auto;margin-right:auto;">Update terus info terbaru seputar dunia kerja, kisah sukses alumni, dan cerita seru lainnya.</p>
    </div>

    <div class="art-grid">
      <a href="#" class="art-card reveal">
        <div class="art-thumb">💼</div>
        <div class="art-body">
          <span class="art-tag">KARIR</span>
          <div class="art-title">Tips Gampang Tembus Dunia Kerja Kekinian ala Alumni Senior!</div>
          <p class="art-excerpt">Mau tahu rahasia lolos interview kerja di perusahaan impian? Intip tips dari kakak tingkatmu di sini...</p>
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
        <a href="#beranda">Beranda</a>
        <a href="#about">Tentang</a>
        <a href="#gallery">Galeri</a>
        <a href="#testi">Testimoni</a>
      </div>
    </div>
    <div class="footer-bottom">
      <div>&copy; 2026 Antares Alumni Club. All rights reserved.</div>
      <div>Kawan Lama, Cerita Baru 💛</div>
    </div>
  </div>
</footer>

<!-- LIBRARY AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- JAVASCRIPT -->
<script>
  // --- Inisialisasi AOS (animasi on-scroll) ---
  AOS.init({
    duration: 700,
    easing: 'ease-out-cubic',
    once: true,
    offset: 60
  });

  // --- Navbar: shadow pas discroll ---
  const siteNav = document.getElementById('siteNav');
  window.addEventListener('scroll', () => {
    siteNav.classList.toggle('scrolled', window.scrollY > 8);
  }, { passive: true });

  // --- Navbar: toggle menu mobile ---
  const navBurger = document.getElementById('navBurger');
  const navMobilePanel = document.getElementById('navMobilePanel');
  navBurger.addEventListener('click', () => {
    navBurger.classList.toggle('open');
    navMobilePanel.classList.toggle('open');
  });

  // --- Scrollspy: highlight nav item (desktop + mobile) sesuai section yang lagi keliatan ---
  const navItems = document.querySelectorAll('.nav-item');
  const uniqueTargets = [...new Set(Array.from(navItems).map(item => item.dataset.target))];
  const sections = uniqueTargets.map(id => document.getElementById(id)).filter(Boolean);

  const spyObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.id;
        navItems.forEach(item => {
          item.classList.toggle('active', item.dataset.target === id);
        });
      }
    });
  }, { rootMargin: '-45% 0px -45% 0px', threshold: 0 });

  sections.forEach(sec => spyObserver.observe(sec));

  // Tutup panel mobile pas salah satu link diklik
  navMobilePanel.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navBurger.classList.remove('open');
      navMobilePanel.classList.remove('open');
    });
  });

  // --- Scroll-reveal: fade/slide-in tiap elemen pas masuk viewport (section lain selain About) ---
  const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
  if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });

    revealEls.forEach(el => revealObserver.observe(el));
  } else {
    revealEls.forEach(el => el.classList.add('in-view'));
  }
</script>

</body>
</html>