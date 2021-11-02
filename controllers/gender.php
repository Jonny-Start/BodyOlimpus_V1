<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    die();
} else {
    if (!empty($_POST['gender'])) {

        $gender = $_POST['gender'];
        $id_user = $_SESSION['user_id'];

        $dataUser = BodyOlimpusDataUser::updateGender($gender,$id_user);
        if ($dataUser == "Genero actualizado") {
            $nameView = 'bo_gender';
            $message = $dataUser;
            echo $twig->render('gender.twig', compact('nameView', 'message'));
        } else {
            $nameView = 'bo_gender';
            $message = $dataUser;
            echo $twig->render('gender.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_gender';
        echo $twig->render('gender.twig', compact('nameView'));
    }
}
