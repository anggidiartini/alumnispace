<header class="custom-header">
  <nav class="custom-nav-container" aria-label="Navigasi utama">
    <a href="#beranda" class="custom-logo" data-target="#beranda">
      <span class="logo-icon logo-spin">✦</span>
      <span class="logo-text">Alumni Space</span>
    </a>

    <!-- Navigasi Utama Datar (Tanpa Dropdown) -->
    <div class="desktop-nav" style="display: flex; align-items: center; gap: 1.5rem;">

      <!-- Beranda (kembali ke section beranda di halaman awal) -->
      <a href="#beranda" class="nav-link-btn" data-target="#beranda" style="text-decoration: none; font-weight: 600; color: #153563;">
        <span>Beranda</span>
      </a>

      <!-- Alumni (menuju index alumni) -->
      <a href="{{ route('alumni.index') }}" class="nav-link-btn flex-between" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Alumni</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Lowongan (menuju index lowongan) -->
      <a href="{{ route('lowongan.index') }}" class="nav-link-btn flex-between" @guest data-auth-link data-auth-label="Lowongan Kerja" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Lowongan</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Event (menuju index event) -->
      <a href="{{ route('event.index') }}" class="nav-link-btn flex-between" @guest data-auth-link data-auth-label="Agenda Event" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Event</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Album (menuju index album) -->
      <a href="{{ route('album.index') }}" class="nav-link-btn flex-between" @guest data-auth-link data-auth-label="Album Foto" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Album</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Artikel (menuju index artikel) -->
      <a href="{{ route('artikel.index') }}" class="nav-link-btn" style="text-decoration: none; font-weight: 600; color: #153563;">
        <span>Artikel</span>
      </a>

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

  <!-- Menu Mobile (Disederhanakan jadi 6 menu utama) -->
  <div id="mobile-nav" class="mobile-nav-container">
    <div class="mobile-nav-content">
      <a class="mobile-link" href="#beranda" data-target="#beranda">Beranda</a>

      <a class="mobile-link flex-between" href="{{ route('alumni.index') }}">
        <span>Alumni</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link flex-between" href="{{ route('lowongan.index') }}">
        <span>Lowongan</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link flex-between" href="{{ route('event.index') }}">
        <span>Event</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link flex-between" href="{{ route('album.index') }}">
        <span>Album</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link" href="{{ route('artikel.index') }}">Artikel</a>

      <div class="mobile-auth-footer" style="margin-top: 1.5rem;">
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
