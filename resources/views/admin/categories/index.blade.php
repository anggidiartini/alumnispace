@extends('admin.layout.index')

@section('page_title', 'Kelola ' . $title)

@section('content')
<style>
    .crud-card-full {
        width: 100%;
        background: #ffffff;
        border: 1px solid #d0e1f0;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
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
        color: #0a4174;
        margin: 0 0 4px 0;
    }
    .table-header p {
        font-size: 12px;
        color: #64748b;
        margin: 0;
    }
    
    /* Form Styling */
    .form-label-custom {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 6px;
        display: block;
    }
    .form-control-custom {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #d0e1f0;
        border-radius: 8px;
        font-size: 13px;
        outline: none;
        transition: all 0.2s;
    }
    .form-control-custom:focus {
        border-color: #0a4174;
        box-shadow: 0 0 0 3px rgba(10, 65, 116, 0.1);
    }
    .btn-save-custom {
        background: #0a4174;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        width: 100%;
        transition: background 0.15s;
    }
    .btn-save-custom:hover {
        background: #08335c;
    }

    /* Toolbar Filter & Search */
    .table-filter-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }
    .filter-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .filter-select {
        padding: 8px 30px 8px 12px;
        border: 1.5px solid #d0e1f0;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #0a4174;
        background: #fff url('data:image/svg+xml,%3Csvg xmlns=\'http://w3.org\' width=\'12\' height=\'12\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230a4174\' stroke-width=\'2.5\'%3E%3Cpath d=\'m6 9 6 6 6-6\'/%3E%3C/svg%3E') no-repeat right 10px center;
        background-size: 12px;
        appearance: none;
        outline: none;
        cursor: pointer;
    }
    .search-box-custom {
        position: relative;
        min-width: 240px;
    }
    .search-box-custom i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
    }
    .search-input-custom {
        width: 100%;
        padding: 8px 14px 8px 34px;
        border: 1.5px solid #d0e1f0;
        border-radius: 8px;
        font-size: 13px;
        outline: none;
        transition: all 0.2s;
    }
    .search-input-custom:focus {
        border-color: #0a4174;
        box-shadow: 0 0 0 3px rgba(10, 65, 116, 0.1);
    }

    /* Table Base */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .data-table th {
        background: #f8fafc;
        padding: 14px 16px;
        color: #1e293b;
        font-weight: 700;
        border-bottom: 2px solid #d0e1f0;
        text-transform: uppercase;
        font-size: 11px;
    }
    .data-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
        color: #1e293b;
        vertical-align: middle;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-active {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    .status-inactive {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Tombol Aksi */
    .btn-action-text {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
        border: 1.5px solid transparent;
        font-family: inherit;
        text-decoration: none;
    }
    .btn-action-text:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.10);
    }
    .btn-detail-style {
        background: rgba(16, 185, 129, 0.08);
        color: #059669;
        border-color: rgba(16, 185, 129, 0.5);
    }
    .btn-detail-style:hover {
        background: #059669;
        color: #ffffff;
        border-color: #059669;
    }
    .btn-edit-style {
        background: rgba(59, 130, 246, 0.08);
        color: #2563eb;
        border-color: rgba(59, 130, 246, 0.5);
    }
    .btn-edit-style:hover {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
    }

    /* Toast */
    .alert-success-toast {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 99999;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 260px;
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
    .alert-success-toast.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

@if (session('success'))
    <div id="successToastCategory" class="alert-success-toast" role="status" aria-live="polite">
        <span style="background: rgba(34, 197, 94, 0.15); width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #15803d;"><i class="fa-solid fa-circle-check"></i></span>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="crud-card-full">
    <div class="table-header">
        <div>
            <h2>Kelola {{ $title }}</h2>
            <p>Gunakan halaman ini untuk memantau atau menambahkan susunan berkas kategori website.</p>
        </div>
    </div>

    <div style="display: flex; gap: 24px; flex-wrap: wrap; margin-top: 10px;">
        <!-- 1. FORM TAMBAH DATA KATEGORI -->
        <div style="flex: 1; min-width: 300px; max-width: 360px;">
            <div style="border: 1px solid #d0e1f0; border-radius: 10px; padding: 20px; background: #ffffff;">
                <h4 style="font-size: 14px; font-weight: 700; color: #0a4174; margin: 0 0 16px 0;"><i class="fa-solid fa-plus me-2"></i>Tambah Kategori</h4>
                
                <form action="{{ route('admin.categories.store', ['type' => $type]) }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 14px;">
                        <label for="name" class="form-label-custom">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control-custom" placeholder="Masukkan nama kategori..." value="{{ old('name') }}" required>
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label for="description" class="form-label-custom">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" class="form-control-custom" placeholder="Deskripsi singkat... (opsional)">{{ old('description') }}</textarea>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="status" class="form-label-custom">Status</label>
                        <select name="status" id="status" class="form-control-custom" style="cursor: pointer; appearance: none; background: #fff url('data:image/svg+xml,%3Csvg xmlns=\'http://w3.org\' width=\'12\' height=\'12\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%230a4174\' stroke-width=\'2.5\'%3E%3Cpath d=\'m6 9 6 6 6-6\'/%3E%3C/svg%3E\') no-repeat right 12px center; background-size: 12px;">
                            <option value="active">● Aktif</option>
                            <option value="inactive">● Tidak Aktif</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-save-custom">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Kategori
                    </button>
                </form>
            </div>
        </div>

        <!-- 2. TABEL DAFTAR KATEGORI -->
        <div style="flex: 2; min-width: 500px;">
            <!-- TOOLBAR FILTER & SEARCH -->
            <div class="table-filter-toolbar">
                <div class="filter-group">
                    <label style="font-size: 13px; font-weight: 600; color: #64748b;">Filter Status:</label>
                    <select id="filterStatusSelect" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="Aktif">● Aktif</option>
                        <option value="Tidak Aktif">● Tidak Aktif</option>
                    </select>
                </div>
                <div class="search-box-custom">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="customSearchInput" class="search-input-custom" placeholder="Cari nama atau deskripsi kategori...">
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table id="categoryTableCustom" class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">NO</th>
                            <th style="text-align: left;">Nama Kategori</th>
                            <th style="text-align: left;">Deskripsi</th>
                            <th style="text-align: center; width: 120px;">Status</th>
                            <th style="text-align: center; width: 130px;">Tanggal Dibuat</th>
                            <th style="text-align: center; width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr class="category-row">
                                <td style="text-align: center; font-weight: 700; color: #64748b; background-color: rgba(244, 248, 251, 0.5);">{{ $loop->iteration }}</td>
                                <td class="category-name-cell" style="font-weight: 600; text-align: left; color: #0a4174;">{{ $category->name }}</td>
                                <td class="category-desc-cell" style="text-align: left; max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #64748b;">{{ $category->description ?? '-' }}</td>
                                <td class="category-status-cell" style="text-align: center;">
                                    @if($category->status)
                                        <span class="status-badge status-active">● Aktif</span>
                                    @else
                                        <span class="status-badge status-inactive">● Tidak Aktif</span>
                                    @endif
                                </td>
                                <td style="text-align: center; color: #64748b; font-size: 12px;">{{ $category->created_at->format('d M Y') }}</td>
                                <td style="text-align: center;">
                                    <div style="display: inline-flex; gap: 6px; justify-content: center;">
                                        {{-- 1. Tombol Detail --}}
                                        <button type="button" class="btn-action-text btn-detail-style btn-detail-category"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description ?? '-' }}"
                                            data-status-val="{{ $category->status ? '1' : '0' }}"
                                            data-created="{{ $category->created_at->format('d M Y, H:i') }}"
                                            data-updated="{{ $category->updated_at->format('d M Y, H:i') }}">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </button>

                                        {{-- 2. Tombol Edit --}}
                                        <button type="button" class="btn-action-text btn-edit-style btn-edit-category" 
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description ?? '' }}"
                                            data-status="{{ $category->status ? 'active' : 'inactive' }}">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyTableRow">
                                <td colspan="6" style="text-align: center; padding: 24px; color: #94a3b8;">Belum ada riwayat data kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 1. MODAL DETAIL KATEGORI -->
<div id="detailCategoryModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 99999; align-items: center; justify-content: center;">
    <div style="background: #ffffff; border-radius: 14px; max-width: 440px; width: 90%; padding: 24px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
            <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #0a4174;">
                <i class="fa-solid fa-circle-info me-2"></i>Detail {{ $title }}
            </h3>
            <button type="button" id="closeDetailModal" style="background: none; border: none; font-size: 20px; color: #94a3b8; cursor: pointer;">&times;</button>
        </div>

        <div style="display: flex; flex-direction: column; gap: 14px; font-size: 13px;">
            <div>
                <span style="font-weight: 600; color: #64748b; display: block; margin-bottom: 2px;">Nama Kategori</span>
                <span id="detail_name" style="font-weight: 700; color: #1e293b; font-size: 15px;"></span>
            </div>

            <div>
                <span style="font-weight: 600; color: #64748b; display: block; margin-bottom: 4px;">Status</span>
                <span id="detail_status_badge" class="status-badge"></span>
            </div>

            <div>
                <span style="font-weight: 600; color: #64748b; display: block; margin-bottom: 2px;">Deskripsi</span>
                <p id="detail_description" style="margin: 0; color: #334155; background: #f8fafc; padding: 10px 12px; border-radius: 8px; border: 1px solid #d0e1f0; white-space: pre-line; line-height: 1.5;"></p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; border-top: 1px solid #f1f5f9; padding-top: 10px; font-size: 11px; color: #64748b;">
                <div>
                    <strong>Dibuat:</strong><br><span id="detail_created"></span>
                </div>
                <div>
                    <strong>Diperbarui:</strong><br><span id="detail_updated"></span>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px; text-align: right;">
            <button type="button" id="closeDetailBtn" style="padding: 8px 18px; border: 1px solid #cbd5e1; background: #f8fafc; color: #475569; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer;">Tutup</button>
        </div>
    </div>
</div>

<!-- 2. MODAL EDIT KATEGORI -->
<div id="editCategoryModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 99999; align-items: center; justify-content: center;">
    <div style="background: #ffffff; border-radius: 14px; max-width: 440px; width: 90%; padding: 24px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
            <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #0a4174;">
                <i class="fa-solid fa-pen-to-square me-2"></i>Edit {{ $title }}
            </h3>
            <button type="button" id="closeEditModal" style="background: none; border: none; font-size: 20px; color: #94a3b8; cursor: pointer;">&times;</button>
        </div>

        <form id="editCategoryForm" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 14px;">
                <label for="edit_name" class="form-label-custom">Nama Kategori</label>
                <input type="text" name="name" id="edit_name" class="form-control-custom" placeholder="Nama kategori..." required>
            </div>

            <div style="margin-bottom: 14px;">
                <label for="edit_description" class="form-label-custom">Deskripsi</label>
                <textarea name="description" id="edit_description" rows="3" class="form-control-custom" placeholder="Deskripsi..."></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="edit_status" class="form-label-custom">Status</label>
                <select name="status" id="edit_status" class="form-control-custom" style="cursor: pointer;">
                    <option value="active">● Aktif</option>
                    <option value="inactive">● Tidak Aktif</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <button type="button" id="cancelEditModal" style="padding: 10px 16px; border: 1px solid #cbd5e1; background: #fff; color: #64748b; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" class="btn-save-custom" style="width: auto; padding: 10px 20px;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Toast Notification Auto-hide
        const toast = document.getElementById('successToastCategory');
        if (toast) {
            requestAnimationFrame(() => toast.classList.add('is-visible'));
            setTimeout(() => {
                toast.classList.remove('is-visible');
                setTimeout(() => toast.remove(), 220);
            }, 2800);
        }

        // 2. Filter & Live Search (Vanilla JS)
        const searchInput = document.getElementById('customSearchInput');
        const filterSelect = document.getElementById('filterStatusSelect');
        const rows = document.querySelectorAll('#categoryTableCustom tbody tr.category-row');

        function filterCategories() {
            const searchVal = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const filterVal = filterSelect ? filterSelect.value.trim() : '';

            rows.forEach(row => {
                const nameText = row.querySelector('.category-name-cell')?.textContent.toLowerCase() || '';
                const descText = row.querySelector('.category-desc-cell')?.textContent.toLowerCase() || '';
                const statusText = row.querySelector('.category-status-cell')?.textContent.trim() || '';

                const matchSearch = nameText.includes(searchVal) || descText.includes(searchVal);
                const matchFilter = !filterVal || statusText.includes(filterVal);

                if (matchSearch && matchFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput?.addEventListener('input', filterCategories);
        filterSelect?.addEventListener('change', filterCategories);

        // 3. Modal Detail
        document.querySelectorAll('.btn-detail-category').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('detail_name').textContent = this.dataset.name || '-';
                document.getElementById('detail_description').textContent = this.dataset.description || '-';
                document.getElementById('detail_created').textContent = this.dataset.created || '-';
                document.getElementById('detail_updated').textContent = this.dataset.updated || '-';

                const isAktif = this.dataset.statusVal === '1';
                const badge = document.getElementById('detail_status_badge');
                badge.textContent = isAktif ? '● Aktif' : '● Tidak Aktif';
                badge.className = 'status-badge ' + (isAktif ? 'status-active' : 'status-inactive');

                document.getElementById('detailCategoryModal').style.display = 'flex';
            });
        });

        // 4. Modal Edit
        document.querySelectorAll('.btn-edit-category').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const name = this.dataset.name || '';
                const description = this.dataset.description || '';
                const status = this.dataset.status || 'active';

                const form = document.getElementById('editCategoryForm');
                form.action = `{{ url('admin/categories/' . $type) }}/${id}`;

                document.getElementById('edit_name').value = name;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_status').value = status;

                document.getElementById('editCategoryModal').style.display = 'flex';
            });
        });

        // 5. Tutup Modal
        const closeAllModals = () => {
            document.getElementById('detailCategoryModal').style.display = 'none';
            document.getElementById('editCategoryModal').style.display = 'none';
        };

        document.getElementById('closeDetailModal')?.addEventListener('click', closeAllModals);
        document.getElementById('closeDetailBtn')?.addEventListener('click', closeAllModals);
        document.getElementById('closeEditModal')?.addEventListener('click', closeAllModals);
        document.getElementById('cancelEditModal')?.addEventListener('click', closeAllModals);

        window.addEventListener('click', function(e) {
            if (e.target.id === 'detailCategoryModal' || e.target.id === 'editCategoryModal') {
                closeAllModals();
            }
        });
    });
</script>
@endsection
