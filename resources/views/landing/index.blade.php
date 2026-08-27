<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Antares Alumni Club — Kawan Lama, Cerita Baru</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
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
    .about-sticker-1{animation:float 4.5s ease-in-out infinite;}
    .about-sticker-2{animation:float 5.5s ease-in-out infinite;--r:-6deg;animation-delay:.4s;}
  }

  /* HERO-SPECIFIC ENTRANCE + AMBIENT ANIMATIONS */
  @media (prefers-reduced-motion:no-preference){
    .hero-in, .hero-pop, .hero-in-fade, .hero-visual-in{opacity:0;}
    .hero-in{transform:translateY(24px);display:inline-block;}
    .hero-pop{display:inline-block;transform:scale(.5) rotate(-8deg);}
    .hero-visual-in{transform:translateX(70px);}

    .hero-in{animation:heroFadeUp .6s cubic-bezier(.2,.8,.3,1) both;}
    .hero-in-fade{animation:heroFadeIn .7s ease-out both;}
    .hero-pop{animation:heroPopScale .65s cubic-bezier(.34,1.56,.64,1) both;}
    .hero-visual-in{animation:heroSlideInRight .8s cubic-bezier(.16,.84,.44,1) both;}

    .hero-in-1{animation-delay:.10s;}
    .hero-in-2{animation-delay:.26s;}
    .hero-in-3{animation-delay:.32s;}
    .hero-in-4{animation-delay:.38s;}
    .hero-in-5{animation-delay:.44s;}
    .hero-in-6{animation-delay:.50s;}
    .hero-in-7{animation-delay:.66s;}
    .hero-in-8{animation-delay:.72s;}
    .hero-in-9{animation-delay:.90s;}
    .hero-in-10{animation-delay:1.05s;}
    .hero-visual-in{animation-delay:.45s;}

    .rocket-emoji{
      display:inline-block;
      width:58px;height:58px;object-fit:contain;
      vertical-align:-16px;
      animation: heroFadeUp .5s ease-out .72s both, rocketFloatRotate 2.6s ease-in-out 1.3s infinite;
    }
    .badge-float{animation: heroFadeIn .5s ease-out .95s both, float 5s ease-in-out 1.4s infinite;}
    .polaroid-float{animation: gentleFloatRotate 5s ease-in-out infinite;}
    .love-pulse{display:inline-block;animation: pulseHeart 1.8s ease-in-out infinite;}
    .twinkle{animation: twinkleFade 2.6s ease-in-out infinite;}
    .twinkle-b{animation-delay:.9s;}
    .swing-float{animation: swingFloat 4.5s ease-in-out infinite;}
    /* Animasi background hero sudah dihapus agar BG diam */
  }

  @keyframes heroFadeUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}
  @keyframes heroFadeIn{from{opacity:0;}to{opacity:1;}}
  @keyframes heroPopScale{0%{opacity:0;transform:scale(.5) rotate(-8deg);}60%{opacity:1;transform:scale(1.1) rotate(3deg);}100%{opacity:1;transform:scale(1) rotate(0deg);}}
  @keyframes heroSlideInRight{from{opacity:0;transform:translateX(70px);}to{opacity:1;transform:translateX(0);}}
  @keyframes rocketFloatRotate{0%,100%{transform:translateY(0) rotate(-10deg);}50%{transform:translateY(-8px) rotate(10deg);}}
  @keyframes gentleFloatRotate{0%,100%{transform:translateY(0) rotate(-4deg);}50%{transform:translateY(-14px) rotate(-4deg);}}
  @keyframes pulseHeart{0%,100%{transform:scale(1);}50%{transform:scale(1.3);}}
  @keyframes twinkleFade{0%,100%{opacity:.45;transform:scale(.85);}50%{opacity:1;transform:scale(1.15);}}
  @keyframes swingFloat{0%,100%{transform:translateY(0) rotate(-10deg);}50%{transform:translateY(-10px) rotate(12deg);}}

  /* NAVBAR — Sticker Tab Bar */
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

  /* HERO */
  .hero{
    padding:64px 0 110px;
    background-color:var(--dewy-blue);
    background-image:
      radial-gradient(circle, var(--sunwashed) 0, transparent 30%),
      radial-gradient(circle, var(--buttercup) 0, transparent 24%),
      radial-gradient(circle, var(--morning-breeze) 0, transparent 60%);
    background-repeat:no-repeat;
    background-size:200% 200%;
    background-position:88% 10%, 8% 85%, 45% -10%;
    position:relative;
    overflow:hidden;
    /* Background diam, animasi digeser ke wave-divider di bawah */
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
  .hero-headline .accent{
    color: var(--coral);
    background: var(--paper);
    padding: 0 8px;
    border-radius: 8px;
    border: 2px solid var(--ink);
    display: inline-block;
    box-shadow: 2px 2px 0 var(--ink);
  }
  .hero-sub{
    margin-top:18px;
    font-size:18px;
    color:var(--ink-soft);
    font-weight:600;
    max-width:46ch;
  }
  .hero-cta{display:flex;flex-wrap:wrap;gap:14px;margin-top:30px;}

  .hero-visual{position:relative;height:460px;margin-top:20px;}
  .polaroid{
    position:absolute;
    background:var(--paper);
    border:4px solid var(--ink);
    border-radius:16px;
    padding:14px 14px 44px;
    box-shadow:10px 10px 0 var(--ink);
    width:88%;
    left:6%;
    top:38px;
    transform:rotate(-4deg);
  }
  .polaroid img{border-radius:8px;width:100%;height:280px;object-fit:cover;background:var(--sky-tint-2);}
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
    top: 4px;
    right: 12px;
    z-index: 10;
    background:var(--dewy-blue);
    border:3px solid var(--ink);
    border-radius:16px;
    padding:10px 16px;
    font-family:'Baloo 2',sans-serif;font-weight:700;font-size:14px;
    box-shadow:var(--shadow-chunky-sm);
  }

  .wave-outer{position:absolute;bottom:-1px;left:0;width:100%;height:42px;overflow:hidden;line-height:0;}
  .wave-divider{display:block;width:200%;height:42px;}
  @media (prefers-reduced-motion:no-preference){
    .wave-divider{animation:waveDrift 16s linear infinite;}
  }
  @keyframes waveDrift{from{transform:translateX(0);}to{transform:translateX(-50%);}}

  /* HERO AUDIO PLAYER */
  .hero-audio-player{
    position:absolute;
    right:-14px;
    bottom:22px;
    z-index:12;
    display:flex;align-items:center;gap:14px;
    background:var(--ink);
    border:3px solid var(--paper);
    border-radius:999px;
    padding:8px 22px 8px 8px;
    box-shadow:var(--shadow-chunky-sm);
  }
  .audio-toggle{
    width:42px;height:42px;flex-shrink:0;
    border-radius:50%;
    background:var(--sunwashed);
    border:2.5px solid var(--paper);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;
    transition:transform .15s ease;
  }
  .audio-toggle:hover{transform:scale(1.08);}
  .audio-toggle svg{width:16px;height:16px;fill:var(--ink);}
  .audio-toggle .icon-pause{display:none;}
  .hero-audio-player.playing .icon-play{display:none;}
  .hero-audio-player.playing .icon-pause{display:block;}
  .audio-bars{display:flex;align-items:center;gap:3.5px;height:22px;}
  .audio-bars span{width:3.5px;border-radius:3px;background:var(--paper);opacity:.9;}
  @media (prefers-reduced-motion:no-preference){
    .hero-audio-player.playing .audio-bars span{animation:audioBar 1s ease-in-out infinite;}
    .hero-audio-player.playing .audio-bars span:nth-child(odd){animation-direction:alternate-reverse;}
    .hero-audio-player.playing .audio-bars span:nth-child(1){animation-delay:0s;}
    .hero-audio-player.playing .audio-bars span:nth-child(2){animation-delay:.08s;}
    .hero-audio-player.playing .audio-bars span:nth-child(3){animation-delay:.16s;}
    .hero-audio-player.playing .audio-bars span:nth-child(4){animation-delay:.24s;}
    .hero-audio-player.playing .audio-bars span:nth-child(5){animation-delay:.32s;}
    .hero-audio-player.playing .audio-bars span:nth-child(6){animation-delay:.40s;}
    .hero-audio-player.playing .audio-bars span:nth-child(7){animation-delay:.48s;}
    .hero-audio-player.playing .audio-bars span:nth-child(8){animation-delay:.56s;}
    .hero-audio-player.playing .audio-bars span:nth-child(9){animation-delay:.64s;}
  }
  @keyframes audioBar{0%,100%{height:6px;}50%{height:22px;}}

  /* ABOUT */
  .about{
    background:linear-gradient(180deg, var(--paper) 0%, var(--paper) 7%, var(--sky-tint) 22%, var(--dewy-blue) 55%, var(--morning-breeze) 100%);
    padding:90px 0 0;
    overflow:hidden;
  }
  .about-dots{
    position:absolute;inset:0;
    background-image:radial-gradient(var(--ink) 1.5px, transparent 1.5px);
    background-size:26px 26px;
    opacity:.06;
    pointer-events:none;
  }
  .about .wrap{position:relative;display:grid;grid-template-columns:.85fr 1.15fr;gap:56px;align-items:center;padding-bottom:70px;}
  .about-visual{position:relative;}
  .about-frame-backdrop{
    position:absolute;
    inset:0;
    background:var(--sunwashed);
    border:4px solid var(--ink);
    border-radius:var(--radius-lg);
    transform:rotate(-8deg);
    z-index:0;
  }
  .about-frame{
    position:relative;
    z-index:1;
    border:4px solid var(--ink);
    border-radius:var(--radius-lg);
    background:repeating-linear-gradient(135deg, var(--dewy-blue) 0 12px, var(--sky-tint-2) 12px 24px);
    padding:22px;
    box-shadow:var(--shadow-chunky);
    transform:rotate(2deg);
  }
  .about-frame-tape{
    position:absolute;
    top:-14px;left:50%;
    transform:translateX(-50%) rotate(-4deg);
    width:92px;height:28px;
    background:rgba(255,148,102,.9);
    border:2px solid var(--ink);
    border-radius:3px;
    z-index:2;
  }
  .about-frame img{border-radius:var(--radius-md);border:3px solid var(--ink);background:var(--paper);min-height:220px;}
  .stat-float{
    position:absolute;bottom:-26px;right:-18px;
    background:var(--morning-breeze);color:var(--paper);
    border:3px solid var(--ink);border-radius:18px;
    padding:14px 18px;box-shadow:var(--shadow-chunky-sm);
    font-family:'Baloo 2',sans-serif;
    text-align:center;
    z-index:3;
  }
  .stat-float b{display:block;font-size:24px;}
  .stat-float span{font-size:11px;font-weight:600;}
  .about-badge-2{
    position:absolute;top:-16px;left:-20px;
    background:var(--sunwashed);color:var(--ink);
    border:3px solid var(--ink);border-radius:16px;
    padding:9px 14px;box-shadow:var(--shadow-chunky-sm);
    font-family:'Baloo 2',sans-serif;font-weight:700;font-size:13px;
    z-index:3;
  }
  .about-sticker{
    position:absolute;
    width:52px;height:52px;border-radius:50%;
    background:var(--paper);border:3px solid var(--ink);
    display:flex;align-items:center;justify-content:center;
    font-size:22px;box-shadow:var(--shadow-chunky-sm);
    z-index:3;
  }
  .about-sticker-1{top:8%;right:-8%;background:var(--sunwashed);}
  .about-sticker-2{bottom:22%;left:-10%;background:var(--coral);}

  .about-highlights{
    display:flex;flex-wrap:wrap;gap:10px;
    margin-top:22px;
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
    .hero .wrap{grid-template-columns:1fr;}
    .hero-visual{height:360px;margin:0 auto;max-width:420px;width:100%;}
    .about .wrap{grid-template-columns:1fr;}
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

  <div class="wrap">
    <div class="hero-copy">
      <span class="eyebrow hero-in hero-in-1">👋 Halo, Kawan Lama!</span>
      <h1 class="hero-headline">
        <span class="hero-in hero-in-2">Siap</span>
        <span class="hero-in hero-in-3">Bernostalgia</span>
        <span class="hero-in hero-in-4">dan</span>
        <span class="hero-in hero-in-5">Bikin</span>
        <span class="accent hero-pop hero-in-6">Cerita Baru</span>
        <span class="hero-in hero-in-7">Lagi?</span>
        <img src="{{ asset('assets/icons/military-aircraft.png') }}" alt="" class="rocket-emoji">
      </h1>
      <p class="hero-sub hero-in-fade hero-in-9">Selamat datang di markas digital kita tercinta! Tempat paling pas buat temu kangen, intip kabar terbaru teman seangkatan, dan saling dukung buat melangkah lebih jauh.</p>
      <div class="hero-cta hero-in hero-in-10">
        <a href="/login" class="btn btn-primary">Masuk ke Akun Kuy! 🚀</a>
        <a href="#daftar" class="btn btn-ghost">Daftar / Verifikasi Data</a>
      </div>
    </div>

    <div class="hero-visual hero-visual-in">
      <div class="badge-chip badge-float" style="--r:4deg;">📸 5.000+ Kenangan</div>
      <div class="polaroid polaroid-float">
        <span class="tape"></span>
        <span class="pin" style="top:-8px;right:18px;"></span>
        <img src="{{ asset('assets/images/antares.png') }}" alt="Kumpul bareng alumni Antares">
        <div class="polaroid-cap">
          <span>Reuni Akbar 2026</span>
          <span class="love-pulse">💛</span>
        </div>
      </div>

      <div class="hero-audio-player" id="audioPlayer">
        <audio id="heroAudio" src="{{ asset('assets/audio/hero-theme.mp3') }}" loop preload="none"></audio>
        <button class="audio-toggle" id="audioToggle" type="button" aria-label="Putar musik">
          <svg class="icon-play" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          <svg class="icon-pause" viewBox="0 0 24 24"><path d="M6 5h4v14H6zM14 5h4v14h-4z"/></svg>
        </button>
        <div class="audio-bars">
          <span style="height:9px;"></span>
          <span style="height:16px;"></span>
          <span style="height:7px;"></span>
          <span style="height:22px;"></span>
          <span style="height:12px;"></span>
          <span style="height:19px;"></span>
          <span style="height:8px;"></span>
          <span style="height:15px;"></span>
          <span style="height:10px;"></span>
        </div>
      </div>
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
  <div class="about-dots"></div>
  <div class="wrap">
    <div class="about-visual reveal">
      <span class="about-badge-2">😄 Sejak 2016</span>
      <span class="about-sticker about-sticker-1">📚</span>
      <span class="about-sticker about-sticker-2">🎓</span>
      <div class="about-frame-backdrop"></div>
      <div class="about-frame">
        <span class="about-frame-tape"></span>
        <img src="{{ asset('assets/images/antares.png') }}" alt="Momen kumpul alumni Antares">
      </div>
      <div class="stat-float float-slow">
        <b>25+</b>
        <span>ANGKATAN GABUNG</span>
      </div>
    </div>
    <div class="about-copy reveal reveal-d1">
      <span class="eyebrow">💛 Kenalin Dulu, Nih...</span>
      <h2 class="section-title">Bukan Sekadar Grup, Ini Keluarga Kedua Kita!</h2>
      <p class="section-text">Website ini dibuat khusus buat kita semua yang rindu masa-masa sekolah/kuliah dulu. Dari yang awalnya cuma mau nanya "Eh, sekarang sibuk apa?", sampai bisa kolaborasi bareng bikin project keren. Yuk, bikin jejaring silaturahmi kita makin erat dan seru di sini!</p>
      <div class="about-highlights">
        <span class="about-highlight">🔗 Networking Lintas Angkatan</span>
        <span class="about-highlight">💼 Info Karir & Loker</span>
        <span class="about-highlight">🎉 Reuni Rutin Tiap Tahun</span>
      </div>
    </div>
  </div>

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

<!-- JAVASCRIPT -->
<script>
  // --- widget musik di Hero ---
  const heroAudio = document.getElementById('heroAudio');
  const audioToggle = document.getElementById('audioToggle');
  const audioPlayer = document.getElementById('audioPlayer');
  audioToggle.addEventListener('click', () => {
    if (heroAudio.paused) {
      heroAudio.play().catch(() => {});
      audioPlayer.textContent = "Playing...";
    } else {
      heroAudio.pause();
      audioPlayer.textContent = "Musik";
    }
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

  // --- Scroll-reveal: fade/slide-in tiap elemen pas masuk viewport ---
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