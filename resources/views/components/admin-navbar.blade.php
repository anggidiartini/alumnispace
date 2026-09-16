<header class="navbar">
    <div class="breadcrumb">
        <a href="/admin/dashboard"><i class="fa-solid fa-house"></i> Beranda</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px; margin: 0 4px;"></i>
        <span style="font-weight:600;">@yield('page_title', 'Beranda')</span>
    </div>
    
    <div style="display: flex; gap: 12px; align-items: center;">
        <a href="{{ route('home') }}" class="btn-web-view">
            <i class="fa-solid fa-globe"></i> Kunjungi Website
        </a>
        
        <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
            @csrf
            <input type="hidden" name="redirect_to" value="admin.login">
            <button type="submit" class="btn-web-view" style="background-color: #fee2e2; color: #b91c1c; border-color: transparent;">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>
</header>
