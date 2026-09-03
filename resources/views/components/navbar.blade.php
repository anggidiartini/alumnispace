<header class="sticky top-0 z-50 border-b border-blue-100 bg-[#fffdf7]/95 backdrop-blur">
  <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-3.5 md:px-8" aria-label="Navigasi utama">
    <a href="#beranda" class="js-nav-link focus-ring flex items-center gap-2 rounded-xl" data-target="#beranda">
      <span class="grid h-9 w-9 place-items-center rounded-xl bg-[#2e72ec] text-lg text-white shadow-sm logo-spin">✦</span>
      <span class="font-bold tracking-tight text-[#153563]">Alumni Space</span>
    </a>

    <div class="desktop-nav flex items-center gap-1 text-sm font-semibold">
      <div class="nav-drop relative">
        <button class="focus-ring nav-link flex items-center gap-1 rounded-lg px-3 py-2 text-[#153563]" type="button" data-dropdown aria-expanded="false" aria-controls="beranda-menu">
          <span>Beranda</span><i data-lucide="chevron-down" class="h-4 w-4"></i>
        </button>
        <div id="beranda-menu" class="drop-menu absolute left-0 top-full mt-2 w-44 rounded-2xl border border-blue-100 bg-white p-2 shadow-xl">
          <a class="js-nav-link focus-ring block rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#tentang" data-target="#tentang">Tentang</a>
          <a class="js-nav-link focus-ring block rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#statistik" data-target="#statistik">Statistik</a>
        </div>
      </div>

      <div class="nav-drop relative">
        <button class="focus-ring nav-link flex items-center gap-1 rounded-lg px-3 py-2 text-[#153563]" type="button" data-dropdown aria-expanded="false" aria-controls="community-menu">
          <span>Komunitas</span><i data-lucide="chevron-down" class="h-4 w-4"></i>
        </button>
        <div id="community-menu" class="drop-menu absolute left-0 top-full mt-2 w-52 rounded-2xl border border-blue-100 bg-white p-2 shadow-xl">
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest>
            <span>Alumni</span>
            @guest<i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>@endguest
          </a>
          <a class="js-nav-link focus-ring block rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#testimoni" data-target="#testimoni">Testimoni</a>
        </div>
      </div>

      <div class="nav-drop relative">
        <button class="focus-ring nav-link flex items-center gap-1 rounded-lg px-3 py-2 text-[#153563]" type="button" data-dropdown aria-expanded="false" aria-controls="media-menu">
          <span>Media</span><i data-lucide="chevron-down" class="h-4 w-4"></i>
        </button>
        <div id="media-menu" class="drop-menu absolute left-0 top-full mt-2 w-52 rounded-2xl border border-blue-100 bg-white p-2 shadow-xl">
          <a class="js-nav-link focus-ring block rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="articles">Artikel</a>
          <a class="js-nav-link focus-ring block rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="gallery">Galeri</a>
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album" @guest data-auth-link data-auth-label="Album Foto" @endguest>
            <span>Album</span>
            @guest<i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>@endguest
          </a>
        </div>
      </div>

      <div class="nav-drop relative">
        <button class="focus-ring nav-link flex items-center gap-1 rounded-lg px-3 py-2 text-[#153563]" type="button" data-dropdown aria-expanded="false" aria-controls="info-menu">
          <span>Informasi</span><i data-lucide="chevron-down" class="h-4 w-4"></i>
        </button>
        <div id="info-menu" class="drop-menu absolute right-0 top-full mt-2 w-52 rounded-2xl border border-blue-100 bg-white p-2 shadow-xl">
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan" @guest data-auth-link data-auth-label="Lowongan Kerja" @endguest>
            <span>Lowongan</span>
            @guest<i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>@endguest
          </a>
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event" @guest data-auth-link data-auth-label="Agenda Event" @endguest>
            <span>Event</span>
            @guest<i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>@endguest
          </a>
        </div>
      </div>
    </div>

    <div class="flex items-center gap-2">
      @guest
      <div id="guest-actions" class="flex items-center gap-2">
        <a href="{{ route('login') }}" class="custom-pill-btn px-6 py-2.5 text-sm">
          Masuk &rarr;
        </a>
      </div>
      @else
      <div id="user-actions" class="flex items-center gap-2">
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
        <a href="{{ route('admin.content.index') }}" class="focus-ring flex items-center gap-1.5 rounded-xl bg-[#fff0a9] border border-amber-300 px-3 py-1.5 text-xs font-bold text-[#153563] shadow-sm hover:bg-amber-100 transition" title="Buka Panel CMS & Pengaturan Situs">
          <span>⚡</span> <span class="hidden sm:inline">CMS Admin</span>
        </a>
        @endif
        <span class="flex items-center gap-2 rounded-xl bg-[#eaf3ff] px-3 py-2 text-sm font-bold text-[#153563]">
          <span id="user-avatar" class="grid h-7 w-7 place-items-center rounded-full bg-[#2e72ec] text-xs text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
          <span id="user-email-label" class="hidden sm:inline">{{ Auth::user()->name }}</span>
        </span>
        <form action="{{ route('logout') }}" method="POST" class="inline">
          @csrf
          <button type="submit" id="logout-btn" class="focus-ring flex items-center gap-1.5 rounded-xl border-2 border-[#2e72ec] px-3 py-2 text-sm font-bold text-[#2e72ec] transition hover:-translate-y-0.5 hover:bg-blue-50" title="Keluar dari akun">
            <i data-lucide="log-out" class="h-4 w-4"></i> <span class="hidden sm:inline text-xs">Keluar</span>
          </button>
        </form>
      </div>
      @endguest

      <button id="mobile-toggle" class="mobile-toggle focus-ring rounded-xl p-2 text-[#153563]" type="button" aria-label="Buka menu" aria-expanded="false">
        <i data-lucide="menu" class="h-6 w-6"></i>
      </button>
    </div>
  </nav>

  <div id="mobile-nav" class="mobile-nav border-t border-blue-100 bg-white px-5">
    <div class="grid gap-1 py-4 text-sm font-semibold">
      <p class="mobile-group-label">Beranda</p>
      <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#tentang" data-target="#tentang">Tentang</a>
      <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#statistik" data-target="#statistik">Statistik</a>

      <p class="mobile-group-label">Komunitas</p>
      <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest>
        <span>Alumni</span>
        @guest<i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i>@endguest
      </a>
      <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#testimoni" data-target="#testimoni">Testimoni</a>

      <p class="mobile-group-label">Media</p>
      <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="articles">Artikel</a>
      <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="gallery">Galeri</a>
      <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album" @guest data-auth-link data-auth-label="Album Foto" @endguest>
        <span>Album</span>
        @guest<i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i>@endguest
      </a>

      <p class="mobile-group-label">Informasi</p>
      <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan" @guest data-auth-link data-auth-label="Lowongan Kerja" @endguest>
        <span>Lowongan</span>
        @guest<i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i>@endguest
      </a>
      <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event" @guest data-auth-link data-auth-label="Agenda Event" @endguest>
        <span>Event</span>
        @guest<i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i>@endguest
      </a>

      <div class="mt-2 border-t border-blue-100 pt-3">
        @guest
        <a href="{{ route('login') }}" class="focus-ring block w-full rounded-xl bg-[#2e72ec] px-4 py-3 text-center text-sm font-bold text-white">Masuk / Login</a>
        @else
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="focus-ring flex w-full items-center justify-center gap-2 rounded-xl border-2 border-[#2e72ec] px-4 py-3 text-sm font-bold text-[#2e72ec]">
            <i data-lucide="log-out" class="h-4 w-4"></i> Keluar ({{ Auth::user()->name }})
          </button>
        </form>
        @endguest
      </div>
    </div>
  </div>
</header>
