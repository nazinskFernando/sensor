<?php

interface ConfiguracaoHidrometroInterface {
    public function cadastroConfiguracao(ConfiguracaoHidrometro $configuracao);   
    public function configuracaoUsuarioTag(ConfiguracaoHidrometro $configuracao);   
     
    public function editarConfiguracaoHidrometro(ConfiguracaoHidrometro $configuracaoHidrometro);    
    public function apagarConfiguracaoHidrometro(ConfiguracaoHidrometro $configuracaoHidrometro);    
    public function hidrometrosUsuario(ConfiguracaoHidrometro $configuracaoHidrometro);    
    public function buscar(ConfiguracaoHidrometro $configuracaoHidrometro);    
}
