<?php
require_once __DIR__ . '../config.php';
$saludos = [
    'hello' => 'que dice',
    'name' => 'Jonny'
];

echo $twig->render('index.twig', compact('saludos'));