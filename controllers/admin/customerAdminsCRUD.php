<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require(__DIR__ . '/../../classes/BodyOlimpusCustomerAccount.php');
$nameView = 'bo_customerAdminsCRUD';
$context = $_SESSION["context"];
$myId = $_SESSION['userAdmin_id'];

if (!isset($_SESSION['userAdmin_id'])) {
    return header("Location: ../loginAdmin.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST["newCustomer"] == true) {
        $date = date("Y-m-d");
        try {
            $BodyOlimpusCustomerAccount = new BodyOlimpusCustomerAccount();
            $BodyOlimpusCustomerAccount->firstName = $_POST["firstName"];
            $BodyOlimpusCustomerAccount->lastName = $_POST["lastName"];
            $BodyOlimpusCustomerAccount->identificationNumber = $_POST["identificationNumber"];
            $BodyOlimpusCustomerAccount->phoneNumber = $_POST["phoneNumber"];
            $BodyOlimpusCustomerAccount->gymName = $_POST["gymName"];
            $BodyOlimpusCustomerAccount->email = $_POST["email"];
            $BodyOlimpusCustomerAccount->locationCustomer = $_POST["locationCustomer"];
            $BodyOlimpusCustomerAccount->accountType = $_POST["accountType"];
            $BodyOlimpusCustomerAccount->availableUsers = $_POST["availableUsers"];
            $BodyOlimpusCustomerAccount->paymentMethod = $_POST["paymentMethod"];
            $BodyOlimpusCustomerAccount->paymentAmount = $_POST["paymentAmount"];
            $BodyOlimpusCustomerAccount->active = $_POST["active"];
            $BodyOlimpusCustomerAccount->activationDate = $_POST["activationDate"];
            $BodyOlimpusCustomerAccount->expirationDate = $_POST["expirationDate"];
            $BodyOlimpusCustomerAccount->comments = $_POST["comments"];
            $BodyOlimpusCustomerAccount->imgGym = $_POST["imgGym"];
            $BodyOlimpusCustomerAccount->imgBlackGym = $_POST["imgBlackGym"];
            $BodyOlimpusCustomerAccount->date_add = $date;
            $BodyOlimpusCustomerAccount->date_upd = $date;
            $resultSave = $BodyOlimpusCustomerAccount->add();
            if ($resultSave == "false") {
                die(); // error
            }
            return header("Location: customerAdmins");

        } catch (Exception $e) {
            die('Save failed: ' . $e->getMessage());
        }
    } else if ($_POST["updateCustomer"] == true) {
        try {
            $BodyOlimpusCustomerAccount = new BodyOlimpusCustomerAccount();
            $BodyOlimpusCustomerAccount->firstName = $_POST["firstName"];
            $BodyOlimpusCustomerAccount->lastName = $_POST["lastName"];
            $BodyOlimpusCustomerAccount->identificationNumber = $_POST["identificationNumber"];
            $BodyOlimpusCustomerAccount->phoneNumber = $_POST["phoneNumber"];
            $BodyOlimpusCustomerAccount->gymName = $_POST["gymName"];
            $BodyOlimpusCustomerAccount->email = $_POST["email"];
            $BodyOlimpusCustomerAccount->locationCustomer = $_POST["locationCustomer"];
            $BodyOlimpusCustomerAccount->accountType = $_POST["accountType"];
            $BodyOlimpusCustomerAccount->availableUsers = $_POST["availableUsers"];
            $BodyOlimpusCustomerAccount->paymentMethod = $_POST["paymentMethod"];
            $BodyOlimpusCustomerAccount->paymentAmount = $_POST["paymentAmount"];
            $BodyOlimpusCustomerAccount->active = $_POST["active"];
            $BodyOlimpusCustomerAccount->activationDate = $_POST["activationDate"];
            $BodyOlimpusCustomerAccount->expirationDate = $_POST["expirationDate"];
            $BodyOlimpusCustomerAccount->comments = $_POST["comments"];
            $BodyOlimpusCustomerAccount->imgGym = $_POST["imgGym"];
            $BodyOlimpusCustomerAccount->imgBlackGym = $_POST["imgBlackGym"];
            $BodyOlimpusCustomerAccount->date_add = $_POST["date_add"];
            $BodyOlimpusCustomerAccount->date_upd = $_POST["date_upd"];
            $BodyOlimpusCustomerAccount->add();

            return header("Location: ../customerAdmins");

        } catch (Exception $e) {
            die('Save failed: ' . $e->getMessage());
        }
    } else {
    }
} else {
    if (!empty($_GET['idCustomerAdmin'])) {
        if (!empty($_GET['view']) && $_GET['view'] == true) {
            $onlyView = true;
            $dataCustomer = new BodyOlimpusCustomerAccount($_GET['idCustomerAdmin']);
            echo $twig->render('admin/customerAdminsCRUD.twig', compact('nameView', 'context', 'dataCustomer', 'onlyView'));
            return;
        }
        $dataCustomer = new BodyOlimpusCustomerAccount($_GET['idCustomerAdmin']);
        echo $twig->render('admin/customerAdminsCRUD.twig', compact('nameView', 'context', 'dataCustomer'));
    } else {
        echo $twig->render('admin/customerAdminsCRUD.twig', compact('nameView', 'context'));
    }
}
