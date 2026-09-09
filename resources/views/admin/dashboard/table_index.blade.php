@extends('admin.layout.index')

@section('page_title')
    Data Master: {{ strtoupper($table_key) }}
@endsection

@section('content')
<style>
    .crud-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .btn-add { background: var(--color-primary); color: #fff; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--border-dark); }
    .btn-add:hover { background: var(--bg-sidebar-hover); }
    .table-responsive { width: 100%; overflow-x: auto; border: 1px solid var(--border-color); border-radius: 8px; }
    .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
    .data-table th { background: var(--bg-main); padding: 12px 16px; color: var(--text-main); font-weight: 700; border-bottom: 2px solid var(--border-color); text-transform: uppercase; font-size: 11px; }
    .data-table td { padding: 14px 16px; border-bottom: 1px solid var(--border-color); color: var(--text-main); max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .action-badge { display: inline-flex; gap: 8px; }
    .btn-edit { color: #3b82f6; text-decoration: none; font-weight: 600; }
    .btn-delete { color: #ef4444; background: none; border: none; cursor: pointer; font-weight: 600; font-family: inherit; font-size: 13px; }
    .pagination-wrapper { margin-top: 20px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: var(--text-muted); }
    
    /* Style Flash Alert Sukses */
    .alert-success { padding: 12px 16px; border-radius: 8px; background-color: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; color: #166534; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; transition: all 0.3s ease; }
</style>

<!-- NOTIFIKASI BERHASIL FLUSH (OTOMATIS HILANG DALAM 4 DETIK) -->
@if (session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 4000)" 
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="alert-success">
        <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="crud-card">
    <div class="table-header">
        <div>
            <h2 style="font-size: 18px; font-weight: 700;">Daftar Konten Tabel `{{ $tableName }}`</h2>
            <p style="font-size: 12px; color: var(--text-muted)">Menampilkan data terstruktur langsung dari database.</p>
        </div>
        <a href="{{ route('admin.table.create', $table_key) }}" class="btn-add">
            <i class="fa-solid fa-plus"></i> Tambah Data
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    @foreach($columns as $col)
                        <th>{{ str_replace('_', ' ', $col) }}</th>
                    @endforeach
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($rows->count() > 0)
                    @foreach($rows as $row)
                        <tr>
                            @foreach($columns as $col)
                                <td>{{ $row->$col ?? '-' }}</td>
                            @endforeach
                            <td style="text-align: center;">
                                <div class="action-badge">
                                    <a href="{{ route('admin.table.edit', [$table_key, $row->id]) }}" class="btn-edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    
                                    <!-- NOTIFIKASI PERTANYAAN KONFIRMASI YAKIN SEBELUM HAPUS DATA -->
                                    <form action="{{ route('admin.table.destroy', [$table_key, $row->id]) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda benar-benar yakin ingin menghapus data ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count($columns) + 1 }}" style="text-align: center; padding: 40px; color: var(--text-muted)">
                            Belum ada records data di dalam tabel ini.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <div>Menampilkan {{ $rows->count() }} records.</div>
        <div>{!! $rows->links() !!}</div>
    </div>
</div>
@endsection
