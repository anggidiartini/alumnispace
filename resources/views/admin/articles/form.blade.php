@extends('admin.layout.index')

@section('page_title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')

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
    
    /* Editor Toolbar */
    .editor-wrapper {
        border: 1.5px solid #d0e1f0;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }
    .editor-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 10px 12px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .editor-btn {
        background: #fff;
        border: 1px solid #d0e1f0;
        color: #0a4174;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .editor-btn:hover {
        background: #0a4174;
        color: #fff;
        border-color: #0a4174;
    }
    .editor-content {
        min-height: 280px;
        padding: 16px;
        line-height: 1.8;
        font-size: 14px;
        color: #1e293b;
        outline: none;
    }

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

<form action="{{ isset($article) ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
    @csrf
    @if(isset($article))
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
        <!-- KOLOM KIRI: KONTEN UTAMA ARTIKEL -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">
                    {{ isset($article) ? 'Sunting Artikel & Berita' : 'Tulis Artikel & Berita Baru' }}
                </h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Lengkapi judul, kategori, ringkasan, dan teks lengkap isi artikel.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Judul Artikel <span class="required-star">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $article->title ?? '') }}" placeholder="Masukkan judul artikel yang menarik..." required>
            </div>

            <div class="form-group">
                <label class="form-label">Kategori <span class="required-star">*</span></label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $article->category ?? 'Seputar Alumni') }}" placeholder="Contoh: Berita Kampus, Kisah Sukses, Tips Karir..." required>
            </div>

            <div class="form-group">
                <label class="form-label">Ringkasan / Excerpt</label>
                <textarea name="excerpt" rows="3" class="form-control" placeholder="Tuliskan 1-2 kalimat ringkasan yang akan muncul pada kartu berita di beranda...">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                <div class="field-hint">Opsional. Jika dikosongkan, sistem akan memotong 150 karakter pertama dari naskah.</div>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Lengkap Artikel <span class="required-star">*</span></label>
                <div class="editor-wrapper">
                    <div class="editor-toolbar">
                        <button type="button" class="editor-btn" onclick="execCmd('bold')"><i class="fa-solid fa-bold"></i> Tebal</button>
                        <button type="button" class="editor-btn" onclick="execCmd('italic')"><i class="fa-solid fa-italic"></i> Miring</button>
                        <button type="button" class="editor-btn" onclick="execCmd('formatBlock', 'h2')">Heading 2</button>
                        <button type="button" class="editor-btn" onclick="execCmd('formatBlock', 'h3')">Heading 3</button>
                        <button type="button" class="editor-btn" onclick="execCmd('insertUnorderedList')"><i class="fa-solid fa-list-ul"></i> Daftar</button>
                        <button type="button" class="editor-btn" onclick="insertLink()"><i class="fa-solid fa-link"></i> Link</button>
                    </div>
                    <div id="articleEditor" class="editor-content" contenteditable="true">{!! old('content', $article->content ?? '') !!}</div>
                </div>
                <input type="hidden" name="content" id="articleContent">
            </div>
        </div>

        <!-- KOLOM KANAN: THUMBNAIL & STATUS PUBLIKASI -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom: 16px; padding-bottom: 8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0;">Media & Publikasi</h3>
            </div>

            <div class="form-group">
                <label class="form-label">Thumbnail Foto</label>
                <input type="file" name="thumbnail" class="form-control" accept="image/jpeg,image/png,image/jpg" onchange="previewThumbnail(this)">
                <div class="field-hint">Format: JPG, JPEG, PNG (Maks 500KB)</div>
                <div style="margin-top: 10px; text-align: center; background: #f8fafc; border: 1px dashed #d0e1f0; border-radius: 8px; padding: 6px; min-height: 120px; display: flex; align-items: center; justify-content: center;">
                    <img id="thumbPreview" 
                         src="{{ (isset($article) && !empty($article->thumbnail)) ? asset($article->thumbnail) : asset('assets/images/no-image.png') }}" 
                         style="max-width: 100%; max-height: 140px; border-radius: 6px; object-fit: {{ (isset($article) && !empty($article->thumbnail)) ? 'cover' : 'contain' }};" 
                         alt="Pratinjau"
                         onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}';">
                </div>
            </div>

            <div class="form-group" style="margin-top: 14px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13px; font-weight: 600; color: #0a4174;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published ?? true) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #0a4174;">
                    <span>Terbitkan Artikel</span>
                </label>
                <div class="field-hint">Jika tidak dicentang, artikel akan tersimpan sebagai draf internal.</div>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" class="btn-submit">Simpan Artikel</button>
                <a href="{{ route('admin.articles.index') }}" class="btn-cancel">Batalkan</a>
            </div>
        </div>
    </div>
</form>

<script>
    function previewThumbnail(input) {
        const preview = document.getElementById('thumbPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { 
                preview.src = e.target.result;
                preview.style.objectFit = 'cover';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function execCmd(command, value = null) {
        document.execCommand(command, false, value);
        document.getElementById('articleEditor').focus();
    }

    function insertLink() {
        const url = prompt('Masukkan tautan URL web:');
        if (url) {
            execCmd('createLink', url);
        }
    }

    document.getElementById('articleForm').addEventListener('submit', function () {
        const editor = document.getElementById('articleEditor');
        document.getElementById('articleContent').value = editor.innerHTML;
    });
</script>
@endsection