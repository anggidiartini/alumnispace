

<!-- ===== CSS KHUSUS NAVBAR ===== -->
<style>
.navbar {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 50;
    background: transparent !important;
    border-bottom: none;
    transition: all 0.3s ease;
}

.navbar.scrolled {
    position: fixed;
    background: var(--white) !important;
    border-bottom: var(--border-w) solid var(--ink);
    box-shadow: 0 4px 0 rgba(30, 44, 79, 0.12);
}

.nav-inner {
    max-width: 1180px;
    margin: 0 auto;
    padding: 14px 24px;
    display: flex;
    align-items: center;
    gap: 22px;
}

.logo, .logo-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 1.2rem;
    color: var(--ink);
    margin-right: auto;
    text-decoration: none;
}

.logo-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--sunwashed);
    border: var(--border-w) solid var(--ink);
    border-radius: 50%;
    font-size: 1.05rem;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 26px;
}

.nav-links a {
    font-family: var(--font-display);
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--ink);
    position: relative;
    text-decoration: none;
}

.nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0;
    height: 3px;
    background: var(--morning);
    border-radius: 3px;
    transition: width 0.2s ease;
}

.nav-links a:hover::after,
.nav-links a.active::after {
    width: 100%;
}

.nav-cta {
    padding: 10px 22px;
    font-size: 0.9rem;
}
.burger {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px;
}
.burger span {
    width: 24px;
    height: 3px;
    border-radius: 3px;
    background: var(--ink);
    transition:
        transform 0.2s ease,
        opacity 0.2s ease;
}
</style>

<!-- ===== STRUKTUR HTML NAVBAR ===== -->
<header class="navbar" id="navbar">
  <div class="nav-inner">
    <a href="{{ url('/') }}" class="logo-brand">
      <span class="text-alumni">ALUMNI</span><span class="text-hub">HUB</span>
    </a>

    <nav class="nav-links" id="navLinks">
      <a href="#beranda" class="active">Beranda</a>
      <a href="#lowongan">Lowongan</a>
      <a href="#alumni">Alumni</a>
      <a href="#event">Event</a>
      <a href="#album">Album</a>
    </nav>
  </div>
</header>
