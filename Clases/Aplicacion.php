<?php
namespace Clases;
use \App\IPersiste;
use \Model\AplicacionModel;
class Aplicacion implements IPersiste
{
    private $id;
    private $cultivoLat;
    private $cultivoLong;
    private $pistaLat;
    private $pistaLong;
    private $areaapl;
    private $faja;
    private $fechaIni;
    private $fechaFin;
    private $tratamiento;
    private $viento;
    private $taquiIni;
    private $taquiFin;
    private $tipo;
    private $padron;
    private $cultivo;
    private $caudal;
    private $dosis;
    private $cliente;
    function getId() {
        return $this->id;
    }
    function getCultivoLat() {
        return $this->cultivoLat;
    }
    function getCultivoLong() {
        return $this->cultivoLong;
    }
    function getPistaLat() {
        return $this->pistaLat;
    }
    function getPistaLong() {
        return $this->pistaLong;
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
    function getDosis() {
        return $this->dosis;
    }
    function getCliente() {
        return $this->cliente;
    }    
    function setId($id) {
        $this->id = $id;
    }
    function setCultivoLat($cultivoLat) {
        $this->cultivoLat = $cultivoLat;
    }
    function setCultivoLong($cultivoLong) {
        $this->cultivoLong = $cultivoLong;
    }
    function setPistaLat($pistaLat) {
        $this->pistaLat = $pistaLat;
    }
    function setPistaLong($pistaLong) {
        $this->pistaLong = $pistaLong;
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
    function setDosis($dosis) {
        $this->dosis = $dosis;
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
    public function maxID(){
        return (new AplicacionModel())->maxId();
    }
    public function del() { }
    /*-----------------------------------------*/
    public function addPro($pro) {
        return (new AplicacionModel())->addPro([$this->id, $pro]);
    }
    public function checkPro($pro) {
        return (new AplicacionModel())->checkPro([$this->id, $pro]);
    }
    public function delPro($pro) {
        return (new AplicacionModel())->delPro([$this->id, $pro]);
    }
    public function getProductos() {
        return (new AplicacionModel())->getProductos([$this->id]); 
    }
    /*-----------------------------------------*/
    public function addUsu($usado) {
        return (new AplicacionModel())->addUsu($usado);
    }
    public function checkUsu($veh){
        return (new AplicacionModel())->checkUsu([$this->id, $veh]);
    }
    public function getUsados(){
        return (new AplicacionModel())->getUsados([$this->id]);
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