<?php
abstract class DB
{
    static private $server = "localhost";
    static private $username = "root";
    static private $password = ""; //Aklsd@$&%Sd@akls
    static private $database = "bodyolimpus";

    // static private $server = "sql200.epizy.com";
    // static private $username = "epiz_30410897";
    // static private $password = "ZROHnZFjC0z";
    // static private $database = "epiz_30410897_bodyolimpus";

    public static function DBconnect()
    {
        try {
            $connection = new PDO("mysql:host=".static::$server."; dbname=".static::$database.";",static::$username,static::$password);
            // $connection = new PDO("mysql:host=$server; dbname=$database;",$username,$password);
        } catch (PDOException $e) {
            die('Connected failed: ' .$e->getMessage());
        }
        return $connection;
    }
}
