@extends('admin.layout.index')

@section('page_title')
    {{ $table_key === 'alumnis' ? 'Data Alumni' : $mapping['title'] }}
@endsection

@section('content')
<style>
    .crud-card-full { width: 100%; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .btn-add { background: var(--color-primary); color: #fff; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; border: 1px solid var(--border-dark); }
    .table-responsive { width: 100%; overflow-x: auto; border: 1px solid var(--border-color); border-radius: 8px; }
    
    /* Style Tabel Melebar Penuh */
    .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 13px; }
    .data-table th { background: var(--bg-main); padding: 14px 16px; color: var(--text-main); font-weight: 700; border-bottom: 2px solid var(--border-color); text-transform: uppercase; font-size: 11px; }
    .data-table td { padding: 14px 16px; border-bottom: 1px solid var(--border-color); color: var(--text-main); max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle; }
    
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
    .preview-img-mini { width: 44px; height: 44px; border-radius: 6px; object-fit: cover; border: 1px solid var(--border-color); }
</style>

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
        <a href="{{ route('admin.table.create', $table_key) }}" class="btn-add">
            <i class="fa-solid fa-plus"></i> Tambah Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <!-- Kepala Kolom Nomor Urut -->
                    <th class="col-number-header">No</th>
                    @foreach($mapping['list_columns'] as $col)
                        <th>{{ $mapping['fields'][$col]['label'] ?? ucwords(str_replace('_', ' ', $col)) }}</th>
                    @endforeach
                    <th style="text-align: center; width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($rows->count() > 0)
                    @foreach($rows as $row)
                        @php
                            $rowNumber = ($loop->index + 1) + ($rows->perPage() * ($rows->currentPage() - 1));
                        @endphp
                        <tr class="data-row">
                            <td class="col-number-data">{{ $rowNumber }}</td>
                            @foreach($mapping['list_columns'] as $col)
                                <td>
                                    @if(in_array($col, ['avatar', 'thumbnail', 'photo_path', 'cover_photo']))
                                        @if(!empty($row->$col))
                                            <img src="{{ asset($row->$col) }}" class="preview-img-mini" alt="Foto">
                                        @else
                                            <span style="color: var(--text-muted); font-style: italic;">Tidak ada foto</span>
                                        @endif
                                    @elseif($col === 'study_status')
                                        <span style="background-color: {{ $row->$col === 'Aktif' ? '#d1fae5' : '#fee2e2' }}; color: {{ $row->$col === 'Aktif' ? '#065f46' : '#991b1b' }}; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 11px;">
                                            {{ $row->$col === 'Aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    @elseif(isset($mapping['fields'][$col]['type']) && $mapping['fields'][$col]['type'] === 'toggle')
                                        <span style="background-color: {{ $row->$col ? '#d1fae5' : '#fee2e2' }}; color: {{ $row->$col ? '#065f46' : '#991b1b' }}; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 11px;">
                                            {{ $mapping['fields'][$col]['options'][$row->$col] ?? ($row->$col ? 'Buka' : 'Tutup') }}
                                        </span>
                                    @else
                                        {{ strip_tags($row->$col) ?? '-' }}
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

    <div class="pagination-wrapper">
        <div>Menampilkan {{ $rows->count() }} data di halaman ini.</div>

        @if ($rows->hasPages())
            <nav class="pagination" aria-label="Pagination">
                @if ($rows->onFirstPage())
                    <span class="page-item disabled" aria-disabled="true">Previous</span>
                @else
                    <a class="page-item" href="{{ $rows->previousPageUrl() }}" rel="prev">Previous</a>
                @endif

                @foreach ($rows->getUrlRange(max(1, $rows->currentPage() - 1), min($rows->lastPage(), $rows->currentPage() + 1)) as $page => $url)
                    @if ($page == $rows->currentPage())
                        <span class="page-item active" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="page-item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($rows->hasMorePages())
                    <a class="page-item" href="{{ $rows->nextPageUrl() }}" rel="next">Next</a>
                @else
                    <span class="page-item disabled" aria-disabled="true">Next</span>
                @endif
            </nav>
        @endif
    </div>
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
    document.addEventListener('DOMContentLoaded', function () {
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

        document.querySelectorAll('.delete-trigger').forEach(function (button) {
            button.addEventListener('click', function () {
                activeForm = this.closest('.delete-form');
                openModal();
            });
        });

        cancelBtn.addEventListener('click', function () {
            activeForm = null;
            closeModal();
        });

        backdrop.addEventListener('click', function (event) {
            if (event.target === backdrop) {
                activeForm = null;
                closeModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !backdrop.hidden) {
                activeForm = null;
                closeModal();
            }
        });

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
    });
</script>
@endsection
