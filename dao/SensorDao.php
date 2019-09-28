<?php

require_once 'Conexao.php';
require_once '../model/Sensor.php';
class SensorDao {
    
    public function getDadosTemperatura() {
        $sensor = new Sensor();
        $sensorArray = array($sensor);
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM sensor");        
         if ($retorno !== "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $sensorArray[$index] = $retorno[$index];
                $valoreRetorno[$index][0] = (int)$index;
                $valoreRetorno[$index][1] = (int)$sensorArray[$index]->temperatura;
            }
            return $valoreRetorno;
        } else {
            return "vazio";
        }
    }
    public function getDadosUmidade() {
        $sensor = new Sensor();
        $sensorArray = array($sensor);
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM sensor");        
         if ($retorno !== "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $sensorArray[$index] = $retorno[$index];
                $valoreRetorno[$index][0] = (int)$index;
                $valoreRetorno[$index][1] = (int)$sensorArray[$index]->umidade;
            }
            return $valoreRetorno;
        } else {
            return "vazio";
        }
    }
    public function getDadosUmidadeSolo() {
        $sensor = new Sensor();
        $sensorArray = array($sensor);
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM sensor");        
         if ($retorno !== "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $sensorArray[$index] = $retorno[$index];
                $valoreRetorno = (int)$sensorArray[$index]->umidadeSolo;
            }
            return $valoreRetorno;
        } else {
            return "vazio";
        }
    }
    public function getDadosChuva() {
        $sensor = new Sensor();
       
        $c = new conexao();
        $retorno = $c->selectDB("SELECT * FROM sensor");        
         if ($retorno !== "vazio") {
            for ($index = 0; $index < count($retorno); $index++) {
                $sensorArray[$index] = $retorno[$index];
                $valoreRetorno = (int)$sensorArray[$index]->sensorChuva;
            }
            return $valoreRetorno;
        } else {
            return "vazio";
        }
    }
}
