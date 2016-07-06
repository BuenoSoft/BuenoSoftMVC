<?php
namespace Clases;
use Model\UsadoModel;
class Usado 
{
    private $aplicacion;
    private $vehiculo;
    private $usuario;
    function getAplicacion() {
        return $this->aplicacion;
    }
    function getVehiculo() {
        return $this->vehiculo;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function setAplicacion($aplicacion) {
        $this->aplicacion = $aplicacion;
    }
    function setVehiculo($vehiculo) {
        $this->vehiculo = $vehiculo;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function __construct() { }
    public function addHis($his){
        return (new UsadoModel())->addHis($his);
    }
    public function getHistoriales(){
        return (new UsadoModel())->getHistoriales([$this->aplicacion->getId(), $this->vehiculo->getId()]);
    }
    public function delHis($his){
        return (new UsadoModel())->delHis($his);
    }
}