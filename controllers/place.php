<?php
require_once __DIR__ . '/../config/config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    die();
}else{
    $nameView = 'bo_place';
    echo $twig->render('place.twig', compact('nameView'));
}