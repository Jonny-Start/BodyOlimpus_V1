<?php
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusDataUser.php');

session_start();
if (!isset($_SESSION['userAdmin_id'])) {
    header("Location: ../loginAdmin.php");
    die();
} else {
    // $dataUsersAll = BodyOlimpusDataUser::getAllUsers();
    $nameView = 'bo_coach';
    echo $twig->render('admin/coach.twig', compact('nameView'));
}