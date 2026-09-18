@extends('admin.layout.index')

@section('title', 'Tinjau Detail — ' . ($table_key === 'alumnis' ? 'Data Alumni' : $mapping['title']))

@section('content')
<style>
    /* KUSTOMISASI LAYOUT GRID 2 KOLOM KANAN KIRI */
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
    }
    .btn-back:hover { background-color: #f4f8fb; color: #0a4174; }
    .btn-edit-direct { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        gap: 6px; 
        text-decoration: none; 
        padding: 12px; 
        background-color: #3b82f6; 
        color: white; 
        font-size: 13px; 
        font-weight: 700; 
        border-radius: 8px; 
        width: 100%;
    }
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
    
    <!-- KOLOM KIRI: DATA UTAMA TEXT & ALINEA -->
    <div class="detail-card-main">
        <div class="detail-header">
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174;">Arsip Informasi</h2>
                <p style="font-size: 12px; color: #527597;">Rincian data teks lengkap yang tersimpan dalam sistem.</p>
            </div>
        </div>

        @foreach($mapping['fields'] as $key => $field)
            <!-- ========================================================
               KONDISI KHUSUS FITUR PENGURUS ALUMNI (FORMAT TANGGAL TEKS)
               ======================================================== -->
            @if($table_key === 'alumni_boards')
                @php
                    $detilPengurus = DB::table('alumni_committees')
                        ->join('alumni_profiles', 'alumni_committees.alumni_profile_id', '=', 'alumni_profiles.id')
                        ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                        ->join('committee_periods', 'alumni_committees.committee_period_id', '=', 'committee_periods.id')
                        ->select('users.name', 'alumni_committees.position', 'committee_periods.period_name', 'committee_periods.start_date', 'committee_periods.finish_date')
                        ->where('alumni_committees.id', $row->id)
                        ->first();
                @endphp

                @if($key === 'alumni_profile_id')
                    <div class="info-group">
                        <span class="info-label">Nama Lengkap Anggota Pengurus</span>
                        <div class="info-value"><strong>{{ $detilPengurus->name }}</strong></div>
                    </div>
                @endif

                @if($key === 'position')
                    <div class="info-group">
                        <span class="info-label">Jabatan Struktural</span>
                        <div class="info-value"><span style="background:rgba(123, 189, 232, 0.25); color:#0a4174; padding:4px 10px; border-radius:6px; font-size:11px; font-weight:bold; display:inline-block;">{{ $detilPengurus->position }}</span></div>
                    </div>
                @endif

                @if($key === 'committee_period_id')
                    <div class="info-group">
                        <span class="info-label">Periode Kepengurusan</span>
                        <div class="info-value"><strong>{{ $detilPengurus->period_name }}</strong></div>
                    </div>
                    
                    <div class="info-group">
                        <span class="info-label">Tanggal Mulai Jabatan Bakti</span>
                        <div class="info-value"><strong>{{ \Carbon\Carbon::parse($detilPengurus->start_date)->locale('id')->translatedFormat('d F Y') }}</strong></div>
                    </div>

                    <div class="info-group">
                        <span class="info-label">Tanggal Berakhir Jabatan Bakti</span>
                        <div class="info-value">
                            <strong>
                                {{ $detilPengurus->finish_date ? \Carbon\Carbon::parse($detilPengurus->finish_date)->locale('id')->translatedFormat('d F Y') : 'Masih Aktif Menjabat' }}
                            </strong>
                        </div>
                    </div>
                @endif

                @php continue; @endphp
            @endif

            <!-- ========================================================
               KODE LAMA BAWAAN TEMANMU (UNTUK ENTITAS LAINNYA)
               ======================================================== -->
            @if(Str::endsWith($key, '_id') || $key === 'id' || $field['type'] === 'file' || in_array($key, ['avatar', 'thumbnail', 'photo_path', 'cover_photo', 'company_logo']))
                @continue
            @endif

            <div class="info-group">
                <span class="info-label">{{ $field['label'] }}</span>
                <div class="info-value">
                    @if($field['type'] === 'toggle')
                        <span style="background-color: {{ $row->$key ? 'rgba(16, 185, 129, 0.15)' : 'rgba(239, 68, 68, 0.15)' }}; color: {{ $row->$key ? '#065f46' : '#991b1b' }}; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: bold; display: inline-block;">
                            {{ $field['options'][$row->$key] ?? ($row->$key ? 'Aktif' : 'Nonaktif') }}
                        </span>
                    @elseif($field['type'] === 'select' || $key === 'study_status' || $key === 'status')
                        <span style="background-color: rgba(123, 189, 232, 0.25); color: #0a4174; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: bold; display: inline-block;">
                            {{ $field['options'][$row->$key] ?? $row->$key }}
                        </span>
                    @elseif($field['type'] === 'textarea' || in_array($key, ['bio', 'description', 'requirements']))
                        <div style="background: #f4f8fb; border: 1px solid #d0e1f0; padding: 12px 16px; border-radius: 8px; margin-top: 4px; white-space: pre-line;">{!! strip_tags($row->$key) !!}</div>
                    @elseif($field['type'] === 'date' && !empty($row->$key))
                        <strong>{{ strtolower(\Carbon\Carbon::parse($row->$key)->locale('id')->translatedFormat('d F Y')) }}</strong>
                    @else
                        <strong>{{ $row->$key ?? '-' }}</strong>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- KOLOM KANAN: MEDIA FOTO & AKSI UTAMA -->
    <div class="detail-card-sidebar">
        <span class="info-label">Lampiran Media</span>
        
        @php $hasImage = false; @endphp
        @foreach($mapping['fields'] as $key => $field)
            @if($field['type'] === 'file' || in_array($key, ['avatar', 'thumbnail', 'photo_path', 'cover_photo', 'company_logo']))
                @if($key === 'company_logo')
                    <div style="margin-bottom: 16px; display: flex; justify-content: center;">
                        <x-company-logo :logo="$row->$key" :name="$row->company_name ?? ($row->company ?? ($row->title ?? 'Perusahaan'))" size="80" option="initials" />
                    </div>
                    @php $hasImage = true; @endphp
                @elseif(!empty($row->$key))
                    <img src="{{ Str::startsWith($row->$key, 'http') ? $row->$key : asset($row->$key) }}" class="img-sidebar-preview" alt="Cover" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'80\' height=\'80\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2394a3b8\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'9\' cy=\'9\' r=\'2\'/><path d=\'m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21\'/></svg>';">
                    @php $hasImage = true; @endphp
                @endif
            @endif
        @endforeach

        @if(!$hasImage)
            <div style="background: #f4f8fb; border: 1px dashed #d0e1f0; padding: 20px; text-align: center; border-radius: 8px; font-size: 12px; color: #527597; margin-bottom: 16px;">
                Tidak ada lampiran berkas foto.
            </div>
        @endif

        <span class="info-label">Aksi Pengelola</span>
        <a href="{{ route('admin.galleries.edit', $row->id) }}" class="btn-edit-direct">
            <i class="fa-solid fa-pen-to-square"></i> Sunting Data
        </a>
        <a href="{{ route('admin.galleries.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

@if($table_key === 'event' && isset($extraData['eventModel']))
<div style="margin-top: 24px; background: #ffffff; border: 1px solid #d0e1f0; border-radius: 16px; padding: 28px; box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #d0e1f0; padding-bottom: 16px; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h3 style="font-size: 18px; font-weight: 800; color: #0a4174; margin: 0; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-users-line" style="color: #2e72ec;"></i> Riwayat Pendaftar & Penjualan Kuota
            </h3>
            <p style="font-size: 12px; color: #527597; margin: 4px 0 0;">Daftar peserta terdaftar dan rincian alokasi kuota tiket untuk event ini.</p>
        </div>
        <div>
            <span style="font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 999px; background: {{ ($extraData['remainingQuota'] ?? 0) > 0 ? 'rgba(16, 185, 129, 0.15); color: #065f46;' : 'rgba(239, 68, 68, 0.15); color: #991b1b;' }}">
                {{ ($extraData['remainingQuota'] ?? 0) > 0 ? 'Pendaftaran Terbuka' : 'Kuota Penuh' }}
            </span>
        </div>
    </div>

    <!-- WIDGET RINGKASAN KUOTA EVENT -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <!-- Card Total Kuota -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.5px;">Total Kuota</span>
                <i class="fa-solid fa-ticket" style="color: #64748b; font-size: 14px;"></i>
            </div>
            <div style="font-size: 24px; font-weight: 800; color: #0a4174;">
                {{ $extraData['totalQuota'] ?? $row->quota }} <span style="font-size: 13px; font-weight: 500; color: #64748b;">kursi</span>
            </div>
        </div>

        <!-- Card Kuota Terpakai -->
        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 18px 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #1e40af; letter-spacing: 0.5px;">Kuota Terpakai / Terjual</span>
                <i class="fa-solid fa-user-check" style="color: #3b82f6; font-size: 14px;"></i>
            </div>
            <div style="font-size: 24px; font-weight: 800; color: #1d4ed8;">
                {{ $extraData['usedQuota'] ?? 0 }} <span style="font-size: 13px; font-weight: 500; color: #3b82f6;">kursi ({{ $extraData['percentFilled'] ?? 0 }}%)</span>
            </div>
        </div>

        <!-- Card Sisa Kuota -->
        <div style="background: {{ ($extraData['remainingQuota'] ?? 0) > 0 ? '#ecfdf5; border: 1px solid #a7f3d0;' : '#fef2f2; border: 1px solid #fecaca;' }} border-radius: 12px; padding: 18px 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: {{ ($extraData['remainingQuota'] ?? 0) > 0 ? '#065f46;' : '#991b1b;' }} letter-spacing: 0.5px;">Sisa Kuota Tersedia</span>
                <i class="fa-solid {{ ($extraData['remainingQuota'] ?? 0) > 0 ? 'fa-chair' : 'fa-ban' }}" style="color: {{ ($extraData['remainingQuota'] ?? 0) > 0 ? '#10b981;' : '#ef4444;' }} font-size: 14px;"></i>
            </div>
            <div style="font-size: 24px; font-weight: 800; color: {{ ($extraData['remainingQuota'] ?? 0) > 0 ? '#047857;' : '#b91c1c;' }}">
                {{ $extraData['remainingQuota'] ?? 0 }} <span style="font-size: 13px; font-weight: 500;">kursi</span>
            </div>
        </div>
    </div>

    <!-- Progress Bar Keterisian -->
    <div style="margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; color: #527597; margin-bottom: 6px;">
            <span>Tingkat Keterisian Kuota</span>
            <span>{{ $extraData['usedQuota'] ?? 0 }} dari {{ $extraData['totalQuota'] ?? $row->quota }} kursi ({{ $extraData['percentFilled'] ?? 0 }}%)</span>
        </div>
        <div style="width: 100%; height: 10px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
            <div style="height: 100%; width: {{ $extraData['percentFilled'] ?? 0 }}%; background: {{ ($extraData['percentFilled'] ?? 0) >= 100 ? '#ef4444;' : '#2e72ec;' }} transition: width 0.3s ease; border-radius: 999px;"></div>
        </div>
    </div>

    <!-- TABEL RIWAYAT PENDAFTAR -->
    <div style="overflow-x: auto; border: 1px solid #d0e1f0; border-radius: 10px;">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #d0e1f0;">
                    <th style="padding: 12px 16px; font-weight: 700; color: #527597; text-align: center; width: 50px;">No</th>
                    <th style="padding: 12px 16px; font-weight: 700; color: #527597;">Kode Tiket</th>
                    <th style="padding: 12px 16px; font-weight: 700; color: #527597;">Nama Pendaftar</th>
                    <th style="padding: 12px 16px; font-weight: 700; color: #527597;">Email & No. WhatsApp</th>
                    <th style="padding: 12px 16px; font-weight: 700; color: #527597; text-align: center;">Kuota Diambil</th>
                    <th style="padding: 12px 16px; font-weight: 700; color: #527597;">Waktu Pendaftaran</th>
                    <th style="padding: 12px 16px; font-weight: 700; color: #527597; text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($extraData['registrations']) && $extraData['registrations']->count() > 0)
                    @foreach($extraData['registrations'] as $index => $reg)
                        <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 14px 16px; text-align: center; font-weight: 700; color: #64748b;">{{ $index + 1 }}</td>
                            <td style="padding: 14px 16px;">
                                <span style="font-family: monospace; font-weight: 700; font-size: 12px; padding: 4px 8px; border-radius: 6px; background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe;">
                                    {{ $reg->ticket_code }}
                                </span>
                            </td>
                            <td style="padding: 14px 16px; font-weight: 600; color: #0a4174;">
                                {{ $reg->name ?? ($reg->user->name ?? '-') }}
                            </td>
                            <td style="padding: 14px 16px; color: #475569;">
                                <div><i class="fa-solid fa-envelope" style="width: 14px; color: #94a3b8; font-size: 11px;"></i> {{ $reg->email ?? ($reg->user->email ?? '-') }}</div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                                    <i class="fa-brands fa-whatsapp" style="width: 14px; color: #22c55e; font-size: 12px;"></i> {{ $reg->phone ?? ($reg->user->phone ?? '-') }}
                                </div>
                            </td>
                            <td style="padding: 14px 16px; text-align: center;">
                                <span style="font-weight: 800; font-size: 14px; color: #0a4174; padding: 3px 10px; background: #f1f5f9; border-radius: 6px;">
                                    {{ $reg->quantity ?? 1 }}
                                </span>
                            </td>
                            <td style="padding: 14px 16px; color: #64748b; font-size: 12px;">
                                {{ $reg->created_at ? $reg->created_at->translatedFormat('d M Y, H:i') . ' WIB' : '-' }}
                            </td>
                            <td style="padding: 14px 16px; text-align: center;">
                                @php
                                    $st = strtolower($reg->status ?? 'registered');
                                    $stLabel = match($st) {
                                        'registered' => 'Terdaftar',
                                        'attended' => 'Hadir',
                                        'cancelled' => 'Dibatalkan',
                                        default => ucfirst($st),
                                    };
                                    $stBg = match($st) {
                                        'registered' => '#eff6ff',
                                        'attended' => '#ecfdf5',
                                        'cancelled' => '#fef2f2',
                                        default => '#f1f5f9',
                                    };
                                    $stColor = match($st) {
                                        'registered' => '#1d4ed8',
                                        'attended' => '#047857',
                                        'cancelled' => '#b91c1c',
                                        default => '#475569',
                                    };
                                @endphp
                                <span style="padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; background: {{ $stBg }}; color: {{ $stColor }};">
                                    {{ $stLabel }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                            <i class="fa-solid fa-clipboard-user" style="font-size: 32px; color: #cbd5e1; margin-bottom: 8px; display: block;"></i>
                            Belum ada riwayat pendaftaran untuk event ini.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
