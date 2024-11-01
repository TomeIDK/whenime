<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
