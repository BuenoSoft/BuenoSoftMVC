<?php
namespace Clases;
class Historial 
{
    private $usado;
    private $combustible;
    private $fecha;
    private $recarga;
    function getUsado() {
        return $this->usado;
    }
    function getCombustible() {
        return $this->combustible;
    }
    function getFecha() {
        return $this->fecha;
    }
    function getRecarga() {
        return $this->recarga;
    }
    function setUsado($usado) {
        $this->usado = $usado;
    }
    function setCombustible($combustible) {
        $this->combustible = $combustible;
    }
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setRecarga($recarga) {
        $this->recarga = $recarga;
    }
    function __construct() { }
}