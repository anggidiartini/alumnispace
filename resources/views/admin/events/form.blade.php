@extends('admin.layout.index')

@section('page_title', isset($event) ? 'Edit Acara' : 'Tambah Acara')

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
    .btn-submit:hover {
        background: #08335c;
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
        display: block;
        width: 100%;
        margin-top: 10px;
        transition: all 0.15s ease;
    }
    .btn-cancel:hover {
        background: #f8fafc;
        color: #0a4174;
    }
    @media (max-width: 992px) {
        .form-layout-grid { grid-template-columns: 1fr; }
        .form-card-sidebar { position: static; }
    }
</style>

<form action="{{ isset($event) ? route('admin.events.update', $event->id) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($event))
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
        <!-- KOLOM KIRI: DATA UTAMA ACARA -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">
                    {{ isset($event) ? 'Sunting Agenda Acara' : 'Buat Agenda Acara Baru' }}
                </h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Silakan lengkapi informasi formulir pelaksanaan agenda kegiatan di bawah ini.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Agenda Acara <span class="required-star">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $event->title ?? '') }}" placeholder="Contoh: Webinar AI Integration 2026..." required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Kategori Kegiatan <span class="required-star">*</span></label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $event->category ?? 'Meetup') }}" placeholder="Contoh: Workshop, Seminar, Reuni..." required>
                </div>
                <div class="form-group">
                    <label class="form-label">Badge / Sticker Tag</label>
                    <input type="text" name="badge_tag" class="form-control" value="{{ old('badge_tag', $event->badge_tag ?? '') }}" placeholder="Contoh: Populer, Gratis, Eksklusif...">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Tanggal Kegiatan <span class="required-star">*</span></label>
                    <input type="date" name="event_date" class="form-control" value="{{ old('event_date', isset($event) && $event->event_date ? $event->event_date->format('Y-m-d') : '') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tampilan Waktu / Jam</label>
                    <input type="text" name="time_display" class="form-control" value="{{ old('time_display', $event->time_display ?? '') }}" placeholder="Contoh: 09:00 - 12:00 WIB">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $event->start_time ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $event->end_time ?? '') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 160px 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Jenis Lokasi <span class="required-star">*</span></label>
                    <select name="location_type" class="form-control" required>
                        <option value="offline" @selected(old('location_type', $event->location_type ?? 'offline') === 'offline')>Offline</option>
                        <option value="online" @selected(old('location_type', $event->location_type ?? '') === 'online')>Online</option>
                        <option value="hybrid" @selected(old('location_type', $event->location_type ?? '') === 'hybrid')>Hybrid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi / Nama Tempat</label>
                    <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue ?? '') }}" placeholder="Contoh: Ruang Auditorium Kampus / Zoom Meeting">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 180px; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Tautan Pendaftaran Eksternal (Opsional)</label>
                    <input type="url" name="registration_link" class="form-control" value="{{ old('registration_link', $event->registration_link ?? '') }}" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label class="form-label">Kuota Peserta</label>
                    @php
                        $minSold = $currSold ?? (isset($event) ? \Illuminate\Support\Facades\DB::table('event_registrations')->where('event_id', $event->id)->where('status', '!=', 'cancelled')->sum('quantity') : 0);
                    @endphp
                    <input type="number" name="quota" class="form-control" min="{{ $minSold }}" value="{{ old('quota', $event->quota ?? '') }}" placeholder="Contoh: 100">
                    @if($minSold > 0)
                        <span style="font-size: 11px; color: #0a4174; font-weight: 600; margin-top: 4px; display: flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-circle-info" style="color: #2e72ec;"></i> Sudah <strong>{{ $minSold }} tiket terjual</strong>. Minimal: {{ $minSold }}.
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Lengkap Acara <span class="required-star">*</span></label>
                <textarea name="description" class="form-control" rows="8" placeholder="Tuliskan gambaran acara, pembicara, dan ketentuan bagi peserta..." required>{{ old('description', $event->description ?? '') }}</textarea>
            </div>
        </div>

        <!-- KOLOM KANAN: MEDIA & PENGATURAN STATUS -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom: 16px; padding-bottom: 8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0;">Media & Status</h3>
            </div>

            <div class="form-group">
                <label class="form-label">Banner Foto Acara</label>
                <input type="file" name="banner_image" class="form-control" accept="image/jpeg,image/png,image/jpg" onchange="previewBanner(this)">
                <div class="field-hint">Format: JPG, JPEG, PNG (Maks 500KB)</div>
                <div style="margin-top: 10px; text-align: center; background: #f8fafc; border: 1px dashed #d0e1f0; border-radius: 8px; padding: 6px; min-height: 120px; display: flex; align-items: center; justify-content: center;">
                    <img id="bannerPreview" 
                         src="{{ (isset($event) && !empty($event->banner_image)) ? asset($event->banner_image) : asset('assets/images/no-image.png') }}" 
                         style="max-width: 100%; max-height: 140px; border-radius: 6px; object-fit: {{ (isset($event) && !empty($event->banner_image)) ? 'cover' : 'contain' }};" 
                         alt="Pratinjau Banner"
                         onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}';">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status Acara <span class="required-star">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="upcoming" @selected(old('status', $event->status ?? 'upcoming') === 'upcoming')>Segera Hadir</option>
                    <option value="completed" @selected(old('status', $event->status ?? '') === 'completed')>Selesai</option>
                </select>
            </div>

            <div style="margin-top: 24px;">
                <button type="submit" class="btn-submit">Simpan Acara</button>
                <a href="{{ route('admin.events.index') }}" class="btn-cancel">Batalkan</a>
            </div>
        </div>
    </div>
</form>

<script>
    function previewBanner(input) {
        const preview = document.getElementById('bannerPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { 
                preview.src = e.target.result;
                preview.style.objectFit = 'cover';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection