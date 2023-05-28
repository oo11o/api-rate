<?php

namespace App\Services\Api;

use GuzzleHttp\Client;
use Exception;

class CoinGeckoApi implements ApiInterface
{
    private $httpClient;
    private $apiUrl;

    public function __construct(Client $httpClient, string $apiUrl = 'https://api.coingecko.com/api/v3/simple/price?')
    {
        $this->httpClient = $httpClient;
        $this->apiUrl = $apiUrl;
    }

    public function getRate(string $coin = 'bitcoin', string $currency='uah'): int
    {
        $urlRequestApi = $this->createUrlRequest(
            [
                'ids' => $coin,
                'vs_currencies'=> $currency
            ]);

        $response = $this->httpClient->request('GET', $urlRequestApi);

        if ($response->getStatusCode() !== 200) {
            throw new Exception("There was an error Api Resolve");
        }

        return json_decode($response->getBody()->getContents(), TRUE)[$coin][$currency];
    }

    private function createUrlRequest(array $arguments): string
    {
        $queries = array_map(
            fn($ind, $items) => "{$ind}={$items}",
            array_keys($arguments),
            $arguments
        );

        return $this->apiUrl.implode('&', $queries);
    }
}