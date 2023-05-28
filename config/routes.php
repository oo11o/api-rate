<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;


use Slim\App;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $app) {
        $app->get('/rate', [\App\Controllers\RateController::class, 'index']);
        $app->get('/rate{param:.+}', [\App\Controllers\RateController::class, 'badRequest']);

        $app->post('/subscribe', \App\Controllers\SubscriberController::class);
        $app->post('/sendemails', \App\Controllers\SenderController::class);
    });

    $app->get('/example', function (Request $request, Response $response, $args) {
        throw new HttpNotFoundException($request);
    });
};
