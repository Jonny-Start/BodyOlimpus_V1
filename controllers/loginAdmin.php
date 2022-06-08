<?php
session_start(); //creo una sesion o reanudo una que ya tengo
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusAdmins.php');

if (isset($_SESSION['userVerification_id'])) {
    return header("Location: admin/verificationCode.php");
}

if (!isset($_SESSION['id_userAdmin'])) {
    if (!empty($_POST['submit'])) {
        if (!empty($_POST['username']) && !empty($_POST['pass'])) {
            $username = $_POST['username']; // traigo los datos que envie en el post si existen
            $pass = $_POST['pass']; // traigo los datos que envie en el post si existen
            $dataUser = BodyOlimpusAdmins::getLogingAdmin($username); // consulto en BD los dato que recojo            
            if (!empty($dataUser) && password_verify($_POST['pass'], $dataUser['pass'])) {
                $ip = getenv('REMOTE_ADDR');
                $BodyOlimpusAdmins = new BodyOlimpusAdmins($dataUser['id_userAdmin']);
                if (empty($BodyOlimpusAdmins->ip_connect)) {
                    try {
                        $BodyOlimpusAdmins->ip_connect = $ip;
                        $BodyOlimpusAdmins->update();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                } else if ($BodyOlimpusAdmins->ip_connect != $ip) {
                    $_SESSION['userVerification_id'] = $dataUser['id_userAdmin'];
                    $code = null;
                    for ($i = 0; $i < 4; $i++) {
                        $code .= rand(1, 9);
                    }
                    try {
                        $BodyOlimpusAdmins->code_email = $code;
                        $BodyOlimpusAdmins->update();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    $asunto = 'Codigo'; //Asunto del correo
                    $body = 'tu codigo de confirmacion es: ' . $code; //Cuerpo del mensaje
                    $header = 'From: messages@bodyolimpus.com ';
                    $mail = mail($email, $asunto, $body, $header);
                    return header("Location: admin/verificationCode.php");
                    // if ($mail) {
                    //     return header("Location: admin/verificationCode.php");
                    // }else{
                    //     // error!!!!!!!
                    // }
                }
                $_SESSION['userAdmin_id'] = $dataUser['id_userAdmin'];
                header("Location: admin/dashboard.php");
            } else {
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
