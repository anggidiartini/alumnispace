<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Alumni Space — Dashboard & Portal Alumni')</title>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ file_exists(public_path('css/footer.css')) ? filemtime(public_path('css/footer.css')) : time() }}">
  @stack('styles')

  @auth
  <script>
    localStorage.setItem("ac_logged_in", "true");
    localStorage.setItem("ac_user_email", "{{ Auth::user()->email }}");
  </script>
  @else
  <script>
    localStorage.setItem("ac_logged_in", "false");
    localStorage.removeItem("ac_user_email");
  </script>
  @endauth
</head>
<body data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}">
  <div class="page-wrap">
    <x-user-navbar />

    <main>
      @yield('content')
    </main>

    <x-user-footer />
  </div>

  <!-- Floating action buttons -->
  <div id="fab-row" class="fab-row">
    <button id="back-to-top" type="button" class="focus-ring" aria-label="Kembali ke atas">
      <i data-lucide="arrow-up" width="20" height="20"></i>
    </button>

    <div id="wa-widget">
      <div id="wa-bubble" class="wa-bubble">
        <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;">
          <p class="wa-bubble-title">Ada pertanyaan?</p>
          <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup">
            <i data-lucide="x" width="16" height="16"></i>
          </button>
        </div>
        <p class="wa-bubble-text">Hubungi pengurus kami via WhatsApp 👋</p>
        <p class="wa-bubble-number">+62 812-3456-7890</p>
      </div>
      <a id="wa-button" href="https://wa.me/6281234567890?text=Halo" target="_blank" rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
        <i data-lucide="message-circle" width="26" height="26"></i>
      </a>
    </div>
  </div>

  <div id="toast" class="toast fixed bottom-5 left-1/2 z-[70] -translate-x-1/2 rounded-full bg-[#153563] px-5 py-3 text-sm font-bold text-white shadow-xl" role="status"></div>

  <!-- Lightbox global -->
  <div id="lightbox-overlay" class="lightbox-overlay">
    <button id="lightbox-close" type="button" class="lightbox-close" aria-label="Tutup"><i data-lucide="x" class="h-6 w-6"></i></button>
    <button id="lightbox-prev" type="button" class="lightbox-nav lightbox-nav--prev" aria-label="Foto sebelumnya"><i data-lucide="chevron-left" class="h-6 w-6"></i></button>
    <img id="lightbox-img" class="lightbox-img" src="" alt="Preview foto">
    <button id="lightbox-next" type="button" class="lightbox-nav lightbox-nav--next" aria-label="Foto berikutnya"><i data-lucide="chevron-right" class="h-6 w-6"></i></button>
    <div id="lightbox-counter" class="lightbox-counter"></div>
  </div>

  <!-- Modal notifikasi "harus login" -->
  <div id="auth-modal-overlay" class="auth-modal-overlay">
    <div class="auth-modal-card">
      <button id="auth-modal-close" type="button" class="auth-modal-close" aria-label="Tutup"><i data-lucide="x" class="h-5 w-5"></i></button>
      <span class="auth-modal-icon"><i data-lucide="lock" class="h-7 w-7"></i></span>
      <h3 class="auth-modal-title">Yah, masih terkunci</h3>
      <p class="auth-modal-text">Kamu harus masuk dulu buat akses <strong id="auth-modal-label">fitur ini</strong>.</p>
      <div class="auth-modal-actions">
        <button id="auth-modal-cancel" type="button" class="auth-modal-btn-secondary">Nanti dulu</button>
        <a id="auth-modal-confirm" href="{{ route('login') }}" class="auth-modal-btn-primary">Login sekarang</a>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>