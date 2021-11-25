<?php
require_once __DIR__.'/../path/vendor/autoload.php';

define('APP_ROOT', __DIR__);
$loader = new \Twig\Loader\FilesystemLoader(APP_ROOT . '/../views/templates/front'); // aqui buscara las vistas (render)
$twig = new \Twig\Environment($loader);

// $twig = new \Twig\Environment($loader, [
//     'cache' => '/path/compilation_cache',
// ]);