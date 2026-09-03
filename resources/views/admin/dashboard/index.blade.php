@php
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $dbConnected = true;
        $dbName = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
    } catch (\Throwable $e) {
        $dbConnected = false;
        $dbName = null;
    }

    $sidebarItems = [
        // Data Alumni & Akademik
        ['key' => 'alumnis', 'title' => 'Data Alumni', 'icon' => 'fa-user-graduate', 'color' => '#7bbde8'],
        ['key' => 'graduations', 'title' => 'Tahun Angkatan', 'icon' => 'fa-graduation-cap', 'color' => '#7bbde8'],
        ['key' => 'schoolclasses', 'title' => 'Daftar Kelas', 'icon' => 'fa-chalkboard-user', 'color' => '#7bbde8'],
        ['key' => 'alumni_achievements', 'title' => 'Prestasi Alumni', 'icon' => 'fa-trophy', 'color' => '#7bbde8'],
        
        // Kepengurusan Alumni
        ['key' => 'board_periods', 'title' => 'Periode Kepengurusan', 'icon' => 'fa-calendar-check', 'color' => '#7bbde8'],
        ['key' => 'alumni_boards', 'title' => 'Pengurus Alumni', 'icon' => 'fa-user-tie', 'color' => '#7bbde8'],
        
        // Karir & Lowongan Kerja
        ['key' => 'job_categories', 'title' => 'Kategori Pekerjaan', 'icon' => 'fa-layer-group', 'color' => '#7bbde8'],
        ['key' => 'job_vacancies', 'title' => 'Lowongan Kerja', 'icon' => 'fa-briefcase', 'color' => '#7bbde8'],

        // Informasi, Media & Acara
        ['key' => 'articles', 'title' => 'Artikel & Berita', 'icon' => 'fa-newspaper', 'color' => '#7bbde8'],
        ['key' => 'event', 'title' => 'Acara & Agenda', 'icon' => 'fa-calendar-days', 'color' => '#7bbde8'],
        ['key' => 'albums', 'title' => 'Album Foto', 'icon' => 'fa-images', 'color' => '#7bbde8'],
        ['key' => 'galleries', 'title' => 'Galeri Foto', 'icon' => 'fa-camera-retro', 'color' => '#7bbde8'],
        ['key' => 'contents', 'title' => 'Konten Halaman', 'icon' => 'fa-file-lines', 'color' => '#7bbde8'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AlumniHub') - Portal Database Alumni</title>

    <!-- Google Fonts (Inter & Plus Jakarta Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js v3.14.1 -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            const savedSize = localStorage.getItem('textSize') || 'normal';
            const scaleMap = { 'small': '14px', 'normal': '16px', 'large': '18px', 'xlarge': '20px' };
            if (scaleMap[savedSize]) {
                document.documentElement.style.fontSize = scaleMap[savedSize];
            }
        })();
    </script>

    <style>
        :root {
            /* Palette Utama */
            --color-primary: #0a4174;
            --color-secondary: #7bbde8;

            /* Light Mode */
            --bg-main: #f4f8fb;
            --bg-card: #ffffff;
            --bg-sidebar: #0a4174;
            --bg-sidebar-header: #062b4f;
            --bg-sidebar-hover: #125493;
            --text-main: #0a4174;
            --text-muted: #527597;
            --text-sidebar: #e0f2fe;
            --border-color: #d0e1f0;
            --border-dark: #125493;
            
            --active-item-bg: #7bbde8;
            --active-item-text: #0a4174;
            --badge-bg: rgba(123, 189, 232, 0.25);
            --badge-text: #7bbde8;
        }

        /* Dark Mode */
        html.dark {
            --bg-main: #041221;
            --bg-card: #081d33;
            --bg-sidebar: #06192d;
            --bg-sidebar-header: #030e1a;
            --bg-sidebar-hover: #0c2d4e;
            --text-main: #f0f7fc;
            --text-muted: #7bbde8;
            --text-sidebar: #b3dcfa;
            --border-color: #12375c;
            --border-dark: #0d2843;

            --active-item-bg: #125493;
            --active-item-text: #ffffff;
            --badge-bg: rgba(123, 189, 232, 0.15);
            --badge-text: #7bbde8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        h1, h2, h3, .brand-text h1 {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        .layout-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background-color: var(--bg-sidebar);
            color: var(--text-sidebar);
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-dark);
            z-index: 20;
            transition: background-color 0.25s ease;
        }

        .sidebar-header {
            height: 64px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--bg-sidebar-header);
            border-bottom: 1px solid var(--border-dark);
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #ffffff;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background-color: var(--color-secondary);
            color: #0a4174;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .brand-text h1 {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.2px;
            color: #ffffff;
        }

        .brand-text p {
            font-size: 11px;
            color: var(--color-secondary);
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
        }

        .menu-category {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--color-secondary);
            margin-bottom: 8px;
            padding: 0 8px;
            display: flex;
            justify-content: space-between;
            letter-spacing: 0.5px;
            opacity: 0.85;
        }

        .nav-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: var(--text-sidebar);
            text-decoration: none;
            margin-bottom: 3px;
            transition: all 0.15s ease;
        }

        .nav-item:hover {
            background-color: var(--bg-sidebar-hover);
            color: #ffffff;
        }

        .nav-item.active {
            background-color: var(--active-item-bg);
            color: var(--active-item-text);
            font-weight: 700;
        }

        .nav-item-content {
            display: flex;
            align-items: center;
            gap: 10px;
            overflow: hidden;
            white-space: nowrap;
        }

        .badge {
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 4px;
            background-color: var(--badge-bg);
            color: var(--badge-text);
        }

        .active .badge {
            background-color: rgba(10, 65, 116, 0.2);
            color: var(--active-item-text);
        }

        html.dark .active .badge {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid var(--border-dark);
            background-color: var(--bg-sidebar-header);
        }

        .user-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 10px;
            border-radius: 6px;
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-dark);
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background-color: var(--color-secondary);
            color: #0a4174;
            font-weight: 700;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Main Wrapper */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Top Navbar */
        .navbar {
            height: 64px;
            background-color: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background-color 0.25s ease, border-color 0.25s ease;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .breadcrumb a {
            color: inherit;
            text-decoration: none;
        }

        .breadcrumb span.active {
            font-weight: 600;
            color: var(--text-main);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-main);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .btn-icon:hover {
            border-color: var(--color-secondary);
            color: var(--color-primary);
        }

        html.dark .btn-icon:hover {
            color: var(--color-secondary);
        }

        .btn-text-size {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-main);
            color: var(--text-main);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.15s ease;
        }

        .btn-text-size:hover {
            border-color: var(--color-secondary);
        }

        /* Profile Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 44px;
            width: 200px;
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 6px 0;
            z-index: 30;
        }

        .dropdown-header {
            padding: 8px 14px;
            border-bottom: 1px solid var(--border-color);
            font-size: 12px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 8px 14px;
            font-size: 12px;
            color: #e11d48;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            font-family: inherit;
        }

        .dropdown-item:hover {
            background-color: rgba(225, 29, 72, 0.08);
        }

        /* Content Body */
        .content-body {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
        }

        .alert-success {
            padding: 12px 16px;
            border-radius: 8px;
            background-color: rgba(123, 189, 232, 0.15);
            border: 1px solid var(--color-secondary);
            color: var(--color-primary);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        html.dark .alert-success {
            background-color: rgba(123, 189, 232, 0.1);
            border-color: var(--color-secondary);
            color: var(--color-secondary);
        }

        /* Responsive Utilities */
        @media (max-width: 1024px) {
            .sidebar-desktop { display: none; }
            .mobile-toggle { display: block !important; }
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 16px;
            color: var(--text-main);
            cursor: pointer;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body x-data="{
        mobileSidebarOpen: false,
        darkMode: document.documentElement.classList.contains('dark'),
        textSize: localStorage.getItem('textSize') || 'normal',
        get textSizeLabel() {
            switch (this.textSize) {
                case 'large': return 'Teks: Besar';
                case 'xlarge': return 'Teks: Ekstra';
                case 'small': return 'Teks: Kecil';
                default: return 'Teks: Normal';
            }
        },
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', this.darkMode);
        },
        cycleTextSize() {
            const sizes = ['normal', 'large', 'xlarge', 'small'];
            const nextIdx = (sizes.indexOf(this.textSize) + 1) % sizes.length;
            this.textSize = sizes[nextIdx];
            localStorage.setItem('textSize', this.textSize);
            const scaleMap = { 'small': '14px', 'normal': '16px', 'large': '18px', 'xlarge': '20px' };
            document.documentElement.style.fontSize = scaleMap[this.textSize] || '16px';
        }
    }">

    <div class="layout-wrapper">
        <!-- SIDEBAR -->
        <aside class="sidebar sidebar-desktop">
            <div class="sidebar-header">
                <a href="/admin/dashboard" class="brand-logo">
                    <div class="brand-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="brand-text">
                        <h1>AlumniHub</h1>
                        <p>Portal Database Alumni</p>
                    </div>
                </a>
            </div>

            <div class="sidebar-menu">
                <div style="margin-bottom: 20px;">
                    <div class="menu-category">Overview</div>
                    <a href="/admin/dashboard" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <div class="nav-item-content">
                            <i class="fa-solid fa-chart-pie" style="width: 16px; text-align: center;"></i>
                            <span>Dashboard Utama</span>
                        </div>
                    </a>
                </div>

                <div>
                    <div class="menu-category">
                        <span>Master Database</span>
                        <span>{{ count($sidebarItems) }} TABEL</span>
                    </div>

                    @foreach ($sidebarItems as $item)
                        @php
                            $isActive = request()->is('admin/table/' . $item['key']) || request()->is('table/' . $item['key']);
                            $count = $counts[$item['key']] ?? 0;
                        @endphp
                        <a href="{{ url('admin/table/' . $item['key']) }}" class="nav-item {{ $isActive ? 'active' : '' }}">
                            <div class="nav-item-content">
                                <i class="fa-solid {{ $item['icon'] }}" style="width: 16px; text-align: center; color: {{ $isActive ? 'var(--active-item-text)' : $item['color'] }};"></i>
                                <span>{{ $item['title'] }}</span>
                            </div>
                            <span class="badge">{{ $count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div class="avatar">AD</div>
                        <div>
                            <p style="font-size: 12px; font-weight: 600; color: #ffffff;">{{ Auth::user()->username ?? 'admin' }}</p>
                            <p style="font-size: 11px; color: var(--color-secondary); text-transform: capitalize;">{{ Auth::user()->role ?? 'Admin' }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: var(--color-secondary); cursor: pointer;" title="Logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN WRAPPER -->
        <div class="main-wrapper">
            <!-- TOP NAVBAR -->
            <header class="navbar">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <button @click="mobileSidebarOpen = true" class="mobile-toggle">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>

                    <div class="breadcrumb">
                        <a href="/admin/dashboard"><i class="fa-solid fa-house"></i> Home</a>
                        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
                        <span class="active">@yield('page_title', 'Dashboard Overview')</span>
                    </div>
                </div>

                <div class="nav-actions">
                    <button type="button" @click="cycleTextSize()" class="btn-text-size">
                        <span style="color: var(--color-primary); font-weight: 800;">A</span>
                        <span x-text="textSizeLabel">Teks: Normal</span>
                    </button>

                    <button type="button" @click="toggleDarkMode()" class="btn-icon" title="Ganti Mode Tampilan">
                        <i :class="darkMode ? 'fa-solid fa-sun' : 'fa-solid fa-moon'" style="color: var(--text-main);"></i>
                    </button>

                    <a href="{{ url()->current() }}" class="btn-icon" title="Refresh Halaman">
                        <i class="fa-solid fa-rotate"></i>
                    </a>

                    <div class="dropdown" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false" style="background: none; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <div class="avatar">AD</div>
                        </button>

                        <div x-cloak x-show="profileOpen" class="dropdown-menu">
                            <div class="dropdown-header">
                                <strong>{{ Auth::user()->email ?? 'admin@alumni.com' }}</strong>
                                <div style="font-size: 11px; color: var(--text-muted);">Administrator</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <main class="content-body">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>