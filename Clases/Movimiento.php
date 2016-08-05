<?php
namespace Clases;
class Movimiento 
{
    private $fecha;
    private $cantidad;
    private $emisor;
    private $receptor;
    private $usuario;
    function getFecha() {
        return $this->fecha;
    }
    function getCantidad() {
        return $this->cantidad;
    }
    function getEmisor() {
        return $this->emisor;
    }
    function getReceptor() {
        return $this->receptor;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    function setEmisor($emisor) {
        $this->emisor = $emisor;
    }
    function setReceptor($receptor) {
        $this->receptor = $receptor;
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
            return $arresp[0]."/".$arrdate[1]."/".$arrdate[0]." ".$arrigual[0].":".$arrigual[1];
        } else {
            return null;
        }
    }
}