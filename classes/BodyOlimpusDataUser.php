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

    public static function updateDataUserProfile($id_user, $first_name, $last_name, $email, $phone_number, $actual_weight, $last_update)
    {
        require(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("UPDATE bo_user SET first_name = :first_name, last_name = :last_name, email = :email, phone_number = :phone_number, actual_weight = :actual_weight, last_update = :last_update WHERE bo_user.id_user = :id_user");
        $sql->bindParam(':id_user', $id_user);
        $sql->bindParam(':first_name', $first_name);
        $sql->bindParam(':last_name', $last_name);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':phone_number', $phone_number);
        // $sql->bindParam(':gender', $gender);
        // $sql->bindParam(':exercise_space', $exercise_space);
        $sql->bindParam(':actual_weight', $actual_weight);
        $sql->bindParam(':last_update', $last_update);

        if ($sql->execute()) {
            $message = "Datos de usuario actualizado";
        } else {
            $message = "Error al actualizar los datos de usuario";
        }

        // $sql->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        // $sql = null; // obligado para cerrar la conexión

        return $message;
    }

    public static function getDataUserProfile($id_user)
    {
        require(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->query("SELECT * FROM `bo_user` WHERE id_user = $id_user");
        // $sql->bindParam(':id_user', $id_user);
        $rows = $sql->fetchAll();
        return $rows[0];
    }
}
