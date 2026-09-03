<header class="custom-header">
  <nav class="custom-nav-container" aria-label="Navigasi utama">
    <a href="#beranda" class="custom-logo" data-target="#beranda">
      <span class="logo-icon logo-spin">✦</span>
      <span class="logo-text">Alumni Space</span>
    </a>

    <div class="desktop-nav">
      <!-- Dropdown Beranda -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Beranda</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu">
          <a class="drop-item" href="#tentang" data-target="#tentang">Tentang</a>
          <a class="drop-item" href="#statistik" data-target="#statistik">Statistik</a>
        </div>
      </div>

      <!-- Dropdown Komunitas -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Komunitas</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu">
          <a class="drop-item flex-between" href="#alumni" data-target="#alumni" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest>
            <span>Alumni</span>
            @guest<i data-lucide="lock" class="icon-lock"></i>@endguest
          </a>
          <a class="drop-item" href="#testimoni" data-target="#testimoni">Testimoni</a>
        </div>
      </div>

      <!-- Dropdown Media -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Media</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu">
          <a class="drop-item" href="#media" data-target="#media" data-tab-target="articles">Artikel</a>
          <a class="drop-item" href="#media" data-target="#media" data-tab-target="gallery">Galeri</a>
          <a class="drop-item flex-between" href="#album" data-target="#album" @guest data-auth-link data-auth-label="Album Foto" @endguest>
            <span>Album</span>
            @guest<i data-lucide="lock" class="icon-lock"></i>@endguest
          </a>
        </div>
      </div>

      <!-- Dropdown Informasi -->
      <div class="nav-drop">
        <button class="nav-link-btn" type="button" data-dropdown aria-expanded="false">
          <span>Informasi</span> <i data-lucide="chevron-down" class="icon-sm"></i>
        </button>
        <div class="drop-menu drop-right">
          <a class="drop-item flex-between" href="#lowongan" data-target="#lowongan" @guest data-auth-link data-auth-label="Lowongan Kerja" @endguest>
            <span>Lowongan</span>
            @guest<i data-lucide="lock" class="icon-lock"></i>@endguest
          </a>
          <a class="drop-item flex-between" href="#event" data-target="#event" @guest data-auth-link data-auth-label="Agenda Event" @endguest>
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
        <a href="{{ route('login') }}" class="btn-primary">
          Masuk &rarr;
        </a>
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

  <!-- Menu Mobile -->
  <div id="mobile-nav" class="mobile-nav-container">
    <div class="mobile-nav-content">
      <p class="mobile-group-label">Beranda</p>
      <a class="mobile-link" href="#tentang" data-target="#tentang">Tentang</a>
      <a class="mobile-link" href="#statistik" data-target="#statistik">Statistik</a>

      <p class="mobile-group-label">Komunitas</p>
      <a class="mobile-link flex-between" href="#alumni" data-target="#alumni">
        <span>Alumni</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>
      <a class="mobile-link" href="#testimoni" data-target="#testimoni">Testimoni</a>

      <p class="mobile-group-label">Media</p>
      <a class="mobile-link" href="#media" data-target="#media" data-tab-target="articles">Artikel</a>
      <a class="mobile-link" href="#media" data-target="#media" data-tab-target="gallery">Galeri</a>
      <a class="mobile-link flex-between" href="#album" data-target="#album">
        <span>Album</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <p class="mobile-group-label">Informasi</p>
      <a class="mobile-link flex-between" href="#lowongan" data-target="#lowongan">
        <span>Lowongan</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>
      <a class="mobile-link flex-between" href="#event" data-target="#event">
        <span>Event</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <div class="mobile-auth-footer">
        @guest
        <a href="{{ route('login') }}" class="btn-primary-block">Masuk / Login</a>
        @else
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn-outline-block">
            <i data-lucide="log-out" class="icon-sm"></i> Keluar ({{ Auth::user()->name }})
          </button>
        </form>
        @endguest
      </div>
    </div>
  </div>
</header>
