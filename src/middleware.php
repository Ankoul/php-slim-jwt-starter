<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Tuupola\Middleware\HttpBasicAuthentication;


/**
 * Auth básica HTTP
 */
$app->add(new HttpBasicAuthentication([
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

$rotating = new RotatingFileHandler(__DIR__ . "/../logs/app.log", 0, Logger::DEBUG);
$logger = new Logger("slim");
$logger->pushHandler($rotating);

$config = parse_ini_file(__DIR__."/../config/config.ini");
$app->add(new Tuupola\Middleware\JwtAuthentication([
//    "path" => "/api", /* path to authenticate or array ["/api", "/admin"] */
//    "passthrough" => ["/auth"], /* path to NOT authenticate or array ["/auth", "/token"] */
    "regexp" => "/(.*)/",
    "logger" => $logger,
    "secret" => $config['JWT_SECRET'],
    "algorithm" => $config['JWT_ALGORITHM'], /* or ["HS256", "HS384"] */
    "rules" => [
        new Tuupola\Middleware\JwtAuthentication\RequestPathRule([
            "path" => "/api", /* path to authenticate or array ["/api", "/admin"] */
            "ignore" => ["/auth"] /* path to NOT authenticate  */
        ]),
        new Tuupola\Middleware\JwtAuthentication\RequestMethodRule([
            "ignore" => ["OPTIONS"] /* Method to NOT authenticate */
        ])
    ]
]));