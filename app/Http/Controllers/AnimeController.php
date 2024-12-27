<?php

namespace App\Http\Controllers;

use App\Models\ScheduleItem;
use Illuminate\Http\Request;
use App\Services\JikanService;
use App\Services\SeasonService;
use App\Services\TimezoneService;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class AnimeController extends Controller
{
    protected $jikanService;
    protected $seasonService;
    protected $timezoneService;

    public function __construct(JikanService $jikanService, SeasonService $seasonService, TimezoneService $timezoneService)
    {
        $this->jikanService = $jikanService;
        $this->seasonService = $seasonService;
        $this->timezoneService = $timezoneService;
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

        // Convert airing time and day UTC
        $airingUTC = $this->timezoneService->convertToUTC($anime['broadcast']['time'], substr($anime['broadcast']['day'], 0, -1), 'Asia/Tokyo');

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

        // Get season and year
        $userId = Auth::id();
        $season = strtoupper($anime['season'][0]) . substr($anime['season'], 1);
        $year = $anime['year'];

        // Find schedule or create one if not exists
        $schedule = Schedule::firstOrCreate([
            'user_id' => $userId,
            'season' => $season,
            'year' => $year,
        ]);

        // Store item in corresponding schedule
        $scheduleItem = new ScheduleItem([
            'anime_id' => $anime['mal_id'],
            'name' => $title,
            'day' => $airingUTC->format('l'),
            'time' => $airingUTC->format('H:i:s'),
            'service' => $service,
        ]);
        $schedule->scheduleItems()->save($scheduleItem);

        return redirect()->back()->with('success', "$title successfully added to $season $year");
    }
}
