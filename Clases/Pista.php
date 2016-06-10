<?php
namespace Clases;
use App\IPersiste;
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
        
    }
    public function find($criterio = null) {
        
    }
    public function findById($id) {
        
    }
    public function save() {
        
    }
}