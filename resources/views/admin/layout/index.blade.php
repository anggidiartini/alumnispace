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
    <title>{{ trim($__env->yieldContent('page_title') ?: $__env->yieldContent('title') ?: 'AlumniSpace') }} - Panel Pengelola Portal</title>
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
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
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #062b4f 0%, #0a4174 50%, #125493 100%);
            color: var(--text-sidebar);
            display: flex;
            flex-direction: column;
            height: calc(100vh - 20px);
            margin: 10px 0 10px 10px;
            border-radius: 12px;
            position: relative;
            box-shadow: 0 20px 35px rgba(5, 34, 58, 0.2);
            border: 1px solid rgba(255,255,255,0.08);
            overflow: hidden;
        }
        .sidebar::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(255,255,255,0.08), transparent 30%);
            pointer-events: none;
        }
        .sidebar-header {
            height: 112px;
            padding: 18px 20px 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            position: relative;
            z-index: 1;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
            color: #ffffff;
            flex-direction: column;
        }
        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(255,255,255,0.12);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.1);
        }
        .brand-text h1 {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.02em;
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.2;
            text-align: center;
        }
        .brand-text p {
            font-size: 11px;
            color: rgba(224,242,254,0.8);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            text-align: center;
            margin-top: 4px;
        }
        .sidebar-menu {
            height: calc(100vh - 200px);
            overflow-y: auto;
            padding: 8px 16px 20px;
            position: relative;
            z-index: 1;
        }
        .nav-item {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #f1f8ff;
            text-decoration: none;
            margin-bottom: 6px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.04);
            border-color: rgba(255,255,255,0.08);
            transform: translateX(2px);
        }
        .nav-item.active {
            background: #f1f3f5;
            color: var(--color-primary);
            font-weight: 700;
            box-shadow: inset 0 0 0 1px rgba(10,65,116,0.08);
        }
        .nav-item-content {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }
        .nav-icon {
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: rgba(255,255,255,0.12);
            color: inherit;
            font-size: 11px;
            flex-shrink: 0;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
        }
        .nav-item.active .nav-icon {
            background: rgba(10,65,116,0.08);
            color: var(--color-primary);
            box-shadow: inset 0 0 0 1px rgba(10,65,116,0.08);
        }
        .badge {
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            color: #eaf7ff;
            min-width: 22px;
            text-align: center;
        }
        .nav-item.active .badge {
            background: rgba(10,65,116,0.08);
            color: var(--color-primary);
        }
        .nav-item.nav-item-special {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .nav-item.nav-item-special.active {
            background: linear-gradient(135deg, #f2b600 0%, #ffc824 100%);
            color: #0a4174;
            box-shadow: 0 8px 16px rgba(242,182,0,0.25);
        }
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 12px 14px 14px;
            border-top: 1px solid rgba(255,255,255,0.08);
            background: rgba(8, 33, 52, 0.38);
            z-index: 2;
        }
        .user-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,0.03);
            width: 100%;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--color-secondary) 0%, #d8f0ff 100%);
            color: #0a4174;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-wrapper { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .navbar { height: 64px; background-color: var(--bg-card); border-bottom: 1px solid var(--border-color); padding: 0 24px; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-muted); text-decoration: none;}
        .breadcrumb a { color: inherit; text-decoration: none; }
        .content-body { flex: 1; overflow-y: auto; padding: 24px; }
        .btn-web-view { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 12px; background: linear-gradient(180deg, #062b4f 0%, #0a4174 50%, #125493 100%); color: #ffffff; font-size: 13px; font-weight: 700; text-decoration: none; border: 1px solid rgba(255,255,255,0.08); transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-web-view:hover { opacity: 0.9; transform: translateY(-1px); color: #ffffff; }
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
