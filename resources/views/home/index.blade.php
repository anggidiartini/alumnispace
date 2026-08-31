<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Mata Yearbook</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    @include('components.navbar')

    <div class="login-page">
        <div class="login-wrapper">

            {{-- ============ LEFT SIDE ============ --}}
            <div class="login-left">
                <h1 class="welcome-heading">
                    Selamat Datang<br>Kembali!
                </h1>
                <p class="welcome-text">
                    Yuk, lanjutkan cerita keluarga alumni dan jelajahi kenangan indah masa sekolah.
                </p>

                <div class="photo-stack">
                    <div class="photo-box photo-1"></div>
                    <div class="photo-box photo-2"></div>
                </div>
            </div>

            {{-- ============ RIGHT SIDE ============ --}}
            <div class="login-right">
                <div class="login-card">

                    <h2 class="form-title">Masuk</h2>
                    <p class="form-subtitle">Senang melihatmu kembali!</p>

                    <form action="{{ route('login') ?? '#' }}" method="POST">
                        @csrf

                        <div class="field-group">
                            <label for="email">Email alumni</label>
                            <div class="input-with-icon">
                                <span class="icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18v12H3z"/>
                                        <path d="M3 6l9 7 9-7"/>
                                    </svg>
                                </span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="namamu@alumni.sch.id"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                >
                            </div>
                            @error('email')
                                <small style="color:#ffe08a;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="password">Kata Sandi</label>
                            <div class="input-with-icon">
                                <span class="icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="5" y="11" width="14" height="9" rx="2"/>
                                        <path d="M8 11V7a4 4 0 0 1 8 0v4"/>
                                    </svg>
                                </span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan kata sandi"
                                    required
                                >
                            </div>
                            @error('password')
                                <small style="color:#ffe08a;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox" name="remember" id="remember">
                                Ingat saya
                            </label>
                            <a href="{{ route('password.request') ?? '#' }}" class="forgot-password">
                                Lupa password?
                            </a>
                        </div>

                        <button type="submit" class="btn-login">masuk</button>
                    </form>

                    <p class="register-note">
                        Belum punya akun? <a href="{{ route('register') ?? '#' }}">Daftar</a>
                    </p>

                </div>
            </div>

        </div>
    </div>

    @include('components.footer')

</body>
</html>