<?php

namespace Database\Seeders;

use App\Models\ContactForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactForm::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'subject' => 'Inquiry about your services',
            'message' => 'Hi, I would like to know more about your pricing and services. Please provide details.',
            'status' => 'UNREAD',
        ]);

        ContactForm::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'subject' => 'Support request',
            'message' => 'I am experiencing issues with my account. Can you assist me with resetting my password?',
            'status' => 'READ',
        ]);

        ContactForm::create([
            'name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'subject' => 'Feedback on recent purchase',
            'message' => 'The product I purchased was fantastic! However, I had some issues with the delivery time.',
            'status' => 'SOLVED',
        ]);

        ContactForm::create([
            'name' => 'Bob Brown',
            'email' => 'bobbrown@example.com',
            'subject' => 'General inquiry',
            'message' => 'Can you provide more information about your store hours and location?',
            'status' => 'UNREAD',
        ]);

        ContactForm::create([
            'name' => 'Charlie Davis',
            'email' => 'charlie.davis@example.com',
            'subject' => 'Question about refund policy',
            'message' => 'I would like to know how to request a refund for a recent purchase I made.',
            'status' => 'UNREAD',
        ]);
    }
}
