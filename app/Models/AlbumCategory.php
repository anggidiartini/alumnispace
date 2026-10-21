<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlbumCategory extends Model
{
    protected $table = 'album_categories';

    protected $fillable = ['name', 'slug', 'description', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Album menyimpan kategori sebagai nama (kolom albums.category),
     * jadi relasinya dihubungkan lewat nama, bukan lewat id.
     */
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, 'category', 'name');
    }

    /**
     * Scope: hanya kategori yang aktif (untuk dropdown di form album).
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
