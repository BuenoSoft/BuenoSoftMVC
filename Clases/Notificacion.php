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
    private $vehiculo;
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
    function getVehiculo() {
        return $this->vehiculo;
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
    function setVehiculo($vehiculo) {
        $this->vehiculo = $vehiculo;
    }
    function __construct() { }
    public function equals(Notificacion $obj){
        return $this->log == $obj->log and $this->vehiculo == $obj->vehiculo;                
    }
    public function mostrarDateTimeIni(){
        $date = date_create($this->fechaini);
        return date_format($date, "Y-m-d\TH:i:s");
    }
    public function mostrarDateTimeFin(){
        $date = date_create($this->fechafin);
        return date_format($date, "Y-m-d\TH:i:s");
    }
    /*----------------------------------*/
    public function find($criterio = null) {
        return (new NotificacionModel())->find($criterio);
    }
    public function findById($id) {
        return (new NotificacionModel())->findById($id);
    }
    public function save() {
        return ($this->id == 0) ? (new NotificacionModel())->create($this) : (new NotificacionModel())->update($this); 
    }
    public function del() { }
}