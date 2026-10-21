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
        'tiktok_url',
        'achievements',
        'organization_role',
        'current_university',
        'study_status',
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

    /**
     * Scope query untuk hanya mengambil alumni berstatus aktif (menyembunyikan yang Tidak Aktif / Non-aktif).
     */
    public function scopeActive($query)
    {
        return $query->where('study_status', 'Aktif');
    }

    /**
     * Ubah path foto di database menjadi URL yang bisa dipakai di <img>.
     * Dipakai juga oleh HomeController untuk data pengurus (query builder).
     *
     * Format dari admin: "uploads/xxx.jpg" (file ada di public/uploads).
     * Tetap mendukung data lama: "storage/..." atau path storage:link, dan URL penuh.
     * Mengembalikan null kalau file tidak ditemukan, sehingga view bisa pakai avatar default.
     */
    public static function resolveAvatarUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        $path = ltrim(str_replace('\\', '/', $path), '/');

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // Format dari admin: uploads/xxx.jpg
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // Cadangan untuk data lama yang disimpan lewat storage:link
        $clean = preg_replace('#^storage/#', '', $path);

        if (file_exists(public_path('storage/' . $clean))) {
            return asset('storage/' . $clean);
        }

        return null;
    }

    /**
     * Accessor: $alumni->avatar_url
     */
    public function getAvatarUrlAttribute(): ?string
    {
        return static::resolveAvatarUrl($this->avatar);
    }
}
