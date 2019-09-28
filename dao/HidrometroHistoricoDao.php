<?php
require_once 'Conexao.php';
include_once '../model/HidrometroHistorico.php';

class HidrometroHistoricoDao {
    
   public function salvar(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();       

        return $c->insertDB("INSERT INTO historicohidrometro (id, tag, valorPulso, dtPulso) VALUES (NULL, "
                . " '$hidrometroHistorico->tag', '$hidrometroHistorico->valorPulso', '$hidrometroHistorico->dtPulso')");
    }
        
    public function getPorId(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM historicohidrometro where id = '$hidrometroHistorico->id'");        
         $hidrometroHistoricoList = array($hidrometroHistorico);
        if ($retorno !== "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $hidrometroHistoricoList[$index] = $retorno[$index];
            }
            return $hidrometroHistoricoList;
        } else {
            return "vazio";
        }
    }
    
    public function getValorAtualHidrometro(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();
       $retorno = $c->selectDB("SELECT SUM(valorPulso) as valor FROM historicohidrometro where tag = '$hidrometroHistorico->tag' "
                . " and dtPulso like '%$hidrometroHistorico->dtPulso%' "
                . " and usuario_id = '$hidrometroHistorico->usuario_id' order by id DESC"); 
        return $retorno;
       
    }
    
    public function getPorTagData(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();
        
        $retorno = $c->selectDB("SELECT * FROM historicohidrometro where tag = '$hidrometroHistorico->tag' "
                . " and dtPulso like '%$hidrometroHistorico->dtPulso%'");  
        
        $hidrometroHistoricoList = array($hidrometroHistorico);
        if ($retorno != "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $hidrometroHistoricoList[$index] = $retorno[$index];
            }
            return $hidrometroHistoricoList;
        } else {
            return "vazio";
        }
    }

    
    public function getPorTag(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();        
        
        $retorno = $c->selectDB("SELECT * FROM historicohidrometro where tag= '$hidrometroHistorico->tag'");        
        $hidrometroHistoricoList = array($hidrometroHistorico);

        if ($retorno != "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $hidrometroHistoricoList[$index] = $retorno[$index];
            }
            return $hidrometroHistoricoList;
        } else {
            return "vazio";
        }
    }
    public function getPorTagDataDia(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();
        
        $retorno = $c->selectDB("SELECT HOUR(dtPulso) as dtPulso, valorPulso FROM historicohidrometro where tag = '$hidrometroHistorico->tag' "
                . " and dtPulso like '%$hidrometroHistorico->dtPulso%' "
                . " and usuario_id = '$hidrometroHistorico->usuario_id' order by id ASC"); 
                
        return $retorno;
    }
    
    public function getPorTagDataMes(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();
        
        $retorno = $c->selectDB("SELECT sum(valorPulso) as valorPulso, day(dtPulso) as dia FROM historicohidrometro where tag = '$hidrometroHistorico->tag' "
                . " and dtPulso like '%$hidrometroHistorico->dtPulso%' "
                . " and usuario_id = '$hidrometroHistorico->usuario_id' GROUP BY dia order by id ASC"); 
                
        return $retorno;
    }
    
    public function getPorTagDataAno(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();
        
        $retorno = $c->selectDB("SELECT sum(valorPulso) as valorPulso, month(dtPulso) as mes FROM historicohidrometro where tag = '$hidrometroHistorico->tag' "
                . " and dtPulso like '%$hidrometroHistorico->dtPulso%' "
                . " and usuario_id = '$hidrometroHistorico->usuario_id' GROUP BY mes order by id ASC"); 
                
        return $retorno;
    }
    
    public function getPorTagHistorico(HidrometroHistorico $hidrometroHistorico) {
        $c = new conexao();
        
        $retorno = $c->selectDB("SELECT valorPulso, dtPulso FROM historicohidrometro where tag = '$hidrometroHistorico->tag' "
                . " and dtPulso like '%$hidrometroHistorico->dtPulso%'"); 
        
        $hidrometroHistoricoList = array($hidrometroHistorico);
        if ($retorno != "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $hidrometroHistoricoList[$index] = $retorno[$index];
                
            }
            return $hidrometroHistoricoList;
        } else {
            return "vazio";
        }
    }
    
    public function editar(HidrometroHistorico $hidrometroHistorico) { 
        $c = new conexao();
        return $c->updateDB("UPDATE historicohidrometro SET "
                . " valorPulso = '$hidrometroHistorico->valorPulso', "
                . " dtPulso = '$hidrometroHistorico->dtPulso' "
                . " WHERE id = '$hidrometroHistorico->id'");   
    }    
  
}
