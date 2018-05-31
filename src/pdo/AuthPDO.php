<?php
namespace com\school\api\pdo;

use PDO;

require_once __DIR__ . '/SuperPDO.php';

class AuthPDO extends SuperPDO {

    public function login(array $credentials){
        $email = $credentials['user'];
        $pass = $credentials['password'];
        $stmt = $this->conn->prepare(
            "select id, nome from `user` where `email` = :email and `password` = md5(:pass) "
        );
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $user;
    }
}