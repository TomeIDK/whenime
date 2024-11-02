<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ScheduleItem;
use Carbon\Carbon;


class ScheduleItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleItem::create([
            "schedule_id" => 1,
            "name" => "Orb: On The Movements Of The Earth",
            "day" => "Saturday",
            "time" => Carbon::createFromTime(18, 0)->toTimeString(),
            "service" => "Netflix",
        ]);

            ScheduleItem::create([
            "schedule_id" => 1,
            "name" => "Bleach: Thousand-Year Blood War Part 3",
            "day" => "Saturday",
            "time" => Carbon::createFromTime(18, 30)->toTimeString(),
            "service" => "Disney+",
        ]);

        ScheduleItem::create([
            "schedule_id" => 1,
            "name" => "Blue Lock S2",
            "day" => "Saturday",
            "time" => Carbon::createFromTime(18, 30)->toTimeString(),
            "service" => "Funimation",
        ]);

        ScheduleItem::create([
            "schedule_id" => 1,
            "name" => "Dandadan",
            "day" => "Thursday",
            "time" => Carbon::createFromTime(17, 0)->toTimeString(),
            "service" => "Netflix",
        ]);

        ScheduleItem::create([
            "schedule_id" => 1,
            "name" => "Shangri-La Frontier S3",
            "day" => "Sunday",
            "time" => Carbon::createFromTime(10, 0)->toTimeString(),
            "service" => "Crunchyroll",
        ]);

        ScheduleItem::create([
            "schedule_id" => 1,
            "name" => "Re:Zero S3",
            "day" => "Wednesday",
            "time" => Carbon::createFromTime(16, 30)->toTimeString(),
            "service" => "Other",
        ]);

        ScheduleItem::create([
            "schedule_id" => 1,
            "name" => "Blue Box",
            "day" => "Thursday",
            "time" => Carbon::createFromTime(17, 0)->toTimeString(),
            "service" => "HIDIVE",
        ]);
    }
}
