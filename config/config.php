<?php
require_once __DIR__ . '/../path/vendor/autoload.php';

define('APP_ROOT', __DIR__);
$loader = new \Twig\Loader\FilesystemLoader(APP_ROOT . '/../views/templates/'); // aqui buscara las vistas (render)
$twig = new \Twig\Environment($loader);
/**
 * Funciones globales
 */

function pushContext($name, $var)
{
    if (empty($_SESSION["context"])) {
        $_SESSION["context"] = array($name => $var);
    } else {
        $_SESSION["context"] = array_merge($_SESSION["context"], array($name => $var));
    }
}

// $twig = new \Twig\Environment($loader, [
//     'cache' => '/path/compilation_cache',
// ]);