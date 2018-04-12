<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

/**
 * Class NewsApi
 * @package App\Services
 */
class NewsApi {

    private $apiKey;
    private $apiUrl = 'https://newsapi.org/v2/';
    private $minutes = 10;

    /**
     * NewsApi constructor.
     */
    public function __construct(){
        $this->apiKey = config('services.newsapi.key');
    }

    private function get(string $endpoint, string $query): string
    {
        $uri = $this->apiUrl . $endpoint . '?pageSize=100&language=nl&apiKey=' . $this->apiKey . '&' . $query;
        $hash = hash('sha256', $uri);
        $data = Cache::get($hash, function () use ($hash, $uri) {
            $client = new Client([
                'headers' => [
                    'Accept' => 'application/xml',
                    'Content-type' => 'application/xml'
                ],
            ]);
            $request = $client->get($uri);
            if ($request->getStatusCode() !== 200) {
                return null;
            }
            $data = (string)$request->getBody();
            Cache::put($hash, $data, $this->minutes);
            return $data;
        });
        return $data;
    }

    /**
     * @param string $q
     * @return string
     */
    public function query(string $q): string
    {
        return $this->get('everything', 'q='.$q);
    }

}