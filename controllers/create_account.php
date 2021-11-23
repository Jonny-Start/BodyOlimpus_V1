<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusLogin.php');


if (!empty($_POST['createAcount'])) {
    if (!empty($_POST['first_name']) || !empty($_POST['last_name']) || !empty($_POST['email'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        for ($i = 0; $i < 10; $i++) {
            $password .= substr($str, rand(0, 62), 1);
        }
        $pass = $password;

        $dataUser = BodyOlimpusLogin::setUser($first_name, $last_name, $email, $pass);
        if ($dataUser == "Usuario Creado") {
            $asunto = 'Tu cuenta en BodyOlimpus fue creada'; //Asunto del correo
            $body = 'Tu contraseña para la app de BodyOlimpus fue creada por el sistema, tu contraseña es: ' . $password; //Cuerpo del mensaje
            $header = 'From: create.account@bodyolimpus.com ';

            $mail = mail($email, $asunto, $body, $header);

            $nameView = 'bo_create_account';
            $message = [
                'type' => 'success',
                'text' => $dataUser . ' Revisa tu correo electronico para saber tu contraseña'
            ];
            echo $twig->render('create_account.twig', compact('nameView', 'message'));
        } else {
            $nameView = 'bo_create_account';
            $message = [
                'type' => 'error',
                'text' => $dataUser
            ];
            echo $twig->render('create_account.twig', compact('nameView', 'message'));
        }
    }else{
        $nameView = 'bo_create_account';
        $message = [
            'type' => 'error',
            'text' => 'Todos los datos campos tienen que estar diligenciados'
        ];
        echo $twig->render('create_account.twig', compact('nameView', 'message'));
    }
} else {
    $nameView = 'bo_create_account';
    echo $twig->render('create_account.twig', compact('nameView'));
}
