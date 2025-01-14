<?php
class Conexion
{
    public static function conectar()
    {
        define("serverName", "localhost");
        define("user", "root");
        define("password", "");
        define("db", "academiafut");
        try {
            $conn = new PDO("mysql:host=" . serverName . ";dbname=" . db, user, password);
            return $conn;
        } catch (\Throwable $th) {
            echo "Error al conectar a la base de datos {$th}";
        }
    }
}
