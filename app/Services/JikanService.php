<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;

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

    protected function makeRequest($endpoint, $params = [], $retries = 0) {
        try {
            // Check if data is cached
            $cacheKey = 'jikan_' . md5($endpoint . json_encode($params));
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }

            // Make Jikan API request
            $response = $this->client->get($endpoint, [
                'query' => $params
            ]);

            // Success (200)
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody()->getContents(), true);

                // Cache response for 24 hours
                Cache::put($cacheKey, $data, now()->addHours(24));

                return $data;
            }

            // Bad Request (400)
            if ($response->getStatusCode() === 400) {
                return ['error' => 'Bad Request'];
            }

            // Not Found (404)
            if ($response->getStatusCode() === 404) {
                return ['error' => 'Not Found'];
            }

            throw new \Exception("Unexpected status code: " . $response->getStatusCode());

        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
            
        // Rate Limited (429)
        } catch (\Exception $e) { 
            if ($e->getCode() === 429) {
                if ($retries < 3) {
                    $waitTime = pow(2, $retries);
                    sleep($waitTime);
                    return $this->makeRequest($endpoint, $params, $retries + 1);
                }

                return ['error' => 'Rate-limited, max retries reached'];
            }

            // Internal Server Error (500 & 503)
            return [
                'error' => true, 
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getAnimeById($id) {
        return $this->makeRequest('anime/' . $id);
    }

    // Search for anime by name (Japanese title)
    // params: TV, sfw, ordered start_date desc,
    public function searchAnimeByName($query, $onlyAiringAndUpcoming = false, $limitPerPage = 9, $page = 1) {
        $params = [
            'q' => $query,
            'type' => 'tv',
            'sfw',
            'limit' => $limitPerPage,
            'page' => $page,
            'order_by' => 'mal_id',
            'sort' => 'desc',
        ];

        if($onlyAiringAndUpcoming) {
            $airingResponse = $this->makeRequest('anime', array_merge($params, ['status' => 'airing']));
            $upcomingResponse = $this->makeRequest('anime', array_merge($params, ['status' => 'upcoming']));

            $combinedResults = array_merge($airingResponse['data'] ?? [], $upcomingResponse['data'] ?? []);
        } else {
            $combinedResults = $this->makeRequest('anime', $params)['data'] ?? [];
        }

                    $uniqueResults = [];
            foreach ($combinedResults as $anime) {
                $uniqueResults[$anime['mal_id']] = $anime;
            }
            $finalResults = array_values($uniqueResults);

        if (empty($finalResults)) {
            return [
                'data' => [],
                'total' => 0,
                'current_page' => $page,
                'last_page' => 1,
            ];
        }


            $totalResults = count($finalResults);
            $offset = ($page - 1) * $limitPerPage;
            $paginatedResults = array_slice($finalResults, $offset, $limitPerPage);

            return [
                'data' => $paginatedResults,
                'total' => $totalResults,
                'current_page' => $page,
                'last_page' => ceil($totalResults / $limitPerPage),
            ];
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

    public function getAnimeServices($id) {
        return $this->makeRequest("anime/" . $id . "/streaming");
    }
}
