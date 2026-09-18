@extends('admin.layout.index')

@section('title', (isset($row) ? 'Ubah Data' : 'Tambah Baru') . ' — ' . ($table_key === 'alumnis' ? 'Data Alumni' : $mapping['title']))

@section('content')
<style>
    /* SUSUNAN FORM GRID KANAN KIRI */
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
    }
    .form-control:focus {
        border-color: #7bbde8;
        background: #fff;
    }
    .form-control:disabled, .form-control[readonly] {
        background-color: #e2e8f0;
        color: #64748b;
        cursor: not-allowed;
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
        width: 100%;
        margin-top: 10px;
    }
    @media (max-width: 992px) {
        .form-layout-grid { grid-template-columns: 1fr; }
        .form-card-sidebar { position: static; }
    }
</style>
<form action="{{ isset($row) ? route('admin.job-vacancies.update', $row->id) : route('admin.job-vacancies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($row))
        @method('PUT')
    @endif

    <div class="form-layout-grid">
        
        <!-- KOLOM KIRI: INPUT DATA UTAMA -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174;">Isian Data Komponen</h2>
                <p style="font-size: 12px; color: #527597">Silakan lengkapi informasi isian komponen di bawah ini.</p>
            </div>

                       @foreach($mapping['fields'] as $key => $field)
                <!-- ========================================================
                   KONDISI KHUSUS FITUR PENGURUS ALUMNI (DROPDOWN RELASI)
                   ======================================================== -->
                @if($table_key === 'alumni_boards')
                    
                    <!-- 1. Dropdown Pilihan Nama Alumni -->
                    @if($key === 'alumni_profile_id')
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap Alumni <span class="required-star">*</span></label>
                            <select name="alumni_profile_id" class="form-control" required>
                                <option value="">-- Pilih Anggota Alumni Berdasarkan Nama --</option>
                                @foreach(DB::table('alumni_profiles')->join('users', 'alumni_profiles.user_id', '=', 'users.id')->select('alumni_profiles.id', 'users.name')->orderBy('users.name', 'asc')->get() as $alumni)
                                    <option value="{{ $alumni->id }}" {{ (isset($row) && $row->alumni_profile_id == $alumni->id) ? 'selected' : '' }}>{{ $alumni->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- 2. Dropdown Pilihan Jabatan Otomatis -->
                    @if($key === 'position')
                        <div class="form-group">
                            <label class="form-label">Jabatan Struktural Pengurus <span class="required-star">*</span></label>
                            <select name="position" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach($field['options'] as $value => $label)
                                    <option value="{{ $value }}" {{ (isset($row) && $row->position == $value) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- 3. Dropdown Pilihan Nama Periode -->
                    @if($key === 'committee_period_id')
                        <div class="form-group">
                            <label class="form-label">Periode Bakti Kepengurusan <span class="required-star">*</span></label>
                            <select name="committee_period_id" class="form-control" required>
                                <option value="">-- Pilih Nama Periode --</option>
                                @foreach(DB::table('committee_periods')->orderBy('id', 'desc')->get() as $p)
                                    <option value="{{ $p->id }}" {{ (isset($row) && $row->committee_period_id == $p->id) ? 'selected' : '' }}>{{ $p->period_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @php continue; @endphp
                @endif

                {{-- ========================================================
                   KODE LAMA BAWAAN TEMANMU (UNTUK ENTITAS LAINNYA)
                   ======================================================== --}}
                {{-- Lewati kolom gambar dan seleksi status untuk ditaruh di sebelah kanan --}}
                @if($field['type'] === 'file' || $field['type'] === 'toggle' || $field['type'] === 'select' || $key === 'study_status' || $key === 'status')
                    @continue
                @endif

                @php 
                    $isRequired = (isset($field['required']) && $field['required']) ? 'required' : ''; 
                    $isReadonly = (isset($field['readonly']) && $field['readonly']) ? 'readonly' : '';
                @endphp

                <div class="form-group">
                    <label class="form-label">{{ $field['label'] }} @if($isRequired)<span class="required-star">*</span>@endif</label>

                    @if($field['type'] === 'textarea')
                        <textarea name="{{ $key }}" rows="5" class="form-control" placeholder="Masukkan {{ $field['label'] }}..." {{ $isRequired }} {{ $isReadonly }}>{{ isset($row) ? $row->$key : '' }}</textarea>
                    @elseif($key === 'graduation_year')
                        <input type="number" name="{{ $key }}" class="form-control" min="1901" max="2100" value="{{ isset($row) ? $row->$key : date('Y') }}" required>
                    @else
                        <input type="{{ $field['type'] }}" name="{{ $key }}" class="form-control" value="{{ isset($row) ? $row->$key : '' }}" placeholder="Masukkan {{ $field['label'] }}..." {{ $isRequired }} {{ $isReadonly }}>
                    @endif
                </div>
            @endforeach


        <!-- KOLOM KANAN: PENGATURAN STATUS & MEDIA -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom:16px; padding-bottom:8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174;">Media & Status</h3>
            </div>

            @foreach($mapping['fields'] as $key => $field)
                @if($field['type'] === 'file' || $field['type'] === 'toggle' || $field['type'] === 'select' || $key === 'study_status' || $key === 'status')
                    
                    <div class="form-group">
                        <label class="form-label">{{ $field['label'] }}</label>
                        
                        @if($field['type'] === 'file')
                            <input type="file" name="{{ $key }}" class="form-control" accept="image/*" onchange="previewImage(this, 'side-preview-{{ $key }}')">
                            <div style="margin-top: 8px; text-align: center;">
                                <img id="side-preview-{{ $key }}" src="{{ (isset($row) && !empty($row->$key)) ? (Str::startsWith($row->$key, 'http') ? $row->$key : asset($row->$key)) : asset('assets/images/no-image.png') }}" style="width: 100%; max-height: 140px; border-radius: 6px; object-fit: cover; border: 1px solid #d0e1f0;" alt="Pratinjau">
                            </div>

                        @elseif($field['type'] === 'select' || $field['type'] === 'toggle' || $key === 'study_status' || $key === 'status')
                            <select name="{{ $key }}" class="form-control">
                                @foreach($field['options'] as $value => $label)
                                    <option value="{{ $value }}" {{ (isset($row) && $row->$key == $value) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                @endif
            @endforeach

            <div class="form-actions">
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
                <a href="{{ route('admin.job-vacancies.index') }}" class="btn-cancel">Batalkan</a>
            </div>
        </div>

    </div>
</form>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { preview.src = e.target.result; }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
