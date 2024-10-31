<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{
    // Show user's profile
    public function show($username){
        $user = User::where('username', $username)->firstOrFail();

        $isCurrentUser = Auth::check() && Auth::user()->username === $username;

        return view('profile.profile', compact('user', 'isCurrentUser'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $username): View
    {
        $user = $request->user();
        $isCurrentUser = Auth::check() && Auth::user()->username === $username;
        return view('profile.edit', compact('user', 'isCurrentUser'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'about' => [
                'nullable',
                'string', 
                'max:2000'
            ],
            'profile_picture' => [
                'nullable', 
                'image', 
                'mimes:jpg,jpeg,png', 
                'max:2048'
            ]]);

        // Sanitize about input
        $about = strip_tags($request->about) ?? '';
        
        $user = $request->user();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->about = $about;

        $user->save();

        return Redirect::route('profile', $user->username)->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
