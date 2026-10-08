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

<x-user-navbar />

{{-- Ornamen dekoratif, disamakan gaya & animasinya dengan halaman Album.
     Fixed di pinggir viewport karena halaman ini satu section panjang. --}}
<div class="deco-asset prof-deco-l1" aria-hidden="true">
  <img src="{{ asset('assets/images/deco-jam.png') }}" alt="" class="prof-jam floaty">
</div>
<div class="deco-asset prof-deco-l2" aria-hidden="true">
  <img src="{{ asset('assets/images/deco-alattulis.png') }}" alt="" class="prof-alattulis wiggle">
</div>
<div class="deco-asset prof-deco-r1" aria-hidden="true">
  <img src="{{ asset('assets/images/deco-bus.png') }}" alt="" class="prof-bus floaty-slow">
</div>
<div class="deco-asset prof-deco-r2" aria-hidden="true">
  <img src="{{ asset('assets/images/deco-papantulis.png') }}" alt="" class="prof-papantulis wiggle">
</div>

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

          <div class="profile-photo-row">
            <div class="profile-field profile-field-avatar">
              <div class="avatar-preview-wrap">

                <button type="button" class="avatar-click-area" id="avatar-click-area" aria-label="Ubah foto profil">
                  <img
                    src="{{ $profile->avatar ? asset('storage/' . $profile->avatar) . '?v=' . $profile->updated_at?->timestamp : asset('assets/images/default-avatar.jpg') }}"
                    alt="Avatar"
                    class="avatar-preview"
                    id="avatar-preview"
                    onerror="this.src='{{ asset('assets/images/default-avatar.jpg') }}'"
                  >

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

            {{-- Sementara belum diarahkan kemana-mana — tinggal ganti jadi <a href="..."> kalau halaman/route-nya udah siap --}}
            <button type="button" class="yearbook-btn">
              
              Digital Yearbook
            </button>
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
              <label for="email">Email</label>
              <input type="email" name="email" id="email"
                     value="{{ old('email', $user->email) }}"
                     data-original-email="{{ $user->email }}">
            </div>
            <div class="profile-field profile-field-full" id="current-password-group" style="display: none;">
              <label for="current_password">Password Saat Ini</label>
              <div class="password-input-wrap">
                <input type="password" name="current_password" id="current_password"
                       placeholder="Masukkan password saat ini untuk konfirmasi" autocomplete="current-password">
                <button type="button" class="password-toggle-btn" id="current_password-toggle" aria-label="Tampilkan password">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-eye-off">
                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a19.68 19.68 0 0 1 4.22-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a19.5 19.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                  </svg>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-eye" style="display: none;">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </button>
              </div>
              <span class="field-hint">Wajib diisi karena kamu mengubah email — untuk verifikasi bahwa ini benar akunmu.</span>
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

        {{-- PRESTASI (list dinamis, ganti dari textarea) --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Prestasi</h2>

          <div class="achievement-list" id="achievement-list">
            @php
                $oldAchievements = old('achievements');
                if ($oldAchievements) {
                    $achievementItems = $oldAchievements;
                } else {
                    $achievementItems = $profile->achievements
                        ? preg_split('/\r\n|\r|\n/', trim($profile->achievements))
                        : [];
                }
            @endphp

            @forelse ($achievementItems as $item)
              <div class="achievement-row">
                <input type="text" name="achievements[]" value="{{ $item }}" placeholder="Contoh: Juara 1 Olimpiade Matematika 2023">
                <button type="button" class="achievement-remove" aria-label="Hapus">&times;</button>
              </div>
            @empty
              <div class="achievement-row">
                <input type="text" name="achievements[]" value="" placeholder="Contoh: Juara 1 Olimpiade Matematika 2023">
                <button type="button" class="achievement-remove" aria-label="Hapus">&times;</button>
              </div>
            @endforelse
          </div>

          <button type="button" class="achievement-add-btn" id="achievement-add-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Prestasi
          </button>
        </div>

        {{-- RIWAYAT ORGANISASI --}}
        <div class="profile-section">
          <h2 class="profile-section-title">Riwayat Organisasi</h2>

          <div class="achievement-list" id="organization-list">
            @php
                $oldOrganizations = old('organization_role');
                if ($oldOrganizations) {
                    $organizationItems = $oldOrganizations;
                } else {
                    $organizationItems = $profile->organization_role
                        ? preg_split('/\r\n|\r|\n/', trim($profile->organization_role))
                        : [];
                }
            @endphp

            @forelse ($organizationItems as $item)
              <div class="achievement-row">
                <input type="text" name="organization_role[]" value="{{ $item }}" placeholder="Contoh: Ketua OSIS 2019/2020">
                <button type="button" class="achievement-remove" aria-label="Hapus">&times;</button>
              </div>
            @empty
              <div class="achievement-row">
                <input type="text" name="organization_role[]" value="" placeholder="Contoh: Ketua OSIS 2019/2020">
                <button type="button" class="achievement-remove" aria-label="Hapus">&times;</button>
              </div>
            @endforelse
          </div>

          <button type="button" class="achievement-add-btn" id="organization-add-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Pengalaman Organisasi
          </button>
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
          <a href="{{ route('home') }}" class="profile-cancel-btn">Kembali</a>
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

{{-- Floating action buttons: Back to Top & WhatsApp — sama seperti di halaman Album --}}
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

<x-user-footer />

<script>
  var DEFAULT_AVATAR_URL = "{{ asset('assets/images/default-avatar.jpg') }}";

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

    // Tombol "Hapus Foto" -> preview langsung jadi foto default, tandai remove=1, modal ditutup
    removeBtn.addEventListener('click', function () {
      fileInput.value = '';
      removeField.value = '1';
      setAvatarPreview(DEFAULT_AVATAR_URL, false);
      closeModal();
    });
  })();

  // List dinamis reusable: dipakai buat Prestasi & Riwayat Organisasi
  // (tombol tambah & hapus per baris, sama-sama pakai class .achievement-row)
  function setupDynamicList(listId, addBtnId, inputName, placeholder) {
    var list = document.getElementById(listId);
    var addBtn = document.getElementById(addBtnId);
    if (!list || !addBtn) return;

    function makeRow(value) {
      var row = document.createElement('div');
      row.className = 'achievement-row';

      var input = document.createElement('input');
      input.type = 'text';
      input.name = inputName;
      input.value = value || '';
      input.placeholder = placeholder;

      var removeBtn = document.createElement('button');
      removeBtn.type = 'button';
      removeBtn.className = 'achievement-remove';
      removeBtn.setAttribute('aria-label', 'Hapus');
      removeBtn.innerHTML = '&times;';

      row.appendChild(input);
      row.appendChild(removeBtn);
      return row;
    }

    addBtn.addEventListener('click', function () {
      var rows = list.querySelectorAll('.achievement-row');
      var lastInput = rows[rows.length - 1].querySelector('input');

      // Kalau box terakhir masih kosong, jangan nambah baru — fokus ke situ aja
      if (lastInput.value.trim() === '') {
        lastInput.focus();
        return;
      }

      var row = makeRow('');
      list.appendChild(row);
      row.querySelector('input').focus();
    });

    list.addEventListener('click', function (e) {
      if (e.target.classList.contains('achievement-remove')) {
        var rows = list.querySelectorAll('.achievement-row');
        if (rows.length > 1) {
          e.target.closest('.achievement-row').remove();
        } else {
          e.target.closest('.achievement-row').querySelector('input').value = '';
        }
      }
    });
  }

  setupDynamicList('achievement-list', 'achievement-add-btn', 'achievements[]', 'Contoh: Juara 1 Olimpiade Matematika 2023');
  setupDynamicList('organization-list', 'organization-add-btn', 'organization_role[]', 'Contoh: Ketua OSIS 2019/2020');

  // Tombol ikon mata di field password — toggle lihat/sembunyikan isi password
  (function () {
    var toggleBtn = document.getElementById('current_password-toggle');
    var pwInput = document.getElementById('current_password');
    if (!toggleBtn || !pwInput) return;

    var eyeIcon = toggleBtn.querySelector('.icon-eye');
    var eyeOffIcon = toggleBtn.querySelector('.icon-eye-off');

    toggleBtn.addEventListener('mousedown', function (e) {
      // preventDefault di sini penting: supaya klik ke tombol ini TIDAK bikin
      // field password kehilangan fokus duluan (yang biasanya memicu dropdown
      // saran autofill browser nutup & "makan" klik pertama, jadi kerasa
      // harus double klik). Dengan ini, toggle langsung kena di klik pertama.
      e.preventDefault();

      var isHidden = pwInput.type === 'password';
      pwInput.type = isHidden ? 'text' : 'password';
      // Mata kebuka = huruf kelihatan (type text), mata coret = huruf disembunyikan (type password)
      eyeIcon.style.display = isHidden ? '' : 'none';
      eyeOffIcon.style.display = isHidden ? 'none' : '';
      toggleBtn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
    });
  })();

  // Field "Password Saat Ini" cuma muncul kalau email diubah dari nilai aslinya
  (function () {
    var emailInput = document.getElementById('email');
    var pwGroup = document.getElementById('current-password-group');
    if (!emailInput || !pwGroup) return;

    var originalEmail = emailInput.dataset.originalEmail || '';

    function toggle() {
      if (emailInput.value.trim() !== originalEmail) {
        pwGroup.style.display = '';
      } else {
        pwGroup.style.display = 'none';
        document.getElementById('current_password').value = '';
      }
    }

    emailInput.addEventListener('input', toggle);
    toggle(); // jaga-jaga kalau reload gara-gara validasi gagal, emailnya udah beda dari semula
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

  // Tombol "Back to Top" — muncul setelah scroll turun, klik untuk balik ke atas
  (function () {
    var backToTopBtn = document.getElementById('back-to-top');
    if (!backToTopBtn) return;

    function toggleBackToTop() {
      if (window.scrollY > 320) {
        backToTopBtn.classList.add('show');
      } else {
        backToTopBtn.classList.remove('show');
      }
    }

    window.addEventListener('scroll', toggleBackToTop, { passive: true });
    toggleBackToTop();

    backToTopBtn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  })();

  // Bubble WhatsApp — klik tombol WA untuk buka/tutup bubble info sebelum lanjut ke wa.me
  (function () {
    var waButton = document.getElementById('wa-button');
    var waBubble = document.getElementById('wa-bubble');
    var waBubbleClose = document.getElementById('wa-bubble-close');
    if (!waButton || !waBubble) return;

    function openBubble(e) {
      if (!waBubble.classList.contains('show')) {
        e.preventDefault();
        waBubble.classList.add('show');
      }
    }

    function closeBubble() {
      waBubble.classList.remove('show');
    }

    waButton.addEventListener('click', openBubble);

    if (waBubbleClose) {
      waBubbleClose.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        closeBubble();
      });
    }

    document.addEventListener('click', function (e) {
      if (waBubble.classList.contains('show') &&
          !waBubble.contains(e.target) &&
          e.target !== waButton &&
          !waButton.contains(e.target)) {
        closeBubble();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeBubble();
    });
  })();

  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
</script>

</body>
</html>