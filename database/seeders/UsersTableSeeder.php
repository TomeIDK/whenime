<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        User::create([
            'username' => 'TomeIDK',
            'date_of_birth' => '2001-06-26',
            'profile_picture' => 'profile_pictures/oKqlktptLhwtn6y49bGfN9G5GThjURaSdkSNUpi5.png',
            'email' => 'cecepas@hotmail.com',
            'email_verified_at' => null,
            'password' => '$2y$12$X/S8eelk3mczY.NZtLLSpuc3zzRfUYBo57MwwYdOXT44POaiSfm1i', // Ensure this password is hashed
            'is_admin' => 0,
            'remember_token' => 'WLAxaZTgR80Ulr1ZxGiBfVPPeCOySOKnSLYccFNdoib3vbLcamBqXNTVf8Xk',
            'created_at' => '2024-10-27 10:09:00',
            'updated_at' => '2024-10-27 20:15:39',
        ]);

        User::create([
            'username' => 'Tome',
            'date_of_birth' => null,
            'profile_picture' => null,
            'email' => 'growtome001@gmail.com',
            'email_verified_at' => null,
            'password' => '$2y$12$M7DgBW66pFiQf/GvMaX3IOryadDAeRuaX1UvyHx320I9fLHs4MgVm',
            'is_admin' => 0,
            'remember_token' => null,
            'created_at' => '2024-10-27 11:06:19',
            'updated_at' => '2024-10-27 11:06:19',
        ]);

        User::create([
            'username' => 'admin',
            'date_of_birth' => null,
            'profile_picture' => 'profile_pictures/mpsx8ekygkJx1ezQI35AahuY9I1OJzln9yEeiZQa.jpg',
            'email' => 'admin@ehb.be',
            'email_verified_at' => null,
            'password' => '$2y$12$vlZWmR0/BQTxyshdoVbiy.JJMchHTcYogkNEn5M85K5P5pk13sGL.',
            'is_admin' => 1,
            'remember_token' => null,
            'created_at' => '2024-10-28 09:54:49',
            'updated_at' => '2024-10-28 09:54:49',
        ]);
    }
}
