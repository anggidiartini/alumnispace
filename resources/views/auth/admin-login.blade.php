<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk Admin — Alumni Connect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="stage">
  <div class="deco-blob pink"></div>
  <div class="deco-blob yellow"></div>
  

  <div class="frame">

    <div class="panel-brand">
      <div>
        <div class="brand-row">
          <img src="{{ asset('assets/images/logo-as.png') }}" alt="Alumni Connect" class="brand-mark">
            <span class="brand-name">Alumni Connect</span>  
        </div>

        <div class="brand-copy">
          <span class="eyebrow-pill"> Ruang hangat untuk kita</span>
          <h1>Selamat datang<br>kembali, sahabat.</h1>
          <p>Masuk untuk lanjut terhubung, bertukar kabar, dan tumbuh bersama alumni lintas angkatan.</p>
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
        <h2>Masuk sebagai Administrator</h2>
      </div>

      @if($errors->any())
        <div class="error-msg show" style="margin-bottom:14px; background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px;">{{ $errors->first() }}</div>
      @endif

      @if(session('status'))
        <div style="margin-bottom:14px; background: #d1fae5; color: #047857; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 500;">
            {{ session('status') }}
        </div>
      @endif

      <form id="loginForm" action="{{ route('login') }}" method="POST" novalidate autocomplete="off">
        @csrf

        <div class="field">
          <label for="email">Email Admin</label>
          <div class="input-wrap" id="emailWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 13l9-5.5M4.5 5h15A1.5 1.5 0 0 1 21 6.5v11A1.5 1.5 0 0 1 19.5 19h-15A1.5 1.5 0 0 1 3 17.5v-11A1.5 1.5 0 0 1 4.5 5Z"/></svg>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@email.com" autocomplete="off">
          </div>
          <div class="error-msg" id="emailError">Masukkan alamat email yang valid ya.</div>
        </div>

        <div class="field">
          <label for="password">Kata sandi</label>
          <div class="input-wrap" id="passWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75v2.25M6.75 10.5h10.5a1.5 1.5 0 0 1 1.5 1.5v6.75a1.5 1.5 0 0 1-1.5 1.5H6.75a1.5 1.5 0 0 1-1.5-1.5V12a1.5 1.5 0 0 1 1.5-1.5Zm1.5 0V7.5a3.75 3.75 0 1 1 7.5 0v3"/></svg>
            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" autocomplete="new-password">
            <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan kata sandi">
              <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12S5.25 5.25 12 5.25 21.75 12 21.75 12 18.75 18.75 12 18.75 2.25 12 2.25 12Z"/><circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
          </div>
          <div class="error-msg" id="passError">Kata sandi minimal 6 karakter.</div>
        </div>

        <div class="row-between">
          <label class="remember">
            <input type="checkbox" id="remember" name="remember">
            Ingat aku
          </label>
          <a href="{{ route('password.request') }}" class="link-forgot">Lupa password?</a>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">
          <span class="spinner" id="spinner"></span>
          <span id="btnLabel">Masuk Admin</span>
        </button>

        <div style="margin-top:20px; padding-top:16px; border-top:1px dashed #E4E7F5; text-align:center;">
          <a href="{{ route('login') }}" style="font-size:14px; font-weight:600; color:var(--blue-600); text-decoration:none;">
            🎓 Login sebagai Alumni
          </a>
        </div>

      </form>

    </div>

  </div>
</div>

<script>
  // Toggle password visibility
  const togglePass = document.getElementById('togglePass');
  const passInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');
  const EYE_OPEN = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12S5.25 5.25 12 5.25 21.75 12 21.75 12 18.75 18.75 12 18.75 2.25 12 2.25 12Z"/><circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round"/>';
  const EYE_CLOSED = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.22A10.94 10.94 0 0 0 2.25 12S5.25 18.75 12 18.75c1.6 0 3.02-.32 4.24-.85M9.9 5.5A10.6 10.6 0 0 1 12 5.25C18.75 5.25 21.75 12 21.75 12a11.36 11.36 0 0 1-2.32 3.4M14.12 14.12a3 3 0 1 1-4.24-4.24"/><path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18"/>';

  togglePass.addEventListener('click', function(){
    const showing = passInput.type === 'text';
    passInput.type = showing ? 'password' : 'text';
    eyeIcon.innerHTML = showing ? EYE_OPEN : EYE_CLOSED;
    togglePass.setAttribute('aria-label', showing ? 'Tampilkan kata sandi' : 'Sembunyikan kata sandi');
  });

</script>

</body>
</html>
