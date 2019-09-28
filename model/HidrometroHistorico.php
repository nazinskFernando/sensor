<?php

include_once '../validacao/HidrometroHistoricoValidacao.php';
include_once '../dao/HidrometroHistoricoDao.php';
require_once '../interface/HistoricoHidrometroInterface.php';
require_once '../model/ConfiguracaoHidrometro.php';


class HidrometroHistorico implements HistoricoHidrometroInterface{
    public $id;
    public $tag;
    public $valorPulso;
    public $usuario_id;
    public $dtPulso;    
    
     public function buscarLeituraAtual(\HidrometroHistorico $hidrometroHistorico) {
        $hidrometroDao = new HidrometroHistoricoDao();
        $configuracao = new ConfiguracaoHidrometro();
        $configuracao->setHidrometro_Tag($hidrometroHistorico->tag);
        $configuracao->setUsuario_Id($hidrometroHistorico->usuario_id);
        
        $configuracao = $configuracao->configuracaoUsuarioTag($configuracao);
        $valorAtual = $hidrometroDao->getValorAtualHidrometro($hidrometroHistorico);
        return $configuracao[0]->valorHidrometroAtual + $valorAtual[0]->valor;      
    }
    public function buscarHidrometroHistoricoId(\HidrometroHistorico $hidrometroHistorico) {
            $hidrometroDao = new HidrometroHistoricoDao();
            $hidrometroHistoricoList = $hidrometroDao->getPorId($hidrometroHistorico);
            if($hidrometroHistoricoList != "vazio"){
                return $hidrometroHistoricoList;
            } else {
                return "Não há histórico!";
            }  
    }    

    public function buscarHidrometroHistoricoTag(\HidrometroHistorico $hidrometroHistorico) {
        $hidrometroDao = new HidrometroHistoricoDao();
       
        $hidrometroHistoricoList = $hidrometroDao->getPorTag($hidrometroHistorico);
        return $hidrometroHistoricoList;
        if($hidrometroHistoricoList != "vazio"){
            return $hidrometroHistoricoList;
        } else {
            return "Não há histórico!";
        }
    }

    public function cadastroHidrometroHistorico(\HidrometroHistorico $hidrometroHistorico) {
        date_default_timezone_set('America/Sao_Paulo');
       $hoje = date("Y-m-d H:i:s");
       $datas = explode(":", $hoje);
       $hidrometroHistorico->setDtPulso($datas[0]);       
      
       $mensagemRetorno = new HidrometroHistoricoValidacao($hidrometroHistorico);     
       $retorno = $mensagemRetorno->cadastro($hidrometroHistorico);
       
       
       if($retorno->tipoMensagem === "sucesso"){
           $hidrometroHistoricoDao = new HidrometroHistoricoDao();
           $hidrometroDao = new HidrometroDao();
           $hidrometro = new Hidrometro();         
           
           $hidrometro->setTag($hidrometroHistorico->tag);           
           $hidrometro = $hidrometroDao->getPorTag($hidrometro);       
           
           $ultimoDado = $hidrometroHistoricoDao->getPorTagData($hidrometroHistorico);
           
           if($ultimoDado === "vazio"){
               
               $cadastro = $hidrometroHistoricoDao->salvar($hidrometroHistorico);               
           } else {                
              $hidrometroHistorico->setValorPulso($ultimoDado[0]->valorPulso + $hidrometroHistorico->valorPulso);
              $hidrometroHistorico->setId($ultimoDado[0]->id);
              //return $hidrometroHistorico;
              $cadastro = $hidrometroHistoricoDao->editar($hidrometroHistorico); 
           }         
                                 
           if($cadastro != "erro"){
               return "ok";
           } else {
               return "erro ao cadastrar";
           }
       } else {
           return $retorno->mensagem;
       }      
    }
    
    public function historicoDia(\HidrometroHistorico $hidrometroHistorico) {
        $hidrometroHistoricoDao = new HidrometroHistoricoDao(); 
        $configuracao = new ConfiguracaoHidrometro();
               
        $retorno = $hidrometroHistoricoDao->getPorTagDataDia($hidrometroHistorico);  
        $configuracao->setHidrometro_Tag($hidrometroHistorico->tag);
        $configuracao->setUsuario_Id($hidrometroHistorico->usuario_id);
        $configuracao = $configuracao->configuracaoUsuarioTag($configuracao);
        
        $hidrometroHistoricoList = array($hidrometroHistorico); 
        $count = 0;
        $consumoTotal = 0;
        if ($retorno != "vazio") {
            for($i=0; $i<24; $i++){                
            
                if($count < count($retorno)){
                    $hidrometroHistoricoList[$count] = $retorno[$count];
                    if((int)$hidrometroHistoricoList[$count]->dtPulso === $i){
                       $valor[$i]= $hidrometroHistoricoList[$count]->valorPulso; 
                       $consumoTotal += $hidrometroHistoricoList[$count]->valorPulso;
                       $dtPulso[$i]= $i;
                       $count++;
                    }else{
                       $valor[$i] = "0"; 
                       $dtPulso[$i]= $i;
                    }                                         
                } else {
                    $valor[$i] = "0"; 
                    $dtPulso[$i]= $i;
                }          
            }           
            $hidrometroHistoricoList[0]->valorPulso = $valor;           
            $hidrometroHistoricoList[0]->dtPulso = $dtPulso;
            $hidrometroHistoricoList[0]->pulsoValor = $configuracao[0]->valorPulso;
            $hidrometroHistoricoList[0]->consumoTotal = $consumoTotal * $configuracao[0]->valorPulso;
            $hidrometroHistoricoList[0]->valorHidrometroAtual = $this->buscarLeituraAtual($hidrometroHistorico);
            
            return $hidrometroHistoricoList[0];
        } else {
            return "vazio";
        }   
        return $hidrometroHistoricoList[0];
        
    }   
   
    public function historicoMes(\HidrometroHistorico $hidrometroHistorico) {
        $hidrometroHistoricoDao = new HidrometroHistoricoDao(); 
        $configuracao = new ConfiguracaoHidrometro();
               
        $retorno = $hidrometroHistoricoDao->getPorTagDataMes($hidrometroHistorico);  
        $configuracao->setHidrometro_Tag($hidrometroHistorico->tag);
        $configuracao->setUsuario_Id($hidrometroHistorico->usuario_id);
        $configuracao = $configuracao->configuracaoUsuarioTag($configuracao);
        
        $hidrometroHistoricoList = array($hidrometroHistorico); 
        $count = 0;
        $consumoTotal = 0;
        if ($retorno != "vazio") {
            for($i=0; $i<31; $i++){                
            
                if($count < count($retorno)){
                    $hidrometroHistoricoList[$count] = $retorno[$count];
                    if((int)$hidrometroHistoricoList[$count]->dia === $i){
                       $valor[$i]= $hidrometroHistoricoList[$count]->valorPulso;
                       $consumoTotal += $hidrometroHistoricoList[$count]->valorPulso;
                       $dtPulso[$i]= 1+$i;
                       $count++;
                    }else{
                       $valor[$i] = "0"; 
                       $dtPulso[$i]=$i +1;
                    }                                         
                } else {
                    $valor[$i] = "0"; 
                    $dtPulso[$i]= $i+1;
                }          
            }           
            $hidrometroHistoricoList[0]->valorPulso = $valor;           
            $hidrometroHistoricoList[0]->dtPulso = $dtPulso;
            $hidrometroHistoricoList[0]->pulsoValor = $configuracao[0]->valorPulso;
            $hidrometroHistoricoList[0]->consumoTotal = $consumoTotal * $configuracao[0]->valorPulso;
            $hidrometroHistoricoList[0]->valorHidrometroAtual = $this->buscarLeituraAtual($hidrometroHistorico);
            
            return $hidrometroHistoricoList[0];
        } else {
            return "vazio";
        }   
        return $hidrometroHistoricoList[0];
        
    }
    public function historicoAno(\HidrometroHistorico $hidrometroHistorico) {
        $hidrometroHistoricoDao = new HidrometroHistoricoDao(); 
        $configuracao = new ConfiguracaoHidrometro();
               
        $retorno = $hidrometroHistoricoDao->getPorTagDataAno($hidrometroHistorico);  
        $configuracao->setHidrometro_Tag($hidrometroHistorico->tag);
        $configuracao->setUsuario_Id($hidrometroHistorico->usuario_id);
        $configuracao = $configuracao->configuracaoUsuarioTag($configuracao);
        
        $hidrometroHistoricoList = array($hidrometroHistorico); 
        $count = 0;
        $consumoTotal = 0;
        if ($retorno != "vazio") {
            for($i=0; $i<12; $i++){                
            
                if($count < count($retorno)){
                    $hidrometroHistoricoList[$count] = $retorno[$count];
                    if((int)$hidrometroHistoricoList[$count]->mes === $i){
                       $valor[$i]= $hidrometroHistoricoList[$count]->valorPulso; 
                       $consumoTotal += $hidrometroHistoricoList[$count]->valorPulso;
                       $dtPulso[$i]= +$i;
                       $count++;
                    }else{
                       $valor[$i] = "0"; 
                       $dtPulso[$i]=$i;
                    }                                         
                } else {
                    $valor[$i] = "0"; 
                    $dtPulso[$i]= $i;
                }          
            }           
            $hidrometroHistoricoList[0]->valorPulso = $valor;           
            $hidrometroHistoricoList[0]->dtPulso = $dtPulso;
            $hidrometroHistoricoList[0]->pulsoValor = $configuracao[0]->valorPulso;
            $hidrometroHistoricoList[0]->consumoTotal = $consumoTotal * $configuracao[0]->valorPulso;
            $hidrometroHistoricoList[0]->valorHidrometroAtual = $this->buscarLeituraAtual($hidrometroHistorico);
            
            return $hidrometroHistoricoList[0];
        } else {
            return "vazio";
        }   
        return $hidrometroHistoricoList[0];
    }


    
    function getId() {
        return $this->id;
    }

    function getTag() {
        return $this->tag;
    }
 

    function getValorPulso() {
        return $this->valorPulso;
    }

    function getDtPulso() {
        return $this->dtPulso;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTag($tag) {
        $this->tag = $tag;
    }

    function setValorPulso($valorPulso) {
        $this->valorPulso = $valorPulso;
    }

    function setDtPulso($dtPulso) {
        $this->dtPulso = $dtPulso;
    }
    function getUsuario() {
        return $this->usuario;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

  
}
