@extends('admin.layout.index')

@section('page_title', isset($album) ? 'Edit Album' : 'Tambah Album')

@section('content')
<form action="{{ isset($album) ? route('admin.albums.update', $album->id) : route('admin.albums.store') }}" method="POST" enctype="multipart/form-data" style="max-width:900px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;">
    @csrf @if(isset($album)) @method('PUT') @endif
    @if($errors->any())<div style="margin-bottom:18px;color:#991b1b;">{{ $errors->first() }}</div>@endif
    <label>Nama Album</label><input name="title" value="{{ old('title', $album->title ?? '') }}" required style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Kategori</label><input name="category" value="{{ old('category', $album->category ?? 'outdoor') }}" required style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Label Sub-Keterangan</label><input name="subtitle_label" value="{{ old('subtitle_label', $album->subtitle_label ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Sticker Tag</label><input name="sticker_tag" value="{{ old('sticker_tag', $album->sticker_tag ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Foto Sampul</label><input type="file" name="cover_photo" accept="image/jpeg,image/png,image/jpg" style="display:block;margin:6px 0 14px;">
    <label>Tanggal Kegiatan</label><input type="date" name="event_date" value="{{ old('event_date', isset($album) && $album->event_date ? $album->event_date->format('Y-m-d') : '') }}" style="padding:10px;margin:6px 0 14px;">
    <label>Tampilan Tanggal</label><input name="date_display" value="{{ old('date_display', $album->date_display ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Lokasi</label><input name="location" value="{{ old('location', $album->location ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Target Angkatan</label><input name="target_generation" value="{{ old('target_generation', $album->target_generation ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Deskripsi</label><textarea name="description" rows="6" style="width:100%;padding:10px;margin:6px 0 14px;">{{ old('description', $album->description ?? '') }}</textarea>
    <label style="display:block;margin-bottom:20px;"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $album->is_featured ?? true))> Tampilkan sebagai album unggulan</label>
    <button type="submit" style="padding:10px 16px;border:0;border-radius:8px;background:var(--color-primary);color:#fff;cursor:pointer;">Simpan</button><a href="{{ route('admin.albums.index') }}" style="margin-left:12px;">Batal</a>
</form>
@endsection