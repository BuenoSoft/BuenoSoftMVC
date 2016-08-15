<?php
namespace Clases;
use App\IPersiste;
use Model\MovimientoModel;
class Movimiento implements IPersiste
{
    private $id;
    private $fecha;
    private $cantidad;
    private $comEmi;
    private $comRec;
    private $vehEmi;
    private $vehRec;
    private $usuario;
    function getId() {
        return $this->id;
    }
    function getFecha() {
        return $this->fecha;
    }
    function getCantidad() {
        return $this->cantidad;
    }
    function getComEmi() {
        return $this->comEmi;
    }
    function getComRec() {
        return $this->comRec;
    }
    function getVehEmi() {
        return $this->vehEmi;
    }
    function getVehRec() {
        return $this->vehRec;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    function setComEmi($comEmi) {
        $this->comEmi = $comEmi;
    }
    function setComRec($comRec) {
        $this->comRec = $comRec;
    }
    function setVehEmi($vehEmi) {
        $this->vehEmi = $vehEmi;
    }
    function setVehRec($vehRec) {
        $this->vehRec = $vehRec;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function __construct() { }
    public function inverseDateIni(){
        if($this->fecha != null){
            $arrdate = explode("-", $this->fecha);
            $arresp = explode(" ", $arrdate[2]);
            $arrigual = explode(":", $arresp[1]);
            return $arresp[0]."/".$arrdate[1]."/".$arrdate[0]." ".$arrigual[0].":".$arrigual[1].":".$arrigual[2];
        } else {
            return null;
        }
    }
    public function del() {
        return (new MovimientoModel())->delete($this);
    }
    public function find($criterio = null) {
        return (new MovimientoModel())->find($criterio);
    }
    public function findById($id) {
        return (new MovimientoModel())->findById($id);
    }
    public function save() {
        return (new MovimientoModel())->addMov($this);
    }
}