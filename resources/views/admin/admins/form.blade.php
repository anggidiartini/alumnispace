@extends('admin.layout.index')

@section('page_title', 'Daftarkan Admin Baru')

@section('content')
<style>
    /* SUSUNAN LAYOUT FORM GRID KANAN KIRI */
    .form-layout-grid { 
        display: grid; 
        grid-template-columns: 1fr 340px; 
        gap: 24px; 
        align-items: start; 
        width: 100%; 
    }
    .form-card-main { 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 16px; 
        padding: 28px; 
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04); 
    }
    .form-card-sidebar { 
        background: #ffffff; 
        border: 1px solid #d0e1f0; 
        border-radius: 16px; 
        padding: 20px; 
        box-shadow: 0 4px 15px rgba(10, 65, 116, 0.04); 
        position: sticky;
        top: 24px;
    }
    .form-header { 
        margin-bottom: 24px; 
        border-bottom: 1px solid #d0e1f0; 
        padding-bottom: 16px; 
    }
    .form-group { 
        display: flex; 
        flex-direction: column; 
        gap: 6px; 
        margin-bottom: 18px; 
    }
    .form-label { 
        font-size: 11px; 
        font-weight: 700; 
        text-transform: uppercase; 
        color: #0a4174; 
        letter-spacing: 0.5px; 
    }
    .form-control { 
        width: 100%; 
        padding: 11px 14px; 
        border: 1px solid #d0e1f0; 
        border-radius: 8px; 
        background: #f4f8fb; 
        color: #0a4174; 
        font-family: inherit; 
        font-size: 14px; 
        outline: none; 
        transition: all 0.2s;
    }
    .form-control:focus { 
        border-color: #7bbde8; 
        background: #fff; 
    }
    .btn-submit { 
        background: #0a4174; 
        color: white; 
        padding: 12px; 
        border: none; 
        border-radius: 8px; 
        cursor: pointer; 
        font-weight: 700; 
        font-size: 13px; 
        width: 100%; 
    }
    .btn-submit:hover {
        opacity: 0.9;
    }
    .btn-cancel { 
        background: transparent; 
        color: #527597; 
        border: 1px solid #d0e1f0; 
        padding: 10px; 
        border-radius: 8px; 
        text-decoration: none; 
        font-weight: 600; 
        font-size: 13px; 
        text-align: center; 
        display: block; 
        width: 100%; 
        margin-top: 10px; 
    }
    .btn-cancel:hover {
        background: #f4f8fb;
    }
    @media (max-width: 992px) {
        .form-layout-grid { grid-template-columns: 1fr; }
        .form-card-sidebar { position: static; }
    }
</style>

<form action="{{ route('admin.admins.store') }}" method="POST">
    @csrf
    <div class="form-layout-grid">
        
        <!-- KOLOM KIRI: ISIAN KREDENSIAL UTAMA -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174;">Pendaftaran Pengelola</h2>
                <p style="font-size: 12px; color: #527597">Buat akun login baru untuk rekan petugas administrasi portal.</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nama Lengkap Admin <span style="color:red;">*</span></label>
                <input type="text" name="name" class="form-control" required placeholder="Masukkan nama asli pengelola...">
            </div>
            
            <div class="form-group">
                <label class="form-label">Alamat Email Login <span style="color:red;">*</span></label>
                <input type="email" name="email" class="form-control" required placeholder="Contoh: staff.admin@alumnispace.id">
            </div>
            
            <div class="form-group">
                <label class="form-label">Kata Sandi (Password) <span style="color:red;">*</span></label>
                <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter unik...">
            </div>
            
            <div class="form-group">
                <label class="form-label">Ulangi Kata Sandi <span style="color:red;">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Ketik ulang password...">
            </div>
        </div>

        <!-- KOLOM KANAN: KONTAK & TINGKATAN OTORITAS -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom:16px; padding-bottom:8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174;">Otoritas & Kontak</h3>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nomor WhatsApp / HP</label>
                <input type="text" name="phone" class="form-control" placeholder="Contoh: 0812345xxxxx">
            </div>
            
            <div class="form-group">
                <label class="form-label">Tingkat Hak Akses <span style="color:red;">*</span></label>
                <select name="role" class="form-control" required style="padding: 10px 14px; background: #f4f8fb;">
                    <option value="admin">Admin Standar (Operasional)</option>
                    <option value="super_admin">Super Admin (Akses Penuh)</option>
                </select>
            </div>
            
            <div class="form-actions" style="margin-top: 24px;">
                <button type="submit" class="btn-submit">Daftarkan Akun Admin</button>
                <a href="{{ route('admin.admins.index') }}" class="btn-cancel" onclick="return confirm('Batalkan pembuatan akun? Semua data ketikan akan hilang.');">Batalkan</a>
            </div>
        </div>
        
    </div>
</form>
@endsection
