@extends('admin.layout.index')

@section('title', 'Tambah Periode Kepengurusan')

@section('content')
<style>
    .period-form-layout { display: grid; grid-template-columns: 1fr 320px; gap: 24px; align-items: start; }
    .period-form-card { background: #fff; border: 1px solid #d0e1f0; border-radius: 16px; padding: 28px; box-shadow: 0 4px 15px rgba(10, 65, 116, .04); }
    .period-form-header { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #d0e1f0; }
    .period-form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
    .period-form-label { color: #0a4174; font-size: 11px; font-weight: 700; letter-spacing: .5px; text-transform: uppercase; }
    .period-form-control { width: 100%; padding: 11px 14px; border: 1px solid #d0e1f0; border-radius: 8px; background: #f4f8fb; color: #0a4174; font: inherit; font-size: 14px; outline: none; }
    .period-form-control:focus { border-color: #7bbde8; background: #fff; }
    .period-required { color: #ef4444; }
    .period-submit { width: 100%; padding: 12px; border: 0; border-radius: 8px; background: #0a4174; color: #fff; cursor: pointer; font-size: 13px; font-weight: 700; }
    .period-cancel { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; margin-top: 10px; padding: 10px; border: 1px solid #d0e1f0; border-radius: 8px; background: transparent; color: #527597; text-decoration: none; font-size: 13px; font-weight: 600; }
    .period-side-card { position: sticky; top: 24px; background: #fff; border: 1px solid #d0e1f0; border-radius: 16px; padding: 20px; box-shadow: 0 4px 15px rgba(10, 65, 116, .04); }
    .period-side-card h3 { margin-bottom: 8px; color: #0a4174; font-size: 15px; }
    .period-side-card p { color: #527597; font-size: 12px; line-height: 1.6; }
    @media (max-width: 992px) { .period-form-layout { grid-template-columns: 1fr; } .period-side-card { position: static; } }
</style>

<form method="POST" action="{{ route('admin.committee-periods.store') }}">
    @csrf
    <div class="period-form-layout">
        <div class="period-form-card">
            <div class="period-form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174;">Tambah Periode Kepengurusan</h2>
                <p style="font-size: 12px; color: #527597;">Lengkapi data periode yang akan digunakan pada Pengurus Alumni.</p>
            </div>

            <div class="period-form-group">
                <label class="period-form-label" for="period_name">Nama Periode <span class="period-required">*</span></label>
                <input class="period-form-control" id="period_name" name="period_name" type="text" maxlength="100" placeholder="Contoh: Periode 2026 - 2029" value="{{ old('period_name') }}" required>
            </div>
            <div class="period-form-group">
                <label class="period-form-label" for="start_date">Tanggal Mulai <span class="period-required">*</span></label>
                <input class="period-form-control" id="start_date" name="start_date" type="date" value="{{ old('start_date') }}" required>
            </div>
            <div class="period-form-group">
                <label class="period-form-label" for="finish_date">Tanggal Selesai</label>
                <input class="period-form-control" id="finish_date" name="finish_date" type="date" value="{{ old('finish_date') }}">
            </div>
        </div>

        <aside class="period-side-card">
            <h3>Aksi</h3>
            <p>Pastikan nama dan tanggal periode sudah benar sebelum disimpan.</p>
            <button type="submit" class="period-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Data</button>
            <a href="{{ route('admin.committee-periods.index') }}" class="period-cancel"><i class="fa-solid fa-arrow-left"></i> Batal</a>
        </aside>
    </div>
</form>
@endsection
