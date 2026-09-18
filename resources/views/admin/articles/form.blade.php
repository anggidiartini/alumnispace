@extends('admin.layout.index')

@section('page_title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')

@section('content')
<form action="{{ isset($article) ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" style="max-width:900px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;">
    @csrf
    @if(isset($article)) @method('PUT') @endif

    @if($errors->any())
        <div style="margin-bottom:18px;color:#991b1b;">{{ $errors->first() }}</div>
    @endif

    <label style="display:block;margin-bottom:6px;font-weight:700;">Judul</label>
    <input name="title" value="{{ old('title', $article->title ?? '') }}" required style="width:100%;padding:10px;margin-bottom:16px;border:1px solid var(--border-color);border-radius:8px;">

    <label style="display:block;margin-bottom:6px;font-weight:700;">Kategori</label>
    <input name="category" value="{{ old('category', $article->category ?? 'Sekolah') }}" required style="width:100%;padding:10px;margin-bottom:16px;border:1px solid var(--border-color);border-radius:8px;">

    <label style="display:block;margin-bottom:6px;font-weight:700;">Ringkasan</label>
    <textarea name="excerpt" rows="3" style="width:100%;padding:10px;margin-bottom:16px;border:1px solid var(--border-color);border-radius:8px;">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>

    <label style="display:block;margin-bottom:6px;font-weight:700;">Isi Artikel</label>
    <div style="border:1px solid var(--border-color);border-radius:8px;margin-bottom:16px;overflow:hidden;">
        <div style="display:flex;flex-wrap:wrap;gap:6px;padding:8px;background:var(--bg-main);">
            <button type="button" onclick="executeArticleCommand('bold')">B</button>
            <button type="button" onclick="executeArticleCommand('italic')">I</button>
            <button type="button" onclick="executeArticleCommand('formatBlock', 'h2')">H2</button>
            <button type="button" onclick="executeArticleCommand('insertUnorderedList')">List</button>
            <button type="button" onclick="insertArticleLink()">Link</button>
        </div>
        <div id="articleEditor" contenteditable="true" style="min-height:280px;padding:14px;line-height:1.7;outline:none;">{!! old('content', $article->content ?? '') !!}</div>
    </div>
    <input type="hidden" name="content" id="articleContent">

    <label style="display:block;margin-bottom:6px;font-weight:700;">Thumbnail</label>
    <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/jpg" style="margin-bottom:16px;">

    <label style="display:block;margin-bottom:20px;"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published ?? true) ? 'checked' : '' }}> Terbitkan artikel</label>

    <button type="submit" style="padding:10px 16px;border:0;border-radius:8px;background:var(--color-primary);color:#fff;cursor:pointer;">Simpan</button>
    <a href="{{ route('admin.articles.index') }}" style="margin-left:12px;">Batal</a>
</form>

<script>
    function executeArticleCommand(command, value = null) {
        document.execCommand(command, false, value);
        document.getElementById('articleEditor').focus();
    }

    function insertArticleLink() {
        const url = prompt('Masukkan alamat URL tautan:');
        if (url) executeArticleCommand('createLink', url);
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        const editor = document.getElementById('articleEditor');
        const content = document.getElementById('articleContent');
        content.value = editor.innerHTML;

        if (!editor.innerText.trim()) {
            event.preventDefault();
            alert('Isi artikel utama wajib diisi.');
        }
    });
</script>
@endsection