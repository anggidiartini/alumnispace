<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'slug',
        'category',
        'badge_tag',
        'banner_image',
        'event_date',
        'start_time',
        'end_time',
        'time_display',
        'location_type',
        'venue',
        'description',
        'registration_link',
        'quota',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'quota' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title . '-' . Str::random(5));
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $table = 'events';

    public function getShortDescriptionAttribute()
    {
        return \Illuminate\Support\Str::limit($this->deskripsi, 150);
    }

    public function getAboutDescriptionAttribute()
    {
        return $this->deskripsi;
    }

    public function getTimeInfoAttribute()
    {
        if ($this->time_display) return $this->time_display;
        $start = $this->start_time ? date('H:i', strtotime($this->start_time)) : '00:00';
        $end = $this->end_time ? date('H:i', strtotime($this->end_time)) : 'Selesai';
        return "{$start} – {$end} WITA";
    }

    public function getRegisteredCountAttribute()
    {
        return $this->registrations()->where('status', 'registered')->count();
    }


    public function getBenefitsAttribute()
    {
        return collect([]);
    }

    public function getGalleriesAttribute()
    {
        return collect([]);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }
}
