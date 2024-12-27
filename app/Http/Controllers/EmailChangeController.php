<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EmailChangeController extends Controller
{
    public function edit() {
        return view('settings.change-email');
    }

    public function store(Request $request) {
        $request->validate([
            'new_email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ]
        ]);

        $user = User::find(Auth::id());
        $user->email = $request->new_email;
        $user->email_verified_at = null;
        $user->save();
        $user->sendEmailVerificationNotification();


        return back()->with('status', 'A verification email was sent to your new email address');
    }
}
