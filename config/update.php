<?php
require_once (__DIR__) . '/../classes/db/DB.php';
class update extends DB
{
    public function loadSQLFile($sql_file)
    {
        //get install SQL file content
        $sql_content = file_get_contents($sql_file);

        //Remplace prefix SQL command in array
        $sql_content = str_replace('PREFIX_', 'bo_', $sql_content);
        $sql_requests = preg_split("/;\s*[\r\n]+/", $sql_content);

        //Execute each SQL statement
        $result = true;
        foreach ($sql_requests as $request) {
            if (!empty($request)) {
                $result &= DB::DBconnect()->query(trim($request));
            }
        }

        //Return result
        return $result;
    }
    static public function updateDB()
    {
        try {
            $sql_file = dirname(__FILE__) . '/../update/install.sql';
            if (!self::loadSQLFile($sql_file)) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    static public function installUsersTest()
    {
        try {
            $sql_file = dirname(__FILE__) . '/../update/installUsersTest.sql';
            if (!self::loadSQLFile($sql_file)) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
