<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni & Lowongan Kerja</title>
    <!-- Masukkan link CSS Bootstrap atau CSS custom kalian di sini -->
    <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}"> <!--Anggi punya -->
</head>
<body>

    <!-- 1. Panggil Navbar di bagian paling atas -->
    <x-navbar />

    <!-- 2. Lubang tempat halaman lain (Lowongan, Alumni, dll) akan masuk -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- 3. Panggil Footer di bagian paling bawah -->
    <x-footer />

    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>