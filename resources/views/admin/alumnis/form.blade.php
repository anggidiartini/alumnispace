@extends('admin.layout.index')

@section('title', (isset($row) ? 'Ubah Data' : 'Tambah Baru') . ' — ' . ($table_key === 'alumnis' ? 'Data Alumni' : $mapping['title']))

@section('content')
<style>
    .form-layout-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 340px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }

    .form-card-main,
    .form-card-sidebar,
    .achievement-card {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
        min-width: 0;
    }

    .form-card-sidebar {
        padding: 20px;
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
        box-sizing: border-box;
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #d0e1f0;
        border-radius: 8px;
        background: #f4f8fb;
        color: #0a4174;
        font-family: inherit;
        font-size: 14px;
        outline: none;
    }

    .form-control:focus {
        border-color: #7bbde8;
        background: #fff;
    }

    .field-hint {
        font-size: 11px;
        color: #64748b;
        margin-top: 2px;
    }

    .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

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
    }

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
        box-sizing: border-box;
        width: 100%;
        margin-top: 10px;
    }

    .achievement-section {
        margin-top: 24px;
    }

    .achievement-card {
        padding: 24px;
        margin-bottom: 20px;
    }

    .achievement-title {
        color: #0a4174;
        font-size: 18px;
        font-weight: 800;
        margin: 0 0 8px;
    }

    .achievement-description {
        color: #64748b;
        font-size: 13px;
        margin: 0 0 22px;
        line-height: 1.6;
    }

    .achievement-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 18px;
    }

    .achievement-table-wrap {
        overflow-x: auto;
        width: 100%;
    }

    .achievement-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .achievement-table th {
        background: #f4f8fb;
        color: #0a4174;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .4px;
        text-align: left;
        padding: 13px 12px;
        border-bottom: 1px solid #d0e1f0;
        white-space: nowrap;
    }

    .achievement-table td {
        color: #334155;
        padding: 13px 12px;
        border-bottom: 1px solid #e7eef5;
        vertical-align: middle;
    }

    .achievement-status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #dcfce7;
        color: #166534;
        font-size: 11px;
        font-weight: 700;
    }

    .achievement-status.inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-delete-achievement {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #be123c;
        border-radius: 7px;
        padding: 7px 10px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .achievement-empty {
        padding: 22px;
        text-align: center;
        color: #64748b;
        font-size: 13px;
        background: #f8fafc;
        border-radius: 10px;
    }

    .achievement-alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .achievement-alert.success {
        background: #dcfce7;
        color: #166534;
    }

    .achievement-alert.error {
        background: #fff1f2;
        color: #be123c;
    }

    @media (max-width: 992px) {
        .form-layout-grid {
            grid-template-columns: 1fr;
        }

        .form-card-sidebar {
            position: static;
        }
    }

    @media (max-width: 600px) {
        .form-card-main,
        .form-card-sidebar,
        .achievement-card {
            padding: 18px;
        }

        .achievement-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@if(session('status'))
    <div class="achievement-alert success">
        {{ session('status') }}
    </div>
@endif

@if($errors->any())
    <div class="achievement-alert error">
        <strong>Periksa kembali isian kamu:</strong>
        <ul style="margin: 8px 0 0 18px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM UTAMA DATA ALUMNI --}}
<form action="{{ isset($row) ? route('admin.alumnis.update', $row->id) : route('admin.alumnis.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @if(isset($row))
        @method('PUT')
    @endif

    <div class="form-layout-grid">

        {{-- KOLOM KIRI: DATA UTAMA --}}
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size:20px;font-weight:800;color:#0a4174;">
                    Isian Data Alumni
                </h2>
                <p style="font-size:12px;color:#527597;">
                    Lengkapi informasi alumni pada kolom berikut.
                </p>
            </div>

            @foreach($mapping['fields'] as $key => $field)

                {{-- KHUSUS FORM PENGURUS ALUMNI --}}
                @if($table_key === 'alumni_boards')

                    @if($key === 'alumni_profile_id')
                        <div class="form-group">
                            <label class="form-label">
                                Nama Lengkap Alumni
                                <span class="required-star">*</span>
                            </label>

                            <select name="alumni_profile_id" class="form-control" required>
                                <option value="">-- Pilih Alumni --</option>
                                @foreach(DB::table('alumni_profiles')
                                    ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                                    ->select('alumni_profiles.id', 'users.name')
                                    ->orderBy('users.name', 'asc')
                                    ->get() as $alumni)
                                    <option value="{{ $alumni->id }}"
                                        {{ (isset($row) && $row->alumni_profile_id == $alumni->id) ? 'selected' : '' }}>
                                        {{ $alumni->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($key === 'position')
                        <div class="form-group">
                            <label class="form-label">
                                Jabatan Struktural Pengurus
                                <span class="required-star">*</span>
                            </label>

                            <select name="position" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach($field['options'] as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ (isset($row) && $row->position == $value) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($key === 'committee_period_id')
                        <div class="form-group">
                            <label class="form-label">
                                Periode Kepengurusan
                                <span class="required-star">*</span>
                            </label>

                            <select name="committee_period_id" class="form-control" required>
                                <option value="">-- Pilih Periode --</option>
                                @foreach(DB::table('committee_periods')->orderBy('id', 'desc')->get() as $p)
                                    <option value="{{ $p->id }}"
                                        {{ (isset($row) && $row->committee_period_id == $p->id) ? 'selected' : '' }}>
                                        {{ $p->period_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @php continue; @endphp
                @endif

                {{-- FILE DAN STATUS DI KOLOM KANAN --}}
                @if(
                    $field['type'] === 'file' ||
                    $field['type'] === 'toggle' ||
                    $field['type'] === 'select' ||
                    $key === 'study_status' ||
                    $key === 'status'
                )
                    @continue
                @endif

                @php
                    $isRequired = !empty($field['required']);
                    $isReadonly = !empty($field['readonly']);
                @endphp

                <div class="form-group">
                    <label class="form-label">
                        {{ $field['label'] }}
                        @if($isRequired)
                            <span class="required-star">*</span>
                        @endif
                    </label>

                    @if($field['type'] === 'textarea')
                        <textarea
                            name="{{ $key }}"
                            rows="5"
                            class="form-control"
                            placeholder="Masukkan {{ $field['label'] }}..."
                            {{ $isRequired ? 'required' : '' }}
                            {{ $isReadonly ? 'readonly' : '' }}
                        >{{ old($key, isset($row) ? ($row->$key ?? '') : '') }}</textarea>

                    @elseif($key === 'graduation_year')
                        <input
                            type="number"
                            name="{{ $key }}"
                            class="form-control"
                            min="1901"
                            max="2100"
                            value="{{ old($key, isset($row) ? ($row->$key ?? date('Y')) : date('Y')) }}"
                            required
                        >

                    @else
                        <input
                            type="{{ $field['type'] }}"
                            name="{{ $key }}"
                            class="form-control"
                            value="{{ old($key, isset($row) ? ($row->$key ?? '') : '') }}"
                            placeholder="Masukkan {{ $field['label'] }}..."
                            {{ $isRequired ? 'required' : '' }}
                            {{ $isReadonly ? 'readonly' : '' }}
                        >
                    @endif
                </div>
            @endforeach
        </div>

        {{-- KOLOM KANAN: FOTO DAN STATUS --}}
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom:16px;padding-bottom:8px;">
                <h3 style="font-size:14px;font-weight:700;color:#0a4174;">
                    Media & Status
                </h3>
            </div>

            @foreach($mapping['fields'] as $key => $field)
                @if(
                    $field['type'] === 'file' ||
                    $field['type'] === 'toggle' ||
                    $field['type'] === 'select' ||
                    $key === 'study_status' ||
                    $key === 'status'
                )
                    <div class="form-group">
                        <label class="form-label">{{ $field['label'] }}</label>

                        @if($field['type'] === 'file')
                            <input
                                type="file"
                                name="{{ $key }}"
                                class="form-control"
                                accept="image/*"
                                onchange="previewImage(this, 'side-preview-{{ $key }}')"
                            >

                            <div style="margin-top:8px;text-align:center;background:#f8fafc;border:1px dashed #d0e1f0;border-radius:8px;padding:6px;min-height:120px;display:flex;align-items:center;justify-content:center;">
                                <img
                                    id="side-preview-{{ $key }}"
                                    src="{{ (isset($row) && !empty($row->$key)) ? (Str::startsWith($row->$key, 'http') ? $row->$key : asset($row->$key)) : asset('assets/images/no-image.webp') }}"
                                    style="max-width:100%;max-height:140px;border-radius:6px;object-fit:cover;"
                                    alt="Pratinjau foto"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image.webp') }}';"
                                >
                            </div>

                        @elseif($field['type'] === 'select' || $field['type'] === 'toggle' || $key === 'study_status' || $key === 'status')
                            <select name="{{ $key }}" class="form-control">
                                @foreach($field['options'] as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old($key, isset($row) ? ($row->$key ?? '') : '') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                @endif
            @endforeach

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    {{ isset($row) ? 'Simpan Perubahan' : 'Simpan Data Alumni' }}
                </button>

                <a href="{{ route('admin.alumnis.index') }}" class="btn-cancel">
                    Batalkan
                </a>
            </div>
        </div>

    </div>
</form>

{{-- PENGELOLAAN PRESTASI: KHUSUS HALAMAN EDIT --}}
@if($table_key === 'alumnis' && isset($row))

    <div class="achievement-section">

        {{-- FORM TAMBAH PRESTASI --}}
        <div class="achievement-card">
            <h2 class="achievement-title">Tambah Prestasi Baru</h2>
            <p class="achievement-description">
                Tambahkan penghargaan, sertifikat, atau pencapaian yang dimiliki alumni ini.
                Data prestasi disimpan terpisah dari data profil.
            </p>

            <form action="{{ route('admin.achievements.store') }}" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="alumni_profile_id"
                    value="{{ $row->id }}"
                >

                <div class="achievement-grid">
                    <div class="form-group">
                        <label class="form-label">
                            Nama Prestasi <span class="required-star">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Juara 1 Lomba Desain"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Tanggal Prestasi <span class="required-star">*</span>
                        </label>
                        <input
                            type="date"
                            name="date"
                            class="form-control"
                            value="{{ old('date') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Jenis Prestasi <span class="required-star">*</span>
                        </label>
                        <input
                            type="text"
                            name="type"
                            class="form-control"
                            value="{{ old('type') }}"
                            placeholder="Contoh: Akademik, Non-akademik"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Status <span class="required-star">*</span>
                        </label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-submit" style="max-width:240px;">
                    + Tambah Prestasi
                </button>
            </form>
        </div>

        {{-- DAFTAR PRESTASI YANG SUDAH TERSIMPAN --}}
        <div class="achievement-card">
            <h2 class="achievement-title">Daftar Prestasi Alumni</h2>
            <p class="achievement-description">
                Prestasi yang sudah tersimpan untuk alumni ini.
            </p>

            @if(isset($achievements) && $achievements->count() > 0)
                <div class="achievement-table-wrap">
                    <table class="achievement-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Prestasi</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($achievements as $index => $achievement)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $achievement->name }}</td>
                                    <td>
                                        {{ $achievement->date ? \Illuminate\Support\Carbon::parse($achievement->date)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td>{{ $achievement->type }}</td>
                                    <td>
                                        @if($achievement->status)
                                            <span class="achievement-status">Aktif</span>
                                        @else
                                            <span class="achievement-status inactive">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form
                                            action="{{ route('admin.achievements.destroy', $achievement->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete-achievement">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="achievement-empty">
                    Belum ada prestasi yang ditambahkan untuk alumni ini.
                </div>
            @endif
        </div>
    </div>
@endif

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0] && preview) {
            const reader = new FileReader();

            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.style.objectFit = 'cover';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
