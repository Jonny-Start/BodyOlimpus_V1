<?php
require_once __DIR__ . '/../config/config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
}else{
    $nameView = 'bo_exercises12';
    echo $twig->render('exercises12.twig', compact('nameView'));
}