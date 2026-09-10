<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lupa Kata Sandi — Alumni Connect</title>
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
          <span class="eyebrow-pill"> Bantuan Akses</span>
          <h1>Lupa Kata Sandi?</h1>
          <p>Tenang saja. Masukkan alamat email yang terdaftar, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
        </div>
      </div>
    </div>

    <div class="panel-form">
      <div class="form-head">
        <h2>Reset Kata Sandi</h2>
      </div>

      @if($errors->any())
        <div class="error-msg show" style="margin-bottom:14px; background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px;">{{ $errors->first() }}</div>
      @endif

      @if(session('status'))
        <div style="margin-bottom:14px; background: #d1fae5; color: #047857; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 500;">
            {{ session('status') }}
        </div>
      @endif

      <form id="forgotForm" action="{{ route('password.email') }}" method="POST" novalidate>
        @csrf

        <div class="field">
          <label for="email">Email</label>
          <div class="input-wrap" id="emailWrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 13l9-5.5M4.5 5h15A1.5 1.5 0 0 1 21 6.5v11A1.5 1.5 0 0 1 19.5 19h-15A1.5 1.5 0 0 1 3 17.5v-11A1.5 1.5 0 0 1 4.5 5Z"/></svg>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email">
          </div>
        </div>

        <button type="submit" class="btn-submit" id="submitBtn">
          <span class="spinner" id="spinner"></span>
          <span id="btnLabel">Kirim Tautan Reset</span>
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
