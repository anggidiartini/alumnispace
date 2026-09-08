<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit agar sinkron dengan database
    protected $table = 'companies';

    // Mengizinkan semua kolom diisi selain kolom id
    protected $guarded = ['id'];

    /**
     * Relasi One-to-Many ke model JobVacancy
     */
    public function jobVacancies(): HasMany
    {
        return $this->hasMany(JobVacancy::class, 'company_id');
    }
}
