<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusLogin.php');


if (!empty($_POST['email']) && !empty($_POST['passwd'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['passwd'];
    $createAccount_date = date("Y-m-d");


    $dataUser = BodyOlimpusLogin::setUser($first_name, $last_name, $email, $pass, $createAccount_date);
    if ($dataUser == "Usuario Creado") {
        $nameView = 'create_account';
        $message = $dataUser;
        echo $twig->render('create_account.twig',compact('nameView','message'));
    }else{
        $nameView = 'create_account';
        $message = $dataUser;
        echo $twig->render('create_account.twig',compact('nameView','message'));
    }
} else {
    $nameView = 'create_account';
    echo $twig->render('create_account.twig', compact('nameView'));
}
