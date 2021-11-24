<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');


session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
} else {
    $id_user = $_SESSION['user_id'];
    $dataUser = BodyOlimpusDataUser::getDataUserProfile($id_user);

    if (!empty($dataUser)) {
        $dataUser = $dataUser[0];
    }

    $fecha_nacimiento = new DateTime($dataUser['date_nac']);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nacimiento);
    $old = $edad->y;

    $nameView = 'bo_profile';
    echo $twig->render('profile.twig', compact('nameView', 'dataUser','old'));
}
