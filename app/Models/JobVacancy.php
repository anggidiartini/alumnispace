<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'posted_by',
        'title',
        'slug',
        'company_name',
        'company_logo',
        'alumni_contact',
        'job_type',
        'workplace_type',
        'category',
        'highlight_badge',
        'location',
        'salary_display',
        'salary_type',
        'description',
        'requirements',
        'skills_tags',
        'application_link',
        'application_email',
        'deadline',
        'is_active',
    ];

    protected $casts = [
        'skills_tags' => 'array',
        'is_active' => 'boolean',
        'deadline' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title . '-' . Str::random(5));
            }
        });
    }

    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_vacancy_id');
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->company_name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
            if (strlen($initials) >= 2) break;
        }
        return $initials ?: 'JB';
    }
}
