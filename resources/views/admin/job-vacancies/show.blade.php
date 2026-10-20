@extends('admin.layout.index')

@section('title', 'Tinjau Detail — ' . ($table_key === 'alumnis' ? 'Data Alumni' : $mapping['title']))

@section('content')
<style>
    .detail-layout-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 340px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }

    .detail-card-main,
    .detail-card-sidebar {
        background: #fff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
    }

    .detail-card-main {
        padding: 28px;
        min-width: 0;
    }

    .detail-card-sidebar {
        padding: 20px;
        position: sticky;
        top: 24px;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #d0e1f0;
        padding-bottom: 16px;
        margin-bottom: 24px;
    }

    .detail-header h2 {
        font-size: 20px;
        font-weight: 800;
        color: #0a4174;
        margin: 0 0 6px;
    }

    .detail-header p {
        font-size: 12px;
        color: #527597;
        margin: 0;
    }

    .info-group {
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f4f8fb;
        overflow-wrap: anywhere;
    }

    .info-group:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .info-label {
        display: block;
        font-weight: 700;
        color: #527597;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .info-value {
        color: #0a4174;
        font-weight: 500;
        font-size: 14px;
        line-height: 1.6;
    }

    .info-text {
        background: #f4f8fb;
        border: 1px solid #d0e1f0;
        padding: 12px 16px;
        border-radius: 8px;
        margin-top: 4px;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .info-badge {
        display: inline-block;
        background: rgba(123, 189, 232, 0.25);
        color: #0a4174;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
    }

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 4px;
    }

    .skill-badge {
        display: inline-block;
        background: rgba(123, 189, 232, 0.25);
        color: #0a4174;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
    }

    .btn-back,
    .btn-edit-direct,
    .btn-export-direct {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        box-sizing: border-box;
        text-decoration: none;
        padding: 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        transition: background 0.15s ease;
    }

    .btn-back {
        margin-top: 10px;
        border: 1px solid #d0e1f0;
        color: #527597;
        background: #fff;
    }

    .btn-back:hover {
        background: #f4f8fb;
        color: #0a4174;
    }

    .btn-edit-direct {
        background: #3b82f6;
        color: #fff;
    }

    .btn-edit-direct:hover {
        background: #2563eb;
        color: #fff;
    }

    .btn-export-direct {
        background: #10b981;
        color: #fff;
        margin-bottom: 10px;
    }

    .btn-export-direct:hover {
        background: #059669;
        color: #fff;
    }

    .img-sidebar-preview {
        display: block;
        width: 100%;
        max-height: 220px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #d0e1f0;
        margin-bottom: 16px;
    }

    @media (max-width: 992px) {
        .detail-layout-grid {
            grid-template-columns: 1fr;
        }

        .detail-card-sidebar {
            position: static;
        }
    }

    @media (max-width: 576px) {
        .detail-card-main,
        .detail-card-sidebar {
            padding: 18px;
        }
    }
</style>

<div class="detail-layout-grid">

    {{-- KOLOM KIRI: DETAIL INFORMASI --}}
    <div class="detail-card-main">
        <div class="detail-header">
            <div>
                <h2>Arsip Informasi</h2>
                <p>Rincian data lengkap yang tersimpan dalam sistem.</p>
            </div>
        </div>

        @foreach($mapping['fields'] as $key => $field)

            {{-- DETAIL KHUSUS PENGURUS ALUMNI --}}
            @if($table_key === 'alumni_boards')
                @if($loop->first)
                    @php
                        $detilPengurus = DB::table('alumni_committees')
                            ->join('alumni_profiles', 'alumni_committees.alumni_profile_id', '=', 'alumni_profiles.id')
                            ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                            ->join('committee_periods', 'alumni_committees.committee_period_id', '=', 'committee_periods.id')
                            ->select(
                                'users.name',
                                'alumni_committees.position',
                                'committee_periods.period_name',
                                'committee_periods.start_date',
                                'committee_periods.finish_date'
                            )
                            ->where('alumni_committees.id', $row->id)
                            ->first();
                    @endphp
                @endif

                @if($key === 'alumni_profile_id')
                    <div class="info-group">
                        <span class="info-label">Nama Lengkap Anggota Pengurus</span>
                        <div class="info-value">
                            <strong>{{ $detilPengurus->name ?? '-' }}</strong>
                        </div>
                    </div>
                @endif

                @if($key === 'position')
                    <div class="info-group">
                        <span class="info-label">Jabatan Struktural</span>
                        <div class="info-value">
                            <span class="info-badge">
                                {{ $detilPengurus->position ?? '-' }}
                            </span>
                        </div>
                    </div>
                @endif

                @if($key === 'committee_period_id')
                    <div class="info-group">
                        <span class="info-label">Periode Kepengurusan</span>
                        <div class="info-value">
                            <strong>{{ $detilPengurus->period_name ?? '-' }}</strong>
                        </div>
                    </div>

                    <div class="info-group">
                        <span class="info-label">Tanggal Mulai Jabatan</span>
                        <div class="info-value">
                            <strong>
                                @if(!empty($detilPengurus->start_date))
                                    {{ \Carbon\Carbon::parse($detilPengurus->start_date)->locale('id')->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </strong>
                        </div>
                    </div>

                    <div class="info-group">
                        <span class="info-label">Tanggal Berakhir Jabatan</span>
                        <div class="info-value">
                            <strong>
                                @if(!empty($detilPengurus->finish_date))
                                    {{ \Carbon\Carbon::parse($detilPengurus->finish_date)->locale('id')->translatedFormat('d F Y') }}
                                @else
                                    Masih Aktif Menjabat
                                @endif
                            </strong>
                        </div>
                    </div>
                @endif

                @continue
            @endif

            {{-- LEWATI ID DAN FIELD MEDIA DI KOLOM INFORMASI --}}
            @if(
                Str::endsWith($key, '_id') ||
                $key === 'id' ||
                ($field['type'] ?? '') === 'file' ||
                in_array($key, ['avatar', 'thumbnail', 'photo_path', 'cover_photo', 'company_logo'])
            )
                @continue
            @endif

            @php
                $value = $row->$key ?? null;
                $fieldType = $field['type'] ?? 'text';
            @endphp

            <div class="info-group">
                <span class="info-label">{{ $field['label'] ?? ucfirst(str_replace('_', ' ', $key)) }}</span>

                <div class="info-value">

                    {{-- STATUS TOGGLE --}}
                    @if($fieldType === 'toggle')
                        <span style="
                            background-color: {{ $value ? 'rgba(16,185,129,.15)' : 'rgba(239,68,68,.15)' }};
                            color: {{ $value ? '#065f46' : '#991b1b' }};
                            padding: 4px 10px;
                            border-radius: 6px;
                            font-size: 11px;
                            font-weight: bold;
                            display: inline-block;
                        ">
                            {{ $field['options'][$value] ?? ($value ? 'Aktif' : 'Nonaktif') }}
                        </span>

                    {{-- SELECT / STATUS --}}
                    @elseif($fieldType === 'select' || in_array($key, ['study_status', 'status']))
                        <span class="info-badge">
                            {{ $field['options'][$value] ?? ($value !== null && $value !== '' ? $value : '-') }}
                        </span>

                    {{-- SKILLS TAGS --}}
                    @elseif($key === 'skills_tags')
                        @php
                            $skills = [];

                            if (is_array($value)) {
                                $skills = $value;
                            } elseif (is_string($value) && trim($value) !== '') {
                                $decoded = json_decode($value, true);

                                if (is_array($decoded)) {
                                    $skills = $decoded;
                                } else {
                                    $skills = preg_split('/[\r\n,]+/', $value);
                                }
                            }

                            $skills = array_values(array_filter(array_map(
                                fn ($skill) => trim((string) $skill),
                                $skills
                            )));
                        @endphp

                        @if(count($skills))
                            <div class="skills-list">
                                @foreach($skills as $skill)
                                    <span class="skill-badge">{{ $skill }}</span>
                                @endforeach
                            </div>
                        @else
                            -
                        @endif

                    {{-- TEXTAREA / DESKRIPSI --}}
                    @elseif($fieldType === 'textarea' || in_array($key, ['bio', 'description', 'requirements', 'company_description']))
                        <div class="info-text">{{ strip_tags((string) ($value ?? '')) ?: '-' }}</div>

                    {{-- TANGGAL --}}
                    @elseif($fieldType === 'date')
                        @if(!empty($value))
                            <strong>
                                {{ \Carbon\Carbon::parse($value)->locale('id')->translatedFormat('d F Y') }}
                            </strong>
                        @else
                            -
                        @endif

                    {{-- KATEGORI DAN FIELD TEKS LAINNYA --}}
                    @else
                        <strong>{{ $value !== null && $value !== '' ? $value : '-' }}</strong>
                    @endif

                </div>
            </div>
        @endforeach
    </div>

    {{-- KOLOM KANAN: MEDIA DAN AKSI --}}
    <div class="detail-card-sidebar">
        <span class="info-label">Lampiran Media</span>

        @php
            $hasImage = false;
        @endphp

        @foreach($mapping['fields'] as $key => $field)
            @if(
                ($field['type'] ?? '') === 'file' ||
                in_array($key, ['avatar', 'thumbnail', 'photo_path', 'cover_photo', 'company_logo'])
            )
                @if($key === 'company_logo' && !empty($row->$key))
                    <div style="margin-bottom: 16px; display: flex; justify-content: center;">
                        <x-company-logo
                            :logo="$row->$key"
                            :name="$row->company_name ?? 'Perusahaan'"
                            size="80"
                            option="initials"
                        />
                    </div>
                    @php $hasImage = true; @endphp

                @elseif(!empty($row->$key))
                    <img
                        src="{{ Str::startsWith($row->$key, ['http://', 'https://']) ? $row->$key : asset($row->$key) }}"
                        class="img-sidebar-preview"
                        alt="{{ $field['label'] ?? 'Lampiran gambar' }}"
                        onerror="this.style.display='none';"
                    >

                    @php $hasImage = true; @endphp
                @endif
            @endif
        @endforeach

        @if(!$hasImage)
            <div style="
                background: #f4f8fb;
                border: 1px dashed #d0e1f0;
                padding: 20px;
                text-align: center;
                border-radius: 8px;
                font-size: 12px;
                color: #527597;
                margin-bottom: 16px;
            ">
                Tidak ada lampiran berkas foto.
            </div>
        @endif

        <span class="info-label" style="margin-top: 10px;">Aksi Pengelola</span>

        <a
            href="{{ route('admin.job-vacancies.export-applications', $row->id) }}"
            class="btn-export-direct"
        >
            <i class="fa-solid fa-file-excel"></i>
            Ekspor Data Pelamar
        </a>

        <a
            href="{{ route('admin.job-vacancies.edit', $row->id) }}"
            class="btn-edit-direct"
        >
            <i class="fa-solid fa-pen-to-square"></i>
            Sunting Data
        </a>

        <a
            href="{{ route('admin.job-vacancies.index') }}"
            class="btn-back"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

</div>
@endsection

