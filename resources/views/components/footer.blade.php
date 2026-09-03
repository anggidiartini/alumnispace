<footer class="border-t border-blue-100 bg-white">
      <div class="mx-auto grid max-w-7xl gap-8 px-5 py-10 md:grid-cols-[1.3fr_1fr_1fr] md:px-8">
        <div>
          <p class="text-2xl font-bold text-[#153563]">✦ {{ $settings['brand_name'] ?? 'Alumni Space' }}</p>
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
        <p class="text-sm text-[#355277]">© 2026 {{ $settings['brand_name'] ?? 'Alumni Space' }} · Dibuat dengan banyak cerita baik.</p>
      </div>
    </footer>
