<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alumni Space — Profil Saya</title>

<script src="https://cdn.jsdelivr.net/npm/lucide@0.577.0/dist/umd/lucide.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ file_exists(public_path('css/navbar.css')) ? filemtime(public_path('css/navbar.css')) : time() }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}?v={{ file_exists(public_path('css/profile.css')) ? filemtime(public_path('css/profile.css')) : time() }}">
</head>
<body class="profile-page-body" data-isGuest="{{ auth()->guest() ? 'true' : 'false' }}" style="background: #f7fbff;">

<x-navbar />

<main>
  <section class="profile-hero">
    <div class="profile-container">

      <h1 class="profile-title">Profil Saya</h1>
      <p class="profile-subtitle">Kelola informasi alumni milikmu di sini.</p>

      {{-- Pesan sukses setelah simpan --}}
      @if (session('success'))
        <div class="profile-alert profile-alert-success">
          {{ session('success') }}
        </div>
      @endif

      {{-- Pesan error validasi --}}
      @if ($errors->any())
        <div class="profile-alert profile-alert-error">
          <p>Ada beberapa data yang perlu diperbaiki:</p>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form" id="profile-form">
        @csrf
        @method('PUT')

        {{-- FOTO PROFIL --}}
        <div class="profile-section profile-section-full">
            <h2 class="profile-section-title">Foto Profil</h2>

          <div class="profile-field profile-field-avatar">
            <div class="avatar-preview-wrap">

              <button type="button" class="avatar-click-area" id="avatar-click-area" aria-label="Ubah foto profil">
                @if ($profile->avatar)
                  <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="avatar-preview" id="avatar-preview">
                @else
                  <span class="avatar-preview avatar-placeholder" id="avatar-preview">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                  </span>
                @endif

                <span class="avatar-edit-badge" aria-hidden="true">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                  </svg>
                </span>
              </button>

              <span class="avatar-hint">Klik foto untuk mengganti atau menghapus.</span>

              {{-- Input file asli, disembunyikan secara visual, dipicu dari dalam modal --}}
              <input type="file" name="avatar" id="avatar-input" accept="image/*" class="avatar-file-input">
              {{-- Penanda untuk backend: 1 = hapus foto saat disimpan --}}
              <input type="hidden" name="remove_avatar" id="remove_avatar" value="0">
            </div>
          </div>
        </div>

        {{-- INFO DASAR --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Info Dasar</h2>
          <div class="profile-grid">
            <div class="profile-field">
              <label>Nama</label>
              <input type="text" value="{{ $user->name }}" disabled>
            </div>
            <div class="profile-field">
              <label>Email</label>
              <input type="text" value="{{ $user->email }}" disabled>
            </div>
          </div>
        </div>

        {{-- INFO KONTAK --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Info Kontak</h2>
          <div class="profile-grid">
            <div class="profile-field">
              <label for="phone_number">No. Telepon</label>
              <input type="text" name="phone_number" id="phone_number"
                     value="{{ old('phone_number', $profile->phone_number) }}">
            </div>
          </div>
        </div>

        {{-- TEMPAT TINGGAL --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Tempat Tinggal</h2>
          <div class="profile-grid">
            <div class="profile-field">
              <label for="city">Kota / Alamat</label>
              <input type="text" name="city" id="city"
                     value="{{ old('city', $profile->city) }}">
            </div>
          </div>
        </div>

        {{-- PEKERJAAN --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Pekerjaan</h2>
          <div class="profile-grid">
            <div class="profile-field">
              <label for="company">Tempat Kerja</label>
              <input type="text" name="company" id="company"
                     value="{{ old('company', $profile->company) }}">
            </div>
            <div class="profile-field">
              <label for="profession">Jabatan</label>
              <input type="text" name="profession" id="profession"
                     value="{{ old('profession', $profile->profession) }}">
            </div>
          </div>
        </div>

        {{-- RIWAYAT PENDIDIKAN --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Riwayat Pendidikan</h2>
          <div class="profile-grid">
            <div class="profile-field">
              <label for="student_number">NIS</label>
              <input type="text" id="student_number"
                     value="{{ $profile->student_number }}" disabled>
            </div>
            <div class="profile-field">
              <label for="graduation_year">Angkatan</label>
              <input type="text" id="graduation_year"
                     value="{{ $profile->graduation_year }}" disabled>
            </div>
            <div class="profile-field">
              <label for="major">Jurusan</label>
              <input type="text" id="major"
                     value="{{ $profile->major }}" disabled>
            </div>
            <div class="profile-field">
              <label for="current_university">Universitas Lanjutan</label>
              <input type="text" name="current_university" id="current_university"
                     value="{{ old('current_university', $profile->current_university) }}">
            </div>
            <div class="profile-field">
              <label for="study_status">Status Studi</label>
              <input type="text" name="study_status" id="study_status"
                     placeholder="Contoh: Sedang kuliah, Sudah lulus"
                     value="{{ old('study_status', $profile->study_status) }}">
            </div>
          </div>
        </div>

        {{-- PRESTASI --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Prestasi</h2>
          <div class="profile-grid">
            <div class="profile-field profile-field-full">
              <label for="achievements">Daftar Prestasi</label>
              <textarea name="achievements" id="achievements" rows="3"
                        placeholder="Ceritakan pencapaianmu, satu per baris">{{ old('achievements', $profile->achievements) }}</textarea>
            </div>
          </div>
        </div>

        {{-- RIWAYAT ORGANISASI --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Riwayat Organisasi</h2>
          <div class="profile-grid">
            <div class="profile-field profile-field-full">
              <label for="organization_role">Pengalaman Organisasi</label>
              <textarea name="organization_role" id="organization_role" rows="3"
                        placeholder="Contoh: Ketua OSIS 2019/2020">{{ old('organization_role', $profile->organization_role) }}</textarea>
            </div>
          </div>
        </div>

        {{-- BIO --}}
        <div class="profile-section profile-section-full">
            <h2 class="profile-section-title">Tentang Saya</h2>
          <div class="profile-grid">
            <div class="profile-field profile-field-full">
              <label for="bio">Bio</label>
              <textarea name="bio" id="bio" rows="4">{{ old('bio', $profile->bio) }}</textarea>
            </div>
          </div>
        </div>

        {{-- SOSIAL MEDIA --}}
       <div class="profile-section profile-section-full">
          <h2 class="profile-section-title">Sosial Media</h2>
          <div class="profile-grid">
            <div class="profile-field">
              <label for="linkedin_url">LinkedIn</label>
              <input type="url" name="linkedin_url" id="linkedin_url" placeholder="https://linkedin.com/in/..."
                     value="{{ old('linkedin_url', $profile->linkedin_url) }}">
            </div>
            <div class="profile-field">
              <label for="instagram_url">Instagram</label>
              <input type="url" name="instagram_url" id="instagram_url" placeholder="https://instagram.com/..."
                     value="{{ old('instagram_url', $profile->instagram_url) }}">
            </div>
            <div class="profile-field">
              <label for="github_url">GitHub</label>
              <input type="url" name="github_url" id="github_url" placeholder="https://github.com/..."
                     value="{{ old('github_url', $profile->github_url) }}">
            </div>
            <div class="profile-field">
              <label for="twitter_url">Twitter / X</label>
              <input type="url" name="twitter_url" id="twitter_url" placeholder="https://x.com/..."
                     value="{{ old('twitter_url', $profile->twitter_url) }}">
            </div>
            <div class="profile-field">
              <label for="youtube_url">YouTube</label>
              <input type="url" name="youtube_url" id="youtube_url" placeholder="https://youtube.com/..."
                     value="{{ old('youtube_url', $profile->youtube_url) }}">
            </div>
            <div class="profile-field">
              <label for="tiktok_url">TikTok</label>
              <input type="url" name="tiktok_url" id="tiktok_url" placeholder="https://tiktok.com/@..."
                     value="{{ old('tiktok_url', $profile->tiktok_url) }}">
            </div>
            <div class="profile-field profile-field-full">
              <label for="portfolio_url">Portfolio / Website</label>
              <input type="url" name="portfolio_url" id="portfolio_url" placeholder="https://..."
                     value="{{ old('portfolio_url', $profile->portfolio_url) }}">
            </div>
          </div>
        </div>

        <div class="profile-actions">
          <button type="submit" class="profile-save-btn">Simpan Perubahan</button>
        </div>

      </form>

    </div>
  </section>
</main>

{{-- MODAL: Ganti / Hapus Foto Profil --}}
<div class="avatar-modal-overlay" id="avatar-modal-overlay">
  <div class="avatar-modal" role="dialog" aria-modal="true" aria-labelledby="avatar-modal-title">
    <button type="button" class="avatar-modal-close" id="avatar-modal-close" aria-label="Tutup">&times;</button>
    <h3 id="avatar-modal-title">Ubah Foto Profil</h3>
    <p class="avatar-modal-sub">Pilih foto baru atau hapus foto yang sedang dipakai. Perubahan baru tersimpan permanen setelah kamu klik "Simpan Perubahan".</p>
    <div class="avatar-modal-actions">
      <button type="button" class="avatar-modal-btn avatar-modal-upload" id="avatar-modal-upload">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
          <polyline points="17 8 12 3 7 8"></polyline>
          <line x1="12" y1="3" x2="12" y2="15"></line>
        </svg>
        Upload Gambar
      </button>
      <button type="button" class="avatar-modal-btn avatar-modal-remove" id="avatar-modal-remove">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="3 6 5 6 21 6"></polyline>
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
          <path d="M10 11v6"></path>
          <path d="M14 11v6"></path>
          <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
        </svg>
        Hapus Foto
      </button>
    </div>
  </div>
</div>

<x-footer />

<script>
  var INITIAL_NAME = "{{ strtoupper(substr($user->name, 0, 1)) }}";

  function setAvatarPreview(content, isPlaceholder) {
    var old = document.getElementById('avatar-preview');
    var el;
    if (isPlaceholder) {
      el = document.createElement('span');
      el.className = 'avatar-preview avatar-placeholder';
      el.textContent = content;
    } else {
      el = document.createElement('img');
      el.src = content;
      el.className = 'avatar-preview';
      el.alt = 'Avatar';
    }
    el.id = 'avatar-preview';
    old.replaceWith(el);
  }

  (function () {
    var clickArea      = document.getElementById('avatar-click-area');
    var overlay        = document.getElementById('avatar-modal-overlay');
    var closeBtn       = document.getElementById('avatar-modal-close');
    var uploadBtn      = document.getElementById('avatar-modal-upload');
    var removeBtn      = document.getElementById('avatar-modal-remove');
    var fileInput      = document.getElementById('avatar-input');
    var removeField    = document.getElementById('remove_avatar');

    function openModal() {
      overlay.classList.add('show');
    }

    function closeModal() {
      overlay.classList.remove('show');
    }

    clickArea.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);

    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) closeModal();
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && overlay.classList.contains('show')) closeModal();
    });

    // Tombol "Upload Gambar" di modal -> buka dialog pilih file bawaan browser
    uploadBtn.addEventListener('click', function () {
      fileInput.click();
    });

    // Setelah file dipilih -> preview langsung berubah, tandai remove=0, modal ditutup
    fileInput.addEventListener('change', function (e) {
      var file = e.target.files[0];
      if (!file) return;

      removeField.value = '0';

      var reader = new FileReader();
      reader.onload = function (event) {
        setAvatarPreview(event.target.result, false);
        closeModal();
      };
      reader.readAsDataURL(file);
    });

    // Tombol "Hapus Foto" -> preview langsung jadi placeholder, tandai remove=1, modal ditutup
    removeBtn.addEventListener('click', function () {
      fileInput.value = '';
      removeField.value = '1';
      setAvatarPreview(INITIAL_NAME, true);
      closeModal();
    });
  })();

  // Animasi section muncul saat discroll ke viewport (bukan langsung semua saat load)
  (function () {
    var sections = document.querySelectorAll('.profile-section');

    if (!('IntersectionObserver' in window)) {
      sections.forEach(function (el) { el.classList.add('in-view', 'popped'); });
      return;
    }

    var observer = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

    sections.forEach(function (el) {
      observer.observe(el);
      el.addEventListener('animationend', function () {
        el.classList.add('popped');
      });
    });
  })();

  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
</script>

</body>
</html>