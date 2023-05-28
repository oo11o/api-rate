<?php

namespace App\Services\Api;

use App\Services\Api\ApiInterface;
use App\Services\Api\CoinGeckoApi;

class Api
{
    private $api;

    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }

    public function getRate()
    {
       return $this->api->getRate();
    }
}