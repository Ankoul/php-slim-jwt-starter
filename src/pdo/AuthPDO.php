<?php
namespace com\school\api\pdo;

use PDO;

require_once __DIR__ . '/SuperPDO.php';

class AuthPDO extends SuperPDO {

    public function login(array $credentials){
        $email = $credentials['user'];
        $pass = $credentials['password'];
        $stmt = $this->conn->prepare(
            "select email from `user` where `email` = :email and `password` = md5(:pass)"
        );
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function getUserForToken($username) {
        $stmt = $this->conn->prepare(
            "select id, nome, permissions from `user` where `email` = :email"
        );
        $stmt->bindParam(':email', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}