<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    /**
     * FIX: sebelumnya berisi 'user_id', 'kategori', 'gambar_utama', 'konten'
     * yang tidak ada di tabel (kolom asli hasil Schema::getColumnListing:
     * author_id, category, thumbnail, content). Field lama itu bikin
     * mass-assignment gagal diam-diam (silent fail).
     */
    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'category',
        'thumbnail',
        'excerpt',
        'content',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title . '-' . Str::random(5));
            }
        });
    }

    /**
     * FIX: FK sebelumnya 'user_id' (tidak ada di tabel).
     * Kolom asli adalah 'author_id'.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}