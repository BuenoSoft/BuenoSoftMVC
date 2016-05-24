<?php
namespace Clases;
use \App\IPersiste;
use \Model\AplicacionModel;
class Aplicacion implements IPersiste
{
    private $id;
    private $coordlat;
    private $coordlong;
    private $areaapl;
    private $faja;
    private $fechaIni;
    private $fechaFin;
    private $estado;
    private $tratamiento;
    private $viento;
    private $taquiIni;
    private $taquiFin;
    private $tipo;
    private $padron;
    private $cultivo;
    private $caudal;
    private $importe;
    private $dosis;
    private $hectareas;
    private $cliente;
    function getId() {
        return $this->id;
    }
    function getCoordlat() {
        return $this->coordlat;
    }
    function getCoordlong() {
        return $this->coordlong;
    }
    function getAreaapl() {
        return $this->areaapl;
    }
    function getFaja() {
        return $this->faja;
    }
    function getFechaIni() {
        return $this->fechaIni;
    }
    function getFechaFin() {
        return $this->fechaFin;
    }
    function getEstado() {
        return $this->estado;
    }
    function getTratamiento() {
        return $this->tratamiento;
    }
    function getViento() {
        return $this->viento;
    }
    function getTaquiIni() {
        return $this->taquiIni;
    }
    function getTaquiFin() {
        return $this->taquiFin;
    }
    function getTipo() {
        return $this->tipo;
    }
    function getPadron() {
        return $this->padron;
    }
    function getCultivo() {
        return $this->cultivo;
    }
    function getCaudal() {
        return $this->caudal;
    }
    function getImporte() {
        return $this->importe;
    }
    function getDosis() {
        return $this->dosis;
    }
    function getHectareas() {
        return $this->hectareas;
    }
    function getCliente() {
        return $this->cliente;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    function setCoordlat($coordlat) {
        $this->coordlat = $coordlat;
    }
    function setCoordlong($coordlong) {
        $this->coordlong = $coordlong;
    }
    function setAreaapl($areaapl) {
        $this->areaapl = $areaapl;
    }
    function setFaja($faja) {
        $this->faja = $faja;
    }
    function setFechaIni($fechaIni) {
        $this->fechaIni = $fechaIni;
    }
    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setTratamiento($tratamiento) {
        $this->tratamiento = $tratamiento;
    }
    function setViento($viento) {
        $this->viento = $viento;
    }
    function setTaquiIni($taquiIni) {
        $this->taquiIni = $taquiIni;
    }
    function setTaquiFin($taquiFin) {
        $this->taquiFin = $taquiFin;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function setPadron($padron) {
        $this->padron = $padron;
    }
    function setCultivo($cultivo) {
        $this->cultivo = $cultivo;
    }
    function setCaudal($caudal) {
        $this->caudal = $caudal;
    }
    function setImporte($importe) {
        $this->importe = $importe;
    }
    function setDosis($dosis) {
        $this->dosis = $dosis;
    }
    function setHectareas($hectareas) {
        $this->hectareas = $hectareas;
    }
    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function __construct() { }
    public function equals(Aplicacion $obj){
        return $this->ruc == $obj->ruc;                
    }
    public function taquiDif(){
        return $this->taquiFin - $this->taquiIni;
    }
    public function mostrarDateTimeIni(){
        $date = date_create($this->fechaIni);
        return date_format($date, "Y-m-d\TH:i:s");
    }
    public function mostrarDateTimeFin(){
        $date = date_create($this->fechaFin);
        return date_format($date, "Y-m-d\TH:i:s");
    }
    /*-----------------------------------------*/        
    public function save() {
        return ($this->id == 0) ? (new AplicacionModel())->addApp($this) : (new AplicacionModel())->modApp($this);
    }
    public function find($criterio = null) {
        return (new AplicacionModel())->find($criterio);
    }
    public function findById($id) {
        return (new AplicacionModel())->findById($id);
    }
    public function del() { }
    /*-----------------------------------------*/
    public function addPro($pro) {
        return (new AplicacionModel())->addPro([$this->id, $pro]);
    }
    public function delPro($pro) {
        return (new AplicacionModel())->delPro([$this->id, $pro]);
    }
    public function getProductos($criterio = null) {
        return (new AplicacionModel())->getProductos([$this->id, $criterio]); 
    }
    /*-----------------------------------------*/
    public function addUsu($usado) {
        return (new AplicacionModel())->addUsu($usado);
    }
    public function getUsados($criterio = null){
        return (new AplicacionModel())->getUsados([$this->id, $criterio]);
    }
    public function getUsado($veh){
        return (new AplicacionModel())->getUsado([$this->id, $veh]);
    }
    public function modUsu($usado) {
        return (new AplicacionModel())->modUsu($usado);    
    }
    public function delUsu($usado) {
        return (new AplicacionModel())->delUsu($usado);    
    }
}