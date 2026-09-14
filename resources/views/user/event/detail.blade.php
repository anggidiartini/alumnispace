@php
    // Catatan: sesuaikan nilai string status ini dengan enum/kolom status
    // yang benar-benar dipakai di tabel events (mis. upcoming / ongoing / completed).
    $statusValue   = strtolower((string) $event->status);
    $isCompleted   = in_array($statusValue, ['completed', 'ended', 'selesai']);
    $isUpcoming    = in_array($statusValue, ['upcoming', 'open', 'akan datang']);
    $isOngoing     = in_array($statusValue, ['ongoing', 'berlangsung']);

    $quota         = (int) ($event->quota ?? 0);
    $registered    = (int) ($event->registered_count ?? 0);
    $remaining     = max($quota - $registered, 0);
    $percentFilled = $quota > 0 ? min(100, round(($registered / $quota) * 100)) : 0;
    $isFull        = $quota > 0 && $registered >= $quota;
    $canRegister   = $isUpcoming && ! $isFull;

    $tags = $event->badge_tag
        ? array_filter(array_map('trim', explode(',', $event->badge_tag)))
        : [];

    $bannerUrl = $event->banner_image
        ? (\Illuminate\Support\Str::startsWith($event->banner_image, ['http://', 'https://'])
            ? $event->banner_image
            : asset('storage/' . $event->banner_image))
        : asset('images/event-placeholder.jpg');

    // Galeri dokumentasi: pakai relasi $event->galleries kalau relasinya
    // sudah didefinisikan di Model Event. Kalau belum ada (relasi/tabel
    // belum dibuat), fallback ke collection kosong supaya tidak fatal error.
    $galleryImages = method_exists($event, 'galleries')
        ? collect($event->galleries)->map(function ($item) {
            return is_string($item) ? $item : ($item->image_path ?? $item->url ?? null);
        })->filter()->values()
        : collect();

    // Fallback lamar/tanya via WhatsApp untuk widget bantuan mengambang.
    $waHelpNumber = '6281234567890';
    $waHelpUrl = 'https://wa.me/' . $waHelpNumber
        . '?text=' . urlencode('Halo Alumni Space, saya mau tanya soal event ' . $event->title);
@endphp
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $event->title }} — Alumni Space</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/detail-event.css') }}?v={{ file_exists(public_path('css/detail-event.css')) ? filemtime(public_path('css/detail-event.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/event-register.css') }}?v={{ file_exists(public_path('css/event-register.css')) ? filemtime(public_path('css/event-register.css')) : time() }}">
</head>
<body>
<div class="site-shell page-wrap">
    <x-navbar />

    <main>
        <div class="page-width">

            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Beranda</a><span>/</span>
                <a href="{{ route('event.index') }}">Event</a><span>/</span>
                <span>{{ $event->title }}</span>
            </nav>

            <section class="event-panel is-active" aria-label="Detail event {{ $event->title }}">

                {{-- ================= HERO ================= --}}
                <section class="hero-card" data-reveal>
                    <span class="blob-extra" aria-hidden="true"></span>
                    <div class="hero-copy">
                        @if($event->category)
                            <span class="category-badge">{{ $event->category }}</span>
                        @endif

                        <h1 class="event-title">{{ $event->title }}</h1>

                        @if(count($tags))
                            <div class="tag-list">
                                @foreach($tags as $tag)
                                    <span class="tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif

                        <p class="event-summary">{{ \Illuminate\Support\Str::limit($event->description ?? '', 180) }}</p>

                        <div class="hero-actions">
                            @if($isCompleted)
                                <span class="status-chip status-ended"><span class="status-dot"></span>Event Selesai</span>
                                <a href="#dokumentasi-kegiatan" class="primary-button">Lihat Dokumentasi</a>
                            @elseif($canRegister)
                                <span class="status-chip status-open"><span class="status-dot"></span>Pendaftaran Dibuka</span>
                                <button type="button" id="registerBtn" class="primary-button" data-event-id="{{ $event->id }}">
                                    Daftar Sekarang
                                </button>
                            @elseif($isUpcoming && $isFull)
                                <span class="status-chip status-soon"><span class="status-dot"></span>Kuota Penuh</span>
                                <span class="disabled-button" aria-disabled="true">Kuota Penuh</span>
                            @else
                                <span class="status-chip status-soon"><span class="status-dot"></span>Sedang Berlangsung</span>
                                <span class="disabled-button" aria-disabled="true">Pendaftaran Ditutup</span>
                            @endif
                        </div>
                    </div>

                    <div class="hero-media">
                        <img src="{{ $bannerUrl }}" alt="{{ $event->title }}" loading="lazy">

                        @if($isCompleted)
                            <span class="hero-sticker floaty">Ada cerita baru!</span>
                        @else
                            <span class="media-status">Terbuka untuk seluruh alumni</span>
                        @endif
                    </div>
                </section>

                {{-- ================= INFO RINGKAS ================= --}}
                <section class="info-grid" aria-label="Informasi ringkas event">
                    <article class="info-card" data-reveal="scale">
                        <span class="info-icon" aria-hidden="true"><i data-lucide="calendar" width="18" height="18"></i></span>
                        <span class="info-label">Tanggal Event</span>
                        <span class="info-value">
                            {{ $event->event_date ? $event->event_date->translatedFormat('l, d F Y') : '-' }}
                        </span>
                    </article>
                    <article class="info-card" data-reveal="scale">
                        <span class="info-icon" aria-hidden="true"><i data-lucide="clock" width="18" height="18"></i></span>
                        <span class="info-label">Waktu</span>
                        {{-- Ganti time_info ke time_display kalau itu nama kolom yang benar di tabel events --}}
                        <span class="info-value">{{ $event->time_display ?? $event->time_info ?? '-' }}</span>
                    </article>
                    <article class="info-card" data-reveal="scale">
                        <span class="info-icon" aria-hidden="true"><i data-lucide="{{ $event->location_type === 'online' ? 'wifi' : 'map-pin' }}" width="18" height="18"></i></span>
                        <span class="info-label">Lokasi</span>
                        <span class="info-value">{{ $event->venue ?: '-' }}</span>
                    </article>
                    <article class="info-card" data-reveal="scale">
                        <span class="info-icon" aria-hidden="true"><i data-lucide="users" width="18" height="18"></i></span>
                        <span class="info-label">Kuota</span>
                        <span class="info-value" data-role="info-quota">
                            <span data-role="animated-number">0</span> dari {{ $quota }} peserta
                        </span>
                    </article>
                </section>

                <div class="main-layout">

                    {{-- ================= KONTEN ================= --}}
                    <div class="article-stack">

                        {{-- "Tentang Event" — disamakan persis sama section
                             "Deskripsi Pekerjaan" di detail-lowongan.blade.php:
                             kartu .detail-card + .accordion-button. --}}
                        <section class="detail-card" data-reveal>
                            <button type="button" class="accordion-button" aria-expanded="true">
                                <span>Tentang Event</span>
                                <i data-lucide="chevron-down" width="22" height="22"></i>
                            </button>
                            <div class="accordion-panel">
                                <p class="section-text">{{ $event->description ?? '-' }}</p>
                            </div>
                        </section>

                        <article class="content-card" data-reveal>
                            <h2 class="card-heading">Detail Lokasi</h2>
                            <div class="location-type">
                                <span class="location-symbol" aria-hidden="true">
                                    <i data-lucide="{{ $event->location_type === 'online' ? 'wifi' : 'map-pin' }}" width="18" height="18"></i>
                                </span>
                                <span>{{ $event->location_type === 'online' ? 'Online Event' : 'Offline Event' }}</span>
                            </div>
                            <p class="location-venue">{{ $event->venue ?: 'Online Event' }}</p>
                            <p class="card-copy">
                                {{ $event->location_type === 'online'
                                    ? 'Link akses akan tersedia setelah pendaftaran berhasil dikonfirmasi.'
                                    : ($event->venue ?? '-') }}
                            </p>
                        </article>
                    </div>

                    {{-- ================= SIDEBAR: PENDAFTARAN atau DOKUMENTASI ================= --}}
                    @if($isCompleted)
                        <aside class="registration-card documentation-card" id="dokumentasi-kegiatan" aria-label="Dokumentasi kegiatan" data-reveal>
                            <h2 class="card-heading">Dokumentasi Kegiatan</h2>
                            <p class="small-copy">Kilas balik momen dari acara ini.</p>

                            <div class="documentation-cover">
                                <img src="{{ $bannerUrl }}" alt="Dokumentasi {{ $event->title }}">
                            </div>

                            @if($galleryImages->count())
                                <div class="gallery-grid">
                                    @foreach($galleryImages as $image)
                                        <div class="gallery-item">
                                            <img src="{{ $image }}" alt="Dokumentasi {{ $event->title }}" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="gallery-empty">Galeri foto tambahan belum tersedia untuk event ini.</div>
                            @endif
                        </aside>
                    @else
                        <aside class="registration-card" aria-label="Pendaftaran event" data-reveal>
                            <h2 class="card-heading">
                                {{ $canRegister ? 'Amankan Kursimu' : ($isFull ? 'Kuota Penuh' : 'Pendaftaran Belum Dibuka') }}
                            </h2>
                            <p class="small-copy">
                                {{ $canRegister
                                    ? 'Bergabunglah bersama alumni lintas bidang dalam acara ini.'
                                    : 'Simpan halaman ini dan pantau terus perkembangan pendaftaran.' }}
                            </p>

                            <div class="quota-row">
                                <span>Keterisian kuota</span>
                                <span data-role="quota-count"><span data-role="animated-number">0</span> / {{ $quota }}</span>
                            </div>
                            <div class="progress-track" aria-label="{{ $percentFilled }} persen kuota telah terisi">
                                <div class="progress-fill" data-target-width="{{ $percentFilled }}%"></div>
                            </div>
                            <div class="remaining-box">
                                <strong data-role="remaining-count">
                                    {{ $remaining > 0 ? $remaining . ' kursi tersisa' : 'Kuota telah terpenuhi' }}
                                </strong>
                                <span class="small-copy">Pendaftaran ditutup saat kuota terpenuhi.</span>
                            </div>

                            @if($canRegister)
                                <span class="status-chip status-open"><span class="status-dot"></span>Pendaftaran Dibuka</span>
                                <button type="button" id="registerBtnSidebar" class="primary-button sidebar-cta"
                                        data-event-id="{{ $event->id }}"
                                        onclick="document.getElementById('registerBtn')?.click()">
                                    Daftar Sekarang
                                </button>
                            @elseif($isFull)
                                <span class="status-chip status-soon"><span class="status-dot"></span>Kuota Penuh</span>
                                <span class="disabled-button sidebar-cta" aria-disabled="true">Kuota Penuh</span>
                            @else
                                <span class="status-chip status-soon"><span class="status-dot"></span>Sedang Berlangsung</span>
                                <span class="disabled-button sidebar-cta" aria-disabled="true">Pendaftaran Ditutup</span>
                            @endif
                        </aside>
                    @endif
                </div>
            </section>
        </div>
    </main>

    <x-footer/>

    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    {{-- Lightbox untuk galeri dokumentasi --}}
    <div class="lightbox-overlay" id="lightbox">
        <button type="button" class="lightbox-close" id="lightboxClose" aria-label="Tutup">&times;</button>
        <img id="lightboxImage" src="" alt="">
    </div>

    {{-- ================= MODAL: FORM PENDAFTARAN EVENT =================
         Dipicu oleh #registerBtn di atas. Submit ke route('event.register', ...)
         lewat window.EventDetailConfig.registerUrl (lihat script di bawah).
         Setelah sukses, backend yang mengirim email berisi link WA konfirmasi
         ke panitia — di sini cuma menampilkan pesan konfirmasinya. ================= --}}
    <div class="er-overlay" id="erOverlay" aria-hidden="true">
        <div class="er-modal" role="dialog" aria-modal="true" aria-labelledby="erTitle">
            <button type="button" class="er-close" id="erClose" aria-label="Tutup">&times;</button>

            <div class="er-step" id="erStepForm">
                <h2 id="erTitle" class="er-title">Daftar {{ $event->title }}</h2>
                <p class="er-sub">Isi data di bawah ini untuk mengamankan kursimu. Link konfirmasi ke panitia akan dikirim lewat email.</p>

                <form id="erForm" class="er-form" novalidate>
                    <div class="er-field">
                        <label for="erName">Nama Lengkap</label>
                        <input type="text" id="erName" name="name" required autocomplete="name">
                        <span class="er-error" data-error-for="name"></span>
                    </div>
                    <div class="er-field">
                        <label for="erEmail">Email</label>
                        <input type="email" id="erEmail" name="email" required autocomplete="email">
                        <span class="er-error" data-error-for="email"></span>
                    </div>
                    <div class="er-field">
                        <label for="erPhone">No. WhatsApp</label>
                        <input type="tel" id="erPhone" name="phone" required placeholder="08xxxxxxxxxx" autocomplete="tel">
                        <span class="er-error" data-error-for="phone"></span>
                    </div>

                    <p class="er-form-error" id="erFormError" hidden></p>

                    <button type="submit" class="primary-button er-submit" id="erSubmitBtn">
                        <span class="er-submit-label">Daftar Sekarang</span>
                        <span class="er-spinner" aria-hidden="true"></span>
                    </button>
                </form>
            </div>

            <div class="er-step" id="erStepSuccess" hidden>
                <div class="er-success-icon" aria-hidden="true"><i data-lucide="mail-check" width="34" height="34"></i></div>
                <h2 class="er-title">Pendaftaran Berhasil!</h2>
                <p class="er-sub" id="erSuccessMessage">
                    Kami sudah mengirim email konfirmasi berisi link WhatsApp untuk konfirmasi ke panitia. Silakan cek inbox (atau folder spam) kamu.
                </p>
                <button type="button" class="primary-button er-submit" id="erDoneBtn">Oke, Mengerti</button>
            </div>
        </div>
    </div>

    {{-- ================= FLOATING: WhatsApp (atas) + on-top (bawah) ================= --}}
    <div id="fab-row" class="fab-row">
        <button id="back-to-top" type="button" aria-label="Kembali ke atas">
            <i data-lucide="arrow-up" width="20" height="20"></i>
        </button>

        <div id="wa-widget">
            <div id="wa-bubble" class="wa-bubble">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;">
                    <p class="wa-bubble-title">Ada pertanyaan?</p>
                    <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup"><i data-lucide="x" width="16" height="16"></i></button>
                </div>
                <p class="wa-bubble-text">Hubungi pengurus alumni kami via WhatsApp 👋</p>
                <p class="wa-bubble-number">+62 812-3456-7890</p>
            </div>
            <a id="wa-button" href="{{ $waHelpUrl }}" target="_blank" rel="noopener" class="wa-pulse" aria-label="Hubungi kami via WhatsApp">
                <i data-lucide="message-circle" width="26" height="26"></i>
            </a>
        </div>
    </div>
</div>

<script>
    window.EventDetailConfig = {
        registerUrl: @json(route('event.register', $event->id)),
        loginUrl: @json(\Illuminate\Support\Facades\Route::has('login') ? route('login') : null),
        csrfToken: @json(csrf_token()),
        quota: {{ $quota }},
        registered: {{ $registered }}
    };
</script>
<script src="{{ asset('js/detail-event.js') }}"></script>
<script src="{{ asset('js/detail-event-floating.js') }}"></script>
<script src="{{ asset('js/event-register.js') }}"></script>
</body>
</html>