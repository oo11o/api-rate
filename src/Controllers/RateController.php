<?php

namespace App\Controllers;

use App\Services\RateService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RateController
{
    private $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }

    public function index(Request $request, Response $response): Response
    {
        return  $this->rateService->getRate();
    }

    public function badRequest(Request $request, Response $response): Response
    {
        $response = $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        $response->getBody()->write(json_encode(['error' => 'Invalid status value']));
        return $response;
    }
}