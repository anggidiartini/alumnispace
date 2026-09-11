@extends('admin.layout.index')

@section('page_title')
    {{ isset($row) ? 'Ubah Data' : 'Tambah Baru' }} — {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}
@endsection

@section('content')
<style>
    .form-container-full {
        width: 100%;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 32px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .form-header {
        margin-bottom: 28px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 18px;
    }
    /* Grid System Dua Kolom Melebar ke Samping */
    .form-grid-two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    /* Kolom Teks Paragraf Panjang otomatis memakan tempat 2 kolom penuh di bawah */
    .form-group.full-width-row {
        grid-column: span 2;
    }
    .form-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-main);
        letter-spacing: 0.3px;
    }
    .form-control {
        width: 100%;
        padding: 11px 16px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background: var(--bg-main);
        color: var(--text-main);
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus {
        border-color: var(--color-secondary);
        box-shadow: 0 0 0 3px rgba(123,189,232,0.2);
    }
    .form-control:disabled, .form-control[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }
    .field-hint {
        font-size: 11px;
        color: #64748b;
        margin-top: 2px;
    }
    .required-star {
        color: #ef4444;
        margin-left: 2px;
        font-weight: bold;
    }
    .img-preview-box {
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .img-preview-element {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid var(--border-color);
        background: #f8fafc;
    }
    .form-actions {
        margin-top: 36px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .btn-submit {
        background: var(--color-primary);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: background 0.2s;
    }
    .btn-submit:hover {
        opacity: 0.9;
    }
    .btn-cancel {
        background: transparent;
        color: var(--text-muted);
        border: 1px solid var(--border-color);
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        text-align: center;
        transition: background 0.2s;
    }
    .btn-cancel:hover {
        background: var(--bg-main);
    }
    @media (max-width: 768px) {
        .form-grid-two-columns { grid-template-columns: 1fr; }
        .form-group.full-width-row { grid-column: span 1; }
    }
</style>

<div class="form-container-full">
    <div class="form-header">
        <h2 style="font-size: 20px; font-weight: 800; color: var(--text-main);">Formulir Isian {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}</h2>
        <p style="font-size: 12px; color: var(--text-muted)">Silakan perbarui atau isi data komponen secara lengkap di bawah ini.</p>
    </div>

    <!-- Tambahkan entype multipart agar bisa memproses unggahan file fisik gambar -->
    <form action="{{ isset($row) ? route('admin.table.update', [$table_key, $row->id]) : route('admin.table.store', $table_key) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($row))
            @method('PUT')
        @endif

        <div class="form-grid-two-columns">
            @foreach($mapping['fields'] as $key => $field)
                @php 
                    $isRequired = (isset($field['required']) && $field['required']) ? 'required' : ''; 
                    $isReadonly = (isset($field['readonly']) && $field['readonly']) ? 'readonly' : '';
                    $isTextArea = ($field['type'] === 'textarea' || $key === 'description' || $key === 'requirements' || $key === 'content');
                @endphp

                <!-- Kolom teks panjang otomatis melebar memakan 2 space baris penuh -->
                <div class="form-group {{ $isTextArea ? 'full-width-row' : '' }}">
                    <label class="form-label">
                        {{ $field['label'] }}
                        @if($isRequired && $key !== 'graduation_year') 
                            <span class="required-star">*</span> 
                        @endif
                    </label>

                    <!-- KONDISI 1: INPUT BERKAS FILE FOTO DENGAN PRATINJAU LANGSUNG -->
                    @if($field['type'] === 'file')
                        <input type="file" name="{{ $key }}" class="form-control" accept="image/*" {{ $isRequired }}
                               onchange="previewImage(this, 'preview-{{ $key }}')">
                        @if(isset($field['hint']))
                            <p class="field-hint"><i class="fa-solid fa-circle-info"></i> {{ $field['hint'] }}</p>
                        @endif
                        
                        <div class="img-preview-box">
                            <div>
                                <p class="field-hint" style="margin-bottom: 4px;">Pratinjau Berkas:</p>
                                <img id="preview-{{ $key }}" 
                                     src="{{ (isset($row) && !empty($row->$key)) ? asset($row->$key) : asset('assets/images/no-avatar.png') }}" 
                                     class="img-preview-element" alt="Pratinjau">
                            </div>
                        </div>

                    <!-- KONDISI 2: SELEKSI DROPDOWN PILIHAN -->
                    @elseif($field['type'] === 'select')
                        <select name="{{ $key }}" class="form-control" {{ $isRequired }}>
                            <option value="">-- Pilih {{ $field['label'] }} --</option>
                            @foreach($field['options'] as $value => $label)
                                <option value="{{ $value }}" {{ (isset($row) && $row->$key == $value) ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>

                    <!-- KONDISI 3: TOGGLE PILIHAN AKTIF / TUTUP -->
                    @elseif($field['type'] === 'toggle')
                        <select name="{{ $key }}" class="form-control" {{ $isRequired }}>
                            @foreach($field['options'] as $value => $label)
                                <option value="{{ $value }}" {{ (isset($row) && $row->$key == $value) ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>

                    <!-- KONDISI 4: INPUT PARAGRAF TEKS PANJANG -->
                    @elseif($field['type'] === 'textarea')
                        <textarea name="{{ $key }}" rows="5" class="form-control" placeholder="Masukkan {{ $field['label'] }}..." {{ $isRequired }} {{ $isReadonly }}>{{ isset($row) ? $row->$key : '' }}</textarea>

                    <!-- KONDISI 5: KHUSUS TAHUN KELULUSAN (MINIMAL 1901 / ANTI 0) -->
                    @elseif($key === 'graduation_year')
                        <input type="number" name="{{ $key }}" class="form-control" min="1901" max="2100"
                               value="{{ isset($row) ? $row->$key : date('Y') }}" required placeholder="Contoh: 2020">
                        <p class="field-hint"><i class="fa-solid fa-circle-exclamation"></i> Tahun kelulusan wajib berupa angka tahun yang valid dan tidak boleh angka 0.</p>

                    <!-- KONDISI 6: STANDAR TEXT / NUMBER / DATE -->
                    @else
                        <input type="{{ $field['type'] }}" name="{{ $key }}" class="form-control" 
                               value="{{ isset($row) ? $row->$key : '' }}" 
                               placeholder="Masukkan {{ $field['label'] }}..." {{ $isRequired }} {{ $isReadonly }}>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.table.index', $table_key) }}" class="btn-cancel">Batalkan</a>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Data Komponen
            </button>
        </div>
    </form>
</div>

<!-- JAVASCRIPT UNTUK LIVE PREVIEW GAMBAR SEBELUM DIUNGGAH -->
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
