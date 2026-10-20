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
        background: #fff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, .04);
        min-width: 0;
    }

    .form-card-sidebar {
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
        letter-spacing: .5px;
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

    .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

    .btn-submit {
        background: #0a4174;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        font-size: 13px;
        width: 100%;
    }

    .btn-submit:hover {
        background: #08345d;
    }

    .btn-cancel {
        background: #fff;
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
        white-space: nowrap;
    }

    .achievement-status.inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-achievement {
        border: 1px solid #bfdbfe;
        background: #eaf4ff;
        color: #1d4ed8;
        border-radius: 7px;
        padding: 7px 10px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .btn-achievement-delete {
        background: #fff1f2;
        border-color: #fecdd3;
        color: #be123c;
    }

    .btn-achievement-save {
        background: #dcfce7;
        border-color: #bbf7d0;
        color: #166534;
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

    .achievement-edit-field[hidden] {
        display: none !important;
    }

    .achievement-edit-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
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
            padding: 16px;
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
<form
    action="{{ isset($row) ? route('admin.alumnis.update', $row->id) : route('admin.alumnis.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if(isset($row))
        @method('PUT')
    @endif

    <div class="form-layout-grid">
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size:20px;font-weight:800;color:#0a4174;margin:0 0 6px;">
                    Isian Data Alumni
                </h2>
                <p style="font-size:12px;color:#527597;margin:0;">
                    Lengkapi informasi alumni pada kolom berikut.
                </p>
            </div>

            @foreach($mapping['fields'] as $key => $field)
                @if($table_key === 'alumnis' && $key === 'achievements')
                    @continue
                @endif

                {{-- FORM KHUSUS PENGURUS ALUMNI --}}
                @if($table_key === 'alumni_boards')
                    @if($key === 'alumni_profile_id')
                        <div class="form-group">
                            <label class="form-label">
                                Nama Lengkap Alumni <span class="required-star">*</span>
                            </label>

                            <select name="alumni_profile_id" class="form-control" required>
                                <option value="">-- Pilih Alumni --</option>

                                @foreach(DB::table('alumni_profiles')
                                    ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                                    ->select('alumni_profiles.id', 'users.name')
                                    ->orderBy('users.name')
                                    ->get() as $alumni)
                                    <option
                                        value="{{ $alumni->id }}"
                                        {{ old('alumni_profile_id', $row->alumni_profile_id ?? '') == $alumni->id ? 'selected' : '' }}
                                    >
                                        {{ $alumni->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($key === 'position')
                        <div class="form-group">
                            <label class="form-label">
                                Jabatan Struktural <span class="required-star">*</span>
                            </label>

                            <select name="position" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>

                                @foreach($field['options'] ?? [] as $value => $label)
                                    <option
                                        value="{{ $value }}"
                                        {{ old('position', $row->position ?? '') == $value ? 'selected' : '' }}
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($key === 'committee_period_id')
                        <div class="form-group">
                            <label class="form-label">
                                Periode Kepengurusan <span class="required-star">*</span>
                            </label>

                            <select name="committee_period_id" class="form-control" required>
                                <option value="">-- Pilih Periode --</option>

                                @foreach(DB::table('committee_periods')->orderByDesc('id')->get() as $period)
                                    <option
                                        value="{{ $period->id }}"
                                        {{ old('committee_period_id', $row->committee_period_id ?? '') == $period->id ? 'selected' : '' }}
                                    >
                                        {{ $period->period_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @continue
                @endif

                {{-- FIELD SIDEBAR TIDAK DIULANG DI KOLOM KIRI --}}
                @if(
                    ($field['type'] ?? '') === 'file' ||
                    ($field['type'] ?? '') === 'toggle' ||
                    ($field['type'] ?? '') === 'select' ||
                    in_array($key, ['study_status', 'status'])
                )
                    @continue
                @endif

                @php
                    $fieldType = $field['type'] ?? 'text';
                    $isRequired = !empty($field['required']);
                    $isReadonly = !empty($field['readonly']);
                    $currentValue = old($key, isset($row) ? ($row->$key ?? '') : '');
                @endphp

                <div class="form-group">
                    <label class="form-label" for="field-{{ $key }}">
                        {{ $field['label'] ?? ucfirst(str_replace('_', ' ', $key)) }}
                        @if($isRequired)
                            <span class="required-star">*</span>
                        @endif
                    </label>

                    @if($fieldType === 'textarea')
                        <textarea
                            id="field-{{ $key }}"
                            name="{{ $key }}"
                            rows="5"
                            class="form-control"
                            placeholder="Masukkan {{ $field['label'] ?? $key }}..."
                            {{ $isRequired ? 'required' : '' }}
                            {{ $isReadonly ? 'readonly' : '' }}
                        >{{ $currentValue }}</textarea>

                    @elseif($fieldType === 'select')
                        <select
                            id="field-{{ $key }}"
                            name="{{ $key }}"
                            class="form-control"
                            {{ $isRequired ? 'required' : '' }}
                        >
                            <option value="">-- Pilih --</option>
                            @foreach($field['options'] ?? [] as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    {{ (string) $currentValue === (string) $value ? 'selected' : '' }}
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                    @elseif($key === 'graduation_year')
                        <input
                            id="field-{{ $key }}"
                            type="number"
                            name="{{ $key }}"
                            class="form-control"
                            min="1901"
                            max="2100"
                            value="{{ $currentValue ?: date('Y') }}"
                            required
                        >

                    @else
                        <input
                            id="field-{{ $key }}"
                            type="{{ $fieldType }}"
                            name="{{ $key }}"
                            class="form-control"
                            value="{{ $currentValue }}"
                            placeholder="Masukkan {{ $field['label'] ?? $key }}..."
                            {{ $isRequired ? 'required' : '' }}
                            {{ $isReadonly ? 'readonly' : '' }}
                        >
                    @endif

                    @error($key)
                        <small style="color:#dc2626;font-size:12px;">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach
        </div>

        {{-- MEDIA DAN STATUS --}}
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom:16px;padding-bottom:10px;">
                <h3 style="font-size:14px;font-weight:700;color:#0a4174;margin:0;">
                    Media & Status
                </h3>
            </div>

            @foreach($mapping['fields'] as $key => $field)
                @if(
                    ($field['type'] ?? '') === 'file' ||
                    ($field['type'] ?? '') === 'toggle' ||
                    ($field['type'] ?? '') === 'select' ||
                    in_array($key, ['study_status', 'status'])
                )
                    <div class="form-group">
                        <label class="form-label" for="sidebar-{{ $key }}">
                            {{ $field['label'] ?? ucfirst(str_replace('_', ' ', $key)) }}
                            @if(!empty($field['required']))
                                <span class="required-star">*</span>
                            @endif
                        </label>

                        @if(($field['type'] ?? '') === 'file')
                            <input
                                id="sidebar-{{ $key }}"
                                type="file"
                                name="{{ $key }}"
                                class="form-control"
                                accept="image/*"
                                onchange="previewImage(this, 'side-preview-{{ $key }}')"
                                {{ !empty($field['required']) && !isset($row) ? 'required' : '' }}
                            >

                            <small style="font-size:11px;color:#64748b;line-height:1.5;">
                                Pilih gambar jika ingin mengganti gambar saat ini.
                            </small>

                            @php
                                $imageValue = isset($row) ? ($row->$key ?? '') : '';
                                $imageUrl = $imageValue
                                    ? (\Illuminate\Support\Str::startsWith($imageValue, ['http://', 'https://'])
                                        ? $imageValue
                                        : asset($imageValue))
                                    : asset('assets/images/no-image.webp');
                            @endphp

                            <div style="margin-top:8px;text-align:center;background:#f8fafc;border:1px dashed #d0e1f0;border-radius:8px;padding:6px;min-height:120px;display:flex;align-items:center;justify-content:center;">
                                <img
                                    id="side-preview-{{ $key }}"
                                    src="{{ $imageUrl }}"
                                    style="max-width:100%;max-height:140px;border-radius:6px;object-fit:contain;"
                                    alt="Pratinjau foto"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image.webp') }}';"
                                >
                            </div>

                        @elseif(
                            ($field['type'] ?? '') === 'select' ||
                            ($field['type'] ?? '') === 'toggle' ||
                            in_array($key, ['study_status', 'status'])
                        )
                            <select
                                id="sidebar-{{ $key }}"
                                name="{{ $key }}"
                                class="form-control"
                                {{ !empty($field['required']) ? 'required' : '' }}
                            >
                                @foreach($field['options'] ?? [0 => 'Tidak Aktif', 1 => 'Aktif'] as $value => $label)
                                    <option
                                        value="{{ $value }}"
                                        {{ (string) old($key, isset($row) ? ($row->$key ?? '') : '') === (string) $value ? 'selected' : '' }}
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                @endif
            @endforeach

            <button type="submit" class="btn-submit">
                {{ isset($row) ? 'Simpan Perubahan' : 'Simpan Data Alumni' }}
            </button>

            <a href="{{ route('admin.alumnis.index') }}" class="btn-cancel">
                Batalkan
            </a>
        </div>
    </div>
</form>

{{-- PENGELOLAAN PRESTASI ALUMNI --}}
@if($table_key === 'alumnis' && isset($row))
    <div class="achievement-section">

        {{-- TAMBAH PRESTASI --}}
        <div class="achievement-card">
            <h2 class="achievement-title">Tambah Prestasi Baru</h2>
            <p class="achievement-description">
                Masukkan nama prestasi dan tentukan statusnya.
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
                        <label class="form-label" for="achievement-name">
                            Nama Prestasi <span class="required-star">*</span>
                        </label>
                        <input
                            id="achievement-name"
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
                        <label class="form-label" for="achievement-status">
                            Status <span class="required-star">*</span>
                        </label>
                        <select id="achievement-status" name="status" class="form-control" required>
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

        {{-- DAFTAR PRESTASI --}}
        <div class="achievement-card">
            <h2 class="achievement-title">Daftar Prestasi Alumni</h2>
            <p class="achievement-description">
                Kelola nama dan status prestasi alumni.
            </p>

            @if(isset($achievements) && $achievements->count() > 0)
                <div class="achievement-table-wrap">
                    <table class="achievement-table">
                        <thead>
                            <tr>
                                <th>Nama Prestasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($achievements as $achievement)
                                <tr id="achievement-row-{{ $achievement->id }}">
                                    <td>
                                        <span class="achievement-display">
                                            {{ $achievement->name }}
                                        </span>

                                        <input
                                            form="edit-achievement-{{ $achievement->id }}"
                                            class="form-control achievement-edit-field"
                                            type="text"
                                            name="name"
                                            value="{{ $achievement->name }}"
                                            maxlength="255"
                                            required
                                            hidden
                                        >
                                    </td>

                                    <td>
                                        <span class="achievement-display">
                                            @if($achievement->status)
                                                <span class="achievement-status">Aktif</span>
                                            @else
                                                <span class="achievement-status inactive">Tidak Aktif</span>
                                            @endif
                                        </span>

                                        <select
                                            form="edit-achievement-{{ $achievement->id }}"
                                            class="form-control achievement-edit-field"
                                            name="status"
                                            required
                                            hidden
                                        >
                                            <option value="1" {{ $achievement->status ? 'selected' : '' }}>
                                                Aktif
                                            </option>
                                            <option value="0" {{ !$achievement->status ? 'selected' : '' }}>
                                                Tidak Aktif
                                            </option>
                                        </select>
                                    </td>

                                    <td>
                                        <div class="achievement-display">
                                            <button
                                                type="button"
                                                class="btn-achievement"
                                                data-achievement-id="{{ $achievement->id }}"
                                                onclick="editAchievement(this.dataset.achievementId)"
                                            >
                                                Edit
                                            </button>

                                            <form
                                                action="{{ route('admin.achievements.destroy', $achievement->id) }}"
                                                method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn-achievement btn-achievement-delete"
                                                >
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>

                                        <div class="achievement-edit-field achievement-edit-actions" hidden>
                                            <button
                                                type="submit"
                                                form="edit-achievement-{{ $achievement->id }}"
                                                class="btn-achievement btn-achievement-save"
                                            >
                                                Simpan
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-achievement"
                                                data-achievement-id="{{ $achievement->id }}"
                                                onclick="cancelEditAchievement(this.dataset.achievementId)"
                                            >
                                                Batal
                                            </button>
                                        </div>

                                        <form
                                            id="edit-achievement-{{ $achievement->id }}"
                                            action="{{ route('admin.achievements.update', $achievement->id) }}"
                                            method="POST"
                                            hidden
                                        >
                                            @csrf
                                            @method('PUT')
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

    <script>
        function editAchievement(id) {
            const row = document.getElementById('achievement-row-' + id);

            if (!row) return;

            row.querySelectorAll('.achievement-display').forEach(function (element) {
                element.hidden = true;
            });

            row.querySelectorAll('.achievement-edit-field').forEach(function (element) {
                element.hidden = false;
            });
        }

        function cancelEditAchievement(id) {
            const row = document.getElementById('achievement-row-' + id);

            if (!row) return;

            row.querySelectorAll('.achievement-display').forEach(function (element) {
                element.hidden = false;
            });

            row.querySelectorAll('.achievement-edit-field').forEach(function (element) {
                element.hidden = true;
            });
        }
    </script>
@endif

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (!input.files || !input.files[0] || !preview) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            preview.src = event.target.result;
            preview.style.objectFit = 'contain';
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection
