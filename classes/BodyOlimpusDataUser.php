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

    public static function updatePlace($place, $id_user)
    {
        require(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("UPDATE bo_user SET exercise_space = :place WHERE bo_user.id_user = :id_user;");
        $sql->bindParam(':place', $place);
        $sql->bindParam(':id_user', $id_user);
        if ($sql->execute()) {
            $message = "Espacio de ejercicio actualizado";
        } else {
            $message = "Error al actualizar el espacio de ejercicio";
        }
        return $message;
    }
}
