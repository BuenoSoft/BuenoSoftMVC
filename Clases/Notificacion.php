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
    private $fechaAct;
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
    function getFechaAct() {
        return $this->fechaAct;
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
    function setFechaAct($fechaAct) {
        $this->fechaAct = $fechaAct;
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
    public function equals(Notificacion $obj){
        return $this->log == $obj->log and $this->vehiculo == $obj->vehiculo;                
    }
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
    public function save() {
        return ($this->id == 0) ? (new NotificacionModel())->create($this) : (new NotificacionModel())->update($this); 
    }
    public function del() { 
        return (new NotificacionModel())->delete($this);
    }
}