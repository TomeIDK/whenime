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

    public function getAnimeServices($id) {
        return $this->makeRequest("anime/" . $id . "/streaming");
    }
}
