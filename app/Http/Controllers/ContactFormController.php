<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\ContactFormStatus;

class ContactFormController extends Controller
{
    public function indexUnread() {
        $forms = ContactForm::unread()->paginate(25);
        $status = 'unread';
        return view('admin.contact', compact('forms', 'status'));
    }

    public function indexRead() {
        $forms = ContactForm::read()->paginate(25);
        $status = 'read';
        return view('admin.contact', compact('forms', 'status'));
    }

    public function indexSolved() {
        $forms = ContactForm::solved()->paginate(25);
        $status = 'solved';
        return view('admin.contact', compact('forms', 'status'));
    }

    public function show($id) {
        $submission = ContactForm::find($id);
        if (!$submission) {
            return Redirect::route('contact.unread')->with('error', 'This form submission does not exist');
        }
        if ($submission->status == ContactFormStatus::Unread) {
            $submission->status = ContactFormStatus::Read;
            $submission->save();
        }

        return view('admin.submission', compact('submission'));
    }

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

    public function toggleRead($id) {
        $form = ContactForm::findOrFail($id);

        $form->status = ($form->status == ContactFormStatus::Unread) ? ContactFormStatus::Read : ContactFormStatus::Unread;

        $form->save();

        if ($form->status == ContactFormStatus::Unread) {
            return Redirect::route('contact.unread')->with('success', 'Set form as unread');
        } else {
            return Redirect::route('contact.read')->with('success', 'Set form as read');
        }
    }

    public function toggleSolved($id) {
        $form = ContactForm::findOrFail($id);

        $form->status = ($form->status == ContactFormStatus::Solved) ? ContactFormStatus::Read : ContactFormStatus::Solved;

        $form->save();

        if ($form->status == ContactFormStatus::Solved) {
            return Redirect::route('contact.solved')->with('success', 'Set form as solved');
        } else {
            return Redirect::route('contact.read')->with('success', 'Set form as read');
        }
    }

    public function destroy($id) {
        $form = ContactForm::findOrFail($id);
        $status = $form->status;

        $form->delete();

        if ($status == ContactFormStatus::Solved) {
            return Redirect::route('contact.solved')->with('success', 'Deleted form submission');
        } else if ($status == ContactFormStatus::Read) {
            return Redirect::route('contact.read')->with('success', 'Deleted form submission');
        } else {
            return Redirect::route('contact.unread')->with('success', 'Deleted form submission');
        }
    }
}
