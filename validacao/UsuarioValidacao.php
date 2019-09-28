<?php
include_once '../model/Usuario.php';
include_once '../model/MensagemRetorno.php';
include_once '../dao/UsuarioDao.php';

class UsuarioValidacao {
    
    public function  validarUsuario(Usuario $usuario){
     
         
        if($usuario->getNome() === null || $usuario->getNome() === ""){
            $retorno = new MensagemRetorno("erro", "nomeNaoPodeSerVazio");
            return $retorno;
            
        } else if($usuario->getEmail() === null || $usuario->getEmail() === ""){
            $retorno = new MensagemRetorno("erro", "emailNaoPodeSerVazio");
            return $retorno;
  
        } else if($usuario->getSenha() === null || $usuario->getSenha() === ""){
            $retorno = new MensagemRetorno("erro", "senhaNaoPodeSerVazio");
            return $retorno;       
            
        }else{          
                       
            $usuarioDao = new UsuarioDao();
            //$usuario->setSenha(md5($usuario->getSenha()));
            $isLogin = $usuarioDao->getPorEmail($usuario);
                    
            if($isLogin != "vazio"){
                $retorno = new MensagemRetorno("erro", "usuarioJaExiste");
                return $retorno;
            }else{
               $retorno = new MensagemRetorno("sucesso", "");                     
                return $retorno;
            }
            
        }
    }
    
    public function validarLogin(Usuario $usuario) {       
        
        if($usuario->getEmail() == null || $usuario->getEmail() == "" ){
            
            $retorno = new MensagemRetorno("erro", "emailNaoPodeSerVazio");          
            return $retorno;
        }else if($usuario->getSenha() == null || $usuario->getSenha() == ""){
            
            $retorno = new MensagemRetorno("erro", "senhaNaoPodeSerVazio"); 
            return $retorno;
        } else {
                      
            $usuarioDao = new UsuarioDao();
            $usuario = $usuarioDao->login($usuario);
            
           if($usuario === "vazio"){
                $retorno = new MensagemRetorno("erro", "usuarioNaoExiste");
                return $retorno;
            }else{
                $retorno = new MensagemRetorno("sucesso", '');                           
                return $retorno;
            }
             
        }
    }

    public function validarVerificarAcesso($usuario) {
        if($usuario->id != null){
            $usuarioDao = new UsuarioDao();
            $usuario = $usuarioDao->getPorId($usuario);
            $retorno = new MensagemRetorno("sucesso", $usuario[0]);
            return $retorno;
        } else {
            $retorno = new MensagemRetorno("erro", "Sem usuário escolhido");
            return $retorno;
        }
    }

    public function validarAlterarSenha($email, $senhaCorrente, $senhaNova) {
        $usuarioDao = new UsuarioDao();
        $usuario = new Usuario();
             
        if($email === null || $email === ""){
            $retorno = new MensagemRetorno("erro", "O E-mail está vazio"); 
            return $retorno;
        }else if($senhaCorrente === null || $senhaCorrente === ""){
            $retorno = new MensagemRetorno("erro", "Senha corrente informada não pode ser vazio"); 
            return $retorno;
        }else if($senhaNova === null || $senhaNova === ""){
             $retorno = new MensagemRetorno("erro", "Nova senha informada não pode ser vazio"); 
            return $retorno;
        }else{
             $usuario->setEmail($email);
             $usuario->setSenha($senhaCorrente);
            
             $usuario = $usuarioDao->login($usuario);
             if($usuario != "vazio"){
                 $retorno = new MensagemRetorno("sucesso", $usuario[0]); 
                return $retorno; 
             }else{
                $retorno = new MensagemRetorno("erro", "Dados informado está incorreto"); 
                return $retorno; 
             }
        }
    }

}
