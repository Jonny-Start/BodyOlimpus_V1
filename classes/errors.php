<?php
require_once((__DIR__) . '/db/DB.php');
class BodyOlimpusErrors extends DB
{
    public $id_errors;
    public $id_user;
    public $messageTitle;
    public $messageBody;

    public function __construct($id_errors = null){
        if($id_errors){
            $this->id_errors = $id_errors;
            $sql = DB::DBconnect()->prepare("SELECT * FROM bo_errors where id_user = :id_user");
            $sql->bindParam(':id_user', $id_user);
            $sql->execute();
            $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
            return $dataUser;
        }
        return;
    }

    public static function add(){
        $sql = DB::DBconnect()->prepare("INSERT INTO bo_errors (id_user, messageTitle, messageBody) VALUES (:id_user, :messageTitle, :messageBody)");
        $sql->bindParam(':id_user', self::$id_user);
        $sql->bindParam(':messageTitle', self::$messageTitle);
        $sql->bindParam(':messageBody', self::$messageBody);
        $sql->execute();
        return;
    }

    public static function update(){
        $sql = DB::DBconnect()->prepare("UPDATE bo_errors SET messageTitle = :messageTitle, messageBody = :messageBody WHERE id_errors = :id_errors;");
        $sql->bindParam(':messageTitle', self::$messageTitle);
        $sql->bindParam(':messageBody', self::$messageBody);
        $sql->bindParam(':id_errors', self::$id_errors);
        $sql->execute();
        return;
    }

    public static function delete(){
        $sql = DB::DBconnect()->prepare("DELETE FROM bo_errors WHERE bo_errors.id_errors = :id_errors");
        $sql->bindParam(':id_errors', self::$id_errors);
        $sql->execute();
        return;
    }
}