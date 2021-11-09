<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');


session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    die();
} else {
    if (!empty($_POST['last_update'])) {

        $id_user = $_SESSION['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        // $gender = $_POST['gender'];
        // $edad = $_POST['edad'];
        $phone_number = $_POST['phone_number'];
        // $exercise_space = $_POST['exercise_space'];
        $actual_weight = $_POST['actual_weight'];
        $last_update = $_POST['last_update'];

        $respond = BodyOlimpusDataUser::updateDataUserProfile($id_user, $first_name, $last_name, $email, $phone_number, $actual_weight, $last_update);
        if ($respond == "Datos de usuario actualizado") {
            $nameView = 'bo_profile';
            $message = $respond;
            echo $twig->render('profile.twig', compact('nameView', 'message'));
        } else {
            $nameView = 'bo_profile';
            $message = $respond;
            echo $twig->render('profile.twig', compact('nameView', 'message'));
        }
    } else {
        $id_user = $_SESSION['user_id'];
        $date_now = date("Y-m-d");
        $dataUser = BodyOlimpusDataUser::getDataUserProfile($id_user);
        $nameView = 'bo_profile';
        echo $twig->render('profile.twig', compact('nameView', 'dataUser', 'date_now'));
    }
}
