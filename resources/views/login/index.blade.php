<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Alumni - Masuk dan lanjutkan cerita serta kenangan indah bersama keluarga alumni.">
    <title>Masuk | Portal Alumni</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Pure Vanilla CSS Styling (No Tailwind CSS) -->
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    

    <!-- 1. MORNING SKY GRADIENT & GLOW BACKGROUND BLOBS -->
    <div class="bg-glow-container" aria-hidden="true">
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>
        <div class="bg-blob bg-blob-3"></div>
    </div>

    <!-- Dotted Paper Overlay Texture -->
    <div class="scrapbook-overlay" aria-hidden="true"></div>

    <!-- 2. DECORATIVE FLOATING ELEMENTS (⭐ ✨ ☁️ 🌼) -->
    <div class="floating-element float-item-1" aria-hidden="true">🌼</div>
    <div class="floating-element float-item-2" aria-hidden="true">✨</div>
    <div class="floating-element float-item-3" aria-hidden="true">☁️</div>
    <div class="floating-element float-item-4" aria-hidden="true">⭐</div>

    <!-- 3. MAIN PAGE CONTAINER -->
    <main class="login-page-container">
        <div class="login-wrapper">

            <!-- ================= BAGIAN KIRI (Visual & Polaroid Scrapbook) ================= -->
            <section class="visual-section">

                <!-- Tag / Badge Header -->
                <div class="scrapbook-badge">
                    <span class="scrapbook-badge-icon"></span>
                    <span class="scrapbook-badge-text">Buku Kenangan Alumni</span>
                    <span class="scrapbook-badge-tag">EST. 2026</span>
                </div>

                <!-- Judul Utama -->
                <h1 class="visual-title">
                    Selamat Datang <br>Kembali! 👋
                </h1>

                <!-- Deskripsi Singkat -->
                <p class="visual-description">
                    Yuk, lanjutkan cerita bersama keluarga alumni dan jelajahi kenangan indah masa sekolah.
                </p>

                <!-- Polaroid Scrapbook Card -->
                <div class="polaroid-container">
                    
                    <!-- Washi Tapes -->
                    <div class="washi-tape-top" aria-hidden="true">
                        <span>MEMORIES</span>
                    </div>
                    <div class="washi-tape-bottom" aria-hidden="true"></div>

                    <!-- Sticker Badge -->
                    <div class="sticker-badge">
                        Class of '24 📸
                    </div>

                    <!-- Sparkles around Polaroid -->
                    <div class="sparkle-decor" style="top: -20px; right: -15px; font-size: 1.5rem;" aria-hidden="true">⭐</div>
                    <div class="sparkle-decor" style="bottom: 10px; left: -25px; font-size: 1.6rem; animation-delay: 1.2s;" aria-hidden="true">✨</div>

                    <!-- Polaroid Frame Component -->
                    <div class="polaroid-frame">
                        <div class="polaroid-image-wrapper">
                            <img 
                                src="/images/alumni-polaroid.png" 
                                alt="Foto Kenangan Alumni" 
                                class="polaroid-image"
                                loading="eager"
                            >
                            <div class="polaroid-tag">
                                💖 Reunian
                            </div>
                        </div>

                        <!-- Caption inside Polaroid -->
                        <div class="polaroid-caption">
                            <div class="polaroid-caption-title">
                                "Sahabat Selamanya ✨"
                            </div>
                            <div class="polaroid-caption-sub">
                                Reuni Akbar & Temu Kangen Alumni
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Subtle Alumni Note -->
                <div class="alumni-count-note">
                    <span class="ping-dot"></span>
                    <span>1,200+ Alumni Sudah Terhubung!</span>
                </div>

            </section>


            <!-- ================= BAGIAN KANAN (Form Login Card) ================= -->
            <section class="form-section">
                
                <div class="login-card">

                    <!-- Top Corner Decorative Sticker -->
                    <div class="card-top-sticker">
                        Portal Resmi 🌟
                    </div>

                    <!-- Card Header -->
                    <div class="card-header">
                        <div class="card-logo-icon">
                            🎓
                        </div>
                        <h2 class="card-title">Masuk ke Akun</h2>
                        <p class="card-subtitle">Senang melihatmu kembali!</p>
                    </div>

                    <!-- Notification Toast Feedback -->
                    <div id="login-toast" class="toast-message hidden" role="status">
                        <span id="toast-icon" style="font-size: 1.1rem;">🚀</span>
                        <span id="toast-message">Memproses data login...</span>
                    </div>

                    <!-- Login Form -->
                    <form id="alumni-login-form" action="#" method="POST" onsubmit="handleLogin(event)">
                        @csrf

                        <!-- Field Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email Alumni <span class="required-star">*</span>
                            </label>
                            <div class="input-container">
                                <div class="input-icon-left" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    required 
                                    placeholder="namamu@alumni.sch.id"
                                    class="form-input"
                                >
                            </div>
                        </div>

                        <!-- Field Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">
                                Kata Sandi <span class="required-star">*</span>
                            </label>
                            <div class="input-container">
                                <div class="input-icon-left" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required 
                                    placeholder="••••••••"
                                    class="form-input"
                                >
                                <!-- Toggle Password Button -->
                                <button 
                                    type="button" 
                                    id="toggle-password"
                                    onclick="togglePasswordVisibility()"
                                    aria-label="Tampilkan atau sembunyikan kata sandi"
                                    class="toggle-password-btn"
                                >
                                    <svg id="eye-icon-show" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eye-icon-hide" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 012.122-.363c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Form Options Row (Ingat saya & Lupa password) -->
                        <div class="form-options-row">
                            <label class="checkbox-label">
                                <input 
                                    type="checkbox" 
                                    id="remember_me" 
                                    name="remember" 
                                    class="custom-checkbox"
                                >
                                <span>Ingat saya</span>
                            </label>

                            <a href="#lupa-password" onclick="alert('Silakan hubungi administrator alumni sekolah untuk reset password!')" class="forgot-link">
                                Lupa password?
                            </a>
                        </div>

                        <!-- Main Submit Button -->
                        <button 
                            type="submit" 
                            id="submit-btn"
                            class="btn-primary"
                        >
                            <span>Masuk</span>
                            <span>🚀</span>
                        </button>

                    </form>
                </div>

            </section>

        </div>
    </main>

    <!-- Vanilla JavaScript Interactions -->
    <script>
        // Password Visibility Toggle Logic
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeShow = document.getElementById('eye-icon-show');
            const eyeHide = document.getElementById('eye-icon-hide');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeShow.style.display = 'none';
                eyeHide.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                eyeShow.style.display = 'inline';
                eyeHide.style.display = 'none';
            }
        }

        // Demo Login Handler with Interactive Feedback Toast
        function handleLogin(event) {
            event.preventDefault();

            const submitBtn = document.getElementById('submit-btn');
            const toast = document.getElementById('login-toast');
            const toastMessage = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');

            toast.classList.remove('hidden');
            toastIcon.innerText = '⌛';
            toastMessage.innerText = 'Memeriksa data kredensial alumni...';

            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';

            setTimeout(() => {
                toastIcon.innerText = '🎉';
                toastMessage.innerText = 'Login Berhasil! Selamat datang kembali di Portal Alumni.';
                toast.style.backgroundColor = 'var(--dewy-blue)';

                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                }, 1500);
            }, 1000);
        }
    </script>

</body>
</html>
