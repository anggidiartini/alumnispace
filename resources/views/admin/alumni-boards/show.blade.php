@extends('admin.layout.index')

@section('title', 'Detail Pengurus Alumni — ' . $board->alumni_name)

@section('content')
<style>
    .detail-layout-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }
    .detail-card-main { 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 16px; 
        padding: 28px; 
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04); 
    }
    .detail-card-sidebar { 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 16px; 
        padding: 20px; 
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04); 
        position: sticky;
        top: 24px;
    }
    .detail-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        border-bottom: 1px solid #d0e1f0; 
        padding-bottom: 16px; 
        margin-bottom: 24px; 
        gap: 12px;
        flex-wrap: wrap;
    }
    .info-group {
        min-height: 82px;
        margin-bottom: 14px;
        padding: 16px;
        border: 1px solid #d0e1f0;
        border-radius: 10px;
        background: #f8fbfe;
    }
    .info-group:last-of-type {
        margin-bottom: 0;
    }
    .info-label { 
        font-weight: 700; 
        color: #527597; 
        text-transform: uppercase; 
        font-size: 11px; 
        letter-spacing: 0.5px; 
        margin-bottom: 6px;
        display: block;
    }
    .info-value { 
        color: #0a4174; 
        font-weight: 500; 
        font-size: 14px;
        line-height: 1.6; 
    }
    .profile-info-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .profile-info-box { min-height: 68px; padding: 12px; border: 1px solid #d0e1f0; border-radius: 8px; background: #fff; }
    .profile-info-box .info-label { margin-bottom: 5px; }
    @media (max-width: 600px) { .profile-info-grid { grid-template-columns: 1fr; } }
    .btn-back { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        gap: 8px; 
        text-decoration: none; 
        padding: 10px; 
        border: 1px solid #d0e1f0; 
        color: #527597; 
        font-size: 13px; 
        font-weight: 600; 
        border-radius: 8px; 
        background: #fff;
        width: 100%;
        margin-top: 10px;
        transition: background 0.15s ease;
    }
    .btn-back:hover { background-color: #f4f8fb; color: #0a4174; }
    .btn-edit-direct { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        gap: 6px; 
        text-decoration: none; 
        padding: 12px; 
        background-color: #0a4174; 
        color: white; 
        font-size: 13px; 
        font-weight: 700; 
        border-radius: 8px; 
        width: 100%;
        transition: background 0.15s ease;
    }
    .btn-edit-direct:hover { background-color: #08335c; color: white; }
    .img-sidebar-preview { 
        width: 100%; 
        max-height: 220px; 
        border-radius: 10px; 
        object-fit: cover; 
        border: 1px solid #d0e1f0; 
        margin-bottom: 16px;
    }
    @media (max-width: 992px) {
        .detail-layout-grid { grid-template-columns: 1fr; }
        .detail-card-sidebar { position: static; }
    }
</style>

<div class="detail-layout-grid">
    <!-- KOLOM KIRI: DETAIL PENGURUS -->
    <div class="detail-card-main">
        <div class="detail-header">
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">Detail Pengurus Alumni</h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Rincian struktur kepengurusan organisasi alumni.</p>
            </div>
            <div>
                @php $st = $board->study_status ?? 'Aktif'; @endphp
                <span style="background-color: {{ $st === 'Aktif' ? '#d1fae5' : '#fee2e2' }}; color: {{ $st === 'Aktif' ? '#065f46' : '#991b1b' }}; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid {{ $st === 'Aktif' ? '#a7f3d0' : '#fecaca' }};">
                    {{ $st }}
                </span>
            </div>
        </div>

        <div class="info-group">
            <span class="info-label">Nama Anggota Alumni</span>
            <div class="info-value" style="font-size: 18px; font-weight: 800; color: #0a4174;">{{ $board->alumni_name }}</div>
        </div>

        <div class="info-group">
            <span class="info-label">Jabatan Kepengurusan</span>
            <div class="info-value" style="font-size: 16px; font-weight: 700; color: #2563eb;">{{ $board->position }}</div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Periode Kepengurusan</span>
                <div class="info-value"><strong>{{ $board->period_name }}</strong></div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Rentang Waktu</span>
                <div class="info-value">
                    {{ $board->start_date ? \Carbon\Carbon::parse($board->start_date)->locale('id')->translatedFormat('d M Y') : '-' }} s/d
                    {{ $board->finish_date ? \Carbon\Carbon::parse($board->finish_date)->locale('id')->translatedFormat('d M Y') : 'Sekarang' }}
                </div>
            </div>
        </div>

        <div class="info-group">
            <span class="info-label">Informasi Kontak dan Profil Alumni</span>
            <div class="profile-info-grid">
                <div class="profile-info-box"><span class="info-label">Jurusan</span><div class="info-value">{{ $board->major ?? '-' }}</div></div>
                <div class="profile-info-box"><span class="info-label">Perusahaan / Instansi</span><div class="info-value">{{ $board->company ?? '-' }}</div></div>
                <div class="profile-info-box"><span class="info-label">Kota Domisili</span><div class="info-value">{{ $board->city ?? '-' }}</div></div>
                <div class="profile-info-box"><span class="info-label">Nomor WhatsApp</span><div class="info-value">{{ $board->phone_number ?? '-' }}</div></div>
            </div>
        </div>

        <div class="info-group">
            <span class="info-label">Biografi</span>
            <div class="info-value" style="white-space: pre-line;">{{ $board->bio ?? '-' }}</div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Tahun Kelulusan</span>
                <div class="info-value">{{ $board->graduation_year ?? '-' }}</div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Profesi Saat Ini</span>
                <div class="info-value">{{ $board->profession ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: FOTO PROFIL & AKSI -->
    <div class="detail-card-sidebar">
        <span class="info-label">Foto Profil</span>
        @if(!empty($board->avatar))
            <img src="{{ asset($board->avatar) }}" class="img-sidebar-preview" alt="{{ $board->alumni_name }}" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'80\' height=\'80\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2394a3b8\' stroke-width=\'1.5\'><circle cx=\'12\' cy=\'8\' r=\'4\'/><path d=\'M6 20v-2a6 6 0 0 1 12 0v2\'/></svg>';">
        @else
            <div style="background: #f4f8fb; border: 1px dashed #d0e1f0; padding: 30px 20px; text-align: center; border-radius: 10px; font-size: 12px; color: #527597; margin-bottom: 16px;">
                <i class="fa-regular fa-user" style="font-size: 32px; color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                Tidak ada lampiran foto profil.
            </div>
        @endif

        <span class="info-label" style="margin-top: 10px;">Aksi Pengelola</span>
        <a href="{{ route('admin.alumni-boards.edit', $board->id) }}" class="btn-edit-direct">
            <i class="fa-solid fa-pen-to-square"></i> Sunting Data
        </a>
        <a href="{{ route('admin.alumni-boards.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection