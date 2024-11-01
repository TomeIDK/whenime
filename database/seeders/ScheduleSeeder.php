<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            "user_id" => 1,
            "name" => "Test schedule 1",
            "is_public" => true,
        ]);
        Schedule::create([
            "user_id" => 1,
            "name" => "Test schedule 2",
            "is_public" => false,
        ]);
        Schedule::create([
            "user_id" => 1,
            "name" => "Test schedule 3",
            "is_public" => true,
        ]);
        Schedule::create([
            "user_id" => 2,
            "name" => "Test schedule 4",
            "is_public" => false,
        ]);
        Schedule::create([
            "user_id" => 3,
            "name" => "Test schedule 5",
            "is_public" => false,
        ]);
        Schedule::create([
            "user_id" => 3,
            "name" => "Test schedule 6",
            "is_public" => true,
        ]);
    }
}
