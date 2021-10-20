<?php
class DB {
    public $host = "localhost";
    public $user = "root";
    public $pass = ""; //Aklsd@$&%Sd@akls
    public $bd = "bodyolimpus";
    
    public static function connect()
    {
        $objCnx = new mysqli("localhost", "root", "", "bodyolimpus");
        if ($objCnx->connect_errno) {
            echo "Error de conexion a la base de datos" . $objCnx->connect_error;
            exit();
        } else {
            return $objCnx;
        }
    }
}


