<?php
abstract class DB
{
    public $host = "localhost";
    public $user = "root";
    public $pass = ""; //Aklsd@$&%Sd@akls
    public $bd = "bodyolimpus";

    public static function DBconnect()
    {
        try {
            $connection = new PDO("localhost", "root", "", "bodyolimpus");
        } catch (PDOException $e) {
            die('Connected failed: ' .$e->getMessage());
        }
        return $connection;
    }
}
