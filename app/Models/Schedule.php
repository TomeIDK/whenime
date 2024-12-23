<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = "schedules";

    protected $fillable = [
        'user_id',
        'season',
        'year',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scheduleItems() {
        return $this->hasMany(ScheduleItem::class, 'schedule_id');
    }
}
