@extends('admin.layout.index')

@section('page_title', 'Album Foto')

@section('content')
<style>
    .crud-card-full { 
        width: 100%; 
        background: var(--bg-card, #ffffff); 
        border: 1px solid var(--border-color, #e2e8f0); 
        border-radius: 12px; 
        padding: 24px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.02); 
    }
    .table-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px; 
        gap: 16px;
        flex-wrap: wrap;
    }
    .table-header h2 {
        font-size: 18px; 
        font-weight: 700; 
        color: var(--color-primary, #0a4174);
        margin: 0 0 4px 0;
    }
    .table-header p {
        font-size: 12px; 
        color: var(--text-muted, #64748b);
        margin: 0;
    }
    .btn-add { 
        background: var(--color-primary, #0a4174); 
        color: #fff; 
        padding: 10px 16px; 
        border-radius: 6px; 
        text-decoration: none; 
        font-size: 13px; 
        font-weight: 600; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        border: 1px solid var(--border-dark, #08335c); 
        transition: all 0.15s ease;
    }
    .btn-add:hover {
        background: #08335c;
        color: #fff;
    }
    
    /* Table Base */
    .data-table { 
        width: 100%; 
        border-collapse: collapse; 
        text-align: center; 
        font-size: 13px; 
    }
    .data-table th { 
        background: var(--bg-main, #f8fafc); 
        padding: 14px 16px; 
        color: var(--text-main, #1e293b); 
        font-weight: 700; 
        border-bottom: 2px solid var(--border-color, #e2e8f0); 
        text-transform: uppercase; 
        font-size: 11px; 
        text-align: center; 
        position: relative;
    }
    .data-table td { 
        padding: 14px 16px; 
        border-bottom: 1px solid var(--border-color, #e2e8f0); 
        color: var(--text-main, #1e293b); 
        max-width: 250px; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        white-space: nowrap; 
        vertical-align: middle; 
        text-align: center; 
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
        color: var(--text-muted, #94a3b8);
        transition: color 0.15s ease, opacity 0.15s ease;
    }
    th.sorting .dt-sort-arrow::before {
        content: "⇅";
        opacity: 0.35;
    }
    th.sorting_asc .dt-sort-arrow::before {
        content: "↑";
        color: var(--color-primary, #0a4174);
        opacity: 1;
        font-weight: 900;
    }
    th.sorting_desc .dt-sort-arrow::before {
        content: "↓";
        color: var(--color-primary, #0a4174);
        opacity: 1;
        font-weight: 900;
    }
    th.sorting_disabled .dt-sort-arrow {
        display: none !important;
    }
    
    /* Kolom Nomor Urut Khusus */
    .col-number-header { 
        width: 60px; 
        text-align: center; 
    }
    .col-number-data { 
        text-align: center; 
        font-weight: 700; 
        color: var(--text-muted, #64748b); 
        background-color: rgba(244, 248, 251, 0.5); 
    }
    
    /* Tombol Aksi */
    .action-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    .btn-action {
        text-decoration: none;
        font-weight: 600;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 6px 12px;
        border-radius: 8px;
        transition: transform 0.15s ease, background 0.15s ease, opacity 0.15s ease;
    }
    .btn-action:hover {
        transform: translateY(-1px);
    }
    .btn-detail {
        color: #10b981;
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .btn-edit {
        color: #3b82f6;
        background: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    .btn-delete {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.08);
        border: 1px solid rgba(239, 68, 68, 0.2);
        cursor: pointer;
        font-family: inherit;
    }
    .delete-form {
        display: inline-flex;
        margin: 0;
    }

    /* Seamless DataTables Toolbar (Show Data Far Left & Search Bar Far Right) */
    .dataTables_wrapper {
        width: 100%;
        font-family: inherit;
        font-size: 13px;
        color: var(--text-main, #1e293b);
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
        color: var(--text-muted, #64748b);
        font-weight: 500;
        margin: 0;
    }
    .dataTables_wrapper .dataTables_length label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 13px;
        color: var(--text-muted, #64748b);
        font-weight: 500;
        margin: 0;
    }
    .dataTables_wrapper .dataTables_length select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%230a4174' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") no-repeat right 10px center;
        padding: 7px 30px 7px 12px;
        border: 1.5px solid var(--border-color, #e2e8f0);
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--color-primary, #0a4174);
        outline: none;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
        min-width: 64px;
    }
    .dataTables_wrapper .dataTables_length select:hover {
        border-color: var(--color-primary, #0a4174);
        background-color: #f8fafc;
    }
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: var(--color-primary, #0a4174);
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
        border: 1.5px solid var(--border-color, #e2e8f0) !important;
        border-radius: 10px !important;
        background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.3-4.3'/%3E%3C/svg%3E") no-repeat 13px center !important;
        color: var(--text-main, #1e293b) !important;
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
        border-color: var(--color-primary, #0a4174) !important;
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
        border: 1px solid var(--border-color, #e2e8f0);
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
        color: var(--text-muted, #64748b);
        padding: 4px 0 !important;
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }
    .dataTables_wrapper .dataTables_info {
        margin: 0 !important;
        font-size: 13px !important;
        color: var(--text-muted, #64748b) !important;
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
        border: 1px solid var(--border-color, #e2e8f0) !important;
        background: #ffffff !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        color: var(--text-main, #1e293b) !important;
        transition: all 0.15s ease !important;
        cursor: pointer !important;
        margin: 0 2px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) {
        background: #f1f5f9 !important;
        border-color: var(--color-primary, #0a4174) !important;
        color: var(--color-primary, #0a4174) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--color-primary, #0a4174) !important;
        color: #ffffff !important;
        border-color: var(--color-primary, #0a4174) !important;
        box-shadow: 0 2px 6px rgba(10, 65, 116, 0.25) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: var(--text-muted, #94a3b8) !important;
        opacity: 0.45 !important;
        cursor: not-allowed !important;
        border-color: var(--border-color, #e2e8f0) !important;
        background: transparent !important;
    }

    /* Delete Modal Backdrop & Card */
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
        0% { opacity: 1; transform: translateX(0) scale(1); filter: saturate(1); }
        20% { opacity: 1; transform: translateX(0) scale(1.005); filter: saturate(1.5); }
        60% { opacity: 0.7; transform: translateX(-4px) scale(0.99); filter: blur(0.6px) brightness(1.1); }
        100% { opacity: 0; }
    }

    /* Toast Notifikasi Sukses */
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
            <h2>Daftar Album Foto</h2>
            <p>Gunakan halaman ini untuk memantau atau memperbarui susunan berkas informasi website.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('admin.albums.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <table id="albumsDataTable" class="data-table display nowrap" style="width:100%">
        <thead>
            <tr>
                <th class="col-number-header">NO</th>
                <th>
                    <div class="dt-th-box">
                        <span class="dt-th-title">Nama Album</span>
                        <span class="dt-sort-arrow"></span>
                    </div>
                </th>
                <th>
                    <div class="dt-th-box">
                        <span class="dt-th-title">Kategori</span>
                        <span class="dt-sort-arrow"></span>
                    </div>
                </th>
                <th>
                    <div class="dt-th-box">
                        <span class="dt-th-title">Target Angkatan</span>
                        <span class="dt-sort-arrow"></span>
                    </div>
                </th>
                <th>
                    <div class="dt-th-box">
                        <span class="dt-th-title">Foto</span>
                        <span class="dt-sort-arrow"></span>
                    </div>
                </th>
                <th style="text-align: center; width: 220px;">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($albums as $album)
                <tr class="data-row">
                    <td class="col-number-data">{{ $loop->iteration }}</td>
                    <td style="font-weight: 500;">{{ $album->title }}</td>
                    <td>{{ $album->category }}</td>
                    <td>{{ $album->target_generation ?? '-' }}</td>
                    <td style="text-align: center;">
                        @if($album->cover_photo)
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                                <img src="{{ asset($album->cover_photo) }}" alt="Cover" style="width: 48px; height: 48px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color, #e2e8f0);">
                                <span style="font-size: 11px; font-weight: 600; color: var(--text-muted, #64748b);">{{ $album->photos_count }} item</span>
                            </div>
                        @else
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                                <div style="width: 48px; height: 48px; background: #f4f8fb; border: 1px dashed var(--border-color, #e2e8f0); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 16px;">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                                <span style="font-size: 11px; font-weight: 600; color: var(--text-muted, #64748b);">{{ $album->photos_count }} item</span>
                            </div>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div class="action-badge">
                            <a href="{{ route('admin.albums.show', $album->id) }}" class="btn-action btn-detail">
                                <i class="fa-solid fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn-action btn-edit">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form class="delete-form" action="{{ route('admin.albums.destroy', $album->id) }}" method="POST" style="display:inline-flex;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-action btn-delete delete-trigger">
                                    <i class="fa-solid fa-trash-can"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted)">
                        Belum ada riwayat data yang ditambahkan.
                    </td>
                </tr>
            @endforelse
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
        const tableElement = $('#albumsDataTable');
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
                order: []
            });
        }

        // ========================================================
        // DELETE MODAL ACTIONS
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
