<?php
require_once((__DIR__) . '/db/DB.php');
class BodyOlimpusLoginAdmin extends DB
{
    public static function getLogingAdmin($username, $pass)
    {
        $sql = DB::DBconnect()->prepare("SELECT id_userAdmin, username, pass FROM bo_admin where username = :username");
        $sql->bindParam(':username', $username);
        $sql->execute();
        $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }

    public static function setUser($first_name, $last_name, $username, $pass)
    {        
        $createAccount_date = date("Y-m-d");

        $sql = DB::DBconnect()->prepare("INSERT INTO bo_user (first_name, last_name, username, passwd, createAccount_date) VALUES (:first_name, :last_name, :username, :passwd, :createAccount_date)");
        $sql->bindParam(':first_name', $first_name);
        $sql->bindParam(':last_name', $last_name);
        $sql->bindParam(':username', $username);
        $passwd = password_hash($pass, PASSWORD_BCRYPT);
        $sql->bindParam(':passwd', $passwd);
        $sql->bindParam(':createAccount_date', $createAccount_date);
        if ($sql->execute()) {
            $message = "Usuario Creado";
        } else {
            $message = "Error para crearlo";
        }
        return $message;
    }

    public static function estaConected()
    {
        $result = DB::DBconnect();
        return $result;
    }
}
