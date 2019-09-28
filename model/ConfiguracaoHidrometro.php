<?php

require_once '../dao/ConfiguracaoHidrometroDao.php';
//require_once '../dao/HidrometroHistoricoDao.php';
require_once '../validacao/HidrometroValidacao.php';
require_once '../interface/ConfiguracaoHidrometroInterface.php';
require_once '../model/MensagemRetorno.php';
require_once '../validacao/ConfiguracaoHidrometroValidacao.php';

class ConfiguracaoHidrometro implements ConfiguracaoHidrometroInterface{
  public $id;
  public $usuario_Id; 
  public $hidrometro_Tag;
  public $valorHidrometroAtual;
  public $valorPulso;
  public $nomeHidrometro;
  
    public function buscar(\ConfiguracaoHidrometro $configuracaoHidrometro) {
         $retorno = new ConfiguracaoHidrometroValidacao();       
       
        $configuracaoHidrometroDao = new ConfiguracaoHidrometroDao();
        $configuracaoHidrometro = $configuracaoHidrometroDao->getPorId($configuracaoHidrometro->id);
          if($configuracaoHidrometro != "vazio"){                  
                $returno = $configuracaoHidrometro;          
                return $returno;
        } else {
            $returno = $configuracaoHidrometro;          
            return $returno;                 
        }  
    }
  
   public function hidrometrosUsuario(\ConfiguracaoHidrometro $configuracaoHidrometro) {
        $retorno = new ConfiguracaoHidrometroValidacao();       
       
        $configuracaoHidrometroDao = new ConfiguracaoHidrometroDao();
        $configuracaoHidrometro = $configuracaoHidrometroDao->getPorHidUsuario($configuracaoHidrometro);
          if($configuracaoHidrometro != "vazio"){                  
                $returno = $configuracaoHidrometro;          
                return $returno;
        } else {
            $returno = $configuracaoHidrometro;          
            return $returno;                 
        }   
    }
    
    public function cadastroConfiguracao(\ConfiguracaoHidrometro $configuracaoHidrometro) {
        $retorno = new ConfiguracaoHidrometroValidacao();
        $mensagemRetorno = $retorno->cadastroHidrometroValidacao($configuracaoHidrometro);
        //return $mensagemRetorno;
        if($mensagemRetorno->tipoMensagem === "sucesso"){
            $configuracaoHidrometroDao = new ConfiguracaoHidrometroDao();
            $idConfiguracao = $configuracaoHidrometroDao->salvar($configuracaoHidrometro);
              if($idConfiguracao != "erro"){                  
                  $returno = new MensagemRetorno("sucesso", "");          
                return $returno;
              } else {
                $returno = new MensagemRetorno("erro", "Erro ao salvar configuração!");          
                return $returno;                 
              }     
        } else {
            return $mensagemRetorno;
        }
    }
    public function apagarConfiguracaoHidrometro(\ConfiguracaoHidrometro $configuracaoHidrometro) {
         $configuracaoHidrometroDao = new ConfiguracaoHidrometroDao();
        
        $configuracaoHidrometro = $configuracaoHidrometroDao->remover($configuracaoHidrometro);
        if($configuracaoHidrometro != "erro"){
            return "ok";
        } else {
            return "erro";
        }   
    }

   

    public function editarConfiguracaoHidrometro(\ConfiguracaoHidrometro $configuracaoHidrometro) {
         $retorno = new ConfiguracaoHidrometroValidacao();
         
        $mensagemRetorno = $retorno->editarHidrometroValidacao($configuracaoHidrometro);
         if($mensagemRetorno->tipoMensagem === "sucesso"){
            $configuracaoHidrometroDao = new ConfiguracaoHidrometroDao();
            $configuracaoHidrometro = $configuracaoHidrometroDao->editar($configuracaoHidrometro); 
            return $configuracaoHidrometro;
            if($configuracaoHidrometro != "erro"){
                  $returno = new MensagemRetorno("sucesso", "");          
                return $returno;
              } else {
                $returno = new MensagemRetorno("erro", "Erro ao salvar configuração!");          
                return $returno;                 
              }     
        } else {
            return $mensagemRetorno;
        }
    }

    public function configuracaoUsuarioTag(\ConfiguracaoHidrometro $configuracao) {
        $dao = new ConfiguracaoHidrometroDao();
        return $dao->getPorTagUsuario($configuracao);
    }
    
  
  function getId() {
      return $this->id;
  }

  function getUsuario_Id() {
      return $this->usuario_Id;
  }

  function getHidrometro_Tag() {
      return $this->hidrometro_Tag;
  }

  function getValorHidrometroAtual() {
      return $this->valorHidrometroAtual;
  }

  function getValorPulso() {
      return $this->valorPulso;
  }

  function getNomeHidrometro() {
      return $this->nomeHidrometro;
  }

  function setId($id) {
      $this->id = $id;
  }

  function setUsuario_Id($usuario_Id) {
      $this->usuario_Id = $usuario_Id;
  }

  function setHidrometro_Tag($hidrometro_Tag) {
      $this->hidrometro_Tag = $hidrometro_Tag;
  }

  function setValorHidrometroAtual($valorHidrometroAtual) {
      $this->valorHidrometroAtual = $valorHidrometroAtual;
  }

  function setValorPulso($valorPulso) {
      $this->valorPulso = $valorPulso;
  }

  function setNomeHidrometro($nomeHidrometro) {
      $this->nomeHidrometro = $nomeHidrometro;
  }

    

}
