<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $profile->user->name }} — Alumni Space</title>

<script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/alumni.css') }}?v={{ file_exists(public_path('css/alumni.css')) ? filemtime(public_path('css/alumni.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/detail-alumni.css') }}?v={{ file_exists(public_path('css/detail-alumni.css')) ? filemtime(public_path('css/detail-alumni.css')) : time() }}">
</head>
<body class="alumni-page-body ad-body">

<x-navbar />

<main>
  <section class="ad-section dot-grid">
    <div class="ad-container">

      {{-- Breadcrumb --}}
      <nav class="ad-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('alumni.index') }}">Beranda</a>
        <span>/</span>
        <a href="{{ route('alumni.index') }}">Direktori Alumni</a>
        <span>/</span>
        <span class="ad-breadcrumb-current">{{ $profile->user->name }}</span>
      </nav>

      {{-- Hero card --}}
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

            <div class="ad-meta-list">
              @if($profile->city)
                <p class="ad-meta-row"><i data-lucide="map-pin" width="16"></i> {{ $profile->city }}</p>
              @endif
              @if($profile->major)
                <p class="ad-meta-row"><i data-lucide="graduation-cap" width="16"></i> {{ $profile->major }}</p>
              @endif
              @if($profile->created_at)
                <p class="ad-meta-row"><i data-lucide="clock" width="16"></i> Bergabung {{ $profile->created_at->diffForHumans() }}</p>
              @endif
            </div>

            <div class="ad-actions">
              @if($profile->phone_number)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone_number) }}" target="_blank" rel="noopener" class="ad-btn ad-btn-outline">
                  <i data-lucide="message-circle" width="18"></i> Hubungi
                </a>
              @endif
              <button id="share-profile-button" type="button" class="ad-btn ad-btn-solid">
                <i data-lucide="share-2" width="18"></i> Bagikan Profil
              </button>
            </div>
          </div>

          <div class="ad-hero-avatar-wrap">
            <img
              class="ad-hero-avatar"
              src="{{ $profile->avatar ? asset('storage/'.$profile->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($profile->user->name).'&background=eaf4ff&color=2e75dd&size=256' }}"
              alt="Foto profil {{ $profile->user->name }}">
          </div>
        </div>
      </article>

      {{-- Info cards --}}
      <div class="ad-info-grid">
        @if($profile->profession)
        <div class="ad-info-card">
          <span class="ad-info-icon"><i data-lucide="briefcase" width="20"></i></span>
          <p class="ad-info-label">PROFESI</p>
          <p class="ad-info-value">{{ $profile->profession }}</p>
        </div>
        @endif

        @if($profile->company)
        <div class="ad-info-card">
          <span class="ad-info-icon"><i data-lucide="building-2" width="20"></i></span>
          <p class="ad-info-label">PERUSAHAAN</p>
          <p class="ad-info-value">{{ $profile->company }}</p>
        </div>
        @endif

        @if($profile->city)
        <div class="ad-info-card">
          <span class="ad-info-icon"><i data-lucide="map" width="20"></i></span>
          <p class="ad-info-label">KOTA DOMISILI</p>
          <p class="ad-info-value">{{ $profile->city }}</p>
        </div>
        @endif
      </div>

      {{-- Bio + kontak --}}
      <div class="ad-content-grid">
        <div class="ad-content-main">
          <h2 class="ad-section-title">Tentang {{ Str::before($profile->user->name, ' ') }}</h2>
          <p class="ad-bio-text">
            {{ $profile->bio ?: 'Alumni ini belum menambahkan cerita singkat tentang dirinya.' }}
          </p>
        </div>

        <aside class="ad-content-side">
          <div class="ad-side-card">
            <h3 class="ad-side-title">Info Kontak</h3>

            @if($profile->student_number)
              <p class="ad-contact-row"><i data-lucide="hash" width="16"></i> NIM {{ $profile->student_number }}</p>
            @endif
            @if($profile->phone_number)
              <p class="ad-contact-row"><i data-lucide="phone" width="16"></i> {{ $profile->phone_number }}</p>
            @endif

            @php
              $socials = [
                'linkedin_url'  => ['icon' => 'linkedin', 'label' => 'LinkedIn'],
                'instagram_url' => ['icon' => 'instagram', 'label' => 'Instagram'],
                'github_url'    => ['icon' => 'github', 'label' => 'GitHub'],
                'twitter_url'   => ['icon' => 'twitter', 'label' => 'Twitter'],
                'youtube_url'   => ['icon' => 'youtube', 'label' => 'YouTube'],
                'portfolio_url' => ['icon' => 'globe', 'label' => 'Portofolio'],
              ];
              $activeSocials = collect($socials)->filter(fn ($meta, $field) => !empty($profile->{$field}));
            @endphp

            @if($activeSocials->isNotEmpty())
              <div class="ad-social-links">
                @foreach($activeSocials as $field => $meta)
                  <a href="{{ $profile->{$field} }}" target="_blank" rel="noopener" class="ad-social-icon" title="{{ $meta['label'] }}">
                    <i data-lucide="{{ $meta['icon'] }}" width="18"></i>
                  </a>
                @endforeach
              </div>
            @endif
          </div>
        </aside>
      </div>

      <a href="{{ route('alumni.index') }}" class="ad-back-link">
        <i data-lucide="arrow-left" width="16"></i> Kembali ke direktori
      </a>

    </div>
  </section>
</main>

<div class="footer-spacer"></div>
<x-footer />

<div id="toast" class="toast" role="status" aria-live="polite">
  <i data-lucide="sparkles" width="19"></i>
  <span id="toast-text"></span>
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
