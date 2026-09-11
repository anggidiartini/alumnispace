@extends('admin.layout.index')

@section('page_title')
    {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}
@endsection

@section('content')
<style>
    .crud-card-full { width: 100%; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .btn-add { background: var(--color-primary); color: #fff; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--border-dark); }
    .table-responsive { width: 100%; overflow-x: auto; border: 1px solid var(--border-color); border-radius: 8px; }
    
    /* Style Tabel Melebar Penuh */
    .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
    .data-table th { background: var(--bg-main); padding: 14px 16px; color: var(--text-main); font-weight: 700; border-bottom: 2px solid var(--border-color); text-transform: uppercase; font-size: 11px; }
    .data-table td { padding: 14px 16px; border-bottom: 1px solid var(--border-color); color: var(--text-main); max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle; }
    
    /* Kolom Nomor Urut Khusus */
    .col-number-header { width: 60px; text-align: center; }
    .col-number-data { text-align: center; font-weight: 700; color: var(--text-muted); background-color: rgba(244, 248, 251, 0.5); }
    
    .action-badge { display: inline-flex; gap: 12px; }
    .btn-action { text-decoration: none; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 4px; }
    .btn-detail { color: #10b981; }
    .btn-edit { color: #3b82f6; }
    .btn-delete { color: #ef4444; background: none; border: none; cursor: pointer; font-family: inherit; }
    
    .pagination-wrapper { margin-top: 20px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: var(--text-muted); }
    .alert-success { padding: 12px 16px; border-radius: 8px; background-color: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; color: #166534; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
    .preview-img-mini { width: 44px; height: 44px; border-radius: 6px; object-fit: cover; border: 1px solid var(--border-color); }
</style>

@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="alert-success">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="crud-card-full">
    <div class="table-header">
        <div>
            <h2 style="font-size: 18px; font-weight: 700;">Daftar {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}</h2>
            <p style="font-size: 12px; color: var(--text-muted)">Gunakan halaman ini untuk memantau atau memperbarui susunan berkas informasi website.</p>
        </div>
        <a href="{{ route('admin.table.create', $table_key) }}" class="btn-add">
            <i class="fa-solid fa-plus"></i> Tambah Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <!-- Kepala Kolom Nomor Urut -->
                    <th class="col-number-header">No</th>
                    @foreach($mapping['list_columns'] as $col)
                        <th>{{ $mapping['fields'][$col]['label'] ?? ucwords(str_replace('_', ' ', $col)) }}</th>
                    @endforeach
                    <th style="text-align: center; width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($rows->count() > 0)
                    @foreach($rows as $row)
                        @php
                            $rowNumber = ($loop->index + 1) + ($rows->perPage() * ($rows->currentPage() - 1));
                        @endphp
                        <tr>
                            <td class="col-number-data">{{ $rowNumber }}</td>
                            @foreach($mapping['list_columns'] as $col)
                                <td>
                                    @if(in_array($col, ['avatar', 'thumbnail', 'photo_path', 'cover_photo']))
                                        @if(!empty($row->$col))
                                            <img src="{{ asset($row->$col) }}" class="preview-img-mini" alt="Foto">
                                        @else
                                            <span style="color: var(--text-muted); font-style: italic;">Tidak ada foto</span>
                                        @endif
                                    @elseif($col === 'study_status')
                                        <span style="background-color: {{ $row->$col === 'Aktif' ? '#d1fae5' : '#fee2e2' }}; color: {{ $row->$col === 'Aktif' ? '#065f46' : '#991b1b' }}; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 11px;">
                                            {{ $row->$col === 'Aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    @elseif(isset($mapping['fields'][$col]['type']) && $mapping['fields'][$col]['type'] === 'toggle')
                                        <span style="background-color: {{ $row->$col ? '#d1fae5' : '#fee2e2' }}; color: {{ $row->$col ? '#065f46' : '#991b1b' }}; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 11px;">
                                            {{ $mapping['fields'][$col]['options'][$row->$col] ?? ($row->$col ? 'Buka' : 'Tutup') }}
                                        </span>
                                    @else
                                        {{ strip_tags($row->$col) ?? '-' }}
                                    @endif
                                </td>
                            @endforeach
                            <td style="text-align: center;">
                                <div class="action-badge">
                                    <a href="{{ url('admin/table/'.$table_key.'/'.$row->id) }}" class="btn-action btn-detail">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.table.edit', [$table_key, $row->id]) }}" class="btn-action btn-edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.table.destroy', [$table_key, $row->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count($mapping['list_columns']) + 2 }}" style="text-align: center; padding: 40px; color: var(--text-muted)">
                            Belum ada riwayat data yang ditambahkan.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <div>Menampilkan {{ $rows->count() }} data di halaman ini.</div>
        <div>{!! $rows->links() !!}</div>
    </div>
</div>
@endsection
