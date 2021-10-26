<?php
class BodyOlimpusLogin
{
    public static function getLoging($email, $pass)
    {
        require(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("SELECT id_user, email, passwd FROM bo_user where email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }

    public static function setUser($email, $pass)
    {
        require(__DIR__ . './db/DB.php');

        $sql = DB::DBconnect()->prepare("INSERT INTO bo_user (email, passwd) VALUES (:email, :passwd)");
        $sql->bindParam(':email', $email);
        $passwd = password_hash($pass, PASSWORD_BCRYPT);
        $sql->bindParam(':passwd', $passwd);
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
