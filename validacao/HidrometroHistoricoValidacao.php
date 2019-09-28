<?php

include_once '../model/MensagemRetorno.php';
include_once '../model/HidrometroHistorico.php';

class HidrometroHistoricoValidacao {
   
    public function cadastro(HidrometroHistorico $hidrometroHistorico) {
        if($hidrometroHistorico->tag === null || $hidrometroHistorico->tag === ""){
            $retorno  = new MensagemRetorno("erro", "Tag não pode ser vazio");
            return $retorno;        
        } else if($hidrometroHistorico->dtPulso === null || $hidrometroHistorico->dtPulso =="" ) {
            $retorno  = new MensagemRetorno("erro", "Data não pode ser vazio");
            return $retorno;
        } else if($hidrometroHistorico->valorPulso === null || $hidrometroHistorico->valorPulso =="" ) {
            $retorno  = new MensagemRetorno("erro", "Valor não pode ser vazio");
            return $retorno;
        } else {
            $retorno  = new MensagemRetorno("sucesso", "");
            return $retorno;
        }
    }
}
