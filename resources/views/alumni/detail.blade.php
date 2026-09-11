<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $profile->user->name }} — Alumni Space</title>

<script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/detail-alumni.css') }}?v={{ file_exists(public_path('css/detail-alumni.css')) ? filemtime(public_path('css/detail-alumni.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ file_exists(public_path('css/home.css')) ? filemtime(public_path('css/detail-alumni.css')) : time() }}">
</head>
<body class="alumni-page-body ad-body">

<x-navbar  />

<main>
  <section class="ad-section dot-grid">
    <div class="ad-container">

<a href="{{ route('alumni.index') }}"
   style="display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1.25rem; font-weight: 700; color: #0e2f6d; text-decoration: none; position: relative; z-index: 10;">
  <i data-lucide="arrow-left" width="16"></i> Kembali ke Alumni
</a>

      {{-- Hero card: cuma info utama (angkatan, nama, profesi, foto) --}}
      <article class="ad-hero-card">
        <span class="hero-shape shape-yellow" style="width:180px;height:180px;top:-70px;right:-50px;left:auto;"></span>
        <span class="hero-shape shape-pink" style="width:150px;height:150px;bottom:-60px;right:60px;left:auto;top:auto;"></span>

        <div class="ad-hero-top">
          <div class="ad-hero-info">
            @if($profile->graduation_year)
              <span class="ad-badge">Angkatan {{ $profile->graduation_year }}</span>
            @endif

            <h1 class="ad-title">
              {{ $profile->user->name }}
              @if($profile->is_verified)
                <i data-lucide="badge-check" class="ad-verified-icon" title="Alumni Terverifikasi"></i>
              @endif
            </h1>

            @if($profile->profession || $profile->company)
              <p class="ad-subtitle">
                {{ $profile->profession }}{{ $profile->profession && $profile->company ? ' · ' : '' }}{{ $profile->company }}
              </p>
            @endif

            <div class="ad-meta-list" style="flex-wrap: wrap; gap: 12px; margin-top: 16px;">
              @if($profile->city)
                <p class="ad-meta-row" style="width: 100%;"><i data-lucide="map-pin" width="16"></i> {{ $profile->city }}</p>
              @endif

              @if($profile->created_at)
                <p class="ad-meta-row" style="width: 100%; color: #64748b;"><i data-lucide="clock" width="16"></i> Bergabung {{ $profile->created_at->diffForHumans() }}</p>
              @endif
            </div>

            <p class="ad-bio-text" style="margin-top: 1rem;">
              {{ $profile->bio ?: 'Alumni ini belum menambahkan cerita singkat tentang dirinya.' }}
            </p>
          </div>

          <div class="ad-hero-avatar-wrap">
            <img
              class="ad-hero-avatar"
              src="{{ $profile->avatar ? asset('storage/'.$profile->avatar) : asset('assets/images/default-avatar.jpg') }}"
              alt="Foto profil {{ $profile->user->name }}"
              onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($profile->user->name) }}&background=eaf4ff&color=2e75dd&size=256'">
          </div>
        </div>
      </article>

      @php
        $socials = [
          'linkedin_url'  => ['icon' => 'linkedin', 'label' => 'LinkedIn'],
          'instagram_url' => ['icon' => 'instagram', 'label' => 'Instagram'],
          'tiktok_url'    => ['icon' => 'video', 'label' => 'TikTok'],
          'github_url'    => ['icon' => 'github', 'label' => 'GitHub'],
          'twitter_url'   => ['icon' => 'twitter', 'label' => 'Twitter'],
          'youtube_url'   => ['icon' => 'youtube', 'label' => 'YouTube'],
          'portfolio_url' => ['icon' => 'globe', 'label' => 'Portofolio'],
        ];
        $activeSocials = collect($socials)->filter(fn ($meta, $field) => !empty($profile->{$field}));
        $hasDetailBoxes = $profile->current_university || $profile->achievements || $profile->organization_role;
      @endphp

      {{-- Riwayat Pendidikan / Prestasi / Organisasi (kiri) + Sosmed (kanan) --}}
      @if($hasDetailBoxes || $activeSocials->isNotEmpty())
      <div class="ad-detail-grid">
        <div class="ad-detail-left" style="opacity:1!important; visibility:visible!important; display:flex!important; flex-direction:column; gap:1.25rem;">
          @if($profile->current_university)
          <div class="ad-detail-card">
            <h3 class="ad-detail-title" style="opacity:1!important; visibility:visible!important; display:flex!important; align-items:center; gap:0.5rem; color:#12356b; font-weight:800; font-size:1.05rem; margin:0 0 0.9rem;">
              <i data-lucide="graduation-cap" width="18"></i> Riwayat Pendidikan
            </h3>
            <ul class="ad-detail-list" style="margin:0; padding:0; list-style:none; display:flex; flex-direction:column; gap:0.6rem;">
              <li style="color:#4c7198; font-size:0.9rem; line-height:1.5; padding-left:1rem; position:relative;">
                <span style="position:absolute; left:0; top:0.55em; width:6px; height:6px; border-radius:999px; background:#2e75dd;"></span>
                {{ $profile->current_university }} <span style="color:#6280a4; font-weight:600;">— {{ $profile->study_status ?? 'Status tidak diketahui' }}</span>
              </li>
            </ul>
          </div>
          @endif

          @if($profile->achievements)
          <div class="ad-detail-card" style="opacity:1!important; visibility:visible!important; display:block!important; background:#ffffff; border:1px solid #dbe8f7; border-radius:22px; padding:1.5rem; box-shadow:0 8px 20px rgba(47,102,164,0.06);">
            <h3 class="ad-detail-title" style="opacity:1!important; visibility:visible!important; display:flex!important; align-items:center; gap:0.5rem; color:#12356b; font-weight:800; font-size:1.05rem; margin:0 0 0.9rem;">
              <i data-lucide="award" width="18"></i> Prestasi
            </h3>
            <ul class="ad-detail-list" style="margin:0; padding:0; list-style:none; display:flex; flex-direction:column; gap:0.6rem;">
              @foreach(preg_split('/\r\n|\r|\n/', trim($profile->achievements)) as $line)
                @continue(trim($line) === '')
                <li style="color:#4c7198; font-size:0.9rem; line-height:1.5; padding-left:1rem; position:relative;">
                  <span style="position:absolute; left:0; top:0.55em; width:6px; height:6px; border-radius:999px; background:#2e75dd;"></span>
                  {{ trim($line) }}
                </li>
              @endforeach
            </ul>
          </div>
          @endif

          @if($profile->organization_role)
          <div class="ad-detail-card" style="opacity:1!important; visibility:visible!important; display:block!important; background:#ffffff; border:1px solid #dbe8f7; border-radius:22px; padding:1.5rem; box-shadow:0 8px 20px rgba(47,102,164,0.06);">
            <h3 class="ad-detail-title" style="opacity:1!important; visibility:visible!important; display:flex!important; align-items:center; gap:0.5rem; color:#12356b; font-weight:800; font-size:1.05rem; margin:0 0 0.9rem;">
              <i data-lucide="users" width="18"></i> Riwayat Organisasi
            </h3>
            <ul class="ad-detail-list" style="margin:0; padding:0; list-style:none; display:flex; flex-direction:column; gap:0.6rem;">
              @foreach(preg_split('/\r\n|\r|\n/', trim($profile->organization_role)) as $line)
                @continue(trim($line) === '')
                <li style="color:#4c7198; font-size:0.9rem; line-height:1.5; padding-left:1rem; position:relative;">
                  <span style="position:absolute; left:0; top:0.55em; width:6px; height:6px; border-radius:999px; background:#2e75dd;"></span>
                  {{ trim($line) }}
                </li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>

        <div class="ad-detail-right" style="opacity:1!important; visibility:visible!important; display:flex!important; flex-direction:column!important;">
          <div class="ad-detail-card" style="opacity:1!important; visibility:visible!important; display:flex!important; flex-direction:column; width:100%; background:#ffffff; border:1px solid #dbe8f7; border-radius:22px; padding:1.5rem; box-shadow:0 8px 20px rgba(47,102,164,0.06);">
            <h3 class="ad-detail-title" style="opacity:1!important; visibility:visible!important; display:flex!important; align-items:center; gap:0.5rem; color:#12356b; font-weight:800; font-size:1.05rem; margin:0 0 0.9rem;">
              <i data-lucide="share-2" width="18"></i> Sosmed
            </h3>

            @if($activeSocials->isNotEmpty())
              <div class="ad-social-links" style="display:flex; flex-wrap:wrap; gap:0.55rem;">
                @foreach($activeSocials as $field => $meta)
                  @if($field === 'tiktok_url' || $field === 'instagram_url')
                    @php
                      $parts = explode('/', rtrim($profile->{$field}, '/'));
                      $username = end($parts);
                      if (!str_starts_with($username, '@')) $username = '@' . $username;

                      $bgColor = '#f1f5f9';
                      $textColor = '#334155';
                      if ($field === 'instagram_url') {
                        $bgColor = '#ec4899';
                        $textColor = '#ffffff';
                      } elseif ($field === 'tiktok_url') {
                        $bgColor = '#111827';
                        $textColor = '#ffffff';
                      }
                    @endphp
                    <a href="{{ $profile->{$field} }}" target="_blank" rel="noopener" title="{{ $meta['label'] }}" style="background: {{ $bgColor }}; padding: 6px 12px; border-radius: 8px; color: {{ $textColor }}; display: inline-flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 14px; white-space: nowrap; text-decoration: none;">
                      @if($field === 'tiktok_url')
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/>
                        </svg>
                      @else
                        <i data-lucide="{{ $meta['icon'] }}" width="18"></i>
                      @endif
                      {{ $username }}
                    </a>
                  @else
                    <a href="{{ $profile->{$field} }}" target="_blank" rel="noopener" title="{{ $meta['label'] }}" style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:12px; background:#eaf4ff; color:#2e75dd; text-decoration:none;">
                      <i data-lucide="{{ $meta['icon'] }}" width="18"></i>
                    </a>
                  @endif
                @endforeach
              </div>
            @else
              <p style="color:#8aa5c2; font-size:0.875rem; margin:0;">Belum menambahkan tautan sosial media.</p>
            @endif
          </div>

          <div class="ad-detail-card" style="opacity:1!important; visibility:visible!important; display:block!important; background:#ffffff; border:1px solid #dbe8f7; border-radius:22px; padding:1.5rem; box-shadow:0 8px 20px rgba(47,102,164,0.06); margin-top:1.25rem;">
            <h3 class="ad-detail-title" style="opacity:1!important; visibility:visible!important; display:flex!important; align-items:center; gap:0.5rem; color:#12356b; font-weight:800; font-size:1.05rem; margin:0 0 0.9rem;">
              <i data-lucide="contact" width="18"></i> Info Kontak
            </h3>

            @if($profile->phone_number)
              <p class="ad-contact-row"><i data-lucide="phone" width="16"></i> {{ $profile->phone_number }}</p>
            @endif
          </div>
        </div>
      </div>
      @endif

      </div>
    </div>
  </section>
</main>

<div class="footer-spacer"></div>
<x-footer />

<div id="toast" class="toast" role="status" aria-live="polite">
  <i data-lucide="sparkles" width="19"></i>
  <span id="toast-text"></span>
</div>

<!-- Floating action buttons -->
<div id="fab-row" class="fab-row">
    <button id="back-to-top" type="button" class="focus-ring" aria-label="Kembali ke atas">
        <i data-lucide="arrow-up" width="20" height="20"></i>
    </button>

    <div id="wa-widget">
        <div id="wa-bubble" class="wa-bubble">
            <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:.5rem;">
                <p class="wa-bubble-title">Ada pertanyaan?</p>
                <button id="wa-bubble-close" type="button" class="wa-bubble-close" aria-label="Tutup"><i
                        data-lucide="x" width="16" height="16"></i></button>
            </div>
            <p class="wa-bubble-text">Hubungi pengurus kami via WhatsApp 👋</p>
            <p class="wa-bubble-number">+62 812-3456-7890</p>
        </div>
        <a id="wa-button" href="https://wa.me/6281234567890?text=Halo" target="_blank"
            rel="noopener" class="wa-pulse focus-ring" aria-label="Hubungi kami via WhatsApp">
            <i data-lucide="message-circle" width="26" height="26"></i>
        </a>
    </div>
</div>
<script src="{{ asset('js/script.js') }}"></script>
<script>
  lucide.createIcons();

  const toast = document.getElementById('toast');
  let toastTimer;
  function showToast(message) {
    document.getElementById('toast-text').textContent = message;
    toast.classList.add('is-visible');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('is-visible'), 3400);
  }

  document.getElementById('share-profile-button')?.addEventListener('click', async () => {
    const url = window.location.href;
    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(url);
        showToast('Tautan profil berhasil disalin.');
      } else {
        showToast('Bagikan tautan profil ini kepada teman alumnimu.');
      }
    } catch {
      showToast('Bagikan tautan profil ini kepada teman alumnimu.');
    }
  });
</script>

</body>
</html>
