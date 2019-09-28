<?php

require_once 'Conexao.php';
require_once '../model/Hidrometro.php';

class HidrometroDao {
    
    public function salvar(Hidrometro $hidrometro) {
        $c = new conexao();       

        return $c->insertDB("INSERT INTO hidrometro (id, tag) VALUES (NULL, '$hidrometro->tag')");
    }
    
    public function getPorId(Hidrometro $hidrometro) {
        $c = new conexao();
        $hidrometro = $c->selectDB("SELECT * FROM hidrometro where id = '$hidrometro->id'");        
        return $hidrometro;
    }
    
    public function getPorTag(Hidrometro $hidrometro) {
        $c = new conexao();
        $hidrometro = $c->selectDB("SELECT * FROM hidrometro where tag = '$hidrometro->tag'");        
        return $hidrometro;
    }
    
}
