<?php
namespace Clases;
class Rol 
{
    private $id;
    private $nombre;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }    
    function setNombre($nombre) {
        $this->nombre = strtoupper($nombre);
    }
    function __construct($xid, $xnombre) {
        $this->id = $xid;
        $this->nombre = strtoupper($xnombre);
    }
    public function equals(Rol $obj){
        return $this->nombre == $obj->nombre;                
    }
}