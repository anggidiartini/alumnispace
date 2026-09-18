@extends('admin.layout.index')

@section('page_title', isset($event) ? 'Edit Acara' : 'Tambah Acara')

@section('content')
<form action="{{ isset($event) ? route('admin.events.update', $event->id) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data" style="max-width:950px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;">
    @csrf
    @if(isset($event)) @method('PUT') @endif
    @if($errors->any())<div style="margin-bottom:18px;color:#991b1b;">{{ $errors->first() }}</div>@endif
    <label>Nama Acara</label><input name="title" value="{{ old('title', $event->title ?? '') }}" required style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Kategori</label><input name="category" value="{{ old('category', $event->category ?? 'Meetup') }}" required style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Badge</label><input name="badge_tag" value="{{ old('badge_tag', $event->badge_tag ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Banner</label><input type="file" name="banner_image" accept="image/jpeg,image/png,image/jpg" style="display:block;margin:6px 0 14px;">
    <label>Tanggal</label><input type="date" name="event_date" value="{{ old('event_date', isset($event) && $event->event_date ? $event->event_date->format('Y-m-d') : '') }}" required style="padding:10px;margin:6px 0 14px;">
    <label>Jam Mulai</label><input type="time" name="start_time" value="{{ old('start_time', $event->start_time ?? '') }}" style="padding:10px;margin:6px 0 14px;">
    <label>Jam Selesai</label><input type="time" name="end_time" value="{{ old('end_time', $event->end_time ?? '') }}" style="padding:10px;margin:6px 0 14px;">
    <label>Keterangan Waktu</label><input name="time_display" value="{{ old('time_display', $event->time_display ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Jenis Lokasi</label><select name="location_type" required style="padding:10px;margin:6px 0 14px;"><option value="offline" @selected(old('location_type', $event->location_type ?? 'offline') === 'offline')>Offline</option><option value="online" @selected(old('location_type', $event->location_type ?? '') === 'online')>Online</option><option value="hybrid" @selected(old('location_type', $event->location_type ?? '') === 'hybrid')>Hybrid</option></select>
    <label>Lokasi</label><input name="venue" value="{{ old('venue', $event->venue ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Deskripsi</label><textarea name="description" rows="7" required style="width:100%;padding:10px;margin:6px 0 14px;">{{ old('description', $event->description ?? '') }}</textarea>
    <label>Link Pendaftaran</label><input type="url" name="registration_link" value="{{ old('registration_link', $event->registration_link ?? '') }}" style="width:100%;padding:10px;margin:6px 0 14px;">
    <label>Kuota</label><input type="number" name="quota" min="1" value="{{ old('quota', $event->quota ?? '') }}" style="padding:10px;margin:6px 0 14px;">
    <label>Status</label><select name="status" required style="padding:10px;margin:6px 0 20px;"><option value="upcoming" @selected(old('status', $event->status ?? 'upcoming') === 'upcoming')>Segera Hadir</option><option value="ongoing" @selected(old('status', $event->status ?? '') === 'ongoing')>Berlangsung</option><option value="completed" @selected(old('status', $event->status ?? '') === 'completed')>Selesai</option><option value="cancelled" @selected(old('status', $event->status ?? '') === 'cancelled')>Dibatalkan</option></select>
    <button type="submit" style="padding:10px 16px;border:0;border-radius:8px;background:var(--color-primary);color:#fff;cursor:pointer;">Simpan</button><a href="{{ route('admin.events.index') }}" style="margin-left:12px;">Batal</a>
</form>
@endsection