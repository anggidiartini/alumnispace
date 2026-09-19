<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AlumniAchievement extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'place',
        'date',
        'type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
