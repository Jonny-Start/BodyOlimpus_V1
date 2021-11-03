<?php
require_once __DIR__ . '/../config/config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Settings");
    die();
}else{
    $nameView = 'bo_settings';
    echo $twig->render('settings.twig', compact('nameView'));
}