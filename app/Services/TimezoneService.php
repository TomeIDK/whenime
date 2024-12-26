<?php

namespace App\Services;

use Carbon\Carbon;

class TimezoneService {
    // TODO: Validate time and day
    public function convertToUTC($time, $day, $timezone) {

        if (preg_match('/(AM|PM)$/i', $time)) {
            $formattedTime = Carbon::createFromFormat('g:i A', $time, $timezone)->format('H:i:s');
        } else {
            $formattedTime = $time;
        }

        $dateTime = Carbon::now($timezone)
            ->startOfWeek()
            ->modify($day)
            ->setTimeFromTimeString($formattedTime);

        return $dateTime->setTimezone('UTC');
    }

    public function getIanaTimezone($timezone) {
        return config("timezones.$timezone", 'UTC');
    }
}