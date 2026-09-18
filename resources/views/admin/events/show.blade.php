@extends('admin.layout.index')

@section('page_title', 'Detail Acara')

@section('content')
<article style="max-width:950px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;">
    <p style="color:var(--text-muted);font-size:13px;">{{ $event->category }} · {{ ucfirst($event->status) }}</p>
    <h1 style="margin:10px 0 16px;color:var(--text-main);">{{ $event->title }}</h1>
    @if($event->banner_image)<img src="{{ asset($event->banner_image) }}" alt="{{ $event->title }}" style="max-width:100%;max-height:320px;object-fit:cover;border-radius:8px;margin-bottom:18px;">@endif
    <p><strong>Tanggal:</strong> {{ $event->event_date?->format('d M Y') }}</p>
    <p><strong>Waktu:</strong> {{ $event->time_display ?: trim(($event->start_time ?? '') . ' - ' . ($event->end_time ?? '')) }}</p>
    <p><strong>Lokasi:</strong> {{ $event->venue ?? ucfirst($event->location_type) }}</p>
    <p><strong>Kuota:</strong> {{ $event->quota ?? 'Tidak dibatasi' }}</p>
    <div style="margin-top:18px;line-height:1.7;white-space:pre-line;">{{ $event->description }}</div>
    <div style="margin-top:24px;"><a href="{{ route('admin.events.edit', $event->id) }}">Edit acara</a> · <a href="{{ route('admin.events.index') }}">Kembali</a></div>
</article>
@endsection