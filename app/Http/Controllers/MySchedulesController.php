<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class MySchedulesController extends Controller
{
    public function index() {
        $user = User::with('schedules')->find(Auth::id());
        return view('my-schedules.my-schedules', compact('user'));
    }

    public function store(Request $request): RedirectResponse 
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:20'
            ] ,
            'is_public' => [
                'boolean'
            ]
        ]);

        $schedule = new Schedule();
        $schedule->user_id = Auth::user()->id;
        $schedule->name = $request->name;
        $schedule->is_public = $request->has('is_public');

        $schedule->save();

        return Redirect::route('my-schedules')->with('success', 'Schedule created successfully');
    }

    public function edit($scheduleName) {
        $ownershipCheck = $this->checkOwnershipByScheduleName($scheduleName);

        if ($ownershipCheck instanceof \Illuminate\Http\RedirectResponse) {
            return $ownershipCheck; 
        }

        $schedule = $ownershipCheck;
        return view('my-schedules.edit', compact('schedule'));
    }

    public function update() {

    }

    public function destroy($id): RedirectResponse 
    {
        $ownershipCheck = $this->checkOwnershipByScheduleId($id);

        if ($ownershipCheck instanceof \Illuminate\Http\RedirectResponse) {
            return $ownershipCheck; 
        }

        $schedule = $ownershipCheck;
        $schedule->delete();

        return Redirect::route('my-schedules')->with('success', 'Schedule deleted successfully!');

    }

    // Checks if user owns the schedule or is an admin
    private function checkOwnershipByScheduleName($scheduleName) {
        $user = Auth::user();

        $schedule = Schedule::where('user_id', $user->id)->where('name', $scheduleName)->first();

        if($user->is_admin) {
            return $schedule;
        }

        if(!$schedule) {
            return Redirect::route('home')->with('error', 'You do not have access to this schedule.');
        }
        return $schedule;
    }

    // Checks if user owns the schedule or is an admin
    private function checkOwnershipByScheduleId($scheduleId) {
        $user = Auth::user();

        $schedule = Schedule::where('user_id', $user->id)->find($scheduleId);

        if($user->is_admin) {
            return $schedule;
        }

        if(!$schedule) {
            return Redirect::route('home')->with('error', 'You do not have access to this schedule.');
        }
        return $schedule;
    }
}
