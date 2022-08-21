<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusUser.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
} else {
    if (!empty($_POST['gender'])) {

        $gender = $_POST['gender'];
        $id_user = $_SESSION['user_id'];

        $dataUser = BodyOlimpusUser::updateGender($gender,$id_user);
        if ($dataUser == "Genero actualizado") {
            $nameView = 'bo_gender';
            $message = [
                'type' => 'success',
                'text' => $dataUser
            ];
            echo $twig->render('front/gender.twig', compact('nameView', 'message'));
        } else {
            $nameView = 'bo_gender';
            $message = [
                'type' => 'error',
                'text' => $dataUser
            ];
            echo $twig->render('front/gender.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_gender';
        echo $twig->render('front/gender.twig', compact('nameView'));
    }
}
