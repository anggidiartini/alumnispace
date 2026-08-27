<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AlumSpace — Menemukan Kembali Cerita Kita</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#2E3A59;
    --paper:#FFFDF7;
    --morning-breeze:#7FA8D6;
    --sunwashed:#FFE08A;
    --shadow-chunky-sm:4px 4px 0 var(--ink);
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    font-family:'Nunito', sans-serif;
    background:#FFFDF7;
  }
  a{text-decoration:none;}

  .opening-scene{
    position:relative;
    width:100%;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    padding:24px;
  }

  .opening-stage{
    position:relative;
    width:min(92vw,640px);
    height:min(62vh,540px);
  }

  /* "Alumspace" star sticker */
  .alumspace-sticker{
    position:absolute;
    left:48%;
    top:48%;
    width:min(72vw, 560px);
    z-index:5;
    filter:drop-shadow(0 10px 0 rgba(46,58,89,.12));
  }

  /* Magnifying glass + hand — digeser lebih ke kanan lagi (left: 86%) */
  .magnifier{
    position:absolute;
    left:86%; 
    top:65%;
    width:min(40vw,300px);
    z-index:8;
  }

  /* CTA into the landing page */
  .opening-cta{
    position:relative;
    z-index:20;
    margin-top:10px;
    display:inline-flex;
    align-items:center;
    gap:10px;
    font-family:'Baloo 2', sans-serif;
    font-weight:800;
    font-size:17px;
    color:var(--ink);
    background:var(--sunwashed);
    border:3px solid var(--ink);
    border-radius:999px;
    padding:12px 28px;
    box-shadow:var(--shadow-chunky-sm);
    cursor:pointer;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .opening-cta:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--ink);}
  .opening-cta:active{transform:translate(1px,1px);box-shadow:2px 2px 0 var(--ink);}

  .opening-skip{
    position:relative;
    z-index:20;
    margin-top:8px;
    font-family:'Nunito', sans-serif;
    font-weight:700;
    font-size:13px;
    color:var(--ink);
    opacity:.65;
    text-decoration:underline;
  }
  .opening-skip:hover{opacity:1;}

  /* ================= ANIMATIONS ================= */
  @media (prefers-reduced-motion:no-preference){

    .opening-scene{opacity:0;animation:sceneFadeIn .8s ease-out forwards;}

    .alumspace-sticker{
      opacity:0;
      transform:translate(-50%,-50%) scale(.3) rotate(-10deg);
      transform-origin:center;
      animation:
        stickerPopIn .8s cubic-bezier(.34,1.56,.64,1) .55s forwards,
        alumspaceLift 6s ease-in-out 1.75s infinite;
    }

    .magnifier{
      opacity:0;
      transform:translate(-50%,-45%) scale(.85);
      transform-origin:center;
      animation:
        magnifierFadeIn .7s ease-out .95s forwards,
        magnifierPan 6s ease-in-out 1.75s infinite;
    }

    .opening-cta{
      opacity:0;
      transform:translateY(20px);
      animation:ctaFadeUp .6s ease-out 2.05s forwards;
    }
    .opening-skip{
      opacity:0;
      animation:skipFadeIn .6s ease-out 2.3s forwards;
    }
  }

  .alumspace-sticker{transform:translate(-50%,-50%);}
  .magnifier{transform:translate(-50%,-50%);}

  @keyframes sceneFadeIn{ from{opacity:0;} to{opacity:1;} }

  @keyframes stickerPopIn{
    0%{opacity:0;transform:translate(-50%,-50%) scale(.3) rotate(-10deg);}
    60%{opacity:1;transform:translate(-50%,-50%) scale(1.12) rotate(4deg);}
    100%{opacity:1;transform:translate(-50%,-50%) scale(1) rotate(0deg);}
  }

  @keyframes alumspaceLift{
    0%,40%,60%,100%{transform:translate(-50%,-50%) translateY(0) scale(1);filter:drop-shadow(0 10px 0 rgba(46,58,89,.12));}
    50%{transform:translate(-50%,-50%) translateY(-18px) scale(1.06);filter:drop-shadow(0 26px 18px rgba(46,58,89,.28));}
  }

  @keyframes magnifierFadeIn{
    from{opacity:0;transform:translate(-50%,-40%) scale(.85);}
    to{opacity:1;transform:translate(-50%,-50%) scale(1);}
  }

  @keyframes magnifierPan{
    0%,100%{transform:translate(-50%,-50%) translate(18px,10px) rotate(-4deg);}
    25%{transform:translate(-50%,-50%) translate(-14px,-6px) rotate(-8deg);}
    50%{transform:translate(-50%,-50%) translate(0,0) rotate(2deg);}
    75%{transform:translate(-50%,-50%) translate(-10px,4px) rotate(-6deg);}
  }

  @keyframes ctaFadeUp{ from{opacity:0;transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }
  @keyframes skipFadeIn{ from{opacity:0;} to{opacity:1;} }

  @media (max-width:600px){
    .opening-stage{height:min(52vh,420px);}
    .opening-cta{font-size:15px;padding:12px 24px;}
  }
</style>
</head>
<body>

<section class="opening-scene">
  <div class="opening-stage">
    <img class="magnifier" src="{{ asset('assets/icons/kacapembesar.png') }}" alt="">
    <img class="alumspace-sticker" src="{{ asset('assets/icons/alumspace.png') }}" alt="AlumSpace">
  </div>

  <a href="{{ url('/') }}" class="opening-cta">Masuk ke AlumSpace 🔍</a>
  <a href="{{ url('/') }}" class="opening-skip">Lewati intro</a>
</section>

</body>
</html>