<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";

    protected $fillable = [
        "title",
        "image",
        "content",
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_news', 'news_id', 'category_id');
    }
}
