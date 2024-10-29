<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    use HasFactory;

    protected $table = "faq_categories";

    protected $fillable = ['name'];

    public function questions(){
        return $this->hasMany(FAQQuestion::class, 'faq_category_id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
