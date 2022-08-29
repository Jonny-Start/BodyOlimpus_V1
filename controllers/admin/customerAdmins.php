<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusCustomerAccount.php');
$nameView = 'bo_customerAdmins';
$context = $_SESSION["context"];
$myId = $_SESSION['userAdmin_id'];

if (!isset($_SESSION['userAdmin_id'])) {
    header("Location: ../loginAdmin.php");
    die();
} else {
    $dataCustomerAll = BodyOlimpusCustomerAccount::getDataAllCustomersAdmin();
    echo $twig->render('admin/customerAdmins.twig', compact('nameView','context','dataCustomerAll'));
}
