<?php
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusAdmins.php');
/**
 * Validation session
 */
session_start();
if (empty($_SESSION['userVerification_id'])) {
    header("Location: ../loginAdmin.php");
    die();
}
/**
 * Construct
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = $_POST["first"];
    $second = $_POST["second"];
    $third = $_POST["third"];
    $fourth = $_POST["fourth"];
    $codeStr = intval($first) . intVal($second) . intVal($third) . intVal($fourth);
    $BodyOlimpusAdmins = new BodyOlimpusAdmins($_SESSION['userVerification_id']);
    if ($BodyOlimpusAdmins->code_email == $codeStr) {
        try {
            $ip = getenv('REMOTE_ADDR');
            $BodyOlimpusAdmins->code_email = null;
            $BodyOlimpusAdmins->ip_connect = $ip;
            $BodyOlimpusAdmins->update();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $_SESSION['userAdmin_id'] = $_SESSION['userVerification_id'];
        $_SESSION['userVerification_id'] = null;
        return header("Location: dashboard.php");
    } else {
        $nameView = 'bo_verificationCode';
        echo $twig->render('admin/verificationCode.twig', compact('nameView'));
    }
} else {
    $nameView = 'bo_verificationCode';
    echo $twig->render('admin/verificationCode.twig', compact('nameView'));
}
