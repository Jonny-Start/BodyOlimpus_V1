<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusLogin.php');

if (session_status() === PHP_SESSION_NONE) {
    // $data = extract($_REQUEST);
    // $loging = Login::getLoging($data);
    $dato = BodyOlimpusLogin::getLoging();
    if ($dato['exist'] == 1) {
        $user = $dato['rt']->fetch_object();
        session_start();
        $_SESSION['name'] = $user->first_name;
        header("Location: myaccount");
    } else {
        echo "No se encuentra el usuario";
    }
} else if (session_status() === PHP_SESSION_ACTIVE) {
    // echo $twig->render('myaccount.twig');
    header("Location: myaccount");
    // @session_start();
    // session_destroy();
    // header("Location:".__FILE__);
}
