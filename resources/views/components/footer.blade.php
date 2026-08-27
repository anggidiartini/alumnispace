<!-- FOOTER -->
<footer>
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">✨ Antares Alumni Club</div>
      <div class="footer-links">
        <a href="#about">Tentang</a>
        <a href="#gallery">Galeri</a>
        <a href="#login">Masuk</a>
        <a href="#daftar">Daftar</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Antares Alumni Club. Dibuat dengan 💛 buat kawan lama.</span>
      <span>Kawan Lama, Cerita Baru</span>
    </div>
  </div>
</footer>

<script>
  const navToggle = document.getElementById('navToggle');
  const navLinks = document.getElementById('navLinks');
  navToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => navLinks.classList.remove('open'));
  });
</script>

</body>
</html>