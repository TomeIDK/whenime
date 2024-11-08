<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\News;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index() {
        $date = Carbon::now()->subWeek();
        $users = [
            'count' => User::all()->count(),
            'comparison' => User::where('created_at', '<', $date)->count(),
            'latest' => User::latest('created_at')->take(5)->get(),
        ];
        $schedules = [
            'count' => Schedule::all()->count(),
            'comparison' => Schedule::where('created_at', '<', $date)->count(),
        ];
        $news = [
            'count' => News::all()->count(),
            'comparison' => News::where('created_at', '<', $date)->count(),
            'latest' => News::latest('created_at')->take(8)->get(),

        ];

        return view('admin.dashboard', compact('users', 'schedules', 'news'));
    }
}
