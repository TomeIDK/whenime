<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

    /**
     * Convert the time to the user's timezone and format
     * 
     * @param string $time  The time to convert (in UTC)
     * @return string   The formatted time
    */
    function format_user_time_from_jst($time, $day = null) {
        $user = Auth::user();

        if(!$user) {
            return $time;
        }

        // Get user settings
        $timezone = $user->settings->timezone ?? 'UTC';
        $timeFormat = $user->settings->time_format ?? '24h';

        // Get corresponding IANA timezone
        $ianaTimezone = config("timezones.$timezone", 'UTC');

        // Set timezone
        try {
            if ($day) {
                $datetime = "next $day $time";
            } else {
                $datetime = "today $time";
            }

            $dateTimeJST = Carbon::parse($datetime, 'Asia/Tokyo');

            $convertedDateTime = $dateTimeJST->timezone($ianaTimezone);

            $formattedTime = $timeFormat == '12h'
            ? $convertedDateTime->format('h:i A')
            : $convertedDateTime->format('H:i');

            $formattedDay = $convertedDateTime->format('l');

            return [
                'day' => $formattedDay,
                'time' => $formattedTime
            ];
        } catch (Exception $e) {
            return ['day' => null, 'time' => $time];
        }
    } 

       function format_user_time_from_utc($time, $day = null) {
        $user = Auth::user();

        if(!$user) {
            return $time;
        }

        // Get user settings
        $timezone = $user->settings->timezone ?? 'UTC';
        $timeFormat = $user->settings->time_format ?? '24h';

        // Get corresponding IANA timezone
        $ianaTimezone = config("timezones.$timezone", 'UTC');

        // Set timezone
        try {
            if ($day) {
                $datetime = "next $day $time";
            } else {
                $datetime = "today $time";
            }

            $dateTimeJST = Carbon::parse($datetime, 'UTC');

            $convertedDateTime = $dateTimeJST->timezone($ianaTimezone);

            $formattedTime = $timeFormat == '12h'
            ? $convertedDateTime->format('h:i A')
            : $convertedDateTime->format('H:i');

            $formattedDay = $convertedDateTime->format('l');

            return [
                'day' => $formattedDay,
                'time' => $formattedTime
            ];
        } catch (Exception $e) {
            return ['day' => null, 'time' => $time];
        }
    }

