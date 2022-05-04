<?php
session_start(); //creo una sesion o reanudo una que ya tengo
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusLoginAdmin.php');


if (!isset($_SESSION['user_id'])) {
    if (!empty($_POST['submit'])) {
        if (!empty($_POST['username']) && !empty($_POST['pass'])) {
            $username = $_POST['username']; // traigo los datos que envie en el post si existen
            $pass = $_POST['pass']; // traigo los datos que envie en el post si existen

            $dataUser = BodyOlimpusLoginAdmin::getLogingAdmin($username, $pass); // consulto en BD los dato que recojo

            if (!empty($dataUser) && password_verify($_POST['pass'], $dataUser['pass'])) {
                $_SESSION['user_id'] = $dataUser['id_userAdmin'];
                header("Location: admin/dashboard.php");
            } else {
                echo("Hola");
                echo($dataUser["username"]);
                echo($dataUser["pass"]);
                die("");
                $message = [
                    'type' => 'error',
                    'text' => 'Error, los datos ingresados no son correctos o no existen'
                ];
                $nameView = 'bo_loginAdmin';
                echo $twig->render('admin/login.twig', compact('nameView', 'message'));
            }
        } else {
            $message = [
                'type' => 'error',
                'text' => 'Error, se tiene que llenar todos los campos'
            ];
            $nameView = 'bo_loginAdmin';
            echo $twig->render('admin/login.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_loginAdmin';
        echo $twig->render('admin/login.twig', compact('nameView'));
    }
} else {
    header("Location: admin/dashboard.php");
}