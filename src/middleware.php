<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

/**
 * Auth básica HTTP
 */
$app->add(new \Tuupola\Middleware\HttpBasicAuthentication([
    /**
     * Usuários existentes
     */
    "users" => [
        "root" => "toor"
    ],
    /**
     * Blacklist - Deixa todas liberadas e só protege as dentro do array
     */
    "path" => ["/auth"],
    /**
     * Whitelist - Protege todas as rotas e só libera as de dentro do array
     */
    //"passthrough" => ["/auth/liberada", "/admin/ping"],
]));


$config = parse_ini_file(__DIR__."/../config/config.ini");
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "regexp" => "/(.*)/",
    "path" => "/api", /* or ["/api", "/admin"] */
    "secret" => $config['JWT_SECRET'],
    "algorithm" => $config['JWT_ALGORITHM'] /* or ["HS256", "HS384"] */
]));