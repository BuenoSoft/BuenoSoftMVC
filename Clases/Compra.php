<?php
namespace Clases;
class Compra 
{
    private $id;
    private $fecha;
    private $cuotas;
    private $cant;
    private $tipo;
    private $user;
    private $veh;
    private $pagos;
    function getId() {
        return $this->id;
    }
    function getFecha() {
        return $this->fecha;
    }
    function getCuotas() {
        return $this->cuotas;
    }
    function getCant() {
        return $this->cant;
    }
    function getTipo() {
        return $this->tipo;
    }
    function getUser() {
        return $this->user;
    }
    function getVeh() {
        return $this->veh;
    }
    function getPagos() {
        return $this->pagos;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setCuotas($cuotas) {
        $this->cuotas = $cuotas;
    }
    function setCant($cant) {
        $this->cant = $cant;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function setUser($user) {
        $this->user = $user;
    }
    function setVeh($veh) {
        $this->veh = $veh;
    }
    function setPagos($pagos) {
        $this->pagos = $pagos;
    }
    function __construct($xid, $xfecha, $xcuotas, $xcant, $xtipo, $xuser, $xveh) {
        $this->id = $xid;
        $this->fecha = $xfecha;
        $this->cuotas = $xcuotas;
        $this->cant = $xcant;
        $this->tipo = $xtipo;
        $this->user = $xuser;
        $this->veh = $xveh;
        $this->pagos = array();
    }
    public function obtenerNroPago(){
        $nro = count($this->pagos);
        return ($nro == 0) ? 1 : $nro +1; 
    }
    public function generarFecVenc(){
        $d=strtotime("+30 Days");
        return ($this->cuotas == $this->obtenerNroPago()) ? date("Y/m/d") : date("Y/m/d",$d);       
    }
    public function checkFecVenc(){        
        $last=count($this->pagos)-1;
        if($last >-1){
            $pago=$this->pagos[$last];
            if(date("Y/m/d") > $pago->getFecVenc()){
                return true;
            }
        }
        return false;
    }
}