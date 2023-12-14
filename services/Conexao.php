<?php

class Conexao {
    private static $URL_MYSQL = "mysql:host=localhost;dbname=paoc"; // Alterado para apontar para o MySQL local
    private static $USER = "root"; // Substitua com o nome de usuário do seu banco de dados
    private static $PASS = ""; // Substitua com a senha do seu banco de dados
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
