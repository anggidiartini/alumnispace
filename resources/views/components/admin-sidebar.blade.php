@php
    $sidebarItems = [
        ['key' => 'alumnis', 'title' => 'Data Alumni', 'icon' => 'fa-user-graduate', 'color' => '#7bbde8'],
        ['key' => 'job_vacancies', 'title' => 'Lowongan Kerja', 'icon' => 'fa-briefcase', 'color' => '#7bbde8'],
        ['key' => 'articles', 'title' => 'Artikel & Berita', 'icon' => 'fa-newspaper', 'color' => '#7bbde8'],
        ['key' => 'event', 'title' => 'Acara & Agenda', 'icon' => 'fa-calendar-days', 'color' => '#7bbde8'],
        ['key' => 'albums', 'title' => 'Album Foto', 'icon' => 'fa-images', 'color' => '#7bbde8'],
        ['key' => 'galleries', 'title' => 'Galeri Foto', 'icon' => 'fa-camera-retro', 'color' => '#7bbde8'],
        ['key' => 'contents', 'title' => 'Konten Teks Halaman', 'icon' => 'fa-file-lines', 'color' => '#7bbde8'],
    ];
@endphp

<aside class="sidebar">
    <div class="sidebar-header">
        <a href="/admin/dashboard" class="brand-logo">
            <div class="brand-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="brand-text">
                <h1>AlumniSpace</h1>
                <p>Menu Pengelola</p>
            </div>
        </a>
    </div>
    <div class="sidebar-menu">
        <div style="margin-bottom: 20px;">
            <div class="menu-category">Ikhtisar</div>
            <a href="/admin/dashboard" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <div class="nav-item-content"><i class="fa-solid fa-chart-pie" style="width: 16px; text-align: center;"></i><span>Halaman Utama</span></div>
            </a>
        </div>
        <div>
            <div class="menu-category"><span>Pengelolaan Situs</span></div>
            @foreach ($sidebarItems as $item)
                @php
                    $isActive = request()->is('admin/table/' . $item['key']) || (request()->is('admin/content') && $item['key'] === 'contents');
                    $countValue = $counts[$item['key']] ?? 0;
                @endphp
                
                <a href="{{ $item['key'] === 'contents' ? route('admin.content.index') : url('admin/table/' . $item['key']) }}" 
                class="nav-item {{ $isActive ? 'active' : '' }} {{ $item['key'] === 'contents' ? 'nav-item-special' : '' }}">
                    <div class="nav-item-content">
                        <i class="fa-solid {{ $item['icon'] }}" style="width: 16px; text-align: center; color: {{ $isActive ? 'var(--active-item-text)' : $item['color'] }};"></i>
                        <span>{{ $item['title'] }}</span>
                    </div>
                    
                    @if($item['key'] !== 'contents')
                        <span class="badge">{{ $countValue }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
    
    <!-- IDENTITAS PETUGAS YANG MASUK -->
    <div class="sidebar-footer">
        <div class="user-card">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div class="avatar">AD</div>
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: #ffffff;">Petugas</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <input type="hidden" name="redirect_to" value="admin.login">
                <button type="submit" style="background: none; border: none; color: var(--color-secondary); cursor: pointer;" title="Keluar">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
