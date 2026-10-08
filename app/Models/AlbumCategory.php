<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumCategory extends Model
{
    protected $table = 'album_categories';
    protected $fillable = ['name', 'description', 'status'];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
