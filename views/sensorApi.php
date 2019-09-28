<?php

require 'Slim/Slim.php';
require_once '../model/Sensor.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/valorGrafico','valorGrafico');

$app->run();
       
function request() {
     $request = \Slim\Slim::getInstance()->request();
    return $data = json_decode($request->getBody());
}   

function carregar() {
    $data = request();

    $sensor = new Sensor();
    
    $sensor->setTemperatura($data->temperatura);
    $sensor->setUmidade($data->umidade);
    $sensor->setUmidadeSolo($data->umidadeSolo);
    $sensor->setSensorChuva($data->sensorChuva);
    
    return $sensor; 
}
function valorGrafico() {   
    $sensor = new Sensor();
  
    echo json_encode($sensor->getValores());
}
