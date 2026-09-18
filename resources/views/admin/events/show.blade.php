@extends('admin.layout.index')

@section('title', 'Detail Acara — ' . $event->title)

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
    }
    .info-group {
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f4f8fb;
    }
    .info-group:last-of-type {
        border-bottom: none;
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

    /* Kartu Metrik Kuota */
    .quota-stat-card {
        padding: 16px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
    .quota-stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 20px;
    }
    .quota-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .quota-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        padding: 10px 14px;
        border-bottom: 2px solid #e2e8f0;
        text-align: left;
    }
    .quota-table td {
        padding: 12px 14px;
        border-bottom: 1px solid #e2e8f0;
        color: #1e293b;
        vertical-align: middle;
    }
    @media (max-width: 992px) {
        .detail-layout-grid { grid-template-columns: 1fr; }
        .detail-card-sidebar { position: static; }
    }
</style>

<div class="detail-layout-grid">
    <!-- KOLOM KIRI: DATA UTAMA & RIWAYAT PENDAFTAR -->
    <div class="detail-card-main">
        <div class="detail-header">
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">Detail Informasi Acara</h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Informasi lengkap rincian agenda dan ketersediaan kuota.</p>
            </div>
            @php $st = strtolower($event->status ?? 'upcoming'); @endphp
            @if($st === 'completed' || $st === 'selesai')
                <span style="background-color: #f1f5f9; color: #475569; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid #e2e8f0;">Selesai</span>
            @elseif($st === 'ongoing' || $st === 'berlangsung')
                <span style="background-color: #ecfdf5; color: #065f46; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid #a7f3d0;">Berlangsung</span>
            @elseif($st === 'cancelled' || $st === 'dibatalkan')
                <span style="background-color: #fef2f2; color: #991b1b; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid #fecaca;">Dibatalkan</span>
            @else
                <span style="background-color: #eff6ff; color: #1d4ed8; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; border: 1px solid #bfdbfe;">Segera Hadir</span>
            @endif
        </div>

        <div class="info-group">
            <span class="info-label">Nama Agenda Acara</span>
            <div class="info-value" style="font-size: 18px; font-weight: 700; color: #0a4174;">{{ $event->title }}</div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Kategori Kegiatan</span>
                <div class="info-value"><strong>{{ $event->category }}</strong></div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Badge / Tag</span>
                <div class="info-value">{{ $event->badge_tag ?? '-' }}</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Tanggal Pelaksanaan</span>
                <div class="info-value">
                    {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') : '-' }}
                </div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Keterangan Waktu</span>
                <div class="info-value">{{ $event->time_display ?: trim(($event->start_time ?? '') . ' - ' . ($event->end_time ?? '')) }}</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Jenis Lokasi</span>
                <div class="info-value">{{ ucfirst($event->location_type) }}</div>
            </div>
            <div class="info-group" style="margin-bottom: 0;">
                <span class="info-label">Venue / Tempat</span>
                <div class="info-value">{{ $event->venue ?? '-' }}</div>
            </div>
        </div>

        @if(!empty($event->registration_link))
            <div class="info-group">
                <span class="info-label">Tautan Registrasi Eksternal</span>
                <div class="info-value">
                    <a href="{{ $event->registration_link }}" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline;">
                        {{ $event->registration_link }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
                    </a>
                </div>
            </div>
        @endif

        <div class="info-group">
            <span class="info-label">Deskripsi Lengkap</span>
            <div class="info-value" style="white-space: pre-line; line-height: 1.7;">{{ $event->description }}</div>
        </div>

        <!-- ========================================================
             WIDGET MANAJEMEN KUOTA & DAFTAR PENDAFTAR
             ======================================================== -->
        <div style="margin-top: 36px; padding-top: 24px; border-top: 2px dashed #d0e1f0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
                <div>
                    <h3 style="font-size: 16px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">
                        <i class="fa-solid fa-users-viewfinder" style="color: #2563eb;"></i> Riwayat Pendaftar & Penjualan Kuota
                    </h3>
                    <p style="font-size: 12px; color: #64748b; margin: 0;">Monitoring sisa kuota dan riwayat peserta pendaftar.</p>
                </div>
            </div>

            <!-- 3 KARTU STATISTIK KUOTA -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 20px;">
                <div class="quota-stat-card" style="background: #eff6ff; border: 1px solid #bfdbfe;">
                    <div class="quota-stat-icon" style="background: #dbeafe; color: #1d4ed8;">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Total Kuota</div>
                        <div style="font-size: 22px; font-weight: 800; color: #1e3a8a;">{{ $totalQuota }} Kursi</div>
                    </div>
                </div>

                <div class="quota-stat-card" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                    <div class="quota-stat-icon" style="background: #dcfce7; color: #15803d;">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Terpakai / Terjual</div>
                        <div style="font-size: 22px; font-weight: 800; color: #166534;">{{ $usedQuota }} Kursi</div>
                    </div>
                </div>

                <div class="quota-stat-card" style="background: {{ $remainingQuota <= 0 ? '#fef2f2' : '#f8fafc' }}; border: 1px solid {{ $remainingQuota <= 0 ? '#fecaca' : '#e2e8f0' }};">
                    <div class="quota-stat-icon" style="background: {{ $remainingQuota <= 0 ? '#fee2e2' : '#f1f5f9' }}; color: {{ $remainingQuota <= 0 ? '#dc2626' : '#475569' }};">
                        <i class="fa-solid fa-chair"></i>
                    </div>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Sisa Kuota</div>
                        <div style="font-size: 22px; font-weight: 800; color: {{ $remainingQuota <= 0 ? '#dc2626' : '#0f172a' }};">
                            {{ $remainingQuota }} Kursi
                        </div>
                    </div>
                </div>
            </div>

            <!-- PROGRESS BAR KETERISIAN -->
            <div style="margin-bottom: 24px; background: #f8fafc; border: 1px solid #e2e8f0; padding: 14px 18px; border-radius: 12px;">
                <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 700; margin-bottom: 8px; color: #334155;">
                    <span>Persentase Keterisian Kuota</span>
                    <span>{{ $percentFilled }}% ({{ $usedQuota }} / {{ $totalQuota }})</span>
                </div>
                <div style="width: 100%; height: 10px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
                    <div style="width: {{ $percentFilled }}%; height: 100%; background: {{ $percentFilled >= 100 ? '#ef4444' : ($percentFilled > 75 ? '#f59e0b' : '#10b981') }}; transition: width 0.4s ease;"></div>
                </div>
            </div>

            <!-- TABEL DAFTAR PENDAFTAR -->
            <div style="border: 1px solid #e2e8f0; border-radius: 12px; overflow-x: auto;">
                <table class="quota-table">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">No</th>
                            <th>Kode Tiket</th>
                            <th>Nama Pendaftar</th>
                            <th>Kontak</th>
                            <th style="text-align: center;">Qty</th>
                            <th>Waktu Pendaftaran</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations ?? [] as $idx => $reg)
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #64748b;">{{ $idx + 1 }}</td>
                                <td>
                                    <span style="font-family: monospace; font-weight: 700; background: #f1f5f9; padding: 3px 8px; border-radius: 6px; font-size: 12px; color: #0a4174;">
                                        {{ $reg->ticket_code }}
                                    </span>
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #0a4174;">{{ $reg->name ?? ($reg->user->name ?? 'Anonim') }}</div>
                                    <div style="font-size: 11px; color: #64748b;">{{ $reg->email ?? ($reg->user->email ?? '-') }}</div>
                                </td>
                                <td>
                                    <span style="font-size: 12px; color: #334155;">{{ $reg->phone ?? '-' }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <span style="background: #e0f2fe; color: #0369a1; padding: 3px 10px; border-radius: 999px; font-weight: 800; font-size: 11px;">
                                        {{ $reg->quantity }} Tiket
                                    </span>
                                </td>
                                <td style="font-size: 12px; color: #64748b;">
                                    {{ $reg->created_at ? $reg->created_at->translatedFormat('d M Y, H:i') : '-' }}
                                </td>
                                <td style="text-align: center;">
                                    @if($reg->status === 'cancelled')
                                        <span style="background: #fee2e2; color: #991b1b; padding: 2px 8px; border-radius: 999px; font-size: 11px; font-weight: 700;">Dibatalkan</span>
                                    @else
                                        <span style="background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 999px; font-size: 11px; font-weight: 700;">Terkonfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px; color: #94a3b8; font-style: italic;">
                                    Belum ada peserta yang mendaftar pada agenda ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: BANNER PREVIEW & AKSI PENGELOLA -->
    <div class="detail-card-sidebar">
        <span class="info-label">Banner Acara</span>
        @if(!empty($event->banner_image))
            <img src="{{ asset($event->banner_image) }}" class="img-sidebar-preview" alt="{{ $event->title }}" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'80\' height=\'80\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2394a3b8\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'9\' cy=\'9\' r=\'2\'/><path d=\'m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21\'/></svg>';">
        @else
            <div style="background: #f4f8fb; border: 1px dashed #d0e1f0; padding: 30px 20px; text-align: center; border-radius: 10px; font-size: 12px; color: #527597; margin-bottom: 16px;">
                <i class="fa-regular fa-image" style="font-size: 28px; color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                Tidak ada banner gambar.
            </div>
        @endif

        <span class="info-label" style="margin-top: 10px;">Aksi Pengelola</span>
        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn-edit-direct">
            <i class="fa-solid fa-pen-to-square"></i> Sunting Acara
        </a>
        <a href="{{ route('admin.events.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection