@extends('admin.layout.index')

@section('page_title', 'Kelola Akun Admin')

@section('content')
<style>
    .admin-card { 
        width: 100%; 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 12px; 
        padding: 24px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.01); 
    }
    .table-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px; 
    }
    .btn-add { 
        background: #0a4174; 
        color: #fff; 
        padding: 10px 16px; 
        border-radius: 8px; 
        text-decoration: none; 
        font-size: 13px; 
        font-weight: 600; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
    }
    .btn-add:hover {
        opacity: 0.9;
    }
    .data-table { 
        width: 100%; 
        border-collapse: collapse; 
        text-align: left; 
        font-size: 13px; 
    }
    .data-table th { 
        background: #f4f8fb; 
        padding: 14px 16px; 
        color: #0a4174; 
        font-weight: 700; 
        border-bottom: 2px solid #d0e1f0; 
        text-transform: uppercase; 
        font-size: 11px; 
    }
    .data-table td { 
        padding: 14px 16px; 
        border-bottom: 1px solid #d0e1f0; 
        color: #0a4174; 
    }
    .role-badge { 
        background-color: rgba(123, 189, 232, 0.25); 
        color: #0a4174; 
        padding: 4px 8px; 
        border-radius: 4px; 
        font-weight: bold; 
        font-size: 11px; 
        text-transform: uppercase; 
    }
    .alert-success { 
        padding: 12px 16px; 
        border-radius: 8px; 
        background-color: rgba(34, 197, 94, 0.15); 
        border: 1px solid #22c55e; 
        color: #166534; 
        font-size: 13px; 
        font-weight: 600; 
        margin-bottom: 20px; 
    }
    .alert-error { 
        padding: 12px 16px; 
        border-radius: 8px; 
        background-color: rgba(239, 68, 68, 0.15); 
        border: 1px solid #ef4444; 
        color: #991b1b; 
        font-size: 13px; 
        font-weight: 600; 
        margin-bottom: 20px; 
    }
    .btn-action { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
        width: 32px; 
        height: 32px; 
        border-radius: 6px; 
        border: none; 
        cursor: pointer; 
        color: white; 
        text-decoration: none;
        margin-right: 4px;
    }
    .btn-edit { background: #eab308; }
    .btn-edit:hover { background: #ca8a04; }
    .btn-delete { background: #ef4444; }
    .btn-delete:hover { background: #dc2626; }
</style>

@if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert-error">
        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
    </div>
@endif

<div class="admin-card">
    <div class="table-header">
        <div>
            <h2 style="font-size: 18px; font-weight: 700; color: #0a4174;">Daftar Petugas Pengelola (Admin)</h2>
            <p style="font-size: 12px; color: #527597">Daftar akun pengelola yang memiliki hak akses kontrol penuh terhadap sistem.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <form method="GET" action="{{ route('admin.admins.index') }}">
                <label for="admin-status-filter" style="font-size: 12px; color: #527597; margin-right: 6px;">Filter Status</label>
                <select id="admin-status-filter" name="status" onchange="this.form.submit()" style="padding: 9px 10px; border: 1px solid #d0e1f0; border-radius: 8px; color: #0a4174; background: #fff;">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </form>
            <a href="{{ route('admin.admins.create') }}" class="btn-add">
                <i class="fa-solid fa-user-plus"></i> Tambah Admin Baru
            </a>
        </div>
    </div>

    <div style="width: 100%; overflow-x: auto; border: 1px solid #d0e1f0; border-radius: 8px;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Pengelola</th>
                    <th>Email</th>
                    <th>No. Telepon / WA</th>
                    <th>Tingkat Otoritas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td><strong>{{ $admin->name }}</strong></td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone ?? '-' }}</td>
                    <td><span class="role-badge">{{ str_replace('_', ' ', $admin->role) }}</span></td>
                    <td>
                        <select class="status-dropdown" data-id="{{ $admin->id }}" style="padding: 6px 10px; border-radius: 6px; border: 1px solid #d0e1f0; background: {{ $admin->is_active ? '#ecfdf5' : '#fef2f2' }}; color: {{ $admin->is_active ? '#047857' : '#b91c1c' }}; font-weight: 600; outline: none; cursor: pointer;">
                            <option value="1" {{ $admin->is_active ? 'selected' : '' }}>● Aktif</option>
                            <option value="0" {{ !$admin->is_active ? 'selected' : '' }}>● Tidak Aktif</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn-action btn-edit" title="Edit Admin">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin ini? Aksi ini tidak dapat dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" title="Hapus Admin">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('.status-dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', function(e) {
                // Determine original value to revert if it fails (not from event to avoid infinite loop)
                const isReverting = e.detail === 'revert';
                if (isReverting) {
                    // Just update colors
                    if (this.value === '1') {
                        this.style.background = '#ecfdf5';
                        this.style.color = '#047857';
                    } else {
                        this.style.background = '#fef2f2';
                        this.style.color = '#b91c1c';
                    }
                    return;
                }

                const adminId = this.getAttribute('data-id');
                const newStatus = this.value;
                const originalValue = newStatus === '1' ? '0' : '1';
                
                // Update colors immediately for good UX
                if (newStatus === '1') {
                    this.style.background = '#ecfdf5';
                    this.style.color = '#047857';
                } else {
                    this.style.background = '#fef2f2';
                    this.style.color = '#b91c1c';
                }

                fetch(`/admin/manage-admins/${adminId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ is_active: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.message || 'Gagal mengubah status.');
                        // Revert visual
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
