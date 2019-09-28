<?php

require_once '../dao/HidrometroDao.php';
require_once '../validacao/HidrometroValidacao.php';
require_once '../interface/HidrometroInterface.php';

class Hidrometro implements HidrometroInterface{
    public $id;
    public $tag;   
    
    public function buscarHidrometroId(\Hidrometro $hidrometro) {
       $hidrometroDao = new HidrometroDao();
       $retorno = $hidrometroDao->getPorId($hidrometro);
       if($retorno != "vazio"){
           return $retorno;
       } else {
           return "Id incorreta";  
       } 
     }    

    public function buscarHidrometroTag(\Hidrometro $hidrometro) {
        $hidrometroDao = new HidrometroDao();
        $retorno = $hidrometroDao->getPorTag($hidrometro);
        if($retorno != "vazio"){
            return $retorno;
        } else {
            return "Tag incorreta";  
        }
    }

    public function cadastroHidrometro(\Hidrometro $hidrometro) {
        $retorno = new HidrometroValidacao();
        $mensagemRetorno = $retorno->cadastroHidrometroValidacao($hidrometro);
        
        if($mensagemRetorno->tipoMensagem === "sucesso"){
           $hidrometroDao = new HidrometroDao();
           $hidrometro = $hidrometroDao->salvar($hidrometro);           
            if($hidrometro !== "erro"){
                return "ok";
            } else {
                return "Erro ao salvar hidrômetro";
            }
        } else {
            return $mensagemRetorno->mensagem;
        }      
    }
  
    function getId() {
        return $this->id;
    }

    function getTag() {
        return $this->tag;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTag($tag) {
        $this->tag = $tag;
    }  

}
