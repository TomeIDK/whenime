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

        $response = $this->jikanService->getUpcomingAnime($page, 25);

        $upcoming = $response['data'];
        $pagination = $response['pagination'];
        return view('anime.explore', compact('upcoming', 'pagination'));
    }
}
