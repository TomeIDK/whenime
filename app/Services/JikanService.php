<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class JikanService {
    protected $client;
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = 'https://api.jikan.moe/v4/';
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'timeout' => 5.0,
        ]);
    }

    protected function makeRequest($endpoint, $params = []) {
        try {
            $response = $this->client->get($endpoint, [
                'query' => $params
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    // Search for anime with given query, optionally filter by airing status
    public function searchAnimeByName($query, $isAiringOnly = false) {
        $params = [
            'q' => $query
        ];

        if($isAiringOnly) {
            $params['status'] = 'airing';
        }

        return $this->makeRequest('anime', ['q'=> $query]);
    }

    // Get upcoming anime (not yet airing)
    public function getUpcomingAnime($page = 1, $limitPerPage = 25) {
        $response = $this->makeRequest('seasons/upcoming', [
            'page' => $page,
            'limit' => $limitPerPage,
        ]);

        return [
            'data' => $response['data'] ?? [],
            'pagination' => $response['pagination'] ?? [],
        ];
    }

    // Get anime based on year and season
    public function getAnimeBySeason($year, $season) {
        return $this->makeRequest("seasons/" . $year . "/" . $season);
    }

    // Get anime details by id
    public function getAnimeDetails($id) {
        return $this->makeRequest("anime/" . $id);
    }

    // Get anime by genre
    public function getAnimeByGenre($genre) {
        return $this->makeRequest('anime', ['genre' => $genre]);
    }

    // TODO: get anime list by user id
    public function getUserAnimeList($id) {
        
    }
}
