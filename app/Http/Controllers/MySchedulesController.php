<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Services\SeasonService;


class MySchedulesController extends Controller
{
    protected $seasonService;

    public function __construct(SeasonService $seasonService)
    {
        $this->seasonService = $seasonService;
    }

    public function index() {
        $user = User::with('schedules')->find(Auth::id());

        foreach ($user->schedules as $schedule) {
            $schedule->schedule_items_count = $schedule->scheduleItems->count();
            $schedule->status = $this->seasonService->getSeasonStatus($schedule->season, $schedule->year);
        }

        $user->schedules = $this->seasonService->sortOldToNew($user->schedules);

        $seasons = ["Winter", "Spring", "Summer", "Fall"];
        $currentSeason = $this->seasonService->getCurrentSeason();
        return view('my-schedules.my-schedules', compact('user', 'seasons', 'currentSeason'));
    }

    public function store(Request $request): RedirectResponse 
    {
        $request->validate([
            'season' => [
                'required',
                'string',
                'in:Winter,Spring,Summer,Fall'
            ],
            'year' => [
                'required',
                'numeric',
                'digits:4',
                'min:' . (date("Y") - 1),
                'max:' . (date("Y") + 1),
            ]
        ]);

        $existingSchedule = Schedule::where('user_id', Auth::id())
            ->where('season', $request->season)
            ->where('year', $request->year)
            ->first();

        // Check if schedule already exists
        if ($existingSchedule) {
            return Redirect::back()->withErrors([
                'season' => 'You already have a schedule for this season and year',
            ])->withInput();
        }

        // Create and save schedule
        $schedule = new Schedule();
        $schedule->user_id = Auth::user()->id;
        $schedule->season = $request->season;
        $schedule->year = $request->year;

        $schedule->save();

        return Redirect::route('my-schedules')->with('success', 'Schedule created successfully');
    }

    public function edit($season, $year) {
        $ownershipCheck = $this->checkOwnershipByScheduleName($season, $year);

        if ($ownershipCheck instanceof \Illuminate\Http\RedirectResponse) {
            return $ownershipCheck; 
        }
        $schedule = $ownershipCheck;

        $dayOrder = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];

        $serviceOrder = [
        'Netflix',
        'Crunchyroll',
        'Funimation',
        'Disney+',
        'HIDIVE',
        'Other',
        ];


        // Group items with the same day and time slot
        $groupedItems = [];
        foreach ($schedule->scheduleItems as $item) {
            $convertedDateTime = format_user_time_from_utc(date('H:i', strtotime($item->time)), $item->day);

            $groupedItems[$convertedDateTime['day']][$convertedDateTime['time']][] = $item;
        }

        // Sort days and services in a custom order
        $uniqueDays = collect(array_keys($groupedItems))->sortBy(function($day) use ($dayOrder) {
            return array_search($day, $dayOrder);
        });

        $uniqueServices = $schedule->scheduleItems->pluck('service')->unique()->sortBy(function($service) use ($serviceOrder) {
            return array_search($service, $serviceOrder);
        });



        return view('my-schedules.edit', compact('schedule', 'uniqueDays', 'uniqueServices', 'groupedItems'));
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
    // TODO: Check access vulnerability at $schedule fetch line
    private function checkOwnershipByScheduleName($season, $year) {
        $user = Auth::user();

        $schedule = Schedule::with('scheduleItems')->where('user_id', $user->id)->where('season', $season)->where('year', $year)->first();

        if($user->is_admin) {
            return $schedule;
        }

        if(!$schedule) {
            return Redirect::route('home')->with('error', 'This schedule does not exist.');
        }
        return $schedule;
    }

    // Checks if user owns the schedule or is an admin
    // TODO: Check access vulnerability at $schedule fetch line
    private function checkOwnershipByScheduleId($scheduleId) {
        $user = Auth::user();

        $schedule = Schedule::where('user_id', $user->id)->find($scheduleId);

        if($user->is_admin) {
            return $schedule;
        }

        if(!$schedule) {
            return Redirect::route('home')->with('error', 'This schedule does not exist.');
        }
        return $schedule;
    }
}
