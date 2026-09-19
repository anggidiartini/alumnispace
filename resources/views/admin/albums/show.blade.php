@extends('admin.layout.index')

@section('title', 'Detail Album — ' . $album->title)

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
    @media (max-width: 992px) {
        .detail-layout-grid { grid-template-columns: 1fr; }
        .detail-card-sidebar { position: static; }
    }
</style>

<div class="detail-layout-grid">
    <!-- KOLOM KIRI: DATA UTAMA ALBUM -->
    <div class="detail-card-main">
        <div class="detail-header">
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">Detail Album Galeri</h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Rincian data koleksi album foto dokumentasi alumni.</p>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="background-color: {{ $album->status ? 'rgba(16, 185, 129, 0.15)' : 'rgba(239, 68, 68, 0.15)' }}; color: {{ $album->status ? '#065f46' : '#991b1b' }}; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px;">
                    <i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $album->status ? 'Aktif' : 'Tidak Aktif' }}
                </span>
                <span style="background-color: #eff6ff; color: #1d4ed8; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid #bfdbfe;">
                    <i class="fa-regular fa-images"></i> {{ $album->photos_count }} Foto
                </span>
            </div>
        </div>

        <div class="info-group">
            <span class="info-label">Nama Album</span>
            <div class="info-value" style="font-size: 18px; font-weight: 800; color: #0a4174;">{{ $album->title }}</div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Kategori</span>
                <div class="info-value"><strong>{{ ucfirst($album->category) }}</strong></div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Target Angkatan</span>
                <div class="info-value">{{ $album->target_generation ?? 'Semua Angkatan' }}</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Tanggal Pelaksanaan</span>
                <div class="info-value">
                    {{ $album->event_date ? \Carbon\Carbon::parse($album->event_date)->locale('id')->translatedFormat('d F Y') : ($album->date_display ?? '-') }}
                </div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Lokasi Kegiatan</span>
                <div class="info-value">{{ $album->location ?? '-' }}</div>
            </div>
        </div>

        @if(!empty($album->subtitle_label) || !empty($album->sticker_tag))
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
                @if(!empty($album->subtitle_label))
                    <div class="info-group" style="margin-bottom: 0;">
                        <span class="info-label">Label Subtitle</span>
                        <div class="info-value">{{ $album->subtitle_label }}</div>
                    </div>
                @endif
                @if(!empty($album->sticker_tag))
                    <div class="info-group" style="margin-bottom: 0;">
                        <span class="info-label">Sticker Tag</span>
                        <div class="info-value">{{ $album->sticker_tag }}</div>
                    </div>
                @endif
            </div>
        @endif

        <div class="info-group">
            <span class="info-label">Deskripsi Album</span>
            <div class="info-value" style="white-space: pre-line; line-height: 1.7;">{{ $album->description ?? 'Tidak ada deskripsi tambahan.' }}</div>
        </div>
    </div>

    <!-- KOLOM KANAN: COVER FOTO & AKSI PENGELOLA -->
    <div class="detail-card-sidebar">
        <span class="info-label">Foto Sampul (Cover)</span>
        @if(!empty($album->cover_photo))
            <img src="{{ asset($album->cover_photo) }}" class="img-sidebar-preview" alt="{{ $album->title }}" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'80\' height=\'80\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2394a3b8\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'9\' cy=\'9\' r=\'2\'/><path d=\'m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21\'/></svg>';">
        @else
            <div style="background: #f4f8fb; border: 1px dashed #d0e1f0; padding: 30px 20px; text-align: center; border-radius: 10px; font-size: 12px; color: #527597; margin-bottom: 16px;">
                <i class="fa-regular fa-image" style="font-size: 32px; color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                Tidak ada foto sampul.
            </div>
        @endif

        <span class="info-label" style="margin-top: 10px;">Aksi Pengelola</span>
        <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn-edit-direct">
            <i class="fa-solid fa-pen-to-square"></i> Sunting Album
        </a>
        <a href="{{ route('admin.albums.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection