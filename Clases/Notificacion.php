<?php
namespace Clases;
use \App\IPersiste;
use \Model\NotificacionModel;
class Notificacion implements IPersiste
{
    private $id;
    private $log;
    private $fechaini;
    private $fechafin;
    private $estado;
    private $vehiculo;
    private $usuario;
    function getId() {
        return $this->id;
    }
    function getLog() {
        return $this->log;
    }
    function getFechaini() {
        return $this->fechaini;
    }
    function getFechafin() {
        return $this->fechafin;
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
    function setLog($log) {
        $this->log = $log;
    }
    function setFechaini($fechaini) {
        $this->fechaini = $fechaini;
    }
    function setFechafin($fechafin) {
        $this->fechafin = $fechafin;
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
        $date = date_create($this->fechaini);
        return date_format($date, "Y-m-d");
    }
    public function mostrarDateFin(){
        $date = date_create($this->fechafin);
        return date_format($date, "Y-m-d");
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