<?php

interface UsuarioInterface {
    public function login(Usuario $usuario);
    public function buscarUsuario(Usuario $usuario);
    public function cadastrarUsuario(Usuario $usuario);
    public function verificarAcesso(Usuario $usuario);
    public function recuperarSenha(Usuario $usuario);
    public function alterarSenha(Usuario $usuario);    
}
