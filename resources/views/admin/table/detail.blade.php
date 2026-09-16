@extends('admin.layout.index')

@section('title', 'Tinjau Detail — ' . ($table_key === 'alumnis' ? 'Data Alumni' : $mapping['title']))

@section('content')
<style>
    .detail-card-full { 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 16px; 
        padding: 32px; 
        width: 100%; 
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.05); 
    }
    .detail-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        border-bottom: 1px solid #d0e1f0; 
        padding-bottom: 20px; 
        margin-bottom: 24px; 
    }
    .detail-container-box { 
        background-color: #f4f8fb; 
        border-radius: 12px; 
        padding: 8px 24px; 
        border: 1px solid #d0e1f0; 
    }
    .detail-grid { 
        display: grid; 
        grid-template-columns: 260px 1fr; 
        gap: 16px; 
        border-bottom: 1px solid #d0e1f0; 
        padding: 16px 0; 
        font-size: 14px; 
    }
    .detail-grid:last-of-type { 
        border-bottom: none; 
    }
    .label-side { 
        font-weight: 700; 
        color: #527597; 
        text-transform: uppercase; 
        font-size: 11px; 
        letter-spacing: 0.5px; 
        display: flex; 
        align-items: center; 
    }
    .value-side { 
        color: #0a4174; 
        font-weight: 500; 
        line-height: 1.6; 
    }
    .btn-back { 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        text-decoration: none; 
        padding: 10px 18px; 
        border: 1px solid #d0e1f0; 
        color: #527597; 
        font-size: 13px; 
        font-weight: 600; 
        border-radius: 8px; 
        transition: all 0.2s; 
        background: #fff;
    }
    .btn-back:hover { 
        background-color: #e2e8f0; 
        color: #0a4174; 
    }
    .btn-edit-direct { 
        display: inline-flex; 
        align-items: center; 
        gap: 6px; 
        text-decoration: none; 
        padding: 10px 18px; 
        background-color: #3b82f6; 
        color: white; 
        font-size: 13px; 
        font-weight: 600; 
        border-radius: 8px; 
        transition: opacity 0.2s;
    }
    .btn-edit-direct:hover {
        opacity: 0.9;
    }
    .detail-preview-img { 
        max-width: 140px; 
        max-height: 140px; 
        border-radius: 8px; 
        object-fit: cover; 
        border: 1px solid #d0e1f0; 
    }
</style>

<div class="detail-card-full">
    <div class="detail-header">
        <div>
            <h2 style="font-size: 22px; font-weight: 800; color: #0a4174;">Arsip Informasi Lengkap</h2>
            <p style="font-size: 13px; color: #527597;">Tinjauan seluruh rincian komponen data yang tersimpan di dalam sistem operasional web.</p>
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('admin.table.edit', [$table_key, $row->id]) }}" class="btn-edit-direct">
                <i class="fa-solid fa-pen-to-square"></i> Sunting Data
            </a>
            <a href="{{ route('admin.table.index', $table_key) }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="detail-container-box">
        @foreach($mapping['fields'] as $key => $field)
            {{-- Menyaring dan menyembunyikan kolom jika mengandung kata '_id' atau berupa nama field ID relasi --}}
            @if(Str::endsWith($key, '_id') || $key === 'id')
                @continue
            @endif

            <div class="detail-grid">
                <div class="label-side">{{ $field['label'] }}</div>
                <div class="value-side">
                    <!-- FORMAT BERUPA FILE FISIK/PREVIEW FOTO -->
                    @if($field['type'] === 'file' || in_array($key, ['avatar', 'thumbnail', 'photo_path', 'cover_photo']))
                        @if(!empty($row->$key))
                            <img src="{{ Str::startsWith($row->$key, 'http') ? $row->$key : asset($row->$key) }}" class="detail-preview-img" alt="Lampiran Foto">
                        @else
                            <span style="color: #527597; font-style: italic;">Tidak ada berkas yang diunggah</span>
                        @endif
                    
                    <!-- FORMAT BERUPA TOGGLE / STATUS PELAKSANAAN -->
                    @elseif($field['type'] === 'toggle')
                        <span style="background-color: {{ $row->$key ? 'rgba(16, 185, 129, 0.15)' : 'rgba(239, 68, 68, 0.15)' }}; color: {{ $row->$key ? '#065f46' : '#991b1b' }}; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; display: inline-block;">
                            {{ $field['options'][$row->$key] ?? ($row->$key ? 'Aktif / Diterbitkan' : 'Nonaktif / Draf') }}
                        </span>
                    
                    <!-- FORMAT BERUPA DROPDOWN SELECT STATUS -->
                    @elseif($field['type'] === 'select' || $key === 'study_status' || $key === 'status')
                        @php
                            $isSuccess = in_array($row->$key, ['Aktif', 'completed', 'upcoming']);
                            $bgColor = $isSuccess ? 'rgba(123, 189, 232, 0.25)' : 'rgba(239, 68, 68, 0.15)';
                            $textColor = $isSuccess ? '#0a4174' : '#991b1b';
                        @endphp
                        <span style="background-color: {{ $bgColor }}; color: {{ $textColor }}; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: bold; display: inline-block;">
                            {{ $field['options'][$row->$key] ?? $row->$key }}
                        </span>
                    
                    <!-- KONTEN TEXTAREA PANJANG / DENGAN PLUGIN FORMAT HTML -->
                    @elseif($field['type'] === 'textarea' || in_array($key, ['content', 'description', 'requirements', 'bio']))
                        <div style="background: #fff; border: 1px solid #d0e1f0; padding: 16px; border-radius: 8px; max-height: 400px; overflow-y: auto;">
                            {!! $row->$key ?? '<span style="color:#527597; font-style:italic;">Kosong</span>' !!}
                        </div>
                    @else
                        <strong>{{ $row->$key ?? '-' }}</strong>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
