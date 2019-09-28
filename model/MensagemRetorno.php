<?php


class MensagemRetorno {
    public $tipoMensagem;
    public $mensagem;
    
    function __construct($tipoMensagem, $mensagem) {
        $this->setMensagem($mensagem);
        $this->setTipoMensagem($tipoMensagem);
    }
      
    function getTipoMensagem() {
        return $this->tipoMensagem;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function setTipoMensagem($tipoMensagem) {     
        $this->tipoMensagem = $tipoMensagem;       
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }


}
