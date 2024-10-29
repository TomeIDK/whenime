<?php

namespace Database\Seeders;

use App\Models\FAQQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FAQQuestion::create([
            "faq_category_id" => 1,
            "question" => "What is Whenime?", 
            "answer" => "Whenime is a personalized anime tracking website that helps users keep track of their favorite anime series, including airing times and streaming platforms. Users can create their own weekly calendars to stay updated on their anime schedule."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 1,
            "question" => "Is Whenime free to use?", 
            "answer" => "Yes, Whenime is completely free to use. You can track your anime without any subscription fees or hidden costs."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 2,
            "question" => "How do I create an account on Whenime?", 
            "answer" => "To create an account, click on the 'Get Started' or 'Register' button on the homepage. Fill out the registration form with your details, including your username, email address, and password. Once you submit the form, you'll receive a confirmation email to verify your account."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 2,
            "question" => "Can I reset my password?", 
            "answer" => "Yes, if you forget your password, you can click on the 'Forgot Password?' link on the login page. Enter your account's email address, and you'll receive instructions to reset your password."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 3,
            "question" => "How do I add anime to my calendar?", 
            "answer" => "You can add anime to your calendar by searching for a title using the search bar. If the anime is found, you can customize the airing time and streaming platform. If the anime is not available, you can manually add it, and it will only be visible to you."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 3,
            "question" => "Can I edit the airing time or streaming platform of an anime?", 
            "answer" => "Yes, if you have added an anime from the search results, you can modify the airing time to match your timezone and select the streaming platform. The title, description, and cover image will remain unchanged."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 4,
            "question" => "Can I share my calendar with others?", 
            "answer" => "Currently, Whenime does not support sharing calendars with other users. However, you can manually share your schedule by exporting it or taking screenshots."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 4,
            "question" => "What should I do if I encounter an issue?", 
            "answer" => "If you experience any issues while using Whenime, please contact support through the 'Contact Us' page. Provide as much detail as possible, and I will assist you as soon as I can."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 5,
            "question" => "Will Whenime have mobile support?", 
            "answer" => "Yes, Whenime is designed to be responsive and can be accessed on mobile devices. You can track your anime on the go from your smartphone or tablet."
        ]);

        FAQQuestion::create([
            "faq_category_id" => 5,
            "question" => "How can I provide feedback or suggestions?", 
            "answer" => "We welcome your feedback! You can provide suggestions through the 'Feedback' section on our website, or contact us directly via email. Your input helps us improve Whenime for all users."
        ]);
    }
}
