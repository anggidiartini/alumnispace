@extends('admin.layout.index')

@section('title', isset($row) ? 'Sunting Artikel' : 'Tulis Artikel Baru')

@section('content')
<style>
    /* TATA LETAK DUA KOLOM GRID ASIMETRIS KANAN KIRI */
    .article-layout-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }
    
    .main-content-card {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
    }
    
    .sidebar-settings-card {
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
        padding: 10px 14px;
        border: 1px solid #d0e1f0;
        border-radius: 8px;
        background: #f4f8fb;
        color: #0a4174;
        font-family: inherit;
        font-size: 14px;
        outline: none;
    }
    .form-control:focus {
        border-color: #7bbde8;
        background: #fff;
    }

    /* KUSTOMISASI ANTARMUKA TEKS EDITOR MINIMALIS */
    .custom-editor-container {
        border: 1px solid #d0e1f0;
        border-radius: 12px;
        background: #ffffff;
        overflow: hidden;
    }
    
    .editor-toolbar {
        background-color: #f5f3ef;
        padding: 10px 14px;
        border-bottom: 1px solid #d0e1f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .toolbar-buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }
    
    .toolbar-buttons button {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 6px;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 500;
        color: #333333;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .toolbar-buttons button:hover {
        background: #0a4174;
        color: #ffffff;
        border-color: #0a4174;
    }
    
    .editor-content-area {
        min-height: 400px;
        padding: 24px;
        color: #1e293b;
        font-family: 'Inter', sans-serif;
        font-size: 15px;
        line-height: 1.8;
        outline: none;
    }
    .editor-content-area blockquote {
        border-left: 4px solid #7bbde8;
        padding-left: 16px;
        font-style: italic;
        color: #527597;
        margin: 12px 0;
    }

    .form-actions {
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #d0e1f0;
        display: flex;
        flex-direction: column;
        gap: 10px;
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
        text-align: center;
        width: 100%;
    }
    
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
        width: 100%;
    }

    @media (max-width: 992px) {
        .article-layout-grid { grid-template-columns: 1fr; }
        .sidebar-settings-card { position: static; }
    }
</style>
<form id="articleForm" action="{{ isset($row) ? route('admin.table.update', ['articles', $row->id]) : route('admin.table.store', 'articles') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($row))
        @method('PUT')
    @endif

    <div class="article-layout-grid">
        
        <!-- ================= KOLOM KIRI: EDITOR KONTEN UTAMA ================= -->
        <div class="main-content-card">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174;">Konten Artikel</h2>
                <p style="font-size: 12px; color: #527597;">Tulis teks informasi utama berita pada lembar kerja di bawah ini.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Judul Berita <span style="color:red;">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $row->title ?? '') }}" required placeholder="Masukkan judul utama berita...">
            </div>

            <div class="form-group">
                <label class="form-label">Kutipan / Ringkasan Awal <span style="color:red;">*</span></label>
                <textarea name="excerpt" rows="2" class="form-control" required placeholder="Tulis deskripsi ringkas pembuka isi artikel...">{{ old('excerpt', $row->excerpt ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Artikel <span style="color:red;">*</span></label>
                <div class="custom-editor-container">
                    <div class="editor-toolbar">
                        <div class="toolbar-buttons">
                            <button type="button" onclick="executeCmd('formatBlock', 'p')">Paragraf</button>
                            <button type="button" onclick="executeCmd('formatBlock', 'h2')">H2</button>
                            <button type="button" onclick="executeCmd('formatBlock', 'h3')">H3</button>
                            <button type="button" onclick="executeCmd('bold')"><b>B</b></button>
                            <button type="button" onclick="executeCmd('italic')"><i>I</i></button>
                            <button type="button" onclick="executeCmd('insertUnorderedList')">• List</button>
                            <button type="button" onclick="executeCmd('insertOrderedList')">1. List</button>
                            <button type="button" onclick="executeCmd('formatBlock', 'blockquote')">Quote</button>
                            <button type="button" onclick="insertLinkUrl()">Link</button>
                            <button type="button" onclick="insertLocalImage()">Foto</button>
                            <button type="button" onclick="executeCmd('removeFormat')">Bersihkan</button>
                        </div>
                        <div class="editor-stats" style="font-size:11px;">
                            <span id="textWords">0</span> kata
                        </div>
                    </div>
                    
                    <div id="textEditorArea" class="editor-content-area" contenteditable="true" oninput="updateWordCount()">{!! old('content', $row->content ?? '') !!}</div>
                </div>
                <input type="hidden" name="content" id="finalHTMLContent">
            </div>
        </div>

        <!-- ================= KOLOM KANAN: MEDIA & STATUS PENERBITAN ================= -->
        <div class="sidebar-settings-card">
            <div class="form-header" style="margin-bottom:16px; padding-bottom:8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174;">Media & Status</h3>
            </div>

            <div class="form-group">
                <label class="form-label">Kategori Berita <span style="color:red;">*</span></label>
                <select name="category" class="form-control" required>
                    <option value="Sekolah" {{ (old('category', $row->category ?? '') == 'Sekolah') ? 'selected' : '' }}>Sekolah</option>
                    <option value="Karier" {{ (old('category', $row->category ?? '') == 'Karier') ? 'selected' : '' }}>Karier</option>
                    <option value="Reuni" {{ (old('category', $row->category ?? '') == 'Reuni') ? 'selected' : '' }}>Reuni</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Cover Artikel / Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control" accept="image/*" onchange="previewFile(this)">
                <div style="margin-top: 10px; text-align: center;">
                    <img id="thumb-preview" src="{{ (isset($row->thumbnail) && !empty($row->thumbnail)) ? (Str::startsWith($row->thumbnail, 'http') ? $row->thumbnail : asset($row->thumbnail)) : asset('assets/images/no-image.png') }}" style="width: 100%; max-height: 140px; border-radius: 6px; object-fit: cover; border: 1px solid #d0e1f0;" alt="Pratinjau">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status Penerbitan</label>
                <select name="is_published" class="form-control">
                    <option value="1" {{ (old('is_published', $row->is_published ?? 1) == 1) ? 'selected' : '' }}>Diterbitkan</option>
                    <option value="0" {{ (old('is_published', $row->is_published ?? 1) == 0) ? 'selected' : '' }}>Simpan Draf</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan Artikel</button>
                <a href="{{ route('admin.table.index', 'articles') }}" class="btn-cancel" onclick="return confirm('Apakah Anda yakin ingin membatalkan? Perubahan yang belum disimpan akan hilang.');">Batalkan</a>
            </div>
        </div>

    </div>
</form>

<script>
    function executeCmd(command, value = null) {
        document.execCommand(command, false, value);
        document.getElementById('textEditorArea').focus();
        updateWordCount();
    }

    function insertLinkUrl() {
        const url = prompt("Masukkan alamat URL tautan:");
        if (url) { executeCmd('createLink', url); }
    }

    function insertLocalImage() {
        const imageUrl = prompt("Masukkan URL gambar:");
        if (imageUrl) { executeCmd('insertImage', imageUrl); }
    }

    function updateWordCount() {
        const text = document.getElementById('textEditorArea').innerText.trim();
        const words = text ? text.split(/\s+/).length : 0;
        document.getElementById('textWords').innerText = words;
    }

    const form = document.getElementById('articleForm');
    form.addEventListener('submit', function(e) {
        const editorArea = document.getElementById('textEditorArea');
        const hiddenInput = document.getElementById('finalHTMLContent');
        hiddenInput.value = editorArea.innerHTML;
        
        if (editorArea.innerText.trim().length === 0) {
            e.preventDefault();
            alert('Isi artikel utama wajib diisi!');
        }
    });

    window.addEventListener('DOMContentLoaded', () => { 
        updateWordCount(); 
    });

    function previewFile(input) {
        const preview = document.getElementById('thumb-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { preview.src = e.target.result; }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
