<?php
require_once '../dao/SensorDao.php';
require_once '../interface/SensorController.php';

class Sensor implements SensorController{
    public $id;
    public $temperatura;
    public $umidade;
    public $umidadeSolo;
    public $sensorChuva;
    public $tempo;
     
    public function getDadosChuva() {
        $dao = new SensorDao();
       return $dao->getDadosChuva();
    }

    public function getDadosTemperatura() {
        $dao = new SensorDao();
       return $dao->getDadosTemperatura();
    }

    public function getDadosUmidade() {
        $dao = new SensorDao();
       return $dao->getDadosUmidade();
    }

    public function getDadosUmidadeSolo() {
        $dao = new SensorDao();
       return $dao->getDadosUmidadeSolo();
    }
    
    
    function getTemperatura() {
        return $this->temperatura;
    }

    function getUmidade() {
        return $this->umidade;
    }

    function getUmidadeSolo() {
        return $this->umidadeSolo;
    }

    function getSensorChuva() {
        return $this->sensorChuva;
    }

    function setTemperatura($temperatura) {
        $this->temperatura = $temperatura;
    }

    function setUmidade($umidade) {
        $this->umidade = $umidade;
    }

    function setUmidadeSolo($umidadeSolo) {
        $this->umidadeSolo = $umidadeSolo;
    }

    function setSensorChuva($sensorChuva) {
        $this->sensorChuva = $sensorChuva;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getTempo() {
        return $this->tempo;
    }

    function setTempo($tempo) {
        $this->tempo = $tempo;
    }



}
