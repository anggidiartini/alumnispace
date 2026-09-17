<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>memori. — {{ $album->title }}</title>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/event.css') }}?v={{ file_exists(public_path('css/event.css')) ? filemtime(public_path('css/event.css')) : time() }}">
    
    <link rel="stylesheet" href="{{ asset('css/album.css') }}?v={{ file_exists(public_path('css/album.css')) ? filemtime(public_path('css/album.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
</head>
<body>

<x-navbar />

<div class="section-yellow detail-page-wrap">

  <div class="deco-asset alb-detail-l1 reveal-onscroll" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="aset-jam floaty">
  </div>
  <div class="deco-asset alb-detail-l2 reveal-onscroll" style="transition-delay:.1s" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="aset-alattulis wiggle">
  </div>
  <div class="deco-asset alb-detail-r1 reveal-onscroll" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="aset-bus floaty-slow">
  </div>
  <div class="deco-asset alb-detail-r2 reveal-onscroll" style="transition-delay:.1s" aria-hidden="true">
    <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="aset-papantulis wiggle">
  </div>


  <div class="wrap">

    <!-- Back-link: disamain PERSIS kayak "Kembali ke Artikel" di detail artikel —
         pakai icon arrow-left + flex layout, statis tanpa animasi masuk. -->
    <a href="{{ route('album.index') }}" class="back-link">
        <i data-lucide="arrow-left" width="18" height="18"></i>
        Kembali ke Album
    </a>

    <div class="detail-grid">
      <div class="detail-photo-col">
        <div class="detail-photo reveal-pop" style="--pop-delay:.1s">
          <span class="cat-pill {{ $album->category === 'outdoor' ? 'outdoor' : '' }}">
            {{ ucfirst($album->category) }}
          </span>
          <img src="{{ asset($album->cover_photo ?? 'assets/images/foto-1.png') }}" alt="{{ $album->title }}">
          <span class="detail-sticker">{{ $album->date_display ? \Illuminate\Support\Str::limit($album->date_display, 9, '') : '✦' }}</span>
        </div>
      </div>

      <!-- ====== FIX: wrapper .info-card DIHAPUS di sini ======
           Sebelumnya kolom kanan dibungkus <div class="info-card">, yang
           bikin muncul box biru (background var(--home-blue-soft) + border
           navy + shadow) dari class .info-card di album.css.
           Sekarang badge/judul/meta/quote langsung ditaruh di
           .detail-info-col, PERSIS seperti struktur di halaman detail
           artikel (artikel/show.blade.php) yang tidak pakai .info-card
           sama sekali — jadi tidak ada box biru lagi. -->
      <div class="detail-info-col">
        <div class="greet-badge small reveal-pop" style="--pop-delay:.15s">
             {{ $album->subtitle_label ?? $album->target_generation ?? 'MEMORI' }}
        </div>

        <h1 class="marker-title reveal-pop" style="--pop-delay:.25s">{{ $album->title }}</h1>

        <div class="meta-row reveal-pop" style="--pop-delay:.35s">
          <span class="meta-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            {{ $album->date_display }}
          </span>
          <span class="meta-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.2"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
            {{ $album->location }}
          </span>
        </div>

        <div class="desc-quote reveal-pop" style="--pop-delay:.45s">
          <p class="detail-desc">{{ $album->description }}</p>
        </div>
      </div>
    </div>

    {{-- =========================================================
         GALERI FOTO ALBUM (banyak foto + lightbox)
         Kolom foto: album_photos.photo_path
         Contoh isi: assets/images/foto-1.png
    ========================================================== --}}
    @if(isset($album->photos) && $album->photos->count())
    <div class="gallery-head reveal-pop">
      <h2>Galeri Foto</span></h2>
      <div class="count">{{ $album->photos->count() }} foto</div>
    </div>

    <div class="photo-gallery">
      @foreach($album->photos as $i => $photo)
        @php
          $photoUrl = $photo->photo_path;
        @endphp
        @if($photoUrl)
        <div class="gallery-item reveal-pop" style="--pop-delay: {{ min($i * 0.06, 0.6) }}s"
             data-src="{{ asset($photoUrl) }}" data-caption="{{ $photo->caption }}" data-index="{{ $i }}">
          <img src="{{ asset($photoUrl) }}" alt="{{ $photo->caption ?? $album->title . ' - foto ' . ($i + 1) }}" loading="lazy">
          <span class="gallery-zoom-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.4">
              <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
            </svg>
          </span>
        </div>
        @endif
      @endforeach
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
            <a href="{{ route('album.show', $related->slug) }}" class="view-btn">View Album</a>
          </div>
        </div>
      @endforeach
    </div>
    @endif

  </div>
</div><!-- /.detail-page-wrap -->
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

<x-footer />

<!-- Floating action buttons: back-to-top & WhatsApp -->
    <div id="fab-row" class="fab-row">
        <button id="back-to-top" type="button" class="focus-ring" aria-label="Kembali ke atas">
            <i data-lucide="arrow-up" width="20" height="20"></i>
        </button>

        <div id="wa-widget">
            <div id="wa-bubble" class="wa-bubble">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;">
                    <p class="wa-bubble-title">Ada pertanyaan?</p>
                    <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup"><i
                            data-lucide="x" width="16" height="16"></i></button>
                </div>
                <p class="wa-bubble-text">Hubungi pengurus alumni kami via WhatsApp 👋</p>
                <p class="wa-bubble-number">+62 812-3456-7890</p>
            </div>
            <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20Ruang%20Kenangan" target="_blank"
                rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
                <i data-lucide="message-circle" width="26" height="26"></i>
            </a>
        </div>
    </div>
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

  // ---------- ICONS (Lucide) ----------
  if (window.lucide) { lucide.createIcons(); }

  // ---------- BACK TO TOP ----------
  var backToTop = document.getElementById('back-to-top');
  if (backToTop) {
    window.addEventListener('scroll', function(){
      if (window.scrollY > 300) {
        backToTop.classList.add('show');
      } else {
        backToTop.classList.remove('show');
      }
    });
    backToTop.addEventListener('click', function(){
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ---------- WHATSAPP BUBBLE ----------
  var waButton = document.getElementById('wa-button');
  var waBubble = document.getElementById('wa-bubble');
  var waBubbleClose = document.getElementById('wa-bubble-close');

  if (waButton && waBubble) {
    waButton.addEventListener('mouseenter', function(){
      waBubble.classList.add('show');
    });
  }
  if (waBubbleClose) {
    waBubbleClose.addEventListener('click', function(){
      waBubble.classList.remove('show');
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