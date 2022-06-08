<?php
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusDataUser.php');

session_start();
if (!isset($_SESSION['userAdmin_id'])) {
    header("Location: ../loginAdmin.php");
    die();
} else {
    $dataUsersAll = BodyOlimpusDataUser::getAllUsers();
    $nameView = 'bo_users';
    echo $twig->render('admin/users.twig', compact('nameView', 'dataUsersAll'));
}