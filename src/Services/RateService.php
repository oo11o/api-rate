<?php

namespace App\Services;

use App\Handlers\ResponseHandler;
use App\Services\Api\Api;

class RateService
{
    private $responseHandler;
    private $apiService;

    public function __construct(ResponseHandler $responseHandler, Api $apiService)
    {
        $this->responseHandler = $responseHandler;
        $this->apiService = $apiService;
    }

    public function getRate()
    {
        $rate = $this->apiService->getRate();
        return $this->responseHandler->jsonResponse(['rate' => $rate]);
    }
};