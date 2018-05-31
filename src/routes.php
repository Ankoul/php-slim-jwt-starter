<?php

use com\school\api\services\AuthService;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/auth', AuthService::class . ':jwtAuth');

$app->get('/api/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route " . $args['name']);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
