@php
    $sidebarIcons = [
        'dashboard' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 13.5h7V20H4zm9-9h7v6.5h-7zm0 9h7V20h-7zM4 4h7v6.5H4z" fill="currentColor"/></svg>',
        'alumnis' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 18.5V9.5h2.2v9h11.6v-9H19v9a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm2.8-12.5h8.4L12 3zm1.2 4.3h6v1.8h-6zm0 3.2h6v1.8h-6z" fill="currentColor"/></svg>',
        'job_vacancies' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 4h6a2 2 0 0 1 2 2v1h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h2V6a2 2 0 0 1 2-2zm0 3h6V6H9zm-1 5h8v2H8zm0 4h8v2H8z" fill="currentColor"/></svg>',
        'articles' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 5.5A2.5 2.5 0 0 1 7.5 3h9A2.5 2.5 0 0 1 19 5.5v13A2.5 2.5 0 0 1 16.5 21h-9A2.5 2.5 0 0 1 5 18.5zm2.5-.5a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5zm1.5 3h6v2H9zm0 4h6v2H9zm0 4h4v2H9z" fill="currentColor"/></svg>',
        'event' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a7 7 0 0 1 7 7c0 4.9-7 13-7 13S5 13.9 5 9a7 7 0 0 1 7-7zm0 9.5A2.5 2.5 0 1 0 12 6a2.5 2.5 0 0 0 0 5.5z" fill="currentColor"/></svg>',
        'albums' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v11A2.5 2.5 0 0 1 17.5 20h-11A2.5 2.5 0 0 1 4 17.5zm5.5 2.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm9.5 9.5l-3.7-4.2L12 16l-1.8-2.2-3.2 4.2z" fill="currentColor"/></svg>',
        'galleries' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3h11A2.5 2.5 0 0 1 20 5.5v13A2.5 2.5 0 0 1 17.5 21h-11A2.5 2.5 0 0 1 4 18.5zm12.5 4.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM7 15.5l3.2-4.3 2.2 3 2.2-2.7 3.4 4z" fill="currentColor"/></svg>',
        'contents' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3.5A2.5 2.5 0 0 0 3.5 6v12A2.5 2.5 0 0 0 6 20.5h12A2.5 2.5 0 0 0 20.5 18V6A2.5 2.5 0 0 0 18 3.5zm0 3h12v2H6zm0 4h12v2H6zm0 4h8v2H6z" fill="currentColor"/></svg>',
        'logout' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 4h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-8v-2h8V6h-8zm-1 4.5L4.5 12 9 15.5v-2.5h6V11h-6z" fill="currentColor"/></svg>'
    ];

    $sidebarItems = [
        ['key' => 'alumnis', 'title' => 'Data Alumni', 'color' => '#7bbde8'],
        ['key' => 'job_vacancies', 'title' => 'Lowongan Kerja', 'color' => '#7bbde8'],
        ['key' => 'articles', 'title' => 'Artikel & Berita', 'color' => '#7bbde8'],
        ['key' => 'event', 'title' => 'Acara & Agenda', 'color' => '#7bbde8'],
        ['key' => 'albums', 'title' => 'Album Foto', 'color' => '#7bbde8'],
        ['key' => 'galleries', 'title' => 'Galeri Foto', 'color' => '#7bbde8'],
        ['key' => 'contents', 'title' => 'Konten Teks Halaman', 'color' => '#7bbde8'],
    ];
@endphp

<aside class="sidebar">
    <div class="sidebar-header">
        <a href="/admin/dashboard" class="brand-logo">
            <div class="brand-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="brand-text">
                <h1>AlumniSpace</h1>
                <p>Admin Panel</p>
            </div>
        </a>
    </div>

    <div class="sidebar-menu">
        <a href="/admin/dashboard" class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <div class="nav-item-content">
                <span class="nav-icon">{!! $sidebarIcons['dashboard'] !!}</span>
                <span>Dashboard</span>
            </div>
        </a>

        @foreach ($sidebarItems as $item)
            @php
                $isActive = request()->is('admin/table/' . $item['key']) || (request()->is('admin/content') && $item['key'] === 'contents');
                $countValue = $counts[$item['key']] ?? 0;
            @endphp

            <a href="{{ $item['key'] === 'contents' ? route('admin.content.index') : url('admin/table/' . $item['key']) }}"
               class="nav-item {{ $isActive ? 'active' : '' }} {{ $item['key'] === 'contents' ? 'nav-item-special' : '' }}">
                <div class="nav-item-content">
                    <span class="nav-icon">{!! $sidebarIcons[$item['key']] ?? '' !!}</span>
                    <span>{{ $item['title'] }}</span>
                </div>

                @if($item['key'] !== 'contents')
                    <span class="badge">{{ $countValue }}</span>
                @endif
            </a>
        @endforeach
    </div>

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
                    {!! $sidebarIcons['logout'] !!}
                </button>
            </form>
        </div>
    </div>
</aside>
