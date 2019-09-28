<?php

include_once '../interface/UsuarioInterface.php';
include_once '../dao/UsuarioDao.php';

include_once '../validacao/UsuarioValidacao.php';
include_once '../model/MensagemRetorno.php';
include_once '../auxiliar/EnvioDeEmail.php';

class Usuario implements UsuarioInterface {

    public $id;
    public $email;
    public $nome;
    public $senha;
    public $status;
    public $dtUltimoLogin;
    public $dtCadastro;
    
    public function login(\Usuario $usuario) {
        $usuarioValidacao = new UsuarioValidacao();
        $usuarioDao = new UsuarioDao();
        
        $mensagemRetorno = $usuarioValidacao->validarLogin($usuario);         
        if($mensagemRetorno->getTipoMensagem() == "sucesso"){ 
           $usuario = $usuarioDao->getPorEmail($usuario);
           $mensagemRetorno->setMensagem($usuario[0]);
           return $mensagemRetorno;
        }else{
            return $mensagemRetorno;
        } 
    }
    
    public function cadastrarUsuario(\Usuario $usuario) {
        $usuarioDao = new UsuarioDao();
        $usuarioValidacao = new UsuarioValidacao();       
                
        $mensagemRetorno = $usuarioValidacao->validarUsuario($usuario);
     
        if($mensagemRetorno->getTipoMensagem() === "sucesso"){
            $usuario->setDtCadastro();
            $retorno= $usuarioDao->salvar($usuario);            
            if($retorno != "erro"){                
                $usuario = $usuarioDao->getPorEmail($usuario);
                $mensagemRetorno->setMensagem($usuario[0]);
                return $mensagemRetorno;
            }else{
                return "erro ao cadastrar";
            }
        }else{
            return $mensagemRetorno;
        }
    }
    
    public function recuperarSenha(\Usuario $usuario) {
       $envioDeEmail = new EnvioDeEmail();
        $retorno = $envioDeEmail->enviarEmail($usuario);
        if($retorno === "ok"){
           return "ok";  
        }else{
            return $retorno;
        }  
    }

    public function alterarSenha(\Usuario $usuario) {
        $usuarioValidacao = new UsuarioValidacao();        
        $usuarioDao = new UsuarioDao();
        $mensagemRetorno = $usuarioValidacao->validarAlterarSenha($email, $senhaCorrente, $senhaNova);
        if($mensagemRetorno->tipoMensagem === "sucesso"){
            $alterar = $usuarioDao->updateSenha($email, $senhaNova);
            if($alterar != "erro"){
                return "ok";
            } else {
                return "erro ao alterar senha";
            }
        }else{
             return $mensagemRetorno->getMensagem();
        }    
    }

    public function buscarUsuario(\Usuario $usuario) {
        $usuarioDao = new UsuarioDao();
        
        $usuario = $usuarioDao->getPorId($usuario);
        return $usuario;
    }

    public function verificarAcesso(\Usuario $usuario) {
        $usuarioValidacao = new UsuarioValidacao();
        
        $mensagemRetorno = $usuarioValidacao->validarVerificarAcesso($usuario); 
        if($mensagemRetorno->getTipoMensagem() === "sucesso"){
            $usuario = $mensagemRetorno->getMensagem();
            return $usuario->status;
        } else {
          return $mensagemRetorno;
        }
    }


    //------------------------------ gets and sets---------------------
    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setStatus($status) {
        $this->status = $status;
    }

   function setDtUltimoLogin() {        
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date("Y-m-d H:i:s");
        $this->dtUltimoLogin = $hoje;
    }

    function setDtCadastro() {
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date("Y-m-d H:i:s");
        $this->dtCadastro = $hoje;
    }

}