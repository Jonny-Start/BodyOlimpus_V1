<?php
class BodyOlimpusDataUser
{
    public static function updateGender($gender, $id_user)
    {
        require_once(__DIR__ . './db/DB.php');
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
        require_once(__DIR__ . './db/DB.php');
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

    public static function updateDataUserProfile($id_user, $first_name, $last_name, $height_user, $date_nac, $email, $phone_number, $last_update)
    {
        require_once(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("UPDATE bo_user SET first_name = :first_name, last_name = :last_name, height_user = :height_user, date_nac = :date_nac, email = :email, phone_number = :phone_number, last_update = :last_update WHERE bo_user.id_user = :id_user");
        $sql->bindParam(':id_user', $id_user);
        $sql->bindParam(':first_name', $first_name);
        $sql->bindParam(':last_name', $last_name);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':phone_number', $phone_number);
        $sql->bindParam(':height_user', $height_user);
        $sql->bindParam(':date_nac', $date_nac);
        $sql->bindParam(':last_update', $last_update);
        if ($sql->execute()) {
            $message = "Datos de usuario actualizado";

            $sqli = DB::DBconnect()->query("SELECT * FROM `bo_user` WHERE id_user = $id_user");
            $rows = $sqli->fetchAll();
            $rows[0];

            $result = [
                'message' => $message,
                'dataUser' => $rows[0]
            ];

        } else {
            $message = "Error al actualizar los datos de usuario";
            $sqli = DB::DBconnect()->query("SELECT * FROM `bo_user` WHERE id_user = $id_user");
            $rows = $sqli->fetchAll();
            $rows[0];

            $result = [
                'message' => $message,
                'dataUser' => $rows[0]
            ];
        }
        return $result;
    }

    public static function getDataUserProfile($id_user)
    {
        require_once(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->query("SELECT * FROM `bo_user` WHERE id_user = $id_user");
        // $sql->bindParam(':id_user', $id_user);
        $rows = $sql->fetchAll();
        return $rows;
    }

    public static function addWeight($weight, $id_user)
    {
        $date_weight = date("Y-m-d");
        require_once(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->query("INSERT INTO bo_weight (`id_weight`, `weight`, `id_user`, `date_weight`) VALUES (NULL, '$weight', '$id_user', '$date_weight')");
        $sqli = DB::DBconnect()->query("UPDATE bo_user SET actual_weight = '$weight' WHERE bo_user.id_user = '$id_user'");
        if (($sql->fetchAll()) > 0) {
            $message = "Peso registrado pero no se actualizo en tu perfil";
            if(($sqli->fetchAll()) > 0){
                $message = "Peso actualizado y registrado en tu perfil";
            }
        } else {
            $message = "Error al actualizar el Peso";
        }
        return $message;
    }

    public static function getDataUserIMC($id_user)
    {
        require_once(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->query("SELECT actual_weight, height_user, gender FROM `bo_user` WHERE id_user = $id_user");
        $rows = $sql->fetchAll();
        if(!empty($rows)){ 
            $rows = $rows[0];
        }else{
            $rows = '';
        }
        return $rows;
    }

    public static function getDataUserChart($id_user)
    {
        require_once(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->query("SELECT weight as peso, date_weight as fecha FROM bo_weight WHERE id_user ='$id_user'");
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public static function getPass($id_user)
    {
        require_once(__DIR__ . './db/DB.php');
        $sql = DB::DBconnect()->prepare("SELECT passwd FROM bo_user where id_user = :id_user");
        $sql->bindParam(':id_user', $id_user);
        $sql->execute();
        $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }

    public static function resetPassword($id_user, $password)
    {
        require_once(__DIR__ . './db/DB.php');
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

}
