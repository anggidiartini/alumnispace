<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun Baru — Alumni Connect</title>
  <link rel="icon" type="image/webp" href="{{ asset('images/logo-as.webp') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="stage">
  <div class="deco-blob pink"></div>
  <div class="deco-blob yellow"></div>
  <div class="deco-blob blue"></div>

  <div class="frame">

    <div class="panel-brand">
      <div>
        <div class="brand-row">
          <img src="{{ asset('assets/images/logo-as.webp') }}" alt="Alumni Connect" class="brand-mark">
          <span class="brand-name">Alumni Connect</span>
        </div>

        <div class="brand-copy">
          <span class="eyebrow-pill">Bergabung bersama kami</span>
          <h1>Mulai perjalananmu<br>di Alumni Space.</h1>
          <p>Daftar untuk lanjut terhubung, bertukar kabar, mencari lowongan, dan tumbuh bersama alumni lintas angkatan.</p>
        </div>

        <div class="story-card">
          <div class="story-people">
            <div class="avatar">NA</div>
            <div class="avatar">RY</div>
            <div class="avatar">DP</div>
          </div>
          <div class="story-text"><strong>12.000+ teman</strong> sudah terhubung dan berbagi cerita minggu ini.</div>
        </div>
      </div>
    </div>

    <div class="panel-form">
      <div class="form-head">
        <h2>Daftar Akun Baru</h2>
      </div>

      @if($errors->any())
        <div class="error-msg show" style="margin-bottom:14px; background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px;">
          {{ $errors->first() }}
        </div>
      @endif

      @if(session('status'))
        <div style="margin-bottom:14px; background: #d1fae5; color: #047857; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 500;">
          {{ session('status') }}
        </div>
      @endif

      <form id="registerForm" action="{{ route('register') }}" method="POST" novalidate autocomplete="off">
        @csrf

        <div class="field">
          <label for="name">Nama Lengkap</label>
          <div class="input-wrap" id="nameWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda" required autocomplete="name">
          </div>
        </div>

        <div class="field">
          <label for="email">Email</label>
          <div class="input-wrap" id="emailWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 13l9-5.5M4.5 5h15A1.5 1.5 0 0 1 21 6.5v11A1.5 1.5 0 0 1 19.5 19h-15A1.5 1.5 0 0 1 3 17.5v-11A1.5 1.5 0 0 1 4.5 5Z"/></svg>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email">
          </div>
        </div>

        <div class="field">
          <label for="password">Kata Sandi</label>
          <div class="input-wrap" id="passWrap">
            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
            <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan kata sandi">
              <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"></svg>
            </button>
          </div>
        </div>

        <div class="field">
          <label for="password_confirmation">Konfirmasi Kata Sandi</label>
          <div class="input-wrap" id="passConfWrap">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required autocomplete="new-password">
            <button type="button" class="toggle-pass" id="togglePassConf" aria-label="Tampilkan konfirmasi kata sandi">
              <svg id="eyeIconConf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"></svg>
            </button>
          </div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">
          <span class="spinner" id="spinner"></span>
          <span id="btnLabel">Daftar Sekarang</span>
        </button>

        <div style="margin-top:20px; text-align:center; font-size:14px; color:#475569;">
          Sudah punya akun? <a href="{{ route('login') }}" style="color: #2e6fb0; font-weight: 600; text-decoration: none;">Masuk di sini</a>
        </div>
      </form>
    </div>

  </div>
</div>

<script>
const EYE_OPEN = `
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.25 12S5.25 5.25 12 5.25
           21.75 12 21.75 12
           18.75 18.75 12 18.75
           2.25 12 2.25 12Z"/>
  <circle cx="12" cy="12" r="3"
          stroke-linecap="round" stroke-linejoin="round"/>
`;

const EYE_CLOSED = `
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M3.98 8.22A10.94 10.94 0 0 0 2.25 12
           S5.25 18.75 12 18.75
           c1.6 0 3.02-.32 4.24-.85
           M9.9 5.5A10.6 10.6 0 0 1 12 5.25
           C18.75 5.25 21.75 12 21.75 12
           a11.36 11.36 0 0 1-2.32 3.4
           M14.12 14.12a3 3 0 1 1-4.24-4.24"/>
  <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18"/>
`;

const togglePass = document.getElementById('togglePass');
const passInput = document.getElementById('password');
const eyeIcon = document.getElementById('eyeIcon');

if (togglePass && passInput && eyeIcon) {
  eyeIcon.innerHTML = EYE_CLOSED;
  togglePass.addEventListener('click', function(){
    const showing = passInput.type === 'text';
    passInput.type = showing ? 'password' : 'text';
    eyeIcon.innerHTML = showing ? EYE_CLOSED : EYE_OPEN;
    togglePass.setAttribute('aria-label', showing ? 'Tampilkan kata sandi' : 'Sembunyikan kata sandi');
  });
}

const togglePassConf = document.getElementById('togglePassConf');
const passConfInput = document.getElementById('password_confirmation');
const eyeIconConf = document.getElementById('eyeIconConf');

if (togglePassConf && passConfInput && eyeIconConf) {
  eyeIconConf.innerHTML = EYE_CLOSED;
  togglePassConf.addEventListener('click', function(){
    const showing = passConfInput.type === 'text';
    passConfInput.type = showing ? 'password' : 'text';
    eyeIconConf.innerHTML = showing ? EYE_CLOSED : EYE_OPEN;
    togglePassConf.setAttribute('aria-label', showing ? 'Tampilkan kata sandi' : 'Sembunyikan kata sandi');
  });
}
</script>

</body>
</html>
