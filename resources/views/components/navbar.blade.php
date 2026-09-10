<header class="custom-header">
  <nav class="custom-nav-container" aria-label="Navigasi utama">
   <a href="#beranda" class="custom-logo" data-target="#beranda">
  <img src="{{ asset('assets/images/logo-as.png') }}" alt="Alumni Space" class="logo-spin" style="height: 2.25rem; width: auto;">
  <span class="logo-text">Alumni Space</span>
</a>

    <!-- Navigasi Utama Datar (Tanpa Dropdown) -->
    <div class="desktop-nav" style="align-items: center; gap: 1.5rem;">

      <!-- Beranda -->
<a href="{{ Request::routeIs('home') ? '#beranda' : route('home') . '#beranda' }}" class="nav-link-btn {{ Request::routeIs('home') ? 'active' : '' }}" style="text-decoration: none; font-weight: 600; color: #153563;">
  <span>Beranda</span>
</a>

      <!-- Alumni (menuju index alumni) -->
      <a href="{{ route('alumni.index') }}" class="nav-link-btn flex-between {{ Request::routeIs('alumni.*') ? 'active' : '' }}" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Alumni</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Lowongan (menuju index lowongan) -->
      <a href="{{ route('lowongan.index') }}" class="nav-link-btn flex-between {{ Request::routeIs('lowongan.*') ? 'active' : '' }}" @guest data-auth-link data-auth-label="Lowongan Kerja" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Lowongan</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Event (menuju index event) -->
      <a href="{{ route('event.index') }}" class="nav-link-btn flex-between {{ Request::routeIs('event.*') ? 'active' : '' }}" @guest data-auth-link data-auth-label="Agenda Event" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Event</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Album (menuju index album) -->
      <a href="{{ route('album.index') }}" class="nav-link-btn flex-between {{ Request::routeIs('album.*') ? 'active' : '' }}" @guest data-auth-link data-auth-label="Album Foto" @endguest style="text-decoration: none; font-weight: 600; color: #153563; display: inline-flex; align-items: center; gap: 4px;">
        <span>Album</span>
        @guest<i data-lucide="lock" class="icon-lock" style="width: 14px; height: 14px;"></i>@endguest
      </a>

      <!-- Artikel (menuju index artikel) -->
      <a href="{{ route('artikel.index') }}" class="nav-link-btn {{ Request::routeIs('artikel.*') ? 'active' : '' }}" style="text-decoration: none; font-weight: 600; color: #153563;">
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
        <a href="{{ route('admin.dashboard') }}" class="btn-admin" title="Buka Panel Admin">
          <span>⚡</span> <span class="hide-mobile">CMS Admin</span>
        </a>
        @endif
        <div class="profile-dropdown-wrap">
          <button type="button" id="profile-trigger" class="user-badge" aria-haspopup="true" aria-expanded="false">
            <span class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            <span class="hide-mobile">{{ Auth::user()->name }}</span>
          </button>

          <div id="profile-dropdown" class="profile-dropdown">
            <div class="profile-dropdown-header">
              <div class="profile-dropdown-avatar">
                @if(Auth::user()->profile && Auth::user()->profile->avatar)
                  <img src="{{ asset('storage/' . Auth::user()->profile->avatar) }}" alt="Avatar">
                @else
                  <span class="profile-dropdown-avatar-placeholder">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                  </span>
                @endif
              </div>
              <div class="profile-dropdown-text">
                <p class="profile-dropdown-name">{{ Auth::user()->name }}</p>
                <p class="profile-dropdown-email">{{ Auth::user()->email }}</p>
              </div>
            </div>

            @if(Auth::user()->profile && (Auth::user()->profile->graduation_year || Auth::user()->profile->profession))
              <div class="profile-dropdown-chips">
                @if(Auth::user()->profile->graduation_year)
                  <span class="profile-modal-chip">Angkatan {{ Auth::user()->profile->graduation_year }}</span>
                @endif
                @if(Auth::user()->profile->profession)
                  <span class="profile-modal-chip">{{ Auth::user()->profile->profession }}</span>
                @endif
              </div>
            @endif

            <a href="{{ route('profile.settings') }}" class="profile-dropdown-settings-btn">
              <i data-lucide="settings" class="icon-sm"></i> Setting Profile
            </a>
          </div>
        </div>
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
      <a class="mobile-link {{ Request::routeIs('home') ? 'active' : '' }}" href="#beranda" data-target="#beranda">Beranda</a>

      <a class="mobile-link flex-between {{ Request::routeIs('alumni.*') ? 'active' : '' }}" href="{{ route('alumni.index') }}">
        <span>Alumni</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link flex-between {{ Request::routeIs('lowongan.*') ? 'active' : '' }}" href="{{ route('lowongan.index') }}">
        <span>Lowongan</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link flex-between {{ Request::routeIs('event.*') ? 'active' : '' }}" href="{{ route('event.index') }}">
        <span>Event</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link flex-between {{ Request::routeIs('album.*') ? 'active' : '' }}" href="{{ route('album.index') }}">
        <span>Album</span> @guest<i data-lucide="lock" class="icon-sm text-blue"></i>@endguest
      </a>

      <a class="mobile-link {{ Request::routeIs('artikel.*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">Artikel</a>

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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const trigger = document.getElementById('profile-trigger');
    const dropdown = document.getElementById('profile-dropdown');

    if (!trigger || !dropdown) return;

    function openDropdown() {
      dropdown.classList.add('active');
      trigger.setAttribute('aria-expanded', 'true');
    }

    function closeDropdown() {
      dropdown.classList.remove('active');
      trigger.setAttribute('aria-expanded', 'false');
    }

    trigger.addEventListener('click', function (e) {
      e.stopPropagation();
      if (dropdown.classList.contains('active')) {
        closeDropdown();
      } else {
        openDropdown();
      }
    });

    // Klik di luar dropdown → tutup
    document.addEventListener('click', function (e) {
      if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
        closeDropdown();
      }
    });

    // Escape → tutup
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeDropdown();
    });
  });
</script>
