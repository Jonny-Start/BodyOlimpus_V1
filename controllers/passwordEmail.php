<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusEmail.php');

session_start();

if (!empty($_POST['submitPassEmail'])) {
    if (!empty($_POST['email'])) {
        $email = $_POST['email']; //Para quien va el correo email
        $dataUser = BodyOlimpusEmail::existsEmail($email);
        if (!empty($dataUser['id_user'])) {
            //Carácteres para la contraseña
            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $password = "";
            //Reconstruimos la contraseña segun la longitud que se quiera
            for ($i = 0; $i < 10; $i++) {
                //obtenemos un caracter aleatorio escogido de la cadena de caracteres
                $password .= substr($str, rand(0, 62), 1);
            }
            $id_user = $dataUser[0];
            $dataUser2 = BodyOlimpusEmail::resetPasswordEmail($id_user, $password);

            if ($dataUser2 == 'Contraseña actualizada') {
                $asunto = 'Tu contraseña fue cambiada en BodyOlimpus'; //Asunto del correo
                $body = 'Tu contraseña para la app de BodyOlimpus fue cambiada a solicitud de el usuario, tu nueva contraseña es: ' . $password; //Cuerpo del mensaje
                $header = 'From: resetpassword@bodyolimpus.com ';

                $mail = mail($email, $asunto, $body, $header);
                // echo $mail;
                // die();
                if ($mail) {
                    $nameView = 'bo_passwordEmail';
                    $message = [
                        'type' => 'success',
                        'text' => 'Contraseña actualizada, revisa tu correo electronico.'
                    ];
                    echo $twig->render('front/passwordEmail.twig', compact('nameView', 'message'));
                } else {
                    $nameView = 'bo_passwordEmail';
                    $message = [
                        'type' => 'error',
                        'text' => 'No se pudo actualizar la contraseña'
                    ];
                    echo $twig->render('front/passwordEmail.twig', compact('nameView', 'message'));
                }
            } else {
                $nameView = 'bo_passwordEmail';
                $message = [
                    'type' => 'error',
                    'text' => 'No se pudo actualizar la contraseña'
                ];
                echo $twig->render('front/passwordEmail.twig', compact('nameView', 'message'));
            }
        } else {
            $nameView = 'bo_passwordEmail';
            $message = [
                'type' => 'error',
                'text' => 'El correo electronico ingresado no tiene cuenta en BodyOlimpus'
            ];
            echo $twig->render('front/passwordEmail.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_passwordEmail';
        $message = [
            'type' => 'error',
            'text' => 'Tiene que agregar un correo electronico para poder restablecer la contraseña'
        ];
        echo $twig->render('front/passwordEmail.twig', compact('nameView', 'message'));
    }
} else {
    $nameView = 'bo_passwordEmail';
    echo $twig->render('front/passwordEmail.twig', compact('nameView'));
}
