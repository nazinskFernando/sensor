<?php

require_once 'Conexao.php';
require_once '../model/ConfiguracaoHidrometro.php';

class ConfiguracaoHidrometroDao {    
    
    public function salvar(ConfiguracaoHidrometro $configuracaoHidrometro) {
        $c = new conexao();      

        return $c->insertDB("INSERT INTO configuracaohidrometro (id, usuario_Id, hidrometro_Tag, valorHidrometroAtual, valorPulso, nomeHidrometro)"
                . " VALUES (NULL, '$configuracaoHidrometro->usuario_Id', '$configuracaoHidrometro->hidrometro_Tag', "
                . "'$configuracaoHidrometro->valorHidrometroAtual' ,'$configuracaoHidrometro->valorPulso', '$configuracaoHidrometro->nomeHidrometro')");
    }
      
    public function getPorTag(ConfiguracaoHidrometro $configuracaoHidrometro) {
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM configuracaohidrometro where hidrometro_Tag = '$configuracaoHidrometro->hidrometro_Tag'");        
        
        $configuracaoHidrometro = array($configuracaoHidrometro);
        if ($retorno !== "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $configuracaoHidrometro[$index] = $retorno[$index];
            }
            return $configuracaoHidrometro;
        } else {
            return "vazio";
        }       
    }
    public function getPorTagUsuario(ConfiguracaoHidrometro $configuracaoHidrometro) {
        $c = new conexao();
        $configuracaoHidrometro = $c->selectDB("SELECT * FROM configuracaohidrometro where hidrometro_Tag = '$configuracaoHidrometro->hidrometro_Tag' and usuario_Id = '$configuracaoHidrometro->usuario_Id'");        
        return $configuracaoHidrometro;
    }
    public function getPorHidUsuario(ConfiguracaoHidrometro $configuracaoHidrometro) {
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM configuracaohidrometro where usuario_Id = '$configuracaoHidrometro->usuario_Id'");        
      
        $configuracaoHidrometro = array($configuracaoHidrometro);
        if ($retorno !== "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $configuracaoHidrometro[$index] = $retorno[$index];
            }
            return $configuracaoHidrometro;
        } else {
            return "vazio";
        }
    }
    public function getPorId($id) {
        $c = new conexao();
        $configuracaoHidrometro = $c->selectDB("SELECT * FROM configuracaohidrometro where id = '$id'");        
        return $configuracaoHidrometro;
    }

    public function remover(ConfiguracaoHidrometro $configuracaoHidrometro) {
        $c = new conexao();
        return $c->deleteDB("DELETE FROM configuracaohidrometro WHERE configuracaohidrometro.hidrometro_Tag = '$configuracaoHidrometro->hidrometro_Tag' "
                . "         AND configuracaohidrometro.usuario_Id = '$configuracaoHidrometro->usuario_Id'");
    }
    
    public function editar(ConfiguracaoHidrometro $configuracaoHidrometro) {       
        $usuario_Id = '';
        $valorHidrometroAtual = '';
        $hidrometro_Tag = '';
        $valorPulso = '';
        $nomeHidrometro = '';
        
        $contador = 0;
        
        $c = new conexao();
        $conf = new ConfiguracaoHidrometro();
        $conf = $this->getPorTag($configuracaoHidrometro);
        
        $inicio = "UPDATE configuracaohidrometro SET" ; 
             if($conf[0]->usuario_Id != $configuracaoHidrometro->usuario_Id){
                $contador != 0 ? $virgula = ", ": $virgula = "";
                $usuario_Id =  " usuario_Id = '$configuracaoHidrometro->usuario_Id', ";
                $hidrometro_Tag = $virgula . $hidrometro_Tag;
             }
             if($conf[0]->hidrometro_Tag != $configuracaoHidrometro->hidrometro_Tag){
                 $contador != 0 ? $virgula = ", ": $virgula = "";
                 $hidrometro_Tag = ", hidrometro_Tag = '$configuracaoHidrometro->hidrometro_Tag' ";
                 $hidrometro_Tag = $virgula . $hidrometro_Tag;
             }
             if($conf[0]->valorHidrometroAtual != $configuracaoHidrometro->valorHidrometroAtual){
                 $contador != 0 ? $virgula = ", ": $virgula = "";
                 $valorHidrometroAtual = " valorHidrometroAtual = '$configuracaoHidrometro->valorHidrometroAtual' ";
                 $valorHidrometroAtual = $virgula . $valorHidrometroAtual;
             }
             if($conf[0]->valorPulso != $configuracaoHidrometro->valorPulso){
                 $contador != 0 ? $virgula = ", ": $virgula = "";
                 $valorPulso = ", valorPulso = '$configuracaoHidrometro->valorPulso' ";
                 $valorPulso = $virgula . $valorPulso;
             }
             if($conf[0]->nomeHidrometro != $configuracaoHidrometro->nomeHidrometro){
                 $contador != 0 ? $virgula = ", ": $virgula = "";
                 $nomeHidrometro = ", nomeHidrometro = '$configuracaoHidrometro->nomeHidrometro'  ";
                 $nomeHidrometro = $virgula . $nomeHidrometro;
             }           
            $fim = " WHERE id = '$configuracaoHidrometro->id'";
             
             $query = $inicio . $usuario_Id . $valorHidrometroAtual .$valorPulso . $nomeHidrometro . $fim;
       
        return $c->updateDB($query);
   
    }

}
