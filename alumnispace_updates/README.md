# AlumniSpace — Panduan Integrasi File Update

Paket ini berisi seluruh pembaruan backend & frontend untuk platform **AlumniSpace**:
- **Autentikasi Nyata (Laravel Auth)**: Validasi email & password kredensial database.
- **Feature Gating**: Fitur Direktori Alumni, Album Kenangan, Lowongan Kerja, dan Agenda Event terkunci bagi tamu, dan terbuka otomatis saat login.
- **Database Migrations & Seeders**: Skema 10 tabel lengkap dengan data demo realistis.

---

## 📁 Struktur File & Lokasi Penempatan

Salin setiap file dari folder ini ke folder proyek utama Laravel Anda sesuai jalurnya:

```
[Paket Update]                              -> [Folder Proyek Utama]
-----------------------------------------------------------------------------
app/
 ├── Http/Controllers/
 │    ├── AuthController.php                -> app/Http/Controllers/AuthController.php
 │    ├── HomeController.php                -> app/Http/Controllers/HomeController.php
 │    ├── AlumniDirectoryController.php     -> app/Http/Controllers/AlumniDirectoryController.php
 │    ├── AlbumController.php               -> app/Http/Controllers/AlbumController.php
 │    ├── JobVacancyController.php          -> app/Http/Controllers/JobVacancyController.php
 │    ├── EventController.php               -> app/Http/Controllers/EventController.php
 │    └── LandingController.php             -> app/Http/Controllers/LandingController.php
 └── Models/
      ├── User.php                          -> app/Models/User.php
      ├── AlumniProfile.php                 -> app/Models/AlumniProfile.php
      ├── JobVacancy.php                    -> app/Models/JobVacancy.php
      ├── JobApplication.php                -> app/Models/JobApplication.php
      ├── Event.php                         -> app/Models/Event.php
      ├── EventRegistration.php             -> app/Models/EventRegistration.php
      ├── Album.php                         -> app/Models/Album.php
      ├── AlbumPhoto.php                    -> app/Models/AlbumPhoto.php
      ├── Testimonial.php                   -> app/Models/Testimonial.php
      └── Article.php                       -> app/Models/Article.php

database/
 ├── migrations/                            -> database/migrations/
 └── seeders/                               -> database/seeders/

resources/
 └── views/
      ├── auth/login.blade.php              -> resources/views/auth/login.blade.php
      └── home/index.blade.php              -> resources/views/home/index.blade.php

public/
 ├── js/script.js                           -> public/js/script.js
 └── css/home.css                           -> public/css/home.css

routes/
 └── web.php                                -> routes/web.php
```

---

## 🚀 Cara Menjalankan & Menguji Alur Login

1. **Jalankan Migrasi & Seeder Database:**
   ```bash
   php artisan migrate:fresh --seed
   ```

2. **Bersihkan Cache View & Route:**
   ```bash
   php artisan view:clear
   php artisan route:clear
   ```

3. **Buka Website di Browser:**
   - Akses: `http://alumnispace.test` atau `http://localhost:8000`
   - Klik tombol **Masuk / Login**
   - Masukkan kredensial demo:
     - **Email:** `kanya.salsabila@alumni.id`
     - **Password:** `password123`
     *(Tersedia tombol pintas klik 1x di halaman login)*
   - Klik **Masuk Sekarang**
   - Website memeriksa kredensial, melakukan login sesi Laravel, dan mengarahkan ke dashboard `/home`.
   - Di `/home`:
     - Teaser terkunci otomatis hilang.
     - Header menampilkan nama dan inisial akun.
     - Fitur **Direktori Alumni**, **Album Kenangan**, **Bursa Lowongan**, dan **Agenda Event** terbuka penuh!
     - Klik tombol **Keluar** untuk logout dan mengunci kembali fitur.
