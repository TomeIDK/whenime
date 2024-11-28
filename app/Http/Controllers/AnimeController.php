<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JikanService;
use App\Services\SeasonService;

class AnimeController extends Controller
{
    protected $jikanService;
    protected $seasonService;

    public function __construct(JikanService $jikanService, SeasonService $seasonService)
    {
        $this->jikanService = $jikanService;
        $this->seasonService = $seasonService;
    }

    public function index(Request $request) {
        $page = $request->get('page', 1);

        $airing = $this->jikanService->getTopAiringAnime($page, 6)['data'];

        $nextSeason = $this->seasonService->getNextSeason();
        $popularUpcoming = $this->jikanService->getAnimeBySeason($nextSeason['year'], $nextSeason['season'], $page, 6)['data'];
        usort($popularUpcoming, function ($a, $b) {
            return $a['popularity'] <=> $b['popularity'];
        });

        $daysUntilNextSeason = $this->seasonService->getDaysUntilNextSeason();
        $currentSeason = $this->seasonService->getCurrentSeason();

        return view('anime.explore', compact('airing', 'popularUpcoming', 'nextSeason', 'daysUntilNextSeason', 'currentSeason'));
    }

    public function show($id) {
        $anime = $this->jikanService->getAnimeById($id)['data'];
        $services = $this->jikanService->getAnimeServices($id)['data'];
        $supportedServices = ['Crunchyroll', 'Netflix', 'Disney+', 'Funimation', 'HIDIVE'];
        return view('anime.show', compact('anime', 'services', 'supportedServices'));
    }
}
