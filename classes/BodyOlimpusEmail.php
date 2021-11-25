<?php
class BodyOlimpusEmail
{
    public static function resetPasswordEmail($id_user, $password)
    {
        require_once(__DIR__ . '/db/DB.php');
        $sql = DB::DBconnect()->prepare("UPDATE bo_user SET passwd = :passwd WHERE bo_user.id_user = :id_user;");
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql->bindParam(':passwd', $password);
        $sql->bindParam(':id_user', $id_user);
        if ($sql->execute()) {
            $message = "Contraseña actualizada";
        } else {
            $message = "Error al actualizar la contraseña";
        }
        return $message;
    }

    public static function existsEmail($email)
    {
        require_once(__DIR__ . '/db/DB.php');
        $sql = DB::DBconnect()->query("SELECT id_user FROM `bo_user` WHERE email ='$email'");
        $rows = $sql->fetchAll();
        if (!isset($rows) || $rows == false || $rows == null) {
            $rows = 0;
        }else{
            $rows = $rows[0];
        }
        return $rows;
    }

}
