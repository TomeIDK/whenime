<?php

namespace App\Http\Controllers;

use App\Models\ScheduleItem;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScheduleItemController extends Controller
{
    public function store(Request $request, $season, $year): RedirectResponse
    {
        $request->validate([
            "name" => [
                'required',
                'string',
                'max:255',
            ],
            "day" => [
                'required',
                'string',
                'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',            
            ],
            "time" => [
                'required',
                'date_format:H:i',
            ],
            "service" => [
                'required',
                'string',
                'in:Netflix,HIDIVE,Disney+,Funimation,Crunchyroll,Other',
            ],
        ]);

        $scheduleId = Schedule::where('season', $season)
            ->where('year', $year)
            ->where('user_id', Auth::id())
            ->value('id');

        if (!$scheduleId) {
            return Redirect::route('my-schedules')->with('error', 'Could not find selected schedule');
        }

        ScheduleItem::create([
            'schedule_id' => $scheduleId,
            'name' => $request->name,
            'day' => $request->day,
            'time' => $request->time,
            'service' => $request->service,
        ]);

        return Redirect::route('my-schedules.edit', [$season, $year])->with('success', 'Anime added successfully to ' . $season . " " . $year);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $scheduleItem = ScheduleItem::find($id);

        if (!$scheduleItem) {
            return Redirect::route('my-schedules')->with('error', 'Schedule item not found.');
        }

        $ownershipCheck = $this->checkOwnershipByScheduleId($scheduleItem->schedule_id);

        if ($ownershipCheck instanceof \Illuminate\Http\RedirectResponse) {
            return $ownershipCheck; 
        }

        $request->validate([
            "name" => [
                'required',
                'string',
                'max:255',
            ],
            "day" => [
                'required',
                'string',
                'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',            
            ],
            "time" => [
                'required',
                'date_format:H:i',
            ],
            "service" => [
                'required',
                'string',
                'in:Netflix,HIDIVE,Disney+,Funimation,Crunchyroll,Other',
            ],
        ]);

        $scheduleItem->name = $request->name;
        $scheduleItem->day = $request->day;
        $scheduleItem->time = $request->time;
        $scheduleItem->service = $request->service;

        $scheduleItem->save();

        return Redirect::route('my-schedules.edit', [$ownershipCheck->season, $ownershipCheck->year])->with('success', 'Anime updated successfully!');
    }

    public function destroy($id): RedirectResponse 
    {
        $scheduleItem = ScheduleItem::find($id);

        if (!$scheduleItem) {
            return Redirect::route('my-schedules')->with('error', 'Schedule item not found.');
        }

        $ownershipCheck = $this->checkOwnershipByScheduleId($scheduleItem->schedule_id);

        if ($ownershipCheck instanceof \Illuminate\Http\RedirectResponse) {
            return $ownershipCheck; 
        }

        $scheduleItem->delete();

        return Redirect::route('my-schedules.edit', [$ownershipCheck->season, $ownershipCheck->year])->with('success', 'Item deleted successfully!');
    }

    // Checks if user owns the schedule the item belongs to or is an admin
    private function checkOwnershipByScheduleId($scheduleId) {
        $user = Auth::user();

        $schedule = Schedule::where('user_id', $user->id)->find($scheduleId);

        if($user->is_admin) {
            return $schedule;
        }

        if(!$schedule) {
            return Redirect::route('home')->with('error', 'You do not have access to this schedule item.');
        }
        return $schedule;
    }
}
