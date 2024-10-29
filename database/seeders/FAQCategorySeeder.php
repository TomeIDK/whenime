<?php

namespace Database\Seeders;

use App\Models\FAQCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FAQCategory::create(["name" => "General Information"]);
        FAQCategory::create(["name" => "Account Management"]);
        FAQCategory::create(["name" => "Using the Platform"]);
        FAQCategory::create(["name" => "Functionality and Features"]);
        FAQCategory::create(["name" => "User Experience"]);
    }
}
