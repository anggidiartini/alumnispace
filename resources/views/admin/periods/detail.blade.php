@extends('admin.layout.index')

@section('page_title', 'Detail Periode Kepengurusan')

@section('content')
<style>
    .period-button-primary, .period-button-secondary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 15px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; cursor: pointer; transition: transform .15s ease, box-shadow .15s ease; }
    .period-button-primary { border: 1px solid var(--border-dark); background: var(--color-primary); color: #fff; box-shadow: 0 4px 8px rgba(10, 65, 116, .15); }
    .period-button-secondary { border: 1px solid var(--border-color); background: #fff; color: var(--color-primary); }
    .period-button-primary:hover, .period-button-secondary:hover { transform: translateY(-1px); box-shadow: 0 6px 12px rgba(10, 65, 116, .16); }
</style>
<div class="crud-card-full">
    <div class="table-header">
        <div>
            <h2 style="font-size: 18px; font-weight: 700;">Detail Periode Kepengurusan</h2>
            <p style="font-size: 12px; color: var(--text-muted);">Informasi lengkap periode yang dipilih.</p>
        </div>
        <a href="{{ route('admin.committee-periods.index') }}" class="period-button-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Periode
        </a>
    </div>

    <div class="period-detail-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px;">
        <div style="padding: 18px; border: 1px solid var(--border-color); border-radius: 10px;">
            <small style="display: block; color: var(--text-muted); margin-bottom: 7px;">Nama Periode</small>
            <strong style="color: var(--text-main);">{{ $period->period_name }}</strong>
        </div>
        <div style="padding: 18px; border: 1px solid var(--border-color); border-radius: 10px;">
            <small style="display: block; color: var(--text-muted); margin-bottom: 7px;">Tanggal Mulai</small>
            <strong style="color: var(--text-main);">{{ $period->start_date ? \Carbon\Carbon::parse($period->start_date)->locale('id')->translatedFormat('d F Y') : '-' }}</strong>
        </div>
        <div style="padding: 18px; border: 1px solid var(--border-color); border-radius: 10px;">
            <small style="display: block; color: var(--text-muted); margin-bottom: 7px;">Tanggal Selesai</small>
            <strong style="color: var(--text-main);">{{ $period->finish_date ? \Carbon\Carbon::parse($period->finish_date)->locale('id')->translatedFormat('d F Y') : 'Masih Berjalan' }}</strong>
        </div>
    </div>

    <div style="display: flex; gap: 10px; margin-top: 22px;">
        <a href="{{ route('admin.committee-periods.edit', $period->id) }}" class="btn-action btn-edit">
            <i class="fa-solid fa-pen-to-square"></i> Edit Periode
        </a>
        <a href="{{ route('admin.table.index', 'alumni_boards') }}" class="btn-action btn-detail">
            <i class="fa-solid fa-users"></i> Ke Pengurus Alumni
        </a>
    </div>
</div>
@endsection
