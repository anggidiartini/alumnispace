<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<footer class="as-footer">
    <div class="as-footer__inner">

        {{-- ===== TOP: BRAND + COLUMNS ===== --}}
        <div class="as-footer__top">
<div class="as-footer__brand">
    <div class="as-footer__logo-row">
        <span class="as-footer__logo-badge">
            <img src="{{ asset('assets/images/logo-as.webp') }}" alt="Alumni Space">
        </span>
        <span class="as-footer__logo-text">Alumni Space</span>
    </div>
    <h2 class="as-footer__headline">
                    Koneksi yang terasa dekat,
                    <span>meski sudah jauh dari almamater.</span>
                </h2>
                <p class="as-footer__desc">
                    Rumah digital bagi seluruh lulusan untuk saling terhubung, berbagi cerita,
                    dan tumbuh bersama lewat komunitas, karier, hingga agenda reuni.
                </p>


            </div>

            <div class="as-footer__columns">

                <div class="as-footer__col">
                    <h5 class="as-footer__col-title">Jelajahi Fitur</h5>
                    <ul class="as-footer__links">
                        @php
                            $isUserRole = Auth::check() && Auth::user()->role === 'user';
                            $isLandingPage = Request::routeIs('home');
                            $footerAlumniHref = $isUserRole ? ($isLandingPage ? '#beranda' : route('home', ['locked' => 'alumni'])) : route('alumni.index');
                            $footerAlbumHref = $isUserRole ? ($isLandingPage ? '#beranda' : route('home', ['locked' => 'album'])) : route('album.index');
                            $footerLowonganHref = $isUserRole ? ($isLandingPage ? '#beranda' : route('home', ['locked' => 'lowongan'])) : route('lowongan.index');
                        @endphp
                        {{-- QA-016 & QA-017: Direktori Alumni (Khusus Alumni & Admin, terkunci bagi Guest dan User biasa) --}}
                        @if(!Auth::check() || $isUserRole)
                        <li>
                            <a href="{{ $footerAlumniHref }}" data-auth-link data-auth-label="Direktori Alumni" @if($isUserRole) data-role-locked="true" @endif style="display:inline-flex; align-items:center; gap:6px;">
                                Direktori Alumni
                                <i data-lucide="lock" class="icon-lock" style="width: 13px; height: 13px; opacity: 0.85;"></i>
                            </a>
                        </li>
                        @else
                        <li><a href="{{ route('alumni.index') }}">Direktori Alumni</a></li>
                        @endif

                        {{-- QA-020: Album Kenangan (Dibatasi bagi non-alumni: terkunci bagi Guest dan User biasa) --}}
                        @if(!Auth::check() || $isUserRole)
                        <li>
                            <a href="{{ $footerAlbumHref }}" data-auth-link data-auth-label="Album Kenangan" @if($isUserRole) data-role-locked="true" @endif style="display:inline-flex; align-items:center; gap:6px;">
                                Album Kenangan
                                <i data-lucide="lock" class="icon-lock" style="width: 13px; height: 13px; opacity: 0.85;"></i>
                            </a>
                        </li>
                        @else
                        <li><a href="{{ route('album.index') }}">Album Kenangan</a></li>
                        @endif

                        {{-- QA-018: Bursa Lowongan (Kunci akses bagi pengguna Guest/User) --}}
                        @if(!Auth::check() || $isUserRole)
                        <li>
                            <a href="{{ $footerLowonganHref }}" data-auth-link data-auth-label="Lowongan Kerja" @if($isUserRole) data-role-locked="true" @endif style="display:inline-flex; align-items:center; gap:6px;">
                                Bursa Lowongan
                                <i data-lucide="lock" class="icon-lock" style="width: 13px; height: 13px; opacity: 0.85;"></i>
                            </a>
                        </li>
                        @else
                        <li><a href="{{ route('lowongan.index') }}">Bursa Lowongan</a></li>
                        @endif

                        {{-- QA-019: Agenda Event (Kunci akses bagi publik tanpa login) --}}
                        @guest
                        <li>
                            <a href="{{ route('event.index') }}" data-auth-link data-auth-label="Agenda Event" style="display:inline-flex; align-items:center; gap:6px;">
                                Agenda Event
                                <i data-lucide="lock" class="icon-lock" style="width: 13px; height: 13px; opacity: 0.85;"></i>
                            </a>
                        </li>
                        @else
                        <li><a href="{{ route('event.index') }}">Agenda Event</a></li>
                        @endguest
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
                    @php
                        // Ambil 3 artikel terbit terbaru langsung dari database,
                        // jadi judul/slug otomatis ikut berubah saat diedit di admin.
                        $footerArticles = \App\Models\Article::where('is_published', true)
                            ->latest('published_at')
                            ->take(3)
                            ->get(['title', 'slug']);
                    @endphp
                    <ul class="as-footer__links">
                        @forelse($footerArticles as $footerArticle)
                            <li><a href="{{ route('artikel.show', $footerArticle->slug) }}">{{ $footerArticle->title }}</a></li>
                        @empty
                            <li><a href="{{ route('artikel.index') }}">Lihat semua artikel</a></li>
                        @endforelse
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

@php
    $isRegularUser = Auth::check() && Auth::user()->role === 'user';
    $lockedParam = request('locked');
    $hasSessionLocked = session()->has('locked_feature');
    $isAutoLocked = $isRegularUser && ($hasSessionLocked || in_array($lockedParam, ['alumni', 'album', 'lowongan']));
    $autoLockedLabel = session('locked_feature') ?? ($lockedParam === 'album' ? 'Album Kenangan' : ($lockedParam === 'lowongan' ? 'Lowongan Kerja' : 'Direktori Alumni'));
@endphp

@if(!Auth::check() || $isRegularUser)
    <div id="auth-modal-overlay" class="auth-modal-overlay{{ $isAutoLocked ? ' active' : '' }}" @if($isAutoLocked) data-auto-open="true" @endif>
        <div class="auth-modal-card">
            <button id="auth-modal-close" type="button" class="auth-modal-close" aria-label="Tutup"><i data-lucide="x" class="h-5 w-5"></i></button>
            <span class="auth-modal-icon"><i data-lucide="lock" class="h-7 w-7"></i></span>
            @guest
                <h3 class="auth-modal-title">Yah, masih terkunci</h3>
                <p class="auth-modal-text">Kamu harus masuk dulu buat akses <strong id="auth-modal-label">fitur ini</strong>.</p>
                <div class="auth-modal-actions">
                    <button id="auth-modal-cancel" type="button" class="auth-modal-btn-secondary">Nanti dulu</button>
                    <a id="auth-modal-confirm" href="{{ route('login') }}" class="auth-modal-btn-primary">Login sekarang</a>
                </div>
            @else
                <h3 class="auth-modal-title">Akses Khusus Alumni</h3>
                <p class="auth-modal-text">Fitur <strong id="auth-modal-label">{{ $isAutoLocked ? $autoLockedLabel : 'fitur ini' }}</strong> hanya dapat diakses oleh akun Alumni terverifikasi.</p>
                <div class="auth-modal-actions">
                    <button id="auth-modal-cancel" type="button" class="auth-modal-btn-primary" style="width: 100%;">Mengerti</button>
                </div>
            @endguest
        </div>
    </div>
@endif
