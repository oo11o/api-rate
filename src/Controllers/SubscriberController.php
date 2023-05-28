<?php

namespace App\Controllers;

use App\Handlers\ResponseHandler;
use App\Services\SubscriberService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SubscriberController
{
    private $subscribeService;

    public function __construct(SubscriberService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $formData = $request->getParsedBody();
        return $this->subscribeService->addEmail($formData['email']);
    }
}