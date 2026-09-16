@php
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AlumniSpace') - Panel Pengelola Portal</title>
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com" rel="stylesheet">
    <link rel="stylesheet" href="https://cloudflare.com">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <style>
        :root {
            --color-primary: #0a4174; --color-secondary: #7bbde8;
            --bg-main: #f4f8fb; --bg-card: #ffffff; --bg-sidebar: #0a4174; --bg-sidebar-header: #062b4f;
            --bg-sidebar-hover: #125493; --text-main: #0a4174; --text-muted: #527597; --text-sidebar: #e0f2fe;
            --border-color: #d0e1f0; --border-dark: #125493; --active-item-bg: #7bbde8; --active-item-text: #0a4174;
            --badge-bg: rgba(123, 189, 232, 0.25); --badge-text: #7bbde8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-main); color: var(--text-main); height: 100vh; display: flex; overflow: hidden; }
        .layout-wrapper { display: flex; height: 100vh; width: 100%; }
        .sidebar { width: 260px; background-color: var(--bg-sidebar); color: var(--text-sidebar); display: flex; flex-direction: column; border-right: 1px solid var(--border-dark); height: 100vh; position: relative; }
        .sidebar-header { height: 64px; padding: 0 20px; display: flex; align-items: center; background-color: var(--bg-sidebar-header); border-bottom: 1px solid var(--border-dark); }
        .brand-logo { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #ffffff; }
        .brand-icon { width: 36px; height: 36px; border-radius: 8px; background-color: var(--color-secondary); color: #0a4174; display: flex; align-items: center; justify-content: center; }
        .brand-text h1 { font-size: 15px; font-weight: 700; color: #ffffff; }
        .brand-text p { font-size: 11px; color: var(--color-secondary); }
        .sidebar-menu { height: calc(100vh - 130px); overflow-y: auto; padding: 16px 12px; padding-bottom: 70px; }
        .menu-category { font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--color-secondary); margin-bottom: 8px; padding: 0 8px; display: flex; justify-content: space-between; }
        .nav-item { display: flex; align-items: center; justify-content: space-between; padding: 8px 12px; border-radius: 6px; font-size: 13px; color: var(--text-sidebar); text-decoration: none; margin-bottom: 3px; }
        .nav-item:hover { background-color: var(--bg-sidebar-hover); color: #ffffff; }
        .nav-item.active { background-color: var(--active-item-bg); color: var(--active-item-text); font-weight: 700; }
        .nav-item-content { display: flex; align-items: center; gap: 10px; }
        .badge { font-size: 11px; font-weight: 600; padding: 2px 7px; border-radius: 4px; background-color: var(--badge-bg); color: var(--badge-text); }
        .sidebar-footer { position: absolute; bottom: 0; left: 0; width: 260px; padding: 12px; border-top: 1px solid var(--border-dark); background-color: var(--bg-sidebar-header); z-index: 50; }
        .user-card { display: flex; align-items: center; justify-content: space-between; padding: 8px 10px; border-radius: 6px; background-color: rgba(0, 0, 0, 0.2); width: 100%; }
        .avatar { width: 32px; height: 32px; border-radius: 6px; background-color: var(--color-secondary); color: #0a4174; font-weight: 700; display: flex; align-items: center; justify-content: center; }
        .main-wrapper { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .navbar { height: 64px; background-color: var(--bg-card); border-bottom: 1px solid var(--border-color); padding: 0 24px; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-muted); text-decoration: none;}
        .breadcrumb a { color: inherit; text-decoration: none; }
        .content-body { flex: 1; overflow-y: auto; padding: 24px; }
        .btn-web-view { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 6px; background-color: var(--color-secondary); color: var(--color-primary); font-size: 13px; font-weight: 700; text-decoration: none; border: 1px solid transparent; transition: all 0.2s ease; }
        .btn-web-view:hover { background-color: transparent; border-color: var(--color-secondary); color: var(--color-primary); }
        .nav-item.nav-item-special {
            background: linear-gradient(135deg, #f2b600 0%, #ffc824 100%);
            color: #0a4174; font-weight: 800; margin-top: 24px; border: 1px solid #e0a300;
            box-shadow: 0 4px 6px rgba(0,0,0,0.15); transition: all 0.2s ease;
        }
        .nav-item.nav-item-special:hover {
            background: linear-gradient(135deg, #e5a900 0%, #f2b600 100%); color: #0a4174;
            transform: translateY(-2px); box-shadow: 0 6px 10px rgba(0,0,0,0.2);
        }
        .nav-item.nav-item-special .nav-item-content i { color: #0a4174 !important; font-size: 16px; }
        .nav-item.nav-item-special.active { box-shadow: inset 0 0 0 3px #0a4174, 0 4px 6px rgba(0,0,0,0.15); background: linear-gradient(135deg, #ffc824 0%, #f2b600 100%); }
    </style>
</head>

<body>
    <div class="layout-wrapper">
        <!-- MENU NAVIGASI KONTROL -->
        <x-admin-sidebar />

        <!-- AREA UTAMA KONTEN -->
        <div class="main-wrapper">
            <x-admin-navbar />
            
            <main class="content-body">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
