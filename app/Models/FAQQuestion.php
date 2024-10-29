<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQQuestion extends Model
{
    use HasFactory;

    protected $table = "faq_questions";

    protected $fillable = [
        "faq_category_id", 
        "question", 
        "answer"
    ];

    public function category(){
        return $this->belongsTo(FAQCategory::class, 'faq_category_id');
    }
}
