<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsIds = News::all()->pluck('id')->toArray();
        $categoryIds = Category::all()->pluck('id')->toArray();

        foreach ($newsIds as $newsId) {
            $randomCategoryId1 = $categoryIds[array_rand($categoryIds)];
            $randomCategoryId2 = $categoryIds[array_rand($categoryIds)];

            DB::table('category_news')->insert([
                'news_id' => $newsId,
                'category_id' => $randomCategoryId1,
            ]);

            DB::table('category_news')->insert([
                'news_id' => $newsId,
                'category_id' => $randomCategoryId2,
            ]);
        }

    }
}
