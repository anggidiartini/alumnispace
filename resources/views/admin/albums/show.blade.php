@extends('admin.layout.index')

@section('page_title', 'Detail Album')

@section('content')
<article style="max-width:900px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;"><p style="color:var(--text-muted);font-size:13px;">{{ $album->category }} · {{ $album->photos_count }} foto</p><h1 style="margin:10px 0 16px;color:var(--text-main);">{{ $album->title }}</h1>@if($album->cover_photo)<img src="{{ asset($album->cover_photo) }}" alt="{{ $album->title }}" style="max-width:100%;max-height:320px;object-fit:cover;border-radius:8px;margin-bottom:18px;">@endif<p><strong>Tanggal:</strong> {{ $album->event_date?->format('d M Y') ?? ($album->date_display ?? '-') }}</p><p><strong>Lokasi:</strong> {{ $album->location ?? '-' }}</p><p><strong>Target:</strong> {{ $album->target_generation ?? '-' }}</p><div style="margin-top:18px;line-height:1.7;white-space:pre-line;">{{ $album->description }}</div><div style="margin-top:24px;"><a href="{{ route('admin.albums.edit', $album->id) }}">Edit album</a> · <a href="{{ route('admin.albums.index') }}">Kembali</a></div></article>
@endsection