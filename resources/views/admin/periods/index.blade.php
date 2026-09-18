@extends('admin.layout.index')

@section('page_title', 'Periode Kepengurusan')

@section('content')
<style>
    .period-card { width: 100%; background: #fff; border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,.02); }
    .period-header { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 20px; flex-wrap: wrap; }
    .period-header h2 { color: var(--text-main); font-size: 18px; font-weight: 700; }
    .period-header p { margin-top: 5px; color: var(--text-muted); font-size: 12px; }
    .period-button-primary, .period-button-secondary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 15px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; cursor: pointer; transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease; }
    .period-button-primary { border: 1px solid var(--border-dark); background: var(--color-primary); color: #fff; box-shadow: 0 4px 8px rgba(10, 65, 116, .15); }
    .period-button-secondary { border: 1px solid var(--border-color); background: #fff; color: var(--color-primary); }
    .period-button-primary:hover, .period-button-secondary:hover { transform: translateY(-1px); box-shadow: 0 6px 12px rgba(10, 65, 116, .16); }
    .period-table-wrap { overflow-x: auto; border: 1px solid var(--border-color); border-radius: 10px; }
    .period-table { width: 100%; border-collapse: collapse; color: var(--text-main); font-size: 13px; }
    .period-table th { padding: 13px 15px; background: var(--bg-main); border-bottom: 2px solid var(--border-color); text-align: left; font-size: 11px; text-transform: uppercase; }
    .period-table td { padding: 14px 15px; border-bottom: 1px solid var(--border-color); }
    .period-table tr:last-child td { border-bottom: 0; }
    .period-alert { margin-bottom: 18px; padding: 12px 15px; border: 1px solid #86efac; border-radius: 8px; background: #ecfdf5; color: #166534; font-size: 13px; font-weight: 600; }
    .period-actions { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .period-button { display: inline-flex; align-items: center; gap: 5px; padding: 7px 10px; border: 0; border-radius: 7px; cursor: pointer; font: inherit; font-size: 12px; font-weight: 700; text-decoration: none; }
    .period-detail { background: #ecfdf5; color: #047857; }
    .period-edit { background: #eff6ff; color: #1d4ed8; }
    .period-delete { background: #fef2f2; color: #b91c1c; }
    .period-empty { padding: 38px 15px !important; color: var(--text-muted) !important; text-align: center !important; }
</style>

<div class="period-card">
    @if (session('success'))
        <div class="period-alert"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
    @endif

    <div class="period-header">
        <div>
            <h2>Periode Kepengurusan</h2>
            <p>Tambahkan dan lihat periode yang bisa dipilih saat mengisi data Pengurus Alumni.</p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('admin.table.index', 'alumni_boards') }}" class="period-button-secondary">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Pengurus Alumni
            </a>
            <a href="{{ route('admin.committee-periods.create') }}" class="period-button-primary">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <div class="period-table-wrap">
        <table class="period-table">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama Periode</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th style="width: 250px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($periods as $period)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $period->period_name }}</strong></td>
                        <td>{{ $period->start_date ? \Carbon\Carbon::parse($period->start_date)->locale('id')->translatedFormat('d F Y') : '-' }}</td>
                        <td>{{ $period->finish_date ? \Carbon\Carbon::parse($period->finish_date)->locale('id')->translatedFormat('d F Y') : 'Masih Berjalan' }}</td>
                        <td>
                            <div class="period-actions">
                                <a href="{{ route('admin.committee-periods.show', $period->id) }}" class="period-button period-detail" title="Lihat detail periode">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.committee-periods.edit', $period->id) }}" class="period-button period-edit" title="Edit periode">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                            <form method="POST" action="{{ route('admin.committee-periods.destroy', $period->id) }}" onsubmit="return confirm('Hapus periode ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="period-button period-delete" title="Hapus periode"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="period-empty">Belum ada periode kepengurusan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
