<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'theme',
        'timezone', 
        'time_format',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
