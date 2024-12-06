<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;
use App\Models\User;

class CreateUserSettings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $defaultSettings = config('settings.defaults');

        foreach ($users as $user) {
            $userSettings = array_merge(['user_id' => $user->id], $defaultSettings);

            Settings::updateOrCreate(
                ['user_id' => $user->id],
                $userSettings
            );
        }
    }
}
