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
    .form-card-sidebar {
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
        display: block;
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

    .form-control:disabled,
    .form-control[readonly] {
        background: #e2e8f0;
        color: #64748b;
        cursor: not-allowed;
    }

    .field-hint {
        font-size: 11px;
        color: #64748b;
        margin-top: 2px;
        line-height: 1.5;
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

    .btn-cancel:hover {
        background: #f4f8fb;
    }

    .form-error {
        color: #dc2626;
        font-size: 12px;
    }

    @media (max-width: 992px) {
        .form-layout-grid {
            grid-template-columns: 1fr;
        }

        .form-card-sidebar {
            position: static;
        }
    }

    @media (max-width: 576px) {
        .form-card-main,
        .form-card-sidebar {
            padding: 16px;
        }
    }
</style>

<form
    action="{{ isset($row) ? route('admin.job-vacancies.update', $row->id) : route('admin.job-vacancies.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if(isset($row))
        @method('PUT')
    @endif

    <div class="form-layout-grid">

        {{-- KOLOM KIRI: DATA UTAMA --}}
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size:20px;font-weight:800;color:#0a4174;margin:0 0 6px;">
                    {{ isset($row) ? 'Ubah Data Lowongan' : 'Tambah Data Lowongan' }}
                </h2>
                <p style="font-size:12px;color:#527597;margin:0;">
                    Lengkapi informasi lowongan pekerjaan di bawah ini.
                </p>
            </div>

            @if($errors->any())
                <div style="background:#fef2f2;border:1px solid #fecaca;padding:12px;border-radius:8px;margin-bottom:18px;">
                    <strong style="color:#991b1b;font-size:13px;">Periksa kembali isian berikut:</strong>
                    <ul style="margin:8px 0 0;padding-left:20px;color:#b91c1c;font-size:12px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @foreach($mapping['fields'] as $key => $field)

                {{-- PENANGANAN KHUSUS PENGURUS ALUMNI --}}
                @if($table_key === 'alumni_boards')

                    @if($key === 'alumni_profile_id')
                        <div class="form-group">
                            <label class="form-label">
                                Nama Lengkap Alumni <span class="required-star">*</span>
                            </label>

                            <select name="alumni_profile_id" class="form-control" required>
                                <option value="">-- Pilih Anggota Alumni --</option>

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
                            <label class="form-label">Jabatan Struktural <span class="required-star">*</span></label>

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
                            <label class="form-label">Periode Kepengurusan <span class="required-star">*</span></label>

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

                {{-- FIELD YANG DITAMPILKAN DI SIDEBAR --}}
                @if(
                    ($field['type'] ?? '') === 'file' ||
                    ($field['type'] ?? '') === 'toggle' ||
                    in_array($key, ['is_active', 'study_status', 'status'])
                )
                    @continue
                @endif

                @php
                    $fieldType = $field['type'] ?? 'text';
                    $isRequired = !empty($field['required']);
                    $isReadonly = !empty($field['readonly']);

                    $currentValue = old($key, isset($row) ? ($row->$key ?? '') : '');

                    // Ubah JSON skills menjadi teks yang mudah diedit.
                    if ($key === 'skills_tags' && is_string($currentValue)) {
                        $decodedSkills = json_decode($currentValue, true);

                        if (is_array($decodedSkills)) {
                            $currentValue = implode("\n", $decodedSkills);
                        }
                    }
                @endphp

                <div class="form-group">
                    <label class="form-label" for="field-{{ $key }}">
                        {{ $field['label'] ?? ucfirst(str_replace('_', ' ', $key)) }}

                        @if($isRequired)
                            <span class="required-star">*</span>
                        @endif
                    </label>

                    {{-- SKILL: SATU SKILL PER BARIS --}}
                    @if($key === 'skills_tags')
                        <textarea
                            id="field-{{ $key }}"
                            name="{{ $key }}"
                            rows="4"
                            class="form-control"
                            placeholder="Contoh:&#10;Laravel&#10;PHP&#10;MySQL"
                            {{ $isRequired ? 'required' : '' }}
                            {{ $isReadonly ? 'readonly' : '' }}
                        >{{ $currentValue }}</textarea>

                        <small class="field-hint">
                            Masukkan satu skill per baris. Kamu juga bisa memisahkannya dengan koma.
                        </small>

                    {{-- TEXTAREA BIASA --}}
                    @elseif($fieldType === 'textarea')
                        <textarea
                            id="field-{{ $key }}"
                            name="{{ $key }}"
                            rows="5"
                            class="form-control"
                            placeholder="Masukkan {{ $field['label'] ?? $key }}..."
                            {{ $isRequired ? 'required' : '' }}
                            {{ $isReadonly ? 'readonly' : '' }}
                        >{{ $currentValue }}</textarea>

                    {{-- DROPDOWN --}}
                    @elseif($fieldType === 'select')
                        <select
                            id="field-{{ $key }}"
                            name="{{ $key }}"
                            class="form-control"
                            {{ $isRequired ? 'required' : '' }}
                        >
                            <option value="">-- Pilih {{ $field['label'] ?? $key }} --</option>

                            @foreach($field['options'] ?? [] as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    {{ (string) $currentValue === (string) $value ? 'selected' : '' }}
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                    {{-- TAHUN KELULUSAN --}}
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

                    {{-- INPUT LAINNYA --}}
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
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach
        </div>

        {{-- KOLOM KANAN: MEDIA DAN STATUS --}}
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
                    in_array($key, ['is_active', 'study_status', 'status'])
                )

                    <div class="form-group">
                        <label class="form-label" for="field-{{ $key }}">
                            {{ $field['label'] ?? ucfirst(str_replace('_', ' ', $key)) }}
                            @if(!empty($field['required']))
                                <span class="required-star">*</span>
                            @endif
                        </label>

                        {{-- UPLOAD GAMBAR --}}
                        @if(($field['type'] ?? '') === 'file')
                            <input
                                id="field-{{ $key }}"
                                type="file"
                                name="{{ $key }}"
                                class="form-control"
                                accept="image/*"
                                onchange="previewImage(this, 'side-preview-{{ $key }}')"
                            >

                            <small class="field-hint">
                                Pilih gambar jika ingin mengganti gambar yang sekarang.
                            </small>

                            <div style="margin-top:8px;text-align:center;background:#f8fafc;border:1px dashed #d0e1f0;border-radius:8px;padding:6px;min-height:120px;display:flex;align-items:center;justify-content:center;">
                                <img
                                    id="side-preview-{{ $key }}"
                                    src="{{ isset($row) && !empty($row->$key) ? (Str::startsWith($row->$key, ['http://', 'https://']) ? $row->$key : asset($row->$key)) : asset('assets/images/no-image.webp') }}"
                                    style="max-width:100%;max-height:140px;border-radius:6px;object-fit:contain;"
                                    alt="Pratinjau gambar"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image.webp') }}';"
                                >
                            </div>

                        {{-- STATUS / DROPDOWN SIDEBAR --}}
                        @elseif(($field['type'] ?? '') === 'select' || ($field['type'] ?? '') === 'toggle' || in_array($key, ['study_status', 'status', 'is_active']))
                            <select
                                id="field-{{ $key }}"
                                name="{{ $key }}"
                                class="form-control"
                                {{ !empty($field['required']) ? 'required' : '' }}
                            >
                                @foreach($field['options'] ?? [0 => 'Nonaktif', 1 => 'Aktif'] as $value => $label)
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

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    {{ isset($row) ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>

                <a href="{{ route('admin.job-vacancies.index') }}" class="btn-cancel">
                    Batalkan
                </a>
            </div>
        </div>
    </div>
</form>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0] && preview) {
            const reader = new FileReader();

            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.style.objectFit = 'contain';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
