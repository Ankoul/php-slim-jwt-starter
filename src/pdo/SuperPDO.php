<?php

namespace com\school\api\pdo;


use PDO;

class SuperPDO{

    protected $conn;

    public function __construct(){
        $config = parse_ini_file(__DIR__."/../../config/config.ini");

        $this->conn = new PDO(
            "mysql:host={$config['DBHOST']};dbname={$config['DBNAME']};charset=utf8",
            $config['USER'],
            $config['PASS']
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}