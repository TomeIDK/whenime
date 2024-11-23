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

    public function getAnimeById($id) {
        return $this->makeRequest('anime/' . $id);
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

        // Get upcoming  anime (not yet airing)
        public function getUpcomingAnime($page = 1, $limitPerPage = 6) {
            $response = $this->makeRequest('seasons/upcoming', [
                'filter' => "tv",
                'sfw',
                'continuing',
                'page' => $page,
                'limit' => $limitPerPage,
            ]);
        
            return [
                'data' => $response['data'] ?? [],
                'pagination' => $response['pagination'] ?? [],
            ];
        }

        // Get top airing anime
        public function getTopAiringAnime($page = 1, $limitPerPage = 10) {

            $response = $this->makeRequest('top/anime', [
                'sfw',
                'filter' => 'airing',
                'type' => 'tv',
                'page' => $page,
                'limit' => $limitPerPage,
            ]);
    
            return [
                'data' => $response['data'] ?? [],
                'pagination' => $response['pagination'] ?? [],
            ];
        }

    // Get anime based on year and season
    public function getAnimeBySeason($year, $season, $page = 1, $limitPerPage = 6) {
        return $this->makeRequest("seasons/" . $year . "/" . $season, [
            'filter' => "tv",
            'sfw',
            'continuing',
            'page' => $page,
            'limit' => $limitPerPage,
        ]);
    }
}
