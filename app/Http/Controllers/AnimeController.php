<?php

namespace App\Http\Controllers;

use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use App\Services\JikanService;
use App\Services\SeasonService;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

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

    public function store($id) {
        $anime = $this->jikanService->getAnimeById($id)['data'];

        $title = $anime['titles'][array_search('English', array_column($anime['titles'], 'type'))]['title'] 
        ?? $anime['titles'][array_search('Default', array_column($anime['titles'], 'type'))]['title'];

        // Get first supported streaming service
        $supportedServices = config('streaming');
        $services = $this->jikanService->getAnimeServices($id)['data'];
        $service = 'Other';
        foreach ($services as $platform) {
            if (in_array($platform['name'], $supportedServices)){
                $service = $platform['name'];
                break;
            }
        }

        $userId = Auth::id();
        $season = strtoupper($anime['season'][0]) . substr($anime['season'], 1);
        $year = $anime['year'];

        $schedule = Schedule::firstOrCreate([
            'user_id' => $userId,
            'season' => $season,
            'year' => $year,
        ]);

        $scheduleItem = new ScheduleItem([
            'name' => $title,
            'day' => substr($anime['broadcast']['day'], 0, -1),
            'time' => $anime['broadcast']['time'],
            'service' => $service,
        ]);

        $schedule->scheduleItems()->save($scheduleItem);
        return redirect()->back()->with('success', "$title successfully added to $season $year");
    }
}
