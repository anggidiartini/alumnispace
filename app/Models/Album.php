<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'subtitle_label',
        'sticker_tag',
        'cover_photo',
        'event_date',
        'date_display',
        'location',
        'target_generation',
        'description',
        'is_featured',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($album) {
            if (empty($album->slug)) {
                $album->slug = Str::slug($album->title . '-' . Str::random(5));
            }
        });
    }

    public function photos(): HasMany
    {
        return $this->hasMany(AlbumPhoto::class);
    }
}
