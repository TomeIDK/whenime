<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JikanService;

class AnimeController extends Controller
{
    protected $jikanService;

    public function __construct(JikanService $jikanService)
    {
        $this->jikanService = $jikanService;
    }

    public function index(Request $request) {
        $page = $request->get('page', 1);

        $airing = $this->jikanService->getTopAiringAnime($page, 6)['data'];

        $nextSeason = $this->getNextSeason();
        $popularUpcoming = $this->jikanService->getAnimeBySeason($nextSeason['year'], $nextSeason['season'], $page, 6)['data'];
        usort($popularUpcoming, function ($a, $b) {
            return $a['popularity'] <=> $b['popularity'];
        });

        return view('anime.explore', compact('airing', 'popularUpcoming'));
    }

    public function getNextSeason() {
        $currentMonth = date('n');
        $currentYear = date('Y');

        $seasons = ['winter', 'spring', 'summer', 'fall'];
        $seasonIndex = (int)($currentMonth - 1) / 3;
        $nextSeasonIndex = ($seasonIndex + 1) % 4;
        $nextYear = $currentYear + (($nextSeasonIndex === 0) ? 1 : 0);

        $nextSeason = $seasons[$nextSeasonIndex];

        return [
            'year' => $nextYear,
            'season' => $nextSeason,
        ];
    }
}
