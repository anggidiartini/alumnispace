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
    .upload-btn-group {
        display: flex;
        gap: 8px;
        margin-top: 6px;
    }
    .btn-action-upload {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #334155;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 10px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .btn-action-upload:hover {
        background: #e2e8f0;
        color: #0a4174;
    }
    .preview-photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 12px;
        margin-top: 12px;
    }
    .preview-photo-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #d0e1f0;
        background: #f8fafc;
        aspect-ratio: 1;
    }
    .preview-photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

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
                <textarea name="description" class="form-control" rows="4" placeholder="Tuliskan cerita singkat atau dokumentasi agenda album...">{{ old('description', $album->description ?? '') }}</textarea>
            </div>

            <!-- DOKUMENTASI FOTO ISI ALBUM -->
            <div style="margin-top: 24px; padding-top: 18px; border-top: 1px solid #d0e1f0;">
                <div style="margin-bottom: 8px;">
                    <label class="form-label" style="margin: 0; font-size: 13px;">
                        <i class="fa-regular fa-images" style="margin-right: 4px;"></i> Foto Dokumentasi Kegiatan (Isi Album)
                    </label>
                </div>
                <p style="font-size: 12px; color: #64748b; margin: 0 0 12px 0;">
                    Unggah kumpulan foto kegiatan dari galeri atau berkas perangkat.
                </p>

                <div>
                    <label for="photosGalleryInput" class="btn-action-upload" style="display: inline-flex; width: auto; padding: 9px 18px; cursor: pointer;">
                        <i class="fa-regular fa-folder-open"></i> Pilih Foto dari Galeri
                    </label>
                </div>

                <!-- Input file untuk galeri (multiple) -->
                <input type="file" id="photosGalleryInput" name="photos[]" multiple class="form-control" accept="image/*,image/heic,image/heif" style="display: none;" onchange="handleMultiplePhotos(this)">

                <div id="photosSelectedSummary" style="margin-top: 8px; font-size: 12px; font-weight: 600; color: #0a4174; display: none;"></div>
                <div id="photosPreviewGrid" class="preview-photos-grid"></div>

                @if(isset($album) && $album->photos->count())
                    <div style="margin-top: 20px;">
                        <label class="form-label" style="font-size: 12px; color: #527597;">Foto yang Sudah Ada di Album Ini (Centang untuk menghapus):</label>
                        <div class="preview-photos-grid">
                            @foreach($album->photos as $p)
                                <div class="preview-photo-item" style="position: relative;">
                                    <img src="{{ asset($p->photo_path) }}" alt="{{ $p->caption ?? 'Foto Album' }}" loading="lazy">
                                    <label style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.65); color: #fff; font-size: 10px; padding: 4px; display: flex; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">
                                        <input type="checkbox" name="delete_photos[]" value="{{ $p->id }}" style="accent-color: #ef4444;">
                                        <span>Hapus</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- KOLOM KANAN: COVER FOTO & STATUS UNGGULAN -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom: 16px; padding-bottom: 8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0;">Foto Sampul & Opsi</h3>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Sampul (Cover / Thumbnail)</label>
                <div class="field-hint" style="margin-bottom: 8px;">Pilih foto dari galeri atau ambil langsung melalui kamera.</div>

                <div class="upload-btn-group">
                    <label for="coverPhotoInput" class="btn-action-upload">
                        <i class="fa-regular fa-folder-open"></i> Galeri
                    </label>
                    <label for="coverCameraInput" class="btn-action-upload">
                        <i class="fa-solid fa-camera"></i> Kamera
                    </label>
                </div>

                <input type="file" id="coverPhotoInput" name="cover_photo" class="form-control" accept="image/*,image/heic,image/heif" style="display: none;" onchange="previewCover(this)">
                <input type="file" id="coverCameraInput" capture="environment" class="form-control" accept="image/*,image/heic,image/heif" style="display: none;" onchange="handleCoverCamera(this)">

                <div style="margin-top: 12px; text-align: center; background: #f8fafc; border: 1px dashed #d0e1f0; border-radius: 8px; padding: 6px; min-height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <img id="coverPreview" 
                         src="{{ (isset($album) && !empty($album->cover_photo)) ? asset($album->cover_photo) : asset('assets/images/no-image.png') }}" 
                         style="max-width: 100%; max-height: 140px; border-radius: 6px; object-fit: {{ (isset($album) && !empty($album->cover_photo)) ? 'cover' : 'contain' }};" 
                         alt="Pratinjau"
                         onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}';">
                    <div id="coverInfoText" style="font-size: 11px; color: #64748b; margin-top: 6px;"></div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 14px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13px; font-weight: 600; color: #0a4174;">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $album->is_featured ?? true)) style="width: 16px; height: 16px; accent-color: #0a4174;">
                    <span>Tampilkan sebagai Album Unggulan</span>
                </label>
            </div>

            <div class="form-group" style="margin-top: 14px;">
                <label class="form-label">Status Album</label>
                <select name="status" class="form-control">
                    <option value="1" @selected(old('status', $album->status ?? 1) == 1)>Aktif</option>
                    <option value="0" @selected(old('status', $album->status ?? 1) == 0)>Tidak Aktif</option>
                </select>
                <div class="field-hint">Album non-aktif tidak akan ditampilkan di halaman publik.</div>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" class="btn-submit">Simpan Album</button>
                <a href="{{ route('admin.albums.index') }}" class="btn-cancel">Batalkan</a>
            </div>
        </div>
    </div>
</form>

<script>
    // Preview Cover Photo
    function previewCover(input) {
        const preview = document.getElementById('coverPreview');
        const info = document.getElementById('coverInfoText');
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const sizeKb = (file.size / 1024).toFixed(1);
            info.textContent = `${file.name} (${sizeKb} KB)`;
            
            const reader = new FileReader();
            reader.onload = function(e) { 
                preview.src = e.target.result;
                preview.style.objectFit = 'cover';
            }
            reader.readAsDataURL(file);
        }
    }

    // Handle Camera Cover Photo
    function handleCoverCamera(input) {
        if (input.files && input.files[0]) {
            const fileInput = document.getElementById('coverPhotoInput');
            fileInput.files = input.files;
            previewCover(fileInput);
        }
    }

    // Accumulate selected photos
    let selectedPhotosDataTransfer = new DataTransfer();

    function renderPhotosPreview() {
        const grid = document.getElementById('photosPreviewGrid');
        const summary = document.getElementById('photosSelectedSummary');
        grid.innerHTML = '';

        const files = selectedPhotosDataTransfer.files;
        if (files.length > 0) {
            summary.style.display = 'block';
            summary.textContent = `${files.length} foto baru dipilih:`;
        } else {
            summary.style.display = 'none';
        }

        Array.from(files).forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'preview-photo-item';
            
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            item.appendChild(img);

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.innerHTML = '&times;';
            removeBtn.style.cssText = 'position: absolute; top: 4px; right: 4px; background: rgba(239, 68, 68, 0.85); color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; font-size: 14px; line-height: 18px; text-align: center;';
            removeBtn.title = 'Hapus foto ini';
            removeBtn.onclick = function() {
                removePhotoAt(index);
            };
            item.appendChild(removeBtn);

            grid.appendChild(item);
        });

        // Sync to the form input
        document.getElementById('photosGalleryInput').files = selectedPhotosDataTransfer.files;
    }

    function removePhotoAt(indexToRemove) {
        const newDt = new DataTransfer();
        Array.from(selectedPhotosDataTransfer.files).forEach((file, idx) => {
            if (idx !== indexToRemove) {
                newDt.items.add(file);
            }
        });
        selectedPhotosDataTransfer = newDt;
        renderPhotosPreview();
    }

    function handleMultiplePhotos(input) {
        if (input.files) {
            Array.from(input.files).forEach(file => {
                selectedPhotosDataTransfer.items.add(file);
            });
            renderPhotosPreview();
        }
    }
</script>
@endsection