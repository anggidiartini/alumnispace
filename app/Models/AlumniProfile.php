<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
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

    // Pola otomatisasi slug mirip dengan JobVacancy
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($profile) {
            if (empty($profile->slug)) {
                $userName = $profile->user->name ?? 'alumni';
                $profile->slug = Str::slug($userName . '-' . Str::random(5));
            }
        });
    }

    // Supaya pencarian di route langsung menggunakan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
