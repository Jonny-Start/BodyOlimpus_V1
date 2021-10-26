<?php
class BodyOlimpusLogin
{
    public static function getLoging($email, $pass)
    {
        require(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("SELECT id, email, passwd FROM bo_user where email = :email and passwd = :passwd");
        $sql->bindParam(':email', $email, ':passwd', $pass);
        $sql->execute();
        $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }

    public static function estaConected()
    {
        $result = DB::DBconnect();
        return $result;
    }
}
