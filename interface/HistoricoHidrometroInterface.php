<?php

interface HistoricoHidrometroInterface {
    public function cadastroHidrometroHistorico(HidrometroHistorico $hidrometroHistorico);   
    public function buscarHidrometroHistoricoTag(HidrometroHistorico $hidrometroHistorico);   
    public function buscarHidrometroHistoricoId(HidrometroHistorico $hidrometroHistorico);  
    public function buscarLeituraAtual(HidrometroHistorico $hidrometroHistorico);  
    public function historicoDia(HidrometroHistorico $hidrometroHistorico);  
    public function historicoMes(HidrometroHistorico $hidrometroHistorico);  
    public function historicoAno(HidrometroHistorico $hidrometroHistorico);  
   
}
