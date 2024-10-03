<?php

class Database
{
    protected static $db;
    private function __construct()
    {
        $db_host = "localhost";
        $db_nome = "petsocial";
        $db_usuario = "root";
        $db_senha = "";
        $db_driver = "mysql";

        try
        {
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            die("Connection Error: " . $e->getMessage());
        }
    }
    public static function connection()
    {
        if (!self::$db)
        {
            new Database();
        }
        return self::$db;
    }
}
?>