<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusUser.php');
$nameView = 'bo_dashboard';
$context = $_SESSION["context"];

if (!isset($_SESSION['userAdmin_id'])) {
    header("Location: ../loginAdmin.php");
    die();
} else {
    $myId = $_SESSION['userAdmin_id'];
    $dataUsersAll = BodyOlimpusUser::getDataUsersDash($myId);
    $dataUsersAllRecent = BodyOlimpusUser::getDataUsersDashRecent($myId);
    $totalLastEntryDate = BodyOlimpusUser::getTotalLastEntryDate($myId);
    $totalMyUser = BodyOlimpusUser::getTotalMyUser($myId);
    $totalUsersFinised = BodyOlimpusUser::getTotalUsersFinised($myId);
    $totalPayment = BodyOlimpusUser::getTotalPaymentUsersActive($myId);
    echo $twig->render('admin/dashboard.twig', compact('nameView', 'dataUsersAll', 'context','totalLastEntryDate',"totalMyUser", 'totalUsersFinised','totalPayment','dataUsersAllRecent'));
}