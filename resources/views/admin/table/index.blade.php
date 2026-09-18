@extends('admin.layout.index')

@section('page_title')
    {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}
@endsection

@section('content')
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

<!-- jQuery & DataTables CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

@if (session('success'))
    <div id="successToast" class="alert-success" role="status" aria-live="polite">
        <span class="toast-icon"><i class="fa-solid fa-circle-check"></i></span>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="crud-card-full">
    <div class="table-header">
        <div>
            <h2 style="font-size: 18px; font-weight: 700;">Daftar {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}</h2>
            <p style="font-size: 12px; color: var(--text-muted)">Gunakan halaman ini untuk memantau atau memperbarui susunan berkas informasi website.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            @if ($table_key === 'alumni_boards')
                <a href="{{ route('admin.committee-periods.index') }}" class="btn-period">
                    <i class="fa-solid fa-calendar-days"></i> Kelola Periode
                </a>
            @endif
            <a href="{{ route('admin.table.create', $table_key) }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <table id="alumniDataTable" class="data-table display nowrap" style="width:100%">
            <thead>
                <tr>
                    <!-- Kepala Kolom Nomor Urut -->
                    <th class="col-number-header">No</th>
                    @foreach($mapping['list_columns'] as $col)
                        @php
                            $label = $mapping['fields'][$col]['label'] ?? ucwords(str_replace('_', ' ', $col));
                            $fieldType = $mapping['fields'][$col]['type'] ?? null;
                            $isCategorizable =
                                in_array($col, ['study_status', 'graduation_year']) ||
                                in_array($fieldType, ['select', 'toggle']);
                        @endphp
                        <th data-col="{{ $col }}" class="{{ $isCategorizable ? 'dt-has-menu' : '' }}">
                            <div class="dt-th-box">
                                <span class="dt-th-title">{{ $label }}</span>
                                @if(!$isCategorizable)
                                    <span class="dt-sort-arrow" aria-hidden="true"></span>
                                @else
                                    <div class="dt-header-filter" data-col-idx="{{ $loop->index + 1 }}" data-col-name="{{ $label }}">
                                        <button type="button" class="dt-hamburger-btn" title="Urutkan & Filter {{ $label }}" aria-label="Urutkan & Filter {{ $label }}">
                                            <svg class="dt-hamburger-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#0a4174" stroke-width="2.8" stroke-linecap="round">
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                                <line x1="3" y1="18" x2="21" y2="18"></line>
                                            </svg>
                                            <span class="dt-menu-indicator" aria-hidden="true"></span>
                                        </button>
                                        <div class="dt-dropdown-menu"></div>
                                    </div>
                                @endif
                            </div>
                        </th>
                    @endforeach
                    <th style="text-align: center; width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($rows->count() > 0)
                    @foreach($rows as $row)
                        @php
                            $rowNumber = $loop->iteration;
                        @endphp
                                              <tr class="data-row">
                            <td class="col-number-data">{{ $rowNumber }}</td>
                            @foreach($mapping['list_columns'] as $col)
                                <td data-col="{{ $col }}">
                                  @if(in_array($col, ['avatar', 'thumbnail', 'photo_path', 'cover_photo', 'company_logo']))
                                      @if($col === 'company_logo')
                                          <x-company-logo :logo="$row->$col" :name="$row->company_name ?? ($row->title ?? 'Perusahaan')" size="40" option="initials" />
                                      @elseif(!empty($row->$col))
                                          <!-- Otomatis membaca path upload dari folder public/uploads/ -->
                                          <img src="{{ Str::startsWith($row->$col, 'http') ? $row->$col : asset($row->$col) }}" class="preview-img-mini" alt="Lampiran" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%2394a3b8\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'9\' cy=\'9\' r=\'2\'/><path d=\'m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21\'/></svg>';">
                                      @else
                                          <span style="color: var(--text-muted); font-style: italic;">Tidak ada foto</span>
                                      @endif

                                    @elseif($col === 'study_status')
                                        <!-- Penyelamat status jika di halaman pengurus alumni agar tidak eror properti -->
                                        @php
                                            $statusVal = ($table_key === 'alumni_boards') 
                                                ? DB::table('alumni_profiles')->where('id', $row->alumni_profile_id)->value('study_status') 
                                                : ($row->$col ?? 'Aktif');
                                        @endphp
                                        <span style="background-color: {{ $statusVal === 'Aktif' ? '#d1fae5' : '#fee2e2' }}; color: {{ $statusVal === 'Aktif' ? '#065f46' : '#991b1b' }}; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 11px;">
                                            {{ $statusVal === 'Aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    @elseif(isset($mapping['fields'][$col]['type']) && $mapping['fields'][$col]['type'] === 'toggle')
                                        <span style="background-color: {{ $row->$col ? '#d1fae5' : '#fee2e2' }}; color: {{ $row->$col ? '#065f46' : '#991b1b' }}; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 11px;">
                                            {{ $mapping['fields'][$col]['options'][$row->$col] ?? ($row->$col ? 'Buka' : 'Tutup') }}
                                        </span>
                                    @elseif(isset($mapping['fields'][$col]['type']) && $mapping['fields'][$col]['type'] === 'date' && !empty($row->$col))
                                        {{ strtolower(\Carbon\Carbon::parse($row->$col)->locale('id')->translatedFormat('d F Y')) }}
                                    
                                    <!-- ========================================================
                                       BAGIAN PROSES REPLACEMENT UNTUK HANDLER KOLOM VIRTUAL
                                       ======================================================== -->
                                    @else
                                        @if($table_key === 'alumni_boards' && $col === 'company_logo')
                                            <!-- Fallback aman jika kolom pembawa logo ikut terbaca array list -->
                                            <span style="color: var(--text-muted); font-style: italic;">Tidak ada foto</span>
                                        @elseif($table_key === 'alumni_boards' && $col === 'alumni_name')
                                            @php
                                                $alumniName = DB::table('alumni_profiles')
                                                    ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                                                    ->where('alumni_profiles.id', $row->alumni_profile_id)
                                                    ->value('users.name');
                                            @endphp
                                            {{ strip_tags($alumniName) ?? '-' }}
                                        @elseif($table_key === 'alumni_boards' && $col === 'period_name')
                                            @php
                                                $periodName = DB::table('committee_periods')
                                                    ->where('id', $row->committee_period_id)
                                                    ->value('period_name');
                                            @endphp
                                            {{ strip_tags($periodName) ?? '-' }}
                                        @else
                                            {{ strip_tags($row->$col ?? '-') }}
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                            <td style="text-align: center;">
                                <div class="action-badge">
                                    <a href="{{ url('admin/table/'.$table_key.'/'.$row->id) }}" class="btn-action btn-detail">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.table.edit', [$table_key, $row->id]) }}" class="btn-action btn-edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form class="delete-form" action="{{ route('admin.table.destroy', [$table_key, $row->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action btn-delete delete-trigger">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count($mapping['list_columns']) + 2 }}" style="text-align: center; padding: 40px; color: var(--text-muted)">
                            Belum ada riwayat data yang ditambahkan.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>


</div>

<div class="delete-modal-backdrop" id="deleteModalBackdrop" aria-hidden="true" hidden>
    <div class="delete-modal" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
        <div class="delete-modal-icon" aria-hidden="true">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 id="deleteModalTitle">Anda yakin ingin menghapus data ini?</h3>
        <p>Data yang dihapus tidak akan bisa dikembalikan. Pastikan Anda benar-benar ingin melanjutkan.</p>
        <div class="delete-modal-actions">
            <button type="button" class="btn-cancel" id="cancelDeleteBtn">Batal</button>
            <button type="button" class="btn-delete-confirm" id="confirmDeleteBtn">Hapus</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Success Toast auto-dismiss
        const successToast = document.getElementById('successToast');
        if (successToast) {
            requestAnimationFrame(function () {
                successToast.classList.add('is-visible');
            });

            setTimeout(function () {
                successToast.classList.remove('is-visible');
                setTimeout(function () {
                    successToast.remove();
                }, 220);
            }, 2800);
        }

        // ========================================================
        // DATATABLES INITIALIZATION & CONFIGURATION
        // ========================================================
        const tableElement = $('#alumniDataTable');
        if (tableElement.length && tableElement.find('tbody tr.data-row').length > 0) {
            const dt = tableElement.DataTable({
                dom: '<"dt-controls-bar"lf><"table-responsive"t><"dt-bottom-bar"ip>',
                paging: true,
                pageLength: 10,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                columnDefs: [
                    // NO (target 0) and AKSI (target -1) excluded from sorting and search
                    { targets: [0, -1], orderable: false, searchable: false },
                    { targets: '_all', className: 'dt-center' }
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Cari data...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Data tidak ditemukan",
                    emptyTable: "Data tidak ditemukan",
                    info: "Menampilkan _TOTAL_ data di halaman ini",
                    infoEmpty: "Menampilkan 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                },
                order: [], // Respect natural database order initially
                initComplete: function () {
                    const api = this.api();

                    // Escape helper for safe HTML
                    const escapeHtml = function (str) {
                        return $('<div>').text(str).html();
                    };

                    // Populate Dropdown Filters for categorizable columns (Tahun Kelulusan & Status)
                    $('.dt-header-filter').each(function () {
                        const wrapper = $(this);
                        const colIdx = parseInt(wrapper.data('col-idx'));
                        const menu = wrapper.find('.dt-dropdown-menu');
                        const column = api.column(colIdx);
                        const colTitle = wrapper.data('col-name') || 'Kolom';

                        // Extract clean unique text values
                        const uniqueValues = [];
                        column.data().each(function (value) {
                            const text = $('<div>').html(value).text().trim();
                            if (text && text !== '-' && !uniqueValues.includes(text)) {
                                uniqueValues.push(text);
                            }
                        });

                        menu.empty();

                        // Construct checkbox items HTML
                        let itemsHtml = '';
                        uniqueValues.sort().forEach(function (val) {
                            itemsHtml += `
                                <label class="dt-dropdown-item">
                                    <input type="checkbox" class="dt-filter-val" value="${escapeHtml(val)}" checked>
                                    <span>${escapeHtml(val)}</span>
                                </label>
                            `;
                        });

                        menu.html(`
                            <div class="dt-dropdown-section">
                                <div class="dt-dropdown-section-title">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 16 4 4 4-4"/><path d="M7 20V4"/><path d="m21 8-4-4-4 4"/><path d="M17 4v16"/></svg>
                                    Urutan Kolom
                                </div>
                                <button type="button" class="dt-menu-sort-btn" data-dir="asc">
                                    <span class="dt-menu-sort-icon">↑</span>
                                    <span>Ascending (A-Z / Terkecil)</span>
                                </button>
                                <button type="button" class="dt-menu-sort-btn" data-dir="desc">
                                    <span class="dt-menu-sort-icon">↓</span>
                                    <span>Descending (Z-A / Terbesar)</span>
                                </button>
                            </div>
                            <div class="dt-dropdown-divider"></div>
                            <div class="dt-dropdown-section">
                                <div class="dt-dropdown-section-title" style="justify-content: space-between;">
                                    <span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                                        Filter ${escapeHtml(colTitle)}
                                    </span>
                                    <button type="button" class="dt-filter-reset-btn" title="Reset semua filter">Reset</button>
                                </div>
                                <div class="dt-filter-list">
                                    <label class="dt-dropdown-item">
                                        <input type="checkbox" class="dt-filter-select-all" checked>
                                        <span style="font-weight: 700;">Pilih Semua</span>
                                    </label>
                                    ${itemsHtml}
                                </div>
                            </div>
                        `);

                        // Menu Sort click event
                        menu.on('click', '.dt-menu-sort-btn', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            const dir = $(this).data('dir');
                            api.column(colIdx).order(dir).draw();
                            menu.find('.dt-menu-sort-btn').removeClass('active');
                            $(this).addClass('active');
                            menu.removeClass('show');
                            wrapper.find('.dt-hamburger-btn').removeClass('active-popover');
                        });

                        // Reset filter click
                        menu.on('click', '.dt-filter-reset-btn', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            menu.find('.dt-filter-select-all').prop('checked', true);
                            menu.find('.dt-filter-val').prop('checked', true);
                            column.search('').draw();
                            wrapper.find('.dt-hamburger-btn').removeClass('is-filtered');
                        });

                        // Select All checkbox change
                        menu.on('change', '.dt-filter-select-all', function () {
                            const isChecked = $(this).is(':checked');
                            menu.find('.dt-filter-val').prop('checked', isChecked);
                            if (isChecked) {
                                column.search('').draw();
                                wrapper.find('.dt-hamburger-btn').removeClass('is-filtered');
                            } else {
                                column.search('^$|__NOMATCH__', true, false).draw();
                                wrapper.find('.dt-hamburger-btn').addClass('is-filtered');
                            }
                        });

                        // Individual checkbox change
                        menu.on('change', '.dt-filter-val', function () {
                            const totalVals = menu.find('.dt-filter-val').length;
                            const checkedBoxes = menu.find('.dt-filter-val:checked');
                            const checkedCount = checkedBoxes.length;

                            if (checkedCount === totalVals) {
                                menu.find('.dt-filter-select-all').prop('checked', true);
                                column.search('').draw();
                                wrapper.find('.dt-hamburger-btn').removeClass('is-filtered');
                            } else if (checkedCount === 0) {
                                menu.find('.dt-filter-select-all').prop('checked', false);
                                column.search('^$|__NOMATCH__', true, false).draw();
                                wrapper.find('.dt-hamburger-btn').addClass('is-filtered');
                            } else {
                                menu.find('.dt-filter-select-all').prop('checked', false);
                                const selectedVals = [];
                                checkedBoxes.each(function () {
                                    selectedVals.push($.fn.dataTable.util.escapeRegex($(this).val()));
                                });
                                const regexStr = '^(' + selectedVals.join('|') + ')$';
                                column.search(regexStr, true, false).draw();
                                wrapper.find('.dt-hamburger-btn').addClass('is-filtered');
                            }
                        });
                    });
                }
            });

            // Dynamic Row Re-indexing Hook on order and search
            dt.on('order.dt search.dt', function () {
                dt.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            });

            // Synchronize sorted status & direction to the hamburger button indicator
            dt.on('order.dt', function () {
                const currentOrder = dt.order();
                $('.dt-header-filter').each(function () {
                    const wrapper = $(this);
                    const colIdx = parseInt(wrapper.data('col-idx'));
                    const btn = wrapper.find('.dt-hamburger-btn');
                    const indicator = wrapper.find('.dt-menu-indicator');
                    const menu = wrapper.find('.dt-dropdown-menu');

                    let isThisColSorted = false;
                    let sortDir = '';
                    if (currentOrder && currentOrder.length) {
                        for (let k = 0; k < currentOrder.length; k++) {
                            if (currentOrder[k][0] === colIdx) {
                                isThisColSorted = true;
                                sortDir = currentOrder[k][1];
                                break;
                            }
                        }
                    }

                    if (isThisColSorted) {
                        btn.addClass('is-sorted');
                        indicator.text(sortDir === 'asc' ? '↑' : '↓');
                        menu.find('.dt-menu-sort-btn').removeClass('active');
                        menu.find(`.dt-menu-sort-btn[data-dir="${sortDir}"]`).addClass('active');
                    } else {
                        btn.removeClass('is-sorted');
                        indicator.text('');
                        menu.find('.dt-menu-sort-btn').removeClass('active');
                    }
                });
            });

            // Toggle filter dropdown popover directly beneath the hamburger button
            $(document).on('click', '.dt-hamburger-btn', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const btn = $(this);
                const wrapper = btn.closest('.dt-header-filter');
                const menu = wrapper.find('.dt-dropdown-menu');
                const isCurrentlyOpen = menu.hasClass('show');

                // Close all other open dropdowns
                $('.dt-dropdown-menu').removeClass('show');
                $('.dt-hamburger-btn').removeClass('active-popover');

                if (!isCurrentlyOpen) {
                    btn.addClass('active-popover');

                    // Calculate fixed position directly beneath the hamburger button
                    const rect = btn[0].getBoundingClientRect();
                    const menuWidth = 230;
                    let leftPos = rect.left + (rect.width / 2) - (menuWidth / 2);

                    // Ensure within viewport boundaries
                    if (leftPos + menuWidth > window.innerWidth - 12) {
                        leftPos = window.innerWidth - menuWidth - 12;
                    }
                    if (leftPos < 12) {
                        leftPos = 12;
                    }

                    menu.css({
                        top: (rect.bottom + 6) + 'px',
                        left: leftPos + 'px',
                        width: menuWidth + 'px'
                    });

                    menu.addClass('show');
                }
            });

            // Prevent clicks inside the dropdown menu from closing it
            $(document).on('click', '.dt-dropdown-menu', function (e) {
                e.stopPropagation();
            });

            // Close filter dropdowns when clicking outside
            $(document).on('click', function (e) {
                if (!$(e.target).closest('.dt-header-filter, .dt-dropdown-menu').length) {
                    $('.dt-dropdown-menu').removeClass('show');
                    $('.dt-hamburger-btn').removeClass('active-popover');
                }
            });

            // Close filter dropdowns on Escape key
            $(document).on('keydown', function (e) {
                if (e.key === 'Escape') {
                    $('.dt-dropdown-menu').removeClass('show');
                    $('.dt-hamburger-btn').removeClass('active-popover');
                }
            });

            // Close filter dropdowns when scrolling or resizing
            $(window).on('scroll resize', function () {
                $('.dt-dropdown-menu').removeClass('show');
                $('.dt-hamburger-btn').removeClass('active-popover');
            });
        }

        // ========================================================
        // DELETE MODAL ACTIONS (EVENT DELEGATION)
        // ========================================================
        const backdrop = document.getElementById('deleteModalBackdrop');
        const cancelBtn = document.getElementById('cancelDeleteBtn');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        let activeForm = null;

        const openModal = () => {
            backdrop.hidden = false;
            requestAnimationFrame(() => backdrop.classList.add('is-open'));
        };

        const closeModal = () => {
            backdrop.classList.remove('is-open');
            setTimeout(() => {
                backdrop.hidden = true;
            }, 180);
        };

        $(document).on('click', '.delete-trigger', function () {
            activeForm = $(this).closest('.delete-form')[0];
            openModal();
        });

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                activeForm = null;
                closeModal();
            });
        }

        if (backdrop) {
            backdrop.addEventListener('click', function (event) {
                if (event.target === backdrop) {
                    activeForm = null;
                    closeModal();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && backdrop && !backdrop.hidden) {
                activeForm = null;
                closeModal();
            }
        });

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function () {
                if (!activeForm) return;

                const row = activeForm.closest('tr');
                if (row) {
                    row.classList.add('is-removing');
                }

                confirmBtn.disabled = true;
                confirmBtn.textContent = 'Menghapus...';

                setTimeout(function () {
                    activeForm.submit();
                }, 280);
            });
        }
    });
</script>
@endsection
