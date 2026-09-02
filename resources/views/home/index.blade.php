<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumni Connect</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
              <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni">
                <span>Alumni</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
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
              <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album" data-auth-link data-auth-label="Album Foto">
                <span>Album</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
              </a>
            </div>
          </div>
          <div class="nav-drop relative">
            <button class="focus-ring nav-link flex items-center gap-1 rounded-lg px-3 py-2 text-[#153563]" type="button" data-dropdown aria-expanded="false" aria-controls="info-menu">
              <span>Informasi</span><i data-lucide="chevron-down" class="h-4 w-4"></i>
            </button>
            <div id="info-menu" class="drop-menu absolute right-0 top-full mt-2 w-52 rounded-2xl border border-blue-100 bg-white p-2 shadow-xl">
              <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan" data-auth-link data-auth-label="Lowongan Kerja">
                <span>Lowongan</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
              </a>
              <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event" data-auth-link data-auth-label="Agenda Event">
                <span>Event</span><i data-lucide="lock" class="h-3.5 w-3.5 text-[#2e72ec]"></i>
              </a>
            </div>
          </div>
        </div>
       <div class="flex items-center gap-2">
    <div id="guest-actions" class="flex items-center gap-2">
        <a href="{{ route('login') }}" class="focus-ring rounded-xl bg-[#2e72ec] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg inline-block text-center">
            Login
        </a>
    </div>
</div>
          <div id="user-actions" class="hidden items-center gap-2">
            <span class="hidden items-center gap-2 rounded-xl bg-[#eaf3ff] px-3 py-2 text-sm font-bold text-[#153563] sm:flex">
              <span id="user-avatar" class="grid h-7 w-7 place-items-center rounded-full bg-[#2e72ec] text-xs text-white">A</span>
              <span id="user-email-label">Alumni</span>
            </span>
            <button id="logout-btn" type="button" class="focus-ring rounded-xl border-2 border-[#2e72ec] px-3 py-2.5 text-sm font-bold text-[#2e72ec] transition hover:-translate-y-0.5" title="Keluar">
              <i data-lucide="log-out" class="h-4 w-4"></i>
            </button>
          </div>
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
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni"><span>Alumni</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
          <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#testimoni" data-target="#testimoni">Testimoni</a>
          <p class="mobile-group-label">Media</p>
          <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="articles">Artikel</a>
          <a class="js-nav-link focus-ring rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#media" data-target="#media" data-tab-target="gallery">Galeri</a>
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#album" data-target="#album" data-auth-link data-auth-label="Album Foto"><span>Album</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
          <p class="mobile-group-label">Informasi</p>
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#lowongan" data-target="#lowongan" data-auth-link data-auth-label="Lowongan Kerja"><span>Lowongan</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
          <a class="js-nav-link focus-ring flex items-center justify-between rounded-xl px-3 py-2.5 hover:bg-blue-50 text-[#153563]" href="#event" data-target="#event" data-auth-link data-auth-label="Agenda Event"><span>Event</span><i data-lucide="lock" class="h-4 w-4 text-[#2e72ec]"></i></a>
          <div class="mt-2 border-t border-blue-100 pt-3">
            <button id="mobile-open-login" type="button" class="focus-ring w-full rounded-xl bg-[#2e72ec] px-4 py-3 text-sm font-bold text-white">Login</button>
            <button id="mobile-logout-btn" type="button" class="focus-ring hidden w-full items-center justify-center gap-2 rounded-xl border-2 border-[#2e72ec] px-4 py-3 text-sm font-bold text-[#2e72ec]">
              <i data-lucide="log-out" class="h-4 w-4"></i> Keluar
            </button>
          </div>
        </div>
      </div>
    </header>

    <main>
      <section id="beranda" class="grid-paper relative isolate overflow-hidden">
        <div class="blob blob-drift absolute -left-20 top-12 h-56 w-56 bg-[#ffd9e7] opacity-80"></div>
        <div class="absolute right-8 top-16 text-4xl text-[#f2b600] spin-slow">✦</div>
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 py-16 md:grid-cols-2 md:px-8 md:py-24">
          <div class="relative z-10 reveal">
            <p class="mb-4 inline-flex rounded-full bg-[#fff0a9] px-4 py-2 text-sm font-bold text-[#153563]">✦ Ruang hangat untuk kita</p>
            <h1 class="max-w-xl text-5xl font-bold leading-[.98] tracking-tight text-[#153563] md:text-7xl">Satu komunitas, banyak cerita</h1>
            <p class="mt-6 max-w-lg text-lg leading-relaxed text-[#355277]">Tempat pulang untuk terhubung, bertukar kabar, dan tumbuh bersama alumni lintas angkatan.</p>
            <div class="mt-8 flex flex-wrap gap-3">
              <a class="js-nav-link focus-ring rounded-2xl bg-[#2e72ec] px-5 py-3.5 font-bold text-white shadow-lg transition hover:-translate-y-1" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni">Jelajahi Komunitas</a>
              <a class="js-nav-link focus-ring rounded-2xl border-2 bg-white px-5 py-3.5 font-bold text-[#153563] transition hover:-translate-y-1" href="#testimoni" data-target="#testimoni">Bagikan Cerita</a>
            </div>
            <div class="mt-9 flex items-center gap-3">
              <div class="flex -space-x-2" aria-label="Avatar komunitas">
                <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white bg-[#ffafca] text-xs font-bold">NA</span>
                <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white bg-[#ffe88b] text-xs font-bold">RY</span>
                <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-white bg-[#a8d3ff] text-xs font-bold">DP</span>
              </div>
              <p class="text-sm font-medium text-[#355277]">12.000+ teman sudah terhubung</p>
            </div>
          </div>
          <div class="relative mx-auto w-full max-w-lg reveal" style="animation-delay:.15s">
            <div class="checker blob aspect-square p-7 shadow-[0_24px_55px_rgba(31,93,182,.16)]">
              <div class="relative h-full overflow-hidden rounded-[2rem] bg-[#2e72ec] p-6">
                <span class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-[#fff0a9]"></span>
                <span class="absolute -bottom-12 -left-8 h-40 w-40 rounded-full bg-[#ffb8d0]"></span>
                <div class="relative flex h-full flex-col justify-between">
                  <div class="flex items-start justify-between">
                    <span class="rounded-full bg-white px-3 py-1.5 text-xs font-bold text-[#153563]">ALUMNI STORY</span>
                    <span class="text-3xl text-[#fff0a9]">✦</span>
                  </div>
                  <div class="rounded-[1.5rem] bg-white p-5 shadow-xl">
                    <div class="flex items-center gap-3">
                      <span class="grid h-12 w-12 place-items-center rounded-2xl bg-[#ffd9e7] font-bold">SA</span>
                      <div>
                        <p class="font-bold text-[#153563]">Salma Aulia</p>
                        <p class="mt-0.5 text-sm text-[#355277]">Angkatan 2016 · Product Designer</p>
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
              <p class="text-sm font-bold text-[#153563]">💌 Ada 8 cerita baru</p>
            </div>
            <div class="floaty-slow absolute -right-4 top-10 grid h-16 w-16 place-items-center rounded-full border-4 border-white bg-[#ffb8d0] text-2xl shadow-lg">✿</div>
          </div>
        </div>
      </section>

      <section id="tentang" class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="grid gap-10 md:grid-cols-[.8fr_1.2fr] md:items-center">
          <div class="relative reveal-onscroll">
            <div class="blob aspect-[4/3] bg-[#ffd9e7] p-5">
              <div class="flex h-full flex-col justify-between rounded-[2rem] bg-[#153563] p-7 text-white">
                <span class="text-4xl text-[#fff0a9]">☻</span>
                <p class="max-w-[13rem] text-3xl font-bold leading-tight">Dari kampus, untuk selamanya.</p>
                <div class="flex gap-2"><span class="h-2 w-10 rounded-full bg-[#ffb8d0]"></span><span class="h-2 w-16 rounded-full bg-[#fff0a9]"></span></div>
              </div>
            </div>
            <div class="absolute -bottom-5 -right-3 rotate-6 rounded-2xl bg-[#fff0a9] px-4 py-3 font-bold shadow-md wiggle">✦ hello!</div>
          </div>
          <div class="reveal-onscroll" style="transition-delay:.1s">
            <p class="mb-4 inline-flex rounded-full bg-[#ffd9e7] px-4 py-2 text-sm font-bold text-[#153563]">Tentang kami</p>
            <h2 class="text-4xl font-bold leading-tight text-[#153563] md:text-5xl">Jalin kembali koneksi yang berarti.</h2>
            <p class="mt-5 max-w-2xl text-lg leading-relaxed text-[#355277]">Alumni Connect adalah ruang komunitas yang memudahkanmu menemukan teman lama, membuka peluang baru, dan merayakan setiap langkah bersama.</p>
            <div class="mt-8 grid gap-4 sm:grid-cols-3">
              <article class="pop-card rounded-[1.5rem] bg-[#eaf3ff] p-5">
                <span class="mb-4 grid h-11 w-11 place-items-center rounded-2xl bg-[#a8d3ff] text-xl">⌁</span>
                <h3 class="text-xl font-bold text-[#153563]">Terhubung</h3>
                <p class="mt-2 text-sm leading-relaxed text-[#355277]">Sapa teman lintas angkatan.</p>
              </article>
              <article class="pop-card rounded-[1.5rem] bg-[#fffbed] p-5" style="transition-delay:.05s">
                <span class="mb-4 grid h-11 w-11 place-items-center rounded-2xl bg-[#fff0a9] text-xl">↗</span>
                <h3 class="text-xl font-bold text-[#153563]">Bertumbuh</h3>
                <p class="mt-2 text-sm leading-relaxed text-[#355277]">Temukan peluang yang tepat.</p>
              </article>
              <article class="pop-card rounded-[1.5rem] bg-[#fff5f8] p-5" style="transition-delay:.1s">
                <span class="mb-4 grid h-11 w-11 place-items-center rounded-2xl bg-[#ffd9e7] text-xl">♡</span>
                <h3 class="text-xl font-bold text-[#153563]">Berbagi</h3>
                <p class="mt-2 text-sm leading-relaxed text-[#355277]">Rayakan cerita dan karya.</p>
              </article>
            </div>
          </div>
        </div>
      </section>

      <section id="statistik" class="bg-[#eaf3ff] py-20">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="mb-9 flex flex-wrap items-end justify-between gap-4 reveal-onscroll">
            <div>
              <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Angka yang bikin senyum</p>
              <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Kita tumbuh bareng.</h2>
            </div>
            <p class="max-w-sm text-sm leading-relaxed text-[#355277]">Data contoh komunitas yang bisa kamu sesuaikan kapan saja.</p>
          </div>
          <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-white p-6" data-count="12000" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#2e72ec]">0</p>
              <p class="mt-2 font-medium text-[#153563]">Alumni terhubung</p>
            </article>
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-[#fff0a9] p-6" style="transition-delay:.05s" data-count="48" data-suffix="">
              <p class="stat-number text-4xl font-bold text-[#153563]">0</p>
              <p class="mt-2 font-medium text-[#153563]">Angkatan</p>
            </article>
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-[#ffd9e7] p-6" style="transition-delay:.1s" data-count="320" data-suffix="+">
              <p class="stat-number text-4xl font-bold text-[#153563]">0</p>
              <p class="mt-2 font-medium text-[#153563]">Cerita dibagikan</p>
            </article>
            <article class="stat-card reveal-onscroll rounded-[1.75rem] bg-[#cce8de] p-6" style="transition-delay:.15s" data-count="85" data-suffix="">
              <p class="stat-number text-4xl font-bold text-[#153563]">0</p>
              <p class="mt-2 font-medium text-[#153563]">Event seru</p>
            </article>
          </div>
        </div>
      </section>

      <section id="locked-teaser" class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="reveal-onscroll rounded-[2.5rem] border-2 border-dashed border-[#a8d3ff] bg-[#f8fbff] p-6 md:p-10">
          <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
              <p class="mb-3 inline-flex items-center gap-2 rounded-full bg-[#fff0a9] px-4 py-2 text-sm font-bold text-[#153563]"><i data-lucide="lock" class="h-4 w-4"></i> Khusus alumni terdaftar</p>
              <h2 class="text-3xl font-bold text-[#153563] md:text-4xl">4 fitur seru menanti setelah kamu login.</h2>
              <p class="mt-2 max-w-lg text-sm leading-relaxed text-[#355277]">Direktori alumni, album kenangan, lowongan, dan agenda event hanya bisa dibuka oleh alumni yang sudah login.</p>
            </div>
            <button id="teaser-login-btn" type="button" class="focus-ring shrink-0 rounded-2xl bg-[#2e72ec] px-5 py-3.5 font-bold text-white shadow-lg transition hover:-translate-y-1">Login sekarang</button>
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
              <p class="mt-1 text-sm text-[#355277]">Kenangan reuni & kegiatan.</p>
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
              <p class="mt-1 text-sm text-[#355277]">Meetup & workshop terdekat.</p>
              <span class="mt-3 inline-flex items-center gap-1 text-xs font-bold text-[#2e72ec]"><i data-lucide="lock" class="h-3.5 w-3.5"></i> Terkunci</span>
            </div>
          </div>
        </div>
      </section>

      <section id="alumni" class="auth-section mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="flex flex-wrap items-end justify-between gap-6 reveal-onscroll">
          <div>
            <p class="mb-3 inline-flex rounded-full bg-[#eaf3ff] px-4 py-2 text-sm font-bold text-[#153563]">Direktori alumni</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Temukan teman seperjalanan.</h2>
          </div>
          <p class="max-w-sm text-sm leading-relaxed text-[#355277]">Profil berikut adalah konten demo yang mudah diganti.</p>
        </div>
        <div class="mt-8 flex flex-wrap gap-3 rounded-[1.5rem] border border-blue-100 bg-[#f8fbff] p-3 reveal-onscroll">
          <label class="sr-only" for="year-filter">Filter angkatan</label>
          <select id="year-filter" class="focus-ring rounded-xl border border-blue-100 bg-white px-4 py-3 text-sm font-semibold text-[#153563]">
            <option value="all">Semua angkatan</option>
            <option value="2014">Angkatan 2014</option>
            <option value="2016">Angkatan 2016</option>
            <option value="2018">Angkatan 2018</option>
          </select>
          <label class="sr-only" for="field-filter">Filter bidang</label>
          <select id="field-filter" class="focus-ring rounded-xl border border-blue-100 bg-white px-4 py-3 text-sm font-semibold text-[#153563]">
            <option value="all">Semua bidang</option>
            <option value="teknologi">Teknologi</option>
            <option value="kreatif">Kreatif</option>
            <option value="sosial">Sosial</option>
          </select>
          <p class="self-center px-2 text-sm text-[#355277]">Pilih filter untuk menemukan orangmu.</p>
        </div>
        <div id="alumni-list" class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
          <article class="alumni-card reveal-onscroll rounded-[1.75rem] border border-blue-100 bg-white p-5 shadow-sm" data-year="2014" data-field="teknologi">
            <div class="flex items-start justify-between">
              <span class="grid h-14 w-14 place-items-center rounded-2xl bg-[#a8d3ff] font-bold">NA</span>
              <span class="rounded-full bg-[#eaf3ff] px-3 py-1 text-xs font-bold">2014</span>
            </div>
            <h3 class="mt-5 text-xl font-bold text-[#153563]">Nadia Arum</h3>
            <p class="mt-1 text-sm text-[#355277]">Software Engineer · Teknologi</p>
            <p class="mt-3 text-sm font-medium text-[#153563]">📍 Jakarta</p>
            <button class="demo-action focus-ring mt-5 w-full rounded-xl bg-[#eaf3ff] px-3 py-2.5 text-sm font-bold text-[#153563]" type="button">Lihat profil</button>
          </article>
          <article class="alumni-card reveal-onscroll rounded-[1.75rem] border border-blue-100 bg-white p-5 shadow-sm" style="transition-delay:.05s" data-year="2016" data-field="kreatif">
            <div class="flex items-start justify-between">
              <span class="grid h-14 w-14 place-items-center rounded-2xl bg-[#ffd9e7] font-bold">RA</span>
              <span class="rounded-full bg-[#fff5f8] px-3 py-1 text-xs font-bold">2016</span>
            </div>
            <h3 class="mt-5 text-xl font-bold text-[#153563]">Raka Aditya</h3>
            <p class="mt-1 text-sm text-[#355277]">Brand Strategist · Kreatif</p>
            <p class="mt-3 text-sm font-medium text-[#153563]">📍 Bandung</p>
            <button class="demo-action focus-ring mt-5 w-full rounded-xl bg-[#eaf3ff] px-3 py-2.5 text-sm font-bold text-[#153563]" type="button">Lihat profil</button>
          </article>
          <article class="alumni-card reveal-onscroll rounded-[1.75rem] border border-blue-100 bg-white p-5 shadow-sm" style="transition-delay:.1s" data-year="2018" data-field="sosial">
            <div class="flex items-start justify-between">
              <span class="grid h-14 w-14 place-items-center rounded-2xl bg-[#fff0a9] font-bold">DP</span>
              <span class="rounded-full bg-[#fffbed] px-3 py-1 text-xs font-bold">2018</span>
            </div>
            <h3 class="mt-5 text-xl font-bold text-[#153563]">Dina Prameswari</h3>
            <p class="mt-1 text-sm text-[#355277]">Program Manager · Sosial</p>
            <p class="mt-3 text-sm font-medium text-[#153563]">📍 Surabaya</p>
            <button class="demo-action focus-ring mt-5 w-full rounded-xl bg-[#eaf3ff] px-3 py-2.5 text-sm font-bold text-[#153563]" type="button">Lihat profil</button>
          </article>
          <article class="alumni-card reveal-onscroll rounded-[1.75rem] border border-blue-100 bg-white p-5 shadow-sm" style="transition-delay:.15s" data-year="2016" data-field="teknologi">
            <div class="flex items-start justify-between">
              <span class="grid h-14 w-14 place-items-center rounded-2xl bg-[#cce8de] font-bold">FK</span>
              <span class="rounded-full bg-[#effaf5] px-3 py-1 text-xs font-bold">2016</span>
            </div>
            <h3 class="mt-5 text-xl font-bold text-[#153563]">Farhan Kurnia</h3>
            <p class="mt-1 text-sm text-[#355277]">Data Analyst · Teknologi</p>
            <p class="mt-3 text-sm font-medium text-[#153563]">📍 Yogyakarta</p>
            <button class="demo-action focus-ring mt-5 w-full rounded-xl bg-[#eaf3ff] px-3 py-2.5 text-sm font-bold text-[#153563]" type="button">Lihat profil</button>
          </article>
        </div>
        <p id="alumni-empty" class="mt-8 hidden rounded-2xl bg-[#fff5f8] p-5 text-center font-medium text-[#153563]">Belum ada alumni dengan filter ini. Coba pilihan lain, ya!</p>
      </section>

      <section id="testimoni" class="relative overflow-hidden bg-[#153563] py-20 text-white">
        <span class="absolute left-8 top-8 text-5xl text-[#fff0a9] floaty-slow">✦</span>
        <span class="absolute bottom-5 right-10 text-7xl text-[#ffb8d0] floaty">⌁</span>
        <div class="mx-auto max-w-5xl px-5 text-center md:px-8">
          <p class="mb-4 inline-flex rounded-full bg-[#fff0a9] px-4 py-2 text-sm font-bold text-[#153563] reveal-onscroll">Cerita dari teman</p>
          <h2 class="text-4xl font-bold text-white md:text-5xl reveal-onscroll">Koneksi kecil, dampak besar.</h2>
          <div class="relative mx-auto mt-10 max-w-3xl reveal-onscroll">
            <article class="testimonial active rounded-[2rem] bg-white p-8 text-left text-[#153563] shadow-2xl md:p-10">
              <p class="text-2xl font-bold leading-relaxed">"Lewat Alumni Connect, aku bertemu lagi dengan teman sekelas yang akhirnya jadi partner proyek."</p>
              <div class="mt-7 flex items-center gap-3">
                <span class="grid h-11 w-11 place-items-center rounded-full bg-[#ffd9e7] font-bold">AL</span>
                <p class="text-sm font-bold text-[#355277]">Alya Lestari · Angkatan 2015</p>
              </div>
            </article>
            <article class="testimonial rounded-[2rem] bg-white p-8 text-left text-[#153563] shadow-2xl md:p-10">
              <p class="text-2xl font-bold leading-relaxed">"Rasanya seperti pulang ke kampus, hanya saja sekarang kami datang membawa banyak cerita baru."</p>
              <div class="mt-7 flex items-center gap-3">
                <span class="grid h-11 w-11 place-items-center rounded-full bg-[#fff0a9] font-bold">IM</span>
                <p class="text-sm font-bold text-[#355277]">Imam Mahendra · Angkatan 2012</p>
              </div>
            </article>
            <article class="testimonial rounded-[2rem] bg-white p-8 text-left text-[#153563] shadow-2xl md:p-10">
              <p class="text-2xl font-bold leading-relaxed">"Paling suka dengan event kecilnya—hangat, relevan, dan bikin semangat belajar lagi."</p>
              <div class="mt-7 flex items-center gap-3">
                <span class="grid h-11 w-11 place-items-center rounded-full bg-[#a8d3ff] font-bold">TS</span>
                <p class="text-sm font-bold text-[#355277]">Tasya Sari · Angkatan 2019</p>
              </div>
            </article>
            <div class="mt-6 flex justify-center gap-3">
              <button id="prev-testimonial" class="focus-ring grid h-11 w-11 place-items-center rounded-full bg-white text-[#153563] transition hover:-translate-y-0.5" type="button" aria-label="Testimoni sebelumnya"><i data-lucide="arrow-left" class="h-5 w-5"></i></button>
              <button id="next-testimonial" class="focus-ring grid h-11 w-11 place-items-center rounded-full bg-[#ffb8d0] text-[#153563] transition hover:-translate-y-0.5" type="button" aria-label="Testimoni berikutnya"><i data-lucide="arrow-right" class="h-5 w-5"></i></button>
            </div>
          </div>
        </div>
      </section>

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
            <article class="pop-card rounded-[1.75rem] bg-[#eaf3ff] p-6">
              <span class="inline-block rounded-full bg-white px-3 py-1 text-xs font-bold text-[#2e72ec]">KABAR KAMPUS</span>
              <h3 class="mt-4 text-2xl font-bold text-[#153563]">Reuni yang jadi awal kolaborasi</h3>
              <p class="mt-3 leading-relaxed text-[#355277]">Tiga alumni mengubah obrolan reuni menjadi proyek kreatif yang seru.</p>
              <p class="mt-5 text-sm font-bold text-[#153563]">28 Agustus 2026</p>
            </article>
            <article class="pop-card rounded-[1.75rem] bg-[#fffbed] p-6" style="transition-delay:.05s">
              <span class="inline-block rounded-full bg-white px-3 py-1 text-xs font-bold text-[#9d7800]">KARIER</span>
              <h3 class="mt-4 text-2xl font-bold text-[#153563]">Networking tanpa terasa canggung</h3>
              <p class="mt-3 leading-relaxed text-[#355277]">Tips ringan untuk mulai ngobrol dan membangun koneksi autentik.</p>
              <p class="mt-5 text-sm font-bold text-[#153563]">20 Agustus 2026</p>
            </article>
            <article class="pop-card rounded-[1.75rem] bg-[#fff5f8] p-6" style="transition-delay:.1s">
              <span class="inline-block rounded-full bg-white px-3 py-1 text-xs font-bold text-[#c8517d]">KOMUNITAS</span>
              <h3 class="mt-4 text-2xl font-bold text-[#153563]">Membuat ruang aman untuk bertumbuh</h3>
              <p class="mt-3 leading-relaxed text-[#355277]">Cerita di balik sesi berbagi ilmu dari alumni untuk alumni.</p>
              <p class="mt-5 text-sm font-bold text-[#153563]">12 Agustus 2026</p>
            </article>
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

      <section id="album" class="auth-section bg-[#f5f9ff] py-20">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="reveal-onscroll">
            <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Album komunitas</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Kenangan yang tersimpan rapi.</h2>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Koleksi album foto khusus untuk alumni yang sudah login.</p>
          </div>
          <div class="mt-9 grid gap-5 md:grid-cols-3">
            <article class="pop-card reveal-onscroll rounded-[1.75rem] bg-[#eaf3ff] p-6">
              <span class="text-4xl">✿</span>
              <h3 class="mt-8 text-2xl font-bold text-[#153563]">Reuni Akbar 2026</h3>
              <p class="mt-2 text-[#355277]">128 foto pilihan</p>
              <button class="demo-action focus-ring mt-6 rounded-xl bg-[#153563] px-4 py-2.5 text-sm font-bold text-white" type="button">Lihat album</button>
            </article>
            <article class="pop-card reveal-onscroll rounded-[1.75rem] bg-[#fffbed] p-6" style="transition-delay:.05s">
              <span class="text-4xl">☀</span>
              <h3 class="mt-8 text-2xl font-bold text-[#153563]">Summer Getaway</h3>
              <p class="mt-2 text-[#355277]">64 foto pilihan</p>
              <button class="demo-action focus-ring mt-6 rounded-xl bg-[#153563] px-4 py-2.5 text-sm font-bold text-white" type="button">Lihat album</button>
            </article>
            <article class="pop-card reveal-onscroll rounded-[1.75rem] bg-[#fff5f8] p-6" style="transition-delay:.1s">
              <span class="text-4xl">★</span>
              <h3 class="mt-8 text-2xl font-bold text-[#153563]">Alumni Awards</h3>
              <p class="mt-2 text-[#355277]">92 foto pilihan</p>
              <button class="demo-action focus-ring mt-6 rounded-xl bg-[#153563] px-4 py-2.5 text-sm font-bold text-white" type="button">Lihat album</button>
            </article>
          </div>
        </div>
      </section>

      <section id="lowongan" class="auth-section mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="reveal-onscroll">
          <p class="mb-3 inline-flex rounded-full bg-[#eaf3ff] px-4 py-2 text-sm font-bold text-[#153563]">Karier &amp; peluang</p>
          <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Lowongan pilihan untukmu.</h2>
          <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Info lowongan dari sesama alumni, khusus untuk yang sudah login.</p>
        </div>
        <div class="mt-9 grid gap-4 md:grid-cols-3">
          <article class="job-card reveal-onscroll rounded-[1.5rem] bg-white p-5 shadow-sm">
            <div class="flex flex-wrap items-start justify-between gap-3">
              <div>
                <h4 class="text-xl font-bold text-[#153563]">Product Designer</h4>
                <p class="mt-1 text-[#355277]">Kawan Studio</p>
              </div>
              <span class="rounded-full bg-[#eaf3ff] px-3 py-1 text-xs font-bold text-[#2e72ec]">Full-time</span>
            </div>
            <p class="mt-4 text-sm text-[#355277]">Jakarta · Hybrid · Teknologi</p>
            <button class="demo-action focus-ring mt-4 rounded-xl bg-[#2e72ec] px-4 py-2.5 text-sm font-bold text-white" type="button">Lihat lowongan</button>
          </article>
          <article class="job-card reveal-onscroll rounded-[1.5rem] bg-white p-5 shadow-sm" style="transition-delay:.05s">
            <div class="flex flex-wrap items-start justify-between gap-3">
              <div>
                <h4 class="text-xl font-bold text-[#153563]">Partnership Associate</h4>
                <p class="mt-1 text-[#355277]">Ruang Tumbuh</p>
              </div>
              <span class="rounded-full bg-[#fff0a9] px-3 py-1 text-xs font-bold text-[#745900]">Remote</span>
            </div>
            <p class="mt-4 text-sm text-[#355277]">Surabaya · Remote · Komunitas</p>
            <button class="demo-action focus-ring mt-4 rounded-xl bg-[#2e72ec] px-4 py-2.5 text-sm font-bold text-white" type="button">Lihat lowongan</button>
          </article>
          <article class="job-card reveal-onscroll rounded-[1.5rem] bg-white p-5 shadow-sm" style="transition-delay:.1s">
            <div class="flex flex-wrap items-start justify-between gap-3">
              <div>
                <h4 class="text-xl font-bold text-[#153563]">Community Manager</h4>
                <p class="mt-1 text-[#355277]">Balik Kampus</p>
              </div>
              <span class="rounded-full bg-[#ffd9e7] px-3 py-1 text-xs font-bold text-[#c8517d]">Part-time</span>
            </div>
            <p class="mt-4 text-sm text-[#355277]">Yogyakarta · Onsite · Sosial</p>
            <button class="demo-action focus-ring mt-4 rounded-xl bg-[#2e72ec] px-4 py-2.5 text-sm font-bold text-white" type="button">Lihat lowongan</button>
          </article>
        </div>
      </section>

      <section id="event" class="auth-section bg-[#eaf3ff] py-20">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
          <div class="reveal-onscroll">
            <p class="mb-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-[#153563]">Agenda komunitas</p>
            <h2 class="text-4xl font-bold text-[#153563] md:text-5xl">Jangan sampai ketinggalan momennya.</h2>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#355277]">Meetup, workshop, dan agenda seru khusus alumni yang sudah login.</p>
          </div>
          <div class="mt-9 grid gap-4 md:grid-cols-3">
            <article class="event-card reveal-onscroll flex gap-4 rounded-[1.5rem] bg-white p-5 shadow-sm">
              <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-[#ffd9e7] text-center">
                <span class="font-bold text-[#153563]" style="line-height:1">14<br>SEP</span>
              </div>
              <div class="min-w-0">
                <span class="text-xs font-bold text-[#c8517d]">MEETUP</span>
                <h4 class="mt-1 text-xl font-bold text-[#153563]">Coffee &amp; Catch Up</h4>
                <p class="mt-1 text-sm text-[#355277]">Kota Lama, Surabaya</p>
                <button class="demo-action focus-ring mt-3 rounded-xl bg-[#153563] px-4 py-2 text-sm font-bold text-white" type="button">Daftar</button>
              </div>
            </article>
            <article class="event-card reveal-onscroll flex gap-4 rounded-[1.5rem] bg-white p-5 shadow-sm" style="transition-delay:.05s">
              <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-[#fff0a9] text-center">
                <span class="font-bold text-[#153563]" style="line-height:1">22<br>SEP</span>
              </div>
              <div class="min-w-0">
                <span class="text-xs font-bold text-[#9d7800]">WORKSHOP</span>
                <h4 class="mt-1 text-xl font-bold text-[#153563]">Personal Branding 101</h4>
                <p class="mt-1 text-sm text-[#355277]">Online via Zoom</p>
                <button class="demo-action focus-ring mt-3 rounded-xl bg-[#153563] px-4 py-2 text-sm font-bold text-white" type="button">Daftar</button>
              </div>
            </article>
            <article class="event-card reveal-onscroll flex gap-4 rounded-[1.5rem] bg-white p-5 shadow-sm" style="transition-delay:.1s">
              <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-[#cce8de] text-center">
                <span class="font-bold text-[#153563]" style="line-height:1">05<br>OKT</span>
              </div>
              <div class="min-w-0">
                <span class="text-xs font-bold text-[#2e7d5e]">OLAHRAGA</span>
                <h4 class="mt-1 text-xl font-bold text-[#153563]">Alumni Sports Day</h4>
                <p class="mt-1 text-sm text-[#355277]">GOR Kampus Utama</p>
                <button class="demo-action focus-ring mt-3 rounded-xl bg-[#153563] px-4 py-2 text-sm font-bold text-white" type="button">Daftar</button>
              </div>
            </article>
          </div>
        </div>
      </section>

      <section class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="reveal-onscroll relative overflow-hidden rounded-[2.5rem] bg-[#2e72ec] p-8 text-center md:p-14">
          <span class="absolute left-8 top-7 text-4xl text-[#fff0a9] floaty-slow">✦</span>
          <span class="absolute bottom-4 right-10 text-5xl text-[#ffb8d0] floaty">✿</span>
          <h2 class="relative mx-auto max-w-2xl text-4xl font-bold text-white md:text-5xl">Masih ada tempat untuk ceritamu di sini.</h2>
          <p class="relative mx-auto mt-4 max-w-xl text-lg leading-relaxed text-[#eaf3ff]">Datang, sapa teman lama, dan buka kesempatan baru bersama komunitas alumni.</p>
          <a class="js-nav-link focus-ring relative mt-7 inline-block rounded-2xl bg-[#fff0a9] px-6 py-3.5 font-bold text-[#153563] transition hover:-translate-y-1" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni">Gabung komunitas</a>
        </div>
      </section>
    </main>

    <footer class="border-t border-blue-100 bg-white">
      <div class="mx-auto grid max-w-7xl gap-8 px-5 py-10 md:grid-cols-[1.3fr_1fr_1fr] md:px-8">
        <div>
          <p class="text-2xl font-bold text-[#153563]">✦ Alumni Connect</p>
          <p class="mt-2 max-w-xs text-sm leading-relaxed text-[#355277]">Koneksi yang terasa dekat, meski sudah jauh dari kampus.</p>
        </div>
        <div>
          <h2 class="font-bold text-[#153563]">Jelajahi</h2>
          <div class="mt-3 grid gap-2 text-sm">
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#alumni" data-target="#alumni" data-auth-link data-auth-label="Direktori Alumni">Alumni</a>
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#media" data-target="#media">Media</a>
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#lowongan" data-target="#lowongan" data-auth-link data-auth-label="Lowongan Kerja">Lowongan</a>
            <a class="js-nav-link focus-ring rounded-lg text-[#355277] hover:text-[#2e72ec]" href="#event" data-target="#event" data-auth-link data-auth-label="Agenda Event">Event</a>
          </div>
        </div>
        <div>
          <h2 class="font-bold text-[#153563]">Sapa kami</h2>
          <div class="mt-3 flex gap-2">
            <button class="demo-action focus-ring grid h-10 w-10 place-items-center rounded-xl bg-[#fff5f8] text-[#153563] transition hover:-translate-y-0.5" type="button" aria-label="Instagram"><i data-lucide="instagram" class="h-4 w-4"></i></button>
            <button class="demo-action focus-ring grid h-10 w-10 place-items-center rounded-xl bg-[#eaf3ff] text-[#153563] transition hover:-translate-y-0.5" type="button" aria-label="LinkedIn"><i data-lucide="linkedin" class="h-4 w-4"></i></button>
            <button class="demo-action focus-ring grid h-10 w-10 place-items-center rounded-xl bg-[#fffbed] text-[#153563] transition hover:-translate-y-0.5" type="button" aria-label="Email"><i data-lucide="mail" class="h-4 w-4"></i></button>
          </div>
        </div>
      </div>
      <div class="border-t border-blue-100 px-5 py-5 text-center">
        <p class="text-sm text-[#355277]">© 2026 Alumni Connect · Dibuat dengan banyak cerita baik.</p>
      </div>
    </footer>
  </div>

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
      <form id="login-form" class="mt-6">
        <label class="mb-2 block text-sm font-bold text-[#153563]" for="login-email">Email</label>
        <input id="login-email" class="focus-ring w-full rounded-xl border border-blue-200 px-4 py-3" type="email" placeholder="nama@email.com" required>
        <button class="focus-ring mt-4 w-full rounded-xl bg-[#2e72ec] px-4 py-3 font-bold text-white transition hover:-translate-y-0.5" type="submit">Lanjutkan</button>
      </form>
      <p id="login-result" class="mt-4 text-center text-sm text-[#355277]">Halaman ini menggunakan tampilan demo dan tidak menyimpan data akun ke server.</p>
    </div>
  </div>

  <!-- Floating action buttons: tombol scroll-ke-atas & WhatsApp sejajar di baris yang sama -->
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
        <p class="mt-1 text-sm leading-relaxed text-[#355277]">Chat kami di WhatsApp, kami siap bantu 👋</p>
        <p class="mt-2 text-sm font-bold text-[#2e72ec]">+62 812-3456-7890</p>
      </div>
      <a id="wa-button" href="https://wa.me/6281234567890?text=Halo%20Alumni%20Connect%2C%20saya%20ingin%20bertanya" target="_blank" rel="noopener" class="focus-ring wa-pulse grid h-14 w-14 place-items-center rounded-full bg-[#25D366] text-white shadow-xl" aria-label="Hubungi kami via WhatsApp">
        <i data-lucide="message-circle" class="h-7 w-7"></i>
      </a>
    </div>
  </div>

  <div id="toast" class="toast fixed bottom-5 left-1/2 z-[70] -translate-x-1/2 rounded-full bg-[#153563] px-5 py-3 text-sm font-bold text-white shadow-xl" role="status"></div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
