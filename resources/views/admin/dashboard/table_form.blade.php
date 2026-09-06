@extends('admin.layout.index')

@section('page_title')
    {{ isset($row) ? 'Ubah Data' : 'Tambah Baru' }} - {{ strtoupper($table_key) }}
@endsection

@section('content')
<style>
    .form-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 28px; max-width: 700px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .form-header { margin-bottom: 24px; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; }
    .form-group { margin-bottom: 20px; display: flex; flex-direction: column; gap: 6px; }
    .form-label { font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--text-main); letter-spacing: 0.3px; }
    .form-card .form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--border-color); border-radius: 6px; background: var(--bg-main); color: var(--text-main); font-family: inherit; font-size: 14px; }
    .form-card .form-control:focus { outline: none; border-color: var(--color-secondary); }
    .form-actions { margin-top: 28px; display: flex; gap: 12px; }
    .btn-submit { background: var(--color-primary); color: white; padding: 10px 20px; border: 1px solid var(--border-dark); border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px; }
    .btn-cancel { background: transparent; color: var(--text-muted); border: 1px solid var(--border-color); padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 13px; text-align: center; }
</style>

<div class="form-card">
    <div class="form-header">
        <h2 style="font-size: 18px; font-weight: 800;">{{ isset($row) ? 'Form Pembaruan' : 'Form Pengisian Baru' }}</h2>
        <p style="font-size: 12px; color: var(--text-muted)">Skema tabel database: `{{ $tableName }}`</p>
    </div>

    <form action="{{ isset($row) ? route('admin.table.update', [$table_key, $row->id]) : route('admin.table.store', $table_key) }}" method="POST">
        @csrf
        @if(isset($row))
            @method('PUT')
        @endif

        @foreach($columns as $col)
            @continue($col === 'slug')
            
            <div class="form-group">
                <label class="form-label">{{ str_replace('_', ' ', $col) }}</label>
                
                @if(Str::contains($col, ['bio', 'description', 'requirements', 'content', 'payload', 'quote']))
                    <textarea name="{{ $col }}" rows="5" class="form-control" placeholder="Tulis {{ $col }}...">{{ isset($row) ? $row->$col : '' }}</textarea>
                @elseif(Str::contains($col, ['year', 'quota', 'rating', 'is_active', 'is_online', 'is_verified']))
                    <input type="number" name="{{ $col }}" class="form-control" value="{{ isset($row) ? $row->$col : '0' }}">
                @elseif(Str::contains($col, ['date']))
                    <input type="date" name="{{ $col }}" class="form-control" value="{{ isset($row) ? $row->$col : '' }}">
                @elseif(Str::contains($col, ['time']))
                    <input type="time" name="{{ $col }}" class="form-control" value="{{ isset($row) ? $row->$col : '' }}">
                @else
                    <input type="text" name="{{ $col }}" class="form-control" value="{{ isset($row) ? $row->$col : '' }}" placeholder="Isi {{ $col }}...">
                @endif
            </div>
        @endforeach

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Data
            </button>
            <a href="{{ route('admin.table.index', $table_key) }}" class="btn-cancel">Kembali</a>
        </div>
    </form>
</div>
@endsection
