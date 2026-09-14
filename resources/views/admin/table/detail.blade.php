@extends('admin.layout.index')

@section('page_title')
    Tinjau Detail — {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}
@endsection

@section('content')
<style>
    .detail-card-full { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; padding: 32px; width: 100%; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .detail-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 20px; margin-bottom: 24px; }
    .detail-container-box { background-color: var(--bg-main); border-radius: 12px; padding: 16px 28px; border: 1px solid var(--border-color); }
    .detail-grid { display: grid; grid-template-columns: 240px 1fr; gap: 16px; border-bottom: 1px solid #e2e8f0; padding: 16px 0; font-size: 14px; }
    .detail-grid:last-of-type { border-bottom: none; }
    .label-side { font-weight: 700; color: var(--text-muted); text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; display: flex; align-items: center; }
    .value-side { color: var(--text-main); font-weight: 500; line-height: 1.6; }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 10px 18px; border: 1px solid var(--border-color); color: var(--text-muted); font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; }
    .btn-back:hover { background-color: #e2e8f0; color: var(--text-main); }
    .btn-edit-direct { display: inline-flex; align-items: center; gap: 6px; text-decoration: none; padding: 10px 18px; background-color: #3b82f6; color: white; font-size: 13px; font-weight: 600; border-radius: 8px; }
    .detail-preview-img { max-width: 120px; max-height: 120px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border-color); }
</style>

<div class="detail-card-full">
    <div class="detail-header">
        <div>
            <h2 style="font-size: 20px; font-weight: 800; color: var(--text-main);">Arsip Informasi Lengkap</h2>
            <p style="font-size: 12px; color: var(--text-muted);">Tinjauan rincian berkas informasi yang tersimpan di dalam sistem operasional.</p>
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('admin.table.edit', [$table_key, $row->id]) }}" class="btn-edit-direct">
                <i class="fa-solid fa-pen-to-square"></i> Sunting Informasi
            </a>
            <a href="{{ route('admin.table.index', $table_key) }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="detail-container-box">
        <div class="detail-grid">
            <div class="label-side"><i class="fa-solid fa-file-signature" style="margin-right: 6px;"></i> Nomor Arsip Registrasi</div>
            <div class="value-side" style="font-weight: bold; color: #1e3a8a;">REG-{{ sprintf('%04d', $row->id) }}</div>
        </div>

        @foreach($mapping['fields'] as $key => $field)
            <div class="detail-grid">
                <div class="label-side">{{ $field['label'] }}</div>
                <div class="value-side">
                    <!-- JIKA BERUPA FORMAT FILE GAMBAR/PREVIEW FOTO -->
                    @if($field['type'] === 'file')
                        @if(!empty($row->$key))
                            <img src="{{ asset($row->$key) }}" class="detail-preview-img" alt="Foto">
                        @else
                            <span style="color: var(--text-muted); font-style: italic;">Tidak ada lampiran foto</span>
                        @endif
                    <!-- JIKA BERUPA CHOSEN TOGGLE STATUS -->
                    @elseif($field['type'] === 'toggle')
                        <span style="background-color: {{ $row->$key ? '#d1fae5' : '#fee2e2' }}; color: {{ $row->$key ? '#065f46' : '#991b1b' }}; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: bold; display: inline-block;">
                            {{ $field['options'][$row->$key] ?? ($row->$key ? 'Buka' : 'Tutup') }}
                        </span>
                    @elseif($field['type'] === 'select')
                        <span style="background-color: {{ $row->$key === 'Aktif' ? '#d1fae5' : '#fee2e2' }}; color: {{ $row->$key === 'Aktif' ? '#065f46' : '#991b1b' }}; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: bold; display: inline-block;">
                            {{ $field['options'][$row->$key] ?? $row->$key }}
                        </span>
                    @else
                        {!! nl2br(e($row->$key ?? '-')) !!}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
