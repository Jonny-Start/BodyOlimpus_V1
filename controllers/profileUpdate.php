<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');


session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
} else {
    if (!empty($_POST['profileUpdateSubmit'])) {
        if (
            !empty($_POST['email']) &&
            !empty($_POST['first_name']) &&
            !empty($_POST['last_name']) &&
            !empty($_POST['height_user']) &&
            !empty($_POST['date_nac']) &&
            !empty($_POST['phone_number']) &&
            !empty($_POST['email'])
        ) {

            $id_user = $_SESSION['user_id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $height_user = $_POST['height_user'];
            $date_nac = $_POST['date_nac'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $last_update = date("Y-m-d");

            $respond = BodyOlimpusDataUser::updateDataUserProfile($id_user, $first_name, $last_name, $height_user, $date_nac, $email, $phone_number, $last_update);
            $dataUser = $respond['dataUser'];

            $fecha_nacimiento = new DateTime($dataUser['date_nac']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nacimiento);
            $old = $edad->y;

            if ($respond['message'] == "Datos de usuario actualizado") {
                $nameView = 'bo_profile';
                $message = [
                    'type' => 'success',
                    'text' => $respond['message']
                ];
                echo $twig->render('front/profile.twig', compact('nameView', 'message', 'dataUser', 'old'));
            } else {
                $nameView = 'bo_profileUpdate';
                $message = [
                    'type' => 'error',
                    'text' => $respond['message']
                ];
                echo $twig->render('front/profileUpdate.twig', compact('nameView', 'message', 'dataUser', 'old'));
            }
        } else {
            $id_user = $_SESSION['user_id'];
            $dataUser = BodyOlimpusDataUser::getDataUserProfile($id_user);
            if (!empty($dataUser)) {
                $dataUser = $dataUser[0];
            }
            $nameView = 'bo_profileUpdate';
            $message = [
                'type' => 'error',
                'text' => 'Error, Todos los campos tienen que estar diligenciados'
            ];
            echo $twig->render('front/profileUpdate.twig', compact('nameView', 'message', 'dataUser'));
        }
    } else {
        $id_user = $_SESSION['user_id'];
        $dataUser = BodyOlimpusDataUser::getDataUserProfile($id_user);
        if (!empty($dataUser)) {
            $dataUser = $dataUser[0];
        }
        $nameView = 'bo_profileUpdate';
        echo $twig->render('front/profileUpdate.twig', compact('nameView', 'dataUser'));
    }
}
