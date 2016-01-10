<?php
namespace Clases;
class Modelo {
    private $id;
    private $nombre;
    private $marca;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getMarca() {
        return $this->marca;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = strtoupper($nombre);
    }
    function setMarca($marca) {
        $this->marca = $marca;
    }
    function __construct($xid, $xnombre, $xmarca) {
        $this->id = $xid;
        $this->nombre = strtoupper($xnombre);
        $this->marca = $xmarca;
    }
    public function equals(Modelo $obj){
        return $this->nombre == $obj->nombre;                
    }
}