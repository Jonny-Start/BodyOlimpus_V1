<?php
require_once __DIR__ . '/../config/config.php';
require(__DIR__ . '/../classes/BodyOlimpusUser.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
} else {
    $id_user = $_SESSION['user_id'];
    $dataUser = BodyOlimpusUser::getDataUserIMC($id_user);
    if (!empty($dataUser) && !empty($dataUser['actual_weight']) && !empty($dataUser['height_user'])) {
        //Calcular IMC
        $peso = number_format(($dataUser['actual_weight']), 1);
        $estatura = number_format($dataUser['height_user'], 2); //numero de decimales
        $estaturaC = pow($estatura, 2); //elevar al cuadrado peso
        $IMC = number_format(($peso / $estaturaC), 2);
        if ($dataUser['gender'] == 'Mujer') {
            if ($IMC < 20) {
                $IMCtext = 'Peso bajo';
            } else if ($IMC >= 20 && $IMC <= 25) {
                $IMCtext = 'Peso normal';
            } else if ($IMC >= 26.1 && $IMC <= 30) {
                $IMCtext = 'Sobre peso';
            } else if ($IMC >= 31.1 && $IMC <= 40) {
                $IMCtext = 'Obesidad';
            } else if ($IMC > 40) {
                $IMCtext = 'Obesidad Mórbida';
            }
        } else {
            if ($IMC < 20) {
                $IMCtext = 'Peso bajo';
            } else if ($IMC >= 20 && $IMC <= 27) {
                $IMCtext = 'Peso normal';
            } else if ($IMC >= 27.1 && $IMC <= 30) {
                $IMCtext = 'Sobre peso';
            } else if ($IMC >= 30.1 && $IMC <= 40) {
                $IMCtext = 'Obesidad';
            } else if ($IMC > 40) {
                $IMCtext = 'Obesidad Mórbida';
            }
        }

        //Crear datos para grafica
        $dataUser = BodyOlimpusUser::getDataUserChart($id_user);

        if (!empty($dataUser)) {
            // echo json_encode($dataUser);
            // die();
            $dateArray = [];
            $pesoArray = [];
            foreach ($dataUser as $dataUser) {
                $meses = array("'Enero'", "'Febrero'", "'Marzo'", "'Abril'", "'Mayo'", "'Junio'", "'Julio'", "'Agosto'", "'Septiembre'", "'Octubre'", "'Noviembre'", "'Diciembre'");
                $mesDate = date("n", strtotime($dataUser['fecha'])); //de fecha a string y le saco el d¿numero del mes
                $mesSave = $meses[$mesDate - 1];
                array_push($dateArray, $mesSave);
                array_push($pesoArray, $dataUser['peso']);
            }

            $dateFormat = implode(", ", $dateArray);
            $weightFormat = implode(", ", $pesoArray);

            $nameView = 'bo_graphics';
            echo $twig->render('front/graphics.twig', compact('nameView', 'IMC', 'IMCtext', 'dateFormat', 'weightFormat'));

        } else {
            $nameView = 'bo_graphics';
            $message = [
                'type' => 'error',
                'text' => 'Aun no tienes datos para graficar'
            ];
            echo $twig->render('front/graphics.twig', compact('nameView', 'message'));
        }
    } else {
        $nameView = 'bo_graphics';
        $message = [
            'type' => 'error',
            'text' => 'Aun no tienes datos para graficar'
        ];
        echo $twig->render('front/graphics.twig', compact('nameView', 'message'));
    }
}
