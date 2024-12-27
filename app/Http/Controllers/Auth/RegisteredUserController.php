<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Honeypot: if email_confirm is filled in, it's likely a bot
        if ($request->filled('email_confirm')) {
            return Redirect::route('home')->with('error', 'Oops, something went wrong');
        }

        $reservedWords = ['admin', 'user', 'support'];
        // Validate user input
        $request->validate([
            'username' => [ // 3-30 chars, only alphanumeric + underscores + hyphens, no leading or trailing spaces, prevent reserved words, unique
                'required', 
                'string', 
                'min:3', 
                'max:30', 
                'regex:/^[A-Za-z0-9_-]+$/', 
                'unique:users,username', 
                'not_in:' . implode(',', $reservedWords), 
                'regex:/^\S.*\S$|^\S$/'
            ], 
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                'unique:user,email',
                'unique:user,new_email'
            ],
            'password' => [
                'required', 
                'confirmed', 
                Rules\Password::min(6)
                ->mixedCase()
                ->numbers()
            ],
            'date_of_birth' => [
                'nullable', 
                'date'
            ],
            'profile_picture' => [ // only jpg or png, max 2 MB
                'nullable', 
                'image', 
                'mimes:jpg,jpeg,png', 
                'max:2048'
            ], 
        ]);

        // Assign input to send to DB
        $userData = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'date_of_birth' => $request->date_of_birth ?? null,
            'profile_picture' => isset($path) ? $path : null,
        ];

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public'); // Store profile_picture in public/storage/profile_pictures
            $userData['profile_picture'] = $path; // Save path to DB
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home'));
    }
}
