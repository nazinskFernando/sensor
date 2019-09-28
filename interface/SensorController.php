<?php

interface SensorController {
    public function getDadosTemperatura();
    public function getDadosUmidade();
    public function getDadosUmidadeSolo();
    public function getDadosChuva();
}
