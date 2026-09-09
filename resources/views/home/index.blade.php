<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="user-logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">
  <title>Alumni Connect</title>
=======
  <title>Alumni Space — Dashboard & Portal Alumni</title>
<<<<<<< HEAD
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
=======
>>>>>>> test-admin
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/home.css')) : time() }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ file_exists(public_path('css/footer.css')) ? filemtime(public_path('css/footer.css')) : time() }}">
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
<<<<<<< HEAD
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
<<<<<<< HEAD
              @guest
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni">
                  <span>Alumni</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
                </a>
              @else
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni">
                  <span>Alumni</span>
                </a>
              @endguest
=======
              <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest>
                <span>Alumni</span>
                @guest<i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>@endguest
              </a>
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
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
<<<<<<< HEAD
              @guest
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album" data-auth-link data-auth-label="Album Foto">
                  <span>Album</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
                </a>
              @else
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album">
                  <span>Album</span>
                </a>
              @endguest
=======
              <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album" @guest data-auth-link data-auth-label="Album Foto" @endguest>
                <span>Album</span>
                @guest<i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>@endguest
              </a>
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
            </div>
          </div>

          <div class="nav-drop relative">
            <button class="focus-ring nav-link flex items-center gap-1 rounded-lg px-3 py-2 text-[#153563]" type="button" data-dropdown aria-expanded="false" aria-controls="info-menu">
              <span>Informasi</span><i data-lucide="chevron-down" class="h-4 w-4"></i>
            </button>
            <div id="info-menu" class="drop-menu absolute right-0 top-full mt-2 w-52 rounded-2xl border border-blue-100 bg-white p-2 shadow-xl">
<<<<<<< HEAD
              @guest
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan" data-auth-link data-auth-label="Lowongan Kerja">
                  <span>Lowongan</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
                </a>
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event" data-auth-link data-auth-label="Agenda Event">
                  <span>Event</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
                </a>
              @else
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan">
                  <span>Lowongan</span>
                </a>
                <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event">
                  <span>Event</span>
                </a>
              @endguest
            </div>
          </div>
        </div>
        <div class="flex items-center gap-2">
          @guest
            <div id="guest-actions" class="flex items-center gap-2">
              <a href="{{ route('login') }}" class="focus-ring rounded-xl bg-[#2e72ec] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg inline-block text-center">
                Login
              </a>
            </div>
          @else
            <div id="user-actions" class="flex items-center gap-2">
              @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="focus-ring rounded-xl bg-amber-500 px-3 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-amber-600">
                  Dashboard Admin
                </a>
              @endif
              <span class="flex items-center gap-2 rounded-xl bg-[#eaf3ff] px-3 py-2 text-sm font-bold text-[#153563] sm:flex">
                <span id="user-avatar" class="grid h-7 w-7 place-items-center rounded-full bg-[#2e72ec] text-xs text-white">
                  {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->email, 0, 1)) }}
                </span>
                <span id="user-email-label">{{ Auth::user()->name ?? Auth::user()->email }}</span>
              </span>
              <button id="logout-btn" type="button" class="focus-ring rounded-xl border-2 border-[#2e72ec] px-3 py-2.5 text-sm font-bold text-[#2e72ec] transition hover:-translate-y-0.5" title="Keluar">
                <i data-lucide="log-out" class="h-4 w-4"></i>
              </button>
            </div>
          @endguest
=======
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

>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
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
<<<<<<< HEAD
          @guest
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni"><span>Alumni</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
          @else
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni"><span>Alumni</span></a>
          @endguest
=======
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest>
            <span>Alumni</span>
            @guest<i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i>@endguest
          </a>
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
          <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#testimoni" data-target="#testimoni">Testimoni</a>

          <p class="mobile-group-label">Media</p>
          <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="articles">Artikel</a>
          <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="gallery">Galeri</a>
<<<<<<< HEAD
          @guest
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album" data-auth-link data-auth-label="Album Foto"><span>Album</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
          @else
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album"><span>Album</span></a>
          @endguest
          <p class="mobile-group-label">Informasi</p>
          @guest
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan" data-auth-link data-auth-label="Lowongan Kerja"><span>Lowongan</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event" data-auth-link data-auth-label="Agenda Event"><span>Event</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
          @else
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan"><span>Lowongan</span></a>
            <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event"><span>Event</span></a>
          @endguest
          <div class="mt-2 border-t border-blue-100 pt-3">
            @guest
              <a href="{{ route('login') }}" class="focus-ring block w-full rounded-xl bg-[#2e72ec] px-4 py-3 text-center text-sm font-bold text-white">Login</a>
            @else
              @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="focus-ring mb-2 block w-full rounded-xl bg-amber-500 px-4 py-3 text-center text-sm font-bold text-white">Dashboard Admin</a>
              @endif
              <button id="mobile-logout-btn" type="button" class="focus-ring flex w-full items-center justify-center gap-2 rounded-xl border-2 border-[#2e72ec] px-4 py-3 text-sm font-bold text-[#2e72ec]">
                <i data-lucide="log-out" class="h-4 w-4"></i> Keluar
              </button>
=======
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
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
            @endguest
          </div>
        </div>
      </div>
    </header>
=======
    <x-navbar />
>>>>>>> test-admin

    <main>
      <!-- HERO SECTION -->
      <section id="beranda" class="grid-paper relative isolate overflow-hidden">
        <div class="blob blob-drift absolute -left-20 top-12 h-56 w-56 bg-[#ffd9e7] opacity-80"></div>

        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 py-16 md:grid-cols-2 md:px-8 md:py-24">
          <div class="relative z-10 reveal">
            @auth
            <p class="mb-4 inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold">
              <span></span> Selamat datang, {{ Auth::user()->name }}! (Alumni Terverifikasi)
            </p>
            <h1 class="max-w-xl text-5xl font-bold leading-[.98] tracking-tight text-[#153563] md:text-7xl">{{ $contents['hero_banner']->title ?? 'Ruang temu kita semua.' }}</h1>
            <p class="mt-6 max-w-lg text-lg leading-relaxed text-[#355277]">{{ $contents['hero_banner']->subtitle ?? 'Seluruh fitur direktori, album kenangan, bursa lowongan, dan agenda gathering kini terbuka untukmu!' }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
              <a class="js-nav-link custom-pill-btn px-6 py-3.5 text-base" href="#alumni" data-target="#alumni">Buka Direktori Alumni</a>
              <a class="js-nav-link custom-white-pill-btn px-6 py-3.5 text-base" href="#lowongan" data-target="#lowongan">Lihat Lowongan</a>
            </div>
            @else
            <p class="mb-4 inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold"> {{ $contents['hero_banner']->meta_data['badge'] ?? 'Ruang hangat untuk kita' }}</p>
            <h1 class="max-w-xl text-5xl font-bold leading-[.98] tracking-tight text-[#153563] md:text-7xl">{{ $contents['hero_banner']->title ?? 'Satu komunitas, banyak cerita' }}</h1>
            <p class="mt-6 max-w-lg text-lg leading-relaxed text-[#355277]">{{ $contents['hero_banner']->subtitle ?? 'Tempat pulang untuk terhubung, bertukar kabar, dan tumbuh bersama alumni lintas angkatan.' }}</p>
           <div class="mt-8 flex flex-wrap gap-3">
  <a class="js-nav-link custom-pill-btn px-6 py-3.5 text-base" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni">Masuk Untuk Membuka Fitur</a>
  <a class="js-nav-link custom-white-pill-btn px-6 py-3.5 text-base" href="#testimoni" data-target="#testimoni">Jelajahi Dulu</a>
</div>
            @endauth

            <div class="mt-9 flex items-center gap-3">
              <div class="flex -space-x-2" aria-label="Avatar komunitas">
                <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white bg-[#ffafca] text-xs font-bold">KS</span>
                <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white bg-[#ffe88b] text-xs font-bold">RP</span>
                <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white bg-[#a8d3ff] text-xs font-bold">NZ</span>
              </div>
              <p class="text-sm font-medium text-[#355277]"><strong>{{ number_format($stats['total_alumni'] ?? 2540) }}+</strong> teman alumni sudah terdaftar!</p>
            </div>
          </div>



         <div class="relative mx-auto w-full max-w-lg reveal flex items-center justify-center" style="animation-delay:.15s">
    <div class="checker blob aspect-square w-full max-w-[480px] p-7 flex items-center justify-center">
        <div class="relative z-20 flex items-center justify-center">
            <div class="relative w-[410px] h-[410px] md:w-[480px] md:h-[480px] flex items-center justify-center drop-shadow-2xl">
                <span class="absolute -top-2 right-6 z-30 text-pink-400 text-3xl animate-pulse">🌸</span>
                <span class="absolute -bottom-2 left-4 z-30 text-pink-400 text-2xl animate-bounce">🌸</span>
                <div class="absolute inset-0 bg-white shadow-xl transition hover:scale-105 duration-300"
                     style="clip-path: polygon(50% 0%, 65% 5%, 78% 2%, 88% 12%, 98% 22%, 95% 35%, 100% 50%, 95% 65%, 98% 78%, 88% 88%, 78% 98%, 65% 95%, 50% 100%, 35% 95%, 22% 98%, 12% 88%, 2% 78%, 5% 65%, 0% 50%, 5% 35%, 2% 22%, 12% 12%, 22% 2%, 35% 5%);">
                </div>
                <div class="absolute inset-[9px] bg-[#fff0a9]"
                     style="clip-path: polygon(50% 0%, 65% 5%, 78% 2%, 88% 12%, 98% 22%, 95% 35%, 100% 50%, 95% 65%, 98% 78%, 88% 88%, 78% 98%, 65% 95%, 50% 100%, 35% 95%, 22% 98%, 12% 88%, 2% 78%, 5% 65%, 0% 50%, 5% 35%, 2% 22%, 12% 12%, 22% 2%, 35% 5%);">
                </div>
                <div class="absolute inset-[18px] overflow-hidden bg-white"
                     style="clip-path: polygon(50% 0%, 65% 5%, 78% 2%, 88% 12%, 98% 22%, 95% 35%, 100% 50%, 95% 65%, 98% 78%, 88% 88%, 78% 98%, 65% 95%, 50% 100%, 35% 95%, 22% 98%, 12% 88%, 2% 78%, 5% 65%, 0% 50%, 5% 35%, 2% 22%, 12% 12%, 22% 2%, 35% 5%);">
                    <img src="{{ asset('assets/images/foto04.png') }}"
                         alt="Alumni Spotlight"
                         class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </div>
</div>
      </section>



      <!-- TENTANG KAMI -->
      <section id="tentang" class="relative isolate overflow-hidden">
  <div class="blob blob-drift absolute h-56 w-56 bg-[#a8d3ff] opacity-80" style="right: -5rem; top: 2rem;"></div>
  <div class="mx-auto max-w-7xl px-5 py-20">
    <div class="tentang-container">

          <!-- KOLASE DI KIRI -->
          <div class="kolase-wrapper reveal-onscroll">
            <div class="blob-bg"></div>
            <div class="kolase-grid">
              <div class="kolase-col">
                <div class="kolase-img-box"><img src="{{ asset('assets/images/foto01.png') }}" alt="Foto 1"></div>
                <div class="kolase-img-box"><img src="{{ asset('assets/images/foto02.png') }}" alt="Foto 2"></div>
              </div>
              <div class="kolase-col pt-4">
                <div class="kolase-img-box"><img src="{{ asset('assets/images/foto03.png') }}" alt="Foto 3"></div>
                <div class="kolase-img-box"><img src="{{ asset('assets/images/foto04.png') }}" alt="Foto 4"></div>
              </div>
            </div>
            <div class="badge-hello">✦ hello alumni!</div>
          </div>

          <!-- TEKS DI KANAN -->
          <div class="teks-wrapper reveal-onscroll">
            <p class="mb-4 inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold">{{ $contents['about_section']->meta_data['badge'] ?? 'Tentang kami' }}</p>
            <h2 class="text-3xl font-bold leading-tight text-[#153563] md:text-4xl lg:text-5xl">{{ $contents['about_section']->title ?? 'Jalin kembali koneksi yang berarti.' }}</h2>
            <p class="mt-4 text-base leading-relaxed text-[#355277] md:text-lg">{{ $contents['about_section']->subtitle ?? 'Alumni Space adalah ruang komunitas yang memudahkanmu menemukan teman lama, membuka peluang baru, dan merayakan setiap langkah bersama.' }}</p>
          </div>

        </div>
      </section>

      <!-- STATISTIK -->
      <section id="statistik" class="relative overflow-hidden bg-[#eaf3ff] grid-paper-dark py-20">
  <div class="blob blob-drift absolute -left-20 top-12 h-56 w-56 bg-[#ffd9e7] opacity-80"></div>
  <div class="mx-auto max-w-7xl px-5 md:px-8">
    <div class="mb-9 flex flex-wrap items-end justify-between gap-4 reveal-onscroll">
            <div>
              <p class="mb-3 inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold">Angka yang bikin senyum</p>
              <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Kita tumbuh bareng.</h2>
            </div>
            <p class="max-w-sm text-sm leading-relaxed text-[#355277]">Data statistik komunitas alumni yang selalu aktif diperbarui.</p>
          </div>
          <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <article class="stat-card card-v1 reveal-onscroll rounded-[1.75rem] p-6" data-count="{{ $stats['total_alumni'] ?? 2540 }}" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#2e72ec]">{{ number_format($stats['total_alumni'] ?? 2540) }}+</p>
              <p class="mt-2 font-medium text-[#153563]">Alumni terhubung</p>
            </article>
            <article class="stat-card card-v2 reveal-onscroll rounded-[1.75rem] p-6" style="transition-delay:.05s" data-count="{{ $stats['total_generations'] ?? 45 }}" data-suffix="">
              <p class="stat-number text-4xl font-bold text-[#153563]">{{ $stats['total_generations'] ?? 45 }}</p>
              <p class="mt-2 font-medium text-[#153563]">Angkatan</p>
            </article>
            <article class="stat-card card-v3 reveal-onscroll rounded-[1.75rem] p-6" style="transition-delay:.1s" data-count="{{ $stats['total_jobs'] ?? 180 }}" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#153563]">{{ $stats['total_jobs'] ?? 180 }}+</p>
              <p class="mt-2 font-medium text-[#153563]">Lowongan terverifikasi</p>
            </article>
            <article class="stat-card card-v4 reveal-onscroll rounded-[1.75rem] p-6" style="transition-delay:.15s" data-count="{{ count($events ?? []) ?: 40 }}" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#153563]">{{ count($events ?? []) ?: 40 }}+</p>
              <p class="mt-2 font-medium text-[#153563]">Event seru terlaksana</p>
            </article>
          </div>
        </div>
      </section>

<<<<<<< HEAD
      <section id="locked-teaser" class="mx-auto max-w-7xl px-5 py-20 md:px-8 @auth hidden-teaser @endauth">
=======
      <!-- GATED TEASER (HANYA MUNCUL KETIKA BELUM LOGIN) -->
      @guest
      <section id="locked-teaser" class="mx-auto max-w-7xl px-5 py-20 md:px-8">
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
        <div class="reveal-onscroll rounded-[2.5rem] border-2 border-dashed border-[#a8d3ff] bg-[#f8fbff] p-6 md:p-10">
          <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
              <p class="mb-3 inline-flex items-center gap-2 rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold"><i data-lucide="lock" class="h-4 w-4"></i> {{ $contents['locked_teaser']->meta_data['badge'] ?? 'Khusus alumni terdaftar' }}</p>
              <h2 class="text-3xl font-bold text-[#153563] md:text-4xl">{{ $contents['locked_teaser']->title ?? '4 fitur seru menanti setelah kamu login.' }}</h2>
              <p class="mt-2 max-w-lg text-sm leading-relaxed text-[#355277]">{{ $contents['locked_teaser']->subtitle ?? 'Direktori alumni, album kenangan, lowongan, dan agenda event hanya bisa dibuka oleh alumni yang sudah login.' }}</p>
            </div>
            <a href="{{ route('login') }}" class="custom-pill-btn px-6 py-3.5 text-base shrink-0">{{ $contents['locked_teaser']->meta_data['button_text'] ?? 'Login sekarang 🚀' }}</a>
          </div>
          <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="teaser-card card-v1 rounded-[1.5rem] p-5 shadow-sm">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#a8d3ff] text-xl">👥</span>
              <h3 class="mt-4 font-bold text-[#153563]">Direktori Alumni</h3>
              <p class="mt-1 text-sm text-[#355277]">Cari & sapa teman seangkatan.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
            <div class="teaser-card card-v2 rounded-[1.5rem] p-5 shadow-sm" style="transition-delay:.05s">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#ffd9e7] text-xl">🖼️</span>
              <h3 class="mt-4 font-bold text-[#153563]">Album Foto</h3>
              <p class="mt-1 text-sm text-[#355277]">Kenangan reuni & kegiatan sekolah.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
            <div class="teaser-card card-v3 rounded-[1.5rem] p-5 shadow-sm" style="transition-delay:.1s">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#fff0a9] text-xl">💼</span>
              <h3 class="mt-4 font-bold text-[#153563]">Lowongan Kerja</h3>
              <p class="mt-1 text-sm text-[#355277]">Peluang karier dari sesama alumni.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
            <div class="teaser-card card-v4 rounded-[1.5rem] p-5 shadow-sm" style="transition-delay:.15s">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#cce8de] text-xl">📅</span>
              <h3 class="mt-4 font-bold text-[#153563]">Agenda Event</h3>
              <p class="mt-1 text-sm text-[#355277]">Meetup, workshop & reuni terdekat.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
          </div>
        </div>
      </section>
      @endguest

<<<<<<< HEAD
=======
      <!-- FITUR 1: DIREKTORI ALUMNI (GATED) -->
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
      <section id="alumni" class="auth-section @auth unlocked @endauth mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="flex flex-wrap items-end justify-between gap-6 reveal-onscroll">
          <div>
            <p class="mb-3 inline-flex rounded-full bg-[#eaf3ff] px-4 py-2 text-sm font-bold text-[#153563]">{{ $contents['alumni_section']->meta_data['badge'] ?? 'Direktori alumni' }}</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">{{ $contents['alumni_section']->title ?? 'Temukan teman seperjalanan.' }}</h2>
          </div>
          <p class="max-w-sm text-sm leading-relaxed text-[#355277]">{{ $contents['alumni_section']->subtitle ?? 'Jelajahi profil ribuan alumni terverifikasi almamater.' }}</p>
        </div>
        <div class="mt-8 flex flex-wrap gap-3 rounded-[1.5rem] border border-blue-100 bg-[#f8fbff] p-3 reveal-onscroll">
          <label class="sr-only" for="year-filter">Filter angkatan</label>
          <select id="year-filter" class="focus-ring rounded-xl border border-blue-100 bg-white px-4 py-3 text-sm font-semibold text-[#153563]">
            <option value="all">Semua angkatan</option>
            <option value="2020">Angkatan 2020</option>
            <option value="2019">Angkatan 2019</option>
            <option value="2018">Angkatan 2018</option>
            <option value="2017">Angkatan 2017</option>
            <option value="2016">Angkatan 2016</option>
            <option value="2015">Angkatan 2015</option>
          </select>
          <label class="sr-only" for="field-filter">Filter bidang</label>
          <select id="field-filter" class="focus-ring rounded-xl border border-blue-100 bg-white px-4 py-3 text-sm font-semibold text-[#153563]">
            <option value="all">Semua bidang</option>
            <option value="teknologi">Teknologi & IT</option>
            <option value="kreatif">Kreatif & Desain</option>
            <option value="sosial">Manajemen & Lainnya</option>
          </select>
          <p class="self-center px-2 text-sm text-[#355277]">Pilih filter untuk menemukan orangmu.</p>
        </div>
        <div id="alumni-list" class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
          @forelse(collect($alumni ?? [])->take(4) as $index => $alum)
          <article class="alumni-card card-v{{ ($index % 4) + 1 }} reveal-onscroll rounded-[1.75rem] p-5 shadow-sm" data-year="{{ $alum->graduation_year }}" data-field="{{ str_contains(strtolower($alum->profession ?? ''), 'engineer') || str_contains(strtolower($alum->profession ?? ''), 'tech') ? 'teknologi' : (str_contains(strtolower($alum->profession ?? ''), 'designer') || str_contains(strtolower($alum->profession ?? ''), 'creator') ? 'kreatif' : 'sosial') }}">
            <div class="flex items-start justify-between">
              @if($alum->avatar)
                <img src="{{ $alum->avatar }}" alt="{{ $alum->user?->name }}" class="h-14 w-14 rounded-2xl object-cover border border-blue-100">
              @else
                <span class="grid h-14 w-14 place-items-center rounded-2xl bg-[#a8d3ff] font-bold text-[#153563]">{{ strtoupper(substr($alum->user?->name ?? 'A', 0, 2)) }}</span>
              @endif
              <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">Angkatan {{ $alum->graduation_year }}</span>
            </div>
            <h3 class="mt-5 text-xl font-bold text-[#153563]">{{ $alum->user?->name ?? 'Alumni' }}</h3>
            <p class="mt-1 text-sm text-[#355277]">{{ $alum->profession ?? 'Alumni Member' }}</p>
            <p class="mt-3 text-sm font-medium text-[#153563]">📍 {{ $alum->city ?? 'Indonesia' }}</p>
            <a href="{{ route('alumni.index') }}" class="focus-ring card-btn custom-white-pill-btn block w-full">Sapa Profil</a>
          </article>
          @empty
          <p class="text-sm text-[#355277]">Belum ada data alumni.</p>
          @endforelse
        </div>
        <p id="alumni-empty" class="mt-8 hidden rounded-2xl bg-[#fff5f8] p-5 text-center font-medium text-[#153563]">Belum ada alumni dengan filter ini. Coba pilihan lain, ya!</p>
       <div class="mt-6 text-right reveal-onscroll">
  <a href="{{ route('alumni.index') }}" class="text-sm font-bold text-[#153563] hover:underline">Lihat Selengkapnya</a>
</div>
      </section>

      <!-- TESTIMONI -->
<section id="testimoni" class="relative overflow-hidden bg-[#153563] py-20 text-white">
  <span class="absolute left-8 top-8 text-5xl text-[#fff0a9] floaty-slow">✦</span>
  <span class="absolute bottom-5 right-10 text-7xl text-[#ffb8d0] floaty">⌁</span>
  <div class="mx-auto max-w-6xl px-5 text-center md:px-8">
    <p class="mb-4 inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold reveal-onscroll">Cerita dari teman</p>
    <h2 class="text-4xl font-bold text-white md:text-5xl reveal-onscroll">Koneksi kecil, dampak besar.</h2>

    <div class="testi-carousel-wrap mt-12 reveal-onscroll">
  <button id="prev-testimonial" type="button" class="testi-arrow focus-ring" aria-label="Testimoni sebelumnya">
    <i data-lucide="chevron-left" class="h-5 w-5"></i>
  </button>

  <div class="testi-viewport">
    <div class="testi-track" id="testi-track">
      @forelse($testimonials ?? [] as $index => $testi)
      <article class="testi-card" data-index="{{ $index }}">
        <span class="testi-quote-mark">&ldquo;</span>
        <div class="testi-stars" aria-label="Rating {{ $testi->rating ?? 5 }} dari 5">
          @for ($s = 1; $s <= 5; $s++)
            <i data-lucide="star" class="h-4 w-4 {{ $s <= ($testi->rating ?? 5) ? 'is-filled' : '' }}"></i>
          @endfor
        </div>
        <p class="testi-quote">{{ $testi->quote }}</p>
        <div class="testi-footer">
          @if($testi->avatar)
            <img src="{{ $testi->avatar }}" alt="{{ $testi->name }}" class="h-10 w-10 shrink-0 rounded-full object-cover border-2 border-[#eaf3ff]">
          @else
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-[#ffd9e7] font-bold text-[#153563] text-sm">{{ strtoupper(substr($testi->name, 0, 2)) }}</span>
          @endif
          <div class="text-left">
            <p class="font-bold text-[#153563] text-sm">{{ $testi->name }}</p>
            <p class="text-xs font-semibold text-[#6f9fe8]">{{ $testi->profession ?? ('Angkatan ' . $testi->graduation_year) }}</p>
          </div>
        </div>
      </article>
      @empty
      <article class="testi-card" data-index="0">
        <span class="testi-quote-mark">&ldquo;</span>
        <div class="testi-stars">@for ($s = 1; $s <= 5; $s++)<i data-lucide="star" class="h-4 w-4 is-filled"></i>@endfor</div>
        <p class="testi-quote">Lewat Alumni Space, aku bertemu lagi dengan teman sekelas yang akhirnya jadi partner proyek startup!</p>
        <div class="testi-footer">
          <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-[#ffd9e7] font-bold text-[#153563] text-sm">AL</span>
          <div class="text-left">
            <p class="font-bold text-[#153563] text-sm">Alya Lestari</p>
            <p class="text-xs font-semibold text-[#6f9fe8]">Angkatan 2015</p>
          </div>
        </div>
      </article>
      @endforelse
    </div>
  </div>

  <button id="next-testimonial" type="button" class="testi-arrow focus-ring" aria-label="Testimoni berikutnya">
    <i data-lucide="chevron-right" class="h-5 w-5"></i>
  </button>
</div>

<div class="testi-dots mt-7" id="testi-dots"></div>
  </div>
</section>
      <!-- SECTION 1: GALERI (KOLASE) -->
<section id="galeri" class="mx-auto max-w-7xl px-5 py-20 md:px-8">
  <div class="flex flex-wrap items-end justify-between gap-5 reveal-onscroll">
    <div>
      <p class="mb-3 inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold">Media komunitas</p>
      <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Galeri momen pilihan.</h2>
    </div>
  </div>

  <div class="mt-9 galeri-kolase-grid">
    <div class="g-item pop-card galeri-photo flex items-end rounded-[1.75rem]" data-bg="{{ asset('assets/images/image2.png') }}">
    </div>
    <div class="g-item pop-card galeri-photo flex items-end rounded-[1.75rem]" data-bg="{{ asset('assets/images/image3.png') }}">

    </div>
    <div class="g-item pop-card galeri-photo flex items-end rounded-[1.75rem]" data-bg="{{ asset('assets/images/image1.png') }}">

    </div>
    <div class="g-item pop-card galeri-photo flex items-end rounded-[1.75rem]" data-bg="{{ asset('assets/images/image7.png') }}">

    </div>
    <div class="g-item pop-card galeri-photo flex items-end rounded-[1.75rem]" data-bg="{{ asset('assets/images/image8.png') }}">

    </div>
    <div class="g-item pop-card galeri-photo flex items-end rounded-[1.75rem]" data-bg="{{ asset('assets/images/image9.png') }}">

    </div>
  </div>
</section>
      <!-- SECTION 2: ARTIKEL (Diperluas jarak bawahnya menjadi pb-32) -->
      <section id="artikel-section" class="mx-auto max-w-7xl px-5 pb-32 md:px-8">
        <div class="flex flex-wrap items-end justify-between gap-5 reveal-onscroll">
          <div>
            <p class="mb-3 inline-flex rounded-full badge-dashed-pill px-4 py-2 text-sm font-bold">Bacaan santai</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Artikel & kabar terbaru.</h2>
          </div>
        </div>

        <div class="mt-9">
          <div class="grid gap-5 md:grid-cols-3">
            @forelse($articles ?? [] as $index => $article)
            <article class="pop-card card-v{{ ($index % 4) + 1 }} reveal-onscroll rounded-[1.75rem] p-6">
              <span class="inline-block rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">{{ strtoupper($article->category) }}</span>
              <h3 class="mt-4 text-2xl font-bold text-[#153563]">{{ $article->title }}</h3>
              <p class="mt-3 leading-relaxed text-[#355277]">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 80) }}</p>
              <p class="mt-5 text-sm font-bold text-[#153563]">{{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d F Y') }}</p>
            </article>
            @empty
            <article class="pop-card card-v1 rounded-[1.75rem] p-6">
              <span class="inline-block rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">KABAR KAMPUS</span>
              <h3 class="mt-4 text-2xl font-bold text-[#153563]">Reuni yang jadi awal kolaborasi</h3>
              <p class="mt-3 leading-relaxed text-[#355277]">Tiga alumni mengubah obrolan reuni menjadi proyek kreatif yang seru.</p>
              <p class="mt-5 text-sm font-bold text-[#153563]">28 Agustus 2026</p>
            </article>
            @endforelse
          </div>
          <div class="mt-6 text-right reveal-onscroll">
            <a href="{{ route('artikel.index') }}" class="text-sm font-bold text-[#153563] hover:underline">Lihat Selengkapnya</a>
          </div>
        </div>
      </section>

<<<<<<< HEAD
=======
      <!-- FITUR 2: ALBUM KENANGAN (GATED) -->
<<<<<<< HEAD
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
      <section id="album" class="auth-section @auth unlocked @endauth bg-[#f5f9ff] py-20">
=======
      <section id="album" class="auth-section @auth unlocked @endauth bg-[#f5f9ff] grid-paper-dark py-20">
>>>>>>> test-admin
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="reveal-onscroll">
            <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Album komunitas</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Kenangan yang tersimpan rapi.</h2>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Koleksi album foto kenangan masa sekolah khusus untuk alumni yang sudah login.</p>
          </div>
          <div class="mt-9 grid gap-5 md:grid-cols-4">
            @forelse($albums ?? [] as $index => $album)
            <article class="pop-card card-v{{ ($index % 4) + 1 }} reveal-onscroll rounded-[1.75rem] p-6">
              <span class="text-4xl">📸</span>
              <h3 class="mt-6 text-2xl font-bold text-[#153563]">{{ $album->title }}</h3>
              <p class="mt-2 text-sm text-[#355277]">{{ $album->subtitle_label ?? $album->target_generation }} · {{ $album->location }}</p>
              <a href="{{ route('album.index') }}" class="focus-ring card-btn custom-white-pill-btn inline-block">Buka Album</a>
            </article>
            @empty
            <p class="text-sm text-[#355277]">Belum ada album foto.</p>
            @endforelse
          </div>
          <div class="mt-6 text-right reveal-onscroll">
            <a href="{{ route('album.index') }}" class="text-sm font-bold text-[#153563] hover:underline">Lihat Selengkapnya</a>
          </div>
        </div>
      </section>

<<<<<<< HEAD
=======
      <!-- FITUR 3: LOWONGAN KERJA (GATED) -->
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
      <section id="lowongan" class="auth-section @auth unlocked @endauth mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="reveal-onscroll">
          <p class="mb-3 inline-flex rounded-full bg-[#eaf3ff] px-4 py-2 text-sm font-bold text-[#153563]">Karier &amp; peluang</p>
          <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Lowongan pilihan untukmu.</h2>
          <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Info bursa kerja & magang terverifikasi dari perusahaan partner alumni.</p>
        </div>
        <div class="mt-9 grid gap-4 md:grid-cols-3">
          @forelse(collect($jobs ?? [])->take(3) as $index => $job)
          <article class="job-card card-v{{ ($index % 4) + 1 }} reveal-onscroll rounded-[1.5rem] p-5 shadow-sm">
            <div class="flex flex-wrap items-start justify-between gap-3">
              <div>
                <h4 class="text-xl font-bold text-[#153563]">{{ $job->title }}</h4>
                <p class="mt-1 text-[#355277] text-sm">{{ $job->company_name }} • ({{ $job->alumni_contact ?? 'Alumni Partner' }})</p>
              </div>
              <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#2e72ec]">{{ $job->job_type }}</span>
            </div>
            <p class="mt-4 text-sm text-[#355277]">{{ $job->location }} · <strong>{{ $job->salary_display }}</strong></p>
            <a href="{{ route('lowongan.show', $job->slug) }}" class="focus-ring card-btn custom-white-pill-btn inline-block">Lamar Sekarang</a>
          </article>
          @empty
          <p class="text-sm text-[#355277]">Belum ada lowongan kerja aktif.</p>
          @endforelse
        </div>
        <div class="mt-6 text-right reveal-onscroll">
          <a href="{{ route('lowongan.index') }}" class="text-sm font-bold text-[#153563] hover:underline">Lihat Selengkapnya</a>
        </div>
      </section>

<<<<<<< HEAD
=======
      <!-- FITUR 4: AGENDA EVENT (GATED) -->
<<<<<<< HEAD
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
      <section id="event" class="auth-section @auth unlocked @endauth bg-[#eaf3ff] py-20">
=======
      <section id="event" class="auth-section @auth unlocked @endauth bg-[#eaf3ff] grid-paper-dark py-20">
>>>>>>> test-admin
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="reveal-onscroll">
            <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Agenda komunitas</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Jangan sampai ketinggalan momennya.</h2>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Meetup, webinar, dan reuni seru yang hanya bisa diikuti alumni login.</p>
          </div>
          <div class="mt-9 grid gap-4 md:grid-cols-3">
            @forelse($events ?? [] as $index => $event)
            <article class="event-card card-v{{ ($index % 4) + 1 }} reveal-onscroll flex gap-4 rounded-[1.5rem] p-5 shadow-sm">
              <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-white text-center">
                <span class="font-bold text-[#153563]" style="line-height:1">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}<br>{{ strtoupper(\Carbon\Carbon::parse($event->event_date)->format('M')) }}</span>
              </div>
              <div class="min-w-0">
                <span class="text-xs font-bold text-[#c8517d]">{{ strtoupper($event->category) }}</span>
                <h4 class="mt-1 text-xl font-bold text-[#153563] truncate">{{ $event->title }}</h4>
                <p class="mt-1 text-sm text-[#355277]">{{ $event->time_display ?? ($event->venue ?? 'Online') }}</p>
                <a href="{{ route('event.index') }}" class="focus-ring card-btn custom-white-pill-btn inline-block">Ikuti Event</a>
              </div>
            </article>
            @empty
            <p class="text-sm text-[#355277]">Belum ada agenda event mendatang.</p>
            @endforelse
          </div>
          <div class="mt-6 text-right reveal-onscroll">
            <a href="{{ route('event.index') }}" class="text-sm font-bold text-[#153563] hover:underline">Lihat Selengkapnya</a>
          </div>
        </div>
      </section>
    </main>

    <x-footer />
  </div>

<<<<<<< HEAD
  <!-- Login Modal -->
  <div id="login-modal" class="modal fixed inset-0 z-[60] grid place-items-center bg-[#153563]/45 p-5" role="dialog" aria-modal="true" aria-labelledby="login-title">
    <div class="modal-card w-full max-w-md rounded-[2rem] bg-white p-7 shadow-2xl">
      <div class="flex items-start justify-between gap-4">
        <div>
          <p class="inline-block rounded-full bg-[#fff0a9] px-3 py-1 text-xs font-bold text-[#153563]">LOGIN ALUMNI</p>
          <h2 id="login-title" class="mt-3 text-3xl font-bold text-[#153563]">Halo, teman alumni!</h2>
        </div>
        <button id="close-login" class="focus-ring rounded-xl p-2" type="button" aria-label="Tutup login"><i data-lucide="x" class="h-5 w-5"></i></button>
      </div>
      <p class="mt-3 leading-relaxed text-[#355277]">Login untuk membuka Direktori Alumni, Album, Lowongan, dan Event.</p>
      <form id="login-form" class="mt-6" action="{{ route('login.post') }}" method="POST">
        @csrf
        <label class="mb-2 block text-sm font-bold text-[#153563]" for="login-email">Email</label>
        <input id="login-email" name="email" class="focus-ring w-full rounded-xl border border-blue-200 px-4 py-3" type="email" placeholder="nama@email.com" required>
        <label class="mb-2 mt-4 block text-sm font-bold text-[#153563]" for="login-password">Kata Sandi</label>
        <input id="login-password" name="password" class="focus-ring w-full rounded-xl border border-blue-200 px-4 py-3" type="password" placeholder="••••••••" required>
        <button class="focus-ring mt-4 w-full rounded-xl bg-[#2e72ec] px-4 py-3 font-bold text-white transition hover:-translate-y-0.5" type="submit">Lanjutkan</button>
      </form>
      <p id="login-result" class="mt-4 text-center text-sm text-[#355277]">Halaman ini menggunakan tampilan demo dan tidak menyimpan data akun ke server.</p>
    </div>
  </div>

  <!-- Floating action buttons: tombol scroll-ke-atas & WhatsApp sejajar di baris yang sama -->
=======
  <!-- Floating action buttons: tombol scroll-ke-atas & WhatsApp -->
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
  <div id="fab-row" class="fixed bottom-5 right-5 z-[65] flex items-center gap-3 md:bottom-8 md:right-8">
    <button id="back-to-top" type="button" class="focus-ring grid h-11 w-11 shrink-0 place-items-center rounded-full bg-[#153563] text-white shadow-xl md:h-12 md:w-12" aria-label="Kembali ke atas">
      <i data-lucide="arrow-up" class="h-5 w-5"></i>
    </button>

    <div id="wa-widget" class="relative shrink-0">
      <div id="wa-bubble" class="wa-bubble absolute bottom-full right-0 mb-3 w-60 rounded-2xl bg-white p-4 shadow-2xl sm:w-64">
        <div class="flex items-start justify-between gap-2">
          <p class="text-sm font-bold text-[#153563]">Ada pertanyaan?</p>
          <button id="wa-bubble-close" type="button" class="focus-ring rounded-lg p-1 text-[#355277]" aria-label="Tutup"><i data-lucide="x" class="h-4 w-4"></i></button>
        </div>
        <p class="mt-1 text-sm leading-relaxed text-[#355277]">Hubungi pengurus alumni kami via WhatsApp 👋</p>
        <p class="mt-2 text-sm font-bold text-[#2e72ec]">{{ $settings['whatsapp_number'] ?? '+62 812-3456-7890' }}</p>
      </div>
      <a id="wa-button" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}?text=Halo%20{{ urlencode($settings['brand_name'] ?? 'Alumni Connect') }}" target="_blank" rel="noopener" class="focus-ring wa-pulse grid h-14 w-14 place-items-center rounded-full bg-[#25D366] text-white shadow-xl" aria-label="Hubungi kami via WhatsApp">
        <i data-lucide="message-circle" class="h-7 w-7"></i>
      </a>
    </div>
  </div>

  <div id="toast" class="toast fixed bottom-5 left-1/2 z-[70] -translate-x-1/2 rounded-full bg-[#153563] px-5 py-3 text-sm font-bold text-white shadow-xl" role="status"></div>

<<<<<<< HEAD
  <script>
    @auth
      localStorage.setItem("ac_logged_in", "true");
      localStorage.setItem("ac_user_email", "{{ Auth::user()->email }}");
    @else
      localStorage.setItem("ac_logged_in", "false");
      localStorage.removeItem("ac_user_email");
    @endauth
  </script>
  <script src="{{ asset('js/script.js') }}"></script>
=======
 <script src="{{ asset('js/script.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const isGuest = document.body.getAttribute('data-isGuest') === 'true';

      // Menangkap semua klik pada link atau tombol yang membutuhkan autentikasi
      document.addEventListener('click', function (e) {
        const authTrigger = e.target.closest('[data-auth-link]');

        if (authTrigger && isGuest) {
          e.preventDefault();
          e.stopPropagation();
          const label = authTrigger.getAttribute('data-auth-label') || 'halaman ini';
          if (confirm('Anda harus masuk terlebih dahulu untuk mengakses ' + label + '. Lanjut ke halaman login?')) {
            window.location.href = "{{ route('login') }}";
          }
        }
      });
    });
  </script>
>>>>>>> test-admin
</body>
</html>
