@extends('admin.layout.index')

@section('page_title', 'Edit Periode Kepengurusan')

@section('content')
<style>
    .period-button-primary, .period-button-secondary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 15px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; cursor: pointer; transition: transform .15s ease, box-shadow .15s ease; }
    .period-button-primary { border: 1px solid var(--border-dark); background: var(--color-primary); color: #fff; box-shadow: 0 4px 8px rgba(10, 65, 116, .15); }
    .period-button-secondary { border: 1px solid var(--border-color); background: #fff; color: var(--color-primary); }
    .period-button-primary:hover, .period-button-secondary:hover { transform: translateY(-1px); box-shadow: 0 6px 12px rgba(10, 65, 116, .16); }
</style>
<div class="crud-card-full" style="max-width: 760px;">
    <div class="table-header">
        <div>
            <h2 style="font-size: 18px; font-weight: 700;">Edit Periode Kepengurusan</h2>
            <p style="font-size: 12px; color: var(--text-muted);">Perbarui informasi periode di bawah ini.</p>
        </div>
        <a href="{{ route('admin.committee-periods.index') }}" class="period-button-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.committee-periods.update', $period->id) }}" style="display: grid; gap: 16px;">
        @csrf
        @method('PUT')
        <div>
            <label for="period_name" style="display: block; margin-bottom: 6px; font-size: 12px; font-weight: 700; color: var(--text-main);">Nama Periode</label>
            <input id="period_name" name="period_name" type="text" value="{{ old('period_name', $period->period_name) }}" maxlength="100" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;">
        </div>
        <div>
            <label for="start_date" style="display: block; margin-bottom: 6px; font-size: 12px; font-weight: 700; color: var(--text-main);">Tanggal Mulai</label>
            <input id="start_date" name="start_date" type="date" value="{{ old('start_date', $period->start_date) }}" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;">
        </div>
        <div>
            <label for="finish_date" style="display: block; margin-bottom: 6px; font-size: 12px; font-weight: 700; color: var(--text-main);">Tanggal Selesai</label>
            <input id="finish_date" name="finish_date" type="date" value="{{ old('finish_date', $period->finish_date) }}" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;">
        </div>
        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 8px;">
            <a href="{{ route('admin.committee-periods.index') }}" class="btn-action btn-detail">Batal</a>
            <button type="submit" class="period-button-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
