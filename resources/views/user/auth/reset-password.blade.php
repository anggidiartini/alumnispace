<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Atur Ulang Kata Sandi — Alumni Connect</title>
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
          <span class="eyebrow-pill"> Keamanan Akun</span>
          <h1>Buat Kata Sandi Baru</h1>
          <p>Silakan masukkan kata sandi baru Anda. Pastikan kata sandi cukup kuat agar akun Anda tetap aman.</p>
        </div>
      </div>
    </div>

    <div class="panel-form">
      <div class="form-head">
        <h2>Atur Ulang Kata Sandi</h2>
      </div>

      @if($errors->any())
        <div class="error-msg show" style="margin-bottom:14px; background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px;">{{ $errors->first() }}</div>
      @endif

      <form id="resetForm" action="{{ route('password.update') }}" method="POST" novalidate>
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="field">
          <label for="email">Email</label>
          <div class="input-wrap" id="emailWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 13l9-5.5M4.5 5h15A1.5 1.5 0 0 1 21 6.5v11A1.5 1.5 0 0 1 19.5 19h-15A1.5 1.5 0 0 1 3 17.5v-11A1.5 1.5 0 0 1 4.5 5Z"/></svg>
            <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" readonly placeholder="nama@email.com" autocomplete="email">
          </div>
        </div>

        <div class="field">
          <label for="password">Kata sandi baru</label>
          <div class="input-wrap" id="passWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75v2.25M6.75 10.5h10.5a1.5 1.5 0 0 1 1.5 1.5v6.75a1.5 1.5 0 0 1-1.5 1.5H6.75a1.5 1.5 0 0 1-1.5-1.5V12a1.5 1.5 0 0 1 1.5-1.5Zm1.5 0V7.5a3.75 3.75 0 1 1 7.5 0v3"/></svg>
            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" autocomplete="new-password">
          </div>
        </div>
        <div class="field">
          <label for="password_confirmation">Konfirmasi kata sandi baru</label>
          <div class="input-wrap" id="passConfWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75v2.25M6.75 10.5h10.5a1.5 1.5 0 0 1 1.5 1.5v6.75a1.5 1.5 0 0 1-1.5 1.5H6.75a1.5 1.5 0 0 1-1.5-1.5V12a1.5 1.5 0 0 1 1.5-1.5Zm1.5 0V7.5a3.75 3.75 0 1 1 7.5 0v3"/></svg>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang kata sandi" autocomplete="new-password">
          </div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">
          <span class="spinner" id="spinner"></span>
          <span id="btnLabel">Simpan Kata Sandi</span>
        </button>

        <div style="margin-top:20px; text-align:center;">
          <a href="{{ route('login') }}" style="color: var(--blue-600); text-decoration: none; font-size: 14px; font-weight: 600;">Kembali ke halaman login</a>
        </div>

      </form>
    </div>

  </div>
</div>

</body>
</html>
