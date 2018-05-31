<?php

namespace com\school\api\services;

require_once __DIR__ . '/../pdo/AuthPDO.php';
use com\school\api\pdo\AuthPDO;

class AuthService {

    private $logger;
    private $PDO;

    public function __construct($logger){
        $this->logger =  $logger;
        $this->PDO = new AuthPDO();
    }

    public function __invoke(array $credentials) {
        return $this->login($credentials);
    }

    public function login(array $credentials){
        /** @noinspection PhpUndefinedMethodInspection */
        $this->logger->info("Trying to authenticate " . $credentials['user']);

        $user = $this->PDO->login($credentials);
        if($user){
            $server["PHP_AUTH_USER"] = $user;
        }
        return !!$user;
    }
}