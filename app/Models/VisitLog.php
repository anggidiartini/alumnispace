<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitLog extends Model
{
    use HasFactory;

    protected $table = 'visit_logs';

    protected $fillable = [
        'visitor_id',
        'url',
        'visited_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
