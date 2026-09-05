<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>memori. — {{ $album->title }}</title>

    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
</head>
<body>

<x-navbar />

<div class="section-yellow detail-page-wrap">

  <!-- doodles, biar senada sama hero index -->
  <div class="doodle" style="top:110px;left:3%;--r:-8deg;">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="#f2b600"><path d="M12 1l2.9 7.3L22 11l-7.1 2.7L12 21l-2.9-7.3L2 11l7.1-2.7z"/></svg>
  </div>
  <div class="doodle" style="top:60%;right:2%;--r:10deg;color:var(--home-pink-strong);font-size:24px;">♡</div>

  <div class="wrap">

    <a href="{{ route('album.index') }}" class="back-link">&larr; Kembali ke Album</a>

    <div class="detail-grid">
      <div class="detail-photo-col">
        <div class="detail-photo">
          <span class="cat-pill {{ $album->category === 'outdoor' ? 'outdoor' : '' }}">
            {{ ucfirst($album->category) }}
          </span>
          <img src="{{ asset($album->cover_photo ?? 'assets/images/foto-1.png') }}" alt="{{ $album->title }}">
          <span class="detail-sticker">{{ $album->date_display ? \Illuminate\Support\Str::limit($album->date_display, 9, '') : '✦' }}</span>
        </div>
      </div>

      <div class="detail-info-col">
        <div class="info-card">
          <div class="greet-badge small">
            <span>✦</span> {{ $album->subtitle_label ?? $album->target_generation ?? 'MEMORI' }}
          </div>

          <h1 class="marker-title">{{ $album->title }}</h1>

          <div class="meta-row">
            <span class="meta-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
              {{ $album->date_display }}
            </span>
            <span class="meta-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.2"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
              {{ $album->location }}
            </span>
          </div>

          <div class="desc-quote">
            <p class="detail-desc">{{ $album->description }}</p>
          </div>
        </div>
      </div>
    </div>

    @if(isset($relatedAlbums) && $relatedAlbums->count())
    <div class="related-head reveal-pop">
      <h2>Album <span class="marker">Lainnya</span></h2>
    </div>

    <div class="related-grid">
      @foreach($relatedAlbums as $i => $related)
        <div class="related-card reveal-pop" style="--pop-delay: {{ $i * 0.15 }}s">
          <div class="related-photo">
            <span class="cat-pill {{ $related->category === 'outdoor' ? 'outdoor' : '' }}">
              {{ ucfirst($related->category) }}
            </span>
            <img src="{{ asset($related->cover_photo ?? 'assets/images/foto-1.png') }}" alt="{{ $related->title }}">
          </div>
          <div class="related-body">
            <div class="label">{{ $related->subtitle_label ?? $related->target_generation }}</div>
            <h3>{{ $related->title }}</h3>
            <a href="{{ route('album.show', $related->slug) }}" class="view-btn">
              View Album
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.4"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      @endforeach
    </div>
    @endif

  </div>
</div><!-- /.detail-page-wrap -->

<x-footer />

<script>
(function(){
  // ---------- SCROLL REVEAL UNTUK RELATED-HEAD / RELATED-CARD ----------
  var popEls = document.querySelectorAll('.reveal-pop');
  if(popEls.length){
    var popIo = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          entry.target.classList.add('in-view');
          popIo.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    popEls.forEach(function(el){
      popIo.observe(el);
      el.addEventListener('animationend', function(e){
        if(e.animationName === 'popBounceIn'){ el.classList.add('popped'); }
      });
    });
  }

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