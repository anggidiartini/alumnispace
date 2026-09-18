@extends('admin.layout.index')

@section('page_title', isset($album) ? 'Edit Album' : 'Tambah Album')

@section('content')
<style>
    .form-layout-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }
    .form-card-main {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
    }
    .form-card-sidebar {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
        position: sticky;
        top: 24px;
    }
    .form-header {
        margin-bottom: 24px;
        border-bottom: 1px solid #d0e1f0;
        padding-bottom: 16px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 18px;
    }
    .form-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #0a4174;
        letter-spacing: 0.5px;
    }
    .form-control {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #d0e1f0;
        border-radius: 8px;
        background: #f4f8fb;
        color: #0a4174;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #2563eb;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .field-hint { font-size: 11px; color: #64748b; margin-top: 2px; }
    .required-star { color: #ef4444; margin-left: 2px; }
    .btn-submit {
        background: #0a4174;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        font-size: 13px;
        width: 100%;
        transition: background 0.15s ease;
    }
    .btn-submit:hover { background: #08335c; }
    .btn-cancel {
        background: transparent;
        color: #527597;
        border: 1px solid #d0e1f0;
        padding: 10px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        text-align: center;
        display: block;
        width: 100%;
        margin-top: 10px;
        transition: all 0.15s ease;
    }
    .btn-cancel:hover { background: #f8fafc; color: #0a4174; }
    @media (max-width: 992px) {
        .form-layout-grid { grid-template-columns: 1fr; }
        .form-card-sidebar { position: static; }
    }
</style>

<form action="{{ isset($album) ? route('admin.albums.update', $album->id) : route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($album))
        @method('PUT')
    @endif

    @if(session('error') || (isset($errors) && $errors->any()))
        <div style="padding: 14px 18px; border-radius: 10px; background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation" style="margin-top: 3px; font-size: 16px;"></i>
            <div>
                @if(session('error'))
                    <div>{{ session('error') }}</div>
                @endif
                @if(isset($errors) && $errors->any())
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif

    <div class="form-layout-grid">
        <!-- KOLOM KIRI: DATA UTAMA ALBUM -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">
                    {{ isset($album) ? 'Sunting Album Galeri' : 'Buat Album Galeri Baru' }}
                </h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Lengkapi identitas album, target angkatan, tanggal, dan informasi kegiatan.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Album <span class="required-star">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $album->title ?? '') }}" placeholder="Contoh: Class Trip 2026..." required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Jenis Kegiatan (Kategori) <span class="required-star">*</span></label>
                    <select name="category" class="form-control" required>
                        <option value="outdoor" @selected(old('category', $album->category ?? 'outdoor') === 'outdoor')>Outdoor</option>
                        <option value="indoor" @selected(old('category', $album->category ?? '') === 'indoor')>Indoor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Target Angkatan</label>
                    <input type="text" name="target_generation" class="form-control" value="{{ old('target_generation', $album->target_generation ?? '') }}" placeholder="Contoh: Angkatan 2020 / Semua Angkatan">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Label Subtitle</label>
                    <input type="text" name="subtitle_label" class="form-control" value="{{ old('subtitle_label', $album->subtitle_label ?? '') }}" placeholder="Contoh: Reuni Akbar 5 Tahunan">
                </div>
                <div class="form-group">
                    <label class="form-label">Sticker Tag</label>
                    <input type="text" name="sticker_tag" class="form-control" value="{{ old('sticker_tag', $album->sticker_tag ?? '') }}" placeholder="Contoh: Best Moments">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Tanggal Pelaksanaan</label>
                    <input type="date" name="event_date" class="form-control" value="{{ old('event_date', isset($album) && $album->event_date ? $album->event_date->format('Y-m-d') : '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Tampilan Tanggal (Opsional)</label>
                    <input type="text" name="date_display" class="form-control" value="{{ old('date_display', $album->date_display ?? '') }}" placeholder="Contoh: 15-18 Agustus 2026">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Lokasi Kegiatan</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $album->location ?? '') }}" placeholder="Contoh: Villa Puncak, Bogor / Gedung Serbaguna">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Album</label>
                <textarea name="description" class="form-control" rows="6" placeholder="Tuliskan cerita singkat atau dokumentasi agenda album...">{{ old('description', $album->description ?? '') }}</textarea>
            </div>
        </div>

        <!-- KOLOM KANAN: COVER FOTO & STATUS UNGGULAN -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom: 16px; padding-bottom: 8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0;">Foto Sampul & Opsi</h3>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Sampul (Cover)</label>
                <input type="file" name="cover_photo" class="form-control" accept="image/jpeg,image/png,image/jpg" onchange="previewCover(this)">
                <div class="field-hint">Format: JPG, JPEG, PNG (Maks 500KB)</div>
                <div style="margin-top: 10px; text-align: center;">
                    <img id="coverPreview" src="{{ (isset($album) && !empty($album->cover_photo)) ? asset($album->cover_photo) : 'data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'80\' height=\'60\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%23cbd5e1\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'9\' cy=\'9\' r=\'2\'/><path d=\'m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21\'/></svg>' }}" style="width: 100%; max-height: 140px; border-radius: 8px; object-fit: cover; border: 1px solid #d0e1f0; background: #f8fafc;" alt="Pratinjau">
                </div>
            </div>

            <div class="form-group" style="margin-top: 14px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13px; font-weight: 600; color: #0a4174;">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $album->is_featured ?? true)) style="width: 16px; height: 16px; accent-color: #0a4174;">
                    <span>Tampilkan sebagai Album Unggulan</span>
                </label>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" class="btn-submit">Simpan Album</button>
                <a href="{{ route('admin.albums.index') }}" class="btn-cancel">Batalkan</a>
            </div>
        </div>
    </div>
</form>

<script>
    function previewCover(input) {
        const preview = document.getElementById('coverPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { preview.src = e.target.result; }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection