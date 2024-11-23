<?php

namespace App\Services;

use Carbon\Carbon;
use InvalidArgumentException;
use Illuminate\Support\Collection;

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

    // Check if season is ended, airing or upcoming
    public function getSeasonStatus($season, $year) {
        $currentSeason = $this->getCurrentSeason();
        $currentYear = date('Y');
        $status = "Airing";

        if ($year < $currentYear) {
            $status = "Ended";
        }

        if ($year > $currentYear) {
            $status = "Upcoming";
        }

        if ($year == $currentYear && $this->compareSeasons($season, $currentSeason) == 0) {
           $status = "Ended";
        }

        if ($year == $currentYear && $this->compareSeasons($season, $currentSeason) == 1) {
           $status = "Upcoming";
        }

        return $status;
    }

    // Compares if $season1 comes before (0), after (1) or is the same (2) as $season2
    public function compareSeasons($season1, $season2) {
        $seasonOrder = [
            "Winter" => 0,
            "Spring" => 1,
            "Summer" => 2,
            "Fall" => 3,
        ];

        if (!isset($seasonOrder[$season1])){
            throw new InvalidArgumentException("Invalid season provided.");
        }

        if ($seasonOrder[$season1] < $seasonOrder[$season2]) {
            return 0;
        } else if ($seasonOrder[$season1] > $seasonOrder[$season2]) {
            return 1;
        } else if  ($seasonOrder[$season1] == $seasonOrder[$season2]) {
            return 2;
        }
    }

    public function sortNewToOld($schedules) {
        return $schedules->sortBy(function ($schedule) {
            $seasonOrder = ['Winter', 'Spring', 'Summer', 'Fall'];
            $seasonIndex = array_search($schedule->season, $seasonOrder);

            return [$schedule->year, $seasonIndex];
        });
    }

    public function sortOldToNew($schedules) {
        return $schedules->sortByDesc(function ($schedule) {
            $seasonOrder = ['Winter', 'Spring', 'Summer', 'Fall'];
            $seasonIndex = array_search($schedule->season, $seasonOrder);

            return [$schedule->year, $seasonIndex];
        });
    }
}