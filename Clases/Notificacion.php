<?php
namespace Clases;
use \App\IPersiste;
use \Model\NotificacionModel;
class Notificacion implements IPersiste
{
    private $id;
    private $mensaje;
    private $fecha;
    private $estado;
    private $vehiculo;
    private $usuario;
    function getId() {
        return $this->id;
    }
    function getMensaje() {
        return $this->mensaje;
    }
    function getFecha() {
        return $this->fecha;
    }
    function getEstado() {
        return $this->estado;
    }
    function getVehiculo() {
        return $this->vehiculo;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setVehiculo($vehiculo) {
        $this->vehiculo = $vehiculo;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function __construct() { }
    public function mostrarDateIni(){
        $date = date_create($this->fecha);
        return date_format($date, "d-m-Y");
    }
    public function inverseDateIni(){
        $arrdate = explode("-", $this->fecha);
        return $arrdate[2]."/".$arrdate[1]."/".$arrdate[0];
    }
    /*----------------------------------*/
    public function find($criterio = null) {
        return (new NotificacionModel())->find($criterio);
    }
    public function findById($id) {
        return (new NotificacionModel())->findById($id);
    }
    public function notify() {
        return (new NotificacionModel())->getNotificaciones();
    }
    public function cantNotify(){
        return (new NotificacionModel())->getCantNots();
    }
    public function save() {
        return ($this->id == 0) ? (new NotificacionModel())->addNot($this) : (new NotificacionModel())->modNot($this); 
    }
    public function del() { 
        return (new NotificacionModel())->delete($this);
    }
}