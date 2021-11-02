<?php
class BodyOlimpusDataUser
{
    public static function updateGender($gender, $id_user)
    {
        require(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("UPDATE bo_user SET gender = :gender WHERE bo_user.id_user = :id_user;");
        $sql->bindParam(':gender', $gender);
        $sql->bindParam(':id_user', $id_user);
        if ($sql->execute()) {
            $message = "Genero actualizado";
        } else {
            $message = "Error al actualizar el genero";
        }
        return $message;
    }
}
