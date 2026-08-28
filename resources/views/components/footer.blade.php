<!-- ===== CSS KHUSUS FOOTER ===== -->
<style>
.footer {
    background: var(--ink);
    padding: 50px 24px 26px;
}
.footer-inner {
    max-width: 1180px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    gap: 40px;
    flex-wrap: wrap;
    padding-bottom: 28px;
    border-bottom: 1.5px solid rgba(255, 247, 214, 0.18);
}
.footer-brand {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    max-width: 280px;
}
.footer-brand .logo-icon {
    background: var(--sunwashed);
}
.footer-brand .logo-text {
    font-family: var(--font-display);
    font-weight: 700;
    color: var(--cloudpuff);
}
.footer-brand p {
    width: 100%;
    color: var(--dewyblue);
    font-size: 0.85rem;
    margin-top: 6px;
}
.footer-links {
    display: flex;
    gap: 60px;
}
.footer-links h4 {
    color: var(--sunwashed);
    font-family: var(--font-display);
    font-size: 0.9rem;
    margin-bottom: 12px;
}
.footer-links a {
    display: block;
    color: var(--dewyblue);
    font-size: 0.88rem;
    margin-bottom: 8px;
    text-decoration: none;
}
.footer-links a:hover {
    color: var(--buttercup);
}
.footer-bottom {
    text-align: center;
    color: var(--dewyblue);
    font-size: 0.8rem;
    margin: 22px 0 0;
}


</style>

<!-- ===== STRUKTUR HTML FOOTER ===== -->
<footer class="footer" id="footer-section">
  <div class="footer-inner">
    <div class="footer-brand">
      <span class="logo-icon">✦</span>
      <span class="logo-text">IKASMAJA</span>
      <p>
        Satu almamater, sejuta cerita indah. Wadah resmi komunikasi dan
        kolaborasi seluruh keluarga besar alumni.
      </p>
    </div>
    <div class="footer-links">
      <div>
        <h4>Jelajahi</h4>
        <a href="#lowongan">Lowongan</a>
        <a href="#alumni">Alumni</a>
        <a href="#album">Album</a>
      </div>
      <div>
        <h4>Komunitas</h4>
        <a href="#event">Event</a>
        <a href="#masuk">Masuk</a>
        <a href="#daftar">Daftar</a>
      </div>
    </div>
  </div>
  <p class="footer-bottom">
    © 2026 IKASMAJA. Dibuat dengan penuh rasa nostalgia & kebersamaan.
  </p>
</footer>
