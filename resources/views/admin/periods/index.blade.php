@extends('admin.layout.index')

@section('page_title', 'Periode Kepengurusan')

@section('content')

<style>
    .period-card { width: 100%; background: #fff; border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,.02); }
    .period-header { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 20px; flex-wrap: wrap; }
    .period-header h2 { color: var(--text-main); font-size: 18px; font-weight: 700; }
    .period-header p { margin-top: 5px; color: var(--text-muted); font-size: 12px; }
    .period-button-primary, .period-button-secondary { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 15px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; cursor: pointer; transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease; }
    .period-button-primary { border: 1px solid var(--border-dark); background: var(--color-primary); color: #fff; box-shadow: 0 4px 8px rgba(10, 65, 116, .15); }
    .period-button-secondary { border: 1px solid var(--border-color); background: #fff; color: var(--color-primary); }
    .period-button-primary:hover, .period-button-secondary:hover { transform: translateY(-1px); box-shadow: 0 6px 12px rgba(10, 65, 116, .16); }
    /* GANTI DUA KELAS CSS INI */
.period-table-wrap { 
    overflow-x: auto; 
    width: 100%; 
    margin-bottom: 0; 
}
.period-table { 
    width: 100%; 
    border-collapse: collapse; 
    color: var(--text-main); 
    font-size: 13px; 
    border: 1px solid var(--border-color); 
    border-radius: 10px; 
    overflow: hidden; 
}

     .period-table th { padding: 13px 15px; background: var(--bg-main); border-bottom: 2px solid var(--border-color); text-align: left; font-size: 11px; text-transform: uppercase; }
    .period-table td { padding: 14px 15px; border-bottom: 1px solid var(--border-color); }
    .period-table tr:last-child td { border-bottom: 0; }
    .period-alert { margin-bottom: 18px; padding: 12px 15px; border: 1px solid #86efac; border-radius: 8px; background: #ecfdf5; color: #166534; font-size: 13px; font-weight: 600; }
    .period-actions { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .period-status { display: inline-flex; align-items: center; gap: 5px; padding: 5px 9px; border-radius: 999px; font-size: 11px; font-weight: 700; }
    .period-status-active { background: #d1fae5; border: 1px solid #a7f3d0; color: #047857; }
    .period-status-inactive { background: #f1f5f9; border: 1px solid #cbd5e1; color: #64748b; }
     .period-button { display: inline-flex; align-items: center; gap: 5px; padding: 7px 12px; border: 1.5px solid transparent; border-radius: 8px; cursor: pointer; font: inherit; font-size: 12px; font-weight: 700; text-decoration: none; transition: all 0.15s ease; }
    .period-button:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.10); }
    .period-detail { background: rgba(16, 185, 129, 0.08); color: #059669; border-color: rgba(16, 185, 129, 0.5); }
    .period-detail:hover { background: #059669; color: #fff; border-color: #059669; }
    .period-edit { background: rgba(59, 130, 246, 0.08); color: #2563eb; border-color: rgba(59, 130, 246, 0.5); }
    .period-edit:hover { background: #2563eb; color: #fff; border-color: #2563eb; }
    .period-delete { background: rgba(239, 68, 68, 0.08); color: #b91c1c; border-color: rgba(239, 68, 68, 0.5); }
    .period-delete:hover { background: #ef4444; color: #fff; border-color: #ef4444; }
    .status-filter-wrap { position: relative; display: inline-flex; margin-left: 6px; }
    .status-filter-button { display: inline-flex; align-items: center; justify-content: center; min-width: 26px; height: 24px; padding: 0 6px; border: 1.5px solid var(--border-color); border-radius: 6px; background: #fff; color: var(--color-primary); cursor: pointer; }
    .status-filter-button:hover, .status-filter-button.is-active { background: var(--color-primary); color: #fff; border-color: var(--color-primary); }
    .status-filter-menu { position: fixed; z-index: 99999; display: none; width: 230px; padding: 10px 8px; border: 1px solid rgba(15, 23, 42, .12); border-radius: 12px; background: #fff; box-shadow: 0 14px 34px rgba(10, 65, 116, .18); text-align: left; }
    .status-filter-menu.show { display: block; }
    .status-filter-section { padding: 2px 4px; }
    .status-filter-title { display: flex; align-items: center; gap: 6px; padding: 4px 6px 6px; color: var(--color-primary); font-size: 11px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
    .status-filter-title button { margin-left: auto; border: 0; background: transparent; color: var(--text-muted); cursor: pointer; font: inherit; font-size: 11px; }
    .status-filter-option { display: flex; align-items: center; gap: 10px; width: 100%; padding: 7px 8px; border: 0; border-radius: 7px; background: transparent; color: var(--text-main); font: inherit; font-size: 12px; font-weight: 600; cursor: pointer; text-align: left; }
    .status-filter-option:hover { background: rgba(10, 65, 116, .08); }
    .status-filter-check { accent-color: var(--color-primary); width: 15px; height: 15px; }
    .status-filter-divider { height: 1px; margin: 8px 4px; background: var(--border-color); }
    .period-empty { padding: 38px 15px !important; color: var(--text-muted) !important; text-align: center !important; }

    /* ==================== PENYESUAIAN HEADER STRUKTUR UTK HALAMAN INDEX ==================== */
    .dataTables_wrapper .dt-custom-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 16px; flex-wrap: wrap; width: 100%; }
    .dataTables_wrapper .dataTables_length { font-size: 13px; color: #64748b; }
     .dataTables_wrapper .dataTables_length select { padding: 6px 32px 6px 12px !important; border: 1px solid var(--border-color) !important; border-radius: 6px !important; background: #fff url("data:image/svg+xml,%3csvg xmlns='http://w3.org' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") no-repeat right 8px center/16px 16px !important; outline: none; margin: 0 8px !important; color: var(--text-main); font-weight: 600; cursor: pointer; appearance: none; -webkit-appearance: none; }
    
    .dataTables_wrapper .custom-search-wrapper { position: relative; display: inline-flex; align-items: center; }
    .dataTables_wrapper .custom-search-wrapper input[type="search"] { padding: 8px 12px 8px 36px !important; border: 1px solid var(--border-color) !important; border-radius: 8px !important; background-color: #fff !important; font-size: 13px !important; width: 210px !important; outline: none; color: var(--text-main); transition: border-color 0.15s ease, box-shadow 0.15s ease; box-sizing: border-box; }
    .dataTables_wrapper .custom-search-wrapper input[type="search"]::placeholder { color: #a0aec0; }
    .dataTables_wrapper .custom-search-wrapper input[type="search"]:focus { border-color: var(--color-primary) !important; box-shadow: 0 0 0 3px rgba(10, 65, 116, 0.06); }
    .dataTables_wrapper .custom-search-wrapper .search-icon { position: absolute; left: 14px; color: #a0aec0; font-size: 12px; pointer-events: none; z-index: 10; }
    
    .dataTables_wrapper table.dataTable.no-footer { border-bottom: none !important; }
    .dataTables_wrapper table.dataTable { border-collapse: collapse !important; }
    .dataTables_wrapper .dt-bottom-bar { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 13px; color: var(--text-muted); flex-wrap: wrap; gap: 12px; width: 100%; }
    .dataTables_wrapper .dataTables_info { padding-top: 0 !important; }
    .dataTables_wrapper .dataTables_paginate { padding-top: 0 !important; }
        /* ==================== KUSTOMISASI WARNA TOMBOL ANGKA HALAMAN ==================== */
    /* Kotak angka yang sedang aktif/dipilih */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: var(--color-primary) !important;
        color: #fff !important;
        border: 1px solid var(--color-primary) !important;
        border-radius: 6px !important;
        padding: 4px 10px !important;
        font-weight: 700 !important;
    }

    /* Kotak angka lain saat diarahkan kursor (hover) */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: rgba(10, 65, 116, 0.08) !important;
        color: var(--color-primary) !important;
        border: 1px solid transparent !important;
        border-radius: 6px !important;
        padding: 4px 10px !important;
    }

    /* Tombol Sebelumnya & Berikutnya saat diarahkan kursor */
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover {
        background: transparent !important;
        color: var(--color-primary) !important;
        border: 1px solid transparent !important;
    }

</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<div class="period-card">
    @if (session('success'))
        <div class="period-alert"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
    @endif

    <div class="period-header">
        <div>
            <h2>Periode Kepengurusan</h2>
            <p>Tambahkan dan lihat periode yang bisa dipilih saat mengisi data Pengurus Alumni.</p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('admin.alumni-boards.index', 'alumni_boards') }}" class="period-button-secondary">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Pengurus Alumni
            </a>
            <a href="{{ route('admin.committee-periods.create') }}" class="period-button-primary">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <!-- Pembungkus tabel diisolasi hanya untuk tabel saja -->
    <div class="period-table-wrap">
        <table id="periodsDataTable" class="period-table display">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama Periode</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>
                        Status
                        <span class="status-filter-wrap">
                            <button type="button" class="status-filter-button" id="period-status-filter-button" title="Urutkan dan filter status" aria-label="Urutkan dan filter status">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" aria-hidden="true">
                                    <line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                            </button>
                            <div class="status-filter-menu" id="period-status-filter-menu">
                                <div class="status-filter-section">
                                    <div class="status-filter-title"><i class="fa-solid fa-arrow-down-up-across-line"></i> Urutan Kolom</div>
                                    <button type="button" class="status-filter-option" data-period-order="asc">↑ &nbsp; Ascending (A-Z / Terkecil)</button>
                                    <button type="button" class="status-filter-option" data-period-order="desc">↓ &nbsp; Descending (Z-A / Terbesar)</button>
                                </div>
                                <div class="status-filter-divider"></div>
                                <div class="status-filter-section">
                                    <div class="status-filter-title"><i class="fa-solid fa-filter"></i> Filter Status <button type="button" class="period-status-reset">Reset</button></div>
                                    <label class="status-filter-option"><input type="checkbox" class="status-filter-check period-status-all" checked> Pilih Semua</label>
                                    <label class="status-filter-option"><input type="checkbox" class="status-filter-check period-status-value" value="Aktif" checked> Aktif</label>
                                    <label class="status-filter-option"><input type="checkbox" class="status-filter-check period-status-value" value="Tidak Aktif" checked> Tidak Aktif</label>
                                </div>
                            </div>
                        </span>
                    </th>
                    <th style="width: 250px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($periods as $period)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $period->period_name }}</strong></td>
                        <td>{{ $period->start_date ? \Carbon\Carbon::parse($period->start_date)->locale('id')->translatedFormat('d F Y') : '-' }}</td>
                        <td>{{ $period->finish_date ? \Carbon\Carbon::parse($period->finish_date)->locale('id')->translatedFormat('d F Y') : 'Masih Berjalan' }}</td>
                        <td>
                            @if($period->is_active)
                                <span class="period-status period-status-active"><i class="fa-solid fa-circle-check"></i> Aktif</span>
                            @else
                                <span class="period-status period-status-inactive"><i class="fa-solid fa-circle-minus"></i> Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="period-actions">
                                <a href="{{ route('admin.committee-periods.show', $period->id) }}" class="period-button period-detail" title="Lihat detail periode">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.committee-periods.edit', $period->id) }}" class="period-button period-edit" title="Edit periode">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.committee-periods.destroy', $period->id) }}" onsubmit="return confirm('Hapus periode ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="period-button period-delete" title="Hapus periode"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="period-empty">Belum ada periode kepengurusan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div> <!-- Batas penutup div wrapper tabel -->
</div> <!-- Batas penutup div .period-card utama halaman -->

<script>
    $(function () {
        const tableElement = $('#periodsDataTable');
        if (!tableElement.length || !tableElement.find('tbody tr').length) return;

        const table = tableElement.DataTable({
            dom: '<"dt-custom-header"lf>rt<"dt-bottom-bar"ip>',
            pageLength: 10,
            ordering: true,
            language: {
                search: '',
                searchPlaceholder: 'Cari data...',
                lengthMenu: 'Tampilkan _MENU_ data',
                zeroRecords: 'Data tidak ditemukan',
                info: 'Menampilkan _TOTAL_ data di halaman ini',
                paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
            },
            columnDefs: [{ targets: [0, -1], orderable: false, searchable: false }]
        });

        // Pasang class custom dan icon kaca pembesar
        const searchContainer = $('.dataTables_filter');
        searchContainer.addClass('custom-search-wrapper');
        searchContainer.prepend('<i class="fa-solid fa-magnifying-glass search-icon"></i>');

        // --- FILTER STATUS DROPDOWN (BAWAAN PERIODE) ---
        const statusColumn = table.column(4);
        const button = $('#period-status-filter-button');
        const menu = $('#period-status-filter-menu');

        button.on('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            const rect = button[0].getBoundingClientRect();
            menu.css({ top: rect.bottom + 6, left: Math.max(12, rect.left - 190) }).toggleClass('show');
        });
        menu.on('click', function (event) { event.stopPropagation(); });
        $(document).on('click', function () { menu.removeClass('show'); });

        menu.on('click', '[data-period-order]', function () {
            statusColumn.order($(this).data('period-order')).draw();
            menu.removeClass('show');
        });

        const applyStatusFilter = function () {
            const selected = menu.find('.period-status-value:checked').map(function () {
                return $.fn.dataTable.util.escapeRegex(this.value);
            }).get();
            const regex = selected.length
                ? '(' + selected.map(function (value) { return '(?:>\\s*' + value + '\\s*<|^\\s*' + value + '\\s*$)'; }).join('|') + ')'
                : '^$|__NOMATCH__';
            statusColumn.search(regex, true, false).draw();
            button.toggleClass('is-active', selected.length !== 2);
        };

        menu.on('change', '.period-status-all', function () {
            menu.find('.period-status-value').prop('checked', this.checked);
            applyStatusFilter();
        });
        menu.on('change', '.period-status-value', function () {
            const values = menu.find('.period-status-value');
            const checked = menu.find('.period-status-value:checked');
            menu.find('.period-status-all').prop('checked', checked.length === values.length);
            applyStatusFilter();
        });
        menu.on('click', '.period-status-reset', function () {
            menu.find('.period-status-all, .period-status-value').prop('checked', true);
            applyStatusFilter();
        });

        // --- GENERIC STATUS DROPDOWN HANDLER ---
        document.querySelectorAll('.status-dropdown').forEach(dropdown => {
            dropdown.addEventListener('change', function(e) {
                if (e.detail === 'revert') {
                    if (this.value == '1' || this.value === 'Aktif') {
                        this.style.background = '#ecfdf5';
                        this.style.color = '#047857';
                    } else {
                        this.style.background = '#fef2f2';
                        this.style.color = '#b91c1c';
                    }
                    return;
                }

                const id = this.getAttribute('data-id');
                const table = this.getAttribute('data-table');
                const column = this.getAttribute('data-column');
                const newValue = this.value;
                const isNumericToggle = (newValue == '1' || newValue == '0');
                const originalValue = isNumericToggle ? (newValue == '1' ? '0' : '1') : (newValue === 'Aktif' ? 'Tidak Aktif' : 'Aktif');
                
                if (newValue == '1' || newValue === 'Aktif') {
                    this.style.background = '#ecfdf5';
                    this.style.color = '#047857';
                } else {
                    this.style.background = '#fef2f2';
                    this.style.color = '#b91c1c';
                }

                fetch(`{{ route('admin.update-status', [], false) }}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, table: table, column: column, value: newValue })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.message || 'Gagal mengubah status.');
                        this.value = originalValue;
                        this.dispatchEvent(new CustomEvent('change', { detail: 'revert' }));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan jaringan.');
                    this.value = originalValue;
                    this.dispatchEvent(new CustomEvent('change', { detail: 'revert' }));
                });
            });
        });
    });
</script>

@endsection
