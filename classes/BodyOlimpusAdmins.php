<?php
require_once((__DIR__) . '/db/DB.php');
class BodyOlimpusAdmins extends DB
{
    public $id_userAdmin;
    public $username;
    public $pass;
    public $code_email;
    public $rol_admin;
    public $ip_connect;

    public function __construct($id_userAdmin = null)
    {
        if ($id_userAdmin) {
            $sql = DB::DBconnect()->prepare("SELECT * FROM bo_admins where id_userAdmin = :id_userAdmin");
            $sql->bindParam(':id_userAdmin', $id_userAdmin);
            $sql->execute();
            $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
            foreach ($dataUser as $key => $data) {
                $this->$key = $data;
            }
        }
        return;
    }

    public function update()
    {
        $sql = DB::DBconnect()->prepare("UPDATE bo_admins SET username = :username, pass = :pass, code_email = :code_email, rol_admin = :rol_admin, ip_connect = :ip_connect WHERE id_userAdmin = :id_userAdmin;");
        $sql->bindParam(':id_userAdmin', $this->id_userAdmin);
        $sql->bindParam(':username', $this->username);
        $sql->bindParam(':pass', $this->pass);
        $sql->bindParam(':code_email', $this->code_email);
        $sql->bindParam(':rol_admin', $this->rol_admin);
        $sql->bindParam(':ip_connect', $this->ip_connect);
        $sql->execute();
        return;
    }

    public static function getLogingAdmin($username)
    {
        $sql = DB::DBconnect()->prepare("SELECT id_userAdmin, username, pass FROM bo_admins where username = :username");
        $sql->bindParam(':username', $username);
        $sql->execute();
        $dataUser = $sql->fetch(PDO::FETCH_ASSOC);
        return $dataUser;
    }
}
