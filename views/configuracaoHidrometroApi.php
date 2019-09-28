<?php

require 'Slim/Slim.php';
require_once '../model/ConfiguracaoHidrometro.php';
require_once '../interface/ConfiguracaoHidrometroInterface.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/cadastroConfiguracao','cadastroConfiguracao');
$app->post('/hidrometrosUsuario','hidrometrosUsuario');
$app->post('/cadastrarConfiguracaoHidrometro','cadastrarConfiguracaoHidrometro');
$app->post('/editarConfiguracaoHidrometro','editarConfiguracaoHidrometro');
$app->post('/apagarConfiguracaoHidrometro','apagarConfiguracaoHidrometro');
$app->post('/buscar','buscar');
  

$app->run();
       
function request() {
     $request = \Slim\Slim::getInstance()->request();
    return $data = json_decode($request->getBody());
}   

function carregar() {
    $data = request();

    $configuracaoHidrometro = new ConfiguracaoHidrometro();
    $configuracaoHidrometro->setId($data->id);
    $configuracaoHidrometro->setUsuario_Id($data->usuario_Id);
    $configuracaoHidrometro->setHidrometro_Tag($data->hidrometro_Tag);
    $configuracaoHidrometro->setNomeHidrometro($data->nomeHidrometro);
    $configuracaoHidrometro->setValorHidrometroAtual($data->valorHidrometroAtual);
    $configuracaoHidrometro->setValorPulso($data->valorPulso);
    $configuracaoHidrometro->setValorHidrometroAtual($data->valorHidrometroAtual);        
      
    return $configuracaoHidrometro; 
}

function cadastroConfiguracao() {       
    $configuracaoHidrometro = carregar();    
    echo json_encode($configuracaoHidrometro->cadastroConfiguracao($configuracaoHidrometro));
}

function buscar() {       
    $configuracaoHidrometro = carregar();    
    echo json_encode($configuracaoHidrometro->buscar($configuracaoHidrometro));
}

function editarConfiguracaoHidrometro() {   
    $configuracaoHidrometro = carregar();    
    echo json_encode($configuracaoHidrometro->editarConfiguracaoHidrometro($configuracaoHidrometro));
}

function apagarConfiguracaoHidrometro() {   
    
    $configuracaoHidrometro = carregar();    
    echo json_encode($configuracaoHidrometro->apagarConfiguracaoHidrometro($configuracaoHidrometro));
}
function hidrometrosUsuario() {   
    
    $configuracaoHidrometro = carregar();    
    echo json_encode($configuracaoHidrometro->hidrometrosUsuario($configuracaoHidrometro));
}