@extends('admin.layout.index')

@section('page_title', isset($board) ? 'Edit Pengurus Alumni' : 'Tambah Pengurus Alumni')

@section('content')
<style>
    .form-layout-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
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
    }
    .form-control:focus {
        border-color: #2563eb;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .field-hint { font-size: 11px; color: #64748b; margin-top: 2px; }
    .required-star { color: #ef4444; margin-left: 2px; }
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

<form action="{{ isset($board) ? route('admin.alumni-boards.update', $board->id) : route('admin.alumni-boards.store') }}" method="POST">
    @csrf
    @if(isset($board))
        @method('PUT')
    @endif

    @if(session('error') || (isset($errors) && $errors->any()))
        <div style="padding: 14px 18px; border-radius: 10px; background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation" style="margin-top: 3px; font-size: 16px;"></i>
            <div>
                @if(session('error'))
                    <div>{{ session('error') }}</div>
                @endif
                @if(isset($errors) && $errors->any())
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif

    <div class="form-layout-grid">
        <!-- KOLOM KIRI: INPUT FORM UTAMA -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174; margin: 0 0 4px 0;">
                    {{ isset($board) ? 'Sunting Pengurus Alumni' : 'Tambah Pengurus Alumni Baru' }}
                </h2>
                <p style="font-size: 12px; color: #527597; margin: 0;">Tentukan alumni, posisi jabatan struktural, dan periode kepengurusan aktif.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Alumni <span class="required-star">*</span></label>
                <select name="alumni_profile_id" class="form-control" required>
                    <option value="">-- Pilih Profil Alumni --</option>
                    @foreach($alumni as $person)
                        <option value="{{ $person->id }}" @selected(old('alumni_profile_id', $board->alumni_profile_id ?? '') == $person->id)>
                            {{ $person->name }}
                        </option>
                    @endforeach
                </select>
                <div class="field-hint">Pilih dari data alumni yang sudah terdaftar dalam sistem.</div>
            </div>

            <div class="form-group">
                <label class="form-label">Jabatan Kepengurusan <span class="required-star">*</span></label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $board->position ?? '') }}" placeholder="Contoh: Ketua Umum Alumni, Sekretaris, Divisi Hubungan Masyarakat..." required list="commonPositions">
                <datalist id="commonPositions">
                    <option value="Ketua Umum Alumni">
                    <option value="Wakil Ketua Umum">
                    <option value="Sekretaris">
                    <option value="Bendahara">
                    <option value="Divisi Hubungan Masyarakat">
                    <option value="Divisi Kreatif & Acara">
                    <option value="Divisi Pengembangan Karier">
                </datalist>
            </div>

            <div class="form-group">
                <label class="form-label">Periode Kepengurusan <span class="required-star">*</span></label>
                <select name="committee_period_id" class="form-control" required>
                    <option value="">-- Pilih Periode Kepengurusan --</option>
                    @foreach($periods as $period)
                        <option value="{{ $period->id }}" @selected(old('committee_period_id', $board->committee_period_id ?? '') == $period->id)>
                            {{ $period->period_name }} ({{ $period->start_date ? \Carbon\Carbon::parse($period->start_date)->format('Y') : '' }} - {{ $period->finish_date ? \Carbon\Carbon::parse($period->finish_date)->format('Y') : 'Sekarang' }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- KOLOM KANAN: INFORMASI PENDUKUNG & SUBMIT -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom: 16px; padding-bottom: 8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0;">Pengaturan & Tindakan</h3>
            </div>

            <div style="background: #f0f7ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 14px; margin-bottom: 20px;">
                <div style="font-size: 12px; font-weight: 700; color: #1e3a8a; margin-bottom: 4px;">
                    <i class="fa-solid fa-calendar-days" style="color: #2563eb;"></i> Kelola Periode
                </div>
                <div style="font-size: 11px; color: #475569; line-height: 1.5; margin-bottom: 8px;">
                    Periode kepengurusan yang Anda butuhkan belum ada di daftar?
                </div>
                <a href="{{ route('admin.committee-periods.index') }}" target="_blank" style="font-size: 12px; font-weight: 700; color: #2563eb; text-decoration: underline;">
                    Buka Kelola Periode <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 10px;"></i>
                </a>
            </div>

            <button type="submit" class="btn-submit">Simpan Data Pengurus</button>
            <a href="{{ route('admin.alumni-boards.index') }}" class="btn-cancel">Batalkan</a>
        </div>
    </div>
</form>
@endsection