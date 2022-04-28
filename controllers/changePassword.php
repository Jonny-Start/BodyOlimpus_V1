<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
} else {
    if (!empty($_POST['submitPass'])) {
        if (!empty($_POST['actualPass']) && !empty($_POST['newPass']) && !empty($_POST['confirmPass'])) {
            $actualPass = $_POST['actualPass'];
            $newPass = $_POST['newPass'];
            $confirmPass = $_POST['confirmPass'];

            $id_user = $_SESSION['user_id'];
            $dataUser = BodyOlimpusDataUser::getPass($id_user);
            if (!empty($dataUser['passwd'])) {
                if ((password_verify($_POST['actualPass'], $dataUser['passwd'])) == true) {
                    if ($newPass == $confirmPass) {
                        $dataUser = BodyOlimpusDataUser::resetPassword($id_user, $newPass);
                        if ($dataUser == 'Contraseña actualizada') {
                            $nameView = 'bo_changePassword';
                            $message = [
                                'type' => 'success',
                                'text' => $dataUser
                            ];
                            echo $twig->render('front/changePassword.twig', compact('nameView', 'message'));
                        } else {
                            $nameView = 'bo_changePassword';
                            $message = [
                                'type' => 'error',
                                'text' => $dataUser
                            ];
                            echo $twig->render('front/changePassword.twig', compact('nameView', 'message'));
                        }
                    } else {
                        $nameView = 'bo_changePassword';
                        $message = [
                            'type' => 'error',
                            'text' => 'Error, la verificacion de nueva contraseña no coinciden'
                        ];
                        echo $twig->render('front/changePassword.twig', compact('nameView', 'message'));
                    }
                } else {
                    $nameView = 'bo_changePassword';
                    $message = [
                        'type' => 'error',
                        'text' => 'Error, la contraseña ingresada, no es la misma para iniciar sesion'
                    ];
                    echo $twig->render('front/changePassword.twig', compact('nameView', 'message'));
                }
            } else {
                $nameView = 'bo_changePassword';
                $message = [
                    'type' => 'error',
                    'text' => 'Error, algo paso y no se pudo consultar la contraseña actual'
                ];
                echo $twig->render('front/changePassword.twig', compact('nameView', 'message'));
            }
        } else {
            $nameView = 'bo_changePassword';
            $message = [
                'type' => 'error',
                'text' => 'Error, tienes que diligenciar todos los campos'
            ];
            echo $twig->render('front/changePassword.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_changePassword';
        echo $twig->render('front/changePassword.twig', compact('nameView'));
    }
}
