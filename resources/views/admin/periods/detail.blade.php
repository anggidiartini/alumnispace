@extends('admin.layout.index')

@section('page_title', 'Detail Periode Kepengurusan')

@section('content')
<style>
    .detail-layout-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }
    .detail-card-main {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
    }
    .detail-card-sidebar {
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04);
        position: sticky;
        top: 24px;
    }
    .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding-bottom: 16px;
        margin-bottom: 24px;
        border-bottom: 1px solid #d0e1f0;
        flex-wrap: wrap;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }
    .info-box {
        padding: 16px;
        border: 1px solid #d0e1f0;
        border-radius: 10px;
        background: #f8fbfe;
        min-height: 80px;
    }
    .info-box.full { grid-column: 1 / -1; }
    .info-label {
        display: block;
        margin-bottom: 8px;
        color: #527597;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .info-value {
        color: #0a4174;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.5;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }
    .status-active { background: #d1fae5; border: 1px solid #a7f3d0; color: #047857; }
    .status-inactive { background: #f1f5f9; border: 1px solid #cbd5e1; color: #64748b; }
    .btn-sidebar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 11px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        margin-top: 10px;
        transition: all 0.15s ease;
        border: none;
        cursor: pointer;
    }
    .btn-sidebar:first-of-type { margin-top: 0; }
    .btn-primary { background: #0a4174; color: #fff; }
    .btn-primary:hover { background: #08335c; color: #fff; }
    .btn-secondary { border: 1px solid #d0e1f0; background: #fff; color: #527597; }
    .btn-secondary:hover { background: #f8fafc; color: #0a4174; }
    .btn-danger { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
    .btn-danger:hover { background: #ef4444; color: #fff; border-color: #ef4444; }
    @media (max-width: 850px) {
        .detail-layout-grid { grid-template-columns: 1fr; }
        .detail-card-sidebar { position: static; }
        .info-grid { grid-template-columns: 1fr; }
        .info-box.full { grid-column: auto; }
    }
</style>

@php
    $today = now()->toDateString();
    $isActive = $period->is_active ?? ($period->start_date <= $today && (!$period->finish_date || $period->finish_date >= $today));
@endphp

<div class="detail-layout-grid">
    <!-- KIRI: INFO DETAIL -->
    <section class="detail-card-main">
        <div class="detail-header">
            <div>
                <h2 style="margin: 0 0 4px; color: #0a4174; font-size: 20px; font-weight: 800;">Detail Periode Kepengurusan</h2>
                <p style="margin: 0; color: #527597; font-size: 12px;">Informasi lengkap periode yang dipilih.</p>
            </div>
            <span class="status-badge {{ $isActive ? 'status-active' : 'status-inactive' }}">
                <i class="fa-solid {{ $isActive ? 'fa-circle-check' : 'fa-circle-minus' }}"></i>
                {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
            </span>
        </div>

               <div class="info-grid">
            <div class="info-box full">
                <span class="info-label">Nama Periode</span>
                <div class="info-value">{{ $period->period_name }}</div>
            </div>
            <div class="info-box">
                <span class="info-label">Tanggal Mulai</span>
                <div class="info-value">
                    {{ $period->start_date ? \Carbon\Carbon::parse($period->start_date)->locale('id')->translatedFormat('d F Y') : '-' }}
                </div>
            </div>
            <div class="info-box">
                <span class="info-label">Tanggal Selesai</span>
                <div class="info-value">
                    {{ $period->finish_date ? \Carbon\Carbon::parse($period->finish_date)->locale('id')->translatedFormat('d F Y') : 'Masih Berjalan' }}
                </div>
            </div>
            <div class="info-box">
                <span class="info-label">Dibuat</span>
                <div class="info-value" style="font-size: 13px;">
                    {{ $period->created_at ? \Carbon\Carbon::parse($period->created_at)->locale('id')->translatedFormat('d F Y, H:i') : '-' }}
                </div>
            </div>
            <div class="info-box">
                <span class="info-label">Terakhir Diperbarui</span>
                <div class="info-value" style="font-size: 13px;">
                    {{ $period->updated_at ? \Carbon\Carbon::parse($period->updated_at)->locale('id')->translatedFormat('d F Y, H:i') : '-' }}
                </div>
            </div>
        </div>
    </section>

    <!-- KANAN: AKSI -->
    <aside class="detail-card-sidebar">
        <div style="border-bottom: 1px solid #d0e1f0; padding-bottom: 8px; margin-bottom: 16px;">
            <h3 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0;">Aksi Pengelola</h3>
        </div>
        <p style="font-size: 12px; color: #527597; margin: 0 0 16px 0; line-height: 1.6;">
            Gunakan tombol berikut untuk mengelola data periode ini.
        </p>
        <a href="{{ route('admin.committee-periods.edit', $period->id) }}" class="btn-sidebar btn-primary">
            <i class="fa-solid fa-pen-to-square"></i> Edit Periode
        </a>
        <a href="{{ route('admin.committee-periods.index') }}" class="btn-sidebar btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
        <a href="{{ route('admin.alumni-boards.index') }}" class="btn-sidebar btn-secondary">
            <i class="fa-solid fa-users"></i> Ke Pengurus Alumni
        </a>
        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #f1f5f9;">
            <form method="POST" action="{{ route('admin.committee-periods.destroy', $period->id) }}"
                onsubmit="return confirm('Yakin ingin menghapus periode ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sidebar btn-danger" style="margin-top: 0;">
                    <i class="fa-solid fa-trash-can"></i> Hapus Periode
                </button>
            </form>
        </div>
    </aside>
</div>
@endsection
