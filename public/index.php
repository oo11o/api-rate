<?php
require __DIR__ . '/../vendor/autoload.php';

// Register DI
$container = require __DIR__ . '/../config/container.php';

$app = \DI\Bridge\Slim\Bridge::create($container);

// Register routes
(require __DIR__ . '/../config/routes.php')($app);

$app->run();
