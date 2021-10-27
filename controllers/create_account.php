<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusLogin.php');


if (!empty($_POST['email']) && !empty($_POST['passwd'])) {

    $email = $_POST['email'];
    $pass = $_POST['passwd'];

    $dataUser = BodyOlimpusLogin::setUser($email, $pass);
    if ($dataUser == "Usuario Creado") {
        echo $twig->render('create_account.twig',compact('dataUser'));
    }
} else {
    $nameView = 'create_account';
    echo $twig->render('create_account.twig', compact('nameView'));
}
