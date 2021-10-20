<?php
require_once (__DIR__) . '\..\config\config.php';
include (__DIR__) . '\..\classes\DB.php';
class index
{

    public function initContent(){
        // parent::initContent();
    }

    public function postProcess(){
         $saludos = [
            'hello' => 'que dice',
            'name' => 'Jonny'
        ];
        $quepaso = $DB->connect();
    }
}
echo $twig->render('index.twig', compact('saludos', $quepaso));
