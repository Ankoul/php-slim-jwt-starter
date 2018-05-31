<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;

// Routes


/**
 * HTTP Auth - Autenticação minimalista para retornar um JWT
 */
$app->get('/auth', function (Request $request, Response $response) use ($app) {
    $config = parse_ini_file(__DIR__."/../config/config.ini");

    $now = new DateTime();
    $future = new DateTime("+30 minutes");
    $server = $request->getServerParams();
    $payload = [
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
        "sub" => $server["PHP_AUTH_USER"]
    ];
    $jwt = JWT::encode($payload, $config['JWT_SECRET'], $config['JWT_ALGORITHM']);
    $data["token"] = $jwt;
    $data["expires"] = $future->getTimeStamp();
    return $response->withJson($data, 201)
        ->withHeader('Content-type', 'application/json');
});


$app->get('/api/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
