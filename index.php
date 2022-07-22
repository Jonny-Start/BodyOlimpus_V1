<?php

/**
 * BodyOlimpus:
 *
 * @author    Jonny Cano, Karen Gomez <jonnyalejandro.ca0910@gmail.com>
 * @copyright © 2021. Some rights reserved.
 * 
 * @license   
 * 
 * 
 * 
 * @link      https://BodyOlimpus.com
 */
// $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$request = $_SERVER['QUERY_STRING'];
require dirname(__FILE__) . '/config/config.php';

if ($request == "updateDB") {
    require_once __DIR__ . '/config/update.php';
    $result = update::updateDB();
    if ($result == true) {
        header("location: ./controllers/login.php?True");
    } else {
        header("location: ./controllers/login.php?False");
    }
} else if ($request == 'updateUserTest') {
    require_once __DIR__ . '/config/update.php';
    $result = update::installUsersTest();
    if ($result == true) {
        header("location: ./controllers/login.php?True");
    } else {
        header("location: ./controllers/login.php?False");
    }
} else {
    header("location: ./controllers/login.php");
}
