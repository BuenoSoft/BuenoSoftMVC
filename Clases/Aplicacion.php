<?php
namespace Clases;
use \App\IPersiste;
use \Model\AplicacionModel;
class Aplicacion implements IPersiste
{
    private $id;
    private $coordCul;
    private $pista;
    private $areaapl;
    private $faja;
    private $fechaIni;
    private $fechaFin;
    private $tratamiento;
    private $viento;
    private $tipo;
    private $taquiIni;
    private $taquiFin;
    private $padron;
    private $cultivo;
    private $caudal;
    private $dosis;
    private $cliente;
    function getId() {
        return $this->id;
    }
    function getCoordCul() {
        return $this->coordCul;
    }
    function getPista() {
        return $this->pista;
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
    function getTipo() {
        return $this->tipo;
    }
    function getTaquiIni() {
        return $this->taquiIni;
    }
    function getTaquiFin() {
        return $this->taquiFin;
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
    function setCoordCul($coordCul) {
        $this->coordCul = $coordCul;
    }
    function setPista($pista) {
        $this->pista = $pista;
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
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function setTaquiIni($taquiIni) {
        $this->taquiIni = $taquiIni;
    }
    function setTaquiFin($taquiFin) {
        $this->taquiFin = $taquiFin;
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
    public function taquiDif(){
        return $this->taquiFin - $this->taquiIni;
    }
    public function mostrarDateTimeIni(){
        $date = date_create($this->fechaIni);
        return date_format($date, "Y-m-d H:i");
    }
    public function mostrarDateTimeFin(){
        $date = date_create($this->fechaFin);
        return date_format($date, "Y-m-d H:i");
    }
    /*-----------------------------------------*/        
    public function save() {
        return ($this->id == 0) ? (new AplicacionModel())->addApp($this) : (new AplicacionModel())->modApp($this);
    }
    public function findAdvance($datos = []){
        return (new AplicacionModel())->findAdvance($datos);
    }    
    public function findById($id) {
        return (new AplicacionModel())->findById($id);
    }
    public function maxID(){
        return (new AplicacionModel())->maxId();
    }
    public function find($criterio = null) { }
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
    public function addUsu($veh,$usu) {
        return (new AplicacionModel())->addUsu([$this->id, $veh, $usu]);
    }
    public function checkUsu($veh){
        return (new AplicacionModel())->checkUsu([$this->id, $veh]);
    }
    public function delUsu($veh,$usu) {
        return (new AplicacionModel())->delUsu([$this->id, $veh, $usu]);
    }
    public function getUsados(){
        return (new AplicacionModel())->getUsados([$this->id]);
    }
}