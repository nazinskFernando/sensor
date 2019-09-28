<?php

require_once '../model/ConfiguracaoHidrometro.php';
require_once '../model/MensagemRetorno.php';
require_once '../model/Hidrometro.php';
require_once '../dao/ConfiguracaoHidrometroDao.php';



class ConfiguracaoHidrometroValidacao {
    
    public function cadastroHidrometroValidacao(ConfiguracaoHidrometro $configuracaoHidrometro) {
        
        if($configuracaoHidrometro->hidrometro_Tag === null || $configuracaoHidrometro->hidrometro_Tag === ""){
            $returno = new MensagemRetorno("erro", "tagNaoInformado");          
            return $returno;          
        } else if($configuracaoHidrometro->nomeHidrometro === null || $configuracaoHidrometro->nomeHidrometro === "") {
            $returno = new MensagemRetorno("erro", "nomeHidrometroNaoInformado");          
            return $returno;   
        } else if($configuracaoHidrometro->usuario_Id === null || $configuracaoHidrometro->usuario_Id === "") {
            $returno = new MensagemRetorno("erro", "idUsuarioNaoInformado");          
            return $returno;
        } else if($configuracaoHidrometro->valorHidrometroAtual === null || $configuracaoHidrometro->valorHidrometroAtual === "") {
            $returno = new MensagemRetorno("erro", "valorNaoInformado");          
            return $returno;
        } else if($configuracaoHidrometro->valorPulso === null || $configuracaoHidrometro->valorPulso === "") {
            $returno = new MensagemRetorno("erro", "pulsoNaoInformado");          
            return $returno;
        } else {
            $hidrometroDao = new Hidrometro();
            $hidrometro = new Hidrometro();
            $hidrometro->setTag($configuracaoHidrometro->hidrometro_Tag);            
            $valor = $hidrometroDao->buscarHidrometroTag($hidrometro);    
            
            if($valor != "vazio"){              
            
                $configuracaoHidrometroDao = new ConfiguracaoHidrometroDao();
                $configuracaoHidrometro = $configuracaoHidrometroDao->getPorTagUsuario($configuracaoHidrometro);

                if($configuracaoHidrometro === "vazio"){
                    $returno = new MensagemRetorno("sucesso", "");          
                    return $returno;           
                } else {
                    $returno = new MensagemRetorno("erro", "hidrometroJaCadastrado");          
                    return $returno;
                }
            } else {
                $returno = new MensagemRetorno("erro", "TagHidrometroInvalido"); 
                return $returno;
            }
            
        }
    }

    public function editarHidrometroValidacao($configuracaoHidrometro) {
        if($configuracaoHidrometro->hidrometro_Tag === null || $configuracaoHidrometro->hidrometro_Tag === ""){
            $returno = new MensagemRetorno("erro", "Um hidrometro deve ser informado!");          
            return $returno;          
        } else if($configuracaoHidrometro->nomeHidrometro === null || $configuracaoHidrometro->nomeHidrometro === "") {
            $returno = new MensagemRetorno("erro", "Um nome do hidrometro deve ser informado!");          
            return $returno;   
        } else if($configuracaoHidrometro->usuario_Id === null || $configuracaoHidrometro->usuario_Id === "") {
            $returno = new MensagemRetorno("erro", "Um usuario deve ser informado!");          
            return $returno;
        } else if($configuracaoHidrometro->valorHidrometroAtual === null || $configuracaoHidrometro->valorHidrometroAtual === "") {
            $returno = new MensagemRetorno("erro", "O valor atual do hidrometro deve ser informado!");          
            return $returno;
        } else if($configuracaoHidrometro->valorPulso === null || $configuracaoHidrometro->valorPulso === "") {
            $returno = new MensagemRetorno("erro", "O valor de pulso do hidrometro deve ser informado!");          
            return $returno;
        } else {            
            $returno = new MensagemRetorno("sucesso", "");          
            return $returno;         
        }
    }

}
