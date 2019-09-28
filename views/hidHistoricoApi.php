<?php

require 'Slim/Slim.php';
require_once '../model/HidrometroHistorico.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


$app->post('/historicoDia','historicoDia');



$app->run();
       
function request() {
     $request = \Slim\Slim::getInstance()->request();
    return $data = json_decode($request->getBody());
}   

function carregar() {
    $data = request();

    $hidrometroHistorico = new HidrometroHistorico();
    
    $hidrometroHistorico->setId($data->id);
    $hidrometroHistorico->setTag($data->tag);
    $hidrometroHistorico->setValorPulso($data->valorPulso);
    $hidrometroHistorico->setUsuario_id($data->usuario);
    $hidrometroHistorico->setDtPulso($data->dtPulso);
    
    return $hidrometroHistorico; 
}
function historicoDia() {   
    $hidrometroHistorico = carregar();
  
    echo json_encode($hidrometroHistorico->historicoDia($hidrometroHistorico));
}
