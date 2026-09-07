<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil {{ $companyProfile->company_name }} | Alumni Space Career Hub</title>
    
    <link href="https://googleapis.com" rel="stylesheet">
    <script src="https://jsdelivr.net" defer></script>
    
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lowongan.css') }}">
</head>
<body>
    <div class="page-wrap">
        <x-navbar-inner/>

        <main style="padding: 2rem 0;">
            <div class="page-width">
                {{-- Detail Info Perusahaan --}}
                <div class="grid-paper" style="padding: 2rem; margin-bottom: 2rem; position: relative; overflow: hidden;">
                    <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;">
                        <div class="company-avatar" style="width: 80px; height: 80px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 2rem; font-weight: bold; color: #4a5568;">
                            @if(!empty($companyProfile->company_logo))
                                <img src="{{ $companyProfile->company_logo }}" alt="Logo {{ $companyProfile->company_name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                            @else
                                {{ $companyProfile->initials }}
                            @endif
                        </div>
                        <div>
                            <h1 style="margin: 0; font-size: 2rem; font-family: 'Fredoka', sans-serif; color: var(--ink);">{{ $companyProfile->company_name }}</h1>
                            <p style="margin: 0.2rem 0 0; color: #4a5568; font-weight: 500;">Kategori: {{ $companyProfile->category ?? '-' }}</p>
                        </div>
                    </div>

                    <p style="color: #2d3748; line-height: 1.6; margin-bottom: 1.5rem;">
                        {{ $companyProfile->company_description ?? 'Belum ada deskripsi profil untuk perusahaan ini.' }}
                    </p>

                    {{-- Link Sosial Media Perusahaan --}}
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        @if(!empty($companyProfile->company_maps_url))
                            <a href="{{ $companyProfile->company_maps_url }}" target="_blank" rel="noopener" class="custom-white-pill-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="map-pin" width="16" height="16"></i> Google Maps
                            </a>
                        @endif
                        @if(!empty($companyProfile->company_website))
                            <a href="{{ $companyProfile->company_website }}" target="_blank" rel="noopener" class="custom-white-pill-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="globe" width="16" height="16"></i> Website
                            </a>
                        @endif
                        @if(!empty($companyProfile->company_instagram))
                            <a href="{{ $companyProfile->company_instagram }}" target="_blank" rel="noopener" class="custom-white-pill-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="instagram" width="16" height="16"></i> Instagram
                            </a>
                        @endif
                        @if(!empty($companyProfile->company_linkedin))
                            <a href="{{ $companyProfile->company_linkedin }}" target="_blank" rel="noopener" class="custom-white-pill-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i data-lucide="linkedin" width="16" height="16"></i> LinkedIn
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Bagian Daftar Lowongan dari Perusahaan Ini --}}
                <h2 style="font-family: 'Fredoka', sans-serif; margin-bottom: 1.5rem; color: var(--ink);">Lowongan Aktif di {{ $companyProfile->company_name }} ({{ $jobs->count() }})</h2>
                
                <div class="jobs-grid">
                    @forelse ($jobs as $job)
                        <article class="job-card">
                            <div class="job-card-head">
                                <span class="job-badge">{{ $job->category }}</span><span class="job-symbol">✳</span>
                            </div>
                            <a class="job-title-link" href="{{ route('lowongan.show', $job->slug) }}">{{ $job->title }}</a>
                            <p class="job-meta">{{ $job->location }} · {{ $job->job_type }} · {{ $job->created_at->diffForHumans() }}</p>
                            <p class="job-description">{{ \Illuminate\Support\Str::limit($job->description, 120) }}</p>
                            <a class="apply-button custom-pill-btn" href="{{ route('lowongan.show', $job->slug) }}">Lihat Detail</a>
                        </article>
                    @empty
                        <div style="grid-column: 1/-1; text-align: center; padding: 3rem; background: #fff; border-radius: 16px; border: 2px dashed #cbd5e1;">
                            <p style="color: #4a5568; margin: 0;">Saat ini tidak ada lowongan aktif lain dari perusahaan ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>

        <x-footer-inner/>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            lucide.createIcons();
        });
    </script>
</body>
</html>
