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
    private $avatar;
    private $cliente;
    private $terrestre;
    private $aeronave;
    private $chofer;
    private $piloto;
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
    function getAvatar() {
        return $this->avatar;
    }
    function getCliente() {
        return $this->cliente;
    }
    function getTerrestre() {
        return $this->terrestre;
    }
    function getAeronave() {
        return $this->aeronave;
    }
    function getChofer() {
        return $this->chofer;
    }
    function getPiloto() {
        return $this->piloto;
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
    function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function setTerrestre($terrestre) {
        $this->terrestre = $terrestre;
    }
    function setAeronave($aeronave) {
        $this->aeronave = $aeronave;
    }
    function setChofer($chofer) {
        $this->chofer = $chofer;
    }
    function setPiloto($piloto) {
        $this->piloto = $piloto;
    }
    /*-----------------------------------------*/
    function __construct() { }
    public function taquiDif(){
        return $this->taquiFin - $this->taquiIni;
    }
    public function mostrarDateTimeIni(){
        if($this->fechaIni != null){
            $date = date_create($this->fechaIni);
            return date_format($date, "d-m-Y-H-i");         
        } else {
            return null;
        }
    }
    public function mostrarDateTimeFin(){
        if($this->fechaFin != null){
            $date = date_create($this->fechaFin);
            return date_format($date, "d-m-Y-H-i");         
        } else {
            return null;
        }
    }
    public function inverseDateIni(){
        if($this->fechaIni != null){
            $arrdate = explode("-", $this->fechaIni);
            $arresp = explode(" ", $arrdate[2]);
            $arrigual = explode(":", $arresp[1]);
            return $arresp[0]."/".$arrdate[1]."/".$arrdate[0]." ".$arrigual[0].":".$arrigual[1];
        } else {
            return null;
        }
    }
    public function inverseDateFin(){
        if($this->fechaFin != null){
            $arrdate = explode("-", $this->fechaFin);
            $arresp = explode(" ", $arrdate[2]);
            $arrigual = explode(":", $arresp[1]);
            return $arresp[0]."/".$arrdate[1]."/".$arrdate[0]." ".$arrigual[0].":".$arrigual[1];
        } else {
            return null;
        }
    }
    public function getGMDLat(){
        if($this->coordCul != ","){
            $arr = explode(",", $this->coordCul);
            $arr[0] *= -1;        
            $sur = explode(".",$arr[0]);
            $p1 = $sur[0];
            $p2= ($arr[0] - $p1) * 60;
            $arrp2 =  explode(".", $p2);
            $p3 = $arrp2[0];
            $p4 = ($p2 - $p3) * 60;
            $p5 = explode(".", $p4);
            return ($p1)." ".($p3)." ".($p5[0]+1);         
        } else {
            return null;
        }
    }
    public function getGMDLong(){
        if($this->coordCul != ","){
            $arr = explode(",", $this->coordCul);
            $arr[1] *= -1;
            $oeste = explode(".",$arr[1]);
            $p1 = $oeste[0];
            $p2= ($arr[1] - $p1) * 60;
            $arrp2 =  explode(".", $p2);
            $p3 = $arrp2[0];
            $p4 = ($p2 - $p3) * 60;
            $p5 = explode(".", $p4);
            return ($p1)." ".($p3)." ".($p5[0]);
        } else {
            return null;
        }
    }
    /*-----------------------------------------*/        
    public function save() {
        return ($this->id == 0) ? (new AplicacionModel())->addApp($this) : (new AplicacionModel())->modApp($this);
    }
    public function findAdvance($datos = []){
        return (new AplicacionModel())->findAdvance($datos);
    }
    public function totAdvance($datos = []){
        return (new AplicacionModel())->totAdvance($datos);
    } 
    public function findById($id) {
        return (new AplicacionModel())->findById($id);
    }
    public function maxID(){
        return (new AplicacionModel())->maxId();
    }
    public function del() { 
        return (new AplicacionModel())->delete($this);
    }
    public function avatar(){
        return (new AplicacionModel())->getAvatar($this);
    }
    public function find($criterio = null) { }
    
    /*-----------------------------------------*/
    public function addTiene($tiene) {
        return (new AplicacionModel())->addTiene($tiene);
    }
    public function checkTiene($tiene) {
        return (new AplicacionModel())->checkTiene($tiene);
    }
    public function delTiene() {
        return (new AplicacionModel())->delTiene($this->id);
    }
    public function getTiene() {
        return (new AplicacionModel())->getTiene($this->id); 
    }
}