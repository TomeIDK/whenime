<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create(){
        return view('contact');
    }

    public function store(Request $request){
        $reservedWords = ['admin', 'user', 'support'];

        // Validate contact form
        $validatedData = $request->validate([
            'name' => [
                'required', 
                'string', 
                'min:3', 
                'max:30', 
                'not_in:' . implode(',', $reservedWords), 
                'regex:/^\S.*\S$|^\S$/'
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255'
            ],
            'subject' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'contact_message' => [
                'required',
                'string',
                'min:3',
                'max:2000'
            ]
        ]);

        Mail::send('emails.contact', $validatedData, function($message) {
            $message->to('tomeidktesting@gmail.com')->subject('Whenime Contact Form Submission');
        });

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
