<?php

namespace App\Controllers;

use App\Services\SenderService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SenderController
{
    private $sender;

    public function __construct(SenderService $sender)
    {
        $this->sender = $sender;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        return $this->sender->sendEmailToSubscribers();
    }
}