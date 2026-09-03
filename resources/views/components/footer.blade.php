<footer class="site-footer">
  <div class="footer-container">
    <div class="footer-col-1">
      <p class="footer-brand">✦ {{ $settings['brand_name'] ?? 'Alumni Space' }}</p>
      <p class="footer-tagline">{{ $settings['footer_tagline'] ?? 'Koneksi yang terasa dekat, meski sudah jauh dari almamater.' }}</p>
    </div>
    <div class="footer-col-2">
      <h3>Jelajahi Fitur</h3>
      <div class="footer-links">
        <a href="{{ route('alumni.index') }}" @guest data-auth-link data-auth-label="Direktori Alumni" @endguest>Direktori Alumni</a>
        <a href="{{ url('/#album') }}" @guest data-auth-link data-auth-label="Album Foto" @endguest>Album Kenangan</a>
        <a href="{{ url('/#lowongan') }}" @guest data-auth-link data-auth-label="Lowongan Kerja" @endguest>Bursa Lowongan</a>
        <a href="{{ url('/#event') }}" @guest data-auth-link data-auth-label="Agenda Event" @endguest>Agenda Event</a>
      </div>
    </div>
    <div class="footer-col-3">
      <h3>Sapa Kami</h3>
      <div class="footer-socials">
        <a href="#" aria-label="Instagram">IG</a>
        <a href="#" aria-label="LinkedIn">IN</a>
        <a href="mailto:{{ $settings['contact_email'] ?? 'halo@alumniconnect.id' }}" aria-label="Email">Mail</a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2026 {{ $settings['brand_name'] ?? 'Alumni Space' }} · Dibuat dengan banyak cerita baik.</p>
  </div>
</footer>
