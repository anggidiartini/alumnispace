<header class="custom-header">
  <nav class="custom-nav-container" aria-label="Navigasi utama">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="custom-logo">
      <span class="logo-icon logo-spin">✦</span>
      <span class="logo-text">Alumni Space</span>
    </a>

    <div class="desktop-nav">
      <!-- Dropdown Beranda (Balik ke Home + Section) -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Beranda</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu">
          <a class="drop-item" href="{{ route('home') }}#tentang">Tentang</a>
          <a class="drop-item" href="{{ route('home') }}#statistik">Statistik</a>
        </div>
      </div>

      <!-- Dropdown Komunitas (Ke Halaman Index Alumni) -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Komunitas</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu">
          <a class="drop-item flex-between" href="{{ route('alumni.index') }}">
            <span>Alumni</span>
            @guest<i data-lucide="lock" class="icon-lock"></i>@endguest
          </a>
          <a class="drop-item" href="{{ route('home') }}#testimoni">Testimoni</a>
        </div>
      </div>

      <!-- Dropdown Media (Ke Halaman Index Artikel & Album) -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Media</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu">
          <a class="drop-item" href="{{ route('artikel.index') }}">Artikel</a>
          <a class="drop-item" href="{{ route('home') }}#media">Galeri</a>
          <a class="drop-item flex-between" href="{{ route('album.index') }}">
            <span>Album</span>
            @guest<i data-lucide="lock" class="icon-lock"></i>@endguest
          </a>
        </div>
      </div>

      <!-- Dropdown Informasi (Ke Halaman Index Lowongan & Event) -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Informasi</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu drop-right">
          <a class="drop-item flex-between" href="{{ route('lowongan.index') }}">
            <span>Lowongan</span>
            @guest<i data-lucide="lock" class="icon-lock"></i>@endguest
          </a>
          <a class="drop-item flex-between" href="{{ route('event.index') }}">
            <span>Event</span>
            @guest<i data-lucide="lock" class="icon-lock"></i>@endguest
          </a>
        </div>
      </div>
    </div>

    <!-- Bagian Kanan (Auth / User / Toggle HP) -->
    <div class="nav-right-actions">
      @guest
      <div id="guest-actions">
        <a href="{{ route('login') }}" class="btn-primary">Masuk &rarr;</a>
      </div>
      @else
      <div id="user-actions" class="user-action-group">
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
        <a href="{{ route('admin.content.index') }}" class="btn-admin" title="Buka Panel CMS">
          <span>⚡</span> <span class="hide-mobile">CMS Admin</span>
        </a>
        @endif
        <span class="user-badge">
          <span class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
          <span class="hide-mobile">{{ Auth::user()->name }}</span>
        </span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="btn-outline-danger" title="Keluar">
            <i data-lucide="log-out" class="icon-sm"></i> <span class="hide-mobile text-xs">Keluar</span>
          </button>
        </form>
      </div>
      @endguest

      <button id="mobile-toggle" class="mobile-toggle-btn" type="button" aria-label="Buka menu">
        <i data-lucide="menu" class="icon-md"></i>
      </button>
    </div>
  </nav>

  <!-- Menu Mobile (Opsional disesuaikan dengan pola di atas) -->
  <div id="mobile-nav" class="mobile-nav-container">
    <!-- Isi mobile nav bisa disesuaikan sama seperti desktop di atas -->
  </div>
</header>
