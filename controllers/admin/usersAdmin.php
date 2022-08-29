<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusUser.php');
$context = $_SESSION["context"];
$myId = $_SESSION['userAdmin_id'];
$nameView = 'bo_users';

if (!isset($_SESSION['userAdmin_id'])) {
    header("Location: ../loginAdmin.php");
    die();
} else {
    $dataUsersAll = BodyOlimpusUser::getDataAllMyUsers($myId);
    echo $twig->render('admin/users.twig', compact('nameView', 'dataUsersAll','context'));
}