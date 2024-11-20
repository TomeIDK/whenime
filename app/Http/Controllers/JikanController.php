<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JikanService;

class JikanController extends Controller
{
    protected $jikanService;

    public function __construct(JikanService $jikanService){
        $this->jikanService = $jikanService;
    }

    public function search(Request $request) {
        $query = $request->query;
        $isAiringOnly = $request->isAiringOnly;
        $data = $this->jikanService->searchAnimeByName($query, $isAiringOnly);

        return $data;
    }
}
