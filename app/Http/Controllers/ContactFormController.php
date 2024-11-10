<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactFormController extends Controller
{
    public function create(){
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        // Honeypot: if email_confirm is filled in, it's likely a bot
        if ($request->filled('email_confirm')) {
            return Redirect::route('home')->with('error', 'Oops, something went wrong');
        }

        $reservedWords = ['admin', 'user', 'support'];

        // Validate contact form
        $request->validate([
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
                'max:1000'
            ]
        ]);

        $contactForm = ContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->contact_message,
            'status' => 'unread',
        ]);

        Mail::send('emails.contact', ['contactForm' => $contactForm], function($message) use ($contactForm) {
            $message->to('tomeidktesting@gmail.com')->subject('Whenime Contact Form Submission #' . $contactForm->id);
        });

        return Redirect::route('contact')->with('success', 'Your message was sent successfully!');
    }
}
