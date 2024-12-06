<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index(Request $request) {
        $section = $request->input('section', 'preferences');
        $settings = Auth::user()->settings;
        $timezones = config('timezones');


        return view('settings.settings', compact('section', 'settings', 'timezones'));
    }

    public function update(Request $request) {
        $timezones = array_keys(config('timezones'));

        $request->validate([
            'theme' => [
                'required', 
                'in:light,dark'
            ],
            'timezone' => [
                'required', 
                Rule::in($timezones)
            ],
            'time_format' => [
                'required', 
                'in:24h,12h'
            ],
        ]);

        $settings = $request->user()->settings;

        if(!$settings) {
            return back()->with('error', 'Settings not found');
        }

        $settings->update([
            'theme' => $request->theme,
            'timezone' => $request->timezone,
            'time_format' => $request->time_format
        ]);

        return back()->with('success', 'Settings updated successfully');
    }
}
