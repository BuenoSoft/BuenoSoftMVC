<?php
namespace Clases;
class Historial 
{
    private $usado;
    private $combustible;
    private $fecha;
    private $cargaIni;
    private $cargaFin;
    function getUsado() {
        return $this->usado;
    }
    function getCombustible() {
        return $this->combustible;
    }
    function getFecha() {
        return $this->fecha;
    }
    function getCargaIni() {
        return $this->cargaIni;
    }
    function getCargaFin() {
        return $this->cargaFin;
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
    function setCargaIni($cargaIni) {
        $this->cargaIni = $cargaIni;
    }
    function setCargaFin($cargaFin) {
        $this->cargaFin = $cargaFin;
    }
    function __construct() { }
}