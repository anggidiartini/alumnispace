<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni Connect — Dashboard & Portal Alumni</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/home.css')) : time() }}">
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
<body>
  <div class="page-wrap">
    <header class="sticky top-0 z-50 border-b border-blue-100 bg-[#fffdf7]/95 backdrop-blur">
      <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-3.5 md:px-8" aria-label="Navigasi utama">
        <a href="#beranda" class="js-nav-link focus-ring flex items-center gap-2 rounded-xl" data-target="#beranda">
          <span class="grid h-9 w-9 place-items-center rounded-xl bg-[#2e72ec] text-lg text-white shadow-sm logo-spin">✦</span>
          <span class="font-bold tracking-tight text-[#153563]">Alumni Connect</span>
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
            <a href="{{ route('login') }}" class="focus-ring inline-block rounded-xl bg-[#2e72ec] px-5 py-2.5 text-center text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
              Masuk / Login
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

    <main>
      <!-- HERO SECTION -->
      <section id="beranda" class="grid-paper relative isolate overflow-hidden">
        <div class="blob blob-drift absolute -left-20 top-12 h-56 w-56 bg-[#ffd9e7] opacity-80"></div>
        <div class="absolute right-8 top-16 text-4xl text-[#f2b600] spin-slow">✦</div>
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 py-16 md:grid-cols-2 md:px-8 md:py-24">
          <div class="relative z-10 reveal">
            @auth
            <p class="mb-4 inline-flex items-center gap-2 rounded-full bg-[#cce8de] px-4 py-2 text-sm font-bold text-[#153563]">
              <span>✨</span> Selamat datang, {{ Auth::user()->name }}! (Alumni Terverifikasi)
            </p>
            <h1 class="max-w-xl text-5xl font-bold leading-[.98] tracking-tight text-[#153563] md:text-7xl">{{ $contents['hero_banner']->title ?? 'Ruang temu kita semua.' }}</h1>
            <p class="mt-6 max-w-lg text-lg leading-relaxed text-[#355277]">{{ $contents['hero_banner']->subtitle ?? 'Seluruh fitur direktori, album kenangan, bursa lowongan, dan agenda gathering kini terbuka untukmu!' }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
              <a class="js-nav-link focus-ring rounded-2xl bg-[#2e72ec] px-5 py-3.5 font-bold text-white shadow-lg transition hover:-translate-y-1" href="#alumni" data-target="#alumni">Buka Direktori Alumni</a>
              <a class="js-nav-link focus-ring rounded-2xl border-2 bg-white px-5 py-3.5 font-bold text-[#153563] transition hover:-translate-y-1" href="#lowongan" data-target="#lowongan">Lihat Lowongan</a>
            </div>
            @else
            <p class="mb-4 inline-flex rounded-full bg-[#fff0a9] px-4 py-2 text-sm font-bold text-[#153563]">✦ {{ $contents['hero_banner']->meta_data['badge'] ?? 'Ruang hangat untuk kita' }}</p>
            <h1 class="max-w-xl text-5xl font-bold leading-[.98] tracking-tight text-[#153563] md:text-7xl">{{ $contents['hero_banner']->title ?? 'Satu komunitas, banyak cerita' }}</h1>
            <p class="mt-6 max-w-lg text-lg leading-relaxed text-[#355277]">{{ $contents['hero_banner']->subtitle ?? 'Tempat pulang untuk terhubung, bertukar kabar, dan tumbuh bersama alumni lintas angkatan.' }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
              <a class="focus-ring rounded-2xl bg-[#2e72ec] px-5 py-3.5 font-bold text-white shadow-lg transition hover:-translate-y-1" href="{{ route('login') }}">Masuk untuk Membuka Fitur</a>
              <a class="js-nav-link focus-ring rounded-2xl border-2 bg-white px-5 py-3.5 font-bold text-[#153563] transition hover:-translate-y-1" href="#tentang" data-target="#tentang">Pelajari Dulu</a>
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
          
          <div class="relative mx-auto w-full max-w-lg reveal" style="animation-delay:.15s">
            <div class="checker blob aspect-square p-7 shadow-[0_24px_55px_rgba(31,93,182,.16)]">
              <div class="relative h-full overflow-hidden rounded-[2rem] bg-[#2e72ec] p-6">
                <span class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-[#fff0a9]"></span>
                <span class="absolute -bottom-12 -left-8 h-40 w-40 rounded-full bg-[#ffb8d0]"></span>
                <div class="relative flex h-full flex-col justify-between">
                  <div class="flex items-start justify-between">
                    <span class="rounded-full bg-white px-3 py-1.5 text-xs font-bold text-[#153563]">ALUMNI SPOTLIGHT</span>
                    <span class="text-3xl text-[#fff0a9]">✦</span>
                  </div>
                  <div class="rounded-[1.5rem] bg-white p-5 shadow-xl">
                    <div class="flex items-center gap-3">
                      <span class="grid h-12 w-12 place-items-center rounded-2xl bg-[#ffd9e7] font-bold">KS</span>
                      <div>
                        <p class="font-bold text-[#153563]">Kanya Salsabila</p>
                        <p class="mt-0.5 text-sm text-[#355277]">Angkatan 2019 · Lead UI/UX Designer</p>
                      </div>
                    </div>
                    <div class="mt-4 flex gap-2">
                      <span class="h-2 flex-1 rounded-full bg-[#a8d3ff]"></span><span class="h-2 w-12 rounded-full bg-[#fff0a9]"></span>
                    </div>
                  </div>
                  <p class="max-w-[14rem] text-2xl font-bold leading-tight text-white">Kenangan lama, koneksi baru.</p>
                </div>
              </div>
            </div>
            <div class="floaty absolute -left-4 bottom-7 rounded-2xl bg-white px-4 py-3 shadow-lg">
              <p class="text-sm font-bold text-[#153563]">💌 {{ count($jobs ?? []) }} lowongan kerja aktif</p>
            </div>
            <div class="floaty-slow absolute -right-4 top-10 grid h-16 w-16 place-items-center rounded-full border-4 border-white bg-[#ffb8d0] text-2xl shadow-lg">✿</div>
          </div>
        </div>
      </section>

      <!-- TENTANG KAMI -->
      <section id="tentang" class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="grid gap-10 md:grid-cols-[.8fr_1.2fr] md:items-center">
          <div class="relative reveal-onscroll">
            <div class="blob aspect-[4/3] bg-[#ffd9e7] p-5">
              <div class="flex h-full flex-col justify-between rounded-[2rem] bg-[#153563] p-7 text-white">
                <span class="text-4xl text-[#fff0a9]">☻</span>
                <p class="max-w-[13rem] text-3xl font-bold leading-tight">Dari sekolah, untuk selamanya.</p>
                <div class="flex gap-2"><span class="h-2 w-10 rounded-full bg-[#ffb8d0]"></span><span class="h-2 w-16 rounded-full bg-[#fff0a9]"></span></div>
              </div>
            </div>
            <div class="absolute -bottom-5 -right-3 rotate-6 rounded-2xl bg-[#fff0a9] px-4 py-3 font-bold shadow-md wiggle">✦ hello alumni!</div>
          </div>
          <div class="reveal-onscroll" style="transition-delay:.1s">
            <p class="mb-4 inline-flex rounded-full bg-[#ffd9e7] px-4 py-2 text-sm font-bold text-[#153563]">{{ $contents['about_section']->meta_data['badge'] ?? 'Tentang kami' }}</p>
            <h2 class="text-4xl font-bold leading-tight text-[#153563] md:text-5xl">{{ $contents['about_section']->title ?? 'Jalin kembali koneksi yang berarti.' }}</h2>
            <p class="mt-5 max-w-2xl text-lg leading-relaxed text-[#355277]">{{ $contents['about_section']->subtitle ?? 'Alumni Connect adalah ruang komunitas yang memudahkanmu menemukan teman lama, membuka peluang baru, dan merayakan setiap langkah bersama.' }}</p>
            <div class="mt-8 grid gap-4 sm:grid-cols-3">
              <article class="pop-card rounded-[1.5rem] bg-[#eaf3ff] p-5">
                <span class="mb-4 grid h-11 w-11 place-items-center rounded-2xl bg-[#a8d3ff] text-xl">⌁</span>
                <h3 class="text-xl font-bold text-[#153563]">Terhubung</h3>
                <p class="mt-2 text-sm leading-relaxed text-[#355277]">Sapa teman lintas angkatan dengan mudah.</p>
              </article>
              <article class="pop-card rounded-[1.5rem] bg-[#fffbed] p-5" style="transition-delay:.05s">
                <span class="mb-4 grid h-11 w-11 place-items-center rounded-2xl bg-[#fff0a9] text-xl">↗</span>
                <h3 class="text-xl font-bold text-[#153563]">Bertumbuh</h3>
                <p class="mt-2 text-sm leading-relaxed text-[#355277]">Temukan peluang karier dan mentoring.</p>
              </article>
              <article class="pop-card rounded-[1.5rem] bg-[#fff5f8] p-5" style="transition-delay:.1s">
                <span class="mb-4 grid h-11 w-11 place-items-center rounded-2xl bg-[#ffd9e7] text-xl">♡</span>
                <h3 class="text-xl font-bold text-[#153563]">Berbagi</h3>
                <p class="mt-2 text-sm leading-relaxed text-[#355277]">Rayakan cerita nostalgia dan karya.</p>
              </article>
            </div>
          </div>
        </div>
      </section>

      <!-- STATISTIK -->
      <section id="statistik" class="bg-[#eaf3ff] py-20">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="mb-9 flex flex-wrap items-end justify-between gap-4 reveal-onscroll">
            <div>
              <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Angka yang bikin senyum</p>
              <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Kita tumbuh bareng.</h2>
            </div>
            <p class="max-w-sm text-sm leading-relaxed text-[#355277]">Data statistik komunitas alumni yang selalu aktif diperbarui.</p>
          </div>
          <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-white p-6" data-count="{{ $stats['total_alumni'] ?? 2540 }}" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#2e72ec]">{{ number_format($stats['total_alumni'] ?? 2540) }}+</p>
              <p class="mt-2 font-medium text-[#153563]">Alumni terhubung</p>
            </article>
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-[#fff0a9] p-6" style="transition-delay:.05s" data-count="{{ $stats['total_generations'] ?? 45 }}" data-suffix="">
              <p class="stat-number text-4xl font-bold text-[#153563]">{{ $stats['total_generations'] ?? 45 }}</p>
              <p class="mt-2 font-medium text-[#153563]">Angkatan</p>
            </article>
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-[#ffd9e7] p-6" style="transition-delay:.1s" data-count="{{ $stats['total_jobs'] ?? 180 }}" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#153563]">{{ $stats['total_jobs'] ?? 180 }}+</p>
              <p class="mt-2 font-medium text-[#153563]">Lowongan terverifikasi</p>
            </article>
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-[#cce8de] p-6" style="transition-delay:.15s" data-count="{{ count($events ?? []) ?: 40 }}" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#153563]">{{ count($events ?? []) ?: 40 }}+</p>
              <p class="mt-2 font-medium text-[#153563]">Event seru terlaksana</p>
            </article>
          </div>
        </div>
      </section>

      <!-- GATED TEASER (HANYA MUNCUL KETIKA BELUM LOGIN) -->
      @guest
      <section id="locked-teaser" class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="reveal-onscroll rounded-[2.5rem] border-2 border-dashed border-[#a8d3ff] bg-[#f8fbff] p-6 md:p-10">
          <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
              <p class="mb-3 inline-flex items-center gap-2 rounded-full bg-[#fff0a9] px-4 py-2 text-sm font-bold text-[#153563]"><i data-lucide="lock" class="h-4 w-4"></i> {{ $contents['locked_teaser']->meta_data['badge'] ?? 'Khusus alumni terdaftar' }}</p>
              <h2 class="text-3xl font-bold text-[#153563] md:text-4xl">{{ $contents['locked_teaser']->title ?? '4 fitur seru menanti setelah kamu login.' }}</h2>
              <p class="mt-2 max-w-lg text-sm leading-relaxed text-[#355277]">{{ $contents['locked_teaser']->subtitle ?? 'Direktori alumni, album kenangan, lowongan, dan agenda event hanya bisa dibuka oleh alumni yang sudah login.' }}</p>
            </div>
            <a href="{{ route('login') }}" class="focus-ring shrink-0 rounded-2xl bg-[#2e72ec] px-5 py-3.5 font-bold text-white shadow-lg transition hover:-translate-y-1">{{ $contents['locked_teaser']->meta_data['button_text'] ?? 'Login sekarang 🚀' }}</a>
          </div>
          <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="teaser-card rounded-[1.5rem] bg-white p-5 shadow-sm">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#a8d3ff] text-xl">👥</span>
              <h3 class="mt-4 font-bold text-[#153563]">Direktori Alumni</h3>
              <p class="mt-1 text-sm text-[#355277]">Cari & sapa teman seangkatan.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
            <div class="teaser-card rounded-[1.5rem] bg-white p-5 shadow-sm" style="transition-delay:.05s">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#ffd9e7] text-xl">🖼️</span>
              <h3 class="mt-4 font-bold text-[#153563]">Album Foto</h3>
              <p class="mt-1 text-sm text-[#355277]">Kenangan reuni & kegiatan sekolah.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
            <div class="teaser-card rounded-[1.5rem] bg-white p-5 shadow-sm" style="transition-delay:.1s">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#fff0a9] text-xl">💼</span>
              <h3 class="mt-4 font-bold text-[#153563]">Lowongan Kerja</h3>
              <p class="mt-1 text-sm text-[#355277]">Peluang karier dari sesama alumni.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
            <div class="teaser-card rounded-[1.5rem] bg-white p-5 shadow-sm" style="transition-delay:.15s">
              <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#cce8de] text-xl">📅</span>
              <h3 class="mt-4 font-bold text-[#153563]">Agenda Event</h3>
              <p class="mt-1 text-sm text-[#355277]">Meetup, workshop & reuni terdekat.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
          </div>
        </div>
      </section>
      @endguest

      <!-- FITUR 1: DIREKTORI ALUMNI (GATED) -->
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
          @forelse($alumni ?? [] as $alum)
          <article class="alumni-card reveal-onscroll rounded-[1.75rem] border border-blue-100 bg-white p-5 shadow-sm" data-year="{{ $alum->graduation_year }}" data-field="{{ str_contains(strtolower($alum->profession ?? ''), 'engineer') || str_contains(strtolower($alum->profession ?? ''), 'tech') ? 'teknologi' : (str_contains(strtolower($alum->profession ?? ''), 'designer') || str_contains(strtolower($alum->profession ?? ''), 'creator') ? 'kreatif' : 'sosial') }}">
            <div class="flex items-start justify-between">
              @if($alum->avatar)
                <img src="{{ $alum->avatar }}" alt="{{ $alum->user?->name }}" class="h-14 w-14 rounded-2xl object-cover border border-blue-100">
              @else
                <span class="grid h-14 w-14 place-items-center rounded-2xl bg-[#a8d3ff] font-bold text-[#153563]">{{ strtoupper(substr($alum->user?->name ?? 'A', 0, 2)) }}</span>
              @endif
              <span class="rounded-full bg-[#eaf3ff] px-3 py-1 text-xs font-bold text-[#153563]">Angkatan {{ $alum->graduation_year }}</span>
            </div>
            <h3 class="mt-5 text-xl font-bold text-[#153563]">{{ $alum->user?->name ?? 'Alumni' }}</h3>
            <p class="mt-1 text-sm text-[#355277]">{{ $alum->profession ?? 'Alumni Member' }}</p>
            <p class="mt-3 text-sm font-medium text-[#153563]">📍 {{ $alum->city ?? 'Indonesia' }}</p>
            <a href="{{ route('alumni.index') }}" class="focus-ring mt-5 block w-full rounded-xl bg-[#eaf3ff] px-3 py-2.5 text-center text-sm font-bold text-[#153563] hover:bg-blue-100 transition">Sapa Profil</a>
          </article>
          @empty
          <p class="text-sm text-[#355277]">Belum ada data alumni.</p>
          @endforelse
        </div>
        <p id="alumni-empty" class="mt-8 hidden rounded-2xl bg-[#fff5f8] p-5 text-center font-medium text-[#153563]">Belum ada alumni dengan filter ini. Coba pilihan lain, ya!</p>
      </section>

      <!-- TESTIMONI -->
      <section id="testimoni" class="relative overflow-hidden bg-[#153563] py-20 text-white">
        <span class="absolute left-8 top-8 text-5xl text-[#fff0a9] floaty-slow">✦</span>
        <span class="absolute bottom-5 right-10 text-7xl text-[#ffb8d0] floaty">⌁</span>
        <div class="mx-auto max-w-5xl px-5 text-center md:px-8">
          <p class="mb-4 inline-flex rounded-full bg-[#fff0a9] px-4 py-2 text-sm font-bold text-[#153563] reveal-onscroll">Cerita dari teman</p>
          <h2 class="text-4xl font-bold text-white md:text-5xl reveal-onscroll">Koneksi kecil, dampak besar.</h2>
          <div class="relative mx-auto mt-10 max-w-3xl reveal-onscroll">
            @forelse($testimonials ?? [] as $index => $testi)
            <article class="testimonial {{ $index == 0 ? 'active' : '' }} rounded-[2rem] bg-white p-8 text-left text-[#153563] shadow-2xl md:p-10">
              <p class="text-2xl font-bold leading-relaxed">"{{ $testi->quote }}"</p>
              <div class="mt-7 flex items-center gap-3">
                <span class="grid h-11 w-11 place-items-center rounded-full bg-[#ffd9e7] font-bold">{{ strtoupper(substr($testi->name, 0, 2)) }}</span>
                <p class="text-sm font-bold text-[#355277]">{{ $testi->name }} · {{ $testi->profession ?? ('Angkatan ' . $testi->graduation_year) }}</p>
              </div>
            </article>
            @empty
            <article class="testimonial active rounded-[2rem] bg-white p-8 text-left text-[#153563] shadow-2xl md:p-10">
              <p class="text-2xl font-bold leading-relaxed">"Lewat Alumni Connect, aku bertemu lagi dengan teman sekelas yang akhirnya jadi partner proyek startup!"</p>
              <div class="mt-7 flex items-center gap-3">
                <span class="grid h-11 w-11 place-items-center rounded-full bg-[#ffd9e7] font-bold">AL</span>
                <p class="text-sm font-bold text-[#355277]">Alya Lestari · Angkatan 2015</p>
              </div>
            </article>
            @endforelse

            <div class="mt-6 flex justify-center gap-3">
              <button id="prev-testimonial" class="focus-ring grid h-11 w-11 place-items-center rounded-full bg-white text-[#153563] transition hover:-translate-y-0.5" type="button" aria-label="Testimoni sebelumnya"><i data-lucide="arrow-left" class="h-5 w-5"></i></button>
              <button id="next-testimonial" class="focus-ring grid h-11 w-11 place-items-center rounded-full bg-[#ffb8d0] text-[#153563] transition hover:-translate-y-0.5" type="button" aria-label="Testimoni berikutnya"><i data-lucide="arrow-right" class="h-5 w-5"></i></button>
            </div>
          </div>
        </div>
      </section>

      <!-- MEDIA & ARTIKEL -->
      <section id="media" class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="flex flex-wrap items-end justify-between gap-5 reveal-onscroll">
          <div>
            <p class="mb-3 inline-flex rounded-full bg-[#ffd9e7] px-4 py-2 text-sm font-bold text-[#153563]">Media komunitas</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Ada yang baru di sini.</h2>
          </div>
          <div class="flex rounded-2xl bg-[#eaf3ff] p-1.5" role="tablist" aria-label="Kategori media">
            <button class="tab-btn focus-ring rounded-xl px-4 py-2 text-sm font-bold bg-[#2e72ec] text-white" type="button" role="tab" aria-selected="true" data-tab="articles">Artikel</button>
            <button class="tab-btn focus-ring rounded-xl px-4 py-2 text-sm font-bold text-[#153563]" type="button" role="tab" aria-selected="false" data-tab="gallery">Galeri</button>
          </div>
        </div>
        
        <div id="articles" class="media-panel active mt-9">
          <div class="grid gap-5 md:grid-cols-3">
            @forelse($articles ?? [] as $index => $article)
            <article class="pop-card rounded-[1.75rem] {{ $index % 3 == 0 ? 'bg-[#eaf3ff]' : ($index % 3 == 1 ? 'bg-[#fffbed]' : 'bg-[#fff5f8]') }} p-6">
              <span class="inline-block rounded-full bg-white px-3 py-1 text-xs font-bold {{ $index % 3 == 0 ? 'text-[#2e72ec]' : ($index % 3 == 1 ? 'text-[#9d7800]' : 'text-[#c8517d]') }}">{{ strtoupper($article->category) }}</span>
              <h3 class="mt-4 text-2xl font-bold text-[#153563]">{{ $article->title }}</h3>
              <p class="mt-3 leading-relaxed text-[#355277]">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 80) }}</p>
              <p class="mt-5 text-sm font-bold text-[#153563]">{{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d F Y') }}</p>
            </article>
            @empty
            <article class="pop-card rounded-[1.75rem] bg-[#eaf3ff] p-6">
              <span class="inline-block rounded-full bg-white px-3 py-1 text-xs font-bold text-[#2e72ec]">KABAR KAMPUS</span>
              <h3 class="mt-4 text-2xl font-bold text-[#153563]">Reuni yang jadi awal kolaborasi</h3>
              <p class="mt-3 leading-relaxed text-[#355277]">Tiga alumni mengubah obrolan reuni menjadi proyek kreatif yang seru.</p>
              <p class="mt-5 text-sm font-bold text-[#153563]">28 Agustus 2026</p>
            </article>
            @endforelse
          </div>
        </div>

        <div id="gallery" class="media-panel mt-9">
          <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
            <div class="checker pop-card flex aspect-square items-end rounded-[1.75rem] bg-[#a8d3ff] p-4"><span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">Campus Day</span></div>
            <div class="pop-card flex aspect-square items-end rounded-[1.75rem] bg-[#ffd9e7] p-4"><span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">Mini Reunion</span></div>
            <div class="pop-card flex aspect-square items-end rounded-[1.75rem] bg-[#fff0a9] p-4"><span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">Creative Lab</span></div>
            <div class="pop-card flex aspect-square items-end rounded-[1.75rem] bg-[#cce8de] p-4"><span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">Volunteer Day</span></div>
            <div class="pop-card flex aspect-square items-end rounded-[1.75rem] bg-[#b8c9ff] p-4"><span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">Career Talk</span></div>
            <div class="pop-card flex aspect-square items-end rounded-[1.75rem] bg-[#ffcfb7] p-4"><span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#153563]">Weekend Club</span></div>
          </div>
        </div>
      </section>

      <!-- FITUR 2: ALBUM KENANGAN (GATED) -->
      <section id="album" class="auth-section @auth unlocked @endauth bg-[#f5f9ff] py-20">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="reveal-onscroll">
            <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Album komunitas</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Kenangan yang tersimpan rapi.</h2>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Koleksi album foto kenangan masa sekolah khusus untuk alumni yang sudah login.</p>
          </div>
          <div class="mt-9 grid gap-5 md:grid-cols-4">
            @forelse($albums ?? [] as $index => $album)
            <article class="pop-card reveal-onscroll rounded-[1.75rem] {{ $index % 2 == 0 ? 'bg-[#eaf3ff]' : 'bg-[#fffbed]' }} p-6">
              <span class="text-4xl">📸</span>
              <h3 class="mt-6 text-2xl font-bold text-[#153563]">{{ $album->title }}</h3>
              <p class="mt-2 text-sm text-[#355277]">{{ $album->subtitle_label ?? $album->target_generation }} · {{ $album->location }}</p>
              <a href="{{ route('album.index') }}" class="focus-ring mt-6 inline-block rounded-xl bg-[#153563] px-4 py-2.5 text-sm font-bold text-white hover:bg-opacity-90">Buka Album</a>
            </article>
            @empty
            <p class="text-sm text-[#355277]">Belum ada album foto.</p>
            @endforelse
          </div>
        </div>
      </section>

      <!-- FITUR 3: LOWONGAN KERJA (GATED) -->
      <section id="lowongan" class="auth-section @auth unlocked @endauth mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="reveal-onscroll">
          <p class="mb-3 inline-flex rounded-full bg-[#eaf3ff] px-4 py-2 text-sm font-bold text-[#153563]">Karier &amp; peluang</p>
          <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Lowongan pilihan untukmu.</h2>
          <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Info bursa kerja & magang terverifikasi dari perusahaan partner alumni.</p>
        </div>
        <div class="mt-9 grid gap-4 md:grid-cols-3">
          @forelse($jobs ?? [] as $job)
          <article class="job-card reveal-onscroll rounded-[1.5rem] bg-white p-5 shadow-sm border border-blue-100">
            <div class="flex flex-wrap items-start justify-between gap-3">
              <div>
                <h4 class="text-xl font-bold text-[#153563]">{{ $job->title }}</h4>
                <p class="mt-1 text-[#355277] text-sm">{{ $job->company_name }} • ({{ $job->alumni_contact ?? 'Alumni Partner' }})</p>
              </div>
              <span class="rounded-full bg-[#eaf3ff] px-3 py-1 text-xs font-bold text-[#2e72ec]">{{ $job->job_type }}</span>
            </div>
            <p class="mt-4 text-sm text-[#355277]">{{ $job->location }} · <strong>{{ $job->salary_display }}</strong></p>
            <a href="{{ route('lowongan.show', $job->slug) }}" class="focus-ring mt-4 inline-block rounded-xl bg-[#2e72ec] px-4 py-2.5 text-sm font-bold text-white hover:bg-blue-600 transition">Lamar Sekarang</a>
          </article>
          @empty
          <p class="text-sm text-[#355277]">Belum ada lowongan kerja aktif.</p>
          @endforelse
        </div>
      </section>

      <!-- FITUR 4: AGENDA EVENT (GATED) -->
      <section id="event" class="auth-section @auth unlocked @endauth bg-[#eaf3ff] py-20">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="reveal-onscroll">
            <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Agenda komunitas</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Jangan sampai ketinggalan momennya.</h2>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Meetup, webinar, dan reuni seru yang hanya bisa diikuti alumni login.</p>
          </div>
          <div class="mt-9 grid gap-4 md:grid-cols-3">
            @forelse($events ?? [] as $event)
            <article class="event-card reveal-onscroll flex gap-4 rounded-[1.5rem] bg-white p-5 shadow-sm border border-blue-100">
              <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-[#ffd9e7] text-center">
                <span class="font-bold text-[#153563]" style="line-height:1">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}<br>{{ strtoupper(\Carbon\Carbon::parse($event->event_date)->format('M')) }}</span>
              </div>
              <div class="min-w-0">
                <span class="text-xs font-bold text-[#c8517d]">{{ strtoupper($event->category) }}</span>
                <h4 class="mt-1 text-xl font-bold text-[#153563] truncate">{{ $event->title }}</h4>
                <p class="mt-1 text-sm text-[#355277]">{{ $event->time_display ?? ($event->venue ?? 'Online') }}</p>
                <a href="{{ route('event.index') }}" class="focus-ring mt-3 inline-block rounded-xl bg-[#153563] px-4 py-2 text-sm font-bold text-white hover:bg-opacity-90">Ikuti Event</a>
              </div>
            </article>
            @empty
            <p class="text-sm text-[#355277]">Belum ada agenda event mendatang.</p>
            @endforelse
          </div>
        </div>
      </section>

      <!-- CALL TO ACTION -->
      <section class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="reveal-onscroll relative overflow-hidden rounded-[2.5rem] bg-[#2e72ec] p-8 text-center md:p-14">
          <span class="absolute left-8 top-7 text-4xl text-[#fff0a9] floaty-slow">✦</span>
          <span class="absolute bottom-4 right-10 text-5xl text-[#ffb8d0] floaty">✿</span>
          <h2 class="relative mx-auto max-w-2xl text-4xl font-bold text-white md:text-5xl">{{ $contents['cta_footer']->title ?? 'Masih ada tempat untuk ceritamu di sini.' }}</h2>
          <p class="relative mx-auto mt-4 max-w-xl text-lg leading-relaxed text-[#eaf3ff]">{{ $contents['cta_footer']->subtitle ?? 'Datang, sapa teman lama, dan buka kesempatan baru bersama komunitas alumni.' }}</p>
          @guest
          <a class="focus-ring relative mt-7 inline-block rounded-2xl bg-[#fff0a9] px-6 py-3.5 font-bold text-[#153563] transition hover:-translate-y-1" href="{{ route('login') }}">{{ $contents['cta_footer']->meta_data['button_text'] ?? 'Masuk ke Komunitas' }}</a>
          @else
          <a class="js-nav-link focus-ring relative mt-7 inline-block rounded-2xl bg-[#fff0a9] px-6 py-3.5 font-bold text-[#153563] transition hover:-translate-y-1" href="#alumni" data-target="#alumni">Jelajahi Direktori Alumni</a>
          @endguest
        </div>
      </section>
    </main>

    <footer class="border-t border-blue-100 bg-white">
      <div class="mx-auto grid max-w-7xl gap-8 px-5 py-10 md:grid-cols-[1.3fr_1fr_1fr] md:px-8">
        <div>
          <p class="text-2xl font-bold text-[#153563]">✦ {{ $settings['brand_name'] ?? 'Alumni Connect' }}</p>
          <p class="mt-2 max-w-xs text-sm leading-relaxed text-[#355277]">{{ $settings['footer_tagline'] ?? 'Koneksi yang terasa dekat, meski sudah jauh dari almamater.' }}</p>
        </div>
        <div>
          <h2 class="font-bold text-[#153563]">Jelajahi Fitur</h2>
          <div class="mt-3 grid gap-2 text-sm">
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#alumni" data-target="#alumni" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest>Direktori Alumni</a>
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#album" data-target="#album" @guest data-auth-link data-auth-label="Album Foto" @endguest>Album Kenangan</a>
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#lowongan" data-target="#lowongan" @guest data-auth-link data-auth-label="Lowongan Kerja" @endguest>Bursa Lowongan</a>
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#event" data-target="#event" @guest data-auth-link data-auth-label="Agenda Event" @endguest>Agenda Event</a>
          </div>
        </div>
        <div>
          <h2 class="font-bold text-[#153563]">Sapa Kami</h2>
          <div class="mt-3 flex gap-2">
            <a href="#" class="focus-ring grid h-10 w-10 place-items-center rounded-xl bg-[#fff5f8] text-[#153563] transition hover:-translate-y-0.5" aria-label="Instagram"><i data-lucide="instagram" class="h-4 w-4"></i></a>
            <a href="#" class="focus-ring grid h-10 w-10 place-items-center rounded-xl bg-[#eaf3ff] text-[#153563] transition hover:-translate-y-0.5" aria-label="LinkedIn"><i data-lucide="linkedin" class="h-4 w-4"></i></a>
            <a href="mailto:{{ $settings['contact_email'] ?? 'halo@alumniconnect.id' }}" class="focus-ring grid h-10 w-10 place-items-center rounded-xl bg-[#fffbed] text-[#153563] transition hover:-translate-y-0.5" aria-label="Email"><i data-lucide="mail" class="h-4 w-4"></i></a>
          </div>
        </div>
      </div>
      <div class="border-t border-blue-100 px-5 py-5 text-center">
        <p class="text-sm text-[#355277]">© 2026 {{ $settings['brand_name'] ?? 'Alumni Connect' }} · Dibuat dengan banyak cerita baik.</p>
      </div>
    </footer>
  </div>

  <!-- Floating action buttons: tombol scroll-ke-atas & WhatsApp -->
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

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
