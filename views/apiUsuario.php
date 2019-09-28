<?php

require 'Slim/Slim.php';
require_once '../model/Usuario.php';
require_once '../interface/UsuarioInterface.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();



$app->post('/buscarUsuario','buscarUsuario');
$app->post('/cadastrarUsuario','cadastrarUsuario'); 
$app->post('/loginUsuario','loginUsuario'); 
$app->post('/verificarAcesso','verificarAcesso'); 
$app->post('/recuperarSenha','recuperarSenha');
$app->post('/alterarSenha','alterarSenha');


$app->run();
       
function request() {
      $request = \Slim\Slim::getInstance()->request();
    return $data = json_decode($request->getBody());
}   

function carregar() {
    $data = request();

   $usuario = new Usuario();

    $usuario->setId($data->id);
    $usuario->setEmail($data->email);
    $usuario->setNome($data->nome);
    $usuario->setSenha($data->senha);
    $usuario->setStatus($data->status); 
    return $usuario; 
 
}

function loginUsuario() {
    $usuario = carregar();
    echo json_encode($usuario->login($usuario));
}

function buscarUsuario() {      
    $usuario = carregar();  
    echo json_encode($usuario->buscarUsuario($usuario));
}

function cadastrarUsuario() {
    $usuario = carregar();  
    echo json_encode($usuario->cadastrarUsuario($usuario));
}

function verificarAcesso() {
    $usuario = carregar();  
    echo json_encode($usuario->verificarAcesso($usuario));
}

function recuperarSenha() {
    $usuario = carregar();  
    echo json_encode($usuario->recuperarSenha($usuario));
}

function alterarSenha() {
    $data = request();  
    $usuario = new Usuario();
    $email = $data->email;
    $senhaCorrente = $data->senhaCorrente;
    $senhaNova = $data->senhaNova;
  
    echo json_encode($usuario->alterarSenha($email, $senhaCorrente, $senhaNova));
}

?>

