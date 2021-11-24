<?php
require_once __DIR__ . '/../config/config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
}else{
    $nameView = 'bo_food7';
    echo $twig->render('food7.twig', compact('nameView'));
}