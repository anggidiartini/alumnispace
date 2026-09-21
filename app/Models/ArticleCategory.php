<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_categories'; // Sesuaikan jika nama tabel database kamu berbeda
    protected $fillable = ['name', 'description', 'status'];

    // Hubungan ke data Artikel utama (Otomatis membaca kolom category_id di database)
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
