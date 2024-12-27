<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{    
    use HasFactory;

    protected $table = "schedule_items";

    protected $fillable = [
        "anime_id",
        "schedule_id",
        "name",
        "day",
        "time",
        "service",
    ];
    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
