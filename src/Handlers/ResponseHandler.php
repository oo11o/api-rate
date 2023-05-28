<?php

namespace App\Handlers;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Factory\ResponseFactory;

class ResponseHandler
{
    private $response;

    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    public function jsonResponse(array $data, int $statusCode = 200)
    {

        $response = $this->response->createResponse();

        $response = $response->withHeader('Content-Type', 'application/json');
        $response = $response->withStatus($statusCode);

        $jsonResponse = json_encode($data);
        $response->getBody()->write($jsonResponse);

        return $response;
    }
}
