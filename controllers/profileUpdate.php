<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');


session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    die();
} else {
    if (!empty($_POST['email'])) {

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
        if ($respond['message'] == "Datos de usuario actualizado") {
            $nameView = 'bo_profile';

            $fecha_nacimiento = new DateTime($dataUser['date_nac']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nacimiento);
            $old = $edad->y;

            $message = [
                'type' => 'success',
                'text' => $respond['message']
            ];
            echo $twig->render('profile.twig', compact('nameView', 'message', 'dataUser', 'old'));
        } else {
            $nameView = 'bo_profileUpdate';

            $fecha_nacimiento = new DateTime($dataUser['date_nac']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nacimiento);
            $old = $edad->y;

            $message = [
                'type' => 'error',
                'text' => $respond['message']
            ];
            echo $twig->render('profileUpdate.twig', compact('nameView', 'message', 'dataUser', 'old'));
        }
    } else {
        $id_user = $_SESSION['user_id'];
        $dataUser = BodyOlimpusDataUser::getDataUserProfile($id_user);
        $nameView = 'bo_profileUpdate';
        echo $twig->render('profileUpdate.twig', compact('nameView', 'dataUser'));
    }
}
