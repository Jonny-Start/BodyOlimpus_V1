<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
} else {
    if (!empty($_POST['place'])) {

        $place = $_POST['place'];
        $id_user = $_SESSION['user_id'];

        $dataUser = BodyOlimpusDataUser::updatePlace($place, $id_user);
        if ($dataUser == "place actualizado") {
            $nameView = 'bo_place';
            $message = [
                'type' => 'success',
                'text' => $dataUser
            ];
            echo $twig->render('place.twig', compact('nameView', 'message'));
        } else {
            $nameView = 'bo_place';
            $message = [
                'type' => 'error',
                'text' => $dataUser
            ];
            echo $twig->render('place.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_place';
        echo $twig->render('place.twig', compact('nameView'));
    }
}
