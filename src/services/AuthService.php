<?php

namespace com\school\api\services;

require_once __DIR__ . '/../pdo/AuthPDO.php';

use com\school\api\pdo\AuthPDO;
use DateTime;
use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;


class AuthService {

    private $container;
    private $PDO;

    public function __construct($container) {
        $this->container = $container;
        $this->PDO = new AuthPDO();
    }

    public function __invoke(array $credentials) {
        return $this->basicAuth($credentials);
    }

    public function basicAuth(array $credentials) {
        $this->container->logger->info("Trying to authenticate " . $credentials['user']);

        $user = $this->PDO->login($credentials);
        return !!$user && $user->email === $credentials['user'];
    }

    public function jwtAuth(Request $request, Response $response) {
        $config = parse_ini_file(__DIR__ . "/../../config/config.ini");

        $server = $request->getServerParams();
        $user = $this->PDO->getUserForToken($server["PHP_AUTH_USER"]);

        $now = new DateTime();
        $future = new DateTime("+30 minutes");
        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "sub" => $user
        ];
        $jwt = JWT::encode($payload, $config['JWT_SECRET'], $config['JWT_ALGORITHM']);
        $data["token"] = $jwt;
        $data["expires"] = $future->getTimeStamp();
        return $response->withJson($data, 201)
            ->withHeader('Content-type', 'application/json');
    }
}