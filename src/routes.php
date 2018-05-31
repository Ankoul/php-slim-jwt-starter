<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


/**
 * HTTP Auth - Autenticação minimalista para retornar um JWT
 */
$app->get('/auth', function (Request $request, Response $response) use ($app) {
    return $response->withJson(["status" => "Autenticado!"], 200)
        ->withHeader('Content-type', 'application/json');
});


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
