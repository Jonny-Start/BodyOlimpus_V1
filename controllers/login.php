<?php
session_start(); //creo una sesion o reanudo una que ya tengo
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusLogin.php');


if (!isset($_SESSION['user_id'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email']; // traigo los datos que envie en el post si existen
        $pass = $_POST['password']; // traigo los datos que envie en el post si existen

        $dataUser = BodyOlimpusLogin::getLoging($email, $pass); // consulto en BD los dato que recojo

        if (!empty($dataUser) && password_verify($_POST['password'], $dataUser['passwd'])) {
            $_SESSION['user_id'] = $dataUser['id_user'];
            header("Location: myaccount");
        } else {
            $message = 'Error, los datos ingresados no son correctos o no existen';
            echo $twig->render('login.twig', compact('message'));
        }
    } else {
        echo $twig->render('login.twig');
    }
} else {
    echo $twig->render('myaccount.twig');
}






// if (session_status() === PHP_SESSION_NONE) {
// $data = extract($_REQUEST);
// $loging = Login::getLoging($data);
// $dato = BodyOlimpusLogin::getLoging();
// if ($dato['exist'] == 1) {
//     $user = $dato['rt']->fetch_object();
//     session_start();
//     $_SESSION['name'] = $user->first_name;
//     header("Location: myaccount");
// } else {
//     echo "No se encuentra el usuario";
// }
// } else if (session_status() === PHP_SESSION_ACTIVE) {
// echo $twig->render('myaccount.twig');
// header("Location: myaccount");
// @session_start();
// session_destroy();
// header("Location:".__FILE__);
// }
