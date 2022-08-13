<?php
session_start(); //creo una sesion o reanudo una que ya tengo
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusAdmins.php');
require(__DIR__ . '/../classes/BodyOlimpusCustomerAccount.php');
$nameView = 'bo_loginAdmin';

if (isset($_SESSION['userVerification_id'])) {
    return header("Location: admin/verificationCode.php");
}
if (isset($_SESSION['id_userAdmin'])) {
    header("Location: admin/dashboard.php");
}
if (!empty($_POST['submit'])) {

    if (empty($_POST['username']) || empty($_POST['pass'])) {
        $message = ['type' => 'error', 'text' => 'Error, se tiene que llenar todos los campos'];
        echo $twig->render('admin/login.twig', compact('nameView', 'message'));
        return false;
    }

    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $dataUser = BodyOlimpusAdmins::getLogingAdmin($username); //Extraigo los datos de ese user name

    if (!empty($dataUser) && password_verify($_POST['pass'], $dataUser['pass'])) {
        
        $customerAccount = BodyOlimpusCustomerAccount::getDataContext($dataUser["id_userAdmin"]);
        $userAdmin =[
            'img' => $customerAccount['imgGym'],
            'imgBlack' => $customerAccount['imgBlackGym'],
            'nameGym' => $customerAccount['gymName'],
            'rol'=> $customerAccount['rol_admin']
        ];
        pushContext("userAdmin", $userAdmin);

        $ip = getenv('REMOTE_ADDR');
        $BodyOlimpusAdmins = new BodyOlimpusAdmins($dataUser['id_userAdmin']);
        if (empty($BodyOlimpusAdmins->ip_connect)) {
            try {
                $BodyOlimpusAdmins->ip_connect = $ip;
                $BodyOlimpusAdmins->update();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else if ($BodyOlimpusAdmins->ip_connect != $ip) {
            $_SESSION['userVerification_id'] = $dataUser['id_userAdmin'];
            $code = null;
            for ($i = 0; $i < 4; $i++) {
                $code .= rand(1, 9);
            }
            try {
                $BodyOlimpusAdmins->code_email = $code;
                $BodyOlimpusAdmins->update();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $asunto = 'Codigo'; //Asunto del correo
            $body = 'tu codigo de confirmacion es: ' . $code; //Cuerpo del mensaje
            $header = 'From: messages@bodyolimpus.com ';
            $mail = mail($email, $asunto, $body, $header);
            return header("Location: admin/verificationCode.php");
            // if ($mail) {
            //     return header("Location: admin/verificationCode.php");
            // }else{
            //     // error!!!!!!!
            // }
        }
        $_SESSION['userAdmin_id'] = $dataUser['id_userAdmin'];
        header("Location: admin/dashboard.php");
    } else {
        $message = ['type' => 'error', 'text' => 'Error, los datos ingresados no son correctos o no existen'];
        echo $twig->render('admin/login.twig', compact('nameView', 'message'));
    }
} else {
    echo $twig->render('admin/login.twig', compact('nameView'));
}
