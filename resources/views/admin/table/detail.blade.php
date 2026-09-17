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
                        <x-company-logo :logo="$row->$key" :name="$row->company_name ?? 'Perusahaan'" size="80" option="initials" />
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
        <a href="{{ route('admin.table.edit', [$table_key, $row->id]) }}" class="btn-edit-direct">
            <i class="fa-solid fa-pen-to-square"></i> Sunting Data
        </a>
        <a href="{{ route('admin.table.index', $table_key) }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection
