<?php
require_once 'Conexao.php';
require_once '../model/Usuario.php';
require_once '../model/Vendedor.php';

class vendedorDao {
    
    
    
        public function buscar_senha(Vendedor $v){    
      
        $c = new conexao();
        $retorno = $c->selectDB("SELECT usuario.id_usuario FROM usuario INNER JOIN usuario_vendedor WHERE usuario_vendedor.id_vendedor = '$v->id_vendedor' AND usuario.id_usuario = usuario_vendedor.id_usuario AND usuario.senha_usuario= '$v->senha_usuario'");
   
        if($retorno==="vazio"){
            return $retorno;
        }else{
        $arrayVendedor = array($v);
            $arrayVendedor2 = array();
            for ($index = 0; $index < count($retorno); $index++) {
                   $arrayVendedor[$index] = $retorno[$index];
                 }

                 return $arrayVendedor[0]->id_usuario;
        }
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
    
      public function buscar_imagem(Vendedor $v){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT imagemEmpresa FROM usuario_vendedor WHERE id_vendedor = '$v->id_vendedor'");
      
        //////////////////////////////////////////////////////////////////////////////////qqqq
       $arrayVendedor = array($v);
     $arrayVendedor2 = array();
     for ($index = 0; $index < count($retorno); $index++) {
            $arrayVendedor[$index] = $retorno[$index];
          }
        
          return $arrayVendedor[0]->imagemEmpresa;
    
     
    }
    public function buscar_nomeEmpresa(Vendedor $v){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT nomeEmpresa FROM usuario_vendedor WHERE id_vendedor = '$v->id_vendedor'");
        
        //////////////////////////////////////////////////////////////////////////////////qqqq
     
        $arrayVendedor = array($v);
 
     for ($index = 0; $index < count($retorno); $index++) {
            $arrayVendedor[$index] = $retorno[$index];
          }
        
          return $arrayVendedor[0]->nomeEmpresa;
     
    }
    
    
    public function insert_usuario (Vendedor $v){
        
      $c = new conexao();     
        
       return $inserir = $c->insertDB("INSERT INTO usuario "
                     . "            (id_usuario, nome_usuario, email_usuario, senha_usuario, push_usuario, telefone_usuario, data_usuario) VALUES"
                     . "            (NULL, '$v->nome_usuario', '$v->email_usuario', '$v->senha_usuario', '$v->push_usuario', '$v->telefone_usuario', '$v->data_usuario')");
        
       
 
            
    }
      public function insert_usuarioFacebook (Vendedor $v){
        
      $c = new conexao();     
        
       return $inserir = $c->insertDB("INSERT INTO usuario "
                     . "            (id_usuario, nome_usuario, email_usuario, senha_usuario, push_usuario, telefone_usuario, data_usuario) VALUES"
                     . "            (NULL, '$v->nome_usuario', '$v->email_usuario', '', '$v->push_usuario', '$v->telefone_usuario', '$v->data_usuario')");
        
       
 
            
    }
    public function insert_vendedor (Vendedor $v){
        
         $c = new conexao();     
        
       return $inserir = $c->insertDB("INSERT INTO usuario_vendedor (id_vendedor, id_usuario, cpf_vendedor, ag_contaBancaria, cc_contaBancaria, cpf_contaBancaria, nome_Titular_contaBancaria, nomeBanco_ContaBancaria, verificacao_vendedor, nomeEmpresa, imagemEmpresa) VALUES "
               . "                     (NULL, '$v->id_usuario', '$v->cpf_vendedor', '$v->ag_contaBancaria', '$v->cc_contaBancaria', '$v->cpf_contaBancaria', '$v->nome_Titular_contaBancaria', '$v->nomeBanco_ContaBancaria', 0, '$v->nomeEmpresa','$v->imagemEmpresa')");
        
       
            
    }
    
       public function buscar_vendedorPeloID(Vendedor $v){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM usuario_vendedor WHERE id_vendedor = '$v->id_vendedor'");
        
        //////////////////////////////////////////////////////////////////////////////////qqqq
    $arrayVendedor = array($v);
     $arrayVendedor2 = array();
     for ($index = 0; $index < count($retorno); $index++) {
            $arrayVendedor[$index] = $retorno[$index];
          }
        
          return $arrayVendedor[0];
    
     
  
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
    public function buscar_vendedor(Vendedor $v){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM usuario WHERE email_usuario = '$v->email_usuario' and senha_usuario='$v->senha_usuario'");
        
        //////////////////////////////////////////////////////////////////////////////////qqqq
    $arrayVendedor = array($v);
     $arrayVendedor2 = array();
     for ($index = 0; $index < count($retorno); $index++) {
            $arrayVendedor[$index] = $retorno[$index];
          }
        
          return $arrayVendedor[0];
    
     
  
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
    public function buscar_vendedor_pendente(Vendedor $v){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM usuario_vendedor WHERE id_vendedor = '$v->id_vendedor' AND verificacao_vendedor = 0");
        
        return $retorno;
        //////////////////////////////////////////////////////////////////////////////////qqqq
 
    
     
  
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
     public function buscarPendenciaVendedor(){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM usuario_vendedor WHERE verificacao_vendedor = 0");
        
        return $retorno;
        //////////////////////////////////////////////////////////////////////////////////qqqq
 
    
     
  
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
    
    public function buscar_email(Vendedor $v){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM usuario WHERE email_usuario = '$v->email_usuario'");
        
   
        
          return $retorno;
    
     
  
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
    public function buscar_vendedorCompleto(Vendedor $v){       
      
        $c = new conexao();
        $retorno = $c->selectDB("SELECT usuario.email_usuario, usuario.id_usuario, usuario_vendedor.id_vendedor, usuario_vendedor.imagemEmpresa, usuario_vendedor.nomeEmpresa,"
                . " usuario.telefone_usuario, usuario_vendedor.verificacao_vendedor FROM usuario INNER JOIN usuario_vendedor WHERE usuario_vendedor.id_usuario = '$v->id_usuario' and usuario.id_usuario = usuario_vendedor.id_usuario");
        if($retorno!=="vazio"){
    
                $arrayVendedor = array($v);
            
                 for ($index = 0; $index < count($retorno); $index++) {
                        $arrayVendedor[$index] = $retorno[$index];
                      }
        
        
        
          return $retorno[0];
        }else{
            return "vazio";
        }
     
  
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
    
    
    
    
        public function buscar_vendedorCompletoPeloVendedor(Vendedor $v){       
           
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM usuario INNER JOIN usuario_vendedor WHERE usuario_vendedor.id_vendedor = '$v->id_vendedor' and usuario.id_usuario = usuario_vendedor.id_usuario");
        
    if($retorno==="vazio"){
        return "vazio";
    }else{
        //////////////////////////////////////////////////////////////////////////////////qqqq
                $arrayVendedor = array($v);
            
                 for ($index = 0; $index < count($retorno); $index++) {
                        $arrayVendedor[$index] = $retorno[$index];
                      }
        
        
    
          return $retorno[0];
    
        }
  
     
   ////////////////////////////////////////////////////////////////////////////////////////qq
    }
    
    
    
    
    
    
    
    public function usuario_login(Vendedor $v){       
        
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM usuario WHERE email_usuario='$v->email_usuario' and senha_usuario = '$v->senha_usuario'");
         $arrayVendedor = array($v);
            $arrayVendedor2 = array();
            for ($index = 0; $index < count($retorno); $index++) {
                   $arrayVendedor[$index] = $retorno[$index];
                 }

                 return $arrayVendedor[0];

     
  
  
    }
    public function update_push(Vendedor $u) {
         $c = new conexao();
         return $c->updateDB("UPDATE usuario SET push_usuario = '$u->push_usuario' WHERE id_usuario = $u->id_usuario");
        
    }
    
    public function update_telefone(Vendedor $u) {
         $c = new conexao();
         return $c->updateDB("UPDATE usuario SET telefone_usuario = '$u->telefone_usuario' WHERE id_usuario = $u->id_usuario");
        
    }
     public function update_aguardarUsuarioEditar(Vendedor $v) {
        $c = new conexao();
        
       return $c->updateDB("UPDATE usuario_vendedor SET verificacao_vendedor = 2 WHERE usuario_vendedor.id_vendedor = '$v->id_vendedor'");
        
    }
    public function update_senha(Vendedor $u) {
         $c = new conexao();
         return $c->updateDB("UPDATE usuario SET senha_usuario = '$u->senha_usuario' WHERE id_usuario = $u->id_usuario");
        
    }
    
    public function CadContaBancaria(Vendedor $v) {
         $c = new conexao();
         return $c->updateDB("UPDATE usuario_vendedor SET ag_contaBancaria = '$v->ag_contaBancaria', cc_contaBancaria ='$v->cc_contaBancaria', cpf_contaBancaria = '$v->cpf_contaBancaria',"
                 . "nome_Titular_contaBancaria= '$v->nome_Titular_contaBancaria', nomeBanco_ContaBancaria = '$v->nomeBanco_ContaBancaria' WHERE id_vendedor = $v->id_vendedor");
        
    }
    
    public function delete(Vendedor $u) {
        $c = new conexao();
         return $c->deleteDB("DELETE FROM usuario WHERE id_usuario='$u->id_usuario'");
        
    }
    public function validarUsuario(Vendedor $v) {
        $c = new conexao();
        
       return $c->updateDB("UPDATE usuario_vendedor SET verificacao_vendedor = '1' WHERE usuario_vendedor.id_vendedor = '$v->id_vendedor'");
        
    }
}
