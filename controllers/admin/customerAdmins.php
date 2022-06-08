<?php
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusDataUser.php');

session_start();
if (!isset($_SESSION['userAdmin_id'])) {
    header("Location: ../loginAdmin.php");
    die();
} else {
    $nameView = 'bo_customerAdmins';
    echo $twig->render('admin/customerAdmins.twig', compact('nameView'));
}
