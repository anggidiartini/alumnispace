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
    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .password-wrapper input {
        padding-right: 40px;
    }
    .password-toggle {
        position: absolute;
        right: 14px;
        color: #527597;
        cursor: pointer;
        font-size: 14px;
    }
    .password-toggle:hover {
        color: #0a4174;
    }
    /* Sembunyikan ikon mata bawaan browser (khususnya Microsoft Edge) */
    .password-wrapper input::-ms-reveal,
    .password-wrapper input::-ms-clear {
        display: none;
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

<form action="{{ isset($admin) ? route('admin.admins.update', $admin->id) : route('admin.admins.store') }}" method="POST">
    @csrf
    @if(isset($admin))
        @method('PUT')
    @endif
    <div class="form-layout-grid">
        
        <!-- KOLOM KIRI: ISIAN KREDENSIAL UTAMA -->
        <div class="form-card-main">
            <div class="form-header">
                <h2 style="font-size: 20px; font-weight: 800; color: #0a4174;">{{ isset($admin) ? 'Edit Pengelola' : 'Pendaftaran Pengelola' }}</h2>
                <p style="font-size: 12px; color: #527597">{{ isset($admin) ? 'Perbarui data akun admin yang sudah ada.' : 'Buat akun login baru untuk rekan petugas administrasi portal.' }}</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nama Lengkap Admin <span style="color:red;">*</span></label>
                <input type="text" name="name" class="form-control" required placeholder="Masukkan nama asli pengelola..." value="{{ $admin->name ?? '' }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Alamat Email Login <span style="color:red;">*</span></label>
                <input type="email" name="email" class="form-control" required placeholder="Masukkan email..." autocomplete="off" value="{{ $admin->email ?? '' }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Kata Sandi (Password) {!! isset($admin) ? '<span style="font-weight: normal; color: #527597; text-transform: none;">(Kosongkan jika tidak diganti)</span>' : '<span style="color:red;">*</span>' !!}</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password_input" class="form-control" {{ isset($admin) ? '' : 'required' }} placeholder="Masukkan password..." autocomplete="new-password">
                    <i class="fa-solid fa-eye-slash password-toggle" onclick="togglePassword('password_input', this)"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Ulangi Kata Sandi {!! !isset($admin) ? '<span style="color:red;">*</span>' : '' !!}</label>
                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" id="password_confirmation_input" class="form-control" {{ isset($admin) ? '' : 'required' }} placeholder="Ketik ulang password..." autocomplete="new-password">
                    <i class="fa-solid fa-eye-slash password-toggle" onclick="togglePassword('password_confirmation_input', this)"></i>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: KONTAK & TINGKATAN OTORITAS -->
        <div class="form-card-sidebar">
            <div class="form-header" style="margin-bottom:16px; padding-bottom:8px;">
                <h3 style="font-size: 14px; font-weight: 700; color: #0a4174;">Otoritas & Kontak</h3>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nomor WhatsApp / HP</label>
                <input type="text" name="phone" class="form-control" placeholder="Contoh: 0812345xxxxx" value="{{ $admin->phone ?? '' }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Tingkat Hak Akses <span style="color:red;">*</span></label>
                <select name="role" class="form-control" required style="padding: 10px 14px; background: #f4f8fb;">
                    <option value="admin" {{ (isset($admin) && $admin->role === 'admin') ? 'selected' : '' }}>Admin Standar (Operasional)</option>
                    <option value="super_admin" {{ (isset($admin) && $admin->role === 'super_admin') ? 'selected' : '' }}>Super Admin (Akses Penuh)</option>
                </select>
            </div>
            
            <div class="form-actions" style="margin-top: 24px;">
                <button type="submit" class="btn-submit">{{ isset($admin) ? 'Simpan Perubahan' : 'Daftarkan Akun Admin' }}</button>
                <a href="{{ route('admin.admins.index') }}" class="btn-cancel" onclick="return confirm('{{ isset($admin) ? 'Batalkan pengeditan? Perubahan yang belum disimpan akan hilang.' : 'Batalkan pembuatan akun? Semua data ketikan akan hilang.' }}');">Batalkan</a>
            </div>
        </div>
        
    </div>
</form>

<script>
    function togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            iconElement.classList.remove('fa-eye-slash');
            iconElement.classList.add('fa-eye');
        } else {
            input.type = 'password';
            iconElement.classList.remove('fa-eye');
            iconElement.classList.add('fa-eye-slash');
        }
    }
</script>
@endsection
