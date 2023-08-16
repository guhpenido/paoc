<?php

class Conexao {
    private static $URL_MYSQL = "mysql:host=paoc.cjpzfmkc7gea.us-east-1.rds.amazonaws.com;dbname=paoc";
    private static $USER = "admin";
    private static $PASS = "LRnl51K5Df8jeGxccnEhezJMtROQSLRcaAqX";
    private static $DRIVER_OPTIONS = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    public static function getConnection() {
        try {
            return new PDO(self::$URL_MYSQL, self::$USER, self::$PASS, self::$DRIVER_OPTIONS);
        } catch (PDOException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}

?>