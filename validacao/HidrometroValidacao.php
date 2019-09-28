<?php

include_once '../model/Hidrometro.php';
include_once '../model/MensagemRetorno.php';
include_once '../dao/HidrometroDao.php';

class HidrometroValidacao {
    public function cadastroHidrometroValidacao(Hidrometro $hidrometro) {
       
        if($hidrometro->tag === null || $hidrometro->tag === ""){
             $retorno = new MensagemRetorno("erro", "Tag não pode ser vazio");
             return $retorno;
        } else {
            $hidrometroDao = new HidrometroDao();
            $existe = $hidrometroDao->getPorTag($hidrometro);            
            if($existe === "vazio"){
                $retorno = new MensagemRetorno("sucesso", "");
                return $retorno;
            } else {
                $retorno = new MensagemRetorno("erro", "Tag escolhida já existe.");
                return $retorno;
            }
            
        }
    }
}
