<?php

require_once 'Conexao.php';
require_once '../model/Usuario.php';

class UsuarioDao {

     public function getPorId(Usuario $usuario) {
         
        $c = new conexao();
        $usuario = $c->selectDB("SELECT * FROM usuario where id = '$usuario->id'");        
        return $usuario;
    }
    
    public function getPorEmail(Usuario $usuario) {
        $c = new conexao();
        $usuario = $c->selectDB("SELECT * FROM usuario where email = '$usuario->email'");        
        return $usuario;
    }
    public function updateSenha($email, $senhaNova) {
        $c = new conexao();
        $usuario = $c->updateDB("UPDATE usuario SET senha = '$senhaNova' WHERE email = '$email'");       
        return $usuario;
    }
    
    public function salvar(Usuario $usuario) {
        $c = new conexao();

        return $c->insertDB("INSERT INTO usuario (id, email, nome, senha, status, dtUltimoLogin, dtCadastro) "
                . "VALUES (NULL, '$usuario->email','$usuario->nome', '$usuario->senha', '$usuario->status', '$usuario->dtUltimoLogin', "
                . "'$usuario->dtCadastro')");
    }

    public function login($usuario) {
        
        $c = new conexao();
        $usuario = $c->selectDB("SELECT id, email, nome, status FROM usuario where email = '$usuario->email' and senha = '$usuario->senha'");        
        return $usuario;
    }

}
