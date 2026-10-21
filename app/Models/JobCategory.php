<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $table = 'job_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class);
    }
}
