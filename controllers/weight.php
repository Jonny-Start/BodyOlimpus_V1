<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusDataUser.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    die();
} else {
    if (!empty($_POST['submitWeight'])) {
        $weight = $_POST['weight'];
        $id_user = $_SESSION['user_id'];

        $dataUser = BodyOlimpusDataUser::addWeight($weight, $id_user);
        if ($dataUser == "Peso actualizado") {
            $nameView = 'bo_weight';
            $message = [
                'type' => 'success',
                'text' => $dataUser
            ];
            echo $twig->render('weight.twig', compact('nameView', 'message'));
        } else {
            $nameView = 'bo_weight';
            $message = [
                'type' => 'error',
                'text' => $dataUser
            ];
            echo $twig->render('weight.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_weight';
        echo $twig->render('weight.twig', compact('nameView'));
    }
}
