<?php
require_once '../dao/UsuarioDao.php';
require_once '../model/Usuario.php';

class EnvioDeEmail {
    
    function enviarEmail(Usuario $usuario) {
        $usuarioDao = new UsuarioDao();
        $remetente = "fernando.nazinsk@gmail.com";
        
        $usuario = $usuarioDao->getPorEmail($usuario);   
              
        if ($usuario === "vazio") {
            return "usuarioNaoEncontrado";
        } else {
            $corpo_email = "Ola, o procedimento de recuperar dados, foi efetuado com sucesso !\n..";
            $corpo_email .= "Senha de acesso = " . $usuario[0]->senha . "\n..";
            $corpo_email .= "Seu email = " . $usuario[0]->email . "\n.. ";
            $corpo_email .= "Nao responda esse email, e-Mail automatizado";
            @mail($usuario[0]->email, "Recuperacao de Senha", $corpo_email, $remetente);
            return "ok";
        }
    }
}
