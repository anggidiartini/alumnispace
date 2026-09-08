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

    {{-- =========================================================
         GALERI FOTO ALBUM (banyak foto + lightbox)
         Asumsi relasi: $album->photos (hasMany), tiap item punya
         salah satu dari field: photo_path / path / image.
         Kalau nama relasi/field beda di backend, tinggal sesuaikan
         2 baris yang ditandai "SESUAIKAN" di bawah.
    ========================================================== --}}
    @if(isset($album->photos) && $album->photos->count())
    <div class="gallery-head reveal-pop">
      <h2>Galeri <span class="marker">Foto</span></h2>
      <div class="count">{{ $album->photos->count() }} foto</div>
    </div>

    <div class="photo-gallery">
      @foreach($album->photos as $i => $photo)
        @php
          // SESUAIKAN: ganti/tambah field sesuai nama kolom di tabel photo kamu
          $photoUrl = $photo->photo_path ?? $photo->path ?? $photo->image ?? null;
        @endphp
        @if($photoUrl)
        <div class="gallery-item reveal-pop" style="--pop-delay: {{ min($i * 0.06, 0.6) }}s"
             data-src="{{ asset($photoUrl) }}" data-index="{{ $i }}">
          <img src="{{ asset($photoUrl) }}" alt="{{ $album->title }} - foto {{ $i + 1 }}" loading="lazy">
          <span class="gallery-zoom-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.4">
              <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
            </svg>
          </span>
        </div>
        @endif
      @endforeach
    </div>

    {{-- ====== LIGHTBOX OVERLAY ====== --}}
    <div class="lightbox-overlay" id="lightboxOverlay">
      <button class="lightbox-close" id="lightboxClose" aria-label="Tutup">&times;</button>
      <button class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="Foto sebelumnya">&larr;</button>
      <div class="lightbox-stage">
        <img src="" alt="" id="lightboxImage" class="lightbox-image">
        <div class="lightbox-counter"><span id="lightboxCurrent">1</span> / <span id="lightboxTotal">0</span></div>
      </div>
      <button class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="Foto selanjutnya">&rarr;</button>
    </div>
    @endif

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
  // ---------- SCROLL REVEAL UNTUK RELATED-HEAD / RELATED-CARD / GALLERY-HEAD / GALLERY-ITEM ----------
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

  // ---------- PHOTO GALLERY LIGHTBOX ----------
  var items = Array.prototype.slice.call(document.querySelectorAll('.gallery-item'));
  if(items.length){
    var overlay   = document.getElementById('lightboxOverlay');
    var imgEl     = document.getElementById('lightboxImage');
    var closeBtn  = document.getElementById('lightboxClose');
    var prevBtn   = document.getElementById('lightboxPrev');
    var nextBtn   = document.getElementById('lightboxNext');
    var currentEl = document.getElementById('lightboxCurrent');
    var totalEl   = document.getElementById('lightboxTotal');

    var sources = items.map(function(el){ return el.dataset.src; });
    var currentIndex = 0;

    totalEl.textContent = sources.length;

    function openLightbox(index){
      currentIndex = index;
      updateImage();
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox(){
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    function updateImage(){
      imgEl.classList.remove('pop');
      // force reflow biar animasi pop ulang tiap ganti foto
      void imgEl.offsetWidth;
      imgEl.src = sources[currentIndex];
      imgEl.classList.add('pop');
      currentEl.textContent = currentIndex + 1;
    }

    function showPrev(){
      currentIndex = (currentIndex - 1 + sources.length) % sources.length;
      updateImage();
    }
    function showNext(){
      currentIndex = (currentIndex + 1) % sources.length;
      updateImage();
    }

    items.forEach(function(el){
      el.addEventListener('click', function(){
        openLightbox(parseInt(el.dataset.index, 10));
      });
    });

    closeBtn.addEventListener('click', closeLightbox);
    prevBtn.addEventListener('click', showPrev);
    nextBtn.addEventListener('click', showNext);

    overlay.addEventListener('click', function(e){
      if(e.target === overlay) closeLightbox();
    });

    document.addEventListener('keydown', function(e){
      if(!overlay.classList.contains('active')) return;
      if(e.key === 'Escape') closeLightbox();
      if(e.key === 'ArrowLeft') showPrev();
      if(e.key === 'ArrowRight') showNext();
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