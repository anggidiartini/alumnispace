@extends('admin.layout.index')

@section('title', 'Detail Artikel — ' . $article->title)

@section('content')
<style>
    .detail-layout-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }
    .detail-card-main { 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 16px; 
        padding: 28px; 
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04); 
    }
    .detail-card-sidebar { 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 16px; 
        padding: 20px; 
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04); 
        position: sticky;
        top: 24px;
    }
    .detail-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        border-bottom: 1px solid #d0e1f0; 
        padding-bottom: 16px; 
        margin-bottom: 24px; 
        gap: 12px;
        flex-wrap: wrap;
    }
    .info-group {
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f4f8fb;
    }
    .info-group:last-of-type {
        border-bottom: none;
    }
    .info-label { 
        font-weight: 700; 
        color: #527597; 
        text-transform: uppercase; 
        font-size: 11px; 
        letter-spacing: 0.5px; 
        margin-bottom: 6px;
        display: block;
    }
    .info-value { 
        color: #0a4174; 
        font-weight: 500; 
        font-size: 14px;
        line-height: 1.6; 
    }
    .btn-back { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        gap: 8px; 
        text-decoration: none; 
        padding: 10px; 
        border: 1px solid #d0e1f0; 
        color: #527597; 
        font-size: 13px; 
        font-weight: 600; 
        border-radius: 8px; 
        background: #fff;
        width: 100%;
        margin-top: 10px;
        transition: background 0.15s ease;
    }
    .btn-back:hover { background-color: #f4f8fb; color: #0a4174; }
    .btn-edit-direct { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        gap: 6px; 
        text-decoration: none; 
        padding: 12px; 
        background-color: #0a4174; 
        color: white; 
        font-size: 13px; 
        font-weight: 700; 
        border-radius: 8px; 
        width: 100%;
        transition: background 0.15s ease;
    }
    .btn-edit-direct:hover { background-color: #08335c; color: white; }
    .img-sidebar-preview { 
        width: 100%; 
        max-height: 220px; 
        border-radius: 10px; 
        object-fit: cover; 
        border: 1px solid #d0e1f0; 
        margin-bottom: 16px;
    }
    .article-content-body {
        font-size: 15px;
        line-height: 1.8;
        color: #1e293b;
        margin-top: 12px;
    }
    .article-content-body p { margin-bottom: 14px; }
    .article-content-body h2, .article-content-body h3 { color: #0a4174; margin: 20px 0 10px; }
    .article-content-body ul, .article-content-body ol { margin-left: 20px; margin-bottom: 14px; }
    @media (max-width: 992px) {
        .detail-layout-grid { grid-template-columns: 1fr; }
        .detail-card-sidebar { position: static; }
    }
</style>

<div class="detail-layout-grid">
    <!-- KOLOM KIRI: KONTEN UTAMA ARTIKEL -->
    <div class="detail-card-main">
        <div class="detail-header">
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">Detail Artikel & Berita</h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Pratinjau konten naskah publikasi portal alumni.</p>
            </div>
            <div>
                @if($article->is_published)
                    <span style="background-color: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid #a7f3d0;">
                        <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> Diterbitkan
                    </span>
                @else
                    <span style="background-color: #f1f5f9; color: #475569; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid #e2e8f0;">
                        <i class="fa-regular fa-clock" style="color: #64748b;"></i> Draf
                    </span>
                @endif
            </div>
        </div>

        <div class="info-group">
            <span class="info-label">Judul Artikel</span>
            <div class="info-value" style="font-size: 20px; font-weight: 800; color: #0a4174; line-height: 1.4;">{{ $article->title }}</div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Kategori</span>
                <div class="info-value"><strong>{{ $article->category }}</strong></div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Tanggal Publikasi</span>
                <div class="info-value">
                    {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->locale('id')->translatedFormat('d F Y, H:i') : ($article->created_at ? $article->created_at->locale('id')->translatedFormat('d F Y') : '-') }}
                </div>
            </div>
        </div>

        @if(!empty($article->excerpt))
            <div class="info-group" style="background: #f8fafc; border-radius: 10px; padding: 14px 18px; border: 1px solid #e2e8f0;">
                <span class="info-label" style="color: #0a4174;">Ringkasan / Excerpt</span>
                <div style="font-size: 13px; color: #475569; font-style: italic; line-height: 1.6;">
                    "{{ $article->excerpt }}"
                </div>
            </div>
        @endif

        <div class="info-group" style="margin-top: 14px;">
            <span class="info-label">Isi Lengkap Naskah</span>
            <div class="article-content-body">
                {!! $article->content !!}
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: THUMBNAIL & AKSI PENGELOLA -->
    <div class="detail-card-sidebar">
        <span class="info-label">Thumbnail Foto</span>
        @if(!empty($article->thumbnail))
            <img src="{{ asset($article->thumbnail) }}" class="img-sidebar-preview" alt="{{ $article->title }}" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'80\' height=\'80\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2394a3b8\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'9\' cy=\'9\' r=\'2\'/><path d=\'m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21\'/></svg>';">
        @else
            <div style="background: #f4f8fb; border: 1px dashed #d0e1f0; padding: 30px 20px; text-align: center; border-radius: 10px; font-size: 12px; color: #527597; margin-bottom: 16px;">
                <i class="fa-regular fa-image" style="font-size: 28px; color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                Tidak ada foto thumbnail.
            </div>
        @endif

        <span class="info-label" style="margin-top: 10px;">Aksi Pengelola</span>
        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-edit-direct">
            <i class="fa-solid fa-pen-to-square"></i> Sunting Artikel
        </a>
        <a href="{{ route('admin.articles.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection