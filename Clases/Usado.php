<?php
namespace Clases;
use Model\UsadoModel;
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
    public function addHis($his){
        return (new UsadoModel())->addHis($his);
    }
    public function getHistoriales(){
        return (new UsadoModel())->getHistoriales([$this->aplicacion->getId(), $this->vehiculo->getId()]);
    }
    public function getHistorial($dates = []){        
        return (new UsadoModel())->getHistorial([$this->aplicacion->getId(), $this->vehiculo->getId(), $dates[0],$dates[1]]);
    }
    public function modHis($his){
        return (new UsadoModel())->modHis($his);
    }
    public function delHis($his){
        return (new UsadoModel())->delHis($his);
    }
}