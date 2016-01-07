<?php
namespace Clases;
class TipoVehiculo {
    private $id;
    private $nombre;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }    
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function __construct($xid, $xnombre) {
        $this->id = $xid;
        $this->nombre = $xnombre;
    }
}