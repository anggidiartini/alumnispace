@extends('admin.layout.index')

@section('page_title', 'Tambah Periode Kepengurusan')

@section('content')
<style>
    .form-layout-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }
    .form-card-main {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
    }
    .form-card-sidebar {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
        position: sticky;
        top: 24px;
    }
    .form-header {
        margin-bottom: 24px;
        border-bottom: 1px solid #d0e1f0;
        padding-bottom: 16px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 18px;
    }
    .form-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #0a4174;
        letter-spacing: 0.5px;
    }
    .form-control {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #d0e1f0;
        border-radius: 8px;
        background: #f4f8fb;
        color: #0a4174;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }
    .form-control:focus {
        border-color: #2563eb;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .required-star { color: #ef4444; margin-left: 2px; }
    .field-hint { font-size: 11px; color: #64748b; margin-top: 2px; }
    .btn-submit {
        background: #0a4174;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        font-size: 13px;
        width: 100%;
        transition: background 0.15s ease;
    }
    .btn-submit:hover { background: #08335c; }
    .btn-cancel {
        background: transparent;
        color: #527597;
        border: 1px solid #d0e1f0;
        padding: 10px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        text-align: center;
        display: block;
        width: 100%;
        margin-top: 10px;
        transition: all 0.15s ease;
    }
    .btn-cancel:hover { background: #f8fafc; color: #0a4174; }
    @media (max-width: 992px) {
        .form-layout-grid { grid-template-columns: 1fr; }
        .form-card-sidebar { position: static; }
    }
</style>

<form method="POST" action="{{ route('admin.committee-periods.store') }}">
    @csrf

    @if($errors->any())
        <div style="padding: 14px 18px; border-radius: 10px; background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation" style="margin-top: 3px; font-size: 16px;"></i>
            <ul style="margin: 0; padding-left: 18px;">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-layout-grid">
        <!-- KIRI: DATA PERIODE -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">
                    Tambah Periode Kepengurusan
                </h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Lengkapi data periode yang akan digunakan pada Pengurus Alumni.</p>
            </div>

            <div class="form-group">
                <label class="form-label" for="period_name">Nama Periode <span class="required-star">*</span></label>
                <input class="form-control" id="period_name" name="period_name" type="text"
                    maxlength="100" placeholder="Contoh: Periode 2026 – 2029"
                    value="{{ old('period_name') }}" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label" for="start_date">Tanggal Mulai <span class="required-star">*</span></label>
                    <input class="form-control" id="start_date" name="start_date" type="date"
                        value="{{ old('start_date') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="finish_date">Tanggal Selesai</label>
                    <input class="form-control" id="finish_date" name="finish_date" type="date"
                        value="{{ old('finish_date') }}">
                    <span class="field-hint">Kosongkan jika periode masih berjalan.</span>
                </div>
            </div>
        </div>

        <!-- KANAN: AKSI -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom: 16px; padding-bottom: 8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0;">Aksi</h3>
            </div>
            <p style="font-size: 12px; color: #527597; margin: 0 0 16px 0; line-height: 1.6;">
                Pastikan nama dan tanggal periode sudah benar sebelum disimpan.
            </p>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Data
            </button>
            <a href="{{ route('admin.committee-periods.index') }}" class="btn-cancel">
                <i class="fa-solid fa-arrow-left me-1"></i> Batal
            </a>
        </div>
    </div>
</form>
@endsection
