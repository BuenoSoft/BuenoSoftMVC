<?php
namespace Clases;
use \App\IPersiste;
use \Model\CompraModel;
class Compra implements IPersiste
{
    private $id;
    private $fecha;
    private $cuotas;
    private $cant;
    private $tipo;
    private $user;
    private $veh;
    private $pagos;
    private $modelo;
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
    function __construct($xid = 0, $xfecha = null, $xcuotas = null, $xcant = null, $xtipo = null, $xuser = null, $xveh = null) {
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
        $this->modelo = new CompraModel();
        return $this->modelo->checkFecVenc($this);
    }
    public function save(){
        $this->modelo = new CompraModel();
        return ($this->id == 0) ? $this->modelo->create($this) : $this->modelo->update($this); 
    }
    public function find($criterio = null){
        $this->modelo = new CompraModel();
        return $this->modelo->find($criterio); 
    }
    public function findById($id){
        $this->modelo = new CompraModel();
        return $this->modelo->findById($id);
    }
    public function findByClientes($criterio){
        $this->modelo = new CompraModel();
        return $this->modelo->findByClientes($criterio);
    }
    public function findByVeh($criterio){
        $this->modelo = new CompraModel();
        return $this->modelo->findByVeh($criterio);
    }
    public function add_pago($pago){
        $this->modelo = new CompraModel();
        return $this->modelo->add_pago($this,$pago);
    }
    public function del_pago($pago){
        $this->modelo = new CompraModel();
        return $this->modelo->del_pago($this,$pago);
    }
    public function find_pago($pago_id){
        $this->modelo = new CompraModel();
        return $this->modelo->find_pago($this->id, $pago_id);
    }

    public function del() { }

}