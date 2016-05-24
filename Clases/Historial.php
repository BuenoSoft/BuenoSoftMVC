<?php
namespace Clases;
class Historial {
    private $id;
    private $fecha;
    private $cargaIni;
    private $cargaFin;
    function getId() {
        return $this->id;
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
    function setId($id) {
        $this->id = $id;
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