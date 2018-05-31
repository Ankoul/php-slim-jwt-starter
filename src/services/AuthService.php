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
        if ($user) {
            $server["PHP_AUTH_USER"] = $user;
        }
        return !!$user;
    }

    public function jwtAuth(Request $request, Response $response) {
        $config = parse_ini_file(__DIR__ . "/../../config/config.ini");

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
    }
}