@extends('admin.layout.index')

@section('page_title', 'Pengurus Alumni')

@section('content')
<div style="background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;">
    @if(session('success'))<div style="padding:12px;margin-bottom:18px;background:#ecfdf5;color:#166534;border:1px solid #22c55e;border-radius:8px;">{{ session('success') }}</div>@endif
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;"><div><h2 style="color:var(--text-main);">Pengurus Alumni</h2><p style="color:var(--text-muted);font-size:13px;">Kelola data pada tabel alumni_committees.</p></div><a href="{{ route('admin.alumni-boards.create') }}" style="padding:10px 16px;border-radius:8px;background:var(--color-primary);color:#fff;text-decoration:none;">Tambah Pengurus</a></div>
    <div style="overflow-x:auto;"><table class="data-table" style="width:100%;border-collapse:collapse;font-size:13px;"><thead><tr style="background:var(--bg-main);text-align:left;"><th style="padding:12px;">Nama Alumni</th><th style="padding:12px;">Jabatan</th><th style="padding:12px;">Periode</th><th style="padding:12px;">Aksi</th></tr></thead><tbody>
    @forelse($boards as $board)<tr style="border-bottom:1px solid var(--border-color);"><td style="padding:12px;">{{ $board->alumni_name }}</td><td style="padding:12px;">{{ $board->position }}</td><td style="padding:12px;">{{ $board->period_name }}</td><td style="padding:12px;white-space:nowrap;text-align:center;"><div class="action-badge"><a href="{{ route('admin.alumni-boards.show', $board->id) }}" class="btn-action btn-detail"><i class="fa-solid fa-eye"></i> Detail</a><a href="{{ route('admin.alumni-boards.edit', $board->id) }}" class="btn-action btn-edit"><i class="fa-solid fa-pen-to-square"></i> Edit</a><form action="{{ route('admin.alumni-boards.destroy', $board->id) }}" method="POST" style="display:inline;margin-left:10px;" onsubmit="return confirm('Hapus data pengurus ini?');">@csrf @method('DELETE')<button type="button" class="btn-action btn-delete delete-trigger"><i class="fa-solid fa-trash"></i> Hapus</button></form></div></td></tr>@empty
    <tr><td colspan="4" style="padding:24px;text-align:center;color:var(--text-muted);">Belum ada data pengurus.</td></tr>@endforelse
    </tbody></table>

<style>
    .crud-card-full { width: 100%; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .btn-add { background: var(--color-primary); color: #fff; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--border-dark); }
    .btn-period { background: #fff; color: var(--color-primary); padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--border-color); }
    .btn-period:hover { background: var(--bg-main); border-color: var(--color-primary); color: var(--color-primary); }
    .table-responsive { width: 100%; overflow-x: auto; }
    
    /* Style Tabel Melebar Penuh */
    .data-table { width: 100%; border-collapse: collapse; text-align: center; font-size: 13px; }
    .data-table th { background: var(--bg-main); padding: 14px 16px; color: var(--text-main); font-weight: 700; border-bottom: 2px solid var(--border-color); text-transform: uppercase; font-size: 11px; text-align: center; }
    .data-table td { padding: 14px 16px; border-bottom: 1px solid var(--border-color); color: var(--text-main); max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle; text-align: center; }
    
    /* Kolom Nomor Urut Khusus */
    .col-number-header { width: 60px; text-align: center; }
    .col-number-data { text-align: center; font-weight: 700; color: var(--text-muted); background-color: rgba(244, 248, 251, 0.5); }
    
    .action-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .action-badge > * {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 32px;
    }
    .btn-action {
        text-decoration: none;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 7px 10px;
        border-radius: 10px;
        transition: transform 0.15s ease, background 0.15s ease, opacity 0.15s ease;
    }
    .btn-action:hover {
        transform: translateY(-1px);
    }
    .btn-detail {
        color: #10b981;
        background: rgba(16, 185, 129, 0.08);
    }
    .btn-edit {
        color: #3b82f6;
        background: rgba(59, 130, 246, 0.08);
    }
    .btn-delete {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.08);
        border: none;
        cursor: pointer;
        font-family: inherit;
    }
    .delete-form {
        display: inline-flex;
        margin: 0;
    }
    
    .delete-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.52);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.22s ease, visibility 0.22s ease;
        z-index: 1200;
    }
    .delete-modal-backdrop.is-open {
        opacity: 1;
        visibility: visible;
    }
    .delete-modal {
        width: min(100%, 420px);
        background: #fff;
        border: 1px solid rgba(148, 163, 184, 0.3);
        border-radius: 22px;
        padding: 26px 24px 20px;
        box-shadow: 0 30px 80px rgba(15, 23, 42, 0.2);
        transform: translateY(12px) scale(0.96);
        transition: transform 0.22s ease;
        position: relative;
        overflow: hidden;
    }
    .delete-modal-backdrop.is-open .delete-modal {
        transform: translateY(0) scale(1);
    }
    .delete-modal::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 6px;
        background: linear-gradient(90deg, #ef4444, #f97316, #facc15);
    }
    .delete-modal-icon {
        width: 62px;
        height: 62px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(254, 226, 226, 1), rgba(255, 237, 213, 1));
        color: #b91c1c;
        display: grid;
        place-items: center;
        font-size: 24px;
        margin-bottom: 16px;
        box-shadow: inset 0 0 0 1px rgba(239, 68, 68, 0.14);
    }
    .delete-modal h3 {
        margin: 0 0 10px;
        font-size: 24px;
        color: #111827;
        line-height: 1.2;
    }
    .delete-modal p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
        color: #475569;
    }
    .delete-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 22px;
    }
    .btn-cancel,
    .btn-delete-confirm {
        border: none;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.18s ease;
    }
    .btn-cancel {
        background: #e2e8f0;
        color: #1f2937;
    }
    .btn-delete-confirm {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        box-shadow: 0 10px 20px rgba(220, 38, 38, 0.22);
    }
    .btn-cancel:hover,
    .btn-delete-confirm:hover {
        transform: translateY(-1px);
    }
    .btn-delete-confirm:disabled {
        opacity: 0.75;
        cursor: wait;
    }
    .data-row.is-removing {
        animation: rowFadeBurn 0.55s ease forwards;
    }
    .data-row.is-removing td {
        background: linear-gradient(90deg, rgba(254, 226, 226, 0.95), rgba(254, 202, 202, 0.8));
        box-shadow: inset 0 0 0 1px rgba(239, 68, 68, 0.1);
    }
    @keyframes rowFadeBurn {
        0% {
            opacity: 1;
            transform: translateX(0) scale(1);
            filter: saturate(1);
        }
        20% {
            opacity: 1;
            transform: translateX(0) scale(1.005);
            filter: saturate(1.5);
        }
        60% {
            opacity: 0.7;
            transform: translateX(-4px) scale(0.99);
            filter: blur(0.6px) brightness(1.1);
        }
        100% {
            opacity: 0;
            transform: translateX(18px) scale(0.97);
            filter: blur(1.7px) brightness(0.9);
        }
    }
    
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: var(--text-muted);
        flex-wrap: wrap;
    }
    .pagination {
        display: flex;
        align-items: center;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
    }
    .page-item {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        list-style: none;
        min-width: 34px;
        min-height: 34px;
        padding: 6px 10px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background: #fff;
        color: var(--text-main);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.18s ease;
    }
    .page-item:hover:not(.disabled):not(.active) {
        border-color: var(--color-primary);
        color: var(--color-primary);
    }
    .page-item.active {
        background: var(--color-primary);
        border-color: var(--color-primary);
        color: #fff;
        box-shadow: 0 8px 18px rgba(30, 64, 175, 0.18);
    }
    .page-item.disabled {
        opacity: 0.45;
        pointer-events: none;
    }
    .alert-success {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 1300;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 260px;
        max-width: min(420px, calc(100vw - 32px));
        padding: 14px 16px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(236, 253, 245, 0.98), rgba(220, 252, 231, 0.98));
        border: 1px solid rgba(34, 197, 94, 0.4);
        color: #166534;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 18px 40px rgba(22, 101, 52, 0.15);
        opacity: 0;
        transform: translateY(-12px);
        transition: opacity 0.22s ease, transform 0.22s ease;
        pointer-events: none;
    }
    .alert-success.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .alert-success .toast-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(34, 197, 94, 0.15);
        display: grid;
        place-items: center;
        color: #15803d;
        flex-shrink: 0;
    }
    .preview-img-mini { width: 44px; height: 44px; border-radius: 6px; object-fit: cover; border: 1px solid var(--border-color); display: inline-block; vertical-align: middle; }

    /* ========================================================
       DATATABLES STYLING & CENTERING PRESERVATION
       ======================================================== */
    table.dataTable,
    .data-table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    table.dataTable thead th,
    table.dataTable tbody td,
    table.dataTable tfoot th,
    .data-table th,
    .data-table td {
        text-align: center !important;
        vertical-align: middle !important;
    }

    table.dataTable thead th {
        background: var(--bg-main) !important;
        color: var(--text-main);
        font-weight: 700;
        border-bottom: 2px solid var(--border-color) !important;
        text-transform: uppercase;
        font-size: 11px;
        padding: 14px !important;
        position: relative;
    }

    /* Suppress DataTables default duplicate arrow pseudo-elements */
    table.dataTable thead>tr>th:before,
    table.dataTable thead>tr>th:after,
    table.dataTable thead>tr>th.sorting:before,
    table.dataTable thead>tr>th.sorting:after,
    table.dataTable thead>tr>th.sorting_asc:before,
    table.dataTable thead>tr>th.sorting_asc:after,
    table.dataTable thead>tr>th.sorting_desc:before,
    table.dataTable thead>tr>th.sorting_desc:after {
        display: none !important;
        content: "" !important;
        opacity: 0 !important;
    }

    /* Single Interactive Sort Arrow (⇅, ↑, ↓) */
    .dt-th-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        position: relative;
        user-select: none;
    }
    .dt-th-title {
        display: inline-block;
    }
    .dt-sort-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        margin-left: 2px;
        color: var(--text-muted);
        transition: color 0.15s ease, opacity 0.15s ease;
    }
    th.sorting .dt-sort-arrow::before {
        content: "⇅";
        opacity: 0.35;
    }
    th.sorting_asc .dt-sort-arrow::before {
        content: "↑";
        color: var(--color-primary);
        opacity: 1;
        font-weight: 900;
    }
    th.sorting_desc .dt-sort-arrow::before {
        content: "↓";
        color: var(--color-primary);
        opacity: 1;
        font-weight: 900;
    }
    th.sorting_disabled .dt-sort-arrow {
        display: none !important;
    }

    th.dt-has-menu {
        cursor: pointer;
    }

    /* Distinct Column Hamburger Dropdown Menu Button */
    .dt-header-filter {
        position: relative;
        display: inline-flex;
        align-items: center;
        margin-left: 6px;
        vertical-align: middle;
    }
    .dt-hamburger-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        min-width: 26px;
        height: 24px;
        padding: 0 6px;
        border-radius: 6px;
        border: 1.5px solid var(--border-color);
        background: #ffffff;
        color: var(--color-primary);
        cursor: pointer;
        transition: all 0.18s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
    }
    .dt-hamburger-btn:hover {
        border-color: var(--color-primary);
        background-color: #f0f7ff;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(10, 65, 116, 0.15);
    }
    .dt-hamburger-btn.is-filtered,
    .dt-hamburger-btn.is-sorted {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
        color: #ffffff;
        box-shadow: 0 2px 6px rgba(10, 65, 116, 0.25);
    }
    .dt-hamburger-btn.is-filtered .dt-hamburger-icon line,
    .dt-hamburger-btn.is-sorted .dt-hamburger-icon line {
        stroke: #ffffff !important;
    }
    .dt-hamburger-btn.active-popover {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(10, 65, 116, 0.15);
    }
    .dt-hamburger-icon {
        display: block;
        pointer-events: none;
        flex-shrink: 0;
    }
    .dt-menu-indicator {
        font-size: 11px;
        font-weight: 900;
        line-height: 1;
        display: none;
        color: inherit;
    }
    .dt-hamburger-btn.is-sorted .dt-menu-indicator {
        display: inline-block;
    }

    /* Dropdown Popover Menu (Fixed positioning avoids table-responsive clipping) */
    .dt-dropdown-menu {
        position: fixed;
        background: #ffffff;
        border: 1px solid rgba(15, 23, 42, 0.12);
        box-shadow: 0 14px 34px rgba(10, 65, 116, 0.18), 0 4px 12px rgba(0, 0, 0, 0.06);
        border-radius: 12px;
        min-width: 220px;
        max-width: 280px;
        z-index: 99999;
        padding: 10px 8px;
        text-align: left;
        display: none;
        opacity: 0;
        transform: translateY(-6px);
        transition: opacity 0.16s ease, transform 0.16s ease;
    }
    .dt-dropdown-menu.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
    .dt-dropdown-section {
        padding: 2px 4px;
    }
    .dt-dropdown-section-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--color-primary);
        padding: 4px 6px 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.04em;
    }
    .dt-filter-reset-btn {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        padding: 2px 6px;
        border-radius: 4px;
        transition: all 0.15s ease;
    }
    .dt-filter-reset-btn:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    .dt-dropdown-divider {
        height: 1px;
        background: var(--border-color);
        margin: 8px 4px;
    }
    .dt-menu-sort-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        padding: 7px 10px;
        border: none;
        background: transparent;
        border-radius: 7px;
        color: var(--text-main);
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-align: left;
        transition: background-color 0.15s ease, color 0.15s ease;
    }
    .dt-menu-sort-btn:hover {
        background-color: rgba(10, 65, 116, 0.08);
        color: var(--color-primary);
    }
    .dt-menu-sort-btn.active {
        background-color: rgba(10, 65, 116, 0.12);
        color: var(--color-primary);
        font-weight: 700;
    }
    .dt-menu-sort-icon {
        font-weight: 900;
        font-size: 13px;
        color: var(--color-primary);
        width: 16px;
        text-align: center;
    }
    .dt-filter-list {
        max-height: 180px;
        overflow-y: auto;
        padding-right: 4px;
    }
    .dt-filter-list::-webkit-scrollbar {
        width: 4px;
    }
    .dt-filter-list::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .dt-filter-list::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .dt-dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 8px;
        font-size: 12px;
        font-weight: 500;
        color: var(--text-main);
        cursor: pointer;
        border-radius: 6px;
        transition: all 0.15s ease;
        user-select: none;
    }
    .dt-dropdown-item:hover {
        background-color: rgba(10, 65, 116, 0.06);
    }
    .dt-dropdown-item input[type="checkbox"] {
        accent-color: var(--color-primary);
        cursor: pointer;
        width: 15px;
        height: 15px;
        border-radius: 4px;
        flex-shrink: 0;
    }

    /* Seamless DataTables Toolbar (Show Data Far Left & Search Bar Far Right) */
    .dataTables_wrapper {
        width: 100%;
        font-family: inherit;
        font-size: 13px;
        color: var(--text-main);
    }
    .dt-controls-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
        flex-wrap: wrap;
        padding: 0 2px;
    }
    .dataTables_wrapper .dataTables_length {
        display: inline-flex;
        align-items: center;
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
        margin: 0;
    }
    .dataTables_wrapper .dataTables_length label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
        margin: 0;
    }
    .dataTables_wrapper .dataTables_length select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%230a4174' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") no-repeat right 10px center;
        padding: 7px 30px 7px 12px;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--color-primary);
        outline: none;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
        min-width: 64px;
    }
    .dataTables_wrapper .dataTables_length select:hover {
        border-color: var(--color-primary);
        background-color: #f8fafc;
    }
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(10, 65, 116, 0.1);
    }
    .dataTables_wrapper .dataTables_filter {
        margin: 0;
        position: relative;
    }
    .dataTables_wrapper .dataTables_filter label {
        margin: 0;
        display: inline-flex;
        align-items: center;
        position: relative;
        font-size: 0;
        color: transparent;
    }
    .dataTables_wrapper .dataTables_filter input {
        margin: 0 !important;
        padding: 8px 16px 8px 38px !important;
        border: 1.5px solid var(--border-color) !important;
        border-radius: 10px !important;
        background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.3-4.3'/%3E%3C/svg%3E") no-repeat 13px center !important;
        color: var(--text-main) !important;
        font-size: 13px !important;
        outline: none !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
        width: 260px !important;
        font-family: inherit !important;
    }
    .dataTables_wrapper .dataTables_filter input:hover {
        border-color: #cbd5e1 !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 3.5px rgba(10, 65, 116, 0.12) !important;
        width: 300px !important;
    }
    .dataTables_wrapper .dataTables_filter input::placeholder {
        color: #94a3b8 !important;
        font-size: 13px !important;
        font-weight: 400 !important;
    }

    /* Table border wrapper — applied after DataTables wraps the element */
    .dataTables_wrapper .table-responsive {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        overflow-x: auto;
        background: #ffffff;
    }

    /* Bottom Info & Pagination - Seamless without outer card/box */
    .dt-bottom-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: 16px;
        flex-wrap: wrap;
        font-size: 13px;
        color: var(--text-muted);
        padding: 4px 0 !important;
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }
    .dataTables_wrapper .dataTables_info {
        margin: 0 !important;
        font-size: 13px !important;
        color: var(--text-muted) !important;
        font-weight: 500 !important;
        padding: 0 !important;
    }
    .dataTables_wrapper .dataTables_paginate {
        margin: 0 !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 32px !important;
        height: 32px !important;
        border-radius: 8px !important;
        padding: 0 10px !important;
        border: 1px solid var(--border-color) !important;
        background: #ffffff !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        color: var(--text-main) !important;
        transition: all 0.15s ease !important;
        cursor: pointer !important;
        margin: 0 2px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) {
        background: #f1f5f9 !important;
        border-color: var(--color-primary) !important;
        color: var(--color-primary) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--color-primary) !important;
        color: #ffffff !important;
        border-color: var(--color-primary) !important;
        box-shadow: 0 2px 6px rgba(10, 65, 116, 0.25) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: var(--text-muted) !important;
        opacity: 0.45 !important;
        cursor: not-allowed !important;
        border-color: var(--border-color) !important;
        background: transparent !important;
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('.data-table')) {
            $('.data-table').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari total _MAX_ entri)",
                    "zeroRecords": "Tidak ditemukan data yang cocok",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "pageLength": 10,
                "ordering": true,
                "responsive": true
            });
        }
    });
</script>
</div>
</div>
@endsection
