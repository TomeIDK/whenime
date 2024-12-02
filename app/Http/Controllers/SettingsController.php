<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request) {
        $section = $request->input('section', 'preferences');

        return view('settings.settings', compact('section'));
    }
}
