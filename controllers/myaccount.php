<?php
require_once __DIR__ . '/../config/config.php';

session_start();
$dataSesion = $_SESSION['email'];

// if($dataSesion == null || $dataSesion == ''){
//     echo ('ud no puede estar aqui');
//     die(); //para que se detenga la ejecución hasta aqui
// }


echo $twig->render('myaccount.twig');
