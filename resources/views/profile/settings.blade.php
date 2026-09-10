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

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
        @csrf
        @method('PUT')

        {{-- FOTO PROFIL --}}
        <div class="profile-section profile-section-full">
            <h2 class="profile-section-title">Foto Profil</h2>

          <div class="profile-field profile-field-avatar">
            <div class="avatar-preview-wrap">
              @if ($profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="avatar-preview" id="avatar-preview">
              @else
                <span class="avatar-preview avatar-placeholder" id="avatar-preview">
                  {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
              @endif
              <input type="file" name="avatar" id="avatar-input" accept="image/*">
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
              <input type="text" name="student_number" id="student_number"
                     value="{{ old('student_number', $profile->student_number) }}">
            </div>
            <div class="profile-field">
              <label for="graduation_year">Angkatan</label>
              <input type="number" name="graduation_year" id="graduation_year"
                     value="{{ old('graduation_year', $profile->graduation_year) }}">
            </div>
            <div class="profile-field">
              <label for="major">Jurusan</label>
              <input type="text" name="major" id="major"
                     value="{{ old('major', $profile->major) }}">
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

<x-footer />

<script>
  document.getElementById('avatar-input').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (event) {
      const preview = document.getElementById('avatar-preview');
      const img = document.createElement('img');
      img.src = event.target.result;
      img.className = 'avatar-preview';
      img.id = 'avatar-preview';
      preview.replaceWith(img);
    };
    reader.readAsDataURL(file);
  });

  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
</script>

</body>
</html>