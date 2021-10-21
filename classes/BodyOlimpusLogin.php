<?php
class BodyOlimpusLogin
{
    public static function getLoging()
    {
        $email = 'jonnyalejandro.ca0910@gmail.com';
        $pass = 'jonny123';
        require(__DIR__ . './db/DB.php');

        $sql = "SELECT * FROM bo_customer where email = '$email' and passwd = '$pass'";
        $rt = DB::DBconnect()->query($sql);
        $exist = $rt->num_rows;
        $dataUser = [
            'exist' => $exist,
            'rt' => $rt
        ];
        return $dataUser;
    }

    public static function estaConected()
    {
        $result = DB::DBconnect();
        return $result;
    }
}
