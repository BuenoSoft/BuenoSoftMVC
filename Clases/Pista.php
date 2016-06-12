<?php
namespace Clases;
use \App\IPersiste;
use \Model\PistaModel;
class Pista implements IPersiste
{
    private $id;
    private $nombre;
    private $coordenadas;
    private $estado;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getCoordenadas() {
        return $this->coordenadas;
    }
    function getEstado() {
        return $this->estado;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setCoordenadas($coordenadas) {
        $this->coordenadas = $coordenadas;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }
    function __construct() { }
    public function equals(Pista $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function del() {
        return (new PistaModel())->delete($this);
    }
    public function active() {
        return (new PistaModel())->active($this);
    }
    public function find($criterio = null) {
        return (new PistaModel())->find($criterio);
    }
    public function findById($id) {
        return (new PistaModel())->findById($id);
    }
    public function save() {
        return ($this->id == 0) ? (new PistaModel())->create($this) : (new PistaModel())->update($this);  
    }
}