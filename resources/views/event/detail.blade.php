{{--
    resources/views/events/show.blade.php

    Halaman detail event — dinamis berdasarkan $event->status ('upcoming' | 'completed').
    Struktur data Eloquent yang diharapkan (sesuaikan nama relasi/kolom dengan model kamu):

    Event
    ├── slug                 string   (route key)
    ├── title                string
    ├── category             string   (mis. "Design & Creative")
    ├── short_description    string   (dipakai di hero)
    ├── about_description    string   (dipakai di section "Tentang event ini")
    ├── status               enum     'upcoming' | 'completed'
    ├── event_date           date     -> ->translatedFormat('d F Y')
    ├── location_type        string   (mis. "Offline" / "Online" / "Hybrid")
    ├── time_info            string   (mis. "Sepanjang hari" / "09:00 - 16:00 WIB")
    ├── venue                string
    ├── quota                int|null (hanya relevan saat upcoming)
    ├── registered_count     int|null (hanya relevan saat upcoming)
    ├── summary_text         string|null (ringkasan kegiatan, hanya relevan saat completed)
    ├── participant_count    int|null (jumlah peserta yang hadir, hanya relevan saat completed)
    ├── benefits             hasMany EventBenefit { icon, title, description, color }
    └── galleries            hasMany EventGallery { image_url, caption }

    Route yang sudah ada:
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.show');
    Route::post('/event/{id}/register', [EventController::class, 'register'])->name('event.register');
--}}
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $event->title }} — Alumn Space Career Hub</title>

    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js" defer></script>

    <link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
</head>
<body>
    <div class="app-wrapper">

        {{-- ================= NAVBAR ================= --}}
        <header class="nav-glass">
            <nav class="navbar" aria-label="Navigasi utama">
                <a href="{{ route('event.index') }}" class="brand" aria-label="Alumn Space Career Hub beranda">
                    <span class="brand-mark" aria-hidden="true">
                        <i data-lucide="sparkles" width="17" height="17"></i>
                    </span>
                    <span class="brand-name">ALUMN SPACE CAREER HUB</span>
                </a>
            </nav>
        </header>

        <main id="top" class="page-main">

            {{-- ================= HERO ================= --}}
            <section class="hero-card reveal" aria-labelledby="event-title">
                <span class="hero-orb" aria-hidden="true"></span>
                <i class="hero-spark" data-lucide="sparkles" width="37" height="37" aria-hidden="true"></i>

                <div class="hero-content">
                    <div class="hero-top-row">
                        <span class="tag tag-yellow">Featured Event</span>

                        @if ($event->status === 'upcoming')
                            <span class="tag tag-white">
                                <span class="status-dot" aria-hidden="true"></span>
                                <span>Open for registration</span>
                            </span>
                        @else
                            <span class="tag tag-white tag-muted">
                                <span class="status-dot status-dot-muted" aria-hidden="true"></span>
                                <span>Event selesai</span>
                            </span>
                        @endif
                    </div>

                    <div class="hero-copy">
                        <span class="hero-category">{{ $event->category }}</span>
                        <h1 id="event-title" class="hero-title">{{ $event->title }}</h1>
                        <p class="hero-description">{{ $event->short_description }}</p>
                    </div>
                </div>
            </section>

            <div class="content-grid">

                {{-- ================= KOLOM UTAMA ================= --}}
                <div class="content-main">

                    {{-- ---- Tentang event ---- --}}
                    <section class="surface-card reveal" aria-labelledby="about-title">
                        <div class="section-heading">
                            <span class="icon-badge icon-badge-lavender" aria-hidden="true">
                                <i data-lucide="heart-handshake" width="19" height="19"></i>
                            </span>
                            <h2 id="about-title" class="section-title">Tentang event ini</h2>
                        </div>
                        <p class="section-text">{{ $event->about_description }}</p>

                        <div class="metadata-row">
                            <div class="metadata-item">
                                <span class="metadata-icon" aria-hidden="true">
                                    <i data-lucide="calendar-days" width="17" height="17"></i>
                                </span>
                                <div class="metadata-text">
                                    <span class="metadata-label">Tanggal</span>
                                    <span class="metadata-value">{{ $event->event_date->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                            <div class="metadata-item">
                                <span class="metadata-icon" aria-hidden="true">
                                    <i data-lucide="map-pin" width="17" height="17"></i>
                                </span>
                                <div class="metadata-text">
                                    <span class="metadata-label">Lokasi</span>
                                    <span class="metadata-value">{{ $event->location_type }}</span>
                                </div>
                            </div>
                            <div class="metadata-item">
                                <span class="metadata-icon" aria-hidden="true">
                                    <i data-lucide="clock-3" width="17" height="17"></i>
                                </span>
                                <div class="metadata-text">
                                    <span class="metadata-label">Waktu</span>
                                    <span class="metadata-value">{{ $event->time_info }}</span>
                                </div>
                            </div>
                            <div class="metadata-item">
                                <span class="metadata-icon" aria-hidden="true">
                                    <i data-lucide="building-2" width="17" height="17"></i>
                                </span>
                                <div class="metadata-text">
                                    <span class="metadata-label">Venue</span>
                                    <span class="metadata-value">{{ $event->venue }}</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- ---- Manfaat / benefits (opsional, tampil di kedua status) ---- --}}
                    @if ($event->benefits && $event->benefits->count())
                        <section class="surface-card reveal" aria-labelledby="benefits-title">
                            <div class="section-heading-row">
                                <div>
                                    <h2 id="benefits-title" class="section-title">Yang akan kamu dapatkan</h2>
                                    <p class="section-subtitle">Tiga bekal sederhana untuk langkah kreatifmu.</p>
                                </div>
                                <span class="decor-blob" aria-hidden="true"></span>
                            </div>

                            <div class="benefit-grid">
                                @foreach ($event->benefits as $benefit)
                                    <article class="benefit-item benefit-{{ $benefit->color ?? 'yellow' }}">
                                        <span class="benefit-icon" aria-hidden="true">
                                            <i data-lucide="{{ $benefit->icon }}" width="18" height="18"></i>
                                        </span>
                                        <div>
                                            <h3 class="benefit-title">{{ $benefit->title }}</h3>
                                            <p class="benefit-text">{{ $benefit->description }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- ---- Galeri dokumentasi — HANYA saat status completed ---- --}}
                    @if ($event->status === 'completed')
                        <section class="surface-card reveal" aria-labelledby="gallery-title">
                            <div class="section-heading">
                                <span class="icon-badge icon-badge-mint" aria-hidden="true">
                                    <i data-lucide="images" width="19" height="19"></i>
                                </span>
                                <h2 id="gallery-title" class="section-title">Dokumentasi acara</h2>
                            </div>

                            @if ($event->summary_text)
                                <p class="section-text">{{ $event->summary_text }}</p>
                            @endif

                            @if ($event->galleries && $event->galleries->count())
                                <div class="gallery-grid">
                                    @foreach ($event->galleries as $item)
                                        <figure class="gallery-item reveal">
                                            <img
                                                src="{{ $item->image_url }}"
                                                alt="{{ $item->caption ?? $event->title }}"
                                                loading="lazy"
                                            >
                                            @if ($item->caption)
                                                <figcaption>{{ $item->caption }}</figcaption>
                                            @endif
                                        </figure>
                                    @endforeach
                                </div>
                            @else
                                <p class="section-text section-text-muted">Dokumentasi acara akan segera ditambahkan.</p>
                            @endif
                        </section>
                    @endif

                </div>

                {{-- ================= SIDEBAR ================= --}}
                <aside class="content-side">
                    @if ($event->status === 'upcoming')
                        {{-- ---- Kartu pendaftaran — HANYA saat status upcoming ---- --}}
                        <section class="surface-card registration-card reveal" aria-label="Pendaftaran event">
                            <div class="tag tag-mint">
                                <span class="status-dot" aria-hidden="true"></span>
                                <span>Pendaftaran dibuka</span>
                            </div>

                            <div class="quota-block">
                                <div class="quota-heading">
                                    <span class="quota-title">Kapasitas pendaftaran</span>
                                    <span id="quota-count" class="quota-count" aria-live="polite"></span>
                                </div>
                                <div class="progress-track" aria-label="Progress kuota pendaftaran">
                                    <div
                                        id="quota-progress"
                                        class="progress-bar"
                                        data-quota="{{ $event->quota }}"
                                        data-registered="{{ $event->registered_count }}"
                                    ></div>
                                </div>
                                <p id="quota-helper" class="quota-helper" aria-live="polite"></p>
                            </div>

                            <button
                                id="register-button"
                                class="action-button register-button"
                                type="button"
                                data-event-id="{{ $event->id }}"
                                data-action="{{ route('event.register', $event->id) }}"
                            >
                                <span>Daftar sekarang</span>
                                <i data-lucide="ticket" width="18" height="18" aria-hidden="true"></i>
                            </button>
                        </section>
                    @else
                        {{-- ---- Ringkasan kegiatan — HANYA saat status completed ---- --}}
                        <section class="surface-card summary-card reveal" aria-label="Ringkasan kegiatan">
                            <div class="tag tag-muted-solid">
                                <i data-lucide="badge-check" width="14" height="14" aria-hidden="true"></i>
                                <span>Event telah selesai</span>
                            </div>

                            <div class="summary-stat">
                                <span class="summary-stat-icon" aria-hidden="true">
                                    <i data-lucide="users-round" width="18" height="18"></i>
                                </span>
                                <div>
                                    <span class="summary-stat-label">Total peserta hadir</span>
                                    <span class="summary-stat-value">{{ $event->participant_count ?? '-' }} orang</span>
                                </div>
                            </div>

                            <a href="{{ route('event.index') }}" class="action-button ghost-button">
                                <span>Lihat event lainnya</span>
                                <i data-lucide="arrow-right" width="18" height="18" aria-hidden="true"></i>
                            </a>
                        </section>
                    @endif
                </aside>
            </div>
        </main>

        <footer class="site-footer">
            <p>ALUMN SPACE CAREER HUB · Temukan ruang untuk tumbuh bersama.</p>
        </footer>
    </div>

    {{-- ================= MODAL PENDAFTARAN (hanya dipakai saat upcoming) ================= --}}
    @if ($event->status === 'upcoming')
        <div id="registration-modal" class="modal-layer" role="dialog" aria-modal="true" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-panel surface-card">
                <div class="modal-header">
                    <div>
                        <span class="icon-badge icon-badge-yellow" aria-hidden="true">
                            <i data-lucide="ticket" width="21" height="21"></i>
                        </span>
                        <h2 id="modal-title" class="modal-title">Daftar event</h2>
                    </div>
                    <button id="modal-close-button" class="icon-button" type="button" aria-label="Tutup formulir pendaftaran">
                        <i data-lucide="x" width="18" height="18" aria-hidden="true"></i>
                    </button>
                </div>

                <p id="modal-description" class="modal-description">
                    Isi data singkat kamu untuk mengamankan kursi di <strong>{{ $event->title }}</strong>.
                </p>

                <form id="registration-form" novalidate>
                    <div class="form-field">
                        <label for="participant-name">Nama lengkap</label>
                        <input id="participant-name" name="name" type="text" required autocomplete="name">
                    </div>
                    <div class="form-field">
                        <label for="participant-email">Email</label>
                        <input id="participant-email" name="email" type="email" required autocomplete="email">
                    </div>

                    <p id="registration-feedback" class="form-feedback" role="status"></p>

                    <button id="registration-submit" class="action-button" type="submit">
                        <span>Konfirmasi pendaftaran</span>
                    </button>
                </form>
            </div>
        </div>
    @endif

    <script src="{{ asset('js/event-detail.js') }}" defer></script>
</body>
</html>