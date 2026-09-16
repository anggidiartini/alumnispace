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
</style>

@if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <div class="table-header">
        <div>
            <h2 style="font-size: 18px; font-weight: 700; color: #0a4174;">Daftar Petugas Pengelola (Admin)</h2>
            <p style="font-size: 12px; color: #527597">Daftar akun pengelola yang memiliki hak akses kontrol penuh terhadap sistem.</p>
        </div>
        <a href="{{ route('admin.admins.create') }}" class="btn-add">
            <i class="fa-solid fa-user-plus"></i> Tambah Admin Baru
        </a>
    </div>

    <div style="width: 100%; overflow-x: auto; border: 1px solid #d0e1f0; border-radius: 8px;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Pengelola</th>
                    <th>Alamat Email</th>
                    <th>No. Telepon / WA</th>
                    <th>Tingkat Otoritas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td><strong>{{ $admin->name }}</strong></td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone ?? '-' }}</td>
                    <td><span class="role-badge">{{ str_replace('_', ' ', $admin->role) }}</span></td>
                    <td><span style="color: #10b981; font-weight: bold;">● Aktif</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
