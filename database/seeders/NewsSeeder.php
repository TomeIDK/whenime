<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            "title" => "Why you should watch Orb: On The Movements Of The Earth",
            "image" => "news_images/rafal-happy.png",
            "content" => "Orb: On The Movements Of The Earth is an amazing show that you need to see! The beautiful visuals and cool animation make every moment exciting. It shows our planet in a way that will make you appreciate nature even more. The story mixes fun and learning perfectly, making it enjoyable for everyone. Don't miss out on this incredible journey—it's a must-watch!",
        ]);

        News::create([
            "title" => "Eternal Echoes: The Journey of Frieren",
            "image" => "news_images/frieren.jpg",
            "content" => "Frieren is an incredible journey that explores the meaning of life and friendship in such a heartfelt way! The story follows an elf mage who embarks on a quest after her hero party disbands, diving deep into emotions and memories. The stunning animation and unique character designs bring each moment to life, making you feel every joy and sadness. With its perfect mix of adventure and introspection, this anime will leave you thinking about its themes long after the credits roll. Don't miss out on this beautiful story—it's a must-watch for any anime fan!",
        ]);

        News::create([
            "title" => "Quest for Glory: The Shangri-La Chronicles",
            "image" => "news_images/shangri-la-frontier.jpeg",
            "content" => "Shangri-La Frontier is an epic ride that every gamer and anime lover needs to check out! It follows a skilled player diving into a new game full of challenges and adventures, packed with thrilling battles and jaw-dropping visuals. The humor and excitement are off the charts, making it an absolute blast to watch. With its unique take on gaming culture, you'll find yourself cheering for the main character as they conquer every obstacle. Get ready for an unforgettable gaming journey—this anime is a total must-see!",
        ]);

        News::create([
            "title" => "Guardians of the Wind: Brotherhood in Battle",
            "image" => "news_images/wind-breaker.jpg",
            "content" => "Wind Breaker is a high-energy anime that will keep you on the edge of your seat from start to finish! It follows a group of fierce fighters who protect their town while showcasing incredible teamwork and friendship. The action-packed scenes and stunning animation will leave you breathless, and the character development is truly inspiring. With its awesome blend of action and heart, you'll be rooting for the heroes every step of the way. Trust me, you don't want to miss this thrilling ride—it's an absolute must-watch!",
        ]);
    }
}
