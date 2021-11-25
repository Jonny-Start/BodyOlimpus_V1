<?php
abstract class DB
{
    public static function DBconnect()
    {
        $server = "localhost";
        $username = "root";
        $password = ""; //Aklsd@$&%Sd@akls
        $database = "bodyolimpus";

        // $server = "sql200.epizy.com";
        // $username = "epiz_30410897";
        // $password = "ZROHnZFjC0z";
        // $database = "epiz_30410897_bodyolimpus";

        try {
            $connection = new PDO("mysql:host=$server; dbname=$database;",$username,$password);
        } catch (PDOException $e) {
            die('Connected failed: ' .$e->getMessage());
        }
        return $connection;
    }
}
