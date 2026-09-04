<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<footer class="as-footer">
    <div class="as-footer__inner">

        {{-- ===== TOP: BRAND + COLUMNS ===== --}}
        <div class="as-footer__top">

            <div class="as-footer__brand">
                <p class="as-footer__logo">✦ Alumni Space</p>
                <h2 class="as-footer__headline">
                    Koneksi yang terasa dekat,
                    <span>meski sudah jauh dari almamater.</span>
                </h2>
                <p class="as-footer__desc">
                    Rumah digital bagi seluruh lulusan untuk saling terhubung, berbagi cerita,
                    dan tumbuh bersama lewat komunitas, karier, hingga agenda reuni.
                </p>

                <form class="as-footer__subscribe" onsubmit="return false;">
                    <input type="email" placeholder="Email kamu" required>
                    <button type="submit">Gabung</button>
                </form>
            </div>

            <div class="as-footer__columns">

                <div class="as-footer__col">
                    <h5 class="as-footer__col-title">Jelajahi Fitur</h5>
                    <ul class="as-footer__links">
                        <li><a href="{{ url('/direktori') }}">Direktori Alumni</a></li>
                        <li><a href="{{ url('/album') }}">Album Kenangan</a></li>
                        <li><a href="{{ url('/lowongan') }}">Bursa Lowongan</a></li>
                        <li><a href="{{ url('/agenda') }}">Agenda Event</a></li>
                    </ul>
                </div>

                <div class="as-footer__col">
                    <h5 class="as-footer__col-title">Layanan</h5>
                    <ul class="as-footer__links">
                        <li><a href="{{ url('/layanan/konsultasi-karier') }}">Konsultasi Karier</a></li>
                        <li><a href="{{ url('/layanan/mentoring') }}">Mentoring Alumni</a></li>
                        <li><a href="{{ url('/layanan/beasiswa') }}">Info Beasiswa</a></li>
                        <li><a href="{{ url('/layanan/kerjasama') }}">Kerjasama Perusahaan</a></li>
                    </ul>
                </div>

                <div class="as-footer__col">
                    <h5 class="as-footer__col-title">Artikel Terbaru</h5>
                    <ul class="as-footer__links">
                        <li><a href="{{ url('/artikel/peresmian-lab-komputer') }}">Peresmian Gedung Baru Lab Komputer Hasil Donasi Alumni</a></li>
                        <li><a href="{{ url('/artikel/tips-interview-unicorn') }}">Tips Lolos Interview Kerja di Perusahaan Unicorn ala Kakak Alumni</a></li>
                        <li><a href="{{ url('/artikel/grand-reunion-2027') }}">Persiapan Grand Reunion 2027: Bakal Ada Artis Tamu Spesial!</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="as-footer__divider"></div>

        {{-- ===== BOTTOM BAR ===== --}}
        <div class="as-footer__bottom">
            <p class="as-footer__copyright">&copy; {{ date('Y') }} Alumni Space &middot; Dibuat dengan banyak cerita baik.</p>

            <div class="as-footer__socials">
                <a href="https://instagram.com" target="_blank" rel="noopener">Instagram</a>
                <a href="https://linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
                <a href="mailto:hello@alumnispace.id">Email</a>
            </div>
        </div>

    </div>
</footer>
