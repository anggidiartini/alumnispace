<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Direktori Alumni — Antares Alumni Club</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  :root{
    --buttercup:#FFF2B2;
    --sunwashed:#FFE08A;
    --cloud-puff:#FFF7D6;
    --dewy-blue:#A8C6E7;
    --morning-breeze:#124d82;
    --sky-tint:#E9F1FB;
    --sky-tint-2:#D3E4F6;
    --ink:#2E3A59;
    --ink-soft:#5B6B8C;
    --paper:#FFFDF7;
    --coral:#FF9466;
    --radius-lg:24px;
    --radius-md:14px;
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

  h1,h2,h3,.display{
    font-family:'Baloo 2', sans-serif;
    font-weight:800;
    line-height:1.08;
    margin:0;
  }
  p{margin:0;}
  a{text-decoration:none;color:inherit;}

  .wrap{
    max-width:1240px;
    margin:0 auto;
    padding:0 24px;
  }

  /* HERO BADGE */
  .hero-badge-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 700;
    font-size: clamp(20px, 2.8vw, 26px);
    color: var(--paper);
    background-color: #124d82;
    padding: 16px 42px;
    border-radius: 999px;
    border: 3px solid #ffffff;
    box-shadow: 4px 4px 0 var(--ink);
    position: relative;
  }
  .hero-badge-box::after {
    content: '';
    position: absolute;
    top: 5px; left: 5px; right: 5px; bottom: 5px;
    border: 2px dashed rgba(255, 255, 255, 0.6);
    border-radius: 999px;
    pointer-events: none;
  }

  .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    font-family:'Baloo 2', sans-serif;
    font-weight:700;
    font-size:15px;
    padding:12px 24px;
    border-radius:999px;
    border:3px solid var(--ink);
    box-shadow:var(--shadow-chunky-sm);
    cursor:pointer;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .btn:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--ink);}
  .btn-primary{background:#124d82;color:var(--paper);}

  .alumni-hero{
    padding:50px 0 70px;
    background:
      radial-gradient(circle at 85% 20%, var(--buttercup) 0, transparent 30%),
      radial-gradient(circle at 15% 75%, var(--cloud-puff) 0, transparent 28%),
      var(--dewy-blue);
    border-bottom:4px solid var(--ink);
    text-align:center;
    position:relative;
  }

  .alumni-title{
    font-size:clamp(32px, 4.5vw, 48px);
    margin-top:16px;
    color: #124d82;
  }

  .alumni-sub{
    margin-top:16px;
    font-size:16px;
    font-weight:600;
    color: #124d82;
  }

  /* SEARCH BAR */
  .search-container{
    margin: 40px auto;
    max-width: 800px;
    display: flex;
    gap: 12px;
    background: var(--paper);
    padding: 12px 18px;
    border: 3px solid var(--ink);
    border-radius: 999px;
    box-shadow: var(--shadow-chunky);
  }
  .search-container input{
    flex: 1;
    border: none;
    outline: none;
    font-family: 'Nunito', sans-serif;
    font-size: 15px;
    font-weight: 600;
    background: transparent;
    padding-left: 12px;
  }
  .search-container select{
    border: 2px solid var(--ink);
    border-radius: 999px;
    padding: 8px 16px;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 700;
    font-size: 14px;
    background: var(--cloud-puff);
    outline: none;
    cursor: pointer;
  }

  /* ALUMNI GRID */
  .alumni-grid{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 80px;
  }
  @media(max-width: 1024px){
    .alumni-grid{ grid-template-columns: repeat(2, 1fr); }
  }
  @media(max-width: 600px){
    .alumni-grid{ grid-template-columns: 1fr; }
    .search-container{ flex-direction: column; border-radius: 20px; }
  }

  .alumni-card{
    background: var(--paper);
    border: 3px solid var(--ink);
    border-radius: var(--radius-lg);
    padding: 24px 20px;
    box-shadow: var(--shadow-chunky);
    text-align: center;
    position: relative;
    transition: transform .15s ease, box-shadow .15s ease;
  }
  .alumni-card:hover{
    transform: translate(-3px, -3px);
    box-shadow: 9px 9px 0 var(--ink);
  }
  .alumni-avatar-wrap{
    width: 90px;
    height: 90px;
    margin: 0 auto 16px;
    border-radius: 50%;
    border: 3px solid var(--ink);
    position: relative;
    box-shadow: 2px 2px 0 var(--ink);
    background: var(--dewy-blue);
  }
  .alumni-avatar-wrap img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
  }
  .status-dot{
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid var(--paper);
  }
  .status-dot.online{ background: #2ecc71; }
  .status-dot.offline{ background: #bdc3c7; }

  .alumni-name{
    font-family: 'Baloo 2', sans-serif;
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 4px;
  }
  .alumni-role{
    font-size: 13.5px;
    font-weight: 700;
    color: var(--ink-soft);
    margin-bottom: 10px;
  }
  .badge-angkatan{
    display: inline-block;
    background: var(--sunwashed);
    border: 2px solid var(--ink);
    border-radius: 999px;
    padding: 3px 12px;
    font-family: 'Baloo 2', sans-serif;
    font-weight: 800;
    font-size: 12px;
    margin-bottom: 14px;
  }
  .alumni-socials{
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 16px;
  }
  .alumni-socials a{
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: 2px solid var(--ink);
    background: var(--sky-tint);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--ink);
    transition: transform .15s ease;
  }
  .alumni-socials a:hover{ transform: scale(1.15); background: var(--morning-breeze); color: #fff; }
</style>
</head>
<body>

<x-navbar />

<section class="alumni-hero">
  <div class="wrap">
    <div class="hero-badge-box">Direktori Sahabat Almamater</div>
    <h1 class="alumni-title">Temukan Kembali Kawan Lamamu!</h1>
    <p class="alumni-sub">Jelajahi profil ribuan alumni hebat lintas angkatan, sambung kembali silaturahmi, dan perluas jaringan profesionalmu.</p>
  </div>
</section>

<main class="wrap">
  <form action="{{ route('alumni.index') }}" method="GET" class="search-container">
    <i class="fa-solid fa-search" style="align-self: center; margin-left: 6px; color: var(--ink-soft);"></i>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama alumni, profesi, atau kota domisili...">
    <select name="generation" onchange="this.form.submit()">
      <option value="">Semua Angkatan</option>
      @foreach($generations ?? [] as $gen)
      <option value="{{ $gen }}" {{ request('generation') == $gen ? 'selected' : '' }}>Angkatan {{ $gen }}</option>
      @endforeach
    </select>
    <button type="submit" class="btn btn-primary" style="padding: 8px 20px; font-size: 14px;">Cari</button>
  </form>

  <div class="alumni-grid">
    @forelse($alumni as $alum)
    <div class="alumni-card">
      <div class="alumni-avatar-wrap">
        <img src="{{ $alum->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300' }}" alt="{{ $alum->user?->name }}">
        <span class="status-dot {{ $alum->is_online ? 'online' : 'offline' }}"></span>
      </div>
      <h3 class="alumni-name">{{ $alum->user?->name ?? 'Alumni Member' }}</h3>
      <p class="alumni-role">{{ $alum->profession ?? 'Alumni' }} • {{ $alum->city ?? 'Indonesia' }}</p>
      <span class="badge-angkatan">Angkatan {{ $alum->graduation_year }}</span>
      <div class="alumni-socials">
        @if($alum->linkedin_url)<a href="{{ $alum->linkedin_url }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a>@endif
        @if($alum->instagram_url)<a href="{{ $alum->instagram_url }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>@endif
        @if($alum->github_url)<a href="{{ $alum->github_url }}" target="_blank"><i class="fa-brands fa-github"></i></a>@endif
        @if($alum->user?->email)<a href="mailto:{{ $alum->user?->email }}"><i class="fa-solid fa-envelope"></i></a>@endif
      </div>
      <button class="btn btn-primary" style="width: 100%; padding: 8px; font-size: 14px;" onclick="alert('Membuka obrolan dengan {{ $alum->user?->name }}!')"><i class="fa-solid fa-comment-dots"></i> Sapa Alumni</button>
    </div>
    @empty
    <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
      <h3>Tidak ada alumni yang ditemukan.</h3>
      <p class="alumni-role" style="margin-top: 8px;">Coba gunakan kata kunci pencarian atau angkatan lain.</p>
    </div>
    @endforelse
  </div>
</main>

<x-footer />

</body>
</html>
