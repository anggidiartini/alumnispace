<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $table = 'job_categories'; // Sesuaikan jika nama tabel kamu job_vacancy_categories
    protected $fillable = ['name', 'description', 'status'];

    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class);
    }
}
