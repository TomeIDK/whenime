<?php

namespace App\Services;

use Carbon\Carbon;

class SeasonService {
    public function getCurrentSeason() {
        $currentMonth = date('n');

        switch ($currentMonth) {
            case 1:
            case 2:
            case 3:
                return 'Winter';
                break;

            case 4:
            case 5:
            case 6:
                return 'Spring';
                break;

            case 7:
            case 8:
            case 9:
                return 'Summer';
                break;

            case 10:
            case 11:
            case 12:
                return 'Fall';
                break;

            default:
                return null;
                break;
        }
    }

    public function getNextSeason() {
        $currentMonth = date('n');
        $currentYear = date('Y');

        $seasons = ['Winter', 'Spring', 'Summer', 'Fall'];
        $seasonIndex = (int)($currentMonth - 1) / 3;
        $nextSeasonIndex = ($seasonIndex + 1) % 4;
        $nextYear = $currentYear + (($nextSeasonIndex === 0) ? 1 : 0);

        $nextSeason = $seasons[$nextSeasonIndex];

        return [
            'year' => $nextYear,
            'season' => $nextSeason,
        ];
    }

    // Returns amount of days left until next season if less than 31 days remain
    public function getDaysUntilNextSeason() {
        $nextSeason = $this->getNextSeason();
        $year = $nextSeason['year'];

        switch (strtolower($nextSeason['season'])) {
            case 'winter':
                $month = 1;
                break;
            case 'spring':
                $month = 4;
                break;
            case 'summer':
                $month = 7;
                break;
            case 'fall':
                $month = 10;
                break;
            default:
                return -1;
        }

        $nextSeasonStart = Carbon::createFromDate($year, $month, 1);
        $now = Carbon::now();
        $interval = $now->diffInDays($nextSeasonStart);

        return round($interval) > 30 ? -1 : round($interval);
    }
}