<?php
namespace Clases;
use \App\IPersiste;
use \Model\PistaModel;
class Pista implements IPersiste
{
    private $id;
    private $nombre;
    private $coordenadas;
    function getId() {
        return $this->id;
    }
    function getNombre() {
        return $this->nombre;
    }
    function getCoordenadas() {
        return $this->coordenadas;
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
    function __construct() { }
    public function equals(Pista $obj){
        return $this->nombre == $obj->nombre;                
    }
    public function del() {
        return (new PistaModel())->delete($this);
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
    public function findByX($x) {
        return (new PistaModel())->findByX($x);
    }
}