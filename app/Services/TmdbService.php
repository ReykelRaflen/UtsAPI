<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TmdbService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('TMDB_API_KEY');
        $this->baseUrl = 'https://api.themoviedb.org/3';
    }

    public function getPopularMovies($page = 1)
    {
        try {
            $response = $this->client->request('GET', "{$this->baseUrl}/movie/popular", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'language' => 'en-US',
                    'page' => $page
                ],
                'verify' => false
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['results' => [], 'error' => $e->getMessage()];
        }
    }

    public function searchMovies($query)
    {
        try {
            $response = $this->client->request('GET', "{$this->baseUrl}/search/movie", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'query' => $query,
                    'language' => 'en-US'
                ],
                'verify' => false
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['results' => [], 'error' => $e->getMessage()];
        }
    }
}
