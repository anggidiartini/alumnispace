<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_number',
        'graduation_year',
        'major',
        'profession',
        'company',
        'city',
        'phone_number',
        'avatar',
        'bio',
        'linkedin_url',
        'instagram_url',
        'github_url',
        'twitter_url',
        'youtube_url',
        'portfolio_url',
        'is_online',
        'is_verified',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'is_online' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
