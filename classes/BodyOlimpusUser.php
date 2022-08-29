<?php
require_once((__DIR__) . '/db/DB.php');
class BodyOlimpusUser extends DB
{

    public $id_user;
    public $id_customerAccount;
    public $first_name;
    public $last_name;
    public $height_user;
    public $email;
    public $passwd;
    public $phone_number;
    public $gender;
    public $actual_weight;
    public $date_nac;
    public $payment;
    public $payment_method;
    public $createAccount_date;
    public $exercise_space;
    public $last_update;
    public $user_activated;
    public $finish_date;
    public $last_connection;
    public $lastEntryDate;
    public $date_add;
    
    public function __construct($id_user = null)
    {
        if ($id_user) {
            $sql = DB::DBconnect()->prepare("SELECT * FROM bo_user where id_user = :id_user");
            $sql->bindParam(':id_user', $id_user);
            $sql->execute();
            $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
            foreach ($dataUser as $key => $data) {
                $this->$key = $data;
            }
        }
        return;
    }

    public function add()
    {
        $sql = DB::DBconnect()->prepare("INSERT INTO bo_user (id_customerAccount, first_name, last_name, height_user, email, passwd, phone_number, gender, actual_weight, date_nac, payment, payment_method, createAccount_date, exercise_space, last_update, user_activated, finish_date, last_connection, lastEntryDate, date_add) ".
        "VALUES (:id_customerAccount, :first_name, :last_name, :height_user, :email, :passwd, :phone_number, :gender, :actual_weight, :date_nac, :payment, :payment_method, :createAccount_date, :exercise_space, :last_update, :user_activated, :finish_date, :last_connection, :lastEntryDate, :date_add)");
        $sql->bindParam(':id_customerAccount', $this->id_customerAccount);
        $sql->bindParam(':first_name', $this->first_name);
        $sql->bindParam(':last_name', $this->last_name);
        $sql->bindParam(':height_user', $this->height_user);
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':passwd', $this->passwd);
        $sql->bindParam(':phone_number', $this->phone_number);
        $sql->bindParam(':gender', $this->gender);
        $sql->bindParam(':actual_weight', $this->actual_weight);
        $sql->bindParam(':date_nac', $this->date_nac);
        $sql->bindParam(':payment', $this->payment);
        $sql->bindParam(':payment_method', $this->payment_method);
        $sql->bindParam(':createAccount_date', $this->createAccount_date);
        $sql->bindParam(':exercise_space', $this->exercise_space);
        $sql->bindParam(':last_update', $this->last_update);
        $sql->bindParam(':user_activated', $this->user_activated);
        $sql->bindParam(':finish_date', $this->finish_date);
        $sql->bindParam(':last_connection', $this->last_connection);
        $sql->bindParam(':lastEntryDate', $this->lastEntryDate);
        $sql->bindParam(':date_add', $this->date_add);
        $sql->execute();
        return;
    }

    public function update()
    {
        $sql = DB::DBconnect()->prepare("UPDATE bo_user SET id_customerAccount = :id_customerAccount, first_name = :first_name, last_name = :last_name, height_user = :height_user, email = :email, passwd = :passwd, phone_number = :phone_number, gender = :gender, actual_weight = :actual_weight, date_nac = :date_nac, payment = :payment, payment_method = :payment_method, createAccount_date = :createAccount_date, exercise_space = :exercise_space, last_update = :last_update, user_activated = :user_activated, finish_date = :finish_date, last_connection = :last_connection, lastEntryDate = :lastEntryDate, date_add = :date_add WHERE id_user = :id_user;");
        $sql->bindParam(':id_user', $this->id_user);
        $sql->bindParam(':id_customerAccount', $this->id_customerAccount);
        $sql->bindParam(':first_name', $this->first_name);
        $sql->bindParam(':last_name', $this->last_name);
        $sql->bindParam(':height_user', $this->height_user);
        $sql->bindParam(':email', $this->email);
        $sql->bindParam(':passwd', $this->passwd);
        $sql->bindParam(':phone_number', $this->phone_number);
        $sql->bindParam(':gender', $this->gender);
        $sql->bindParam(':actual_weight', $this->actual_weight);
        $sql->bindParam(':date_nac', $this->date_nac);
        $sql->bindParam(':payment', $this->payment);
        $sql->bindParam(':payment_method', $this->payment_method);
        $sql->bindParam(':createAccount_date', $this->createAccount_date);
        $sql->bindParam(':exercise_space', $this->exercise_space);
        $sql->bindParam(':last_update', $this->last_update);
        $sql->bindParam(':user_activated', $this->user_activated);
        $sql->bindParam(':finish_date', $this->finish_date);
        $sql->bindParam(':last_connection', $this->last_connection);
        $sql->bindParam(':lastEntryDate', $this->lastEntryDate);
        $sql->bindParam(':date_add', $this->date_add);
        $sql->execute();
        return;
    }

    public function delete()
    {
        $sql = DB::DBconnect()->prepare("DELETE FROM bo_user WHERE bo_user.id_user = :id_user");
        $sql->bindParam(':id_user', $this->id_user);
        $sql->execute();
        return;
    }

    /**
     * Extrae el total de usuarios que ingresaron al GYM el día actual
     */
    public static function getTotalLastEntryDate($id_customerAccount){
        $sql = DB::DBconnect()->prepare("SELECT COUNT(id_user) as total FROM bo_user 
                                        LEFT JOIN bo_customeraccount
                                        ON bo_customeraccount.id_customerAccount = bo_user.id_customerAccount
                                        WHERE DATE(bo_user.lastEntryDate) = DATE(NOW()) and bo_user.id_customerAccount = ".$id_customerAccount);
        $sql->execute();
        $total = $sql->fetch(PDO::FETCH_ASSOC);
        return $total;
    }
    /**
     * Extrae el total de usuarios registrados a un id de customer
     */
    public static function getTotalMyUser($id_customerAccount){
        $sql = DB::DBconnect()->prepare("SELECT COUNT(id_user) as total FROM bo_user
                                        LEFT JOIN bo_customeraccount
                                        ON bo_customeraccount.id_customerAccount = bo_user.id_customerAccount
                                        WHERE bo_user.id_customerAccount = ".$id_customerAccount);
        $sql->execute();
        $total = $sql->fetch(PDO::FETCH_ASSOC);
        return $total;
    }
    /**
     * Extrae el total de usuarios con la menbresia del GYM vencida
     */
    public static function getTotalUsersFinised($id_customerAccount){
        $sql = DB::DBconnect()->prepare("SELECT COUNT(id_user) as total FROM bo_user WHERE
                                        DATE(bo_user.finish_date) > DATE(NOW()) 
                                        and bo_user.id_customerAccount = ".$id_customerAccount."
                                         and bo_user.user_activated = 1");
        $sql->execute();
        $total = $sql->fetch(PDO::FETCH_ASSOC);
        return $total;
    }
    /**
     * Extrae el total de ingresos por usuarios activo
     */
    public static function getTotalPaymentUsersActive($id_customerAccount){
        $sql = DB::DBconnect()->prepare("SELECT SUM(bo_user.payment) as total FROM bo_user 
                                        WHERE bo_user.user_activated = 1 and bo_user.id_customerAccount = ".$id_customerAccount);
        $sql->execute();
        $total = $sql->fetch(PDO::FETCH_ASSOC);
        return $total;
    }
    /**
     * Extrae el nombre, apellido, pago y metodo de pago para todos mis usuarios
     */
    public static function getDataUsersDash($id_customerAccount){
        $sql = DB::DBconnect()->prepare("SELECT first_name, last_name, payment, payment_method FROM bo_user WHERE id_customerAccount = ".$id_customerAccount."  LIMIT 8");
        $sql->execute();
        $total = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $total;
    }
    /**
     * Extrae el nombre, apellido, email para todos mis usuarios
     */
    public static function getDataUsersDashRecent($id_customerAccount){
        $sql = DB::DBconnect()->prepare("SELECT first_name, last_name, email FROM bo_user WHERE id_customerAccount = ".$id_customerAccount." ORDER BY date_add DESC LIMIT 10");
        $sql->execute();
        $total = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $total;
    }
    /**
     * Extrae el nombre, apellido, email para todos mis usuarios
     */
    public static function getDataAllMyUsers($id_customerAccount){
        $sql = DB::DBconnect()->prepare("SELECT * FROM bo_user WHERE id_customerAccount = ".$id_customerAccount);
        $sql->execute();
        $total = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $total;
    }



















    public static function updateGender($gender, $id_user)
    {
        // require_once(__DIR__ . '/db/DB.php');
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
        // require_once(__DIR__ . '/db/DB.php');
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
        // require_once(__DIR__ . '/db/DB.php');
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

            $sqli = DB::DBconnect()->query("SELECT * FROM bo_user WHERE id_user = $id_user");
            $rows = $sqli->fetchAll();
            $rows[0];

            $result = [
                'message' => $message,
                'dataUser' => $rows[0]
            ];
        } else {
            $message = "Error al actualizar los datos de usuario";
            $sqli = DB::DBconnect()->query("SELECT * FROM bo_user WHERE id_user = $id_user");
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
        // require_once(__DIR__ . '/db/DB.php');
        $sql = DB::DBconnect()->query("SELECT * FROM bo_user WHERE id_user = $id_user");
        // $sql->bindParam(':id_user', $id_user);
        $rows = $sql->fetchAll();
        return $rows;
    }

    public static function addWeight($weight, $id_user)
    {
        $date_weight = date("Y-m-d");
        // require_once(__DIR__ . '/db/DB.php');
        $sql = DB::DBconnect()->query("INSERT INTO bo_weight (id_weight, weight, id_user, date_weight) VALUES (NULL, '$weight', '$id_user', '$date_weight')");
        $sqli = DB::DBconnect()->query("UPDATE bo_user SET actual_weight = '$weight' WHERE bo_user.id_user = '$id_user'");
        if (($sql->fetchAll()) > 0) {
            $message = "Peso registrado pero no se actualizo en tu perfil";
            if (($sqli->fetchAll()) > 0) {
                $message = "Peso actualizado y registrado en tu perfil";
            }
        } else {
            $message = "Error al actualizar el Peso";
        }
        return $message;
    }

    public static function getDataUserIMC($id_user)
    {
        // require_once(__DIR__ . '/db/DB.php');
        $sql = DB::DBconnect()->query("SELECT actual_weight, height_user, gender FROM bo_user WHERE id_user = $id_user");
        $rows = $sql->fetchAll();
        if (!empty($rows)) {
            $rows = $rows[0];
        } else {
            $rows = '';
        }
        return $rows;
    }

    public static function getDataUserChart($id_user)
    {
        // require_once(__DIR__ . '/db/DB.php');
        $sql = DB::DBconnect()->query("SELECT weight as peso, date_weight as fecha FROM bo_weight WHERE id_user ='$id_user'");
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public static function getPass($id_user)
    {
        // require_once(__DIR__ . '/db/DB.php');
        $sql = DB::DBconnect()->prepare("SELECT passwd FROM bo_user where id_user = :id_user");
        $sql->bindParam(':id_user', $id_user);
        $sql->execute();
        $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }

    public static function resetPassword($id_user, $password)
    {
        // require_once(__DIR__ . '/db/DB.php');
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
