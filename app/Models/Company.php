<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit agar sinkron dengan database MySQL
    protected $table = 'companies';

    // Mengizinkan semua kolom diisi secara mass-assignment selain kolom id
    protected $guarded = ['id'];

    /**
     * Relasi One-to-Many ke model JobVacancy (Tabel lowongan kerja bawaan Anda)
     */
    public function jobVacancies(): HasMany
    {
        return $this->hasMany(JobVacancy::class, 'company_id');
    }

    /**
     * Accessor untuk membuat inisial logo default jika file gambar kosong
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
            if (strlen($initials) >= 2) break;
        }
        return $initials ?: 'CO';
    }
}
