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
            $mysqli = new mysqli("localhost", "root", "", "bodyolimpus");
            if (mysqli_connect_errno()) {
                printf("Error de conexión: %s\n", mysqli_connect_error());
                exit();
            }
        } catch (\Throwable $e) {
            return 0;
        }
        return $mysqli;
    }
}
