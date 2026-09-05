<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>memori. — Our Album</title>

    <!-- CSS File Calls -->
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
</head>
<body data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}">

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
      <div class="count">{{ count($albums) }} albums</div>
    </div>

    <div class="filter-bar">
      <button class="filter-btn active" data-filter="all">Semua</button>
      <button class="filter-btn" data-filter="indoor">Indoor</button>
      <button class="filter-btn" data-filter="outdoor">Outdoor</button>
    </div>
    <div class="filter-status">Menampilkan <strong id="filter-label">semua album</strong></div>

    <div class="album-grid">
      @forelse($albums as $index => $album)
      <div class="card" id="c{{ $album->id }}" data-category="{{ $album->category }}">
        <div class="card-photo">
          <span class="cat-pill {{ $album->category === 'outdoor' ? 'outdoor' : '' }}">{{ ucfirst($album->category) }}</span>
          <img src="{{ asset($album->cover_photo ?? 'assets/images/foto-1.png') }}" alt="{{ $album->title }}">
        </div>
        @if($album->sticker_tag)
        <div class="sticker {{ $index % 2 == 1 ? 'alt' : '' }}">{!! nl2br(e($album->sticker_tag)) !!}</div>
        @endif
        <div class="card-body">
          <div class="label">{{ $album->subtitle_label ?? $album->target_generation }}</div>
          <h3>{{ $album->title }}</h3>
          <div class="date">{{ $album->date_display ?? ($album->location ?? 'Memori') }}</div>
          <a href="{{ route('album.show', $album->slug) }}" class="view-btn">View Album
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
      @empty
      <div style="grid-column: 1 / -1; text-align:center; padding: 40px;">
        <p style="font-size: 18px; font-weight:700;">Belum ada album kenangan.</p>
      </div>
      @endforelse
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

  // ---------- SCROLL REVEAL FOR ALBUM CARDS ----------
  var cards = document.querySelectorAll('.card');
  var columns = 2;
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

  // Heart pop on polaroid click
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

if (menuToggle && navbarMenu) {
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
}
</script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>