<?php
namespace Clases;
class Usado 
{
    private $aplicacion;
    private $vehiculo;
    private $conductor;
    private $capacidad;
    function getAplicacion() {
        return $this->aplicacion;
    }
    function getVehiculo() {
        return $this->vehiculo;
    }
    function getConductor() {
        return $this->conductor;
    }
    function getCapacidad() {
        return $this->capacidad;
    }
    function setAplicacion($aplicacion) {
        $this->aplicacion = $aplicacion;
    }
    function setVehiculo($vehiculo) {
        $this->vehiculo = $vehiculo;
    }
    function setConductor($conductor) {
        $this->conductor = $conductor;
    }
    function setCapacidad($capacidad) {
        $this->capacidad = $capacidad;
    }
    function __construct() { }
    public function equals(Usado $obj){
        return $this->aplicacion == $obj->aplicacion and $this->vehiculo == $obj->vehiculo; 
    }
}