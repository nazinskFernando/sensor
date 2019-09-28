<?php

require 'Slim/Slim.php';
require_once '../model/Hidrometro.php';
require_once '../interface/HidrometroInterface.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/cadastroHidrometro','cadastroHidrometro');
$app->post('/buscarHidrometroTag','buscarHidrometroTag'); 
$app->post('/buscarHidrometroId','buscarHidrometroId'); 


$app->run();
       
function request() {
     $request = \Slim\Slim::getInstance()->request();
    return $data = json_decode($request->getBody());
}   

function carregar() {
    $data = request();

    $hidrometro = new Hidrometro();
    $hidrometro->setId($data->id);
    $hidrometro->setTag($data->tag);
    
    return $hidrometro; 
}

function cadastroHidrometro() {   
    $hidrometro = carregar();
  
    echo json_encode($hidrometro->cadastroHidrometro($hidrometro));
}

function buscarHidrometroTag() {   
    $hidrometro = carregar();  
    echo json_encode($hidrometro->buscarHidrometroTag($hidrometro));
}

function buscarHidrometroId() {   
    $hidrometro = carregar();  
    echo json_encode($hidrometro->buscarHidrometroId($hidrometro));
}
