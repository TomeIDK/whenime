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
        $user = User::with(['schedules' => function ($query) {
            $query->where('is_public', true);
        }])->where('username', $username)->firstOrFail();

        $isCurrentUser = Auth::check() && Auth::user()->username === $username;

        $currentSchedule = $user->schedules->first();

        $dayOrder = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];

        if ($currentSchedule) {
            // Sort days and services in a custom order
            $uniqueDays = $currentSchedule->scheduleItems->pluck('day')->unique()->sortBy(function($day) use ($dayOrder) {
                return array_search($day, $dayOrder);
            });

                // Group items with the same day and time slot
            $groupedItems = [];
            foreach ($currentSchedule->scheduleItems as $item) {
                $groupedItems[$item->day][$item->time][] = $item;
            }
            return view('profile.profile', compact('user', 'isCurrentUser', 'currentSchedule', 'uniqueDays', 'groupedItems'));

        }


        return view('profile.profile', compact('user', 'isCurrentUser', 'currentSchedule'));
    }

    public function showSchedule($username, $season, $year) {
        $user = User::with(['schedules' => function ($query) {
            $query->where('is_public', true);
        }])->where('username', $username)->firstOrFail();

        $isCurrentUser = Auth::check() && Auth::user()->username === $username;

        $currentSchedule = $user->schedules->where('season', $season)->where('year', $year)->first();

        $dayOrder = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];

        if ($currentSchedule) {
            // Sort days and services in a custom order
            $uniqueDays = $currentSchedule->scheduleItems->pluck('day')->unique()->sortBy(function($day) use ($dayOrder) {
                return array_search($day, $dayOrder);
            });

            // Group items with the same day and time slot
            $groupedItems = [];
            foreach ($currentSchedule->scheduleItems as $item) {
                $groupedItems[$item->day][$item->time][] = $item;
            }
            return view('profile.profile', compact('user', 'isCurrentUser', 'currentSchedule', 'uniqueDays', 'groupedItems'));
        }

        return $this->show($username);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $username): View
    {
        $user = User::where('username', $username)->firstOrFail();
        $isCurrentUser = Auth::check() && Auth::user()->username === $username;
        return view('profile.edit', compact('user', 'isCurrentUser'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $username): RedirectResponse
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
            ],
            'date_of_birth' => [
                'nullable', 
                'date'
            ]
        ]);

        // Sanitize about input
        $about = strip_tags($request->about) ?? '';
        
        $user = User::where('username', $username)->first();

        if (!$user) {
            return Redirect::route('home')->with('error', 'This profile does not exist');
        }

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->about = $about;
        if(!$user->date_of_birth){
            $user->date_of_birth = $request->date_of_birth;
        }

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
